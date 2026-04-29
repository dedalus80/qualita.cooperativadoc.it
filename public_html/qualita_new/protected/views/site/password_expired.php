<div class="container" id="expired-form">
    <div class="row login-logo">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'login-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array('class' => 'form-horizontal')
                            ));
                    ?>
                <div class="panel-heading" style=" text-align: left; padding: 10px ; border-radius: none;border-bottom: #dadfe3 1px solid">
                     <img class='img-responsive' src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-login-qualita.png" />
                </div>
                <div class="panel-body" style="border: none !important; border-radius: 0px" >
                    <div class="alert alert-dismissable alert-danger" id='alert-ko' style='display: none'>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <i class="fa fa-fw fa-warning"></i>&nbsp; <strong>Attenzione</strong><br />
                        <span id='reset-ko-text' style='text-align: left' ></span>
                    </div>
                    
                    <?php if (Yii::app()->user->hasFlash('opResultKO')): ?>
                        <div class="alert alert-dismissable alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <i class="fa fa-fw fa-warning"></i>&nbsp; <strong>Attenzione</strong><br /><?php echo Yii::app()->user->getFlash('opResultKO'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="general-box">
                        <div id="box-login">
                            <h3>Benvenuto <?php echo $model->user;?></h3>
                            <div class="form-group">
                                <div class="col-xs-12 login-txt" style='text-align: left'>
                                La tua password è scaduta, creane una nuova per accedere alla tua area riservata
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 login-txt" style="text-align:left">
                                    La password deve essere formata da almeno 8 caratteri e avere le seguenti caratteristiche:<br />
                                    <ul>
                                        <li>contenere almeno un numero</li>
                                        <li>contenere almeno una lettera maiuscola</li>
                                        <li>contenere almeno una lettera minuscola</li>
                                        <li>contenere almeno un carattere simbolo</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 10px">
                                <div class="col-xs-12">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <?php echo $form->passwordField($model, 'newPassword', array('size' => 40, 'placeholder' => 'Nuova password', 'class' => 'form-control')); ?>
                                    </div>
                                    <span id="StrengthDisp" class="badge displayBadge" style="display:none">Debole</span>
                                    <?php echo $form->error($model, 'newPassword'); ?>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 10px">
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <?php echo $form->passwordField($model, 'repeatPassword', array('size' => 40, 'placeholder' => 'Ripeti password', 'class' => 'form-control')); ?>
                                    </div>
                                    <?php echo $form->error($model, 'repeatPassword'); ?>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="panel-footer">
                    <div class="clearfix" style="padding:15px">
                        <div id='btn-login'>
                            <?php echo CHtml::submitButton('SALVA', array("class" => "btn btn-orange pull-right login-btn" ,'id' => 'pulsante-salva')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>