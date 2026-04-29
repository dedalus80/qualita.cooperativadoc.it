<?php $form = $this->beginWidget('CActiveForm', array('id' => 'utenti-form','enableAjaxValidation' => true,'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
 ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class='row row-10'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
    
    <div class="row row-10">
        <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
            <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
            <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'user'); ?></label>
            <?php echo $form->textField($model, 'user', array('class' => 'form-control')); ?>
        </div>
    </div>
    
    <div class="row row-10">
        <!--<div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'password'); ?></label>
            <?php //echo $form->passwordField($model, 'password', array('class' => 'form-control', 'value'=>'')); ?>
            <span id="StrengthDisp" class="badge displayBadge" style="display:none">Debole</span>
        </div>-->
        <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'email'); ?></label> 
            <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'avatar'); ?> <?= $model->avatar ? "<a href='".Yii::app()->request->baseUrl."/avatar/".$model->avatar."' target='_blank' >".$model->avatar."</a>" : "" ?>   </label>
            <?php echo $form->fileField($model, 'avatar', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'user_type'); ?></label>
            <? echo $form->dropDownList($model, "user_type", $model->selectTipi, array('empty' => 'Scegli', 'class' => 'form-control') ); ?>
        </div>
    </div>
        
    <div class="row row-10 row-bottom" >
        <div class="col-xs-12 col-md-12">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'user_unita'); ?></label>
            <div class="input-group">							
                <a href='#' class='strutture input-group-addon' rel="tooltip" data-toggle="tooltip" title="Strutture">
                    <i class="fa fa-home"></i>
                </a>
                <div class='form-control tokenfield' id='Utenti_strutture_tag'>
                    <?php echo $model->strutture;?>
                </div>    
                <?php echo $form->hiddenField($model, 'user_unita'); ?>
            </div>
        </div>
    </div>

    <div class="row row-10 row-bottom">
        <div class="col-xs-12 col-md-12">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'selectedTags'); ?></label>
            <?php
                $utenteSelectedTagMap = array();
                if (!empty($model->selectedTags)) {
                    foreach ($model->selectedTags as $selectedTagId) {
                        $selectedTagId = (int)$selectedTagId;
                        if ($selectedTagId > 0 && isset($tagOptions[$selectedTagId])) {
                            $utenteSelectedTagMap[$selectedTagId] = $tagOptions[$selectedTagId];
                        }
                    }
                }
            ?>

            <div id="utente-tags-hidden-inputs"></div>
            <div id="utente-tags-available" class="well tag-box-soft" style="max-height:220px;overflow:auto;">
                <?php foreach ((isset($tagOptions) ? $tagOptions : array()) as $tagId => $tagName): ?>
                    <a href="#"
                       class="utente-tag-option label label-primary tag-label tag-label-clickable tag-label-soft"
                       data-tag-id="<?php echo (int)$tagId; ?>"
                       data-tag-name="<?php echo CHtml::encode($tagName); ?>">
                        <?php echo CHtml::encode($tagName); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <small class="help-block">I tag con sfondo verde sono associati all'utente. Clicca un tag per selezionarlo o deselezionarlo.</small>

            <script type="text/javascript">
                (function initUtenteTagsSelector() {
                    if (!window.jQuery) {
                        setTimeout(initUtenteTagsSelector, 50);
                        return;
                    }

                    var $ = window.jQuery;
                    var selectedTags = <?php echo CJSON::encode($utenteSelectedTagMap); ?>;

                    function getSortedIds() {
                        return Object.keys(selectedTags).sort(function (leftId, rightId) {
                            var leftName = String(selectedTags[leftId] || '').toLowerCase();
                            var rightName = String(selectedTags[rightId] || '').toLowerCase();
                            return leftName.localeCompare(rightName);
                        });
                    }

                    function sortAvailableTags() {
                        var $container = $('#utente-tags-available');
                        var $items = $container.find('.utente-tag-option').get();

                        $items.sort(function (leftEl, rightEl) {
                            var leftName = String($(leftEl).data('tag-name') || '').toLowerCase();
                            var rightName = String($(rightEl).data('tag-name') || '').toLowerCase();
                            return leftName.localeCompare(rightName);
                        });

                        $.each($items, function (_, item) {
                            $container.append(item);
                        });
                    }

                    function renderUtenteTags() {
                        var $hiddenInputs = $('#utente-tags-hidden-inputs');
                        $hiddenInputs.empty();

                        var ids = getSortedIds();
                        $('.utente-tag-option').removeClass('label-success tag-label-success').addClass('label-primary tag-label-soft');

                        for (var i = 0; i < ids.length; i++) {
                            var id = ids[i];
                            $('.utente-tag-option[data-tag-id="' + id + '"]').removeClass('label-primary tag-label-soft').addClass('label-success tag-label-success');
                            $hiddenInputs.append('<input type="hidden" name="Utenti[selectedTags][]" value="' + id + '">');
                        }
                    }

                    $(document).off('click.utenteTagsToggle').on('click.utenteTagsToggle', '.utente-tag-option', function (e) {
                        e.preventDefault();
                        var id = String($(this).data('tag-id'));
                        var name = $(this).data('tag-name');

                        if (selectedTags[id]) {
                            delete selectedTags[id];
                        } else {
                            selectedTags[id] = name;
                        }

                        renderUtenteTags();
                    });

                    sortAvailableTags();
                    renderUtenteTags();
                })();
            </script>
        </div>
    </div>

    <div class='custom_title'>Abilita visualizzazione preiscrizioni</div>
    <div class="row row-10 row-bottom" >
         <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_sn'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'preiscrizione_sn', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_sp'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'preiscrizione_sp', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_cs'); ?></label><br /> 
           <?php echo $form->radioButtonList($model, 'preiscrizione_cs', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_fo'); ?></label><br /> 
           <?php echo $form->radioButtonList($model, 'preiscrizione_fo', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom" >
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_sh'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'preiscrizione_sh', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_cm'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'preiscrizione_cm', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'preiscrizione_tim'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'preiscrizione_tim', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
	<div class='custom_title'>Abilita notifiche <span class='no-phone'>inserimento</span> questionari</div>
    <div class="row row-10 row-bottom" >
         <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_junior'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'q_junior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_senior'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'q_senior', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_scientifici'); ?></label><br /> 
           <?php echo $form->radioButtonList($model, 'q_scientifici', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_studio'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'q_studio', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
     <div class="row row-10 row-bottom" >
         <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_doc'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'q_doc', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_campus'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'q_campus', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_keluar'); ?></label><br /> 
           <?php echo $form->radioButtonList($model, 'q_keluar', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_sharing'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'q_sharing', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
    <div class="row row-10 row-bottom" >
         <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_formazione'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'q_formazione', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'q_vacanza'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'q_vacanza', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        
    </div>

    <div class='custom_title'>Abilita sezioni documenti</div>
    <div class="row row-10 row-bottom" >
         <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'documenti_qualita'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'documenti_qualita', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'documenti_soggiorni'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'documenti_soggiorni', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
        <div class="col-xs-6 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'area_documenti'); ?></label><br />
           <?php echo $form->radioButtonList($model, 'area_documenti', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>

    <div class="custom_title abilities-app">Abilitazione APP DOCFix</div>
    <div class="row row-10 row-bottom abilities-app">
        <div class="col-xs-6 col-md-3">
            <label for="is_maintenance_lead" class="control-label"><?php echo $form->labelEx($model, 'is_maintenance_lead'); ?></label><br />
            <?php echo $form->radioButtonList($model, 'is_maintenance_lead', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?>
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange ', 'id' => 'utenti-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
