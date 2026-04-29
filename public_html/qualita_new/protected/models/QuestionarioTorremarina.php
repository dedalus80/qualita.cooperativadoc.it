<?php

class QuestionarioTorremarina extends CActiveRecord {

    var $datiEsportazione = array();
    var $stats = array();
    var $dataStart;
    var $dataStop;
    var $selectStrutture = array();
    var $selectConsiglia = array();
    var $selectGiudizzi = array();
    var $selectTipologie = array();
    var $selectAnni = array();
    var $struttura = "";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_torremarina';
    }

    public function rules() {

        return array(
            array('nome, cognome, lingua, email, cellulare, data_arrivo, data_partenza, conoscenza, tipologia_cliente, giorni_permanenza, data_consegna, data_restituzione, struttura_nome, personale_animazione, info, anno', 'required'),
            array('conoscenza, tipologia_cliente, giorni_permanenza, struttura_nome, anno', 'numerical', 'integerOnly' => true),
            array('nome, cognome, cellulare', 'length', 'max' => 30),
            array('lingua', 'length', 'max' => 6),
            array('email', 'length', 'max' => 50),
            array('vacanza, struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, personale_animazione, consiglia, info', 'length', 'max' => 1),
            array('suggerimenti', 'safe'),
            array('id, nome, cognome, lingua, email, cellulare, data_arrivo, data_partenza, conoscenza, tipologia_cliente, giorni_permanenza, data_consegna, data_restituzione, vacanza, struttura_pulizia, struttura_nome, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, personale_animazione, consiglia, suggerimenti, info, anno', 'safe', 'on' => 'search'),
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
            'lingua' => 'Lingua',
            'email' => 'Email',
            'cellulare' => 'Cellulare',
            'data_arrivo' => 'Data Arrivo',
            'data_partenza' => 'Data Partenza',
            'conoscenza' => 'Conoscenza',
            'tipologia_cliente' => 'Tipologia Cliente',
            'giorni_permanenza' => 'Giorni Permanenza',
            'data_consegna' => 'Data Consegna',
            'data_restituzione' => 'Data Restituzione',
            'vacanza' => 'Vacanza',
            'struttura_pulizia' => 'Struttura Pulizia',
            'struttura_nome' => 'Struttura Nome',
            'struttura_complessivo' => 'Struttura Complessivo',
            'stanza_confort' => 'Stanza Confort',
            'stanza_arredi' => 'Stanza Arredi',
            'stanza_pulizia' => 'Stanza Pulizia',
            'stanza_complessivo' => 'Stanza Complessivo',
            'ristorante_servizio' => 'Ristorante Servizio',
            'ristorante_attesa' => 'Ristorante Attesa',
            'ristorante_cibo' => 'Ristorante Cibo',
            'ristorante_menu' => 'Ristorante Menu',
            'ristorante_complessivo' => 'Ristorante Complessivo',
            'personale_cortesia' => 'Personale Cortesia',
            'personale_professionalita' => 'Personale Professionalita',
            'personale_complessivo' => 'Personale Complessivo',
            'personale_animazione' => 'Personale Animazione',
            'consiglia' => 'Consiglia',
            'suggerimenti' => 'Suggerimenti',
            'info' => 'Info',
            'anno' => 'Anno',
        );
    }

    public function search() {


        $criteria = new CDbCriteria;
        $criteria->order = 'data_restituzione DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('lingua', $this->lingua, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cellulare', $this->cellulare, true);
        $criteria->compare('data_arrivo', $this->data_arrivo, true);
        $criteria->compare('data_partenza', $this->data_partenza, true);
        $criteria->compare('conoscenza', $this->conoscenza);
        $criteria->compare('tipologia_cliente', $this->tipologia_cliente);
        $criteria->compare('giorni_permanenza', $this->giorni_permanenza);
        $criteria->compare('data_consegna', $this->data_consegna, true);
        $criteria->compare('data_restituzione', $this->data_restituzione, true);
        $criteria->compare('vacanza', $this->vacanza, true);
        $criteria->compare('struttura_pulizia', $this->struttura_pulizia, true);
        $criteria->compare('struttura_nome', $this->struttura_nome);
        $criteria->compare('struttura_complessivo', $this->struttura_complessivo, true);
        $criteria->compare('stanza_confort', $this->stanza_confort, true);
        $criteria->compare('stanza_arredi', $this->stanza_arredi, true);
        $criteria->compare('stanza_pulizia', $this->stanza_pulizia, true);
        $criteria->compare('stanza_complessivo', $this->stanza_complessivo, true);
        $criteria->compare('ristorante_servizio', $this->ristorante_servizio, true);
        $criteria->compare('ristorante_attesa', $this->ristorante_attesa, true);
        $criteria->compare('ristorante_cibo', $this->ristorante_cibo, true);
        $criteria->compare('ristorante_menu', $this->ristorante_menu, true);
        $criteria->compare('ristorante_complessivo', $this->ristorante_complessivo, true);
        $criteria->compare('personale_cortesia', $this->personale_cortesia, true);
        $criteria->compare('personale_professionalita', $this->personale_professionalita, true);
        $criteria->compare('personale_complessivo', $this->personale_complessivo, true);
        $criteria->compare('personale_animazione', $this->personale_animazione, true);
        $criteria->compare('consiglia', $this->consiglia, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('anno', $this->anno);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_restituzione);
    }

    public function getEsportazione($anni = null) {
        $query = "SELECT * FROM questionario_torremarina ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getGiudizio($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->vacanza, "doc_giudizzi");
    }

    public function getGiudizioStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura_complessivo, "doc_giudizzi");
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura_nome, "doc_unita");
    }

	public function getDettaglio($data , $t){
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_restituzione)." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Giudizio:</span> ".Yii::app()->MyUtils->getSelectValue($data->vacanza, "doc_giudizzi");
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
	
	
    public function getAllStats() {

        $allStats = array();
        if ($this->struttura_nome)
            $and = "AND struttura_nome='" . $this->struttura_nome . "'";
        if ($this->anno)
            $and .= "AND anno = '" . $this->anno . "'";

        $allStats['finale'][] = "{label: 'CERTAMENTE SI', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='S' " . $and . "")->queryScalar() . "}";
        $allStats['finale'][] = "{label: 'CERTAMNETE NO', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='N' " . $and . "")->queryScalar() . "}";
        $allStats['finale'][] = "{label: 'NON SO FORSE', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='F' " . $and . "")->queryScalar() . "}";

        foreach ($this->attributes as $name => $val) {
            $allStats[$name][] = "{label: 'ECCELLENTE', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='E' " . $and . "")->queryScalar() . "}";
            $allStats[$name][] = "{label: 'BUONO', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='B' " . $and . "")->queryScalar() . "}";
            $allStats[$name][] = "{label: 'SUFFICENTE', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='S' " . $and . "")->queryScalar() . "}";
            $allStats[$name][] = "{label: 'INSUFICENTE', value: " . Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='I' " . $and . "")->queryScalar() . "}";
            $allStats['exist'][$name] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "!='' " . $and . "")->queryScalar();
        }
        $allStats['totale'] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE 1 " . $and . "")->queryScalar();
        return $allStats;
    }

    public function setSelect() {
        $this->selectGiudizzi = Yii::app()->MyUtils->getSelect('doc_giudizzi');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_clienti');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

}