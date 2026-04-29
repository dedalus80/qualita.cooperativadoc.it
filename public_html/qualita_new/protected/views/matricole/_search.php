<div class="wide form form-horizontal row-border">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'nome_contatore'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'nome_contatore', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'matricola'); ?></div>
        <div class="col-xs-8"> <?php echo $form->textField($model, 'matricola', array('class' => 'form-control')); ?></div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'id_struttura'); ?></div>
        <div class="col-xs-8"> 
            <?
            if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                echo $form->dropDownList($model, "id_struttura", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            else
                echo "<br>" . Yii::app()->MyUtils->getSelectValue($model->id_struttura, 'doc_unita');
            ?>

        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-3 control-label"><?php echo $form->labelEx($model, 'tipo_matricola'); ?></div>
        <div class="col-xs-8"> <? echo $form->dropDownList($model, "tipo_matricola", $model->selectTipologie, array('empty' => 'Scegli', 'class' => 'form-control')); ?></div>
    </div>
    <?php $this->endWidget(); ?>
</div>