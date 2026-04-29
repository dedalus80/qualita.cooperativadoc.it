<?php

class UtentiTagAssoc extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'utenti_tags_assoc';
    }

    public function rules()
    {
        return array(
            array('utente_id, tag_id', 'required'),
            array('utente_id, tag_id', 'numerical', 'integerOnly' => true),
            array('utente_id, tag_id', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'utente' => array(self::BELONGS_TO, 'Utenti', 'utente_id'),
            'tag' => array(self::BELONGS_TO, 'UtentiTag', 'tag_id'),
        );
    }
}
