<?php
$this->breadcrumbs = array('Questionari Keluar' => array('index'), 'statistiche',);
$giudizzi = array('viaggio_complessivo','struttura_complessivo','rapporto_keluar','trasporto_qualita', 'trasporto_cortesia','trasporto_tempi','ristorante_servizio','ristorante_cibo','ristorante_menu', 'personale_cortesia','personale_disponibilita','escursioni_itinerari','escursioni_guida','neve_noleggio','neve_scuola','laboratori_tecnici','laboratori_competenze');
?>
<!-- Required to convert named colors to RGB -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.4/rgbcolor.min.js"></script>
<!-- Optional if you want blur -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/stackblur-canvas/1.4.1/stackblur.min.js"></script>
<!-- Main canvg code -->
<script src="https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js"></script>
 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div class="row">
    <div class="panel panel-default panel-margin" style="">
        <div class="panel-heading">
			<h2><i class='fa fa-bar-chart-o'></i>&nbsp;<span class='hidden-480'>STATISTICHE </span><span class='orange' style='font-weight: 550'><?= $model->stats['nome_struttura'] ?></span>  Totale questionari <span class='orange' style='font-weight: 550'><?= $model->stats['totale'] ?></span></h2>
            <div class="panel-ctrls">
                <ul class="demo-btns" >
                    <li class='li-480' >
                        <div class="input-group date" style="margin-bottom:-5px !important" >
                            <span class="input-group-addon ">Anno</span>
                            <select id="anno" name="anno" class="form-control">
                                <option value=""> -- Seleziona </option>
                                <? foreach ($model->selectAnni AS $id => $val) { ?>
                                    <option value="<?= $id ?>"  <?= $model->anno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </li>
                    <?php if($model->stats['user'] =='admin'):?>
                    <li class='li-480'>
                        <div class="input-group date" style="margin-bottom:-5px !important" >
                            <span class="input-group-addon ">Struttura</span>
                            <select id="struttura" name="struttura" class="form-control">
                                <option value=""> -- Seleziona </option>
                                <? foreach ($model->selectStrutture AS $id => $val) { ?>
                                    <option value="<?= $id ?>"  <?= $model->stats['struttura'] == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <? } ?>
                            </select>
                         </div>
                    </li>
                    <?php endif; ?>
                     <li class='li-480' ><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'stats-keluar-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                </ul>
            </div>
        </div>
         <div class="panel-body" id="stats">
                      
            <?php foreach($giudizzi AS $giudizzio){ 
            
                if( $model->stats[$giudizzio]['totale'][0] > 0 ||  $model->stats[$giudizzio]['totale'][1] > 0 ||  $model->stats[$giudizzio]['totale'][2] > 0 || $model->stats[$giudizzio]['totale'][3] > 0){  ?>
                
                <div class='col-xs-12 col-sm-6'>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><?= str_replace("_"," ",$giudizzio) ?></h2>
                        </div>

                        <div class="panel-body">
                            <div id="<?= $giudizzio ?>" style="margin: 0 auto; width: 100% "></div>
                            <div style='padding-top: 5px'>
                            <table  class="table  table-bordered dataTable" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class='right' >Anno in Corso</th>
                                        <th class='right' >Anno Precedente</th>
                                        <th class='right' >Totale Strutture anno in corso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Insufficiente</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'][0]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['precedente'][0]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'][0]  ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Sufficente</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'][1]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['precedente'][1]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'][1]  ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Buono</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'][2]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['precedente'][2]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'][2]  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Eccelente</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'][3]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['precedente'][3]  ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'][3]  ?></td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                        </div>
                    </div>
                </div>
            <?php }  } ?>
        </div>
    </div>
</div>
<script>
    Highcharts.setOptions({
        navigation: {
            buttonOptions: {
                enabled: false
            }
        },
        exporting: {
            contextButton: {
                enabled: false,
            }
        },
        exporting: false,
        credits: {
            enabled: false
        },
        title: {
            useHTML: true,
            color: "#00FF00"
        },
        legend: {
            enabled: true
        },
        tooltip: {
            formatter: function() {
                return this.series.name+'<br/>'+this.x+': <b>'+Highcharts.numberFormat(this.y, 0)+"%</b>";
            }
        },
        
    })

    <?php foreach($giudizzi as $giudizzio){  
        
        if( $model->stats[$giudizzio]['totale'][0] > 0 ||  $model->stats[$giudizzio]['totale'][1] > 0 ||  $model->stats[$giudizzio]['totale'][2] > 0 || $model->stats[$giudizzio]['totale'][3] > 0){  ?>
       

    Highcharts.chart('<?= $giudizzio ?>', {
        yAxis: {
            title: {
                text: 'Percentuale'
            }
        },
        title: {
    text: ''
    },
        xAxis: {
            categories: ["Insufficiente","sufficiente","Buono","Eccelente"]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Anno in  corso',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['anno_per']) ?> ]
        }, {
            type: 'column',
            name: 'Anno Precedente',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['precedente_per']) ?>],
        }, {
            type: 'column',
            name: 'Media Strutture anno in corso',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['totale_per']) ?>],
        }],
    });

    <?php } 
} ?>

</script>

