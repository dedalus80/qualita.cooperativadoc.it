<?php

class MyEmails extends CApplicationComponent {

    // TEMP FASE DI TEST 
    var $smtpHost = "smtp.office365.com";
    var $smtpUser = "noreply@cooperativadoc.it"; //"recuperopassword@cooperativadoc.it";
    var $smtpPassword = "Q^682722741895on"; //"EFlqa693";
    var $smtpPort = "587";
    var $smtpFrom = "noreply@cooperativadoc.it"; //"recuperopassword@cooperativadoc.it";
    var $smtpFromName = 'Qualità Cooperativadoc';
    var $smtpDest = array('qualita@cooperativadoc.it' => 'Qualita Cooperativadoc');
    var $smtpObject = "";
    var $smtpText = "";
    var $smtpTipo = "";
	var $smtpId   = "";
	var $smtpDati = array();
	var $smtpAllegati = array();
	
	public function sendTest(){
		$mail = new YiiMailer();
        $mail->setSmtp($this->smtpHost, $this->smtpPort, '', true, $this->smtpUser, $this->smtpPassword);
        $mail->setFrom($this->smtpFrom, $this->smtpFromName);
        $mail->setTo($this->smtpDest);
        $mail->setSubject("TEST");
        $mail->setBody( "Invio test  ");
		$mail->send();
	}
		
    function send() {
        
        /* I TEST INVIO RISETTA ARRAY */
        # $this->smtpDest = array("djamal@archynet.it" =>"Adoum djamal");
        
        
        switch ($this->smtpTipo) {
            case"verifica":
                $this->smtpObject = "Assegnazione Verifica Ispettiva";
                break;
            case"trattamento":
                $this->smtpObject = "Trattamento Azione non Conforme rifiutato";
                break;
            case"nc_create":
                $this->smtpObject = "Inserimento nuova Azione Non Conforme";
                break;
            case"nc_update":
                $this->smtpObject = "Aggiornamento Azione Non Conforme";
                break;
            case"ac_create":
                $this->smtpObject = "Inserimento nuova Azione Correttiva";
                break;
            case"ac_update":
                $this->smtpObject = "Aggiornamento Azione Correttiva";
                break;
            case"re_update":
                $this->smtpObject = "Aggiornamento Reclamo";
                break;
            case"re_create":
                $this->smtpObject = "Inserimento nuovo Reclamo";
                break;
            case"are_update":
                $this->smtpObject = "Aggiornamento Azione Reclamo";
                break;
            case"are_create":
                $this->smtpObject = "Imserimento nuova Azione Reclamo";
                break;
			 case"reminder":
                $this->smtpObject = "Aggiunta Verbale Verifica";
                break;
            case"formazione":
                $this->smtpObject = "Corso di formazione";
                break;	
        }

        $template = Yii::app()->db->createCommand("SELECT valore FROM config WHERE chiave ='TEMPLATE_EMAIL' ")->queryScalar();
        $template = str_replace("[TITOLO]", $this->smtpObject, $template);
        $template = str_replace("[MESSAGGIO]", $this->smtpText, $template);
        
        // Fase di test mando solo a me 
        /*
        if($this->smtpDest){
            foreach($this->smtpDest AS $id => $val ){
                $this->smtpObject .= $id." ===== >>>> ".$val;
            }
        }
        $this->smtpDest["djamal@archynet.it"] = " Adoum Djamal";
        $this->smtpDest["andrea@totalconnect.it"] = "Andrea";
        */
        
        
        $mail = new YiiMailer();
        $mail->setSmtp($this->smtpHost, $this->smtpPort, 'tls', true, $this->smtpUser, $this->smtpPassword);
        $mail->setFrom($this->smtpFrom, $this->smtpFromName);
        $mail->setTo($this->smtpDest);
        $mail->setSubject($this->smtpObject);
        $mail->setBody($template);

        if (count($this->smtpAllegati) > 0) {
            foreach ($this->smtpAllegati AS $allegato)
                $mail->setAttachment(Yii::app()->basePath . '/../' . $allegato);
        }
       
        $mail->send();
        return true;
    }

