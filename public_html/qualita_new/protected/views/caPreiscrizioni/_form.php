<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'ca-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>

    <fieldset>
        <legend>Dati utente</legend>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
                <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
                <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cellulare'); ?></label>
                <?php echo $form->textField($model, 'cellulare', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'email'); ?></label>
                <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10" >
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'data_nascita'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_nascita', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_nascita))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luogo_nascita'); ?></label>
                <?php echo $form->textField($model, 'luogo_nascita', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nazionalita'); ?></label> 
                <?php echo $form->dropDownList($model, "nazionalita", $model->selectNazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'occupazione'); ?></label>
                <? echo $form->dropDownList($model, "occupazione", $model->selectOccupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'conoscenza'); ?></label>
                <? echo $form->dropDownList($model, "conoscenza", $model->selectConoscenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'sesso'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'sesso', array('M' => 'M', 'F' => 'F'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'privacy'); ?></label> <br />

                <?php echo $form->radioButtonList($model, 'privacy', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>

            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'prima_volta'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'prima_volta', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div>
		
		<div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'facoltaId'); ?></label>
                <? echo $form->dropDownList($model, "facoltaId", $model->selectFacolta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
		</div>
    </fieldset>
    <fieldset style="margin-top: 20px ">
        <legend>Richiesta</legend>
        <div class="row row-10 " >
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'data_in'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_in', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_in))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'data_out'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_out', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_out))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'campus'); ?></label>
                <? echo $form->dropDownList($model, "campus", $model->selectCamere, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control', 'onChange' => 'javascript:showFormula()')
                ); ?>
            </div>
        </div>
        <div class="row row-10 " >
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'coabitazione'); ?></label>
                <?php echo $form->textField($model, 'coabitazione', array('size' => 40, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10 " style='margin-bottom: 20px' >
            <div class="col-xs-12 col-md-12">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'note'); ?></label>
                <? echo $form->textArea($model, "note", array('maxlength' => 320, 'rows' => 3, 'class' => 'form-control')); ?> 
            </div>
        </div>
    </fieldset>
</div>
<div class="panel-footer">
    <div class=" pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'ca-preiscrizioni-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?> 