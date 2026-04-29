<?php
/* @var $this QuestionarioUnavacanzaController */
/* @var $model QuestionarioUnavacanza */

$this->breadcrumbs=array(
	'Questionario Unavacanzas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionarioUnavacanza', 'url'=>array('index')),
	array('label'=>'Create QuestionarioUnavacanza', 'url'=>array('create')),
	array('label'=>'View QuestionarioUnavacanza', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionarioUnavacanza', 'url'=>array('admin')),
);
?>

<h1>Update QuestionarioUnavacanza <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>