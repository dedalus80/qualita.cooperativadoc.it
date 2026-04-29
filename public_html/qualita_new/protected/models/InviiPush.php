<?php

class InviiPush extends CActiveRecord {

    var $selectTurni        = array();
    var $selectPeriodi      = array();
    var $selectStrutture    = array();
    var $selectSezioni      = array();
    var $selectAdmin        = array();
    var $selectStati        = array("1" => "Inserimento", "2" =>"Agiornamento", "3" =>"Rimozione","4"=>"Approvazione" ,"5"=>"Rifuito" );
    var $datiAdmin = "";

    public function tableName() {
        return 'send_push';
    }

    public function rules() {
        return array(
            array('sender, testo', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_destinatari, quanti', 'numerical', 'integerOnly' => true),
            array('tipo', 'length', 'max' => 1),
            array('sezione,centro,stato', 'length', 'max' => 2),
            array('sender, data_visita', 'length', 'max' => 11, 'message' => 'Il mittente può essere lungo al massomo 11 caratteri'),
            array('id, tipo, destinatari, id_destinatari, sender, testo, quanti, data_visita,data_invio, unita_operativa,sezione, stato', 'safe', 'on' => 'search'),
        );
    }
    
    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tipo' => 'Tipo',
            'destinatari' => 'Destinatari',
            'id_destinatari' => 'Utente',
            'sender' => 'Utente',
            'testo' => 'Testo Notifica',
            'quanti' => 'Previsti',
            'effettuati' => 'Effettuati',
            'data_invio' => 'Data',
            'tutti' => 'Tutti i clienti',
            'data_vista' => 'In visita il',
            'centro' => 'Centro',
            'unita_operativa' => 'Struttura',
            'sezione' => 'Sezione',
            'stato' => 'Azione',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $criteria->order = ' data_invio DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('destinatari', $this->destinatari, true);
        $criteria->compare('id_destinatari', $this->id_destinatari);
        $criteria->compare('sender', $this->sender, true);
        $criteria->compare('testo', $this->testo, true);
        $criteria->compare('centro', $this->centro, true);
        $criteria->compare('unita_operativa', $this->unita_operativa, true);
        $criteria->compare('sezione', $this->sezione, true);
        $criteria->compare('stato', $this->stato, true);
        $criteria->compare('quanti', $this->quanti);
        $criteria->compare('effettuati', $this->effettuati);
        $criteria->compare('data_invio', $this->data_invio, true);
        $criteria->compare('tutti', $this->tutti, true);
        $criteria->compare('data_visita', $this->data_visita, true);

        $ids = Yii::app()->MyUtils->getUserStruttura();
        
        if (count($ids) > 0){
            $ids[] = 0;
            $criteria->addInCondition('unita_operativa', $ids, 'AND');
        }else
            $criteria->compare('unita_operativa', $this->unita_operativa);


        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }


    public function getText($data, $d) {

        return "<div class='only-480'><b>".str_replace("<br />"," ",Yii::app()->MyUtils->getItaDate($data->data_invio))."</b></div>".str_replace("\n", "<br />", $data->testo);
    }

    public function getSender($data, $d) {
        return str_replace(" ","<br />", Yii::app()->MyUtils->getSelectValue($data->id_destinatari, "dettaglio_admin"));
    }
    
    public function getDataSend($data, $d) {
        return Yii::app()->MyUtils->getItaDate($data->data_invio);
    }

    public function getStato($data, $d) {
        return $this->selectStati[$data->stato];
    }

    public function getCentro($data, $d) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }

    public function getSezione($data, $d) {
        return Yii::app()->MyUtils->getSelectValue($data->sezione, "comunicazioni_tipologie");
    }
    
    public function setDefaultValue() {
        $this->selectAdmin = Yii::app()->MyUtils->getSelect('utenti');
        $this->selectSezioni = Yii::app()->MyUtils->getSelect('comunicazioni_tipologie');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->datiAdmin = Yii::app()->MyUtils->getUserInfo();
    }

}

