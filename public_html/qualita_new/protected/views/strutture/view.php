<?php
/* @var $this StruttureController */
/* @var $model Strutture */

$this->breadcrumbs=array(
	'Struttures'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Strutture', 'url'=>array('index')),
	array('label'=>'Create Strutture', 'url'=>array('create')),
	array('label'=>'Update Strutture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Strutture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Strutture', 'url'=>array('admin')),
);
?>

<h1>View Strutture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'codice',
		'tipologia',
	),
)); ?>
