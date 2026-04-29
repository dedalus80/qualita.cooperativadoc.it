<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs = array(
    html_entity_decode('Categorie corsi formazione', ENT_QUOTES, 'UTF-8') => array('admin'),
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
        <h2><i class='fa fa-graduation-cap'></i>&nbsp;Categorie corsi formazione </h2> 
        <div class="panel-ctrls">
            <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip','data-html' =>'true', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi categoria'))); ?></li>
            </ul>
        </div>
        </div>
    </div>
    <div class="panel-body">
        
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale  <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti categorie corsi formazione',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
            'id' => 'formazione-categorie-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
               
                'nome',
               
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
                            'url' => 'Yii::app()->createUrl("FormazioneCategorie/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip','data-html' =>'true', 'title' => Yii::t('app', 'Modifica categoria')),
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
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip','data-html' =>'true', 'title' => Yii::t('app', 'Elimina categoria formazione')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"formazioneCategoria" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?> 
    </div>
</div>

