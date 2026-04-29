<?
$this->breadcrumbs = array(
    'Questionario Junior' => array('index'),
    $model->nome_coordinatore . " " . $model->cognome_coordinatore,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Junior <span class='orange return-block'><?= $model->nome_coordinatore . " " . $model->cognome_coordinatore ?></h2>
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
                    <?= $form->labelEx($model, 'nome_gruppo'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome_gruppo; ?></span>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'data_restituzione'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->reverseDate($model->data_restituzione); ?></span>
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
            <div class="col-xs-4  col-sm-2 centered"> <span class='bold'>MOLTO</span></div>
            <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>ABBASTANZA</span></div>
            <div class="col-xs-4 col-sm-2 centered"> <span class='bold'>POCO</span></div>
           
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'divertimento'); ?></span></div>
            <div class="col-xs-4  col-sm-2 centered"><?= $model->divertimento == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-4  col-sm-2 centered"><?= $model->divertimento == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-4 col-sm-2 centered"><?= $model->divertimento == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'educatori'); ?></span></div>
            
            <div class="col-xs-2 col-sm-2 centered"><?= $model->educatori == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 col-sm-2 centered"><?= $model->educatori == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 col-sm-2 centered"><?= $model->educatori == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'compagni'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->compagni == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->compagni == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->compagni == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'giochi'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->giochi == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->giochi == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->giochi == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'attivita_sportive'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->attivita_sportive == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita_sportive == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita_sportive == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'gite'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->gite == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->gite == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->gite == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
            
        </div>
        <div class="row ">
            <div class="col-xs-12 col-sm-6"> <span class='bold'><?= $form->labelEx($model, 'laboratori'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->laboratori == 'M' ? "<img src='" . Yii::app()->request->baseUrl . "/images/ottimo.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori == 'A' ? "<img src='" . Yii::app()->request->baseUrl . "/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori == 'P' ? "<img src='" . Yii::app()->request->baseUrl . "/images/insufficente.png '>" : "" ?></div>
        </div>
         <div class="row title">
            <div class="col-xs-12">
                <b><?= $form->labelEx($model, 'suggerimenti')  ; ?></b>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-12">
                <?= $model->suggerimenti ? strtoupper(substr($model->suggerimenti, 0,1)).strtolower(substr($model->suggerimenti, 1))    :"<br />" ?>
            </div>
        </div>
       <div class="row title">
            <div class="col-xs-12">
                <b><?= $form->labelEx($model, 'osservazioni'); ?></b>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-12">
                <?= $model->osservazioni ? strtoupper(substr($model->osservazioni, 0,1)).strtolower(substr($model->osservazioni, 1)) :"<br />" ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 