    function sendEmailAc($tipo, $id) {

        $query = "SELECT ac.* , u.nome as nome_ins , u.cognome  as cognome_ins , u.email as email_dest , ac.unita_operativa as struttura ,
            s.nome as societa_nome , un.nome as unita_nome , ta.nome as tipologia_nome ,  dbnc.id as riferimento ,
            DATE_FORMAT(ac.data_az ,'%d-%m-%Y') AS data_az , DATE_FORMAT(ac.data ,'%d-%m-%Y') AS data_ins , DATE_FORMAT(ac.descrizione ,'%d-%m-%Y') AS data_desc  FROM db_azionicorrettive AS ac
            LEFT JOIN doc_societa AS s ON ac.societa = s.id
            LEFT JOIN doc_unita AS un ON ac.unita_operativa = un.id
            LEFT JOIN doc_tipologie_aperture AS ta ON ac.tipologia = ta.id
            LEFT JOIN db_nonconforme AS dbnc ON ac.codice_riferimento = dbnc.id
            LEFT JOIN utenti as u ON ac.id_utente = u.id  WHERE ac.id ='" . $id . "'";


        $dati = Yii::app()->db->createCommand($query)->queryRow();

        $txt  ="<div style='margin-top: 20px'>";
        $txt .= "<p>Codice riferimento: <b>" . $dati['riferimento'] . " </b></p>";
        $txt .= "<p>Data inserimento: <b>" . $dati['data'] . " </b></p> ";
        $txt .= "<p>Data Azione: <b>" . $dati['data_az'] . " </b></p> ";
        $txt .= "<p>Inserito da: <b>" . $dati['nome_ins'] . " " . $dati['cognome_ins'] . "</b></p> ";
        $txt .= "<p>Nome e cognome: <b>" . $dati['nome'] . " " . $dati['cognome'] . "</b></p> ";
        $txt .= "<p>Tipo di azione: <b>" . $dati['tipo'] . " </b></p> ";
        $txt .= "<p>Societa: <b>" . $dati['societa_nome'] . " </b></p> ";
        $txt .= "<p>Unita Operativa: <b>" . $dati['unita_nome'] . " </b></p> ";
        $txt .= "<p>Tipologia: <b>" . $dati['tipologia_nome'] . " </b></p> ";
        $txt .= "<p>Entro il: <b>" . $dati['data_desc'] . " </b></p> ";
        $txt .= "<p>Trattamento: <b>" . $dati['trattamento'] . " </b></p> ";
        $txt .= "<p>Efficacia verifica: <b>" . $dati['verifica_efficacia'] . " </b></p> ";

        if ($dati['allegato']) {
            $txt .= "Allegato: <b>" . $dati['allegato'] . "</b> </p>";
            $this->smtpAllegati[] = "images/allegati/" . $dati['allegato'];
        }

        $txt .="</div>";
        $this->setExtraDest($dati['struttura']);
        $this->smtpTipo = $tipo;
        $this->smtpText = $txt;
        $this->send();
    }

