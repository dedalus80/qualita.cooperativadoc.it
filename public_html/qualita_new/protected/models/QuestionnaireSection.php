<?php

class QuestionnaireSection extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'questionnaire_sections';
    }

    public function rules()
    {
        return array(
            array('version_id, title', 'required'),
            array('version_id, order', 'numerical', 'integerOnly'=>true),
            array('condition_field, condition_operator, condition_value', 'safe'), // aggiunti come opzionali
            array('condition_field, condition_value', 'length', 'max'=>50),
            array('condition_operator', 'in', 'range'=>array('=', '!=', 'in', 'not in')),
        );
    }

    public function relations()
    {
        return array(
            'version' => array(self::BELONGS_TO, 'QuestionnaireVersion', 'version_id'),
            'questions' => [self::HAS_MANY, 'Question', 'section_id', 'order' => '`questions`.`order` ASC'],
            'visibilityRuleset' => array(
                self::HAS_ONE,
                'VisibilityRuleset',
                '',
                'on' => "visibilityRuleset.target_type = 'section' AND visibilityRuleset.target_id = t.id",
            ),
        );
    }

    /**
     * @return array
     */
    public function getVisibilityRulesetData()
    {
        return VisibilityRulesHelper::getRulesetDataForSection($this);
    }

    /**
     * @param array $answers
     * @param array $participant
     * @return bool
     */
    public function shouldShow($answers = array(), $participant = array())
    {
        $ruleset = $this->getVisibilityRulesetData();
        return VisibilityRulesEvaluator::evaluate($ruleset, array(
            'answers' => $answers,
            'participant' => $participant,
        ));
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'version_id' => 'Versione',
            'title' => 'Titolo',
            'order' => 'Ordine',
            'condition_field' => 'Campo Condizione',
            'condition_operator' => 'Operatore Condizione',
            'condition_value' => 'Valore Condizione',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
        );
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
}
