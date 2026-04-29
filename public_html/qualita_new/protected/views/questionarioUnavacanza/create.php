<?php
/* @var $this QuestionarioUnavacanzaController */
/* @var $model QuestionarioUnavacanza */

$this->breadcrumbs=array(
	'Questionario Unavacanzas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionarioUnavacanza', 'url'=>array('index')),
	array('label'=>'Manage QuestionarioUnavacanza', 'url'=>array('admin')),
);
?>

<h1>Create QuestionarioUnavacanza</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>