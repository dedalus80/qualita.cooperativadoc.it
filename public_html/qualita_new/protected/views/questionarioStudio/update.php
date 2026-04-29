<?php
$this->breadcrumbs = array('Questionari vacanze studio' => array('admin'), 'Modifica questionario',);
?>
<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-question'></i>&nbsp;Modifica questionario <span class='orange return-block'><?= $model->nome . " " . $model->cognome ?> </span></h2></div>
    <div class="panel-body ">
        <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'questionarioStudio-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array('validateOnSubmit' => true,),));
        ?>
        <div>
            <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
            <div class="row row-10">
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
                    <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
                    <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'eta'); ?></label>
                    <?php echo $form->dropDownList($model, "eta", $model->selectEta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
                </div>
            </div>
            <div class="row row-10">
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome_coordinatore'); ?></label>
                    <?php echo $form->textField($model, 'nome_coordinatore', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome_coordinatore'); ?></label>
                    <?php echo $form->textField($model, 'cognome_coordinatore', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome_gruppo'); ?></label>
                    <?php echo $form->textField($model, 'nome_gruppo', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-10">
                <div class="col-xs-12 col-sm-3 ">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_restituzione'); ?></label>
                    <div class="input-group date" style="max-width: 150px" >
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo $form->textField($model, 'data_restituzione', array('class' => 'form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data_restituzione))); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'soggiorno'); ?></label>
                    <?php echo $form->dropDownList($model, "soggiorno", $model->selectSoggiorni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'turno'); ?></label>
                    <?php echo $form->dropDownList($model, "turno", $model->selectTurni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
                </div>
                <div class="col-xs-12 col-md-3">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'organizzatore'); ?></label>
                    <?php echo $form->dropDownList($model, "organizzatore", $model->selectOrganizzazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')) ?>
                </div>
            </div>
            <div class="question-body" style='margin-top: 20px;'>
                <div class="row  title">
                    <div class="col-xs-12 col-sm-6 "> <span class='bold'>QUESITO</span></div>
                    <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>MOLTO</span></div>
                    <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>ABBASTANZA</span></div>
                     <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>POCO</span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'divertimento'); ?></span></div>
                    <div class="col-xs-12  col-sm-6  right" ><span id="rgv1"><?php echo $form->radioButtonList($model, 'divertimento', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'educatori'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv2"><?php echo $form->radioButtonList($model, 'educatori', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'compagni'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right "><span id="rgv3"><?php echo $form->radioButtonList($model, 'compagni', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'giochi'); ?></span></div>
                    <div class="col-xs-12  col-sm-6  right"><span id="rgv4"><?php echo $form->radioButtonList($model, 'giochi', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'attivita_sportive'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv5"><?php echo $form->radioButtonList($model, 'attivita_sportive', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'gite'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv6"><?php echo $form->radioButtonList($model, 'gite', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'laboratori'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv7"><?php echo $form->radioButtonList($model, 'laboratori', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'studio_localita'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv8"><?php echo $form->radioButtonList($model, 'studio_localita', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'studio_college'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv9"><?php echo $form->radioButtonList($model, 'studio_college', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'studio_corso'); ?></span></div>
                    <div class="col-xs-12  col-sm-6 right"><span id="rgv10"><?php echo $form->radioButtonList($model, 'studio_corso', array('M' => '', 'A' => '', 'P' => ""), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-suf', 'separator' => '&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;')); ?></span></div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 ">
                        <b><?= $form->labelEx($model, 'studio_aspetto_vacanza'); ?></b>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 " style="padding: 5px 0px 5px 0px">
                        <? echo $form->textArea($model, "studio_aspetto_vacanza", array('rows' => 1, 'class' => 'form-control', 'html' => true)); ?> 
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 ">
                        <b><?= $form->labelEx($model, 'studio_attivita_utile'); ?></b>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 " style="padding: 5px 0px 5px 0px">
                        <? echo $form->textArea($model, "studio_attivita_utile", array('rows' => 1, 'class' => 'form-control', 'html' => true)); ?> 
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12">
                        <b><?= $form->labelEx($model, 'suggerimenti'); ?></b>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12" style="padding: 5px 0px 5px 0px">
                        <? echo $form->textArea($model, "suggerimenti", array('rows' => 1, 'class' => 'form-control', 'html' => true)); ?> 
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12">
                        <b><?= $form->labelEx($model, 'osservazioni'); ?></b>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12" style="padding: 5px 0px 5px 0px">
                        <? echo $form->textArea($model, "osservazioni", array('rows' => 1, 'class' => 'form-control', 'html' => true)); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-sm ', 'id' => 'questionarioStudio-btn')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>