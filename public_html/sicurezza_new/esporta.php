<?php
include_once ('Spreadsheet/Excel/Writer.php');


$cartella = new Spreadsheet_Excel_Writer();
$cartella->setVersion (8);



$cartella->setCustomColor(10,240,240,240); #Grigio Chiaro
$cartella->setCustomColor(11,192,192,192); #Grigio Scuro
$cartella->setCustomColor(12,255,255,255); #Bianco

$cartella->setCustomColor(22,255,255,255); #Bianco
$cartella->setCustomColor(23,255,255,255); #Bianco
$cartella->setCustomColor(24,255,255,255); #Bianco


$titolo = & $cartella->addFormat();
$titolo->setBold();
$titolo->setFgColor(11);
$titolo->setColor(12);
$titolo->setFontFamily('Tahoma');
$titolo->setSize(8);

$intestazione =& $cartella->addFormat();
$intestazione->setFontFamily('Tahoma');
$intestazione->setSize(8);
$intestazione->setBold();
$intestazione->setFgColor(10);

$normalText =& $cartella->addFormat();
$normalText->setFontFamily('Tahoma');
$normalText->setSize(8);

###################   INTESTAZIONI FOGLIO ###########################################

$cartella->send($nomeFile."test.xls");
$foglio =& $cartella->addWorksheet($tipoDati);
$foglio->writeString(1, 0, 'Evento: '.$nomeEvento,$titolo );
$foglio->writeString(2, 0, 'Gruppo: Mobitour',$titolo );
$foglio->writeString(3, 0, 'Riferimenti : Claudio Gioiosa 348.3903149 ',$titolo);
$foglio->writeString(4, 0, 'Dettaglio: '.$dettaglio,$titolo );
$foglio->writeString(1, 1, '',$titolo );
$foglio->writeString(1, 2, '',$titolo );
$foglio->writeString(2, 1, '',$titolo );
$foglio->writeString(2, 2, '',$titolo );
$foglio->writeString(3, 1, '',$titolo );
$foglio->writeString(3, 2, '',$titolo );
$foglio->writeString(4, 1, '',$titolo );
$foglio->writeString(4, 2, '',$titolo );

$riga = 6;
 $cartella->close();