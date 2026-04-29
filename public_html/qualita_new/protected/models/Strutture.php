<?php

class Strutture extends CActiveRecord {

    var $selectTipologie    = array();
    var $selectCentri       = array();
    var $selectColori       = array();
    var $selectClienti      = array();
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_unita';
    }

    public function rules() {

        return array(
            array('nome, codice, tipologia, centro', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('tipologia , superficie', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 50),
            array('codice,ente', 'length', 'max' => 4),
            array('colore', 'length', 'max' => 8),
            array('qdoc,qsharing , qcampus , qkeluar ', 'length', 'max' => 1),
            array('qsenior,qjunior, qscientifici , qstudio , qsport, qsmog , soloq', 'length', 'max' => 4),
            array('id, nome, codice, tipologia ,ente, qdoc,qsharing , qcampus , qkeluar , centro , soloq', 'safe', 'on' => 'search'),
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
            'codice' => 'Codice',
            'tipologia' => 'Tipologia',
            'superficie' => 'Superficie',
            'centro' => 'Centro',
            'colore' =>'Colore',
            'qkeluar' => "Keluar",
            'ente' => "Cliente",
            'qdoc' => "Doc",
            'qsharing' => "Sharing",
            'qcampus' => "San Paolo",
            'qsenior' => "Senior",
            'qjunior' => "Junior",
            'qsport'  => "Sport",
            'qscientifici' => "Campus scientifici",
            'qstudio' => "Vacanze Studio",
            'qsmog' => "Comune milano",
            'soloq' => "Solo Questioanrio",
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = ' nome ASC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('superficie', $this->superficie, true);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('colore', $this->colore, true);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('centro', $this->centro);
        $criteria->compare('ente', $this->ente);
        $criteria->compare('qdoc', $this->qdoc);
        $criteria->compare('qkeluar', $this->qkeluar);
        $criteria->compare('qsharing', $this->qsharing);
        $criteria->compare('qcampus', $this->qcampus);
        $criteria->compare('qjunior', $this->qjunior);
        $criteria->compare('qsenior', $this->qsenior);
        $criteria->compare('qscientifici', $this->qscientifici);
        $criteria->compare('qstudio', $this->qstudio);
        $criteria->compare('qsport', $this->qsport);
        $criteria->compare('qsmog', $this->qsmog);
        $criteria->compare('soloq', $this->qsmog);


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
    
    public function getColore($data, $id) {
        $background = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id='" . $data->colore . "'")->queryScalar();
        $colore = "<span class='color-preview' style='background:" . $background . "'> &nbsp;</span>";
        return $colore;
    }
        
    public function setSelectValue() {
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_strutture');
        $this->selectCentri = Yii::app()->MyUtils->getSelect('doc_unita_centri');
        $this->selectColori = Yii::app()->MyUtils->getSelect("doc_colori");
        $this->selectClienti = Yii::app()->MyUtils->getSelect("doc_clienti");
    }

    public function getTipologia($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_tipologie_strutture");
    }

    public function getCentro($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->centro, "doc_unita_centri");
    }
    
    public function getCliente($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->ente, "doc_clienti");
    }
    
    public function getSuperficie($data, $t) {
        
        if($data->superficie > 0)
        return $data->superficie." Mq";
    }
    
    public function getQuestionario($data, $t) {
       $check ='';
        if($data->soloq=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title='Solo questionari' ></i>" ;
        return $check;
    }
    
}