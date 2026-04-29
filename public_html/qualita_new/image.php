
<?php

function setVectorGraphics() {
    //Setup a draw object with some drawing in it.
    $draw=new \ImagickDraw();
    $draw->setFillColor("red");
    $draw->circle(20, 20, 50, 50);
    $draw->setFillColor("blue");
    $draw->circle(50, 70, 50, 50);
    $draw->rectangle(50, 120, 80, 150);
    
    //Get the drawing as a string
    $SVG=$draw->getVectorGraphics();
    
    //$svg is a string, and could be saved anywhere a string can be saved
    
    //Use the saved drawing to generate a new draw object
    $draw2=new \ImagickDraw();
    //Apparently the SVG text is missing the root element. 
    $draw2->setVectorGraphics($SVG);
    
    $imagick=new \Imagick();
    $imagick->newImage(200, 200, 'white');
    $imagick->setImageFormat("png");
    
    $imagick->drawImage($draw2);
    
    header("Content-Type: image/png");
    echo $imagick->getImageBlob();
}

setVectorGraphics();

?>