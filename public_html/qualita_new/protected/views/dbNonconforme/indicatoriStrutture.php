
<?php
$this->breadcrumbs = array('Azioni non conformi' => array('admin'), 'Indicatori per strutture',);
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading"><h2><i class='fa fa-thumbs-o-down'></i>Indicatori <span class="hidden-480">non conformita </span><span class="only-480">nc </span>per strutture</h2></div>
    <div class="panel-body"> 
        <div style="overflow: auto">
            <table class="table table-striped table-bordered dataTable table-right" >
                <thead>
                    <tr>
                        <th style="text-align: left">Struttura</th>
						<th class='td-phone' style="min-width: 150px; text-align:left" >Indicatori</th>
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
                    <?php for ($x = 0; $x < count($model->indicatori['strutture']); $x++) { ?>
                        <tr>
                            <td style="text-align: left" ><?= $model->indicatori['strutture'][$x]['nome'] ?></td>
							<td class="td-phone" style="text-align: left">
								<span class='bold indicatore'>Totale</span>&nbsp;&nbsp;<?= $model->indicatori['strutture'][$x]['indicatori']['totale'] ?><br />
								<span class='bold indicatore'>Chiuse</span>&nbsp;&nbsp;<?= $model->indicatori['strutture'][$x]['indicatori']['chiuse'] ?><br />
								<span class='bold indicatore'>Aperte</span>&nbsp;&nbsp;<?= $model->indicatori['strutture'][$x]['indicatori']['da_chiudere'] ?><br />
								<span class='bold indicatore'>C. Positive</span>&nbsp;&nbsp;<?= $model->indicatori['strutture'][$x]['indicatori']['positive'] ?><br />
								<span class='bold indicatore'>C. Negative</span>&nbsp;&nbsp;<?= $model->indicatori['strutture'][$x]['indicatori']['negative'] ?>
							</td>
                            <td class='no-phone no-tablet'><?= $model->indicatori['strutture'][$x]['indicatori']['totale'] ?></td>
                            <td class='no-phone no-tablet'><?= $model->indicatori['strutture'][$x]['indicatori']['chiuse'] ?></td>
                            <td class='no-phone no-tablet'><?= $model->indicatori['strutture'][$x]['indicatori']['da_chiudere'] ?></td>
                            <td class='no-phone no-tablet'><?= $model->indicatori['strutture'][$x]['indicatori']['positive'] ?></td>
                            <td class='no-phone no-tablet'><?= $model->indicatori['strutture'][$x]['indicatori']['negative'] ?></td>
                            <td class='no-phone no-tablet'>
                                <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                    <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['strutture'][$x]['indicatori']['color_per_chiuse'] ?>" style="width:<?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse'] ?>%"></div>
                                </div>
                                <div style="; display: inline-block"><?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse'] ?>%</div>    
                            </td>
                            <td class='no-phone no-tablet'>
                                <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                    <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['strutture'][$x]['indicatori']['color_per_chiuse_positive'] ?>" style="width: <?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse_positive'] ?>%"></div>
                                </div>
                                <div style="; display: inline-block"> <?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse_positive'] ?>%</div>
                            </td>
                            <td class='no-phone no-tablet'>
                                <div class="progress" style="display: inline-block ; margin-bottom: 0px ; margin: 0px; width: 70%">
                                    <div id="progress-sezione-1"   class="progress-bar progress-bar-<?= $model->indicatori['strutture'][$x]['indicatori']['color_per_chiuse_negative'] ?>" style="width:<?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse_negative'] ?>%"></div>
                                </div>
                                <div style="; display: inline-block"><?= $model->indicatori['strutture'][$x]['indicatori']['per_chiuse_negative'] ?>%</div>
                            </td>
				        </tr>
                    <? } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align: left" >TOTALI</th>
						<th class='td-phone' style="text-align: left">
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