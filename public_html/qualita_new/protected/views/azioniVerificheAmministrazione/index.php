<?php
/* @var $this AzioniVerificheAmministrazioneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Azioni Verifiche Amministraziones',
);

$this->menu=array(
	array('label'=>'Create AzioniVerificheAmministrazione', 'url'=>array('create')),
	array('label'=>'Manage AzioniVerificheAmministrazione', 'url'=>array('admin')),
);
?>

<h1>Azioni Verifiche Amministraziones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
