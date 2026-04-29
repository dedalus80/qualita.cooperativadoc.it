<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'destinatario'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "destinatario", $model->selectUtenti, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'ruolo'); ?></div>
        <div class="col-xs-8"><?php echo $form->dropDownList($model, "ruolo", $model->selectRuoli, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'struttura'); ?></div>
        <div class="col-xs-8"><?php echo $form->dropDownList($model, "struttura", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipo'); ?></div>
        <div class="col-xs-8"><?php echo $form->dropDownList($model, "tipo", $model->selectTipi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tutti'); ?></div>
        <div class="col-xs-8"> <?php echo $form->radioButtonList($model, 'tutti', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'stato'); ?></div>
        <div class="col-xs-8 line-39"  ><?php echo $form->radioButtonList($model, 'stato', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div>