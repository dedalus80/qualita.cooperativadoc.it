<?php
/* @var $this AreaStrutturaController */
/* @var $model UnitaMappaAree */

$this->breadcrumbs=array(
	'Aree Strutture'=>array('admin'),
	'Crea',
);

/*$this->menu=array(
	array('label'=>'List UnitaMappaAree', 'url'=>array('index')),
	array('label'=>'Manage UnitaMappaAree', 'url'=>array('admin')),
);*/
?>

<h1>Crea Area Struttura</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/admin');?>">Elenco Aree Strutture</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/create');?>">Crea Area Struttura</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Nuova Area</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>