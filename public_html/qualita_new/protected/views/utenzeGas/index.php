<?php
/* @var $this UtenzePresenzeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utenze Presenzes',
);

$this->menu=array(
	array('label'=>'Create UtenzePresenze', 'url'=>array('create')),
	array('label'=>'Manage UtenzePresenze', 'url'=>array('admin')),
);
?>

<h1>Utenze Presenzes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
