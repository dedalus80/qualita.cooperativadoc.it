<?php
$this->breadcrumbs = array('Questionari Junior' => array('index'), 'statistiche',);
$tmp = Yii::app()->MyUtils->getDatiQuestionario("questionario_junior");
$giudizzi = $tmp['giudizzi'] ;

foreach($giudizzi as $giudizzio){  
        
    if( $model->stats[$giudizzio]['totale'] > 0 ){  
    
        Yii::app()->clientScript->registerScript('grafico_'.$giudizzio, "
            
            var anno        = $('#struttura-anno').val()
            var struttura   = $('#struttura-utente').val()
            var tipo        = $('#tipo-grafico').val()
        
            $(document).ready(function(){
                $.ajax({
                    url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
                    type: 'post',
                    data: {
                        'grafico': btoa(".$giudizzio.".getSVG()),
                        'nome':'".$giudizzio."',
                        'anno':anno,
                        'struttura':struttura,
                        'tipo':tipo
                    },
                    success: function (result) {   }
                }); 
            })"
        );
    }
}

 if( $model->stats["consiglia"]['totale'] > 0 ){
 
    Yii::app()->clientScript->registerScript('consiglia', "
        
            var anno        = $('#struttura-utente').val()
            var struttura   = $('#struttura-anno').val()
            var tipo        = $('#tipo-grafico').val()
        
            $(document).ready(function(){
                $.ajax({
                    url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
                    type: 'post',
                    data: {
                        'grafico': btoa(consiglia.getSVG()),
                        'nome':'consiglia',
                        'anno':anno,
                        'struttura':struttura,
                        'tipo':tipo
                    },
                    success: function (result) {  console.log('NEW'+result) }
                }); 
            })"
        );
}

?>
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
                                <? foreach ($model->selectSoggiorni AS $id => $val) { ?>
                                    <option value="<?= $id ?>"  <?= $model->stats['struttura'] == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <? } ?>
                            </select>
                         </div>
                    </li>
                    <?php endif; ?>
                    <li class='li-480' ><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('data-model' => 'Junior' , 'class' => 'button-icon button-icon-green', 'id' => 'btn-update-stats', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                    <li class='li-480' ><a href='#' id='stampa-grafici-btn' data-model='questionarioJunior' class='button-icon button-icon-green' ><i class='fa fa-download'></i></a> </li>
                   
                    <input type='hidden' id='struttura-utente' name='struttura-utente' value='<?= $model->stats['struttura'] ?>' />
                     <input type='hidden' id='struttura-anno' name='struttura-anno' value='<?= $model->anno ?>' />
                     <input type='hidden' id='tipo-grafico' name='tipo-grafico' value='questionari_junior' />
                </ul>
            </div>
        </div>
         <div class="panel-body" id="stats">
                      
            <?php foreach($giudizzi AS $giudizzio){ 
            
                if( $model->stats[$giudizzio]['totale'] > 0){  ?>
                
                <div class='col-xs-12 col-sm-6'>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class='giudizio'> <?= str_replace("_"," ",$model->stats[$giudizzio]['label']) ?></h2>
                        </div>

                        <div class="panel-body" style='padding: 0px'>
                            <div id="<?= $giudizzio ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
                            <div style='padding: 5px 10px '>
                            <table  class="table  table-bordered dataTable" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class='right'>Poco</th>
                                        <th class='right'>Abbastanza</th>
                                        <th class='right'>Molto</th>
                                        <th class='right'>Totale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td >Anno Precedente</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['P'][0] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['A'][0] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['M'][0] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['ieri'] ?></td> 
                                        
                                    </tr>
                                    <tr>
                                        <td >Anno in Corso</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['P'][1] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['A'][1] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['M'][1] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'] ?></td> 
                                    </tr>
                                    <tr>
                                        <td >Totale Strutture </td>
                                        <td class='right'><?= $model->stats[$giudizzio]['P'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['A'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['M'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'] ?></td> 
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/grafici_percentuale.js"></script>
<script>
<?php foreach($giudizzi as $giudizzio){  
        
    if( $model->stats[$giudizzio]['totale'] > 0 ){  ?>
        var <?= $giudizzio ?> = Highcharts.chart('<?= $giudizzio ?>', {
        yAxis: { title: {    text: 'Percentuale'  } },
        title: { text: '' },
        xAxis: { categories: ["Anno precedente", "Anno in Corso", "Media strutture"] },
        labels: {items: [{   html: '',  style: {   left: '50px',   top: '18px', }  }]   },
        series: [{
            type: 'column',
            name: 'Poco',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['P_per']) ?>],
            color: '#e74c3c',
        }, {
            type: 'column',
            name: 'Abbastanza',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['A_per']) ?>],
            color: '#f1c40f',
        }, {
            type: 'column',
            name: 'Molto',
            data: [<?= implode(",", $model->stats[ $giudizzio ]['M_per']) ?>],
            color: '#0e836c',
        }],
    });
 <?php } } ?>
</script>










