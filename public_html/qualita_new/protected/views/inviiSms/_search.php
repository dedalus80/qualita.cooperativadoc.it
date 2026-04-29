<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'POST', 'id' => 'search-form-int')); ?>
    <div class="form-group" >
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'data_invio'); ?></label>
        <div class="col-xs-8">  
            <div class="input-group date" >
                <span class="input-group-addon data-calendar" data-refer="data_invio"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_invio', array('id' => 'data_invio', 'class' => 'form-control hasDatepicker richiamo', 'size' => '10', 'maxlength' => '10', 'value' => $model->data_invio ? $model->reverseData($model->data_invio) : "")); ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->