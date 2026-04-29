<?php
/* @var $this QuestionarioSharingController */
/* @var $model QuestionarioSharing */
/* @var $form CActiveForm */




$camera = $model->getSelect('sp_camera');
$appartamento = $model->getSelect('sp_appartamento');
$nazione = $model->getSelect('doc_nazioni');
$occupazioni = $model->getSelect('sp_occupazione');
$conoscenza = $model->getSelect('sp_conoscenza');

$siNo = array("Y" => "SI", "N" => "NO");
$sesso = array("M" => "Maschio", "F" => "Femmina");
?>
<script>

    function showFormula(){
        var formula = document.getElementById('SpPreiscrizioni_formula').options[document.getElementById('ShPreiscrizioni_formula').selectedIndex].value;
        
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
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>


    <div class="flaot_left big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome', array('size' => 17)); ?>

        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'nome'); ?>
            <?php echo $form->textField($model, 'nome', array('size' => 17)); ?>

        </div>
        <div class='clear'></div>    
    </div>
    <div class="flaot_right big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'cellulare'); ?>
            <?php echo $form->textField($model, 'cellulare', array('size' => 17)); ?>

        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('size' => 17)); ?>

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
        <? echo $form->dropDownList($model, "nazionalita", $nazione, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>

    </div>

    <div class='flaot_left big'>
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'sesso'); ?>
            <? echo $form->radioButtonList($model, 'sesso', $sesso, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>


        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'privacy'); ?>
            <? echo $form->radioButtonList($model, 'privacy', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>


        </div>
        <div class='clear'></div>  



    </div>

    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'occupazione'); ?>
        <? echo $form->dropDownList($model, "occupazione", $occupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>

    </div>
    <div class='clear'></div>    
    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'prima_volta'); ?>
        <? echo $form->radioButtonList($model, 'prima_volta', $siNo, array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ',)); ?>

    </div>

    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'conoscenza'); ?>
        <? echo $form->dropDownList($model, "conoscenza", $conoscenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>

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
    <div class='clear'></div>  


    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'tipo_appartamento'); ?>
        <? echo $form->dropDownList($model, "tipo_appartamento", $appartamento, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'tipo_appartamento'); ?>
    </div>
    
    <div class='flaot_right big '>
        <?php echo $form->labelEx($model, 'tipo_camera'); ?>
        <? echo $form->dropDownList($model, "tipo_camera", $camera, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')
        ); ?>
        <?php echo $form->error($model, 'tipo_camera'); ?>
    </div>
    <div class='clear'></div>
    <div class="row buttons float-right">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>
    <div class='clear'></div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->