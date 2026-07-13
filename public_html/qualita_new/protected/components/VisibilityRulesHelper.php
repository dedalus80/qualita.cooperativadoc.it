<?php

class VisibilityRulesHelper
{
    const OPERATOR_LABELS = array(
        '=' => 'è uguale a',
        '!=' => 'è diverso da',
        'in' => 'è uno tra',
        'not in' => 'non è uno tra',
    );

    const PARTICIPANT_FIELD_LABELS = array(
        'tipologia_id' => 'Tipologia Soggiorno',
        'centro' => 'Centro/Soggiorno',
        'soggiorno' => 'Soggiorno',
        'turno' => 'Turno',
        'eta' => 'Età',
        'group_name' => 'Gruppo',
        'coordinator_name' => 'Nome Coordinatore',
        'coordinator_surname' => 'Cognome Coordinatore',
        'name' => 'Nome',
        'surname' => 'Cognome',
        'email' => 'Email',
        'phone' => 'Telefono',
        'date_course' => 'Data corso',
        'type_course_id' => 'Tipologia corso',
        'course_category' => 'Categoria corso',
        'title_course_id' => 'Titolo corso',
        'affiliated_organisation' => 'Ente/organizzazione',
        // Legacy (solo risoluzione etichette regole esistenti)
        'ente' => 'Cliente/Ente',
        'anno' => 'Anno',
        'organizzatore' => 'Organizzatore',
    );

    /**
     * Campi anagrafici disponibili per tipo questionario (allineato a fill.php data-field).
     *
     * @var array
     */
    const PARTICIPANT_FIELDS_BY_TYPE = array(
        'A' => array(),
        'SP' => array(
            'tipologia_id', 'centro', 'soggiorno', 'turno', 'eta', 'group_name',
            'coordinator_name', 'coordinator_surname', 'name', 'surname',
        ),
        'SG' => array(
            'tipologia_id', 'centro', 'soggiorno', 'turno', 'eta',
            'coordinator_name', 'coordinator_surname', 'name', 'surname', 'email', 'phone',
        ),
        'Q' => array('name', 'surname', 'email', 'phone'),
        'F' => array(
            'date_course', 'type_course_id', 'course_category', 'title_course_id',
            'name', 'surname', 'affiliated_organisation',
        ),
    );

    /**
     * @param string $targetType
     * @param int $targetId
     * @return VisibilityRuleset|null
     */
    public static function findRuleset($targetType, $targetId)
    {
        return VisibilityRuleset::model()->with('rules')->findByAttributes(array(
            'target_type' => $targetType,
            'target_id' => (int) $targetId,
        ));
    }

    /**
     * @param QuestionnaireSection $section
     * @return array
     */
    public static function getRulesetDataForSection(QuestionnaireSection $section)
    {
        $ruleset = self::findRuleset('section', $section->id);
        if ($ruleset) {
            return $ruleset->toArray();
        }

        return self::buildLegacySectionRuleset($section);
    }

    /**
     * @param Question $question
     * @return array
     */
    public static function getRulesetDataForQuestion(Question $question)
    {
        $ruleset = self::findRuleset('question', $question->id);
        if ($ruleset) {
            return $ruleset->toArray();
        }

        return self::buildLegacyQuestionRuleset($question);
    }

    /**
     * @param QuestionnaireSection $section
     * @return array
     */
    public static function buildLegacySectionRuleset(QuestionnaireSection $section)
    {
        if (empty($section->condition_field) || empty($section->condition_operator)) {
            return self::emptyRuleset();
        }

        return array(
            'enabled' => true,
            'combine_operator' => 'and',
            'rules' => array(
                array(
                    'source_type' => 'participant_field',
                    'source_key' => $section->condition_field,
                    'operator' => $section->condition_operator,
                    'value' => (string) $section->condition_value,
                ),
            ),
        );
    }

