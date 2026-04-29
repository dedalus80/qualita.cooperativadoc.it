<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Soggiorni Tim  Preiscrizione");

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
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);

$objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('Y1:AL1')->applyFromArray($style2);
$objPHPExcel->getActiveSheet()->getStyle('AM1:AR1')->applyFromArray($style1);

for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':AR' . $x)->applyFromArray($style3);
	else
		$objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':AR' . $x)->applyFromArray($style4);
}

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATI PARTECIPANTE');
$objPHPExcel->getActiveSheet()->mergeCells('A1:X1');

$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'DATI GENITORE');
$objPHPExcel->getActiveSheet()->mergeCells('Y1:AL1');

$objPHPExcel->getActiveSheet()->setCellValue('AM1', 'DATI SECONDO GENITORE');
$objPHPExcel->getActiveSheet()->mergeCells('AM1:AR1');

$row = 2;
$cols = 0;

$label = array(
    'ID','Data iscrizione','Ora iscrizione', 'Nome', 'Cognome', 'Codice Fiscale','Data Nascita', 'Luogo Nascita', 'Provincia Nascita', 'Nazione', 'Indirizzo', 'Citta', 'Provincia',
    'Cap', 'Telefono','Iscrizione', 'Soggiorno','Codice turno','Inizio turno','Fine turno', 'Partenza','Operatore supporto','Allergie', 'Problema sanitario','Nome','Cognome','Codice Fiscale','Societa','Funzione','Sede',
    'CID', 'Localita', 'Provincia', 'Cap', 'Telefono', 'Cellulare', 'Email','Reddito','Nome','Cognome','Codice Fiscale', 'Nato il ', 'Nato a ','Provincia'
);



for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, iconv('UTF-8', 'windows-1252',$label[$x]));

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {
    
    $ID = $x +1 ;
    
     $model->datiEsportazione[$x]['operatore_supporto'] =='Y' ? $operatore = "Si: ".$model->datiEsportazione[$x]['operatore_supporto_dettaglio'] : $operatore = "No";
     $model->datiEsportazione[$x]['allergie'] =='Y' ? $allergie = "Si: ".$model->datiEsportazione[$x]['allergie_dettaglio'] : $allergie = "No";
     $model->datiEsportazione[$x]['problema_sanitario'] =='Y' ? $sanitario = "Si: ".$model->datiEsportazione[$x]['problema_sanitario_dettaglio'] : $problema = "No";
    

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $ID);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['data_insert']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['ora_insert']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['codice_fiscale']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['nascita']  );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['nascita_luogo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['nome_provincia_nascita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['nome_nazione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['indirizzo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $model->datiEsportazione[$x]['citta']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['nome_provincia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['cap']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['telefono']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['nome_iscrizione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['nome_soggiorno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['codice_turno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['inizio_turno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['fine_turno']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $model->datiEsportazione[$x]['nome_partenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $operatore);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $allergie);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $sanitario);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $model->datiEsportazione[$x]['genitore_nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $model->datiEsportazione[$x]['genitore_cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $model->datiEsportazione[$x]['genitore_codice_fiscale']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $model->datiEsportazione[$x]['nome_societa']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $model->datiEsportazione[$x]['nome_funzione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $model->datiEsportazione[$x]['nome_sede']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $model->datiEsportazione[$x]['cid']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $model->datiEsportazione[$x]['localita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $model->datiEsportazione[$x]['nome_provincia_g']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $model->datiEsportazione[$x]['genitore_cap']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(34, $row, $model->datiEsportazione[$x]['genitore_telefono']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(35, $row, $model->datiEsportazione[$x]['genitore_cellulare']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(36, $row, $model->datiEsportazione[$x]['genitore_email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(37, $row, $model->datiEsportazione[$x]['nome_fascia']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(38, $row, $model->datiEsportazione[$x]['secondo_genitore_nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(39, $row, $model->datiEsportazione[$x]['secondo_genitore_cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(40, $row, $model->datiEsportazione[$x]['secondo_genitore_codice_fiscale']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(41, $row, $model->datiEsportazione[$x]['nascita_sg']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(42, $row, $model->datiEsportazione[$x]['secondo_genitore_nascita_luogo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(43, $row, $model->datiEsportazione[$x]['nome_provincia_sg']);
    
    
    $row++;
}



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Preiscrizioni_Soggiorni_tim.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>

