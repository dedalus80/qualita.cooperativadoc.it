<?php

class TimPreiscrizioni extends CActiveRecord{
	
    var $selectFascie       = array();
    var $selectSoggiorni    = array();
    var $selectCentri        = array();
    var $selectTurni        = array();
    var $selectNazioni      = array();
    var $selectProvincie    = array();
    var $selectSocieta      = array();
    var $selectPartenze     = array();
    var $selectFunzioni     = array();
    var $selectSedi         = array();
    var $datiEsportazione = array();
    
    
    public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName()	{
		return 'tim_preiscrizioni';
	}

	public function rules()	{
		return array(
			array('nome, cognome, codice_fiscale, soggiorno, turno,  genitore_nome, genitore_cognome, genitore_codice_fiscale,  cid, iscrizione, reddito, data_iscrizione', 'required'),
			array('nascita_provincia, nazionalita, provincia, soggiorno, turno, partenza, genitore_societa, genitore_funzione, cid, genitore_provincia, secondo_genitore_provincia, iscrizione, reddito', 'numerical', 'integerOnly'=>true),
			array('nome, cognome, genitore_nome, genitore_cognome', 'length', 'max'=>100),
			array('codice_fiscale, telefono, genitore_codice_fiscale, genitore_telefono, genitore_cellulare, secondo_genitore_codice_fiscale', 'length', 'max'=>16),
			array('nascita_luogo, citta, genitore_lavoro, secondo_genitore_nome, secondo_genitore_cognome, secondo_genitore_nascita_luogo', 'length', 'max'=>150),
			array('indirizzo, operatore_supporto_dettaglio, allergie_dettaglio, localita, genitore_email , problema_sanitario_dettaglio ,modulo_conformita,modulo_genitore, modulo_secondo_genitore', 'length', 'max'=>255),
			array('cap, genitore_cap', 'length', 'max'=>5),
			array('codice', 'length', 'max'=>10),
			array('operatore_supporto, allergie,problema_sanitario ,altro_genitore', 'length', 'max'=>1),
			array('id, nome, cognome, codice_fiscale, nascita_luogo, nascita_data, nascita_provincia, nazionalita, indirizzo, citta, provincia, cap, telefono, soggiorno, turno, partenza, operatore_supporto, operatore_supporto_dettaglio, allergie, allergie_dettaglio, genitore_nome, genitore_cognome, genitore_codice_fiscale, genitore_societa, genitore_funzione, cid, localita, genitore_provincia, genitore_cap, genitore_telefono, genitore_cellulare, genitore_email, genitore_lavoro, secondo_genitore_nome, secondo_genitore_cognome, secondo_genitore_codice_fiscale, secondo_genitore_nascita_luogo, secondo_genitore_nascita_data, secondo_genitore_provincia, iscrizione, reddito, data_iscrizione ,problema_sanitario ,problema_sanitario_dettaglio, altro_genitore,codice,modulo_conformita,modulo_genitore, modulo_secondo_genitore', 'safe', 'on'=>'search'),
		);
    }
    
	public function relations()	{
		return array(		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'cognome' => 'Cognome',
			'codice_fiscale' => 'Codice Fiscale',
			'nascita_luogo' => 'Nato/a A',
			'nascita_data' => 'Nato/a Il',
			'nascita_provincia' => 'Provincia',
			'nazionalita' => 'Nazionalita',
			'indirizzo' => 'Indirizzo',
			'citta' => 'Citta',
			'provincia' => 'Provincia',
			'cap' => 'Cap',
			'telefono' => 'Telefono',
			'soggiorno' => 'Soggiorno',
			'turno' => 'Turno',
			'partenza' => 'Partenza',
			'operatore_supporto' => 'Operatore Supporto',
			'operatore_supporto_dettaglio' => 'Dettaglio',
			'allergie' => 'Allergie',
			'allergie_dettaglio' => 'Dettaglio',
			'genitore_nome' => 'Nome',
			'genitore_cognome' => 'Cognome',
			'genitore_codice_fiscale' => 'Codice Fiscale',
			'genitore_societa' => 'Societa',
			'genitore_funzione' => 'Funzione',
			'cid' => 'Cid',
			'localita' => 'Localita',
			'genitore_provincia' => 'Provincia',
			'genitore_cap' => 'Cap',
			'genitore_telefono' => 'Telefono',
			'genitore_cellulare' => 'Cellulare',
			'genitore_email' => 'Email',
			'genitore_lavoro' => 'Sede Lavoro',
			'secondo_genitore_nome' => 'Nome',
			'secondo_genitore_cognome' => 'Cognome',
			'secondo_genitore_codice_fiscale' => 'Codice Fiscale',
			'secondo_genitore_nascita_luogo' => 'Nato a',
			'secondo_genitore_nascita_data' => 'Nato/a Il',
			'secondo_genitore_provincia' => 'Provincia',
			'iscrizione' => 'Iscrizione',
			'reddito' => 'Reddito',
			'data_iscrizione' => 'Data Iscrizione',
            'problema_sanitario' => 'Problema sanitario',
            'problema_sanitario_dettaglio' => 'Dettaglio',
            'altro_genitore' =>'Secondo genitore',
            'codice' => 'Codice',
            'modulo_conformita' => 'Documento',
            'modulo_genitore' => 'Documento primo genitore',
            'modulo_secondo_genitore' => 'Documento secondo genitore',
		);
	}

