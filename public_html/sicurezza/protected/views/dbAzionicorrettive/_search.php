<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>
    <div class="flaot_left big">
        <div class='flaot_int'>
            <?php echo $form->labelEx($model, 'codice_riferimento'); ?>
            <?php echo $model->selectCodici ? $form->dropDownList($model, 'codice_riferimento', $model->selectCodici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'myslim')):""; ?>
        </div>
        <div class='flaot_right_int'>
            <?php echo $form->labelEx($model, 'tipo_azione'); ?>
            <?php echo $form->dropDownList($model, 'tipo_azione', $model->selectAzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'myslim')); ?>
        </div>
        <div class='clear'></div>
    </div>
    <div class="flaot_right big">
        <?php echo $form->labelEx($model, 'unita_operativa'); ?>
        <?
        if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
            echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno'));
        else
            echo $model->getSelectValue($model->unita_operativa, 'doc_unita');
        ?>
    </div>

    <div class='clear'></div> 
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'societa'); ?>
        <? echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'slim')); ?>
    </div>
    <div class='flaot_left big'>
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
    <div class='clear'></div> 
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'funzione'); ?>
        <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'slim')
        ); ?>
    </div>
    <div class='flaot_left big '>
        <?php echo $form->labelEx($model, 'tipologia'); ?>
        <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'slim')
        ); ?>
    </div>
    <div class='clear'></div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
