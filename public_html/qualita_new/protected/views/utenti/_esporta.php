<?php
$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
spl_autoload_unregister(array('YiiBase', 'autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel('UTF-8');

$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Utenti Gestionale Qualita");

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
$objPHPExcel->getActiveSheet()->getStyle('A1:T1')->applyFromArray($style1);
for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
    if ($x % 2 == 0)
        $objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':T' . $x)->applyFromArray($style3);
}

$label = array(
    'ID', 'Utente', 'Nome', 'Cognome', 'Email', 'Password', 'Tipo Utente', 'Struttura',
    'Preiscrizione Scuola Natura', 'Preiscrizione Stessopiano', 'Preiscrizione CampusSanPaolo', 'Preiscrizione Sharing',
    'Questionario Keluar','Questionario Doc','Questionario Formazione','Questionario Sharing','Questionario Junior',
    'Questionario Senior','Questionario Scientifici','Questionario Studio'
);

$row = 1;

for ($x = 0; $x < count($label); $x++)
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, iconv('UTF-8', 'windows-1252', $label[$x]));

$row++;

for ($x = 0; $x < count($model->datiEsportazione); $x++) {


    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $model->datiEsportazione[$x]['id']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $model->datiEsportazione[$x]['user']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $model->datiEsportazione[$x]['nome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $model->datiEsportazione[$x]['cognome']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $model->datiEsportazione[$x]['email']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $model->datiEsportazione[$x]['password']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $model->datiEsportazione[$x]['tipo']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $model->datiEsportazione[$x]['struttura']);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $model->datiEsportazione[$x]['preiscrizione_sn'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $model->datiEsportazione[$x]['preiscrizione_sp'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $model->datiEsportazione[$x]['preiscrizione_cs'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $model->datiEsportazione[$x]['preiscrizione_sh'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $model->datiEsportazione[$x]['q_kelaur'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, $model->datiEsportazione[$x]['q_doc'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $model->datiEsportazione[$x]['q_formazione'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $model->datiEsportazione[$x]['q_sharing'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $model->datiEsportazione[$x]['q_junior'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $model->datiEsportazione[$x]['q_senior'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $model->datiEsportazione[$x]['q_scientifici'] == 'Y' ? "SI" : "NO");
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $model->datiEsportazione[$x]['q_studio'] == 'Y' ? "SI" : "NO");
    
    $row++;
    
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="utenti_gestionale_qualita.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->save('php://output');
spl_autoload_register(array('YiiBase', 'autoload'));
?>
