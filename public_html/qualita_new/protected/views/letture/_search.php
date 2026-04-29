<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'incremento'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'incremento', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'id_matricola'); ?></div>
        <div class="col-xs-8"> <? echo $form->dropDownList($model, "id_matricola", $model->selectMatricole, array('empty' => 'Scegli', 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'data_lettura'); ?></div>
        <div class="col-xs-8"> 
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_lettura', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_lettura))); ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>