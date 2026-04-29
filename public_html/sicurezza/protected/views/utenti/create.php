<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs=array(
	'Utenti'=>array('admin'),
	'Nuovo utente',
);

$this->menu=array(
        
	array('label'=>'Lista Utenti', 'url'=>array('admin')),
	array('label'=>'Nuovo Utente', 'url'=>array('create'),'itemOptions' => array('class' => 'last')),
);
?>

<h1>Nuovo Utenti</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>