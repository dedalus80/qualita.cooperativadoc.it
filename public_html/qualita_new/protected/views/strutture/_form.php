<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'strutture-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
    <div class="wide form form-horizontal row-border">
        <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
        <div class="form-group first-row">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <div class="col-xs-8">
                <?php echo    $form->textField($model,'nome',array('class'=> 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'codice'); ?></label>
            <div class="col-xs-8">
                <?php echo    $form->textField($model,'codice',array('class'=> 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'superficie'); ?></label>
            <div class="col-xs-8">
                <?php echo    $form->textField($model,'superficie',array('class'=> 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'colore'); ?></label>
            <div class="col-xs-8 top7" id='form-colorpicker'>
                <select class="simple-colorpicker-1">
                <? foreach ($model->selectColori AS $id => $val) { ?>
                    <option value="<?= $val ?>" data-id-color="<?= $id ?>" <?= $id == $model->colore ? "selected='selected'" : "" ?> > <?= $val ?></option>
                <? } ?>
            </select>
                <? echo $form->hiddenField($model, "colore",array("value" => Yii::app()->MyUtils->getSelectValue($model->colore, "nome_colore"))); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'tipologia'); ?></label>
            <div class="col-xs-8">
                <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'centro'); ?></label>
            <div class="col-xs-8">
                <? echo $form->dropDownList($model, "centro", $model->selectCentri, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'ente'); ?></label>
            <div class="col-xs-8">
                <? echo $form->dropDownList($model, "ente", $model->selectClienti, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label"><?php echo $form->labelEx($model, 'soloq'); ?></label>
            <div class="col-xs-8 top7">
               <?php echo $form->radioButtonList($model, 'soloq', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label">Questionari</label>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qdoc'); ?><br />
                <?php echo $form->radioButtonList($model, 'qdoc', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qkeluar'); ?><br />
                <?php echo $form->radioButtonList($model, 'qkeluar', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qsharing'); ?><br />
                <?php echo $form->radioButtonList($model, 'qsharing', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qcampus'); ?><br />
                <?php echo $form->radioButtonList($model, 'qcampus', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>

            </div>
        </div>

        <div class="form-group first-row">
            <label class="col-xs-2 control-label"></label>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qscientifici'); ?><br />
                <?php echo $form->radioButtonList($model, 'qscientifici', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>

            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qsenior'); ?><br />
                <?php echo $form->radioButtonList($model, 'qsenior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qjunior'); ?><br />
                <?php echo $form->radioButtonList($model, 'qjunior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qstudio'); ?><br />
                <?php echo $form->radioButtonList($model, 'qstudio', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
            <div class="col-xs-2">
                <?php echo $form->labelEx($model, 'qsport'); ?><br />
                <?php echo $form->radioButtonList($model, 'qsport', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-xs-2 control-label">Iscrizioni</label>
            <div class="col-xs-8">
                <?php echo $form->labelEx($model, 'qsmog'); ?><br />
                <?php echo $form->radioButtonList($model, 'qsmog', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>

            </div>

        </div>
    </div>
    <div class="panel-footer">
        <div class="pull-right">
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'strutture-btn')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
