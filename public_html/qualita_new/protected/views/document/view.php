<?php
/* @var $this DocumentController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documenti'=>array('index', 'category_id'=>$model->category_id),
	$model->id,
);

/*$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'Update Documents', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Documents', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);*/
?>

<h1>Documento #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped'
	),
	'attributes'=>array(
		'id',
		array(
			'name'=>'category_id',
			'value'=>$model->category ? $model->category->name : ''
		),
		array(
			'name'=>'procedura_id',
			'value'=>$model->procedura ? $model->procedura->procedura : ''
		),
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
		'luogo_archiviazione',
		'formato',
		array(
			'name'=>'funzione_responsabile_id',
			'value'=>$model->funzioneResponsabile ? $model->funzioneResponsabile->nome : ''
		),
		'data_inserimento',
		'data_modifica',
		'creato_user_id',
		'modificato_user_id',
		'filename',
	),
)); ?>
