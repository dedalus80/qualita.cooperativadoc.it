<?php $form = $this->beginWidget('CActiveForm', array( 'id' => 'azioni-formazione-form', 'enableAjaxValidation' => false, 'htmlOptions' => array("class" => 'wide form form-horizontal row-border' , 'enctype' => 'multipart/form-data'))); 
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="form-group">
        <!--<label class="col-sm-3 control-label"><?php //echo $form->labelEx($model, 'titolo'); ?></label>
        
        <div class="col-sm-8"><?php //echo $form->textField($model, 'titolo', array('class' => 'form-control', 'disabled' => $disabled)); ?></div>
-->
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'titolo_id'); ?></label>
        <div class="col-sm-8">
            <?php echo $form->dropDownList($model, "titolo_id", CHtml::listData(FormazioneTitoloCorsi::model()->findAll("attivo = 'Y'"),'id','titolo_corso'), array('empty' => 'Scegli', 'options' => $model->titolo_id, 'class' => 'form-control')); ?>
        </div>
    
    </div>


    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'id_categoria' ); ?></label>
        <div class="col-sm-8">
           <?= $form->dropDownList($model, "id_categoria", $model->selectCorsiAdmin, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'data'); ?></label>
        <div class="col-sm-8">
            <div class="input-daterange input-group" id="datepicker-range">
				<span class="p4-10 bleft input-group-addon data-calendar field-verifiche remove-disabled" data-refer="prima_verifica" ><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data', array('class' => 'left form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data))); ?>
                <span class="input-group-addon p4-10" >Al</span>
				<?php echo $form->textField($model, 'data_fine', array('class' => 'left form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data_fine))); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'ora'); ?></label>
        <div class="col-sm-8">
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 
                <?php echo $form->textField($model, 'ora', array('class' => 'form-control', 'disabled' => $disabled, )); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'invio_email' ); ?></label>
        <div class="col-sm-8">
             <div class="input-group date" >
                <span class="input-group-addon" style='padding: 4px 5px 4px'>
                 <?php echo $form->checkbox($model, 'invio_email', array('value' => 'Y' , "class" => 'checkbox-green' )); ?>
                </span> 
                <?php echo $form->numberField($model, 'giorni_invio_email', array("min"=> "0" ,"max"=> "5" ,'class' => 'form-control send', 'disabled' => $disabled, )); ?>
                 <span class="input-group-addon">
                 Giorni prima del' inizio del corso di formazione 
                </span> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'invio_sms' ); ?></label>
        <div class="col-sm-8">
             <div class="input-group date" >
                <span class="input-group-addon" style='padding: 4px 5px 4px'>
                 <?php echo $form->checkbox($model, 'invio_sms', array('value' => 'Y' , "class" => 'checkbox-green' )); ?>
                </span> 
                <?php echo $form->numberField($model, 'giorni_invio_sms', array("min"=> "0" ,"max"=> "5" , 'class' => 'form-control send', 'disabled' => $disabled, )); ?>
                 <span class="input-group-addon">
                 Giorni prima del' inizio del corso di formazione 
                </span> 
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'gruppi'); ?></label>
        <div class="col-sm-8">
            <?php foreach($model->selectGruppi AS $id => $val){
    
    
    
            if(count($model->gruppi))
                in_array($id, $model->gruppi) ? $checked[$id] = "checked='checked' ": $checked[$id] =''
            
            ?>
            <div class="input-group date" style='margin-bottom: 5px'>
                <span class="input-group-addon" style='padding: 4px 5px 4px;'>
                    <input type='checkbox' class='checkbox-green' name ='gruppi[<?= $id ?>]' value ='<?= $id ?>'  <?= $checked[$id] ?>  >
                </span>
                <input type='text' class='form-control' disabled='disabled' value='<?= $val ?>'>
            </div>
             <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'selectedTags'); ?></label>
        <div class="col-sm-8">
            <?php
                $selectedTagMap = array();
                if (!empty($model->selectedTags)) {
                    foreach ($model->selectedTags as $selectedTagId) {
                        $selectedTagId = (int)$selectedTagId;
                        if ($selectedTagId > 0 && isset($model->selectTags[$selectedTagId])) {
                            $selectedTagMap[$selectedTagId] = $model->selectTags[$selectedTagId];
                        }
                    }
                }
            ?>

            <div id="formazione-tags-selected" class="well tag-box-soft" style="min-height:70px;margin-bottom:10px;"></div>
            <div id="formazione-tags-hidden-inputs"></div>

            <div id="formazione-tags-available" class="well tag-box-soft" style="max-height:180px;overflow:auto;">
                <?php foreach ($model->selectTags as $tagId => $tagName): ?>
                    <a href="#"
                       class="formazione-tag-option label label-primary tag-label tag-label-clickable tag-label-soft"
                       data-tag-id="<?php echo (int)$tagId; ?>"
                       data-tag-name="<?php echo CHtml::encode($tagName); ?>"
                       style="">
                        <?php echo CHtml::encode($tagName); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <small class="help-block">Clicca un tag per aggiungerlo. Clicca la <strong>x</strong> sul tag selezionato per rimuoverlo.</small>

            <script type="text/javascript">
                (function initFormazioneTagsSelector() {
                    if (!window.jQuery) {
                        setTimeout(initFormazioneTagsSelector, 50);
                        return;
                    }

                    var $ = window.jQuery;
                    var selectedTags = <?php echo CJSON::encode($selectedTagMap); ?>;

                    function getSortedIds() {
                        return Object.keys(selectedTags).sort(function (leftId, rightId) {
                            var leftName = String(selectedTags[leftId] || '').toLowerCase();
                            var rightName = String(selectedTags[rightId] || '').toLowerCase();
                            return leftName.localeCompare(rightName);
                        });
                    }

                    function sortAvailableTags() {
                        var $container = $('#formazione-tags-available');
                        var $items = $container.find('.formazione-tag-option').get();

                        $items.sort(function (leftEl, rightEl) {
                            var leftName = String($(leftEl).data('tag-name') || '').toLowerCase();
                            var rightName = String($(rightEl).data('tag-name') || '').toLowerCase();
                            return leftName.localeCompare(rightName);
                        });

                        $.each($items, function (_, item) {
                            $container.append(item);
                        });
                    }

                    function renderSelectedTags() {
                        var $selectedBox = $('#formazione-tags-selected');
                        var $hiddenInputs = $('#formazione-tags-hidden-inputs');

                        $selectedBox.empty();
                        $hiddenInputs.empty();

                        var ids = getSortedIds();
                        if (!ids.length) {
                            $selectedBox.html('<span class="text-muted">Nessun tag selezionato</span>');
                        }

                        for (var i = 0; i < ids.length; i++) {
                            var id = ids[i];
                            var name = selectedTags[id];

                            $selectedBox.append(
                                '<span class="label label-primary tag-label tag-label-primary">' +
                                name +
                                ' <a href="#" class="remove-formazione-tag tag-label-remove" data-tag-id="' + id + '">×</a>' +
                                '</span>'
                            );

                            $hiddenInputs.append('<input type="hidden" name="AzioniFormazione[selectedTags][]" value="' + id + '">');
                        }

                        $('.formazione-tag-option').removeClass('tag-label-primary').addClass('label-primary tag-label-soft');
                        for (var j = 0; j < ids.length; j++) {
                            $('.formazione-tag-option[data-tag-id="' + ids[j] + '"]').removeClass('tag-label-soft').addClass('tag-label-primary');
                        }
                    }

                    $(document).off('click.formazioneTagsAdd').on('click.formazioneTagsAdd', '.formazione-tag-option', function (e) {
                        e.preventDefault();
                        var id = String($(this).data('tag-id'));
                        var name = $(this).data('tag-name');
                        selectedTags[id] = name;
                        renderSelectedTags();
                    });

                    $(document).off('click.formazioneTagsRemove').on('click.formazioneTagsRemove', '.remove-formazione-tag', function (e) {
                        e.preventDefault();
                        var id = String($(this).data('tag-id'));
                        delete selectedTags[id];
                        renderSelectedTags();
                    });

                    sortAvailableTags();
                    renderSelectedTags();
                })();
            </script>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'descrizione'); ?></label>
        <div class="col-sm-8"><?php echo $form->textArea($model, 'descrizione', array('class' => 'form-control')); ?></div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'tipo_accesso'); ?></label>
        <div class="col-sm-8"><?php echo $form->radioButtonList($model, 'tipo_accesso', array('P' => 'In presenza', 'O' => 'On-line'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red radio-tipo-corso', 'separator' => '&nbsp&nbsp;')); ?></div>
    </div>

    <div id="view-link-accesso" class="form-group" <?php echo ($model->isNewRecord || $model->tipo_accesso=='P'?'style="display:none"':'');?>>
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'link_accesso'); ?></label>
        <div class="col-sm-8"><?php echo $form->textField($model, 'link_accesso', array('class' => 'form-control')); ?></div>
    </div>

    <div id="view-address-accesso" class="form-group" <?php echo ($model->isNewRecord || $model->tipo_accesso=='O'?'style="display:none"':'');?>>
        <label class="col-sm-3 control-label"><?php echo $form->labelEx($model, 'address_accesso'); ?></label>
        <div class="col-sm-8"><?php echo $form->textField($model, 'address_accesso', array('class' => 'form-control')); ?></div>
    </div>

    <div class='row row-10 row-bottom'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form ', 'data-refer' => 'azioni-formazione-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
