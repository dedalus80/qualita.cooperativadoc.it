<?php

class SnPreiscrizioni extends CActiveRecord {

    var $selectRuoli = array();
    var $selectPercorsi = array();
    var $selectFocus = array();
    var $selectAnni = array();
    var $datiEsportazione = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'sn_preiscrizioni';
    }

    public function rules() {

        return array(
            array('nome, cognome, ruolo,ente, focus, percorso', 'required'),
            array('ruolo, focus, percorso', 'numerical', 'integerOnly' => true),
            array('nome, cognome, altro_ruolo, ente', 'length', 'max' => 50),
            array('anno', 'length', 'max' => 4),
            array('id, nome, cognome, ruolo, altro_ruolo, ente, focus, percorso, data_insert', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {

        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'ruolo' => 'Ruolo',
            'altro_ruolo' => 'Altro Ruolo',
            'ente' => 'Ente',
            'focus' => 'Focus',
            'anno' => 'Anno',
            'percorso' => 'Percorso',
            'data_insert' => 'Data',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_insert DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('ruolo', $this->ruolo);
        $criteria->compare('altro_ruolo', $this->altro_ruolo, true);
        $criteria->compare('ente', $this->ente, true);
        $criteria->compare('focus', $this->focus);
        $criteria->compare('anno', $this->anno);

        $criteria->compare('percorso', $this->percorso);
        $criteria->compare('data_insert', $this->data_insert, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
		
		$tmp  = "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp  .= "<span class='bold'>Ruolo:</span> ".Yii::app()->MyUtils->getSelectValue($data->ruolo, 'sn_ruoli')." <br />";
		$tmp .= "<span class='bold'>Percorso:</span> ".Yii::app()->MyUtils->getSelectValue($data->percorso, 'sn_percorsi')." <br />";
		$tmp .= "<span class='bold'>Focus:</span> ".Yii::app()->MyUtils->getSelectValue($data->focus, 'sn_focus');
		return $tmp;  
	}
	
	
	
    public function getData($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_insert);
    }

    public function getRuolo($data, $t) {

        $ruolo = Yii::app()->MyUtils->getSelectValue($data->ruolo, 'sn_ruoli');
        if ($data->ruolo == "4")
            $ruolo .= " " . $data->altro_ruolo;
        return $ruolo;
    }

    public function getPercorso($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->percorso, 'sn_percorsi');
    }

    public function getFocus($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->focus, 'sn_focus');
    }

    public function setSelectValue() {
        $this->selectRuoli = Yii::app()->MyUtils->getSelect('sn_ruoli');
        $this->selectPercorsi = Yii::app()->MyUtils->getSelect('sn_percorsi');
        $this->selectFocus = Yii::app()->MyUtils->getSelect('sn_focus');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        $query = "SELECT i.* , DATE_FORMAT(i.data_insert , '%d-%m-%Y') AS data , r.nome as nome_ruolo , f.nome  as nome_focus , p.nome  as nome_percorso 
         FROM " . $this->tableName() . " AS i
         LEFT JOIN sn_ruoli AS r  ON i.ruolo =  r.id 
         LEFT JOIN sn_focus AS f  ON i.focus =  f.id 
         LEFT JOIN sn_percorsi AS p  ON i.percorso =  p.id ORDER BY data_insert ";
        $dati = Yii::app()->db->createCommand($query)->queryAll();
        return $dati;
    }

}