<?php
/* @var $this DocumentProcedureController */
/* @var $model DocumentsProcedures */

$this->breadcrumbs=array(
	'Procedure Documenti'=>array('admin'),
	$model->id,
);

/*$this->menu=array(
	array('label'=>'List DocumentsProcedures', 'url'=>array('index')),
	array('label'=>'Create DocumentsProcedures', 'url'=>array('create')),
	array('label'=>'Update DocumentsProcedures', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentsProcedures', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentsProcedures', 'url'=>array('admin')),
);*/
?>

<h1>Procedura Documento #<?php echo $model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/admin');?>">Elenco Procedure Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/create');?>">Crea Procedura Documento</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/update/'.$model->id);?>">Modifica Procedura Documento</a>
</div>

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
		'procedura',
	),
)); ?>
