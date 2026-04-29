<?php
/* @var $this DocumentCategoryController */
/* @var $model DocumentsCategory */

$this->breadcrumbs=array(
	'Categorie Documenti'=>array('admin'),
	$model->id,
);

/*$this->menu=array(
	array('label'=>'List DocumentsCategory', 'url'=>array('index')),
	array('label'=>'Create DocumentsCategory', 'url'=>array('create')),
	array('label'=>'Update DocumentsCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DocumentsCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentsCategory', 'url'=>array('admin')),
);*/
?>

<h1>Categoria Documento #<?php echo $model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/admin');?>">Elenco Categorie Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/create');?>">Crea Categoria Documento</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/update/'.$model->id);?>">Modifica Categoria Documento</a>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped'
	),
	'attributes'=>array(
		'id',
		'name',
		'created_at',
		'update_at',
	),
)); ?>
