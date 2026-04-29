<?php
/* @var $this StruttureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Struttures',
);

$this->menu=array(
	array('label'=>'Create Strutture', 'url'=>array('create')),
	array('label'=>'Manage Strutture', 'url'=>array('admin')),
);
?>

<h1>Struttures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
