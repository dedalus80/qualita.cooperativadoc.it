<?php
/* @var $this LettureController */
/* @var $model Letture */

$this->breadcrumbs=array(
	'Lettures'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Letture', 'url'=>array('index')),
	array('label'=>'Create Letture', 'url'=>array('create')),
	array('label'=>'Update Letture', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Letture', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Letture', 'url'=>array('admin')),
);
?>

<h1>View Letture #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_matricola',
		'data_lettira',
		'incremento',
		'diffrenza',
	),
)); ?>
