<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs=array(
	'Utenti'=>array('index'),
	$model->user=>array('view','id'=>$model->id),
	'Modifica',
);

$this->menu=array(
	array('label'=>'Lista Utenti', 'url'=>array('admin')),
	array('label'=>'Crea Utente', 'url'=>array('create')),
	array('label'=>'Visualizza Utente', 'url'=>array('view', 'id'=>$model->id), 'itemOptions' => array('class' => 'last')),
	
);
?>

 <h1>Modifica utente <span class='red'><?=$model->user?></span></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>