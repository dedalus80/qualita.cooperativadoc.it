<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-xs-8"> <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'id_reclamo'); ?></div>
        <div class="col-xs-8">
            <?php echo $form->dropDownList($model, "id_reclamo", $model->selectReclami, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
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
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome'); ?></div>
        <div class="col-xs-8">  <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?></div>
    </div>
     <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'cognome'); ?></div>
        <div class="col-xs-8">  <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->