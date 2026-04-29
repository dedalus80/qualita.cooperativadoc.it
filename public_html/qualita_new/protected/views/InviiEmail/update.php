<?php
/* @var $this SendEmailController */
/* @var $model SendEmail */

$this->breadcrumbs=array(
	'Send Emails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SendEmail', 'url'=>array('index')),
	array('label'=>'Create SendEmail', 'url'=>array('create')),
	array('label'=>'View SendEmail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SendEmail', 'url'=>array('admin')),
);
?>

<h1>Update SendEmail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>