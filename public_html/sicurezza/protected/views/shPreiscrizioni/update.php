<?php

/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Pre Iscrizioni Sharing' => array('admin'),
    $model->id=>array('view','id'=>$model->id),
	'Modifica',
);

$this->menu = array(
    array('label' => 'Lista pre iscrizioni', 'url' => array('admin'),  'itemOptions' => array('class' => 'last'))
  
);

?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>