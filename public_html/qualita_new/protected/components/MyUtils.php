<?php

class MyUtils extends CApplicationComponent {

   
    public function getAjaxSelect($dati){
        
        $query = "SELECT id , ".$dati['field']."  as nome FROM ".$dati['table']." WHERE ".$dati['field']." LIKE '".$dati['valore']."%' " ;
        $tmp =   Yii::app()->db->createCommand($query)->queryAll();
        $list['totale'] = count($tmp);
        for($x=0; $x < count ($tmp); $x++){
            $list['list'] .= "<li ><a class='autocomplete-li' href='#' data-id='".$tmp[$x]['id']."' data-text='".$tmp[$x]['nome']."'  >".$tmp[$x]['nome']." </a></li>";
        }
        
        return $list;
    }
            
    public function getAjaxStrutture($strutture){
        
        $strutture ? $struttura = explode(",",$strutture) :"";
        
        $tmp =   Yii::app()->db->createCommand("SELECT id , nome  FROM doc_unita WHERE soloq ='N' ORDER BY  nome")->queryAll();
        
        $list['totale'] = count($tmp);
        
        if(count($tmp)){
            for($x=0; $x < count($tmp) ; $x++){
                $x%2 =='0' ? $class='odd':$class="";
                is_array($struttura) && in_array($tmp[$x]['id'],$struttura) ? $check ='checked="checked"' : $check ='';
			     
                $list['list'] .= "<div class='row-corelato ".$class."'>
				 <input type='checkbox' ".$check."  name='nessuno' class='check-struttura checkbox-blue' value='' data-valore='".$tmp[$x]['id']."' data-codice='".$tmp[$x]['nome']."'  >
				 &nbsp; &nbsp;".$tmp[$x]['nome']."</div>";
            }
	    }
        
        return $list;
    }
    
