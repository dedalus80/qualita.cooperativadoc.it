<?php
/* @var $this DocumentiQualitaProceduraController */
/* @var $model DocumentiQualitaProcedura */

$this->breadcrumbs=array(
	'Tipologie documenti'=>array('admin'),
	$model->id=>array('update','id'=>$model->id),
	'Modifica',
);

/*$this->menu=array(
	array('label'=>'List DocumentiQualitaProcedura', 'url'=>array('index')),
	array('label'=>'Create DocumentiQualitaProcedura', 'url'=>array('create')),
	array('label'=>'View DocumentiQualitaProcedura', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentiQualitaProcedura', 'url'=>array('admin')),
);*/
?>

<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Modifica Tipologia Documento <?php echo $model->id; ?></span></h2>
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>