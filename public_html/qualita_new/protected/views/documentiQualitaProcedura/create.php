<?php
/* @var $this DocumentiQualitaProceduraController */
/* @var $model DocumentiQualitaProcedura */

$this->breadcrumbs=array(
	'Tipologie documenti'=>array('admin'),
	'Crea',
);

/*$this->menu=array(
	array('label'=>'List DocumentiQualitaProcedura', 'url'=>array('index')),
	array('label'=>'Manage DocumentiQualitaProcedura', 'url'=>array('admin')),
);*/
?>

<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Crea Tipologia Documento</span></h2>
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>