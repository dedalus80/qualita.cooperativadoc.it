<?php
/* @var $this ComunicazioniController */
/* @var $model Comunicazioni */

$this->breadcrumbs=array(
	'Comunicazionis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comunicazioni', 'url'=>array('index')),
	array('label'=>'Create Comunicazioni', 'url'=>array('create')),
	array('label'=>'View Comunicazioni', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Comunicazioni', 'url'=>array('admin')),
);
?>

<h1>Update Comunicazioni <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>