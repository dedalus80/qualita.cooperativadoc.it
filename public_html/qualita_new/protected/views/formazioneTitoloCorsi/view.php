<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

$this->breadcrumbs=array(
	'Formazione Titolo Corsis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FormazioneTitoloCorsi', 'url'=>array('index')),
	array('label'=>'Create FormazioneTitoloCorsi', 'url'=>array('create')),
	array('label'=>'Update FormazioneTitoloCorsi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FormazioneTitoloCorsi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FormazioneTitoloCorsi', 'url'=>array('admin')),
);
?>

<h1>View FormazioneTitoloCorsi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'titaolo_corso',
		'insert_date',
	),
)); ?>
