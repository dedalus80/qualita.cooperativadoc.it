<?php
/* @var $this DbAzionicorrettiveController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pre Iscrizioni Sharing',
);

$this->menu = array(
    array('label' => 'Lista pre iscrizioni', 'url' => array('admin'),  'itemOptions' => array('class' => 'last'))
    
);
?>

<h1>Pre Iscrizioni Sharing</h1>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
