<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'sp-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>

    <fieldset>
        <legend>Dati utente</legend>
        <div class="row row-10" style='margin-top: 20px'>
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
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'privacy'); ?></label> <br />

                <?php echo $form->radioButtonList($model, 'privacy', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>

            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'prima_volta'); ?></label> <br />
                <?php echo $form->radioButtonList($model, 'prima_volta', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'fumatore'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'fumatore', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div>
    </fieldset>
    <fieldset style="margin-top: 20px ">
        <legend>Richiesta</legend>
        <div class="row row-10 " >
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'data_in'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_in', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_in))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'data_out'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_out', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_out))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'livello'); ?></label>
                <? echo $form->dropDownList($model, "livello", $model->selectLivelli, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>       
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'livello_altro'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                    <?php echo $form->textField($model, 'livello_altro', array('class' => 'form-control ', 'size' => '10', 'maxlength' => '12',)); ?>
                </div>
            </div>
        </div>
        <div class="row row-10 " >
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'appartamento'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'appartamento', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <div id="show-appartamento-det" style="display:<?= $model->appartamento == 'Y' ? "block" : "none" ?>" >
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'tipo_appartamento'); ?></label>
                    <? echo $form->dropDownList($model, "tipo_appartamento", $model->selectAppartamenti, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control', 'onChange' => 'javascript:showFormula()')); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'camera'); ?></label><br />
                <?php echo $form->radioButtonList($model, 'camera', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <div id="show-camera-det" style="display:<?= $model->camera == 'Y' ? "block" : "none" ?>" >
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'tipo_camera'); ?></label>
                    <? echo $form->dropDownList($model, "tipo_camera", $model->selectCamere, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
                </div>
            </div>
        </div>
        <div class="row row-10 " >
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'quartieri'); ?></label><br />
                <? echo $form->dropDownList($model, "quartieri", $model->selectQuartieri, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>   </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'coabitazione'); ?></label><br />
                <? echo $form->dropDownList($model, "coabitazione", $model->selectCoabitazione, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>     </div>

            <div class="col-xs-12 col-md-3">
                <div style="width: 50% ; float: left">
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'coinquilini'); ?></label><br />
                    <?php echo $form->radioButtonList($model, 'coinquilini', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>

                </div> 
                <div style="width: 50% ; float: left">
                    <div id="show-coinquilini-det" style="display:<?= $model->coinquilini == 'Y' ? "inlineblock" : "none" ?>" >
                        <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'coinquilini_n'); ?></label><br />
                        <?php echo $form->textField($model, 'coinquilini_n', array('class' => 'form-control')); ?>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-3">
                <div style="width: 50% ; float: left">
                    <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'animali'); ?></label><br />
                    <?php echo $form->radioButtonList($model, 'animali', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>

                </div>
                <div style="width: 50% ; float: left">
                    <div id="show-animali-det" style="display:<?= $model->animali == 'Y' ? "block" : "none" ?>" >
                        <label for="" class="control-label label-no-margin"><?php echo $form->labelEx($model, 'animali_det'); ?></label><br />
                        <?php echo $form->textField($model, 'animali_det', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-10 row-bottom" >
            <div class="col-xs-12 col-md-6">
                <?php echo $form->labelEx($model, 'interessato'); ?><br />
                <? echo $form->textArea($model, "interessato", array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-6">
                <?php echo $form->labelEx($model, 'note'); ?><br />
                <? echo $form->textArea($model, "note", array('class' => 'form-control')); ?> 
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