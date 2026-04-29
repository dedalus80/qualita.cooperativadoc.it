<?php
$this->breadcrumbs = array('Email Inviati' => array('admin'), 'Elenco',);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

");
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-envelope'></i>&nbsp; Email Inviate</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><!--<?php echo CHtml::link('<i class="fa fa-download"></i><span class="hidden-480">&nbsp;Esporta</span>', array('sendSms/esporta'), array('class' => 'btn btn-default btn-sm  ', 'id' => '')); ?>--></li>
                <li><?php echo CHtml::link('<i class="fa fa-search"></i><span class="hidden-480">&nbsp;&nbsp;Ricerca</span>', '#', array('class' => 'btn btn-default btn-sm  ', 'id' => 'box-form-btn')); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none" id="search-form-box">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
        </div><!-- search-form -->
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale email <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non ci sono email inviati',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'send-email-grid',
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
                    'name' => 'effettuati',
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                array(
                    'name' => 'tipo',
                    'value' => array($model, 'getTipoSend'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'name' => 'destinatari',
                    'value' => array($model, 'getDestinatari'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                 array(
                    'type' => 'raw',
                    'name' => 'tutti',
                    'value' => array($model, 'getAll'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'centro',
                    'value' => array($model, 'getCentro'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'periodo',
                    'value' => array($model, 'getPeriodo'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'turno',
                    'value' => array($model, 'getTurno'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Notifiche",
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-tasks  bigger-110 icon-only"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'delivery', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Notifiche Email')),
                            'click' => 'js: function(e){ getDeliveryEmail($(this).attr("href")); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Vedi",
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-search  bigger-110 icon-only"></i>',
                            'url' => 'Yii::app()->createUrl("sendEmail/view", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza Messaggio')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>
<div id="sendSms_box" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id='delDato_title' >Notifiche Invio</h4>
            </div>
            <div class="modal-body">
                <div id="have_delivery"style="display: none">
                    <div class='row' style='margin-bottom: 20px'>
                        <div class='col-xs-12' id='delivery_count'>     
                        </div>
                    </div>
                    <table id="table_delivery" class='table table-striped table-bordered dataTable'>
                        <thead>
                            <tr>
                                <th>Destinatario</th>
                                <th class="centered">Consegnato</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_delivery">

                        </tbody>
                    </table>
                </div>
                <div id="no_delivery" style="display: none">
                    Non sono presenti notifiche di riccezzione per questo invio
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="sendSms_undo" >Chiudi</button>
            </div>
        </div>
    </div>
</div>