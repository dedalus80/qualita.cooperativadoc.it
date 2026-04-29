<?php
/* @var $this DocumentiSoggiorniProceduraController */
/* @var $model DocumentiSoggiorniProcedura */

$this->breadcrumbs=array(
	'Tipologie documenti'=>array('admin'),
	$model->id=>array('update','id'=>$model->id),
	'Modifica',
);

/*$this->menu=array(
	array('label'=>'List DocumentiSoggiorniProcedura', 'url'=>array('index')),
	array('label'=>'Create DocumentiSoggiorniProcedura', 'url'=>array('create')),
	array('label'=>'View DocumentiSoggiorniProcedura', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentiSoggiorniProcedura', 'url'=>array('admin')),
);*/
?>

<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Modifica Tipologia Documento <?php echo $model->id; ?></span></h2>
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>