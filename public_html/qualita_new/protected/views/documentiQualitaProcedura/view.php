<?php
/* @var $this DocumentiQualitaProceduraController */
/* @var $model DocumentiQualitaProcedura */

$this->breadcrumbs=array(
	'Documenti Qualita Proceduras'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentiQualitaProcedura', 'url'=>array('index')),
	array('label'=>'Create DocumentiQualitaProcedura', 'url'=>array('create')),
	array('label'=>'Update DocumentiQualitaProcedura', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentiQualitaProcedura', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentiQualitaProcedura', 'url'=>array('admin')),
);
?>

<h1>View DocumentiQualitaProcedura #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'procedura',
	),
)); ?>
