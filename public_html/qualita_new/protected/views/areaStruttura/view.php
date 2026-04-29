<?php
/* @var $this AreaStrutturaController */
/* @var $model UnitaMappaAree */

$this->breadcrumbs=array(
	'Area Struttura'=>array('admin'),
	$model->id,
);

/*$this->menu=array(
	array('label'=>'List UnitaMappaAree', 'url'=>array('index')),
	array('label'=>'Create UnitaMappaAree', 'url'=>array('create')),
	array('label'=>'Update UnitaMappaAree', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UnitaMappaAree', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UnitaMappaAree', 'url'=>array('admin')),
);*/
?>

<h1>Area Struttura #<?php echo $model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/admin');?>">Elenco Aree Strutture</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/create');?>">Crea Area Struttura</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/update/'.$model->id);?>">Modifica Area Struttura</a>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions'=>array(
		'class'=>'table table-striped'
	),
	'attributes'=>array(
		'id',
		array(
			'name'=>'unita_id',
			'value'=>$model->unita->nome
		),
		'description',
	),
)); ?>
