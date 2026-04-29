<?php
/* @var $this QuestionnaireController */
/* @var $dataProvider CActiveDataProvider */
/* @var $versions QuestionnaireVersion[] */
/* @var $questionnaireId int */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Compilazioni',
);
?>

<style>
.sortable-header {
    color: #337ab7;
    text-decoration: none;
}
.sortable-header:hover {
    color: #23527c;
    text-decoration: underline;
}
.sortable-header.active {
    font-weight: bold;
    color: #23527c;
}
</style>



<div class="page-header">
    <h1><i class="fa fa-list-alt"></i> Compilazioni Questionari</h1>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Filtri -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> Filtri</h3>
            </div>
            <div class="panel-body">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'method' => 'GET',
                    'action' => Yii::app()->createUrl('questionnaire/submissions'),
                    'htmlOptions' => array('class' => 'form-horizontal'),
                )); ?>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Questionario:</label>
                            <select name="questionnaire_id" id="questionnaire-select" class="form-control">
                                <option value="">Tutti i questionari</option>
                                <?php foreach ($questionnaires as $questionnaire): ?>
                                    <option value="<?php echo $questionnaire->id; ?>" <?php echo ($questionnaireId == $questionnaire->id) ? 'selected' : ''; ?>>
                                        <?php echo CHtml::encode($questionnaire->title); ?>
                                        <?php if ($questionnaire->client): ?>
                                            (<?php echo CHtml::encode($questionnaire->client->nome); ?>)
                                        <?php endif; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Versione:</label>
                            <select name="version_id" id="version-select" class="form-control">
                                <option value="">Tutte le versioni</option>
                                <?php foreach ($versions as $version): ?>
                                    <option value="<?php echo $version->id; ?>" <?php echo (isset($_GET['version_id']) && $_GET['version_id'] == $version->id) ? 'selected' : ''; ?>>
                                        <?php if ($questionnaireId): ?>
                                            v<?php echo $version->version_number; ?>
                                        <?php else: ?>
                                            <?php echo ($version->questionnaire ? $version->questionnaire->title : 'Questionario #' . $version->id) . ' - v' . $version->version_number; ?>
                                        <?php endif; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data da:</label>
                            <input type="date" name="date_from" class="form-control" value="<?php echo isset($_GET['date_from']) ? $_GET['date_from'] : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data a:</label>
                            <input type="date" name="date_to" class="form-control" value="<?php echo isset($_GET['date_to']) ? $_GET['date_to'] : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Indirizzo IP:</label>
                            <input type="text" name="ip_address" class="form-control" value="<?php echo isset($_GET['ip_address']) ? CHtml::encode($_GET['ip_address']) : ''; ?>" placeholder="Es: 192.168.1.1">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-offset-0">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filtra</button>
                                <a href="<?php echo Yii::app()->createUrl('questionnaire/submissions'); ?>" class="btn btn-default"><i class="fa fa-times"></i> Reset</a>
                                <a href="<?php echo Yii::app()->createUrl('questionnaire/exportSubmissions', array_merge(array('questionnaire_id' => $questionnaireId, 'export' => 'excel'), $_GET)); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Esporta Excel</a>
                                <a href="<?php echo Yii::app()->createUrl('questionnaire/exportSubmissions', array_merge(array('questionnaire_id' => $questionnaireId, 'export' => 'csv'), $_GET)); ?>" class="btn btn-info"><i class="fa fa-file-text-o"></i> Esporta CSV</a>
                                <?php if ($questionnaireId): ?>
                                    <a href="<?php echo Yii::app()->createUrl('questionnaire/deleteSubmissions', array('id' => $questionnaireId)); ?>" class="btn btn-warning" onclick="return confirm('ATTENZIONE: Questa azione eliminerà definitivamente tutte le compilazioni di questo questionario. Questa operazione non può essere annullata. Sei sicuro di voler procedere?');"><i class="fa fa-trash-o"></i> Elimina Tutte le Compilazioni</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php $this->endWidget(); ?>
            </div>
        </div>

        <!-- Tabella risultati -->
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Risultati Compilazioni</h3>
                <div class="panel-ctrls">
                    <ul class="demo-btns">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('questionnaire/exportSubmissions', array_merge(array('id' => $questionnaireId, 'export' => 'excel'), $_GET)); ?>" class="button-icon button-icon-green" rel="tooltip" data-toggle="tooltip" title="Esporta Excel">
                                <i class="fa fa-file-excel-o"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('questionnaire/submissions'); ?>" class="button-icon button-icon-blue" rel="tooltip" data-toggle="tooltip" title="Tutti i questionari">
                                <i class="fa fa-list"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'submissions-grid',
                    'dataProvider'=>$dataProvider,
                    'summaryText'=>'<div class="summary">Mostrati {start}-{end} di {count} risultati</div>',
                    'emptyText'=>'<p>Nessuna compilazione trovata.</p>',
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
                            'htmlOptions'=>array('width'=>'60px'),
                        ),
                        array(
                            'header'=>'Questionario',
                            'name'=>'questionnaire_id',
                            'value'=>'$data->questionnaire ? $data->questionnaire->title : "-"',
                            'htmlOptions'=>array('width'=>'200px'),
                            'headerHtmlOptions'=>array('style'=>'cursor:pointer;'),
                            'header'=>CHtml::link('Questionario', Yii::app()->createUrl('questionnaire/submissions', array_merge($_GET, array('sort'=>'questionnaire.title', 'direction'=>($_GET['sort']=='questionnaire.title' && $_GET['direction']=='ASC') ? 'DESC' : 'ASC'))), array('class'=>'sortable-header' . (isset($_GET['sort']) && $_GET['sort']=='questionnaire.title' ? ' active' : ''))),
                        ),
                        array(
                            'header'=>'Versione',
                            'name'=>'version_id',
                            'value'=>'$data->version ? "v" . $data->version->version_number : "-"',
                            'htmlOptions'=>array('width'=>'80px', 'class'=>'text-center'),
                            'headerHtmlOptions'=>array('style'=>'cursor:pointer;'),
                            'header'=>CHtml::link('Versione', Yii::app()->createUrl('questionnaire/submissions', array_merge($_GET, array('sort'=>'version.version_number', 'direction'=>($_GET['sort']=='version.version_number' && $_GET['direction']=='ASC') ? 'DESC' : 'ASC'))), array('class'=>'sortable-header' . (isset($_GET['sort']) && $_GET['sort']=='version.version_number' ? ' active' : ''))),
                        ),
                        array(
                            'header'=>'Nome',
                            'name'=>'name',
                            'value'=>'$data->name ? $data->name : "-"',
                            'htmlOptions'=>array('width'=>'120px'),
                        ),
                        array(
                            'header'=>'Cognome',
                            'name'=>'surname',
                            'value'=>'$data->surname ? $data->surname : "-"',
                            'htmlOptions'=>array('width'=>'120px'),
                        ),
                        array(
                            'header'=>'Email',
                            'name'=>'email',
                            'value'=>'$data->email ? $data->email : "-"',
                            'htmlOptions'=>array('width'=>'180px'),
                        ),
                        array(
                            'header'=>'Tipologia',
                            'name'=>'tipologia_soggiorno_id',
                            'value'=>'$data->tipologiaSoggiorno ? $data->tipologiaSoggiorno->tipologia : "-"',
                            'htmlOptions'=>array('width'=>'150px'),
                            'headerHtmlOptions'=>array('style'=>'cursor:pointer;'),
                            'header'=>CHtml::link('Tipologia', Yii::app()->createUrl('questionnaire/submissions', array_merge($_GET, array('sort'=>'tipologiaSoggiorno.tipologia', 'direction'=>($_GET['sort']=='tipologiaSoggiorno.tipologia' && $_GET['direction']=='ASC') ? 'DESC' : 'ASC'))), array('class'=>'sortable-header' . (isset($_GET['sort']) && $_GET['sort']=='tipologiaSoggiorno.tipologia' ? ' active' : ''))),
                        ),
                        array(
                            'header'=>'Soggiorno',
                            'name'=>'soggiorno_id',
                            'value'=>'$data->soggiorno ? $data->soggiorno->nome : "-"',
                            'htmlOptions'=>array('width'=>'150px'),
                            'headerHtmlOptions'=>array('style'=>'cursor:pointer;'),
                            'header'=>CHtml::link('Soggiorno', Yii::app()->createUrl('questionnaire/submissions', array_merge($_GET, array('sort'=>'soggiorno.nome', 'direction'=>($_GET['sort']=='soggiorno.nome' && $_GET['direction']=='ASC') ? 'DESC' : 'ASC'))), array('class'=>'sortable-header' . (isset($_GET['sort']) && $_GET['sort']=='soggiorno.nome' ? ' active' : ''))),
                        ),
                        array(
                            'header'=>'Data Compilazione',
                            'name'=>'created_at',
                            'value'=>'DateTimeHelper::formatItalianDateTime($data->created_at)',
                            'htmlOptions'=>array('width'=>'140px'),
                        ),
                        array(
                            'class'=>'CButtonColumn',
                            'template'=>'{view} {delete}',
                            'buttons'=>array(
                                'view'=>array(
                                    'label'=>'<i class="fa fa-eye"></i>',
                                    'url'=>'Yii::app()->createUrl("questionnaire/viewSubmission", array("id"=>$data->id))',
                                    'options'=>array('title'=>'Visualizza Dettagli','class'=>'btn btn-xs btn-info'),
                                    'imageUrl'=>false,
                                ),
                                'delete'=>array(
                                    'label'=>'<i class="fa fa-trash"></i>',
                                    'url'=>'Yii::app()->createUrl("questionnaire/deleteSingleSubmission", array("id"=>$data->id))',
                                    'options'=>array('title'=>'Elimina Compilazione','class'=>'btn btn-xs btn-danger'),
                                    'imageUrl'=>false,
                                    'click'=>'function(){return confirm("Sei sicuro di voler eliminare questa compilazione? Questa azione non può essere annullata.");}',
                                ),
                            ),
                            'htmlOptions'=>array('style'=>'width:120px; text-align:center;'),
                        ),
                    ),
                )); ?>

            </div> <!-- panel-body -->
        </div> <!-- panel -->

    </div> <!-- col -->
</div> <!-- row -->

<script type="text/javascript">
$(document).ready(function() {
    // Gestione select dinamica delle versioni
    $('#questionnaire-select').change(function() {
        var questionnaireId = $(this).val();
        var versionSelect = $('#version-select');
        
        // Reset della select delle versioni
        versionSelect.html('<option value="">Caricamento...</option>');
        
        // Chiamata AJAX per ottenere le versioni del questionario selezionato
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("questionnaire/getVersions"); ?>',
            type: 'GET',
            data: { questionnaire_id: questionnaireId },
            dataType: 'json',
            success: function(response) {
                versionSelect.html(response.options);
            },
            error: function() {
                versionSelect.html('<option value="">Errore nel caricamento</option>');
            }
        });
    });
    
    // Auto-submit del form quando cambia il questionario (opzionale)
    $('#questionnaire-select').change(function() {
        // Reset della versione selezionata quando cambia il questionario
        $('#version-select').val('');
    });
});
</script> 