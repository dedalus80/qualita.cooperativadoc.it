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
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);

$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('K1:Q1')->applyFromArray($style2);
$objPHPExcel->getActiveSheet()->getStyle('R1:T1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('U1:V1')->applyFromArray($style2);


$objPHPExcel->getActiveSheet()->getStyle('A2:V2')->applyFromArray($style4);



for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':V' . $x)->applyFromArray($style3);
}

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATI PARTECIPANTE');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'QUESITI PARTECIPANTE');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'QUESITI VACANZA STUDIO');
$objPHPExcel->getActiveSheet()->setCellValue('U1', 'SUGGERIMENTI');

$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
$objPHPExcel->getActiveSheet()->mergeCells('K1:Q1');
$objPHPExcel->getActiveSheet()->mergeCells('R1:T1');
$objPHPExcel->getActiveSheet()->mergeCells('U1:V1');

$label = array('ID', 'Data restituzione', 'Nome', 'Cognome','Soggiono','Turno','Organizzazione','Nome gruppo','Nome coordinatore','Cognome coordinatore',
   'Divertimento','Educatori','Compagni', 'Giochi', 'Attivita Aportive','Gite','Laboratori','Organizzazione corsi campus' ,  'Didattica corsi campus','Utilita formativa','Suggerimenti','Osservazioni'
);

$row = 2;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, $label[$x]);

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['restituzione'] !='00-00-0000' ? $model->datiEsportazione[$x]['restituzione']:"" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['struttura']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['turno']." Turno"  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['organizza']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['nome_gruppo']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['nome_coordinatore']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['cognome_coordinatore']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['divertimento'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['educatori'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['compagni'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['giochi'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['attivita_sportive'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['gite'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['laboratori'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['scientifici_organizzazione'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['scientifici_didattica'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, Yii::app()->MyUtils->getGiudizio($model->datiEsportazione[$x]['scientifici_formazione'],3)  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, html_entity_decode($model->datiEsportazione[$x]['suggerimenti'] ));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, html_entity_decode($model->datiEsportazione[$x]['osservazioni'] ));
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Questionari_campus_formativi.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>
