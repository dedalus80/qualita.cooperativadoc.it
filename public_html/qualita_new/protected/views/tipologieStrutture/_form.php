<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'qualita-strutture-centri-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-orizontal'), 'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-12">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
       
    </div>
    <div class='row row-10 row-bottom row-bottom-top' >
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'qualita-strutture-centri-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
