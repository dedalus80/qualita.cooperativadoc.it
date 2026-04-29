<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'azioni-verifiche-amministrative-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'), 'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row">
        <div class="col-xs-12">
            <legend>Incaricato verifica: <span class='orange return-block'> <?= Yii::app()->MyUtils->getSelectValue($model->incaricato,'dettaglio_admin')  ?></span></legend>
        </div>
    </div>
    <div class="row row-10">
        <div class="col-xs-12 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'data'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon data-calendar" data-refer="AzioniVerificheAmministrative_data"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data', array('class' => 'form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data))); ?>
            </div>  
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_inizio'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheAmministrative_ora_inizio' ></i></span>
                <?php echo $form->textField($model, 'ora_inizio', array('class' => 'orario form-control ', 'value' => substr($model->ora_inizio, 0, 5))); ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ora_fine'); ?></label>
            <div class="input-group">							
                <span class="input-group-addon"><i class="fa fa-clock-o data-timer" data-refer='AzioniVerificheAmministrative_ora_fine' ></i></span>
                <?php echo $form->textField($model, 'ora_fine', array('class' => 'orario form-control', 'data-refer' => '', 'value' => substr($model->ora_fine, 0, 5))); ?>
            </div>
        </div>
        <div class="col-xs-6 col-sm-2 ">

            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'apertura_nc'); ?></label>
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'apertura_nc', array('Y' => '&nbsp;SI&nbsp;&nbsp;&nbsp;', 'N' => '&nbsp;NO&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>

        </div>
        <div class="col-xs-12 col-sm-4 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipo_valutazione'); ?></label>
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'tipo_valutazione', array('A' => '&nbsp;AUTOVALUTAZIONE&nbsp;&nbsp;&nbsp;', 'V' => '&nbsp;VALUTAZIONE&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>
        </div>
    </div>
    <div class="row row-10 descrizione">
        <div class="col-xs-12 ">
            <p>La check list di BASE &egrave; articolata in <b>3 sezioni</b><br />
                Ogni sezione richiede di verificare la conformit&agrave; o meno ai singoli requisiti. Dopo la verifica l'ispettore riporti  a margine e/o in calce ad ogni sezione le eventuali note ed il numero di NON CONFORMIT&Agrave; registrate. A fine controllo riporti il totale delle Non conformit&agrave; nell'ultima pagina della check list lasciando copia al gestore dell'Unit&agrave; Ristorativa. <br />
                Il valutatore indichi il giudizio UNICAMENTE con le sigle: <b>C</b> (voce conforme), <b>NC</b> (voce non conforme), <b>NA</b> (non applicabile), <b>NR</b> (non rilevata)</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel-group panel-default" id="accordionA">
            <?php $k=1; foreach($questions as $question):?>
                <div class="panel panel-default">
                    <a data-toggle="collapse" data-parent="#accordionA" href="#collapse_<?= $k ?>" aria-expanded="<?= $k == 1 ? 'true' : 'false' ?>" class="">
                        <div class="panel-heading">
                            <h2><?php echo $question['name'];?></h2>
                            <div class="panel-ctrls panel-ctrls-verifica" >
                                <div class="progress progress-verifica" >
                                    <div id="progress-sezione-<?= $k ?>" class="progress-bar progress-bar-<?php echo $progress[$question['id']]['color'];?>" style="width:<?php echo $progress[$question['id']]['percentage'];?>%"></div>
                                </div>
                                <div style="display:inline-block">
                                    <div class="nc-count dropdown toolbar-icon-bg" style="display: inline-block">
                                        <span class="icon-bg"><i class="fa fa-fw fa-thumbs-o-down"></i></span><span id="badge-sezione-<?= $k ?>" class="badge badge-<?php echo $progress[$question['id']]['badge'];?>" data-html="true" data-placement='bottom' data-toggle = 'tooltip' title = 'Totale non conformit&agrave;'><?php echo $progress[$question['id']]['nc'];?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div id="collapse_<?php echo $k;?>" class="collapse <?= $k == 1 ? 'in' : '' ?> " aria-expanded="<?= $k == 1 ? 'true' : 'false' ?>">
                        <div class="panel-body panel-body-verifica"  style="padding-top: 0px" id="panel-verifica-<?= $k ?>">
                            <div class="row row-10 intestazione-sezione hidden-480">
                                <div class="col-xs-12 col-sm-5 pdl">PARAMETRO DA VALUTARE</div>
                                <div class="col-xs-12 col-sm-2 centered">GIUDIZIO</div>
                                <div class="col-xs-12 col-sm-5 centered">NOTE SINGOLA VOCE</div>
                            </div>

                            <?php foreach($question['verificheQuestions'] as $domanda):?>
                                <?php 
                                $currentAnswer = isset($domanda['verificheAnswers'][0]['answer']) ? $domanda['verificheAnswers'][0]['answer'] : '';
                                $fileNc = isset($domanda['verificheAnswers'][0]['file_nc']) ? $domanda['verificheAnswers'][0]['file_nc'] : '';
                                $showFileUpload = ($currentAnswer == 'NC');
                                ?>
                                <div class="row row-10 bor-bot">
                                    <div class="col-xs-12 col-sm-5"><label><?php echo $domanda['question'];?></label></div>
                                    <div class="col-xs-12 only-phone">GIUDIZIO</div>
                                    <div class="col-xs-12 col-sm-2">
                                        <?php 
                                            echo VerificheAnswers::getSelectAnswer($domanda['id'], $currentAnswer);
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-5">
                                        <textarea class="form-control" name="Questions[<?php echo $domanda['id'];?>][note]"><?php echo isset($domanda['verificheAnswers'][0]['note']) ? $domanda['verificheAnswers'][0]['note'] : '';?></textarea>
                                        <div class="file-upload-nc" data-question-id="<?php echo $domanda['id'];?>" style="<?php echo $showFileUpload ? '' : 'display:none;'; ?> margin-top: 10px;">
                                            <label style="font-size: 12px; font-weight: bold;">Allegato Non Conformità (Immagine o PDF):</label>
                                            <input type="file" name="Questions[<?php echo $domanda['id'];?>][file_nc]" accept="image/*,.pdf" class="form-control" style="margin-top: 5px;">
                                            <?php if($fileNc): ?>
                                                <?php 
                                                $ncDir = Yii::app()->basePath . '/data/nc';
                                                $filePath = $ncDir . '/' . $fileNc;
                                                if(file_exists($filePath)):
                                                    $isImage = in_array(strtolower(pathinfo($fileNc, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif'));
                                                    $fileUrl = $this->createUrl('azioniVerifiche/downloadNc', array('file' => $fileNc));
                                                ?>
                                                    <div style="margin-top: 5px;">
                                                        <small>File attuale: 
                                                            <?php if($isImage): ?>
                                                                <a href="<?php echo $fileUrl; ?>" target="_blank"><img src="<?php echo $fileUrl; ?>" style="max-width: 100px; max-height: 100px; margin-left: 5px;" /></a>
                                                            <?php else: ?>
                                                                <a href="<?php echo $fileUrl; ?>" target="_blank"><?php echo $fileNc; ?></a>
                                                            <?php endif; ?>
                                                        </small>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <!--<div class="row">
                        <hr>
                        <div class="col-xs-3">
                            <label>NOTE</label>
                        </div>
                        <div class="col-xs-9">
                            <textarea class="form-control" name="AzioniVerifiche[note]"><?php //echo $model->note;?></textarea>
                        </div>
                    </div>-->
                </div>
            <?php $k++; endforeach;?>
            </div>
        </div>
    </div>
    <div>    
        <div class='row row-10 row-bottom' style="margin-top: 15px" >
            <div class="col-xs-12">
                <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="pull-right">
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form ', 'data-refer' => 'azioni-verifiche-amministrative-form')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php
Yii::app()->clientScript->registerScript('toggleFileUpload', "

    // Gestione visibilità campo file upload per risposte NC
    function toggleFileUpload(selectElement) {
        var questionId = $(selectElement).data('question-id');
        var answer = $(selectElement).val();
        var fileUploadDiv = $('.file-upload-nc[data-question-id='+questionId +']');

        console.log(questionId);
        console.log(answer);
        console.log(fileUploadDiv);
        
        if(answer == 'NC') {
            fileUploadDiv.slideDown();
        } else {
            fileUploadDiv.slideUp();
        }
    }
    
    // Inizializza la visibilità al caricamento della pagina
    $('.answer-select').each(function() {
        toggleFileUpload(this);
    });
    
    // Gestisci il cambio di risposta
    $(document).on('change', '.answer-select', function() {
                                                                console.log('change');
        toggleFileUpload(this);
    });

", CClientScript::POS_END);
?>