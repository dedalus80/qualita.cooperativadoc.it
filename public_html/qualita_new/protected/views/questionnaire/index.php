<?php
/* @var $this QuestionnaireController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Questionari',
);
?>

<div class="page-header">
    <h1><i class="fa fa-list"></i> Elenco Questionari</h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Lista Questionari</h3>
                <!--<div class="btn-group pull-right">
                    <?php //echo CHtml::link('<i class="fa fa-plus"></i> Crea Nuovo Questionario', array('create'), array('class'=>'btn btn-success btn-sm')); ?>
                </div>-->



                <div class="panel-ctrls">
                    <ul class="demo-btns">
                        <!--<li><a class="open-search button-icon button-icon-orange" id="open-search-btn" rel="tooltip" data-toggle="tooltip" title="" href="#" data-original-title="Ricerca Clienti"><i class="fa fa-search"></i></a></li>-->
                        <li> <?php echo CHtml::link('<i class="fa fa-book"></i>', array('documentation'), array('class'=>'button-icon button-icon-purple', 'rel'=>'tooltip', 'data-toggle'=>'tooltip', 'title'=>'Documentazione Sistema Questionari')); ?></li>
                        <li> <?php echo CHtml::link('<i class="fa fa-list-alt"></i>', array('submissions'), array('class'=>'button-icon button-icon-blue', 'rel'=>'tooltip', 'data-toggle'=>'tooltip', 'title'=>'Visualizza Tutte le Compilazioni')); ?></li>
                        <li> <?php echo CHtml::link('<i class="fa fa-plus"></i>', array('create'), array('class'=>'button-icon button-icon-green', 'rel'=>'tooltip', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Crea Nuovo Questionario'))); ?></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'questionnaire-grid',
                    'dataProvider'=>$dataProvider,
                    'summaryText'=>'<div class="summary">Mostrati {start}-{end} di {count} risultati</div>',
                    'emptyText'=>'<p>Nessun questionario trovato.</p>',
                    'itemsCssClass'=>'table table-striped table-bordered table-hover',
                    'pagerCssClass'=>'pagination',
                    'pager'=>array(
                        'header'=>'',
                        'htmlOptions'=>array('class'=>'pagination'),
                    ),
                    'columns'=>array(
                        array(
                            'header'=>'ID',
                            'name'=>'id',
                            'htmlOptions'=>array('width'=>'50px'),
                        ),
                        array(
                            'header'=>'Titolo',
                            'name'=>'title',
                            'type'=>'raw',
                            'value'=>'CHtml::link(CHtml::encode($data->title), array("view","id"=>$data->id))',
                        ),
                        array(
                            'header'=>'Cliente',
                            'name'=>'client_id',
                            'value'=>'$data->client ? $data->client->nome : "-"',
                        ),
                        array(
                            'header'=>'Pubblico',
                            'name'=>'is_public',
                            'value'=>'$data->is_public ? "Sì" : "No"',
                            'htmlOptions'=>array('width'=>'80px','class'=>'text-center'),
                        ),
                        array(
                            'header'=>'Risposte',
                            'name'=>'has_responses',
                            'type'=>'raw',
                            'value'=>'QuestionnaireParticipant::model()->exists("questionnaire_id = :questionnaire_id", array(":questionnaire_id" => $data->id)) ? 
                                "<span class=\"label label-warning\"><i class=\"fa fa-exclamation-triangle\"></i> Ha risposte</span>" : 
                                "<span class=\"label label-success\"><i class=\"fa fa-check\"></i> Nessuna risposta</span>"',
                            'htmlOptions'=>array('width'=>'120px','class'=>'text-center'),
                        ),
                        array(
                            'header'=>'Creato il',
                            'name'=>'created_at',
                            'value'=>'DateTimeHelper::formatItalianDateTime($data->created_at)',
                        ),
                        array(
                            'class'=>'CButtonColumn',
                            'template'=>'{view} {update} {submissions} {delete}',
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
                                'submissions'=>array(
                                    'label'=>'<i class="fa fa-list-alt"></i>',
                                    'url'=>'Yii::app()->createUrl("questionnaire/submissions", array("id"=>$data->id))',
                                    'options'=>array('title'=>'Visualizza Compilazioni','class'=>'btn btn-xs btn-success'),
                                    'imageUrl'=>false,
                                ),
                                'delete'=>array(
                                    'label'=>'<i class="fa fa-trash"></i>',
                                    'options'=>array('title'=>'Elimina','class'=>'btn btn-xs btn-danger'),
                                    'imageUrl'=>false,
                                    'visible'=>'!QuestionnaireParticipant::model()->exists("questionnaire_id = :questionnaire_id", array(":questionnaire_id" => $data->id))',
                                ),
                            ),
                            'htmlOptions'=>array('style'=>'width:130px; text-align:center;'),
                        ),
                    ),
                )); ?>

            </div> <!-- panel-body -->
        </div> <!-- panel -->

    </div> <!-- col -->
</div> <!-- row -->
