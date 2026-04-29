<?php
/* @var $this MatricoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Matricoles',
);

$this->menu=array(
	array('label'=>'Create Matricole', 'url'=>array('create')),
	array('label'=>'Manage Matricole', 'url'=>array('admin')),
);
?>

<h1>Matricoles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
