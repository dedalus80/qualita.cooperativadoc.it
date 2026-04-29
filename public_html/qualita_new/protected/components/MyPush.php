<?

class MyPush extends CApplicationComponent {

    var $signalText = "";
    var $signalTitle = "Qualita Cooperativadoc";
    var $signalApId = "9e208e47-0f90-4222-8f94-7f3aa7596f4d";
    var $signalApKey = "NzA0NTlmZjEtODA2My00ODdmLWJlOTgtNjRlNjE2YWM4OGE1";
    var $signalTags = array();
    var $typeUser = "";
    var $userDetail = array();
    var $pushDetail = array();
    var $pushResult = array();
    var $statoPush = "";
    var $tipoPush = "";
    var $tipologiaPush = "";
    var $idPush = "";
    var $sezionePush = "";
    var $table = "";

    public function getLabel() {

        $txt = "";
        $this->sezionePush = 'azione';
        switch ($this->tipoPush) {
            case"nc":
                $txt = " Azione Non Conforme ";
                $this->tipologiaPush = 1;
                break;
            case"ac":
                $txt = " Azione Correttiva ";
                $this->tipologiaPush = 2;
                break;
            case"re":
                $txt = " Reclamo ";
                $this->tipologiaPush = 3;

                break;
            case"are":
                $txt = " Azione reclamo ";
                $this->tipologiaPush = 4;
                break;
            case"ve":
				switch ($this->pushDetail['tipo_verifica']) {
                    case"1":
                        $txt = " Verifica ispettiva: Pulizia e Manutenzione ";
                        $this->tipologiaPush = 5;
                        break;
                    case"2":
                        $txt = " Verifica ispettiva: Amministrazione o";
                        $this->tipologiaPush = 6;
                        break;
                    case"3":
                        $txt = " Verifica ispettiva: Gestione sicurezza ";
                        $this->tipologiaPush = 7;
                        break;
                    case"4":
                        $txt = " Verifica ispettiva: Ristorazione e Stoccaggio ";
                        $this->tipologiaPush = 8;
                        break;
					case"6":
                        $txt = " Verifica ispettiva: Esterna ";
                        $this->tipologiaPush = 20;
						$this->sezionePush = 'esterne';
                        break;	
					case"5":
                        $txt = " Verifica ispettiva: Piano educativo";
                        $this->tipologiaPush = 21;
                        break;	
					case"7":
                        $txt = " Verifica ispettiva: Ambiente";
                        $this->tipologiaPush = 22;
                        break;	
                }
				break;
            case"veb":
                $txt = " Verifica ispettiva: Ambiente";
                $this->tipologiaPush = 22;
                break; 
			case"vea":
                $txt = " Verifica ispettiva: Amministrazione";
                $this->tipologiaPush = 6;
                break;
            case"vp":
                $txt = " verifica ispettiva: Pulizia e Manutenzione ";
                $this->tipologiaPush = 5;
                break;
            case"vs":
                $txt = " verifica ispettiva: Gestione sicurezza ";
                $this->tipologiaPush = 7;
                break;
            case"vr":
                $txt = " verifica ispettiva: Ristorazione e Stoccaggio ";
                $this->tipologiaPush = 8;
                break;
			case"ved":
                $txt = " verifica ispettiva: Piano educativo ";
                $this->tipologiaPush = 21;
				break;
			case"vee":
                $txt = " verifica ispettiva: Esterna ";
                $this->tipologiaPush = 20;
				break;
			case"up":
                $txt = " Presenze struttura  ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 9;
                break;
            case"ucl":
                $txt = " Consumi Energetici ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 10;
                break;
            case"ucg":
                $txt = " Consumi gas  ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 11;
                break;
            case"uca":
                $txt = " Consumi acqua  ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 12;
                break;
            case"ucc":
                $txt = " Consumi sostanze chimiche  ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 12;
                break;
            case"ucr":
                $txt = " Consumi rifiuti  ";
                $this->sezionePush = 'utenze';
                $this->tipologiaPush = 12;
                break;
                
            case"mac":
                $txt = " Matricola contatore  ";
                $this->sezionePush = 'contatore';
                $this->tipologiaPush = 13;
                break;
            case"lec":
                $txt = " Lettura contatore  ";
                $this->sezionePush = 'contatore';
                $this->tipologiaPush = 14;
                break;
            case"ut":
                $txt = " Utente Centri Estivi  ";
                $this->sezionePush = 'utente';
                $this->tipologiaPush = 15;
                break;
            case"uts":
                $txt = " Scheda Sanitaria ";
                $this->sezionePush = 'utente';
                $this->tipologiaPush = 16;
                break;
            case"utr":
                $txt = " Rientro Anticipato  ";
                $this->sezionePush = 'utente';
                $this->tipologiaPush = 17;
                break;
            case"uth":
                $txt = " Handicap utente  ";
                $this->sezionePush = 'utente';
                $this->tipologiaPush = 18;
                break;
             case"for":
                $txt = " Corso formazione  ";
                $this->sezionePush = 'formazione';
                $this->tipologiaPush = 23;
                break;    
        }

        return $txt;
    }

