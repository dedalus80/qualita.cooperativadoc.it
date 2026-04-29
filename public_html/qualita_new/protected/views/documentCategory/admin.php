<?php
/* @var $this DocumentCategoryController */
/* @var $model DocumentsCategory */

$this->breadcrumbs=array(
	'Categorie Documenti'=>array('admin'),
	'Gestione',
);

/*$this->menu=array(
	array('label'=>'Elenco Categorie Documenti', 'url'=>array('admin')),
	array('label'=>'Crea Categoria Documento', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documents-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestione Categorie Documenti</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/admin');?>">Elenco Categorie Documenti</a>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('documentCategory/create');?>">Crea Categoria Documento</a>
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

<div id="statusMsg" style="display:none"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documents-category-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-striped table-bordered dataTable margin-bottom-xs',
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'created_at',
		'update_at',
		array(
			'class' => 'CButtonColumn',
			'headerHtmlOptions' => array('class' => 'centered dark', 'style'=>'width:100px'),
			'template' => '{view} {update} {delete}',
			'updateButtonImageUrl' => false,
			'buttons' => array
				(
				'view' => array(
					'label' => '<i class="fa fa-eye"></i>',
					'url' => 'Yii::app()->createUrl("documentCategory/view", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza')),
					'imageUrl' => false,
				),
				'update' => array(
					'label' => '<i class="fa fa-edit"></i>',
					'url' => 'Yii::app()->createUrl("documentCategory/update", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica')),
					'imageUrl' => false,
				),
				'delete' => array(
					'label' => '<i class="fa fa-trash"></i>',
					'url' => 'Yii::app()->createUrl("documentCategory/delete", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'class' => 'dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina')),
					'imageUrl' => false,
				)
			),
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data).show(); }',
		),
	),
)); ?>
