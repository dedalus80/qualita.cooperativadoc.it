<?php
$this->breadcrumbs = array('Notifiche Inviate' => array('admin'), 'Elenco',);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});

");
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-microphone'></i>&nbsp; Notifiche Inviate</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca notifica'))); ?></li>
              <!--  <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova notifica'))); ?></li> -->
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono state inviate notifiche',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'send-push-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'type' => 'raw',
                    'name' => "data_invio",
                    'value' => array($model, 'getDataSend'),
                     'htmlOptions' => array('class' => ' '),
                    'headerHtmlOptions' => array('class' => ''),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'unita_operativa',
                    'value' => array($model, 'getCentro'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'stato',
                    'value' => array($model, 'getStato'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'sezione',
                    'value' => array($model, 'getSezione'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'sender',
                    'type' => 'raw',
                    'value' => array($model, 'getSender'),
                    'htmlOptions' => array('class' => 'hidden-480 '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 '),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'testo',
                    'value' => array($model, 'getText'),
                    
                ),
            ),
        ));
        ?>
    </div>
</div>

<div id="testo-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 300px;">
        <div class="modal-content">
            <div class="modal-header"> <h4 class="modal-title" ><i class='fa fa-microphone'></i>&nbsp;Invio notifiche push</h4> </div>
            <div class="modal-body" id="testo-sms"> </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-check"></i>&nbsp;&nbsp;Chiudi', '#', array('class' => 'btn btn-default btn-undo-box', 'data-refer' => 'testo-box')); ?>
            </div>
        </div>
    </div>
</div>
<div id="delivery-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header"> <h4 class="modal-title" ><i class='fa fa-tasks'></i>&nbsp;Notifiche invio push</h4> </div>
            <div class="modal-body">
                <div id="have_delivery"style="display: none">
                    <div class='row' style='margin-bottom: 20px'><div class='col-xs-12' id='delivery_count'></div></div>
                    <table id="table_delivery" class='table table-striped table-bordered dataTable'>
                        <thead>
                            <tr>
                                <th>Destinatario</th>
                                <th>Soggiorno</th>
                                <th>Numero</th>
                                <th>Data</th>
                                <th class="centered">Stato</th>
                            </tr>
                        </thead>
                        <tbody id="table_body_delivery">

                        </tbody>
                    </table>
                </div>
                <div id="no_delivery" style="display: none"> Non sono presenti notifiche di riccezzione per questo invio </div>
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-check"></i>&nbsp;&nbsp;Chiudi', '#', array('class' => 'btn btn-default btn-undo-box', 'data-refer' => 'delivery-box')); ?>
            </div>
        </div>
    </div>
</div>

<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-microphone'></i>&nbsp; Invii notifiche</h4>
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
