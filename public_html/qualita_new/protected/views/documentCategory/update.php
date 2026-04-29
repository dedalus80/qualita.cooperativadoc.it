<?php
/* @var $this DocumentCategoryController */
/* @var $model DocumentsCategory */

$this->breadcrumbs=array(
	'Categorie Documenti'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Modifica',
);

/*$this->menu=array(
	array('label'=>'List DocumentsCategory', 'url'=>array('index')),
	array('label'=>'Create DocumentsCategory', 'url'=>array('create')),
	array('label'=>'View DocumentsCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentsCategory', 'url'=>array('admin')),
);*/
?>

<h1>Modifica Categoria <?php echo '#'.$model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/admin');?>">Elenco Categorie Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/create');?>">Crea Categoria Documento</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/view/'.$model->id);?>">Visualizza Categoria Documento</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica Categoria</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>