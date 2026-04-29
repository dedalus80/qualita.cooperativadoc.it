<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'letture-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
   
    <div class="row row-10 ">
        <div class="col-xs-12 col-md-5">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'id_matricola'); ?></label>
            <? echo $form->dropDownList($model, "id_matricola", $model->selectMatricole, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'incremento'); ?></label>
            <?php echo $form->textField($model, 'incremento', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-12 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_lettura'); ?></label>
             <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_lettura', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12','value' => Yii::app()->MyUtils->reverseDate($model->data_lettura)  )); ?>
            </div>
        </div>
    </div> 
	 <div class='row row-10 '>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'letture-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
