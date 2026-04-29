<?php
/* @var $this DbNonconformeController */
/* @var $model DbNonconforme */

$this->breadcrumbs=array(
	'Azione non conforme'=>array('index'),
	$model->codice=>array('view','id'=>$model->id),
	'Modifica',
);

$this->menu=array(
	array('label'=>'Lista azioni non conformi', 'url'=>array('admin')),
	array('label'=>'Inserisci azione non conforme', 'url'=>array('create')),
	array('label'=>'Visualizza azione non conforme', 'url'=>array('view', 'id'=>$model->id),'itemOptions' => array('class' => 'last')),
	
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>