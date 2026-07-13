(function(window) {
    'use strict';

    function getParticipantFieldValue(participant, field) {
        var fieldMapping = {
            tipologia_id: 'tipologia_soggiorno_id',
            centro: 'soggiorno_id',
            ente: 'client_id',
            anno: 'anno',
            eta: 'age',
            organizzatore: 'organizzatore_id',
            soggiorno: 'soggiorno_id',
            turno: 'turno_id'
        };

        var participantField = fieldMapping[field] || field;
        if (participantField === 'anno') {
            return participant.anno || String(new Date().getFullYear());
        }
        return participant[participantField];
    }

    function valueInList(actualValue, expectedValues) {
        var actualParts = String(actualValue).split(',').map(function(v) { return v.trim(); });
        for (var i = 0; i < actualParts.length; i++) {
            if (expectedValues.indexOf(actualParts[i]) !== -1) {
                return true;
            }
        }
        return expectedValues.indexOf(String(actualValue)) !== -1;
    }

    function compareValues(actualValue, operator, expectedValue) {
        if (actualValue === undefined || actualValue === null || actualValue === '') {
            return false;
        }

        switch (operator) {
            case '=':
                return actualValue == expectedValue;
            case '!=':
                return actualValue != expectedValue;
            case 'in':
                return valueInList(actualValue, String(expectedValue).split(',').map(function(v) { return v.trim(); }));
            case 'not in':
                return !valueInList(actualValue, String(expectedValue).split(',').map(function(v) { return v.trim(); }));
            default:
                return true;
        }
    }

    function evaluateRule(rule, context) {
        var actualValue;
        if (rule.source_type === 'participant_field') {
            actualValue = getParticipantFieldValue(context.participant || {}, rule.source_key);
        } else {
            var answers = context.answers || {};
            if (!Object.prototype.hasOwnProperty.call(answers, rule.source_key)) {
                return false;
            }
            actualValue = answers[rule.source_key];
            if (actualValue === '' || actualValue === null || actualValue === undefined) {
                return false;
            }
        }

        return compareValues(actualValue, rule.operator, rule.value);
    }

    function evaluate(ruleset, context) {
        if (!ruleset || !ruleset.enabled || !ruleset.rules || !ruleset.rules.length) {
            return true;
        }

        var results = ruleset.rules.map(function(rule) {
            return evaluateRule(rule, context);
        });

        if (ruleset.combine_operator === 'or') {
            return results.some(function(result) { return result; });
        }

        return results.every(function(result) { return result; });
    }

    window.VisibilityRulesEvaluator = {
        evaluate: evaluate,
        evaluateRule: evaluateRule,
        compareValues: compareValues,
        getParticipantFieldValue: getParticipantFieldValue
    };
})(window);
