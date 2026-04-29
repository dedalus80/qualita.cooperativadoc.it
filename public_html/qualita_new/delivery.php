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
$_REQUEST["test"]       = "TEXT";
$_REQUEST["number"]     = "+393403405409";
$_REQUEST["idrefer"]    = "2";
$_REQUEST["status"]     = "1";
$_REQUEST["reason"]     = "Delivered";
$_REQUEST["date"]       = "2017-11-15 13:09:48"; 
*/

foreach($_REQUEST AS $id => $val)
    $txt .= $id ." =====>  ".$val." <br />";


// MI INVIO UNA MAIL CON LE DELIVERY POI CANCELLO NON MI SERVIRA' PIU
Yii::app()->MyEmails->smtpObject = "Oggetto";
Yii::app()->MyEmails->smtpText = "TEST file delivery ".$txt;
Yii::app()->MyEmails->send();

// SALVO LA DELIVERY
Yii::app()->MySms->delivery = $_REQUEST;
Yii::app()->MySms->saveDelivery();

?>