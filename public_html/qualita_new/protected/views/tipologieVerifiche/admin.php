<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs = array(
    html_entity_decode('Tipologie verifiche inspettive', ENT_QUOTES, 'UTF-8') => array('admin'),
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
        <h2><i class='fa fa-cogs'></i>&nbsp;Tipologie verifiche <span class="hidden-480">ispettive</span></h2>
        <div class="panel-ctrls">
            <div class="panel-ctrls">
                <ul class="demo-btns">
                    <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-html' => 'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi tipologia verifica'))); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="panel-body">

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non ci sono tipologie verifiche operative',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'qualita-scadenze-tipologie-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'type' => 'raw',
                    'name' => 'codice',
                    'htmlOptions' => array('class' => ' hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                ),
                'nome',
                array(
                    'type' => 'raw',
                    'name' => 'colore',
                    'value' => array($model, 'getColore'),
                    'htmlOptions' => array('class' => 'centered hidden-480'),
                    'headerHtmlOptions' => array('class' => 'centered hidden-480'),
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
                            'url' => 'Yii::app()->createUrl("TipologieVerifiche/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-html' => 'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifca tipologia verifica')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-html' => 'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina tipologia verifica')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"tipologieVerifiche" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'type' => 'raw',
                    'name' => 'is_hidden',
                    'header' => 'Nascosto',
                    'htmlOptions' => array('class' => ' hidden-480'),
                    'headerHtmlOptions' => array('class' => 'hidden-480'),
                    'value' => '$data->is_hidden=="N"?"NO":"SI"',
                )
            ),
        ));
        ?>
    </div>
</div>



