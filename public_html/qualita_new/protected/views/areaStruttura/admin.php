<?php
/* @var $this AreaStrutturaController */
/* @var $model UnitaMappaAree */

$this->breadcrumbs=array(
	'Aree Strutture'=>array('admin'),
	'Gestione',
);

/*$this->menu=array(
	array('label'=>'Elenco Aree Strutture', 'url'=>array('admin')),
	array('label'=>'Crea Area Struttura', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#unita-mappa-aree-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestione Aree Strutture</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/admin');?>">Elenco Aree Strutture</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('areaStruttura/create');?>">Crea Area Struttura</a>
</div>

<p>
Facoltativamente è possibile inserire un operatore di confronto (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) all'inizio di ciascuno dei valori di ricerca per specificare come deve essere effettuato il confronto.
</p>

<!--
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
));*/ ?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'unita-mappa-aree-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-striped table-bordered dataTable margin-bottom-xs',
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'unita_id',
			'value' => '$data->unita->nome',
			'filter' => CHtml::dropDownList('UnitaMappaAree[unita_id]', $model->unita_id, CHtml::listData(Soggiorni::model()->findAll(['condition' => 'tipologia = 1', 'order'=> 'nome']), 'id', 'nome'), ['empty'=>'-- --'])
		),
		'description',
		array(
			'class' => 'CButtonColumn',
			'headerHtmlOptions' => array('class' => 'centered dark', 'style'=>'width:100px'),
			'template' => '{view} {update} {delete}',
			'updateButtonImageUrl' => false,
			'buttons' => array
				(
				'view' => array(
					'label' => '<i class="fa fa-eye"></i>',
					'url' => 'Yii::app()->createUrl("areaStruttura/view", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza')),
					'imageUrl' => false,
				),
				'update' => array(
					'label' => '<i class="fa fa-edit"></i>',
					'url' => 'Yii::app()->createUrl("areaStruttura/update", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica')),
					'imageUrl' => false,
				),
				'delete' => array(
					'label' => '<i class="fa fa-trash"></i>',
					'url' => 'Yii::app()->createUrl("areaStruttura/delete", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'class' => 'dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina')),
					'imageUrl' => false,
				)
			),
		),
	),
)); ?>
