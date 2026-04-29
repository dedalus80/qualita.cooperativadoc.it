<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route, $idTipoVerifica ? array('id' => $idTipoVerifica) : array()), 'method' => 'GET', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></label>
        <div class="col-xs-8">
            <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
        <div class="col-xs-8">
            <?php
                if (Yii::app()->user->getState('group') == 'ADMIN') {
                    echo $form->dropDownList($model, "unita_operativa",  CHtml::listData(Strutture::model()->findAll(['order'=>'nome']), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                }
                else {
                    echo $form->dropDownList($model, "unita_operativa",  CHtml::listData(Strutture::model()->findAll(['condition' => 'id IN ("'.implode('","', Yii::app()->user->getState('strutture')).'")', 'order'=>'nome']), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                }
            ?> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'verifica'); ?></label>
        <div class="col-xs-8">
            <?php echo $form->dropDownList($model, "verifica", $model->selectVerifiche, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipo_verifica'); ?></label>
        <div class="col-xs-8">    <?php echo $form->dropDownList($model, "tipo_verifica", $model->selectTipologie, array('empty' => 'Scegli', 'html' => true, 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->
