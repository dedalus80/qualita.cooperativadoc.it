<?php

class InviiSms extends CActiveRecord {

    var $sendResult = array();
    var $sms = array();
    var $selectTurni = array();
    var $selectPeriodi = array();
    var $selectCentri = array();

    public function tableName() {
        return 'send_sms';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sender, testo', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_destinatari, quanti', 'numerical', 'integerOnly' => true),
            array('tutti', 'validaDestination'),
            array('tipo', 'length', 'max' => 1),
            array('sender, data_visita', 'length', 'max' => 11, 'message' => 'Il mittente può essere lungo al massomo 11 caratteri'),
            array('id, tipo, destinatari, id_destinatari, sender, testo, quanti, data_visita,data_invio, centro_vacanza,turno, periodo', 'safe', 'on' => 'search'),
        );
    }

    function validaDestination() {
        if ($this->tutti == 'N' && !$this->turno && !$this->centro_vacanza && !$this->id_destinatari && !$this->periodo)
            $this->addError("tutti", "Specificare i destinatari del messaggio (turno, centro , periodo) o se inviare il messaggio a tutti i destinatari");
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
            'sender' => 'Mittente Sms',
            'testo' => 'Testo Sms',
            'quanti' => 'Previsti',
            'effettuati' => 'Effettuati',
            'data_invio' => 'Data Invio',
            
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('destinatari', $this->destinatari, true);
        $criteria->compare('id_destinatari', $this->id_destinatari);
        $criteria->compare('sender', $this->sender, true);
        $criteria->compare('testo', $this->testo, true);
        $criteria->compare('quanti', $this->quanti);
        $criteria->compare('effettuati', $this->effettuati);
        $criteria->compare('data_invio', $this->data_invio, true);
        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    public static function model($className=__CLASS__) {
        return parent::model($className);
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
        $query = "SELECT count(u.comp_cellulare) FROM clienti AS u WHERE u.comp_cellulare !='' ";
        return Yii::app()->db->createCommand($query . " " . $this->getQueryAnd())->queryScalar();
    }

    public function sendMultiSms() {


        $query = "SELECT u.centro, u.turno, u.periodo ,u.nome as nome , u.cognome as cognome , u.comp_cellulare as cellulare , c.nome  as u_centro , t.nome as  u_turno, DATE_FORMAT(p.dal, '%d-%m-%Y') as u_dal ,DATE_FORMAT(p.al, '%d-%m-%Y') as u_al ";
        $query .= "FROM clienti as u ";
        $query .="LEFT JOIN _turni as t ON u.turno = t.id ";
        $query .="LEFT JOIN _centri_vacanza as c ON u.centro = c.id ";
        $query .="LEFT JOIN _periodi as p ON u.periodo  = p.id  WHERE comp_cellulare !='' ";

        $destinatari = Yii::app()->db->createCommand($query . " " . $this->getQueryAnd())->queryAll();

        $effettuati     = 0;
        $noSend         = 0;
        $problemi       = '';

        if (count($destinatari) > 0) {


            for ($x = 0; $x < count($destinatari); $x++) {

                $txt = str_replace("[NOME]", $destinatari[$x]['nome'], $this->testo);
                $txt = str_replace("[COGNOME]", $destinatari[$x]['cognome'], $txt);
                $txt = str_replace("[CENTRO]", $destinatari[$x]['u_centro'], $txt);
                $txt = str_replace("[PERIODO]", "Dal " . $destinatari[$x]['u_dal'] . " AL " . $destinatari[$x]['u_dal'], $txt);
                $txt = str_replace("[TURNO]", $destinatari[$x]['u_turno'], $txt);

                $returnURL = "https://centriestivi.keluar.it/delivery/delivery_sms.php";
                $stringa = "https://www.totalconnect.it/send_sms/register.php?username=" . $this->sms_user . "";
                $stringa .= "&password=" . $this->sms_psw . "&type_user=admin";
                $stringa .= "&route=GW2&message=" . urlencode($txt) . "&to=" . urlencode($destinatari[$x]['cellulare']) . "";
                $stringa .= "&from=" . urlencode($this->sender);
                $stringa .= "&idrefer=" . $this->id . "&returnURL=" . urlencode($returnURL) . "&delivery=s";
                if (strlen($this->testo) > 160)
                    $stringa .="&split=s";
                
                /*
                $contents = file($stringa);
                $risposta = trim($contents[0]);
                $len = strlen($risposta);
                */ 
                $risposta ="OK";
                
                if ($risposta != "OK") {
                    $noSend++;
                    $problemi .= implode(" ", $contents) . "  destinatario: " . $destinatari[$x]['cellulare'] . "<br />";
                }else
                    $effettuati++;
            }

            if ($problemi != '') {
                $result['stato'] = 'opResultKO';
                $result['txt'] = 'Problemi durante l\'invio degli sms <br /> Inviati: <b>' . $effettuati . '</b> Non inviati:<b>' . $noSend . '</b><br />' . $problemi;
            } else {
                $result['stato'] = 'opResultOK';
                $result['txt'] = 'Sms inviati correttamente totale Sms: <b>' . $effettuati . '</b> ';
            }
            
            Yii::app()->db->createCommand("UPDATE send_sms SET effettuati ='" . $effettuati . "' WHERE id='" . $this->id . "'")->execute();
        } else {
            $result['stato'] = 'opResultKO';
            $result['txt'] = 'Problemi durante l\'invio del\'Sms<br /> <b>Non sono stati trovati contatti a cui inviare il messaggio </b> <br />';
        }
        
        return $result;
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
            $n = Yii::app()->db->createCommand("SELECT CONCAT(nome, ' ', cognome) FROM  utenti WHERE cellulare='" . $data->destinatari . "'")->queryScalar();
        }
        
        return $n;
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

    public function getDataTurno($data, $d) {
        return Yii::app()->MyUtils->reverseData($data->data_visita);
    }

    public function getDelivery() {
        $txt = '';
        $stat = array();
        $delivery = Yii::app()->db->createCommand("SELECT status, number , DATE_FORMAT(data_delivery ,'%d-%m-%Y %H:%i') as data  FROM  send_sms_stats WHERE id_send='" . $this->refer . "'")->queryAll();
        
        $txt  = '<table id="table_delivery" class="table table-striped table-bordered dataTable">';
        $txt .= '<thead><tr><th>Destinatario</th><th class="centered">Consegnato</th><th>Data</th></tr></thead>';
        $txt .='<tbody id="">';
        if(count($delivery) > 0){
            for ($x = 0; $x < count($delivery); $x++) {

                if ($delivery[$x]['status'] == 'D')
                    $stat[$x] = "<i class='fa alert-success fa-check'></i>";
                else
                    $stat[$x] = "<i class='fa fa-minus-circle alert-danger'></i>";

                $txt .= "<tr>";
                $txt .= "<td>" . $delivery[$x]['number'] . "</td>";
                $txt .= "<td class='centered'>" . $stat[$x] . "</td>";
                $txt .= "<td>" . $delivery[$x]['data'] . "</td>";
                $txt .= "</tr>";
            }
        
        }else
            $txt .= "<tr><td colspan='3' >Non sono presenti notifiche di riccezione per questo invio</td></tr>";
        
        $txt .='</tbody></table>';
        $dati['count']  = count($delivery);
        $dati['txt']    = $txt;
        
        return $dati;
    }

}

