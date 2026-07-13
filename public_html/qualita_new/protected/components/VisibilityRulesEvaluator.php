<?php

class VisibilityRulesEvaluator
{
    /**
     * @param array $ruleset
     * @param array $context ['participant' => [], 'answers' => []]
     * @return bool
     */
    public static function evaluate($ruleset, array $context)
    {
        if (empty($ruleset) || empty($ruleset['enabled']) || empty($ruleset['rules'])) {
            return true;
        }

        $results = array();
        foreach ($ruleset['rules'] as $rule) {
            $results[] = self::evaluateRule($rule, $context);
        }

        if (empty($results)) {
            return true;
        }

        $combine = isset($ruleset['combine_operator']) ? $ruleset['combine_operator'] : 'and';
        if ($combine === 'or') {
            foreach ($results as $result) {
                if ($result) {
                    return true;
                }
            }
            return false;
        }

        foreach ($results as $result) {
            if (!$result) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $rule
     * @param array $context
     * @return bool
     */
    public static function evaluateRule(array $rule, array $context)
    {
        $operator = isset($rule['operator']) ? $rule['operator'] : '=';
        $expectedValue = isset($rule['value']) ? $rule['value'] : '';

        if ($rule['source_type'] === 'participant_field') {
            $actualValue = self::getParticipantFieldValue(
                isset($context['participant']) ? $context['participant'] : array(),
                $rule['source_key']
            );
        } else {
            $questionId = $rule['source_key'];
            $answers = isset($context['answers']) ? $context['answers'] : array();
            if (!isset($answers[$questionId]) || $answers[$questionId] === '' || $answers[$questionId] === null) {
                return false;
            }
            $actualValue = $answers[$questionId];
        }

        return self::compareValues($actualValue, $operator, $expectedValue);
    }

    /**
     * @param mixed $actualValue
     * @param string $operator
     * @param string $expectedValue
     * @return bool
     */
    public static function compareValues($actualValue, $operator, $expectedValue)
    {
        if ($actualValue === null || $actualValue === '') {
            return false;
        }

        switch ($operator) {
            case '=':
                return $actualValue == $expectedValue;
            case '!=':
                return $actualValue != $expectedValue;
            case 'in':
                $expectedValues = array_map('trim', explode(',', $expectedValue));
                return self::valueInList($actualValue, $expectedValues);
            case 'not in':
                $expectedValues = array_map('trim', explode(',', $expectedValue));
                return !self::valueInList($actualValue, $expectedValues);
            default:
                return true;
        }
    }

    /**
     * @param mixed $actualValue
     * @param array $expectedValues
     * @return bool
     */
    protected static function valueInList($actualValue, array $expectedValues)
    {
        $actualParts = array_map('trim', explode(',', (string) $actualValue));
        foreach ($actualParts as $part) {
            if (in_array($part, $expectedValues, false)) {
                return true;
            }
        }

        return in_array((string) $actualValue, $expectedValues, false);
    }

    /**
     * @param array $participant
     * @param string $field
     * @return mixed|null
     */
    public static function getParticipantFieldValue(array $participant, $field)
    {
        $fieldMapping = array(
            'tipologia_id' => 'tipologia_soggiorno_id',
            'centro' => 'soggiorno_id',
            'ente' => 'client_id',
            'anno' => 'anno',
            'eta' => 'age',
            'organizzatore' => 'organizzatore_id',
            'soggiorno' => 'soggiorno_id',
            'turno' => 'turno_id',
        );

        $participantField = isset($fieldMapping[$field]) ? $fieldMapping[$field] : $field;

        if ($participantField === 'anno') {
            return isset($participant['anno']) ? $participant['anno'] : date('Y');
        }

        if (array_key_exists($participantField, $participant)) {
            return $participant[$participantField];
        }

        return null;
    }
}
