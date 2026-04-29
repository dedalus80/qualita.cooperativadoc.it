<?php
/* @var $this VerificheQuestionsGroupsController */
/* @var $model VerificheQuestionsGroups */

$this->breadcrumbs=array(
	'Verifiche Questions Groups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List VerificheQuestionsGroups', 'url'=>array('index')),
	array('label'=>'Create VerificheQuestionsGroups', 'url'=>array('create')),
	array('label'=>'View VerificheQuestionsGroups', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage VerificheQuestionsGroups', 'url'=>array('admin')),
);
?>

<h1>Update VerificheQuestionsGroups <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>