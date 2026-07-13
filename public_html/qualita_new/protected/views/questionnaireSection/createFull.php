<?php
/* @var $this QuestionnaireSectionController */
/* @var $version_id integer */
/* @var $version QuestionnaireVersion */
/* @var $catalog array */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Versioni'=>array('questionnaireVersion/index'),
    'Creazione Rapida Questionario',
);

$version = isset($version) ? $version : QuestionnaireVersion::model()->with('questionnaire')->findByPk($version_id);
$catalog = isset($catalog) ? $catalog : VisibilityRulesHelper::buildCatalogForVersion($version);
$ruleValueUrl = Yii::app()->createUrl('questionnaireSection/getRuleValueOptions', array('version_id' => $version_id));
$emptyRulesetJson = CJSON::encode(VisibilityRulesHelper::emptyRuleset());

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

<?php $this->renderPartial('_visibilityRulesDialog'); ?>

<?php
Yii::app()->clientScript->registerScript('createFullScript', <<<JS
$(function(){
    let sectionCount = 0;
    var emptyRulesetJson = {$emptyRulesetJson};

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
                    <i class="fa fa-filter"></i> Visibilità sezione
                </h4>
                <div class="visibility-rules-widget"
                     data-entity-key="section-create-`+sectionCount+`"
                     data-target-type="section">
                    <div class="checkbox" style="margin-bottom: 5px;">
                        <label>
                            <input type="checkbox" class="visibility-rules-enable-checkbox">
                            Abilita condizioni per mostrare questa sezione
                        </label>
                    </div>
                    <div class="visibility-rules-summary text-secondary small" style="display:none;">
                        <i class="fa fa-filter"></i>
                        <span class="visibility-rules-summary-text"></span>
                    </div>
                    <input type="hidden"
                           name="sections[`+sectionCount+`][visibility_ruleset]"
                           class="visibility-rules-json-input"
                           value='`+JSON.stringify(emptyRulesetJson)+`'>
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
        <div class="panel panel-info question-block" data-id="new-`+sectionIndex+`-`+questionCount+`">
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
                        <option value="yes_no">Sì / No</option>
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
                <div class="form-group type-render-group" style="display:none;">
                    <label>Tipo visualizzazione risposte</label>
                    <select name="sections[`+sectionIndex+`][questions][`+questionCount+`][type_render]" class="form-control question-render-select">
                        <option value="radio">Radio (scelta singola)</option>
                        <option value="checkbox">Checkbox (scelta multipla)</option>
                        <option value="select">Select</option>
                    </select>
                    <small class="text-secondary">Con Select puoi combinare scelta singola o multipla tramite la checkbox sopra.</small>
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

                <div class="visibility-rules-widget"
                     data-entity-key="question-create-`+sectionIndex+`-`+questionCount+`"
                     data-target-type="question">
                    <div class="checkbox" style="margin-bottom: 5px;">
                        <label>
                            <input type="checkbox" class="visibility-rules-enable-checkbox">
                            Abilita condizioni per mostrare questa domanda
                        </label>
                    </div>
                    <div class="visibility-rules-summary text-secondary small" style="display:none;">
                        <i class="fa fa-filter"></i>
                        <span class="visibility-rules-summary-text"></span>
                    </div>
                    <input type="hidden"
                           name="sections[`+sectionIndex+`][questions][`+questionCount+`][visibility_ruleset]"
                           class="visibility-rules-json-input"
                           value='`+JSON.stringify(emptyRulesetJson)+`'>
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
    // Mostra/nascondi campo custom options, multiple options e type_render in base al tipo
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
    // Inizializza visibilità gruppi custom, multiple e render
    $('.question-type-select').each(function(){
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

});
JS
, CClientScript::POS_END);
?>