    function sendEmailNc($tipo, $id, $dest = NULL) {

        $query = "SELECT nc.* , u.nome as nome_ins , u.cognome  as cognome_ins , u.email as email_dest , f.nome As funzione_nome , r.nome as responsabile_nome ,
            s.nome as societa_nome , un.nome as unita_nome , ta.nome as tipologia_nome , ch.nome as chiusura_nome , nc.unita_operativa as struttura ,
            DATE_FORMAT(nc.data_nc ,'%d-%m-%Y') AS data_nc , DATE_FORMAT(nc.data ,'%d-%m-%Y') AS data_ins  FROM db_nonconforme AS nc
            LEFT JOIN doc_funzione AS f ON nc.funzione = f.id
            LEFT JOIN doc_responsabile AS r ON nc.responsabile = r.id
            LEFT JOIN doc_societa AS s ON nc.societa = s.id
            LEFT JOIN doc_unita AS un ON nc.unita_operativa = un.id
            LEFT JOIN doc_tipologie_aperture AS ta ON nc.tipologia = ta.id
            LEFT JOIN doc_chiusura AS ch ON nc.chiusura = ch.id
            
            LEFT JOIN utenti as u ON nc.id_utente = u.id  WHERE nc.id ='" . $id . "'";

        $dati = Yii::app()->db->createCommand($query)->queryRow();

        if ($tipo == 'trattamento') {
            $txt = "<div style='background:#F8F8F8;padding: 10px'>";
            $txt .= "<p>La proposta di trattamento per la seguente azione non conforme inserita non &egrave; stata accettata</p>";
            $txt .= "<p>Si prega di aggiornare l'azione non conforme proponendo un altra proposta di trattamento</p>";
            $txt .= "<p><span style='color:#'>" . $dati['trattamento_note'] . "</span></p>";
            $txt .= "</div>";
        }

        $txt .="<div style='margin-top: 20px'>";
        $txt .= "<p>Codice: <b>" . $dati['codice'] . "</b> </p> ";
        $txt .= "<p>Data inserimento: <b>" . $dati['data_ins'] . "</b> </p>";
        $txt .= "<p>Data non conformit&agrave;: <b>" . $dati['data_nc'] . "</b> </p>";
        $txt .= "<p>Inserito da: <b>" . $dati['nome_ins'] . " " . $dati['cognome_ins'] . "</b> </p>";
        $txt .= "<p>Nome: <b>" . $dati['nome'] . "</b></p> ";
        $txt .= "<p>Cognome: <b>" . $dati['cognome'] . "</b> </p> ";
        $txt .= "<p>Funzione: <b>" . $dati['funzione_nome'] . " </b></p>";
        $txt .= "<p>Responsabile: <b>" . $dati['responsabile_nome'] . "</b> </p>";
        $txt .= "<p>Societa: <b>" . $dati['societa_nome'] . "</b> </p>";
        $txt .= "<p>Unita Operativa: <b>" . $dati['unita_nome'] . "</b> </p>";
        $txt .= "<p>Tipologia: <b>" . $dati['tipologia_nome'] . "</b> </p>";
        $txt .= "<p>Descrizione: <b>" . $dati['descrizione'] . "</b> </p>";
        if ($tipo == 'trattamento') {
            $txt .= "<p>Trattamento  RIFIUTATO: <b>" . $dati['trattamento'] . "</b> </p>";
            $this->smtpDest[$dati['email_dest']] = $dati['nome_ins'] . " " . $dati['cognome_ins'];
        } else {

            $txt .= "<p>Chiusura: <b>" . $dati['chiusura_nome'] . "</b> </p>";
            if ($dati['allegato']) {
                $txt .= "Allegato: <b>" . $dati['allegato'] . "</b> </p>";
                $this->smtpAllegati[] = "images/allegati/" . $dati['allegato'];
            }
            
        }
		
		$this->setExtraDest($dati['struttura']);
        
		$txt .="</div>";
        $this->smtpTipo = $tipo;
        $this->smtpText = $txt;
        $this->send();
    }
	
