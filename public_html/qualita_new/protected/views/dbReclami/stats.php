<?php
$this->breadcrumbs = array('Statistiche qualita' => array('admin'), 'Statistiche',);

$dati = array(
    "NC" => "Azioni non conformi ",
    "AC" => "Azioni correttive ",
    "AP" => "Azioni preventive ",
    "R" => "Reclami",
);

$icona = array(
    "NC" => "fa-thumbs-o-down",
    "AC" => "fa-thumbs-o-up",
    "AP" => "fa-thumbs-o-up",
    "R" => "fa-bullhorn"
);

foreach($dati AS $ID => $val){
    if(count($model->stats['generali'][$ID])  ||  count($model->stats['anni'][$ID])     ){   

        Yii::app()->clientScript->registerScript('grafico_'.$ID, "
        
        
            var struttura   = $('#struttura-utente').val()
            var anno        = $('#struttura-anno').val()
            var tipo        = $('#tipo-grafico').val()
        
            $(document).ready(function(){
                $.ajax({
                    url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
                    type: 'post',
                    data: {
                        'grafico': btoa(grafico_".$ID.".getSVG()),
                        'nome':'statistiche_".$ID."',
                        'anno':anno,
                        'struttura':struttura,
                        'tipo':tipo
                    },
                    success: function (result) { 
                       
                       console.log(struttura);
                       console.log('NEW'+result)
                    }
                }); 
            })"
        );
    }
}

?>
<div class='col-xs-12'>
    <div class="panel panel-default panel-margin">
        <div class="panel-heading">
            <?php //if($model->stats['admin'] =='Y'):?>
			<?php if(Yii::app()->user->isEnabled('Statistiche')):?>
            <h2><i class='fa fa-bar-chart-o'></i>&nbsp;<span class='hidden-480'>STATISTICHE </span><span class='orange' style='font-weight: 550'><?= $model->anno ?></span></h2>
            <div class="panel-ctrls">
                <ul class="demo-btns" >
                    <li class='li-480' >
                        <div class="input-group date" style="margin-bottom:-5px !important" >
                            <span class="input-group-addon ">Anno</span>
                            <select id="anno" name="anno" class="form-control">
                                <option value=""> -- Seleziona </option>
                                <?php foreach ($model->selectAnni AS $id => $val) {
                                
                                    if($val > 2013){                                
    
                                    ?>
                                    <option value="<?= $id ?>"  <?= $model->anno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </li>
                    <li class='li-480' ><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('data-model' => 'Junior' , 'class' => 'button-icon button-icon-green', 'id' => 'stats-generali-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                    
                    <?php if(Yii::app()->user->getState('group') == 'ADMIN'):?>
                    <li class='li-480' ><a href='#' id='stampa-grafici-btn' data-model='dbReclami' class='button-icon button-icon-green' ><i class='fa fa-download'></i></a> </li>
                    <?php endif;?>
                </ul>
            </div>
            <?php else: ?>
            <h2><i class='fa fa-bar-chart-o'></i>&nbsp;<span class='hidden-480'>STATISTICHE </span><span class='orange' style='font-weight: 550'><?= $model->stats['struttura']['nome'] ?></span></h2>
            <?php endif; ?>
            <input type='hidden' id='struttura-utente' name='struttura-utente' value='<?= $model->stats['struttura']['id'] ?>' />
            <input type='hidden' id='struttura-anno' name='struttura-anno' value='<?= $model->anno ?>' />
            <input type='hidden' id='tipo-grafico' name='tipo-grafico' value='azioni' />
        </div>
        <div class="panel-body" id="">
            <?php
                foreach($dati AS $ID => $val ) {
                    //if($model->stats['admin'] =='Y') {
                        if(count($model->stats['generali'][$ID])) {
            ?> 
                            <div class='col-xs-12'>
                                <div class="panel panel-default">
                                    <div class="panel-heading"> <h2><i class="fa <?= $icona[$ID] ?>"></i>&nbsp;<?= $val ?> TOT: <span class='orange' style='font-weight: 550'><?= $model->stats['generali_'.$ID] ?></span></h2> </div>
                                    <div class="panel-body" style='padding: 0px'>
                                        <div id="statistiche_<?= $ID ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
                                    </div>
                                </div>
                            </div>    
            <?php       } 
                    /*}
                    else {
                        if(count($model->stats['strutture'][$ID])) {
            ?> 
                            <div class='col-xs-12 col-sm-6'>
                                <div class="panel panel-default">
                                    <div class="panel-heading"> <h2><i class="fa <?= $icona[$ID] ?>"></i>&nbsp;<?= $val ?> TOT: <span class='orange' style='font-weight: 550'><?= $model->stats['strutture_'.$ID] ?></span></h2> </div>
                                    <div class="panel-body" style='padding: 0px'>
                                        <div id="statistiche_<?= $ID ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
                                    </div>
                                </div>
                            </div>    
            <?php
                        } 
                    }*/
                }
            ?>
        </div>
     </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/grafici.js"></script>
<script>
<?php foreach($dati AS $ID => $val){
                    
    if(count($model->stats['generali'][$ID])){  ?>    
      var grafico<?= "_".$ID ?> =  Highcharts.chart('statistiche_<?= $ID ?>', {
        /*
          chart: {
            width: 1250
        },
        */
        yAxis: {title: { text: 'Totale <?= $ID ?>'}},
        title: {text: ''    },
        xAxis: {categories: ["<?= $val ?>"]},
        labels: {items: [{ html: '', style: {left: '50px', top: '18px', } }] },
        series: [
            <?php for($x=0 ; $x < count($model->stats['generali'][$ID]) ; $x++ ){ ?>
                {
                type: 'column',
                name: '<?= $model->stats['generali'][$ID][$x]['nome'] ?>',
                data: [<?= $model->stats['generali'][$ID][$x]['totale'] ?> ],
                color:'<?= $model->stats['generali'][$ID][$x]['colore'] ?>',
                },
            <?php } ?>
            ],
        });

<?php } 
    if(count($model->stats['anni'][$ID])){  ?>    
        
      var grafico<?= "_".$ID ?> =  Highcharts.chart('statistiche_<?= $ID ?>', {
        yAxis: {title: { text: '<?= $val ?>'}},
        title: {text: ''    },
        xAxis: {categories: [<?= implode(",", $model->stats['anni'][$ID]) ?>]},
        labels: {items: [{ html: '', style: {left: '50px', top: '18px', } }] },
        series: [{
                type: 'column',
                name: '<?= $model->stats['struttura']['nome'] ?>',
                data: [<?= implode(",", $model->stats['strutture'][$ID] ) ?> ],
                color:'<?= $model->stats['struttura']['colore'] ?>',
                },
        ],
    });
<?php } } ?>
</script>