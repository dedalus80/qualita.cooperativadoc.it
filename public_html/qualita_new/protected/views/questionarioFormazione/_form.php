<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'questionario-formazione-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class='row row-10 noline'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
    <div class="row noline" >
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'data_corso'); ?></label>
            <?php echo $form->textField($model, 'data_corso', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'titolo'); ?></label>
            <?php echo $form->textField($model, 'titolo', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipo_corso'); ?></label>
            <?= $form->dropDownList($model, "tipo_corso", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row noline">
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ente_corso'); ?></label>
            <?php echo $form->textField($model, 'ente_corso', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row noline">
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'argomenti'); ?></label>
            <?php echo $form->textField($model, 'argomenti', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'suggerimenti'); ?></label>
            <?php echo $form->textField($model, 'suggerimenti', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row  title" style="margin-top: 20px" >
        <div class="col-xs-4"> <span class='bold'>QUESITO</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>INSUFFICIENTE</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>SUFFICIENTE</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>BUONA</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>OTTIMO</span></div>
    </div>
    <div class="row ">
        <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'giudizio'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[giudizio]" class="radio-ins" value="I" <?= $model->giudizio == 'I' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[giudizio]" class="radio-suf" value="S" <?= $model->giudizio == 'S' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[giudizio]" class="radio-buo" value="B" <?= $model->giudizio == 'B' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[giudizio]" class="radio-ott" value="E" <?= $model->giudizio == 'E' ? "checked='checked'" : "" ?> /></div>
    </div>
    <div class="row ">
        <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'corso'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[corso]" class="radio-ins" value="I" <?= $model->corso == 'I' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[corso]" class="radio-suf" value="S" <?= $model->corso == 'S' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[corso]" class="radio-buo" value="B" <?= $model->corso == 'B' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[corso]" class="radio-ott" value="E" <?= $model->corso == 'E' ? "checked='checked'" : "" ?> /></div>
    </div>
    <div class="row ">
        <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'conduzione'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[conduzione]" class="radio-ins" value="I" <?= $model->conduzione == 'I' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[conduzione]" class="radio-suf" value="S" <?= $model->conduzione == 'S' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[conduzione]" class="radio-buo" value="B" <?= $model->conduzione == 'B' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[conduzione]" class="radio-ott" value="E" <?= $model->conduzione == 'E' ? "checked='checked'" : "" ?> /></div>
    </div>
    <div class="row ">
        <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'spazi'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[spazi]" class="radio-ins" value="I" <?= $model->spazi == 'I' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[spazi]" class="radio-suf" value="S" <?= $model->spazi == 'S' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[spazi]" class="radio-buo" value="B" <?= $model->spazi == 'B' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[spazi]" class="radio-ott" value="E" <?= $model->spazi == 'E' ? "checked='checked'" : "" ?> /></div>
    </div>
    <div class="row ">
        <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'livello'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[livello]" class="radio-ins" value="I" <?= $model->livello == 'I' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[livello]" class="radio-suf" value="S" <?= $model->livello == 'S' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[livello]" class="radio-buo" value="B" <?= $model->livello == 'B' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[livello]" class="radio-ott" value="E" <?= $model->livello == 'E' ? "checked='checked'" : "" ?> /></div>
    </div>

    <div class="row title">
        <div class="col-xs-6"> <span class='bold'>CONSIGLIEREBBE</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE NO </span></div>
        <div class="col-xs-2 centered"> <span class='bold'>FORSE</span></div>
        <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE SI </span></div>
    </div>
    <div class="row " style="margin-bottom: 20px">
        <div class="col-xs-6"> <span class='bold'><?= $form->labelEx($model, 'consiglia'); ?></span></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[consiglia]" class="radio-suf" value="N" <?= $model->consiglia == 'N' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[consiglia]" class="radio-buo" value="F" <?= $model->consiglia == 'F' ? "checked='checked'" : "" ?> /></div>
        <div class="col-xs-2 centered"><input type="radio" name="QuestionarioFormazione[consiglia]" class="radio-ott" value="S" <?= $model->consiglia == 'S' ? "checked='checked'" : "" ?> /></div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-sm ', 'id' => 'questionario-formazione-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>