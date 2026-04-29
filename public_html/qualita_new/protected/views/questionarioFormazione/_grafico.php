<?php
if ($model->stats['totale'] > 0) {


    Yii::app()->clientScript->registerScript('grafico1', " 
 $(document).ready(function(){

Morris.Donut({
                    element: 'gra-consiglia',
                    data: [" . implode(",", $model->stats['finale']) . "],
                   colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success') ]
                });



Morris.Donut({
                    element: 'gra-corso',
                    data: [" . implode(",", $model->stats['corso']) . "],
                    colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success'),Utility.getBrandColor('green') ]
                });


Morris.Donut({
                    element: 'gra-temi',
                    data: [" . implode(",", $model->stats['giudizio']) . "],
                    colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success'),Utility.getBrandColor('green') ]
                });

Morris.Donut({
                    element: 'gra-conduzione',
                    data: [" . implode(",", $model->stats['conduzione']) . "],
                    colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success'),Utility.getBrandColor('green') ]
                });


Morris.Donut({
                    element: 'gra-spazi',
                    data: [" . implode(",", $model->stats['spazi']) . "],
                   colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success'),Utility.getBrandColor('green') ]
                });


Morris.Donut({
                    element: 'gra-livelli',
                    data: [" . implode(",", $model->stats['livello']) . "],
                    colors: [ Utility.getBrandColor('danger') , Utility.getBrandColor('warning'), Utility.getBrandColor('success'),Utility.getBrandColor('green') ]
                });

})

");
}
?>

<div style="display: <?= $model->stats['totale'] > 0 ? "none" : "block" ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="graf-legend legend-left"><h3> Non sono presenti questionari per il tipo di corso indicato o l'anno selezionato </h3></div>
        </div>
    </div>
</div>


<div id="table-grafici" style="display: <?= $model->stats['totale'] > 0 ? "block" : "none" ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <div id="gra-corso"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Il corso</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['corso_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['corso_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['corso_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['corso_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div id="gra-temi"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">I temi</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['giudizio_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['giudizio_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['giudizio_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['giudizio_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div id="gra-conduzione"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Conduzione</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['conduzione_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['conduzione_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['conduzione_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['giudizio_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div id="gra-spazi"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Gli Spazi</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['conduzione_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['conduzione_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['conduzione_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['conduzione_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3">
            <div id="gra-livelli"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Livello partecipazione</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['livello_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['livello_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['livello_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['livello_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3">
            <div id="gra-consiglia"></div>
            <table  class="table  table-bordered dataTable ">
                <thead><tr><td colspan="3" class="centered nob-right">Consiglia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['consiglia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['consiglia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['consiglia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['consiglia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

