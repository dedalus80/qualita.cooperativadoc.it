<?php

class TimFascie extends CActiveRecord {

    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'tim_fascie';
    }
    
    public function rules() {
        return array(
			array('nome, descrizione', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio',),
			array('nome', 'numerical', 'integerOnly'=>true, 'message' => 'Il campo {attribute} deve essere di tipo numerico',),
			array('descrizione', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome, descrizione', 'safe', 'on'=>'search'),
		);
    }

    public function relations() {
        
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Numero',
            'descrizione' => "Descrizione"
        );
    }
    
    public function search() {
        
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('descrizione',$this->descrizione,true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
