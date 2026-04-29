<?php

class Comunicazioni extends CActiveRecord {

    // Comunicazioni push ( One Signal )
    var $signalText = "";
    var $signalTitle = "";
    var $signalApId = "9e208e47-0f90-4222-8f94-7f3aa7596f4d";
    var $signalApKey = "NzA0NTlmZjEtODA2My00ODdmLWJlOTgtNjRlNjE2YWM4OGE1";
    var $signalTags = array();
    var $signalSegments = "";
    var $typeUser = "";
    
    // Comunicazioni Sms ( totalc )
    var $sms_user = 'docscs08';
    var $sms_psw = 'lo2612pk';
    var $sms_text = "";
    var $sms_sender = "";
    var $sms_destinatario = "";
    
// Comunicazioni Email ( Totac )
    var $email_user = 'docscs08';
    var $email_psw = 'lo2612pk';
    var $email_sender = 'Cooperativa Doc S.c.s Qualita';
    var $email_email = "qualita@cooperativadoc.it";
    var $email_destinatari = array();
    var $destinatari = array();
    var $selectRuoli = array();
    var $selectStrutture = array();
    var $selectUtenti = array();
    var $selectTipi = array("S" => "Invio Sms ", "E" => "Invio Email ", "P" => "Notifica Push ");

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'comunicazioni';
    }

    public function rules() {
        return array(
            array('tipo', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('tipo', 'checkTipo'),
            array('dstinatario', 'checkDestinatario'),
            array('destinatario, ruolo, struttura', 'numerical', 'integerOnly' => true),
            array('tutti', 'length', 'max' => 1),
            array('sender', 'length', 'max' => 16),
            array('data_invio', 'length', 'max' => 20),
            
            array('messaggio_sms,messaggio_push, oggetto , titolo', 'length', 'max' => 255, 'message' => 'Il campo {attribute} &egrave; troppo lungo accorciare il {attribute}'),
            array('id, destinatario, ruolo, tutti, messaggio_sms,messaggio_email,messaggio_push, data_invio, risposta, struttura', 'safe', 'on' => 'search'),
        );
    }

    public function checkDestinatario() {
        if ($this->tutti != 'Y' && !$this->destinatario && !$this->struttura && !$this->ruolo)
            $this->addError("destinatario", "Specificare a chi mandare la comunicazione (destinatario / tutti / struttura o ruolo )");
    }

    public function checkTipo() {
        switch ($this->tipo) {
            case"S":
                if (!$this->sender)
                    $this->addError("destinatario", "Indicare il mittente per l' sms ");
                if (!$this->messaggio_sms)
                    $this->addError("destinatario", "Indicare il messaggio per l' sms ");
                break;
            case"P":
                if (!$this->messaggio_push)
                    $this->addError("destinatario", "Indicare il testo della notifica ");
                if (!$this->titolo)
                    $this->addError("destinatario", "Indicare il titolo della notifica ");

                break;
            case"E":
                if (!$this->oggetto)
                    $this->addError("destinatario", "Indicare l'oggeto della mail ");
                if (!$this->messaggio_email)
                    $this->addError("destinatario", "Indicare il messaggio della mail ");
                break;
        }
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'destinatario' => 'Destinatario',
            'ruolo' => 'Ruolo',
            'tutti' => 'Tutti',
            'messaggio_sms' => 'Messaggio',
            'messaggio_email' => 'Messaggio',
            'messaggio_push' => 'Messaggio',
            'data_invio' => 'Data Invio',
            'risposta' => 'Risposta',
            'struttura' => 'Struttura',
            'tipo' => 'Tipo',
            'quanti' => 'Quanti',
            'sender' => 'Mittente',
            'oggetto' => 'Oggetto',
            'stato' => 'Inviati',
            'titolo' => 'Titolo',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;
         $criteria->order = 'data_invio DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('destinatario', $this->destinatario);
        $criteria->compare('ruolo', $this->ruolo);
        $criteria->compare('tutti', $this->tutti, true);
        $criteria->compare('messaggio_sms', $this->messaggio_sms, true);
        $criteria->compare('messaggio_push', $this->messaggio_push, true);
        $criteria->compare('messaggio_email', $this->messaggio_email, true);
        $criteria->compare('data_invio', $this->data_invio, true);
        $criteria->compare('risposta', $this->risposta, true);
        $criteria->compare('struttura', $this->struttura);
        $criteria->compare('tipo', $this->tipo);
        $criteria->compare('quanti', $this->quanti);
        $criteria->compare('sender', $this->sender);
        $criteria->compare('oggetto', $this->oggetto);
        $criteria->compare('titolo', $this->titolo);


        $criteria->compare('stato', $this->stato);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getTipo($data, $d) {
        switch ($data->tipo) {
            case"S":
                $x = "Invio sms";
                break;
            case"E":
                $x = "Invio email";
                break;
            case"P":
                $x = "Invio notifica";
                break;
        }

        return $x;
    }
    
    public function getTipoInvio($tipo) {
        switch ($tipo) {
            case"S":
                $x = "Invio sms";
                break;
            case"E":
                $x = "Invio email";
                break;
            case"P":
                $x = "Invio notifica";
                break;
        }

        return $x;
    }
    
    
    public function getData($data, $d) {
        return Yii::app()->MyUtils->getItaDate($data->data_invio);
    }

    public function getDestinatario($data, $d) {

        if ($data->destinatario)
            return Yii::app()->MyUtils->getSelectValue($data->destinatario, "utenti_communicazioni");
    }

    public function getRuolo($data, $d) {
        if ($data->ruolo)
            return Yii::app()->MyUtils->getSelectValue($data->ruolo, "utenti_tipi");
    }
    
    public function getMessaggio($data, $d) {
        switch ($data->tipo) {
            case"S":
                $x = $data->messaggio_sms;
                break;
            case"E":
                $x = $data->messaggio_email;
                break;
            case"P":
                $x = $data->messaggio_push;
                break;
        }
         return $x;
    }
    
    
    
    public function getStruttura($data, $d) {
        if ($data->struttura)
            return Yii::app()->MyUtils->getSelectValue($data->struttura, "doc_unita");
    }

    public function getTutti($data, $d) {

        $x = '';
        if ($data->tutti == 'Y')
            $x = "<i class=' alert-success fa fa-check' ></i>";

        return $x;
    }

    public function getNotifiche($data, $d) {
        
    }

    public function coustomText($text, $destinario) {
        $txt = str_replace("[NOME]", $destinario['nome'], $text);
        $txt = str_replace("[COGNOME]", $destinario['cognome'], $txt);
        $txt = str_replace("[CENTRO]", $destinario['u_centro'], $txt);
        return $txt;
    }

    public function setDestinatari() {


        switch ($this->tipo) {
            case"S":
                $AND = " AND cellulare !='' ";
                break;
            case"E":
                $AND = " AND email !='' ";
                break;
            case"P":
                $AND = " AND id_signal !='' ";
                break;
        }

        // Invio a tutti 
        $query = "SELECT id, nome, cognome, email , cellulare , id_signal FROM utenti ";
        // Invio a ruolo 
        $where = " WHERE user_type ='" . $this->ruolo . "'  " . $AND;
        // Invio a singolo
        $where = " WHERE id ='" . $this->destinatario . "' " . $AND;
        // Invio a struttura
        $where = " WHERE user_unita ='" . $this->struttura . "' " . $AND;

        $this->destinatari = Yii::app()->db->createCommand($query)->queryAll();
    }

    public function sendComunication() {

        $this->setDestinatari();
        
        $this->stato = "Y";
        
        
        if (count($this->destinatari)) {

            switch ($this->tipo) {
                case"S":

                    $mess_OK = " Invio sms eseguito con successo totale <b>destinatari [TOT]</b>";
                    $mess_KO = " Errore durente l'invio dell'sms. <b>Inviati [TOT]</b>";

                    for ($x = 0; $x < count($this->destinatari); $x++) {

                        $this->sms_sender = $this->sender;
                        $this->sms_text = $this->coustomText($this->messaggio_sms, $this->destinatario[$x]);
                        $this->sms_destinatario = $this->destinatari[$x]['cellulare'];
                        $result = $this->sendSms();
                        if ($result == 'OK')
                            $this->quanti++;
                        else
                            $this->stato = 'N';
                    }
                    break;
                case"E":

                    $mess_OK = " Invio email eseguito con successo totale <b>inviati [TOT]</b>";
                    $mess_KO = " Errore durente l'invio email.<b> Inviati [TOT]</b>";

                    for ($x = 0; $x < count($this->destinatari); $x++) {

                        $this->email_oggetto = $this->oggetto;
                        $this->email_text = $this->coustomText($this->messaggio_email);
                        $this->email_destinatari = array($this->destinatari[$x]['email']);
                        $result = $this->sendEmail();
                        if ($result == 'OK')
                            $this->quanti++;
                        else
                            $this->stato = 'N';
                    }
                    break;
                case"P":

                    $mess_OK = " Invio notifica push eseguito con successo totale <b>destinatari [TOT] </b>";
                    $mess_KO = " Errore durente l'invio dell'sms. <b>Inviati [TOT]</b>";

                    $this->signalText = $this->messaggio_push;
                    $this->signalTitle = $this->titolo;

                    if ($this->destinatario)
                        $this->signalTags = array(array('key' => 'user', 'relation' => '=', 'value' => $this->destinatario));
                    if ($this->struttura)
                        $this->signalTags = array(array('key' => 'struttura', 'relation' => '=', 'value' => $this->struttura));
                    if ($this->ruolo)
                        $this->signalTags = array(array('key' => 'ruolo', 'relation' => '=', 'value' => $this->ruolo));
                    if ($this->tutti == 'Y')
                        $this->signalSegments = array('All');
                    $result = $this->sendPush();
                    if(is_numeric($result))
                        $this->quanti = $result;
                    else
                        $this->stato = 'N';
                    break;
            }
        }

        if ($this->stato == "Y") {
            $risultato["txt"] = str_replace("[TOT]", $this->quanti, $mess_OK);
            $risultato['stato'] = 'opResultOK';
        } else {
            $risultato["txt"] = str_replace("[TOT]", $this->quanti, $mess_OK);
            $risultato['stato'] = 'opResultKO';
        }
        
        if($this->quanti > 0)
            Yii::app()->db->createCommand("UPDATE ".$this->tableName()." SET quanti ='".$this->quanti."' WHERE id='" . $this->id . "'")->execute();
        
        
        return $risultato;
    }

    public function sendSms() {

        $returnURL = "https://centriestivi.keluar.it/delivery/delivery_sms.php";
        $stringa = "https://www.totalconnect.it/send_sms/register.php?username=" . $this->sms_user . "";
        $stringa .= "&password=" . $this->sms_psw . "&type_user=admin";
        $stringa .= "&route=GW2&message=" . urlencode($this->sms_text) . "&to=" . urlencode($this->sms_destinatario) . "";
        $stringa .= "&from=" . urlencode($this->sms_sender);
        $stringa .= "&idrefer=" . $this->id . "&returnURL=" . urlencode($returnURL) . "&delivery=s";
        if (strlen($this->testo) > 160)
            $stringa .="&split=s";
        $contents = file($stringa);
        return trim($contents[0]);
    }

    public function sendEmail() {
        $wsdl = new SoapClient("https://www.totalconnect.it/ws/email.php?wsdl");
        $dati = array(
            'username' => $this->email_user,
            'password' => $this->email_psw,
            'address' => $this->email_destinatari,
            'name_sender' => $this->email_sender,
            'email_sender' => $this->email_email,
            'object' => utf8_encode($this->email_oggetto),
            'body_message' => $this->email_text,
            'refer_id' => $this->id
        );
        $risposta = (array) $wsdl->__soapCall('sendEmail', $dati);
        return $risposta['result']; // 1 OK 
    }

    public function sendPush() {

        $content = array(
            "en" => $this->signalText,
            "it" => $this->signalText,
        );

        $headings = array(
            "en" => $this->signalTitle,
            "it" => $this->signalTitle,
        );


        $fields = array(
            'app_id' => $this->signalApId,
            'data' => array("foo" => "bar"),
            'included_segments' => $this->signalSegments, #  array('All'),
            'tags' => $this->signalTags,
            'contents' => $content,
            'headings' => $headings,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $this->signalApKey . ' '));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        $return = $response;
        $obj = json_decode($return);
        return $obj->{'recipients'};
    }

    public function getSmsDelivery($id) {
        $txt = '';
        $stat = array();
        $delivery = Yii::app()->db->createCommand("SELECT status, number , DATE_FORMAT(data_delivery ,'%d-%m-%Y %H:%i') as data  FROM  send_sms_stats WHERE id_send='" . $id . "'")->queryAll();
        for ($x = 0; $x < count($delivery); $x++) {

            if ($delivery[$x]['status'] == 'D')
                $stat[$x] = "<i class='fa alert-success fa-check-square-o'></i>";
            else
                $stat[$x] = "<i class='fa fa-minus-circle alert-danger'></i>";


            $txt .= "<tr>";
            $txt .= "<td>" . $delivery[$x]['number'] . "</td>";
            $txt .= "<td class='centered'>" . $stat[$x] . "</td>";
            $txt .= "<td>" . $delivery[$x]['data'] . "</td>";
            $txt .= "</tr>";
        }

        $dati['count'] = count($delivery);
        $dati['txt'] = $txt;
        return $dati;
    }

    public function getEmailDelivery($id) {
        $txt = '';
        $stat = array();
        $delivery = Yii::app()->db->createCommand("SELECT status, email , DATE_FORMAT(data_delivery ,'%d-%m-%Y %H:%i') as data  FROM  send_email_stats WHERE id_send='" . $id . "'")->queryAll();
        for ($x = 0; $x < count($delivery); $x++) {

            if ($delivery[$x]['status'] == 'D')
                $stat[$x] = "<i class='fa alert-success fa-check-square-o'></i>";
            else
                $stat[$x] = "<i class='fa fa-minus-circle alert-danger'></i>";


            $txt .= "<tr>";
            $txt .= "<td>" . $delivery[$x]['number'] . "</td>";
            $txt .= "<td class='centered'>" . $stat[$x] . "</td>";
            $txt .= "<td>" . $delivery[$x]['data'] . "</td>";
            $txt .= "</tr>";
        }

        $dati['count'] = count($delivery);
        $dati['txt'] = $txt;
        return $dati;
    }

    public function setSelect() {
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectUtenti = Yii::app()->MyUtils->getSelect('utenti');
        $this->selectRuoli = Yii::app()->MyUtils->getSelect('utenti_tipi');
    }

}