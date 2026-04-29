<?php $this->breadcrumbs = array('Richieste online Stessopiano' => array('admin'), 'Gestisci',); ?>
<div class="panel panel-default panel-margin" style="margin-bottom: 300px">
    <div class="panel-heading"><h2><i class='fa fa-book stessoP'></i>Richiesta online &nbsp;<span class='orange return-block'><?= $model->nome." ".$model->cognome ?></span></h2></div>
    <div class="panel-body" style='line-height: 50px'>
        <div class="row ">
            <div class="col-xs-6 col-md-3">
                Data:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getItaDate($model->data_insert) ?> </span>
            </div>

            <div class="col-xs-6 col-md-3">
                Formula abitativa:&nbsp;&nbsp;<span class='bold'><?= $model->getDettaglioFormula($model->camera, $model->appartamento, $model->id) ?></span>
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
                Occupazione:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->occupazione,'sp_occupazione') ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Conosciuti tramite:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->conoscenza,'sp_conoscenza') ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Prima volta:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getYN($model->prima_volta)  ?> </span>
            </div>

            <div class="col-xs-6 col-md-3">
               livello spesa:&nbsp;&nbsp;<span class='bold'><?= $model->geLivello($model->livello,$model->id) ?></span>
            </div>
        </div>
        <div class="row ">
            <div class="col-xs-6 col-md-3">
               Quartieri:&nbsp;&nbsp;<span class='bold'><?= $model->getQuartieri($model->quartieri) ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Coinquilini:&nbsp;&nbsp;<span class='bold'><?=  $model->getCoinquilini($model->coinquilini,$model->id) ?></span>
            </div>
            <div class="col-xs-6 col-md-3">
                Animali:&nbsp;&nbsp;<span class='bold'><?= $model->getAnimali($model->animali,$model->id) ?> </span>
            </div>
             <div class="col-xs-6 col-md-3">
                Fumatore:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getYN($model->fumatore)  ?></span>
            </div>
        </div>
        <div class="row " style='line-height: 20px'>
              <div class="col-xs-12 col-md-6">
               <span class='bold'> Note:&nbsp;&nbsp;</span><?= $model->note ?> 
            </div>
            <div class="col-xs-12 col-md-3">
               Coabitazione:&nbsp;&nbsp;<span class='bold'><?=Yii::app()->MyUtils->getSelectValue($model->coabitazione,'sp_coabitazione') ?></span>
            </div>
            <div class="col-xs-12 col-md-3">
                Interessato:&nbsp;&nbsp;<span class='bold'><?=  $model->interessato ?></span>
            </div>
          
         </div>
    </div>
</div>

