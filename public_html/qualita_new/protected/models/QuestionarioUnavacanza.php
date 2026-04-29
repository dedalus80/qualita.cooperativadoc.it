<?php

class QuestionarioUnavacanza extends CActiveRecord {
    
    
    var $selectTurni = array();
    var $selectAttivita = array();
    var $datiEsportazione = array();
    var $selectAnni = array();
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'un_questionario';
    }

    public function rules() {

        return array(
            array('nome, cognome, turno, attivita, privacy, informativa', 'required'),
            array('turno, attivita', 'numerical', 'integerOnly' => true),
            array('nome, cognome, email, cellulare', 'length', 'max' => 50),
            array('privacy, informativa', 'length', 'max' => 1),
            array('anno', 'length', 'max' => 4),
            
            array('id, nome, cognome, turno, attivita, privacy, informativa, email, cellulare, data_insert', 'safe', 'on' => 'search'),
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
            'cognome' => 'Cognome',
            'turno' => 'Turno',
            'attivita' => 'Attivita',
            'privacy' => 'Privacy',
            'informativa' => 'Informativa',
            'email' => 'Email',
            'cellulare' => 'Cellulare',
            'data_insert' => 'Data Inserimento',
            'anno' => 'Anno'
        );
    }

    public function search() {
        
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('turno', $this->turno);
        $criteria->compare('attivita', $this->attivita);
        $criteria->compare('privacy', $this->privacy, true);
        $criteria->compare('informativa', $this->informativa, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cellulare', $this->cellulare, true);
        $criteria->compare('data_insert', $this->data_insert, true);
        $criteria->compare('anno', $this->anno, true);
        return new CActiveDataProvider($this, array( 'criteria' => $criteria, ));
    }
    
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_insert)." <br />";
		$tmp .= "<span class='bold'>Turno:</span> ".Yii::app()->MyUtils->getSelectValue($data->turno, "un_turni")." <br />";
		$tmp .= "<span class='bold'>Attivit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->attivita, "un_attivita")."  <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
	
    public function getData($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_insert);
    }
    
    public function getTurno($data, $t){
        return Yii::app()->MyUtils->getSelectValue($data->turno, "un_turni");
    }
    
    public function getAttivita($data, $t){
        return Yii::app()->MyUtils->getSelectValue($data->attivita, "un_attivita");
        
    }
    
    public function setSelect(){
        $this->selectTurni = Yii::app()->MyUtils->getSelect('un_turni');
        $this->selectAttivita = Yii::app()->MyUtils->getSelect('un_attivita');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }
	
    public function getEsportazione($anni = null) {
        $query = "SELECT q.* , t.nome as turno_nome, a.nome as attivita_nome, DATE_FORMAT(data_insert, '%d-%m-%Y')  as data  FROM ".$this->tableName()." AS q 
            LEFT JOIN un_turni  as t ON q.turno = t.id 
            LEFT JOIN un_attivita  as a ON q.turno = a.id ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }
    
}