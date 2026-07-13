<?php
$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    $version->questionnaire->title=>array('questionnaire/view','id'=>$version->questionnaire_id),
    'Versione '.$version->version_number=>array('questionnaireVersion/view','id'=>$version->id),
    'Modifica Sezioni e Domande',
);

$catalog = isset($catalog) ? $catalog : VisibilityRulesHelper::buildCatalogForVersion($version);
$ruleValueUrl = Yii::app()->createUrl('questionnaireSection/getRuleValueOptions', array('version_id' => $version->id));

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/js/visibility-rules-builder.js',
    CClientScript::POS_END
);
Yii::app()->clientScript->registerScript(
    'visibilityRulesInit',
    'VisibilityRulesBuilder.init(' . CJSON::encode(array(
        'catalog' => $catalog,
        'ruleValueUrl' => $ruleValueUrl,
    )) . ');',
    CClientScript::POS_READY
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
                        <i class="fa fa-filter"></i> Visibilità sezione
                    </h4>

                    <?php $this->renderPartial('_visibilityRulesWidget', array(
                        'inputName' => 'sections[' . $section->id . '][visibility_ruleset]',
                        'targetType' => 'section',
                        'entityKey' => 'section-' . $section->id,
                        'rulesetData' => $section->getVisibilityRulesetData(),
                        'excludeQuestionId' => null,
                        'catalog' => $catalog,
                        'checkboxLabel' => 'Abilita condizioni per mostrare questa sezione',
                    )); ?>

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
                                            <option value="yes_no" <?php if($question->type=='yes_no') echo 'selected'; ?>>Sì / No</option>
                                        </select>
                                    </div>
                                    <?php if ($question->type == 'custom'): ?>
                                        <?php
                                        $typeRender = $question->type_render;
                                        if (empty($typeRender)) {
                                            $typeRender = $question->is_multiple ? 'checkbox' : 'radio';
                                        }
                                        ?>
                                        <div class="form-group multiple-options-group" data-question-id="<?php echo $question->id; ?>">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][is_multiple]" value="1" <?php echo $question->is_multiple ? 'checked' : ''; ?>>
                                                    Permetti risposte multiple
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group type-render-group" data-question-id="<?php echo $question->id; ?>">
                                            <label>Tipo visualizzazione risposte</label>
                                            <select name="sections[<?php echo $section->id; ?>][questions][<?php echo $question->id; ?>][type_render]" class="form-control question-render-select">
                                                <option value="radio" <?php if ($typeRender == 'radio') echo 'selected'; ?>>Radio (scelta singola)</option>
                                                <option value="checkbox" <?php if ($typeRender == 'checkbox') echo 'selected'; ?>>Checkbox (scelta multipla)</option>
                                                <option value="select" <?php if ($typeRender == 'select') echo 'selected'; ?>>Select</option>
                                            </select>
                                            <small class="text-muted">Con Select puoi combinare scelta singola o multipla tramite la checkbox sopra.</small>
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

                                    <!-- Condizioni di visibilità -->
                                    <?php $this->renderPartial('_visibilityRulesWidget', array(
                                        'inputName' => 'sections[' . $section->id . '][questions][' . $question->id . '][visibility_ruleset]',
                                        'targetType' => 'question',
                                        'entityKey' => 'question-' . $question->id,
                                        'rulesetData' => $question->getVisibilityRulesetData(),
                                        'excludeQuestionId' => $question->id,
                                        'catalog' => $catalog,
                                        'checkboxLabel' => 'Abilita condizioni per mostrare questa domanda',
                                    )); ?>
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

<?php $this->renderPartial('_visibilityRulesDialog'); ?>

