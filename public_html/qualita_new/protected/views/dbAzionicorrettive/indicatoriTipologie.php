
<?php
$this->breadcrumbs = array('Azioni correttive' => array('admin'), 'Indicatori per tipologia',);
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading"><h2><i class='fa fa-thumbs-o-up'></i>Indicatori <span class="hidden-480">azioni correttive </span><span class="only-480">ac </span>per tipologia</h2></div>
    <div class="panel-body">
        <div style="overflow:auto">
        <table class="table table-striped table-bordered dataTable tabella-right"  >
             <thead>
                <tr>
                    <th style="text-align: left">Tipologia</th>
					<th style="text-align: left; min-width: 150px" class='td-phone'>Indicatori</th>
                    <th class='no-phone no-tablet'>Totale</th>
                    <th class='no-phone no-tablet'>Chiuse</th>
                    <th class='no-phone no-tablet'>Aperte</th>
                    <th class='no-phone no-tablet'>C. Positive</th>
                    <th class='no-phone no-tablet'>C. Negative</th>
                    <th class='no-phone no-tablet' style="min-width: 130px">% Chiuse</th>
                    <th class='no-phone no-tablet' style="min-width: 130px">% C. Positive</th>
                    <th class='no-phone no-tablet' style="min-width: 130px">% C. Negative</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($x = 0; $x < count($model->indicatori['tipologie']); $x++) { ?>
                    <tr>
                        <td style="text-align: left" ><?= $model->indicatori['tipologie'][$x]['nome'] ?></td>
						<td style="text-align: left" class='td-phone' >
							<span class='bold indicatore'>Totale</span>&nbsp;&nbsp;<?= $model->indicatori['tipologie'][$x]['indicatori']['totale'] ?><br />
							<span class='bold indicatore'>Chiuse</span>&nbsp;&nbsp;<?= $model->indicatori['tipologie'][$x]['indicatori']['chiuse'] ?><br />
							<span class='bold indicatore'>Aperte</span>&nbsp;&nbsp;<?= $model->indicatori['tipologie'][$x]['indicatori']['da_chiudere'] ?><br />
							<span class='bold indicatore'>C. Positive</span>&nbsp;&nbsp;<?= $model->indicatori['tipologie'][$x]['indicatori']['positive'] ?><br />
							<span class='bold indicatore'>C. Negative</span>&nbsp;&nbsp;<?= $model->indicatori['tipologie'][$x]['indicatori']['negative'] ?>
						</td>
                        <td class='no-phone no-tablet'><?= $model->indicatori['tipologie'][$x]['indicatori']['totale'] ?></td>
                        <td class='no-phone no-tablet'><?= $model->indicatori['tipologie'][$x]['indicatori']['chiuse'] ?></td>
                        <td class='no-phone no-tablet'><?= $model->indicatori['tipologie'][$x]['indicatori']['da_chiudere'] ?></td>
                        <td class='no-phone no-tablet'><?= $model->indicatori['tipologie'][$x]['indicatori']['positive'] ?></td>
                        <td class='no-phone no-tablet'><?= $model->indicatori['tipologie'][$x]['indicatori']['negative'] ?></td>
                        <td class='no-phone no-tablet'>
                            <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['tipologie'][$x]['indicatori']['color_per_chiuse'] ?>" style="width:<?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse'] ?>%"></div>
                            </div>
                            <div style="; display: inline-block"><?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse'] ?>%</div>    
                        </td>
                        <td class='no-phone no-tablet'>
                            <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['tipologie'][$x]['indicatori']['color_per_chiuse_positive'] ?>" style="width: <?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse_positive'] ?>%"></div>
                            </div>
                            <div style="; display: inline-block"> <?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse_positive'] ?>%</div>
                        </td>
                        <td class='no-phone no-tablet'>
                            <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['tipologie'][$x]['indicatori']['color_per_chiuse_negative'] ?>" style="width:<?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse_negative'] ?>%"></div>
                            </div>
                            <div style="; display: inline-block"><?= $model->indicatori['tipologie'][$x]['indicatori']['per_chiuse_negative'] ?>%</div>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align: left" >TOTALI</th>
					  <th style="text-align: left"  class='td-phone' >
						<span class='bold indicatore'>Totale</span>&nbsp;&nbsp;<?= $model->indicatori['totali']['totale'] ?><br />
						<span class='bold indicatore'>Chiuse</span>&nbsp;&nbsp;<?= $model->indicatori['totali']['chiuse'] ?><br />
						<span class='bold indicatore'>Aperte</span>&nbsp;&nbsp;<?= $model->indicatori['totali']['da_chiudere'] ?><br />
						<span class='bold indicatore'>C. Positive</span>&nbsp;&nbsp;<?= $model->indicatori['totali']['positive'] ?><br />
						<span class='bold indicatore' >C. Negative</span>&nbsp;&nbsp;<?= $model->indicatori['totali']['negative'] ?>
					</th>
                    <th class='no-phone no-tablet'><?= $model->indicatori['totali']['totale'] ?></th>
                    <th class='no-phone no-tablet'><?= $model->indicatori['totali']['chiuse'] ?></th>
                    <th class='no-phone no-tablet'><?= $model->indicatori['totali']['da_chiudere'] ?></th>
                    <th class='no-phone no-tablet'><?= $model->indicatori['totali']['positive'] ?></th>
                    <th class='no-phone no-tablet'><?= $model->indicatori['totali']['negative'] ?></th>
                    <th class='no-phone no-tablet'>
                        <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                             <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['totali']['color_per_chiuse'] ?>" style="width: <?= $model->indicatori['totali']['per_chiuse'] ?>%"></div>
                        </div>
                        <div style="; display: inline-block"> <?= $model->indicatori['totali']['per_chiuse'] ?>%</div>
                     </th>
                    <th class='no-phone no-tablet'>
                        <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                             <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['totali']['color_per_chiuse_positive'] ?>" style="width: <?= $model->indicatori['totali']['per_chiuse_positive'] ?>%"></div>
                        </div>
                        <div style="; display: inline-block"> <?= $model->indicatori['totali']['per_chiuse_positive'] ?>%</div>
                    </th>
                    <th class='no-phone no-tablet'>
                        <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                             <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['totali']['color_per_chiuse_negative'] ?>" style="width:<?= $model->indicatori['totali']['per_chiuse_negative'] ?>%"></div>
                        </div>
                        <div style="; display: inline-block"><?= $model->indicatori['totali']['per_chiuse_negative'] ?>%</div>
                    </th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>