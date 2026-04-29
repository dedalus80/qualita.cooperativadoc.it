<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs = array(
    'Tipologie corsi formazione' => array('admin'),
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
        <h2><i class='fa fa-university'></i>&nbsp;Tipologie c. formazione</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip','data-html' =>'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi tipologia corso'))); ?></li>
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
            'summaryText' => 'Totale tipologie corsi <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non ci sono tipologie corsi',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'tipologie-formazione-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                'id',
                'nome',
                array(
                    'name' => 'attivo',
                    'type' => 'raw',
                    'value' => array($model, 'getAttivo'),
                    'htmlOptions' => array('class' => 'hidden-480 centered '),
                    'headerHtmlOptions' => array('class' => 'hidden-480 centered '),
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
                            'url' => 'Yii::app()->createUrl("tipologieFormazione/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifca tipologia corso')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina tipologia corso')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"tipologia_formazione" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>




