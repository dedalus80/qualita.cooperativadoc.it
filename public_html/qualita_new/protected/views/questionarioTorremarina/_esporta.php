<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Questionari Doc");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':V' . $x)->applyFromArray($style3);
}

$label = array('ID','Data Consegna','Nome', 'Cognome','La Vacanza', 'Struttura',  'Struttura Pulizia','Struttura Complessivo','Stanza Confort', 'Stanza Arredi', 'Stanza Pulizia',
 'Stanza Complessivo', 'Ristorante Servizio',  'Ristorante Attesa', 'Ristorante Cibo','Ristorante Menu',  'Ristorante Complessivo',
 'Personale Cortesia', 'Personale professionalit�', 'Personale Complessivo',  'Consiglia','Suggerimenti'
         );

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, $label[$x]);

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
   
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 0, $row,  $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 1, $row,  $model->getItaDate($model->datiEsportazione[$x]['data_consegna']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 2, $row,  $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 3, $row,  $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 4, $row,  $model->getSelectValue($model->datiEsportazione[$x]['vacanza'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 5, $row,  $model->getSelectValue($model->datiEsportazione[$x]['struttura_nome'],'doc_unita'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 6, $row,  $model->getSelectValue($model->datiEsportazione[$x]['struttura_pulizia'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 7, $row,  $model->getSelectValue($model->datiEsportazione[$x]['struttura_complessivo'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 8, $row,  $model->getSelectValue($model->datiEsportazione[$x]['stanza_confort'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 9, $row,  $model->getSelectValue($model->datiEsportazione[$x]['stanza_arredi'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 10, $row, $model->getSelectValue($model->datiEsportazione[$x]['stanza_pulizia'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 11, $row, $model->getSelectValue($model->datiEsportazione[$x]['stanza_complessivo'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 12, $row, $model->getSelectValue($model->datiEsportazione[$x]['ristorante_servizio'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 13, $row, $model->getSelectValue($model->datiEsportazione[$x]['ristorante_attesa'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 14, $row, $model->getSelectValue($model->datiEsportazione[$x]['ristorante_cibo'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 15, $row, $model->getSelectValue($model->datiEsportazione[$x]['ristorante_menu'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 16, $row, $model->getSelectValue($model->datiEsportazione[$x]['ristorante_complessivo'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 17, $row, $model->getSelectValue($model->datiEsportazione[$x]['personale_cortesia'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 18, $row, $model->getSelectValue($model->datiEsportazione[$x]['personale_professionalita'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 19, $row, $model->getSelectValue($model->datiEsportazione[$x]['personale_complessivo'],'doc_giudizzi'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 20, $row, $model->getSelectValue($model->datiEsportazione[$x]['consiglia'],'doc_consiglia'));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow( 21, $row, $model->datiEsportazione[$x]['suggerimenti']);
    $row++;
    
}


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Questionari_doc.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));


?>
