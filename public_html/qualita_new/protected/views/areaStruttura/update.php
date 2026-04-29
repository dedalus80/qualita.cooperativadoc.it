<?php
/* @var $this AreaStrutturaController */
/* @var $model UnitaMappaAree */

$this->breadcrumbs=array(
	'Aree Strutture'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List UnitaMappaAree', 'url'=>array('index')),
	array('label'=>'Create UnitaMappaAree', 'url'=>array('create')),
	array('label'=>'View UnitaMappaAree', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UnitaMappaAree', 'url'=>array('admin')),
);*/
?>

<h1>Modifica Area <?php echo '#'.$model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/admin');?>">Elenco Aree Strutture</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/create');?>">Crea Area Struttura</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/view/'.$model->id);?>">Visualizza Area Struttura</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica Area</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>