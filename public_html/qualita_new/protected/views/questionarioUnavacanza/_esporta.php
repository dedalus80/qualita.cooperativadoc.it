<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Questionari Una Vacanza Una Esperienza");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':I' . $x)->applyFromArray($style3);
}

$label = array('ID','Data Consegna','Nome','Cognome','Cellulare', 'Email',  'Turno','Attivita','Anno'
         );

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, $label[$x]);

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
   
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['data'] !='00-00-0000' ? $model->datiEsportazione[$x]['data']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['cellulare']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['turno_nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['attivita_nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['anno']);
    $row++;
    
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Questionari_unavacanzaunaesperienza.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));


?>
