<?php
/* @var $this QuestionnaireSectionController */
/* @var $version_id integer */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Versioni'=>array('questionnaireVersion/index'),
    'Creazione Rapida Questionario',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Sezioni e Domande</h1>
</div>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error'); ?></div>
<?php endif; ?>

<div class="text-right" style="margin-bottom: 15px;">
    <button type="button" class="btn btn-default" id="toggle-all-sections">
        <i class="fa fa-plus-square"></i> Espandi/Comprimi Tutte le Sezioni
    </button>
</div>

<form method="post" id="full-questionnaire-form">
    <div id="sections-container" class="sortable-sections"></div>

    <button type="button" class="btn btn-success" id="add-section-btn"><i class="fa fa-plus"></i> Aggiungi Sezione</button>
    <hr>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Salva Questionario
        </button>
    </div>
</form>

<?php
Yii::app()->clientScript->registerScript('createFullScript', <<<JS
$(function(){
    let sectionCount = 0;

    function updateSectionOrder() {
        $('.section-block').each(function(index){
            $(this).find('input.section-order').val(index+1);
        });
    }

    function updateQuestionOrder(sectionBlock) {
        sectionBlock.find('.question-block').each(function(index){
            $(this).find('input.question-order').val(index+1);
        });
    }

    $('#add-section-btn').click(function(){
        sectionCount++;
        let sectionHtml = `
        <div class="panel panel-default section-block">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Sezione #`+sectionCount+`
                    <button type="button" class="btn btn-xs btn-default pull-right toggle-section-btn">
                        <i class="fa fa-minus"></i>
                    </button>
                </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Titolo Sezione</label>
                    <input type="text" name="sections[`+sectionCount+`][title]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Ordine</label>
                    <input type="number" name="sections[`+sectionCount+`][order]" class="form-control section-order" value="`+sectionCount+`" required>
                </div>
                
                <h4 style="margin-top: 20px; margin-bottom: 15px; color: #337ab7; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <i class="fa fa-filter"></i> Mostra con queste condizioni
                </h4>
                
                <div class="form-group">
                    <label>Campo Condizione</label>
                    <select name="sections[`+sectionCount+`][condition_field]" class="form-control condition-field-select">
                        <option value="">-- nessuno --</option>
                        <option value="tipologia_id">Tipologia Soggiorno</option>
                        <!--<option value="centro">Centro/Soggiorno</option>
                        <option value="ente">Cliente/Ente</option>
                        <option value="anno">Anno</option>
                        <option value="eta">Età</option>
                        <option value="organizzatore">Organizzatore</option>
                        <option value="soggiorno">Soggiorno</option>
                        <option value="turno">Turno</option>-->
                    </select>
                </div>
                <div class="form-group">
                    <label>Operatore Condizione</label>
                    <select name="sections[`+sectionCount+`][condition_operator]" class="form-control">
                        <option value="">-- nessuno --</option>
                        <option value="=">=</option>
                        <option value="!=">!=</option>
                        <option value="in">IN</option>
                        <option value="not in">NOT IN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Valore Condizione</label>
                    <div class="condition-value-container">
                        <input type="text" name="sections[`+sectionCount+`][condition_value]" class="form-control condition-value-input" placeholder="es. 3 o 1,2,5">
                    </div>
                </div>

                <h4 style="margin-top: 20px; margin-bottom: 15px; color: #5cb85c; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <i class="fa fa-list"></i> Domande della sezione
                </h4>
                
                <div class="questions-container sortable-questions"></div>
                <button type="button" class="btn btn-info add-question-btn">Aggiungi Domanda</button>
            </div>
        </div>
        `;
        $('#sections-container').append(sectionHtml);
        updateSectionOrder();
    });

    $(document).on('click', '.add-question-btn', function(){
        let sectionBlock = $(this).closest('.section-block');
        let questionsContainer = sectionBlock.find('.questions-container');
        let sectionIndex = sectionBlock.index() + 1;
        let questionCount = questionsContainer.children().length + 1;

        let questionHtml = `
        <div class="panel panel-info question-block">
            <div class="panel-heading">
                <h4 class="panel-title">Domanda #`+questionCount+`</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Testo Domanda</label>
                    <input type="text" name="sections[`+sectionIndex+`][questions][`+questionCount+`][text]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="sections[`+sectionIndex+`][questions][`+questionCount+`][type]" class="form-control question-type-select" required>
                        <option value="">Seleziona Tipo</option>
                        <option value="text">Risposta Libera</option>
                        <option value="option">Opzioni</option>
                        <option value="range">Range 1-5</option>
                        <option value="custom">Custom (opzioni personalizzate)</option>
                    </select>
                </div>
                <div class="form-group multiple-options-group" style="display:none;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="sections[`+sectionIndex+`][questions][`+questionCount+`][is_multiple]" value="1">
                            Permetti risposte multiple
                        </label>
                    </div>
                </div>
                <div class="form-group custom-options-group" style="display:none;">
                    <label>Opzioni personalizzate</label>
                    <div class="input-group">
                        <input type="text" class="form-control custom-option-input" placeholder="Inserisci valore">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success custom-option-add-btn"><i class="fa fa-plus"></i> Inserisci</button>
                        </span>
                    </div>
                    <div class="custom-options-list" style="margin-top:20px;"></div>
                    <textarea name="sections[`+sectionIndex+`][questions][`+questionCount+`][custom_options]" class="form-control custom-options-textarea" style="display:none;"></textarea>
                </div>
                <div class="form-group">
                    <label>Ordine</label>
                    <input type="number" name="sections[`+sectionIndex+`][questions][`+questionCount+`][order]" class="form-control question-order" value="`+questionCount+`" required>
                </div>

                <!-- Campi condizionali per nuove domande -->
                <div class="form-group">
                    <label>Domanda Condizionale</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="enable-conditional-checkbox">
                            Abilita condizioni per mostrare questa domanda
                        </label>
                    </div>
                </div>

                <div class="conditional-fields-group" style="display:none;">
                    <div class="form-group">
                        <label>Domanda Condizione</label>
                        <select name="sections[`+sectionIndex+`][questions][`+questionCount+`][condition_question_id]" class="form-control">
                            <option value="">Seleziona la domanda condizione</option>
                            <!-- Le opzioni verranno popolate dinamicamente -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Operatore</label>
                        <select name="sections[`+sectionIndex+`][questions][`+questionCount+`][condition_operator]" class="form-control">
                            <option value="">Seleziona operatore</option>
                            <option value="=">Uguale a</option>
                            <option value="!=">Diverso da</option>
                            <option value="in">Contenuto in</option>
                            <option value="not in">Non contenuto in</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Valore Condizione</label>
                        <input type="text" name="sections[`+sectionIndex+`][questions][`+questionCount+`][condition_value]" class="form-control" placeholder="Inserisci il valore o valori separati da virgola">
                        <small class="text-muted">Per operatori "in" e "not in", separa i valori con virgole (es: "valore1,valore2")</small>
                    </div>
                </div>
            </div>
        </div>`;

        questionsContainer.append(questionHtml);
        updateQuestionOrder(sectionBlock);
    });

    $(document).on('click', '.toggle-section-btn', function(){
        let btn = $(this);
        let panelBody = btn.closest('.section-block').find('.panel-body');
        panelBody.slideToggle();

        let icon = btn.find('i');
        icon.toggleClass('fa-minus fa-plus');
    });

    // Toggle globale tutte le sezioni
    $('#toggle-all-sections').click(function(){
        let anyClosed = $('.panel-body:hidden').length > 0;

        $('.panel-body').each(function(){
            if(anyClosed){
                $(this).slideDown();
            } else {
                $(this).slideUp();
            }
        });

        // Aggiorna tutte le icone +/-
        $('.toggle-section-btn i').each(function(){
            if(anyClosed){
                $(this).removeClass('fa-plus').addClass('fa-minus');
            } else {
                $(this).removeClass('fa-minus').addClass('fa-plus');
            }
        });
    });

    // Gestione select dinamiche per condition_field
    $(document).on('change', '.condition-field-select', function(){
        let field = $(this).val();
        let container = $(this).closest('.section-block').find('.condition-value-container');
        let currentValue = container.find('.condition-value-input').val();
        
        if (field) {
            $.ajax({
                url: '{$this->createUrl('questionnaireSection/getConditionValues')}',
                type: 'GET',
                data: { field: field },
                dataType: 'json',
                success: function(response) {
                    if (response.type === 'select') {
                        let selectHtml = '<select name="' + container.find('.condition-value-input').attr('name') + '" class="form-control condition-value-select">';
                        selectHtml += '<option value="">-- seleziona --</option>';
                        $.each(response.values, function(value, label) {
                            let selected = (value == currentValue) ? 'selected' : '';
                            selectHtml += '<option value="' + value + '" ' + selected + '>' + label + '</option>';
                        });
                        selectHtml += '</select>';
                        container.html(selectHtml);
                    } else {
                        let inputHtml = '<input type="text" name="' + container.find('.condition-value-input').attr('name') + '" class="form-control condition-value-input" placeholder="' + response.placeholder + '" value="' + currentValue + '">';
                        container.html(inputHtml);
                    }
                },
                error: function() {
                    console.log('Errore nel caricamento dei valori per il campo: ' + field);
                }
            });
        } else {
            // Reset a input text vuoto
            let inputHtml = '<input type="text" name="' + container.find('.condition-value-input').attr('name') + '" class="form-control condition-value-input" placeholder="es. 3 o 1,2,5" value="">';
            container.html(inputHtml);
        }
    });

    $('#sections-container').sortable({
        handle: '.panel-heading',
        update: function(){
            updateSectionOrder();
        }
    });

    $(document).on('mouseenter', '.questions-container', function(){
        $(this).sortable({
            handle: '.panel-heading',
            update: function(){
                updateQuestionOrder($(this).closest('.section-block'));
            }
        });
    });

    // Espandi sezioni nascoste al submit per evitare errori di focus
    $('#full-questionnaire-form').submit(function(){
        $('.panel-body:hidden').slideDown();
    });
});

// Copia/incolla qui anche il JS per mostrare/nascondere custom-options-group, aggiungere/rimuovere opzioni custom come in editFull.php
$(function(){
    // Mostra/nascondi campo custom options e multiple options in base al tipo
    $(document).on('change', '.question-type-select', function(){
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var customGroup = questionBlock.find('.custom-options-group');
        var multipleGroup = questionBlock.find('.multiple-options-group');
        
        if(val === 'custom') {
            customGroup.show();
            multipleGroup.show();
        } else {
            customGroup.hide();
            multipleGroup.hide();
        }
    });
    // Aggiungi opzione custom
    $(document).on('click', '.custom-option-add-btn', function(){
        var group = $(this).closest('.custom-options-group');
        var input = group.find('.custom-option-input');
        var val = input.val().trim();
        if(val) {
            var label = $('<span class="badge badge-primary custom-option-label" style="margin-right:5px;">'+$('<div>').text(val).html()+' <a href="#" class="text-white ms-1 custom-option-remove" title="Rimuovi"><i class="fa fa-times"></i></a></span>');
            group.find('.custom-options-list').append(label);
            // aggiorna textarea
            var ta = group.find('.custom-options-textarea');
            var opts = [];
            group.find('.custom-option-label').each(function(){
                var text = $(this).clone().children().remove().end().text().trim();
                if (opts.indexOf(text) === -1) opts.push(text);
            });
            ta.val(opts.join(`\n`));
            input.val('');
        }
    });
    // Rimuovi opzione custom
    $(document).on('click', '.custom-option-remove', function(e){
        e.preventDefault();
        var group = $(this).closest('.custom-options-group');
        $(this).closest('.custom-option-label').remove();
        // aggiorna textarea
        var ta = group.find('.custom-options-textarea');
        var opts = [];
        group.find('.custom-option-label').each(function(){
            opts.push($(this).clone().children().remove().end().text().trim());
        });
        ta.val(opts.join(`\n`));
    });
    // Inizializza visibilità gruppi custom e multiple
    $('.question-type-select').each(function(){
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var customGroup = questionBlock.find('.custom-options-group');
        var multipleGroup = questionBlock.find('.multiple-options-group');
        
        if(val === 'custom') {
            customGroup.show();
            multipleGroup.show();
        } else {
            customGroup.hide();
            multipleGroup.hide();
        }
    });

    // Gestione campi condizionali
    $(document).on('change', '.enable-conditional-checkbox', function(){
        var questionBlock = $(this).closest('.question-block');
        var conditionalFields = questionBlock.find('.conditional-fields-group');
        
        if ($(this).is(':checked')) {
            conditionalFields.show();
            // Popola le opzioni della domanda condizione
            populateConditionQuestionOptions(questionBlock);
        } else {
            conditionalFields.hide();
            // Pulisci i campi quando si disabilita
            conditionalFields.find('select, input').val('');
        }
    });

    // Funzione per popolare le opzioni della domanda condizione
    function populateConditionQuestionOptions(questionBlock) {
        var sectionBlock = questionBlock.closest('.section-block');
        var conditionSelect = questionBlock.find('select[name*="[condition_question_id]"]');
        
        // Salva il valore attualmente selezionato
        var selectedValue = conditionSelect.val();
        
        // Pulisci le opzioni esistenti
        conditionSelect.find('option:not(:first)').remove();
        
        // Aggiungi le domande della stessa sezione (escludendo la corrente)
        sectionBlock.find('.question-block').each(function(){
            var questionText = $(this).find('input[name*="[text]"]').val();
            if (questionText && $(this)[0] !== questionBlock[0]) {
                var option = $('<option value="' + questionText + '">' + questionText + '</option>');
                
                // Se questo era il valore selezionato, ripristinalo
                if (questionText == selectedValue) {
                    option.prop('selected', true);
                }
                
                conditionSelect.append(option);
            }
        });
    }
});
JS
, CClientScript::POS_END);
?>
