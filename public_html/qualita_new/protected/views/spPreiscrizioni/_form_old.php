<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'sp-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<style>
    .row-20{
        margin-top: 20px;
    }
</style>
<div> 
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <fieldset>
        <legend>Dati utente</legend>
        <div class="row row-25" >
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
        <div class="row row-20" >
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'data_nascita'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_nascita', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_nascita))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'sesso'); ?></label>
                <div class='row-radio-check'><?php echo $form->radioButtonList($model, 'sesso', array('M' => 'M', 'F' => 'F'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luogo_nascita'); ?></label>
                <?php echo $form->textField($model, 'luogo_nascita', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nazionalita'); ?></label> 
                <?php echo $form->dropDownList($model, "nazionalita", $model->selectNazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice_fiscale'); ?></label>
                <?php echo $form->textField($model, 'codice_fiscale', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-20" >
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'residenza'); ?></label>
                <?php echo $form->textField($model, 'residenza', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cap'); ?></label> 
                <?php echo $form->textField($model, 'cap', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'provincia'); ?></label>
                <? echo $form->dropDownList($model, "provincia", $model->selectProvincie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'indirizzo'); ?></label> 
                <?php echo $form->textField($model, 'indirizzo', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-1">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'numero_civico'); ?></label> 
                <?php echo $form->textField($model, 'numero_civico', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-20" >
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice_fiscale'); ?></label>
                <?php echo $form->textField($model, 'codice_fiscale', array('class' => 'form-control')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipo_documento'); ?></label>
                <?php echo $form->textField($model, 'tipo_documento', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-1">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'numero_documento'); ?></label>
                <?php echo $form->textField($model, 'numero_documento', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'scadenza_documento'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'scadenza_documento', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->scadenza_documento))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'permesso_soggiorno'); ?></label>
                <?php echo $form->textField($model, 'permesso_soggiorno', array('class' => 'form-control')); ?>
            </div>
        </div>
	</fieldset> 
    <fieldset style="margin-top: 20px" >
        <legend >Altre informazioni</legend>
        <div class="row row-25">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'conoscenza'); ?></label>
                <? echo $form->dropDownList($model, "conoscenza", $model->selectConoscenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'occupazione_det'); ?></label>
                <?php echo $form->textField($model, 'occupazione_det', array('class' => 'form-control')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'prima_volta'); ?></label> 
                <div class='row-radio-check'> <?php echo $form->radioButtonList($model, 'prima_volta', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'fumatore'); ?></label>
                <div class='row-radio-check'> <?php echo $form->radioButtonList($model, 'fumatore', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
		</div>
		<div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'occupazione'); ?></label>
                <? echo $form->dropDownList($model, "occupazione", $model->selectOccupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
            </div>
			
			<div class="col-xs-12 col-md-3">
                <div id='occupazione-extra' style='display:<?= $model->occupazione == '4' ? "block":"none" ?>'>
				<label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'occupazione_det'); ?></label>
                <?php echo $form->textField($model, 'occupazione_det', array('class' => 'form-control')); ?>
				</div>
				<div id='studente-extra' style='display:<?= $model->occupazione == '1' ? "block":"none" ?>'>
				<label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'studente_det'); ?></label>
                <?php echo $form->textField($model, 'studente_det', array('class' => 'form-control')); ?>
				</div>
				
				<div id='lavoratore-extra' style='display:<?= $model->occupazione == '2' ? "block":"none" ?>'>
				<label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'lavoratore_tipo'); ?></label>
                <?php echo $form->textField($model, 'lavoratore_tipo', array('class' => 'form-control')); ?>
				</div>
			</div>
			
			
			<div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dove_vive'); ?></label>
                <? echo $form->dropDownList($model, "dove_vive", $model->selectAlloggi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dove_vive_altro'); ?></label>
                <?php echo $form->textField($model, 'dove_vive_altro', array('class' => 'form-control')); ?>
            </div>
        </div>
		<div class="row row-10">
            
			<div class="col-xs-12 col-md-3">
                    <label for="" class="control-label "><?php echo $form->labelEx($model, 'animali'); ?></label><br />
                    <div class='row-radio-check'> <?php echo $form->radioButtonList($model, 'animali', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
               <div class="col-xs-12 col-md-3">
                    <div id="show-animali-det" style="display:<?= $model->animali == 'Y' ? "block" : "none" ?>" >
                        <label for="" class="control-label "><?php echo $form->labelEx($model, 'animali_det'); ?></label><br />
                        <?php echo $form->textField($model, 'animali_det', array('class' => 'form-control')); ?>
                    </div>
                </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'livello'); ?></label><br />
                <? echo $form->dropDownList($model, "livello", $model->selectLivelli, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>     
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'livello_altro'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                    <?php echo $form->textField($model, 'livello_altro', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
                </div>
            </div>
        </div>
		<div class="row row-20" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera_amici'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'camera_amici', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera_amici_dettaglio'); ?></label>
                <?php echo $form->textField($model, 'camera_amici_dettaglio', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
            </div>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'nuova_residenza'); ?></label>
               <? echo $form->dropDownList($model, "nuova_residenza", $model->selectCambioResidenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
	<fieldset style="margin-top: 20px ">
        <legend>
			<div style='display: inline-block'>Ricerchi camera con coinquilini ? Quanti ?&nbsp;&nbsp;&nbsp;</div>
			<div style='display: inline-block'><? echo $form->dropDownList($model, "amici_quanti", $model->selectAmiciQuanti, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
		</legend>
		<div class='row row-25'>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_occupazione'); ?></label><br />
                <? echo $form->dropDownList($model, "amici_occupazione", $model->selectAmiciOccupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?> 
            </div>
         	<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_genere'); ?></label><br />
                <? echo $form->dropDownList($model, "amici_genere", $model->selectAmiciGenere, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?> 
            </div>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_eta'); ?></label><br />
                <? echo $form->dropDownList($model, "amici_eta", $model->selectAmiciEta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?> 
            </div>
		</div>
		<div class='row row-25'>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_fumo'); ?></label><br />
                <? echo $form->dropDownList($model, "amici_fumo", $model->selectAmiciEta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?> 
            </div>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_animali'); ?></label><br />
                <? echo $form->dropDownList($model, "amici_animali", $model->selectAmiciEta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?> 
            </div>
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'amici_animali_dettaglio'); ?></label><br />
                <?php echo $form->textField($model, 'amici_animali_dettaglio', array('class' => 'form-control ', )); ?>
            </div>
		</div>
	</fieldset>
	<fieldset style="margin-top: 20px ">
        <legend>Richiesta</legend>
		<div class='row row-25'>
		<div class="col-xs-12 col-md-2">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera_singola'); ?></label>
                <div class='row-radio-check'><?php echo $form->checkBox($model, 'camera_singola', array('class' => 'checkbox-green', 'value' => 'Y')); ?>&nbsp;</div>      
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera_doppia'); ?></label>
                <div class='row-radio-check'><?php echo $form->checkBox($model, 'camera_doppia', array('class' => 'checkbox-green', 'value' => 'Y')); ?>&nbsp;</div>           
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera_indiferente'); ?></label>
                <div class='row-radio-check'><?php echo $form->checkBox($model, 'camera_indiferente', array('class' => 'checkbox-green', 'value' => 'Y')); ?>&nbsp;</div>           
            </div>
			<div class="col-xs-12 col-md-3">
                <div style="width: 50% ; float: left">
                    <label for="" class="control-label "><?php echo $form->labelEx($model, 'appartamento'); ?></label>
                    <div class='row-radio-check'><?php echo $form->radioButtonList($model, 'appartamento', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
                <div style="width: 50% ; float: left">
                    <div id="show-appartamento-det" style="display:<?= $model->appartamento == 'Y' ? "block" : "none" ?>" >
                        <label for="" class="control-label "><?php echo $form->labelEx($model, 'tipo_appartamento'); ?></label>
                        <? echo $form->dropDownList($model, "tipo_appartamento", $model->selectAppartamenti, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control', 'onChange' => 'javascript:showFormula()')); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div style="width: 50% ; float: left">
                    <label for="" class="control-label "><?php echo $form->labelEx($model, 'camera'); ?></label>
                    <div class='row-radio-check'><?php echo $form->radioButtonList($model, 'camera', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
                <div style="width: 50% ; float: left">
                    <div id="show-camera-det" style="display:<?= $model->camera == 'Y' ? "block" : "none" ?>" >
                        <label for="" class="control-label "><?php echo $form->labelEx($model, 'tipo_camera'); ?></label>
                        <? echo $form->dropDownList($model, "tipo_camera", $model->selectCamere, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
		
		
		</div>
		<div class="row row-10 row-bottom" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'data_in'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_in', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_in))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'data_out'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_out', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_out))); ?>
                </div>
            </div>
			<div class="col-xs-12 col-md-4">
                <?php echo $form->labelEx($model, 'giorni_visita'); ?><br />
                <?php echo $form->textField($model, 'giorni_visita', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
            </div>
			
        </div>
        <div class="row row-10 row-bottom" >
			<div class="col-xs-12 col-md-4">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'quartieri'); ?></label><br />
                <? echo $form->dropDownList($model, "quartieri", $model->selectQuartieri, array('empty' => 'Scegli', 'multiple' => 'multiple' , 'size'=> 3, 'options' => $sel, 'class' => 'form-control')); ?>   
            </div>
            <div class="col-xs-12 col-md-4">
                <?php echo $form->labelEx($model, 'interessato'); ?><br />
                <? echo $form->textArea($model, "interessato", array('class' => 'form-control' , 'rows' => 5)); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <?php echo $form->labelEx($model, 'note'); ?><br />
                <? echo $form->textArea($model, "note", array('class' => 'form-control', 'rows' => 5)); ?> 
            </div>
        </div>
		<div class="row row-10 row-bottom" >
			<div class="col-xs-12 col-md-3">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'privacy'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'privacy', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'mailing'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'mailing', array('Y' => 'Autorizzo', 'N' => 'Non autorizzo'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'consenso'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'consenso', array('Y' => 'Autorizzo', 'N' => 'Non autorizzo'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
			<div class="col-xs-12 col-md-3">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'media'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'media', array('Y' => 'Autorizzo', 'N' => 'Non autorizzo'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
		</div>
    </fieldset>
</div>
<div class="panel-footer">
    <div class=" pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'sp-preiscrizioni-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?> 