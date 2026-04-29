<?php

class InviiEmail extends CActiveRecord {
    
    public function tableName() {
        return 'send_email';
    }

    public function rules() {

        return array(
            array('sender, testo', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_destinatari, quanti, effettuati', 'numerical', 'integerOnly' => true),
            array('tipo, tutti', 'length', 'max' => 1),
            array('tutti', 'validaDestination'),
            array('sender', 'length', 'max' => 255),
            array('turno,centro,periodo', 'length', 'max' => 2),
            array('data_visita', 'safe'),
            array('id, tipo, turno,centro,centro_vacanza,  periodo, destinatari, id_destinatari, sender, testo, quanti, data_invio, tutti, effettuati, data_visita', 'safe', 'on' => 'search'),
        );
    }

    function validaDestination() {
        if ($this->tutti == 'N' && !$this->turno && !$this->centro_vacanza && !$this->periodo && !$this->id_destinatari)
            $this->addError("tutti", "Specificare la data della vista o se inviare il messaggio a tutti i partecipanti");
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'tipo' => 'Tipo',
            'destinatari' => 'Destinatari',
            'id_destinatari' => 'Id Destinatari',
            'sender' => 'Oggetto',
            'testo' => 'Testo',
            'quanti' => 'Previsti',
            'data_invio' => 'Data Invio',
            'tutti' => 'Tutti',
            'effettuati' => 'Effettuati',
            'data_visita' => 'Data Visita',
            'turno' => 'Turno',
            'centro' => 'Centro',
            'centro_vacanza' => 'Centro',
            'periodo' => 'Periodo',
            'scheda' => 'Scheda',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('destinatari', $this->destinatari, true);
        $criteria->compare('id_destinatari', $this->id_destinatari);
        $criteria->compare('sender', $this->sender, true);
        $criteria->compare('testo', $this->testo, true);
        $criteria->compare('quanti', $this->quanti);
        $criteria->compare('scheda', $this->scheda);
        $criteria->compare('data_invio', $this->data_invio, true);
        $criteria->compare('tutti', $this->tutti, true);
        $criteria->compare('effettuati', $this->effettuati);
        $criteria->compare('data_visita', $this->data_visita, true);
        $criteria->compare('turno', $this->turno, true);
        $criteria->compare('centro', $this->centro, true);
        $criteria->compare('centro_vacanza', $this->centro_vacanza, true);
        $criteria->compare('periodo', $this->periodo, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function getAll($data, $d) {
        $n = '';
        if ($data->tutti == 'Y')
            $n = "<i class='fa alert-success fa-check-square-o'></i>";
        return $n;
    }

    public function getDestinatari($data, $d) {
        $n = '';
        if ($data->tipo == 'S') {
            $dati = Yii::app()->db->createCommand("SELECT nome , cognome FROM  clienti WHERE id='" . $data->id_destinatari . "'")->queryRow();
            $n = $dati['nome'] . " " . $dati['cognome'];
        }
        return $n;
    }

    public function getPeriodo($data, $d) {
        $p = '';
        if ($data->periodo) {
            $t = Yii::app()->db->createCommand("SELECT DATE_FORMAT(dal ,'%d-%m-%Y') as dal , DATE_FORMAT(al ,'%d-%m-%Y') as al FROM _periodi WHERE  id='" . $data->periodo . "' ")->queryRow();
            $p = "<b>Dal </b>" . $t['dal'] . " <b>AL</b> " . $t['al'];
        }

        return $p;
    }

    public function getCentro($data, $d) {
        $p = '';
        if ($data->centro)
            $p = Yii::app()->db->createCommand("SELECT nome FROM _centri_vacanza WHERE  id='" . $data->centro . "' ")->queryScalar();
        return $p;
    }

    public function getTurno($data, $d) {
        $p = '';
        if ($data->turno) {
            $p = Yii::app()->db->createCommand("SELECT nome FROM _turni WHERE  id='" . $data->turno . "' ")->queryScalar();
        }
        return $p;
    }

    public function getTipoSend($data, $d) {

        $n = 'Multiplo';
        if ($data->tipo == 'S')
            $n = 'Singolo';
        return $n;
    }

    public function getDataSend($data, $d) {
        return Yii::app()->MyUtils->reverseDate($data->data_invio);
    }

    public function getDataVista($data, $d) {
        return Yii::app()->MyUtils->reverseDate($data->data_visita);
    }

    public function getQueryAnd() {

        $AND = " AND  u.anno ='" . date("Y") . "' ";
        if ($this->turno || $this->periodo || $this->centro_vancanza || $this->scheda) {

            if ($this->scheda == 'C')
                $AND .=" AND u.scheda ='Y'";
            else if ($this->scheda == 'NC')
                $AND .=" AND u.scheda != 'Y'";
            if ($this->turno)
                $AND .=" AND u.turno ='" . $this->turno . "'";
            if ($this->periodo)
                $AND .=" AND u.periodo ='" . $this->periodo . "'";
            if ($this->centro_vacanza)
                $AND .=" AND u.centro ='" . $this->centro_vacanza . "'";
        }
        else if ($this->id_destinatari)
            $AND .= " AND u.id ='" . $this->id_destinatari . "'";

        return $AND;
    }

    public function setDestination() {
        $query = "SELECT count(u.comp_email) FROM clienti AS u WHERE u.comp_email !='' ";
        return Yii::app()->db->createCommand($query . " " . $this->getQueryAnd() . " ")->queryScalar();
    }

    public function getDelivery($id) {
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

    public function sendMultiEmail() {

        $query = "SELECT u.scheda , u.centro, u.turno, u.periodo ,u.nome as nome , u.cognome as cognome , u.comp_email as email , c.nome  as u_centro , t.nome as u_turno, DATE_FORMAT(p.dal, '%d-%m-%Y') as u_dal ,DATE_FORMAT(p.al, '%d-%m-%Y') as u_al ";
        $query .= "FROM clienti as u ";
        $query .="LEFT JOIN _turni as t ON u.turno = t.id ";
        $query .="LEFT JOIN _centri_vacanza as c ON u.centro = c.id ";
        $query .="LEFT JOIN _periodi as p ON u.periodo  = p.id  WHERE comp_email !='' ";

        $destinatari = Yii::app()->db->createCommand($query . " " . $this->getQueryAnd())->queryAll();

        $effettuati = 0;
        $noSend = 0;
        $problemi = '';

        if (count($destinatari) > 0) {

            $wsdl = new SoapClient("https://www.totalconnect.it/ws/email.php?wsdl");

            for ($x = 0; $x < count($destinatari); $x++) {

                $txt = str_replace("[NOME]", $destinatari[$x]['nome'], $this->testo);
                $txt = str_replace("[COGNOME]", $destinatari[$x]['cognome'], $txt);
                $txt = str_replace("[CENTRO]", $destinatari[$x]['u_centro'], $txt);
                $txt = str_replace("[PERIODO]", "Dal " . $destinatari[$x]['u_dal'] . " AL " . $destinatari[$x]['u_dal'], $txt);
                $txt = str_replace("[TURNO]", $destinatari[$x]['u_turno'], $txt);

                $sendTo = array($destinatari[$x]['email']);

                $dati = array(
                    'username' => $this->email_user,
                    'password' => $this->email_psw,
                    'address' => $sendTo,
                    'name_sender' => $this->email_sender,
                    'email_sender' => $this->email_email,
                    'object' => utf8_encode($this->sender),
                    'body_message' => $txt,
                    'refer_id' => $this->id
                );

               # $risposta = (array) $wsdl->__soapCall('sendEmail', $dati);

                $risposta['result'] = 1;

                if ($risposta['result'] != 1) {
                    $noSend++;
                    $problemi .= implode(" ", (array) $risposta['response']) . "  destinatario: " . $destinatari[$x]['email'] . "<br />";
                }else
                    $effettuati++;
            }

            if ($problemi != '') {

                $result['stato'] = 'opResultKO';
                $result['txt'] = 'Problemi durante l\'invio delle Email <br /> Inviati: <b>' . $effettuati . ' </b> Non inviati: <b>' . $noSend . ' </b> <br />' . $problemi;
            } else {

                $result['stato'] = 'opResultOK';
                $result['txt'] = 'Email inviate correttamente totale Email: <b>' . $effettuati . '</b> ';
            }

            Yii::app()->db->createCommand("UPDATE send_email SET effettuati ='" . $effettuati . "' WHERE id='" . $this->id . "'")->execute();
        } else {

            $result['stato'] = 'opResultKO';
            $result['txt'] = 'Problemi durante l\'invio delle Email <br /> <b>Non sono stati trovati contatti a cui inviare l\'email </b> <br />';
        }

        return $result;
    }

}