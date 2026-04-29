<?
$this->breadcrumbs = array(
    'Questionario Unavacanza Unaesperienza' => array('index'),
    $model->id,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Unavacanza Unaesperienza <span class='orange return-block'><?= $model->nome . " " . $model->cognome ?></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row "> 
                <div class="col-xs-3">
                    <?= $form->labelEx($model, 'nome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome; ?></span>
                </div>
                <div class="col-xs-3">
                    <?= $form->labelEx($model, 'cognome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->cognome; ?></span>
                </div>
                <div class="col-xs-3">
                    <?= $form->labelEx($model, 'email'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->email; ?></span>
                </div>
                <div class="col-xs-3">
                    <?= $form->labelEx($model, 'cellulare'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->cellulare; ?></span>
                </div>
            </div>
             <div class="row "> 
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'data_insert'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->reverseDate($model->data_insert); ?></span>
                </div>
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'turno'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->turno, "un_turni"); ?></span>
                </div>
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'attivita'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->attivita, "un_attivita"); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 