<?php
/* @var $this LettureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lettures',
);

$this->menu=array(
	array('label'=>'Create Letture', 'url'=>array('create')),
	array('label'=>'Manage Letture', 'url'=>array('admin')),
);
?>

<h1>Lettures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
