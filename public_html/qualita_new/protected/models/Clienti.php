<?php

class Clienti extends CActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_clienti';
    }

    public function rules() {

        return array(
            array('nome, codice', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('tipologia', 'numerical', 'integerOnly' => true),
            array('nome', 'length', 'max' => 50),
            array('codice', 'length', 'max' => 4),
            array('qdoc, qkeluar, qsharing, qcampus, qsenior, qjunior, qscientifici, qstudio, qsport, online', 'length', 'max' => 1),
            array('id, nome, codice, tipologia, qdoc, qkeluar, qsharing, qcampus, qsenior, qjunior, qscientifici, qstudio, qsport, online', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'soggiorni' => array(self::HAS_MANY, 'DocClientiTipologiaSoggiorni', 'cliente_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'codice' => 'Codice',
            'tipologia' => 'Tipologia',
            'qdoc' => 'Q. Doc',
            'qkeluar' => 'Q. Keluar',
            'qsharing' => 'Q .Sharing',
            'qcampus' => 'Q. Campus San Paolo',
            'qsenior' => 'Q. Senior',
            'qjunior' => 'Q. Junior',
            'qscientifici' => 'Q. Campus Scientifici',
            'qsport' => 'Q. Campus Sportivi',
            'qstudio' => 'Q. Vacanze Studio',
            'online' => 'Online',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('qdoc', $this->qdoc, true);
        $criteria->compare('qkeluar', $this->qkeluar, true);
        $criteria->compare('qsharing', $this->qsharing, true);
        $criteria->compare('qcampus', $this->qcampus, true);
        $criteria->compare('qsenior', $this->qsenior, true);
        $criteria->compare('qjunior', $this->qjunior, true);
        $criteria->compare('qscientifici', $this->qscientifici, true);
        $criteria->compare('qsport', $this->qsport, true);
        $criteria->compare('qstudio', $this->qstudio, true);
        $criteria->compare('online', $this->online, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }
    
    public function getQStudio($data, $t) {
        $check ='';
        if($data->qstudio=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title=' Abilitato su Questionario Vacanze Studio' ></i>" ;
        return $check;
    }
    
    public function getQJunior($data, $t) {
        $check ='';
        if($data->qjunior=='Y')
            $check = "<i class='fa fa-check green alert-success ' data-toggle ='tooltip' title=' Abilitato su Questionario Senior' ></i>" ;
        return $check;
    }
    
    public function getQSenior($data, $t) {
        $check ='';
        if($data->qsenior=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title=' Abilitato su Questionario Junior' ></i>" ;
        return $check;
    }
    
    public function getQScientifici($data, $t) {
       $check ='';
        if($data->qscientifici=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title=' Abilitato su Questionario Campus Scientifici' ></i>" ;
        return $check;
    }

    public function getQSport($data, $t) {
        $check ='';
        if($data->qsport=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title=' Abilitato su Questionario Campus Sportivi' ></i>" ;
        return $check;
    }
    
    public function getOnline($data, $t) {
       $check ='';
        if($data->online=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title=' Online' ></i>" ;
        return $check;
    }
    
}