<?php
/* @var $this QuestionarioSharingController */
/* @var $model QuestionarioSharing */

$this->breadcrumbs=array(
	'Questionario Sharings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionarioSharing', 'url'=>array('index')),
	array('label'=>'Create QuestionarioSharing', 'url'=>array('create')),
	array('label'=>'View QuestionarioSharing', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionarioSharing', 'url'=>array('admin')),
);
?>

<h1>Update QuestionarioSharing <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>