<?php

class VisibilityRuleset extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'visibility_rulesets';
    }

    public function rules()
    {
        return array(
            array('target_type, target_id', 'required'),
            array('target_id', 'numerical', 'integerOnly' => true),
            array('target_type', 'in', 'range' => array('question', 'section')),
            array('combine_operator', 'in', 'range' => array('and', 'or')),
            array('combine_operator', 'default', 'value' => 'and'),
        );
    }

    public function relations()
    {
        return array(
            'rules' => array(
                self::HAS_MANY,
                'VisibilityRule',
                'ruleset_id',
                'order' => 'rules.sort_order ASC, rules.id ASC',
            ),
        );
    }

    public function afterValidate()
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');

        return parent::afterValidate();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $rules = array();
        foreach ($this->rules as $rule) {
            $rules[] = $rule->toArray();
        }

        return array(
            'enabled' => !empty($rules),
            'combine_operator' => $this->combine_operator ?: 'and',
            'rules' => $rules,
        );
    }
}
