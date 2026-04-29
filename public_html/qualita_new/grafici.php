<?php

phpinfo();
exit();

$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config);

 
/*
$img = $_POST['img']; 
$nome = $_POST['nome'];

$fp = fopen('./temp/'.$nome.'.svg', 'w');
fwrite($fp, base64_decode($img) );

if(fclose($fp)){
    
   $im = new Imagick();
   $svg = file_get_contents('./temp/'.$nome.'.svg'); 
   $im->readImageBlob($svg);
   $im->setImageFormat("png24");
   $im->writeImage('./temp/'.$nome.'.svg');

}
*/






$im = new Imagick();

$svg = file_get_contents('./temp/c_acqua.svg'); 
$im->setBackgroundColor(new ImagickPixel("transparent"));
//$im->magick("SVG");
//$im->magick("svg");
$im->readImageBlob('<?xml version="1.0" encoding="UTF-8" standalone="no"?>'.$svg);
$im->setImageFormat("png24");
$im->writeImage('./temp/c_acqua.png');

?>


?>