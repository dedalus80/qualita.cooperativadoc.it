<?php
$this->breadcrumbs  = array('Questionari Doc' => array('index'), 'statistiche',);
$tmp                = Yii::app()->MyUtils->getDatiQuestionario("questionario_doc");
$giudizzi           = $tmp['giudizzi'] ;

foreach($giudizzi as $giudizzio){  
        
    if( $model->stats[$giudizzio]['totale'] > 0 ){  
    
        Yii::app()->clientScript->registerScript('grafico_'.$giudizzio, "
            
            var struttura   = $('#struttura-utente').val();
            var anno        = $('#struttura-anno').val();
            var tipo        = $('#tipo-grafico').val();
        
            $.ajax({
                url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
                type: 'post',
                data: {
                    'grafico': btoa(".$giudizzio.".getSVGForExport()),
                    'nome':'".$giudizzio."',
                    'anno':anno,
                    'struttura':struttura,
                    'tipo':tipo
                },
                success: function (result) {  console.log('NEW'+result) }
            }); 
            ",
            CClientScript::POS_END
        );
    }
}

if( $model->stats["consiglia"]['totale'] > 0 ) {
 
    Yii::app()->clientScript->registerScript('consiglia', "
        var struttura   = $('#struttura-utente').val();
        var anno        = $('#struttura-anno').val();
        var tipo        = $('#tipo-grafico').val();
    
        $.ajax({
            url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
            type: 'post',
            data: {
                'grafico': btoa(consiglia.getSVGForExport()),
                'nome':'consiglia',
                'anno':anno,
                'struttura':struttura,
                'tipo':tipo
            },
            success: function (result) {  console.log('NEW'+result) }
        });
        ",
        CClientScript::POS_END
    );
}


