<?php

class AzioniVerifiche extends CActiveRecord {

    var $selectTipologie    = array();
    var $selectStrutture    = array();
    var $selectIncaricati   = array();
    var $selectProcessi     = array();
    var $selectAnni = array();
	var $userInfo   = array();
    var $selectVerifiche = array("P" => "Prima verifica", "S" => "Seconda verifica");
    var $selectCVerifiche = array("P" => "1", "S" => "2");
    var $stats = array();
    var $datiEsportazione = array();
    var $datiAdmin = '';
    var $nome_struttura = "";
    var $struttura = "";
    var $prima_verifica = "";
    var $seconda_verifica = "";
    var $indicatori = array();
    var $calendario = "";
    var $today = false;

    public function tableName() {
        return 'db_verifiche';
    }

    public function rules() {
        return array(
            array('unita_operativa, data_prevista,tipo_verifica, incaricato', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('unita_operativa,tipo_verifica, incaricato', 'numerical', 'integerOnly' => true),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('data_prevista, data_effettiva,data_prevista_fine ', 'length', 'max' => 10),
            array('codice', 'length', 'max' => 100),
            array('completa', 'length', 'max' => 1),
            array('anno', 'length', 'max' => 4),
            array('tipo_processo , tipo_verifica, avvisi', 'length', 'max' => 3),
            array('dettaglio , diario , verbale', 'length', 'max' => 255),
            array('data, ora_inizio, ora_fine, note', 'safe'),
            array('id,data_prevista,avvisi,anno, data_effettiva,data_prevista_fine, dettaglio, verifica, unita_operativa,tipo_verifica ,tipo_proceso , codice , incaricato , completa ,compilatore, ora_inizio, ora_fine, data ', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'verificheAnswers' => array(self::HAS_MANY, 'VerificheAnswers', 'verificaId'),
            'tipologiaVerifica' => array(self::BELONGS_TO, 'TipologieVerifiche', 'tipo_verifica'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'unita_operativa' => '<span class="hidden-480">Unita Operativa</span><span class="only-phone">Struttura</span>',
            'codice' => 'Codice',
            'tipo_verifica' => 'Tipo<span class="hidden-480"> verifica</span>',
            'tipo_processo' => 'Processo',
            'verifica' => 'Verifica',
            'data_prevista' => 'Data prevista',
            'data_prevista_fine' => 'Data fine',
            'data_effettiva' => 'Data esecuzione',
            'stato' => 'Stato verifica',
            'completa' => 'Completa',
            'dettaglio' => 'Specificare',
            'non_conformita' => 'Non conformit&agrave;',
            'incaricato' => 'Incaricato',
            'compilatore' => 'Creata da',
			'diario' => 'Diario Verifica',
			'verbale' => 'Verbale Verifica',
            'avvisi' => 'Inizio avvisi',
            'anno' => 'Anno',
            'ora_inizio' => 'Ora Inizio',
            'ora_fine' => 'Ora Fine',
            'data' => 'Data',
            'tipo_valutazione' => 'Tipo Valutazione',
            'apertura_nc' => 'Apertura Nc',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->with = array('tipologiaVerifica');
        $criteria->order = "t.id DESC";
        $criteria->compare('id', $this->id);
        $criteria->compare('tipo_verifica', $this->tipo_verifica);
        $criteria->compare('tipo_processo', $this->tipo_processo);
        $criteria->compare('data_prevista', $this->data_prevista, true);
        $criteria->compare('data_prevista_fine', $this->data_prevista_fine, true);
        $criteria->compare('data_effettiva', $this->data_effettiva, true);
        $criteria->compare('stato', $this->stato, true);
        $criteria->compare('completa', $this->completa, true);
        $criteria->compare('verifica', $this->verifica, true);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('dettaglio', $this->dettaglio, true);
        $criteria->compare('non_conformita', $this->non_conformita, true);
        $criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('incaricato', $this->incaricato);
        $criteria->compare('compilatore', $this->compilatore);
        $criteria->compare('diario', $this->diario);
        $criteria->compare('verbale', $this->verbale);
        $criteria->compare('avvisi', $this->verbale);
        $criteria->compare('ora_inizio', $this->ora_inizio, true);
        $criteria->compare('ora_fine', $this->ora_fine, true);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('tipologiaVerifica.is_hidden', 'N', true);

		$dati = Yii::app()->MyUtils->getUserInfo();
		
		if($dati['user_type'] =='7') {
            //$criteria->addInCondition('id', Yii::app()->MyUtils->getIncaricatiVerificaInterni(), 'AND');
            $criteria->addInCondition('t.id', Yii::app()->MyUtils->getIncaricatiVerifica(), 'AND');
        }else {
			if (!$this->unita_operativa)
                $criteria->addInCondition('unita_operativa', Yii::app()->MyUtils->getUserStruttura(), 'AND');
		}
		
        if (!$this->anno)
            $criteria->compare('anno', date("Y"), true);
        else
            $criteria->compare('anno', $this->anno, true);

        return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 25,
                    ),
                ));
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }
	
	public function getDettaglio($data , $id){
		
		if($data->completa == 'Y'){
			if($data->diario && $data->verbale)
				$class ='green';
			else
				$class ='red';
		}
        
        $data->data_prevista_fine ? $fine = "Al ".Yii::app()->MyUtils->getItaDate($data->data_prevista_fine):"";
		
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_prevista)." ".$fine."<br />";
		$tmp .= "<span class='bold'>Codice:</span> <span class='".$class." '>".$data->codice."</span> <br />";
		$tmp .= "<span class='bold'>Tipo:</span> ".Yii::app()->MyUtils->getSelectValue($data->tipo_verifica, "doc_tipologie_verifiche")." <br />";
		$tmp .= "<span class='bold'>Struttura:</span> ".Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Incaricato:</span> ".Yii::app()->MyUtils->getSelectValue($data->incaricato, "dettaglio_admin")." <br /> ";
		$tmp .= "<span class='bold'>Stato:</span> ".$this->getCompleta($data, $id)."  ".$this->getStato($data, $id);
		return $tmp;
	}
		
