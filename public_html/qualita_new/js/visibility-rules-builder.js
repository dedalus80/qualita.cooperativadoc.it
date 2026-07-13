(function(window, $) {
    'use strict';

    var VisibilityRulesBuilder = {
        catalog: null,
        ruleValueUrl: null,
        activeWidget: null,
        draftRuleset: null,

        init: function(config) {
            this.catalog = config.catalog || {questions: {}, participant_fields: {}, tipologie: {}};
            this.ruleValueUrl = config.ruleValueUrl;
            this.bindEvents();
        },

        bindEvents: function() {
            var self = this;

            $(document).on('change', '.visibility-rules-enable-checkbox', function(e) {
                var widget = $(this).closest('.visibility-rules-widget');
                if ($(this).is(':checked')) {
                    e.preventDefault();
                    $(this).prop('checked', false);
                    self.openForWidget(widget, true);
                } else {
                    self.clearWidget(widget);
                }
            });

            $(document).on('click', '.visibility-rules-edit-btn', function() {
                self.openForWidget($(this).closest('.visibility-rules-widget'), false);
            });

            $('.visibility-rules-add-btn').on('click', function() {
                self.addRuleRow();
            });

            $('.visibility-rules-confirm-btn').on('click', function() {
                self.confirmModal();
            });

            $('#visibility-rules-modal').on('hidden.bs.modal', function() {
                if (self.activeWidget && !self.modalConfirmed) {
                    if (self.modalIsNew) {
                        self.clearWidget(self.activeWidget);
                    } else {
                        self.applyRulesetToWidget(self.activeWidget, self.modalPreviousRuleset);
                    }
                }
                self.activeWidget = null;
                self.draftRuleset = null;
                self.modalConfirmed = false;
                $('.visibility-rules-modal-error').hide().text('');
            });

            $(document).on('change', '.visibility-rule-source-type', function() {
                self.onSourceTypeChange($(this).closest('.visibility-rule-row'));
            });

            $(document).on('change', '.visibility-rule-source-key', function() {
                self.loadValueField($(this).closest('.visibility-rule-row'));
            });

            $(document).on('change', '.visibility-rule-operator', function() {
                self.loadValueField($(this).closest('.visibility-rule-row'));
            });

            $(document).on('click', '.visibility-rule-remove-btn', function() {
                $(this).closest('.visibility-rule-row').remove();
                if ($('.visibility-rule-row').length === 0) {
                    self.addRuleRow();
                }
            });
        },

        parseRuleset: function(widget) {
            var raw = widget.find('.visibility-rules-json-input').val();
            if (!raw) {
                return {enabled: false, combine_operator: 'or', rules: []};
            }
            try {
                return JSON.parse(raw);
            } catch (e) {
                return {enabled: false, combine_operator: 'or', rules: []};
            }
        },

        openForWidget: function(widget, isNew) {
            this.activeWidget = widget;
            this.modalIsNew = !!isNew;
            this.modalPreviousRuleset = this.parseRuleset(widget);
            var current = $.extend(true, {}, this.modalPreviousRuleset);
            this.draftRuleset = {
                enabled: true,
                combine_operator: current.combine_operator || 'or',
                rules: $.extend(true, [], current.rules || [])
            };

            if (isNew && (!this.draftRuleset.rules || this.draftRuleset.rules.length === 0)) {
                this.draftRuleset.rules = [this.createEmptyRule(widget)];
            }

            $('input[name="visibility-rules-combine"][value="' + this.draftRuleset.combine_operator + '"]').prop('checked', true);
            this.renderRuleRows(widget);
            $('#visibility-rules-modal').modal('show');
        },

        createEmptyRule: function(widget) {
            var targetType = widget.data('target-type');
            if (targetType === 'section') {
                return {
                    source_type: 'participant_field',
                    source_key: 'tipologia_id',
                    operator: 'in',
                    value: ''
                };
            }

            var availableQuestions = this.getAvailableQuestions(widget);
            var firstQuestionId = Object.keys(availableQuestions)[0] || '';

            return {
                source_type: 'question_answer',
                source_key: firstQuestionId,
                operator: '=',
                value: ''
            };
        },

        renderRuleRows: function(widget) {
            var self = this;
            var $list = $('.visibility-rules-list').empty();
            var rules = this.draftRuleset.rules || [];

            if (rules.length === 0) {
                rules.push(this.createEmptyRule(widget));
            }

            $.each(rules, function(index, rule) {
                var $row = $(self.buildRuleRow(widget, rule, index));
                $row.attr('data-initial-value', rule.value || '');
                $list.append($row);
            });

            $list.find('.visibility-rule-row').each(function() {
                self.loadValueField($(this));
            });
        },

        buildRuleRow: function(widget, rule, index) {
            var targetType = widget.data('target-type');
            var excludeQuestionId = widget.data('exclude-question-id');
            var sourceTypeOptions = '';

            if (targetType === 'section') {
                sourceTypeOptions += '<option value="participant_field"' + (rule.source_type === 'participant_field' ? ' selected' : '') + '>Campo partecipante</option>';
            }
            sourceTypeOptions += '<option value="question_answer"' + (rule.source_type === 'question_answer' ? ' selected' : '') + '>Risposta domanda</option>';

            var sourceKeyHtml = this.buildSourceKeyField(widget, rule);
            var operatorHtml = this.buildOperatorField(rule);

            return [
                '<div class="panel panel-default visibility-rule-row" data-index="', index, '" style="margin-bottom:10px;">',
                    '<div class="panel-body">',
                        '<div class="row">',
                            '<div class="col-sm-3">',
                                '<label>Tipo sorgente</label>',
                                '<select class="form-control visibility-rule-source-type">', sourceTypeOptions, '</select>',
                            '</div>',
                            '<div class="col-sm-4 visibility-rule-source-key-wrap">',
                                '<label>Sorgente</label>',
                                sourceKeyHtml,
                            '</div>',
                            '<div class="col-sm-2">',
                                '<label>Operatore</label>',
                                operatorHtml,
                            '</div>',
                            '<div class="col-sm-3 visibility-rule-value-wrap">',
                                '<label>Valore</label>',
                                '<div class="visibility-rule-value-container"></div>',
                            '</div>',
                        '</div>',
                        '<div class="text-right" style="margin-top:8px;">',
                            '<button type="button" class="btn btn-xs btn-danger visibility-rule-remove-btn"><i class="fa fa-trash"></i> Rimuovi</button>',
                        '</div>',
                    '</div>',
                '</div>'
            ].join('');
        },

        getQuestionOrderInput: function(questionBlock) {
            var $orderInput = questionBlock.find('input.question-order, input[name*="[order]"]').first();
            return $orderInput.length ? $orderInput : questionBlock.find('input[type="number"]').last();
        },

        getQuestionOrderValue: function(questionBlock, sectionBlock) {
            var $orderInput = this.getQuestionOrderInput(questionBlock);
            var questionOrder = parseInt($orderInput.val(), 10);
            if (!isNaN(questionOrder)) {
                return questionOrder;
            }

            if (sectionBlock && sectionBlock.length) {
                return sectionBlock.find('.question-block').index(questionBlock) + 1;
            }

            return 0;
        },

        getQuestionBlockId: function(questionBlock, sectionBlock) {
            var questionId = questionBlock.data('id');
            if (questionId) {
                return String(questionId);
            }

            var sectionId = sectionBlock.data('id') || '0';
            var order = this.getQuestionOrderValue(questionBlock, sectionBlock);
            return 'new-' + sectionId + '-' + order;
        },

        getEntityPosition: function(widget) {
            var sectionBlock = widget.closest('.section-block');
            var sectionOrder = parseInt(sectionBlock.find('input.section-order').val(), 10);
            if (isNaN(sectionOrder)) {
                sectionOrder = 0;
            }

            var position = {
                targetType: widget.data('target-type'),
                sectionOrder: sectionOrder,
                questionOrder: null
            };

            if (position.targetType === 'question') {
                var questionBlock = widget.closest('.question-block');
                position.questionOrder = this.getQuestionOrderValue(questionBlock, sectionBlock);
            }

            return position;
        },

        getCatalogWithLiveOrders: function() {
            var self = this;
            var catalog = {
                questions: $.extend(true, {}, this.catalog.questions || {})
            };

            $('.section-block').each(function() {
                var $section = $(this);
                var sectionOrder = parseInt($section.find('input.section-order').val(), 10);
                if (isNaN(sectionOrder)) {
                    sectionOrder = 0;
                }
                var sectionTitle = $.trim($section.find('input[name*="[title]"]').first().val()) || 'Sezione';

                $section.find('.question-block').each(function() {
                    var $questionBlock = $(this);
                    var questionId = self.getQuestionBlockId($questionBlock, $section);
                    var questionOrder = self.getQuestionOrderValue($questionBlock, $section);
                    var questionText = $.trim($questionBlock.find('input[name*="[text]"]').first().val()) || ('Domanda #' + questionId);
                    var questionType = $questionBlock.find('.question-type-select').val() || '';

                    if (!catalog.questions[questionId]) {
                        catalog.questions[questionId] = {
                            id: questionId,
                            label: sectionTitle + ' — ' + questionText,
                            type: questionType,
                            values: {}
                        };
                    }

                    catalog.questions[questionId].section_order = sectionOrder;
                    catalog.questions[questionId].question_order = questionOrder;
                    catalog.questions[questionId].label = sectionTitle + ' — ' + questionText;
                    if (questionType) {
                        catalog.questions[questionId].type = questionType;
                    }
                });
            });

            return catalog;
        },

        isQuestionBeforeTarget: function(question, position) {
            if (!question) {
                return false;
            }

            var questionSectionOrder = parseInt(question.section_order, 10);
            var questionOrder = parseInt(question.question_order, 10);
            if (isNaN(questionSectionOrder)) {
                return false;
            }
            if (isNaN(questionOrder)) {
                questionOrder = 0;
            }

            if (position.targetType === 'section') {
                return questionSectionOrder < position.sectionOrder;
            }

            if (questionSectionOrder < position.sectionOrder) {
                return true;
            }

            return questionSectionOrder === position.sectionOrder
                && questionOrder < position.questionOrder;
        },

        getAvailableQuestions: function(widget) {
            var position = this.getEntityPosition(widget);
            var catalog = this.getCatalogWithLiveOrders();
            var available = {};
            var self = this;

            $.each(catalog.questions || {}, function(id, question) {
                if (self.isQuestionBeforeTarget(question, position)) {
                    available[id] = question;
                }
            });

            return available;
        },

        buildSourceKeyField: function(widget, rule) {
            var sourceType = rule.source_type || 'question_answer';
            if (sourceType === 'participant_field') {
                var html = '<select class="form-control visibility-rule-source-key">';
                $.each(this.catalog.participant_fields || {}, function(key, label) {
                    html += '<option value="' + key + '"' + (rule.source_key === key ? ' selected' : '') + '>' + selfEscape(label) + '</option>';
                });
                html += '</select>';
                return html;
            }

            var excludeQuestionId = String(widget.data('exclude-question-id') || '');
            var availableQuestions = this.getAvailableQuestions(widget);
            var catalog = this.getCatalogWithLiveOrders();
            var html = '<select class="form-control visibility-rule-source-key">';
            html += '<option value="">Seleziona domanda</option>';

            if ($.isEmptyObject(availableQuestions)) {
                html += '<option value="" disabled>Nessuna domanda precedente disponibile</option>';
            } else {
                $.each(availableQuestions, function(id, question) {
                    if (excludeQuestionId && String(id) === excludeQuestionId) {
                        return;
                    }
                    html += '<option value="' + id + '"' + (String(rule.source_key) === String(id) ? ' selected' : '') + '>' + selfEscape(question.label) + '</option>';
                });
            }

            if (rule.source_key
                && !availableQuestions[rule.source_key]
                && catalog.questions[rule.source_key]
                && (!excludeQuestionId || String(rule.source_key) !== excludeQuestionId)) {
                html += '<option value="' + selfEscape(rule.source_key) + '" selected>'
                    + selfEscape(catalog.questions[rule.source_key].label) + ' (ordine non valido)</option>';
            }

            html += '</select>';
            return html;
        },

        buildOperatorField: function(rule) {
            var operators = {
                '=': '=',
                '!=': '!=',
                'in': 'IN',
                'not in': 'NOT IN'
            };
            var html = '<select class="form-control visibility-rule-operator">';
            $.each(operators, function(value, label) {
                html += '<option value="' + value + '"' + (rule.operator === value ? ' selected' : '') + '>' + label + '</option>';
            });
            html += '</select>';
            return html;
        },

        onSourceTypeChange: function($row) {
            var widget = this.activeWidget;
            var sourceType = $row.find('.visibility-rule-source-type').val();
            var rule = {
                source_type: sourceType,
                source_key: sourceType === 'participant_field' ? 'tipologia_id' : '',
                operator: '=',
                value: ''
            };
            $row.find('.visibility-rule-source-key-wrap').html(
                '<label>Sorgente</label>' + this.buildSourceKeyField(widget, rule)
            );
            $row.find('.visibility-rule-operator').val('=');
            this.loadValueField($row);
        },

        loadValueField: function($row) {
            var self = this;
            var sourceType = $row.find('.visibility-rule-source-type').val();
            var sourceKey = $row.find('.visibility-rule-source-key').val();
            var operator = $row.find('.visibility-rule-operator').val();
            var currentValue = $row.data('current-value') || '';
            var $container = $row.find('.visibility-rule-value-container');

            if (!sourceKey) {
                $container.html('<input type="text" class="form-control visibility-rule-value" disabled placeholder="Seleziona prima la sorgente">');
                return;
            }

            $container.html('<input type="text" class="form-control" disabled placeholder="Caricamento...">');

            $.getJSON(this.ruleValueUrl, {
                source_type: sourceType,
                source_key: sourceKey,
                operator: operator
            }).done(function(response) {
                var html = '';
                var initialValue = currentValue || $row.attr('data-initial-value') || '';
                if ($row.attr('data-initial-value')) {
                    $row.removeAttr('data-initial-value');
                }
                var selectedValues = String(initialValue).split(',').map(function(v) { return $.trim(v); }).filter(Boolean);
                var selectedValue = selectedValues.length ? selectedValues[0] : '';

                if (response.type === 'select' && response.values) {
                    if (operator === 'in' || operator === 'not in' || response.multiple) {
                        html = '<select class="form-control visibility-rule-value" multiple size="4">';
                        $.each(response.values, function(value, label) {
                            var selected = $.inArray(String(value), selectedValues) !== -1 ? ' selected' : '';
                            html += '<option value="' + selfEscape(value) + '"' + selected + '>' + selfEscape(label) + '</option>';
                        });
                        html += '</select>';
                    } else {
                        html = '<select class="form-control visibility-rule-value">';
                        html += '<option value="">-- seleziona --</option>';
                        $.each(response.values, function(value, label) {
                            var selected = String(selectedValue) === String(value) ? ' selected' : '';
                            html += '<option value="' + selfEscape(value) + '"' + selected + '>' + selfEscape(label) + '</option>';
                        });
                        html += '</select>';
                    }
                } else {
                    var placeholder = response.placeholder || 'Inserisci valore';
                    html = '<input type="text" class="form-control visibility-rule-value" placeholder="' + selfEscape(placeholder) + '" value="' + selfEscape(initialValue) + '">';
                }

                $container.html(html);
            }).fail(function() {
                var fallbackValue = currentValue || $row.attr('data-initial-value') || '';
                $container.html('<input type="text" class="form-control visibility-rule-value" value="' + selfEscape(fallbackValue) + '">');
            });
        },

        addRuleRow: function() {
            if (!this.activeWidget) {
                return;
            }
            var rule = this.createEmptyRule(this.activeWidget);
            var index = $('.visibility-rule-row').length;
            var $row = $(this.buildRuleRow(this.activeWidget, rule, index));
            $('.visibility-rules-list').append($row);
            this.loadValueField($row);
        },

        collectRulesFromModal: function() {
            var rules = [];
            $('.visibility-rule-row').each(function() {
                var $row = $(this);
                var sourceType = $row.find('.visibility-rule-source-type').val();
                var sourceKey = $row.find('.visibility-rule-source-key').val();
                var operator = $row.find('.visibility-rule-operator').val();
                var $valueField = $row.find('.visibility-rule-value');
                var value = '';

                if ($valueField.is('select[multiple]')) {
                    value = $valueField.val() ? $valueField.val().join(',') : '';
                } else {
                    value = $.trim($valueField.val() || '');
                }

                rules.push({
                    source_type: sourceType,
                    source_key: sourceKey,
                    operator: operator,
                    value: value
                });
            });
            return rules;
        },

        validateRules: function(rules, widget) {
            if (!rules.length) {
                return 'Aggiungi almeno una regola.';
            }

            var excludeQuestionId = String(widget.data('exclude-question-id') || '');
            var availableQuestions = this.getAvailableQuestions(widget);

            for (var i = 0; i < rules.length; i++) {
                var rule = rules[i];
                if (!rule.source_key) {
                    return 'Seleziona la sorgente per la regola ' + (i + 1) + '.';
                }
                if (!rule.operator) {
                    return 'Seleziona l\'operatore per la regola ' + (i + 1) + '.';
                }
                if (rule.value === '') {
                    return 'Inserisci il valore per la regola ' + (i + 1) + '.';
                }
                if (rule.source_type === 'question_answer' && excludeQuestionId && String(rule.source_key) === excludeQuestionId) {
                    return 'Una domanda non può dipendere da se stessa.';
                }
                if (rule.source_type === 'question_answer' && !availableQuestions[rule.source_key]) {
                    return 'La regola ' + (i + 1) + ' fa riferimento a una domanda successiva o non ancora mostrata durante la compilazione.';
                }
            }

            return null;
        },

        confirmModal: function() {
            if (!this.activeWidget) {
                return;
            }

            var rules = this.collectRulesFromModal();
            var error = this.validateRules(rules, this.activeWidget);
            if (error) {
                $('.visibility-rules-modal-error').text(error).show();
                return;
            }

            var ruleset = {
                enabled: true,
                combine_operator: $('input[name="visibility-rules-combine"]:checked').val() || 'or',
                rules: rules
            };

            this.applyRulesetToWidget(this.activeWidget, ruleset);
            this.modalConfirmed = true;
            $('#visibility-rules-modal').modal('hide');
        },

        applyRulesetToWidget: function(widget, ruleset) {
            ruleset = ruleset || {enabled: false, combine_operator: 'or', rules: []};
            widget.find('.visibility-rules-json-input').val(JSON.stringify(ruleset));

            var enabled = !!(ruleset.enabled && ruleset.rules && ruleset.rules.length);
            widget.find('.visibility-rules-enable-checkbox').prop('checked', enabled);

            if (!enabled) {
                widget.find('.visibility-rules-summary').hide();
                widget.find('.visibility-rules-edit-btn').remove();
                return;
            }

            var summary = this.formatSummary(ruleset);
            var $summary = widget.find('.visibility-rules-summary');
            if (summary) {
                $summary.find('.visibility-rules-summary-text').text(summary);
                $summary.show();
            } else {
                $summary.hide();
            }

            if (widget.find('.visibility-rules-edit-btn').length === 0) {
                widget.find('label').first().append(
                    ' <button type="button" class="btn btn-xs btn-default visibility-rules-edit-btn" style="margin-left: 8px;"><i class="fa fa-pencil"></i> Modifica</button>'
                );
            }
        },

        clearWidget: function(widget) {
            var empty = {enabled: false, combine_operator: 'or', rules: []};
            widget.find('.visibility-rules-json-input').val(JSON.stringify(empty));
            widget.find('.visibility-rules-enable-checkbox').prop('checked', false);
            widget.find('.visibility-rules-summary').hide();
            widget.find('.visibility-rules-edit-btn').remove();
        },

        formatSummary: function(ruleset) {
            if (!ruleset.enabled || !ruleset.rules || !ruleset.rules.length) {
                return '';
            }

            var self = this;
            var parts = $.map(ruleset.rules, function(rule) {
                return self.formatRuleSummary(rule);
            });
            var joiner = ruleset.combine_operator === 'or' ? ' OR ' : ' AND ';
            return 'Mostra se ' + parts.join(joiner);
        },

        formatRuleSummary: function(rule) {
            var source = this.resolveSourceLabel(rule);
            var operator = this.operatorLabel(rule.operator);
            var value = this.resolveValueLabel(rule);
            return '(' + source + ' ' + operator + ' ' + value + ')';
        },

        resolveSourceLabel: function(rule) {
            if (rule.source_type === 'participant_field') {
                return (this.catalog.participant_fields && this.catalog.participant_fields[rule.source_key]) || rule.source_key;
            }
            if (this.catalog.questions && this.catalog.questions[rule.source_key]) {
                return this.catalog.questions[rule.source_key].label;
            }
            return 'Domanda #' + rule.source_key;
        },

        operatorLabel: function(operator) {
            var labels = {
                '=': 'è uguale a',
                '!=': 'è diverso da',
                'in': 'è uno tra',
                'not in': 'non è uno tra'
            };
            return labels[operator] || operator;
        },

        resolveValueLabel: function(rule) {
            var value = rule.value || '';
            if (!value) {
                return '—';
            }

            if (rule.source_type === 'participant_field' && rule.source_key === 'tipologia_id') {
                var self = this;
                return $.map(String(value).split(','), function(id) {
                    id = $.trim(id);
                    return (self.catalog.tipologie && self.catalog.tipologie[id]) ? self.catalog.tipologie[id] : id;
                }).join(', ');
            }

            if (rule.source_type === 'question_answer' && this.catalog.questions && this.catalog.questions[rule.source_key]) {
                var valuesMap = this.catalog.questions[rule.source_key].values || {};
                if (valuesMap[value]) {
                    return valuesMap[value];
                }
            }

            if (rule.operator === 'in' || rule.operator === 'not in') {
                return String(value).split(',').join(', ');
            }

            return value;
        },

        refreshSummaries: function() {
            var self = this;
            $('.visibility-rules-widget').each(function() {
                var widget = $(this);
                var ruleset = self.parseRuleset(widget);
                var summary = self.formatSummary(ruleset);
                if (summary) {
                    widget.find('.visibility-rules-summary-text').text(summary);
                    widget.find('.visibility-rules-summary').show();
                    widget.find('.visibility-rules-enable-checkbox').prop('checked', true);
                }
            });
        }
    };

    function selfEscape(value) {
        return $('<div/>').text(value == null ? '' : value).html();
    }

    window.VisibilityRulesBuilder = VisibilityRulesBuilder;
})(window, jQuery);
