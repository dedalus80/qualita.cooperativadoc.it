<?php
if ($model->stats['totale'] > 0) {

    Yii::app()->clientScript->registerScript('grafico1', "
 $(document).ready(function(){
 
Morris.Donut({
                    element: 'gra-consiglia',
                    data: [" . implode(",", $model->stats['finale']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

Morris.Donut({
                    element: 'gra-complessivo',
                    data: [" . implode(",", $model->stats['viaggio_complessivo']) . "],
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
                    element: 'gra-rapporto-keluar',
                    data: [" . implode(",", $model->stats['rapporto_keluar']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-pulizia',
                    data: [" . implode(",", $model->stats['camera_pulizia']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-camera-confort',
                    data: [" . implode(",", $model->stats['camera_confort']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                }); 

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-trasporto-qualita',
                    data: [" . implode(",", $model->stats['trasporto_qualita']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})
 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-trasporto-cortesia',
                    data: [" . implode(",", $model->stats['trasporto_cortesia']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})




 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-trasporto-tempi',
                    data: [" . implode(",", $model->stats['trasporto_tempi']) . "],
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
                    element: 'gra-personale-disponibilita',
                    data: [" . implode(",", $model->stats['personale_disponibilita']) . "],
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
                    element: 'gra-escursioni-itinerari',
                    data: [" . implode(",", $model->stats['escursioni_itinerari']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-escursioni-guida',
                    data: [" . implode(",", $model->stats['escursioni_guida']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-neve-noleggio',
                    data: [" . implode(",", $model->stats['neve_noleggio']) . "],
                    colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-neve-scuola',
                    data: [" . implode(",", $model->stats['neve_scuola']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-laboratori-tecnici',
                    data: [" . implode(",", $model->stats['laboratori_tecnici']) . "],
                     colors: [Utility.getBrandColor('danger'),Utility.getBrandColor('warning'), Utility.getBrandColor('success'), Utility.getBrandColor('green')]
                });

})

 $(document).ready(function(){
Morris.Donut({
                    element: 'gra-laboratori-competenze',
                    data: [" . implode(",", $model->stats['laboratori_competenze']) . "],
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
<div style="display: <?= $model->stats['totale'] > 0 ? "block" : "none" ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['viaggio_complessivo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-complessivo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Giudizio complessivo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['viaggio_complessivo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['viaggio_complessivo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['viaggio_complessivo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['viaggio_complessivo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['consiglia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-consiglia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Gonsiglerebbe</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['consiglierebbe_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['consiglierebbe_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['consiglierebbe_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['consiglierebbe_data'][$x]['percentuale'] ?> %</td></tr>
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
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['rapporto_keluar'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-rapporto-keluar"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Rapporto con keluar</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['rapporto_keluar_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['rapporto_keluar_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['rapporto_keluar_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['rapporto_keluar_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['camera_confort'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-confort"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Camera confort</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['camera_confort_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['camera_confort_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['camera_confort_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['camera_confort_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['camera_pulizia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-camera-pulizia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Camera pulizia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['camera_pulizia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['camera_pulizia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['camera_pulizia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['camera_pulizia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['trasporto_qualita'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-trasporto-qualita"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Trasporto qualit&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['trasporto_qualita_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['trasporto_qualita_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['trasporto_qualita_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['trasporto_qualita_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['trasporto_cortesia'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-trasporto-cortesia"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Trasporto cortesia</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['trasporto_cortesia_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['trasporto_cortesia_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['trasporto_cortesia_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['trasporto_cortesia_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">   
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['trasporto_tempi'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-trasporto-tempi"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Transporto tempi</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['trasporto_tempi_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['trasporto_tempi_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['trasporto_tempi_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['trasporto_tempi_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
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
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['personale_disponibilita'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-personale-disponibilita"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Personale disponibilit&agrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['personale_disponibilita_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['personale_disponibilita_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['personale_disponibilita_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['personale_disponibilita_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
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
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_menu'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-menu"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante men&ugrave;</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_menu_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_menu_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_menu_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_menu_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['ristorante_cibo'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-risto-cibo"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Ristorante cibo</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['ristorante_cibo_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['ristorante_cibo_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['ristorante_cibo_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['ristorante_cibo_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['escursioni_itinerari'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-escursioni-itinerari"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Escursioni itinerari</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['escursioni_itinerari_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['escursioni_itinerari_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['escursioni_itinerari_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['escursioni_itinerari_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['escursioni_guida'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-escursioni-guida"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Escursioni guida</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['escursioni_guida_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['escursioni_guida_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['escursioni_guida_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['escursioni_guida_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['neve_noleggio'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-neve-noleggio"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Neve nolleggio</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['neve_noleggio_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['neve_noleggio_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['neve_noleggio_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['neve_noleggio_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['neve_scuola'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-neve-scuola"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Neve scuola</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['neve_scuola_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['neve_scuola_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['neve_scuola_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['neve_scuola_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['laboratori_tecnici'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-laboratori-tecnici"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Laboratori tecnici</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['laboratori_tecnici_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['laboratori_tecnici_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['laboratori_tecnici_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['laboratori_tecnici_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-3" style="display: <?= $model->stats['exist']['laboratori_competenze'] > 0 ? "block" : "none" ?>" > 
            <div id="gra-laboratori-competenze"></div>
            <table  class="table  table-bordered dataTable">
                <thead><tr><td colspan="3" class="centered nob-right">Laboratori competenze</td></tr></thead>
                <tbody>
                    <? for ($x = 0; $x < count($model->stats['laboratori_competenze_data']); $x++) { ?>
                        <tr><td ><?= $model->stats['laboratori_competenze_data'][$x]['label'] ?></td><td class='right'><?= $model->stats['laboratori_competenze_data'][$x]['valore'] ?></td><td class='right' ><?= $model->stats['laboratori_competenze_data'][$x]['percentuale'] ?> %</td></tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


