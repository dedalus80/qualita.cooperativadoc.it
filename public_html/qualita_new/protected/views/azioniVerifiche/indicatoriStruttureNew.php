<?php
$this->breadcrumbs = array('Verifiche ispettive' => array('admin'), 'Indicatori per strutture',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Indicatori verifiche per strutture</h2></div>
    <div class="panel-body"> 
        <div style="overflow: auto">
        <table class="table table-striped table-bordered dataTable table-right" >
            <thead>
                <tr>
                    <th colspan='2'></th>
                    <?php foreach($indicatori['verifiche'] as $verifica => $counters):?>
                        <th colspan="2" class="centered" style="color:#000000; background-color:#CCFF99"><?php echo $verifica;?></th>
                    <?php endforeach;?>
                </tr>
                <tr>
                    <th style="text-align: left">Struttura</th>
                    <th id="">Verifiche </th>
                    <?php for($i=0;$i<count($indicatori['verifiche']);$i++):?>
                        <th >Complete</th>
                        <th >Non Complete</th>
                    <?php endfor;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($indicatori['unita'] as $struttura => $verifiche): ?>
                <tr>
                    <td style="text-align: left"><?php echo $struttura ?></td>
                    <td id=""><?php echo isset($verifiche['tot']) ? $verifiche['tot'] : '0'; ?></td>

                    <?php foreach($indicatori['verifiche'] as $tipo => $tot) {

                            if(isset($verifiche['verifiche'][$tipo])) {
                    ?>
                        <td id=""><?php echo isset($verifiche['verifiche'][$tipo]['totY']) ? $verifiche['verifiche'][$tipo]['totY'] : '0'; ?></td>
                        <td id=""><?php echo isset($verifiche['verifiche'][$tipo]['totN']) ? $verifiche['verifiche'][$tipo]['totN'] : '0'; ?></td>
                    <?php
                            }
                            else {
                    ?>
                        <td id="">0</td>
                        <td id="">0</td>
                    <?php
                            }
                    }?>                  
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align: left">TOTALI</th>
                    <th id=""><?php echo isset($indicatori['totale']) ? $indicatori['totale'] : '0'; ?></th>
                    <?php foreach($indicatori['verifiche'] as $verifica => $counters):?>
                        <th><?php echo isset($counters['totY']) ? $counters['totY'] : '0';?></th>
                        <th><?php echo isset($counters['totN']) ? $counters['totN'] : '0';?></th>
                    <?php endforeach;?>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>