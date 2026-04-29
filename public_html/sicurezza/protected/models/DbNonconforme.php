<?php

class DbNonconforme extends CActiveRecord {

    public $allegato;
    var $selectFunzioni     = array();
    var $selectSocieta      = array();
    var $selectTipologie    = array();
    var $selectUnita        = array();
    var $selectAzioni       = array();
    var $selectResponsabili = array();
    var $selectChiusure     = array();
    var $selectCodici     = array();
    var $datiEsportazione   = array();
    
    var $typeUser           = '';
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_nonconforme';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' societa,  nome, cognome, funzione, tipologia, descrizione, trattamento, responsabile', 'required', 'message' => 'Compilare il campo'),
            array('societa, unita_operativa, funzione, tipologia, responsabile, chiusura', 'numerical', 'integerOnly' => true),
            array('codice', 'length', 'max' => 20),
            array('trattamento_note', 'length', 'max' => 500),
            array('trattamento_accettato', 'length', 'max' => 1),
            array('unita_operativa','validaUnita'),
            array('allegato', 'file', 'types' => 'jpg, gif, png, doc, pdf, xls, xxls', 'message' => 'Possono essere caricati solo file con le seguenti estensioni jpg, png, doc, xls, pdf', 'allowEmpty' => true),
            // Please remove those attributes that should not be searched.
            array('trattamento_note, trattamento_data, trattamento_accettato, id, data, societa, unita_operativa, nome, cognome, funzione, tipologia, descrizione, trattamento, responsabile, codice, chiusura', 'safe', 'on' => 'search'),
        );
    }
    
     public function validaUnita(){
       $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryScalar();
        if($typeUser=='admin' || Yii::app()->user->getId()==110){
            if (!$this->unita_operativa || $this->unita_operativa=='')
                $this->addError("unita_operativa", "Indicare unita operativa");
        }
    }
    
    
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'data' => 'Data',
            'data_aggiornamento' => 'Aggiornato il ',
            'societa' => 'Societ&agrave; ',
            'unita_operativa' => 'Unit&agrave; Operativa',
            'nome' => 'Nome ',
            'cognome' => 'Cognome ',
            'funzione' => 'Funzione',
            'tipologia' => 'Tipologia non conformit&agrave;',
            'descrizione' => 'Descrizione non conformit&agrave;',
            'trattamento' => 'Proposta trattamento non conformatit&agrave;',
            'responsabile' => 'Responsabile controllo e verifica',
            'codice' => 'Codice',
            'allegato' => 'Allegato',
            'chiusura' => 'Chiusura non conformit&agrave;',
            'trattamento_accettato' => 'Proposta trattamento accettata',
            'trattamento_data' => 'Data accettazione proposta',
            'trattamento_note' => 'Note'
        );
    }

    public function search() {


        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('data_aggiornamento', $this->data, true);
        $criteria->compare('societa', $this->societa);
        $criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('funzione', $this->funzione);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('trattamento', $this->trattamento, true);
        $criteria->compare('responsabile', $this->responsabile);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('chiusura', $this->chiusura, true);
        $criteria->compare('trattamento_accettato', $this->trattamento_accettato, true);
        $criteria->compare('trattamento_data', $this->trattamento_data, true);
        $criteria->compare('trattamento_note', $this->trattamento_note, true);
        $criteria->compare('allegato', $this->allegato, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getSelect($table) {
        
        if($table =='doc_unita' && Yii::app()->user->getId()==110) 
            $where = " WHERE id IN ('19','20','21','22')";
        
        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM " . $table." ".$where." ORDER BY nome")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }

    public function getDataFormated($data, $t) {

        $date = Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->data . "'")->queryScalar();
        return $this->getItaDate($data->data);
    }

    public function getDataUpadate($data, $t) {

        $date = Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->data_aggiornamento . "'")->queryScalar();
        return $this->getItaDate($data->data_aggiornamento);
    }

    public function getEsportazione() {
        $dati = Yii::app()->db->createCommand("SELECT * FROM db_nonconforme")->queryAll();
        return $dati;
    }

    public function getFunzione($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_funzione WHERE id='" . $data->funzione . "'")->queryScalar();
    }

    public function getSocieta($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_societa WHERE id='" . $data->societa . "'")->queryScalar();
    }

    public function getUnita($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $data->unita_operativa . "'")->queryScalar();
    }

    public function getChiusura($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_chiusura WHERE id='" . $data->chiusura . "'")->queryScalar();
    }

    public function getResponsabile($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_responsabile WHERE id='" . $data->responsabile . "'")->queryScalar();
    }

    public function getTipologia($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_tipologia_apertura WHERE id='" . $data->tipologia . "'")->queryScalar();
    }

    public function getSelectValue($id, $table) {
        return Yii::app()->db->createCommand("SELECT nome FROM " . $table . " WHERE id='" . $id . "'")->queryScalar();
    }

    public function getAllegato($id) {
        return Yii::app()->db->createCommand("SELECT allegato FROM db_nonconforme WHERE id='" . $id . "'")->queryScalar();
    }

    function generaCodice($unita, $id) {

        #PRIMA LO CANCELLO 
        Yii::app()->db->createCommand("DELETE FROM doc_codici WHERE id_nc ='" . $id . "'")->execute();

        $u = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id='" . $unita . "'")->queryScalar();
        $c = Yii::app()->db->createCommand("SELECT MAX(id) FROM doc_codici WHERE unita='" . $u . "'")->queryScalar();
        $nc = $c + 1;
        $i = Yii::app()->db->createCommand("INSERT INTO doc_codici (id,unita,id_nc) VALUE ('" . $nc . "', '" . $u . "','" . $id . "')")->execute();
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $u . "-" . $nc . "'  WHERE id='" . $id . "'")->execute();
        return $u . "-" . $nc;
    }

    function updateCodice($id, $codice) {
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $codice . "'  WHERE id='" . $id . "'")->execute();
    }
    
    function getUserType($id){
        $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . $id . "'")->queryScalar();
        if($typeUser =='1' || $typeUser =='3' )
            $user = 'admin';
        else
            $user ='user';
        
        return $user;
    }
    
    public function getCodici($id) {
        
        $userType = $this->getUserType($id);
        
        if($userType!='admin'){
            
            if($id==110)
                $where = " WHERE unita_operativa IN ('19','20','21','22')";
            else{
                $userUnit = $this->setUserUnita($id);
                $where = "WHERE unita_operativa ='".$userUnit."' ";
            }
        }
         
        $dati = Yii::app()->db->createCommand("SELECT id, codice as nome FROM  db_nonconforme " . $where. " ORDER BY nome")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }
    
    
    function setUserUnita($id){
        return Yii::app()->db->createCommand("SELECT user_unita FROM utenti WHERE id='" . $id . "'")->queryScalar();
    }
    
    
    function sendEmailTrattamento($id){
        $dati = Yii::app()->db->createCommand("SELECT * FROM db_nonconforme  WHERE id ='" . $id . "'")->queryAll();

        $object = "TRATTAMNETO AZIONE NON CONFORME RIFIUTATO ";
        
        $txt ="<div style='background:#F8F8F8;padding: 10px'>";
        $txt .= "<p>La proposta di trattamento per la seguente azione non conforme inserita non &egrave; stata accettata</p>";
        $txt .= "<p>Si prega di aggiornare l'azione non conforme proponendo un altra proposta di trattamento</p>";
        $txt .= "<p><span style='color:#'>".$dati[0]['trattamento_note']."</span></p>";
        
        $txt .="</div><div style='margin-top: 20px'>";
        $txt .= "Codice :" . $dati[0]['codice'] . " <br> ";
        $txt .= "Data :" . $this->getItaDate($dati[0]['data']) . " \n <br>";
        $txt .= "Inserito da  :" . Yii::app()->db->createCommand("SELECT user FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Nome  :" . $dati[0]['nome'] . " \n ";
        $txt .= "Cognome  :" . $dati[0]['cognome'] . " \n ";
        $txt .= "Funzione  :" . Yii::app()->db->createCommand("SELECT nome FROM doc_funzione WHERE id='" . $dati[0]['funzione'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Responsabile :" . Yii::app()->db->createCommand("SELECT nome FROM doc_responsabile WHERE id='" . $dati[0]['responsabile'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Societa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_societa WHERE id='" . $dati[0]['societa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Unita Operativa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $dati[0]['unita_operativa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Tipologia :" . Yii::app()->db->createCommand("SELECT nome FROM doc_tipologia_apertura WHERE id='" . $dati[0]['tipologia'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Descrizione :" . $dati[0]['descrizione'] . " \n <br>";
        $txt .= "Trattamento  RIFIUTATO:" . $dati[0]['trattamento'] . " \n <br>";
        $txt .="</div>";
        
        $destinatario =  Yii::app()->db->createCommand("SELECT email FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar();
                
        $mail = new YiiMailer();
        $mail->setFrom('info@cooperativadoc.it', 'Qualita cooperativadoc');
        $mail->setTo(array('djamal@archynet.it', $destinatario ));
        $mail->setSubject($object);
        $mail->setBody($object . "\n \n " . $txt);
        $mail->send();
   }
    
    
    public function sendEmail($id, $from) {

        $dati = Yii::app()->db->createCommand("SELECT * FROM db_nonconforme  WHERE id ='" . $id . "'")->queryAll();

        $object = "INSERIMENTO NUOVA AZIONE NON CONFORME";
        if ($from == 'E')
            $object = "AGGIORNAMENTO AZIONE NON CONFORME";

        $txt = "Codice :" . $dati[0]['codice'] . " <br> ";
        $txt .= "Data :" . $this->getItaDate($dati[0]['data']) . " \n <br>";
        $txt .= "Inserito da  :" . Yii::app()->db->createCommand("SELECT user FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Nome  :" . $dati[0]['nome'] . " \n ";
        $txt .= "Cognome  :" . $dati[0]['cognome'] . " \n ";
        $txt .= "Funzione  :" . Yii::app()->db->createCommand("SELECT nome FROM doc_funzione WHERE id='" . $dati[0]['funzione'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Responsabile :" . Yii::app()->db->createCommand("SELECT nome FROM doc_responsabile WHERE id='" . $dati[0]['responsabile'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Societa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_societa WHERE id='" . $dati[0]['societa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Unita Operativa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $dati[0]['unita_operativa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Tipologia :" . Yii::app()->db->createCommand("SELECT nome FROM doc_tipologia_apertura WHERE id='" . $dati[0]['tipologia'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Descrizione :" . $dati[0]['descrizione'] . " \n <br>";
        $txt .= "Trattamento :" . $dati[0]['trattamento'] . " \n <br>";
        $txt .= "Chiusura :" . Yii::app()->db->createCommand("SELECT nome FROM doc_chiusura WHERE id='" . $dati[0]['chiusura'] . "'")->queryScalar() . " \n <br>";

        if ($dati[0]['allegato'])
            $txt .= "Allegato :" . $dati[0]['allegato'] . " \n <br>";

        $mail = new YiiMailer();
        $mail->setFrom('info@cooperativadoc.it', 'Qualita cooperativadoc');
        $mail->setTo(array('djamal@archynet.it','qualita@cooperativadoc.it'));
        $mail->setSubject($object);
        $mail->setBody($object . "\n \n " . $txt);
        if ($dati[0]['allegato'])
            $mail->setAttachment(Yii::app()->basePath . '/../images/allegati/' . $dati[0]['allegato']);
        
        $mail->send();


        
        
    }

    function getItaDate($date) {

        $g = explode(" ", $date);
        $d = explode("-", $g[0]);
        return $d[2] . " " . $this->getMount($d[1]) . " " . $d[0];
    }

    function getMount($m) {
        switch ($m) {
            case"01":
                $mese = "Gennaio";
                break;
            case"02":
                $mese = "Febbraio";
                break;
            case"03":
                $mese = "Marzo";
                break;
            case"04":
                $mese = "Aprile";
                break;
            case"05":
                $mese = "Maggio";
                break;
            case"06":
                $mese = "Giugno";
                break;
            case"07":
                $mese = "Luglio";
                break;
            case"08":
                $mese = "Agosto";
                break;
            case"09":
                $mese = "Settembre";
                break;
            case"10":
                $mese = "Ottobre";
                break;
            case"11":
                $mese = "Novembre";
                break;
            case"12":
                $mese = "Dicembre";
                break;
        }

        return $mese;
    }

    protected function beforeValidate() {


        #$this->setAttribute('data', 'NOW()');

        return parent::beforeValidate();
    }

}