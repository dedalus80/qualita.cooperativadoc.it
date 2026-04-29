<?php
/* @var $this DocumentProcedureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents Procedures',
);

$this->menu=array(
	array('label'=>'Create DocumentsProcedures', 'url'=>array('create')),
	array('label'=>'Manage DocumentsProcedures', 'url'=>array('admin')),
);
?>

<h1>Documents Procedures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