	public function sendEmailResponsabili() {
		
        // Svuoto i destinatari e gli allegati
        $this->smtpDest = array();
        $this->smtpAllegati = array();
        
        // Verifico resposnsabili struttura 
        $this->setExtraDest($this->smtpDati['unita_op']);
        
        
        
        $tmp = $this->smtpDest;
        // Svuoto i destinatari
        
        $this->smtpDest = array();
        
        // Allegato solo la check list  
        $this->checkAllegatoVerifica($this->smtpDati['code']);
        
        // ciclo i responsabili e mando mail personalizzata
        if(count($tmp)){
            
            foreach($tmp AS $email => $nome){
                $txt  = "<p>Buon giorno <b>".$nome."</b> <br /><br />";
                $txt .= "Ti informiamo che abbiamo assegnato a <b>".$this->smtpDati['nome_verifica']." ".$this->smtpDati['cognome_verifica']."</b> la verifica ispettiva  <b>\"".$this->smtpDati['tipo_verifica']."\"</b>  dall'Ufficio qualit&agrave;<br /><br />";
                $txt .= "Ti ricordiamo che verrai nei prossimi giorni contattato da <b>".$this->smtpDati['nome_verifica']."</b> per definire nel dettaglio il Piano della Verifica ispettiva. E che per la data della Verifica &egrave; necessario compilare il file check list in allegato come AUTOVALUTAZIONE.<br /></p>";
                $txt .= "<p>Codice Verifica: <b>" .$this->smtpDati['codice_verifica'] . "</b> </p>";
                $txt .= "<p>Tipo Verifica: <b>" . $this->smtpDati['tipo_verifica'] . "</b> </p>";
                $txt .= "<p>Data Verifica: <b>" . $this->smtpDati['data_verifica'] . "</b> <br /></p>";
                $txt .= "<p>Unit&agrave; operativa: <b>" . $this->smtpDati['unita_verifica'] . "</b> <br /></p>";
                $txt .="<p>Buon Lavoro<br />Qualit&agrave; Cooperativadoc </p> ";
                
                $this->smtpDest = array($email => $nome);
                $this->smtpText = $txt;
		        $this->send();
            }
        }
    }
	
