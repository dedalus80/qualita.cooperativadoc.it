<?php

if($model->stats['totale'] > 0 ){

Yii::app()->clientScript->registerScript('grafico1', "
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-complessivo',
                    data: [" . implode(",", $model->stats['vacanza']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-struttura-complessivo',
                    data: [" . implode(",", $model->stats['struttura_complessivo']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-struttura-pulizia',
                    data: [" . implode(",", $model->stats['struttura_pulizia']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-confort',
                    data: [" . implode(",", $model->stats['stanza_confort']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-complessivo',
                    data: [" . implode(",", $model->stats['stanza_complessivo']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-arredi',
                    data: [" . implode(",", $model->stats['stanza_arredi']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-pulizia',
                    data: [" . implode(",", $model->stats['stanza_pulizia']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})




 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-servizio',
                    data: [" . implode(",", $model->stats['ristorante_servizio']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-attesa',
                    data: [" . implode(",", $model->stats['ristorante_attesa']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-menu',
                    data: [" . implode(",", $model->stats['ristorante_menu']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-cibo',
                    data: [" . implode(",", $model->stats['ristorante_cibo']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-complessivo',
                    data: [" . implode(",", $model->stats['ristorante_complessivo']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})



 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-cortesia',
                    data: [" . implode(",", $model->stats['personale_cortesia']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-professionalita',
                    data: [" . implode(",", $model->stats['personale_professionalita']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-complessivo',
                    data: [" . implode(",", $model->stats['personale_complessivo']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('success'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-consiglia',
                    data: [" . implode(",", $model->stats['finale']) . "],
                    colors: [Utility.getBrandColor('green'),Utility.getBrandColor('danger'), Utility.getBrandColor('warning'), Utility.getBrandColor('danger')]
                });

})
");

}
?>

<div style="display: <?= $model->stats['totale'] > 0 ? "none" : "block" ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
           <div class="graf-legend legend-left"><h3> Non sono presenti questionari per la struttura o l'anno selezionato </h3></div>
        </div>
    </div>
</div>


<div style="display: <?= $model->stats['totale'] > 0 ? "block" : "none" ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['vacanza'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-complessivo"></div>
            <div class="graf-label">Giudizio complessivo</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['consiglia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-consiglia"></div>
            <div class="graf-label">Consiglia</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['struttura_pulizia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-struttura-pulizia"></div>
            <div class="graf-label" >Struttura Pulizia</div> 
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['struttura_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-struttura-complessivo"></div>
            <div class="graf-label">Struttura complessivo</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['stanza_confort'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-confort"></div>
            <div class="graf-label" >Camera Confort</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['stanza_arredi'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-arredi"></div>
            <div class="graf-label" >Camera Arredi</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['stanza_pulizia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-pulizia"></div>
            <div class="graf-label"  >Camera Pulizia</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['stanza_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-complessivo"></div>
            <div class="graf-label"  > Camera complessivo</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['personale_cortesia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-cortesia"></div>
            <div class="graf-label">Personale cortesia</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['personale_professionalita'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-professionalita"></div>
            <div class="graf-label" >Personale professionalit&agrave;</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['personale_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-complessivo"></div>
            <div class="graf-label" >Personale complessivo</div>
        </div> 
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['attivita_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-attivita-complessivo"></div>
            <div class="graf-label" >Attivita complessivo</div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['ristorante_servizio'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-servizio"></div>
            <div class="graf-label" >Ristorante Servizio</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['ristorante_attesa'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-attesa"></div>
            <div class="graf-label"  >Ristorante atesa</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['ristorante_cibo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-cibo"></div>
            <div class="graf-label" >Ristorante qualit&agrave;</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['ristorante_menu'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-menu"></div>
            <div class="graf-label" >Ristorante variet&agrave;</div>
        </div>
        <div class="col-xs-12 col-sm-2" style="display: <?= $model->stats['exist']['ristorante_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-complessivo"></div>
            <div class="graf-label" >Ristorante complessivo</div>
        </div>
    </div>
</div>

