<?php
$this->breadcrumbs = array('Consumi sostanze chimiche' => array('admin'), 'Gestisci',);

Yii::app()->clientScript->registerScript('search', " $('.search-button').click(function(){	$('.search-form').toggle();	return false;});");
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-flask'></i>&nbsp; Consumi sostanze chimiche</h2>
       <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi consumi'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca consumi'))); ?></li>
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
            'summaryText' => 'Totale consumi <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non presenti consumi sostanze chimiche per le strutture',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'utenze-chimici-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'anno',
                ),
                array(
                    'name' => 'struttura',
                    'value' => array($model, 'getStruttura'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'name' => 'superficie',
                    'value' => array($model, 'getSuperficie'),
                    'htmlOptions' => array('class' => 'hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 dark'),
                ),
                array(
                    'name' => 'totale_euro',
                    'value' => array($model, 'getTotaleCosti'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                array(
                    'name' => 'totale_litri',
                    'value' => array($model, 'getTotale'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                array(
                    'name' => 'ospiti',
                    'value' => array($model, 'getOspiti'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
               array(
                    'name' => 'media_euro_superfice',
                    'value' => array($model, 'getEuroSuperficie'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ), 
                array(
                    'name' => 'media_euro_ospiti',
                    'value' => array($model, 'getEuroOspiti'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                 array(
                    'name' => 'media_litri_ospiti',
                    'value' => array($model, 'getLitriOspiti'),
                    'htmlOptions' => array('class' => 'hidden-480 centered'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
                ),
                 array(
                    'name' => 'media_litri_superfice',
                    'value' => array($model, 'getLitriSuperficie'),
                    'htmlOptions' => array('class' => 'hidden-480 centered dark'),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered dark'),
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
                            'url' => 'Yii::app()->createUrl("utenzeChimici/view", array("id"=>$data->id))',
                            'options' => array('class' => 'myview dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza consumi sostanze chimiche struttura')),
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
                            'label' => '<i class="ace-icon fa fa-edit  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("utenzeChimici/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica consumi sostanze chimiche struttura')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina consumi sostanze chimiche struttura')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"utenze_chimici" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => "Esporta",
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array
                        (
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-download  bigger-110 icon-only btn  btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("utenzeChimici/scarica", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Scarica consumi sostanze chimiche struttura')),
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
                <h4 class="modal-title" ><i class='fa fa-tint'></i>&nbsp;&nbsp;Ricerca consumi</h4>
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



