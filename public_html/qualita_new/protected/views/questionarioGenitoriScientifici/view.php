<?
$this->breadcrumbs = array(
    'Questionario genitori campus formativi' => array('index'),
    $model->nome_coordinatore . " " . $model->cognome_coordinatore,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario genitori campus formativi <span class='orange return-block'><?= $model->nome_coordinatore . " " . $model->cognome_coordinatore ?></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row "> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'cognome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->cognome; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'eta'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->eta; ?> anni</span>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome_coordinatore'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome_coordinatore; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'cognome_coordinatore'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->cognome_coordinatore; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'email_genitore'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->email_genitore; ?></span>
                </div>
            </div>
            <div class="row "> 
                 <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome_gruppo'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome_gruppo; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'soggiorno'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->soggiorno, "doc_unita"); ?></span> <?= $model->turno . " Turno" ?>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'organizzatore'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->organizzatore, "doc_clienti"); ?></span>
                </div>
            </div> 
        </div>

        <div class="row  title">
            <div class="col-xs-12 col-sm-6 "> <span class='bold'>QUESITO</span></div>
            <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>POCO</span></div>
            <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>ABBASTANZA</span></div>
            <div class="col-xs-4  col-sm-2 centered"> <span class='bold'>MOLTO</span></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'assistenza'); ?></span></div>
            <div class="col-xs-4 col-sm-2 centered"><?= $model->assistenza == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-4  col-sm-2 centered"><?= $model->assistenza == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-4  col-sm-2 centered"><?= $model->assistenza == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'informazioni'); ?></span></div>
            <div class="col-xs-2 col-sm-2 centered"><?= $model->informazioni == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 col-sm-2 centered"><?= $model->informazioni == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 col-sm-2 centered"><?= $model->informazioni == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'trasferimenti'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->trasferimenti == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasferimenti == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasferimenti == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'organizzazione'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->organizzazione == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->organizzazione == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->organizzazione == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'attivita'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->attivita == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'esperienza'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->esperienza == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->esperienza == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->esperienza == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
         <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'communicazione'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->communicazione == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->communicazione == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->communicazione == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
         <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'cura'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->cura == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->cura == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->cura == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->complessivo == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->complessivo == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->complessivo == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row title">
            <div class="col-xs-12">
                <b><?= $form->labelEx($model, 'suggerimenti'); ?>:</b>
               
            </div>
        </div>
         <div class="row ">
            <div class="col-xs-12">
                <br /><?= $model->suggerimenti ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 