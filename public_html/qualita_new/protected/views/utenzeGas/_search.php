<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'anno'); ?></div>
        <div class="col-sm-8"> <?php echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'struttura'); ?></div>
        <div class="col-sm-8">
            <?
            if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                echo $form->dropDownList($model, "struttura", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            else
                echo "<br>" . Yii::app()->MyUtils->getSelectValue($model->struttura, 'doc_unita');
            ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
