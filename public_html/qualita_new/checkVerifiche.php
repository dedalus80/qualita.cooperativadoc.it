#!/usr/bin/php
<?php

$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);

/*
Cron richiamato alle 09.05 
Manda reminder verifica
*/ 

$ieri = date('Y-m-d', strtotime(' -1 day'));

//$verifiche = Yii::app()->db->createCommand("SELECT id FROM db_verifiche WHERE data_prevista ='".$ieri."' ")->queryAll();


if(count($verifiche)){
	for($x = 0 ; $x < count($verifiche); $x++){
		Yii::app()->MyEmails->sendEmailVerifica("reminder", $verifiche[$x]['id']);
	}
	
}

//$formazione = Yii::app()->db->createCommand("SELECT id, invio_sms, invio_email ,  data , giorni_invio_sms , giorni_invio_email  FROM db_formazione WHERE invio_sms='Y' || invio_email ='Y'  AND data >= '".date("Y-m-d")."'")->queryAll();

$oggi = date("d-m-Y");

if(count($formazione)){
    
    for($x = 0 ; $x < count($formazione) ; $x++ ){
        
        if($formazione[$x]['invio_sms'] =='Y'){
            $sendSmsDate    = Yii::app()->MyUtils->getDataFromDays($formazione[$x]['data'], $formazione[$x]['giorni_invio_sms']) ; 
            
            if($sendSmsDate == $oggi)    
                Yii::app()->MySms->sendSmsFormazione($formazione[$x]['id']);   
        
        }
        
        if($formazione[$x]['invio_email'] =='Y'){
            $sendEmailDate    = Yii::app()->MyUtils->getDataFromDays($formazione[$x]['data'], $formazione[$x]['giorni_invio_email']) ; 
            
            if($sendEmailDate == $oggi)    
                 Yii::app()->MyEmails->sendEmailFormazione($formazione[$x]['id']);   
        }
    }
}

?>