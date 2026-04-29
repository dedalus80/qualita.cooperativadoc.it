<?php
/* @var $this RuoliController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utenti Tipis',
);

$this->menu=array(
	array('label'=>'Create UtentiTipi', 'url'=>array('create')),
	array('label'=>'Manage UtentiTipi', 'url'=>array('admin')),
);
?>

<h1>Utenti Tipis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
