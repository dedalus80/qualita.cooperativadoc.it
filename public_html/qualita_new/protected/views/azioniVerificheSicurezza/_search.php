<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'POST', 'id' => 'search-form-int')); ?>
     <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></label>
        <div class="col-xs-8">
            <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
        <div class="col-xs-8">
            <?
            if ($model->datiAdmin['admin'] == true)
                echo $form->dropDownList($model, "unita_operativa", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            else
                echo "<span class='struttura-line'>" . Yii::app()->MyUtils->getSelectValue($model->datiAdmin['user_unita'], 'doc_unita') . " " . $form->hiddenField($model, 'unita_operativa', array('value' => $model->datiAdmin['user_unita'])) . "</span>";
            ?> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'codice_verifica'); ?></label>
        <div class="col-xs-8">
            <?php echo $form->dropDownList($model, "id", $model->selectCodici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group"  >
        <label class="col-xs-3 control-label hidden-480"><?php echo $form->labelEx($model, 'tipo_valutazione'); ?></label>
        <div class="col-xs-12 col-sm-8"> 
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'tipo_valutazione', array('A' => '&nbsp;AUTOVALUTAZIONE&nbsp;&nbsp;&nbsp;', 'V' => '&nbsp;VALUTAZIONE&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->