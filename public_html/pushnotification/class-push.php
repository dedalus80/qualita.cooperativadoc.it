<?php

class Push_Notification extends MySql_DB {

    var $pushApId = "9e208e47-0f90-4222-8f94-7f3aa7596f4d";
    var $pushApKey = "NzA0NTlmZjEtODA2My00ODdmLWJlOTgtNjRlNjE2YWM4OGE1";
    var $pushTags = array();
    var $typeUser = "";
    var $Q_site = "";
    var $Q_id = "";
    var $pushText = "";
    var $pushTitle = "GESTIONALE QUALITA";
    var $pushQuestionario = "";
    var $pushGiudizzio = "";
    var $pushField = "";
    var $pushTable = "";
    var $pushRefer = "";
    var $pushType = "";

    public function savePush() {

        // DESTINATARI NOTIFICA
        $quanti = $this->SingleField("count(id)", "utenti", "WHERE " . $this->pushKey . "= 'Y' ");
        $query = " INSERT INTO comunicazioni (tipo,quanti,previsti, titolo,messaggio_push, data_invio, stato, query) VALUES ";
        $query .= " ('P','" . $this->pushQuanti . "','" . $quanti . "','" . $this->pushTitle . "' ,'" . $this->pushText . "',NOW(),'Y',   '" . $this->pushKey . "=Y') ";
        $this->Query($query);
    }

    function asGiudizio() {
        $stato = true;
        switch ($this->Q_site) {

            case"COM":
            case"CAMO":
            case"SHAO":
            case"STEO":
            case"TIM":
				
                $stato = false;
        }
        return $stato;
    }

    function setGiudizio() {
        if ($this->asGiudizio())
            $this->pushGiudizzio = $this->descrizione($this->SingleField($this->pushField, $this->pushTable, " WHERE id ='" . $this->Q_id . "' ") . " con giudizio complessivo");
    }

    function descrizione($id) {
        switch ($id) {
            case"B":
                $txt = "Buono";
                break;
            case"S":
                $txt = "Sufficiente";
                break;
            case"I":
                $txt = "Insuficiente";
                break;
            case"E":
                $txt = "Ottimo";
                break;
            case"P":
                $txt = "Poco";
                break;
            case"A":
                $txt = "Abbastanza";
                break;
            case"M":
                $txt = "Molto";
                break;
        }
        return $txt;
    }

