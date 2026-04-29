<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route),'method' => 'post','id'=>'search-form-int'));?>
    <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'codice'); ?></div>
        <div class="col-xs-7"><?php echo $form->textField($model, 'codice', array('class' => 'form-control')); ?></div>
    </div>
   <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'qdoc'); ?></div>
        <div class="col-xs-7 radio-input"><?php echo $form->radioButtonList($model, 'qdoc', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>   </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'qkeluar'); ?></div>
        <div class="col-xs-7 radio-input"><?php echo $form->radioButtonList($model, 'qkeluar', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>    </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'qsharing'); ?></div>
        <div class="col-xs-7 radio-input"><?php echo $form->radioButtonList($model, 'qsharing', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>    </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 control-label"><?php echo $form->labelEx($model, 'qcampus'); ?></div>
        <div class="col-xs-7 radio-input"><?php echo $form->radioButtonList($model, 'qcampus', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>    </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->