    public function sendEmailVerifica($tipo, $id, $dest = NULL) {

        $query = "SELECT v.incaricato as incaricato ,  v.compilatore ,  v.diario , v.verbale , v.dettaglio as descrizione , v.tipo_verifica as tipo , DATE_FORMAT(data_prevista,'%d-%m-%Y') as data_verifica , t.nome as tipo_verifica , t.codice as code , v.unita_operativa as unita_op , o.nome as unita_verifica ,
                    c.nome as nome_compilatore, c.cognome as cognome_compilatore, c.email as email_compilatore, u.nome as nome_verifica , u.cognome as cognome_verifica , u.email as email_verifica ,v.codice as codice_verifica , u.user_type , u.id as utente
                    FROM db_verifiche AS v 
                    LEFT JOIN utenti AS u ON v.incaricato  = u.id 
                    LEFT JOIN utenti AS c ON v.compilatore = c.id 
                    LEFT JOIN doc_tipologie_verifiche AS t ON v.tipo_verifica = t.id
                    LEFT JOIN doc_unita AS o ON v.unita_operativa = o.id WHERE v.id='" . $id . "'    ";

        $dati = Yii::app()->db->createCommand($query)->queryRow();
		
		$txt ='';
		
		if($tipo =='reminder')
			$txt .= "<p><b>Ciao ti ricordiamo di caricare sul piano delle verifiche <u>il verbale</u> per seguente verifica ispettiva</b></p>";
		else{
            // TESTO PER MARIO / AUDITOR 
            $txt .="<p>Buon giorno <b>".$dati['nome_verifica']." ".$dati['cognome_verifica']."</b> <br /><br />";
            $txt .="Ti &egrave; stata assegnata una verifica  ispettiva <b> \"". $dati['tipo_verifica'] . "\"</b>  dall'Ufficio qualit&agrave;.<br />";
            $txt .="Ti ricordiamo di inviare al Responsabile del Soggiorno: <br /><ul>";
            $txt .="<li> il file check list in allegato invitandolo a precompilarlo come autovalutazione. </li>";
            $txt .="<li> concordare con lui la data effettiva della VII ed inviare al Responsabile il piano della verifica ispettiva compilato attraverso la web app.</li></ul></p>";
            $txt .="<p>Ti ricordo inoltre che al termine della verifica dovrai:"; 
            $txt .="<ol type='1'>";
            $txt .="<li>Compilare il verbale di verifica ispettiva dalla web app.</li>";
            $txt .="<li>Compilare il diario di verifica dalla web app.</li>";
            //$txt .="<li>Caricare Diario e Verbale in piattaforma</li>";
            //$txt .="<li>Inviare a qualita@cooperativadoc.it tutta la documentazione sopra citata</li>";
            $txt .="</ol></p>";

            $txt .= "<p>Ti informo che è possibile accedere alla web app attraverso l'apposito link: <a href=\"https://cooperativadoc.jotform.com/app/261461825197968\" target=\"_blank\">Web App</a></p>";
            $txt .= "<p>o inquadra il seguente QR code per accedere con il tuo cellulare</p>";
            $txt .= "<p style=\"text-align:center\"><img src=\"https://qualita.cooperativadoc.it/qualita_new/images/modulistica/qr-code-261461825197968.png\" style=\"width:200px\" /></p>";

            $txt .="<p>Codice Verifica: <b>" . $dati['codice_verifica'] . "</b> </p>";
            $txt .="<p>Tipo Verifica: <b>" . $dati['tipo_verifica'] . "</b> </p>";
            $txt .="<p>Data Verifica: <b>" . $dati['data_verifica'] . "</b> <br /></p>";
            $txt .="<p>Unit&agrave; operativa: <b>" . $dati['unita_verifica'] . "</b> <br /></p>";
            $txt .="<p>Buon Lavoro<br />Qualit&agrave; Cooperativadoc </p> ";
        }
        
        // Inserisco l'incaricato / auditor esterno 
        $this->smtpDest[$dati['email_verifica']] = $dati['nome_verifica']." ".$dati['cognome_verifica'];
        
        // Inserisco il compilatore se diverso dall'audito e diverso da ferretti
        //$dati['email_compilatore'] != $dati['email_verifica'] && $dati['email_compilatore'] != "qualita@cooperativadoc.it" ? $this->smtpDest[$dati['email_compilatore']] = $dati['nome_compilatore']." ".$dati[$x]['cognome_compilatore']:"";
        
        
		if($dati['tipo'] =='6')
			$txt .= "<p>Descrizione: <b>" . $dati['descrizione'] . "</b> <br /></p>";
		
        /*
		if ($dati['diario']) {
            $txt .= "Diario: <b>" . $dati['diario'] . "</b> </p>";
            $this->smtpAllegati[] = "images/diari_verifiche/" . $dati['diario'];
        }
		
		if ($dati['verbale']) {
            $txt .= "Verbale: <b>" . $dati['verbale'] . "</b> </p>";
            $this->smtpAllegati[] = "images/verbali_verifiche/" . $dati['verbale'];
        }
        */
        
        
        $this->checkAllegatoVerifica($dati['code']);
		
		$this->smtpTipo = $tipo; 
        $this->smtpText = $txt;
		
		
		if($tipo =='reminder'){
			
			if( $dati['compilatore'] != $dati['incaricato'] ){
				$compilatore = Yii::app()->db->createCommand("SELECT * FROM utenti  WHERE id ='".$dati['compilatore']."'")->queryRow();
				if($compilatore['user_type'] =='7')
					$this->smtpDest[$compilatore['email']] = $compilatore['nome'] . " " . $compilatore['cognome'];
			}else{
				if($dati["user_type"] == '7')
					$this->smtpDest[$dati['email_verifica']] = $dati['nome_verifica'] . " " . $dati['cognome_verifica'];
        	}
			$this->send();
			
		}else{
			
			// Aggiunta modulistica, non bisogna più allegare documenti
			/*$this->smtpAllegati[] = "images/modulistica/MD_07_02_Verbale_verifiche_ispettive_interne.dot";
			$this->smtpAllegati[] = "images/modulistica/MOD_07_04_DIario_VII.dot";
			$this->smtpAllegati[] = "images/modulistica/MD_07-01_Pianificazione_Piano_di_Audit_rev_001.xlt";
            $this->smtpAllegati[] = "images/modulistica/EL_RIL_VII_REV_00.xlsx";
            $this->smtpAllegati[] = "images/modulistica/qr-code-261461825197968.png";*/
			
            if($this->send()){
                
                 // Mando email responsabili struttura
			     $this->smtpDati = $dati;
			     $this->sendEmailResponsabili();
                
            }
        }
	}
    
