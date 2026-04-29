<?php
/* @var $this VerificheQuestionsGroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Verifiche Questions Groups',
);

$this->menu=array(
	array('label'=>'Create VerificheQuestionsGroups', 'url'=>array('create')),
	array('label'=>'Manage VerificheQuestionsGroups', 'url'=>array('admin')),
);
?>

<h1>Verifiche Questions Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
