<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id = NULL;
    private $_username = NULL;

    public function authenticate() {

        if (!$this->username) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!$this->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {

            #VERIFCO PRESENZA UTENTE REGISTRATO SU DB COOPERATIVA
            //$user = Utenti::model()->findByAttributes(array('user' => $this->username, 'password' => $this->password));
            //!$user ? $user = Utenti::model()->findByAttributes(array('email' => $this->username, 'password' => $this->password)):"";

            $user = Utenti::model()->find('user = :input1 OR email = :input2', array('input1'=>$this->username, 'input2' => $this->username));

            if (!$user)
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            else {
                if(password_verify($this->password, $user->password_hash)) {
                    $typeUser = Yii::app()->db->createCommand("SELECT gruppo FROM utenti_tipi WHERE id = '".$user->user_type."'")->queryRow();

                    $this->_id = $user->id;
                    $this->_username = $user->user;
                    $this->setState('__name', $user->user);
                    $this->setState('username', $user->user);
                    $this->setState('group', $typeUser['gruppo']);
                    $this->setState('typeUserId', $user->user_type);
                    $this->setState('strutture', explode(',', $user->user_unita));
                    $this->setState('expiredPassword', ($user->password_expired_at ? (new DateTime($user->password_expired_at))->getTimestamp(): null));
                    $this->setState('is_maintenance_lead', $user->is_maintenance_lead);
                    $this->errorCode = self::ERROR_NONE;

                    //registro login su tabella accessi
                    $login = new UtentiLoginAccess;
                    $login->user_id = $user->id;
                    $login->ip_address = $_SERVER["HTTP_CF_CONNECTING_IP"] ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];
                    $login->save(false);
                }
                else {
                    $this->errorCode = self::ERROR_USERNAME_INVALID;
                }
            }
        }
        
        return!$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    public function getName() {
        return $this->_username;
    }
}