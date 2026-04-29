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

$cartella->send("questionari_doc.xls");
$foglio = & $cartella->addWorksheet($tipoDati);
$foglio->setInputEncoding('UTF-8');

$riga = 0;
$foglio->setRow ( $riga, "20" ,  $format=0 );
$foglio->writeString($riga, 0, 'ID', $intestazione);
$foglio->writeString($riga, 1, 'Data Consegna', $intestazione);
$foglio->writeString($riga, 2, 'Nome', $intestazione);
$foglio->writeString($riga, 3, 'Cognome', $intestazione);
$foglio->writeString($riga, 4, 'La Vacanza', $intestazione);
$foglio->writeString($riga, 5, 'Struttura', $intestazione);
$foglio->writeString($riga, 6, 'Struttura Pulizia', $intestazione);
$foglio->writeString($riga, 7, 'Struttura Complessivo', $intestazione);
$foglio->writeString($riga, 8, 'Stanza Confort', $intestazione);
$foglio->writeString($riga, 9, 'Stanza Arredi', $intestazione);
$foglio->writeString($riga, 10, 'Stanza Pulizia', $intestazione);
$foglio->writeString($riga, 11, 'Stanza Complessivo', $intestazione);
$foglio->writeString($riga, 12, 'Ristorante Servizio', $intestazione);
$foglio->writeString($riga, 13, 'Ristorante Attesa', $intestazione);
$foglio->writeString($riga, 14, 'Ristorante Cibo', $intestazione);
$foglio->writeString($riga, 15, 'Ristorante Menu', $intestazione);
$foglio->writeString($riga, 16, 'Ristorante Complessivo', $intestazione);
$foglio->writeString($riga, 17, 'Personale Cortesia', $intestazione);
$foglio->writeString($riga, 18, 'Personale professionalit�', $intestazione);
$foglio->writeString($riga, 19, 'Personale Complessivo', $intestazione);
$foglio->writeString($riga, 20, 'Consiglia', $intestazione);
$foglio->writeString($riga, 21, 'Suggerimenti', $intestazione);
$riga++;

for ($x = 0; $x < count($dati); $x++) {
    $foglio->writeString($riga, 0,  $dati[$x]['id'], $normalText);
    $foglio->writeString($riga, 1,  $model->getItaDate($dati[$x]['data_consegna']), $normalText);
    $foglio->writeString($riga, 2,  $dati[$x]['nome'], $normalText);
    $foglio->writeString($riga, 3,  $dati[$x]['cognome'], $normalText);
    $foglio->writeString($riga, 4,  $model->getSelectValue($dati[$x]['vacanza'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 5,  $model->getSelectValue($dati[$x]['struttura_nome'],'doc_unita'), $normalText);
    $foglio->writeString($riga, 6,  $model->getSelectValue($dati[$x]['struttura_pulizia'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 7,  $model->getSelectValue($dati[$x]['struttura_complessivo'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 8,  $model->getSelectValue($dati[$x]['stanza_confort'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 9,  $model->getSelectValue($dati[$x]['stanza_arredi'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 10, $model->getSelectValue($dati[$x]['stanza_pulizia'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 11, $model->getSelectValue($dati[$x]['stanza_complessivo'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 12, $model->getSelectValue($dati[$x]['ristorante_servizio'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 13, $model->getSelectValue($dati[$x]['ristorante_attesa'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 14, $model->getSelectValue($dati[$x]['ristorante_cibo'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 15, $model->getSelectValue($dati[$x]['ristorante_menu'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 16, $model->getSelectValue($dati[$x]['ristorante_complessivo'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 17, $model->getSelectValue($dati[$x]['personale_cortesia'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 18, $model->getSelectValue($dati[$x]['personale_professionalita'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 19, $model->getSelectValue($dati[$x]['personale_complessivo'],'doc_giudizzi'), $normalText);
    $foglio->writeString($riga, 20, $model->getSelectValue($dati[$x]['consiglia'],'doc_consiglia'), $normalText);
    $foglio->writeString($riga, 21, $dati[$x]['suggerimenti'], $normalText);
    $riga++;
    $k++;
}


$cartella->close();
?>
