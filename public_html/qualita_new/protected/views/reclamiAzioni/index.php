<?php
/* @var $this ReclamiAzioniController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reclami Azionis',
);

$this->menu=array(
	array('label'=>'Create ReclamiAzioni', 'url'=>array('create')),
	array('label'=>'Manage ReclamiAzioni', 'url'=>array('admin')),
);
?>

<h1>Reclami Azionis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
