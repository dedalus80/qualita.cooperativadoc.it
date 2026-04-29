<?php
/* @var $this TipologieFormazioneController */
/* @var $model TipologieFormazione */

$this->breadcrumbs=array(
	'Tipologie Formaziones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipologieFormazione', 'url'=>array('index')),
	array('label'=>'Create TipologieFormazione', 'url'=>array('create')),
	array('label'=>'Update TipologieFormazione', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipologieFormazione', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipologieFormazione', 'url'=>array('admin')),
);
?>

<h1>View TipologieFormazione #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'attivo',
	),
)); ?>
