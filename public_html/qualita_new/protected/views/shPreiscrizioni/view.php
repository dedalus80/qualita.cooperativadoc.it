<?php $this->breadcrumbs = array('Richieste online Sharing' => array('admin'), 'Gestisci',); ?>
<div class="panel panel-default panel-margin" style="margin-bottom: 300px">
    <div class="panel-heading"><h2><i class='fa fa-book shariNG'></i>Richiesta online &nbsp;<span class='orange return-block'><?= $model->nome." ".$model->cognome ?></span></h2></div>
    <div class="panel-body" style='line-height: 50px'>
        <div class="row ">
            <div class="col-xs-12">
                Formula abitativa:&nbsp;&nbsp;<span class='bold'><?= $model->getDettaglioFormula($model->formula,$model->campus,$model->housing) ?></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-6 col-md-3">
                Data:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getItaDate($model->data_insert) ?> </span>
            </div>
            <div class="col-xs-6 col-md-3">
                Dal:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getItaDate($model->data_in) ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Al:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getItaDate($model->data_out) ?></span>
            </div>
        </div>
        <div class="row " >
            <div class="col-xs-6 col-md-3">
                Nome:&nbsp;&nbsp;<span class='bold'><?= $model->nome ?> </span>
            </div>

            <div class="col-xs-6 col-md-3">
                Cognome:&nbsp;&nbsp;<span class='bold'><?= $model->cognome ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Cellulare:&nbsp;&nbsp;<span class='bold'><?= $model->cellulare ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Email:&nbsp;&nbsp;<span class='bold'><?= $model->email ?></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-6 col-md-3">
                Sesso:&nbsp;&nbsp;<span class='bold'><?= $model->sesso=='M'? "Maschio":"Femmina" ?> </span>
            </div>

            <div class="col-xs-6 col-md-3">
                Data nascita:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getItaDate($model->data_nascita) ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Luogo nascita:&nbsp;&nbsp;<span class='bold'><?= $model->luogo_nascita ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Nazionalit&agrave;:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->nazionalita,'doc_nazioni') ?></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-6 col-md-3">
                Occupazione:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->occupazione,'doc_occupazioni') ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Conosciuti tramite:&nbsp;&nbsp;<span class='bold'><br /><?= Yii::app()->MyUtils->getSelectValue($model->conoscenza,'doc_segnalato') ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Prima volta:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getYN($model->prima_volta)  ?> </span>
            </div>
            <div class="col-xs-12 col-md-3">
               Coabitazione:&nbsp;&nbsp;<span class='bold'><?= $model->coabitazione ?></span>
            </div>
        </div>
        <div class="row " style='line-height: 20px'>
              <div class="col-xs-12 col-md-12">
               <span class='bold'> Note:&nbsp;&nbsp;</span><?= $model->note ?> 
            </div>
        </div>
    </div>
</div>


