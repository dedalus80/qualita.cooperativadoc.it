<?php

class DocumentPublicDownload
{
    const TOKEN_TTL = 2592000;

    public static function createUrl($route, $id)
    {
        $expires = time() + self::TOKEN_TTL;

        return Yii::app()->createAbsoluteUrl($route, array(
            'id' => (int)$id,
            'expires' => $expires,
            'token' => self::createToken($route, $id, $expires),
        ));
    }

    public static function validateRequest($route, $id, $expires, $token)
    {
        if(!$id || !$expires || !$token || !ctype_digit((string)$id) || !ctype_digit((string)$expires)) {
            return false;
        }

        $id = (int)$id;
        $expires = (int)$expires;

        if($id <= 0 || $expires < time()) {
            return false;
        }

        return self::hashEquals(self::createToken($route, $id, $expires), $token);
    }

    public static function sendFile($path, $baseDir = null)
    {
        $realPath = realpath($path);

        if($baseDir !== null) {
            $realBaseDir = realpath($baseDir);

            if($realBaseDir === false || $realPath === false || strpos($realPath, $realBaseDir . DIRECTORY_SEPARATOR) !== 0) {
                throw new CHttpException(404, 'Il documento richiesto non è stato trovato.');
            }
        }

        if($realPath === false || !is_file($realPath)) {
            throw new CHttpException(404, 'Il documento richiesto non è stato trovato.');
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . self::getSafeFilename($realPath) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($realPath));

        if(ob_get_length()) {
            ob_clean();
        }

        flush();
        readfile($realPath);
        Yii::app()->end();
    }

    protected static function createToken($route, $id, $expires)
    {
        return hash_hmac('sha256', $route . '|' . (int)$id . '|' . (int)$expires, self::getSecret());
    }

    protected static function getSecret()
    {
        return Yii::app()->getSecurityManager()->getValidationKey();
    }

    protected static function getSafeFilename($path)
    {
        return str_replace(array("\r", "\n", '"'), '', basename($path));
    }

    protected static function hashEquals($knownString, $userString)
    {
        if(function_exists('hash_equals')) {
            return hash_equals($knownString, $userString);
        }

        if(strlen($knownString) !== strlen($userString)) {
            return false;
        }

        $result = 0;

        for($i = 0; $i < strlen($knownString); $i++) {
            $result |= ord($knownString[$i]) ^ ord($userString[$i]);
        }

        return $result === 0;
    }
}
