<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Consumi sostanze chimiche");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:AE1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('A2:AE2')->applyFromArray($style2);
for ($x = 3; $x < count($model->datiEsportazione) + 2; $x++) {
     if ($x % 2 == 0)
    $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':AE' . $x)->applyFromArray($style3);
}

$label = array(
    0 => 'Anno', 1 => 'Unità', 2 => 'Gennaio', 4 => 'Febbraio', 6 => 'Marzo', 8 => 'Aprile', 10 => 'Maggio', 12 => 'Giugno', 14 => 'Luglio',
    16 => 'Agosto', 18 => 'Settembre', 20 => 'Ottobre', 22 => 'Novembre', 24 => 'Dicembre', 26 => 'Totale', 28 => 'Presenze', 30 => 'Media'
);

$row = 1;

foreach ($label AS $id => $val)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, iconv('windows-1251', 'utf-8', $val));

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:D1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E1:F1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G1:H1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I1:J1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K1:L1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M1:N1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:P1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q1:R1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S1:T1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('U1:V1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('W1:X1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Y1:Z1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AA1:AB1');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AD1:AE1');
$row++;

for ($x = 2; $x <= 27; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, "MC");
    else
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, "Euro");
}


$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow("28", $row, "Totale");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow("29", $row, "MC");
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow("30", $row, "Euro");
$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['anno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['nome_unita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['gennaio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['c_gennaio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['febbraio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['c_febbraio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, utf8_decode($model->datiEsportazione[$x]['marzo']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, utf8_decode($model->datiEsportazione[$x]['c_marzo']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, utf8_decode($model->datiEsportazione[$x]['aprile']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, utf8_decode($model->datiEsportazione[$x]['c_aprile']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['maggio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $model->datiEsportazione[$x]['c_maggio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['giugno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['c_giugno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['luglio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['c_luglio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['agosto']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['c_agosto']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['settembre']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['c_settembre']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, utf8_decode($model->datiEsportazione[$x]['ottobre']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, utf8_decode($model->datiEsportazione[$x]['c_ottobre']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, utf8_decode($model->datiEsportazione[$x]['novembre']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, utf8_decode($model->datiEsportazione[$x]['c_novembre']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $model->datiEsportazione[$x]['dicembre']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $model->datiEsportazione[$x]['c_dicembre']);

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $model->datiEsportazione[$x]['totale'] > 0 ? number_format($model->datiEsportazione[$x]['totale'], 2, ",", ".") : "0" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $model->datiEsportazione[$x]['c_totale'] > 0 ? number_format($model->datiEsportazione[$x]['c_totale'], 2, ",", ".") : "0" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $model->datiEsportazione[$x]['presenze'] > 0 ? $model->datiEsportazione[$x]['presenze'] : "" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $model->datiEsportazione[$x]['media'] > 0 ? number_format($model->datiEsportazione[$x]['media'], 4, ",", ".") : "" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $model->datiEsportazione[$x]['c_media'] > 0 ? number_format($model->datiEsportazione[$x]['c_media'], 4, ",", ".") : "0" );
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Consumi_sostanze_chimiche.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>