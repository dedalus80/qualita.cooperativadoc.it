<?php
/* @var $this AzioniVerificheAmbientaleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Azioni Verifiche Ambientales',
);

$this->menu=array(
	array('label'=>'Create AzioniVerificheAmbientale', 'url'=>array('create')),
	array('label'=>'Manage AzioniVerificheAmbientale', 'url'=>array('admin')),
);
?>

<h1>Azioni Verifiche Ambientales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
