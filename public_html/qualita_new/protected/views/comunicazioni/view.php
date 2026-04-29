<?
$this->breadcrumbs = array(
    'Comunicazioni' => array('index'),
    $model->titolo,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-microphone'></i>&nbsp; Comunicazioni <span class='orange return-block'><?= $model->titolo ?></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row "> 
                <div class="col-xs-12 col-sm-4">
                   <span class='bold'> <?= $form->labelEx($model, 'data_invio'); ?>:&nbsp;&nbsp;</span><?= Yii::app()->MyUtils->getItaDate($model->data_invio) ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                   <span class='bold'> <?= "Tipo invio" ?>:&nbsp;&nbsp;</span><?= $model->getTipoInvio($model->tipo)  ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                   <span class='bold'> <?= $form->labelEx($model, 'quanti'); ?>:&nbsp;&nbsp;</span><?= $model->quanti; ?>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-12 col-sm-12">
                    <span class='bold'>
                    <?php
                    switch ($model->tipo) {
                        case"P":
                            echo $form->labelEx($model, 'titolo');
                            ?>:&nbsp;&nbsp;</span><?= $model->titolo; ?><?
                    break;
                case"S":
                    echo $form->labelEx($model, 'sender');
                            ?>:&nbsp;&nbsp;</span><?= $model->sender; ?><?
                    break;
                case"E":
                    echo $form->labelEx($model, 'oggetto');
                            ?>:&nbsp;&nbsp;</span><?= $model->oggetto; ?><?
                    break;
            }
                    ?>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-12">
                    <span class='bold'>
                  <?php
                    switch ($model->tipo) {
                        case"P":
                            echo $form->labelEx($model, 'messaggio_push');
                            ?>:&nbsp;&nbsp;</span><br /><?= $model->messaggio_push; ?><?
                    break;
                case"S":
                    echo $form->labelEx($model, 'messaggio_sms');
                            ?>:&nbsp;&nbsp;</span><br /><?= $model->messaggio_sms; ?><?
                    break;
                case"E":
                    echo $form->labelEx($model, 'messaggio_email');
                            ?>:&nbsp;&nbsp;</span><br /><?= $model->messaggio_email; ?><?
                    break;
            }
                    ?>    
                </div>
            </div> 
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 