<?php
$this->breadcrumbs = array('Questionari Formazione' => array('admin'), 'Gestisci',);
Yii::app()->clientScript->registerScript('search', " $('.search-button').click(function(){	$('.search-form').toggle();	return false;});");
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionari Formazione</h2>
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
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i>',
                'nextPageLabel' => '<i class="ace-icon fa fa-angle-right"></i>',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'questionario-formazione-grid',
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
                    'name' => 'data_corso',
                    'value' => array($model, 'getDataCorso'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'titolo',
                   	'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'tipo_corso',
                    'value' => array($model, 'getTipoCorso'),
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'nome',
                   	'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
				array(
                    'name' => 'cognome',
                   	'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
				array(
                    'name' => 'ente_corso',
                   	'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'giudizio',
                    'value' => array($model, 'getGiudizio'),
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
                            'url' => 'Yii::app()->createUrl("questionarioFormazione/view", array("id"=>$data->id))',
                            'options' => array('class' => 'myview dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza questionario')),
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Mod",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-edit bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("questionarioFormazione/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifca questionario')),
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
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina questionario')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"questionario_formazione" ); return false }',
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
