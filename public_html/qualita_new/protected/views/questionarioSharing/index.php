<?php
/* @var $this QuestionarioSharingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionario Sharings',
);

$this->menu=array(
	array('label'=>'Create QuestionarioSharing', 'url'=>array('create')),
	array('label'=>'Manage QuestionarioSharing', 'url'=>array('admin')),
);
?>

<h1>Questionario Sharings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
