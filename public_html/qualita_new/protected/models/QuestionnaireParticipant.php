<?php

class QuestionnaireParticipant extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'questionnaire_participants';
    }

    public function rules()
    {
        return array(
            // Campi sempre richiesti (indipendentemente dal tipo di questionario)
            array('questionnaire_id, version_id', 'required'),
            array('questionnaire_id, version_id', 'numerical', 'integerOnly'=>true),
            
            // Validazione condizionale basata sul tipo di questionario
            array('name, surname', 'required', 'on' => 'sp,sg,q'),
            array('age, coordinator_name, coordinator_surname, tipologia_soggiorno_id, soggiorno_id, turno_id', 'required', 'on' => 'sp,sg'),
            array('group_name', 'required', 'on' => 'sp'),
            array('email', 'required', 'on' => 'sg,q'),
            array('email', 'email', 'on' => 'sg,q'),
            // Scenario formazione (F): dati per questionari di tipo formazione
            array('name, surname, type_course_id, title_course_id, date_course, affiliated_organisation', 'required', 'on' => 'formazione'),
            
            // Campi sempre opzionali
            array('phone', 'safe'),
            
            // Campi di audit (assegnati automaticamente)
            array('ip_address, browser_agent', 'safe'),
            
            // Campi che devono essere sempre safe per mass assignment
            array('name, surname, age, coordinator_name, coordinator_surname, group_name, tipologia_soggiorno_id, soggiorno_id, turno_id, email, ip_address, browser_agent, type_course_id, title_course_id, date_course, affiliated_organisation', 'safe'),
        );
    }

    /**
     * Imposta lo scenario di validazione in base al tipo di questionario
     * @param string $questionnaireType
     */
    public function setValidationScenario($questionnaireType)
    {
        switch ($questionnaireType) {
            case 'SP':
                $this->setScenario('sp');
                break;
            case 'SG':
                $this->setScenario('sg');
                break;
            case 'Q':
                $this->setScenario('q');
                break;
            case 'A':
                // Per il tipo A, non validare i campi anagrafica (sono nascosti)
                $this->setScenario('a');
                break;
            case 'F':
                // Questionari formazione
                $this->setScenario('formazione');
                break;
            default:
                $this->setScenario('default');
        }
    }

    public function relations()
    {
        return array(
            'questionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'questionnaire_id'),
            'version' => array(self::BELONGS_TO, 'QuestionnaireVersion', 'version_id'),
            'answers' => array(self::HAS_MANY, 'Answer', 'participant_id'),
            'tipologiaSoggiorno' => array(self::BELONGS_TO, 'TipologiaSoggiorni', 'tipologia_soggiorno_id'),
            'soggiorno' => array(self::BELONGS_TO, 'Soggiorni', 'soggiorno_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'questionnaire_id' => 'Questionario',
            'version_id' => 'Versione',
            'name' => 'Nome',
            'surname' => 'Cognome',
            'age' => 'Età',
            'coordinator_name' => 'Nome Coordinatore',
            'coordinator_surname' => 'Cognome Coordinatore',
            'group_name' => 'Gruppo',
            'tipologia_soggiorno_id' => 'Tipologia Soggiorno',
            'soggiorno_id' => 'Soggiorno',
            'turno_id' => 'Turno',
            'email' => 'Email',
            'phone' => 'Telefono',
            'ip_address' => 'Indirizzo IP',
            'browser_agent' => 'User Agent',
            'created_at' => 'Creato il',
            'completed_at' => 'Completato il',
            'type_course_id' => 'Tipologia corso',
            'title_course_id' => 'Titolo corso',
            'date_course' => 'Data corso',
            'affiliated_organisation' => 'Ente/organizzazione di appartenenza',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        
        // Aggiungi le relazioni per l'ordinamento
        $criteria->with = array('questionnaire', 'version', 'tipologiaSoggiorno', 'soggiorno');
        
        // Gestione ordinamento personalizzato per le colonne con relazioni
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 't.created_at';
        $direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
        
        // Mappa per l'ordinamento delle colonne personalizzate
        $sortMap = array(
            'tipologiaSoggiorno.tipologia' => 'tipologiaSoggiorno.tipologia',
            'soggiorno.nome' => 'soggiorno.nome',
            'questionnaire.title' => 'questionnaire.title',
            'version.version_number' => 'version.version_number',
        );
        
        // Se è una colonna personalizzata, usa la mappa
        if (isset($sortMap[$sort])) {
            $criteria->order = $sortMap[$sort] . ' ' . $direction;
        } else {
            // Altrimenti usa l'ordinamento standard
            $criteria->order = $sort . ' ' . $direction;
        }
        
        // Filtri di ricerca - solo se i valori non sono vuoti
        if (!empty($this->id)) {
            $criteria->compare('t.id', $this->id);
        }
        if (!empty($this->questionnaire_id)) {
            $criteria->compare('t.questionnaire_id', $this->questionnaire_id);
        }
        if (!empty($this->version_id)) {
            $criteria->compare('t.version_id', $this->version_id);
        }
        if (!empty($this->name)) {
            $criteria->compare('t.name', $this->name, true);
        }
        if (!empty($this->surname)) {
            $criteria->compare('t.surname', $this->surname, true);
        }
        if (!empty($this->email)) {
            $criteria->compare('t.email', $this->email, true);
        }
        if (!empty($this->tipologia_soggiorno_id)) {
            $criteria->compare('t.tipologia_soggiorno_id', $this->tipologia_soggiorno_id);
        }
        if (!empty($this->soggiorno_id)) {
            $criteria->compare('t.soggiorno_id', $this->soggiorno_id);
        }
        
        // Filtri personalizzati per data
        if (isset($_GET['date_from']) && $_GET['date_from'] !== '') {
            $criteria->addCondition('DATE(t.created_at) >= :date_from');
            $criteria->params[':date_from'] = $_GET['date_from'];
        }
        
        if (isset($_GET['date_to']) && $_GET['date_to'] !== '') {
            $criteria->addCondition('DATE(t.created_at) <= :date_to');
            $criteria->params[':date_to'] = $_GET['date_to'];
        }
        
        // Filtro per IP
        if (isset($_GET['ip_address']) && $_GET['ip_address'] !== '') {
            $criteria->addSearchCondition('t.ip_address', $_GET['ip_address']);
        }
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }
}
