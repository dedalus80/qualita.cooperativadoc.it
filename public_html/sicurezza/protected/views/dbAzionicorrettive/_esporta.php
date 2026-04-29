<?php

include_once ('Spreadsheet/Excel/Writer.php');

$cartella = new Spreadsheet_Excel_Writer();


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

$cartella->send("azioni_preventive-correttive.xls");
$foglio = & $cartella->addWorksheet($tipoDati);
$foglio->setInputEncoding('UTF-8');

$riga = 0;
$foglio->setRow ( $riga, "20" ,  $format=0 );
$foglio->writeString($riga, 0, 'Data', $intestazione);
$foglio->writeString($riga, 1, 'ID', $intestazione);
$foglio->writeString($riga, 2, 'Tipo Azione', $intestazione);
$foglio->writeString($riga, 3, 'Riferimento', $intestazione);
$foglio->writeString($riga, 4, 'Inserito da', $intestazione);
$foglio->writeString($riga, 5, 'Nome', $intestazione);
$foglio->writeString($riga, 6, 'Cognome', $intestazione);
$foglio->writeString($riga, 7, 'Funzione', $intestazione);
$foglio->writeString($riga, 8, 'Società', $intestazione);
$foglio->writeString($riga, 9, 'Tipologia', $intestazione);
$foglio->writeString($riga, 10, 'Unità Operativa', $intestazione);
$foglio->writeString($riga, 11, 'Trattamento', $intestazione);
$foglio->writeString($riga, 12, 'Descrizione', $intestazione);
$riga++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
    $foglio->writeString($riga, 0, $model->getItaDate($model->datiEsportazione[$x]['data']), $normalText);
    $foglio->writeString($riga, 1, $model->datiEsportazione[$x]['id'], $normalText);
    $foglio->writeString($riga, 2, $model->getSelectValue($model->datiEsportazione[$x]['tipo_azione'],'doc_azione'), $normalText);
    $foglio->writeString($riga, 3, $model->getCodice($model->datiEsportazione[$x]['codice_riferimento']), $normalText);
    $foglio->writeString($riga, 4, $model->getSelectValue($model->datiEsportazione[$x]['id_utente'],'utenti'), $normalText);
    $foglio->writeString($riga, 5, $model->datiEsportazione[$x]['nome'], $normalText);
    $foglio->writeString($riga, 6, $model->datiEsportazione[$x]['cognome'], $normalText);
    $foglio->writeString($riga, 7, $model->getSelectValue($model->datiEsportazione[$x]['funzione'],'doc_funzione'), $normalText);
    $foglio->writeString($riga, 8, $model->getSelectValue($model->datiEsportazione[$x]['societa'],'doc_societa'), $normalText);
    $foglio->writeString($riga, 9, $model->getSelectValue($model->datiEsportazione[$x]['tipologia'],'doc_tipologia_apertura'), $normalText);
    $foglio->writeString($riga, 10, $model->getSelectValue($model->datiEsportazione[$x]['unita_operativa'],'doc_unita'), $normalText);
    $foglio->writeString($riga, 11, iconv('UTF-8', 'windows-1252',$model->datiEsportazione[$x]['trattamento']), $normalText);
    $foglio->writeString($riga, 12, $model->getDate($model->datiEsportazione[$x]['descrizione'],""), $normalText);
    $riga++;
    $k++;
}


$cartella->close();
?>