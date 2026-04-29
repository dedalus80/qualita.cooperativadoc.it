<?php
/* @var $this QuestionarioDocController */
/* @var $model QuestionarioDoc */
/* @var $form CActiveForm */

$giudizzi = $model->getSelect('doc_giudizzi');
$consiglia = $model->getSelect('doc_consiglia');
$strutture = $model->getSelect('doc_unita', '11');
?>


<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
       
            ));
    ?>

    <div class="row float-left">
        <?php
        echo $form->label($model, 'data_consegna');

        $attribute = 'data_restituzione';
        for ($i = 0; $i <= 1; $i++) {
            echo ($i == 0 ? Yii::t('main', 'Dal : ') : Yii::t('main', '  Al : '));
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'id' => CHtml::activeId($model, $attribute . '_' . $i),
                'model' => $model,
                'attribute' => $attribute . "[$i]",
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd'
                ),
                'htmlOptions' => array(
                    'size' => '8'
                ),
            ));
        }
        ?>
    </div>
    <div class='clear'></div>

    <div class="row float-left">
        <?php echo $form->label($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome', array('size' => 30, 'maxlength' => 30)); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'cognome'); ?>
        <?php echo $form->textField($model, 'cognome', array('size' => 30, 'maxlength' => 30)); ?>
    </div>
    <div class='clear'></div>


    <div class="row float-left">
        <?php echo $form->label($model, 'struttura_nome'); ?>
        <?php echo $form->dropDownList($model, 'struttura_nome', $strutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')); ?>

    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'vacanza'); ?>
        <?php echo $form->dropDownList($model, "vacanza", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'struttura_pulizia'); ?>
        <?php echo $form->dropDownList($model, "struttura_pulizia", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'struttura_complessivo'); ?>
        <?php echo $form->dropDownList($model, "struttura_complessivo", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'stanza_confort'); ?>
        <?php echo $form->dropDownList($model, "stanza_confort", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'stanza_arredi'); ?>
        <?php echo $form->dropDownList($model, "stanza_arredi", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'stanza_pulizia'); ?>
        <?php echo $form->dropDownList($model, "stanza_pulizia", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'stanza_complessivo'); ?>
        <?php echo $form->dropDownList($model, "stanza_complessivo", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_servizio'); ?>
        <?php echo $form->dropDownList($model, "ristorante_servizio", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_attesa'); ?>
        <?php echo $form->dropDownList($model, "ristorante_attesa", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_cibo'); ?>
        <?php echo $form->dropDownList($model, "ristorante_cibo", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_menu'); ?>
        <?php echo $form->dropDownList($model, "ristorante_menu", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_complessivo'); ?>
        <?php echo $form->dropDownList($model, "ristorante_complessivo", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'personale_cortesia'); ?>
        <?php echo $form->dropDownList($model, "personale_cortesia", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'personale_professionalita'); ?>
        <?php echo $form->dropDownList($model, "personale_professionalita", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'personale_complessivo'); ?>
        <?php echo $form->dropDownList($model, "personale_complessivo", $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'consiglia'); ?>
        <?php echo $form->dropDownList($model, "consiglia", $consiglia, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>

    <div class="row buttons float-right">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>
    <div class='clear'></div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->