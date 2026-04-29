<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("CLettura consumi");
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


$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($style1);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:C1');
$objPHPExcel->getActiveSheet()->setTitle("Lettura consumi");
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);


$row = 1;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, "LETTURE  " . strtoupper($model->datiEsportazione['matricola']['tipo']) . " " . $model->datiEsportazione['matricola']['struttura'] . " " . $model->datiEsportazione['matricola']['matricola']);

for ($x = 3; $x <= count($model->datiEsportazione['letture']) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':C' . $x)->applyFromArray($style3);
    else
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':C' . $x)->applyFromArray($style4);

    $objPHPExcel->getActiveSheet()->getRowDimension($x)->setRowHeight(20);
}

$label = array(
    0 => 'Data', 1 => 'Lettura', 2 => 'Differenze'
);

$row++;

foreach ($label AS $id => $val)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($id, $row, iconv('windows-1251', 'utf-8', $val));

$row++;

for ($x = 0; $x < count($model->datiEsportazione['letture']); $x++) {
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione['letture'][$x]['data']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione['letture'][$x]['incremento']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione['letture'][$x]['differenza']);
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Lettura_Consumi_' . strtoupper($model->datiEsportazione['matricola']['tipo']) . " " . $model->datiEsportazione['matricola']['stuttura'] . " " . $model->datiEsportazione['matricola']['matricola'] . '.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>