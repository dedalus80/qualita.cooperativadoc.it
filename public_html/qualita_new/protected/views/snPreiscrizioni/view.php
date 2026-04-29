<?php
/* @var $this SnPreiscrizioniController */
/* @var $model SnPreiscrizioni */

$this->breadcrumbs=array(
	'Sn Preiscrizionis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SnPreiscrizioni', 'url'=>array('index')),
	array('label'=>'Create SnPreiscrizioni', 'url'=>array('create')),
	array('label'=>'Update SnPreiscrizioni', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SnPreiscrizioni', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SnPreiscrizioni', 'url'=>array('admin')),
);
?>

<h1>View SnPreiscrizioni #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'cognome',
		'ruolo',
		'altro_ruolo',
		'ente',
		'focus',
		'percorso',
		'data_insert',
	),
)); ?>
