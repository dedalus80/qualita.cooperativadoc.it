<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'cognome'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'cellulare'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'cellulare', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'ruolo'); ?></div>
        <div class="col-xs-8"> <? echo $form->dropDownList($model, "ruolo", $model->selectRuoli, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'focus'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "focus", $model->selectFocus, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'percorso'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "percorso", $model->selectPercorsi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->