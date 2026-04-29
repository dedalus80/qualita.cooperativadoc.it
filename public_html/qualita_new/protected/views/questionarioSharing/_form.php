<?php
if ($model->stats['totale'] > 0) {

    Yii::app()->clientScript->registerScript('grafico1', "
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-complessivo',
                    data: [" . implode(",", $model->stats['vacanza']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-struttura-complessivo',
                    data: [" . implode(",", $model->stats['struttura_complessivo']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-struttura-pulizia',
                    data: [" . implode(",", $model->stats['struttura_pulizia']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-confort',
                    data: [" . implode(",", $model->stats['stanza_confort']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-complessivo',
                    data: [" . implode(",", $model->stats['stanza_complessivo']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-arredi',
                    data: [" . implode(",", $model->stats['stanza_arredi']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-pulizia',
                    data: [" . implode(",", $model->stats['stanza_pulizia']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})




 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-servizio',
                    data: [" . implode(",", $model->stats['ristorante_servizio']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-attesa',
                    data: [" . implode(",", $model->stats['ristorante_attesa']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-menu',
                    data: [" . implode(",", $model->stats['ristorante_menu']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-cibo',
                    data: [" . implode(",", $model->stats['ristorante_cibo']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-risto-complessivo',
                    data: [" . implode(",", $model->stats['ristorante_complessivo']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})



 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-cortesia',
                    data: [" . implode(",", $model->stats['personale_cortesia']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-professionalita',
                    data: [" . implode(",", $model->stats['personale_professionalita']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-personale-complessivo',
                    data: [" . implode(",", $model->stats['personale_complessivo']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-attivita-complessivo',
                    data: [" . implode(",", $model->stats['attivita_complessivo']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})



 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-consiglia',
                    data: [" . implode(",", $model->stats['finale']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
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


<div style="display: <?= $model->stats['totale'] > 0 ? "block" : "none" ?>"   id="table-grafici">
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['vacanza'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['vacanza_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['vacanza_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['vacanza_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['vacanza_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['consiglia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-consiglia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Consiglia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['consiglierebbe_data']); $x++) { ?>
                        <tr>
                            <td ><?= $model->stats['consiglierebbe_data'][$x]['label'] ?></td>
                            <td class='right'><?= $model->stats['consiglierebbe_data'][$x]['valore'] ?></td>
                            <td class='right' ><?= $model->stats['consiglierebbe_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['struttura_pulizia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-struttura-pulizia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Struttura Pulizia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['struttura_pulizia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['struttura_pulizia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['struttura_pulizia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['struttura_pulizia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['struttura_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-struttura-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Struttura complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['struttura_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['struttura_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['struttura_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['struttura_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['stanza_confort'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-confort"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Camera Confort</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['stanza_confort_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['stanza_confort_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['stanza_confort_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['stanza_confort_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['stanza_arredi'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-arredi"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Camera Arredi</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['stanza_arredi_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['stanza_arredi_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['stanza_arredi_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['stanza_arredi_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['stanza_pulizia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-pulizia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Camera Pulizia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['stanza_pulizia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['stanza_pulizia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['stanza_pulizia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['stanza_pulizia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['stanza_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right"> Camera complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['stanza_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['stanza_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['stanza_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['stanza_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['personale_cortesia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-cortesia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Personale cortesia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['personale_cortesia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['personale_cortesia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['personale_cortesia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['personale_cortesia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['personale_professionalita'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-professionalita"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Personale professionalit&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['personale_professionalita_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['personale_professionalita_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['personale_professionalita_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['personale_professionalita_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['personale_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Personale complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['personale_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['personale_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['personale_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['personale_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div> 
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['attivita_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-attivita-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Attivit&agrave; complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['attivita_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['attivita_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['attivita_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['attivita_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_servizio'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-servizio"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante Servizio</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_servizio_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_servizio_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_servizio_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_servizio_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_attesa'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-attesa"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante attesa</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_attesa_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_attesa_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_attesa_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_attesa_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_cibo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-cibo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante qualit&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_cibo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_cibo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_cibo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_cibo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_menu'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-menu"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante variet&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_menu_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_menu_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_menu_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_menu_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>