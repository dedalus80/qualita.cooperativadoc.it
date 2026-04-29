<?php
$this->breadcrumbs  = array('Questionari Formazione' => array('index'), 'statistiche',);
$corsi              = Yii::app()->MyStats->getCorsiFormazione();
$valutazioni       = array("corso" => "Il corso","giudizio" => "Il giudizio","spazi"=> "Gli spazi",'conduzione'=>"La conduzione",'livello'=> "Il livello"); 

foreach($corsi as $id => $corso){  
        
    if( $model->stats['corso_'.$id]['totale_campo'] > 0 ){  
    
        Yii::app()->clientScript->registerScript('grafico_'.$id, "
            
            $(document).ready(function(){
                $.ajax({
                    url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
                    type: 'post',
                    data: {
                        'grafico': btoa(corso_".$id.".getSVGForExport()),
                        'nome':'".preg_replace('/[^a-zA-Z0-9_.]/', '_', $corso)."',
                        'tipo':'questionari_formazione'
                    },
                    success: function (result) {  console.log('NEW'+result) }
                }); 
            })"
        );
    }
}
?>

<?php
    foreach($corsi AS $id => $corso ) {
        $sql = "SELECT DATE_FORMAT(data_corso,'%d-%m-%Y') FROM questionario_formazione WHERE titolo = :corso";
        $cmd = Yii::app()->db->createCommand($sql);
        $cmd->bindParam(':corso', $corso, PDO::PARAM_STR);
        $data = $cmd->queryScalar();
?>
    <div class='col-xs-12'>
    <div class="panel panel-default panel-margin" style="">
        <div class="panel-heading">
			<h2><i class='fa fa-bar-chart-o'></i>&nbsp;<span class='hidden-480'>STATISTICHE </span><?= $data ?>&nbsp;<span class='orange' style='font-weight: 550'><?= $corso ?></span>  Totale questionari <span class='orange' style='font-weight: 550'><?= $model->stats['corso_'.$id]['totale']  ?></span></h2>
            <div class="panel-ctrls">
                <ul class="demo-btns" >
                    <li class='li-480' ><a href='#' id='' data-corso='<?= $id ?>' class='button-icon button-icon-green stampa-grafici-formazione' ><i class='fa fa-download'></i></a> </li>
                    <input type='hidden' id='nome_corso_<?= $id ?>' name="nome_corso_<?= $id ?>" value="<?php echo $corso; ?>" />
                </ul>
            </div>        
        </div>
        <div class="panel-body" id="">
            <div id="corso_<?= $id ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
            <div style='padding: 5px 10px '>
                <table  class="table  table-bordered dataTable" >
                    <thead>
                        <tr>
                            <th></th>
                            <th class='right'>Insufficiente</th>
                            <th class='right'>Sufficente</th>
                            <th class='right'>Buono</th>
                            <th class='right'>Eccelente</th>
                            <th class='right'>Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($valutazioni AS $val => $giudizio){?>
                        <tr>
                            <td ><?=$giudizio ?></td>
                            <td class='right'><?= $model->stats['corso_'.$id][$val]['I'] ?></td>
                            <td class='right'><?= $model->stats['corso_'.$id][$val]['S'] ?></td>
                            <td class='right'><?= $model->stats['corso_'.$id][$val]['B'] ?></td> 
                            <td class='right'><?= $model->stats['corso_'.$id][$val]['E'] ?></td> 
                            <td class='right'><?= $model->stats['corso_'.$id]['totale_campo'] ?></td> 
                        </tr>
                     <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
     </div>
</div>
<?php }?>     
<!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/grafici_percentuale.js"></script>-->
<script>
    
   <?php foreach($corsi AS $id => $corso ){
        
        if( $model->stats['corso_'.$id]['totale']  > 0 ){  ?>
        
        var corso_<?= $id ?>  = Highcharts.chart('corso_<?= $id ?>', {
        yAxis: { title: {                text: 'Percentuale'            }        },
        title: {    text: ''    },
        xAxis: {  categories: ["Il corso","Il giudizio","Gli spazi","La conduzione","Il livello","Consiglerebbe"]        },
        labels: { items: [{  html: '',  style: {  left: '50px',  top: '18px',  } }] },
        series: [
            {
                type: 'column',
                name: 'Insufficiente',
                data: [<?= implode(",", $model->stats["corso_".$id]['I']) ?> ],
                color:'#e74c3c',
            }, 
            {
                type: 'column',
                name: 'Sufficiente',
                data: [<?= implode(",", $model->stats["corso_".$id]['S']) ?>],
                color:'#f1c40f',
            },
            {
                type: 'column',
                name: 'Buono',
                data: [<?= implode(",", $model->stats["corso_".$id]['B']) ?>],
                color:'#35f887',
            },
            {
                type: 'column',
                name: 'Eccellente',
                data: [<?= implode(",", $model->stats["corso_".$id]['E']) ?>],
                color:'#0e836c',
            }
        ],
        /*plotOptions: {
            series: {
                animation: false,
                type: 'bar',
                dataLabels: {
                    enabled: true
                }
            }
        },*/
    });

    <?php } } ?>
</script>


