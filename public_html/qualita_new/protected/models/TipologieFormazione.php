<?php

class TipologieFormazione extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_tipologie_formazione';
    }

    public function rules() {

        return array(
            array('nome', 'required'),
            array('nome', 'length', 'max' => 255),
            array('attivo', 'length', 'max' => 1),
            array('id, nome, attivo', 'safe', 'on' => 'search'),
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
            'attivo' => 'Attivo',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('attivo', $this->attivo, true);
         return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
    
    public function getAttivo($data, $t) {
        $check ='';
        if($data->attivo=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title='Abilitato tipologia formazione' ></i>" ;
        return $check;
    }
    
}