<?php
/* @var $this DocumentProcedureController */
/* @var $model DocumentsProcedures */

$this->breadcrumbs=array(
	'Procedure Documenti'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Modifica',
);

/*$this->menu=array(
	array('label'=>'List DocumentsProcedures', 'url'=>array('index')),
	array('label'=>'Create DocumentsProcedures', 'url'=>array('create')),
	array('label'=>'View DocumentsProcedures', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentsProcedures', 'url'=>array('admin')),
);*/
?>

<h1>Modifica Procedura <?php echo '#'.$model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/admin');?>">Elenco Procedure Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/create');?>">Crea Procedura Documento</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/view/'.$model->id);?>">Visualizza Procedura Documento</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica Procedura</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>