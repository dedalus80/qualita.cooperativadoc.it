<?php
$this->breadcrumbs = array('Reclami' => array('admin'), 'Gestione',);
Yii::app()->clientScript->registerScript('search', " $('.search-button').click(function(){	$('.search-form').toggle();	return false;});");
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-bullhorn'></i>&nbsp; Reclami</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <?php if(Yii::app()->user->can('Reclami', 'create')):?>
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi reclamo'))); ?></li>
                <?php endif;?>
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca reclami'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale Reclami <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti reclami',
            'pager' => array(
                'pageSize' => 2,
				'header' => '',
				'maxButtonCount'=>3,
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'db-reclami-grid',
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
                    'name' => 'codice',
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
				array(
                    'name' => 'data_inserimento',
                    'value' => array($model, 'getData'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'tipologia',
                    'value' => array($model, 'getTipologia'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'canale',
                    'value' => array($model, 'getCanale'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
					
                ),
                array(
                    'name' => 'unita',
                    'value' => array($model, 'getUnita'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'societa',
                    'value' => array($model, 'getSocieta'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'allegato',
                    'value' => array($model, 'getAllegato'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Vis",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-eye   bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("dbReclami/view", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza reclamo')),
                            'imageUrl' => false,
                            'visible' => 'Yii::app()->user->can("Reclami", "view")',
                        ),
                    ),
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
                            'label' => '<i class="ace-icon fa fa-edit   bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("dbReclami/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica reclamo')),
                            'imageUrl' => false,
                            'visible' => 'Yii::app()->user->can("Reclami", "update", $data->id_utente)',
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
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina reclamo')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"reclamo" ); return false }',
                            'imageUrl' => false,
                            'visible' => 'Yii::app()->user->can("Reclami", "delete", $data->id_utente)',
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "PDF",
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-file-pdf-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("dbReclami/stampa", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Scarica PDF Reclamo')),
                            'imageUrl' => false,
                            'visible' => 'Yii::app()->user->can("Reclami", "view")',
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Azioni",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-arrow-circle-right  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("ReclamiAzioni/azione", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Inserisci azione reclamo')),
                            'imageUrl' => false,
                            'visible' => 'Yii::app()->user->can("AzioniReclami", "create", $data->id_utente)',
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
                <h4 class="modal-title" ><i class='fa fa-bullhorn'></i>&nbsp;&nbsp;Ricerca reclami</h4>
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

