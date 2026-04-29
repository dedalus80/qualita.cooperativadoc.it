<?php

$this->breadcrumbs = array(
    html_entity_decode('Gruppi corsi formazione', ENT_QUOTES, 'UTF-8') => array('admin'),
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
        <h2><i class='fa fa-graduation-cap'></i>&nbsp;Gruppi corsi formazione </h2> 
        <div class="panel-ctrls">
            <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip','data-html' =>'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi gruppo'))); ?></li>
            </ul>
        </div>
        </div>
    </div>
    <div class="panel-body">
        
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale  <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti gruppi corsi formazione',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'formazione-gruppo-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
               
                'nome',
                array(
                    'name' => 'Iscritti',
                    'type' => 'raw',
                    'value' => array($model, 'getPartecipanti'),
					'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                array(
                    'name' => 'Utenti',
                    'type' => 'raw',
                    'value' => array($model, 'getIscritti'),
					'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark centered'),
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
                            'label' => '<i class="ace-icon fa fa-edit  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("FormazioneGruppi/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip','data-html' =>'true', 'title' => Yii::t('app', 'Modifica gruppo')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip','data-html' =>'true', 'title' => Yii::t('app', 'Elimina gruppo formazione')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"formazioneGruppo" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?> 
    </div>
</div>

<div id="box-utenti-gruppi" class="modal fade">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-user-circle'></i>&nbsp;&nbsp;Iscritti gruppo <b><span class='' id='nome-gruppo'></span></b></h4>
            </div>
            <div class="modal-body" style='height: 500px ; overflow: auto'>
                 <div class='row'>
                    <div class='col-xs-12'>
                        <div id='tabella-iscritti-gruppo'></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('Chiudi', '#', array('class' => 'btn btn-default', 'id' => 'btn-close-iscritti-gruppo')); ?>
                <?php echo CHtml::link('<i class="fa fa-plus"></i>&nbsp;&nbsp;Aggiungi', '#', array('class' => 'btn btn-orange ', 'id' => 'btn-aggiungi-iscritti-gruppo')); ?>
            </div>
        </div>
    </div>
</div>
