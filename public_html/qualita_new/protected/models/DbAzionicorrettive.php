<?php

class DbAzionicorrettive extends CActiveRecord {

    var $selectFunzioni = array();
    var $selectSocieta = array();
    var $selectTipologie = array();
    var $selectUnita = array();
    var $selectAzioni = array();
    var $selectCodici = array();
    var $datiEsportazione = array();
    var $selectAnni = array();
    var $typeUser = '';
    var $refer = array();
    var $indicatori = array();
    public $allegato;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_azionicorrettive';
    }

    public function rules() {

        return array(
            array('data, data_az, tipo_azione, societa,nome, cognome, codice_riferimento, funzione, tipologia, descrizione, trattamento, verifica_efficacia', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('tipo_azione, societa, unita_operativa, funzione, tipologia', 'numerical', 'integerOnly' => true),
            array('codice_riferimento', 'length', 'max' => 20),
            array('unita_operativa', 'validaUnita'),
            array('anno', 'length', 'max' => 4),
            array('data_az', 'length', 'max' => 10),
            array('allegato', 'file', 'types' => 'jpg, gif, png, doc, pdf, xls, xxls', 'message' => 'Possono essere caricati solo file con le seguenti estensioni jpg, png, doc, xls, pdf', 'allowEmpty' => true),
            // Please remove those attributes that should not be searched.
            array('id, data, tipo_azione, societa, unita_operativa, nome, cognome, codice_riferimento, funzione, tipologia, descrizione, trattamento', 'safe', 'on' => 'search'),
        );
    }

    public function validaUnita() {
        $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryScalar();
        if ($typeUser == 'admin' || Yii::app()->user->getId() == 110) {
            if (!$this->unita_operativa || $this->unita_operativa == '')
                $this->addError("unita_operativa", "Indicare il giorno");
        }
    }

    public function relations() {

        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'data' => 'Data creazione',
            'data_aggiornamento' => 'Aggiornato il ',
            'data_az' => 'Data azione',
            'tipo_azione' => '<span class="no-phone">Tipo</span> Azione',
            'societa' => 'Societa',
            'unita_operativa' => 'Unita <span class="no-phone">Operativa</span>',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'codice_riferimento' => 'Codice <span class="no-phone">Riferimento</span>',
            'funzione' => 'Funzione',
            'tipologia' => 'Tipologia',
            'descrizione' => 'Entro il ',
            'trattamento' => 'Descrizione Azione Correttiva ',
            'allegato' => 'Allegato',
            'verifica_efficacia' => 'Efficacia verifica',
            'anno' => 'Anno',
            'approvato' => 'Approvato',
            'chiusura' => 'Chiusura'
        );
    }

    public function search() {

        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = ' data_az DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('data_az', $this->data_az, true);
        $criteria->compare('tipo_azione', $this->tipo_azione);
        $criteria->compare('societa', $this->societa);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('codice_riferimento', $this->codice_riferimento, true);
        $criteria->compare('funzione', $this->funzione);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('trattamento', $this->trattamento, true);
        $criteria->compare('allegato', $this->allegato, true);
        $criteria->compare('anno', $this->anno, true);
        $criteria->compare('chiusura', $this->chiusura, true);
        $criteria->compare('approvato', $this->approvato, true);
        
        $criteria->compare('verifica_efficacia', $this->verifica_efficacia, true);

        /*if (!$this->unita_operativa)
            $criteria->addInCondition('unita_operativa',Yii::app()->user->getState('strutture'));
        else
            $criteria->compare('unita_operativa', $this->unita_operativa);*/

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
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data)." <br />";
		$tmp .= "<span class='bold'>Codice:</span> ".Yii::app()->MyUtils->getSelectValue($data->codice_riferimento, "codice_nc")." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Efficacia:</span> ".$this->getEfficacia($data->verifica_efficacia)."  ";
		return $tmp;
	}
	
    public function getEfficacia($data) {
        if ($data == "S")
            $dati = "SI";
        else if ($data == "N")
            $dati = "NO";
        else if ($data == "V")
            $dati = "IN VALUTAZIONE";
        else
            $dati = "";

        return $dati;
    }

    public function getFunzione($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->funzione, "doc_funzione");
    }

    public function getSocieta($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->societa, "doc_societa");
    }

    public function getUnita($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }

    public function getResponsabile($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->responsabile, "doc_responsabile");
    }

    public function getTipologia($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_tipologie_aperture");
    }

    public function getCode($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->codice_riferimento, "codice_nc");
    }

    public function getCodice($id) {
        return Yii::app()->MyUtils->getSelectValue($id, "codice_nc");
    }

    public function getAllegato($id) {
        return Yii::app()->MyUtils->getSelectValue($id, "allegato_ac");
    }

    function generaCodice($id, $a, $b) {
        return Yii::app()->MyUtils->getSelectValue($a, "codice_societa") . "-" . Yii::app()->MyUtils->getSelectValue($b, "codice_unita") . "-" . $id;
    }

    function updateCodice($id, $codice) {
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $codice . "'  WHERE id='" . $id . "'")->execute();
    }

    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_az);
    }

    public function getDataUpadate($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_aggiornamento);
    }

    public function getDataFormatedAz($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_az);
    }

    protected function beforeValidate() {
        return parent::beforeValidate();
    }

    public function setDefaultValue() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        $this->selectFunzioni = Yii::app()->MyUtils->getSelect('doc_funzione');
        $this->selectSocieta = Yii::app()->MyUtils->getSelect('doc_societa');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_aperture');
        $this->selectUnita = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectAzioni = Yii::app()->MyUtils->getSelect('doc_azione');
        $this->selectCodici = Yii::app()->MyUtils->getSelect('codici_nc');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->refer = Yii::app()->db->createCommand("SELECT descrizione, trattamento ,codice FROM db_nonconforme WHERE id='" . $this->codice_riferimento . "'")->queryRow();
    }

    public function getEsportazione($anno = NULL) {

        $WHERE = " WHERE  a.unita_operativa IN (" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        if ($anno)
            $WHERE .= " AND a.anno IN (" . $anno . ") ";

        $query = " SELECT  a.id ,DATE_FORMAT(a.data, '%d-%m-%Y') as data ,DATE_FORMAT(a.data_az, '%d-%m-%Y') as data_az ,  DATE_FORMAT(a.descrizione, '%d-%m-%Y')  as descrizione 
             ,  a.nome , a.cognome,  a.trattamento , a.anno , az.nome as nome_azione , nc.codice as nome_codice 
             ,u.nome as nome_utente , f.nome as nome_funzione , soc.nome as nome_societa , tip.nome as nome_tipologia_apertura,
             uni.nome as nome_unita_operativa FROM db_azionicorrettive AS a 
             LEFT JOIN doc_azione AS az ON a.tipo_azione = az.id 
             LEFT JOIN utenti AS u ON a.id_utente  = u.id 
             LEFT JOIN doc_funzione AS f ON a.funzione  = f.id
             LEFT JOIN doc_societa AS soc ON a.societa  = soc.id
             LEFT JOIN doc_tipologie_aperture AS tip ON a.tipologia  = tip.id
             LEFT JOIN doc_unita AS uni ON a.unita_operativa  = uni.id
             LEFT JOIN db_nonconforme AS nc ON a.codice_riferimento  = nc.id " . $WHERE;
        return Yii::app()->db->createCommand($query)->queryAll();
    }
	
	public function getNcDetail($id){
        return Yii::app()->db->createCommand("SELECT codice, trattamento, descrizione FROM db_nonconforme WHERE id ='".$id."' ")->queryRow();
    }
	
	
}