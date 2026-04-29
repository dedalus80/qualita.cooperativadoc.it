<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs=array(
	'Azioni correttive / preventive '=>array('admin'),
	'Inserisci',
);

$this->menu=array(
	array('label'=>'Inserisci azione correttiva / preventiva', 'url'=>array('create')),
	array('label'=>'Visualizza azioni correttive / preventive', 'url'=>array('admin'), 'itemOptions' => array('class' => 'last')),
);
?>

<div class="form" style='margin-top: 10px'>
    <h1>Inserisci azione non conforme</h1>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>
    <div class="flaot_left big">
    <div class='flaot_int'>
        <?php echo $form->labelEx($model, 'codice_riferimento'); ?>
        <?php echo $form->dropDownList($model, 'codice_riferimento',$codici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'myslim'));?>
         <?php echo $form->error($model, 'codice_riferimento'); ?>
    </div>
    <div class='flaot_right_int'>
        <?php echo $form->labelEx($model, 'tipo_azione'); ?>
        <?php echo $form->dropDownList($model, 'tipo_azione',$azione, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'myslim'));?>
         <?php echo $form->error($model, 'tipo_azione'); ?>
    </div>
        
    <div class='clear'></div>
</div>
    <div class="flaot_right big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome',array('size' => 17)); ?>
            <?php echo $form->error($model, 'cognome'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'nome'); ?>
            <?php echo $form->textField($model, 'nome',array('size' => 17)); ?>
            <?php echo $form->error($model, 'nome'); ?>
        </div>
        <div class='clear'></div>    
    </div>
    <div class='clear'></div>  
    
    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'societa'); ?>
        <? echo $form->dropDownList($model, "societa", $societa, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'societa'); ?>
    </div>
   


    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'unita_operativa'); ?>
        <? echo $form->dropDownList($model, "unita_operativa", $unita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'unita_operativa'); ?>
    </div>
    
     <div class='clear'></div>
    
    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'funzione'); ?>
        <? echo $form->dropDownList($model, "funzione", $funzione, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'funzione'); ?>
    </div>
    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'tipologia'); ?>
        <? echo $form->dropDownList($model, "tipologia", $tipologia, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'tipologia'); ?>
    </div>
     <div class='clear'></div>
    
    <div class='clear'></div>
     <div class='flaot_left big '>
        <?php echo $form->labelEx($model, 'trattamento'); ?>
        <? echo $form->textArea($model, "trattamento", array('maxlength' => 320, 'rows' => 6, 'width'=>320 )); ?> 
        <?php echo $form->error($model, 'trattamento'); ?>
    </div>
    <div class='flaot_right big'>
        
        <?php echo $form->labelEx($model, 'descrizione'); ?> 
        <? echo $form->textField($model, "descrizione"); ?>
        <?php echo $form->error($model, 'descrizione'); ?>
    </div>
   
    <div class='clear'></div>
    
    
    


      <div class='flaot_right'>
        <?php echo CHtml::submitButton('Inserisci'); ?>
    </div>
    <div class='clear'></div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
