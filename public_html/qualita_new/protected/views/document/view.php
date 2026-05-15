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
		'titolo',
		array(
			'name'=>'description',
			'type'=>'raw',
			'value'=>nl2br(CHtml::encode($model->description)),
		),
		array(
			'name'=>'publication_date',
			'value'=>$model->publication_date ? date('d-m-Y', strtotime($model->publication_date)) : '',
		),
		array(
			'name'=>'external_url',
			'type'=>'raw',
			'value'=>$model->external_url ? CHtml::link(CHtml::encode($model->external_url), $model->external_url, array('target'=>'_blank', 'rel'=>'noopener')) : '',
		),
		array(
			'name'=>'filename',
			'type'=>'raw',
			'value'=>$model->filename ? CHtml::link(CHtml::encode($model->filename), Yii::app()->createUrl('document/download', array('id'=>$model->id))) : '',
		),
	),
)); ?>
