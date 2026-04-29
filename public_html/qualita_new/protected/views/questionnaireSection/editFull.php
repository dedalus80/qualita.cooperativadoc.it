<?php
$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    $version->questionnaire->title=>array('questionnaire/view','id'=>$version->questionnaire_id),
    'Versione '.$version->version_number=>array('questionnaireVersion/view','id'=>$version->id),
    'Modifica Sezioni e Domande',
);
?>

<div class="page-header">
    <h1><i class="fa fa-edit"></i> Modifica Sezioni e Domande - Versione <?php echo $version->version_number; ?></h1>
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

<form method="post" id="edit-full-form">
    <div id="sections-container" class="sortable-sections">
        <?php foreach ($sections as $section): ?>
            <div class="panel panel-default section-block" data-id="<?php echo $section->id; ?>">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo CHtml::encode($section->title); ?>
                        <button type="button" class="btn btn-xs btn-default pull-right toggle-section-btn">
                            <i class="fa fa-minus"></i>
                        </button>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Titolo Sezione</label>
                        <input type="text" name="sections[<?php echo $section->id; ?>][title]" class="form-control" value="<?php echo CHtml::encode($section->title); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Ordine</label>
                        <input type="number" name="sections[<?php echo $section->id; ?>][order]" class="form-control section-order" value="<?php echo $section->order; ?>" required>
                    </div>
                    
                    <h4 style="margin-top: 20px; margin-bottom: 15px; color: #337ab7; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                        <i class="fa fa-filter"></i> Mostra con queste condizioni
                    </h4>
                    
                    <div class="form-group">
                        <label>Campo Condizione</label>
                        <select name="sections[<?php echo $section->id; ?>][condition_field]" class="form-control condition-field-select">
                            <option value="">-- nessuno --</option>
                            <option value="tipologia_id" <?php if($section->condition_field=='tipologia_id') echo 'selected'; ?>>Tipologia Soggiorno</option>
                            <!--<option value="centro" <?php if($section->condition_field=='centro') echo 'selected'; ?>>Centro/Soggiorno</option>
                            <option value="ente" <?php if($section->condition_field=='ente') echo 'selected'; ?>>Cliente/Ente</option>
                            <option value="anno" <?php if($section->condition_field=='anno') echo 'selected'; ?>>Anno</option>
                            <option value="eta" <?php if($section->condition_field=='eta') echo 'selected'; ?>>Età</option>
                            <option value="organizzatore" <?php if($section->condition_field=='organizzatore') echo 'selected'; ?>>Organizzatore</option>
                            <option value="soggiorno" <?php if($section->condition_field=='soggiorno') echo 'selected'; ?>>Soggiorno</option>
                            <option value="turno" <?php if($section->condition_field=='turno') echo 'selected'; ?>>Turno</option>-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Operatore Condizione</label>
                        <select name="sections[<?php echo $section->id; ?>][condition_operator]" class="form-control">
                            <option value="">-- nessuno --</option>
                            <option value="=" <?php if($section->condition_operator=='=') echo 'selected'; ?>>=</option>
                            <option value="!=" <?php if($section->condition_operator=='!=') echo 'selected'; ?>>!=</option>
                            <option value="in" <?php if($section->condition_operator=='in') echo 'selected'; ?>>IN</option>
                            <option value="not in" <?php if($section->condition_operator=='not in') echo 'selected'; ?>>NOT IN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Valore Condizione</label>
                        <div class="condition-value-container">
                            <input type="text" name="sections[<?php echo $section->id; ?>][condition_value]" class="form-control condition-value-input" placeholder="es. 3 o 1,2,5" value="<?php echo CHtml::encode($section->condition_value); ?>">
                        </div>
                    </div>

                    <h4 style="margin-top: 20px; margin-bottom: 15px; color: #5cb85c; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                        <i class="fa fa-list"></i> Domande della sezione
                    </h4>
                    
                    <div class="questions-container sortable-questions">
                        <?php foreach ($section->questions as $question): ?>
                            <div class="panel panel-info question-block" data-id="<?php echo $question->id; ?>">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><?php echo CHtml::encode($question->text); ?></h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Testo Domanda</label>
                                        <input type="text" name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][text]" class="form-control" value="<?php echo CHtml::encode($question->text); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][type]" class="form-control question-type-select" data-question-id="<?php echo $question->id; ?>" required>
                                            <option value="">Seleziona Tipo</option>
                                            <option value="text" <?php if($question->type=='text') echo 'selected'; ?>>Risposta Libera</option>
                                            <option value="option" <?php if($question->type=='option') echo 'selected'; ?>>Opzioni</option>
                                            <option value="range" <?php if($question->type=='range') echo 'selected'; ?>>Range 1-5</option>
                                            <option value="custom" <?php if($question->type=='custom') echo 'selected'; ?>>Custom (opzioni personalizzate)</option>
                                        </select>
                                    </div>
                                    <?php if ($question->type == 'custom'): ?>
                                        <div class="form-group multiple-options-group" data-question-id="<?php echo $question->id; ?>">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][is_multiple]" value="1" <?php echo $question->is_multiple ? 'checked' : ''; ?>>
                                                    Permetti risposte multiple
                                                </label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($question->type == 'custom'): ?>
                                        <div class="form-group custom-options-group" data-question-id="<?php echo $question->id; ?>">
                                            <label>Opzioni personalizzate</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control custom-option-input" placeholder="Inserisci valore">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success custom-option-add-btn"><i class="fa fa-plus"></i> Inserisci</button>
                                                </span>
                                            </div>
                                            <div class="custom-options-list" style="margin-top:20px;">
                                                <?php foreach ($question->options as $opt): ?>
                                                    <span class="badge badge-primary custom-option-label" style="margin-right:5px;margin-bottom:5px;">
                                                        <?php echo CHtml::encode($opt->option_text); ?>
                                                        <a href="#" class="text-white ms-1 custom-option-remove" title="Rimuovi"><i class="fa fa-times"></i></a>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                            <textarea name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][custom_options]" class="form-control custom-options-textarea" style="display:none;"><?php echo CHtml::encode(implode("\n", array_map(function($o){return $o->option_text;}, $question->options))); ?></textarea>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label>Ordine</label>
                                        <input type="number" name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][order]" class="form-control question-order" value="<?php echo $question->order; ?>" required>
                                    </div>

                                    <!-- Campi condizionali -->
                                    <div class="form-group">
                                        <label>Domanda Condizionale</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="enable-conditional-checkbox" data-question-id="<?php echo $question->id; ?>" <?php echo $question->isConditional() ? 'checked' : ''; ?>>
                                                Abilita condizioni per mostrare questa domanda
                                            </label>
                                        </div>
                                    </div>


                                    <div class="conditional-fields-group" data-question-id="<?php echo $question->id; ?>" style="display: <?php echo $question->isConditional() ? 'block' : 'none'; ?>;">
                                        <div class="form-group">
                                            <label>Domanda Condizione</label>
                                            <select name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][condition_question_id]" class="form-control">
                                                <option value="">Seleziona la domanda condizione</option>
                                                <?php foreach ($section->questions as $otherQuestion): ?>
                                                    <?php if ($otherQuestion->id != $question->id): ?>
                                                        <option value="<?php echo $otherQuestion->id; ?>" <?php echo ($question->condition_question_id == $otherQuestion->id) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo CHtml::encode($otherQuestion->text); ?>
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Operatore</label>
                                            <select name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][condition_operator]" class="form-control">
                                                <option value="">-- nessuno --</option>
                                                <option value="=" <?php echo ($question->condition_operator == '=') ? 'selected' : ''; ?>>=</option>
                                                <option value="!=" <?php echo ($question->condition_operator == '!=') ? 'selected' : ''; ?>>!=</option>
                                                <option value="in" <?php echo ($question->condition_operator == 'in') ? 'selected' : ''; ?>>IN</option>
                                                <option value="not in" <?php echo ($question->condition_operator == 'not in') ? 'selected' : ''; ?>>NOT IN</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Valore Condizione</label>
                                            <input type="text" name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][condition_value]" class="form-control" value="<?php echo CHtml::encode($question->condition_value); ?>" placeholder="Inserisci il valore o valori separati da virgola">
                                            <small class="text-muted">Per operatori "in" e "not in", separa i valori con virgole (es: "valore1,valore2")</small>
                                        </div>
                                    </div>
                                    <?php if (!$hasResponses): ?>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger delete-question-btn">
                                            <i class="fa fa-trash"></i> Elimina
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Blocco per aggiungere nuove domande -->
                    <div class="new-questions-container"></div>
                    <button type="button" class="btn btn-success add-new-question-btn">
                        <i class="fa fa-plus"></i> Aggiungi Nuova Domanda
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="btn btn-success" id="add-section-btn">
        <i class="fa fa-plus"></i> Aggiungi Nuova Sezione
    </button>

    <hr>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Salva Modifiche
        </button>
    </div>
