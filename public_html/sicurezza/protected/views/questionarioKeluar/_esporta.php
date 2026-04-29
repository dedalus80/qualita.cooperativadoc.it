<?php

include_once ('Spreadsheet/Excel/Writer.php');

$cartella = new Spreadsheet_Excel_Writer();
$cartella->setVersion(8);

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

$cartella->send("questionari_keluar.xls");
$foglio = & $cartella->addWorksheet($tipoDati);
$foglio->setInputEncoding('UTF-8');

$riga = 0;
$foglio->setRow($riga, "20", $format = 0);
$foglio->writeString($riga, 0, 'ID', $intestazione);
$foglio->writeString($riga, 1, 'Data Consegna', $intestazione);
$foglio->writeString($riga, 2, 'Nome', $intestazione);
$foglio->writeString($riga, 3, 'Cognome', $intestazione);
$foglio->writeString($riga, 4, 'Sede Operativa', $intestazione);
$foglio->writeString($riga, 5, 'Scuola', $intestazione);
$foglio->writeString($riga, 6, 'Struttura', $intestazione);
$foglio->writeString($riga, 7, 'Viaggio Complessivo', $intestazione);
$foglio->writeString($riga, 8, 'Struttura Complessivo', $intestazione);
$foglio->writeString($riga, 9, 'Camera Pulizia', $intestazione);
$foglio->writeString($riga, 10, 'Camera Confort', $intestazione);
$foglio->writeString($riga, 11, 'Trasporto Nome', $intestazione);
$foglio->writeString($riga, 12, 'Trasporto Qualità', $intestazione);
$foglio->writeString($riga, 13, 'Trasporto Cortesia', $intestazione);
$foglio->writeString($riga, 14, 'Trasporto Tempi', $intestazione);
$foglio->writeString($riga, 15, 'Ristorante Servizio', $intestazione);
$foglio->writeString($riga, 16, 'Ristorante Cibo', $intestazione);
$foglio->writeString($riga, 17, 'Ristorante Menu', $intestazione);
$foglio->writeString($riga, 18, 'Personale Cortesia', $intestazione);
$foglio->writeString($riga, 19, 'Personale disponibilità', $intestazione);
$foglio->writeString($riga, 20, 'Escursioni Itinerari', $intestazione);
$foglio->writeString($riga, 21, 'Escursioni Guida', $intestazione);
$foglio->writeString($riga, 22, 'Neve Noleggio', $intestazione);
$foglio->writeString($riga, 23, 'Neve Scuola', $intestazione);
$foglio->writeString($riga, 24, 'Laboratori tecnici', $intestazione);
$foglio->writeString($riga, 25, 'Laboratori Competenze', $intestazione);
$foglio->writeString($riga, 26, 'Consiglia', $intestazione);
$foglio->writeString($riga, 27, 'Suggerimenti', $intestazione);
$foglio->writeString($riga, 28, 'Rapporto con keluar', $intestazione);


$riga++;

for ($x = 0; $x < count($dati); $x++) {
    $foglio->writeString($riga, 0, $dati[$x]['id'], $normalText);
    $foglio->writeString($riga, 1, $model->getItaDate($dati[$x]['data_consegna']), $normalText);
    $foglio->writeString($riga, 2, $dati[$x]['nome'], $normalText);
    $foglio->writeString($riga, 3, $dati[$x]['cognome'], $normalText);
    $foglio->writeString($riga, 4, $dati[$x]['sede_operativa'], $normalText);
    $foglio->writeString($riga, 5, $dati[$x]['scuola'], $normalText);
    $foglio->writeString($riga, 6, $model->getSelectValue($dati[$x]['struttura_nome'], 'doc_unita'), $normalText);
    $foglio->writeString($riga, 7, $model->getSelectValue($dati[$x]['viaggio_complessivo'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 8, $model->getSelectValue($dati[$x]['struttura_complessivo'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 9, $model->getSelectValue($dati[$x]['camera_pulizia'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 10, $model->getSelectValue($dati[$x]['camera_confort'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 11, $dati[$x]['trasporto_nome'], $normalText);
    $foglio->writeString($riga, 12, $model->getSelectValue($dati[$x]['trasporto_qualita'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 13, $model->getSelectValue($dati[$x]['trasporto_cortesia'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 14, $model->getSelectValue($dati[$x]['trasporto_tempi'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 15, $model->getSelectValue($dati[$x]['ristorante_servizio'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 16, $model->getSelectValue($dati[$x]['ristorante_cibo'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 17, $model->getSelectValue($dati[$x]['ristorante_menu'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 17, $model->getSelectValue($dati[$x]['ristorante_menu'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 18, $model->getSelectValue($dati[$x]['personale_cortesia'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 19, $model->getSelectValue($dati[$x]['personale_disponibilita'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 20, $model->getSelectValue($dati[$x]['escursioni_itinerari'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 21, $model->getSelectValue($dati[$x]['escursioni_guida'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 22, $model->getSelectValue($dati[$x]['neve_noleggio'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 23, $model->getSelectValue($dati[$x]['neve_scuola'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 24, $model->getSelectValue($dati[$x]['laboratori_tecnici'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 25, $model->getSelectValue($dati[$x]['laboratori_competenze'], 'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 26, $model->getSelectValue($dati[$x]['consiglia'], 'doc_consiglia'), $normalText);
    $foglio->writeString($riga, 27, $dati[$x]['suggerimenti'], $normalText);
    $foglio->writeString($riga, 28, $model->getSelectValue($dati[$x]['rapporto_keluar'], 'doc_giudizzi'), $normalText);
    $riga++;
    $k++;
}


$cartella->close();
?>