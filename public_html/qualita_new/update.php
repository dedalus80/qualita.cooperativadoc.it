<?php

$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);
$result  =  Yii::app()->db->createCommand("SELECT user_unita , id  FROM utenti")->queryAll();

for($x=0; $x < count($result); $x++){
    
    $centro = Yii::app()->db->createCommand("SELECT centro from doc_unita WHERE id ='".$result[$x]['user_unita']."'")->queryScalar();
    
    if($centro)
        Yii::app()->db->createCommand("UPDATE  utenti   SET user_centro ='".$centro."' WHERE id ='".$result[$x]['id']."'")->execute();
    
}



?>