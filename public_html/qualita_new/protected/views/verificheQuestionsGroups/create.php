<?php
/* @var $this VerificheQuestionsGroupsController */
/* @var $model VerificheQuestionsGroups */

$this->breadcrumbs=array(
	'Verifiche Questions Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VerificheQuestionsGroups', 'url'=>array('index')),
	array('label'=>'Manage VerificheQuestionsGroups', 'url'=>array('admin')),
);
?>

<h1>Create VerificheQuestionsGroups</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>