    function setKeySite() {

        switch ($this->Q_site) {
            case"SHAO":
                $this->pushKey = 'preiscrizione_sh';
                $this->sito = "Sharing.to.it";
				$this->pushTable = 'sh_preiscrizioni';
                break;
            case"TIM":
                $this->pushKey = 'preiscrizione_tim';
                $this->sito = "Iscrizioni Tim Keluar.it";
				$this->pushTable = 'tim_preiscrizioni';
                break;    
			 case"STEO":
                $this->pushKey = 'preiscrizione_sp';
                $this->sito = "Stesso Piano.it";
				$this->pushTable = 'sp_preiscrizioni';
                break;	
            case"CAMO":
                $this->pushKey = '	preiscrizione_cs';
                $this->sito = "Campussanpaolo.it";
                $this->pushTable = "ca_preiscrizioni";
                break;
            case "SHA":
                $this->pushKey = 'q_sharing';
                $this->pushQuestionario = "SHARING";
                $this->pushTable = 'questionario_sharing';
                $this->pushField = "viaggio_complessivo";
                break;
            case "CAM":
                $this->pushKey = 'q_campus';
                $this->pushQuestionario = "CAMPUS SAN PAOLO";
                $this->pushTable = 'questionario_sharing';
                $this->pushField = "viaggio_complessivo";
                break;
            case "COM":
                $this->pushKey = 'preiscrizione_cm';
                $this->pushQuestionario = "FACCIAMO L'ALBERO";
                $this->pushTable = "Inscrizione facciamo  l'albero";
                $this->pushField = "viaggio_complessivo";
                break;
            case "DOC":
            case "TOR":
            case "VIL":
            case "CES":
                $this->pushKey = 'q_doc';
                $this->pushQuestionario = "DOC";

                if ($this->Q_site == 'TOR')
                    $this->pushQuestionario = "TORRE MARINA";
                else if ($this->Q_site == 'VIL')
                    $this->pushQuestionario = "VILLAGGIO BARDONECCHIA";
                else if ($this->Q_site == 'CES')
                    $this->pushQuestionario = "OSTELLO CESENATICO";
                $this->pushTable = 'questionario_doc';
                $this->pushField = 'vacanza';
                break;
            case "KEL":
                $this->pushKey = 'q_keluar';
                $this->pushQuestionario = "KELUAR " . $this->Q_site;
                $this->pushTable = 'questionario_keluar';
                $this->pushField = "viaggio_complessivo";
                break;
            case "KELL":
                $this->pushKey = 'q_keluar';
                $this->pushQuestionario = "KELUAR " . $this->Q_id;
                $this->pushTable = 'questionario_keluar';
                $this->pushField = "viaggio_complessivo";
                break;
            case "FOR":
                $this->pushKey = 'q_formazione';
                $this->pushQuestionario = "FORMAZIONE";
                $this->pushTable = 'questionario_formazione';
                $this->pushField = "giudizio";
                break;
            case "JUN":
                $this->pushKey = 'q_junior';
                $this->pushQuestionario = "SOGGIORNO JUNIOR";
                $this->pushTable = 'questionario_junior';
                $this->pushField = "divertimento";

                break;
            case "SEN":
                $this->pushKey = 'q_senior';
                $this->pushQuestionario = "SOGGIORNO SENIOR";
                $this->pushTable = 'questionario_senior';
                $this->pushField = "divertimento";
                break;
            case "SCI":
                $this->pushKey = 'q_scientifici';
                $this->pushQuestionario = "SOGGIORNO CAMPUS FORMATIVI";
                $this->pushTable = 'questionario_scientifici';
                $this->pushField = "divertimento";
                break;
            case "STU":
                $this->pushKey = 'q_studio';
                $this->pushQuestionario = "VACANZE STUDIO";
                $this->pushTable = 'questionario_studio';
                $this->pushField = "divertimento";
                break;
            case "VAC":
                $this->pushKey = 'q_vacanza';
                $this->pushQuestionario = "UNA VACANZA UNA ESPERIENZA";
                $this->pushTable = 'questionario_studio';
                $this->pushField = "giudizio";
                break;
            case "JUNG":
                $this->pushKey = 'q_junior';
                $this->pushQuestionario = "GENITORE JUNIOR";
                $this->pushTable = 'questionario_genitori_junior';
                $this->pushField = "complessivo";
                break;
            case "SENG":
                $this->pushKey = 'q_senior';
                $this->pushQuestionario = "GENITORE SENIOR";
                $this->pushTable = 'questionario_genitori_senior';
                $this->pushField = "complessivo";
                break;
            case "SCIG":
                $this->pushKey = 'q_scientifici';
                $this->pushQuestionario = "GENITORE  CAMPUS FORMATIVI";
                $this->pushTable = 'questionario_genitori_scientifici';
                $this->pushField = "complessivo";
                break;
            case "STUG":
                $this->pushKey = 'q_studio';
                $this->pushQuestionario = "GENITORE VACANZE STUDIO";
                $this->pushTable = 'questionario_genitori_studio';
                $this->pushField = "complessivo";
                break;
        }
        return $this->pushKey;
    }

    function setPushText() {
		
		$iscrizioni = array("STEO","SHAR","CAMO","TIM") ;
		
        if (in_array($this->Q_site,$iscrizioni) ){
			$dati = $this->FetchArray($this->Query("SELECT nome, cognome FROM ".$this->pushTable." WHERE id ='".$this->Q_id  ."' "));
			$this->pushText = "Ciao.".$dati['nome']." ".$dati['cognome']." ha  appena compilato compilato una nuova registrazione al sito " . $this->sito;
		}
        else if($this->Q_site == 'COM')
            $this->pushText = "Ciao. E appena stato compilato una nuova registrazione a " . $this->pushQuestionario . "  " . strtoupper($this->pushGiudizzio) . ".";
        else if ($this->pushType == 'OFFERTE')
            $this->pushText = "Ciao un nuovo utente " . $this->pushRefer . " ha richiesto di ricevere le offerte speciali del sito " . $this->sito;
        else
            $this->pushText = "Ciao. E appena stato compilato un nuovo questionario " . $this->pushQuestionario . "  " . strtoupper($this->pushGiudizzio) . ".";
        
        if ($this->pushType != 'OFFERTE')
            $this->pushText .= " Clicca per visualizzarne il contenuto integrale.";
    }

    function sendNotification() {

        $content = array(
            "en" => $this->pushText,
            "it" => $this->pushText,
        );

        $heading = array(
            "en" => $this->pushTitle,
            "it" => $this->pushTitle,
        );

        $fields = array(
            'app_id' => $this->pushApId,
            'data' => array("foo" => "bar"),
            'tags' => $this->pushTags,
            'contents' => $content,
            'headings' => $heading,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . $this->pushApKey . ' '));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($response);
        $this->pushQuanti = $obj->{'recipients'};

        echo $response;
    }

}