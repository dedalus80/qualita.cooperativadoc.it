<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */
/* @var $form CActiveForm */




$camera = $model->getSelect('sp_camera');
$appartamento = $model->getSelect('sp_appartamento');
$nazione = $model->getSelect('doc_nazioni');
$occupazioni = $model->getSelect('sp_occupazione');
$conoscenza = $model->getSelect('sp_conoscenza');
$livello = $model->getSelect('sp_livello');
$quartiere = $model->getSelect('sp_quartiere');
$coabitazione = $model->getSelect('sp_coabitazione');

$siNo = array("Y" => "SI", "N" => "NO");
$sesso = array("M" => "Maschio", "F" => "Femmina");
?>
<script>

    function showFormula(){
        var formula = document.getElementById('ShPreiscrizioni_formula').options[document.getElementById('ShPreiscrizioni_formula').selectedIndex].value;
        
        if(formula==1){
            document.getElementById("campus_box").style.display ='block';
            document.getElementById("housing_box").style.display ='none';
        }
        else if(formula==2){
            document.getElementById("housing_box").style.display ='block';
            document.getElementById("campus_box").style.display ='none';
        }
        else{
            document.getElementById("housing_box").style.display ='none';
            document.getElementById("campus_box").style.display ='none';
        }
    }


</script>

<style>
    .anno{
        width: 120px!important;
    }
</style>