</form>

<?php
Yii::app()->clientScript->registerScript('editFullScript', <<<JS
$(function(){
    // Aggiungi nuova sezione
    $('#add-section-btn').click(function(){
        let sectionCount = $('.section-block').length + 1;
        let newSectionId = 'new_' + sectionCount;

        let html = `
        <div class="panel panel-default section-block new-section" data-id="`+newSectionId+`">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Nuova Sezione #`+sectionCount+`
                    <button type="button" class="btn btn-xs btn-default pull-right toggle-section-btn">
                        <i class="fa fa-minus"></i>
                    </button>
                </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Titolo Sezione</label>
                    <input type="text" name="new_sections[`+newSectionId+`][title]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Ordine</label>
                    <input type="number" name="new_sections[`+newSectionId+`][order]" class="form-control section-order" value="`+sectionCount+`" required>
                </div>
                
                <h4 style="margin-top: 20px; margin-bottom: 15px; color: #337ab7; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <i class="fa fa-filter"></i> Mostra con queste condizioni
                </h4>
                
                <div class="form-group">
                    <label>Campo Condizione</label>
                    <select name="new_sections[`+newSectionId+`][condition_field]" class="form-control condition-field-select">
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
                    <select name="new_sections[`+newSectionId+`][condition_operator]" class="form-control">
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
                        <input type="text" name="new_sections[`+newSectionId+`][condition_value]" class="form-control condition-value-input" placeholder="es. 3 o 1,2,5">
                    </div>
                </div>

                <h4 style="margin-top: 20px; margin-bottom: 15px; color: #5cb85c; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <i class="fa fa-list"></i> Domande della sezione
                </h4>
                
                <div class="questions-container sortable-questions"></div>

                <div class="new-questions-container"></div>
                <button type="button" class="btn btn-info add-new-question-btn">
                    <i class="fa fa-plus"></i> Aggiungi Domanda
                </button>
            </div>
        </div>`;
        $('#sections-container').append(html);
    });

    // Aggiungi nuova domanda (event delegation per sezioni esistenti e nuove)
    $(document).on('click', '.add-new-question-btn', function(){
        let sectionBlock = $(this).closest('.section-block');
        let sectionId = sectionBlock.data('id');
        let container = sectionBlock.find('.new-questions-container');
        
        // Calcola il numero totale di domande (esistenti + nuove)
        let existingQuestions = sectionBlock.find('.questions-container .question-block').length;
        let newQuestions = container.children().length;
        let questionCount = existingQuestions + newQuestions + 1;

        // Differenziazione name input tra nuove sezioni e sezioni esistenti
        let inputPrefix = sectionId.toString().startsWith('new_') ? 
            `new_sections[`+sectionId+`][questions][`+questionCount+`]` : 
            `new_questions[`+sectionId+`][`+questionCount+`]`;

        let html = `
        <div class="panel panel-success question-block">
            <div class="panel-heading">
                <h4 class="panel-title">Nuova Domanda #`+questionCount+`</h4>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Testo Domanda</label>
                    <input type="text" name="`+inputPrefix+`[text]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select name="`+inputPrefix+`[type]" class="form-control question-type-select" required>
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
                            <input type="checkbox" name="`+inputPrefix+`[is_multiple]" value="1">
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
                    <textarea name="`+inputPrefix+`[custom_options]" class="form-control custom-options-textarea" style="display:none;"></textarea>
                </div>
                <div class="form-group">
                    <label>Ordine</label>
                    <input type="number" name="`+inputPrefix+`[order]" class="form-control" value="`+questionCount+`" required>
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
                        <select name="`+inputPrefix+`[condition_question_id]" class="form-control">
                            <option value="">Seleziona la domanda condizione</option>
                            <!-- Le opzioni verranno popolate dinamicamente -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Operatore</label>
                        <select name="`+inputPrefix+`[condition_operator]" class="form-control">
                            <option value="">Seleziona operatore</option>
                            <option value="=">Uguale a</option>
                            <option value="!=">Diverso da</option>
                            <option value="in">Contenuto in</option>
                            <option value="not in">Non contenuto in</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Valore Condizione</label>
                        <input type="text" name="`+inputPrefix+`[condition_value]" class="form-control" placeholder="Inserisci il valore o valori separati da virgola">
                        <small class="text-muted">Per operatori "in" e "not in", separa i valori con virgole (es: "valore1,valore2")</small>
                    </div>
                </div>
            </div>
        </div>`;
        container.append(html);
        
        // Aggiorna i numeri delle domande dopo l'aggiunta
        updateQuestionNumbers(sectionBlock);
    });
    
    // Funzione per aggiornare i numeri delle domande
    function updateQuestionNumbers(sectionBlock) {
        let questionBlocks = sectionBlock.find('.question-block');
        questionBlocks.each(function(index) {
            let title = $(this).find('.panel-title');
            let orderInput = $(this).find('input[name*="[order]"]');
            
            // Aggiorna il titolo
            if (title.text().includes('Domanda #')) {
                title.text('Domanda #' + (index + 1));
            }
            
            // Aggiorna l'ordine se non è stato modificato manualmente
            if (orderInput.val() == orderInput.attr('data-original-order') || !orderInput.attr('data-original-order')) {
                orderInput.val(index + 1);
                orderInput.attr('data-original-order', index + 1);
            }
        });
    }

    // Delete domanda con conferma
    $(document).on('click', '.delete-question-btn', function(){
        if(confirm('Sei sicuro di voler eliminare questa domanda? Una volta cliccato su `Salva Modifiche`, la domanda sarà eliminata definitivamente.')) {
            let questionBlock = $(this).closest('.question-block');
            let sectionBlock = questionBlock.closest('.section-block');
            let questionId = questionBlock.data('id');
            $('#edit-full-form').append('<input type="hidden" name="delete_questions[]" value="'+questionId+'">');
            questionBlock.remove();
            
            // Aggiorna i numeri delle domande dopo l'eliminazione
            updateQuestionNumbers(sectionBlock);
        }
    });

    // Toggle sezione
    $(document).on('click', '.toggle-section-btn', function(){
        let btn = $(this);
        let panelBody = btn.closest('.section-block').find('.panel-body');
        panelBody.slideToggle();
        btn.find('i').toggleClass('fa-minus fa-plus');
    });

    // Sortable
    $('#sections-container').sortable({
        handle: '.panel-heading',
        update: function(){
            $('.section-block').each(function(index){
                $(this).find('.section-order').val(index+1);
            });
        }
    });
    $('.questions-container').sortable({
        handle: '.panel-heading',
        update: function(){
            $('.question-block').each(function(index){
                $(this).find('.question-order').val(index+1);
            });
        }
    });

    // Espandi sezioni nascoste al submit per evitare errori di focus
    $('#edit-full-form').submit(function(){
        $('.panel-body:hidden').slideDown();
    });

    // All'apertura, chiudi tutte le sezioni
    $('.panel-body').hide();
    $('.toggle-section-btn i').removeClass('fa-minus').addClass('fa-plus');

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

    // Inizializza le select per le sezioni esistenti che hanno già un valore
    $('.condition-field-select').each(function(){
        if ($(this).val()) {
            $(this).trigger('change');
        }
    });

    // Mostra/nascondi campo custom options e multiple options in base al tipo
    $(document).on('change', '.question-type-select', function(){
        console.log('change');
        var qid = $(this).data('question-id');
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var customGroup = questionBlock.find('.custom-options-group');
        var multipleGroup = questionBlock.find('.multiple-options-group');

        console.log(customGroup);

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
            var label = $('<span class="badge badge-primary custom-option-label" style="margin-right:5px;margin-bottom:5px;">'+$('<div>').text(val).html()+' <a href="#" class="text-white ms-1 custom-option-remove" title="Rimuovi"><i class="fa fa-times"></i></a></span>');
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
        var qid = $(this).data('question-id');
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var customGroup = questionBlock.find('.multiple-options-group');
        
        if(val === 'custom') {
            customGroup.show();
        } else {
            customGroup.hide();
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
        var currentQuestionId = questionBlock.data('id');
        
        // Salva il valore attualmente selezionato
        var selectedValue = conditionSelect.val();
        
        // Pulisci le opzioni esistenti
        conditionSelect.find('option:not(:first)').remove();
        
        // Aggiungi le domande della stessa sezione (escludendo la corrente)
        sectionBlock.find('.question-block').each(function(){
            var otherQuestionId = $(this).data('id');
            if (otherQuestionId && otherQuestionId != currentQuestionId) {
                var questionText = $(this).find('input[name*="[text]"]').val() || 
                                 $(this).find('label:contains("Testo Domanda")').next().find('input').val() ||
                                 'Domanda #' + otherQuestionId;
                var option = $('<option value="' + otherQuestionId + '">' + questionText + '</option>');
                
                // Se questo era il valore selezionato, ripristinalo
                if (otherQuestionId == selectedValue) {
                    option.prop('selected', true);
                }
                
                conditionSelect.append(option);
            }
        });
    }

    // Inizializza i campi condizionali esistenti
    $('.enable-conditional-checkbox:checked').each(function(){
        var questionBlock = $(this).closest('.question-block');
        populateConditionQuestionOptions(questionBlock);
    });
    
    // Inizializza i numeri delle domande al caricamento della pagina
    $('.section-block').each(function(){
        updateQuestionNumbers($(this));
    });
});
JS
, CClientScript::POS_END);


?>
