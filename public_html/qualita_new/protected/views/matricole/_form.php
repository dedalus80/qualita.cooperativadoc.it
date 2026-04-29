<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'matricole-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class='row row-10'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome_contatore'); ?></label>
            <?php echo $form->textField($model, 'nome_contatore', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'matricola'); ?></label>
            <?php echo $form->textField($model, 'matricola', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'id_struttura'); ?></label>
            <?
            if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                echo $form->dropDownList($model, "id_struttura", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            else
                echo "<br>" . Yii::app()->MyUtils->getSelectValue($model->id_struttura, 'doc_unita');
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipo_matricola'); ?></label>
            <? echo $form->dropDownList($model, "tipo_matricola", $model->selectTipologie, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
    </div> 
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange', 'id' => 'matricole-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
