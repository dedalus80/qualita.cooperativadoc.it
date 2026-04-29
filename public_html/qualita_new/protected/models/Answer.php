<?php

class Answer extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'answers';
    }

    public function rules()
    {
        return array(
            array('participant_id, question_id, questionnaire_version_id, value', 'required'),
            array('participant_id, question_id, questionnaire_version_id', 'numerical', 'integerOnly' => true),
            array('value', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'participant' => array(self::BELONGS_TO, 'QuestionnaireParticipant', 'participant_id'),
            'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
            'version' => array(self::BELONGS_TO, 'QuestionnaireVersion', 'questionnaire_version_id'),
        );
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave();
    }
}
