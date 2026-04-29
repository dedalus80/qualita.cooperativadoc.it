<?php
/* @var $this ComunicazioniController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comunicazionis',
);

$this->menu=array(
	array('label'=>'Create Comunicazioni', 'url'=>array('create')),
	array('label'=>'Manage Comunicazioni', 'url'=>array('admin')),
);
?>

<h1>Comunicazionis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
