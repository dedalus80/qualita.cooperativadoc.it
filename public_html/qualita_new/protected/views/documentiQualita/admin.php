<?php
/* @var $this DocumentiQualitaController */
/* @var $model DocumentiQualita */

$this->breadcrumbs=array(
	'Documenti Qualitas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DocumentiQualita', 'url'=>array('index')),
	array('label'=>'Create DocumentiQualita', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documenti-qualita-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Documenti Qualitas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documenti-qualita-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'sgq',
		'tipologia',
		'codice',
		'numero',
		'revisione',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
