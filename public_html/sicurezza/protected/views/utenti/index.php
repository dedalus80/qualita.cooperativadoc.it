<?php
/* @var $this UtentiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utentis',
);

$this->menu=array(
	array('label'=>'Create Utenti', 'url'=>array('create')),
	array('label'=>'Manage Utenti', 'url'=>array('admin')),
);
?>

<h1>Utentis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
