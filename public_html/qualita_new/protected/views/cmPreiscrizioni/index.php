<?php
/* @var $this CmPreiscrizioniController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cm Preiscrizionis',
);

$this->menu=array(
	array('label'=>'Create CmPreiscrizioni', 'url'=>array('create')),
	array('label'=>'Manage CmPreiscrizioni', 'url'=>array('admin')),
);
?>

<h1>Cm Preiscrizionis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