    public function getDataPrevista($data, $id) {
       return $data->data_prevista_fine ?  "Dal ".Yii::app()->MyUtils->reverseDate($data->data_prevista)." Al ".Yii::app()->MyUtils->reverseDate($data->data_prevista_fine): Yii::app()->MyUtils->reverseDate($data->data_prevista);
    }

    public function getDataEffettiva($data, $id) {
        return Yii::app()->MyUtils->reverseDate($data->data_effettiva);
    }

    public function getVerificaTipo($data, $id) {
        return $this->selectVerifiche[$data->verifica];
    }
    
    public function getIncaricato($data, $id) {
        return Yii::app()->MyUtils->getSelectValue($data->incaricato, "dettaglio_admin");
    }
    
    public function getTipologia($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->tipo_verifica, "doc_tipologie_verifiche");
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }
	
	public function getAllegato($tipo){
		return Yii::app()->db->createCommand("SELECT ".$tipo." FROM ".$this->tableName()." WHERE id ='".$this->id."' ")->queryScalar();
		
	}
	
	public function getCode($data , $id){
		
		if($data->completa == 'Y'){
			if($data->diario && $data->verbale)
				$class ='green';
			else
				$class ='red';
		}
		return "<span class='".$class." bold'>".$data->codice."</span>";
		
	}
		
    public function getCompleta($data, $t) {
        return $data->completa == 'Y' ? "<i class='ace-icon fa fa-check  bigger-110 icon-only  green btn  btn-circle circle-blue' data-toggle='tooltip' data-placement='top' title='Verifica ispettiva completata'  ></i>" : "";
    }

    public function getStato($data, $id) {
        return $data->stato ? $data->stato . " - <b>" . $data->non_conformita . " NC</b>" : "";
    }

    public function getLinkVerifica($data, $id) {
		
		$link = "";
        $dettagli = $this->getTipoVerifica($data->tipo_verifica);
        
		if($data->tipo_verifica !='6' && $data->tipo_verifica !='8'){
//~ 			$exist = Yii::app()->db->createCommand("SELECT id FROM " . $dettagli['table'] . " WHERE id_verifica ='" . $data->id . "' ")->queryScalar();
			$exist = Yii::app()->db->createCommand("SELECT id FROM " . $dettagli['table'] . " WHERE id ='" . $data->id . "' ")->queryScalar();
        
			if ($exist) {
            	$class = 'green';
            	$action = 'Aggiorna';
        	} else {
            	$class = '';
            	$action = 'Esegui';
        	}
        
        	$link =  "<a class='check-verifica-btn' data-idrefer='" . $data->id . "'  data-refer='" . $dettagli['controller'] . "' href='#'><i class='ace-icon fa fa-check  bigger-110 icon-only  " . $class . " btn  btn-circle circle-blue' data-toggle='tooltip' data-placement='top' title='" . $action . " verifica ispettiva'  ></i></a>";
		}
		
		return $link;
    }

    /*public function getTipoVerifica($tipo) {

        $dati = array();

        switch ($tipo) {
            case"1":
                $controller = "AzioniVerificheManutenzione";
                $table = "db_verifiche_manutenzione";
                break;
            case"2":
                $controller = "AzioniVerificheAmministrative";
                $table = "db_verifiche_amministrative";
                break;
            case"3":
                $controller = "AzioniVerificheSicurezza";
                $table = "db_verifiche_sicurezza";
                break;
            case"4":
                $controller = "AzioniVerificheRistorazione";
                $table = "db_verifiche_ristorazione";
                break;
            case"5":
                $controller = "AzioniVerificheEducative";
                $table = "db_verifiche_educative";
                break;
			case"7":
                $controller = "AzioniVerificheAmbientale";
                $table = "db_verifiche_ambientale";
                break;	
       }

        $dati['controller'] = $controller;
        $dati['table'] = $table;
        return $dati;
    }*/
	
	public function getTipoVerifica($tipo) {

        /*$dati = array();

        switch ($tipo) {
            case"1":
                $controller = "AzioniVerificheManutenzione";
                $table = "db_verifiche_manutenzione";
                break;
            case"2":
                $controller = "AzioniVerificheAmministrative";
                $table = "db_verifiche_amministrative";
                break;
            case"3":
                $controller = "AzioniVerificheSicurezza";
                $table = "db_verifiche_sicurezza";
                break;
            case"4":
                $controller = "AzioniVerificheRistorazione";
                $table = "db_verifiche_ristorazione";
                break;
            case"5":
                $controller = "AzioniVerificheEducative";
                $table = "db_verifiche_educative";
                break;
			case"7":
                $controller = "AzioniVerificheAmbientale";
                $table = "db_verifiche_ambientale";
                break;	
       }

        $dati['controller'] = $controller;
        $dati['table'] = $table;*/
		
		$dati['controller'] = 'AzioniVerifiche';
        $dati['table'] = 'db_verifiche';
        return $dati;
    }

    public function rimuoviInspezioni() {
        $dati = $this->getTipoVerifica($this->tipo_verifica);
        Yii::app()->db->createCommand("DELETE FROM " . $dati['table'] . " WHERE id_verifica ='" . $this->id . "'  ")->execute();
    }

    public function checkVerifica() {
        $dati = $this->getTipoVerifica($this->tipo_verifica);
        /*$exist = Yii::app()->db->createCommand("SELECT id FROM " . $dati['table'] . "  WHERE id_verifica ='" . $this->id . "'  ")->queryScalar();
        $exist = Yii::app()->db->createCommand("SELECT id FROM " . $dati['table'] . "  WHERE id ='" . $this->id . "'  ")->queryScalar();
        if (!$exist) {
            Yii::app()->db->createCommand("INSERT INTO " . $dati['table'] . " (id_verifica,codice_verifica,unita_operativa,autore,data,ora_inizio,anno) VALUE ('" . $this->id . "','" . $this->codice . "' ,'" . $this->unita_operativa . "' ,'" . $this->incaricato . "', '".date("Y-m-d")."', '".date("H:i:00")."','".date("Y")."' )  ")->execute();
            $exist = Yii::app()->db->getLastInsertId();
        }
        $dati['idverifica'] = $exist;
        */
		
		$dati['idverifica'] = $this->id;
		
		return $dati;
    }

    public function getCodice() {

        $a = Yii::app()->MyUtils->getSelectValue($this->unita_operativa, "qualita_strutture_codice");
        $b = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $this->tableName() . "  WHERE unita_operativa='" . $this->unita_operativa . "' AND tipo_verifica ='" . $this->tipo_verifica . "' ")->queryScalar() + 1;
        $c = Yii::app()->MyUtils->getSelectValue($this->tipo_verifica, "qualita_tipologie_verifiche_codice");
        return $a . "-" . $c . "-" . date("Y") . "-VERIFICA-N-" . $b;
    }

    public function getVerifica($id) {
        $verifiche = array();
        $query = "SELECT tipo_verifica,tipo_processo , verifica, dettaglio , codice, unita_operativa,
        DATE_FORMAT(data_prevista, '%d-%m-%Y' ) as data_verifica , DATE_FORMAT(data_prevista_fine, '%d-%m-%Y' ) as data_verifica_fine ,incaricato  
        
        FROM " . $this->tableName() . " WHERE id ='" . $id . "' ";
        $tmp = Yii::app()->db->createCommand($query)->queryRow();
        $verifiche['unita_operativa'] = $tmp['unita_operativa'];
        $verifiche['nome_unita'] = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$tmp['unita_operativa']."' ")->queryScalar();
        $verifiche['tipo_verifica'] = $tmp['tipo_verifica'];
        $verifiche['tipo_processo'] = $tmp['tipo_processo'];
        $verifiche['codice'] = $tmp['codice'];
        $verifiche['prima_verifica'] = $tmp['data_verifica'];
        $verifiche['seconda_verifica'] = $tmp['data_verifica_fine'];
        $verifiche['incaricato'] = $tmp['incaricato'];
        $verifiche['dettaglio'] = $tmp['dettaglio'];
        
        return $verifiche;
    }

    public function isCodice($codice, $id = NULL) {

        if ($id)
            $and = "AND id !='" . $id . "'";

        $exist = Yii::app()->db->createCommand("SELECT codice FROM " . $this->tableName() . " WHERE codice ='" . $codice . "' " . $and . "  ")->queryScalar();
        if ($exist)
            return true;
        else
            return false;
    }
        
    public function addVerifica($tipo, $data, $codice, $fine = NULL) {
        $query = " INSERT INTO " . $this->tableName() . " (codice,unita_operativa,verifica,tipo_verifica,anno,data_prevista, data_prevista_fine, incaricato,dettaglio, tipo_processo) VALUE ";
        $query .="('" . $codice . "', '" . $this->unita_operativa . "' ,'" . $tipo . "' ,'" . $this->tipo_verifica . "' ,'" . date("Y") . "' , '" . Yii::app()->MyUtils->reverseDate($data) . "' , '" . Yii::app()->MyUtils->reverseDate($fine) . "' , '".$this->incaricato."','".$this->dettaglio."','".$this->tipo_processo."' )";
        Yii::app()->db->createCommand($query)->execute();
        $ID = Yii::app()->db->getLastInsertId();
        
        // MONDO NOTIFICA PUSH
        Yii::app()->MyPush->newNotificaton($this->tableName(), "ve", "create", $ID);
        
        // MANDO EMAIL ALL'INCARICATO
        Yii::app()->MyEmails->sendEmailVerifica("verifica",$ID);
        
        return $ID ;
    }

    public function setVerifica($id) {

        $booking = "";
        $dati['stato'] = 'OK';
        $dati['messaggio'] = "";
        $dati['remove'] = "N";
        $dati['newDate'] = "N";
        $dati['error'] = "";

        $idVerifiche = array();
        $newVerifiche = array();
        $oldVerifiche = array();

        if ($id == 'new') {
            $this->verifica = "P";
            $codice = $this->getCodice();
            $idVerifiche[] = $this->addVerifica("P", $this->prima_verifica, $codice);
            
        } else {

            $verifica = Yii::app()->db->createCommand("SELECT * FROM " . $this->tableName() . "  WHERE id ='" . $id . "' ")->queryRow();
            $this->verifica = $verifica['verifica'];
            $codice = $this->getCodice();
            
            $query = "UPDATE " . $this->tableName() . " SET tipo_processo ='" . $this->tipo_processo . "'  ,  tipo_verifica ='" . $this->tipo_verifica . "'  , unita_operativa='" . $this->unita_operativa . "' , incaricato = '".$this->incaricato."'  ,dettaglio ='".$this->dettaglio."'    ";
            $query .= " , data_prevista ='" . Yii::app()->MyUtils->reverseDate($this->prima_verifica) . "',  data_prevista_fine ='" . Yii::app()->MyUtils->reverseDate($this->seconda_verifica) . "', 
             anno ='" . date("Y") . "'   WHERE id ='" . $id . "' ";
            Yii::app()->db->createCommand($query)->execute();
            $dati['remove'] = "Y";
            $oldVerifiche[] = $id;
            $idVerifiche[] = $id;
            
            // INVIO NOTIFICHE PUSH
            Yii::app()->MyPush->newNotificaton($this->tableName(), "ve", "update", $id);
            
			// MANDO EMAIL ALL'INCARICATO
        	Yii::app()->MyEmails->sendEmailVerifica("verifica",$id);
            
        }

        if (count($idVerifiche) > 0) {
            for ($x = 0; $x < count($idVerifiche); $x++) {

                $query = " SELECT s.*, DATE_FORMAT(s.data_prevista ,'%Y') as anno_start , DATE_FORMAT(s.data_prevista ,'%d-%m-%Y') as data_anno , DATE_FORMAT(s.data_prevista ,'%d')  as giorno_start , DATE_FORMAT(s.data_prevista ,'%m')  as mese_start ,";
                $query .= " DATE_FORMAT(s.data_prevista_fine ,'%Y') as anno_stop , DATE_FORMAT(s.data_prevista_fine ,'%d-%m-%Y') as fine_anno , DATE_FORMAT(s.data_prevista_fine ,'%d')  as giorno_stop , DATE_FORMAT(s.data_prevista_fine ,'%m')  as mese_stop ,";
                $query .= "  t.nome  as tipo , t.colore , u.nome as unita  FROM " . $this->tableName() . " AS s  LEFT JOIN  doc_tipologie_verifiche AS t ON s.tipo_verifica = t.id  LEFT JOIN doc_unita as  u  ON s.unita_operativa = u.id    WHERE s.id='" . $idVerifiche[$x] . "'";
                $dettaglio = Yii::app()->db->createCommand($query)->queryRow();
                $numero = explode("-", $dettaglio['codice']);

                $tmp['titolo'] = $dettaglio['unita'] . "<br> VERIFICA " . $dettaglio['tipo'] . " N " . $numero[6];
                $tmp['color'] = Yii::app()->db->createCommand("SELECT nome FROM doc_colori WHERE id ='" . $dettaglio['colore'] . "' ")->queryScalar();
                $tmp['id'] = $idVerifiche[$x];
                
                $tmp['data_prevista'] = $dettaglio['data_prevista'];
                $tmp['data_prevista_fine'] = $dettaglio['data_prevista_fine'];
                
                $tmp['mex'] = $tmp['titolo'] . " inserita con successo";
                
                $tmp['data_in'] =  $this->getjavascriptDate($tmp['data_prevista']) . "-12-00";
                $tmp['data_prevista_fine']  ? $tmp['data_out'] = $this->getjavascriptDate($tmp['data_prevista_fine']) . "-12-00" : $tmp['data_out'] = $tmp['data_in'];
                
                $tmp['data_anno'] = $dettaglio['data_anno'];
                
                
                $tmp['small'] = "<a href='javascript:checkVerifica(" . $dettaglio['id'] . ")' class='verifica' data-refer='" . $dettaglio['id'] . "' id='verifica-" . $dettaglio['id'] . "' style='background-color:" . Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='" . $dettaglio['colore'] . "' ")->queryScalar() . "'>" . $numero[0] . "</a>";
                $newVerifiche[] = $tmp;
            }

            $dati['newVerifiche'] = $newVerifiche;
            $dati['newDate'] = 'Y';
        }


        if (count($idVerifiche) > 0)
            $dati['idRemove'] = implode(",", $oldVerifiche);
        if ($error)
            $dati['error'] = $error;

        return $dati;
    }

    function getjavascriptDate($date) {
        $data = explode("-", $date);
        return date("Y-m-d", mktime(0, 0, 0, $data[1] - 1, $data[2], $data[0]));
    }

    function getBookingDate($date, $type) {

        $data = explode("-", $date);
        if ($type == 'start')
            return date("Y-m-d", mktime(0, 0, 0, $data[1], $data[2] + 1, $data[0]));
        else
            return date("Y-m-d", mktime(0, 0, 0, $data[1], $data[2] - 1, $data[0]));
    }

    public function setDefaultValue() {
        $this->datiAdmin        = Yii::app()->MyUtils->getUserInfo();
        $this->selectStrutture  = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectTipologie  = Yii::app()->MyUtils->getSelect('doc_tipologie_verifiche');
        $this->selectProcessi   = Yii::app()->MyUtils->getSelect('doc_tipologie_processi');
        $this->selectIncaricati = Yii::app()->MyUtils->getSelect('utenti');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getSmallVerifiche($anno = null) {
        
		$WHERE = " WHERE 1";
        if ($anno)
            $WHERE .= " AND anno ='" . $anno . "' ";
        
		if($this->datiAdmin['user_type'] =='7')
			$AND = " AND id in (".implode(",",Yii::app()->MyUtils->getIncaricatiVerifica ()).")";
		else if ($this->datiAdmin['admin'] != true)
            $AND = " AND unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        
        $date = Yii::app()->db->createCommand("SELECT DISTINCT(data_prevista) as data FROM " . $this->tableName() . "  " . $WHERE . " ".$AND)->queryAll();
        $verifiche = array();

        for ($x = 0; $x < count($date); $x++) {
            $verifiche[$date[$x]['data']] = array();
            $tmp = Yii::app()->db->createCommand("SELECT * FROM " . $this->tableName() . " WHERE data_prevista ='" . $date[$x]['data'] . "' ".$AND." ")->queryAll();

            for ($v = 0; $v < count($tmp); $v++) {
                $background = Yii::app()->db->createCommand("SELECT c.colore ,t.colore  FROM doc_tipologie_verifiche AS t LEFT JOIN doc_colori As c  ON t.colore = c.id WHERE t.id = '" . $tmp[$v]['tipo_verifica'] . "'  ")->queryScalar();
                $codice = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id ='" . $tmp[$v]['unita_operativa'] . "'  ")->queryScalar();
                $verifiche[$date[$x]['data']][] = "<a class='verifica' data-refer='" . $tmp[$v]['id'] . "' id='verifica-" . $tmp[$v]['id'] . "' style='background-color:" . $background . "'>" . $codice . "</a> <span style='height: 1px'>&nbsp;</span>";
            }
        }
        return $verifiche;
    }

    public function getVerifiche() {

        $stats = array();
        $WHERE = "";
		if($this->datiAdmin['user_type'] =='7')
			$WHERE .= " WHERE s.id in (".implode(",",Yii::app()->MyUtils->getIncaricatiVerifica ()).")";
        else if ($this->datiAdmin['admin'] != true)
            $WHERE = " WHERE s.unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";

        $query = " SELECT s.* , DATE_FORMAT(s.data_prevista ,'%Y') as anno_start , DATE_FORMAT(s.data_prevista ,'%d')  as giorno_start , DATE_FORMAT(s.data_prevista ,'%m')  as mese_start ,";
        $query .= " DATE_FORMAT(s.data_prevista_fine ,'%Y') as anno_stop , DATE_FORMAT(s.data_prevista_fine ,'%d')  as giorno_stop , DATE_FORMAT(s.data_prevista_fine ,'%m')  as mese_stop ,";
        $query .= "  t.nome  as tipo , t.colore ,  u.nome as unita  FROM " . $this->tableName() . " AS s LEFT JOIN  doc_tipologie_verifiche AS t ON s.tipo_verifica = t.id  LEFT JOIN doc_unita as  u  ON s.unita_operativa = u.id " . $WHERE;


        $stats['verifiche'] = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($stats['verifiche']); $x++) {

            $mese_start = $stats['verifiche'][$x]['mese_start'] - 1;
            

           $stats['verifiche'][$x]['mese_stop'] ? $mese_stop = $stats['verifiche'][$x]['mese_stop'] - 1 : $mese_stop = $mese_start ;
            
           !$stats['verifiche'][$x]['anno_stop'] ? $stats['verifiche'][$x]['anno_stop'] = $stats['verifiche'][$x]['anno_start']:"";
           !$stats['verifiche'][$x]['giorno_stop'] ? $stats['verifiche'][$x]['giorno_stop'] = $stats['verifiche'][$x]['giorno_start']:"";
          
            
            if ($stats['verifiche'][$x]['ora_inizio'])
                $orario = explode(":", $stats['verifiche'][$x]['ora_inizio']);
            else
                $orario = explode(":", "09:00");

            $border[$x] = "#ccc";

            $color[$x] = Yii::app()->db->createCommand("SELECT nome FROM doc_colori WHERE id ='" . $stats['verifiche'][$x]['colore'] . "' ")->queryScalar();

            if (!$color[$x])
                $color[$x] = 'success';

            $backgound[$x] = "backgroundColor: Utility.getBrandColor('" . $color[$x] . "')";
            $numero = explode("-", $stats['verifiche'][$x]['codice']);

            $txt = "{";
            $txt .="title:'" . str_replace("'", "", $stats['verifiche'][$x]['unita'] . "<br />VERIFICA " . $stats['verifiche'][$x]['tipo']) . " N " . $numero[6] . "  ' , ";
            $txt .="start: new Date(" . $stats['verifiche'][$x]['anno_start'] . ", " . $mese_start . ", " . $stats['verifiche'][$x]['giorno_start'] . " ," . $orario[0] . "," . $orario[1] . "),";
            $txt .=" end: new Date(" . $stats['verifiche'][$x]['anno_stop'] . ", " . $mese_stop . ", " . $stats['verifiche'][$x]['giorno_stop'] . "," . $orario[0] . "," . $orario[1] . "),";
            $txt .="id:" . $stats['verifiche'][$x]['id'] . ",";
            $txt .=" allDay: false,";
            $txt .="className: '" . $border[$x] . "',";
            $txt .="type: 2,";
            $txt .= $backgound[$x];
            $txt .="}";

            $stats['reserved'][] = $txt;
        }

        // RECUPERO CONTEGGI SU VERIFICHE 
        $tipoLogie = Yii::app()->db->createCommand("SELECT tv.* , tv.nome as nome_tipologia, c.nome, c.colore FROM doc_tipologie_verifiche as tv LEFT JOIN doc_colori as c ON tv.colore = c.id ")->queryAll();

        for ($x = 0; $x < count($tipoLogie); $x++) {

            $tipoLogie[$x]['prime_c'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche WHERE verifica ='P' AND data_prevista <='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND tipo_verifica ='" . $tipoLogie[$x]['id'] . "'  ")->queryScalar();
            $tipoLogie[$x]['seconde_c'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche WHERE verifica ='S' AND data_prevista <='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND tipo_verifica ='" . $tipoLogie[$x]['id'] . "'  ")->queryScalar();
            $tipoLogie[$x]['prime_nc'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche WHERE verifica ='P' AND data_prevista >='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND tipo_verifica ='" . $tipoLogie[$x]['id'] . "' AND completa ='N' ")->queryScalar();
            $tipoLogie[$x]['seconde_nc'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche WHERE verifica ='S' AND data_prevista >='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND tipo_verifica ='" . $tipoLogie[$x]['id'] . "' AND completa ='N' ")->queryScalar();
        }

        $stats['stats'] = $tipoLogie;

        return $stats;
    }

    public function getNC($data, $id) {
        /*$totale = 0;
        $field = $this->getFields();
        foreach ($field AS $id => $val)
            $totale += count($field[$id]);*/

        $totale = VerificheQuestions::model()->count('tipologiaVerificaId=:id', array('id'=>$data->tipo_verifica));

        $color = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($data->non_conformita, $totale));
        
        return "<span class='nc' >" . $data->non_conformita . "/" . $totale . " - <span class='nc-" . $color . "' >" . Yii::app()->MyUtils->getPercent($data->non_conformita, $totale) . "% </span></span>";
    }

    public function getFields() {
        $field = array(
            'sezione_1' => array('presenza_documento', 'cartellino', 'presenza_fascicoli', 'presenza_verbale', 'presenza_dpi', 'dpi_indossati', 'presenza_lettera_incarico', 'presenza_incaricati', 'preposti_sicurezza', 'addetti_sicurezza', 'copie_attestati', 'aggiornamenti_attestati', 'incaricati_primo_soccorso', 'letter_primo_soccorso', 'attestati_formazione'),
            'sezione_2' => array('prove_emergenza', 'verbale_prove_emergenza', 'registro_accessi', 'informativa_rischi'),
            'sezione_3' => array('divieto_fumo', 'rischio_elettrico', 'divieto_acqua', 'punto_raccolta', 'pulsante_allarme', 'pulsante_sgancio', 'uscite_emergenza', 'porte_tagliafuoco', 'estintori', 'idranti_manichetta', 'idranti_colonna', 'naspi', 'attacco_vvf', 'divieto_parcheggio', 'passo_uomo', 'uscita_veicoli', 'divieto_accesso', 'planimetrie', 'informativa_emergenza'),
            'sezione_4' => array('copia_cpi', 'impianto_elettrico', 'impianto_idrico', 'impianto_termico', 'impianto_condizionamento', 'impianto_antincendio', 'impianto_fumi', 'denuncia_messaterra', 'verifica_messaterra', 'verifica_ascensore', 'verifica_funi', 'caldaia_conforme', 'autorizzazione_alberghiera', 'autorizzazione_sanitaria', 'autorizzazione_piscina', 'contratto_man_antincendio', 'contratto_man_ascensori', 'contratto_man_termico', 'contratto_man_elettrico', 'contratto_man_idrico'),
            'sezione_5' => array('presenza_dvr', 'presenza_dvr_specifico', 'rischio_chimico', 'rischio_incendio', 'rischio_rumore', 'rischio_stress', 'rischio_vibrazioni', 'presenza_patentini', 'documenti_rischi', 'piano_emergenza', 'planimetrie_esposte', 'presenza_verbale_giornaliero'),
            'sezione_6' => array('presenza_manuale_hse', 'firme_responsabili', 'ditta_consulente', 'certificato_prelievo', 'modulo_sch', 'presenza_termometro', 'acqua_calda', 'acqua_fredda', 'usura_giunti', 'diffusori_doccia')
        );

        return $field;
    }

    public function getProgress() 
    {
        $questions = Yii::app()->db->createCommand()
                        ->select('COUNT(*) tot, groupId')
                        ->from('doc_verifiche_questions q')
                        ->leftJoin('doc_verifiche_answers a', 'q.id = a.questionId')
                        ->join('doc_verifiche_questions_groups g', 'q.groupId = g.id')
                        ->where('a.verificaId=:id', array(':id'=>$this->id))
                        ->group('groupId')
                        ->queryAll();

        $answers   = Yii::app()->db->createCommand()
                        ->select('COUNT(*) tot, groupId')
                        ->from('doc_verifiche_answers a')
                        ->join('doc_verifiche_questions q', 'a.questionId = q.id')
                        ->join('doc_verifiche_questions_groups g', 'q.groupId = g.id')
                        ->where('a.verificaId=:id AND a.answer !=""', array(':id'=>$this->id))
                        ->group('groupId')
                        ->queryAll();

        $ncs        = Yii::app()->db->createCommand()
                        ->select('COUNT(*) tot, groupId')
                        ->from('doc_verifiche_answers a')
                        ->join('doc_verifiche_questions q', 'a.questionId = q.id')
                        ->join('doc_verifiche_questions_groups g', 'q.groupId = g.id')
                        ->where('a.verificaId=:id AND a.answer="NC"', array(':id'=>$this->id))
                        ->group('groupId')
                        ->queryAll();

        foreach($answers as $answer) {
            $ans[$answer['groupId']] = $answer['tot'];
        }

        foreach($ncs as $nc) {
            $noConformita[$nc['groupId']] = $nc['tot'];
        }

        foreach($questions as $question) {
            if($ans[$question['groupId']]) {
                $p = Yii::app()->MyUtils->getPercent($ans[$question['groupId']], $question['tot']);

                $color = Yii::app()->MyUtils->getColor($p, 'top');

                if($noConformita[$question['groupId']]) {
                    $nc = $noConformita[$question['groupId']];
                }
                else {
                    $nc = 0;
                }

                $badge = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($nc, $question['tot']));

                $progress[$question['groupId']] = ['tot'=>$question['tot'],'done'=>$ans[$question['groupId']],'percentage'=>$p,'color'=>$color,'badge'=>$badge,'nc'=>$nc];
            }
            else {
                $progress[$question['groupId']] = ['tot'=>$question['tot'],'done'=>0,'percentage'=>0,'color'=>'danger','badge'=>'success','nc'=>0];
            }
        }

        return $progress;
    }

    public function openNonConforme()
    {
        //leggo le risposte date alla verifica
        $verifica = self::model()->with('verificheAnswers')->findByPk($this->id);

        $user = Yii::app()->MyUtils->getUserInfo();

        foreach($verifica['verificheAnswers'] as $question) {

            //leggo le non conformità eventualmente già presenti
            $nc = DbNonconforme::model()->findByAttributes(array('id_verifica'=>$this->id,'verificaQuestionId'=>$question['questionId']));

            $gruppo = Yii::app()->db->createCommand()
                        ->select('g.name, q.question')
                        ->from('doc_verifiche_questions q')
                        ->join('doc_verifiche_questions_groups g', 'q.groupId=g.id')
                        ->where('q.id=:id', array(':id'=>$question['questionId']))
                        ->queryRow();

            if($question['answer'] == 'NC') {
                if(!$nc) {
                    $nc = new DbNonconforme;
                    $nc->data = New CDbExpression('NOW()');
                    $nc->data_nc = New CDbExpression('NOW()');
                    $nc->unita_operativa = $this->unita_operativa;
                    $nc->id_utente = Yii::app()->user->getId();
                    $nc->anno = date('Y');
                    $nc->id_verifica = $this->id;
                    $nc->tipo_verifica = $gruppo['name'];
                    $nc->verificaQuestionId = $question['questionId'];
                    $nc->descrizione = $gruppo['question'].": ".$question['note'];
                    $nc->nome = $user['nome'];
                    $nc->cognome = $user['cognome'];
                    $nc->tipologia = $this->tipo_verifica;

                    if($nc->save(false)) {
                        $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $nc->id);
                        $nc->codice = $codice;
                        $nc->save(false);                        
                    }
                    else{
                        echo 'failed';
                        Yii::trace('query failed');
                        exit;
                    }
                }
                else {
                    $nc->data = new CDbExpression('NOW()');
                    $nc->data_nc = new CDbExpression('NOW()');
                    $nc->id_utente = Yii::app()->user->getId();
                    $nc->id_verifica = $this->id;
                    $nc->tipo_verifica = $gruppo['name'];
                    $nc->verificaQuestionId = $question['questionId'];
                    $nc->descrizione = $gruppo['question'].": ".$question['note'];
                    $nc->save(false);
                }
            }
            else {
                if($nc) {
                    $nc->delete();
                }
            } 
        }
    }

    public function getIndicatoriStrutture()
    {
        //raw query
        //$sql = "SELECT COUNT(*) tot, v.unita_operativa, v.tipo_verifica, v.completa, u.nome AS unita, t.nome AS verifica
        //        FROM `db_verifiche` v JOIN doc_unita u ON v.unita_operativa = u.id JOIN doc_tipologie_verifiche t ON v.tipo_verifica = t.id
        //        WHERE anno = 2023 GROUP BY v.unita_operativa, v.tipo_verifica, v.completa ORDER BY unita, verifica";

        $records = Yii::app()->db->createCommand()
                        ->select('COUNT(*) tot, v.unita_operativa, v.tipo_verifica, v.completa, u.nome AS unita, t.nome AS verifica')
                        ->from('db_verifiche AS v')
                        ->join('doc_unita AS u', 'v.unita_operativa = u.id')
                        ->join('doc_tipologie_verifiche AS t', 'v.tipo_verifica = t.id')
                        ->where('v.anno=:year', array(':year'=>2023))
                        ->group('v.tipo_verifica, v.unita_operativa, v.completa')
                        ->order('unita, verifica')
                        ->queryAll();

        $indicatori = [];

        foreach($records as $row) {
            $indicatori['verifiche'][trim($row['verifica'])]['tot'] += $row['tot'];
            if($row['completa'] == 'Y') {
                $indicatori['verifiche'][trim($row['verifica'])]['totY'] += $row['tot'];
            }
            if($row['completa'] == 'N') {
                $indicatori['verifiche'][trim($row['verifica'])]['totN'] += $row['tot'];
            }

            $indicatori['unita'][trim($row['unita'])]['tot'] += $row['tot'];

            if($row['completa'] == 'Y') {
                $indicatori['unita'][trim($row['unita'])]['totY'] += $row['tot'];
            }
            if($row['completa'] == 'N') {
                $indicatori['unita'][trim($row['unita'])]['totN'] += $row['tot'];
            }

            $indicatori['unita'][trim($row['unita'])]['verifiche'][trim($row['verifica'])]['tot'] += $row['tot'];

            if($row['completa'] == 'Y') {
                $indicatori['unita'][trim($row['unita'])]['verifiche'][trim($row['verifica'])]['totY'] += $row['tot'];
            }
            if($row['completa'] == 'N') {
                $indicatori['unita'][trim($row['unita'])]['verifiche'][trim($row['verifica'])]['totN'] += $row['tot'];
            }

            $indicatori['totale'] += $row['tot'];
        }

        return $indicatori;
    }
}