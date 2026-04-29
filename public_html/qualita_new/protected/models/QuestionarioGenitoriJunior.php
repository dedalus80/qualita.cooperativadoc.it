<?php

class QuestionarioGenitoriJunior extends CActiveRecord {

    var $selectAnni = array();
    var $selectOrganizzazioni = array();
    var $selectSoggiorni = array();
    var $selectTurni = array();
    var $selectGruppi = array();
    var $datiEsportazione = array();
    var $id_struttura = "";
    var $stats = array();
    var $struttura = "";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_genitori_junior';
    }

    public function rules() {
        return array(
            array('organizzatore, soggiorno, turno, eta, anno', 'numerical', 'integerOnly' => true),
            array('nome, cognome, nome_coordinatore, cognome_coordinatore, nome_gruppo', 'length', 'max' => 50),
            array('assistenza, informazioni, trasferimenti, complessivo, organizzazione, attivita, esperienza, cura, communicazione', 'length', 'max' => 1),
            array('id, nome, cognome, organizzatore, soggiorno, turno, nome_coordinatore, cognome_coordinatore, eta, nome_gruppo, assistenza, informazioni, trasferimenti, complessivo, organizzazione, attivita, esperienza, cura, communicazione, suggerimenti, data_restituzione, anno', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome partecipante',
            'cognome' => 'Cognome partecipante',
            'organizzatore' => 'Organizzatore',
            'soggiorno' => 'Soggiorno',
            'turno' => 'Turno',
            'nome_coordinatore' => 'Nome genitore',
            'cognome_coordinatore' => 'Cognome genitore',
            'email_genitore' => "Email genitore",
            'eta' => 'Eta',
            'nome_gruppo' => 'Nome Gruppo',
            'assistenza' => 'Assistenza',
            'informazioni' => 'Informazioni',
            'trasferimenti' => 'Trasferimenti',
            'complessivo' => 'Complessivo',
            'organizzazione' => 'Organizzazione',
            'attivita' => 'Attivita',
            'esperienza' => 'Esperienza',
            'cura' => 'Cura',
            'communicazione' => 'Communicazione',
            'suggerimenti' => 'Suggerimenti',
            'data_restituzione' => 'Data Restituzione',
            'anno' => 'Anno',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('organizzatore', $this->organizzatore);
        $criteria->compare('soggiorno', $this->soggiorno);
        $criteria->compare('turno', $this->turno);
        $criteria->compare('nome_coordinatore', $this->nome_coordinatore, true);
        $criteria->compare('cognome_coordinatore', $this->cognome_coordinatore, true);
        $criteria->compare('email_genitore', $this->email_genitore, true);
        $criteria->compare('eta', $this->eta);
        $criteria->compare('nome_gruppo', $this->nome_gruppo, true);
        $criteria->compare('assistenza', $this->assistenza, true);
        $criteria->compare('informazioni', $this->informazioni, true);
        $criteria->compare('trasferimenti', $this->trasferimenti, true);
        $criteria->compare('complessivo', $this->complessivo, true);
        $criteria->compare('organizzazione', $this->organizzazione, true);
        $criteria->compare('attivita', $this->attivita, true);
        $criteria->compare('esperienza', $this->esperienza, true);
        $criteria->compare('cura', $this->cura, true);
        $criteria->compare('communicazione', $this->communicazione, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        $criteria->compare('data_restituzione', $this->data_restituzione, true);
        $criteria->compare('anno', $this->anno);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
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
        $this->selectGruppi = Yii::app()->MyUtils->getGruppi($this->tableName());
        $this->selectSoggiorni = Yii::app()->MyUtils->getSelect('doc_unita_junior');
        $this->selectTurni = Yii::app()->MyUtils->getTurni();
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = "SELECT q.*, DATE_FORMAT(q.data_restituzione ,'%d-%m-%Y' ) as restituzione , c.nome as organizza, s.nome as struttura
            FROM " . $this->tableName() . " AS q 
            LEFT JOIN doc_clienti as c ON q.organizzatore = c.id
            LEFT JOIN doc_unita as s ON q.soggiorno = s.id
            " . $WHERE;

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

        $campi = array('assistenza', 'informazioni', 'trasferimenti', 'complessivo', 'organizzazione', 'attivita', 'esperienza', 'cura', 'communicazione');
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