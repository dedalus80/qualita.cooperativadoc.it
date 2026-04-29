<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route),'method' => 'post','id'=>'search-form-int'));?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'codice'); ?></div>
        <div class="col-xs-8"><?php echo $form->textField($model, 'codice', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipologia'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'class' => 'form-control')           ); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'centro'); ?></div>
        <div class="col-xs-8"><? echo $form->dropDownList($model, "centro", $model->selectCentri, array('empty' => 'Scegli', 'class' => 'form-control')           ); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->
