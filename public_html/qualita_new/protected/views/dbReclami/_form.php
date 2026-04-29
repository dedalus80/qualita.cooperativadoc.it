<?
$siNo = array("1" => "Si", "0" => "No");
?>
<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'db-reclami-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array('validateOnSubmit' => true,),));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10">
        <div class="col-xs-12 ">
            <?= $model->data_inserimento ? "Ultimo aggiornamento <span class='testoBlu'>" . Yii::app()->MyUtils->getItaDate($model->data_inserimento, "") . "</span>" : ""; ?>
        </div>
    </div>

    <?php if ($model->typeUser == 'admin'): ?>
    <div class="row row-10">
        <div class="col-xs-3 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_inserimento'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_inserimento', array('class' => 'form-control hasDatepicker richiamo' , 'value' =>  (new DateTime($model->data_inserimento))->format('d-m-Y'))); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <div class="left-small <?= $model->canale != '4' ? "left-small-big" : "left-small-small"; ?>" id ="canale">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'canale'); ?></label>
                <? echo $form->dropDownList($model, "canale", $model->selectCanali, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="left-small" id="canale-specificare" style="display:<?= $model->canale == '4' ? "inline-block" : "none" ?>">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'canale_altro'); ?></label>
                <?php echo $form->textField($model, 'canale_altro', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="left-small <?= $model->tipologia != '3' ? "left-small-big" : "left-small-small"; ?>" id ="tipologia">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipologia'); ?></label>
                <? echo $form->dropDownList($model, "tipologia", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="left-small    " id="tipologia-specificare"style="display:<?= $model->tipologia == '3' ? "inline-block" : "none" ?>">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tipologia_altro'); ?></label>
                <?php echo $form->textField($model, 'tipologia_altro', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>

        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
    </div>  
    <div class='row row-10'>
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'descrizione'); ?></label><br />
            <? echo $form->textArea($model, "descrizione", array('maxlength' => 800, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'motivazione'); ?></label><br />
            <? echo $form->textArea($model, "motivazione", array('motivazione' => 800, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
    </div>

    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
            <?php
                //if ($model->typeUser == 'admin' || Yii::app()->user->getId() == 110)
                //    echo $form->dropDownList($model, "unita_operativa", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                //else {
                //    echo $form->hiddenField($model, 'unita_operativa', array('class' => 'form-control'));
                //    echo "<br><span class='struttura-line'>" . Yii::app()->MyUtils->getStrutturaNome()."</span>";
                //}

                echo $form->dropDownList(
                    $model,
                    "unita_operativa",
                    $strutture, 
                    array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')
                );
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome_compilatore'); ?></label>
            <?php echo $form->textField($model, 'nome_compilatore', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome_compilatore'); ?></label>
            <?php echo $form->textField($model, 'cognome_compilatore', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'societa'); ?></label>
            <? echo $form->dropDownList($model, "societa", $model->selectSocieta, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>    
    <div class="row row-10">
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'funzione'); ?></label>
            <? echo $form->dropDownList($model, "funzione", $model->selectFunzioni, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'allegato'); ?>  <?= $model->allegato ? "Allegato: <a href='/../qualita_new/images/allegati_reclami/" . $model->allegato . "' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegato'  >" . $model->allegato . "</a>" : "" ?> </label> 
            <? echo $form->fileField($model, 'allegato', array('class' => 'form-control')); ?>
           
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'chiusura'); ?></label>
            <? echo $form->dropDownList($model, "chiusura", $model->selectChiusure, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'non_conformita'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'non_conformita', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
    <div class="row row-10" style="display:<?= $model->non_conformita == 'N' ? "block" : "none" ?> " id="motivo" >
        <div class="col-xs-12 col-md-12">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'motivo_non_conformita'); ?></label><br />
            <? echo $form->textArea($model, "motivo_non_conformita", array('maxlength' => 320, 'rows' => 4, 'cols' => 30, 'class' => 'form-control')); ?>
        </div>
    </div>

    <?php if(Yii::app()->user->isEnabled('AzioniReclami')):?>
    <div class="panel-heading" id="inter-heading">
		<h2><i class='fa fa-bullhorn'></i>&nbsp; Azioni <span class='hidden-480'>Da fare </span>verso il cliente</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'add-extra', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi Azione reclamo'))); ?></li>
            </ul>
        </div>
    </div>

    <div class="col-xs-12 col-md-12">
        <div id="extra-block">
            <? if (count($model->azioni)) {
                for ($x = 0; $x < count($model->azioni); $x++) { ?>
                    <div class="block-azione row-extra" id ="row-<?= $model->azioni[$x]['id'] ?>">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 extra-row">
                                <input type='hidden' name ='Azione[<?= $x ?>][id]' value='<?= $model->azioni[$x]['id'] ?>'   id ='id-extra-<?= $model->azioni[$x]['id'] ?>' />
                                <label for="" class="control-label">Descrizione azione <?= $x + 1 ?></label>
                                <textarea name="Azione[<?= $x ?>][descrizione]"   class="form-control"  ><?= $model->azioni[$x]['descrizione'] ?></textarea>
                            </div>   
                        </div> 
                        <div class="row row-10">
                            <div class="col-xs-12 col-sm-2 extra-row">
                                <label for="" class="control-label">Entro il</label>
                                <div class="input-group date" >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="Azione[<?= $x ?>][entro_il]"   class="form-control hasDatepicker form-size richiamo" value="<?= Yii::app()->MyUtils->reverseDate($model->azioni[$x]['entro_il']) ?>" style="width: 100px !important"/>
                                </div>
                            </div>

                            <div class="col-xs-6 col-sm-2 extra-row">
                                <label for="" class="control-label">Nome</label>
                                <input type="text" name="Azione[<?= $x ?>][nome]"  class="form-control" value="<?= $model->azioni[$x]['nome'] ?>"  />
                            </div>
                            <div class="col-xs-6 col-sm-2 extra-row">
                                <label for="" class="control-label">Cognome</label>
                                <input type="text" name="Azione[<?= $x ?>][cognome]"   class="form-control" value="<?= $model->azioni[$x]['cognome'] ?>"  />
                            </div>    
                            <div class="col-xs-12 col-sm-2 extra-row"> 
                                <label for="" class="control-label">Funzioni</label>
                                <select name="Azione[<?= $x ?>][funzione]"   class="form-control   extra-select"   >
                                    <option value =''>- Seleziona-</option>

                                    <?
                                    foreach ($model->selectFunzioni AS $id => $val) {

                                        if ($id == $model->azioni[$x]['funzione'])
                                            $sel = 'selected ="selected"';
                                        else
                                            $sel = '';
                                        ?>
                                        <option value ='<?= $id ?>'  <?= $sel ?> ><?= $val ?></option>
                                    <? } ?>
                                </select>
                            </div>

                            <div class="col-xs-10  col-sm-3 extra-row">
                                <label for="" class="control-label">Allegato</label>
                                <input type="file" name="Azione[<?= $x ?>][allegato]"  class="form-control"  />
                            </div>
                            <div class="col-xs-2  col-sm-1 extra-row" style="padding-right: 0px ;padding-left: 0px">
                                <label for="" class="control-label">&nbsp;</label><br />
                                <span class='row-action'><?php echo CHtml::link('<i class="fa fa-trash"></i><span class="">', "javascript:delExtraRow('old'," . $model->azioni[$x]['id'] . ")", array('data-extra' => 'old', 'data-extraid' => $model->azioni[$x]['id'], 'class' => 'dell-extra btn btn-danger  open-search button-icon button-icon-red', 'id' => 'add-extra-btn', 'style' => 'padding: 7px', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Elimina azione'))); ?></span> 
                            </div>
                        </div>
                    <? }
                } else { ?>
                    <div class="row buttons" style='margin:20px 0px 10px 0px' id='no-extra' >  
                        <div class="col-xs-12"> Non sono ancora state inserite azioni da fare verso il cliente / fornitore.<br />Per aggiungere un azione cliccare sul link "Aggiungi azione" In alto a destra </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div>    
        <div class='row row-10 row-bottom' style="margin-top: 30px" >
            <div class="col-xs-12">
                <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="pull-right">
            <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange  ', 'id' => 'db-reclami-btn')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
	
