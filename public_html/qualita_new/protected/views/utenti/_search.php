<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route),'method' => 'post','id'=>'search-form-int'));?>
     <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'cognome'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'user'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'user', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'email'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'user_type'); ?></div>
        <div class="col-xs-7"><? echo $form->dropDownList($model, "user_type", $model->selectTipi, array('empty' => 'Scegli', 'class' => 'form-control')           ); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->
