<?php
$this->breadcrumbs = array(
    'Corsi formazione ' => array('admin'),
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
        <h2><i class='fa fa-graduation-cap'></i><span class="hidden-480">&nbsp;Corsi </span>formazione</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca corsi'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova corso formazione'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti corsi di formazione',
            'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'azioni-formazione-grid',
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
                    'name' => 'data',
                    'type' => 'raw',
                    'value' => array($model, 'getDataCorso'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'titolo',
                    'type' => 'raw',
                    'value' => array($model, 'getCorso'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'Iscritti',
                    'type' => 'raw',
                    'value' => array($model, 'getGruppiCorso'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480  dark'),
                ),
                array(
                    'name' => 'id_gruppi',
                    'type' => 'raw',
                    'value' => array($model, 'getIscritti'),
                    'htmlOptions' => array('class' => 'centered '),
                    'headerHtmlOptions' => array('class' => 'centered dark '),
                ),
                 array(
                    'name' => 'invio_email',
                    'type' => 'raw',
                    'value' => array($model, 'getEmail'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                array(
                    'name' => 'invio_sms',
                    'type' => 'raw',
                    'value' => array($model, 'getSms'),
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
                            'url' => 'Yii::app()->createUrl("azioniFormazione/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica corso formazione')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina corso formazione')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"azioniFormazione" ); return false }',
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
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-graduation-cap'></i>&nbsp; Corsi formazione</h4>
            </div>
            <div class="modal-body" style='max-height: 500px ; overflow: auto'>
                <?php $this->renderPartial('_search', array('model' => $model)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-search"></i>&nbsp;&nbsp;Ricerca', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'search-form-int')); ?>
            </div>
        </div>
    </div>
</div>

<div id="box-gruppi-corso" class="modal fade">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-graduation-cap'></i>&nbsp;&nbsp;Gruppo  corso <b><span class='' id='nome-corso'></span></b></h4>
            </div>
            <div class="modal-body" style=''>
                 <div class='row'>
                    <div class='col-xs-12'>
                        <div id='tabella-gruppi-corso'></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('Chiudi', '#', array('class' => 'btn btn-default', 'id' => 'btn-close-gruppi-corso')); ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Aggiungi', '#', array('class' => 'btn btn-orange ', 'id' => 'btn-aggiungi-gruppi-corso')); ?>
            </div>
        </div>
    </div>
</div>