    public function getCodice() {

        $codice = $this->pushDetail["codice"];
        switch ($this->tipoPush) {
            case"ac":
                $codice = Yii::app()->db->createCommand("SELECT codice FROM db_nonconforme WHERE id ='" . $this->pushDetail["codice_riferimento"] . "' ")->queryScalar();
                break;
            case"are":
                $codice = Yii::app()->db->createCommand("SELECT codice FROM db_reclami WHERE id ='" . $this->pushDetail["id_reclamo"] . "' ")->queryScalar();
                break;
            case"vea":
            case"veb":
                $codice = $this->pushDetail["codice_verifica"];
                break;
        }
        return $codice;
    }

    public function createText() {

        in_array($this->tipoPush, array("re", "utr", "ut","for")) ? $gender = 'un' : $gender = 'una';
        in_array($this->tipoPush, array("re", "utr", "ut","for")) ? $genderNew = 'nuovo' : $genderNew = 'nuova';

        switch ($this->statoPush) {
            case "create":
                $action = "Inserimento " . $genderNew;
                break;
            case "update":
                $action = "Aggiornamento";
                break;
            case "delete":
                $action = "Rimozione";
                break;
        }

        $txt = $action . " " . $this->getLabel() . "\n";

        if ($this->sezionePush == 'azione')
            $txt .= "Codice: " . $this->getCodice() . "\n";
        if ($this->sezionePush == 'utente')
            $txt .= "Utente: " . $this->pushDetail['nome'] . " " . $this->pushDetail['cognome'] . "\n";
        
        if($this->sezionePush == 'formazione'){
            $txt .= "Titolo: " . $this->pushDetail['titolo']. "\n";
            $txt .= "Corso: " . $this->pushDetail['corso']. "\n";
                
        }else
            $txt .="Struttura: " . $this->pushDetail['struttura'] . "\n";
        
        if ($this->sezionePush == 'utenze')
            $txt .= "Anno: " . $this->pushDetail['anno'] . "\n";
        if ($this->sezionePush == 'contatore') {
            $txt .= "Contatore: " . $this->pushDetail['nome_contatore'] . "\n";
            $txt .= "N Matricola: " . $this->pushDetail['matricola'] . "\n";
        }
		
		if($this->sezionePush =='esterne')
			$txt .="Dettaglio: " . $this->pushDetail['dettaglio'] . "    \n";

        return $txt;
    }

    public function setDetail() {

        switch ($this->tipoPush) {
            case "ve":
                 $query = "SELECT d.* , t.nome as struttura , dettaglio , tipo_verifica  FROM " . $this->table . " AS d LEFT JOIN doc_unita AS t ON d.unita_operativa = t.id  WHERE d.id ='" . $this->idPush . "' ";
                break;
            case "ucl":
            case "ucg":
            case "uca":
            case "ucc":
            case "ucr":
            case"up":
                $query = "SELECT d.* , t.nome as struttura FROM " . $this->table . " AS d LEFT JOIN doc_unita AS t ON d.struttura = t.id  WHERE d.id ='" . $this->idPush . "' ";
                break;
			case "uts":
            case "utr":
                $query = "SELECT d.* , t.nome as struttura FROM utenti AS d LEFT JOIN doc_unita AS t ON d.unita_operativa = t.id  WHERE d.id ='" . $this->idPush . "' ";
                break;
                case "for":
                $query = "SELECT f.* , c.nome as corso FROM ".$this->table." AS f LEFT JOIN doc_formazione_formazioni AS c ON f.id_categoria = c.id  WHERE f.id ='" . $this->idPush . "' ";
                break;
            default:
                $query = "SELECT d.* , t.nome as struttura FROM " . $this->table . " AS d LEFT JOIN doc_unita AS t ON d.unita_operativa = t.id  WHERE d.id ='" . $this->idPush . "' ";
                break;
        }
        $this->pushDetail = Yii::app()->db->createCommand($query)->queryRow();
    }

