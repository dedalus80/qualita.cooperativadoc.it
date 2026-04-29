<?php
/* @var $this QuestionarioSharingController */
/* @var $model QuestionarioSharing */

$periodo = $_REQUEST['periodo'];
$data = explode("-",$periodo);

$this->breadcrumbs=array(
	'Questionario Sharing'=>array('index'),
	'statistiche',
);


$this->menu = array(
    array('label' => 'Questionari Doc', 'url' => array('./questionarioDoc/admin')),
    array('label' => 'Questionari Keluar', 'url' => array('./questionarioKeluar/admin')),
    array('label' => 'Questionari Sharing', 'url' => array('./questionarioSharing/admin')),
    array('label' => 'Statistiche Questionari Doc', 'url' => array('./questionarioDoc/create')),
    array('label' => 'Statistiche Keluar', 'url' => array('./questionarioKeluar/create')),
    array('label' => 'Statistiche Sharing', 'url' => array('./questionarioSharing/create'), 'itemOptions' => array('class' => 'last')),
);
?>

<h1>Statistiche Questionari <span class='red'>Sharing </span>&nbsp;&nbsp;&nbsp;&nbsp; <a href='http://qualita.cooperativadoc.it/qualita/index.php/questionarioSharing/stampaStats/periodo/<?=$periodo?>'>Stampa PDF</a> </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>