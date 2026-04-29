<?php
/* @var $this AreaStrutturaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Unita Mappa Arees',
);

$this->menu=array(
	array('label'=>'Create UnitaMappaAree', 'url'=>array('create')),
	array('label'=>'Manage UnitaMappaAree', 'url'=>array('admin')),
);
?>

<h1>Unita Mappa Arees</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
