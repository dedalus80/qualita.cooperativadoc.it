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
$foglio->setRow($riga, "20", $format = 0);
$foglio->writeString($riga, 0, 'Data', $intestazione);
$foglio->writeString($riga, 1, 'ID', $intestazione);
$foglio->writeString($riga, 2, 'Dal', $intestazione);
$foglio->writeString($riga, 3, 'Al', $intestazione);
$foglio->writeString($riga, 4, 'Nome', $intestazione);
$foglio->writeString($riga, 5, 'Cognome', $intestazione);
$foglio->writeString($riga, 6, 'Cellulare', $intestazione);
$foglio->writeString($riga, 7, 'Email', $intestazione);
$foglio->writeString($riga, 8, 'Sesso', $intestazione);
$foglio->writeString($riga, 9, 'Data Nascita', $intestazione);
$foglio->writeString($riga, 10, 'Luogo Nascita', $intestazione);
$foglio->writeString($riga, 11, 'Nazionalita', $intestazione);
$foglio->writeString($riga, 12, 'Occupazione', $intestazione);
$foglio->writeString($riga, 13, 'Prima Volta con Stessopiano?', $intestazione);
$foglio->writeString($riga, 14, 'Conosciuti tramite ', $intestazione);

$foglio->writeString($riga, 15, 'Camera', $intestazione);
$foglio->writeString($riga, 16, 'Appartamento', $intestazione);
$foglio->writeString($riga, 17, 'Spesa Massima', $intestazione);

$foglio->writeString($riga, 18, 'Coinquilini', $intestazione);

$foglio->writeString($riga, 19, 'Quartieri', $intestazione);
$foglio->writeString($riga, 20, 'Fumatore', $intestazione);

$foglio->writeString($riga, 21, 'Animali', $intestazione);

$foglio->writeString($riga, 22, 'Coabitazione con', $intestazione);
$foglio->writeString($riga, 23, 'Consenso', $intestazione);
$foglio->writeString($riga, 24, 'Mailing List', $intestazione);

$foglio->writeString($riga, 25, 'Altro interesse', $intestazione);
$foglio->writeString($riga, 26, 'Note', $intestazione);

$riga++;

for ($x = 0; $x < count($dati); $x++) {
    
    
    
    
    $foglio->writeString($riga, 0, $model->getItaDate($dati[$x]['data_insert']), $normalText);
    $foglio->writeString($riga, 1, $dati[$x]['id'], $normalText);
    $foglio->writeString($riga, 2, $model->getItaDate($dati[$x]['data_in']), $normalText);
    $foglio->writeString($riga, 3, $model->getItaDate($dati[$x]['data_out']), $normalText);
    $foglio->writeString($riga, 4, $dati[$x]['nome'], $normalText);
    $foglio->writeString($riga, 5, $dati[$x]['cognome'], $normalText);
    $foglio->writeString($riga, 6, $dati[$x]['cellulare'], $normalText);
    $foglio->writeString($riga, 7, $dati[$x]['email'], $normalText);
    
    
    
    if ($dati[$x]['sesso'] == 'M')
        $foglio->writeString($riga, 8, "Maschio", $normalText);
    if ($dati[$x]['sesso'] == 'F')
        $foglio->writeString($riga, 8, "Femmina", $normalText);

    $foglio->writeString($riga, 9, $model->getItaDate($dati[$x]['data_nascita']), $normalText);
    $foglio->writeString($riga, 10, $dati[$x]['luogo_nascita'], $normalText);
    $foglio->writeString($riga, 11, $model->getSelectValue($dati[$x]['nazionalita'], 'doc_nazioni'), $normalText);
    $foglio->writeString($riga, 12, $model->getSelectValue($dati[$x]['occupazione'], 'sp_occupazione'), $normalText);

    if ($dati[$x]['prima_volta'] == 'Y')
        $foglio->writeString($riga, 13, "SI", $normalText);
    if ($dati[$x]['prima_volta'] == 'N')
        $foglio->writeString($riga, 13, "NO", $normalText);

    $foglio->writeString($riga, 14, $model->getSelectValue($dati[$x]['conoscenza'], 'sp_conoscenza'), $normalText);

    if ($dati[$x]['camera'] == 'Y')
        $foglio->writeString($riga, 15, $model->getSelectValue($dati[$x]['tipo_camera'], 'sp_camera'), $normalText);
    else
        $foglio->writeString($riga, 15, "", $normalText);

    if ($dati[$x]['appartamento'] == 'Y')
        $foglio->writeString($riga, 16, $model->getSelectValue($dati[$x]['tipo_appartamento'], 'sp_appartamento'), $normalText);
    else
        $foglio->writeString($riga, 16, "", $normalText);
    
    
     $foglio->writeString($riga, 17, $model->geLivello($dati[$x]['livello'],$dati[$x]['id']), $normalText);
    
    
    if ($dati[$x]['coinquilini'] == 'Y')
        $foglio->writeString($riga, 18, $dati[$x]['coinquilini_n'], $normalText);
    if ($dati[$x]['coinquilini'] == 'N')
        $foglio->writeString($riga, 18, "NO", $normalText);

    
    $quartieri = explode(",", $dati[$x]['quartieri']);
    for ($z = 0; $z < count($quartieri); $z++)
        $q[$x] .= " ".$model->getSelectValue($quartieri[$z], 'sp_quartiere');
    
    #echo $q[$x];
    
    $foglio->writeString($riga, 19, $q[$x] , $normalText);
    
    #$foglio->writeString($riga, 19, $model->getQuartieri($dati[$x]['id']), $normalText);
    
    
    
    if ($dati[$x]['fumatore'] == 'Y')
        $foglio->writeString($riga, 20, "SI ", $normalText);
    if ($dati[$x]['fumatore'] == 'N')
        $foglio->writeString($riga, 20, "NO", $normalText);

    if ($dati[$x]['animali'] == 'Y')
        $foglio->writeString($riga, 21, $dati[$x]['animali_det'], $normalText);
    if ($dati[$x]['animali'] == 'N')
        $foglio->writeString($riga, 21, "NO", $normalText);

    $foglio->writeString($riga, 22, $model->getSelectValue($dati[$x]['coabitazione'], 'sp_coabitazione'), $normalText);
    $foglio->writeString($riga, 23, $dati[$x]['privacy'] == 'Y' ? "SI" : "NO", $normalText);
    $foglio->writeString($riga, 24, $dati[$x]['mailing'] == 'Y' ? "SI" : "NO", $normalText);
    $foglio->writeString($riga, 25, utf8_decode($dati[$x]['interesse']), $normalText);
    $foglio->writeString($riga, 26, utf8_decode($dati[$x]['note']), $normalText);
    

    $riga++;
    $k++;
}


$cartella->close();
?>