<?php
/* @var $this UtentiController */
/* @var $model Utenti */
/* @var $form CActiveForm */

?>


<div class="form" style='margin-top: 10px'> 
   
    
   <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utenti-form',
	'enableAjaxValidation'=>true,
)); ?>
 

    <div class="flaot_left big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome', array('size' => 17)); ?>
            <?php echo $form->error($model, 'cognome'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'nome'); ?>
            <?php echo $form->textField($model, 'nome', array('size' => 17)); ?>
            <?php echo $form->error($model, 'nome'); ?>
        </div>
        <div class='clear'></div>    
    </div>
    
    <div class='flaot_right big'>
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'user'); ?>
            <?php echo $form->textField($model, 'user', array('size' => 17)); ?>
            <?php echo $form->error($model, 'user'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->textField($model, 'password', array('size' => 17)); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <div class='clear'></div>  
        
        
        
    </div>
    <div class='clear'></div>


    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'user_type'); ?>
        <? echo $form->dropDownList($model, "user_type", $model->selectTipi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'user_type'); ?>
    </div>
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'email'); ?>
        <? echo $form->textField($model, "email", array('size' => 45)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class='clear'></div>
     <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'user_unita'); ?>
        <? echo $form->dropDownList($model, "user_unita", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'user_unita'); ?>
    </div>
    <div class='clear'></div>



    <div style='margin-top: 20px'>
         <?php echo CHtml::submitButton($model->isNewRecord ? 'Inserisci' : 'Aggiorna'); ?>
    </div>
    <div class='clear'></div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
