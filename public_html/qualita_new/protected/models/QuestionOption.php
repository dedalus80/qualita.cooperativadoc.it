<?php

class QuestionOption extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'question_options';
    }

    public function rules()
    {
        return array(
            array('question_id, option_text, value', 'required'),
            array('question_id, value, order', 'numerical', 'integerOnly'=>true),
        );
    }

    public function relations()
    {
        return array(
            'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'question_id' => 'Domanda',
            'option_text' => 'Opzione',
            'value' => 'Valore',
            'order' => 'Ordine',
        );
    }
}
