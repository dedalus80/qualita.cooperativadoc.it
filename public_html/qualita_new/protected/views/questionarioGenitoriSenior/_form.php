<?php
if ($model->stats['totale'] > 0) {


    Yii::app()->clientScript->registerScript('grafico1', "
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-assistenza',
                    data: [" . implode(",", $model->stats['assistenza']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-informazioni',
                    data: [" . implode(",", $model->stats['informazioni']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-trasferimenti',
                    data: [" . implode(",", $model->stats['trasferimenti']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-complessivo',
                    data: [" . implode(",", $model->stats['complessivo']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-organizzazione',
                    data: [" . implode(",", $model->stats['organizzazione']) . "],
                   colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-attivita',
                    data: [" . implode(",", $model->stats['attivita']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-esperienza',
                    data: [" . implode(",", $model->stats['esperienza']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-cura',
                    data: [" . implode(",", $model->stats['cura']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})


 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-communicazione',
                    data: [" . implode(",", $model->stats['communicazione']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
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

<div style="display: <?= $model->stats['totale'] > 0 ? "block" : "none" ?>" id="table-grafici">
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['assistenza'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-assistenza"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Assistenza telefonica</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['assistenza_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['assistenza_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['assistenza_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['assistenza_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['informazioni'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-informazioni"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Informazioni fornite</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['informazioni_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['informazioni_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['informazioni_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['informazioni_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['trasferimenti'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-trasferimenti"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Trasferimenti soggiorno</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['trasferimenti_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['trasferimenti_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['trasferimenti_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['trasferimenti_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['communicazione'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-communicazione"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Communicazione con soggiorno</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['communicazione_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['communicazione_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['communicazione_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['communicazione_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['organizzazione'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-organizzazione"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Organizzazione soggiorno</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['organizzazione_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['organizzazione_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['organizzazione_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['organizzazione_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['attivita'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-attivita"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Attivit&Agrave; proposta</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['attivita_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['attivita_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['attivita_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['attivita_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['esperienza'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-esperienza"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Esperienza utile</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['esperienza_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['esperienza_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['esperienza_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['esperienza_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['cura'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-cura"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Cura direzzione</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['cura_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['cura_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['cura_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['cura_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>