<?php
/* @var $this QuestionarioDocController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionario Docs',
);

$this->menu=array(
	array('label'=>'Create QuestionarioDoc', 'url'=>array('create')),
	array('label'=>'Manage QuestionarioDoc', 'url'=>array('admin')),
);
?>

<h1>Questionario Docs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
