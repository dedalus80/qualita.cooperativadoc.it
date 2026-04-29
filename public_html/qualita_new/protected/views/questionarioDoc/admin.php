<?php
$this->breadcrumbs = array('Questionari Doc' => array('admin'), 'Gestisci',);
Yii::app()->clientScript->registerScript('search', " $('.search-button').click(function(){	$('.search-form').toggle();	return false;});");
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionari Doc</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                 <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca questionario'))); ?></li>
        
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale questionari <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Nessuna questionario',
            'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'questionario-doc-grid',
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
                    'name' => 'data_restituzione',
                    'value' => array($model, 'getDataFormated'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ), array(
                    'name' => 'nome',
                    //'value' => array($model, 'getDataFormated'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ), array(
                    'name' => 'cognome',
                    //'value' => array($model, 'getDataFormated'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'struttura_nome',
                    'value' => array($model, 'getStruttura'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'vacanza',
                    'value' => array($model, 'getGiudizioVacanza'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'header' => 'Vedi',
                    'headerHtmlOptions' => array('class' => 'dark centered'),
                    'class' => 'CButtonColumn',
                    'template' => '{scarica}',
                    'buttons' => array
                        (
                        'scarica' => array
                            (
                            'class' => 'donwload_link',
                            'label' => '<i class="ace-icon fa fa-search bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("questionarioDoc/view", array("id"=>$data->id))',
                            'options' => array('class' => 'myview dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza questionario')),
                        ),
                    ),
                ),/*
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Pdf",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-file-pdf-o bigger-110 icon-only"></i>',
                            'url' => 'Yii::app()->createUrl("questionarioDoc/stampa", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Stampa questionario')),
                            'imageUrl' => false,
                        ),
                    ),
                ), */
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Can",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina questionario')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"questionario_doc" ); return false }',
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
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-question'></i>&nbsp;&nbsp;Ricerca questionario</h4>
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
