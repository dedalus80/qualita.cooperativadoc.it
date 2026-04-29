<?php
/* @var $this QuestionarioKeluarController */
/* @var $model QuestionarioKeluar */
/* @var $form CActiveForm */

$giudizzi = $model->getSelect('doc_giudizzi');
$consiglia = $model->getSelect('doc_consiglia');
$strutture = $model->getSelect('doc_unita','11');
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
    <div class='clear'></div>
    
    <div class="row float-left">
        <?php echo $form->label($model, 'viaggio_complessivo'); ?>
        <?php echo $form->dropDownList($model, 'viaggio_complessivo', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'struttura_complessivo'); ?>
        <?php echo $form->dropDownList($model, 'struttura_complessivo', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'rapporto_keluar'); ?>
        <?php echo $form->dropDownList($model, 'rapporto_keluar', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>


    <div class="row float-left">
        <?php echo $form->label($model, 'trasporto_qualita'); ?>
        <?php echo $form->dropDownList($model, 'trasporto_qualita', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'trasporto_cortesia'); ?>
        <?php echo $form->dropDownList($model, 'trasporto_cortesia', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'trasporto_tempi'); ?>
        <?php echo $form->dropDownList($model, 'trasporto_tempi', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_servizio'); ?>
        <?php echo $form->dropDownList($model, 'ristorante_servizio', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_cibo'); ?>
        <?php echo $form->dropDownList($model, 'ristorante_cibo', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'ristorante_menu'); ?>
        <?php echo $form->dropDownList($model, 'ristorante_menu', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'personale_cortesia'); ?>
        <?php echo $form->dropDownList($model, 'personale_cortesia', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'personale_disponibilita'); ?>
        <?php echo $form->dropDownList($model, 'personale_disponibilita', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'escursioni_itinerari'); ?>
        <?php echo $form->dropDownList($model, 'escursioni_itinerari', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'escursioni_guida'); ?>
        <?php echo $form->dropDownList($model, 'escursioni_guida', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'neve_noleggio'); ?>
        <?php echo $form->dropDownList($model, 'neve_noleggio', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'neve_scuola'); ?>
        <?php echo $form->dropDownList($model, 'neve_scuola', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'laboratori_tecnici'); ?>
        <?php echo $form->dropDownList($model, 'laboratori_tecnici', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>

    <div class="row float-left">
        <?php echo $form->label($model, 'laboratori_competenze'); ?>
        <?php echo $form->dropDownList($model, 'laboratori_competenze', $giudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row float-left">
        <?php echo $form->label($model, 'consiglia'); ?>
        <?php echo $form->dropDownList($model, 'consiglia', $consiglia, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'giudizzio')); ?>
    </div>
    <div class='clear'></div>
    <div class="row buttons float-right">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>
    <div class='clear'></div>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->