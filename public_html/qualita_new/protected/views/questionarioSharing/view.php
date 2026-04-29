<?
$this->breadcrumbs = array(
    'Questionario Sharing' => array('index'),
    $model->id,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Sahring <span class='orange return-block'><?= $model->nome . " " . $model->cognome ?></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row "> 
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'data_arrivo'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->reverseDate($model->data_arrivo); ?></span>
                </div>
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'data_partenza'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->reverseDate($model->data_partenza); ?></span>
                </div>
                <div class="col-xs-4">
                    <?= $form->labelEx($model, 'titpologia_cliente'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->tipologia_cliente, "doc_tipologie_clienti"); ?></span>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-6">
                    <?= $form->labelEx($model, 'soggiorno'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->soggiorno, "doc_unita"); ?></span>
                </div>
                <div class="col-xs-6">
                    <?= $form->labelEx($model, 'conoscenza'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->conoscenza, "doc_conoscenza"); ?></span>
                </div>
            </div> 
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
        </div>
        
        <div class="row  title">
            <div class="col-xs-4"> <span class='bold'>QUESITO</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>INSUFFICIENTE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>SUFFICIENTE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>BUONA</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>OTTIMO</span></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'vacanza'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->vacanza == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->vacanza == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->vacanza == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->vacanza == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'struttura_pulizia'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->struttura_pulizia == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_pulizia == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_pulizia == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_pulizia == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'struttura_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->struttura_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->struttura_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'stanza_confort'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->stanza_confort == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_confort == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_confort == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_confort == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'stanza_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->stanza_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->stanza_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'ristorante_cibo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_cibo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_cibo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_cibo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_cibo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'ristorante_servizio'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_servizio == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_servizio == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_servizio == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_servizio == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'ristorante_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_cortesia'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_professionalita'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_professionalita == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_professionalita == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_professionalita == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_professionalita == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'attivita_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->attivita_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->attivita_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row title">
            <div class="col-xs-6"> <span class='bold'>CONSIGLEREBBE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE NO </span></div>
            <div class="col-xs-2 centered"> <span class='bold'>FORSE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE SI </span></div>
        </div>
        <div class="row " style="margin-bottom: 20px">
            <div class="col-xs-6"> <span class='bold'><?= $form->labelEx($model, 'consiglia'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->consiglia == 'N' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->consiglia == 'F' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->consiglia == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 