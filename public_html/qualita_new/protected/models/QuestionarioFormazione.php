<?php

class QuestionarioFormazione extends CActiveRecord {

    var $datiEsportazione = array();
    var $stats = array();
    var $dataStart;
    var $dataStop;
    var $selectStrutture    = array();
    var $selectConsiglia    = array();
    var $selectGiudizzi     = array();
    var $selectTipologie    = array();
    var $selectTitoli       = array();
    var $selectEnti         = array();
    
    var $selectAnni = array();
    var $struttura = "";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_formazione';
    }

    public function rules() {
        return array(
            array('lingua, data_corso, titolo, nome, cognome, ente, corso, giudizio,tipo_corso, conduzione, spazi, livello','required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('ente, anno,tipo_corso', 'numerical', 'integerOnly' => true),
            array('lingua , anno', 'length', 'max' => 6),
            array('titolo', 'length', 'max' => 50),
            array('nome, cognome', 'length', 'max' => 20),
            array('corso, giudizio, conduzione, spazi, livello, consiglia', 'length', 'max' => 1),
            array('id, lingua, data_corso, titolo, nome, cognome, ente, corso, giudizio, conduzione, spazi, livello, consiglia, argomenti, suggerimenti, anno, data_inserimento', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'lingua' => 'Lingua',
            'data_corso' => 'Data Corso',
            'titolo' => 'Titolo',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'ente' => 'Ente',
            'ente_corso' => 'Ente',
            'corso' => 'Corso',
            'tipo_corso' => 'Tipo<span class="hidden-480"> Corso</span>',
            'giudizio' => 'Giudizio <span class="hidden-480">complessivo</span>',
            'conduzione' => 'Conduzione',
            'spazi' => 'Spazi',
            'livello' => 'Livello',
            'consiglia' => 'consiglia',
            'argomenti' => 'Argomenti',
            'suggerimenti' => 'Suggerimenti',
            'anno' => 'Anno',
            'data_inserimento' => 'Data Inserimento',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_inserimento DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('lingua', $this->lingua, true);
        $criteria->compare('data_corso', $this->data_corso, true);
        $criteria->compare('titolo', $this->titolo, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('ente', $this->ente);
        $criteria->compare('corso', $this->corso, true);
        $criteria->compare('tipo_corso', $this->tipo_corso, true);
        $criteria->compare('ente_corso', $this->ente_corso, true);

        $criteria->compare('giudizio', $this->giudizio, true);
        $criteria->compare('conduzione', $this->conduzione, true);
        $criteria->compare('spazi', $this->spazi, true);
        $criteria->compare('livello', $this->livello, true);
        $criteria->compare('consiglia', $this->consiglia, true);
        $criteria->compare('argomenti', $this->argomenti, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        $criteria->compare('anno', $this->anno);
        $criteria->compare('data_inserimento', $this->data_inserimento, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_corso)." <br />";
		$tmp .= "<span class='bold'>Titolo:</span> ".$data->titolo." <br />";
		$tmp .= "<span class='bold'>Tipologia:</span> ".Yii::app()->MyUtils->getSelectValue($data->tipo_corso, "doc_tipologie_formazione")." <br />";
		$tmp .= "<span class='bold'>Giudizio:</span> ".Yii::app()->MyUtils->getSelectValue($data->giudizio, "doc_giudizzi")." <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
	
    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_inserimento);
    }

    public function getDataCorso($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_corso);
    }

    public function getGiudizio($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->giudizio, "doc_giudizzi");
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->ente, "doc_unita");
    }

    public function getTipoCorso($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->tipo_corso, "doc_tipologie_formazione");
    }
    
    public function getSelectTipologie(){
        
        $select = array();
        
        $dati = Yii::app()->db->createCommand("SELECT DISTINCT(q.tipo_corso) AS id ,s.nome as nome FROM ".$this->tableName()." as q LEFT JOIN doc_tipologie_formazione as s ON q.tipo_corso = s.id ORDER BY nome ")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = html_entity_decode($dati[$x]['nome']);

        return $select;
        
    }
    
    public function getSelectTitoli(){
        $select = array();
        
        $dati = Yii::app()->db->createCommand("SELECT titolo as nome FROM ".$this->tableName()." ORDER BY nome ")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['nome']] = html_entity_decode($dati[$x]['nome']);

        return $select;
    }

    public function setSelect() {
        $this->selectGiudizzi = Yii::app()->MyUtils->getSelect('doc_giudizzi');
        $this->selectEnti = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectConsiglia = Yii::app()->MyUtils->getSelect('doc_consiglia');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_formazione');

        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";


        $query = "SELECT q.anno, q.id , q.nome , q.cognome, DATE_FORMAT(q.data_corso ,'%d-%m-%Y' ) as data_corso ,DATE_FORMAT(q.data_inserimento ,'%d-%m-%Y' ) as data_restituzione ,
            q.titolo , q.suggerimenti ,q.argomenti  ,
            gi1.nome as nome_corso ,
            gi2.nome as nome_giudizio ,
            gi3.nome as nome_conduzione ,
            gi4.nome as nome_spazi  ,
            gi5.nome as nome_livello ,
            gi6.nome as nome_consiglia ,
            gi7.nome as nome_ente ,
            gi8.nome as tipo_corso
            
            FROM questionario_formazione AS q 
            LEFT JOIN doc_giudizzi as gi1 ON q.corso = gi1.id 
            LEFT JOIN doc_giudizzi as gi2 ON q.giudizio = gi2.id 
            LEFT JOIN doc_giudizzi as gi3 ON q.conduzione = gi3.id 
            LEFT JOIN doc_giudizzi as gi4 ON q.spazi = gi4.id 
            LEFT JOIN doc_giudizzi as gi5 ON q.livello = gi5.id 
            LEFT JOIN doc_consiglia as gi6 ON q.consiglia = gi6.id 
            LEFT JOIN doc_unita as gi7  ON q.ente = gi7.id 
            LEFT JOIN doc_tipologie_formazione as gi8  ON q.tipo_corso = gi8.id 
            
            " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }
    
    
    
    
    
    
}