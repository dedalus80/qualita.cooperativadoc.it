<?php

include_once ('Spreadsheet/Excel/Writer.php');

$cartella = new Spreadsheet_Excel_Writer();
$cartella->setVersion(8);
#$cartella->setInputEncoding('UTF-8');




#$cartella->setCustomColor(10, 240, 240, 240); #Grigio Chiaro
#$cartella->setCustomColor(11, 192, 192, 192); #Grigio Scuro
#$cartella->setCustomColor(12, 255, 255, 255); #Bianco

$intestazione = & $cartella->addFormat();
$intestazione->setFontFamily('Tahoma');
$intestazione->setSize(12);
$intestazione->setBold();
$intestazione->setFgColor('red');
$intestazione->setColor('white');

$normalText = & $cartella->addFormat();
$normalText->setFontFamily('Tahoma');
$normalText->setSize(10);

###################   INTESTAZIONI FOGLIO ###########################################

$cartella->send("pre_iscrizioni.xls");
$foglio = & $cartella->addWorksheet($tipoDati);
$foglio->setInputEncoding('UTF-8');


$riga = 0;
$foglio->setRow ( $riga, "20" ,  $format=0 );
$foglio->writeString($riga, 0, 'Data', $intestazione);
$foglio->writeString($riga, 1, 'ID', $intestazione);
$foglio->writeString($riga, 2, 'Dal', $intestazione);
$foglio->writeString($riga, 3, 'Al', $intestazione);
$foglio->writeString($riga, 4, 'Formula', $intestazione);
$foglio->writeString($riga, 5, 'Nome', $intestazione);
$foglio->writeString($riga, 6, 'Cognome', $intestazione);
$foglio->writeString($riga, 7, 'Cellulare', $intestazione);
$foglio->writeString($riga, 8, 'Email', $intestazione);
$foglio->writeString($riga, 9, 'Sesso', $intestazione);
$foglio->writeString($riga, 10, 'Data Nascita', $intestazione);
$foglio->writeString($riga, 11, 'Luogo Nascita', $intestazione);
$foglio->writeString($riga, 12, 'Nazionalita', $intestazione);
$foglio->writeString($riga, 13, 'Occupazione', $intestazione);
$foglio->writeString($riga, 14, 'Prima Volta In Sharing?', $intestazione);
$foglio->writeString($riga, 15, 'Conosciuti tramite ', $intestazione);
$foglio->writeString($riga, 16, 'Coabitazione con', $intestazione);
$foglio->writeString($riga, 17, 'Consenso', $intestazione);
$foglio->writeString($riga, 18, 'Mailing List', $intestazione);
$foglio->writeString($riga, 19, 'Note', $intestazione);

$riga++;

for ($x = 0; $x < count($dati); $x++) {
    $foglio->writeString($riga, 0, $model->getItaDate($dati[$x]['data_insert']), $normalText);
    $foglio->writeString($riga, 1, $dati[$x]['id'], $normalText);
    $foglio->writeString($riga, 2, $model->getItaDate($dati[$x]['data_in']), $normalText);
    $foglio->writeString($riga, 3, $model->getItaDate($dati[$x]['data_out']), $normalText);
    
    if($dati[$x]['formula']=='1')
        $foglio->writeString($riga, 4, $model->getSelectValue($dati[$x]['campus'],'doc_campus'), $normalText);
    if($dati[$x]['formula']=='2')
        $foglio->writeString($riga, 4, $model->getSelectValue($dati[$x]['housing'],'doc_housing'), $normalText);
    $foglio->writeString($riga, 5, $dati[$x]['nome'], $normalText);
    $foglio->writeString($riga, 6, $dati[$x]['cognome'], $normalText);
    $foglio->writeString($riga, 7, $dati[$x]['cellulare'], $normalText);
    $foglio->writeString($riga, 8, $dati[$x]['email'], $normalText);
    
    if($dati[$x]['sesso']=='M')
        $foglio->writeString($riga, 9, "Maschio", $normalText);
    if($dati[$x]['sesso']=='F')
        $foglio->writeString($riga, 9, "Femmina", $normalText);
    
    $foglio->writeString($riga, 10, $model->getItaDate($dati[$x]['data_nascita']), $normalText);
    $foglio->writeString($riga, 11, $dati[$x]['luogo_nascita'], $normalText);
    $foglio->writeString($riga, 12, $model->getSelectValue($dati[$x]['nazionalita'],'doc_nazioni'), $normalText);
    $foglio->writeString($riga, 13, $model->getSelectValue($dati[$x]['occupazione'],'doc_occupazioni'), $normalText);
    
    if($dati[$x]['prima_volta']=='Y')
        $foglio->writeString($riga, 14, "SI", $normalText);
    if($dati[$x]['prima_volta']=='N')
        $foglio->writeString($riga, 14, "NO", $normalText);
    
    $foglio->writeString($riga, 15, $model->getSelectValue($dati[$x]['conoscenza'],'doc_segnalato'), $normalText);
    
    $foglio->writeString($riga, 16, $dati[$x]['coabitazione'], $normalText);
    
    if($dati[$x]['privacy']=='Y')
        $foglio->writeString($riga, 17, "SI", $normalText);
    if($dati[$x]['privacy']=='N')
        $foglio->writeString($riga, 17, "NO", $normalText);
    if($dati[$x]['mailing']=='Y')
        $foglio->writeString($riga, 18, "SI", $normalText);
    if($dati[$x]['mailing']=='N')
        $foglio->writeString($riga, 18, "NO", $normalText);
    
    
    $foglio->writeString($riga, 19, utf8_decode($dati[$x]['note']), $normalText);
    
    
    $riga++;
    $k++;
}


$cartella->close();
?>