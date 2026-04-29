<?php
/* @var $this TipologieFormazioneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipologie Formaziones',
);

$this->menu=array(
	array('label'=>'Create TipologieFormazione', 'url'=>array('create')),
	array('label'=>'Manage TipologieFormazione', 'url'=>array('admin')),
);
?>

<h1>Tipologie Formaziones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
