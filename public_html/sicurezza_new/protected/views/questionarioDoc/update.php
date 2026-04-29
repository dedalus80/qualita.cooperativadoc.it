<?php
/* @var $this QuestionarioDocController */
/* @var $model QuestionarioDoc */

$this->breadcrumbs=array(
	'Questionario Docs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionarioDoc', 'url'=>array('index')),
	array('label'=>'Create QuestionarioDoc', 'url'=>array('create')),
	array('label'=>'View QuestionarioDoc', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionarioDoc', 'url'=>array('admin')),
);
?>

<h1>Update QuestionarioDoc <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>