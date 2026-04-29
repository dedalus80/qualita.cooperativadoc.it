<?
$this->menu = array(
    array('label' => 'Inserisci Azione non conforme', 'url' => array('create')),
    array('label' => 'Visualizza Azione non conforme ', 'url' => array('admin'), 'itemOptions' => array('class' => 'last')),
);
?>

<div class="form" style='margin-top: 10px'>
    <h1>Inserisci azione non conforme</h1>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'contact-form',
        'enableClientValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

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
        <?php echo $form->labelEx($model, 'unita_operativa'); ?>
        <?
        if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
            echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno'));
        else
            echo $model->getSelectValue($model->unita_operativa, 'doc_unita');
        ?>
        <?php echo $form->error($model, 'unita_operativa'); ?>
    </div>
    <div class='clear'></div>


    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'societa'); ?>
        <? echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
        <?php echo $form->error($model, 'societa'); ?>
    </div>
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'funzione'); ?>
        <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
        <?php echo $form->error($model, 'funzione'); ?>
    </div>
    <div class='clear'></div>

    <div class='flaot_left big '>
        <?php echo $form->labelEx($model, 'tipologia'); ?>
        <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
        <?php echo $form->error($model, 'tipologia'); ?>
    </div>
    <div class='flaot_right  big'>
        <?php echo $form->labelEx($model, 'responsabile'); ?>
        <? echo $form->dropDownList($model, "responsabile", $model->selectResponsabili, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
        <?php echo $form->error($model, 'responsabile'); ?>
    </div>
    <div class='clear'></div>
    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'descrizione'); ?>
        <? echo $form->textArea($model, "descrizione", array('maxlength' => 320, 'rows' => 6, 'cols' => 30)); ?>
        <?php echo $form->error($model, 'descrizione'); ?>
    </div>
    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'trattamento'); ?>
        <? echo $form->textArea($model, "trattamento", array('maxlength' => 320, 'rows' => 6, 'width' => 320)); ?> 
        <?php echo $form->error($model, 'trattamento'); ?>
    </div>

    <div class='clear'></div>

    <? if ($_SESSION['user']['user_type'] == 1 || $_SESSION['user']['user_type'] == 3) { ?>
        <div class='flaot_left  big'>
            <?php echo $form->labelEx($model, 'chiusura'); ?>
            <? echo $form->dropDownList($model, "chiusura", $model->selectChiusure, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
            <?php echo $form->error($model, 'chiusura'); ?>
        </div>
        <div class='flaot_right big '>
            <?php echo $form->labelEx($model, 'allegato'); ?>
            <? echo $form->fileField($model, 'allegato'); ?> 
            <?php echo $form->error($model, 'allegato'); ?>
            <?= $model->allegato ? "<div>Allegato:" . $model->allegato . "</div>" : "" ?>
        </div>
    <? } else { ?>
        <div class='flaot_left  big'>
            <?php echo $form->labelEx($model, 'allegato'); ?> 
            <? echo $form->fileField($model, 'allegato'); ?> 
            <?php echo $form->error($model, 'allegato'); ?>
            <?= $model->allegato ? "<div>Allegato:" . $model->allegato . "</div>" : "" ?>
        </div>

    <? } ?>
    <div class='clear'></div>



    <div class='flaot_right'>
        <?php echo CHtml::submitButton('Inserisci'); ?>
    </div>
    <div class='clear'></div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
