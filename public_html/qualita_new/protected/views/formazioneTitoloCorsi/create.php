<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

/*$this->breadcrumbs=array(
	'Formazione Titolo Corsis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FormazioneTitoloCorsi', 'url'=>array('index')),
	array('label'=>'Manage FormazioneTitoloCorsi', 'url'=>array('admin')),
);
?>

<h1>Create FormazioneTitoloCorsi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

*/

/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

$this->breadcrumbs = array('Gestione titolo corsi formazione' => array('admin'),'Nuovo titolo corso',);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuova titolo corso di formazione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>