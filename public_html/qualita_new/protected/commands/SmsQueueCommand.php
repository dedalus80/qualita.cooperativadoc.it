<?php
/**
 * SmsQueueCommand class file.
 *
 * @author Luciano Ciaramella
 * @date 11/05/2022
 */

/**
 * Sends out sms based on the sms api MG. 
 */
class SmsQueueCommand extends CConsoleCommand
{
    public function run($args)
    {
        $criteria = new CDbCriteria(array(
                'condition' => 'success=:success AND attempts < max_attempts',
                'params' => array(
                    ':success' => 0,
                ),
            ));

        $queueList = SmsQueue::model()->findAll($criteria);

        if(count($queueList) == 0) {
            echo date('Y-m-d H:i:s')." - Nessun SMS in coda\n";
            return;
        }

        /* @var $queueItem SmsQueue */
        foreach ($queueList as $queueItem)
        {
            $message = new SMS();
            $message->setTo($queueItem->recipient);
            $message->setSender($queueItem->sender);
            $message->setText($queueItem->message);

            if ($message->send())
            {
                $queueItem->attempts = $queueItem->attempts + 1;
                $queueItem->success = 1;
                $queueItem->last_attempt = new CDbExpression('NOW()');
                $queueItem->date_sent = new CDbExpression('NOW()');

                $queueItem->save();
            }
            else
            {
                $queueItem->attempts = $queueItem->attempts + 1;
                $queueItem->last_attempt = new CDbExpression('NOW()');

                $queueItem->save();
            }
        }
    }
}
?>