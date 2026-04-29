<?php
$siNo = array("S" => "Si", "N" => "No", "V" => "In Valutazione");
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'db-azionicorrettive-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data')
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div id='user-detail' style="display:<?= $model->id ? "block" : "none" ?>; margin-bottom: 20px;">
        <div class="row row-10">
            <div class="col-xs-12 col-sm-4">
                <span class="bold">Codice non conformit&agrave;:&nbsp;&nbsp;</span><span id='refer-codice'><?= $model->refer['codice'] ?></span>
            </div>
            <div class="col-xs-12 col-sm-4">
               <span class="bold">Data inserimento:&nbsp;&nbsp;</span><span><?= Yii::app()->MyUtils->getItaDate($model->data, "") ?></span>
            </div>
             <div class="col-xs-12 col-sm-4">
                <span class="bold">Data aggiornamento:&nbsp;&nbsp;</span><span><?= Yii::app()->MyUtils->getItaDate($model->data_aggiornamento, "") ?></span>
            </div>
        </div>
        <div class="row row-10">
             <div class="col-xs-12 col-sm-6">
                <div class="bold">Descrizione</div><div id='refer-descrizione'><?= $model->refer['descrizione'] ?></div>
            </div>
             <div class="col-xs-12 col-sm-6">
                <div class="bold">Trattamento</div><div id='refer-trattamento'><?= $model->refer['trattamento'] ?></div>
            </div>
        </div> 
    </div> 
	<div class="row row-10">
        <div class="col-xs-12 col-sm-2">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_az'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                 <?php echo $form->textField($model, 'data_az', array('class' => 'form-control hasDatepicker richiamo' , 'value' => Yii::app()->MyUtils->reverseDate($model->data_az))); ?>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-2">
            <label><?php echo $form->labelEx($model, 'codice_riferimento'); ?></label>
            <?php echo ($model->selectCodici ? $form->dropDownList($model, 'codice_riferimento', $model->selectCodici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control update-nc')) : ""); ?>
        </div>
        <div class="col-xs-12 col-md-2">
             <label><?php echo $form->labelEx($model, 'tipo_azione'); ?></label>
            <?php echo $form->dropDownList($model, 'tipo_azione', $model->selectAzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>

        </div>
        <div class="col-xs-12 col-md-3">
            <label><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
            <?php
                /*if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                    echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                else {
                    echo $form->hiddenField($model, 'unita_operativa', array('class' => 'form-control'));
                    echo "<br><span class='struttura-line'>" . Yii::app()->MyUtils->getStrutturaNome()."</span>";
                }*/

                echo $form->dropDownList(
                    $model,
                    "unita_operativa",
                    $strutture, 
                    array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')
                );
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
             <label><?php echo $form->labelEx($model, 'societa'); ?></label>
            <? echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div> 
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12 col-md-3">
             <label><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label> <?php echo $form->labelEx($model, 'nome');?> </label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
             <label><?php echo $form->labelEx($model, 'funzione'); ?></label>
            <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
             <label><?php echo $form->labelEx($model, 'tipologia'); ?></label>
            <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'trattamento'); ?></label><br />
            <? echo $form->textArea($model, "trattamento", array('maxlength' => 320, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12 col-md-4">
            <label ><?php echo $form->labelEx($model, 'descrizione'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'descrizione', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->descrizione))); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
             <label><?php echo $form->labelEx($model, 'allegato'); ?> <?= $model->allegato ? "<a href='/../qualita_new/images/allegati_reclami/".$model->allegato."' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegati'   >" . $model->allegato . "</a>" : "" ?> </label>
            <? echo $form->fileField($model, 'allegato', array('class' => 'form-control')); ?>
            
        </div>
        <div class="col-xs-12 col-md-4">
             <label><?php echo $form->labelEx($model, 'verifica_efficacia'); ?></label>
            <? echo $form->dropDownList($model, "verifica_efficacia", $siNo, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>

    <?php if ($model->typeUser == 'admin'): ?>
    <div class="row row-10 row-bottom" >
        <div class="col-xs-3 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data', array('class' => 'form-control hasDatepicker richiamo' , 'value' =>  (new DateTime($model->data))->format('d-m-Y'))); ?>
            </div>
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
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'db-azionicorrettive-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>