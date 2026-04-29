<?php
$this->breadcrumbs = array(
    'Tag utenti' => array('admin'),
    'Gestione',
);
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-tags'></i>&nbsp;Tag utenti</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi tag'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-link"></i>', './assegna', array('class' => 'button-icon button-icon-orange', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Assegna tag a utenti'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'itemsCssClass' => 'table table-striped table-bordered dataTable',
            'summaryText' => 'Totale tag <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono presenti tag',
            'pager' => array(
                'pageSize' => 2,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>',
                'htmlOptions' => array('class' => 'pager_class'),
            ),
            'id' => 'utenti-tags-grid',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'nome',
                    'type' => 'raw',
                    'value' => '
                        "<span class=" . "\"label label-primary tag-label-inline tag-label-primary\"" . ">" . CHtml::encode($data->nome) . "</span>"
                    ',
                ),
                array(
                    'header' => 'Utenti associati',
                    'type' => 'raw',
                    'value' => '
                        "<span class=" . "\"label label-primary tag-label-inline tag-label-soft\"" . ">" . count($data->utenti) . "</span>"
                    ',
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => 'Mod',
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array(
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-edit bigger-110 icon-only btn btn-circle circle-blue"></i>',
                            'url' => 'Yii::app()->createUrl("utentiTags/update", array("id"=>$data->id))',
                            'options' => array('class' => 'mycbv dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Modifica tag')),
                            'imageUrl' => false,
                        ),
                    ),
                ),
                array(
                    'class' => 'CButtonColumn',
                    'header' => 'Can',
                    'headerHtmlOptions' => array('class' => 'centered dark'),
                    'template' => '{tmp}',
                    'updateButtonImageUrl' => false,
                    'buttons' => array(
                        'tmp' => array(
                            'label' => '<i class="ace-icon fa fa-trash-o bigger-110 icon-only btn btn-circle circle-blue"></i>',
                            'url' => '$data->id',
                            'visible' => 'true',
                            'options' => array('class' => 'del_btn dark', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina tag')),
                            'click' => 'js: function(e){ delDato($(this).attr("href"),"utentiTag" ); return false }',
                            'imageUrl' => false,
                        ),
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>
