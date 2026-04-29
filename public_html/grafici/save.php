<?php 
/*
$img = $_POST['img']; 
$nome = $_POST['nome'];

$fp = fopen($nome.'.svg', 'w');
fwrite($fp, base64_decode($img) );
if(fclose($fp)){
    
   $im = new Imagick();
   $svg = file_get_contents($nome.'.svg'); 
   $im->readImageBlob($svg);
   $im->setImageFormat("png24");
   $im->writeImage($nome.'.svg');

}

*/

$im = new Imagick();

$svg = file_get_contents('c_gas.svg'); 



$im->setBackgroundColor(new ImagickPixel("transparent"));
$im->readImageBlob($svg);

$im->setImageFormat("png24");
$im->writeImage('c.gas.svg');

?>