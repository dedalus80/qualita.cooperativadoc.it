<?php
/* @var $this DocumentController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documenti'=>array('index'),
	'Gestione',
);

/*$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documents-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestione Documenti</h1>

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
	'id'=>'documents-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-striped table-bordered dataTable margin-bottom-xs',
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'category_id',
			'value' => '$data->category ? $data->category->name : ""',
			'filter' => CHtml::dropDownList('Documents[category_id]', $model->category_id, CHtml::listData(DocumentsCategory::model()->findAll(), 'id', 'name'), ['empty'=>'-- --', 'class'=>'form-control'])
		),
		array(
			'name' => 'procedura_id',
			'value' => '$data->procedura ? $data->procedura->procedura : ""',
			'filter' => CHtml::dropDownList('Documents[procedura_id]', $model->procedura_id, CHtml::listData(DocumentsProcedures::model()->findAll(), 'id', 'procedura'), ['empty'=>'-- --', 'class'=>'form-control'])
		),
		'titolo',
		array(
			'name' => 'publication_date',
			'value' => '$data->publication_date ? date("d-m-Y", strtotime($data->publication_date)) : ""',
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
					'url' => 'Yii::app()->createUrl("document/view", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza')),
					'imageUrl' => false,
				),
				'update' => array(
					'label' => '<i class="fa fa-edit"></i>',
					'url' => 'Yii::app()->createUrl("document/update", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica')),
					'imageUrl' => false,
				),
				'delete' => array(
					'label' => '<i class="fa fa-trash"></i>',
					'url' => 'Yii::app()->createUrl("document/delete", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'class' => 'dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina')),
					'imageUrl' => false,
				)
			),
		),
	),
)); ?>
