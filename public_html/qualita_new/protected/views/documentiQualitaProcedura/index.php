<?php
/* @var $this DocumentiQualitaProceduraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documenti Qualita Proceduras',
);

$this->menu=array(
	array('label'=>'Create DocumentiQualitaProcedura', 'url'=>array('create')),
	array('label'=>'Manage DocumentiQualitaProcedura', 'url'=>array('admin')),
);
?>

<h1>Documenti Qualita Proceduras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
