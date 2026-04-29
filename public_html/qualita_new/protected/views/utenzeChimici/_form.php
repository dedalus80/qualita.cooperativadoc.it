 <?php $form = $this->beginWidget('CActiveForm', array('id' => 'utenze-chimici-form','enableAjaxValidation' => true,'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
 ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <? if(!$model->id){?>
    <div class="row row-10">
        <div class="col-xs-12 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'anno'); ?></label>
             <? echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'class' => 'form-control utenza') ); ?>
        </div>
        <div class="col-xs-12 col-md-10">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'struttura'); ?></label>
            <?php
            // if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
            //    echo$form->dropDownList($model, "struttura", $model->selectStrutture, array('empty' => 'Scegli', 'class' => 'form-control utenza') );
            if (Yii::app()->user->getState('group') == 'ADMIN') {
                echo $form->dropDownList($model, "struttura",  CHtml::listData(Strutture::model()->findAll(['order'=>'nome']), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            }
            else {
                echo  "<br>".Yii::app()->MyUtils->getSelectValue($model->struttura, 'doc_unita');
                    echo $form->hiddenField($model, 'struttura');
            }
            ?>
           
        </div>
    </div> 
    <?}else{ ?>
      <div class="row row-10">
            
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label">Presenze</label>
                <? echo $model->presenze ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label">Superficie</label>
                <? echo $model->superficie ?>
            </div>
        </div>
    <?} ?>
    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'gennaio'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'gennaio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_gennaio', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'febbraio'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'febbraio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_febbraio', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'marzo'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'marzo', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_marzo', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'aprile'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'aprile', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_aprile', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'maggio'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'maggio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_maggio', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'giugno'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'giugno', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_giugno', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luglio'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'luglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_luglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'agosto'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'agosto', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_agosto', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'settembre'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'settembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_settembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ottobre'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'ottobre', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_ottobre', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'novembre'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'novembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_novembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dicembre'); ?></label>
            <div class="row">
                <div class='col-xs-6'>
                    <div class="input-group date">
                        <span class="input-group-addon">LITRI</span><?php echo $form->textField($model, 'dicembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='col-xs-6'> 
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-euro"></i></span><?php echo $form->textField($model, 'c_dicembre', array('class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange convalida_utenza', 'id' => 'utenze-chimici-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
