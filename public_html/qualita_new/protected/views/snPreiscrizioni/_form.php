<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'sn-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10">
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ente'); ?></label>
            <?php echo $form->textField($model, 'ente', array('class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'focus'); ?></label>
            <? echo $form->dropDownList($model, "focus", $model->selectFocus, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'percorso'); ?></label>
            <? echo $form->dropDownList($model, "percorso", $model->selectPercorsi, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ruolo'); ?></label>
            <? echo $form->dropDownList($model, "ruolo", $model->selectRuoli, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3" style="display: <?= $model->ruolo == '4' ? 'block':'none' ?>" >
            <div id="show-ruoli-det">  
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_ruolo'); ?></label>
                <?php echo $form->textField($model, 'altro_ruolo', array('class' => 'form-control')); ?>
            </div>
        </div>
    </div>
    <div class='row row-10 row-bottom'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange', 'id' => 'sn-preiscrizioni-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
