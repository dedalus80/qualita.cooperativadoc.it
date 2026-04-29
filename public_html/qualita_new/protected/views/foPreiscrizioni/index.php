<?php
/* @var $this CaPreiscrizioniController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ca Preiscrizionis',
);

$this->menu=array(
	array('label'=>'Create CaPreiscrizioni', 'url'=>array('create')),
	array('label'=>'Manage CaPreiscrizioni', 'url'=>array('admin')),
);
?>

<h1>Ca Preiscrizionis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
