<?php
$this->breadcrumbs = array('Questionari Torre Marina' => array('index'), 'statistiche',);
?>
<div class="row">
    <div class="panel panel-default panel-margin" style="">
        <div class="panel-heading">
            <h2><i class='fa fa-bar-chart-o'></i>&nbsp;sTATISTICHE <span class='orange return-block'><?= $model->struttura ?> </span> TOTALE QUESTIONARI <span class='orange return-block'><?=$model->stats['totale']?></span></h2>
            <div class="panel-ctrls">
                <ul class="demo-btns" >
                    <li  >
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
                    <li>
                        <div class="input-group date" style="margin-bottom:-5px !important" >
                            <span class="input-group-addon ">Struttura</span>
                            <select id="struttura" name="struttura" class="form-control">
                                <option value=""> -- Seleziona </option>
                                <? foreach ($model->selectStrutture AS $id => $val) { ?>
                                    <option value="<?= $id ?>"  <?= $model->struttura_nome == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                <? } ?>
                            </select>
                         </div>
                    </li>
                     <li><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'stats-torremarina-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                </ul>
            </div>
        </div>
        <div class="panel-body" id="stats">
            <?php echo $this->renderPartial('_form', array('model' => $model, )); ?>
        </div>
    </div>
</div>