	public function search()	{
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('cognome',$this->cognome,true);
		$criteria->compare('codice_fiscale',$this->codice_fiscale,true);
		$criteria->compare('nascita_luogo',$this->nascita_luogo,true);
		$criteria->compare('nascita_data',$this->nascita_data,true);
		$criteria->compare('nascita_provincia',$this->nascita_provincia);
		$criteria->compare('nazionalita',$this->nazionalita);
		$criteria->compare('indirizzo',$this->indirizzo,true);
		$criteria->compare('citta',$this->citta,true);
		$criteria->compare('provincia',$this->provincia);
		$criteria->compare('cap',$this->cap,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('soggiorno',$this->soggiorno);
		$criteria->compare('turno',$this->turno);
		$criteria->compare('partenza',$this->partenza);
		$criteria->compare('operatore_supporto',$this->operatore_supporto,true);
		$criteria->compare('operatore_supporto_dettaglio',$this->operatore_supporto_dettaglio,true);
		$criteria->compare('allergie',$this->allergie,true);
		$criteria->compare('allergie_dettaglio',$this->allergie_dettaglio,true);
		$criteria->compare('genitore_nome',$this->genitore_nome,true);
		$criteria->compare('genitore_cognome',$this->genitore_cognome,true);
		$criteria->compare('genitore_codice_fiscale',$this->genitore_codice_fiscale,true);
		$criteria->compare('genitore_societa',$this->genitore_societa);
		$criteria->compare('genitore_funzione',$this->genitore_funzione);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('localita',$this->localita,true);
		$criteria->compare('genitore_provincia',$this->genitore_provincia);
		$criteria->compare('genitore_cap',$this->genitore_cap,true);
		$criteria->compare('genitore_telefono',$this->genitore_telefono,true);
		$criteria->compare('genitore_cellulare',$this->genitore_cellulare,true);
		$criteria->compare('genitore_email',$this->genitore_email,true);
		$criteria->compare('genitore_lavoro',$this->genitore_lavoro,true);
		$criteria->compare('secondo_genitore_nome',$this->secondo_genitore_nome,true);
		$criteria->compare('secondo_genitore_cognome',$this->secondo_genitore_cognome,true);
		$criteria->compare('secondo_genitore_codice_fiscale',$this->secondo_genitore_codice_fiscale,true);
		$criteria->compare('secondo_genitore_nascita_luogo',$this->secondo_genitore_nascita_luogo,true);
		$criteria->compare('secondo_genitore_nascita_data',$this->secondo_genitore_nascita_data,true);
		$criteria->compare('secondo_genitore_provincia',$this->secondo_genitore_provincia);
		$criteria->compare('iscrizione',$this->iscrizione);
		$criteria->compare('reddito',$this->reddito);
		$criteria->compare('data_iscrizione',$this->data_iscrizione,true);
        $criteria->compare('problema_sanitario',$this->problema_sanitario,true);
        $criteria->compare('problema_sanitario_dettaglio',$this->problema_sanitario_dettaglio,true);
        $criteria->compare('altro_genitore',$this->altro_genitore,true);
        $criteria->compare('codice',$this->codice,true);
        $criteria->compare('modulo_conformita',$this->modulo_conformita,true);
        $criteria->compare('modulo_genitore',$this->modulo_genitore,true);
        $criteria->compare('modulo_secondo_genitore',$this->modulo_secondo_genitore,true);
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function setDefaultValues(){
        $this->selectFascie     =  Yii::app()->MyUtils->getSelect('tim_fascie','id');
        $this->selectTurni      =  Yii::app()->MyUtils->getSelect('tim_turni');
        $this->selectSoggiorni  = Yii::app()->MyUtils->getSelect('tim_soggiorni');
        $this->selectNazioni    = Yii::app()->MyUtils->getSelect('doc_nazioni');
        $this->selectProvincie  = Yii::app()->MyUtils->getSelect('sp_province');
        $this->selectCentri     = Yii::app()->MyUtils->getSelect('tim_centri');
        $this->selectFunzioni   = Yii::app()->MyUtils->getSelect('tim_funzioni');
        $this->selectPartenze   = Yii::app()->MyUtils->getSelect('tim_partenze');
        $this->selectSocieta    = Yii::app()->MyUtils->getSelect('tim_societa');
        $this->selectSedi       = Yii::app()->MyUtils->getSelect('tim_sedi');
    }
        
    public function getFascia($data, $id){
       return Yii::app()->MyUtils->getSelectValue($data->reddito, "tim_fascie");
    }
    
    public function getSoggiorno($data, $id){
        return Yii::app()->MyUtils->getSelectValue($data->iscrizione, "tim_soggiorni");
    }
    
    public function getDettaglio($data , $id){
		
		$tmp  .= "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->reverseDate($data->data_iscrizione)." <br />";
		$tmp  .= "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp  .= "<span class='bold'>Soggiorno</span> ".$this->getSoggiorno($data, $id)." <br />";
		$tmp  .= "<span class='bold'>Fascia</span> ".str_replace("<br />"," ",$this->getFascia($data, $id));
		return $tmp;  
	}
	
    public function getDataIscrizione($data, $t) {
        return Yii::app()->MyUtils->reverseDateTime($data->data_iscrizione);
    }
    
    public function getEsportazione($anni = null) {

        $query = "SELECT i.*, DATE_FORMAT(tt.data_inizio , '%d-%m-%Y') AS inizio_turno ,DATE_FORMAT(tt.data_fine , '%d-%m-%Y') AS fine_turno  ,
        DATE_FORMAT(i.secondo_genitore_nascita_data , '%d-%m-%Y') AS nascita_sg  , DATE_FORMAT(i.data_iscrizione , '%d-%m-%Y') AS data_insert , 
        DATE_FORMAT(i.nascita_data , '%d-%m-%Y') AS nascita , DATE_FORMAT(i.data_iscrizione , '%H-%s') AS ora_insert , 
         tt.codice as codice_turno , ts.nome as nome_iscrizione , ce.nome as nome_soggiorno , na.nome as nome_nazione , pr.nome as nome_provincia_nascita ,ce.nome as nome_centro , fa.descrizione as nome_fascia , se.nome as nome_sede ,
         fu.nome as nome_funzione , pa.nome as nome_partenza , so.nome as nome_societa  , pri.nome as nome_provincia , prs.nome as nome_provincia_sg , prg.nome as nome_provincia_g  
         FROM " . $this->tableName() . " AS i
         LEFT JOIN tim_turni AS tt  ON i.turno =  tt.id 
         LEFT JOIN tim_soggiorni AS ts  ON i.iscrizione =  ts.id 
         LEFT JOIN doc_nazioni AS na  ON i.nazionalita =  na.id 
         LEFT JOIN sp_province AS pr  ON i.nascita_provincia =  pr.id 
         LEFT JOIN sp_province AS pri  ON i.provincia =  pri.id 
         LEFT JOIN sp_province AS prs  ON i.secondo_genitore_provincia =  prs.id 
         LEFT JOIN sp_province AS prg  ON i.genitore_provincia =  prg.id 
         LEFT JOIN tim_centri AS ce  ON i.soggiorno =  ce.id 
         LEFT JOIN tim_funzioni AS fu  ON i.genitore_funzione =  fu.id 
         LEFT JOIN tim_partenze AS pa  ON i.partenza =  pa.id 
         LEFT JOIN tim_societa AS so  ON i.genitore_societa =  so.id 
         LEFT JOIN tim_fascie AS fa  ON i.reddito =  fa.id 
         LEFT JOIN tim_sedi AS se  ON i.genitore_lavoro=  se.id 
        ";
         
        $dati = Yii::app()->db->createCommand($query." ORDER BY id")->queryAll();
        return $dati;
    }
    
    
}