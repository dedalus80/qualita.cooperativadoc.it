<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs=array(
	'Azioni correttive / preventive'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Modifica',
);

$this->menu=array(
	array('label'=>'Inserisci azione correttiva / preventiva', 'url'=>array('create')),
	array('label'=>'Visualizza azione correttiva / preventiva', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestisci azioni correttive / preventive', 'url'=>array('admin'),'itemOptions' => array('class' => 'last'))
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>