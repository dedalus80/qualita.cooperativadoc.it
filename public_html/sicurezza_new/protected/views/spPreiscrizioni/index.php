<?php
/* @var $this DbAzionicorrettiveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Db Azionicorrettives',
);

$this->menu=array(
	array('label'=>'Create DbAzionicorrettive', 'url'=>array('create')),
	array('label'=>'Manage DbAzionicorrettive', 'url'=>array('admin')),
);
?>

<h1>Db Azionicorrettives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
