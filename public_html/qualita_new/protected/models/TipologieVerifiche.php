<?php

class TipologieVerifiche extends CActiveRecord {

    var $selectColori = array();
    var $selectIcone = array();
    var $tmpIcona;
    var $tmpColore;
    public $file_upload;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_tipologie_verifiche';
    }

    public function rules() {
        return array(
            array('codice, nome', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('codice', 'length', 'max' => 6),
            array('colore', 'length', 'max' => 8),
            array('nome', 'length', 'max' => 50),
            array('file_name', 'length', 'max' => 255),
            array('file_upload', 'file', 'types' => 'pdf,doc,docx', 'allowEmpty' => true, 'message' => 'Possono essere caricati solo file con le seguenti estensioni pdf, doc, docx'),
            array('is_hidden', 'length', 'max' => 1),
            array('id, codice, nome, file_name, is_hidden', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'verificheQuestions' => array(self::HAS_MANY, 'VerificheQuestions', 'tipologiaVerificaId', 'order'=>'`ordine` ASC'),
            'questionsGroups' => array(self::HAS_MANY, 'VerificheQuestionsGroups', 'tipologiaVerificaId', 'order'=>'`rank` ASC'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'codice' => 'Codice',
            'nome' => 'Nome',
            'colore' => 'Colore',
            'file_name' => 'Documento',
            'file_upload' => 'Documento',
            'is_hidden' => 'Nascondi',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('colore', $this->codice, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('file_name', $this->file_name, true);
        $criteria->compare('is_hidden', $this->is_hidden, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getColore($data, $id) {
        $background = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id='" . $data->colore . "'")->queryScalar();
        $colore = "<span class='color-preview' style='background:" . $background . "'> &nbsp;</span>";
        return $colore;
    }

    public function setSelect() {
        $this->selectColori = Yii::app()->MyUtils->getSelect("doc_colori");
        $this->tmpColore = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id='" . $this->colore . "'")->queryScalar();
    }

}
