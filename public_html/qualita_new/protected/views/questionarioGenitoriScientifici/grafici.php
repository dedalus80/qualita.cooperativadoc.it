<?php
$this->breadcrumbs = array('Questionari Genitori Campus formativi' => array('index'), 'statistiche',);
?>
<div class="row">
    <div class="panel panel-default panel-margin" style="">
        <div class="panel-heading">
            <h2><i class='fa fa-bar-chart-o'></i>&nbsp;sTATISTICHE QUESTIONARI  <span class='orange return-block'>GENITORI CAMPUS FORMATIVI <?= $model->struttura ?> <?= $model->turno ? $model->turno." Turno":"" ?> </span> TOTALE QUESTIONARI <span class='orange return-block'> <?= $model->stats['totale'] ?></span></h2>
            <div class="panel-ctrls">
               
            </div>
        </div>
        <div class="panel-body" id="stats">
            <div class="row">
                <div class="col-xs-12 col-sm-2"  > 
                    <div class="input-group date" >
                        <span class="input-group-addon">Anno</span>
                        <select id="anno" name="anno" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectAnni AS $id => $val) { ?>
                                <option value="<?= $id ?>"  <?= $model->anno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3"  >
                    <div class="input-group date" >
                        <span class="input-group-addon">Struttura</span>
                        <select id="struttura" name="struttura" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectSoggiorni AS $id => $val) { ?>
                                <option value="<?= $id ?>"  <?= $model->id_struttura == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2"  >
                    <div class="input-group date" >
                        <span class="input-group-addon">Turno</span>
                        <select id="turno" name="turno" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectTurni AS $id => $val) { ?>
                                <option value="<?= $id ?>"  <?= $model->turno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3"  >
                    <div class="input-group date" >
                        <span class="input-group-addon">Gruppo</span>
                        <select id="nome_gruppo" name="nome_gruppo" class="form-control">
                            <option value=""> -- Seleziona </option>
                            <? foreach ($model->selectGruppi AS $id => $val) { ?>
                                <option value="<?= $id ?>"  <?= $model->nome_gruppo == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                            <? } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2"  >
                    <?php echo CHtml::link('<i class="fa fa-refresh"></i><span class="hidden-480">&nbsp;&nbsp;Aggiorna', '#', array('class' => 'btn btn-default btn-md btn-update-stats', 'id' => 'stats-genitori-scientifici-btn')); ?>
                </div>
            </div>
            <?php echo $this->renderPartial('_form', array('model' => $model,)); ?>
        </div>
    </div>
</div>


