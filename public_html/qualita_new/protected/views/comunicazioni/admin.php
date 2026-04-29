<?php
$this->breadcrumbs = array(
    'Comunicazioni ' => array('admin'),
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
        <h2><i class='fa fa-microphone'></i>&nbsp; Comunicazioni</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                 <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi communicazione'))); ?></li>
                 <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca communicazione'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale comunicazioni <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono state inviate comunicazioni',
            
			'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i>&nbsp;',
                'nextPageLabel' => '&nbsp;<i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'communicazioni-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'data_invio',
                    'value' => array($model, 'getData'),
                    'htmlOptions' => array('class' => ''),
                    'headerHtmlOptions' => array('class' => ''),
                ),
                array(
                    'name' => 'Tipo',
                    'value' => array($model, 'getTipo'),
                    'htmlOptions' => array('class' => ''),
                    'headerHtmlOptions' => array('class' => ''),
                ),
                array(
                    'name' => 'quanti',
					'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'Messaggio',
                    'value' => array($model, 'getMessaggio'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'destinatario',
                    'value' => array($model, 'getDestinatario'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'ruolo',
                    'value' => array($model, 'getRuolo'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'struttura',
                    'value' => array($model, 'getStruttura'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                array(
                    'name' => 'tutti',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'centered hidden-480'),
                    'headerHtmlOptions' => array('class' => 'centered hidden-480'),
                    'value' => array($model, 'getTutti'),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Vedi",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-search  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("comunicazioni/view", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza communicazione')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Can",
					'htmlOptions' => array('class' => 'hidden-480 centered dark'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                   
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina communicazione')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"comunicazione" ); return false }',
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
                <h4 class="modal-title" ><i class='fa fa-microphone'></i>&nbsp;&nbsp;Ricerca comunicazione</h4>
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





