
<?php
/**
 * MailQueueCommand class file.
 *
 * @author Matt Skelton
 * @date 26-Jun-2011
 */

/**
 * Sends out emails based on the retrieved EmailQueue objects. 
 */
class MailQueueCommand extends CConsoleCommand
{
    static public function getSMTPData($scenario = null)
    {
        switch($scenario) {
            case 'formazione':
                $data = [
                    'host'=>'smtp.office365.com',
                    'port'=>587,
                    'secure'=>'tls',
                    'auth'=>true,
                    'username'=>'gest.qualita@cooperativadoc.it',
                    'password'=>'Daq01129'
                ];
                break;
        }

        return $data;
    }

    public function run($args)
    {

        //mark records like in process...
        EmailQueue::model()->updateAll(array('status' => 1), 'status = 0 AND success = 0 AND attempts < max_attempts AND date_scheduled <= "'.date('Y-m-d H:i:s').'"');

        $criteria = new CDbCriteria(array(
                'condition' => 'status=:status AND success=:success AND attempts < max_attempts',
                'params' => array(
                    ':status' => 1,
                    ':success' => 0,
                ),
            ));

        $queueList = EmailQueue::model()->findAll($criteria);

        if(count($queueList) == 0) {
            echo date('Y-m-d H:i:s')." - Nessuna email in coda\n";
            return;
        }

        /* @var $queueItem EmailQueue */
        foreach ($queueList as $queueItem)
        {
            $message = new YiiMailer();
            //$message->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
            $message->setTo($queueItem->to_email);
            $message->setFrom($queueItem->from_email,$queueItem->from_name);
            $message->setSubject($queueItem->subject);
            $message->setBody($queueItem->message);
            $smtp = self::getSMTPData('formazione');
            $message->setSmtp($smtp['host'], $smtp['port'], $smtp['secure'], $smtp['auth'], $smtp['username'], $smtp['password']);

            if ($this->sendEmail($message))
            {
                $queueItem->attempts = $queueItem->attempts + 1;
                $queueItem->success = 1;
                $queueItem->status = 2;
                $queueItem->last_attempt = new CDbExpression('NOW()');
                $queueItem->date_sent = new CDbExpression('NOW()');

                $queueItem->save();
            }
            else
            {
                $queueItem->attempts = $queueItem->attempts + 1;
                $queueItem->status = 0;
                $queueItem->last_attempt = new CDbExpression('NOW()');

                $queueItem->save();
            }
        }
    }

    /**
        * Sends an email to the user.
        * This methods expects a complete message that includes to, from, subject, and body
        *
        * @param YiiMailer $message the message to be sent to the user
        * @return boolean returns true if the message was sent successfully or false if unsuccessful
        */
    private function sendEmail(YiiMailer $message)
    {
        $sendStatus = false;

        //if (Yii::app()->mail->send($message) > 0)
        if($message->send())
            $sendStatus = true;

        return $sendStatus;
    }

}
?>