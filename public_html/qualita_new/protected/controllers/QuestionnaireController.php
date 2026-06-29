<?php

class QuestionnaireController extends Controller
{
    public function beforeAction($action)
    {
        // Disabilita il log di debug solo per le azioni di export
        if ($action->id === 'exportSubmissions' || $action->id === 'cloneQuestionnaire') {
            foreach (Yii::app()->log->routes as $route){
                if ($route instanceof CWebLogRoute){
                    $route->enabled = false;
                }
            }
        }

        return true;
    }

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'submissions', 'viewSubmission', 'exportSubmissions', 'documentation', 'deleteSubmissions', 'deleteSingleSubmission', 'getVersions', 'cloneQuestionnaire'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Questionnaire');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Questionnaire;

        // Gestione della validazione AJAX
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionnaire-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // Gestione dell'invio effettivo del form
        if (isset($_POST['Questionnaire'])) {
            $model->attributes = $_POST['Questionnaire'];

            // Gestione upload logo
            if (CUploadedFile::getInstance($model, 'logo')) {
                $file = CUploadedFile::getInstance($model, 'logo');
                $fileName = uniqid('logo_') . '.' . $file->getExtensionName();
                $uploadDir = Yii::getPathOfAlias('webroot') . '/uploads/questionnaire_logos/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $file->saveAs($uploadDir . $fileName);
                $model->logo = $fileName;
            }

            if ($model->save()) {
                // Creazione della prima versione del questionario
                $version = new QuestionnaireVersion;
                $version->questionnaire_id = $model->id;
                $version->version_number = 1;
                if ($version->save()) {
                    Yii::app()->user->setFlash('success', 'Questionario creato con successo.');
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    // Rollback in caso di errore nella creazione della versione
                    $model->delete();
                    Yii::app()->user->setFlash('error', 'Errore nella creazione della versione iniziale.');
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $oldLogo = $model->logo;

        if (isset($_POST['Questionnaire'])) {
            // Rimuovi il campo logo dal POST se non viene caricato un nuovo file
            $postData = $_POST['Questionnaire'];
            $uploadedFile = CUploadedFile::getInstance($model, 'logo');
            
            if (!$uploadedFile) {
                // Se non viene caricato un nuovo file, rimuovi il campo logo dal POST
                unset($postData['logo']);
            }
            
            $model->attributes = $postData;

            // Gestione upload logo
            if ($uploadedFile) {
                // Nuovo logo caricato
                $fileName = uniqid('logo_') . '.' . $uploadedFile->getExtensionName();
                $uploadDir = Yii::getPathOfAlias('webroot') . '/uploads/questionnaire_logos/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadedFile->saveAs($uploadDir . $fileName);
                $model->setAttribute('logo', $fileName);
            }
            else {
                $model->setAttribute('logo', $oldLogo);
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Questionario aggiornato.');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        
        // Verifica se il questionario ha partecipanti (risposte)
        $hasParticipants = QuestionnaireParticipant::model()->exists('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $id));
        
        if ($hasParticipants) {
            Yii::app()->user->setFlash('error', 'Impossibile eliminare questo questionario perché ha già ricevuto risposte. Elimina prima tutte le compilazioni.');
            $this->redirect(array('view', 'id' => $id));
            return;
        }
        
        // Inizia la transazione per garantire l'integrità dei dati
        $transaction = Yii::app()->db->beginTransaction();
        
        try {
            // 1. Elimina tutte le risposte associate alle domande di questo questionario
            $this->deleteQuestionnaireAnswers($id);
            
            // 2. Elimina tutti i partecipanti del questionario
            QuestionnaireParticipant::model()->deleteAll('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $id));
            
            // 3. Elimina tutte le opzioni delle domande
            $this->deleteQuestionnaireOptions($id);
            
            // 4. Elimina tutte le domande
            $this->deleteQuestionnaireQuestions($id);
            
            // 5. Elimina tutte le sezioni
            $this->deleteQuestionnaireSections($id);
            
            // 6. Elimina tutte le versioni
            QuestionnaireVersion::model()->deleteAll('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $id));
            
            // 7. Infine elimina il questionario
            $model->delete();
            
            $transaction->commit();
            Yii::app()->user->setFlash('success', 'Questionario e tutti i dati correlati eliminati con successo.');
            
        } catch (Exception $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('error', 'Errore durante l\'eliminazione del questionario: ' . $e->getMessage());
        }
        
        $this->redirect(array('index'));
    }
    
    /**
     * Elimina tutte le risposte associate alle domande di un questionario
     * @param int $questionnaireId
     */
    private function deleteQuestionnaireAnswers($questionnaireId)
    {
        // Ottieni tutti gli ID delle domande del questionario
        $questionIds = Yii::app()->db->createCommand()
            ->select('q.id')
            ->from('questions q')
            ->join('questionnaire_sections s', 'q.section_id = s.id')
            ->join('questionnaire_versions v', 's.version_id = v.id')
            ->where('v.questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $questionnaireId))
            ->queryColumn();
        
        if (!empty($questionIds)) {
            // Elimina tutte le risposte per queste domande
            Answer::model()->deleteAll('question_id IN (' . implode(',', $questionIds) . ')');
        }
    }
    
    /**
     * Elimina tutte le opzioni delle domande di un questionario
     * @param int $questionnaireId
     */
    private function deleteQuestionnaireOptions($questionnaireId)
    {
        // Ottieni tutti gli ID delle domande del questionario
        $questionIds = Yii::app()->db->createCommand()
            ->select('q.id')
            ->from('questions q')
            ->join('questionnaire_sections s', 'q.section_id = s.id')
            ->join('questionnaire_versions v', 's.version_id = v.id')
            ->where('v.questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $questionnaireId))
            ->queryColumn();
        
        if (!empty($questionIds)) {
            // Elimina tutte le opzioni per queste domande
            QuestionOption::model()->deleteAll('question_id IN (' . implode(',', $questionIds) . ')');
        }
    }
    
    /**
     * Elimina tutte le domande di un questionario
     * @param int $questionnaireId
     */
    private function deleteQuestionnaireQuestions($questionnaireId)
    {
        // Ottieni tutti gli ID delle domande del questionario
        $questionIds = Yii::app()->db->createCommand()
            ->select('q.id')
            ->from('questions q')
            ->join('questionnaire_sections s', 'q.section_id = s.id')
            ->join('questionnaire_versions v', 's.version_id = v.id')
            ->where('v.questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $questionnaireId))
            ->queryColumn();
        
        if (!empty($questionIds)) {
            // Elimina tutte le domande
            Question::model()->deleteAll('id IN (' . implode(',', $questionIds) . ')');
        }
    }
    
    /**
     * Elimina tutte le sezioni di un questionario
     * @param int $questionnaireId
     */
    private function deleteQuestionnaireSections($questionnaireId)
    {
        // Ottieni tutti gli ID delle sezioni del questionario
        $sectionIds = Yii::app()->db->createCommand()
            ->select('s.id')
            ->from('questionnaire_sections s')
            ->join('questionnaire_versions v', 's.version_id = v.id')
            ->where('v.questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $questionnaireId))
            ->queryColumn();
        
        if (!empty($sectionIds)) {
            // Elimina tutte le sezioni
            QuestionnaireSection::model()->deleteAll('id IN (' . implode(',', $sectionIds) . ')');
        }
    }

    public function actionSubmissions($id = null)
    {
        // Crea un'istanza del modello per la ricerca
        $model = new QuestionnaireParticipant('search');
        
        // Filtro per questionario specifico se fornito tramite URL o GET
        $selectedQuestionnaireId = $id ?: (isset($_GET['questionnaire_id']) ? $_GET['questionnaire_id'] : null);
        if ($selectedQuestionnaireId) {
            $model->questionnaire_id = $selectedQuestionnaireId;
        }
        
        // Filtro per versione se specificata
        if (isset($_GET['version_id']) && $_GET['version_id'] !== '') {
            $model->version_id = $_GET['version_id'];
        }
        
        // Usa il metodo search del modello (i filtri data e IP sono gestiti nel modello)
        $dataProvider = $model->search();
        
        // Ottieni tutti i questionari per il filtro
        $questionnaires = Questionnaire::model()->with('client')->findAll(array(
            'order' => 'title ASC'
        ));
        
        // Ottieni le versioni disponibili per il filtro
        $versions = array();
        if ($selectedQuestionnaireId) {
            // Se è selezionato un questionario, mostra solo le sue versioni
            $versions = QuestionnaireVersion::model()->findAll(array(
                'condition' => 'questionnaire_id = :questionnaire_id',
                'params' => array(':questionnaire_id' => $selectedQuestionnaireId),
                'order' => 'version_number DESC'
            ));
        } else {
            // Altrimenti mostra tutte le versioni
            $versions = QuestionnaireVersion::model()->with('questionnaire')->findAll(array(
                'order' => 'questionnaire_id, version_number DESC'
            ));
        }
        
        $this->render('submissions', array(
            'dataProvider' => $dataProvider,
            'questionnaires' => $questionnaires,
            'versions' => $versions,
            'questionnaireId' => $selectedQuestionnaireId,
        ));
    }

    public function actionViewSubmission($id)
    {
        $participant = QuestionnaireParticipant::model()->findByPk($id);
        if (!$participant) {
            throw new CHttpException(404, 'Compilazione non trovata.');
        }
        
        // Carica le risposte del partecipante
        $answers = Answer::model()->findAll(array(
            'condition' => 'participant_id = :participant_id',
            'params' => array(':participant_id' => $id),
            'order' => 'question_id ASC'
        ));
        
        $this->render('viewSubmission', array(
            'participant' => $participant,
            'answers' => $answers,
        ));
    }

    public function actionExportSubmissions($id = null)
    {
        // Verifica se la richiesta è per l'esportazione
        if (!isset($_GET['export'])) {
            throw new CHttpException(400, 'Richiesta non valida.');
        }
        
        $exportType = $_GET['export'];
        if ($exportType !== 'excel' && $exportType !== 'csv') {
            throw new CHttpException(400, 'Tipo di esportazione non valido.');
        }

        $criteria = new CDbCriteria;
        
        // Filtro per questionario specifico se fornito tramite URL o GET
        $selectedQuestionnaireId = $id ?: (isset($_GET['questionnaire_id']) ? $_GET['questionnaire_id'] : null);
        if ($selectedQuestionnaireId) {
            $criteria->compare('t.questionnaire_id', $selectedQuestionnaireId);
        }
        
        // Filtro per versione se specificata
        if (isset($_GET['version_id']) && $_GET['version_id'] !== '') {
            $criteria->compare('version_id', $_GET['version_id']);
        }
        
        // Filtro per data se specificata
        if (isset($_GET['date_from']) && $_GET['date_from'] !== '') {
            $criteria->addCondition('DATE(created_at) >= :date_from');
            $criteria->params[':date_from'] = $_GET['date_from'];
        }
        
        if (isset($_GET['date_to']) && $_GET['date_to'] !== '') {
            $criteria->addCondition('DATE(created_at) <= :date_to');
            $criteria->params[':date_to'] = $_GET['date_to'];
        }
        
        // Filtro per IP se specificato
        if (isset($_GET['ip_address']) && $_GET['ip_address'] !== '') {
            $criteria->addSearchCondition('ip_address', $_GET['ip_address']);
        }
        
        $criteria->order = 't.created_at DESC';
        
        // Carica tutti i partecipanti con le relazioni necessarie
        $participants = QuestionnaireParticipant::model()->with(array('questionnaire' => array('with' => 'client'), 'version'))->findAll($criteria);
        
        if (empty($participants)) {
            Yii::app()->user->setFlash('error', 'Nessun dato da esportare con i filtri applicati.');
            $this->redirect(array('submissions', 'questionnaire_id' => $selectedQuestionnaireId));
        }
        
        // Prepara i dati per l'esportazione
        $exportData = $this->prepareExportData($participants);
        
        // Genera il file in base al tipo richiesto
        if ($exportType === 'excel') {
            $this->generateExcelFile($exportData, $selectedQuestionnaireId);
        } else {
            $this->generateCsvFile($exportData, $selectedQuestionnaireId);
        }
    }

    /**
     * Prepara i dati per l'esportazione Excel
     * @param QuestionnaireParticipant[] $participants
     * @return array
     */
    private function prepareExportData($participants)
    {
        $data = array();
        
        // Ottieni tutte le domande di tutte le versioni per creare le colonne
        $allQuestions = $this->getAllQuestionsForExport($participants);
        
        // Intestazioni base
        $headers = array(
            'ID',
            'Questionario',
            'Cliente',
            'Versione',
            'Nome',
            'Cognome',
            'Email',
            'Telefono',
            'Età',
            'Coordinatore Nome',
            'Coordinatore Cognome',
            'Gruppo',
            'Tipologia Soggiorno',
            'Soggiorno',
            'Turno',
            'Tipo Corso',
            'Titolo Corso',
            'Data Corso',
            'Organizzazione Affiliata',
            'Indirizzo IP',
            'User Agent',
            'Data Compilazione'
        );
        
        // Aggiungi le colonne per ogni domanda
        foreach ($allQuestions as $question) {
            $headers[] = $question['text'];
        }
        
        $data[] = $headers;
        
        foreach ($participants as $participant) {
            // Carica le risposte per questo partecipante con le relazioni delle domande
            $answers = Answer::model()->with('question')->findAll(array(
                'condition' => 'participant_id = :participant_id',
                'params' => array(':participant_id' => $participant->id),
                'order' => 'question_id ASC'
            ));
            
            // Crea un array associativo delle risposte per accesso rapido
            $participantAnswers = array();
            foreach ($answers as $answer) {
                $participantAnswers[$answer->question_id] = $answer;
            }
            
            // Dati base del partecipante
            $row = array(
                $participant->id,
                $participant->questionnaire ? $participant->questionnaire->title : '-',
                $this->getClienteName($participant->questionnaire),
                $participant->version ? 'v' . $participant->version->version_number : '-',
                $participant->name ?: '-',
                $participant->surname ?: '-',
                $participant->email ?: '-',
                $participant->phone ?: '-',
                $participant->age ?: '-',
                $participant->coordinator_name ?: '-',
                $participant->coordinator_surname ?: '-',
                $participant->group_name ?: '-',
                $this->getTipologiaSoggiornoName($participant->tipologia_soggiorno_id),
                $this->getSoggiornoName($participant->soggiorno_id),
                $this->getTurnoName($participant->turno_id),
                $participant->type_course_id ?: '-',
                $participant->title_course_id ?: '-',
                $participant->date_course ?: '-',
                $participant->affiliated_organisation ?: '-',
                $participant->ip_address ?: '-',
                $participant->browser_agent ?: '-',
                DateTimeHelper::formatItalianDateTimeFull($participant->created_at)
            );
            
            // Aggiungi le risposte per ogni domanda
            foreach ($allQuestions as $question) {
                // Cerca la risposta basandosi sul testo della domanda per gestire le clonazioni
                $foundAnswer = null;
                foreach ($participantAnswers as $answer) {
                    if ($answer->question && $answer->question->text === $question['text']) {
                        $foundAnswer = $answer;
                        break;
                    }
                }
                
                if ($foundAnswer) {
                    $row[] = $this->formatAnswerValue($foundAnswer);
                } else {
                    $row[] = ''; // Cella vuota se la domanda non era presente in questa versione
                }
            }
            
            $data[] = $row;
        }
        
        return $data;
    }

    /**
     * Formatta il valore di una risposta per l'esportazione
     * @param Answer $answer
     * @return string
     */
    private function formatAnswerValue($answer)
    {
        if (!$answer->value) {
            return '-';
        }
        
        // Carica la domanda se non è già caricata
        $question = $answer->question;
        if (!$question) {
            $question = Question::model()->findByPk($answer->question_id);
        }
        
        if ($question && in_array($question->type, array('radio', 'checkbox', 'select'))) {
            // Per domande con opzioni, mostra il testo dell'opzione
            $values = explode(',', $answer->value);
            $optionTexts = array();
            foreach ($values as $value) {
                $option = QuestionOption::model()->findByPk(trim($value));
                if ($option) {
                    $optionTexts[] = $option->option_text;
                } else {
                    $optionTexts[] = trim($value);
                }
            }
            return implode(', ', $optionTexts);
        } else {
            return $answer->value;
        }
    }

    /**
     * Ottiene tutte le domande uniche di tutte le versioni per creare le colonne dell'export
     * @param QuestionnaireParticipant[] $participants
     * @return array
     */
    private function getAllQuestionsForExport($participants)
    {
        $questionnaireIds = array();
        
        // Raccogli tutti gli ID di questionari
        foreach ($participants as $participant) {
            if ($participant->questionnaire_id) {
                $questionnaireIds[] = $participant->questionnaire_id;
            }
        }
        
        if (empty($questionnaireIds)) {
            return array();
        }
        
        // Ottieni tutte le domande uniche raggruppando per testo per evitare duplicazioni da clonazione
        $sql = "SELECT MIN(q.id) as id, q.text, q.type, MIN(q.order) as order_num, MIN(s.title) as section_title
                FROM questions q
                INNER JOIN questionnaire_sections s ON q.section_id = s.id 
                INNER JOIN questionnaire_versions v ON s.version_id = v.id
                WHERE v.questionnaire_id IN (" . implode(',', $questionnaireIds) . ")
                AND q.deleted_at IS NULL
                GROUP BY q.text, q.type
                ORDER BY MIN(q.id) ASC";
        
        $questions = Yii::app()->db->createCommand($sql)->queryAll();
        
        $formattedQuestions = array();
        foreach ($questions as $question) {
            $formattedQuestions[] = array(
                'id' => $question['id'],
                'text' => $question['text'],
                'type' => $question['type'],
                'order' => $question['order_num'],
                'section_title' => $question['section_title']
            );
        }
        
        return $formattedQuestions;
    }

    /**
     * Ottiene il nome della tipologia soggiorno
     * @param int $tipologiaId
     * @return string
     */
    private function getTipologiaSoggiornoName($tipologiaId)
    {
        if (!$tipologiaId) {
            return '-';
        }
        
        $tipologia = TipologiaSoggiorni::model()->findByPk($tipologiaId);
        return $tipologia ? $tipologia->tipologia : 'ID: ' . $tipologiaId;
    }

    /**
     * Ottiene il nome del soggiorno
     * @param int $soggiornoId
     * @return string
     */
    private function getSoggiornoName($soggiornoId)
    {
        if (!$soggiornoId) {
            return '-';
        }
        
        $soggiorno = Soggiorni::model()->findByPk($soggiornoId);
        return $soggiorno ? $soggiorno->nome : 'ID: ' . $soggiornoId;
    }

    /**
     * Ottiene il nome del cliente associato al questionario
     * @param Questionnaire $questionnaire
     * @return string
     */
    private function getClienteName($questionnaire)
    {
        if (!$questionnaire || !$questionnaire->client) {
            return '-';
        }
        
        return $questionnaire->client->nome ?: 'ID: ' . $questionnaire->client_id;
    }

    /**
     * Ottiene il nome del turno
     * @param int $turnoId
     * @return string
     */
    private function getTurnoName($turnoId)
    {
        if (!$turnoId) {
            return '-';
        }
        
        // Per ora restituiamo il valore numerico, dato che non abbiamo una relazione diretta
        // In futuro si potrebbe implementare una logica per mappare i valori numerici ai nomi
        return $turnoId ? $turnoId : '-';
    }



    /**
     * Genera il file Excel
     * @param array $data
     * @param int $questionnaireId
     */
    private function generateExcelFile($data, $questionnaireId = null)
    {
        try {
            // Includi la libreria PHPExcel
            require_once(Yii::getPathOfAlias('application.extensions.phpexcel') . '/PHPExcel.php');
            
            $excel = new PHPExcel();
            $excel->setActiveSheetIndex(0);
            $sheet = $excel->getActiveSheet();
            
            // Imposta il titolo del foglio
            $title = $questionnaireId ? 'Compilazioni Questionario' : 'Tutte le Compilazioni';
            $sheet->setTitle($title);
            
            // Stile per le intestazioni
            $headerStyle = array(
                'font' => array(
                    'bold' => true,
                    'color' => array('rgb' => 'FFFFFF'),
                ),
                'fill' => array(
                    'type' => 'solid',
                    'color' => array('rgb' => '4472C4'),
                ),
                'alignment' => array(
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ),
            );
            
            // Popola i dati
            foreach ($data as $rowIndex => $row) {
                foreach ($row as $colIndex => $value) {
                    $cellCoordinate = $this->getColumnLetter($colIndex) . ($rowIndex + 1);
                    // Pulisci il valore per evitare caratteri problematici
                    $cleanValue = $this->cleanExcelValue($value);
                    $sheet->setCellValue($cellCoordinate, $cleanValue);
                    
                    // Applica stile alle intestazioni
                    if ($rowIndex === 0) {
                        $sheet->getStyle($cellCoordinate)->applyFromArray($headerStyle);
                    }
                }
            }
            
            // Auto-dimensiona le colonne
            foreach (range(0, count($data[0]) - 1) as $colIndex) {
                $sheet->getColumnDimension($this->getColumnLetter($colIndex))->setAutoSize(true);
            }
            
            // Imposta il nome del file
            $filename = 'compilazioni_questionari_' . date('Y-m-d_H-i-s');
            if ($questionnaireId) {
                $filename .= '_questionario_' . $questionnaireId;
            }
            $filename .= '.xlsx';
            
            // Imposta gli header per il download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            
            // Salva il file
            $writer = new PHPExcel_Writer_Excel2007($excel);
            $writer->save('php://output');
            
            Yii::app()->end();
            
        } catch (Exception $e) {
            // Log dell'errore
            Yii::log('Errore generazione Excel: ' . $e->getMessage(), 'error');
            
            // Reindirizza con messaggio di errore
            Yii::app()->user->setFlash('error', 'Errore nella generazione del file Excel. Riprova.');
            $this->redirect(array('submissions', 'id' => $questionnaireId));
        }
    }

    public function actionDocumentation()
    {
        $this->render('documentation');
    }
    
    /**
     * Elimina tutte le compilazioni di un questionario specifico
     * @param int $id ID del questionario
     */
    public function actionDeleteSubmissions($id)
    {
        $questionnaire = $this->loadModel($id);
        
        // Verifica se ci sono compilazioni da eliminare
        $participantCount = QuestionnaireParticipant::model()->count('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $id));
        
        if ($participantCount == 0) {
            Yii::app()->user->setFlash('warning', 'Questo questionario non ha compilazioni da eliminare.');
            $this->redirect(array('view', 'id' => $id));
            return;
        }
        
        // Inizia la transazione per garantire l'integrità dei dati
        $transaction = Yii::app()->db->beginTransaction();
        
        try {
            // 1. Elimina tutte le risposte dei partecipanti di questo questionario
            $this->deleteQuestionnaireAnswers($id);
            
            // 2. Elimina tutti i partecipanti del questionario
            $deletedParticipants = QuestionnaireParticipant::model()->deleteAll('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $id));
            
            $transaction->commit();
            
            Yii::app()->user->setFlash('success', "Eliminate con successo {$deletedParticipants} compilazioni e tutte le relative risposte per il questionario '{$questionnaire->title}'.");
            
        } catch (Exception $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('error', 'Errore durante l\'eliminazione delle compilazioni: ' . $e->getMessage());
        }
        
        $this->redirect(array('view', 'id' => $id));
    }
    
    /**
     * Elimina una singola compilazione
     * @param int $id ID della compilazione
     */
    public function actionDeleteSingleSubmission($id)
    {
        $participant = QuestionnaireParticipant::model()->findByPk($id);
        if (!$participant) {
            throw new CHttpException(404, 'Compilazione non trovata.');
        }
        
        $questionnaireId = $participant->questionnaire_id;
        $participantName = $participant->name . ' ' . $participant->surname;
        
        // Inizia la transazione per garantire l'integrità dei dati
        $transaction = Yii::app()->db->beginTransaction();
        
        try {
            // 1. Elimina tutte le risposte del partecipante
            Answer::model()->deleteAll('participant_id = :participant_id', array(':participant_id' => $id));
            
            // 2. Elimina il partecipante
            $participant->delete();
            
            $transaction->commit();
            
            Yii::app()->user->setFlash('success', "Compilazione di '{$participantName}' eliminata con successo.");
            
        } catch (Exception $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('error', 'Errore durante l\'eliminazione della compilazione: ' . $e->getMessage());
        }
        
        // Reindirizza alla pagina delle submissions del questionario
        $this->redirect(array('submissions', 'id' => $questionnaireId));
    }
    
    /**
     * Clona un questionario con una versione specifica
     */
    public function actionCloneQuestionnaire($id)
    {
        try {
            // Imposta il content type per JSON
            header('Content-Type: application/json');
            
            if (!Yii::app()->request->isPostRequest) {
                echo CJSON::encode(array('success' => false, 'message' => 'Richiesta non valida.'));
                Yii::app()->end();
            }
            
            // Carica il questionario originale con gestione errori personalizzata
            $originalQuestionnaire = Questionnaire::model()->findByPk($id);
            if ($originalQuestionnaire === null) {
                echo CJSON::encode(array('success' => false, 'message' => 'Questionario non trovato.'));
                Yii::app()->end();
            }
            $response = array('success' => false, 'errors' => array());
        
        // Validazione dei dati ricevuti
        if (!isset($_POST['Questionnaire']) || !isset($_POST['version_id'])) {
            $response['message'] = 'Dati mancanti per la clonazione.';
            echo CJSON::encode($response);
            Yii::app()->end();
        }
        
        $questionnaireData = $_POST['Questionnaire'];
        $versionId = $_POST['version_id'];
        
        // Validazione campi obbligatori
        $errors = array();
        if (empty($versionId)) {
            $errors['version_id'] = 'Seleziona una versione da clonare.';
        }
        
        // Se ci sono errori di validazione manuale, restituiscili
        if (!empty($errors)) {
            $response['success'] = false;
            $response['errors'] = $errors;
            echo CJSON::encode($response);
            Yii::app()->end();
        }
        
        // Verifica che la versione esista e appartenga al questionario originale
        $version = QuestionnaireVersion::model()->find('id = :id AND questionnaire_id = :questionnaire_id', array(
            ':id' => $versionId,
            ':questionnaire_id' => $id
        ));
        if (!$version) {
            $errors['version_id'] = 'Versione non valida.';
        }
        
        if (!empty($errors)) {
            $response['errors'] = $errors;
            echo CJSON::encode($response);
            Yii::app()->end();
        }
        
        // Inizia la transazione per garantire l'integrità dei dati
        $transaction = Yii::app()->db->beginTransaction();
        
        try {
            // 1. Crea il nuovo questionario
            $newQuestionnaire = new Questionnaire();
            $newQuestionnaire->attributes = $questionnaireData;
            
            // Validazione del modello
            if (!$newQuestionnaire->validate()) {
                // Usa CActiveForm::validate per restituire errori nel formato standard di Yii
                $validationResult = CActiveForm::validate($newQuestionnaire);
                echo $validationResult;
                Yii::app()->end();
            }
            
            if (!$newQuestionnaire->save()) {
                // Per errori di salvataggio, usa il formato personalizzato
                $modelErrors = $newQuestionnaire->getErrors();
                $formattedErrors = $this->formatModelErrors($modelErrors);
                $response['success'] = false;
                $response['errors'] = $formattedErrors;
                echo CJSON::encode($response);
                Yii::app()->end();
            }
            
            // 2. Crea la prima versione del nuovo questionario
            $newVersion = new QuestionnaireVersion();
            $newVersion->questionnaire_id = $newQuestionnaire->id;
            $newVersion->version_number = 1;
            $newVersion->description = 'Clonato da ' . $originalQuestionnaire->title . ' - v' . $version->version_number;
            $newVersion->is_active = 1;
            
            if (!$newVersion->save()) {
                // Per errori di salvataggio, usa il formato personalizzato
                $modelErrors = $newVersion->getErrors();
                $formattedErrors = $this->formatModelErrors($modelErrors);
                $response['success'] = false;
                $response['errors'] = $formattedErrors;
                echo CJSON::encode($response);
                Yii::app()->end();
            }
            
            // 3. Clona le sezioni
            $sections = QuestionnaireSection::model()->findAll(array(
                'condition' => 'version_id = :version_id',
                'params' => array(':version_id' => $versionId),
                'order' => '`order` ASC'
            ));

            $oldToNewQuestionIds = array();
            $newQuestionsWithConditions = array();

            foreach ($sections as $section) {
                $newSection = new QuestionnaireSection();
                $newSection->version_id = $newVersion->id;
                $newSection->title = $section->title;
                $newSection->order = $section->order;
                $newSection->condition_field = $section->condition_field;
                $newSection->condition_operator = $section->condition_operator;
                $newSection->condition_value = $section->condition_value;

                if (!$newSection->save()) {
                    // Per errori di salvataggio, usa il formato personalizzato
                    $modelErrors = $newSection->getErrors();
                    $formattedErrors = $this->formatModelErrors($modelErrors);
                    $response['success'] = false;
                    $response['errors'] = $formattedErrors;
                    echo CJSON::encode($response);
                    Yii::app()->end();
                }

                // 4. Clona le domande della sezione
                $questions = Question::model()->findAll(array(
                    'condition' => 'section_id = :section_id',
                    'params' => array(':section_id' => $section->id),
                    'order' => '`order` ASC'
                ));

                foreach ($questions as $question) {
                    $newQuestion = new Question();
                    $newQuestion->section_id = $newSection->id;
                    $newQuestion->text = $question->text;
                    $newQuestion->type = $question->type;
                    $newQuestion->order = $question->order;
                    $newQuestion->is_multiple = $question->is_multiple;
                    $newQuestion->condition_question_id = $question->condition_question_id;
                    $newQuestion->condition_operator = $question->condition_operator;
                    $newQuestion->condition_value = $question->condition_value;

                    if (!$newQuestion->save()) {
                        // Per errori di salvataggio, usa il formato personalizzato
                        $modelErrors = $newQuestion->getErrors();
                        $formattedErrors = $this->formatModelErrors($modelErrors);
                        $response['success'] = false;
                        $response['errors'] = $formattedErrors;
                        echo CJSON::encode($response);
                        Yii::app()->end();
                    }

                    $oldToNewQuestionIds[$question->id] = $newQuestion->id;
                    if (!empty($question->condition_question_id)) {
                        $newQuestionsWithConditions[] = array(
                            'newQuestionId' => $newQuestion->id,
                            'oldConditionQuestionId' => $question->condition_question_id,
                        );
                    }

                    // 5. Clona le opzioni della domanda (se presenti)
                    if (in_array($question->type, array('radio', 'checkbox', 'select', 'custom'))) {
                        $options = QuestionOption::model()->findAll(array(
                            'condition' => 'question_id = :question_id',
                            'params' => array(':question_id' => $question->id),
                            'order' => '`order` ASC'
                        ));

                        foreach ($options as $option) {
                            $newOption = new QuestionOption();
                            $newOption->question_id = $newQuestion->id;
                            $newOption->option_text = $option->option_text;
                            $newOption->value = $option->value;
                            $newOption->order = $option->order;

                            if (!$newOption->save()) {
                                // Per errori di salvataggio, usa il formato personalizzato
                                $modelErrors = $newOption->getErrors();
                                $formattedErrors = $this->formatModelErrors($modelErrors);
                                $response['success'] = false;
                                $response['errors'] = $formattedErrors;
                                echo CJSON::encode($response);
                                Yii::app()->end();
                            }
                        }
                    }
                }
            }

            // 6. Rimappa i riferimenti condizionali sulle domande clonate
            foreach ($newQuestionsWithConditions as $item) {
                $oldConditionQuestionId = $item['oldConditionQuestionId'];
                if (isset($oldToNewQuestionIds[$oldConditionQuestionId])) {
                    Question::model()->updateByPk(
                        $item['newQuestionId'],
                        array('condition_question_id' => $oldToNewQuestionIds[$oldConditionQuestionId])
                    );
                }
            }

            $transaction->commit();
            
            $response['success'] = true;
            $response['message'] = 'Questionario clonato con successo.';
            $response['redirect_url'] = $this->createUrl('index');
            
        } catch (Exception $e) {
            $transaction->rollback();
            $response['message'] = 'Errore durante la clonazione: ' . $e->getMessage();
            echo CJSON::encode($response);
            Yii::app()->end();
        }
        
        echo CJSON::encode($response);
        Yii::app()->end();
        
    } catch (Exception $e) {
        // Gestione generale degli errori
        header('Content-Type: application/json');
        echo CJSON::encode(array(
            'success' => false, 
            'message' => 'Errore inaspettato: ' . $e->getMessage()
        ));
        Yii::app()->end();
    }
    }

    /**
     * Azione AJAX per ottenere le versioni di un questionario
     */
    public function actionGetVersions()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, 'Richiesta non valida.');
        }
        
        $questionnaireId = Yii::app()->request->getParam('questionnaire_id');
        
        if (!$questionnaireId) {
            echo CJSON::encode(array('options' => '<option value="">Tutte le versioni</option>'));
            return;
        }
        
        $versions = QuestionnaireVersion::model()->findAll(array(
            'condition' => 'questionnaire_id = :questionnaire_id',
            'params' => array(':questionnaire_id' => $questionnaireId),
            'order' => 'version_number DESC'
        ));
        
        $options = '<option value="">Tutte le versioni</option>';
        foreach ($versions as $version) {
            $options .= '<option value="' . $version->id . '">v' . $version->version_number . '</option>';
        }
        
        echo CJSON::encode(array('options' => $options));
    }

    public function loadModel($id)
    {
        $model = Questionnaire::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Questionario non trovato.');
        return $model;
    }

    /**
     * Converte l'indice della colonna in lettera Excel (A, B, C, ...)
     * @param int $columnIndex
     * @return string
     */
    private function getColumnLetter($columnIndex)
    {
        $letter = '';
        while ($columnIndex >= 0) {
            $letter = chr(65 + ($columnIndex % 26)) . $letter;
            $columnIndex = floor($columnIndex / 26) - 1;
        }
        return $letter;
    }

    /**
     * Pulisce un valore per l'esportazione Excel
     * @param string $value
     * @return string
     */
    private function cleanExcelValue($value)
    {
        if (is_null($value)) {
            return '';
        }
        
        // Converti in stringa
        $value = (string) $value;
        
        // Rimuovi caratteri di controllo problematici
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);
        
        // Rimuovi caratteri Unicode problematici
        $value = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $value);
        
        // Limita la lunghezza per evitare problemi
        if (strlen($value) > 32767) {
            $value = substr($value, 0, 32767);
        }
        
        return $value;
    }

    /**
     * Genera il file CSV
     * @param array $data
     * @param int $questionnaireId
     */
    private function generateCsvFile($data, $questionnaireId = null)
    {
        try {
            // Imposta il nome del file
            $filename = 'compilazioni_questionari_' . date('Y-m-d_H-i-s');
            if ($questionnaireId) {
                $filename .= '_questionario_' . $questionnaireId;
            }
            $filename .= '.csv';
            
            // Imposta gli header per il download
            header('Content-Type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            
            // Aggiungi BOM per UTF-8
            echo "\xEF\xBB\xBF";
            
            // Genera il contenuto CSV
            $output = fopen('php://output', 'w');
            
            foreach ($data as $row) {
                $cleanRow = array();
                foreach ($row as $value) {
                    $cleanRow[] = $this->cleanCsvValue($value);
                }
                fputcsv($output, $cleanRow, ';', '"', '\\');
            }
            
            fclose($output);
            Yii::app()->end();
            
        } catch (Exception $e) {
            // Log dell'errore
            Yii::log('Errore generazione CSV: ' . $e->getMessage(), 'error');
            
            // Reindirizza con messaggio di errore
            Yii::app()->user->setFlash('error', 'Errore nella generazione del file CSV. Riprova.');
            $this->redirect(array('submissions', 'id' => $questionnaireId));
        }
    }

    /**
     * Pulisce un valore per l'esportazione CSV
     * @param string $value
     * @return string
     */
    private function cleanCsvValue($value)
    {
        if (is_null($value)) {
            return '';
        }
        
        // Converti in stringa
        $value = (string) $value;
        
        // Rimuovi caratteri di controllo problematici
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);
        
        return $value;
    }
    
    /**
     * Formatta gli errori del modello per il frontend
     * @param array $modelErrors
     * @return array
     */
    private function formatModelErrors($modelErrors)
    {
        $formattedErrors = array();
        foreach ($modelErrors as $field => $errors) {
            if (is_array($errors) && !empty($errors)) {
                $formattedErrors[$field] = $errors[0]; // Prendi solo il primo errore
            }
        }
        return $formattedErrors;
    }
}
