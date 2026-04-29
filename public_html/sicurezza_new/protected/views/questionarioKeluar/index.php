<?php
/* @var $this QuestionarioKeluarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionario Keluars',
);

$this->menu=array(
	array('label'=>'Create QuestionarioKeluar', 'url'=>array('create')),
	array('label'=>'Manage QuestionarioKeluar', 'url'=>array('admin')),
);
?>

<h1>Questionario Keluars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
