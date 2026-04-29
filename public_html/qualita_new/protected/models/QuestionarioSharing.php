<?php

class QuestionarioSharing extends CActiveRecord {

    var $datiEsportazione = array();
    var $stats = array();
    var $dataStart;
    var $dataStop;
    var $selectStrutture = array();
    var $selectConsiglia = array();
    var $selectGiudizzi = array();
    var $selectAnni = array();
    var $struttura  = array();
    var $tipoUtente = "user"; 

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_sharing';
    }

    public function rules() {
        return array(
            array('nome, cognome', 'required'),
            array('nome, cognome', 'length', 'max' => 30),
            array('anno', 'length', 'max' => 4),
            array('vacanza, struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, consiglia', 'length', 'max' => 1),
            array('suggerimenti,data_restituzione,soggiorno', 'safe'),
            array('id, nome, cognome, vacanza, struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, consiglia, suggerimenti', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors() {
        return array(
            'dateRangeSearch' => array(
                'class' => 'application.components.behaviors.EDateRangeSearchBehavior',
            ),
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
            'data_consegna' => 'Data Consegna',
            'data_restituzione' => 'Data Restituzione',
            'vacanza' => 'Vacanza',
            'struttura_pulizia' => 'Struttura Pulizia',
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
            'consiglia' => 'Consiglia',
            'suggerimenti' => 'Suggerimenti',
            'soggiorno' => 'Soggiorno',
            'anno' => 'Anno',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_restituzione DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('anno', $this->anno, true);
        $criteria->mergeWith($this->dateRangeSearchCriteria('data_restituzione', $this->data_restituzione));
        $criteria->compare('vacanza', $this->vacanza, true);
        $criteria->compare('struttura_pulizia', $this->struttura_pulizia, true);
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
        $criteria->compare('consiglia', $this->consiglia, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        
        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $criteria->compare('soggiorno', $user['user_unita']) : $criteria->compare('soggiorno', $this->soggiorno) ;
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_restituzione)." <br />";
		$tmp .= "<span class='bold'>Giudizio:</span> ".Yii::app()->MyUtils->getSelectValue($data->vacanza, "doc_giudizzi")." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
		
    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_restituzione);
    }
    
    public function getGiudizioVacanza($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->vacanza, "doc_giudizzi");
    }

    public function getSoggiorno($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita");
    }

    public function getGiudizioStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura_complessivo, "doc_giudizzi");
    }

    public function getAllStats() {

        $allStats = array();
        if ($this->soggiorno)
            $and = "AND soggiorno='" . $this->soggiorno . "'";
        if ($this->anno)
            $and .= "AND anno = '" . $this->anno . "'";

        $cons_si_per = 0;
        $cons_no_per = 0;
        $cons_forse_per = 0;

        $cons_si = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='S' " . $and . "")->queryScalar();
        $cons_forse = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='F' " . $and . "")->queryScalar();
        $cons_no = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='N' " . $and . "")->queryScalar();
        $allStats['totale'] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE 1 " . $and . "")->queryScalar();

        if ($cons_si > 0)
            $cons_si_per = $cons_si / $allStats['totale'] * 100;
        if ($cons_no > 0)
            $cons_no_per = $cons_no / $allStats['totale'] * 100;
        if ($cons_forse > 0)
            $cons_forse_per = $cons_forse / $allStats['totale'] * 100;


        $allStats['finale'][] = "{label: 'CERTAMNETE NO', value: " . $cons_no . "}";
        $allStats['finale'][] = "{label: 'NON SO FORSE', value: " . $cons_forse . "}";
        $allStats['finale'][] = "{label: 'CERTAMENTE SI', value: " . $cons_si . "}";


        $allStats["consiglierebbe_data"][] = array("label" => 'CERTAMNETE NO', "valore" => $cons_no, 'percentuale' => number_format($cons_no_per, 2));
        $allStats["consiglierebbe_data"][] = array("label" => 'NON SO FORSE', "valore" => $cons_forse, 'percentuale' => number_format($cons_forse_per, 2));
        $allStats["consiglierebbe_data"][] = array("label" => 'CERTAMENTE SI', "valore" => $cons_si, 'percentuale' => number_format($cons_si_per, 2));

        foreach ($this->attributes as $name => $val) {

            $ins_per = 0;
            $suff_per = 0;
            $buon_per = 0;
            $otti_per = 0;

            $ins = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='I' " . $and . "")->queryScalar();
            $suff = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='S' " . $and . "")->queryScalar();
            $buon = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='B' " . $and . "")->queryScalar();
            $otti = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "='E' " . $and . "")->queryScalar();

            if ($ins > 0)
                $ins_per = $ins / $allStats['totale'] * 100;
            if ($suff > 0)
                $suff_per = $suff / $allStats['totale'] * 100;
            if ($buon > 0)
                $buon_per = $buon / $allStats['totale'] * 100;
            if ($otti > 0)
                $otti_per = $otti / $allStats['totale'] * 100;


            $allStats[$name][] = "{label: 'INSUFFICIENTE', value: " . $ins . "}";
            $allStats[$name][] = "{label: 'SUFFICIENTE', value: " . $suff . "}";
            $allStats[$name][] = "{label: 'BUONO', value: " . $buon . "}";
            $allStats[$name][] = "{label: 'ECCELLENTE', value: " . $otti . "}";

            $allStats[$name . "_data"][] = array("label" => 'INSUFFICIENTE', "valore" => $ins, 'percentuale' => number_format($ins_per, 2));
            $allStats[$name . "_data"][] = array("label" => 'SUFFICIENTE', "valore" => $suff, 'percentuale' => number_format($suff_per, 2));
            $allStats[$name . "_data"][] = array("label" => 'BUONO', "valore" => $buon, 'percentuale' => number_format($buon_per, 2));
            $allStats[$name . "_data"][] = array("label" => 'ECCELLENTE', "valore" => $otti, 'percentuale' => number_format($otti_per, 2));

            $allStats['exist'][$name] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE " . $name . "!='' " . $and . "")->queryScalar();
        }
        return $allStats;
    }
    
    public function setSelect() {
        $this->selectGiudizzi = Yii::app()->MyUtils->getSelect('doc_giudizzi');
        $this->selectConsiglia = Yii::app()->MyUtils->getSelect('doc_consiglia');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }
    
    public function getEsportazione($anni = null) {
        
        if($anni && $anni !='0,0,0,0,0')
           $WHERE = " WHERE q.anno IN (".$anni.") ";
        
        $query = "SELECT q.id , q.nome , q.cognome, q.email,q.cellulare , DATE_FORMAT(q.data_arrivo ,'%d-%m-%Y' ) as arrivo ,DATE_FORMAT(q.data_partenza ,'%d-%m-%Y' ) as partenza ,
            c.nome as nome_conoscenza  ,q.anno,q.suggerimenti, q.giorni_permanenza ,  tc.nome as tipologia_cliente  ,  DATE_FORMAT(q.data_restituzione ,'%d-%m-%Y' ) as restituzione ,
            gi1.nome as nome_vacanza ,
            gi2.nome as nome_struttura_pulizia ,
            gi3.nome as nome_struttura_complessivo ,
            gi4.nome as nome_stanza_confort  ,
            gi5.nome as nome_stanza_arredi ,
            gi6.nome as nome_stanza_pulizia ,
            gi7.nome as nome_stanza_complessivo ,
            gi8.nome as nome_ristorante_servizio ,
            gi9.nome as nome_ristorante_attesa ,
            gi10.nome as nome_ristorante_cibo ,
            gi11.nome as nome_ristorante_menu ,
            gi12.nome as nome_ristorante_complessivo ,
            gi13.nome as nome_personale_cortesia  ,
            gi14.nome as nome_personale_professionalita ,
            gi15.nome as nome_personale_complessivo ,
            gi16.nome as nome_consiglia ,
            gi17.nome as nome_attivita_complessivo 
            
            FROM questionario_sharing AS q 
            LEFT JOIN doc_giudizzi as gi1 ON q.vacanza = gi1.id 
            LEFT JOIN doc_giudizzi as gi2 ON q.struttura_pulizia = gi2.id 
            LEFT JOIN doc_giudizzi as gi3 ON q.struttura_complessivo = gi3.id 
            LEFT JOIN doc_giudizzi as gi4 ON q.stanza_confort = gi4.id 
            LEFT JOIN doc_giudizzi as gi5 ON q.stanza_arredi = gi5.id 
            LEFT JOIN doc_giudizzi as gi6 ON q.stanza_pulizia = gi6.id 
            LEFT JOIN doc_giudizzi as gi7 ON q.stanza_complessivo = gi7.id 
            LEFT JOIN doc_giudizzi as gi8 ON q.ristorante_servizio = gi8.id 
            LEFT JOIN doc_giudizzi as gi9 ON q.ristorante_attesa = gi9.id 
            LEFT JOIN doc_giudizzi as gi10 ON q.ristorante_cibo = gi10.id 
            LEFT JOIN doc_giudizzi as gi11 ON q.ristorante_menu = gi11.id 
            LEFT JOIN doc_giudizzi as gi12 ON q.ristorante_complessivo = gi12.id 
            LEFT JOIN doc_giudizzi as gi13 ON q.personale_cortesia = gi13.id 
            LEFT JOIN doc_giudizzi as gi14 ON q.personale_professionalita = gi14.id 
            LEFT JOIN doc_giudizzi as gi15 ON q.personale_complessivo = gi15.id 
            LEFT JOIN doc_consiglia as gi16 ON q.consiglia = gi16.id 
            LEFT JOIN doc_giudizzi as gi17 ON q.attivita_complessivo = gi16.id 
            
            LEFT JOIN doc_conoscenza as c ON q.conoscenza = c.id 
            LEFT JOIN doc_tipologie_clienti  as tc ON q.tipologia_cliente = c.id 
            ".$WHERE;
        
        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }
    
    
}