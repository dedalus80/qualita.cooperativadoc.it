<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Questionari sharing");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:AD1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':AD' . $x)->applyFromArray($style3);
}


$label = array('ID', 'Data restituzione', 'Nome', 'Cognome','Email','Cellulare','Arrivo','Partenza','Giorni permanenza','Tipo cliente','Conoscenza', 'La Vacanza', 'Struttura', 'Struttura Pulizia', 'Struttura Complessivo', 'Stanza Confort', 'Stanza Arredi', 'Stanza Pulizia',
    'Stanza Complessivo', 'Ristorante Servizio', 'Ristorante Attesa', 'Ristorante Cibo', 'Ristorante Menu', 'Ristorante Complessivo',
    'Personale Cortesia', 'Personale professionalita\'', 'Personale Complessivo','Attivita complessivo', 'Consiglia', 'Suggerimenti'
);

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, $label[$x]);

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['restituzione'] !='00-00-0000' ? $model->datiEsportazione[$x]['restituzione']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['cellulare']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['arrivo'] != '00-00-0000' ? $model->datiEsportazione[$x]['arrivo']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['partenza'] != '00-00-0000' ? $model->datiEsportazione[$x]['partenza']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['giorni_permanenza'] != '0' ? $model->datiEsportazione[$x]['giorni_permanenza']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['tipologia_cliente']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['conoscenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $model->datiEsportazione[$x]['nome_vacanza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['nome_struttura_nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['nome_struttura_pulizia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['nome_struttura_complessivo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['nome_stanza_confort']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['nome_stanza_arredi']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['nome_stanza_pulizia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['nome_stanza_complessivo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['nome_ristorante_servizio']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $model->datiEsportazione[$x]['nome_ristorante_attesa']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $model->datiEsportazione[$x]['nome_ristorante_cibo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $model->datiEsportazione[$x]['nome_ristorante_menu']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $model->datiEsportazione[$x]['nome_ristorante_complessivo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $model->datiEsportazione[$x]['nome_personale_cortesia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $model->datiEsportazione[$x]['nome_personale_professionalita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $model->datiEsportazione[$x]['nome_personale_complessivo']);
     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $model->datiEsportazione[$x]['nome_attivita_complessivo']);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $model->datiEsportazione[$x]['nome_consiglia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $model->datiEsportazione[$x]['suggerimenti']);

    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Questionari_sharing.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>