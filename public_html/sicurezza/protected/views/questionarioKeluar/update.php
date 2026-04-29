<?php
/* @var $this QuestionarioKeluarController */
/* @var $model QuestionarioKeluar */

$this->breadcrumbs=array(
	'Questionario Keluars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionarioKeluar', 'url'=>array('index')),
	array('label'=>'Create QuestionarioKeluar', 'url'=>array('create')),
	array('label'=>'View QuestionarioKeluar', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuestionarioKeluar', 'url'=>array('admin')),
);
?>

<h1>Update QuestionarioKeluar <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>