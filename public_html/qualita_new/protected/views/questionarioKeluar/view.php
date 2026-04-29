<?
$this->breadcrumbs = array(
    'Questionario Keluar' => array('index'),
    $model->id,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Keluar <span class='orange return-block'><?= $model->nome . " " . $model->cognome ?></h2>
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
                <div class="col-xs-6">
                    <?= $form->labelEx($model, 'scuola'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->scuola; ?></span>
                </div>
            </div>
            <div class="row "> 
                 <div class="col-xs-6">
                    <?= $form->labelEx($model, 'struttura_nome'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->struttura_nome, "doc_unita"); ?></span>
                </div>
                <div class="col-xs-6">
                    <?= $form->labelEx($model, 'trasporto_nome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->trasporto_nome; ?></span>
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
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'viaggio_complessivo'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->viaggio_complessivo == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->viaggio_complessivo == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->viaggio_complessivo == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->viaggio_complessivo == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'rapporto_keluar'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->rapporto_keluar == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->rapporto_keluar == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->rapporto_keluar == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->rapporto_keluar == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'trasporto_qualita'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_qualita == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_qualita == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_qualita == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_qualita == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'trasporto_cortesia'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_cortesia == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_cortesia == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_cortesia == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_cortesia == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'trasporto_tempi'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_tempi == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_tempi == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_tempi == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->trasporto_tempi == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
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
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'ristorante_menu'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_menu == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_menu == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_menu == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->ristorante_menu == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_cortesia'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_cortesia == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'personale_disponibilita'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->personale_disponibilita == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_disponibilita == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_disponibilita == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->personale_disponibilita == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'escursioni_itinerari'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_itinerari == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_itinerari == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_itinerari == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_itinerari == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'escursioni_guida'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_guida == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_guida == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_guida == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->escursioni_guida == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'neve_noleggio'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->neve_noleggio == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_noleggio == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_noleggio == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_noleggio == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div> 
         <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'neve_scuola'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->neve_scuola == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_scuola == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_scuola == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->neve_scuola == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
         <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'laboratori_tecnici'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_tecnici == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_tecnici == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_tecnici == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_tecnici == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'laboratori_competenze'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_competenze == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_competenze == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_competenze == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->laboratori_competenze == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
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