    public function checkAllegatoVerifica($code){
        /*switch($code){
            case"VI-A":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-ambientale.pdf";
            break;
            case"VI-Q":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-amministrazione.pdf";
            break;
            case"VI-E":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-educative.pdf";
            break;
            case"VI-P":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-manutenzione.pdf";
            break;
            case"VI-R":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-ristorazione.pdf";
            break;
            case"VI-S":
                $this->smtpAllegati[] = "images/modulistica/modello-verifica-ispettiva-sicurezza.pdf";
            break;
        }*/
    
    }
        
    public function sendEmailRe($tipo, $id, $dest = NULL) {

        $al = array();

        $query = "SELECT re.* , DATE_FORMAT(re. data_inserimento,'%d-%m-%Y') as data_reclamo ,  u.nome as nome_unita ,  f.nome as nome_funzione , re.unita_operativa as struttura , s.nome as nome_societa ,ch.nome as nome_chiusura ,ca.nome as nome_canale , cat.nome as nome_tipologia FROM db_reclami AS re 
                    LEFT JOIN doc_funzione AS f ON re.funzione = f.id
                    LEFT JOIN doc_societa AS s ON re.societa = s.id
                    LEFT JOIN doc_chiusura AS ch ON re.chiusura = ch.id
                    LEFT JOIN doc_reclami_canali AS ca ON re.canale = ca.id
                    LEFT JOIN doc_reclami_tipologie AS cat ON re.tipologia = cat.id
                    LEFT JOIN doc_unita AS u ON re.unita_operativa = u.id WHERE re.id='" . $id . "'    ";

        $dati = Yii::app()->db->createCommand($query)->queryRow();

        $txt .="<div style='margin-top: 20px'>";
        $txt .= "<p>Codice riferimento: <b>" . $dati['codice'] . "</b></p> ";
        $txt .= "<p>Data: <b>" . $dati['data_reclamo'] . " </b></p> ";
        $txt .= "<p>Inserito da: <b>" . $dati['nome_compilatore'] . " " . $dati['cognome_compilatore'] . "</b></p>  ";
        $txt .= "<p>Nome: <b>" . $dati['nome'] . "</b></p>  ";
        $txt .= "<p>Cognome: <b>" . $dati['cognome'] . " </b></p>  ";
        $txt .= "<p>Canale: <b>" . $dati['canale'] == '4' ? $dati['nome_canale'] . " " . $dati['canale_altro'] : $dati['nome_canale'] . "</b></p>  ";
        $txt .= "<p>Tipologia: <b>" . $dati['tipologia'] == '3' ? $dati['nome_tipologia'] . " " . $dati['tipologia-altro'] : $dati['nome_tipologia'] . "</b></p>  ";
        $txt .= "<p>Unita Operativa: <b>" . $dati['nome_unita'] . " </b></p>  ";
        $txt .= "<p>Societa: <b>" . $dati['nome_societa'] . " </b></p> ";
        $txt .= "<p>Funzione: <b>" . $dati['nome_funzione'] . " </b></p>  ";
        $txt .= "<p>Descrizione: <b>" . $dati['descrizione'] . " </b></p>  ";
        $txt .= "<p>Apertura non conformita: <b>" . $dati['non_conformita'] == 'Y' ? "Si codice " . $dati['id_non_conformita-altro'] : "No " . $dati['motivo_non_conformita'] . " </b></p>  ";
        $txt .= "<p>Chiusura: <b>" . $dati['nome_chiusura'] . "</b></p>  ";

        if ($dati['allegato']) {
            $this->smtpAllegati[] = "images/allegati_reclami/" . $dati['allegato'];
            $txt .= "<p>Allegato: <b>" . $dati['allegato'] . "</b></p>  ";
        }

        $query = "SELECT az.* , DATE_FORMAT(az.entro_il,'%d-%m-%Y') as data_azione , f.nome as nome_funzione  FROM  db_reclami_azioni  as az 
            LEFT JOIN doc_funzione AS f ON az.funzione = f.id WHERE id_reclamo = '" . $id . "'";

        $azioni = Yii::app()->db->createCommand($query)->queryAll();

        if (count($azioni)) {
            $txt .= " <div style='margin-top: 20px ; margin-left: 20px'>";

            for ($x = 0; $x < count($azioni); $x++) {

                $k = $x + 1;
                $txt .= "<p><b> AZIONI RECLAMO: " . $k . " </b></p> ";
                $txt .= "<p>Da eseguire entro il:<b>" . $azioni[$x]['data_azione'] . " </b></p> ";
                $txt .= "<p>Funzione: <b>" . $azioni[$x]['nome_funzione'] . " </b></p> ";
                $txt .= "<p>Nome: <b>" . $azioni[$x]['nome'] . "</b></p>  ";
                $txt .= "<p>Cognome: <b>" . $azioni[$x]['cognome'] . " </b></p>  ";
                $txt .= "<p>Descrizione: <b>" . $azioni[$x]['descrizione'] . " </b></p>  ";
                if ($azioni[$x]['allegato']) {
                    $this->smtpAllegati[] = "images/allegati_azioni/" . $azioni[$x]['allegato'];
                    $txt .= "<p>Allegato: <b>" . $azioni[$x]['allegato'] . "</b></p>  ";
                }
            }
            $txt .="</div>";
        }
        $txt .="</div>";
        $this->setExtraDest($dati['struttura']);
        $this->smtpTipo = $tipo;
        $this->smtpText = $txt;
        $this->send();
    }

