<?php
$this->breadcrumbs = array(
    'Questionari' => array('admin'),
    'indice di soddisfazione',
);

function getColor($valore) {
    if ($valore > 75)
        $colore = "success";
    else if ($valore > 50)
        $colore = "warning";
    else
        $colore = "danger";
    return $colore;
}
?>
<div class="row">
    <div class="col-xs-12">
        <blockquote>
            <h5>L'indice di soddisfazione viene calcolato assegnado: <br />
            - 25 punti per ogni risposta <span class="text-danger">"POCO"</span> <br />
            - 50 punti per ogni risposta <span class="text-warning">"ABBASTANZA"</span> <br />
            - 100 punti per ogni risposta <span class="text-success">"MOLTO"</span></h5>
        </blockquote>
    </div>
</div>
<div class="panel-group panel-default" id="accordionA" style="margin-bottom: 300px ">
    <? foreach ($model->smile AS $id => $val) { ?>
        <div class="panel panel-default panel-480">
            <a data-toggle="collapse" data-parent="#accordionA" href="#questionario_<?= $id ?>">
                <div class="panel-heading">
					<h2>Questionari <?= $id ?><span class='orange '> <?= $model->smile[$id]['totale'] ?> </span> </h2>
                    <div class="panel-ctrls button-icon-bg progress-480" >
                        <div class="progress general-progress lnb">
                            <div class="progress-bar progress-bar-<?= getColor($model->smile[$id]['percentuale']) ?>" style="width:<?= $model->smile[$id]['percentuale'] ?>%"></div> 
                        </div>
						<div class="lnb" style="margin-right: 10px">
                            <?= $model->smile[$id]['percentuale'] ?>% 
                        </div>
                    </div>
                </div>
            </a>
            <div id="questionario_<?= $id ?>" class="collapse <? $id == 'junior' ? "in" : "" ?> ">
                <div class="panel-body">
                    <table class="table  table-striped table-bordered dataTable">
                        <thead>
                        <th>Questionario</th>
                        <th class="hidden-480">Gruppo</th>
                        <th style="">Risposte</th>
                        <th style="">Percentuale</th>
                        </thead>
                        <tbody>
                            <?
                            foreach ($model->smile[$id] AS $gruppo => $valori) {

                                if ($gruppo != 'totale' && $gruppo != 'percentuale' && $gruppo != 'punteggio' && $gruppo != 'quanti') {
                                    ?>
                                    <tr>
										<td class="td-phone">
											<span class='bold'>Tipologia:</span>&nbsp;<?= $id ?><br />
											<span class='bold'>Gruppo:</span>&nbsp;<?= $gruppo ?>
										</td>
                                        <td class='hidden-480'><?= $id ?> </td>
                                        <td class='hidden-480'><?= $gruppo ?> </td>
                                        <td><?= $valori['totale'] ?></td>
                                        <td style='width: 35%'>
                                            <div class="lbn">
                                                <div class="clearfix">
                                                    <div class="progress-percentage"><?= $valori['percentuale'] ?>%</div>
                                                </div>
                                            </div>
                                            <div class="progress lbn">
                                                <div class="progress-bar progress-bar-<?= getColor($valori['percentuale']) ?>" style="width: <?= $valori['percentuale'] ?>%"></div>
                                            </div>
                                        </td>
                                    </tr>
                                <? }
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    <? } ?>
</div>