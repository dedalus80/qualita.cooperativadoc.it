<?php
/* @var $this SnPreiscrizioniController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sn Preiscrizionis',
);

$this->menu=array(
	array('label'=>'Create SnPreiscrizioni', 'url'=>array('create')),
	array('label'=>'Manage SnPreiscrizioni', 'url'=>array('admin')),
);
?>

<h1>Sn Preiscrizionis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