<div class="form" style='margin-top: 10px'>
    <h1>Ricerca Form Online Stessopiano: <span class='red'><?= $model->id ?></span></h1>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sp-preiscrizioni-form',
        'enableClientValidation' => true,
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
    <div class="flaot_right big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'cellulare'); ?>
            <?php echo $form->textField($model, 'cellulare', array('size' => 17)); ?>
            <?php echo $form->error($model, 'cellulare'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('size' => 17)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
        <div class='clear'></div>    
    </div>
    <div class='clear'></div>  
    <div class="flaot_left big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'data_nascita'); ?>

            <?
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'data_nascita',
                'options' => array(
                    'dateFormat' => 'dd-mm-yy',
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                ),
                'htmlOptions' => array(
                    'size' => '10', // textField size
                    'maxlength' => '10', // textField maxlength
                ),
            ));
            ?>


            <?php echo $form->error($model, 'data_nascita'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'luogo_nascita'); ?>
            <?php echo $form->textField($model, 'luogo_nascita', array('size' => 17)); ?>
            <?php echo $form->error($model, 'luogo_nascita'); ?>
        </div>
        <div class='clear'></div>    
    </div>
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'nazionalita'); ?>
        <? echo $form->dropDownList($model, "nazionalita", $nazione, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'nazionalita'); ?>
    </div>

    <div class='flaot_left big'>
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'sesso'); ?>
            <? echo $form->radioButtonList($model, 'sesso', $sesso, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
            <?php echo $form->error($model, 'sesso'); ?>

        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'privacy'); ?>
            <? echo $form->radioButtonList($model, 'privacy', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
            <?php echo $form->error($model, 'privacy'); ?>

        </div>
        <div class='clear'></div>  



    </div>

    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'occupazione'); ?>
        <? echo $form->dropDownList($model, "occupazione", $occupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'occupazione'); ?>
    </div>
    <div class='clear'></div> 

    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'prima_volta'); ?>
        <? echo $form->radioButtonList($model, 'prima_volta', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
        <?php echo $form->error($model, 'prima_volta'); ?>
    </div>

    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'conoscenza'); ?>
        <? echo $form->dropDownList($model, "conoscenza", $conoscenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'conoscenza'); ?>
    </div>

    <div class='clear'></div> 

    <div class='flaot_left big'>
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'appartamento'); ?>
            <? echo $form->radioButtonList($model, 'appartamento', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
            <?php echo $form->error($model, 'appartamento'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'camera'); ?>
            <? echo $form->radioButtonList($model, 'camera', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
            <?php echo $form->error($model, 'camera'); ?>
        </div>
        <div class='clear'></div>

    </div>

    <div class='flaot_right big'>

        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'livello'); ?>
            <? echo $form->dropDownList($model, "livello", $livello, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
            ); ?>
            <?php echo $form->error($model, 'livello'); ?>
        </div>

        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'livello_altro'); ?>
            <?php echo $form->textField($model, 'livello_altro', array('size' => 25)); ?>
            <?php echo $form->error($model, 'livello_altro'); ?>
        </div>
        <div class='clear'></div>    

    </div>

    <div class='clear'></div>

    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'tipo_appartamento'); ?>
        <? echo $form->dropDownList($model, "tipo_appartamento", $appartamento, array('empty' => 'Scegli', 'options' => $sel, 'class' => '', 'onChange' => 'javascript:showFormula()')
        ); ?>
        <?php echo $form->error($model, 'tipo_appartamento'); ?>
    </div>


    <div class='flaot_right big '>

        <?php echo $form->labelEx($model, 'tipo_camera'); ?>
        <? echo $form->dropDownList($model, "tipo_camera", $camera, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'tipo_camera'); ?>

    </div>

    <div class='clear'></div>

    <div class="flaot_left big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'data_in'); ?>
            <?
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'data_in',
                'options' => array(
                    'dateFormat' => 'dd-mm-yy',
                ),
                'htmlOptions' => array(
                    'size' => '10', // textField size
                    'maxlength' => '10', // textField maxlength
                ),
            ));
            ?>
            <?php echo $form->error($model, 'data_in'); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'data_out'); ?>
            <?
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'data_out',
                'options' => array(
                    'dateFormat' => 'dd-mm-yy',
                ),
                'htmlOptions' => array(
                    'size' => '10', // textField size
                    'maxlength' => '10', // textField maxlength
                ),
            ));
            ?>
            <?php echo $form->error($model, 'data_out'); ?>
        </div>
        <div class='clear'></div>    
    </div>
    
    
    <div class='flaot_right big '>
        
        <div class="flaot_int ">
          <?php echo $form->labelEx($model, 'coinquilini'); ?>
        <? echo $form->radioButtonList($model, 'coinquilini', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
        <?php echo $form->error($model, 'coinquilini'); ?>
        </div>

        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'coinquilini_n'); ?>
            <?php echo $form->textField($model, 'coinquilini_n', array('size' => 3)); ?>
            <?php echo $form->error($model, 'coinquilini_n'); ?>
        </div>
        <div class='clear'></div> 
   </div>
   


    <div class='clear'></div>  





    <div class='flaot_left big '>
        <?php echo $form->labelEx($model, 'quartieri'); ?>
        <? echo $form->dropDownList($model, "quartieri", $quartiere, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'quartieri'); ?>
    </div>

    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'fumatore'); ?>
        <? echo $form->radioButtonList($model, 'fumatore', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
        <?php echo $form->error($model, 'fumatore'); ?>
    </div>

    <div class='clear'></div>





    <div class='flaot_left big '>
        
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'animali'); ?>
        <? echo $form->radioButtonList($model, 'animali', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>
        <?php echo $form->error($model, 'animali'); ?>
        </div>

        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'animali_det'); ?>
            <?php echo $form->textField($model, 'animali_det', array('size' => 25)); ?>
            <?php echo $form->error($model, 'animali_det'); ?>
        </div>
        <div class='clear'></div> 
   </div>

    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'coabitazione'); ?>
        <? echo $form->dropDownList($model, "coabitazione", $coabitazione, array('empty' => 'Scegli', 'options' => $sel, 'class' => '')
        ); ?>
        <?php echo $form->error($model, 'coabitazione'); ?>
    </div>
    <div class='clear'></div>

    <div class='flaot_left big '>
        <?php echo $form->labelEx($model, 'interessato'); ?>
        <? echo $form->textArea($model, "interessato", array('maxlength' => 320, 'rows' => 4, 'width' => 320)); ?>
    </div>

    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'note'); ?>
        <? echo $form->textArea($model, "note", array('maxlength' => 320, 'rows' => 4, 'width' => 320)); ?> 
    </div>
    <div class='clear'></div>



    <div class='flaot_right'>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Inserisci' : 'Aggiorna'); ?>
    </div>
    <div class='clear'></div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

