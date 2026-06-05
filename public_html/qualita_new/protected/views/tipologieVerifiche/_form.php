<?php $form = $this->beginWidget('CActiveForm', array('id' => 'tipologie-verifiche-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('enctype' => 'multipart/form-data'),)); ?>
<div> 
    <?php echo $form->errorSummary($model, "<i class='ti ti-alert'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi  </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10  row-bottom" >
        <div class="col-xs-12 col-md-2">
            <?php echo $form->label($model, 'codice'); ?>*
            <?php echo $form->textField($model, 'codice', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <?php echo $form->label($model, 'nome'); ?>*
            <?php echo $form->textField($model, 'nome', array('size' => 50, 'maxlength' => 50, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-6 col-md-2">
            <?php echo $form->label($model, 'colore'); ?> 
            <select class="simple-colorpicker-3">
                <? foreach ($model->selectColori AS $id => $val) { ?>
                    <option value="<?= $val ?>" data-id-color="<?= $id ?>" <?= $id == $model->colore ? "selected='selected'" : "" ?> > <?= $val ?></option>
                <? } ?>
            </select>
            <? echo $form->hiddenField($model, "colore",array("value" => Yii::app()->MyUtils->getSelectValue($model->colore, "nome_colore"))); ?>
        </div>
        <div class="col-xs-6 col-md-2 form-group">
            <?php echo $form->label($model, 'is_hidden');?><br />
            <?php echo $form->radioButtonList($model, 'is_hidden', array('Y' => 'SI', 'N' => 'NO'), array('class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-6">
            <?php echo $form->label($model, 'file_upload'); ?>
            <?php echo $form->fileField($model, 'file_upload', array('class' => 'form-control', 'accept' => '.pdf,.doc,.docx')); ?>
            <?php echo $form->error($model, 'file_upload'); ?>
            <?php if (!$model->isNewRecord && $model->file_name) { ?>
                <span>Documento attuale: <?php echo CHtml::link(CHtml::encode($model->file_name), Yii::app()->baseUrl . '/images/modulistica/verifiche/' . rawurlencode($model->file_name), array('target' => '_blank')); ?></span>
            <?php } ?>
        </div>
    </div>
    <div class="row row-10  row-bottom" >
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p>  
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right ">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'tipologie-verifiche-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
