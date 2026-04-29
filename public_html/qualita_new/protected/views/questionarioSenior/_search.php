<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'organizzatore'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "organizzatore", $model->selectOrganizzazioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'turno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "turno", $model->selectTurni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'soggiorno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "soggiorno", $model->selectSoggiorni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'cognome'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome_gruppo'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'nome_gruppo', array('class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->