<?php
$this->breadcrumbs = array('Gestione profilo' => array('profilo'), $model->user => array('utente', 'id' => $model->id), 'Modifica',);
?>
<div class="panel panel-default panel-margin" style="margin-bottom:20px">
    <div class="panel-heading"><h2><img src="<?php echo Yii::app()->request->baseUrl; ?>/avatar/<?= $model->avatar ? $model->avatar : "default_avatar.png" ?>" class="avatar" />&nbsp;Modifica <span class='no-phone'>profilo</span> <span class='orange '><?= $model->user ?></span></h2></div>
    <div class="panel-body">
       <?php
        $form = $this->beginWidget('CActiveForm', array('id' => 'admin-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
        ?>
        <div>
            <?php echo $formhtml != 'changepassword' ? $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>") : ''; ?>

            <div class="row row-10">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <?php echo $form->labelEx($model, 'nome'); ?>
                    <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
                    <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
                </div> 
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'user'); ?></label>
                    <?php echo $form->textField($model, 'user', array('class' => 'form-control', 'disabled' => 'disabled')); ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'email'); ?></label> 
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                </div>
                <!--<div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'password'); ?></label>
                    <?php //echo $form->textField($model, 'password', array('class' => 'form-control')); ?>
                </div>-->
            </div> 
            <div class="row row-10 row-bottom">
               <!--<div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'user_type'); ?></label>
                    <? echo $form->dropDownList($model, "user_type", $model->selectTipi, array('empty' => 'Scegli', 'class' => 'form-control', 'disabled' => 'disabled')); ?>
                </div>
               <div class="col-xs-12 col-sm-6 col-md-3">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'user_unita'); ?></label>
                    <? echo $form->dropDownList($model, "user_unita", $model->selectUnita, array('empty' => 'Scegli', 'class' => 'form-control', 'disabled' => 'disabled')); ?>
                </div>-->
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'avatar'); ?> <?php echo $model->avatar ? "<a href='" . Yii::app()->request->baseUrl . "/avatar/" . $model->avatar . "' target='_blank' >" . $model->avatar . "</a>" : "";?>   </label>
                    <?php echo $form->fileField($model, 'avatar', array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="row row-bottom-top">
                <div class="col-xs-12">
                    <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'id' => 'utenti-btn', 'data-refer' => 'admin-form',)); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="panel panel-default panel-margin" style="margin-bottom: 100px">
    <div class="panel-heading"><h2><img src="<?php echo Yii::app()->request->baseUrl; ?>/avatar/<?= $model->avatar ? $model->avatar : "default_avatar.png" ?>" class="avatar" />&nbsp;Modifica <span class='no-phone'>password</span> <span class='orange '><?= $model->user ?></span></h2></div>
    <div class="panel-body">
       <?php
        $form = $this->beginWidget('CActiveForm',
            array(
                'id' => 'change-password-form',
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'action' => Yii::app()->createUrl('utenti/changepassword'),
            )
        );
        ?>
        <div>
            <?php echo $formhtml == 'changepassword' ? $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>") : ''; ?>

            <div class="row row-10">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <?php echo $form->labelEx($model, 'newPassword'); ?> <span class="required">*</span>
                    <?php echo $form->passwordField($model, 'newPassword', array('class' => 'form-control')); ?>
                    <span id="StrengthDisp" class="badge displayBadge" style="display:none">Debole</span>
                    <?php echo $form->error($model, 'newPassword'); ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <?php echo $form->labelEx($model, 'repeatPassword'); ?> <span class="required">*</span>
                    <?php echo $form->passwordField($model, 'repeatPassword', array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'repeatPassword'); ?>
                </div>
            </div>

            <div class="row row-bottom-top">
                <div class="col-xs-12">
                    <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Modifica", '#', array('class' => 'btn btn-orange btn-submit-form', 'id' => 'utenti-btn', 'data-refer' => 'change-password-form',)); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>