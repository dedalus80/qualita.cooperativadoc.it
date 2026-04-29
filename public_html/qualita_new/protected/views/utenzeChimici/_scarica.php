<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');
$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Consumi Sostanze Chimiche");

$style1 = array(
    'font' => array(
        'bold' => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size' => 12,
        'name' => 'Verdana'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => '5bb4e5',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFF',
        ),
    ),
);

$style2 = array(
    'font' => array(
        'bold' => false,
        'size' => 11,
        'name' => 'Verdana'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'dadfe3')
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'e0e4e7',
        ),
        'endcolor' => array(
            'argb' => 'ffffff',
        ),
    ),
);
$style3 = array(
    'font' => array(
        'bold' => false,
        'size' => 10,
        'name' => 'Verdana'
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'fafbfc',
        ),
    ),
);
$style4 = array(
    'font' => array(
        'bold' => false,
        'size' => 10,
        'name' => 'Verdana'
    ),
);

$row = 1;

$colonne = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N");

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('A2:N2')->applyFromArray($style2);
$objPHPExcel->getActiveSheet()->getStyle('A4:N4')->applyFromArray($style3);
$objPHPExcel->getActiveSheet()->getStyle('A5:N5')->applyFromArray($style4);
$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->applyFromArray($style3);
$objPHPExcel->getActiveSheet()->getStyle('A7:N7')->applyFromArray($style4);
$objPHPExcel->getActiveSheet()->getStyle('A7:N7')->getNumberFormat()->setFormatCode('#,####0.0000');
$objPHPExcel->getActiveSheet()->getStyle('A6:N6')->getNumberFormat()->setFormatCode('#,####0.0000');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:N1');
$objPHPExcel->getActiveSheet()->setTitle("Consumi Acqua ");
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);

foreach ($colonne as $col)
    $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);

$mesi = array(
    1 => 'gennaio', 2 => 'febbraio', 3 => 'marzo', 4 => 'aprile', 5 => 'maggio', 6 => 'giugno', 7 => 'luglio', 8 => 'agosto',
    9 => 'settembre', 10 => 'ottobre', 11 => 'novembre', 12 => 'dicembre', 13 => 'totale'
);
$label = array(
    1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto',
    9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre', 13 => 'Totale'
);

$row = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "CONSUMI ACQUA " . strtoupper($model->struttura_nome) . " " . $model->anno);
$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "");
foreach ($label AS $id => $val)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, iconv('windows-1251', 'utf-8', $val));

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "Litri");
foreach ($mesi as $id => $val) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->$val > 0 ? $model->$val : "");
}

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "Euro");
foreach ($mesi as $id => $val) {
    $x = "c_" . $val;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->$x > 0 ? $model->$x : "" );
}

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "Ospiti");
foreach ($mesi as $id => $val) {
    $x = "c_" . $mese;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->utenze[$val] > 0 ? $model->utenze[$val] : "" );
}

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "Euro / Ospite");
foreach ($mesi as $id => $val) {
    $x = "c_" . $mese;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->utenze[$val . "_media_costi"] > 0 ? number_format($model->utenze[$val . '_media_costi'], 4, '.', '') : "" );
}

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "Litri / Ospite");
foreach ($mesi as $id => $val) {
    $x = "c_" . $mese;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->utenze[$val . "_media_consumi"] > 0 ? number_format($model->utenze[$val . '_media_consumi'], 4, '.', '') : "" );
}


$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row,"Euro / Mq" );
foreach($mesi as $id => $val){
     $x = "c_".$mese;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->utenze[$val."_media_superficie"] > 0  ?    number_format($model->utenze[$val.'_media_superficie'] , 4, '.', ''): "" );
}

$row++;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row,"Litri / Mq" );
foreach($mesi as $id => $val){
     $x = "c_".$mese;
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, $model->utenze[$val."_media_superficie_unita"] > 0  ?    number_format($model->utenze[$val.'_media_superficie_unita'] , 4, '.', ''): "" );
}



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Consumi_Sostanze_chimiche_' . str_replace(" ", "_", $model->struttura_nome) . '_' . $model->anno . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>