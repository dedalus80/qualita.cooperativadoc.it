<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formazione-corsi-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-orizontal'),'clientOptions' => array(  'validateOnSubmit' => true, ),  ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
     <div class="row row-10 row-bottom">
         <div class="col-xs-12 col-sm-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice'); ?></label>
                            <?php echo $form->textField($model, 'codice', array('class' => 'form-control')); ?>

            </div><div class="col-xs-12 col-sm-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'id_categoria'); ?></label>
                <? echo $form->dropDownList($model, "id_categoria", $model->selectCategorie, array('empty' => 'Scegli', 'class' => 'check-sms-dest form-control')); ?>
            </div>
         <div class="col-xs-12 col-sm-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-sm-2">
            <?php echo $form->label($model, 'colore'); ?> 
            <select class="simple-colorpicker-2">
                <? foreach ($model->selectColori AS $id => $val) { ?>
                    <option value="<?= $val ?>" data-id-color="<?= $id ?>" <?= $id == $model->colore ? "selected='selected'" : "" ?> > <?= $val ?></option>
                <? } ?>
            </select>
            <? echo $form->hiddenField($model, "colore",array("value" => Yii::app()->MyUtils->getSelectValue($model->colore, "nome_colore"))); ?>
        </div> 
    </div>
    <div class='row row-10  row-bottom'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p>  
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'formazione-corsi-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>