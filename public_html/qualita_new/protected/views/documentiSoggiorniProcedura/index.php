<?php
/* @var $this DocumentiSoggiorniProceduraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documenti Qualita Proceduras',
);

$this->menu=array(
	array('label'=>'Create DocumentiSoggiorniProcedura', 'url'=>array('create')),
	array('label'=>'Manage DocumentiSoggiorniProcedura', 'url'=>array('admin')),
);
?>

<h1>Documenti Qualita Proceduras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
