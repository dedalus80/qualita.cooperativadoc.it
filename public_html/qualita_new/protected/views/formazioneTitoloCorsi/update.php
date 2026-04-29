<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

/*$this->breadcrumbs=array(
	'Formazione Titolo Corsis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FormazioneTitoloCorsi', 'url'=>array('index')),
	array('label'=>'Create FormazioneTitoloCorsi', 'url'=>array('create')),
	array('label'=>'View FormazioneTitoloCorsi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FormazioneTitoloCorsi', 'url'=>array('admin')),
);
?>

<h1>Update FormazioneTitoloCorsi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
*/

/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

$this->breadcrumbs=array(
	'Gestione titolo corsi formazione'=>array('admin'),
	$model->id=>array('update','id'=>$model->id),'Modifica',);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Modifica <span class="no-phone">titolo corso&nbsp;</span><span class="orange">"<?php echo $model->titolo_corso;?>"</span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>