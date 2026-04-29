<?php
$this->breadcrumbs = array(
    'Verifiche Ispettive' => array('admin'),
    'Gestione',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-check'></i>&nbsp;Verifiche <span class="hidden-480">ispettive</span></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca verifica'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova verifica'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non ci sono verifiche ispettive',
            'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'azioni-verifiche-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'Dettaglio',
					'value' => array($model, 'getDettaglio'),
                    'type' => 'raw',
					'htmlOptions' => array('class' => 'td-phone'),
                    'headerHtmlOptions' => array('class' => 'dark td-phone'),
                ),
				array(
                    'name' => 'codice',
                    'type' => 'raw',
					'value' => array($model, 'getCode'),
					'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'unita_operativa',
                    'value' => array($model, 'getStruttura'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'tipo_verifica',
                    'value' => array($model, 'getTipologia'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'data_prevista',
                    'value' => array($model, 'getDataPrevista'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'data_effettiva',
                    'value' => array($model, 'getDataEffettiva'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'stato',
                    'type' => 'raw',
                    'value' => array($model, 'getStato'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                array(
                    'name' => 'completa',
                    'type' => 'raw',
                    'value' => array($model, 'getCompleta'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Mod",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-edit  bigger-110 icon-only  btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("azioniVerifiche/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica verifica')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Can",
                   	'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only  btn  btn-circle circle-blue "></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina verifica')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"azioniVerifiche" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'name' => 'Esegui',
                    'type' => 'raw',
                    'value' => array($model, 'getLinkVerifica'),
                    'htmlOptions' => array('class' => 'centered'),
                    'headerHtmlOptions' => array('class' => 'centered'), 
                ),
            ),
        ));
        ?>
    </div>
</div>
<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-check'></i>&nbsp; Verifiche ispettive</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('_search', array('model' => $model)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-search"></i>&nbsp;&nbsp;Ricerca', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'search-form-int')); ?>
            </div>
        </div>
    </div>
</div>