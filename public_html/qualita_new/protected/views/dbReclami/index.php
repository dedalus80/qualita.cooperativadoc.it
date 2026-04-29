<?php
/* @var $this DbReclamiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Db Reclamis',
);

$this->menu=array(
	array('label'=>'Create DbReclami', 'url'=>array('create')),
	array('label'=>'Manage DbReclami', 'url'=>array('admin')),
);
?>

<h1>Db Reclamis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
