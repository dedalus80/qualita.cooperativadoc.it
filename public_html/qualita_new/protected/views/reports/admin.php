<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Segnalazioni'=>array('admin'),
	'Gestione',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reports-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestione segnalazioni</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
	<?php if(Yii::app()->user->can('Segnalazioni', 'create')):?>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/create');?>">Crea Segnalazione</a>
	<?php endif;?>
	<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
    <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/unavailable-areas');?>">Aree / Spazi non disponibili</a>
    <?php endif;?>
</div>

<p>
Facoltativamente è possibile inserire un operatore di confronto (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) all'inizio di ciascuno dei valori di ricerca per specificare come deve essere effettuato il confronto.
</p>

<?php if(!empty($searchForm)):?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php endif;?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'itemsCssClass' => 'table table-striped table-bordered dataTable margin-bottom-xs',
	'filter'=>$model,
	'afterAjaxUpdate'=>'loadStyleFilter',
	'columns'=>array(
		'id',
		array(
			'name' => 'created_at',
			'type' => 'raw',
			'value' => 'Yii::app()->dateFormatter->formatDateTime($data->created_at)'
		),
		array(
			'name' => 'user_id',
			'type' => 'raw',
			'value' => '$data->user->nome." ".$data->user->cognome',
			'htmlOptions' => array('class' => 'hidden-480'),
			'headerHtmlOptions' => array('class' => 'hidden-480'),
		),
		array(
			'name' => 'structure_id',
			'type' => 'raw',
			'value' => 'Strutture::model()->findByPk($data->structure_id)->nome',
			'htmlOptions' => array('class' => 'hidden-480'),
			'headerHtmlOptions' => array('class' => 'hidden-480'),
			'filter' => CHtml::dropDownList('Reports[structure_id]', $model->structure_id, $model->getViewStructureFilter(), ['class'=>'select2','empty'=>'-- --'])
		),
		array(
			'name' => 'structure_area_id',
			'value' => '$data->area->description',
			'htmlOptions' => array('class' => 'hidden-480'),
			'headerHtmlOptions' => array('class' => 'hidden-480'),
			'filter' => CHtml::dropDownList('Reports[structure_area_id]', $model->structure_area_id, $model->getViewAreaFilter(), ['class'=>'select2','empty'=>'-- --'])
		),
		array(
			'name' => 'area_not_available',
			'header' => 'Disponibile?',
			'type' => 'raw',
			'value' => '$data->getHtmlAreaNotAvailable()',
			'filter' => Chtml::dropDownList('Reports[area_not_available]', $model->area_not_available, ['0'=>'SI','1'=>'NO'], ['class'=>'select2','empty'=>'-- --'])
		),
		array(
			'name' => 'category_id',
			'value' => '$data->category->name',
			'filter' => CHtml::dropDownList('Reports[category_id]', $model->category_id, $model->getViewCategoryFilter(), ['class'=>'select2','empty'=>'-- --'])
		),
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => '$data->getHtmlStatus()',
			'filter' => CHtml::dropDownList('Reports[status]', $model->status, CHtml::listData($model->getViewStatusFilter(), 'id', 'status'), ['empty'=>'-- --'])
		),
		array(
			'name' => 'escalated_to_admin',
			'header' => 'R.I.',
			'type' => 'raw',
			'value' => '$data->getHtmlEscalatedToAdmin()',
			'filter' => Chtml::dropDownList('Reports[escalated_to_admin]', $model->escalated_to_admin, ['1'=>'SI','0'=>'NO'], ['class'=>'select2','empty'=>'-- --'])
		),
		array(
			'name' => 'priority',
			'value' => '$data->priority',
			'filter' => CHtml::dropDownList('Reports[priority]', $model->priority, ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'], ['empty'=>'-- --'])
		),
		/*array(
			'name' => 'maintenances.user_id',
			'type' => 'raw',
			'value' => '$data->maintenances->user->nome." ".$data->maintenances->user->cognome',
		),*/
		array(
			'class' => 'CButtonColumn',
			//'header' => "Azioni",
			'headerHtmlOptions' => array('class' => 'centered dark', 'style'=>'width:100px'),
			'template' => '{view} {update} {delete}',
			'updateButtonImageUrl' => false,
			'buttons' => array
				(
				'view' => array(
					'label' => '<i class="fa fa-eye"></i>',
					'url' => 'Yii::app()->createUrl("reports/view", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza')),
					'imageUrl' => false,
				),
				'update' => array(
					'label' => '<i class="fa fa-edit"></i>',
					'url' => 'Yii::app()->createUrl("reports/update", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica')),
					'imageUrl' => false,
					'visible' => '$data->abilityUpdate()'
				),
				'delete' => array(
					'label' => '<i class="fa fa-trash"></i>',
					'url' => 'Yii::app()->createUrl("reports/delete", array("id"=>$data->id))',
					'options' => array('style' => 'margin: .25em', 'class' => 'dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina')),
					'imageUrl' => false,
					'visible' => '$data->abilityDelete()',
				)
			),
		),
	),
)); ?>
