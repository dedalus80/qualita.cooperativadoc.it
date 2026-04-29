<?php
/* @var $this SendSmsController */
/* @var $model SendSms */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array('id' => 'send-email-form', 'enableAjaxValidation' => false,)); ?>
    <div>
        <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
        <div class='row row-10'>
            <div class="col-xs-12">
                <p> I campi contrasegnati con <em>*</em> sono obbligatori</p>
            </div>
        </div>
        <div class="row row-10 ">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'turno'); ?></label>
                <? echo $form->dropDownList($model, "turno", $model->selectTurni, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'periodo'); ?></label>
                <? echo $form->dropDownList($model, "periodo", $model->selectPeriodi, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
               
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'centro_vacanza'); ?></label>
                <?
                $ruolo = Yii::app()->db->createCommand("SELECT ruolo,struttura FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryRow();
                if ($ruolo['ruolo'] == '2')
                    echo "<br><b>" . Yii::app()->db->createCommand("SELECT nome FROM _centri_vacanza WHERE id='" . $ruolo['struttura'] . "'")->queryScalar() . "</b>";
                else
                    echo $form->dropDownList($model, "centro_vacanza", $model->selectCentri, array('empty' => 'Scegli', 'class' => 'form-control'));
                ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <?php echo $form->labelEx($model, 'tutti'); ?><br />
                <?php echo $form->radioButtonList($model, 'tutti', array('Y' => '&nbsp;&nbsp;SI&nbsp;&nbsp;', 'N' => '&nbsp;&nbsp;NO&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div> 
        <div class="row row-10 row-bottom">
            <div class="col-xs-12 col-md-8">
                <?php echo $form->labelEx($model, 'sender'); ?><br />
                <?php echo $form->textField($model, 'sender', array('class' => ' form-control ')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label">Variabili</label>
                <select id="variabili_email" name="variabili_email"  class='form-control'>
                    <option value="[NOME]">Nome</option>
                    <option value="[COGNOME]">Cognome</option>
                    <option value="[TURNO]">Turno</option>
                    <option value="[CENTRO]">Centro</option>
                    <option value="[PERIODO]">Periodo</option>
                </select>
            </div>
        </div>
        <div class="row row-10 row-bottom" >
            <div class="col-xs-12 col-md-12">
                <?php echo $form->labelEx($model, 'testo'); ?><br />
                <?php echo $form->textArea($model, 'testo', array('class' => ' form-control ', 'rows' => '30' )); ?>
            </div>
        </div>
    </div>  
</div>
<div class="panel-footer">
    <div class="text-gray pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-envelope '></i>&nbsp;Invia" : "<i class='fa fa-envelope '></i>&nbsp;Invia", '#', array('class' => 'btn btn-orange btn-sm', 'id' => 'send-email-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>