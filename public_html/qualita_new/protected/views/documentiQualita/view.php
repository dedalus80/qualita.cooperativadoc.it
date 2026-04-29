<?php
/* @var $this DocumentiQualitaController */
/* @var $model DocumentiQualita */

$this->breadcrumbs=array(
	'Documenti Qualitas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentiQualita', 'url'=>array('index')),
	array('label'=>'Create DocumentiQualita', 'url'=>array('create')),
	array('label'=>'Update DocumentiQualita', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentiQualita', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentiQualita', 'url'=>array('admin')),
);
?>

<h1>View DocumentiQualita #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sgq',
		'tipologia',
		'codice',
		'numero',
		'revisione',
		'data_revisione',
		'titolo',
		'redige',
		'archivia',
		'riesamina',
		'autorizza',
		'approva',
		'periodicita_riesame',
		'modalita_archiviazione',
		'tempo_archiviazione',
		'luogo_archiviazione',
		'formato',
		'funzione_responsabile_id',
		'data_inserimento',
		'data_modifica',
		'creato_user_id',
		'modificato_user_id',
		'filename',
	),
)); ?>
