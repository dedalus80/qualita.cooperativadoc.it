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
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'email'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?></div>
    </div>
        <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'refer'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "refer", $model->selectRefer, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'occupazione'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "occupazione", $model->selectOccupazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'conoscenza'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "conoscenza", $model->selectConoscenza, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'formula'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "formula", $model->selectFormule, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'campus'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "campus", $model->selectCampus, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'housing'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "housing", $model->selectHousing, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->