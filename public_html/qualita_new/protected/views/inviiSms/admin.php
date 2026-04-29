<?php
$this->breadcrumbs = array(
    'Sms inviati ' => array('admin'),
    'Storico',
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
        <h2><i class='fa fa-comment'></i><span class="hidden-480">&nbsp;Sms </span>inviati</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca sms'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuovo sms'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti sms inviati',
            'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'invii-sms-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => "data_invio",
                    'value' => array($model, 'getDataSend'),
                ),
                array(
                    'name' => 'quanti',
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                
                array(
                    'name' => 'tipo',
                    'value' => array($model, 'getTipoSend'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'name' => 'destinatari',
                    'value' => array($model, 'getDestinatari'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'name' => 'testo',
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'tutti',
                    'value' => array($model, 'getAll'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'centro',
                    'value' => array($model, 'getCentro'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'periodo',
                    'value' => array($model, 'getPeriodo'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'turno',
                    'value' => array($model, 'getTurno'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Notifiche",
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-tasks  bigger-110 icon-only  btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'delivery sendSms', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Notifiche Sms')),
                            'click' => 'js: function(e){ getDelivery($(this).attr("href")); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
                
            ),
        ));
        ?>
    </div>
</div>


<div id="delivery-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-tasks'></i>&nbsp; Notifiche invio <b><span class='' id='totale-delivery'></span></b></h4>
            </div>
            <div class="modal-body" style='max-height: 500px ; overflow: auto'>
                <div id='table-delivery' > </div>  
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('Chiudi', '#', array('class' => 'btn btn-default', 'id' => 'sendSms_undo')); ?>
            </div>
        </div>
    </div>
</div>


<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-comment'></i>&nbsp; Invii sms</h4>
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
