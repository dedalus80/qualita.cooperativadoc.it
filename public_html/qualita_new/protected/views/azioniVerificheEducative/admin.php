<?php
$this->breadcrumbs = array(
    'Verifiche Ispettive dati servizio educativo' => array('admin'),
    'Gestione',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>

<div class="panel panel-default panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-check'></i>&nbsp;Verifiche <span class="hidden-480">ispettive </span>servizio educativo</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca verifica'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-download"></i>', './modello', array('class' => 'open-download button-icon button-icon-orange', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Scarica modello verifica ispettiva'))); ?></li>
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
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'azioni-verifiche-educazione-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'Dettaglio',
					'type' => 'raw',
					'value' => array($model, 'getDettaglio'),
                    'htmlOptions' => array('class' => 'td-phone'),
                    'headerHtmlOptions' => array('class' => 'td-phone dark'),
                ),
				array(
                    'name' => 'codice_verifica',
                    'type' => 'raw',
					'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'data',
                    'value' => array($model, 'getData'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'ora_inizio',
                    'value' => array($model, 'getOraStart'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'ora_fine',
                    'value' => array($model, 'getOraStop'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'autore',
                    'value' => array($model, 'getAutore'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'unita_operativa',
                    'value' => array($model, 'getStruttura'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'tipo_valutazione',
                    'value' => array($model, 'getValutazione'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'numero_non_conformita',
                    'type' => 'raw',
                    'value' => array($model, 'getNC'),
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
                            'url' => 'Yii::app()->createUrl("azioniVerificheEducative/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica verifica')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "PDF",
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-file-pdf-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("azioniVerificheEducative/stampa", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Stampa verifica ispettiva')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Can",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only  btn  btn-circle circle-blue "></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina verifica')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"azioniVerificheEducative" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>
<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-check'></i>&nbsp; Verifiche servizi educativi</h4>
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