?>
<div class="row">
    <div class="panel panel-default panel-margin">
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
                    <?php if($model->stats['user']=='admin'):?>
                    <li class='li-480'>
                        <div class="input-group date" style="margin-bottom:-5px !important" >
                            <span class="input-group-addon ">Struttura</span>
                            <select id="struttura" name="struttura" class="form-control">
                                <option value=""> -- Seleziona </option>
                                <?php foreach ($model->selectStrutture AS $id => $val):?>
                                    <option value="<?= $id ?>"  <?= $model->stats['struttura'] == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <?php endforeach; ?>
                            </select>
                         </div>
                    </li>
                    <?php endif; ?>
                     <li class='li-480' ><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'stats-doc-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                     <li class='li-480' ><a href='#' id='stampa-grafici-btn' data-model='questionarioDoc' class='button-icon button-icon-green' ><i class='fa fa-download'></i></a> </li>
              
                    <input type='hidden' id='struttura-utente' name='struttura-utente' value='<?= $model->stats['struttura'] ?>' />
                     <input type='hidden' id='struttura-anno' name='struttura-anno' value='<?= $model->anno ?>' />
                     <input type='hidden' id='tipo-grafico' name='tipo-grafico' value='questionari_doc' />
                </ul>
            </div>
        </div>
         <div class="panel-body" id="stats">
                      
            <?php foreach($giudizzi AS $giudizzio){ 
            
                if( $model->stats[$giudizzio]['totale'] > 0){  ?>
                
                <div class='col-xs-12 col-sm-6'>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><?= str_replace("_"," ",$giudizzio) ?></h2>
                        </div>

                        <div class="panel-body" style='padding: 0px'>
                            <div id="<?= $giudizzio ?>" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
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
                                    <tr>
                                        <td >Anno Precedente</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['I'][0] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['S'][0] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['B'][0] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['E'][0] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['ieri'] ?></td> 
                                        
                                    </tr>
                                    <tr>
                                        <td >Anno in Corso</td>
                                        <td class='right'><?= $model->stats[$giudizzio]['I'][1] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['S'][1] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['B'][1] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['E'][1] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['anno'] ?></td> 
                                    </tr>
                                    <tr>
                                        <td >Totale Strutture </td>
                                        <td class='right'><?= $model->stats[$giudizzio]['I'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['S'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['B'][2] ?></td>
                                        <td class='right'><?= $model->stats[$giudizzio]['E'][2] ?></td> 
                                        <td class='right'><?= $model->stats[$giudizzio]['totale'] ?></td> 
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                        </div>
                    </div>
                </div>
            <?php }  } if( $model->stats['consiglia']['totale'] > 0){  ?>
                
                <div class='col-xs-12 col-sm-6'>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Consiglierebbe</h2>
                        </div>

                        <div class="panel-body" style='padding: 0px'>
                            <div id="consiglia" style="margin: 0 auto; width: 100% ; padding: 0px" class='grafico'></div>
                            <div style='padding: 5px 10px '>
                            <table  class="table  table-bordered dataTable" >
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class='right'>Certamente No</th>
                                        <th class='right'>Non so Forse</th>
                                        <th class='right'>Certamente Si</th>
                                        <th class='right'>Totale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td >Anno Precedente</td>
                                        <td class='right'><?= $model->stats['consiglia']['N'][0] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['F'][0] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['S'][0] ?></td> 
                                        <td class='right'><?= $model->stats['consiglia']['ieri'] ?></td> 
                                    </tr>
                                    <tr>
                                        <td >Anno in Corso</td>
                                        <td class='right'><?= $model->stats['consiglia']['N'][1] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['F'][1] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['S'][1] ?></td> 
                                        <td class='right'><?= $model->stats['consiglia']['anno'] ?></td> 
                                    </tr>
                                    <tr>
                                        <td >Totale Strutture </td>
                                        <td class='right'><?= $model->stats['consiglia']['N'][2] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['F'][2] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['S'][2] ?></td>
                                        <td class='right'><?= $model->stats['consiglia']['totale'] ?></td> 
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/js/grafici_percentuale.js"></script>-->
<script>
    
    <?php   if( $model->stats["consiglia"]['totale'] > 0 ){  ?>
       

       var consiglia =  Highcharts.chart('consiglia', {
            
            yAxis: { title: { text: 'Percentuale'} },
            title: {text: ''  },
            xAxis: {categories: ["Anno precedente","Anno in Corso","Media strutture"]},
            labels: {items: [{ html: '',  style: {  left: '50px', top: '18px',  } }]  },
            series: [{
                type: 'column',
                name: 'Certamente No',
                data: [<?= implode(",", $model->stats['consiglia']['N_per']) ?> ],
                color:'#e74c3c',
            }, {
                type: 'column',
                name: 'Non Sò Forse',
                data: [<?= implode(",", $model->stats['consiglia']['F_per']) ?>],
                color:'#f1c40f',
            }, {
                type: 'column',
                name: 'Certamente Si',
                data: [<?= implode(",", $model->stats['consiglia']['S_per']) ?>],
                color:'#0e836c',
            }],
        });

    <?php }
    
     foreach($giudizzi as $giudizzio){  
        
        if( $model->stats[$giudizzio]['totale'] > 0 ){  ?>
       
        var <?= $giudizzio ?> =  Highcharts.chart('<?= $giudizzio ?>', {
        
        yAxis: { title: {  text: 'Percentuale'            }        },
        title: { text: ''    },
        xAxis: { categories: ["Anno precedente","Anno in Corso","Media strutture"] },
        labels: { items: [{ html: '',  style: {  left: '50px',   top: '18px',   }  }]        },
        series: [{
            type: 'column',
            name: 'Insufficiente',
            data: [<?php echo implode(",", $model->stats[ $giudizzio ]['I_per']); ?> ],
            color:'#e74c3c',
        }, {
            type: 'column',
            name: 'Sufficiente',
            data: [<?php echo implode(",", $model->stats[ $giudizzio ]['S_per']); ?>],
            color:'#f1c40f',
        }, {
            type: 'column',
            name: 'Buono',
            data: [<?php echo implode(",", $model->stats[ $giudizzio ]['B_per']); ?>],
            color:'#35f887',
        },{
            type: 'column',
            name: 'Eccellente',
            data: [<?php echo implode(",", $model->stats[ $giudizzio ]['E_per']); ?>],
            color:'#0e836c',
        }],
    });

 <?php } } ?>

</script>
