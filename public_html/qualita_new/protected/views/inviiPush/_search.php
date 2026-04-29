<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'POST', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
        <div class="col-xs-8">
           <?
           if ($model->datiAdmin['admin'] == true)
                echo $form->dropDownList($model, "unita_operativa", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            else
                echo "<br>" . Yii::app()->MyUtils->getSelectValue($model->unita_operativa, 'qualita_strutture');
            ?> 
        </div>
    </div>
    <div class="form-group" >
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'sezione'); ?></label>
        <div class="col-xs-8">    <?php echo $form->dropDownList($model, "sezione", $model->selectSezioni, array('empty' => 'Scegli', 'html' => true, 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'id_destinatari'); ?></label>
        <div class="col-xs-8">    <?php echo $form->dropDownList($model, "id_destinatari", $model->selectAdmin, array('empty' => 'Scegli', 'html' => true, 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'stato'); ?></label>
        <div class="col-xs-8">    <?php echo $form->dropDownList($model, "stato", $model->selectStati, array('empty' => 'Scegli', 'html' => true, 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    
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