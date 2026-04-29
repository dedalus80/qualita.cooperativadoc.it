<?php $form = $this->beginWidget('CActiveForm', array('id' => 'cm-preiscrizioni-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'), 'clientOptions' => array('validateOnSubmit' => true,),)); ?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <fieldset>
        <legend>Dati Genitore</legend>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome'); ?></label>
                <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome'); ?></label>
                <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cellulare'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <?php echo $form->textField($model, 'cellulare', array('class' => 'form-control')); ?>        
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'email'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>        
                </div>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'residenza'); ?></label>
                <?php echo $form->textField($model, 'residenza', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'indirizzo'); ?></label>
                <?php echo $form->textField($model, 'indirizzo', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'numero'); ?></label>
                <?php echo $form->textField($model, 'numero', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cap'); ?></label>
                <?php echo $form->textField($model, 'cap', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codicefiscale'); ?></label> 
                <?php echo $form->textField($model, 'codicefiscale', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luogo_nascita'); ?></label>
                <?php echo $form->textField($model, 'luogo_nascita', array('class' => 'form-control')); ?>
            </div>
             <div class="col-xs-12 col-md-2">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_nascita'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_nascita', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_nascita))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'altro_genitore'); ?></label>
                <div class="l-34"><?php echo $form->radioButtonList($model, 'altro_genitore', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
        </div>
    </fieldset>
    <fieldset id="altro_genitore" style="display:<?= $model->altro_genitore == 'Y' ? "block" : "none" ?>"  >
        <legend>Dati altro genitore</legend>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_nome'); ?></label>
                <?php echo $form->textField($model, 'altro_nome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_cognome'); ?></label>
                <?php echo $form->textField($model, 'altro_cognome', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_cellulare'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <?php echo $form->textField($model, 'altro_cellulare', array('class' => 'form-control')); ?>        
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_email'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <?php echo $form->textField($model, 'altro_email', array('class' => 'form-control')); ?>        
                </div>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_residenza'); ?></label>
                <?php echo $form->textField($model, 'altro_residenza', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_indirizzo'); ?></label>
                <?php echo $form->textField($model, 'altro_indirizzo', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_numero'); ?></label>
                <?php echo $form->textField($model, 'altro_numero', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_cap'); ?></label>
                <?php echo $form->textField($model, 'altro_cap', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_codicefiscale'); ?></label> 
                <?php echo $form->textField($model, 'altro_codicefiscale', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'altro_luogo_nascita'); ?></label>
                <?php echo $form->textField($model, 'altro_luogo_nascita', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-4">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'altro_data_nascita'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'altro_data_nascita', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->altro_data_nascita))); ?>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset >
        <legend>Documento</legend>
        <div class="row row-10" >
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'documento'); ?></label><br />
                <div class="l-34"><?php echo $form->radioButtonList($model, 'documento', array('PS' => 'Passaporto', 'PA' => 'Patente', 'CI' => "Carta I."), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
            <div class="col-xs-12 col-md-2">
                <label for="" class="control-label"><?php echo $form->labelEx($model, 'data_rilascio'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_rilascio', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_rilascio))); ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'documento_numero'); ?></label>
                <?php echo $form->textField($model, 'documento_numero', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'documento_rilascio'); ?></label> 
                <?php echo $form->textField($model, 'documento_rilascio', array('class' => 'form-control')); ?>
            </div>
        </div>
    </fieldset>
    <fieldset style="margin-bottom: 20px" >
        <legend>Dati bambino</legend>
        <div class="row row-10">
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'nome_figlio'); ?></label>
                <?php echo $form->textField($model, 'nome_figlio', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'cognome_figlio'); ?></label>
                <?php echo $form->textField($model, 'cognome_figlio', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'tessera_sanitaria_figlio'); ?></label>
                <?php echo $form->textField($model, 'tessera_sanitaria_figlio', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'codice_fiscale_figlio'); ?></label>
                <?php echo $form->textField($model, 'codice_fiscale_figlio', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'casa_vacanza '); ?></label><br />
                <? echo $form->dropDownList($model, "casa_vacanza", $model->selectStrutture, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luogo_nascita_figlio'); ?></label>
                <?php echo $form->textField($model, 'luogo_nascita_figlio', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="control-label "><?php echo $form->labelEx($model, 'data_nascita_figlio'); ?></label>
                <div class="input-group date" >
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $form->textField($model, 'data_nascita_figlio', array('class' => 'form-control hasDatepicker form-size richiamo', 'size' => '10', 'maxlength' => '12', 'value' => Yii::app()->MyUtils->reverseDate($model->data_nascita))); ?>
                </div>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-6">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'scuola'); ?></label>
                <?php echo $form->textField($model, 'scuola', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'classe'); ?></label>
                <?php echo $form->textField($model, 'classe', array('class' => 'form-control')); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'sezione'); ?></label>
                <?php echo $form->textField($model, 'sezione', array('class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'utente_milano'); ?></label><br />
                <div class="l-34"><?php echo $form->radioButtonList($model, 'utente_milano', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="fl-l">
                    <label for="" class="control-label"><?php echo $form->labelEx($model, 'dieta_sanitaria'); ?></label><br />
                    <div class="l-34"><?php echo $form->radioButtonList($model, 'dieta_sanitaria', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
                <div class="fl-l">
                    <div id="dieta_sanitaria_dettaglio" style="display:<?= $model->dieta_sanitaria == 'Y' ? "block" : "none" ?>">
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dieta_sanitaria_dettaglio'); ?></label><br />
                        <?php echo $form->textField($model, 'dieta_sanitaria_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='clear'></div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="fl-l">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dieta_religiosa'); ?></label><br />
                    <div class="l-34"><?php echo $form->radioButtonList($model, 'dieta_religiosa', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
                <div class="fl-l">
                    <div id="dieta_religiosa_dettaglio" style="display:<?= $model->dieta_religiosa == 'Y' ? "block" : "none" ?>">
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dieta_religiosa_dettaglio'); ?></label><br />
                        <?php echo $form->textField($model, 'dieta_religiosa_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='clear'></div>
            </div>
        </div>
        <div class="row row-10">
            <div class="col-xs-12 col-md-4">
                <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'insegnante_sostegno'); ?></label><br /> 
                <div class="l-34"><?php echo $form->radioButtonList($model, 'insegnante_sostegno', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="fl-l">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'disabile'); ?></label><br />
                   <div class="l-34"> <?php echo $form->radioButtonList($model, 'disabile', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </div>
                <div class="fl-l">
                    <div id="disabile_dettaglio" style="display:<?= $model->disabile == 'Y' ? "block" : "none" ?>">
                        <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'disabile_dettaglio'); ?></label><br />
                        <?php echo $form->textField($model, 'disabile_dettaglio', array('class' => 'form-control')); ?>
                    </div>
                </div>
                <div class='clear'></div>
            </div>
            <div class="col-xs-12 col-md-4">
                <di id="educatore" style="display:<?= $model->disabile == 'Y' ? "block" : "none" ?>">
                    <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'educatore_individuale'); ?></label>
                    <div class="l-34"><?php echo $form->radioButtonList($model, 'educatore_individuale', array('Y' => 'Si', 'N' => 'No'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green radio-red', 'separator' => '&nbsp&nbsp;')); ?></div>
                </di>
            </div>  
        </div>
    </fieldset>
</div>
<div class="panel-footer">
    <div class=" pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange', 'id' => 'cm-preiscrizioni-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?> 