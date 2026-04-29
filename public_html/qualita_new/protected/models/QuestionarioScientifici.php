<?php

class QuestionarioScientifici extends CActiveRecord {

    var $selectAnni = array();
    var $selectEta = array();
    var $selectOrganizzazioni = array();
    var $selectSoggiorni = array();
    var $selectTurni = array();
    var $datiEsportazione = array();
    var $selectGruppi = array();
    var $id_struttura = "";
    var $stats = array();
    var $struttura = "";
    var $tipoUtente = "user";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_scientifici';
    }

    public function rules() {
        return array(
            array('organizzatore, soggiorno, turno, anno', 'numerical', 'integerOnly' => true),
            array('nome, cognome,nome_gruppo', 'length', 'max' => 50),
            array('email', 'length', 'max' => 255),
            array('cellulare', 'length', 'max' => 20),
            array('data_restituzione', 'length', 'max' => 10),
            array('suggerimenti , osservazioni ,nome_gruppo', 'length', 'max' => 255),
            array('divertimento, educatori, compagni, giochi, attivita_sportive, gite, laboratori, escursioni, soggiorno_esperienza, soggiorno_staff, soggiorno_communicazione, soggiorno_complessivo, scientifici_organizzazione, scientifici_didattica, scientifici_formazione', 'length', 'max' => 2),
            array('id, nome, cognome,nome_gruppo, organizzatore, soggiorno, turno, email, cellulare, divertimento, educatori, compagni, giochi, attivita_sportive, gite, laboratori, escursioni, soggiorno_esperienza, soggiorno_staff, soggiorno_communicazione, soggiorno_complessivo, scientifici_organizzazione, scientifici_didattica, scientifici_formazione, suggerimenti, data_restituzione, anno', 'safe', 'on' => 'search'),
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
            'organizzatore' => 'Organizzatore',
            'soggiorno' => 'Soggiorno',
            'turno' => 'Turno',
            'email' => 'Email',
            'cellulare' => 'Cellulare',
            'nome_gruppo' => 'Nome gruppo',
            'divertimento' => 'Ti sei divertito durante il soggiorno?',
            'educatori' => 'Gli educatori ti sono piaciuti?',
            'compagni' => 'Ti sei trovato bene con i compagni del soggiorno?',
            'giochi' => 'Le attivit&agrave; sono state divertenti?',
            'attivita_sportive' => 'Le attivit&agrave; sportive erano ben organizzate?',
            'gite' => 'Le gite e le escursioni sono state interessanti?',
            'laboratori' => 'Ti sono piaciuti i laboratori?',
            'escursioni' => 'Le gite e le escursioni sono state interessanti?',
            'soggiorno_esperienza' => 'Ritiene che il soggiorno estivo sia stato per suo/a figlio/a un\'esperienza complessivamente utile per la sua crescita?',
            'soggiorno_staff' => 'Ritiene che la cura e l\'attenzione dello staff del soggiorno sia stata adeguata?',
            'soggiorno_communicazione' => 'Ritiene che sia stata adeguata la comunicazione con il  soggiorno?',
            'soggiorno_complessivo' => 'Come valuta complessivamente l\'esperienza di soggiorno?',
            'scientifici_organizzazione' => 'I corsi del campus scientifico, ti sono sembrati ben organizzati?',
            'scientifici_didattica' => 'Dal punto di vista didattico, sei soddisfatto dei corsi che hai frequentato?',
            'scientifici_formazione' => 'Il soggiorno &egrave; stato utile alla tua formazione?',
            'osservazioni' => 'Osservazioni generali',
            'suggerimenti' => 'Ci dai qualche suggerimento per attivit&agrave;, laboratori ed escursioni per il prossimo anno?',
            'data_restituzione' => 'Data Restituzione',
            'anno' => 'Anno',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_restituzione  DESC , id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('nome_coordinatore', $this->nome_coordinatore, true);
        $criteria->compare('cognome_coordinatore', $this->cognome_coordinatore, true);
        $criteria->compare('eta', $this->eta, true);
        $criteria->compare('nome_gruppo', $this->nome_gruppo, true);
        $criteria->compare('organizzatore', $this->organizzatore);
        $criteria->compare('turno', $this->turno);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cellulare', $this->cellulare, true);
        $criteria->compare('divertimento', $this->divertimento, true);
        $criteria->compare('educatori', $this->educatori, true);
        $criteria->compare('compagni', $this->compagni, true);
        $criteria->compare('giochi', $this->giochi, true);
        $criteria->compare('attivita_sportive', $this->attivita_sportive, true);
        $criteria->compare('gite', $this->gite, true);
        $criteria->compare('laboratori', $this->laboratori, true);
        $criteria->compare('escursioni', $this->escursioni, true);
        $criteria->compare('soggiorno_esperienza', $this->soggiorno_esperienza, true);
        $criteria->compare('soggiorno_staff', $this->soggiorno_staff, true);
        $criteria->compare('soggiorno_communicazione', $this->soggiorno_communicazione, true);
        $criteria->compare('soggiorno_complessivo', $this->soggiorno_complessivo, true);
        $criteria->compare('scientifici_organizzazione', $this->scientifici_organizzazione, true);
        $criteria->compare('scientifici_didattica', $this->scientifici_didattica, true);
        $criteria->compare('scientifici_formazione', $this->scientifici_formazione, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        $criteria->compare('osservazioni', $this->osservazioni, true);
        $criteria->compare('data_restituzione', $this->data_restituzione, true);
        $criteria->compare('anno', $this->anno);
        
        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $criteria->compare('soggiorno', $user['user_unita']) : $criteria->compare('soggiorno', $this->soggiorno) ;
        
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 30,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_restituzione)." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
	
    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_restituzione);
    }

    public function getSoggiorno($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita");
    }

    function setSelect() {

        $this->selectOrganizzazioni = Yii::app()->MyUtils->getSelect('doc_clienti');
        $this->selectSoggiorni = Yii::app()->MyUtils->getSelect('doc_unita_scientifici');
        $this->selectTurni = Yii::app()->MyUtils->getTurni();
        $this->selectEta = Yii::app()->MyUtils->getEta();
        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->selectGruppi = Yii::app()->MyUtils->getGruppi($this->tableName());
    }

    public function getEsportazione($anni = null) {

        /*if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = "SELECT q.*, DATE_FORMAT(q.data_restituzione ,'%d-%m-%Y' ) as restituzione , c.nome as organizza, s.nome as struttura
            FROM " . $this->tableName() . " AS q 
            LEFT JOIN doc_clienti as c ON q.organizzatore = c.id
            LEFT JOIN doc_unita as s ON q.soggiorno = s.id
            " . $WHERE;*/

        $where_year = "";
        if ($anni && $anni != '0,0,0,0,0') {
            $where_year = "AND s.anno IN (" . $anni . ") ";
        }

        $query = "SELECT s.*, DATE_FORMAT(s.data_restituzione ,'%d-%m-%Y' ) as restituzione , c.nome as organizza, u.nome as struttura
            FROM survey_stays AS s
            LEFT JOIN doc_clienti as c ON s.organizzatore = c.id
            LEFT JOIN doc_unita as u ON s.soggiorno = u.id
            WHERE s.tipologia_id = 4 ".$where_year;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }

    public function getAllStats() {

        $allStats = array();
        if ($this->soggiorno)
            $and = "AND soggiorno='" . $this->soggiorno . "'";
        if ($this->anno)
            $and .= "AND anno = '" . $this->anno . "'";
        if ($this->turno)
            $and .= "AND turno = '" . $this->turno . "'";
        if ($this->nome_gruppo)
            $and .= "AND nome_gruppo = '" . addslashes($this->nome_gruppo) . "'";

        $campi = array('divertimento', 'educatori', 'compagni', 'giochi', 'attivita_sportive', 'gite', 'laboratori', 'escursioni', 'soggiorno_esperienza', 'soggiorno_staff', 'soggiorno_communicazione', 'soggiorno_complessivo', 'scientifici_organizzazione', 'scientifici_didattica', 'scientifici_formazione');
        $allStats['totale'] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE 1 " . $and . "")->queryScalar();

        foreach ($campi as $name) {

            $poco = $abbas = $molto = 0;

            $poco = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='P' " . $and . "")->queryScalar();
            $abbas = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='A' " . $and . "")->queryScalar();
            $molto = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='M' " . $and . "")->queryScalar();

            if ($poco > 0)
                $poco_per = $poco / $allStats['totale'] * 100;
            if ($abbas > 0)
                $abbas_per = $abbas / $allStats['totale'] * 100;
            if ($molto > 0)
                $molto_per = $molto / $allStats['totale'] * 100;

            $allStats[$name][] = "{label: 'POCO', value: " . $poco . "}";
            $allStats[$name][] = "{label: 'ABBASTANZA', value: " . $abbas . "}";
            $allStats[$name][] = "{label: 'MOLTO', value: " . $molto . "}";
            $allStats[$name . "_data"][] = array("label" => 'POCO', "valore" => $poco, 'percentuale' => number_format($poco_per, 2));
            $allStats[$name . "_data"][] = array("label" => 'ABBASTANZA', "valore" => $abbas, 'percentuale' => number_format($abbas_per, 2));
            $allStats[$name . "_data"][] = array("label" => 'MOLTO', "valore" => $molto, 'percentuale' => number_format($molto_per, 2));
            $allStats['exist'][$name] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "!='' " . $and . "")->queryScalar();
        }

        return $allStats;
    }

}