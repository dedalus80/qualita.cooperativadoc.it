<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $model FormazioneTitoloCorsi */

$this->breadcrumbs=array(
	'Gestione titoli corsi formazione'=>array('admin'),
	'Gestione',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#formazione-titolo-corsi-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-university'></i>&nbsp;Titoli corsi formazione</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip','data-html' =>'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuovo titolo corso'))); ?></li>
            </ul>
        </div>
    </div>
	<div class="panel-body">
		<div class="search-form" style="display:none" id="search-form-box">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
        </div><!-- search-form -->

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale titoli presenti <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non ci sono titoli presenti',
			'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
			'id'=>'formazione-titoli-corsi-grid',
			'dataProvider'=>$model->search(),
			//'filter'=>$model,
			'columns'=>array(
				'id',
				'titolo_corso',
				'categoria',
				array(
                    'name' => 'attivo',
                    'type' => 'raw',
                    'value' => array($model, 'getAttivo'),
                    'htmlOptions' => array('class' => 'hidden-480 centered '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered '),
                ),
				'insert_date',
				array(
					'class'=>'CButtonColumn',
					'headerHtmlOptions' => array('class' => 'text-center'),
					'template' => '<div class="text-center">{update}&nbsp;{delete}</div>',
					'updateButtonImageUrl' => false,
					'htmlOptions' => array('class' => 'inline-block'),
					'buttons' => array
                        (
                        'update' => array(
                            'label' => '<i class="ace-icon fa fa-edit bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("formazioneTitoloCorsi/update", array("id"=>$data->id))',
                            'visible' => 'true',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica titolo corso')),
                            'imageUrl' => false,
                        ),
						'delete' => array(
							'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("formazioneTitoloCorsi/delete", array("id"=>$data->id))',
                            'visible' => 'true',
							'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina titolo corso')),
							'imageUrl' => false,
						)
                    ),
				),
			),
		)); ?>
	</div>


