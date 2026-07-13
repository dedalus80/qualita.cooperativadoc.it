<?php

class VisibilityRule extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'visibility_rules';
    }

    public function rules()
    {
        return array(
            array('ruleset_id, source_type, source_key, operator', 'required'),
            array('ruleset_id, sort_order', 'numerical', 'integerOnly' => true),
            array('source_type', 'in', 'range' => array('participant_field', 'question_answer')),
            array('operator', 'in', 'range' => array('=', '!=', 'in', 'not in')),
            array('value', 'length', 'max' => 255),
            array('sort_order', 'default', 'value' => 0),
        );
    }

    public function relations()
    {
        return array(
            'ruleset' => array(self::BELONGS_TO, 'VisibilityRuleset', 'ruleset_id'),
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'source_type' => $this->source_type,
            'source_key' => $this->source_key,
            'operator' => $this->operator,
            'value' => $this->value,
        );
    }
}
