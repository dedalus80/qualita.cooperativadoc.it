<?php
/* @var $this QuestionOptionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Domande'=>array('question/index'),
    'Opzioni',
);
?>

<div class="page-header">
    <h1><i class="fa fa-list"></i> Elenco Opzioni</h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Lista Opzioni</h3>
            </div>
            <div class="panel-body">

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'question-option-grid',
                    'dataProvider'=>$dataProvider,
                    'summaryText'=>'<div class="summary">Mostrati {start}-{end} di {count} risultati</div>',
                    'emptyText'=>'<p>Nessuna opzione trovata.</p>',
                    'itemsCssClass'=>'table table-striped table-bordered table-hover',
                    'pagerCssClass'=>'pagination',
                    'pager'=>array(
                        'header'=>'',
                        'htmlOptions'=>array('class'=>'pagination'),
                    ),
                    'columns'=>array(
                        'id',
                        'option_text',
                        'value',
                        'order',
                        array(
                            'class'=>'CButtonColumn',
                            'template'=>'{view} {update} {delete}',
                            'buttons'=>array(
                                'view'=>array(
                                    'label'=>'<i class="fa fa-eye"></i>',
                                    'options'=>array('title'=>'Visualizza','class'=>'btn btn-xs btn-info'),
                                    'imageUrl'=>false,
                                ),
                                'update'=>array(
                                    'label'=>'<i class="fa fa-pencil"></i>',
                                    'options'=>array('title'=>'Aggiorna','class'=>'btn btn-xs btn-warning'),
                                    'imageUrl'=>false,
                                ),
                                'delete'=>array(
                                    'label'=>'<i class="fa fa-trash"></i>',
                                    'options'=>array('title'=>'Elimina','class'=>'btn btn-xs btn-danger'),
                                    'imageUrl'=>false,
                                ),
                            ),
                            'htmlOptions'=>array('style'=>'width:120px; text-align:center;'),
                        ),
                    ),
                )); ?>

            </div>
        </div>

    </div>
</div>
