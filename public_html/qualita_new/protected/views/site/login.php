<div class="container" id="login-form">
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
                    <div class="alert alert-dismissable alert-success" id='alert-ok' style="display: none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <i class="fa fa-fw fa-check"></i>&nbsp; <strong>Recupero password</strong><br />
                        <span id='reset-ok-text' style='text-align: left'></span>
                    </div>
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

                    <?php if (Yii::app()->user->hasFlash('activation')): ?>
                        <div class="alert alert-dismissable alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <i class="fa fa-fw fa-success"></i>&nbsp; <strong>Ben fatto!</strong><br /><?php echo Yii::app()->user->getFlash('activation'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (Yii::app()->user->hasFlash('maintenance')): ?>
                        <div class="alert alert-dismissable alert-warning">
                            <h4> <i class="fa fa-fw fa-warning"></i><?php echo Yii::app()->user->getFlash('maintenance'); ?></h4>
                        </div>
                    <?php else: ?>

                    <div id='general-box'>
                    <div id='box-login'>
                        <div class="form-group">
                            <div class="col-xs-12 login-txt" style='text-align: left'>
                            Inserisci nome utente e password per accedere all'area riservata
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px">
                            <div class="col-xs-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <?php echo $form->textField($model, 'username', array('size' => 40, 'placeholder' => 'Email Username', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'username'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <?php echo $form->passwordField($model, 'password', array('size' => 40, 'placeholder' => 'Password', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'password'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <a href='#' id='btn-forgot'>Password dimenticata ?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id='box-reset' style='display: none'>
                        <div class="form-group" style="margin-bottom: 10px; text-align: left">
                            <div class="col-xs-12 login-txt">
                            Inserisci il tuo indirizzo email per ricevere una nuova password
                            </div>
                        </div>
                        <!--
                        <div class="form-group" style="margin-bottom: 10px">
                            <div class="col-xs-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <?php echo $form->textField($model, 'nome', array('size' => 40, 'placeholder' => 'Nome utente', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'nome'); ?>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="form-group" style="margin-bottom: 10px">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <?php echo $form->textField($model, 'email', array('size' => 40, 'placeholder' => 'Indirizzo Email', 'class' => 'form-control')); ?>
                                    <?php echo $form->error($model, 'email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <a href='#' id='btn-remember'>Mi ricordo la password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>    
                    <?php endif; ?>
                </div>
                <div class="panel-footer">
                    <div class="clearfix" style='padding:15px'>
                        <?php if (!Yii::app()->user->hasFlash('maintenance')): ?>
                            <div id='btn-login'>
                            <?php echo CHtml::submitButton('ACCEDI', array("class" => "btn btn-orange pull-right login-btn" ,'id' => 'pulsante-accedi')); ?>
                            </div>
                            <div id='btn-reset'>
                            <input class="btn btn btn-orange pull-right" type="button" id='pulsante-reset' name="" value="INVIA" style='display: none'>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    
    <div class="row" style="background-color:#ffffff;padding:20px;text-align:center;margin-bottom:20px">
        <h2>App DOCFix</h2>
        <div class="col-md-3"></div>
        <div class="col-md-2" style="text-align:center;padding-top:2rem">
            <a href="https://apps.apple.com/it/app/docfix/id6738959685" target="_blank">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/App_Store_Badge_IT_blk_100317.png" style="height:40px" />
            </a>
        </div>
        <div class="col-md-2" style="text-align:center;padding-top:2rem">
            <a href="https://qualita.cooperativadoc.it/qualita_new/media/docfix.apk" target="_blank">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/GetItOnGooglePlay_Badge_Web_color_Italian.png" style="height:40px" />
            </a>
        </div>
        <div class="col-md-2" style="text-align:center;padding-top:2rem">
            <button type="button" class="btn btn-success" onclick="(function(){window.location.href='https://cooperativadoc.jotform.com/243525911337961'})();return false;">Richiedi accesso</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>