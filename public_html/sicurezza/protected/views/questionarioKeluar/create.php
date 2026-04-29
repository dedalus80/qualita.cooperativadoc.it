<?php
/* @var $this QuestionarioKeluarController */
/* @var $model QuestionarioKeluar */
 

$periodo = $_REQUEST['periodo'];
$data = explode("-",$periodo);



$this->breadcrumbs=array(
	'Questionario Keluar'=>array('index'),
	'Statistiche',
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




<h1>Statistiche Questionari <span class='red'>Keluar <?= $nomeStruttura ? "/ ".$nomeStruttura:""?></span> &nbsp;&nbsp;&nbsp;&nbsp; 
    <a href='http://qualita.cooperativadoc.it/qualita/index.php/questionarioKeluar/stampaStats/id/<?=$struttura?>/periodo/<?=$periodo?>'>Stampa PDF</a> </h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'struttura'=>$struttura,'nomeStruttura'=>$nomeStruttura)); ?>