<?php

class DbAzionicorrettive extends CActiveRecord {

    var $selectFunzioni = array();
    var $selectSocieta = array();
    var $selectTipologie = array();
    var $selectUnita = array();
    var $selectAzioni = array();
    var $selectCodici = array();
    var $datiEsportazione = array();
    var $typeUser           = '';
    public $allegato;

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_azionicorrettive';
    }

    public function rules() {

        return array(
            array('data, tipo_azione, societa,nome, cognome, codice_riferimento, funzione, tipologia, descrizione, trattamento, verifica_efficacia', 'required', 'message' => 'Compilare il campo'),
            array('tipo_azione, societa, unita_operativa, funzione, tipologia', 'numerical', 'integerOnly' => true),
            array('codice_riferimento', 'length', 'max' => 20),
            array('unita_operativa','validaUnita'),
            array('allegato', 'file', 'types' => 'jpg, gif, png, doc, pdf, xls, xxls', 'message' => 'Possono essere caricati solo file con le seguenti estensioni jpg, png, doc, xls, pdf', 'allowEmpty' => true),
            // Please remove those attributes that should not be searched.
            array('id, data, tipo_azione, societa, unita_operativa, nome, cognome, codice_riferimento, funzione, tipologia, descrizione, trattamento', 'safe', 'on' => 'search'),
        );
    }
    
    public function validaUnita(){
       $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryScalar();
        if($typeUser=='admin' || Yii::app()->user->getId()==110){
            if (!$this->unita_operativa || $this->unita_operativa=='')
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
            'tipo_azione' => 'Tipo Azione',
            'societa' => 'Societa',
            'unita_operativa' => 'Unita Operativa',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'codice_riferimento' => 'Codice Riferimento',
            'funzione' => 'Funzione',
            'tipologia' => 'Tipologia',
            'descrizione' => 'Entro il ',
            'trattamento' => 'Descrizione Azione Correttiva / Azione Preventiva',
            'allegato' => 'Allegato',
            'verifica_efficacia' => 'Efficacia verifica'
        );
    }

    public function search() {

        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('tipo_azione', $this->tipo_azione);
        $criteria->compare('societa', $this->societa);
        $criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('codice_riferimento', $this->codice_riferimento, true);
        $criteria->compare('funzione', $this->funzione);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('trattamento', $this->trattamento, true);
        $criteria->compare('allegato', $this->allegato, true);
        $criteria->compare('verifica_efficacia', $this->verifica_efficacia, true);
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

    function getUserType($id){
        $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . $id . "'")->queryScalar();
        if($typeUser =='1' || $typeUser =='3')
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
        
        
        $dati = Yii::app()->db->createCommand("SELECT id, codice as nome FROM db_nonconforme ".$where."  ORDER BY nome")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }
    
    function setUserUnita($id){
        
        
        
        return Yii::app()->db->createCommand("SELECT user_unita FROM utenti WHERE id='" . $id . "'")->queryScalar();
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

    public function getEsportazione() {
        $dati = Yii::app()->db->createCommand("SELECT * FROM db_azionicorrettive ")->queryAll();
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

    public function getResponsabile($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_responsabile WHERE id='" . $data->responsabile . "'")->queryScalar();
    }

    public function getTipologia($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_tipologia_apertura WHERE id='" . $data->tipologia . "'")->queryScalar();
    }

    public function getCode($data, $t) {
        return Yii::app()->db->createCommand("SELECT codice FROM db_nonconforme WHERE id='" . $data->codice_riferimento . "'")->queryScalar();
    }

    public function getSelectValue($id, $table) {
        return Yii::app()->db->createCommand("SELECT nome FROM " . $table . " WHERE id='" . $id . "'")->queryScalar();
    }

    public function getCodice($data) {
        return Yii::app()->db->createCommand("SELECT codice FROM db_nonconforme WHERE id='" . $data . "'")->queryScalar();
    }

    public function getAllegato($id) {
        return $allegato = Yii::app()->db->createCommand("SELECT allegato FROM db_azionicorrettive WHERE id='" . $id . "'")->queryScalar();
    }

    function generaCodice($id, $a, $b) {
        $societa = Yii::app()->db->createCommand("SELECT codice FROM doc_societa WHERE id='" . $a . "'")->queryScalar();
        $unita = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id='" . $b . "'")->queryScalar();
        return $societa . "-" . $unita . "-" . $id;
    }

    function updateCodice($id, $codice) {
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $codice . "'  WHERE id='" . $id . "'")->execute();
    }

    public function getDataFormated($data, $t) {

        $date = Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->data . "'")->queryScalar();
        return $this->getItaDate($data->data);
    }

    public function getDataUpadate($data, $t) {

        $date = Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->data_aggiornamento . "'")->queryScalar();
        return $this->getItaDate($data->data_aggiornamento);
    }

    public function sendEmail($id, $from) {

        $dati = Yii::app()->db->createCommand("SELECT * FROM db_azionicorrettive  WHERE id ='" . $id . "'")->queryAll();
        $tipo = Yii::app()->db->createCommand("SELECT nome FROM doc_azione WHERE id='" . $dati[0]['tipo_azione'] . "'")->queryScalar();


        $object = "INSERIMENTO NUOVA " . $tipo;
        if ($from == 'E')
            $object = "AGGIORNAMENTO " . $tipo;
        $txt = "Codice riferimento :" . Yii::app()->db->createCommand("SELECT codice FROM db_nonconforme WHERE id='" . $dati[0]['codice_riferimento'] . "'")->queryScalar() . " <br>\n ";
        $txt .= "Data :" . $this->getItaDate($dati[0]['data']) . " <br> \n ";
        $txt .= "Inserito da  :" . Yii::app()->db->createCommand("SELECT user FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar() . " <br>\n ";
        $txt .= "Nome  :" . $dati[0]['nome'] . "<br> \n ";
        $txt .= "Cognome  :" . $dati[0]['cognome'] . " <br> \n ";
        $txt .= "Tipo di azione :" . $tipo . " <br> \n ";
        $txt .= "Societa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_societa WHERE id='" . $dati[0]['societa'] . "'")->queryScalar() . " <br> \n ";
        $txt .= "Unita Operativa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $dati[0]['unita_operativa'] . "'")->queryScalar() . " <br> \n ";
        $txt .= "Tipologia :" . Yii::app()->db->createCommand("SELECT nome FROM doc_tipologia_apertura WHERE id='" . $dati[0]['tipologia'] . "'")->queryScalar() . " <br> \n ";
        $txt .= "Entro il :" . $this->getDate($dati[0]['descrizione']) . " <br> \n ";
        $txt .= "Trattamento :" . $dati[0]['trattamento'] . " <br> \n ";
        $txt .= "Efficacia verifica :" . $dati[0]['verifica_efficacia'] . " <br> \n ";

        $mail = new YiiMailer();
        $mail->setFrom('info@cooperativadoc.it', 'Qualita cooperativadoc');
        $mail->setTo("qualita@cooperativadoc.it");
        #$mail->setTo("djamal@archynet.it");
        $mail->setSubject($object);
        $mail->setBody($object . "\n \n " . $txt);
        if ($dati[0]['allegato'])
            $mail->setAttachment(Yii::app()->basePath . '/../images/allegati/' . $dati[0]['allegato']);
        $mail->send();

        mail("andrea@totalconnect.it", $object, $object . "\n \n " . $txt, "From:info@cooperativadoc.it", "");
    }

    function getDate($date, $type=NULL) {
        $g = explode("-", $date);
        return $g[2] . "-" . $g[1] . "-" . $g[0];
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