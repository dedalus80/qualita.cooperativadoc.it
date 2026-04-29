<?php
/* @var $this ReclamiAzioniController */
/* @var $model ReclamiAzioni */

$this->breadcrumbs=array(
	'Reclami Azionis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ReclamiAzioni', 'url'=>array('index')),
	array('label'=>'Create ReclamiAzioni', 'url'=>array('create')),
	array('label'=>'Update ReclamiAzioni', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ReclamiAzioni', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReclamiAzioni', 'url'=>array('admin')),
);
?>

<h1>View ReclamiAzioni #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_reclamo',
		'nome',
		'cognome',
		'entro_il',
		'effettuata_il',
		'descrizione',
		'allegato',
	),
)); ?>
