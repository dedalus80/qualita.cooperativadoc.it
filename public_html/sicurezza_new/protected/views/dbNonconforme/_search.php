<div class="wide form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>

    <div class='flaot_left big '>
        <?
        echo $form->labelEx($model, 'unita_operativa');
        if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
            echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno'));
        else
            echo $model->getSelectValue($model->unita_operativa, 'doc_unita');
        ?>
    </div>
    <div class='clear'></div>

    <div class='flaot_right big'>
        <?= $model->selectCodici ? $form->labelEx($model, 'codice') : ""; ?>
        <?= $model->selectCodici ? $form->dropDownList($model, "codice", $model->selectCodici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')) : ""; ?>
    </div>
    <div class="flaot_left " >
        <?= $form->labelEx($model, 'tipologia'); ?>
        <?= $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='clear'></div>


    <div class="flaot_left big">
        <div class="flaot_int ">
            <?= $form->labelEx($model, 'cognome'); ?>
            <?= $form->textField($model, 'cognome', array('size' => 17)); ?>
        </div>
        <div class="flaot_right_int" >
            <?= $form->labelEx($model, 'nome'); ?>
            <?= $form->textField($model, 'nome', array('size' => 17)); ?>
        </div>
        <div class='clear'></div>    
    </div>


    <div class='flaot_right big'>
        <?= $form->labelEx($model, 'societa'); ?>
        <?= $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='clear'></div>
    <div class='flaot_left big'>
        <?= $form->labelEx($model, 'funzione'); ?>
        <?= $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='flaot_right big'>
        <?= $form->labelEx($model, 'responsabile'); ?>
        <?= $form->dropDownList($model, "responsabile", $model->selectResponsabili, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='clear'></div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- search-form -->