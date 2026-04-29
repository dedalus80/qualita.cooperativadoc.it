<?php
$this->breadcrumbs = array('Email Inviate' => array('admin'), $model->id,);
$d = explode(" ", $model->data_invio)
?>
<div class="panel panel-default" style="margin-bottom: 50px">
    <div class="panel-heading">
        <h2><i class='fa fa-envelope'></i>&nbsp;Email Imviata ID<span class='orange return-block'>&nbsp;<?= $model->id ?></span></h2>
    </div>
    <div class="panel-body">
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Data Invio :&nbsp;&nbsp;</span> <?= $model->reverseData($d[0]) . " " . $d[1] ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Tipo invio:&nbsp;&nbsp;</span><?= $model->tipo == 'S' ? "Singolo" : "Multiplo"; ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Effettuati:&nbsp;&nbsp;</span><?= $model->effettuati ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Previsti:&nbsp;&nbsp;</span><?= $model->quanti ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Turno :&nbsp;&nbsp;</span> <?= $model->getSelectValue($model->turno, "_turni") ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Periodo:&nbsp;&nbsp;</span><?= $model->getSelectValue($model->periodo, "_periodi") ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <span class='bold'>Centro:&nbsp;&nbsp;</span><?= $model->getSelectValue($model->centro, "_centri_vacanza") ?>
            </div>
            <div class="col-xs-12 col-md-3">
                     <span class='bold'>Destinatari:&nbsp;&nbsp;</span><?= $model->getSelectValue($model->id_destinatari,"clienti") ?>
                </div>
        </div>
        
        <div class="row row-10">
            <div class="col-xs-12 ">
                <span class='bold'>Oggetto:&nbsp;&nbsp;</span><?= $model->sender ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 ">
                <span class='bold'>Testo:&nbsp;&nbsp;</span><?= $model->testo ?>
            </div>
        </div>
    </div>
</div>