    public function sendEmailAre($tipo, $id, $dest = NULL) {

        $query = "SELECT re.* , DATE_FORMAT(re. entro_il,'%d-%m-%Y') as data_reclamo ,  u.nome as nome_unita ,  f.nome as nome_funzione  , re.unita_operativa as struttura
                    FROM db_reclami_azioni AS re 
                    LEFT JOIN doc_funzione AS f ON re.funzione = f.id
                    LEFT JOIN doc_unita AS u ON re.unita_operativa = u.id WHERE re.id='" . $id . "'    ";

        $dati = Yii::app()->db->createCommand($query)->queryRow();

        $txt .="<div style='margin-top: 20px'>";
        $txt = "<p>ID Reclamo: <b>" . $dati['id_reclamo'] . " </b></p> ";
        $txt .= "<p>Da eseguire entro il: <b>" . $dati['data_reclamo'] . " </b></p>";
        $txt .= "<p>Nome: <b>" . $dati['nome'] . " </b></p> ";
        $txt .= "<p>Cognome: <b>" . $dati['cognome'] . " </b></p>";
        $txt .= "<p>Unita: <b>" . $dati['nome_unita'] . " </b></p> ";
        $txt .= "<p>Funzione: <b>" . $dati['nome_funzione'] . " </b></p> ";
        $txt .= "<p>Descrizione: <b>" . $dati['descrizione'] . " </b></p> ";

        if ($dati['allegato']) {
            $txt .= "Allegato: <b>" . $dati['allegato'] . "</b> </p>";
            $this->smtpAllegati[] = "images/allegati_azioni/" . $dati['allegato'];
        }
		
        $txt .="</div>";
        $this->setExtraDest($dati['struttura']);
        $this->smtpTipo = $tipo;
        $this->smtpText = $txt;
        $this->send();
    }
		
