<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'tipologie-formazione-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class='row row-10'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-9">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'attivo'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'attivo', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange  ', 'id' => 'tipologie-formazione-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
