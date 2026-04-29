<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dati Domanda</h3>
            </div>
            <div class="panel-body">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'question-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>

                <p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

                <?php echo $form->hiddenField($model,'section_id'); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'text', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textArea($model,'text',array('rows'=>3,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'text', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'type', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->dropDownList($model,'type', array(
                            'libera'=>'Risposta Libera',
                            'opzioni'=>'Opzioni (POCO, ABBASTANZA, MOLTO)',
                            'range'=>'Range 1-5',
                            'custom'=>'Custom (opzioni personalizzate)',
                        ), array('class'=>'form-control','prompt'=>'Seleziona Tipo', 'id'=>'question-type-select')); ?>
                        <?php echo $form->error($model,'type', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group" id="custom-options-group" style="display:none;">
                    <label class="col-sm-2 control-label">Opzioni personalizzate</label>
                    <div class="col-sm-10">
                        <textarea name="custom_options" id="custom-options-textarea" class="form-control" rows="3" placeholder="Inserisci una opzione per riga"><?php
                            if (!$model->isNewRecord && $model->type === 'custom') {
                                $opts = array();
                                foreach ($model->options as $opt) {
                                    $opts[] = $opt->option_text;
                                }
                                echo CHtml::encode(implode("\n", $opts));
                            }
                        ?></textarea>
                        <small class="text-muted">Le opzioni saranno mostrate come scelte all'utente.</small>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'order', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'order',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'order', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Domanda Condizionale</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="enable-conditional" <?php echo $model->isConditional() ? 'checked' : ''; ?>>
                                Abilita condizioni per mostrare questa domanda
                            </label>
                        </div>
                    </div>
                </div>

                <div id="conditional-fields" style="display: <?php echo $model->isConditional() ? 'block' : 'none'; ?>;">
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'condition_question_id', array('class'=>'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php 
                            // Ottieni tutte le domande della stessa sezione
                            $questions = Question::model()->findAll(array(
                                'condition' => 'section_id = :section_id AND id != :current_id',
                                'params' => array(
                                    ':section_id' => $model->section_id,
                                    ':current_id' => $model->id ?: 0
                                ),
                                'order' => 'order ASC'
                            ));
                            $questionList = CHtml::listData($questions, 'id', 'text');
                            ?>
                            <?php echo $form->dropDownList($model,'condition_question_id', $questionList, array(
                                'class'=>'form-control',
                                'prompt'=>'Seleziona la domanda condizione',
                                'empty'=>'Nessuna'
                            )); ?>
                            <?php echo $form->error($model,'condition_question_id', array('class'=>'text-danger')); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'condition_operator', array('class'=>'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->dropDownList($model,'condition_operator', array(
                                '=' => 'Uguale a',
                                '!=' => 'Diverso da',
                                'in' => 'Contenuto in',
                                'not in' => 'Non contenuto in'
                            ), array(
                                'class'=>'form-control',
                                'prompt'=>'Seleziona operatore'
                            )); ?>
                            <?php echo $form->error($model,'condition_operator', array('class'=>'text-danger')); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'condition_value', array('class'=>'col-sm-2 control-label')); ?>
                        <div class="col-sm-10">
                            <?php echo $form->textField($model,'condition_value',array(
                                'class'=>'form-control',
                                'placeholder'=>'Inserisci il valore o valori separati da virgola'
                            )); ?>
                            <?php echo $form->error($model,'condition_value', array('class'=>'text-danger')); ?>
                            <small class="text-muted">Per operatori "in" e "not in", separa i valori con virgole (es: "valore1,valore2")</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class'=>'btn btn-primary')); ?>
                        <?php echo CHtml::link('Annulla', array('index'), array('class'=>'btn btn-default')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

            </div>
        </div>

    </div>
</div>

<script>
$(function() {
    function toggleCustomOptions() {
        if ($('#question-type-select').val() === 'custom') {
            $('#custom-options-group').show();
        } else {
            $('#custom-options-group').hide();
        }
    }
    $('#question-type-select').on('change', toggleCustomOptions);
    toggleCustomOptions();

    // Gestione campi condizionali
    $('#enable-conditional').on('change', function() {
        if ($(this).is(':checked')) {
            $('#conditional-fields').show();
        } else {
            $('#conditional-fields').hide();
            // Pulisci i campi quando si disabilita
            $('#Question_condition_question_id').val('');
            $('#Question_condition_operator').val('');
            $('#Question_condition_value').val('');
        }
    });
});
</script>
