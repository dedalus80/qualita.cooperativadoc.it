<?php

class TimSoggiorni extends CActiveRecord {

    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'tim_soggiorni';
    }
    
    public function rules() {
        
        return array(
            array('nome', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio',),
            array('nome', 'length', 'max' => 100),
           
            array('id, nome', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
        );
    }
    
    public function search() {
        
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
