<?php

class QuestionnaireSectionController extends Controller
{
    public $layout = 'main'; // usa layout del modulo se presente

    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'createFull', 'editFull', 'getConditionValues', 'getRuleValueOptions'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('QuestionnaireSection');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Breadcrumbs dinamici
        $this->breadcrumbs = array(
            'Questionari' => array('questionnaire/index'),
            $model->version->questionnaire->title => array('questionnaire/view', 'id' => $model->version->questionnaire_id),
            'Versioni' => array('questionnaireVersion/index', 'questionnaire_id' => $model->version->questionnaire_id),
            'Versione ' . $model->version->version_number => array('questionnaireVersion/view', 'id' => $model->version_id),
            'Sezioni' => array('questionnaireSection/index', 'version_id' => $model->version_id),
            $model->title,
        );

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate($version_id)
    {
        $model = new QuestionnaireSection;
        $model->version_id = $version_id;

        if (isset($_POST['QuestionnaireSection'])) {
            $model->attributes = $_POST['QuestionnaireSection'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Sezione creata con successo.');
                $this->redirect(array('questionnaireVersion/view', 'id'=>$version_id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['QuestionnaireSection'])) {
            $model->attributes = $_POST['QuestionnaireSection'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Sezione aggiornata.');
                $this->redirect(array('questionnaireVersion/view', 'id'=>$model->version_id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            $version_id = $model->version_id;
            $model->delete();

            Yii::app()->user->setFlash('success', 'Sezione eliminata.');
            $this->redirect(array('questionnaireVersion/view', 'id'=>$version_id));
        } else {
            throw new CHttpException(400, 'Richiesta non valida.');
        }
    }

    public function actionCreateFull($version_id)
    {
        if (isset($_POST['sections'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                foreach ($_POST['sections'] as $sectionData) {
                    $section = new QuestionnaireSection;
                    $section->attributes = $sectionData; // Assicurati che i campi siano corretti
                    $section->setAttribute('version_id', $version_id);

                    if (!$section->validate() || !$section->save()) {
                        echo CVarDumper::dumpAsString($section->getErrors());exit;
                        throw new Exception('Errore salvataggio sezione: '.$section->title);
                    }

                    if (isset($sectionData['visibility_ruleset'])) {
                        $rulesetData = VisibilityRulesHelper::parseRulesetJson($sectionData['visibility_ruleset']);
                        VisibilityRulesHelper::syncRuleset('section', $section->id, $rulesetData);
                        VisibilityRulesHelper::syncLegacySectionFields($section, $rulesetData);
                        $section->save(false);
                    }

                    if (isset($sectionData['questions'])) {
                        foreach ($sectionData['questions'] as $questionData) {
                            $question = new Question;
                            $question->section_id = $section->id;
                            $this->applyQuestionAttributesFromPost($question, $questionData);

                            if (isset($questionData['visibility_ruleset'])) {
                                $rulesetData = VisibilityRulesHelper::parseRulesetJson($questionData['visibility_ruleset']);
                            } else {
                                $rulesetData = VisibilityRulesHelper::emptyRuleset();
                                if (empty($questionData['condition_question_id']) || empty($questionData['condition_operator']) || empty($questionData['condition_value'])) {
                                    $question->condition_question_id = null;
                                    $question->condition_operator = null;
                                    $question->condition_value = null;
                                }
                            }

                            $this->normalizeQuestionForSave($question);

                            if (!$question->save())
                                throw new Exception('Errore salvataggio domanda: '.$question->text);

                            if (isset($questionData['visibility_ruleset'])) {
                                $this->syncQuestionVisibilityRuleset($question, $rulesetData, $version_id);
                                $question->save(false);
                            }
                            // Gestione opzioni custom
                            if ($question->type === 'custom' && !empty($questionData['custom_options'])) {
                                // Debug temporaneo
                                error_log("DEBUG: Salvataggio opzioni custom per domanda ID " . $question->id);
                                error_log("DEBUG: custom_options ricevuto: " . $questionData['custom_options']);
                                
                                $options = preg_split('/\r?\n/', trim($questionData['custom_options']));
                                $options = array_unique(array_filter(array_map('trim', $options), function($v){ return $v !== ''; }));
                                sort($options, SORT_NATURAL);
                                
                                error_log("DEBUG: Opzioni processate: " . print_r($options, true));
                                
                                $order = 1;
                                foreach ($options as $opt) {
                                    $opt = trim($opt);
                                    if ($opt === '') continue;
                                    $option = new QuestionOption();
                                    $option->question_id = $question->id;
                                    $option->option_text = $opt;
                                    $option->value = $order;
                                    $option->order = $order;
                                    if (!$option->save()) {
                                        error_log("DEBUG: Errore salvataggio opzione: " . print_r($option->getErrors(), true));
                                    } else {
                                        error_log("DEBUG: Opzione salvata con successo: " . $opt);
                                    }
                                    $order++;
                                }
                            } else if ($question->type === 'custom') {
                                error_log("DEBUG: Domanda custom senza opzioni - ID: " . $question->id . ", custom_options: " . (isset($questionData['custom_options']) ? $questionData['custom_options'] : 'NON SET'));
                            }
                        }
                    }
                }
                $transaction->commit();
                Yii::app()->user->setFlash('success', 'Questionario creato con successo.');
                $this->redirect(array('questionnaireVersion/view', 'id'=>$version_id));

            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'Errore: '.$e->getMessage());
            }
        }

        $version = QuestionnaireVersion::model()->with('questionnaire')->findByPk($version_id);
        if (!$version) {
            throw new CHttpException(404, 'Versione non trovata.');
        }

        $catalog = VisibilityRulesHelper::buildCatalogForVersion($version);

        $this->render('createFull', array(
            'version_id' => $version_id,
            'version' => $version,
            'catalog' => $catalog,
        ));
    }

    public function actionEditFull($version_id)
    {
        $version = QuestionnaireVersion::model()->with('questionnaire')->findByPk($version_id);
        if (!$version) throw new CHttpException(404, 'Versione non trovata.');

        $sections = QuestionnaireSection::model()->with('questions')->findAll(array(
            'condition'=>'version_id=:version_id',
            'params'=>array(':version_id'=>$version_id),
            'order'=>'t.order ASC, questions.order ASC'
        ));

        $hasResponses = $version->hasResponses();

        if (isset($_POST['sections']) || isset($_POST['new_sections']) || isset($_POST['new_questions']) || isset($_POST['delete_questions'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if (isset($_POST['sections'])) {
                    foreach ($_POST['sections'] as $section_id => $sectionData) {
                        $section = QuestionnaireSection::model()->findByPk($section_id);
                        if (!$section) continue;

                        $section->attributes = $sectionData;
                        if (!$section->save())
                            throw new Exception('Errore salvataggio sezione '.$section_id.': '.CJSON::encode($section->getErrors()));

                        if (isset($sectionData['visibility_ruleset'])) {
                            $rulesetData = VisibilityRulesHelper::parseRulesetJson($sectionData['visibility_ruleset']);
                            $linearError = VisibilityRulesHelper::validateRulesetLinearOrder(
                                $rulesetData,
                                'section',
                                (int) $section->order,
                                null,
                                (int) $version_id
                            );
                            if ($linearError) {
                                throw new Exception('Sezione "' . $section->title . '": ' . $linearError);
                            }
                            VisibilityRulesHelper::syncRuleset('section', $section->id, $rulesetData);
                            VisibilityRulesHelper::syncLegacySectionFields($section, $rulesetData);
                            $section->save(false);
                        }

                        // Update domande esistenti
                        if (isset($sectionData['questions'])) {
                            foreach ($sectionData['questions'] as $question_id => $questionData) {
                                $question = Question::model()->findByPk($question_id);
                                if (!$question) continue;

                                $this->applyQuestionAttributesFromPost($question, $questionData);

                                if (isset($questionData['visibility_ruleset'])) {
                                    $rulesetData = VisibilityRulesHelper::parseRulesetJson($questionData['visibility_ruleset']);
                                    $this->syncQuestionVisibilityRuleset($question, $rulesetData, $version_id);
                                } else {
                                    // Gestione campi condizionali legacy
                                    if (empty($questionData['condition_question_id']) || empty($questionData['condition_operator']) || empty($questionData['condition_value'])) {
                                        $question->condition_question_id = null;
                                        $question->condition_operator = null;
                                        $question->condition_value = null;
                                        VisibilityRulesHelper::syncRuleset('question', $question->id, VisibilityRulesHelper::emptyRuleset());
                                    }
                                }

                                $this->normalizeQuestionForSave($question);
                                
                                if (!$question->save())
                                    throw new Exception('Errore salvataggio domanda '.$question_id.': '.CJSON::encode($question->getErrors()));
                                // Gestione opzioni custom
                                if ($question->type === 'custom') {
                                    // Debug temporaneo
                                    error_log("DEBUG: Aggiornamento opzioni custom per domanda ID " . $question->id);
                                    error_log("DEBUG: custom_options ricevuto: " . (isset($questionData['custom_options']) ? $questionData['custom_options'] : 'NON SET'));
                                    
                                    QuestionOption::model()->deleteAllByAttributes(['question_id' => $question->id]);
                                    if (!empty($questionData['custom_options'])) {
                                        $options = preg_split('/\r?\n/', trim($questionData['custom_options']));
                                        $options = array_unique(array_filter(array_map('trim', $options), function($v){ return $v !== ''; }));
                                        sort($options, SORT_NATURAL);
                                        
                                        error_log("DEBUG: Opzioni processate: " . print_r($options, true));
                                        
                                        $order = 1;
                                        foreach ($options as $opt) {
                                            $opt = trim($opt);
                                            if ($opt === '') continue;
                                            $option = new QuestionOption();
                                            $option->question_id = $question->id;
                                            $option->option_text = $opt;
                                            $option->value = $order;
                                            $option->order = $order;
                                            if (!$option->save()) {
                                                error_log("DEBUG: Errore salvataggio opzione: " . print_r($option->getErrors(), true));
                                            } else {
                                                error_log("DEBUG: Opzione salvata con successo: " . $opt);
                                            }
                                            $order++;
                                        }
                                    } else {
                                        error_log("DEBUG: Domanda custom senza opzioni - ID: " . $question->id);
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['new_sections'])) {
                    foreach ($_POST['new_sections'] as $tmpSectionId => $sectionData) {
                        $section = new QuestionnaireSection;
                        $section->attributes = $sectionData;
                        $section->setAttribute('version_id', $version_id);
                        if (!$section->save())
                            throw new Exception('Errore salvataggio nuova sezione: '.CJSON::encode($section->getErrors()));

                        if (isset($sectionData['visibility_ruleset'])) {
                            $rulesetData = VisibilityRulesHelper::parseRulesetJson($sectionData['visibility_ruleset']);
                            $linearError = VisibilityRulesHelper::validateRulesetLinearOrder(
                                $rulesetData,
                                'section',
                                (int) $section->order,
                                null,
                                (int) $version_id
                            );
                            if ($linearError) {
                                throw new Exception('Sezione "' . $section->title . '": ' . $linearError);
                            }
                            VisibilityRulesHelper::syncRuleset('section', $section->id, $rulesetData);
                            VisibilityRulesHelper::syncLegacySectionFields($section, $rulesetData);
                            $section->save(false);
                        }

                        // Nuove domande della nuova sezione
                        if (isset($sectionData['questions'])) {
                            foreach ($sectionData['questions'] as $questionData) {
                                $question = new Question;
                                $question->setAttribute('section_id', $section->id);
                                $this->applyQuestionAttributesFromPost($question, $questionData);

                                if (isset($questionData['visibility_ruleset'])) {
                                    $rulesetData = VisibilityRulesHelper::parseRulesetJson($questionData['visibility_ruleset']);
                                } else {
                                    $rulesetData = VisibilityRulesHelper::emptyRuleset();
                                    if (empty($questionData['condition_question_id']) || empty($questionData['condition_operator']) || empty($questionData['condition_value'])) {
                                        $question->condition_question_id = null;
                                        $question->condition_operator = null;
                                        $question->condition_value = null;
                                    }
                                }

                                $this->normalizeQuestionForSave($question);

                                if (!$question->save())
                                    throw new Exception('Errore salvataggio domanda: '.CJSON::encode($question->getErrors()));

                                if (isset($questionData['visibility_ruleset'])) {
                                    $this->syncQuestionVisibilityRuleset($question, $rulesetData, $version_id);
                                    $question->save(false);
                                } elseif (empty($questionData['condition_question_id'])) {
                                    VisibilityRulesHelper::syncRuleset('question', $question->id, VisibilityRulesHelper::emptyRuleset());
                                }
                                
                                // Gestione opzioni custom per nuove domande in nuove sezioni
                                if ($question->type === 'custom' && !empty($questionData['custom_options'])) {
                                    // Debug temporaneo
                                    error_log("DEBUG: Salvataggio opzioni custom per NUOVA domanda in NUOVA sezione ID " . $question->id);
                                    error_log("DEBUG: custom_options ricevuto: " . $questionData['custom_options']);
                                    
                                    $options = preg_split('/\r?\n/', trim($questionData['custom_options']));
                                    $options = array_unique(array_filter(array_map('trim', $options), function($v){ return $v !== ''; }));
                                    sort($options, SORT_NATURAL);
                                    
                                    error_log("DEBUG: Opzioni processate: " . print_r($options, true));
                                    
                                    $order = 1;
                                    foreach ($options as $opt) {
                                        $opt = trim($opt);
                                        if ($opt === '') continue;
                                        $option = new QuestionOption();
                                        $option->question_id = $question->id;
                                        $option->option_text = $opt;
                                        $option->value = $order;
                                        $option->order = $order;
                                        if (!$option->save()) {
                                            error_log("DEBUG: Errore salvataggio opzione: " . print_r($option->getErrors(), true));
                                        } else {
                                            error_log("DEBUG: Opzione salvata con successo: " . $opt);
                                        }
                                        $order++;
                                    }
                                } else if ($question->type === 'custom') {
                                    error_log("DEBUG: NUOVA domanda custom in NUOVA sezione senza opzioni - ID: " . $question->id . ", custom_options: " . (isset($questionData['custom_options']) ? $questionData['custom_options'] : 'NON SET'));
                                }
                            }
                        }
                    }
                }

                if (isset($_POST['new_questions'])) {
                    foreach ($_POST['new_questions'] as $section_id => $questions) {
                        foreach ($questions as $questionData) {
                            $question = new Question;
                            $question->setAttribute('section_id', $section_id);
                            $this->applyQuestionAttributesFromPost($question, $questionData);

                            if (isset($questionData['visibility_ruleset'])) {
                                $rulesetData = VisibilityRulesHelper::parseRulesetJson($questionData['visibility_ruleset']);
                            } else {
                                $rulesetData = VisibilityRulesHelper::emptyRuleset();
                                if (empty($questionData['condition_question_id']) || empty($questionData['condition_operator']) || empty($questionData['condition_value'])) {
                                    $question->condition_question_id = null;
                                    $question->condition_operator = null;
                                    $question->condition_value = null;
                                }
                            }

                            $this->normalizeQuestionForSave($question);

                            if (!$question->save())
                                throw new Exception('Errore salvataggio nuova domanda: '.CJSON::encode($question->getErrors()));

                            if (isset($questionData['visibility_ruleset'])) {
                                $this->syncQuestionVisibilityRuleset($question, $rulesetData, $version_id);
                                $question->save(false);
                            } elseif (empty($questionData['condition_question_id'])) {
                                VisibilityRulesHelper::syncRuleset('question', $question->id, VisibilityRulesHelper::emptyRuleset());
                            }
                            
                            // Gestione opzioni custom per nuove domande
                            if ($question->type === 'custom' && !empty($questionData['custom_options'])) {
                                // Debug temporaneo
                                error_log("DEBUG: Salvataggio opzioni custom per NUOVA domanda ID " . $question->id);
                                error_log("DEBUG: custom_options ricevuto: " . $questionData['custom_options']);
                                
                                $options = preg_split('/\r?\n/', trim($questionData['custom_options']));
                                $options = array_unique(array_filter(array_map('trim', $options), function($v){ return $v !== ''; }));
                                sort($options, SORT_NATURAL);
                                
                                error_log("DEBUG: Opzioni processate: " . print_r($options, true));
                                
                                $order = 1;
                                foreach ($options as $opt) {
                                    $opt = trim($opt);
                                    if ($opt === '') continue;
                                    $option = new QuestionOption();
                                    $option->question_id = $question->id;
                                    $option->option_text = $opt;
                                    $option->value = $order;
                                    $option->order = $order;
                                    if (!$option->save()) {
                                        error_log("DEBUG: Errore salvataggio opzione: " . print_r($option->getErrors(), true));
                                    } else {
                                        error_log("DEBUG: Opzione salvata con successo: " . $opt);
                                    }
                                    $order++;
                                }
                            } else if ($question->type === 'custom') {
                                error_log("DEBUG: NUOVA domanda custom senza opzioni - ID: " . $question->id . ", custom_options: " . (isset($questionData['custom_options']) ? $questionData['custom_options'] : 'NON SET'));
                            }
                        }
                    }
                }

                if (!$hasResponses && isset($_POST['delete_questions'])) {
                    foreach ($_POST['delete_questions'] as $question_id) {
                        $question = Question::model()->findByPk($question_id);
                        if ($question) $question->delete();
                    }
                } elseif ($hasResponses && isset($_POST['delete_questions'])) {
                    throw new Exception('Impossibile eliminare domande: la versione ha compilazioni registrate.');
                }

                $transaction->commit();
                Yii::app()->user->setFlash('success', 'Modifiche salvate con successo.');
                $this->redirect(array('questionnaireVersion/view', 'id'=>$version_id));

            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('error', 'Errore: '.$e->getMessage());
            }
        }

        $catalog = VisibilityRulesHelper::buildCatalogForVersion($version);

        $this->render('editFull', array(
            'version' => $version,
            'sections' => $sections,
            'hasResponses' => $hasResponses,
            'catalog' => $catalog,
        ));
    }


    public function loadModel($id)
    {
        $model = QuestionnaireSection::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Sezione non trovata.');
        return $model;
    }

    /**
     * Applica i dati POST alla domanda gestendo i campi checkbox non inviati se deselezionati.
     */
    private function applyQuestionAttributesFromPost(Question $question, array $questionData)
    {
        $question->attributes = $questionData;

        if ($question->type === 'custom') {
            $question->is_multiple = !empty($questionData['is_multiple']) ? 1 : 0;
        }
    }

    /**
     * Normalizza i campi della domanda in base al tipo prima del salvataggio.
     */
    private function normalizeQuestionForSave(Question $question)
    {
        if ($question->type === 'text') {
            $question->type_render = 'textarea';
            $question->is_multiple = 0;
            return;
        }

        if ($question->type === 'yes_no') {
            $question->is_multiple = 0;
            $question->type_render = 'radio';
            return;
        }

        if (in_array($question->type, array('option', 'range'), true)) {
            $question->type_render = 'radio';
            $question->is_multiple = 0;
            return;
        }

        if ($question->type === 'custom') {
            if (empty($question->type_render)) {
                $question->type_render = $question->is_multiple ? 'checkbox' : 'radio';
            }

            if ($question->type_render === 'radio' && $question->is_multiple) {
                $question->type_render = 'checkbox';
            } elseif ($question->type_render === 'checkbox' && !$question->is_multiple) {
                $question->type_render = 'radio';
            }
        }
    }

    /**
     * Valida e sincronizza il ruleset di visibilità di una domanda.
     *
     * @param Question $question
     * @param array $rulesetData
     * @param int $versionId
     */
    private function syncQuestionVisibilityRuleset(Question $question, array $rulesetData, $versionId)
    {
        $section = $question->section ? $question->section : QuestionnaireSection::model()->findByPk($question->section_id);
        $linearError = VisibilityRulesHelper::validateRulesetLinearOrder(
            $rulesetData,
            'question',
            $section ? (int) $section->order : 0,
            (int) $question->order,
            (int) $versionId
        );
        if ($linearError) {
            throw new Exception('Domanda "' . $question->text . '": ' . $linearError);
        }

        VisibilityRulesHelper::syncRuleset('question', $question->id, $rulesetData);
        VisibilityRulesHelper::syncLegacyQuestionFields($question, $rulesetData);
    }

    /**
     * Action AJAX per ottenere i valori possibili per condition_value
     * in base al campo condition_field selezionato
     */
    public function actionGetConditionValues()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, 'Richiesta non valida.');
        }

        $field = Yii::app()->request->getParam('field');
        $response = array();

        // Mappatura dei campi disponibili con i loro valori possibili
        $fieldValues = array(
            'tipologia_id' => array(
                'type' => 'select',
                'values' => CHtml::listData(TipologiaSoggiorni::model()->findAll(array('order' => 'tipologia ASC')), 'id', 'tipologia')
            ),
            'centro' => array(
                'type' => 'select', 
                'values' => CHtml::listData(Soggiorni::model()->findAll(array('order' => 'nome ASC')), 'id', 'nome')
            ),
            'ente' => array(
                'type' => 'select',
                'values' => CHtml::listData(Clienti::model()->findAll(array('order' => 'nome ASC')), 'id', 'nome')
            ),
            'anno' => array(
                'type' => 'text',
                'placeholder' => 'es. 2024'
            ),
            'eta' => array(
                'type' => 'text',
                'placeholder' => 'es. 18 o 18,25,30'
            ),
            'organizzatore' => array(
                'type' => 'text',
                'placeholder' => 'es. 1 o 1,2,3'
            ),
            'soggiorno' => array(
                'type' => 'text',
                'placeholder' => 'es. 5 o 5,10,15'
            ),
            'turno' => array(
                'type' => 'text',
                'placeholder' => 'es. 1 o 1,2,3'
            )
        );

        if (isset($fieldValues[$field])) {
            $response = $fieldValues[$field];
        } else {
            $response = array(
                'type' => 'text',
                'placeholder' => 'Inserisci valore'
            );
        }

        echo CJSON::encode($response);
        Yii::app()->end();
    }

    /**
     * Valori possibili per una regola di visibilità.
     */
    public function actionGetRuleValueOptions()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, 'Richiesta non valida.');
        }

        $sourceType = Yii::app()->request->getParam('source_type');
        $sourceKey = Yii::app()->request->getParam('source_key');
        $versionId = (int) Yii::app()->request->getParam('version_id');
        $clientId = null;

        if ($versionId) {
            $version = QuestionnaireVersion::model()->with('questionnaire')->findByPk($versionId);
            if ($version && $version->questionnaire) {
                $clientId = $version->questionnaire->client_id;
            }
        }

        if ($sourceType === 'participant_field') {
            $response = VisibilityRulesHelper::getRuleValueOptionsForParticipantField($sourceKey, $clientId);
        } elseif ($sourceType === 'question_answer') {
            $response = VisibilityRulesHelper::getRuleValueOptionsForQuestion((int) $sourceKey);
        } else {
            $response = array('type' => 'text', 'placeholder' => 'Inserisci valore');
        }

        echo CJSON::encode($response);
        Yii::app()->end();
    }
}
