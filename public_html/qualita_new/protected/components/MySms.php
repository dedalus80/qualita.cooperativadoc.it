<?

class MySms extends CApplicationComponent {
		
		var $smsWebService  = "https://legacy.messageglobe.com/send_sms/register.php" ;
    	var $smsSender 		= "";
    	var $smsRoute 		= "GW2";
    	var $smsNumber 		= "";
    	var $smsPassword 	= ""; 
    	var $smsUser 		= "";
    	var $smsText 		= "";
		var $smsDest        = "";
		var $smsDelivery    = "";
		var $smsTipo        = "";
		var $smsRefer       = "";
		var $smsResult      = "";
		var $smsReturnUrl   = "https://qualita.cooperativadoc.it/qualita_new/delivery.php";
		var $delivery       = array("status"=>"","stato"=>"","number"=>"","reason"=>"","idrefer"=>"","date"=>"");
    
		function setAttributes(){ 
			$this->smsSender = Yii::app()->db->createCommand("SELECT txt FROM _config WHERE val_key='SMS-SENDER'")->queryScalar();
			$this->smsPassword = Yii::app()->db->createCommand("SELECT txt FROM _config WHERE val_key='TOTALC-PSW'")->queryScalar();
			$this->smsUser = Yii::app()->db->createCommand("SELECT txt FROM _config WHERE val_key='TOTALC-USER'")->queryScalar();
		}	
			
		function send(){
			
			$buffer = array(
        		"username"    => $this->smsUser,
        		"password"    => $this->smsPassword,
        		"route"       => $this->smsRoute,
                "from"        => $this->smsSender,
                "to"          => $this->smsDest,  
                "message"     => $this->smsText,  
        		"idrefer"     => $this->smsRefer,
        		"delivery"    => $this->smsDelivery,
        		"returnURL"   => $this->smsReturnUrl
			);
            
			$options = array(
        		CURLOPT_RETURNTRANSFER => true, // return web page 
        		CURLOPT_HEADER => false, // don't return headers 
        		CURLOPT_POSTFIELDS => $buffer, // this are my post vars 
    		);
            
    		$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL, $this->smsWebService);
    		curl_setopt_array($ch, $options);
			$this->smsResult = curl_exec($ch);
    		curl_close($ch);
			$this->saveSms();
		}	
		
		function saveSms(){
			$data = json_decode($this->smsResult);
			$query = " INSERT INTO send_sms (tipo_sms , tipo,destinatari,sender,testo,quanti,data_invio, risposta, refer) VALUES ";
    		$query .= " ('" . $this->smsTipo . "', 'S','" . $this->smsDest . "','" . $this->smsSender . "','" . addslashes($this->smsText) . "','1' ,NOW() ,'" . trim($this->smsResult) . "','".$this->smsRefer."' )";
    		Yii::app()->db->createCommand($query)->execute();
		}
		
        public function sendSmsFormazione($formazione){
            
            $this->setAttributes();
            $this->smsTipo = '23' ;#Reminder formazione
            
            $query = "SELECT c.nome , DATE_FORMAT(f.data , '%d-%m-%Y') as data_corso , f.* FROM db_formazione  AS f LEFT JOIN doc_formazione_formazioni AS c ON f.id_categoria = c.id WHERE f.id ='".$formazione."' ";

            $dati = Yii::app()->db->createCommand($query)->queryRow();

            $tmp = Yii::app()->db->createCommand("SELECT id_gruppo FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$formazione."' ")->queryAll();

            if(count($tmp)){
                for($x=0 ; $x < count($tmp); $x++)
                    $gruppi[] = $tmp[$x]['id_gruppo'];

                if(count($gruppi) > 0){
                    $query = "SELECT DISTINCT(g.id_utente) , u.nome , u.cognome , u.email , u.cellulare  FROM doc_formazione_utenti_gruppi as g LEFT JOIN utenti AS u  ON g.id_utente = u.id WHERE id_gruppo IN  (".implode(",",$gruppi).")  AND u.cellulare !='' ";
                    $users =  Yii::app()->db->createCommand($query)->queryAll();

                    if(count($users)){
                        for($x=0; $x <count($users); $x++){
                            
                            $txt = "Ciao ".$users[$x]['nome']." ti ricordiamo la tua presenza per il ".$dati['data_corso']." alle ore ".$dati['ora']." al corso di formazione ".$dati['nome'].": ".$dati['titolo'];
                            $this->smsRefer = $users[$x]['id_utente'].time();
                            $this->smsDest = $users[$x]['cellulare'];
                            $this->smsText = $txt;
                            $this->send();

                        }

                    }

                }
            }
        }
    
        public function saveDelivery(){
            $this->delivery['status'] == "1" ? $this->delivery['stato'] = "D": $this->delivery['stato'] = "F";  
            $query = "INSERT INTO send_sms_stats (id_send, number, status, reason , data_delivery ) VALUE ('".$this->delivery['idrefer']."','".$this->delivery['number']."','".$this->delivery['stato']."','".$this->delivery['reason']."','".$this->delivery['date']."')";
            Yii::app()->db->createCommand($query)->execute();
        }
    
    
}

?>
