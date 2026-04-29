<?php
/* @var $this QuestionarioUnavacanzaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Questionario Unavacanzas',
);

$this->menu=array(
	array('label'=>'Create QuestionarioUnavacanza', 'url'=>array('create')),
	array('label'=>'Manage QuestionarioUnavacanza', 'url'=>array('admin')),
);
?>

<h1>Questionario Unavacanzas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
