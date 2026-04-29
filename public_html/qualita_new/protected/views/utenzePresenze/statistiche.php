<?php
    $this->breadcrumbs = array('Statistiche Generali' =>array('index'),);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2>
            <i class='fa fa-bar-chart-o'></i>&nbsp;Statistiche consumi&nbsp;
            <span class='orange return-block' style='font-weight: 600'><?php echo $model->struttura_nome;?></span>
        </h2>
        
        <?php //if($admin =='Y'): ?>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li>
                    <div class="input-group " style="margin-bottom:-5px !important">
                        <span class="input-group-addon ">Struttura</span>
                        <?php 
                            if (Yii::app()->user->getState('group') == 'ADMIN') {
                                echo CHtml::dropDownList('struttura', $model->struttura, CHtml::listData(Strutture::model()->findAll(['order'=>'nome']), 'id', 'nome'), ['empty'=>'-- Seleziona --', 'class'=>'form-control']);
                            }
                            else {
                                echo CHtml::dropDownList("struttura", $model->struttura, CHtml::listData(Strutture::model()->findAll(['condition' => 'id IN ("'.implode('","', Yii::app()->user->getState('strutture')).'")', 'order'=>'nome']), 'id', 'nome'), ['empty'=>'-- Seleziona --', 'class'=>'form-control']);
                            }
                        ?>
                    </div>
                </li>
                <li>
                    <?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'stats-utenze-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?>
                </li>
                <?php if(Yii::app()->user->getState('group') == 'ADMIN'): ?>
                <li class='li-480' ><a href='#' id='stampa-grafici-btn' class='button-icon button-icon-green' data-model='UtenzePresenze' ><i class='fa fa-download'></i></a> </li>
                <?php endif;?>
                
                <input type='hidden' id='struttura-utente' name='struttura-utente' value='<?= $model->struttura ?>' />
                <input type='hidden' id='struttura-anno' name='struttura-anno' value='' />
                <input type='hidden' id='tipo-grafico' name='tipo-grafico' value='presenze' />
            </ul>
        </div>
        <?php //endif; ?>
    </div>
    <div class="panel-body" id="stats">
        <div class='row'>
            <?php foreach($grafici AS $id => $val ): ?>
                <div class='col-xs-12 col-sm-4'>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h2><?= $grafici[$id]['titolo'] ?></h2></div>    
                        <div class="panel-body">
                            <?= count($stat[$val['tipo']][$val['stats']] ) ? '<div id="grafico-'.$id.'" style="margin: 0 auto"></div>': "Non sono presenti dati statistici per i ".$grafici[$id]['stats']." di ".$id; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    
<?php
    foreach($grafici as $titolo => $dati){
        if(count($stat[$dati['tipo']][$dati['stats']])) {
?>
        var grafico_<?= str_replace("-","_", $titolo) ?> = Highcharts.chart('grafico-<?= $titolo ?>', {
            chart: {
                marginLeft: 80,
                spacingLeft: 10
            },
            yAxis: {
                title: { text: '' },
                labels: {
                    style: { fontSize: '11px' },
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 0, ',', '.');
                    }
                }
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
            title: {text: ''},
            xAxis: {categories: [<?= implode(",",$stat[  $dati['tipo'] ]['anni']) ?>]  },
            labels: {items: [{   html: '', style: { left: '10px', top: '18px',  } }]   },
            series: [{
                type: 'column',
                name: '<?= $dati['dati'] ?>',
                data: [<?= implode(",",$stat[  $dati['tipo'] ][ $dati['stats'] ]) ?>],
                color: "#8dc9e8"
            }]
        });
<?php
        }
    }
?>
</script>
