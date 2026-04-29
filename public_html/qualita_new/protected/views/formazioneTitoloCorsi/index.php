<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Formazione Titolo Corsis',
);

$this->menu=array(
	array('label'=>'Create FormazioneTitoloCorsi', 'url'=>array('create')),
	array('label'=>'Manage FormazioneTitoloCorsi', 'url'=>array('admin')),
);
?>

<h1>Formazione Titolo Corsis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
