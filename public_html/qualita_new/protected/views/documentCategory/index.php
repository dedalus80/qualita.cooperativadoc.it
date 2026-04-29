<?php
/* @var $this DocumentCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents Categories',
);

$this->menu=array(
	array('label'=>'Create DocumentsCategory', 'url'=>array('create')),
	array('label'=>'Manage DocumentsCategory', 'url'=>array('admin')),
);
?>

<h1>Documents Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
