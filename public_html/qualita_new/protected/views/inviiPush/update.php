<?php
/* @var $this SendSmsController */
/* @var $model SendSms */

$this->breadcrumbs=array(
	'Send Sms'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SendSms', 'url'=>array('index')),
	array('label'=>'Create SendSms', 'url'=>array('create')),
	array('label'=>'View SendSms', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SendSms', 'url'=>array('admin')),
);
?>

<h1>Update SendSms <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>