<?php
/* @var $this SendEmailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Send Emails',
);

$this->menu=array(
	array('label'=>'Create SendEmail', 'url'=>array('create')),
	array('label'=>'Manage SendEmail', 'url'=>array('admin')),
);
?>

<h1>Send Emails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
