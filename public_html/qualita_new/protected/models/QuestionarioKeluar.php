<?php

class QuestionarioKeluar extends CActiveRecord {

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
    var $tipoUtente = "user";

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'questionario_keluar';
    }

    public function rules() {

        return array(
            array('nome, cognome, sede_operativa, scuola,struttura_complessivo', 'required'),
            array('nome, cognome', 'length', 'max' => 30),
            array('anno', 'length', 'max' => 4),
            array('struttura_nome', 'length', 'max' => 2),
            array('sede_operativa, scuola, trasporto_nome', 'length', 'max' => 50),
            array('viaggio_complessivo, struttura_complessivo, rapporto_keluar, trasporto_qualita, trasporto_cortesia, trasporto_tempi, ristorante_servizio, ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni__itinerari, escursioni_guida, neve_noleggio, neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia', 'length', 'max' => 1),
            array('suggerimenti,data_restituzione', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id,struttura_nome, nome, cognome, sede_operativa, scuola, viaggio_complessivo, struttura_complessivo, rapporto_keluar, trasporto_nome, trasporto_qualita, trasporto_cortesia, trasporto_tempi, ristorante_servizio, ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni_itinerari, escursioni_guida, neve_noleggio, neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia, suggerimenti', 'safe', 'on' => 'search'),
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
            'sede_operativa' => 'Sede Operativa',
            'scuola' => 'Scuola',
            'data_consegna' => 'Data Consegna',
            'data_restituzione' => 'Data Restituzione',
            'viaggio_complessivo' => 'Giudizzio Complessivo',
            'struttura_nome' => 'Centro vacanza',
            'struttura_complessivo' => 'Struttura Complessivo',
            'rapporto_keluar' => 'Rapporto Keluar',
            'trasporto_nome' => 'Trasporto Nome',
            'trasporto_qualita' => 'Trasporto Qualita',
            'trasporto_cortesia' => 'Trasporto Cortesia',
            'trasporto_tempi' => 'Trasporto Tempi',
            'ristorante_servizio' => 'Ristorante Servizio',
            'ristorante_cibo' => 'Ristorante Cibo',
            'ristorante_menu' => 'Ristorante Menu',
            'personale_cortesia' => 'Personale Cortesia',
            'personale_disponibilita' => 'Personale Disponibilita',
            'escursioni_itinerari' => 'Escursioni Itinerari',
            'escursioni_guida' => 'Escursioni Guida',
            'neve_noleggio' => 'Neve Noleggio',
            'neve_scuola' => 'Neve Scuola',
            'laboratori_tecnici' => 'Laboratori Tecnici',
            'laboratori_competenze' => 'Laboratori Competenze',
            'consiglia' => 'Consiglia',
            'suggerimenti' => 'Suggerimenti',
            'anno' => 'Anno'
        );
    }

    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->order = 'data_restituzione DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('sede_operativa', $this->sede_operativa, true);
        $criteria->compare('scuola', $this->scuola, true);
        $criteria->mergeWith($this->dateRangeSearchCriteria('data_restituzione', $this->data_restituzione));
        $criteria->compare('viaggio_complessivo', $this->viaggio_complessivo, true);
        $criteria->compare('struttura_complessivo', $this->struttura_complessivo, true);
        $criteria->compare('rapporto_keluar', $this->rapporto_keluar, true);
        $criteria->compare('trasporto_nome', $this->trasporto_nome, true);
        $criteria->compare('trasporto_qualita', $this->trasporto_qualita, true);
        $criteria->compare('trasporto_cortesia', $this->trasporto_cortesia, true);
        $criteria->compare('trasporto_tempi', $this->trasporto_tempi, true);
        $criteria->compare('ristorante_servizio', $this->ristorante_servizio, true);
        $criteria->compare('ristorante_cibo', $this->ristorante_cibo, true);
        $criteria->compare('ristorante_menu', $this->ristorante_menu, true);
        $criteria->compare('personale_cortesia', $this->personale_cortesia, true);
        $criteria->compare('personale_disponibilita', $this->personale_disponibilita, true);
        $criteria->compare('escursioni_itinerari', $this->escursioni_itinerari, true);
        $criteria->compare('escursioni_guida', $this->escursioni_guida, true);
        $criteria->compare('neve_noleggio', $this->neve_noleggio, true);
        $criteria->compare('neve_scuola', $this->neve_scuola, true);
        $criteria->compare('laboratori_tecnici', $this->laboratori_tecnici, true);
        $criteria->compare('laboratori_competenze', $this->laboratori_competenze, true);
        $criteria->compare('consiglia', $this->consiglia, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);
        $criteria->compare('anno', $this->anno, true);
        
        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $criteria->compare('struttura_nome', $user['user_unita']) : $criteria->compare('struttura_nome', $this->struttura_nome) ;
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }
		
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_restituzione)." <br />";
		$tmp .= "<span class='bold'>Giudizio:</span> ".Yii::app()->MyUtils->getSelectValue($data->viaggio_complessivo, "doc_giudizzi")." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->struttura_nome, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}
	
    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_restituzione);
    }

    public function getGiudizioViaggio($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->viaggio_complessivo, "doc_giudizzi");
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura_nome, "doc_unita");
    }

    public function getGiudizioStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura_complessivo, "doc_giudizzi");
    }
    
    public function getAllStats() {

        $allStats = array();
        if ($this->struttura_nome)
            $and = "AND struttura_nome='" . $this->struttura_nome . "'";
        if ($this->anno)
            $and .= "AND anno = '" . $this->anno . "'";
        
        $cons_si_per = 0;
        $cons_no_per = 0;
        $cons_forse_per = 0;

        $cons_si = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='S' " . $and . "")->queryScalar();
        $cons_no = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='F' " . $and . "")->queryScalar();
        $cons_forse = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE consiglia='N' " . $and . "")->queryScalar();
        $allStats['totale'] = Yii::app()->db->createCommand("SELECT count(id) FROM  " . $this->tableName() . " WHERE 1 " . $and . "")->queryScalar();

        if ($cons_si > 0)
            $cons_si_per = $cons_si / $allStats['totale'] * 100;
        if ($cons_no > 0)
            $cons_no_per = $cons_no / $allStats['totale'] * 100;
        if ($cons_forse > 0)
            $cons_forse_per = $cons_forse / $allStats['totale'] * 100;


        $allStats['finale'][] = "{label: 'CERTAMNETE NO', value: " . $cons_forse . "}";
        $allStats['finale'][] = "{label: 'NON SO FORSE', value: " . $cons_no . "}";
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
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_clienti');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = "SELECT q.id , q.nome , q.cognome, q.anno, q.suggerimenti, DATE_FORMAT(q.data_restituzione ,'%d-%m-%Y' ) as restituzione ,
           q.sede_operativa, q.scuola ,q.trasporto_nome ,  u.nome as nome_struttura ,
            gi1.nome as nome_viaggio_complessivo ,
            gi2.nome as nome_struttura_complessivo ,
            gi3.nome as nome_camera_confort  ,
            gi4.nome as nome_camera_pulizia ,
            gi5.nome as nome_rapporto_keluar ,
            gi6.nome as nome_trasporto_qualita ,
            gi7.nome as nome_trasporto_cortesia ,
            gi8.nome as nome_trasporto_tempi ,
            gi9.nome as nome_ristorante_cibo ,
            gi10.nome as nome_ristorante_menu ,
            gi11.nome as nome_ristorante_servizio ,
            gi12.nome as nome_personale_cortesia  ,
            gi13.nome as nome_personale_disponibilita ,
            gi14.nome as nome_escursioni_guida ,
            gi15.nome as nome_neve_noleggio ,
            gi16.nome as nome_neve_scuola ,
            gi17.nome as nome_laboratori_tecnici ,
            gi18.nome as nome_laboratori_competenze ,
            gi19.nome as nome_consiglia ,
             gi20.nome as nome_escursioni_itinerari 
            FROM questionario_keluar AS q 
            LEFT JOIN doc_unita as u ON q.struttura_nome = u.id 
           
            LEFT JOIN doc_giudizzi as gi1 ON q.viaggio_complessivo = gi1.id 
            LEFT JOIN doc_giudizzi as gi2 ON q.struttura_complessivo = gi2.id 
            LEFT JOIN doc_giudizzi as gi3 ON q.camera_confort = gi3.id 
            LEFT JOIN doc_giudizzi as gi4 ON q.camera_pulizia = gi4.id 
            LEFT JOIN doc_giudizzi as gi5 ON q.rapporto_keluar = gi5.id 
            LEFT JOIN doc_giudizzi as gi6 ON q.trasporto_qualita = gi6.id 
            LEFT JOIN doc_giudizzi as gi7 ON q.trasporto_cortesia = gi7.id 
            LEFT JOIN doc_giudizzi as gi8 ON q.trasporto_tempi = gi8.id 
            LEFT JOIN doc_giudizzi as gi9 ON q.ristorante_cibo = gi9.id 
            LEFT JOIN doc_giudizzi as gi10 ON q.ristorante_menu = gi10.id 
            LEFT JOIN doc_giudizzi as gi11 ON q.ristorante_servizio = gi11.id 
            LEFT JOIN doc_giudizzi as gi12 ON q.personale_cortesia = gi12.id 
            LEFT JOIN doc_giudizzi as gi13 ON q.personale_disponibilita = gi13.id 
            LEFT JOIN doc_giudizzi as gi14 ON q.escursioni_guida = gi14.id 
            LEFT JOIN doc_giudizzi as gi15 ON q.neve_noleggio = gi15.id 
            LEFT JOIN doc_giudizzi as gi16 ON q.neve_scuola = gi16.id 
            LEFT JOIN doc_giudizzi as gi17 ON q.laboratori_tecnici = gi17.id 
            LEFT JOIN doc_giudizzi as gi18 ON q.laboratori_competenze = gi18.id 
            LEFT JOIN doc_consiglia as gi19 ON q.consiglia = gi19.id 
            LEFT JOIN doc_giudizzi as gi20 ON q.escursioni_itinerari = gi20.id 
            
            " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }

}