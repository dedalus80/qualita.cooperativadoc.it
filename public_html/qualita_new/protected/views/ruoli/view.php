<?php
/* @var $this RuoliController */
/* @var $model UtentiTipi */

$this->breadcrumbs=array(
	'Utenti Tipis'=>array('index'),
	$model->id,
);

/*$this->menu=array(
	'submenuTemplate' => "\n<div class='btn-group row-button'>\n{items}\n</div>",
	//'options' => ['class'=>'btn-group row-bottom', 'role'=>'group'],
	'items'=>[
		array('label'=>'List UtentiTipi', 'url'=>array('index'), 'class'=>'btn btn-default'),
		array('label'=>'Create UtentiTipi', 'url'=>array('create'), 'class'=>'btn btn-default'),
		array('label'=>'Update UtentiTipi', 'url'=>array('update', 'id'=>$model->id), 'class'=>'btn btn-default'),
		array('label'=>'Delete UtentiTipi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'class'=>'btn btn-default'),
		array('label'=>'Manage UtentiTipi', 'url'=>array('admin'), 'class'=>'btn btn-default'),
	]
);*/

?>

<h1>Dettaglio Ruolo #<?php echo $model->nome; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/create');?>">Crea Ruolo</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/admin');?>">Gestione Ruoli</a>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'gruppo',
		array(
			'name'=>'permissions',
			'type'=>'html',
			'value' => $model->displayPermissions(),
		)
	),
)); ?>