<?php
$emptyRulesetJson = CJSON::encode(VisibilityRulesHelper::emptyRuleset());
Yii::app()->clientScript->registerScript('editFullScript', <<<JS
$(function(){
    var emptyRulesetJson = {$emptyRulesetJson};

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
                    <i class="fa fa-filter"></i> Visibilità sezione
                </h4>
                <div class="visibility-rules-widget"
                     data-entity-key="section-`+newSectionId+`"
                     data-target-type="section">
                    <div class="checkbox" style="margin-bottom: 5px;">
                        <label>
                            <input type="checkbox" class="visibility-rules-enable-checkbox">
                            Abilita condizioni per mostrare questa sezione
                        </label>
                    </div>
                    <div class="visibility-rules-summary text-muted small" style="display:none;">
                        <i class="fa fa-filter"></i>
                        <span class="visibility-rules-summary-text"></span>
                    </div>
                    <input type="hidden"
                           name="new_sections[`+newSectionId+`][visibility_ruleset]"
                           class="visibility-rules-json-input"
                           value='`+JSON.stringify(emptyRulesetJson)+`'>
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
        <div class="panel panel-success question-block" data-id="new-`+sectionId+`-`+questionCount+`">
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
                        <option value="yes_no">Sì / No</option>
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
                <div class="form-group type-render-group" style="display:none;">
                    <label>Tipo visualizzazione risposte</label>
                    <select name="`+inputPrefix+`[type_render]" class="form-control question-render-select">
                        <option value="radio">Radio (scelta singola)</option>
                        <option value="checkbox">Checkbox (scelta multipla)</option>
                        <option value="select">Select</option>
                    </select>
                    <small class="text-muted">Con Select puoi combinare scelta singola o multipla tramite la checkbox sopra.</small>
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
                    <input type="number" name="`+inputPrefix+`[order]" class="form-control question-order" value="`+questionCount+`" required>
                </div>

                <!-- Condizioni di visibilità -->
                <div class="visibility-rules-widget"
                     data-entity-key="question-new-`+sectionId+`-`+questionCount+`"
                     data-target-type="question">
                    <div class="checkbox" style="margin-bottom: 5px;">
                        <label>
                            <input type="checkbox" class="visibility-rules-enable-checkbox">
                            Abilita condizioni per mostrare questa domanda
                        </label>
                    </div>
                    <div class="visibility-rules-summary text-muted small" style="display:none;">
                        <i class="fa fa-filter"></i>
                        <span class="visibility-rules-summary-text"></span>
                    </div>
                    <input type="hidden"
                           name="`+inputPrefix+`[visibility_ruleset]"
                           class="visibility-rules-json-input"
                           value='`+JSON.stringify(emptyRulesetJson)+`'>
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

    // Mostra/nascondi campo custom options e multiple options in base al tipo
    $(document).on('change', '.question-type-select', function(){
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var customGroup = questionBlock.find('.custom-options-group');
        var multipleGroup = questionBlock.find('.multiple-options-group');
        var renderGroup = questionBlock.find('.type-render-group');

        if(val === 'custom') {
            customGroup.show();
            multipleGroup.show();
            renderGroup.show();
        } else {
            customGroup.hide();
            multipleGroup.hide();
            renderGroup.hide();
        }
    });

    // Sincronizza type_render e is_multiple per domande custom
    $(document).on('change', '.question-render-select', function(){
        var questionBlock = $(this).closest('.question-block');
        var renderType = $(this).val();
        var multipleCheckbox = questionBlock.find('input[name*="[is_multiple]"]');

        if (renderType === 'radio') {
            multipleCheckbox.prop('checked', false);
        } else if (renderType === 'checkbox') {
            multipleCheckbox.prop('checked', true);
        }
    });

    $(document).on('change', 'input[name*="[is_multiple]"]', function(){
        var questionBlock = $(this).closest('.question-block');
        var renderSelect = questionBlock.find('.question-render-select');

        if (!renderSelect.length || renderSelect.val() === 'select') {
            return;
        }

        if ($(this).is(':checked')) {
            renderSelect.val('checkbox');
        } else {
            renderSelect.val('radio');
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
    // Inizializza visibilità gruppi custom, multiple e render
    $('.question-type-select').each(function(){
        var val = $(this).val();
        var questionBlock = $(this).closest('.question-block');
        var multipleGroup = questionBlock.find('.multiple-options-group');
        var renderGroup = questionBlock.find('.type-render-group');
        var customGroup = questionBlock.find('.custom-options-group');

        if(val === 'custom') {
            multipleGroup.show();
            renderGroup.show();
            customGroup.show();
        } else {
            multipleGroup.hide();
            renderGroup.hide();
            customGroup.hide();
        }
    });

    // Inizializza i numeri delle domande al caricamento della pagina
    $('.section-block').each(function(){
        updateQuestionNumbers($(this));
    });
});
JS
, CClientScript::POS_END);


?>
