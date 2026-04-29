<?php

$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Sharing Stesso Piano");

$row = 1;
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

$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('O1:S1')->applyFromArray($style2);
$objPHPExcel->getActiveSheet()->getStyle('T1:AQ1')->applyFromArray($style1);
$objPHPExcel->getActiveSheet()->getStyle('AR1:AV1')->applyFromArray($style2);


for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':AV' . $x)->applyFromArray($style3);
}

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATI PARTECIPANTE');
$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');

$objPHPExcel->getActiveSheet()->setCellValue('O1', 'DOCUMENTI');
$objPHPExcel->getActiveSheet()->mergeCells('O1:S1');

$objPHPExcel->getActiveSheet()->setCellValue('T1', 'DETTAGLI RICERCA '); 
$objPHPExcel->getActiveSheet()->mergeCells('T1:AQ1');

$objPHPExcel->getActiveSheet()->setCellValue('AR1', 'ALTRE INFORMAZIONI');
$objPHPExcel->getActiveSheet()->mergeCells('AR1:AV1');

$row = 2;
$cols = 0;

$label = array(
    'Data', 'ID',  'Nome', 'Cognome', 'Cellulare', 'Email', 'Sesso', 'Data Nascita', 'Luogo Nascita', 'Nazionalita',
    'Residenza', 'Indirizzo', 'Cap', 'Provincia', 'Codice Fiscale', 'Documento', 'Numero Documento', 'Scadenza Documento', 'Permesso Soggiorno',
    'Occupazione', 'Alloggio attuale','Arrivo', 'Partenza', 'Tipo Camera', 'Con Amici', 'Numero Coinquilini', 'Coinquilini Genere', 'Coinquilini eta', 'Coinquilini Occupazione', 'Coinquilini Fumatori', 'Coinquilini Animali', 'Prima Volta con Stessopiano?', 'Conosciuti tramite ', 'Cambio Residenza', 'Camera', 'Appartamento',
    'Spesa Massima', 'Coinquilini', 'Quartieri', 'Fumatore', 'Animali', 'Coabitazione con', 'Giorni visita', 'Consenso', 'Mailing List', 'Altro interesse', 'Note', 'Anno'
);

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, iconv('windows-1251', 'utf-8', $label[$x]));

$row++;

$responsLabel = array("Y" => "Si", "N"=>'No', "I"=>"Indiferente","S"=>"Studente","L"=>"lavoratore","E"=> "Studente / Lavoratore","M"=>"Maschi","F"=>"Femmine","U"=>"Stessa Eta");
$alloggi = array("1"=>"Casa dei genitori" ,  "2" =>"In affitto da solo" , "3" =>"In affitto con altri" , "4" =>"Ospite da amici o parenti" , "5" =>"Collegio universitario/pensione" , "6" =>"Albergo" );

for ($x = 0; $x < count($model->datiEsportazione); $x++) {

    if ($model->datiEsportazione[$x]['camera_singola'] == 'Y')
        $camera = "Camera Singola";
    else if ($model->datiEsportazione[$x]['camera_doppia'] == 'Y')
        $camera = "Camera Doppia";
    else if ($model->datiEsportazione[$x]['camera_indiferente'] == 'Y')
        $camera = "Indiferente";

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['inserimento']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['id']);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, utf8_decode($model->datiEsportazione[$x]['nome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, utf8_decode($model->datiEsportazione[$x]['cognome']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['cellulare']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['sesso'] == 'M' ? "Maschio" : "Femmina");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['nascita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['luogo_nascita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['nome_nazione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, utf8_decode($model->datiEsportazione[$x]['residenza']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, utf8_decode($model->datiEsportazione[$x]['indirizzo']) . " " . $model->datiEsportazione[$x]['numero_civico']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['cap']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['nome_provincia']);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['codice_fiscale']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['tipo_documento']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['numero_documento']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['scadenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['permesso_soggiorno']);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['nome_occupazione'] . " " . utf8_decode($model->datiEsportazione[$x]['occupazione_det']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $model->datiEsportazione[$x]['dove_vive']  ==  7 ? $model->datiEsportazione[$x]['dove_vive_altro']:$alloggi[$model->datiEsportazione[$x]['dove_vive']]);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $model->datiEsportazione[$x]['arrivo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $model->datiEsportazione[$x]['partenza']);
    
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $camera);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $model->datiEsportazione[$x]['camera_amici'] =='Y' ? " Si con ".$model->datiEsportazione[$x]['camera_amici_quanti']." amici :" . $model->datiEsportazione[$x]['camera_amici_dettaglio']:"No");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $model->datiEsportazione[$x]['amici_quanti ']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $responsLabel[$model->datiEsportazione[$x]['amici_genere']]);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $responsLabel[$model->datiEsportazione[$x]['amici_eta']]);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $responsLabel[$model->datiEsportazione[$x]['amici_occupazione']]);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $responsLabel[$model->datiEsportazione[$x]['amici_fumo']]);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $model->datiEsportazione[$x]['amici_animali'] =='Y' ?  "Si " . $model->datiEsportazione[$x]['amici_animali_dettaglio']:"No");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $model->datiEsportazione[$x]['prima_volta'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $model->datiEsportazione[$x]['nome_conoscenza']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $model->datiEsportazione[$x]['nuova_residenza'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(34, $row, $model->datiEsportazione[$x]['camera'] == 'Y' ? $model->datiEsportazione[$x]['nome_camera'] : "No" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(35, $row, $model->datiEsportazione[$x]['appartamento'] == 'Y' ? $model->datiEsportazione[$x]['nome_appartamento'] : "No" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(36, $row, $model->datiEsportazione[$x]['nome_livello'] . " " . $model->datiEsportazione[$x]['livello_altro']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(37, $row, $model->datiEsportazione[$x]['conquilini'] == 'Y' ? "Si " . $model->datiEsportazione[$x]['conquilini_n'] : "No" );
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(38, $row, $model->datiEsportazione[$x]['nome_quartieri']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(39, $row, $model->datiEsportazione[$x]['fumatore'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(40, $row, $model->datiEsportazione[$x]['animali'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(41, $row, $model->datiEsportazione[$x]['coabitazione']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(42, $row, $model->datiEsportazione[$x]['giorni_visita']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(43, $row, $model->datiEsportazione[$x]['privacy'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(44, $row, $model->datiEsportazione[$x]['mailing'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(45, $row, utf8_decode($model->datiEsportazione[$x]['interessato']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(46, $row, utf8_decode($model->datiEsportazione[$x]['note']));
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(47, $row, utf8_decode($model->datiEsportazione[$x]['anno']));
    $row++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Preiscrizioni_Stesso_Piano.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>