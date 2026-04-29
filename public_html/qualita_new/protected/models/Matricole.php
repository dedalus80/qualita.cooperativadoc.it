<?php

class Matricole extends CActiveRecord {

    var $selectTipologie = array("1" => "Acqua", "2" => "Energetico", "3" => "Gas");
    var $selectStrutture = array();
    var $struttura_nome  = "";
    var $typeUser = '';

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_matricole';
    }

    public function rules() {

        return array(
            array('id_struttura, nome_contatore, matricola,tipo_matricola', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_struttura', 'numerical', 'integerOnly' => true),
            array('nome_contatore, matricola', 'length', 'max' => 255),
            array('matricola', 'checkMatricola'),
            array('id, id_struttura, nome_contatore, matricola', 'safe', 'on' => 'search'),
        );
    }

    public function checkMatricola() {
        $isData = Yii::app()->db->createCommand("SELECT id FROM " . $this->tableName() . " WHERE id!='" . $this->id . "' AND matricola ='" . $this->matricola . "'  ")->queryScalar();
        if ($isData)
            $this->addError("data_lettura", "&egrave; gi&agrave; stata inserita un contatore con questo numero di matricola <b>" . $this->matricola . "</b>");
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_struttura' => 'Struttura',
            'nome_contatore' => '<span class="no-phone">Nome </span>Contatore',
            'matricola' => 'N&deg;Matricola',
            'tipo_matricola' => '<span class="no-phone">Tipo contatore</span><span class="only-phone">Tipologia</span>',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('id_struttura', $this->id_struttura);
        $criteria->compare('nome_contatore', $this->nome_contatore, true);
        $criteria->compare('matricola', $this->matricola, true);
        $criteria->compare('tipo_matricola', $this->tipo_matricola, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function setSelect() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() == 110)
            $this->setAttribute('id_struttura', array("19", "20", "21", "22"));
        else if ($this->typeUser != 'admin')
            $this->setAttribute('id_struttura', Yii::app()->MyUtils->getUserStruttura());

        $this->struttura_nome = Yii::app()->MyUtils->getSelectValue($this->id_struttura, "doc_unita");

        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
    }

    public function getTipologia($data, $t) {
        return $this->selectTipologie[$data->tipo_matricola];
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->id_struttura, "doc_unita");
    }

    public function getDataLettura($data, $t) {
        return Yii::app()->db->createCommand("SELECT DATE_FORMAT(data_lettura, '%d-%m-%Y') FROM doc_letture  WHERE id_matricola ='" . $data->id . "' ORDER BY data_lettura DESC ")->queryScalar();
    }

    public function getLettura($data, $t) {
        return Yii::app()->db->createCommand("SELECT incremento FROM doc_letture  WHERE id_matricola ='" . $data->id . "' ORDER BY data_lettura DESC ")->queryScalar();
    }

    public function getDifferenza($data, $t) {
        return Yii::app()->db->createCommand("SELECT differenza FROM doc_letture  WHERE id_matricola ='" . $data->id . "' ORDER BY data_lettura DESC ")->queryScalar();
    }

}