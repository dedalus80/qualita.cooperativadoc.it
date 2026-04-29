<?php

class QuestionnaireVersion extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'questionnaire_versions';
    }

    public function rules()
    {
        return array(
            array('questionnaire_id, version_number', 'required'),
            array('questionnaire_id, version_number', 'numerical', 'integerOnly'=>true),
            array('description', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'questionnaire' => array(self::BELONGS_TO, 'Questionnaire', 'questionnaire_id'),
            'sections' => array(self::HAS_MANY, 'QuestionnaireSection', 'version_id'),
            'participants' => array(self::HAS_MANY, 'QuestionnaireParticipant', 'version_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'questionnaire_id' => 'Questionario',
            'version_number' => 'Versione',
            'description' => 'Descrizione',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
        );
    }

    public function hasResponses()
    {
        // Assumendo che esista un model QuestionnaireParticipant con colonna version_id
        return QuestionnaireParticipant::model()->exists('version_id = :version_id', array(':version_id' => $this->id));
    }

    public function afterValidate()
    {
        // Automatically set created_at and updated_at timestamps
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
        
        return parent::afterValidate();
    }

    public function isLatest()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'questionnaire_id = :qid';
        $criteria->params = array(':qid' => $this->questionnaire_id);
        $criteria->order = 'version_number DESC';
        $criteria->limit = 1;

        $latestVersion = self::model()->find($criteria);

        return ($latestVersion && $latestVersion->id == $this->id);
    }

    public function activate()
    {
        // Disattiva tutte le versioni dello stesso questionario
        self::model()->updateAll(
            array('is_active' => 0),
            'questionnaire_id = :qid',
            array(':qid' => $this->questionnaire_id)
        );

        // Attiva questa versione
        $this->is_active = 1;
        return $this->save(false);
    }

    public function isActive()
    {
        return $this->is_active == 1;
    }

}
