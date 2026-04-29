<?php
/* @var $this DocumentProcedureController */
/* @var $model DocumentsProcedures */

$this->breadcrumbs=array(
	'Procedure Documenti'=>array('admin'),
	'Crea',
);

/*$this->menu=array(
	array('label'=>'List DocumentsProcedures', 'url'=>array('index')),
	array('label'=>'Manage DocumentsProcedures', 'url'=>array('admin')),
);*/
?>

<h1>Crea Procedura Documento</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/admin');?>">Elenco Procedure Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentProcedure/create');?>">Crea Procedura Documento</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Nuova Procedura</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>