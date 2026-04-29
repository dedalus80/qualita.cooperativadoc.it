<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'reclami-azioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div id='user-detail' style="display:<?= $model->id ? "block" : "none" ?>; margin-bottom: 20px;">
        <div class="row row-10">
            <div class="col-xs-12  col-sm-6">
                <span class="bold">Codice reclamo:&nbsp;&nbsp;</span><span id='refer-codice'><?= $model->refer['codice'] ?></span>
            </div>
            <div class="col-xs-12 col-sm-6">
                <span  class="bold">Aggiornamento:&nbsp;&nbsp;</span><span><?= Yii::app()->MyUtils->getItaDate($model->effettuata_il, "") ?></span>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-6 col-sm-3">
                <span  class="bold">Canale:&nbsp;&nbsp;</span><span id='refer-canale'><?= $model->refer['canale'] ?></span>
            </div>
            <div class="col-xs-6 col-sm-3">
                <span  class="bold">Tipologia:&nbsp;&nbsp;</span><span id='refer-tipologia'><?= $model->refer['tipologia'] ?></span>
            </div>
            <div class="col-xs-6 col-sm-3">
                <span  class="bold">Nome:&nbsp;&nbsp;</span><span id='refer-nome'><?= $model->refer['nome'] ?></span>
            </div>
            <div class="col-xs-6 col-sm-3">
                <span  class="bold">Cognome:&nbsp;&nbsp;</span><span id='refer-cognome'><?= $model->refer['cognome'] ?></span>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12">
                <div class="bold">Descrizione</div><div id='refer-descrizione'><?= $model->refer['descrizione'] ?></div>
            </div>
        </div> 
    </div>   
    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'id_reclamo'); ?></label>
            <?php
                if (!$model->id_reclamo)
                    echo $form->dropDownList($model, "id_reclamo", $model->selectReclami, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control reclamoDetail'));
                else {
                    echo "<br /><b>" . Yii::app()->MyUtils->getSelectValue($model->id_reclamo, 'db_reclami') . "</b>";
                    echo $form->hiddenField($model, 'id_reclamo');
                }
            ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'funzione'); ?></label>
            <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'entro_il'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'entro_il', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12','value' => Yii::app()->MyUtils->reverseDate($model->entro_il)  )); ?>
            </div>
        </div>
    </div>  
    <div class='row row-10'>
        <div class="col-xs-12 col-md-12">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'descrizione'); ?></label>
            <? echo $form->textArea($model, "descrizione", array('maxlength' => 320, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row row-10">
        <div class="col-xs-12 col-md-4">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'allegato'); ?>&nbsp; &nbsp;<?= $model->allegato ? "<a href='/../qualita_new/images/allegati_reclami/".$model->allegato."' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegati'  >" . $model->allegato . "</a>" : "" ?>     </label> 
            <? echo $form->fileField($model, 'allegato', array('class' => 'form-control')); ?>
            
        </div>
    </div>    
    <div class='row row-10 row-bottom' style="margin-top: 30px" >
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange', 'id' => 'reclami-azioni-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>


