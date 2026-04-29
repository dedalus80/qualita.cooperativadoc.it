<?php
/* @var $this DocumentiSoggiorniController */
/* @var $model DocumentiSoggiorni */

$this->breadcrumbs=array(
	'Documenti Qualitas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DocumentiSoggiorni', 'url'=>array('index')),
	array('label'=>'Create DocumentiSoggiorni', 'url'=>array('create')),
	array('label'=>'Update DocumentiSoggiorni', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentiSoggiorni', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentiSoggiorni', 'url'=>array('admin')),
);
?>

<h1>View DocumentiSoggiorni #<?php echo $model->id; ?></h1>

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
