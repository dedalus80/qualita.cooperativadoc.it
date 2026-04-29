<?php

class UtentiTag extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'utenti_tags';
    }

    public function rules()
    {
        return array(
            array('nome', 'required', 'message' => 'Il campo {attribute} è obbligatorio'),
            array('nome', 'length', 'max' => 100),
            array('nome', 'unique', 'message' => 'Questo tag esiste già'),
            array('id, nome', 'safe', 'on' => 'search'),
        );
    }

    public function relations()
    {
        return array(
            'utenti' => array(self::MANY_MANY, 'Utenti', 'utenti_tags_assoc(tag_id,utente_id)'),
            'assegnazioni' => array(self::HAS_MANY, 'UtentiTagAssoc', 'tag_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nome' => 'Tag',
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->order = 'nome ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
    }

    public static function getOptions()
    {
        $tags = self::model()->findAll(array('order' => 'nome ASC'));
        return CHtml::listData($tags, 'id', 'nome');
    }
}
