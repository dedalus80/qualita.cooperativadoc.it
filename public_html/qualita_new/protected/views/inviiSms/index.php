<?php
/* @var $this SendSmsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Send Sms',
);

$this->menu=array(
	array('label'=>'Create SendSms', 'url'=>array('create')),
	array('label'=>'Manage SendSms', 'url'=>array('admin')),
);
?>

<h1>Send Sms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