    public function setTags() {
        $tags = array();

        $tmp = "push_qualita";
        if ($this->sezionePush == 'utente')
            $tmp = "push_centriestivi";

        $users = Yii::app()->db->createCommand("SELECT * FROM utenti WHERE " . $tmp . "='Y'")->queryAll();

        for ($x = 0; $x < count($users); $x++) {
            switch ($users[$x]['user_type']) {
                case"1":
                case"5":
                    $send[] = $users[$x]['id'];
                    break;
                case"3":
                    $centro = Yii::app()->db->createCommand("SELECT centro FROM doc_unita WHERE  id IN (" .$users[$x]['user_unita'] . ")")->queryScalar();
                    $centro_struttura = Yii::app()->db->createCommand("SELECT centro FROM doc_unita WHERE  id ='" . $this->pushDetail['unita_operativa'] . "' ")->queryScalar();
                    $centro == $centro_struttura ? $send[] = $users[$x]['id'] : "";
                    break;
                case"6":
                case"7":
                    $this->pushDetail['unita_operativa'] == $users[$x]['user_unita'] ? $send[] = $users[$x]['id'] : "";
                    break;
            }
        }

        for ($x = 0; $x < count($send); $x++) {
            $tags[] = array('key' => 'user', 'relation' => '=', 'value' => $send[$x]);
            if ($x + 1 < count($send))
                $tags[] = array('operator' => 'OR');
        }

        return $tags;
    }

    public function newNotificationUtenze($table, $tipo, $stato, $id) {
        $this->statoPush = $stato;
        $this->tipoPush = $tipo;
        $this->table = $table;
        $this->idPush = $id;
    }

    public function newNotificaton($table, $tipo, $stato, $id) {
        $this->statoPush = $stato;
        $this->tipoPush = $tipo;
        $this->table = $table;
        $this->idPush = $id;

        $this->setDetail();

        $this->signalText = $this->createText();
        $this->signalTags = $this->setTags();
        $this->sendNotification();
    }

    public function sendNotification() {

        $content = array(
            "en" => $this->signalText,
            "it" => $this->signalText,
        );

        $heading = array(
            "en" => $this->signalTitle,
            "it" => $this->signalTitle,
        );


        $fields = array(
            'app_id' => $this->signalApId,
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'tags' => $this->signalTags,
            'contents' => $content,
            'headings' => $heading,
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

        $this->pushResult = json_decode($response, true);
        $this->addDbPush();
    }

    public function addDbPush() {

        switch ($this->statoPush) {
            case"create":
                $tmp = 1;
                break;
            case"update":
                $tmp = 2;
                break;
            case"delete":
                $tmp = 3;
                break;
        }

        $query = "INSERT INTO send_push (tipo, destinatari, id_destinatari, sender, testo, quanti, effettuati, data_invio,unita_operativa,sezione,stato)";
        $query .= " VALUES ('P', '" . addslashes(json_encode($this->signalTags)) . "'," . Yii::app()->user->getId() . ", 'Qualita Cooperativadoc', '" . addslashes($this->signalText) . "', '" . $this->pushResult['recipients'] . "', '" . $this->pushResult['recipients'] . "', NOW(),'" . addslashes($this->pushDetail['unita_operativa']) . "','" . $this->tipologiaPush . "','" . $tmp . "' );";
        Yii::app()->db->createCommand($query)->execute();
    }

}

?>