<?php
class Question extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'questions';
    }

    public function rules()
    {
        return array(
            array('section_id, text, type', 'required'),
            array('section_id, order, condition_question_id', 'numerical', 'integerOnly'=>true),
            array('type', 'in', 'range'=>array('text','option','range','custom')),
            array('condition_operator', 'in', 'range'=>array('=', '!=', 'in', 'not in')),
            array('condition_value', 'length', 'max'=>255),
            array('is_multiple', 'boolean'),
            array('deleted_at, condition_question_id, condition_operator, condition_value', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'section' => array(self::BELONGS_TO, 'QuestionnaireSection', 'section_id'),
            'options' => array(self::HAS_MANY, 'QuestionOption', 'question_id'),
            'answers' => array(self::HAS_MANY, 'Answer', 'question_id'),
            'conditionQuestion' => array(self::BELONGS_TO, 'Question', 'condition_question_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'section_id' => 'Sezione',
            'text' => 'Testo',
            'type' => 'Tipo',
            'order' => 'Ordine',
            'is_multiple' => 'Risposte Multiple',
            'condition_question_id' => 'Domanda Condizione',
            'condition_operator' => 'Operatore Condizione',
            'condition_value' => 'Valore Condizione',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'deleted_at' => 'Eliminato il',
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

    /**
     * Verifica se la domanda è condizionale
     */
    public function isConditional()
    {
        return !empty($this->condition_question_id) && !empty($this->condition_operator) && !empty($this->condition_value);
    }

    /**
     * Verifica se la domanda dovrebbe essere mostrata basandosi sulla risposta di un'altra domanda
     */
    public function shouldShow($answers = [])
    {
        if (!$this->isConditional()) {
            return true;
        }

        if (!isset($answers[$this->condition_question_id])) {
            return false;
        }

        $conditionValue = $answers[$this->condition_question_id];
        $expectedValue = $this->condition_value;

        switch ($this->condition_operator) {
            case '=':
                return $conditionValue == $expectedValue;
            case '!=':
                return $conditionValue != $expectedValue;
            case 'in':
                $expectedValues = explode(',', $expectedValue);
                return in_array($conditionValue, $expectedValues);
            case 'not in':
                $expectedValues = explode(',', $expectedValue);
                return !in_array($conditionValue, $expectedValues);
            default:
                return true;
        }
    }
}
