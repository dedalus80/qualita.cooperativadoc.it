<?php

class Centri extends CActiveRecord {

    var $selectMedici = array();
    var $selectResponsabili = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_unita_centri';
    }

    public function rules() {
        return array(
            array('nome, id_responsabile', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_responsabile, id_medico', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 200),
            array('id, nome, id_responsabile, id_medico', 'safe', 'on' => 'search'),
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
            'id_responsabile' => 'Responsabile Centro',
            'id_medico' => 'Medico Centro',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('id_responsabile', $this->id_responsabile);
        $criteria->compare('id_medico', $this->id_medico);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
    
    public function setDefaultValue() {
        $this->selectMedici = Yii::app()->MyUtils->getSelect('medici_centro');
        $this->selectResponsabili = Yii::app()->MyUtils->getSelect('responsabili_centro');
    }

    public function getMedico($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->id_medico, "admin_medici");
    }

    public function getResponsabile($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->id_responsabile, "admin_responsabili");
    }

}