	public function setExtraDest($struttura)
    {
        /**
         * nel campo user_unita possono essere presenti più id struttura separati da virgola
         * a seguito di una modifica richiesta dal cliente per permettere di associare più strutture ad un unico direttore
         * per identificare gli utenti direttori ai quali inviare l'email saranno ciclati tutti facendo un explode del valore di user_unita
         * e verificando con la funzione in_array se l'id struttura è presente
         * la logica non è ottimale ma al momento non è possibile creare una tabella di appoggio che associ utente e strutura in rapporto di uno a molti
         */
		/*$query = "SELECT nome , cognome, email FROM utenti  WHERE user_type ='3'  AND user_unita ='".$struttura."' ";
		$dati = Yii::app()->db->createCommand($query)->queryAll();
		
		for($x=0; $x < count($dati); $x++){
			if($dati[$x]['email'])
				$this->smtpDest[$dati[$x]['email']] = $dati[$x]['nome']." ".$dati[$x]['cognome'];
		}*/
        
        $users = Utenti::model()->findAllByAttributes(['user_type' => '3']);
        
        foreach($users as $user) {
            $struttureIds = explode(',', $user->user_unita);

            if(in_array($struttura, $struttureIds) && !empty($user->email)) {
                $this->smtpDest[$user->email] = $user->nome." ".$user->cognome;
            }
        }
        
	}
    
    public function sendEmailFormazione($formazione){
        
        $query = "SELECT c.nome ,f.ora ,  DATE_FORMAT(f.data , '%d-%m-%Y') as data_corso , f.* FROM db_formazione  AS f LEFT JOIN doc_formazione_formazioni AS c ON f.id_categoria = c.id WHERE f.id ='".$formazione."' ";
        
        $dati = Yii::app()->db->createCommand($query)->queryRow();
        
        $tmp = Yii::app()->db->createCommand("SELECT id_gruppo FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$formazione."' ")->queryAll();
        
        if(count($tmp)){
            for($x=0 ; $x < count($tmp); $x++)
                $gruppi[] = $tmp[$x]['id_gruppo'];
        
            if(count($gruppi) > 0){
                $query = "SELECT DISTINCT(g.id_utente) , u.nome , u.cognome , u.email   FROM doc_formazione_utenti_gruppi AS g LEFT JOIN utenti AS u  ON g.id_utente = u.id WHERE id_gruppo IN  (".implode(",",$gruppi).")  AND u.email !='' ";
                $users =  Yii::app()->db->createCommand($query)->queryAll();
                
                if(count($users)) {
                    for($x=0; $x <count($users); $x++){
                        
                        $this->smtpDest = array();
                        $this->smtpDest[$users[$x]['email']] = $users[$x]['nome']." ".$users[$x]['cognome'];
                        
                        $txt  = "<div style='margin-top: 20px'>";
                        $txt .= "<p>Ciao  <b>" . $users[$x]['nome']." ".$users[$x]['cognome']."</b></p> ";
                        $txt .= "<p>Ti ricordiamo la tua presenza ".$dati['data_corso']." alle ore ".$dati['ore']." per il seguente corso di formazione ".$dati['nome']." ".$dati['titolo']."  </p>";
                        $txt .= "</div>";
                        
                        $this->smtpTipo ='formazione';
                        $this->smtpText = $txt;
                        $this->send();
                        
                    }
                
                }
            
            }
        }
    }
    
    function getTemplate(){
        return Yii::app()->db->createCommand("SELECT valore FROM config WHERE chiave ='TEMPLATE_GENERICO' ")->queryScalar();
    }
    
    function sendSmtp() {
        
        $mail = new YiiMailer();
        //$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
        $mail->setSmtp($this->smtpHost, $this->smtpPort, 'tls', true, $this->smtpUser, $this->smtpPassword);
        $mail->setFrom($this->smtpFrom, $this->smtpFromName);
        $mail->setTo($this->smtpDest);
        $mail->setSubject($this->smtpObject);
        $mail->setBody($this->smtpText);
		$mail->send();
    }
}
?>
