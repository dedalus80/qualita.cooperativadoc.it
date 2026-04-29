<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Cascina Fossata Preiscrizione");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':W' . $x)->applyFromArray($style3);
}

$label = array(
    'Refer','Data', 'ID', 'Dal', 'Al', 'Formula','Stanza', 'Nome', 'Cognome', 'Cellulare', 'Email', 'Sesso', 'Data Nascita', 'Luogo Nascita', 'Nazionalita',
    'Occupazione', 'Prima Volta In Campus San Paolo', 'Conosciuti tramite ', 'Coabitazione con', 'Consenso', 'Mailing List', 'Note' , 'Anno'
);

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, iconv('UTF-8', 'windows-1252',$label[$x]));

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['refer'] =='S' ? "Cascina Fossata":"Politecnico");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['inserimento']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['arrivo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['partenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['nome_formula']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['formula'] == '1' ? $model->datiEsportazione[$x]['nome_campus'] : $model->datiEsportazione[$x]['nome_housing'] );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, utf8_decode($model->datiEsportazione[$x]['nome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, utf8_decode($model->datiEsportazione[$x]['cognome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['cellulare']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $model->datiEsportazione[$x]['sesso'] == 'M' ? "Maschio" : "Femmina");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['nascita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['luogo_nascita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['nome_nazionalita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['nome_occupazione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['prima_volta'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['nome_conoscenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['coabitazione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['privacy'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $model->datiEsportazione[$x]['mailing'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, utf8_decode($model->datiEsportazione[$x]['note']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, utf8_decode($model->datiEsportazione[$x]['anno']));
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Preiscrizioni_CascinaFossata.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>

