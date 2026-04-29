<?php
/* @var $this MatricoleController */
/* @var $model Matricole */

$this->breadcrumbs=array(
	'Matricoles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Matricole', 'url'=>array('index')),
	array('label'=>'Create Matricole', 'url'=>array('create')),
	array('label'=>'Update Matricole', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Matricole', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Matricole', 'url'=>array('admin')),
);
?>

<h1>View Matricole #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_struttura',
		'nome_contatore',
		'matricola',
	),
)); ?>