    /**
     * @param Question $question
     * @return array
     */
    public static function buildLegacyQuestionRuleset(Question $question)
    {
        if (empty($question->condition_question_id) || empty($question->condition_operator)) {
            return self::emptyRuleset();
        }

        return array(
            'enabled' => true,
            'combine_operator' => 'and',
            'rules' => array(
                array(
                    'source_type' => 'question_answer',
                    'source_key' => (string) $question->condition_question_id,
                    'operator' => $question->condition_operator,
                    'value' => (string) $question->condition_value,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public static function emptyRuleset()
    {
        return array(
            'enabled' => false,
            'combine_operator' => 'or',
            'rules' => array(),
        );
    }

    /**
     * @param string $json
     * @return array
     */
    public static function parseRulesetJson($json)
    {
        if ($json === null || $json === '') {
            return self::emptyRuleset();
        }

        $data = CJSON::decode($json, true);
        if (!is_array($data)) {
            return self::emptyRuleset();
        }

        $rules = array();
        if (!empty($data['rules']) && is_array($data['rules'])) {
            foreach ($data['rules'] as $rule) {
                if (empty($rule['source_type']) || empty($rule['source_key']) || empty($rule['operator'])) {
                    continue;
                }
                $rules[] = array(
                    'source_type' => $rule['source_type'],
                    'source_key' => (string) $rule['source_key'],
                    'operator' => $rule['operator'],
                    'value' => isset($rule['value']) ? (string) $rule['value'] : '',
                );
            }
        }

        return array(
            'enabled' => !empty($data['enabled']) && !empty($rules),
            'combine_operator' => !empty($data['combine_operator']) ? $data['combine_operator'] : 'or',
            'rules' => $rules,
        );
    }

    /**
     * @param string $targetType
     * @param int $targetId
     * @param array $rulesetData
     */
    public static function syncRuleset($targetType, $targetId, array $rulesetData)
    {
        $existing = self::findRuleset($targetType, $targetId);

        if (empty($rulesetData['enabled']) || empty($rulesetData['rules'])) {
            if ($existing) {
                VisibilityRule::model()->deleteAllByAttributes(array('ruleset_id' => $existing->id));
                $existing->delete();
            }
            return;
        }

        if (!$existing) {
            $existing = new VisibilityRuleset();
            $existing->target_type = $targetType;
            $existing->target_id = (int) $targetId;
        }

        $existing->combine_operator = !empty($rulesetData['combine_operator']) ? $rulesetData['combine_operator'] : 'or';
        if (!$existing->save()) {
            throw new Exception('Errore salvataggio ruleset: ' . CJSON::encode($existing->getErrors()));
        }

        VisibilityRule::model()->deleteAllByAttributes(array('ruleset_id' => $existing->id));

        $order = 0;
        foreach ($rulesetData['rules'] as $ruleData) {
            $rule = new VisibilityRule();
            $rule->ruleset_id = $existing->id;
            $rule->sort_order = $order++;
            $rule->source_type = $ruleData['source_type'];
            $rule->source_key = (string) $ruleData['source_key'];
            $rule->operator = $ruleData['operator'];
            $rule->value = isset($ruleData['value']) ? (string) $ruleData['value'] : '';
            if (!$rule->save()) {
                throw new Exception('Errore salvataggio regola: ' . CJSON::encode($rule->getErrors()));
            }
        }
    }

    /**
     * @param array $rulesetData
     * @param array $catalog
     * @return string
     */
    public static function formatSummary(array $rulesetData, array $catalog)
    {
        if (empty($rulesetData['enabled']) || empty($rulesetData['rules'])) {
            return '';
        }

        $parts = array();
        foreach ($rulesetData['rules'] as $rule) {
            $parts[] = self::formatRuleSummary($rule, $catalog);
        }

        $joiner = !empty($rulesetData['combine_operator']) && $rulesetData['combine_operator'] === 'or'
            ? ' OR '
            : ' AND ';

        return 'Mostra se ' . implode($joiner, $parts);
    }

    /**
     * @param array $rule
     * @param array $catalog
     * @return string
     */
    public static function formatRuleSummary(array $rule, array $catalog)
    {
        $sourceLabel = self::resolveSourceLabel($rule, $catalog);
        $operator = isset($rule['operator']) ? $rule['operator'] : '';
        $operatorLabel = array_key_exists($operator, self::OPERATOR_LABELS)
            ? self::OPERATOR_LABELS[$operator]
            : $operator;
        $valueLabel = self::resolveValueLabel($rule, $catalog);

        return '(' . $sourceLabel . ' ' . $operatorLabel . ' ' . $valueLabel . ')';
    }

    /**
     * @param array $rule
     * @param array $catalog
     * @return string
     */
    protected static function resolveSourceLabel(array $rule, array $catalog)
    {
        if ($rule['source_type'] === 'participant_field') {
            $key = $rule['source_key'];
            return array_key_exists($key, self::PARTICIPANT_FIELD_LABELS)
                ? self::PARTICIPANT_FIELD_LABELS[$key]
                : $key;
        }

        $questionId = $rule['source_key'];
        if (isset($catalog['questions'][$questionId])) {
            return $catalog['questions'][$questionId]['label'];
        }

        return 'Domanda #' . $questionId;
    }

    /**
     * @param array $rule
     * @param array $catalog
     * @return string
     */
    protected static function resolveValueLabel(array $rule, array $catalog)
    {
        $value = isset($rule['value']) ? $rule['value'] : '';
        if ($value === '') {
            return '—';
        }

        if ($rule['source_type'] === 'participant_field' && $rule['source_key'] === 'tipologia_id') {
            $ids = array_map('trim', explode(',', $value));
            $labels = array();
            foreach ($ids as $id) {
                if (isset($catalog['tipologie'][$id])) {
                    $labels[] = $catalog['tipologie'][$id];
                } else {
                    $labels[] = $id;
                }
            }
            return implode(', ', $labels);
        }

        if ($rule['source_type'] === 'participant_field') {
            $sourceKey = $rule['source_key'];
            $lookupMaps = array(
                'centro' => 'centri',
                'soggiorno' => 'centri',
                'type_course_id' => 'course_types',
                'title_course_id' => 'course_titles',
                'course_category' => 'course_categories',
            );
            if (isset($lookupMaps[$sourceKey]) && isset($catalog[$lookupMaps[$sourceKey]])) {
                $map = $catalog[$lookupMaps[$sourceKey]];
                if (in_array($rule['operator'], array('in', 'not in'), true)) {
                    $ids = array_map('trim', explode(',', $value));
                    $labels = array();
                    foreach ($ids as $id) {
                        $labels[] = isset($map[$id]) ? $map[$id] : $id;
                    }
                    return implode(', ', $labels);
                }
                return isset($map[$value]) ? $map[$value] : $value;
            }
        }

        if ($rule['source_type'] === 'question_answer') {
            $questionId = $rule['source_key'];
            if (isset($catalog['questions'][$questionId]['values'][$value])) {
                return $catalog['questions'][$questionId]['values'][$value];
            }
        }

        if (in_array($rule['operator'], array('in', 'not in'), true)) {
            return str_replace(',', ', ', $value);
        }

        return $value;
    }

    /**
     * @param QuestionnaireVersion $version
     * @return array
     */
    public static function buildCatalogForVersion(QuestionnaireVersion $version)
    {
        $sections = QuestionnaireSection::model()->with(array(
            'questions' => array(
                'with' => array('options'),
                'order' => 'questions.order ASC',
            ),
        ))->findAll(array(
            'condition' => 'version_id = :version_id',
            'params' => array(':version_id' => $version->id),
            'order' => 't.order ASC',
        ));

        $questions = array();
        foreach ($sections as $section) {
            foreach ($section->questions as $question) {
                $questions[(string) $question->id] = array(
                    'id' => (int) $question->id,
                    'section_id' => (int) $section->id,
                    'section_order' => (int) $section->order,
                    'question_order' => (int) $question->order,
                    'section_title' => $section->title,
                    'label' => $section->title . ' — ' . $question->text,
                    'type' => $question->type,
                    'values' => self::getQuestionValueOptions($question),
                );
            }
        }

        $tipologie = array();
        $clientId = $version->questionnaire ? $version->questionnaire->client_id : null;
        if ($clientId) {
            $rows = TipologiaSoggiorni::model()->with('tipologia')->findAll(array(
                'condition' => 'tipologia.cliente_id = :cliente',
                'params' => array(':cliente' => $clientId),
                'order' => 't.tipologia ASC',
            ));
            foreach ($rows as $row) {
                $tipologie[(string) $row->id] = $row->tipologia;
            }
        } else {
            $rows = TipologiaSoggiorni::model()->findAll(array('order' => 'tipologia ASC'));
            foreach ($rows as $row) {
                $tipologie[(string) $row->id] = $row->tipologia;
            }
        }

        $questionnaireType = $version->questionnaire ? $version->questionnaire->questionnaire_type : '';
        $catalog = array(
            'questions' => $questions,
            'questionnaire_type' => $questionnaireType,
            'supports_participant_fields' => self::supportsParticipantFieldRules($questionnaireType),
            'participant_fields' => self::getParticipantFieldOptionsForType($questionnaireType),
            'tipologie' => $tipologie,
        );

        if ($questionnaireType === 'F') {
            $catalog = array_merge($catalog, self::buildCourseCatalogData());
        }

        if (in_array($questionnaireType, array('SP', 'SG'), true)) {
            $centriCriteria = array('order' => 'nome ASC');
            $clientId = $version->questionnaire ? $version->questionnaire->client_id : null;
            if ($clientId) {
                $centriCriteria['condition'] = 'cliente_id = :cliente';
                $centriCriteria['params'] = array(':cliente' => $clientId);
            }
            $catalog['centri'] = CHtml::listData(Soggiorni::model()->findAll($centriCriteria), 'id', 'nome');
        }

        return $catalog;
    }

    /**
     * @param string $questionnaireType
     * @return bool
     */
    public static function supportsParticipantFieldRules($questionnaireType)
    {
        return !empty(self::getParticipantFieldOptionsForType($questionnaireType));
    }

    /**
     * @param string $questionnaireType
     * @return array key => label
     */
    public static function getParticipantFieldOptionsForType($questionnaireType)
    {
        $keys = array_key_exists($questionnaireType, self::PARTICIPANT_FIELDS_BY_TYPE)
            ? self::PARTICIPANT_FIELDS_BY_TYPE[$questionnaireType]
            : array();
        $options = array();

        foreach ($keys as $key) {
            if (array_key_exists($key, self::PARTICIPANT_FIELD_LABELS)) {
                $options[$key] = self::PARTICIPANT_FIELD_LABELS[$key];
            }
        }

        return $options;
    }

    /**
     * Catalogo opzioni per questionari formazione (tipo F).
     *
     * @return array
     */
    public static function buildCourseCatalogData()
    {
        $courseTypes = array();
        $courseCategories = array(
            'SOCI' => 'SOCI',
            'APERTA A TUTTI' => 'APERTA A TUTTI',
        );
        $courseTitles = array();

        $courseTypeRows = Yii::app()->db->createCommand()
            ->select('id, nome')
            ->from('doc_tipologie_formazione')
            ->where('attivo = :active', array(':active' => 'Y'))
            ->order('nome')
            ->queryAll();
        if (!empty($courseTypeRows)) {
            foreach ($courseTypeRows as $row) {
                $courseTypes[(string) $row['id']] = $row['nome'];
            }
        }

        $courseTitleRows = Yii::app()->db->createCommand()
            ->select('id, titolo_corso AS nome')
            ->from('doc_formazione_titolo_corsi')
            ->where('attivo = :active', array(':active' => 'Y'))
            ->order('nome')
            ->queryAll();
        if (!empty($courseTitleRows)) {
            foreach ($courseTitleRows as $row) {
                $courseTitles[(string) $row['id']] = $row['nome'];
            }
        }

        return array(
            'course_types' => $courseTypes,
            'course_categories' => $courseCategories,
            'course_titles' => $courseTitles,
        );
    }

    /**
     * Campi partecipante disponibili come sorgente condizione (tutti i tipi).
     *
     * @return array
     */
    public static function getParticipantFieldOptions()
    {
        return self::PARTICIPANT_FIELD_LABELS;
    }

    /**
     * @return array
     * @deprecated Usare getParticipantFieldOptions()
     */
    public static function getParticipantFieldsForSections()
    {
        return self::getParticipantFieldOptions();
    }

    /**
     * @param Question $question
     * @return array id=>label
     */
    public static function getQuestionValueOptions(Question $question)
    {
        $values = array();

        if ($question->type === 'option') {
            $options = $question->options ? $question->options : array();
            if (empty($options)) {
                foreach (array('POCO', 'ABBASTANZA', 'MOLTO') as $opt) {
                    $values[$opt] = $opt;
                }
            } else {
                foreach ($options as $opt) {
                    $values[$opt->option_text] = $opt->option_text;
                }
            }
        } elseif ($question->type === 'range') {
            for ($i = 1; $i <= 5; $i++) {
                $values[(string) $i] = (string) $i;
            }
        } elseif ($question->type === 'yes_no') {
            $values['SI'] = 'Sì';
            $values['NO'] = 'No';
        } elseif ($question->type === 'custom' && $question->options) {
            foreach ($question->options as $opt) {
                $values[$opt->option_text] = $opt->option_text;
            }
        }

        return $values;
    }

    /**
     * @param int $questionId
     * @return array
     */
    public static function getRuleValueOptionsForQuestion($questionId)
    {
        $question = Question::model()->with('options')->findByPk($questionId);
        if (!$question) {
            return array('type' => 'text', 'values' => array());
        }

        $values = self::getQuestionValueOptions($question);
        if (!empty($values)) {
            return array('type' => 'select', 'values' => $values);
        }

        return array(
            'type' => 'text',
            'placeholder' => 'Inserisci valore',
        );
    }

    /**
     * @param string $field
     * @param int|null $clientId
     * @return array
     */
    public static function getRuleValueOptionsForParticipantField($field, $clientId = null)
    {
        if ($field === 'tipologia_id') {
            $values = array();
            if ($clientId) {
                $rows = TipologiaSoggiorni::model()->with('tipologia')->findAll(array(
                    'condition' => 'tipologia.cliente_id = :cliente',
                    'params' => array(':cliente' => $clientId),
                    'order' => 't.tipologia ASC',
                ));
            } else {
                $rows = TipologiaSoggiorni::model()->findAll(array('order' => 'tipologia ASC'));
            }
            foreach ($rows as $row) {
                $values[(string) $row->id] = $row->tipologia;
            }
            return array('type' => 'select', 'values' => $values, 'multiple' => true);
        }

        if ($field === 'centro' || $field === 'soggiorno') {
            $criteria = array('order' => 'nome ASC');
            if ($clientId) {
                $criteria['condition'] = 'cliente_id = :cliente';
                $criteria['params'] = array(':cliente' => $clientId);
            }
            return array(
                'type' => 'select',
                'values' => CHtml::listData(Soggiorni::model()->findAll($criteria), 'id', 'nome'),
                'multiple' => true,
            );
        }

        if ($field === 'ente') {
            return array(
                'type' => 'select',
                'values' => CHtml::listData(Clienti::model()->findAll(array('order' => 'nome ASC')), 'id', 'nome'),
                'multiple' => true,
            );
        }

        if ($field === 'eta') {
            return array(
                'type' => 'select',
                'values' => SurveyStays::getParticipantAges(),
                'multiple' => true,
            );
        }

        if ($field === 'type_course_id') {
            $rows = Yii::app()->db->createCommand()
                ->select('id, nome')
                ->from('doc_tipologie_formazione')
                ->where('attivo = :active', array(':active' => 'Y'))
                ->order('nome')
                ->queryAll();
            $values = array();
            foreach ($rows as $row) {
                $values[(string) $row['id']] = $row['nome'];
            }
            return array('type' => 'select', 'values' => $values, 'multiple' => true);
        }

        if ($field === 'course_category') {
            return array(
                'type' => 'select',
                'values' => array(
                    'SOCI' => 'SOCI',
                    'APERTA A TUTTI' => 'APERTA A TUTTI',
                ),
                'multiple' => true,
            );
        }

        if ($field === 'title_course_id') {
            $rows = Yii::app()->db->createCommand()
                ->select('id, titolo_corso AS nome')
                ->from('doc_formazione_titolo_corsi')
                ->where('attivo = :active', array(':active' => 'Y'))
                ->order('nome')
                ->queryAll();
            $values = array();
            foreach ($rows as $row) {
                $values[(string) $row['id']] = $row['nome'];
            }
            return array('type' => 'select', 'values' => $values, 'multiple' => true);
        }

        $placeholders = array(
            'anno' => 'es. 2024',
            'organizzatore' => 'es. 1 o 1,2,3',
            'turno' => 'es. 1 o 1,2,3',
            'date_course' => 'es. 2024-06-15',
            'name' => 'es. Mario',
            'surname' => 'es. Rossi',
            'email' => 'es. nome@dominio.it',
            'phone' => 'es. 3331234567',
            'group_name' => 'es. Gruppo A',
            'coordinator_name' => 'es. Mario',
            'coordinator_surname' => 'es. Rossi',
            'affiliated_organisation' => 'es. Ente/organizzazione',
        );

        return array(
            'type' => 'text',
            'placeholder' => isset($placeholders[$field]) ? $placeholders[$field] : 'Inserisci valore',
        );
    }

    /**
     * Mappa posizioni di compilazione per le domande di una versione.
     *
     * @param int $versionId
     * @return array
     */
    public static function getQuestionPositionMap($versionId)
    {
        $map = array();
        $sections = QuestionnaireSection::model()->with(array(
            'questions' => array('order' => 'questions.order ASC'),
        ))->findAll(array(
            'condition' => 'version_id = :version_id',
            'params' => array(':version_id' => (int) $versionId),
            'order' => 't.order ASC',
        ));

        foreach ($sections as $section) {
            foreach ($section->questions as $question) {
                $map[(string) $question->id] = array(
                    'section_order' => (int) $section->order,
                    'question_order' => (int) $question->order,
                );
            }
        }

        return $map;
    }

    /**
     * Verifica se una domanda precede il target nell'ordine di compilazione.
     *
     * @param int|string $questionId
     * @param string $targetType section|question
     * @param int $targetSectionOrder
     * @param int|null $targetQuestionOrder
     * @param int $versionId
     * @return bool
     */
    public static function isQuestionBeforeTarget($questionId, $targetType, $targetSectionOrder, $targetQuestionOrder, $versionId)
    {
        $map = self::getQuestionPositionMap($versionId);
        $key = (string) $questionId;
        if (!isset($map[$key])) {
            return false;
        }

        $questionPosition = $map[$key];
        $targetSectionOrder = (int) $targetSectionOrder;

        if ($targetType === 'section') {
            return $questionPosition['section_order'] < $targetSectionOrder;
        }

        $targetQuestionOrder = (int) $targetQuestionOrder;
        if ($questionPosition['section_order'] < $targetSectionOrder) {
            return true;
        }

        return $questionPosition['section_order'] === $targetSectionOrder
            && $questionPosition['question_order'] < $targetQuestionOrder;
    }

    /**
     * Valida che le regole non facciano riferimento a domande successive.
     *
     * @param array $rulesetData
     * @param string $targetType
     * @param int $targetSectionOrder
     * @param int|null $targetQuestionOrder
     * @param int $versionId
     * @return string|null Messaggio errore
     */
    public static function validateRulesetLinearOrder(array $rulesetData, $targetType, $targetSectionOrder, $targetQuestionOrder, $versionId)
    {
        if (empty($rulesetData['enabled']) || empty($rulesetData['rules'])) {
            return null;
        }

        foreach ($rulesetData['rules'] as $index => $rule) {
            if ($rule['source_type'] !== 'question_answer') {
                continue;
            }

            if (!self::isQuestionBeforeTarget(
                $rule['source_key'],
                $targetType,
                $targetSectionOrder,
                $targetQuestionOrder,
                $versionId
            )) {
                return 'La regola ' . ($index + 1) . ' fa riferimento a una domanda successiva nel questionario.';
            }
        }

        return null;
    }

    /**
     * Valida che le regole sui campi partecipante siano coerenti col tipo questionario.
     *
     * @param array $rulesetData
     * @param string $questionnaireType
     * @return string|null Messaggio errore
     */
    public static function validateParticipantFieldRules(array $rulesetData, $questionnaireType)
    {
        if (empty($rulesetData['enabled']) || empty($rulesetData['rules'])) {
            return null;
        }

        $allowedFields = self::getParticipantFieldOptionsForType($questionnaireType);

        foreach ($rulesetData['rules'] as $index => $rule) {
            if ($rule['source_type'] !== 'participant_field') {
                continue;
            }

            if (empty($allowedFields)) {
                return 'La regola ' . ($index + 1) . ' usa un campo partecipante, non disponibile per questionari di tipo ' . $questionnaireType . '.';
            }

            if (!isset($allowedFields[$rule['source_key']])) {
                return 'La regola ' . ($index + 1) . ' usa un campo partecipante non valido per questo tipo di questionario.';
            }
        }

        return null;
    }

    /**
     * Validazione completa ruleset (ordine lineare + campi partecipante).
     *
     * @param array $rulesetData
     * @param string $targetType
     * @param int $targetSectionOrder
     * @param int|null $targetQuestionOrder
     * @param int $versionId
     * @param string|null $questionnaireType
     * @return string|null
     */
    public static function validateRulesetForVersion(
        array $rulesetData,
        $targetType,
        $targetSectionOrder,
        $targetQuestionOrder,
        $versionId,
        $questionnaireType = null
    ) {
        if ($questionnaireType === null) {
            $version = QuestionnaireVersion::model()->with('questionnaire')->findByPk((int) $versionId);
            $questionnaireType = $version && $version->questionnaire
                ? $version->questionnaire->questionnaire_type
                : '';
        }

        $participantError = self::validateParticipantFieldRules($rulesetData, $questionnaireType);
        if ($participantError) {
            return $participantError;
        }

        return self::validateRulesetLinearOrder(
            $rulesetData,
            $targetType,
            $targetSectionOrder,
            $targetQuestionOrder,
            $versionId
        );
    }

    /**
     * Clona un ruleset su un nuovo target, rimappando gli ID domanda.
     *
     * @param string $sourceType
     * @param int $sourceTargetId
     * @param string $destType
     * @param int $destTargetId
     * @param array $questionIdMap
     */
    public static function cloneRuleset($sourceType, $sourceTargetId, $destType, $destTargetId, array $questionIdMap = array())
    {
        $sourceRuleset = self::findRuleset($sourceType, $sourceTargetId);
        if (!$sourceRuleset) {
            return;
        }

        $data = $sourceRuleset->toArray();
        if (empty($data['enabled']) || empty($data['rules'])) {
            return;
        }

        foreach ($data['rules'] as &$rule) {
            if ($rule['source_type'] === 'question_answer' && isset($questionIdMap[$rule['source_key']])) {
                $rule['source_key'] = (string) $questionIdMap[$rule['source_key']];
            }
        }
        unset($rule);

        self::syncRuleset($destType, $destTargetId, $data);
    }

    /**
     * Sincronizza i campi legacy per retrocompatibilità runtime.
     *
     * @param Question $question
     * @param array $rulesetData
     */
    public static function syncLegacyQuestionFields(Question $question, array $rulesetData)
    {
        if (empty($rulesetData['enabled']) || count($rulesetData['rules']) !== 1) {
            $question->condition_question_id = null;
            $question->condition_operator = null;
            $question->condition_value = null;
            return;
        }

        $rule = $rulesetData['rules'][0];
        if ($rule['source_type'] !== 'question_answer' || $rulesetData['combine_operator'] !== 'and') {
            $question->condition_question_id = null;
            $question->condition_operator = null;
            $question->condition_value = null;
            return;
        }

        $question->condition_question_id = (int) $rule['source_key'];
        $question->condition_operator = $rule['operator'];
        $question->condition_value = $rule['value'];
    }

    /**
     * @param QuestionnaireSection $section
     * @param array $rulesetData
     */
    public static function syncLegacySectionFields(QuestionnaireSection $section, array $rulesetData)
    {
        if (empty($rulesetData['enabled']) || count($rulesetData['rules']) !== 1) {
            $section->condition_field = null;
            $section->condition_operator = null;
            $section->condition_value = null;
            return;
        }

        $rule = $rulesetData['rules'][0];
        if ($rule['source_type'] !== 'participant_field' || $rulesetData['combine_operator'] !== 'and') {
            $section->condition_field = null;
            $section->condition_operator = null;
            $section->condition_value = null;
            return;
        }

        $section->condition_field = $rule['source_key'];
        $section->condition_operator = $rule['operator'];
        $section->condition_value = $rule['value'];
    }
}
