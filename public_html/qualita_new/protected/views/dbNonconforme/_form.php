<?
$siNo = array("1" => "Si", "0" => "No");
?>
<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'db-nonconforme-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10">
        <div class="col-xs-12 ">
            Data inserimento: <?= "<span class='orange '>" . Yii::app()->MyUtils->getItaDate($model->data, "") . "</span>" ?>
            <?= $model->data_aggiornamento ? " - Ultimo aggiornamento : <span class='orange '>" . Yii::app()->MyUtils->getItaDate($model->data_aggiornamento, "") . "</span>" : ""; ?>
        </div>
    </div> 
    <div class="row row-10">
        <div class="col-xs-12 col-sm-3 ">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_nc'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <?php echo $form->textField($model, 'data_nc', array('class' => 'form-control hasDatepicker richiamo' , 'value' => Yii::app()->MyUtils->reverseDate($model->data_nc))); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
            <?php
                //if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                    //echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                //else {
                //    echo $form->hiddenField($model, 'unita_operativa', array('class' => 'form-control'));
                //    echo "<br><span class='struttura-line'>" . Yii::app()->MyUtils->getStrutturaNome()."</span>";
                //}

                echo $form->dropDownList(
                    $model,
                    "unita_operativa",
                    $strutture,
                    array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            ?>
        </div>
    </div> 
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'societa'); ?></label>
            <? echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'funzione'); ?></label>
            <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipologia'); ?></label>
            <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $el, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'responsabile'); ?></label> 
            <? echo $form->dropDownList($model, "responsabile", $model->selectResponsabili, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'descrizione'); ?></label><br />
            <? echo $form->textArea($model, "descrizione", array('maxlength' => 320, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'trattamento'); ?></label><br />
            <? echo $form->textArea($model, "trattamento", array('maxlength' => 320, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
    </div>
    <? if ($model->typeUser == 'admin'): ?>
        <div class="row row-10 row-bottom" > 
            <div class="col-xs-12 ">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'trattamento_note'); ?></label><br />
                <? echo $form->textArea($model, "trattamento_note", array('maxlength' => 320, 'rows' => 4, 'width' => 320, 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10 row-bottom" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'allegato'); ?> <?= $model->allegato ? "<a href='/../qualita_new/images/allegati/" . $model->allegato . "' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegati'   >" . $model->allegato . "</a>" : "" ?> </label> 
                <? echo $form->fileField($model, 'allegato', array('class' => 'form-control')); ?>

            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'chiusura'); ?></label><br /> 
                <? echo $form->dropDownList($model, "chiusura", $model->selectChiusure, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'trattamento_accettato'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'trattamento_accettato', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div>
        <div class="row row-10 row-bottom">
            <div class="col-xs-3 col-md-3">
                <label for="" class="contro-label"><?php echo $form->labelEx($model, 'data'); ?></label><br />
                <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data', array('class' => 'form-control hasDatepicker richiamo' , 'value' => (new DateTime($model->data))->format('d-m-Y'))); ?>
                </div>
            </div>
        </div>
    <? else: ?>
        <div class="row row-10 row-bottom" > 
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'allegato'); ?>  <?= $model->allegato ? "&nbsp;&nbsp;<a href='/../qualita_new/images/allegati_reclami/" . $model->allegato . "' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegati'  >" . $model->allegato . "</a>" : "" ?>     </label> 
                <? echo $form->fileField($model, 'allegato', array('class' => 'form-control')); ?>

            </div>
        </div>   
    <?php endif; ?>   
    <div class='row row-10 row-bottom'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange  ', 'id' => 'db-nonconforme-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

