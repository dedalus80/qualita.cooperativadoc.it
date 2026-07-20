<?php
/**
 * Controller: QuestionnaireController (modulo Questionnaire)
 * Action: actionFill($slug)
 * - Recupera questionario tramite slug
 * - Mostra form compilabile con layout Bootstrap 5
 */

// Import delle librerie necessarie
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/lib/libreria_html2pdf/_tcpdf_5.0.002/tcpdf.php');
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/vendor/phpmailer/phpmailer/src/SMTP.php');
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/vendor/phpmailer/phpmailer/src/Exception.php');

// Definizioni TCPDF se non già definite
if (!defined('PDF_PAGE_ORIENTATION')) define('PDF_PAGE_ORIENTATION', 'P');
if (!defined('PDF_UNIT')) define('PDF_UNIT', 'mm');
if (!defined('PDF_PAGE_FORMAT')) define('PDF_PAGE_FORMAT', 'A4');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class QuestionnaireController extends CController
{
    public $customFooter = null;

    public function actionFill($slug)
    {
        $this->layout = 'main_survey_parents';

        $questionnaire = Questionnaire::model()->findByAttributes(['slug' => $slug]);
        if (!$questionnaire || !$questionnaire->activeVersion) {
            throw new CHttpException(404, 'Questionario non trovato.');
        }

        // Controllo se il questionario è pubblico
        if (!$questionnaire->is_public) {
            throw new CHttpException(404, 'Questionario non disponibile.');
        }

        $version = $questionnaire->activeVersion;
        $sections = QuestionnaireSection::model()->with([
            'questions' => [
                'order' => 'questions.order ASC',
                'with' => ['options' => ['order' => 'options.order ASC']]
            ]
        ])->findAll([
            'condition' => 'version_id = :vid',
            'params' => [':vid' => $version->id],
            'order' => 't.order ASC'
        ]);

        $tipologie = TipologiaSoggiorni::model()->with('tipologia')
            ->findAll([
                'condition'=>'tipologia.cliente_id = :cliente',
                'params' => [':cliente' => $questionnaire->client_id],
                'order'=>'t.tipologia'
            ]);

        // Dati specifici per questionari di tipo Formazione (F)
        $courseTypes = array();
        $courseTitles = array();
        $courseCategories = array(
            'SOCI' => 'SOCI',
            'APERTA A TUTTI' => 'APERTA A TUTTI',
        );
        $courseTitlesByCategory = array(
            'SOCI' => array(),
            'APERTA A TUTTI' => array(),
        );
        $courseTitlesByCategoryOptions = array(
            'SOCI' => array(),
            'APERTA A TUTTI' => array(),
        );
        $selectedCourseCategory = isset($_POST['course_category']) ? trim($_POST['course_category']) : '';
        if ($questionnaire->questionnaire_type === 'F') {
            // Tipologie corso
            $courseTypeRows = Yii::app()->db->createCommand()
                ->select('id, nome')
                ->from('doc_tipologie_formazione')
                ->where('attivo = :active', array(':active' => 'Y'))
                ->order('nome')
                ->queryAll();
            if (!empty($courseTypeRows)) {
                $courseTypes = CHtml::listData($courseTypeRows, 'id', 'nome');
            }

            // Titoli corso
            $courseTitleRows = Yii::app()->db->createCommand()
                ->select('id, titolo_corso AS nome, categoria')
                ->from('doc_formazione_titolo_corsi')
                ->where('attivo = :active', array(':active' => 'Y'))
                ->order('nome')
                ->queryAll();
            if (!empty($courseTitleRows)) {
                foreach ($courseTitleRows as $courseTitleRow) {
                    if (in_array($courseTitleRow['categoria'], array('SOCI', 'ENTRAMBI'), true)) {
                        $courseTitlesByCategory['SOCI'][$courseTitleRow['id']] = $courseTitleRow['nome'];
                        $courseTitlesByCategoryOptions['SOCI'][] = array(
                            'id' => $courseTitleRow['id'],
                            'nome' => $courseTitleRow['nome'],
                        );
                    }

                    if (in_array($courseTitleRow['categoria'], array('APERTA A TUTTI', 'ENTRAMBI'), true)) {
                        $courseTitlesByCategory['APERTA A TUTTI'][$courseTitleRow['id']] = $courseTitleRow['nome'];
                        $courseTitlesByCategoryOptions['APERTA A TUTTI'][] = array(
                            'id' => $courseTitleRow['id'],
                            'nome' => $courseTitleRow['nome'],
                        );
                    }
                }
            }

            if (!empty($selectedCourseCategory) && isset($courseTitlesByCategory[$selectedCourseCategory])) {
                $courseTitles = $courseTitlesByCategory[$selectedCourseCategory];
            }
        }

        $participant = new QuestionnaireParticipant();

        if (isset($_POST['Answer'])) {
            // Verifica reCAPTCHA v3
            if (!$this->verifyRecaptcha()) {
                Yii::app()->user->setFlash('error', 'Verifica di sicurezza fallita. Riprova.');
            } else {
                // Imposta lo scenario di validazione PRIMA di assegnare gli attributi
                $participant->setValidationScenario($questionnaire->questionnaire_type);
                
                // Assegna i dati del partecipante solo se presenti
                if (isset($_POST['QuestionnaireParticipant'])) {
                    $participant->attributes = $_POST['QuestionnaireParticipant'];

                }
                
                $participant->setAttribute('questionnaire_id', $questionnaire->id);
                $participant->setAttribute('version_id', $version->id);
                
                // Assegna automaticamente i dati di audit
                $participant->setAttribute('ip_address', $this->getClientIp());
                $participant->setAttribute('browser_agent', $this->getBrowserAgent());

                $selectedTypeCourseId = $participant->type_course_id;
                $selectedTitleCourseId = $participant->title_course_id;
                $mappedTypeCourse = null;
                $mappedTitleCourse = null;
                $isValid = $participant->validate();

                if ($questionnaire->questionnaire_type === 'F') {
                    if (empty($selectedCourseCategory) || !isset($courseCategories[$selectedCourseCategory])) {
                        $participant->addError('title_course_id', 'Seleziona la categoria del corso.');
                        $isValid = false;
                    }

                    if (!empty($selectedTypeCourseId)) {
                        if (isset($courseTypes[$selectedTypeCourseId])) {
                            $mappedTypeCourse = $courseTypes[$selectedTypeCourseId];
                        } else {
                            $participant->addError('type_course_id', 'Seleziona una tipologia corso valida.');
                            $isValid = false;
                        }
                    }

                    if (!empty($selectedTitleCourseId)) {
                        if (!empty($selectedCourseCategory) && isset($courseTitlesByCategory[$selectedCourseCategory][$selectedTitleCourseId])) {
                            $mappedTitleCourse = $courseTitlesByCategory[$selectedCourseCategory][$selectedTitleCourseId];
                        } else {
                            $participant->addError('title_course_id', 'Seleziona un titolo corso valido per la categoria scelta.');
                            $isValid = false;
                        }
                    }
                }

                if ($isValid) {
                    if ($mappedTypeCourse !== null) {
                        $participant->type_course_id = $mappedTypeCourse;
                    }

                    if ($mappedTitleCourse !== null) {
                        $participant->title_course_id = $mappedTitleCourse;
                    }
                }

                if ($isValid && $participant->save(false)) {
                        $answersToSave = $this->filterSubmittedAnswers($_POST['Answer'], $sections, $participant, $_POST);
                        foreach ($answersToSave as $questionId => $value) {
                            $answer = new Answer();
                            $answer->setAttribute('participant_id', $participant->id);
                            $answer->setAttribute('question_id', $questionId);
                            $answer->setAttribute('questionnaire_version_id', $version->id);
                            $answer->setAttribute('value', is_array($value) ? implode(',', $value) : $value);
                            $answer->save();
                        }

                        // Invia email con PDF se è configurata l'email di notifica
                        if (!empty($questionnaire->email_notification)) {
                            $this->sendQuestionnaireResultsEmail($questionnaire, $participant, $sections);
                        }

                        // Store questionnaire information in session for thank you page
                        Yii::app()->session['completed_questionnaire'] = [
                            'id' => $questionnaire->id,
                            'title' => $questionnaire->title,
                            'logo' => $questionnaire->logo,
                            'client_id' => $questionnaire->client_id,
                            'footer_description' => $questionnaire->footer_description,
                            'email_contact' => $questionnaire->email_contact,
                        ];

                    $this->redirect(['default/thankyou']);
                }
                else {
                    // Se la validazione fallisce, mostra gli errori
                    Yii::app()->user->setFlash('error', 'Si sono verificati errori nella compilazione del form.');
                }
            }
        }

        // Passa tutte le sezioni alla vista (il JavaScript gestirà la visibilità)
        if (!empty($questionnaire->footer_description)) {
            $footerHtml = '';
            if (!empty($questionnaire->logo)) {
                $logoUrl = CHtml::encode($questionnaire->getLogoUrl());
                $footerHtml = '<div class="row align-items-center justify-content-center p-3">
                    <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                        <img class="d-block mx-auto mb-4" src="' . $logoUrl . '" alt="Logo" width="150">
                    </div>
                    <div class="col-12 col-md-8 text-center text-md-start">
                        <div class="text-muted small">' . nl2br(CHtml::encode($questionnaire->footer_description)) . '</div>
                    </div>
                </div>';
            } else {
                $footerHtml = '<div class="row p-3"><div class="col-12 text-center"><div class="text-muted small">' . nl2br(CHtml::encode($questionnaire->footer_description)) . '</div></div></div>';
            }
            $this->customFooter = $footerHtml;
        }
        
        $this->render('fill', [
            'questionnaire' => $questionnaire,
            'version' => $version,
            'sections' => $sections,
            'participant' => $participant,
            'tipologie' => $tipologie,
            'courseTypes' => $courseTypes,
            'courseTitles' => $courseTitles,
            'courseCategories' => $courseCategories,
            'courseTitlesByCategory' => $courseTitlesByCategory,
            'courseTitlesByCategoryOptions' => $courseTitlesByCategoryOptions,
            'selectedCourseCategory' => $selectedCourseCategory,
        ]);
    }

    /**
     * Filtra le risposte inviate mantenendo solo domande visibili.
     *
     * @param array $submittedAnswers
     * @param QuestionnaireSection[] $sections
     * @param QuestionnaireParticipant $participant
     * @return array
     */
    private function filterSubmittedAnswers(array $submittedAnswers, array $sections, QuestionnaireParticipant $participant, array $post = array())
    {
        // Costruisce l'insieme degli id di domande valide per questa versione
        $validQuestionIds = array();
        foreach ($sections as $section) {
            foreach ($section->questions as $question) {
                $validQuestionIds[$question->id] = true;
            }
        }

        // Mantieni solo le risposte che appartengono a domande reali della versione
        $filtered = array();
        foreach ($submittedAnswers as $questionId => $value) {
            if (isset($validQuestionIds[$questionId])) {
                $filtered[$questionId] = $value;
            }
        }

        return $filtered;
    }

    /**
     * Costruisce il contesto partecipante per la valutazione delle regole di visibilità.
     *
     * @param QuestionnaireParticipant $participant
     * @param array $post
     * @return array
     */
    private function buildParticipantVisibilityContext(QuestionnaireParticipant $participant, array $post = array())
    {
        $context = array(
            'tipologia_soggiorno_id' => $participant->tipologia_soggiorno_id,
            'tipologia_id' => $participant->tipologia_soggiorno_id,
            'soggiorno_id' => $participant->soggiorno_id,
            'centro' => $participant->soggiorno_id,
            'soggiorno' => $participant->soggiorno_id,
            'age' => $participant->age,
            'eta' => $participant->age,
            'turno_id' => $participant->turno_id,
            'turno' => $participant->turno_id,
            'name' => $participant->name,
            'surname' => $participant->surname,
            'email' => $participant->email,
            'phone' => $participant->phone,
            'group_name' => $participant->group_name,
            'coordinator_name' => $participant->coordinator_name,
            'coordinator_surname' => $participant->coordinator_surname,
            'date_course' => $participant->date_course,
            'type_course_id' => $participant->type_course_id,
            'title_course_id' => $participant->title_course_id,
            'affiliated_organisation' => $participant->affiliated_organisation,
            'anno' => date('Y'),
        );

        if (isset($post['course_category'])) {
            $context['course_category'] = $post['course_category'];
        }

        return $context;
    }

    /**
     * Filtra le sezioni in base alle condizioni definite
     * @param QuestionnaireSection[] $sections
     * @param QuestionnaireParticipant $participant
     * @return QuestionnaireSection[]
     */
    private function filterSectionsByConditions($sections, $participant)
    {
        $filteredSections = [];
        
        foreach ($sections as $section) {
            $ruleset = $section->getVisibilityRulesetData();
            if (empty($ruleset['enabled'])) {
                $filteredSections[] = $section;
                continue;
            }

            $shouldShow = $this->evaluateCondition($section, $participant);
            if ($shouldShow) {
                $filteredSections[] = $section;
            }
        }
        
        return $filteredSections;
    }

    /**
     * Valuta se una sezione deve essere mostrata in base alle condizioni
     * @param QuestionnaireSection $section
     * @param QuestionnaireParticipant $participant
     * @return bool
     */
    private function evaluateCondition($section, $participant)
    {
        $ruleset = $section->getVisibilityRulesetData();
        $participantContext = array(
            'tipologia_soggiorno_id' => $participant->tipologia_soggiorno_id,
            'tipologia_id' => $participant->tipologia_soggiorno_id,
            'soggiorno_id' => $participant->soggiorno_id,
            'age' => $participant->age,
            'eta' => $participant->age,
            'turno_id' => $participant->turno_id,
            'anno' => date('Y'),
        );

        return VisibilityRulesEvaluator::evaluate($ruleset, array(
            'participant' => $participantContext,
            'answers' => array(),
        ));
    }

    /**
     * Ottiene il valore di un campo dal partecipante
     * @param QuestionnaireParticipant $participant
     * @param string $field
     * @return mixed|null
     */
    private function getParticipantFieldValue($participant, $field)
    {
        // Mappatura dei campi condition_field ai campi del partecipante
        $fieldMapping = [
            'tipologia_id' => 'tipologia_soggiorno_id',
            'centro' => 'soggiorno_id',
            'ente' => 'questionnaire.client_id',
            'anno' => 'created_at', // Anno di creazione
            'eta' => 'age',
            'organizzatore' => 'organizzatore_id', // Se esiste
            'soggiorno' => 'soggiorno_id',
            'turno' => 'turno_id'
        ];

        $participantField = isset($fieldMapping[$field]) ? $fieldMapping[$field] : $field;
        
        // Gestione campi speciali
        if ($participantField === 'created_at') {
            return date('Y'); // Anno corrente per ora
        }
        
        if ($participantField === 'questionnaire.client_id') {
            return $participant->questionnaire_id ? Questionnaire::model()->findByPk($participant->questionnaire_id)->client_id : null;
        }

        // Verifica se il campo esiste nel modello
        if (property_exists($participant, $participantField)) {
            return $participant->$participantField;
        }

        return null;
    }

    /**
     * Genera l'array delle condizioni delle sezioni per il JavaScript
     * @param QuestionnaireSection[] $sections
     * @return array
     */
    public function getSectionConditions($sections)
    {
        $conditions = [];
        
        foreach ($sections as $section) {
            $ruleset = $section->getVisibilityRulesetData();
            if (!empty($ruleset['enabled'])) {
                $conditions[] = array(
                    'sectionId' => $section->id,
                    'ruleset' => $ruleset,
                );
            }
        }
        
        return $conditions;
    }

    /**
     * Verifica il token reCAPTCHA v3
     * @return bool
     */
    private function verifyRecaptcha()
    {
        $recaptcha_token = isset($_POST['recaptcha_token']) ? $_POST['recaptcha_token'] : '';
        
        if (empty($recaptcha_token)) {
            return false;
        }

        $recaptcha_secret = '6LegKYYrAAAAAF8rePXtjidDi6akB0d2jwBYXaCR'; // Chiave segreta reCAPTCHA v3
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        
        $data = [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($recaptcha_url, false, $context);
        
        if ($response === false) {
            return false;
        }

        $result = json_decode($response, true);
        
        // Verifica che la risposta sia valida e il punteggio sia accettabile (>= 0.5)
        return isset($result['success']) && $result['success'] === true && 
               isset($result['score']) && $result['score'] >= 0.5;
    }

    /**
     * Ottiene l'indirizzo IP del client
     * @return string
     */
    private function getClientIp()
    {
        // Controlla prima gli header proxy comuni
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        // Fallback all'IP remoto
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
    }

    /**
     * Ottiene il browser agent del client
     * @return string
     */
    private function getBrowserAgent()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';
    }

    /**
     * Genera un PDF con i risultati del questionario
     * @param Questionnaire $questionnaire
     * @param QuestionnaireParticipant $participant
     * @param QuestionnaireSection[] $sections
     * @return string
     */
    private function generateQuestionnairePDF($questionnaire, $participant, $sections)
    {
        // Crea un nuovo documento PDF con supporto UTF-8
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Imposta le informazioni del documento
        $pdf->SetCreator('Sistema Questionari');
        $pdf->SetAuthor('Sistema Questionari');
        $pdf->SetTitle('Risultati Questionario: ' . $questionnaire->title);
        $pdf->SetSubject('Risultati Questionario');
        
        // Rimuovi header e footer di default
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Imposta i margini
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(TRUE, 15);
        
        // Aggiungi una pagina
        $pdf->AddPage();
        
                        // Aggiungi il logo del questionario
                $logoPath = $this->getQuestionnaireLogoPath($questionnaire);
                if ($logoPath && file_exists($logoPath)) {
                    // Calcola le dimensioni del logo (max 50mm di larghezza)
                    $logoWidth = 50;
                    $logoHeight = 0;

                    // Ottieni le dimensioni dell'immagine
                    $imageInfo = getimagesize($logoPath);
                    if ($imageInfo) {
                        $aspectRatio = $imageInfo[0] / $imageInfo[1];
                        $logoHeight = $logoWidth / $aspectRatio;
                    }

                    // Calcola la posizione X per centrare il logo
                    $logoX = ($pdf->GetPageWidth() - $logoWidth) / 2;
                    
                    // Posiziona il logo centrato in alto
                    $pdf->Image($logoPath, $logoX, 15, $logoWidth, $logoHeight);

                    // Posiziona il titolo sotto al logo
                    $pdf->SetY(15 + $logoHeight + 10); // 10mm di spazio tra logo e titolo
                    $pdf->SetFont('helvetica', 'B', 16);
                    $pdf->Cell(0, 10, 'Risultati Questionario: ' . $questionnaire->title, 0, 1, 'C');

                    // Posiziona il cursore sotto il titolo per il contenuto successivo
                    $pdf->Ln(10);
                } else {
                    // Se non c'è logo, centra il titolo
                    $pdf->SetFont('helvetica', 'B', 16);
                    $pdf->Cell(0, 10, 'Risultati Questionario: ' . $questionnaire->title, 0, 1, 'C');
                    $pdf->Ln(10);
                }
        
        $pdf->Ln(5);
        
        // Informazioni partecipante
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, 'Dati Partecipante:', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);
        
        // Dati anagrafici
        if (!empty($participant->name)) {
            $pdf->Cell(0, 6, 'Nome: ' . $participant->name, 0, 1, 'L');
        }
        if (!empty($participant->surname)) {
            $pdf->Cell(0, 6, 'Cognome: ' . $participant->surname, 0, 1, 'L');
        }
        if (!empty($participant->age)) {
            $pdf->Cell(0, 6, 'Età: ' . $participant->age, 0, 1, 'L');
        }

        // Dati del corso (per questionari Formazione - tipo F)
        if (!empty($participant->type_course_id)) {
            $pdf->Cell(0, 6, 'Tipologia corso: ' . $participant->type_course_id, 0, 1, 'L');
        }
        if (!empty($participant->title_course_id)) {
            $pdf->Cell(0, 6, 'Titolo corso: ' . $participant->title_course_id, 0, 1, 'L');
        }
        if (!empty($participant->date_course)) {
            $formattedDate = date('d/m/Y', strtotime($participant->date_course));
            $pdf->Cell(0, 6, 'Data corso: ' . $formattedDate, 0, 1, 'L');
        }
        if (!empty($participant->affiliated_organisation)) {
            $pdf->Cell(0, 6, 'Ente/organizzazione: ' . $participant->affiliated_organisation, 0, 1, 'L');
        }
        
        // Dati di contatto
        if (!empty($participant->email)) {
            $pdf->Cell(0, 6, 'Email: ' . $participant->email, 0, 1, 'L');
        }
        if (!empty($participant->phone)) {
            $pdf->Cell(0, 6, 'Telefono: ' . $participant->phone, 0, 1, 'L');
        }
        
        // Dati del coordinatore (per questionari SP/SG)
        if (!empty($participant->coordinator_name)) {
            $pdf->Cell(0, 6, 'Nome Coordinatore: ' . $participant->coordinator_name, 0, 1, 'L');
        }
        if (!empty($participant->coordinator_surname)) {
            $pdf->Cell(0, 6, 'Cognome Coordinatore: ' . $participant->coordinator_surname, 0, 1, 'L');
        }
        
        // Dati del gruppo (per questionari SP)
        if (!empty($participant->group_name)) {
            $pdf->Cell(0, 6, 'Nome Gruppo: ' . $participant->group_name, 0, 1, 'L');
        }
        
        // Dati del soggiorno (per questionari SP/SG)
        if (!empty($participant->tipologia_soggiorno_id)) {
            // Ottieni il nome della tipologia
            $tipologia = TipologiaSoggiorni::model()->findByPk($participant->tipologia_soggiorno_id);
            if ($tipologia && !empty($tipologia->tipologia)) {
                $pdf->Cell(0, 6, 'Tipologia Soggiorno: ' . $tipologia->tipologia, 0, 1, 'L');
            } else {
                $pdf->Cell(0, 6, 'Tipologia Soggiorno ID: ' . $participant->tipologia_soggiorno_id, 0, 1, 'L');
            }
        }
        
        if (!empty($participant->soggiorno_id)) {
            // Ottieni il nome del soggiorno
            $soggiorno = Soggiorni::model()->findByPk($participant->soggiorno_id);
            if ($soggiorno && !empty($soggiorno->nome)) {
                $pdf->Cell(0, 6, 'Soggiorno: ' . $soggiorno->nome, 0, 1, 'L');
            } else {
                $pdf->Cell(0, 6, 'Soggiorno ID: ' . $participant->soggiorno_id, 0, 1, 'L');
            }
        }
        
        if (!empty($participant->turno_id)) {
            $pdf->Cell(0, 6, 'Turno: ' . $participant->turno_id, 0, 1, 'L');
        }
        
        // Data compilazione
        $pdf->Cell(0, 6, 'Data compilazione: ' . date('d/m/Y H:i'), 0, 1, 'L');
        $pdf->Ln(10);

        // Risposte alle domande
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Risposte alle Domande', 0, 1, 'L');
        $pdf->Ln(5);

        foreach ($sections as $section) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 8, $section->title, 0, 1, 'L');
            $pdf->SetFont('helvetica', '', 10);
            
            foreach ($section->questions as $question) {
                $pdf->Cell(0, 6, 'Domanda: ' . $question->text, 0, 1, 'L');
                
                // Ottieni la risposta
                $answer = Answer::model()->findByAttributes([
                    'question_id' => $question->id,
                    'participant_id' => $participant->id
                ]);
                
                if ($answer) {
                    $pdf->Cell(0, 6, 'Risposta: ' . $answer->value, 0, 1, 'L');
                } else {
                    $pdf->Cell(0, 6, 'Risposta: Non fornita', 0, 1, 'L');
                }
                $pdf->Ln(3);
            }
            $pdf->Ln(5);
        }

        // Genera il PDF come stringa
        return $pdf->Output('', 'S');
    }

    /**
     * Ottiene il percorso del logo del questionario
     * @param Questionnaire $questionnaire
     * @return string|null
     */
    private function getQuestionnaireLogoPath($questionnaire)
    {
        if (!empty($questionnaire->logo)) {
            // Percorso del logo personalizzato del questionario
            $logoPath = Yii::getPathOfAlias('webroot.') . '/uploads/questionnaire_logos/' . $questionnaire->logo;
            
            if (file_exists($logoPath)) {
                return $logoPath;
            }
        }
        
        // Logo di fallback
        $fallbackLogoPath = Yii::getPathOfAlias('webroot.') . '/images/survey/keluar_logo_21.png';
        if (file_exists($fallbackLogoPath)) {
            return $fallbackLogoPath;
        }
        
        return null;
    }

    /**
     * Invia l'email di notifica con il PDF dei risultati
     * @param Questionnaire $questionnaire
     * @param QuestionnaireParticipant $participant
     * @param QuestionnaireSection[] $sections
     * @return bool
     */
    private function sendQuestionnaireResultsEmail($questionnaire, $participant, $sections)
    {
        try {
            $mailer = new PHPMailer(true);
            
            // Configurazione SMTP di base (puoi personalizzare questi parametri)
            $mailer->isSMTP();
            $mailer->Host = 'smtp.office365.com'; // Modifica con il tuo server SMTP
            $mailer->SMTPAuth = true; // Imposta a true se richiede autenticazione
            $mailer->Port = 587; // Porta SMTP standard
            
            // Se hai bisogno di autenticazione SMTP, decommenta e configura:
            $mailer->Username = 'noreply@cooperativadoc.it';//'recuperopassword@cooperativadoc.it';
            $mailer->Password = 'Q^682722741895on';//'EFlqa693';
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            
            // Per Gmail, usa:
            // $mailer->Host = 'smtp.gmail.com';
            // $mailer->SMTPAuth = true;
            // $mailer->Username = 'your_email@gmail.com';
            // $mailer->Password = 'your_app_password';
            // $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // $mailer->Port = 587;
            
            // Mittente
            $mailer->setFrom('noreply@cooperativadoc.it', 'Sistema Questionari');
            
            // Destinatario
            $mailer->addAddress($questionnaire->email_notification);
            
            // Contenuto dell'email
            $mailer->isHTML(true);
            $mailer->CharSet = 'UTF-8';
            $mailer->Encoding = 'base64';
            $mailer->Subject = '=?UTF-8?B?' . base64_encode('Nuovo questionario compilato: ' . $questionnaire->title) . '?=';
            
            // Corpo dell'email
            $emailBody = '<!DOCTYPE html>';
            $emailBody .= '<html lang="it">';
            $emailBody .= '<head>';
            $emailBody .= '<meta charset="UTF-8">';
            $emailBody .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
            $emailBody .= '</head>';
            $emailBody .= '<body>';
            $emailBody .= '<h2>Nuovo questionario compilato</h2>';
            $emailBody .= '<p><strong>Questionario:</strong> ' . htmlspecialchars($questionnaire->title, ENT_QUOTES, 'UTF-8') . '</p>';
            $emailBody .= '<p><strong>Data compilazione:</strong> ' . date('d/m/Y H:i:s') . '</p>';
            
            if (!empty($participant->name)) {
                $emailBody .= '<p><strong>Nome:</strong> ' . htmlspecialchars($participant->name, ENT_QUOTES, 'UTF-8') . '</p>';
            }
            if (!empty($participant->surname)) {
                $emailBody .= '<p><strong>Cognome:</strong> ' . htmlspecialchars($participant->surname, ENT_QUOTES, 'UTF-8') . '</p>';
            }
            if (!empty($participant->email)) {
                $emailBody .= '<p><strong>Email partecipante:</strong> ' . htmlspecialchars($participant->email, ENT_QUOTES, 'UTF-8') . '</p>';
            }
            if (!empty($participant->phone)) {
                $emailBody .= '<p><strong>Telefono:</strong> ' . htmlspecialchars($participant->phone, ENT_QUOTES, 'UTF-8') . '</p>';
            }
            
            $emailBody .= '<p>In allegato trovi il PDF con tutte le risposte dettagliate.</p>';
            $emailBody .= '<p>Cordiali saluti,<br>Sistema Questionari</p>';
            $emailBody .= '</body>';
            $emailBody .= '</html>';
            
            $mailer->Body = $emailBody;
            
            // Genera e allega il PDF
            $pdfContent = $this->generateQuestionnairePDF($questionnaire, $participant, $sections);
            $pdfFilename = 'questionario_' . $questionnaire->slug . '_' . date('Y-m-d_H-i-s') . '.pdf';
            $mailer->addStringAttachment($pdfContent, $pdfFilename, 'base64', 'application/pdf');
            
            // Invia l'email
            $mailer->send();
            
            Yii::log('Email di notifica inviata con successo a: ' . $questionnaire->email_notification, 'info');
            return true;
            
        } catch (Exception $e) {
            Yii::log('Errore durante l\'invio dell\'email di notifica: ' . $e->getMessage(), 'error');
            return false;
        }
    }

    /**
     * Action di test per visualizzare il PDF di un questionario compilato
     * @param integer $id ID del questionario compilato (participant_id)
     */
    public function actionTestPdf($id)
    {
        // Verifica che l'utente sia autenticato e abbia i permessi
        if (!Yii::app()->user->isGuest) {
            
            // Carica il questionario compilato
            $participant = QuestionnaireParticipant::model()->findByPk($id);
            
            if (!$participant) {
                throw new CHttpException(404, 'Questionario compilato non trovato.');
            }
            
            // Carica il questionario
            $questionnaire = Questionnaire::model()->findByPk($participant->questionnaire_id);
            
            if (!$questionnaire) {
                throw new CHttpException(404, 'Questionario non trovato.');
            }
            
            // Carica le sezioni e domande per la versione del partecipante
            $sections = QuestionnaireSection::model()->with('questions')->findAllByAttributes(
                array('version_id' => $participant->version_id),
                array('order' => 't.order ASC, questions.order ASC')
            );
            
            // Genera il PDF
            $pdfContent = $this->generateQuestionnairePDF($questionnaire, $participant, $sections);
            
            // Imposta gli header per la visualizzazione del PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="test_questionario_' . $id . '.pdf"');
            header('Content-Length: ' . strlen($pdfContent));
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');
            
            // Output del PDF
            echo $pdfContent;
            Yii::app()->end();
            
        } else {
            throw new CHttpException(403, 'Accesso negato. Richiesti permessi di amministratore.');
        }
    }
}
