<?php
/* @var $this QuestionnaireVersionController */
/* @var $dataProvider CActiveDataProvider */
/* @var $questionnaire_id integer */

// I breadcrumbs sono già impostati nel controller
?>

<div class="page-header">
    <h1><i class="fa fa-list"></i> 
        <?php if ($questionnaire_id !== null): ?>
            Versioni del Questionario
        <?php else: ?>
            Elenco Versioni Questionari
        <?php endif; ?>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">
                    <?php if ($questionnaire_id !== null): ?>
                        Lista Versioni del Questionario
                    <?php else: ?>
                        Lista Versioni
                    <?php endif; ?>
                </h3>
                <div class="btn-group pull-right">
                    <?php if ($questionnaire_id !== null): ?>
                        <?php echo CHtml::link('<i class="fa fa-plus"></i> Crea Nuova Versione', array('create', 'questionnaire_id'=>$questionnaire_id), array('class'=>'btn btn-success btn-sm')); ?>
                    <?php else: ?>
                        <?php echo CHtml::link('<i class="fa fa-plus"></i> Crea Nuova Versione', array('create', 'questionnaire_id'=>1), array('class'=>'btn btn-success btn-sm')); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="panel-body">

                <?php 
                // Costruisci l'array delle colonne dinamicamente
                $columns = array(
                    'id',
                    array(
                        'header'=>'Versione',
                        'name'=>'version_number',
                    ),
                );
                
                // Aggiungi la colonna questionario solo se non stiamo filtrando per un questionario specifico
                if ($questionnaire_id === null) {
                    $columns[] = array(
                        'header'=>'Questionario',
                        'value'=>'$data->questionnaire->title',
                    );
                }
                
                $columns = array_merge($columns, array(
                    array(
                        'header'=>'Stato',
                        'type'=>'raw',
                        'value'=>'$data->isActive() ? \'<span class="badge badge-success">Attiva</span>\' : \'<a href="\'.Yii::app()->createUrl("questionnaireVersion/setActive", array("id"=>$data->id)).\'" class="badge badge-secondary" style="text-decoration:none; color:white;" onclick="return confirm(\\"Vuoi rendere attiva questa versione? Le altre saranno disattivate.\\");" title="Clicca per attivare">Non attiva <i class="fa fa-check-circle"></i></a>\'',
                        'htmlOptions'=>array('class'=>'text-center'),
                    ),
                    array(
                        'header'=>'Compilazioni',
                        'type'=>'raw',
                        'value'=>'$data->hasResponses() ? \'<a href="\'.Yii::app()->createUrl("questionnaire/submissions", array("id"=>$data->questionnaire_id, "version_id"=>$data->id)).\'" class="badge badge-info" style="text-decoration:none; color:white;" title="Clicca per visualizzare le compilazioni">Con risposte <i class="fa fa-list-alt"></i></a>\' : \'<span class="badge badge-light">Senza risposte</span>\'',
                        'htmlOptions'=>array('class'=>'text-center'),
                    ),
                    'description',
                    array(
                        'header'=>'Creato il',
                        'name'=>'created_at',
                        'value'=>'DateTimeHelper::formatItalianDateTime($data->created_at)',
                    ),
                    array(
                        'class'=>'CButtonColumn',
                        'template'=>'{view} {update} {delete} {preview} {clone}',
                        'buttons'=>array(
                            'clone'=>array(
                                'label'=>'<i class="fa fa-copy"></i>',
                                'options'=>array('title'=>'Clona versione','class'=>'btn btn-xs btn-default'),
                                'url'=>'Yii::app()->createUrl("questionnaireVersion/cloneVersion", array("id"=>$data->id))',
                                'imageUrl'=>false,
                            ),
                            'view'=>array(
                                'label'=>'<i class="fa fa-eye"></i>',
                                'options'=>array('title'=>'Visualizza dettagli','class'=>'btn btn-xs btn-info'),
                                'imageUrl'=>false,
                            ),
                            'update'=>array(
                                'label'=>'<i class="fa fa-pencil"></i>',
                                'options'=>array('title'=>'Modifica versione','class'=>'btn btn-xs btn-warning'),
                                'imageUrl'=>false,
                            ),
                            'preview' => array(
                                'label'=>'<i class="fa fa-search"></i>',
                                'imageUrl'=>false,
                                'options'=>array('title'=>'Anteprima','class'=>'btn btn-xs btn-primary preview-btn'),
                                'url'=>'Yii::app()->createUrl("questionnaireVersion/preview", array("id"=>$data->id,"modal"=>true))',
                            ),
                            'delete'=>array(
                                'label'=>'<i class="fa fa-trash"></i>',
                                'options'=>array('title'=>'Elimina versione','class'=>'btn btn-xs btn-danger'),
                                'imageUrl'=>false,
                                'visible'=>'!$data->hasResponses() && !$data->isActive()',
                            ),
                        ),
                        'htmlOptions'=>array('style'=>'width:120px; text-align:center;'),
                    ),
                ));
                
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'questionnaire-version-grid',
                    'dataProvider'=>$dataProvider,
                    'summaryText'=>'<div class="summary">Mostrati {start}-{end} di {count} risultati</div>',
                    'emptyText'=>'<p>Nessuna versione trovata.</p>',
                    'itemsCssClass'=>'table table-striped table-bordered table-hover',
                    'pagerCssClass'=>'pagination',
                    'pager'=>array(
                        'header'=>'',
                        'htmlOptions'=>array('class'=>'pagination'),
                    ),
                    'columns'=>$columns,
                )); 
                ?>

            </div>
        </div>

    </div>
</div>

<!-- Modale Bootstrap -->
<!-- Modale Bootstrap per anteprima questionario -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title" id="previewModalLabel">
          <i class="fa fa-eye"></i> Anteprima Questionario
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="previewModalContent">
        <!-- Spinner iniziale -->
        <div class="text-center text-muted" style="padding: 30px;">
          <i class="fa fa-spinner fa-spin fa-2x"></i>
          <p>Caricamento in corso...</p>
        </div>
      </div>

    </div>
  </div>
</div>


<?php
Yii::app()->clientScript->registerScript('previewModalScript', <<<JS
$(document).on('click', '.preview-btn', function(e){
    e.preventDefault();
    var url = $(this).attr('href');

    // Spinner iniziale
    $('#previewModalContent').html(`
        <div class="text-center text-muted" style="padding: 30px;">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
            <p>Caricamento in corso...</p>
        </div>
    `);

    $('#previewModal').modal('show');

    $.get(url, function(data){
        $('#previewModalContent').html(data);
    }).fail(function(){
        $('#previewModalContent').html('<p class="text-danger">Errore durante il caricamento del contenuto.</p>');
    });
});
JS
, CClientScript::POS_END);

?>
