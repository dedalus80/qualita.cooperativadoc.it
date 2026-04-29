<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'clienti-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
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
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice'); ?></label>
            <?php echo $form->textField($model, 'codice', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'online'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'online', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div> 
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'qdoc'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qdoc', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'qkeluar'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qkeluar', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'qsharing'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qsharing', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'qcampus'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qcampus', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'qsenior'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qsenior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'qjunior'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qjunior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'qscientifici'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qscientifici', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'qsport'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qsport', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'qstudio'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'qstudio', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange', 'id' => 'clienti-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
