<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'vacanza'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "vacanza", $model->selectGiudizzi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'soggiorno'); ?></div>
        <div class="col-xs-8">
            <?php //echo $form->dropDownList($model, "soggiorno", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            <?php
                if (Yii::app()->user->getState('group') == 'ADMIN') {
                    echo $form->dropDownList($model, "soggiorno",  CHtml::listData(Strutture::model()->findAll(['order'=>'nome']), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                }
                else {
                    echo $form->dropDownList($model, "soggiorno",  CHtml::listData(Strutture::model()->findAll(['condition' => 'id IN ("'.implode('","', Yii::app()->user->getState('strutture')).'")', 'order'=>'nome']), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                }
            ?> 
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->