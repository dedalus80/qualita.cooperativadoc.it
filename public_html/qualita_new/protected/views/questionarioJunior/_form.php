<?php
if ($model->stats['totale'] > 0) {

    Yii::app()->clientScript->registerScript('grafico1', "
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-divertimento',
                    data: [" . implode(",", $model->stats['divertimento']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-educatori',
                    data: [" . implode(",", $model->stats['educatori']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-compagni',
                    data: [" . implode(",", $model->stats['compagni']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-giochi',
                    data: [" . implode(",", $model->stats['giochi']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-attivita_sportive',
                    data: [" . implode(",", $model->stats['attivita_sportive']) . "],
                   colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-gite',
                    data: [" . implode(",", $model->stats['gite']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'),Utility.getBrandColor('success') ]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-laboratori',
                    data: [" . implode(",", $model->stats['laboratori']) . "],
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
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['divertimento'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-divertimento"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ti sei devertito</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['divertimento_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['divertimento_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['divertimento_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['divertimento_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>

        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['educatori'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-educatori"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio educatori</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['educatori_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['educatori_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['educatori_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['educatori_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['compagni'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-compagni"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio compagni</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['compagni_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['compagni_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['compagni_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['compagni_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['giochi'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-giochi"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio attivit&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['giochi_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['giochi_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['giochi_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['giochi_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['attivita_sportive'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-attivita_sportive"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio attivit&agrave; sportive</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['attivita_sportive_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['attivita_sportive_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['attivita_sportive_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['attivita_sportive_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['gite'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-gite"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio gite</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['gite_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['gite_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['gite_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['gite_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['laboratori'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-laboratori"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">giudizio laboratori</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['laboratori_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['laboratori_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['laboratori_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['laboratori_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>