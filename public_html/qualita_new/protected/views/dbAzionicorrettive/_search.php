<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'get', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'codice_riferimento'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "codice_riferimento", $model->selectCodici, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipo_azione'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "tipo_azione", $model->selectAzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></div>
        <div class="col-xs-8"> 
            <?php
                if (Yii::app()->user->getState('group') == 'ADMIN')
                    echo $form->dropDownList($model, "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                else
                    echo $form->dropDownList($model, "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('condition' => 'id IN ('.implode(',', Yii::app()->user->getState('strutture')).')', 'order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'societa'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'funzione'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipologia'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->