    public function getUserInfo() {

        $dati = Yii::app()->db->createCommand("SELECT * FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryRow();
        
        if ($dati['q_junior'] == 'Y' || $dati['q_senior'] == 'Y' || $dati['q_keluar'] == 'Y' || $dati['q_doc'] == 'Y' || $dati['q_studio'] == 'Y' || $dati['q_scientifici'] == 'Y' || $dati['q_sharing'] == 'Y' || $dati['q_campus'] == 'Y' || $dati['q_formazione'] == 'Y')
            $dati['questionari'] = "Y";
        
        $dati['preiscrizione_sn'] == "Y" || $dati['preiscrizione_cs'] == "Y" || $dati['preiscrizione_sh'] == "Y" || $dati['preiscrizione_sp'] == "Y" || $dati['preiscrizione_cm'] == "Y" || $dati['preiscrizione_tim'] == "Y" ? $dati['preiscrizioni'] = "Y" : "";
        
        //$admin = array("1","3","5","8","9");

        $admin = array("1","8","9");

        if (in_array($dati['user_type'], $admin))
            $dati['admin'] = true;
        else
            $dati['admin'] = false;
       
        
        return $dati;
    }

    public function getPermition($type)
    {
        //$users      = array('admin');
        $users      = array();
        $dettagli   = $this->getUserInfo();

        switch ($type) {
            case"azioni":
                $users[] = $dettagli['user'] ;
                break;
            case"formazione":
                $dettagli['formazione'] == "Y" ? $users[] = $dettagli['user']:"" ;
                break;
            case"statistiche":
                $dettagli['user_type'] == "3" ? $users[] = $dettagli['user']:"" ;
                break;     
			case"verifiche":
                $dettagli['user_type'] != "4"  ? $users[] = $dettagli['user'] : "";
                break;
            case"documenti":
                if(Yii::app()->user->getState('group') == 'ADMIN')
                    $users[] = $dettagli['user'];
                else
                    $users[] = "";
                break;
            case"admin":
                $dettagli['user_type'] == "8" ||  $dettagli['user_type'] == "9"  ? $users[] = $dettagli['user'] : "";
                break;
            case"admin_formazione":
                $dettagli['user_type'] == "8" ||  $dettagli['user_type'] == "9"  ? $users[] = $dettagli['user'] : "";
                break;
            case"SN":
                $dettagli['preiscrizione_sn'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"TIM":
                $dettagli['preiscrizione_tim'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;    
            case"SP":
                $dettagli['preiscrizione_sp'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"CS":
                $dettagli['preiscrizione_cs'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"SH":
                $dettagli['preiscrizione_sh'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"CM":
                $dettagli['preiscrizione_cm'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"FO":
                $dettagli['preiscrizione_fo'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;    
            case"QU":
                $dettagli['questionari'] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
            case"all":
                $users[] = $dettagli['user'];
                break;
            case"q_doc":
            case"q_formazione":
            case"q_keluar":
            case"q_sharing":
            case"q_vacanza":
            case"q_junior":
            case"q_senior":
            case"q_studio":
            case"q_scientifici":
            case"q_campus":
            case"q_torremarina":
                $dettagli[$type] == "Y" ? $users[] = $dettagli['user'] : "";
                break;
        }

        return $users;
    }

    public function getMenuPermition($type) {


        $asPermition    = false;
        $dettagli       = $this->getUserInfo();

        switch ($type) {
            
            case"azioni":
                $asPermition = true ;
                break;
			case"verifiche":
                //$dettagli['verifiche_ispettive'] == "Y"  ? $asPermition = true : "";
                $dettagli['user_type'] != "2" ? $asPermition = true : "";
                break;
            case"verifiche_int":
                $dettagli['user_type'] != "7"  ? $asPermition = true : "";
                break;    
            case"formazione":
                $dettagli['formazione'] == "Y"  ? $asPermition = true : "";
                break;    
            case"admin":
                $dettagli['user_type'] == "8" || $dettagli['user_type'] == "9" ? $asPermition = true : "";
                break;
            case"admin_formazione":
                $dettagli['user_type'] == "8" || $dettagli['user_type'] == "9" ? $asPermition = true : "";
                break;
            case"boss":
                $dettagli['user_type'] == "9" ? $asPermition = true : "";
                break;  
            case"statistiche":
                $dettagli['statistiche'] == "Y" || $dettagli['user_type'] =='3' ? $asPermition = true : "";
                break;
            case"letture":
                $dettagli['letture_contatori'] == "Y" ? $asPermition = true : "";
                break;
            case"utenze":
                $dettagli['utenze'] == "Y" ? $asPermition = true : "";
                break;
            case"iscrizioni":
                $dettagli['preiscrizioni']  ? $asPermition = true : "";
                break;
            case"export":
                 $dettagli['user_type'] == "8" || $dettagli['user_type'] == "9" || $dettagli['preiscrizioni'] == "Y" ? $asPermition = true : "";
                break;    
            case"SN":
                $dettagli['preiscrizione_sn'] == "Y" ? $asPermition = true : "";
                break;
            case"CS":
                $dettagli['preiscrizione_cs'] == "Y" ? $asPermition = true : "";
                break;
            case"SH":
                $dettagli['preiscrizione_sh'] == "Y" ? $asPermition = true : "";
                break;
            case"SP":
                $dettagli['preiscrizione_sp'] == "Y" ? $asPermition = true : "";
                break;
            case"CM":
                $dettagli['preiscrizione_cm'] == "Y" ? $asPermition = true : "";
                break;
            case"FO":
                $dettagli['preiscrizione_fo'] == "Y" ? $asPermition = true : "";
                break;    
             case"TIM":
                $dettagli['preiscrizione_tim'] == "Y" ? $asPermition = true : "";
                break;    
            case"QU":
                $dettagli['questionari'] == "Y" ? $asPermition = true : "";
                break;
            case"all":
                $asPermition = true;
                break;
            case"q_doc":
            case"q_formazione":
            case"q_keluar":
            case"q_sharing":
            case"q_vacanza":
            case"q_junior":
            case"q_senior":
            case"q_studio":
            case"q_scientifici":
            case"q_sport":
            case"q_campus":
            case"q_torremarina":
                $dettagli[$type] == "Y" ? $asPermition = true : "";
                break;
        }

        return $asPermition;
    }

    public function getIdFormazione(){
        
        $corsi = array("0");
        $tmp = Yii::app()->db->createCommand("SELECT id_gruppo FROM doc_formazione_utenti_gruppi WHERE id_utente ='".Yii::app()->user->getId()."' ")->queryAll();
        
        if(count($tmp)){
            for($x=0; $x < count($tmp); $x++)
                $gruppi[] = $tmp[$x]['id_gruppo'];
        
            $tmpCorsi =  Yii::app()->db->createCommand("SELECT id_corso FROM doc_formazione_gruppi_corsi WHERE id_gruppo IN (".implode(",",$gruppi).")")->queryAll();
            if(count($tmpCorsi)){
                for($x=0; $x < count($tmpCorsi); $x++)
                $corsi[] = $tmpCorsi[$x]['id_corso'];
            }
        }

        //verifico se l'utente ha in invito singolo ai corsi
        $tmpCorsi =  Yii::app()->db->createCommand("SELECT id_corso FROM doc_formazione_utenti_corsi WHERE id_utente = '".Yii::app()->user->getId()."'")->queryAll();
        if(count($tmpCorsi)) {
            foreach($tmpCorsi as $corso)
                $corsi[] = $corso['id_corso'];
        }

        return $corsi ;
    }
        
    public function approvaAzione($id, $table, $stato) {
        Yii::app()->db->createCommand("UPDATE " . $table . " SET approvato = '" . $stato . "' WHERE id ='" . $id . "' ")->execute();
        $result = array();

        switch ($table) {
            case"iscrizioni_unavacanzaperognieta":
                $title = "Iscrizione una vacanza per ogni et&agrave;";
                break;
            case"iscrizioni_unavacanzainsieme":
                $title = "Iscrizione una vacanza insieme";
                break;
            case"":
                break;
        }

        if ($stato == "Y") {
            $result['class_add'] = "approved circle-green fa-check";
            $result['class_remove'] = "non-approved circle-red fa-ban";
            $result['testo'] = $title . " approvata con successo";

            $result['titolo'] = "Approvata clicca per non approvare";
        } else {
            $result['class_remove'] = "approved circle-green fa-check";
            $result['class_add'] = "non-approved circle-red fa-ban";
            $result['testo'] = $title . " non approvata con successo";
            $result['titolo'] = "Non Approvata clicca per approvare";
        }
        return $result;
    }
    
    public function setOnline($dati){
        
        
       
        
        Yii::app()->db->createCommand("UPDATE " . $dati['table'] . " SET online = '" . $dati['stato'] . "' WHERE id ='" . $dati['id'] . "' ")->execute();
        
         $class='bigger-110 icon-only btn  btn-circle circle-blue';
        
        if($dati['stato'] =='Y')
            $tmp = "<a href='javascript:setOnline(\"".$dati['table']."\",\"".$dati['model']."\",\"N\",".$dati['id'].")' data-original-title='ONline clicca per mettere OFFline' class='set-online' rel='tooltip' data-toggle='tooltip' data-model='".$dati['model']."' data-table='".$dati['table']."' data-stato='N' data-refer ='".$dati['id'] ."'  ><i class='fa fa-check  green ".$class."'></i></a>";
        else
            $tmp = "<a href='javascript:setOnline(\"".$dati['table']."\",\"".$dati['model']."\",\"Y\",".$dati['id'].")'  data-original-title='OFFline clicca per mettere ONline' class='set-online' rel='tooltip' data-toggle='tooltip' data-model='".$dati['model']."' data-table='".$dati['table']."' data-stato='Y' data-refer ='".$dati['id'] ."' id='online-".$dati['id'] ."' ><i class='fa fa-ban red  ".$class."'></i></a>";
        
        return $tmp;
    }
        
    public function getGiudizio($id, $tipo) {
        $g = "";
        switch ($tipo) {
            case"2":
                switch ($id) {
                    case"M":
                        $g = "SI";
                        break;
                    case"P":
                        $g = "NO";
                        break;
                }
                break;
            case"3":
                switch ($id) {
                    case"M":
                        $g = "MOLTO";
                        break;
                    case"A":
                        $g = "ABBASTANZA";
                        break;
                    case"P":
                        $g = "POCO";
                        break;
                }
                break;
            case"4":
                switch ($id) {
                    case"M":
                        $g = "BUONA";
                        break;
                    case"A":
                        $g = "AFFICIENTE";
                        break;
                    case"P":
                        $g = "INSUFICIENTE";
                        break;
                    case"O":
                        $g = "MOLTO BUONA";
                        break;
                }
                break;
        }
        return $g;
    }

    public function getSelect($table, $order = NULL) {

        $select = array();
        $field = "id, nome";
        //$strutture = $this->getUserStruttura();

        $strutture = Yii::app()->user->getState('strutture');

        if(count($strutture) == 1 && $strutture[0] == '')
            $strutture = null;
        
        switch ($table) {
            case "qualita_strutture":
            case "doc_unita":
                
                $AND = "AND soloq ='N' ";
                
                if ($strutture)
                    $AND .= " AND id IN(" . implode(",", $strutture) . ") ";
                else
                    $AND .= "  ";
                break;


            case "codici_reclami":
            case "codici_ac":
            case "codici_reclamo":
            case "azioni_reclami_azioni":
            case "azioni_verifiche":
            case "azioni_verifiche_amministrazione":
            case "azioni_verifiche_ambientali":
            case "azioni_verifiche_sicurezza":
            case "azioni_verifiche_ristorazione":
            case "azioni_verifiche_personale":
            case "utenze_matricole":
            case "codici_nonconformi":
            case "refer_codici_nonconformi":
                if ($strutture)
                    $AND = " AND unita_operativa IN(" . implode(",", $strutture) . ")  AND anno = '".date("Y")."' ";
                else
                    $AND = " ";
                break;
            case "doc_unita_doc":
                $AND = " AND qdoc ='Y' ";
                break;
            case "doc_unita_keluar":
                $AND = " AND qkeluar ='Y' ";
                break;
            case "doc_unita_sharing":
                $AND = " AND qsharing ='Y' ";
                break;
            case "doc_unita_formazione":
                $AND = " AND qformazione ='Y' ";
                break;
            case "doc_unita_senior":
                $AND = " AND qsenior ='Y' ";
                break;
            case "doc_unita_junior":
                $AND = " AND qjunior ='Y' ";
                break;
            case "doc_unita_scientifici":
                $AND = " AND qscientifici ='Y' ";
                break;
            case "doc_unita_studio":
                $AND = " AND qstudio ='Y' ";
                break;
            case "doc_unita_comune":
                $AND = " AND qsmog ='Y' ";
                break;
            case 'doc_tipologie_verifiche':
                $AND = " AND is_hidden ='N' ";
                break;
            default :
                $AND = "";
                break;
        }

        $where = "WHERE 1";

        switch ($table) {

            case"incaricato":
                $table = 'admin';
                $field = " id , CONCAT(nome,' ', cognome) as nome ";
                break;
			case"sp_alloggio":
                $field = " id , nome_it as nome ";
                break;
			case"sp_amici_genere":
                $field = " id , nome_it as nome ";
                break;	
			case"sp_amici":
                $field = " id , nome_it as nome ";
                break;	
			case"sp_amici_occupazione":
                $field = " id , nome_it as nome ";
                break;
			case"sp_amici_eta":
                $field = " id , nome_it as nome ";
                break;	
            case"sp_amici_fumatori":
                $field = " id , nome_it as nome ";
                break;	
            case"sp_amici_animali":
                $field = " id , nome_it as nome ";
                break;	
			case"sp_residenza":
                $field = " id , nome_it as nome ";
                break;	
				
			case"codici_nc":
                $table = 'db_nonconforme';
                $field = "id, codice as  nome";
                if(Yii::app()->user->getState('group') != 'ADMIN') {
                    //$where = " WHERE id_utente = ".Yii::app()->user->getId()." AND anno = '".date('Y')."'";
                    $where = " WHERE id_utente = ".Yii::app()->user->getId();
                }
                else {
                    //$where = " WHERE anno = '".date('Y')."'";
                    $where = " WHERE 1";
                }
                break;
            case"codici_ac":
                $table = 'db_azionicorrettive';
                $field = "id, codice as  nome";
                break;
            case"codici_reclami":
                $table = 'db_reclami';
                $field = "id, codice as  nome";
                break;
            case"tim_fascie":
                $field = " id , descrizione as  nome";
                break;
             case"tim_turni":
                $field = " id , CONCAT(codice,' Dal ', DATE_FORMAT(data_inizio ,'%d-%m-%Y') ,' Al ', DATE_FORMAT(data_fine ,'%d-%m-%Y')) as nome ";
                break;       
                
            case "responsabili_strutture":
            case "responsabili_centro":
            case "medici_centro":
                $table = 'utenti';
                if ($table == 'medici_centro')
                    $where = " WHERE user_type ='6'";
                else if ($table == 'responsabili_centro')
                    $where = " WHERE user_type IN (1,3,5) ";
                break;
            case 'db_verifiche_amministrazione_codici':
                $table = 'db_verifiche_amministrazione';
                $field = "id, codice_verifica as  nome";
                break;
            case 'db_verifiche_amministrative_codici':
                $table = 'db_verifiche_amministrative';
                $field = "id, codice_verifica as  nome";
                break;
            case 'db_verifiche_educazione_codici':
                $table = 'db_verifiche_educazione';
                $field = "id, codice_verifica as  nome";
                break;
             case 'db_verifiche_educative_codici':
                $table = 'db_verifiche_educative';
                $field = "id, codice_verifica as  nome";
                break;    
            case 'db_verifiche_manutenzione_codici':
                $table = 'db_verifiche_manutenzione';
                $field = "id, codice_verifica as  nome";
                break;
            case 'db_verifiche_sicurezza_codici':
                $table = 'db_verifiche_sicurezza';
                $field = "id, codice_verifica as  nome";
                break;
            case 'db_verifiche_ristorazione_codici':
                $table = 'db_verifiche_ristorazione';
                $field = "id, codice_verifica as  nome";
                break;
            case 'db_verifiche_ambientale_codici':
                $table = 'db_verifiche_ambientale';
                $field = "id, codice_verifica as  nome";
                break;
            case 'utenze_matricole':
                $field = "id, unita_operativa as nome";
                break;
            case 'azioni_reclami':
                $field = "id, codice as  nome";
                break;
            case 'utenti_periodi':
                $field = "id, CONCAT('Dal ', DATE_FORMAT(dal ,'%d-%m-%Y'),' Al ', DATE_FORMAT(al ,'%d-%m-%Y')) as  nome";
                $where = "WHERE 1";
                break;
            case 'codici_nonconformi':
            case 'refer_codici_nonconformi':
                $field = "codice as id , codice as nome ";
                if ($table == 'refer_codici_nonconformi')
                    $field = "id , codice as nome ";
                $table = "azioni_nonconformi";
                break;
            case"doc_colori":
                $field = " id , colore as nome ";
                break;
            case"utenti":
                $field = " id , CONCAT(nome,' ', cognome) as nome ";
                $where = "WHERE user_type != 2";
            case"admin":
                $field = " id , CONCAT(nome,' ', cognome) as nome ";
                break;
            case"doc_unita_doc":
            case"doc_unita_keluar":
            case"doc_unita_sharing":
            case"doc_unita_formazione":
            case"doc_unita_senior":
            case"doc_unita_junior":
            case"doc_unita_scientifici":
            case"doc_unita_studio":
            case"doc_unita_comune":
                $table = "doc_unita";
                break;
			case 'facolta':
				$field = "id, nome_facolta as nome ";
				break;
            
            case 'doc_campus':
                $where = "WHERE formulaId IN (2,5,7,8)";
                $orderBy = "ORDER BY formulaId, nome";
                break;
				
            default:
                $field = "id, nome";
                break;
        }

        if ($order)
            $orderBy = "ORDER BY " . $order;
        else
            $orderBy = "ORDER BY nome ";

        $query = "SELECT " . $field . " FROM " . $table . "  " . $where . " " . $AND . " " . $orderBy;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = html_entity_decode($dati[$x]['nome']);

        return $select;
    }
    
    public function getSoggiorniQ($table,$soggiorno){
        
        $select = array();
        
        //$dati = Yii::app()->db->createCommand("SELECT DISTINCT(q.".$soggiorno.") AS id ,s.nome as nome FROM  " . $table . " as q LEFT JOIN doc_unita as s ON q.".$soggiorno." = s.id ORDER BY nome ")->queryAll();
        $dati = Yii::app()->db->createCommand("SELECT DISTINCT(q.".$soggiorno.") AS id ,s.nome as nome FROM  " . $table . " as q JOIN doc_unita as s ON q.".$soggiorno." = s.id ORDER BY nome ")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = html_entity_decode($dati[$x]['nome']);

        return $select;
        
        
    }
    
    public function getYearsQ($table){
        
      $dati = Yii::app()->db->createCommand("SELECT DISTINCT(anno) AS id FROM  " . $table . " ORDER BY anno ")->queryAll();
        
       for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = html_entity_decode($dati[$x]['id']);

        return $select; 
    }
        
    public function getSelectValue($id, $table) {

        $WHERE = "WHERE id='" . $id . "'";
        $field = 'nome';

        switch ($table) {
             case "tim_fascie":
                $field = "CONCAT(nome,' &deg; Fascia <br />',descrizione) ";
                break;
            case "nome_colore":
                $field = "colore";
                $table = 'doc_colori';
                break;
            case "utenze_matricole":
                $field = "matricola";
                break;
            case"dettaglio_utenti":
                $field = "CONCAT(nome,' ', cognome) ";
                $table = 'utenti';
                break;
            case"dettaglio_admin":
                $field = "CONCAT(nome,' ', cognome) ";
                $table = 'utenti';
                break;
            case"utenti_periodi":
                $field = "CONCAT('Dal ', DATE_FORMAT(dal ,'%d-%m-%Y'),' Al ', DATE_FORMAT(al ,'%d-%m-%Y')) ";
                break;
            case "azioni_reclami":
            case "qualita_strutture_codice":
            case "qualita_tipologie_verifiche_codice":

                $field = 'codice';
                if ($table == 'qualita_strutture_codice')
                    $table = 'doc_unita';
                if ($table == 'qualita_tipologie_verifiche_codice')
                    $table = 'doc_tipologie_verifiche';

                break;
            case "utenze_matricole":
                $field = 'matricola';
                break;
            case "codice_nc":
                $field = 'codice';
                $table = 'db_nonconforme';
                break;

            case "allegato_nc":
                $field = 'allegato';
                $table = 'db_nonconforme';
                break;
            case "allegato_ac":
                $field = 'allegato';
                $table = 'db_azionicorrettive';
                break;
            case "allegato_reclamo":
                $field = 'allegato';
                $table = 'db_reclami';
                break;
            case "codice_societa":
                $field = 'codice';
                $table = 'doc_societa';
                break;
            case "codice_unita":
                $field = 'codice';
                $table = 'doc_unita';
                break;
            case "codice_verifica_nc":
                $field = 'codice';
                $table = 'db_verifiche';
                break;
            case "codice_reclamo_nc":
                $field = 'codice';
                $table = 'db_reclami';
                break;
            case "codice_reclamo":
                $field = 'matricola';
                break;
            case "utenti_communicazioni":
            case "admin_medici":
            case "admin_responsabili":
                $field = "CONCAT(nome,' ', cognome) ";
                $table = 'utenti';
                break;
            case "utenti_rientri_anticipati_deleghe":
                $field = 'delega';
                $WHERE = "WHERE id_rientro='" . $id . "'";
                break;
            case "codici_nonconformi":
                $field = 'codice';
                $table = 'azioni_nonconformi';
                break;
            case "db_reclami":
                $field = 'codice';
                break;
            case "doc_matricole":
                $field = 'matricola';
                break;
            case "utenti_communicazioni":
                $field = "user";
                $table = 'utenti';
                break;
            case "doc_unita_superficie":
                $field = "CONCAT(superficie,' Mq')";
                $table = 'doc_unita';
                break;
            //case "doc_housing":
            //    $WHERE = "WHERE formulaId = '$id'";
            //    break;
            default:
                $field = 'nome';
                break;
        }

        $val = Yii::app()->db->createCommand("SELECT " . $field . " FROM " . $table . " " . $WHERE)->queryScalar();
        if (!$val)
            $val = "";
        return $val;
    }
    
    function generaCodice($struttura, $tabella, $id = NULL) {

        // SE ESISTE ID VERIFICO CHE NON SIA CAMBIATA LA STRUTTURA

        if ($id)
            $codice = Yii::app()->db->createCommand("SELECT codice FROM " . $tabella . "  WHERE id='" . $id . "' AND  unita_operativa ='" . $struttura . "' ")->queryScalar();

        if (!$codice)
            $codice = Yii::app()->db->createCommand("SELECT MAX(id) FROM " . $tabella . "  WHERE unita_operativa ='" . $struttura . "' AND anno ='" . date("Y") . "'  ")->queryScalar() + 1;

        return Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id='" . $struttura . "'")->queryScalar() . "-" . date("Y") . "-" . $codice;
    }
        
    public function getPercent($quanti, $totale) {

        if ($quanti > 0 && $totale > 0)
            $tmp = ( $quanti / $totale ) * 100;
        else
            $tmp = 0;

        return number_format($tmp, 0);
    }

    public function getColor($tmp, $tipo= NULL) {

        if ($tmp > 75) {
            if ($tipo)
                $color = "success";
            else
                $color = "danger";
        }
        else if ($tmp > 50)
            $color = "warning";
        else {
            if ($tipo)
                $color = "danger";
            else
                $color = "success";
        }

        return $color;
    }

    function reverseDate($date) {
        if ($date && $date != '00-00-0000' && $date != '0000-00-00') {
            $data = explode("-", $date);
            return $data[2] . "-" . $data[1] . "-" . $data[0];
        }
        else
            return "";
    }

    function reverseDateTime($date) {
        if ($date && $date != '00-00-0000 00:00:00' && $date != '0000-00-00 00:00:00') {
            $d = explode(" ",$date);
            $data = explode("-", $d[0]);
            
            return $data[2] . "-" . $data[1] . "-" . $data[0]." ".substr($d[1],0,5);
        }
        else
            return "";
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

    public function getCompilatore($id = NULL) {

        if (!$id)
            $id = Yii::app()->user->getId();

        return Yii::app()->db->createCommand("SELECT cognome , nome , user_type FROM utenti WHERE id='" . $id . "'")->queryRow();
    }

    public function getStrutturaNome() {
        $user = $this->getUserInfo();
        return Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='" . $user['user_unita'] . "' ")->queryScalar();
    }

    public function getStrutturaId() {
        $user = $this->getUserInfo();
        return $user['user_unita'];
    }
	
	public function getIncaricatiVerifica (){
		$ids = array("0");
		
		$verifiche = Yii::app()->db->createCommand("SELECT id FROM db_verifiche WHERE incaricato ='".Yii::app()->user->getId()."' || compilatore ='".Yii::app()->user->getId()."'  || tipo_verifica = '5' ")->queryAll();
		for($x = 0; $x< count($verifiche) ; $x++)
			$ids[] = $verifiche[$x]['id'];
		
		return $ids;	
	}
    
    public function getIncaricatiVerificaInterni (){
		$ids = array("0");
		
		$verifiche = Yii::app()->db->createCommand("SELECT id FROM db_verifiche WHERE incaricato ='".Yii::app()->user->getId()."' || compilatore ='".Yii::app()->user->getId()."'  || tipo_verifica = '5'  && tipo_verifica IN ('5','2') ")->queryAll();
		for($x = 0; $x< count($verifiche) ; $x++)
			$ids[] = $verifiche[$x]['id'];
		
		return $ids;	
	}
    	
    public function getUserStruttura($type = NULL) {

        $dati       = $this->getUserInfo();
        $strutture  = array("0");
		
		$users = array("3","2","4","6","7");
		
        switch ($dati["id"]) {

            case "110": // RESPONSABILE STRUTTURA 

                if ($type == 'indagini') {
                    $id = Yii::app()->db->createCommand("SELECT id FROM infortunio WHERE struttura IN ('19','20','21','22')")->queryAll();
                    if(count($id)){
                        for ($x = 0; $x < count($id); $x++)
                            $strutture[] = $id[$x]['id'];
                    }
                }
                else
                    $strutture = array("19", "20", "21", "22");
                break;

            default:
                if ($type == 'indagini') {
                    if ($dati["user_type"] == 3) {
                        $id = Yii::app()->db->createCommand("SELECT id FROM infortunio WHERE struttura ='" . $typeUser . "' ")->queryAll();
                        if(count($id)){
                            for ($x = 0; $x < count($id); $x++)
                                $strutture[] = $id[$x]['id'];
                        }
                    }
                } else {
                    if (in_array($dati["user_type"], $users)) {
                        
                        // Modifica gennaio 2019 per permetter ad alcuni utenti di gestire più strutture
                        if($dati["user_unita"]) {
                            $tmp = explode(",",$dati["user_unita"]);
                            
                            /*if(count($tmp) > 0 ) {
                                for ($x = 0; $x < count($tmp); $x++)
                                    $strutture[] = $tmp[$x];
                            }*/

                            $strutture = array_merge($strutture, $tmp);
                        }
                    }
                    else if ($dati["user_type"] == 5) {
                       
                        $tmp  = Yii::app()->db->createCommand("SELECT DISTINCT(centro) FROM doc_unita WHERE id IN('".$dati["user_unita"]."')  ")->queryAll();
                        if(count($tmp)) {
                            for ($x = 0; $x < count($tmp); $x++)
                                $centri[] = $tmp[$x]['id'];
                        }
                       
                        if(count($centri)) {
                            $id = Yii::app()->db->createCommand("SELECT id FROM doc_unita WHERE centro IN ('".implode(",",$centri)."') ")->queryAll();
                            if(count($id)){
                            for ($x = 0; $x < count($id); $x++)
                                $strutture[] = $id[$x]['id'];
                            }
                        }
                        
                    } else {
                        $id = Yii::app()->db->createCommand("SELECT id FROM doc_unita  ")->queryAll();
                        if(count($id)){
                            for ($x = 0; $x < count($id); $x++)
                                $strutture[] = $id[$x]['id'];
                        }
                    }
                    break;
                }
        }

        return $strutture;
    }

    public function getDisplayStatus($status, $data = NULL, $ore = NULL) {
        $stato = "";
        if ($status == 'Y') {
            $stato = "<span class='badge badge-green newGreen'>SI</span>&nbsp;&nbsp;&nbsp;";
            if ($data)
                $stato .= "  Il:  " . $this->reverseDate($data);
            if ($ore)
                $stato .= " Alle: " . $ore;
        }
        else
            $stato = "<span class='badge badge-red newRed'>NO</span>";

        return $stato;
    }

    public function getYN($val) {
        $yn = "<i class='fa fa-ban alert-danger '></i>";
        if ($val == 'Y' || $val == '1')
            $yn = "<i class='fa alert-success fa-check-square-o'></i>";
        return $yn;
    }

    public function getStatsAzioni() {

        $stats = array();

        $year = "anno ='" . date("Y") . "'";
        $user = $this->getUserInfo();
        
        if (Yii::app()->user->getId() == 110)
            $AND = " AND unita_operativa IN ('19', '20', '21', '22')";
        else if ($user['typeUser'] != 'admin')
            $AND .= " AND unita_operativa IN (" .implode(",", $this->getUserStruttura()) . ")  ";
        else if($user['type_user'] =='3')
            $AND .= " AND unita_operativa ='".$user['user_unita']."' " ;


        $stats['NC_totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_nonconforme WHERE " . $year . " " . $AND . " ")->queryScalar();
        $stats['NC_positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_nonconforme WHERE chiusura ='1' AND " . $year . " " . $AND . " ")->queryScalar();
        $stats['AC_totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE tipo_azione ='1'  AND " . $year . " " . $AND . " ")->queryScalar();
        $stats['AC_positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE tipo_azione ='1'  AND " . $year . " " . $AND . " AND verifica_efficacia ='S' ")->queryScalar();
        $stats['AP_totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE tipo_azione ='2'  AND " . $year . " " . $AND . " ")->queryScalar();
        $stats['AP_positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE tipo_azione ='2'  AND " . $year . "  " . $AND . " AND verifica_efficacia ='S' ")->queryScalar();
        $stats['RC_totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami  WHERE " . $year . " " . $AND . " ")->queryScalar();
        $stats['RC_positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami  WHERE " . $year . " " . $AND . " ")->queryScalar();


        $unita = "unita_operativa";
        $query = "SELECT COUNT(t.id) as id_unita, t." . $unita . " as sede , s.nome FROM";
        $table = "db_nonconforme ";
        $left = " AS t LEFT JOIN doc_unita as s ON t." . $unita . "=s.id ";
        $group . " GROUP BY t." . $unita;


        $stats['NC_strutture'] = Yii::app()->db->createCommand($query . " db_nonconforme " . $left . " " . $group)->queryAll();
        $stats['AP_strutture'] = Yii::app()->db->createCommand($query . " db_azionicorrettive " . $left . " WHERE tipo_azione ='2'  AND " . $year . " " . $AND . " " . $group)->queryAll();
        $stats['AC_strutture'] = Yii::app()->db->createCommand($query . " db_azionicorrettive " . $left . " WHERE tipo_azione ='1'  AND " . $year . "  " . $AND . " " . $group)->queryAll();

        for ($x = 0; $x < count($stats['NC_strutture']); $x++)
            $stats['NC_strutture'][$x]['positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_nonconforme WHERE unita_operativa ='" . $stats['NC_strutture'][$x]['id_unita'] . "' AND chiusura ='1'  AND " . $year . " " . $AND . " ")->queryScalar();

        for ($x = 0; $x < count($stats['AP_strutture']); $x++)
            $stats['AP_strutture'][$x]['positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE unita_operativa ='" . $stats['AP_strutture'][$x]['id_unita'] . "' AND verifica_efficacia ='1' AND tipo_azione ='2'  AND " . $year . " " . $AND . " ")->queryScalar();

        for ($x = 0; $x < count($stats['AC_strutture']); $x++)
            $stats['AC_strutture'][$x]['positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE unita_operativa ='" . $stats['AC_strutture'][$x]['id_unita'] . "' AND verifica_efficacia ='1' AND tipo_azione ='1'  AND " . $year . " " . $AND . " ")->queryScalar();


        $unita = "unita_operativa ";
        $query = "SELECT COUNT(t.id) , t." . $unita . " , s.nome FROM";
        $table = "db_nonconforme ";
        $left = " AS t LEFT JOIN doc_unita as s ON t." . $unita . "=s.id  WHERE   " . $year . "";
        $group . " GROUP BY t." . $unita;

        $stats['RC_strutture'] = Yii::app()->db->createCommand($query . " db_reclami " . $left . "  " . $AND . "  " . $group)->queryAll();

        $stats['NC_negative'] = $stats['NC_totale'] - $stats['NC_positive'];
        $stats['AP_negative'] = $stats['AP_totale'] - $stats['AP_positive'];
        $stats['AC_negative'] = $stats['AC_totale'] - $stats['AC_positive'];
        $stats['RC_negative'] = $stats['RC_totale'] - $stats['RC_positive'];




        $stats['grafici_nc'] = array(
            "{label: 'Chiusura Positiva', value: " . $stats['NC_positive'] . "}", "{label: 'Chiusura Negativa', value: " . $stats['NC_negative'] . "}"
        );
        $stats['grafici_ap'] = array(
            "{label: 'Chiusura Positiva', value: " . $stats['AP_positive'] . "}", "{label: 'Chiusura Negativa', value: " . $stats['AP_negative'] . "}"
        );
        $stats['grafici_ac'] = array(
            "{label: 'Chiusura Positiva', value: " . $stats['AC_positive'] . "}", "{label: 'Chiusura Negativa', value: " . $stats['AC_negative'] . "}"
        );
        $stats['grafici_rc'] = array(
            "{label: 'Chiusura Positiva', value: " . $stats['RC_positive'] . "}", "{label: 'Chiusura Negativa', value: " . $stats['RC_negative'] . "}"
        );

        $strutture = Yii::app()->db->createCommand("SELECT id, nome ,codice FROM doc_unita ")->queryAll();
        ;

        $stats['grafici_unita'] = array();

        for ($x = 0; $x < count($strutture); $x++) {
            $NC = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_nonconforme WHERE unita_operativa ='" . $strutture[$x]['id'] . "'  AND " . $year . "  " . $AND . " ")->queryScalar();
            $AC = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE unita_operativa ='" . $strutture[$x]['id'] . "' AND tipo_azione ='2'  AND " . $year . " " . $AND . " ")->queryScalar();
            $AP = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive WHERE unita_operativa ='" . $strutture[$x]['id'] . "' AND tipo_azione ='1'  AND " . $year . " " . $AND . " ")->queryScalar();
            $RC = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami WHERE unita_operativa ='" . $strutture[$x]['id'] . "'  AND " . $year . "  ")->queryScalar();

            if ($RC > 0 || $NC > 0 || $AC > 0 || $AP > 0) {
                $stats['grafici_unita'][] = "{x: '" . $strutture[$x]['nome'] . "', y: '" . $strutture[$x]['nome'] . "', a: " . $NC . ", b:  " . $AC . " , c:  " . $AP . " , d:  " . $RC . " }";
            }
        }
        return $stats;
    }

    public function getYears() {
        for ($x = 2012; $x <= date("Y"); $x++) {
            $select[$x] = $x;
        }
        return $select;
    }

    public function getEta() {
        for ($x = 5; $x <= 17; $x++) {
            $select[$x] = $x;
        }
        return $select;
    }

    public function getTurni() {
        for ($x = 1; $x <= 4; $x++) {
            $select[$x] = $x;
        }
        return $select;
    }

    function getUserType($id) {
        $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . $id . "'")->queryScalar();
        if ($typeUser == '1' || $typeUser == '3' || $typeUser == '5' || $typeUser == '8' || $typeUser == '9' )
            $user = 'admin';
        else
            $user = 'user';

        return $user;
    }

    public function getUtenze($struttura, $anno, $tipo = NULL) {

        if ($tipo == 'gas')
            $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_gas WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        else if ($tipo == 'acqua')
            $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_acqua WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        else if ($tipo == 'luce')
            $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_luce WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        else if ($tipo == 'rifiuti')
            $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_rifiuti WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        else if ($tipo == 'chimici')
            $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_chimici WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();

        $utenze = Yii::app()->db->createCommand("SELECT * FROM utenze_presenze WHERE struttura ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        
        $superficie = Yii::app()->db->createCommand("SELECT superficie FROM doc_unita WHERE id ='" . $struttura . "' ")->queryScalar();
                
        if ($consumi ) {
            
            if($utenze){
                foreach ($utenze as $id => $val) {
                    $utenze[$id . '_costi'] = $consumi["c_" . $id];
                    if ($val > 0) {
                        $utenze[$id . '_costi'] = $consumi["c_" . $id];
                        $utenze[$id . '_media_consumi'] = $consumi[$id] / $utenze[$id];
                        $utenze[$id . '_media_costi'] = $consumi["c_" . $id] / $utenze[$id];
                        
                        $superficie > 0 ? $utenze[$id . '_media_superficie'] = $consumi["c_" . $id] / $superficie: $utenze[$id.'_media_superficie'] = 0;
                        $superficie > 0 ? $utenze[$id . '_media_superficie_unita'] = $consumi[$id] / $superficie : $utenze[$id.'_media_superficie_unita'] = 0;
                    } else {

                        $utenze[$id . '_media_consumi'] = 0;
                        $utenze[$id . '_media_costi'] = 0;
                        $utenze[$id . '_media_superficie'] = 0;
                        $utenze[$id . '_media_superficie_unita'] = 0;
                    }
                }
            }
        }
        
        #echo $superficie;
        #print_r($utenze);
        #exit();
        
        return $utenze;
    }

    public function getKTime($data, $day = NULL, $signe = NULL) {

        $d = explode("-", $data);
        if ($day)
            $x = $signe . "" . $day;

        echo $d[1] . " " . $d[2] . " " . $x . "  " . $d[0] . "<BR >";

        return mktime(0, 0, 0, $d[1], $d[2] . " " . $x, $d[0]);
    }

    public function getGruppi($table) {

        $gruppi = array();

        $id = Yii::app()->db->createCommand("SELECT DISTINCT(nome_gruppo) as gruppo FROM " . $table . "  WHERE nome_gruppo !=''  ORDER BY nome_gruppo ")->queryAll();
        for ($x = 0; $x < count($id); $x++)
            $gruppi[$id[$x]['gruppo']] = strtolower($id[$x]['gruppo']);

        return $gruppi;
    }

    public function getSoddisfazione() {

        $smile = array();

        $punteggi = array("P" => 25, "A" => 50, "M" => 100);

        $field = array(
            "junior" => array('divertimento', 'educatori', 'compagni', 'giochi', 'attivita_sportive', 'gite', 'laboratori'),
            "senior" => array('divertimento', 'educatori', 'compagni', 'giochi', 'attivita_sportive', 'gite', 'laboratori'),
            "studio" => array('divertimento', 'educatori', 'compagni', 'giochi', 'attivita_sportive', 'gite', 'laboratori', 'studio_localita', 'studio_college', 'studio_corso'),
            "scientifici" => array('divertimento', 'educatori', 'compagni', 'giochi', 'attivita_sportive', 'gite', 'laboratori', 'scientifici_organizzazione', 'scientifici_didattica', 'scientifici_formazione'),
        );

        foreach ($field As $id => $val) {
            $smile[$id]['percentuale'] = 0;
            $smile[$id]['totale'] = 0;
            $smile[$id]['quanti'] = 0;

            $gruppi = Yii::app()->db->createCommand("SELECT DISTINCT(nome_gruppo) as gruppo FROM questionario_" . $id . " WHERE nome_gruppo !='' ")->queryAll();
            $smile[$id]['quanti'] = count($val);

            for ($x = 0; $x < count($gruppi); $x++) {

                $smile[$id][$gruppi[$x]['gruppo']]['totale'] = Yii::app()->db->createCommand(" SELECT COUNT(id) as totale FROM questionario_" . $id . "  WHERE nome_gruppo ='" . addslashes($gruppi[$x]['gruppo']) . "'")->queryScalar();
                $smile[$id][$gruppi[$x]['gruppo']]['punteggio'] = 0;
                $smile[$id]['totale'] = $smile[$id]['totale'] + $smile[$id][$gruppi[$x]['gruppo']]['totale'];


                foreach ($val As $campo) {

                    foreach ($punteggi as $giudizzio => $punteggio) {
                        $query = "SELECT COUNT(id) as totale FROM questionario_" . $id . "  WHERE nome_gruppo ='" . addslashes($gruppi[$x]['gruppo']) . "' AND " . $campo . "= '" . $giudizzio . "' ";
                        $punti = Yii::app()->db->createCommand($query)->queryScalar();
                        $smile[$id][$gruppi[$x]['gruppo']]['punteggio'] = $smile[$id][$gruppi[$x]['gruppo']]['punteggio'] + ($punti * $punteggio);
                        $smile[$id]['punteggio'] = $smile[$id]['punteggio'] + ($punti * $punteggio);
                    }
                }
                $smile[$id][$gruppi[$x]['gruppo']]['percentuale'] = number_format($smile[$id][$gruppi[$x]['gruppo']]['punteggio'] / ( $smile[$id][$gruppi[$x]['gruppo']]['totale'] * count($val) ), 0);
            }

            $smile[$id]['percentuale'] = number_format($smile[$id]['punteggio'] / ( $smile[$id]['totale'] * $smile[$id]['quanti'] ), 0);
        }
        return $smile;
    }
	
	public function getGestioni($gestione){
		$strutture = array();
		$dati =  Yii::app()->db->createCommand("SELECT id FROM doc_unita WHERE tipologia ='".$gestione."' ")->queryAll() ;
		for($x=0; $x < count($dati); $x++)
			$strutture[] = $dati[$x]['id'];
			
		return $strutture ;
		
	}
    
    public function getDataFromDays($data, $giorni){
        return date("d-m-Y" ,strtotime("- ".$giorni." days", strtotime($data)));
    }
    
    function getjavascriptDate($date) {
        $data = explode("-", $date);
        return date("Y-m-d", mktime(0, 0, 0, $data[1] - 1, $data[2], $data[0]));
    }
        
    function getMediaConsumi($struttura,$table,$anno,$tipo = NULL){
        
        $totale         = 0;
        $totaleUtenze   = 0;
        
        $mesi = array("gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre","ottobre","novembre","dicembre");
        
        $utenze = Yii::app()->db->createCommand("SELECT * FROM utenze_presenze WHERE struttura = '".$struttura."' AND anno ='".$anno."' ")->queryRow();
        
        $consumi = Yii::app()->db->createCommand("SELECT * FROM ".$table." WHERE struttura = '".$struttura . "' AND anno = '".$anno."'")->queryRow();
        
        $superficie = Yii::app()->db->createCommand("SELECT superficie FROM doc_unita WHERE id = '".$struttura . "' ")->queryScalar();
        
        
        foreach($mesi As $val){
            
            if($tipo =='consumo'){
                if($consumi[$val] > 0){
                    $totaleUtenze  = $totaleUtenze + $utenze[$val];
                    $totale  = $totale  + $consumi[$val];
                }
            }else if($tipo =='superficie'){
                $totaleUtenze  = $superficie;
                $totale  = $totale  + $consumi["c_".$val];
            }
            else if($tipo =='superficie_unita'){
                $totaleUtenze  = $superficie;
                $totale  = $totale  + $consumi[$val];
            }
            else{
                if($consumi["c_".$val] > 0){
                     $totaleUtenze  = $totaleUtenze + $utenze[$val];
                     $totale  = $totale  + $consumi["c_".$val];
                }
            }
        }
        
        if ($totaleUtenze > 0)
            return number_format($totale / $totaleUtenze, 2, '.', '');
        else
            return "0";
        
    }
    
    function getDatiQuestionario($table){
        
        $dati = array();
        
        switch($table){
            case"questionario_formazione":
                $dati['giudizzi'] = array('corso','giudizio','conduzione','spazi','livello');    
                $dati['struttura'] ='tipo_corso';
                $dati['consiglia'] = 'Y';
                $dati['valori']     =  array("I","S","B","E");
            break;    
                
            case"questionario_keluar":
                $dati['giudizzi'] = array('viaggio_complessivo','struttura_complessivo','rapporto_keluar','trasporto_qualita', 'trasporto_cortesia','trasporto_tempi','ristorante_servizio','ristorante_cibo','ristorante_menu', 'personale_cortesia','personale_disponibilita','escursioni_itinerari','escursioni_guida','neve_noleggio','neve_scuola','laboratori_tecnici','laboratori_competenze');    
                $dati['struttura'] ='struttura_nome';
                $dati['consiglia'] = 'Y';
                $dati['valori']     =  array("I","S","B","E");
            break; 
            case"questionario_doc":
                $dati['giudizzi'] = array('vacanza','struttura_pulizia','struttura_complessivo','stanza_confort','stanza_arredi','stanza_pulizia','stanza_complessivo','ristorante_servizio','ristorante_attesa','ristorante_cibo','ristorante_menu', 'ristorante_complessivo', 'personale_cortesia','personale_professionalita', 'personale_complessivo');    
                $dati['struttura'] ='struttura_nome';
                $dati['consiglia'] = 'Y';
                $dati['valori']     =  array("I","S","B","E");
            break; 
                
            case"questionario_sharing":
                $dati['giudizzi']   = array('vacanza','struttura_pulizia','struttura_complessivo','stanza_confort','stanza_arredi','stanza_pulizia','stanza_complessivo','ristorante_servizio','ristorante_attesa','ristorante_cibo','ristorante_menu','ristorante_complessivo','personale_cortesia','personale_professionalita','personale_complessivo');    
                $dati['struttura']  ='soggiorno';
                $dati['consiglia']  = 'Y';
                $dati['valori']     =  array("I","S","B","E");
                break; 
            case"questionario_studio":
            case 3:
                //$dati['giudizzi'] = array('divertimento','educatori','compagni','giochi','attivita_sportive','gite','laboratori','escursioni','soggiorno_esperienza','soggiorno_staff','soggiorno_communicazione','soggiorno_complessivo','studio_localita','studio_college','studio_attivita','studio_corso','studio_escursioni','studio_divertimento',);    
                $dati['giudizzi'] = array('divertimento','educatori','compagni','giochi','attivita_sportive','gite','laboratori','studio_localita','studio_college','studio_corso', 'studio_escursioni', 'studio_divertimento', 'studio_involvement');    
                $dati['struttura'] ='soggiorno';
                $dati['consiglia'] = 'N';
                $dati['valori']     =  array("P","A","M");
                break; 
            case"questionario_scientifici":
            case 4:
                $dati['giudizzi'] = array('divertimento','educatori', 'compagni','giochi','attivita_sportive', 'gite', 'laboratori', 'scientifici_organizzazione','scientifici_didattica', 'scientifici_formazione', 'scientifici_school_subject', 'scientifici_modules_liked', 'scientifici_involvement');
                $dati['struttura'] ='soggiorno';
                $dati['consiglia'] = 'N';
                $dati['valori']     =  array("P","A","M");
                break;
            case"questionario_junior":
            case"questionario_senior":
            case 'survey_stays':
            case 1:
            case 2:
                $dati['giudizzi']  = array('divertimento','educatori', 'compagni','giochi','attivita_sportive', 'gite', 'laboratori');
                $dati['struttura'] ='soggiorno';
                $dati['consiglia'] = 'N';
                $dati['valori']    =  array("P","A","M");
                break;
            case 'questionario_sport':
            case 5:
                $dati['giudizzi']  = array('divertimento','educatori', 'compagni','giochi','attivita_sportive', 'gite', 'laboratori','sport_organization','sport_involvement');
                $dati['struttura'] ='soggiorno';
                $dati['consiglia'] = 'N';
                $dati['valori']    =  array("P","A","M");
                break;
        }
        
        return $dati ;
        
    }
    
     function getLabelQuestionario($id){
        
         $label = array(
            'viaggio_complessivo'=>'Viaggio_complessivo',
            'struttura_complessivo'=>'Struttura_complessivo',
            'rapporto_keluar'=>'Rapporto_keluar',
            'trasporto_qualita'=>'Trasporto_qualita',
            'trasporto_cortesia'=>'trasporto_cortesia',
            'trasporto_tempi'=>'trasporto_tempi',
            'ristorante_servizio'=>'ristorante_servizio',
            'ristorante_cibo'=>'ristorante_cibo',
            'ristorante_menu'=>'ristorante_menu',
            'personale_cortesia'=>'personale_cortesia',
            'personale_disponibilita'=>'personale_disponibilita',
            'escursioni_itinerari'=>'escursioni_itinerari',
            'escursioni_guida'=>'escursioni_guida',
            'neve_noleggio'=>'neve_noleggio',
            'neve_scuola'=>'neve_scuola',
            'laboratori_tecnici'=>'laboratori_tecnici',
            'laboratori_competenze'=>'laboratori_competenze',
            'vacanza'=>'vacanza',
            'struttura_pulizia'=>'struttura_pulizia',
            'stanza_confort'=>'stanza_confort',
            'stanza_arredi'=>'stanza_arredi',
            'stanza_pulizia'=>'stanza_pulizia',
            'stanza_complessivo'=>'stanza_complessivo',
            'ristorante_attesa'=>'ristorante_attesa',
            'ristorante_complessivo'=>'ristorante_complessivo',
            'personale_professionalita'=>'personale_professionalita',
            'personale_complessivo'=>'personale_complessivo',
            'divertimento'=>'Ti sei divertito durante il soggiorno?',
            'educatori'=>'Gli animatori ti sono piaciuti ?',
            'compagni'=>'Ti sei trovato bene con i compagni del soggiorno ?',
            'giochi'=>'Le attività sono state divertenti?',
            'attivita_sportive'=>'Le attività sportive sono state ben organizzate?',
            'gite'=>'Le gite e le escursioni sono state interessanti?',
            'laboratori'=>'Ti sono piaciuti i laboratori?',
            'escursioni'=>'escursioni',
            'soggiorno_esperienza'=>'soggiorno_esperienza',
            'soggiorno_staff'=>'soggiorno_staff',
            'soggiorno_communicazione'=>'soggiorno_communicazione',
            'soggiorno_complessivo'=>'soggiorno_complessivo',
            'studio_localita'=>'Ti è piaciuta la località in cui si è svolta la vacanza studio?',
            'studio_college'=>'Ti è piaciuto il college/la struttura alberghiera presso cui si è svolta la vacanza studio?',
            'studio_attivita'=>'studio_attivita',
            'studio_corso'=>'Valuti positivamente il corso di inglese che ti è stato proposto?',
            'studio_escursioni'=>'studio_escursioni',
            'studio_divertimento'=>'studio_divertimento',
            'scientifici_organizzazione' =>'I corsi del campus formativo, ti sono sembrati ben organizzati?',
            'scientifici_didattica'  => 'Dal punto di vista didattico, sei soddisfatto dei corsi che hai frequentato?',
            'scientifici_formazione' => 'Il soggiorno è stato utile alla tua formazione?'
                
             
             
             
         );
         
         
         return $label[$id];
         
    
     }
}
?>