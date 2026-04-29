<?php
$consumi = array(
    "utenze_gas" => array("nome" => "Gas","icona"=>"fa fa-fire"),
    "utenze_acqua" =>array("nome" => "Acqua","icona"=>"fa fa-tint"),
    "utenze_luce" => array("nome" => "Energetici","icona"=>"fa fa-plug"),
    "utenze_rifiuti" => array("nome" => "Rifiuti","icona"=>"fa fa-trash-o"),
    "utenze_chimici" => array("nome" => "Sostanze Chimiche","icona"=>"fa fa-flask"),
);
$this->breadcrumbs = array('Statistiche consumi' => array('index'), 'statistiche',); 

// Costruisci la lista dei grafici da salvare
$graficiDaSalvare = array();
foreach($consumi AS $id => $val) {
    if($model->stats[$id] > 0) {
        $graficiDaSalvare[] = $id;
    }
}
?>
<div class="panel panel-default panel-margin" style="">
    <div class="panel-heading">
        <h2><i class='fa fa-bar-chart-o'></i>&nbsp;STATISTICHE CONSUMI<span class='orange return-block'>
                <?= $model->anno ?> </span> <span class='orange return-block'></span></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li>
                    <div class="input-group date" style="margin-bottom:-5px !important">
                        <span class="input-group-addon ">Anno</span>
                        <select id="anno" name="anno" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectAnni AS $id => $val) { ?>
                            <option value="<?= $id ?>" <?=$model->anno == $id ? "selected='selected'" : "" ?> >
                                <?= $val ?>
                            </option>
                            <? } ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="input-group date" style="margin-bottom:-5px !important">
                        <span class="input-group-addon ">Tipo</span>
                        <select id="tipo" name="tipo" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectTipi AS $id => $val) { ?>
                            <option value="<?= $id ?>" <?=$model->tipo == $id ? "selected='selected'" : "" ?> >
                                <?= $val ?>
                            </option>
                            <? } ?>
                        </select>
                    </div>
                </li>
                <li>
                    <?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'stats-presenze-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?>
                </li>
                <li class='li-480' ><a href='#' id='stampa-grafici-strutture-btn' class='button-icon button-icon-green' data-model='UtenzePresenze' ><i class='fa fa-download'></i></a> </li>
                
                <input type='hidden' id='struttura-anno' name='struttura-anno' value='<?= $model->anno  ?>' />
                <input type='hidden' id='tipo-grafico' name='tipo-grafico' value='utenze_<?= $model->tipo ?>' />
            </ul>
        </div>
    </div>
    <div class="panel-body" id="stats">
        <?php foreach($consumi AS $id => $nome ){ 
                $id == 'utenze_chimici' ? $unita = 'litri': $unita = 'MC' ;  
                $model->tipo =='p' ? $k = 'c_' : $k = '';
                $totale = Yii::app()->db->createCommand("SELECT SUM(".$k."totale) FROM ".$id." WHERE anno ='".$model->anno."' ")->queryScalar();
        ?>

        <div class="panel panel-default panel-margin" style="">
            <div class="panel-heading">
                <h2>
                    <?= "<i class='".$consumi[$id]['icona']."'></i>".$consumi[$id]['nome'] ?> 
                    <?php if($totale > 0){
                        echo "Tot: <span class='orange return-block'>".$totale ;
                        echo $model->tipo =='p' ? "&euro;</span>":$unita."</span>";
                    } ?>
                </h2>
            </div>
            <div class="panel-body" id="stats">
                <?php if($model->stats[$id]){?>
                <div id="<?= $id ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
                <?php } else { ?>
                Non sono presenti dati statistici per questo tipo di consumo 
                <?php } ?>
            </div>
        </div>
        <?php } ?>
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
            enabled: true,
            itemStyle: {
                fontSize: '12px'
            },
        },
        tooltip: {
            style: {
                fontSize: '14px',
                padding: '10px'
            },
            formatter: function() {
                return '<span style="font-size:13px">' + this.series.name + '</span><br/>' + 
                       '<span style="font-size:15px">' + this.x + ': <b>' + Highcharts.numberFormat(this.y, 0, ',', '.') + '</b></span>';
            }
        },
        
    })

   <?php foreach($consumi AS $id  => $val ){
        
        if( $model->stats[$id]  > 0 ){  ?>
        
       var <?= $id ?> = Highcharts.chart('<?= $id ?>', {
        chart: {
            marginLeft: 80,
            spacingLeft: 10
        },
        yAxis: {
            title: {text: 'Totale'},
            labels: {
                style: { fontSize: '11px' },
                formatter: function() {
                    return Highcharts.numberFormat(this.value, 0, ',', '.');
                }
            }
        },
        title: {text: ''},
        xAxis: { categories: ["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"]},
        labels: {items: [{html: '', style: {  left: '50px',top: '18px',}}]},
        series: [
            <?php for($x=0 ; $x < count($model->stats[$id]) ; $x++){ ?>  
            {
            type: 'column',
            name: '<?= $model->stats[$id][$x]['nome'] ?>',
            data: [<?= implode(",", $model->stats[$id][$x]['valori']) ?> ],
            color:'<?= $model->stats[$id][$x]['colore'] ?>',
        },
        <?php } ?>
        
        ],
    });

    <?php } } ?>

    // Sistema di salvataggio grafici PNG - attende che jQuery sia caricato
    window.addEventListener('load', function() {
        var anno = document.getElementById('struttura-anno').value;
        var tipo = document.getElementById('tipo-grafico').value;
        
        // Coda per serializzare le esportazioni
        var chartQueue = [];
        var isProcessing = false;
        var chartsToSave = <?= json_encode($graficiDaSalvare) ?>;
        
        function processQueue() {
            if (isProcessing || chartQueue.length === 0) return;
            
            isProcessing = true;
            var item = chartQueue.shift();
            var chart = item.chart;
            
            // Estrai SVG dal DOM
            var svgElement = chart.container.querySelector('svg');
            if (!svgElement) {
                isProcessing = false;
                processQueue();
                return;
            }
            
            // Clona e prepara l'SVG
            var svgClone = svgElement.cloneNode(true);
            svgClone.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            svgClone.setAttribute('width', chart.chartWidth);
            svgClone.setAttribute('height', chart.chartHeight);
            var svg = new XMLSerializer().serializeToString(svgClone);
            
            // Converti SVG in PNG usando canvas
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');
            var img = new Image();
            
            var svgBase64 = btoa(unescape(encodeURIComponent(svg)));
            var dataUrl = 'data:image/svg+xml;base64,' + svgBase64;
            
            img.onload = function() {
                canvas.width = img.width * 2;
                canvas.height = img.height * 2;
                ctx.fillStyle = '#FFFFFF';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.scale(2, 2);
                ctx.drawImage(img, 0, 0);
                
                var pngBase64 = canvas.toDataURL('image/png').split(',')[1];
                item.callback(pngBase64);
                
                isProcessing = false;
                processQueue();
            };
            
            img.onerror = function() {
                isProcessing = false;
                processQueue();
            };
            
            img.src = dataUrl;
        }
        
        function svgToPng(chart, callback) {
            if (!chart || !chart.container) return;
            chartQueue.push({ chart: chart, callback: callback });
            processQueue();
        }
        
        function sendToServer(chartName, pngData) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log('Saved ' + chartName + ':', xhr.responseText);
                }
            };
            xhr.send('grafico=' + encodeURIComponent(pngData) + '&nome=' + encodeURIComponent(chartName) + '&anno=' + encodeURIComponent(anno) + '&tipo=' + encodeURIComponent(tipo));
        }
        
        // Attendi che Highcharts completi il rendering
        setTimeout(function() {
            chartsToSave.forEach(function(chartName) {
                var chart = window[chartName];
                if (chart) {
                    svgToPng(chart, function(pngData) {
                        sendToServer(chartName, pngData);
                    });
                }
            });
        }, 1500);
    });
</script>
