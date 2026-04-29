<?php

class DbReclami extends CActiveRecord {

    public $allegato;
    var $selectFunzioni = array();
    var $selectSocieta = array();
    var $selectTipologie = array();
    var $selectUnita = array();
    var $selectAzioni = array();
    var $selectCanali = array();
    var $selectResponsabili = array();
    var $selectChiusure = array();
    var $selectCodici = array();
    var $datiEsportazione = array();
    var $selectAnni = array();
    var $typeUser = '';
    var $azioni = array();
    var $stats = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_reclami';
    }

    public function rules() {
        return array(
            array('canale,non_conformita, nome, cognome, tipologia, nome_compilatore, cognome_compilatore, unita_operativa, societa, funzione, descrizione', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('canale, tipologia, unita_operativa, societa, funzione, id_utente', 'numerical', 'integerOnly' => true),
            array('canale_altro,tipologia_altro , nome, cognome, nome_compilatore, cognome_compilatore, allegato', 'length', 'max' => 255),
            array('non_conformita,chiusura', 'length', 'max' => 1),
            array('anno', 'length', 'max' => 4),
            array('motivo_non_conformita, motivazione', 'length', 'max' => 10000),
            array('non_conformita', 'validaNonConforme'),
            array('canale', 'validaCanale'),
            array('tipologia', 'validaTipologia'),
            array('id, canale, canale_altro, nome, cognome, tipologia, nome_compilatore, cognome_compilatore, unita_operativa, societa, funzione, descrizione, allegato, data_inserimento', 'safe', 'on' => 'search'),
        );
    }

    public function validaCanale() {
        if ($this->canale == '4' && !$this->canale_altro)
            $this->addError("canale", "Specificare il canale");
    }

    public function validaTipologia() {
        if ($this->tipologia == '3' && $this->tipologia_altro)
            $this->addError("titpologia", "Specificare la tipologia");
    }

    public function validaNonConforme() {
        if ($this->non_conformita == 'N' && ( $this->motivo_non_conformita == '' || !$this->motivo_non_conformita ))
            $this->addError("motivo_non_conformita", "Indicare  il motivo per non aprire una non conformit&agrave;");
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'codice' => 'Codice',
            'canale' => 'Canale',
            'canale_altro' => 'Specificare',
            'chiusura' => 'Chiusura  reclamo',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'tipologia' => 'Tipologia',
            'tipologia_altro' => 'Specificare',
            'nome_compilatore' => 'Nome Compilatore',
            'cognome_compilatore' => 'Cognome Compilatore',
            'unita_operativa' => 'Struttura',
            'societa' => 'Societa',
            'funzione' => 'Funzione',
            'descrizione' => 'Descrizione',
            'motivazione' => 'Motivazione e fondatezza reclamo *',
            'allegato' => 'Allegato',
            'data_inserimento' => 'Data Inserimento',
            'non_conformita' => 'Non conformit&agrave;',
            'motivo_non_conformita' => 'Motivo',
            'id_non_conformita' => 'Riferimento',
            'anno' => 'Anno'
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = ' data_inserimento DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('codice', $this->codice);
        $criteria->compare('chiusura', $this->chiusura);
        $criteria->compare('canale', $this->canale);
        $criteria->compare('canale_altro', $this->canale_altro, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('tipologia_altro', $this->tipologia_altro);
        $criteria->compare('nome_compilatore', $this->nome_compilatore, true);
        $criteria->compare('cognome_compilatore', $this->cognome_compilatore, true);
        $criteria->compare('societa', $this->societa);
        $criteria->compare('funzione', $this->funzione);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('motivazione', $this->motivazione, true);
        $criteria->compare('allegato', $this->allegato, true);
        $criteria->compare('data_inserimento', $this->data_inserimento, true);
        $criteria->compare('non_conformita', $this->non_conformita, true);
        $criteria->compare('motivo_non_conformita', $this->motivo_non_conformita, true);
        $criteria->compare('id_non_conformita', $this->id_non_conformita, true);
         
        /*if (!$this->unita_operativa)
            $criteria->addInCondition('unita_operativa',Yii::app()->user->getState('strutture'));
        else
            $criteria->compare('unita_operativa', $this->unita_operativa, true);
*/
        if($this->unita_operativa) {
            $criteria->compare('unita_operativa', $this->unita_operativa, true);
        }
        else {
            if(Yii::app()->user->getState('group') != 'ADMIN') {
                $criteria->addInCondition('unita_operativa',Yii::app()->user->getState('strutture'));
            }
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
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_inserimento)." <br />";
		$tmp .= "<span class='bold'>Codice:</span> ".Yii::app()->MyUtils->getSelectValue($data->codice, "codice_nc")." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita")." <br />";
		$tmp .= "<span class='bold'>Canale:</span> ".Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_canali")."  <br />";
		$tmp .= "<span class='bold'>Tipologia:</span> ".Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_tipologie")."  ";
		return $tmp;
	}
	
	
    public function getData($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_inserimento);
    }

    public function getTipologia($data, $t = null) {

        if ($data->tipologia == '3')
            $tipo = Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_tipologie") . " " . $data->tipologia_altro;
        else
            $tipo = Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_tipologie");
        return $tipo;
    }

    public function getAllegato($data, $t) {

        $allegato = '';

        if ($data->allegato)
            $allegato = "<a href='/../qualita_new/images/allegati_reclami/" . $data->allegato . "' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegato'  >" . $data->allegato . "</a>";

        return $allegato;
    }

    public function getOldAllegato() {
        return Yii::app()->MyUtils->getSelectValue($data->id, "allegato_reclamo");
    }
    
    public function getCanale($data, $t = null) {

        if ($data->canale == '4')
            $tipo = Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_canali") . " " . $data->tipologia_altro;
        else
            $tipo = Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_reclami_canali");
        return $tipo;
    }

    public function getUnita($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }

    public function getSocieta($data, $t = null) {
        return Yii::app()->MyUtils->getSelectValue($data->societa, "doc_societa");
    }

    public function countAzioni($data, $t = null) {
        return Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami_azioni WHERE id_reclamo = '" . $data->id . "'  ")->queryScalar();
    }

    public function setDefaultValue() {
        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        $this->selectSocieta = Yii::app()->MyUtils->getSelect('doc_societa');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_aperture');
        $this->selectUnita = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectResponsabili = Yii::app()->MyUtils->getSelect('doc_responsabile');
        $this->selectFunzioni = Yii::app()->MyUtils->getSelect('doc_funzione');
        $this->selectChiusure = Yii::app()->MyUtils->getSelect('doc_chiusura');
        $this->selectCanali = Yii::app()->MyUtils->getSelect('doc_reclami_canali', 'id');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_reclami_tipologie', 'id');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anno = NULL) {
        
        $WHERE = " WHERE  r.unita_operativa IN (" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        if ($anno)
            $WHERE .= " AND a.anno IN (" . $anno . ") ";
        
        $query = " SELECT r.id , r.codice , r.canale_altro , r.nome , r.cognome ,r.tipologia_altro, r.nome_compilatore,  r.cognome_compilatore , DATE_FORMAT(data_inserimento,'%d-%m-%Y') as data_inserimento ,  
            r.non_conformita, r.id_non_conformita ,r.motivo_non_conformita , r.cognome_compilatore , r.anno , r.descrizione , ch.nome,
            c.nome as nome_canale , t.nome as nome_tipologia , u.nome as nome_unita ,s.nome as nome_societa , f.nome as nome_funzione FROM db_reclami as r
            LEFT JOIN doc_reclami_canali AS c ON r.canale = c.id
            LEFT JOIN doc_reclami_tipologie  AS t ON r.tipologia = t.id
            LEFT JOIN doc_unita  AS u ON r.unita_operativa = u.id
            LEFT JOIN doc_societa  AS s ON r.societa = s.id
            LEFT JOIN doc_chiusura  AS ch ON r.chiusura = s.id
            LEFT JOIN doc_funzione  AS f ON r.funzione = f.id ".$WHERE ;
        
          return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getNomeAllegato() {

        $end = explode(".", $this->allegato);
        $a = 1;

        return "Allegato_" . $a . "_Reclamo_" . $this->codice . "." . $end[1];
    }

    public function generaCodice() {

        $totale = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $this->tableName() . " WHERE unita_operativa = '" . $this->unita_operativa . "' AND anno ='" . date("Y") . "'  ")->queryScalar() + 1;
        $codice = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id = '" . $this->unita_operativa . "'  ")->queryScalar() . "-" . $totale;
        return $codice;
    }

    public function setAzioni() {
        $this->azioni = Yii::app()->db->createCommand("SELECT * FROM db_reclami_azioni WHERE id_reclamo ='" . $this->id . "'")->queryAll();
    }

    public function addAzione() {
        $this->azioni = Yii::app()->db->createCommand("SELECT * FROM db_reclami_azioni WHERE id_reclamo ='" . $this->id . "'")->queryRow();
    }

    public function removeAction() {
        $this->azioni = Yii::app()->db->createCommand("DELETE FROM db_reclami_azioni WHERE id_reclamo ='" . $this->id . "'")->execute();
    }

    public function addAzioneReclamo($azione, $id) {

        if ($azione['id']) {
            $query = "UPDATE db_reclami_azioni SET id_reclamo = '" . $id . "' ,
                descrizione ='" . addslashes($azione['descrizione']) . "' , nome ='" . $azione['nome'] . "' , cognome ='" . $azione['cognome'] . "' , allegato = '" . $azione['allegato'] . "' , 
                entro_il = '" . Yii::app()->MyUtils->reverseDate($azione['entro_il']) . "' , effettuata_il = now() , funzione ='" . $azione['funzione'] . "' 
                WHERE id = '" . $azione['id'] . "' ";
        } else {
            $query = "INSERT INTO db_reclami_azioni (id_reclamo,descrizione,nome,cognome,entro_il,effettuata_il,funzione,anno ,unita_operativa , allegato) ";
            $query .= "VALUE ('" . $id . "','" . addslashes($azione['descrizione']) . "','" . $azione['nome'] . "','" . $azione['cognome'] . "','" . Yii::app()->MyUtils->reverseDate($azione['entro_il']) . "',now(),'" . $azione['funzione'] . "' ,'" . date("Y") . "' ,'".$this->unita_operativa."' ,'" . $azione['allegato'] . "' )";
        }
        Yii::app()->db->createCommand($query)->execute();
    }

    public function nonConforme() {

        $isNc = Yii::app()->db->createCommand("SELECT id FROM db_nonconforme WHERE id_reclamo ='" . $this->id . "'")->queryScalar();

        $tipologia = "16";


        if ($isNc) {
            $query = "UPDATE  db_nonconforme  SET 
                id_utente ='" . Yii::app()->user->getId() . "', data_aggiornamento = NOW() , descrizione ='" . addslashes($this->descrizione) . "' ,
                nome ='" . $this->nome . "' , cognome ='" . $this->cognome . "' ,unita_operativa ='" . $this->unita_operativa . "' ,
                societa ='" . $this->societa . "' , funzione ='" . $this->funzione . "' , tipologia ='" . $tipologia . "' 
                WHERE id ='" . $isNc . "'  ";
            Yii::app()->db->createCommand($query)->execute();
        } else {
            $query = "INSERT INTO db_nonconforme (id_utente, data, descrizione ,  nome, cognome, unita_operativa, societa, funzione,id_reclamo,tipologia,anno) VALUES 
                ('" . Yii::app()->user->getId() . "',NOW(),'" . addslashes($this->descrizione) . "', '" . $this->nome . "',
                    '" . $this->cognome . "','" . $this->unita_operativa . "','" . $this->societa . "' ,'" . $this->funzione . "','" . $this->id . "','" . $tipologia . "' ,'" . date("Y") . "' )";
            Yii::app()->db->createCommand($query)->execute();
            $isNc = Yii::app()->db->getLastInsertID();
        }

        Yii::app()->db->createCommand("DELETE FROM doc_codici WHERE id_nc ='" . $isNc . "'")->execute();

        $u = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id='" . $this->unita_operativa . "'")->queryScalar();
        $c = Yii::app()->db->createCommand("SELECT MAX(id) FROM doc_codici WHERE unita ='" . $u . "'")->queryScalar();
        $nc = $c + 1;
        $i = Yii::app()->db->createCommand("INSERT INTO doc_codici (id,unita,id_nc) VALUE ('" . $nc . "', '" . $u . "','" . $isNc . "')")->execute();
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $u . "-" . $nc . "'  WHERE id='" . $isNc . "'")->execute();
    }


}