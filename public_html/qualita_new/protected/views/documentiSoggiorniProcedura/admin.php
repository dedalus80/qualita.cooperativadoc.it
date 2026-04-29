<?php
/* @var $this DocumentiSoggiorniProceduraController */
/* @var $model DocumentiSoggiorniProcedura */

$this->breadcrumbs=array(
	'Tipologie documenti'=>array('admin'),
	'Gestione',
);
/*
$this->menu=array(
	array('label'=>'List DocumentiSoggiorniProcedura', 'url'=>array('index')),
	array('label'=>'Create DocumentiSoggiorniProcedura', 'url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#documenti-qualita-procedura-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-check'></i>&nbsp;Gestione tipologie documenti</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <!--<li><?php //echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca documento'))); ?></li>-->
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova tipologia documento'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'documenti-qualita-procedura-grid',
			'dataProvider'=>$model->search(),
			'itemsCssClass' => 'table table-striped table-bordered dataTable',
			'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono stati trovate tipologie di documenti',
			//'filter'=>$model,
			'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
			'columns'=>array(
				'id',
				array(
					'header'=>'Tipologia',
					'name'=>'procedura',
					'type'=>'raw',
				),
				/*array(
					'class'=>'CButtonColumn',
				),*/
				array(
                    'class' => 'CButtonColumn',
                    'header' => "Operazioni",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'htmlOptions' => array('style' => 'width:auto;text-align:center'),
                    'template' => '{edit} {delete}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array(
                        'edit' => array(
                            'label' => '<i class="ace-icon fa fa-edit  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("DocumentiSoggiorniProcedura/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica')),
                            'imageUrl' => false,
                        ),
						'delete' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"tipologiaDocumentiSoggiorni" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
			),
		)); ?>
	</div>
</div>

<!--
<h1>Gestione tipologie documenti</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->
