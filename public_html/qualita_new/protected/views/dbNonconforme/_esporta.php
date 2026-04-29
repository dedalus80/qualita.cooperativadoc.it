<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Azioni Non Conformi");

$style1 = array(
    'font' => array(
        'bold' => true,
        'size' => 10,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'e0e4e7',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
);

$style2 = array(
    'font' => array(
        'bold' => true,
        'size' => 10,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => '95a5a6',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
);
$style3 = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'fafbfc',
        ),
    ),
);
$style4 = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'f4f5f6',
        ),
    ),
    'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
);

$row = 1;


$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':O' . $x)->applyFromArray($style3);
}

$label = array(
    'Data non conforme', 'ID', 'Codice', 'Inserito da', 'Nome', 'Cognome', 'Funzione', 'Società', 'Tipologia',
    'Unità Operativa', 'Responsabile', 'Trattamento', 'Descrizione', 'Stato Chiusura', 'Anno'
);

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, iconv('windows-1251', 'utf-8', $label[$x]));

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['data_nc']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['codice']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['nome_utente']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, utf8_decode($model->datiEsportazione[$x]['nome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, utf8_decode($model->datiEsportazione[$x]['cognome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['nome_funzione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['nome_societa']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['nome_tipologia_apertura']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['nome_unita_operativa']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['nome_responsabile']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, utf8_decode($model->datiEsportazione[$x]['trattamento']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, utf8_decode($model->datiEsportazione[$x]['descrizione']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['nome_chiusura']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['anno']);
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Azioni_non_conformi.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>