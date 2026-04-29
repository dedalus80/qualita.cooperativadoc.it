<?

class MyStats extends CApplicationComponent {

    public function getAllScadenze() {

        $mesi = array();
        $query = " SELECT * ,DATE_FORMAT(data,'%w')as giorno ,DATE_FORMAT(data,'%d')as day , DATE_FORMAT(data,'%m')as mese ,DATE_FORMAT(data,'%Y')as anno FROM  0_update WHERE 1 ORDER BY data DESC";
        $mesi = Yii::app()->db->createCommand($query)->queryAll();
        for ($x = 0; $x < count($mesi); $x++) {
            $mesi[$x]['mount'] = Yii::app()->MyUtils->getMount($mesi[$x]['mese']);
            $mesi[$x]['update-date'] = Yii::app()->MyUtils->getDay($mesi[$x]['giorno']) . " " . $mesi[$x]['day'] . " " . Yii::app()->MyUtils->getMount($mesi[$x]['mese']) . " " . $mesi[$x]['anno'];

            if ($mesi[$x]['id'] == '5')
                $mesi[$x]['stato'] = 'activity-warning';
            else
                $mesi[$x]['data'] <= date("Y") . "-" . date("m") . "-" . date("d") ? $mesi[$x]['stato'] = 'activity-success' : $mesi[$x]['stato'] = 'activity-tmp';
        }
        return $mesi;
    }

    public function getScadenze() {

        $scadenze = array();
        $mesi = Yii::app()->db->createCommand("SELECT DISTINCT(DATE_FORMAT(data,'%m-%Y')) as mese_anno , DATE_FORMAT(data,'%m') as mese , DATE_FORMAT(data,'%Y') as anno FROM 0_update WHERE data <='" . date("Y") . "-" . date("m") . "-" . date("d") . "'  ORDER BY data DESC")->queryAll();
        for ($x = 0; $x < count($mesi); $x++) {
            $mesi[$x]['mount'] = Yii::app()->MyUtils->getMount($mesi[$x]['mese']);
            $query = "SELECT * ,DATE_FORMAT(data,'%w')as giorno ,DATE_FORMAT(data,'%d')as day , DATE_FORMAT(data,'%m')as mese ,DATE_FORMAT(data,'%Y')as anno FROM  0_update WHERE DATE_FORMAT(data,'%m-%Y') ='" . $mesi[$x]['mese_anno'] . "' AND data <='" . date("Y") . "-" . date("m") . "-" . date("d") . "'  ORDER BY data DESC";
            $mesi[$x]['update'] = Yii::app()->db->createCommand($query)->queryAll();
        }

        $scadenze = $mesi;
        return $scadenze;
    }
    
    public function getCounter() {
        
        $WHERE = " WHERE anno ='" . date("Y") . "' ";
        
        Yii::app()->MyUtils->getMenuPermition('approvato') ?  $WHERE .= " AND approvato ='Y' ":"";
        
        !Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $ANDFOR = " AND id IN(".implode(",",Yii::app()->MyUtils->getIdFormazione()).")" :"";
	
        
        $AND = " AND unita_operativa IN (" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";

		$user = Yii::app()->MyUtils->getUserInfo() ;
		
		if($user['user_type'] =='7') {
			$ids = Yii::app()->MyUtils->getIncaricatiVerifica() ;
			$ANDVERIFICA =  " AND id IN(" . implode(",", $ids) . ")";
			$ANDVERIFICA_ID =  " AND id_verifica IN(" . implode(",", $ids) . ")";
		}
        else if($user['user_type'] == '3') {
            //$ANDQ = " AND soggiorno ='".$user['user_unita']."' ";
            $ANDQ = " AND soggiorno IN (".implode(',', Yii::app()->user->getState('strutture')).")";
            $ANDK = " AND struttura_nome ='".$user['user_unita']."' ";
            $ANDVERIFICA = $AND;
        }
        else {
			$ANDVERIFICA = $ANDVERIFICA_ID = $AND;
        }
		
        $counter['nonconformi'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_nonconforme " . $WHERE . "  " . $AND . "  ")->queryScalar();
        $counter['preventive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_azionicorrettive " . $WHERE . " " . $AND . "  ")->queryScalar();
        $counter['reclami'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami  " . $WHERE . "  " . $AND . "  ")->queryScalar();
        $counter['azioni'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_reclami_azioni    " . $WHERE . "  " . $AND . "  ")->queryScalar();
        $counter['verifiche'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche " . $WHERE . " ".$ANDVERIFICA )->queryScalar();
        $counter['verifiche_processi'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche " . $WHERE . " ".$ANDVERIFICA." AND tipo_verifica ='8' " )->queryScalar();
        $counter['verifiche_esterne'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_verifiche " . $WHERE . " ".$ANDVERIFICA." AND tipo_verifica ='6'" )->queryScalar();
        $counter['verifiche_amministrative'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_amministrative " . $WHERE . "    ".$ANDVERIFICA_ID)->queryScalar();
        $counter['verifiche_sicurezza'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_sicurezza " . $WHERE . "    ".$ANDVERIFICA_ID)->queryScalar();
        $counter['verifiche_manutenzione'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_manutenzione " . $WHERE . "   ".$ANDVERIFICA_ID)->queryScalar();
        $counter['verifiche_ristorazione'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_ristorazione " . $WHERE . "   ".$ANDVERIFICA_ID)->queryScalar();
        $counter['verifiche_educazione'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_educazione " . $WHERE . "    ".$ANDVERIFICA_ID)->queryScalar();
        $counter['verifiche_educative'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_educative " . $WHERE . "    ".$ANDVERIFICA_ID)->queryScalar();
		$counter['verifiche_ambiente'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM  db_verifiche_ambientale " . $WHERE . "   ".$ANDVERIFICA_ID)->queryScalar();
        
        $counter['q_doc'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_doc ".$WHERE." ".$ANDV)->queryScalar();
        $counter['q_keluar'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_keluar ".$WHERE." ".$ANDK)->queryScalar();
        $counter['q_sharing'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_sharing ".$WHERE." ".$ANDQ)->queryScalar();
        $counter['q_formazione'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_formazione ".$WHERE)->queryScalar();
        $counter['q_senior'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM survey_stays  ".$WHERE." ".$ANDQ." AND tipologia_id = 2")->queryScalar();
        $counter['q_junior'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM survey_stays  ".$WHERE." ".$ANDQ." AND tipologia_id = 1")->queryScalar();
        $counter['q_studio'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM survey_stays  ".$WHERE." ".$ANDQ." AND tipologia_id = 3")->queryScalar();
        $counter['q_scientifici'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM survey_stays ".$WHERE." ".$ANDQ." AND tipologia_id = 4")->queryScalar();
        $counter['q_sport'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM survey_stays ".$WHERE." ".$ANDQ." AND tipologia_id = 5")->queryScalar();
        $counter['q_gsenior'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_genitori_senior ".$WHERE." ".$ANDQ)->queryScalar();
        $counter['q_gjunior'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_genitori_junior ".$WHERE." ".$ANDQ)->queryScalar();
        $counter['q_gstudio'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_genitori_studio ".$WHERE." ".$ANDQ)->queryScalar();
        $counter['q_gscientifici'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_genitori_scientifici ".$WHERE." ".$ANDQ)->queryScalar();
        $counter['q_vacanza'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM un_questionario ".$WHERE)->queryScalar();
        $counter['q_torremarina'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_torremarina ".$WHERE)->queryScalar();
        
        $counter['is_sharing'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM sh_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_campus'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM ca_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_stessopiano'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM sp_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_scuola'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM sn_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_comune'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM cm_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_fossata'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM fo_preiscrizioni ".$WHERE."")->queryScalar();
        $counter['is_tim'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM tim_preiscrizioni   ")->queryScalar();
        
        
        $counter['formazione'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_formazione  WHERE anno ='" . date("Y") . "' ".$ANDFOR."  ")->queryScalar();

        return $counter;
    }
    
    public function getStatsAzioni($anno = null)
    {
        $stats     = array();
        //$strutture      = Yii::app()->MyUtils->getUserStruttura();
        $strutture = Yii::app()->user->getState('strutture');
        
        /*if(count($strutture) > 1)
            $stats['admin']     = "Y" ;
        else if(count($strutture) == '1'){
            $stats['admin']     = 'N' ;
            $struttura          = $strutture[0];
            $stats['struttura'] = Yii::app()->db->createCommand("SELECT  u.nome as nome , c.colore , u.id FROM doc_unita AS u LEFT JOIN doc_colori AS c  ON u.colore = c.id WHERE u.id ='".$struttura."'" )->queryRow();
        }*/

        if(Yii::app()->user->getState('group') == 'ADMIN') {
            $sql_where = "";
        }
        else {
            $sql_where = "AND a.unita_operativa IN (".implode(',', $strutture).")";
        }
        
        $azioni = array(
            "NC" => array("tabella"=>"db_nonconforme","totale"=>"" ,"positive" =>"AND a.chiusura ='1'"), 
            "AC" => array("tabella"=>"db_azionicorrettive","totale"=>"AND a.tipo_azione ='1' ","positive" => "AND a.tipo_azione ='1'  AND a.verifica_efficacia ='S' "), 
            "AP" => array("tabella"=>"db_azionicorrettive","totale"=>"AND a.tipo_azione ='2'", "positive" => "AND a.tipo_azione ='2'  AND a.verifica_efficacia ='S' "), 
            "R"  => array("tabella"=>"db_reclami","totale"=>"", "positive" => ""), 
        );
        
        $query = "SELECT COUNT(a.id) as totale , u.nome as nome  , a.unita_operativa , c.colore as colore FROM [TABELLA] AS a 
                    LEFT JOIN doc_unita AS u  ON a.unita_operativa = u.id  
                    LEFT JOIN doc_colori AS c  ON u.colore = c.id  
                    WHERE 1 [AND] AND a.anno ='".$anno."' $sql_where GROUP BY a.unita_operativa ";
                
        
        foreach($azioni AS $id => $val) {
            /*if($struttura ) {
                $stats['strutture_'.$id]  = 0;
                
                $anni = Yii::app()->db->createCommand("SELECT DISTINCT(anno) FROM ".$azioni[$id]['tabella']." AS a WHERE 1 ".$azioni[$id]['totale']." AND unita_operativa ='".$struttura."' ORDER BY anno ")->queryAll();
                if($anni){
                    $stats['strutture'][$id] = array();
                    for($x = 0 ; $x < count($anni); $x++){
                        
                        $tmp = Yii::app()->db->createCommand("SELECT COUNT(id) FROM ".$azioni[$id]['tabella']." AS a WHERE a.anno ='".$anni[$x]['anno']."' ".$azioni[$id]['totale']." AND a.unita_operativa ='".$struttura."' ")->queryScalar();
                        
                        $stats['anni'][$id][]       = "'".$anni[$x]['anno']."'";
                        $stats['strutture'][$id][]  = $tmp;
                        $stats['strutture_'.$id]    = $stats['strutture_'.$id]  + $tmp;
                    
                    }
                }
            }
            else {*/
                $q = str_replace("[TABELLA]", $azioni[$id]['tabella'], $query );
                $stats['generali'][$id] = Yii::app()->db->createCommand(str_replace("[AND]", $azioni[$id]['totale'], $q ))->queryAll() ;
                $stats['generali_'.$id]  = Yii::app()->db->createCommand("SELECT COUNT(id) FROM ".$azioni[$id]['tabella']." AS a WHERE 1 ".$sql_where." AND a.anno ='".$anno."' ".$azioni[$id]['totale'])->queryScalar();
            //}
        }
                
        return $stats;
        
    }
        
    public function getUtenze($struttura, $anno, $tipo = NULL) {

        $consumi = Yii::app()->db->createCommand("SELECT * FROM utenze_" . $tipo . " WHERE unita_operativa ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        $utenze = Yii::app()->db->createCommand("SELECT * FROM utenze_presenze WHERE unita_operativa ='" . $struttura . "' AND anno ='" . $anno . "'  ")->queryRow();
        if ($consumi) {
            foreach ($utenze as $id => $val) {
                $utenze[$id . '_costi'] = $consumi["c_" . $id];
                if ($val > 0) {
                    $utenze[$id . '_costi'] = $consumi["c_" . $id];
                    $utenze[$id . '_media_consumi'] = $consumi[$id] / $utenze[$id];
                    $utenze[$id . '_media_costi'] = $consumi["c_" . $id] / $utenze[$id];
                } else {

                    $utenze[$id . '_media_consumi'] = 0;
                    $utenze[$id . '_media_costi'] = 0;
                }
            }
        }
        return $utenze;
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

    function getAnd($GET) {

        $AND = "";
        $strutture = Yii::app()->MyUtils->getUserStruttura();
        if (count($strutture) > 0)
            $AND = $GET . " unita_operativa IN (" . implode(",", $strutture) . " )   AND anno ='".date("Y")."'";
        return $AND;
    }

    function getTotali($table, $struttura = NULL, $tipologia = NULL) {

        $WHERE = " WHERE anno = '" . date("Y") . "' AND unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ") ";

        if ($struttura)
            $WHERE .= " AND unita_operativa ='" . $struttura . "' ";
        if ($tipologia)
            $WHERE .= " AND tipologia = '" . $tipologia . "' ";
        else
            $WHERE.= " AND tipologia != '' ";

        $totali = array();
        $totali['totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE)->queryScalar();
        $totali['positive'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND chiusura ='1' ")->queryScalar();
        $totali['negative'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND chiusura ='0' ")->queryScalar();
        $totali['chiuse'] = $totali['positive'] + $totali['negative'];
        $totali['da_chiudere'] = $totali['totale'] - $totali['chiuse'];

        $totali['per_chiuse'] = Yii::app()->MyUtils->getPercent($totali['chiuse'], $totali['totale']);
        $totali['per_chiuse_positive'] = Yii::app()->MyUtils->getPercent($totali['positive'], $totali['chiuse']);
        $totali['per_chiuse_negative'] = Yii::app()->MyUtils->getPercent($totali['negative'], $totali['chiuse']);

        foreach ($totali AS $id => $val)
            $val == 0 ? $totali[$id] = '' : '';

        $totali['color_per_chiuse'] = Yii::app()->MyUtils->getColor($totali['color_per_chiuse']);
        $totali['color_per_chiuse_positive'] = Yii::app()->MyUtils->getColor($totali['per_chiuse_positive'], "positive");
        $totali['color_per_chiuse_negative'] = Yii::app()->MyUtils->getColor($totali['per_chiuse_negative']);

        return $totali;
    }

    function setIndicatoriStrutture($tipo) {

        switch ($tipo) {
            case"NC":
                $table = "db_nonconforme";
                break;
            case"AC":
                $table = "db_azionicorrettive";
                break;
        }


        $indicatori = array();
        $indicatori['totali'] = $this->getTotali($table);
        $dati = Yii::app()->db->createCommand("SELECT DISTINCT(unita_operativa) FROM " . $table . " " . $this->getAnd("WHERE") . " ")->queryAll();
               
        
        for ($x = 0; $x < count($dati); $x++) {
            $indicatori['strutture'][$x]['indicatori'] = $this->getTotali($table, $dati[$x]['unita_operativa'], '');
            $indicatori['strutture'][$x]['nome'] = Yii::app()->MyUtils->getSelectValue($dati[$x]['unita_operativa'], "doc_unita");
        }
        return $indicatori;
    }

    function setIndicatoriTipologie($tipo) {

        switch ($tipo) {
            case"NC":
                $table = "db_nonconforme";
                break;
            case"AC":
                $table = "db_azionicorrettive";
                break;
        }
        $indicatori = array();
        $indicatori['totali'] = $this->getTotali($table);
        $dati = Yii::app()->db->createCommand("SELECT DISTINCT(tipologia) FROM " . $table . " WHERE 1 " . $this->getAnd("AND") . " AND tipologia !=''  ")->queryAll();
        
        
        for ($x = 0; $x < count($dati); $x++) {
            $indicatori['tipologie'][$x]['indicatori'] = $this->getTotali($table, '', $dati[$x]['tipologia']);
            $indicatori['tipologie'][$x]['nome'] = Yii::app()->MyUtils->getSelectValue($dati[$x]['tipologia'], "doc_tipologie_aperture");
        }
        return $indicatori;
    }

    function getIndicatoriVerifiche($table, $struttura = NULL) {

        $WHERE = " WHERE anno ='" . date("Y") . "' AND unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ") ";
        if ($struttura)
            $WHERE .= " AND unita_operativa ='" . $struttura . "'";

        $totali = array();
        $totali['totale'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE)->queryScalar();
        $totali['am_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND  completa ='Y'  AND tipo_verifica ='24' ")->queryScalar();
        $totali['am_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='24' ")->queryScalar();
        $totali['si_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='19'  ")->queryScalar();
        $totali['si_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='19' ")->queryScalar();
        $totali['pe_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='20'  ")->queryScalar();
        $totali['pe_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='20' ")->queryScalar();
        $totali['ri_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='18'  ")->queryScalar();
        $totali['ri_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='18' ")->queryScalar();
        $totali['pu_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='5'  ")->queryScalar();
        $totali['pu_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='5' ")->queryScalar();
        $totali['ab_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='13'  ")->queryScalar();
        $totali['ab_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='13' ")->queryScalar();
        $totali['es_complete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa ='Y'  AND tipo_verifica ='6'  ")->queryScalar();
        $totali['es_noncomplete'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $table . " " . $WHERE . " AND completa !='Y'  AND tipo_verifica ='6' ")->queryScalar();
		
        foreach ($totali AS $id => $val)
            $val == 0 ? $totali[$id] = '' : '';
        return $totali;
    }

    function setIndicatoriVerifiche() {

        $table = "db_verifiche";
        $indicatori = array();
        $indicatori['totali'] = $this->getIndicatoriVerifiche($table);
        $dati = Yii::app()->db->createCommand("SELECT DISTINCT(unita_operativa) FROM " . $table . " " . $this->getAnd("WHERE") . "  ")->queryAll();
        for ($x = 0; $x < count($dati); $x++) {
            $indicatori['strutture'][$x]['indicatori'] = $this->getIndicatoriVerifiche($table, $dati[$x]['unita_operativa']);
            $indicatori['strutture'][$x]['nome'] = Yii::app()->MyUtils->getSelectValue($dati[$x]['unita_operativa'], "doc_unita");
        }
        return $indicatori;
    }

    public function getStats() {


        $stats = array();
        $whereStruttura = "";
        $stats['centri'] = array();
        $stats['turni'] = array();
        $stats['societa'] = array();

        $WHERE = " WHERE anno ='" . date("Y") . "'  AND unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        $WHERESTRUTTURA = " WHERE id IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";

        $stats['totali']['clienti'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM utenti " . $WHERE . " ")->queryScalar();
        $stats['totali']['schede'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie  " . $WHERE . " ")->queryScalar();
        $stats['totali']['rientri'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM utenti_rientri_anticipati  " . $WHERE . " ")->queryScalar();

        $stats['totali']['clienti_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['clienti'], $stats['totali']['clienti']);
        $stats['totali']['schede_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['schede'], $stats['totali']['clienti']);
        $stats['totali']['rientri_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['rientri'], $stats['totali']['clienti']);

        /*
          $stats['totali']['ricoveri_ospedale'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM clienti_ricoveri_ospedale  " . $where . "")->queryScalar();
          $stats['totali']['ricoveri_infermeria'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM clienti_ricoveri_infermeria  " . $where . " ")->queryScalar();
          $stats['totali']['infortuni'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM clienti_infortuni  " . $where . " ")->queryScalar();
          $stats['totali']['ricoveri_infermeria_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['clienti'], $stats['totali']['ricoveri_infermeria']);
          $stats['totali']['ricoveri_ospedale_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['clienti'], $stats['totali']['ricoveri_ospedale']);
          $stats['totali']['infortuni_percent'] = Yii::app()->MyUtils->getPercent($stats['totali']['clienti'], $stats['totali']['infortuni']);
         */

        $stats['tipologie']['junior'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti " . $WHERE . " AND tipologia ='1'  ")->queryScalar();
        $stats['tipologie']['senior'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti " . $WHERE . " AND tipologia ='2'  ")->queryScalar();

        $turni = Yii::app()->db->createCommand("SELECT id, nome  FROM utenti_turni ")->queryAll();
        for ($x = 0; $x < count($turni); $x++)
            $stats['turni'][] = "{label: '" . $turni[$x]['nome'] . "', value: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti " . $WHERE . " AND turno ='" . $turni[$x]['id'] . "'    ")->queryScalar() . "}";

        $centri = Yii::app()->db->createCommand("SELECT id, nome  FROM qualita_strutture  " . $WHERESTRUTTURA . "   ")->queryAll();
        for ($x = 0; $x < count($centri); $x++) {
            $tot[$x] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti " . $WHERE . " AND unita_operativa ='" . $centri[$x]['id'] . "'  ")->queryScalar();
            if ($tot[$x] > 0)
                $stats['centri'][] = "{label: '" . $centri[$x]['nome'] . "', value: " . $tot[$x] . "}";
        }

        $societa = Yii::app()->db->createCommand("SELECT id, nome  FROM qualita_societa ")->queryAll();
        for ($x = 0; $x < count($societa); $x++) {
            $tot[$x] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti " . $WHERE . " AND societa ='" . $societa[$x]['id'] . "'   ")->queryScalar();
            if ($tot[$x] > 0)
                $stats['societa'][] = "{label: '" . $societa[$x]['nome'] . "', value: " . $tot[$x] . "}";
        }

        $pregresse = $this->getFields("pregresse");
        for ($x = 0; $x < count($pregresse['fields']); $x++)
            $stats['pregresse'][] = "{ y: '" . $pregresse['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $pregresse['fields'][$x] . " ='Y'   ")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $pregresse['fields'][$x] . " ='N' ")->queryScalar() . " }";

        $inatto = $this->getFields("inatto");
        for ($x = 0; $x < count($inatto['fields']); $x++)
            $stats['inatto'][] = "{ y: '" . $inatto['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $inatto['fields'][$x] . " ='Y'   ")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $inatto['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        $vacinazioni = $this->getFields("vacinazioni");
        for ($x = 0; $x < count($vacinazioni['fields']); $x++)
            $stats['vacinazioni'][] = "{ y: '" . $vacinazioni['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $vacinazioni['fields'][$x] . " ='Y'    ")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $vacinazioni['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        $notizie_portatore = $this->getFields("notizie_portatore");
        for ($x = 0; $x < count($notizie_portatore['fields']); $x++)
            $stats['notizie_portatore'][] = "{ y: '" . $notizie_portatore['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $notizie_portatore['fields'][$x] . " ='Y'  ")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $notizie_portatore['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        $notizie_soggetto = $this->getFields("notizie_soggetto");
        for ($x = 0; $x < count($notizie_soggetto['fields']); $x++)
            $stats['notizie_soggetto'][] = "{ y: '" . $notizie_soggetto['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $notizie_soggetto['fields'][$x] . " ='Y'")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $notizie_soggetto['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        $allergie = $this->getFields("allergie");
        for ($x = 0; $x < count($allergie['fields']); $x++)
            $stats['allergie'][] = "{ y: '" . $allergie['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $allergie['fields'][$x] . " ='Y'")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $allergie['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        $segnalazioni = $this->getFields("segnalazioni");
        for ($x = 0; $x < count($segnalazioni['fields']); $x++)
            $stats['segnalazioni'][] = "{ y: '" . $segnalazioni['labels'][$x] . "', a: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND " . $segnalazioni['fields'][$x] . " ='Y'")->queryScalar() . ", b: " . Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie " . $WHERE . " AND  " . $segnalazioni['fields'][$x] . " ='N'  ")->queryScalar() . " }";

        return $stats;
    }

    public function getFields($fields) {


        $data = array(
            'pregresse' => array(
                'fields' => array("pre_morbillo", "pre_rosalia", "pre_nefrite", "pre_convulsioni_febbrili", "pre_parotite", "pre_varicella", "pre_asma_bronchiale", "pre_epilessia", "pre_pertosse", "pre_scarlattina", "pre_malattia_reumatica"),
                'labels' => array("Morbillo", "Rosalia", "Nefrite", "Convulsioni febbrili", "Parotite", "Varicella", "Asma Bronchiale", "Epilessia", "Pertosse", "Scarlattina", "Malattia Reumatica"),
                'title' => "Malattie Pregresse"
            ),
            'inatto' => array(
                'fields' => array("att_asma_bronchiale", "att_deficit_gh", "att_diabete", "att_ipotiroidismo", "att_malattia_reumatica", "att_epilessia", "att_rinocongiuvite_allergica", "att_celiachia", "att_convulsioni_febbrili"),
                'labels' => array("Asma Bronchiale", "Deficit GH", "Diabete", "Ipotiroidismo", "Malattia Reumatica", "Epilessia", "Rinocongiuvite Allergica", "Celiachia", "Convulsioni febbrili"),
                'title' => "Malattie In Atto"
            ),
            'segnalazioni' => array(
                'fields' => array("alt_ritardo_psicomotorio", "alt_disturbo_comportamento", "alt_terapie_incorso"),
                'labels' => array("Ritardo psicomotorio", "Disturbo del comportamento", "Terapie in corso"),
                'title' => "Altre Segnalazioni"
            ),
            'allergie' => array(
                'fields' => array("allergie_farmaci", "allergie_alimenti", "allergie_insetti", "allergie_pollini", "allergie_polveri", "allergie_muffe"),
                'labels' => array("Allergie farmaci", "Allergie alimenti", "Allergie insetti", "Allergie pollini", "Allergie polveri", "Allergie muffe"),
                'title' => "Allergie"
            ),
            'notizie_portatore' => array(
                'fields' => array("not_apparecchio_ortodontico", "not_apparecchio_acustico", "not_occhiali"),
                'labels' => array("Apparecchio ortodontico", "Apparecchio acustico", "Occhiali"),
                'title' => "Notizie Utili"
            ),
            'notizie_soggetto' => array(
                'fields' => array("not_sonnambulismo", "not_enuresi", "not_insonnia", "not_crisi_acetonemiche"),
                'labels' => array("Sonnambulismo", "Enuresi notturna /diurna", "Insonnia", "Crisi acetonemiche"),
                'title' => "Notizie Utili"
            ),
            'vacinazioni' => array(
                'fields' => array("va_antitetanica", "va_antiepatite_b", "va_antidifterica", "va_antimorbillosa", "va_antipoliomelitica", "va_antipertossica"),
                'labels' => array("Antitetanica", "Antiepatite B", "Antidifterica", "Antimorbillosa", "Antipoliomelitica", "Antipertossica"),
                'title' => "Vacinazioni"
            ),
        );


        return $data[$fields];
    }

    public function getStatsStrutture() {

        $AND = " AND anno ='" . date("Y") . "' ";
        $WHERE .= " WHERE unita_operativa IN(" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        $strutture = Yii::app()->db->createCommand("SELECT DISTINCT(unita_operativa)   FROM utenti " . $WHERE . "  " . $AND . "  ORDER BY tipologia ")->queryAll();

        for ($x = 0; $x < count($strutture); $x++) {

            $AND = "='" . $strutture[$x]['unita_operativa'] . "' " . $AND; 

            $strutture[$x]['nome'] = Yii::app()->db->createCommand("SELECT nome  FROM qualita_strutture  WHERE id " . $AND)->queryScalar();
            $strutture[$x]['totale'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti  WHERE unita_operativa " . $AND)->queryScalar();
            $strutture[$x]['schede'] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti_schede_sanitarie  WHERE unita_operativa " . $AND)->queryScalar();
            $strutture[$x]['rinunce'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM utenti  WHERE unita_operativa " . $AND . " AND rinuncia ='Y'")->queryScalar();
            $strutture[$x]["percentuale"] = Yii::app()->MyUtils->getPercent($strutture[$x]["schede"] - $strutture[$x]['rinunce'], $strutture[$x]["totale"] - $strutture[$x]['rinunce']);

            if ($strutture[$x]["percentuale"] <= 33)
                $strutture[$x]["color"] = "progress-bar-danger";
            else if ($strutture[$x]["percentuale"] >= 66)
                $strutture[$x]['color'] = "progress-bar-success";
            else
                $strutture[$x]['color'] = "progress-bar-warning";

            $turni = Yii::app()->db->createCommand("SELECT DISTINCT(turno) , periodo  FROM utenti  WHERE unita_operativa " . $AND . " ORDER BY turno ")->queryAll();

            if (count($turni)) {

                $strutture[$x]['turno'] = array();

                for ($t = 0; $t < count($turni); $t++) {

                    $strutture[$x]['turno'][$t]["nome"] = $turni[$t]['turno'] . "&deg; Turno";
                    $strutture[$x]['turno'][$t]["id"] = $turni[$t]['turno'];

                    $from = Yii::app()->db->createCommand(" SELECT DATE_FORMAT( dal , '%d-%m-%Y')  as dal  , DATE_FORMAT(al  , '%d-%m-%Y') as al FROM utenti_periodi  WHERE id ='" . $turni[$t]['periodo'] . "' ")->queryRow();
                    if ($from)
                        $strutture[$x]['turno'][$t]["periodo"] = "DAL: <b>" . $from['dal'] . "</b> AL: <b>" . $from['al'] . "</b>";

                    $WHERE = "WHERE unita_operativa ='" . $strutture[$x]['unita_operativa'] . "'   AND turno ='" . $turni[$t]['turno'] . "' " . $AND;

                    $strutture[$x]['turno'][$t]["totale"] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti   " . $WHERE)->queryScalar();
                    $strutture[$x]['turno'][$t]["schede"] = Yii::app()->db->createCommand("SELECT COUNT(id)   FROM utenti_schede_sanitarie   " . $WHERE)->queryScalar();
                    $strutture[$x]['turno'][$t]["rinunce"] = Yii::app()->db->createCommand("SELECT COUNT(id)  FROM utenti    " . $WHERE . "  AND rinuncia ='Y'")->queryScalar();
                    $strutture[$x]['turno'][$t]["percentuale"] = Yii::app()->MyUtils->getPercent($strutture[$x]['turno'][$t]["schede"] - $strutture[$x]['turno'][$t]["rinunce"], $strutture[$x]['turno'][$t]["totale"] - $strutture[$x]['turno'][$t]["rinunce"]);

                    if ($strutture[$x]['turno'][$t]["percentuale"] <= 33)
                        $strutture[$x]['turno'][$t]["color"] = "progress-bar-danger";
                    else if ($strutture[$x]['turno'][$t]["percentuale"] >= 66)
                        $strutture[$x]['turno'][$t]["color"] = "progress-bar-success";
                    else
                        $strutture[$x]['turno'][$t]["color"] = "progress-bar-warning";
                }
            }
        }
        return $strutture;
    }
    
    public function getStruttureConsumi($table , $anno ){
        
        return Yii::app()->db->createCommand("SELECT DISTINCT(s.struttura) as id , c.nome , c.colore  FROM ".$table." AS s LEFT JOIN doc_unita AS c ON s.struttura = c.id WHERE s.anno ='".$anno."' ")->queryAll();
    }
    
    public function getMesi(){
        return  array("gennaio","febbraio","marzo","aprile",'maggio','giugno','luglio','agosto','settembre','ottobre','novembre','dicembre');
    }
    
    public function getStatsConsumi($table , $anno = NULL , $tipo = NULL){
        
        if(!$anno)
            $anno = date("Y");
        if(!$tipo)
            $tipo = "m";
        
        $tipo == "p" ? $k = "c_": $k='';
        $strutture = $this->getStruttureConsumi($table, $anno) ;
        $mesi      = $this->getMesi();
        
        $tempMesi           = array();
        $tempStrutture      = array();
        $tempColori         = array();
        $tempColoriTorta    = array();
        
        // grafico torta per strutture
        for($s= 0 ; $s < count($strutture) ; $s++){
            $totale = Yii::app()->db->createCommand("SELECT SUM(".$k."totale) FROM ".$table." WHERE anno ='".$anno."' AND struttura ='".$strutture[$s]['id']."' ")->queryScalar();
            $stats['torta'][]   = "{label: '".$strutture[$s]['nome']."', value: " . $totale . "}";
            $tempColoriTorta[]  = "'".Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='".$strutture[$s]['colore']."' ")->queryScalar() ."'";
        }
        
        
        for($x=0 ; $x < count($mesi) ; $x++ ){
            
            
            $tempMesi[] = "'".$k.$mesi[$x]."'";
            
            // Grafico a barre anni / strutture    
            for($s = 0; $s < count($strutture); $s++){
                
                 if(!in_array("'".$strutture[$s]['nome']."'",$tempStrutture) ){
                     $tempStrutture[]   = "'".$strutture[$s]['nome']."'";
                     $tempColori[]      = "'".Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='".$strutture[$s]['colore']."' ")->queryScalar() ."'";
                 }
                
                $consumo[$x][$strutture[$s]['nome'] ] =  Yii::app()->db->createCommand("SELECT SUM(".$k.$mesi[$x].") FROM ".$table." WHERE anno ='".$anno."' AND struttura ='".$strutture[$s]['id']."' ")->queryScalar();    
                
                if(!$consumo[$x][$strutture[$s]['nome'] ])
                    $consumo[$x][$strutture[$s]['nome'] ] = 0;
                
            }
            
            if($consumo[$x]){
                $tmp = "{x: '" .$mesi[$x] . "', y: '" . $mesi[$x] . "' ";
            
                foreach($consumo[$x] AS $id => $val){
                    $tmp  .= ",'".$id."' : " . $val  ;
                }
                $tmp .= "}";
            
                $stats['consumi'][] = $tmp;
            }
            
            
        }
        
        $stats['totale'] =  Yii::app()->db->createCommand("SELECT SUM(".$k."totale) FROM ".$table." WHERE anno ='".$anno."' ")->queryScalar();
        $stats['label'] = $tempMesi;
        $stats['key'] =  $tempStrutture;
        $stats['colori'] =  $tempColori;
        $stats['colori_torta'] =  $tempColoriTorta;
        
        return $stats;            
    
    }
    
    public function getStatsConsumiNew($table , $anno = NULL , $tipo = NULL){
        
        !$tipo ? $tipo = "m" :"";
        
        $tipo       == "p" ? $k = "c_": $k='';
        $strutture  = $this->getStruttureConsumi($table, $anno) ;
        $mesi       = $this->getMesi();
        
        for($x = 0 ; $x < count($strutture); $x++){
            
            $stats[$x]['colore']    = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='".$strutture[$x]['colore']."' ")->queryScalar();
            $stats[$x]['nome']      = $strutture[$x]['nome'];
            $stats[$x]['valori']    = array();
            
            foreach($mesi AS $val){
                $tmp =  Yii::app()->db->createCommand("SELECT SUM(".$k.$val.") FROM ".$table." WHERE anno ='".$anno."' AND struttura ='".$strutture[$x]['id']."' ")->queryScalar(); 
                $tmp ? $stats[$x]['valori'][] = $tmp : $stats[$x]['valori'][] = 0 ; 
            }
        }
        
        return $stats;            
    
    }
    
    public function getStatsAnnuali(){
        
        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $struttura = $user['user_unita'] : "";
        
        $struttura ? $AND =" AND struttura ='".$struttura."' " : $AND = ""; 
        
        
        $stats = array();
        $anni = Yii::app()->db->createCommand("SELECT DISTINCT(anno) as anno  FROM utenze_presenze WHERE 1 ".$AND." ORDER BY anno ")->queryAll();
        
        
        $stats['acqua_mc']['nome'] = "Mc Acqua";
        $stats['acqua_euro']['nome'] = "&euro; Acqua";
        $stats['luce_khw']['nome'] = "kwh Enegia Elettrica";
        $stats['luce_euro']['nome'] = "&euro; Energia Elettrica";
        $stats['gas_mc']['nome'] = "Mc Gas";
        $stats['gas_euro']['nome'] = "&euro; Gas";
        $stats['chimici_litri']['nome'] = "Litri Sostanze Chimiche";
        $stats['chimici_euro']['nome'] = "&euro; Sostanze Chimiche";
        $stats['rifiuti_euro']['nome'] = "&euro; Rifiuti";
        
        for($x=0; $x < count($anni) ; $x++){
            
            $SELECT = " SELECT totale FROM ";
            $SELECTE = " SELECT c_totale FROM ";
            $WHERE  = " WHERE anno = '".$anni[$x]['anno']."' ";
                
            $ACC    = Yii::app()->db->createCommand($SELECT." utenze_acqua ".$WHERE." ".$AND)->queryScalar();   
            $ACE   = Yii::app()->db->createCommand($SELECTE." utenze_acqua ".$WHERE." ".$AND)->queryScalar(); 
            $LUC   = Yii::app()->db->createCommand($SELECT." utenze_luce ".$WHERE." ".$AND)->queryScalar();  
            $LUE     = Yii::app()->db->createCommand($SELECTE." utenze_luce ".$WHERE." ".$AND)->queryScalar();  
            $GASC    = Yii::app()->db->createCommand($SELECT." utenze_gas ".$WHERE." ".$AND)->queryScalar(); 
            $GASE   = Yii::app()->db->createCommand($SELECTE." utenze_gas ".$WHERE." ".$AND)->queryScalar();  
            $CHIC   = Yii::app()->db->createCommand($SELECT." utenze_chimici ".$WHERE." ".$AND)->queryScalar();    
            $CHIE   = Yii::app()->db->createCommand($SELECTE." utenze_chimici ".$WHERE." ".$AND)->queryScalar();    
            $RIE   = Yii::app()->db->createCommand($SELECTE." utenze_rifiuti ".$WHERE." ".$AND)->queryScalar(); 
            
            !$ACC ? $ACC =0 :"";
            !$ACE ? $ACE =0 :"";
            !$LUC ? $LUC =0 :"";
            !$LUE ? $LUE =0 :"";
            !$GASC ? $GASC =0 :"";
            !$GASE ? $GASE =0 :"";
            !$CHIC ? $CHIC =0 :"";
            !$CHIE ? $CHIE =0 :"";
            !$RIE ? $RIE =0 :"";
            
            $stats['acqua_mc']['anni'][]   = "{y:".$anni[$x]['anno']." , a:".$ACC." }";   
            $stats['acqua_euro']['anni'][]  = "{y:".$anni[$x]['anno']." , a:".$ACE." }";  
            $stats['luce_kwh']['anni'][] = "{y:".$anni[$x]['anno']." , a:".$LUC." }";  
            $stats['luce_euro']['anni'][]  = "{y:".$anni[$x]['anno']." , a:".$LUE." }";  
            $stats['gas_mc']['anni'][]  = "{y:".$anni[$x]['anno']." , a:".$GASC." }";   
            $stats['gas_euro']['anni'][]  = "{y:".$anni[$x]['anno']." , a:". $GASE." }";   
            $stats['chimici_litri']['anni'][]  = "{y:".$anni[$x]['anno']." , a:". $CHIC." }";   
            $stats['chimici_euro']['anni'][]  = "{y:".$anni[$x]['anno']." , a:". $CHIE." }";   
            $stats['rifiuti_euro']['anni'][]  = "{y:".$anni[$x]['anno']." , a:". $RIE." }";   
        }
        return $stats;
    }
    
    public function getPercent($valore, $totale){
        $valore > 0 ?  $percent = $valore / $totale * 100 : $percent = 0;
        return number_format($percent,1);
    }
    
    // Verifica che ci siano alemeno 1 questionario per l'anno in corso
    public function getCountStatsQuestionari($table){
        $tmp  = Yii::app()->db->createCommand("SELECT COUNT(id) FROM ".$table." WHERE anno ='".date("Y")."' ")->queryScalar();
        return $tmp > 0 ? date("Y") : date("Y") -1 ;
    }
    
    
    public function getStatsQuestionari($table, $struttura = null, $anno = null ,$titolo = null, $tipologia = null)
    {    
        $stats = array();

        if(!$struttura) {
            $user = Yii::app()->MyUtils->getUserInfo();
            //$user['user_type'] =='3' ? $struttura = $user['user_unita']: $stats['user'] ='admin' ;

            if($user['user_unita']) {
                $centri = $user['user_unita'];
            }
            else {
                $centri = "";
            }
        }
        else {
            $centri = $struttura;
        }

        $stats['user'] ='admin';
        
        $anno ? $stats['anno'] = $anno : $stats['anno'] = date("Y");
        $ieri = $stats['anno'] - 1;
        
        $WHERE = " anno = '".$stats['anno']."'";
        $WHEREIERI = " anno ='".$ieri."'";

        if($tipologia) {
            $WHERE     .= ' AND tipologia_id = '.$tipologia;
            $WHEREIERI .= ' AND tipologia_id = '.$tipologia;
        }

        // Dettagli specifici ad ogni questionario
        $tipologia ? $type = $tipologia : $type = $table; 
        $dettagli = Yii::app()->MyUtils->getDatiQuestionario($type);
        
        $titolo ?  $AND .=" AND titolo ='".$titolo."' " : ""; 
                
        if($centri) {
            $AND                    .= " AND ".$dettagli['struttura']." IN (".$centri.")";
            $stats['struttura']      = $struttura ;
            $stats['nome_struttura'] = Yii::app()->MyUtils->getSelectValue($struttura, "doc_unita");
        }
        else {
            $AND                    .= " AND ".$dettagli['struttura']." != ''";
        }
        
        $valori = $dettagli['valori'];
        
        $queryTotale    = "SELECT count(id) FROM  " . $table . " WHERE  ".$WHERE;
        $queryAnno      = "SELECT count(id) FROM  " . $table . " WHERE  ".$WHERE." ".$AND;
        $queryIeri      = "SELECT count(id) FROM  " . $table . " WHERE  ".$WHEREIERI." ".$AND;
        
        foreach ($dettagli['giudizzi'] as $giudizio) {
            
            $stats[$giudizio] = array();
            
            $noNull = " AND ".$giudizio." IS NOT NULL AND ".$giudizio." !='' ";
                
            $stats[$giudizio]['totale']  = Yii::app()->db->createCommand($queryTotale." ".$noNull)->queryScalar();
            $stats[$giudizio]['anno']    = Yii::app()->db->createCommand($queryAnno." ".$noNull)->queryScalar();
            $stats[$giudizio]['ieri']    = Yii::app()->db->createCommand($queryIeri." ".$noNull)->queryScalar();
            $stats[$giudizio]['label']   = Yii::app()->MyUtils->getLabelQuestionario($giudizio);
            
            foreach($valori as $valore ){
                
                $totale     = Yii::app()->db->createCommand($queryTotale." AND ".$giudizio."='".$valore."'")->queryScalar();
                $anno       = Yii::app()->db->createCommand($queryAnno." AND ".$giudizio."='".$valore."'")->queryScalar();
                $precedente = Yii::app()->db->createCommand($queryIeri." AND ".$giudizio."='".$valore."'")->queryScalar();
                
                $stats[$giudizio][$valore][] = $precedente;
                $stats[$giudizio][$valore][] = $anno; 
                $stats[$giudizio][$valore][] = $totale ;
                
                $stats[$giudizio][$valore."_per"][]     = $this->getPercent($precedente, $stats[$giudizio]['ieri']);
                $stats[$giudizio][$valore."_per"][]     = $this->getPercent($anno, $stats[$giudizio]['anno']);
                $stats[$giudizio][$valore."_per"][]     = $this->getPercent($totale, $stats[$giudizio]['totale']);
            }
            
        }
        
        
        if($dettagli['consiglia'] =='Y'){
            
            $stats['consiglia'] = array();
            $cons = array("N","F","S");
            
            $noNull = " AND consiglia  IS NOT NULL AND consiglia !='' ";
                                
            $stats['consiglia']['totale']  = Yii::app()->db->createCommand($queryTotale." ".$noNull)->queryScalar();
            $stats['consiglia']['anno']    = Yii::app()->db->createCommand($queryAnno." ".$noNull)->queryScalar();
            $stats['consiglia']['ieri']    = Yii::app()->db->createCommand($queryIeri." ".$noNull)->queryScalar();
            $stats['consiglia']['label']   = "Consiglierebbe la vacanza ?";
            
            foreach($cons as $valore ){
                
                $totale     = Yii::app()->db->createCommand($queryTotale." AND consiglia='".$valore."'")->queryScalar();
                $anno       = Yii::app()->db->createCommand($queryAnno." AND consiglia='".$valore."'")->queryScalar();
                $precedente = Yii::app()->db->createCommand($queryIeri." AND consiglia='".$valore."'")->queryScalar();
                
                $stats['consiglia'][$valore][]   = $precedente;
                $stats['consiglia'][$valore][]         = $anno; 
                $stats['consiglia'][$valore][]       = $totale ;
                
                $stats['consiglia'][$valore."_per"][]     = $this->getPercent($precedente, $stats['consiglia']['ieri']);
                $stats['consiglia'][$valore."_per"][]     = $this->getPercent($anno, $stats['consiglia']['anno']);
                $stats['consiglia'][$valore."_per"][]     = $this->getPercent($totale, $stats['consiglia']['totale']);
            }
            
        }        
        
        $stats['totale'] = Yii::app()->db->createCommand("SELECT count(id) FROM ".$table." WHERE ".$WHERE." ".$AND)->queryScalar();
        return $stats;
    }
    
    public function getCorsiFormazione($corso = null){
        $corsi = array();
        
        $corso ? $AND ="WHERE titolo ='".addslashes($corso)."'" : $AND ='';
        
        $tmp = Yii::app()->db->createCommand("SELECT DISTINCT(titolo) as nome FROM questionario_formazione ".$AND." ORDER BY data_corso DESC  ")->queryAll();
        for($x=0; $x < count($tmp); $x++){
            $corsi[$x] = trim($tmp[$x]['nome']);
        }
        return $corsi;
    }
    
    public function getStatsFormazione( $corso = null){
        
        $stats          = array();
        $giudizzi       = array("I","S","B","E");
        $corsi          = $this->getCorsiFormazione($corso);
        $valutazioni    = array("corso","giudizio","spazi",'conduzione','livello');
        
        foreach($corsi AS $x => $val){
            
            //$queryTotale                    = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = '".$val."'";
            
            $sql = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = :titolo";
            $cmd = Yii::app()->db->createCommand($sql);
            $cmd->bindParam(":titolo",$val,PDO::PARAM_STR);
            
            $stats['corso_'.$x]['totale']   = $cmd->queryScalar(); //Yii::app()->db->createCommand($queryTotale)->queryScalar();
            
            foreach ($valutazioni as $campo) {

                //$noNull                             = " AND ".$campo." IS NOT NULL AND ".$campo." !='' ";
                $sql = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = :titolo AND ".$campo." IS NOT NULL AND ".$campo." !=''";
                $cmd = Yii::app()->db->createCommand($sql);
                $cmd->bindParam(":titolo",$val,PDO::PARAM_STR);
                
                $stats['corso_'.$x]['totale_campo'] = $cmd->queryScalar(); //Yii::app()->db->createCommand($queryTotale." ".$noNull)->queryScalar();

                foreach($giudizzi AS $g) {
                    $sql = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = :titolo AND ".$campo."='".$g."'";
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindParam(":titolo",$val,PDO::PARAM_STR);

                    $stats['corso_'.$x][$campo][$g] = $cmd->queryScalar(); //Yii::app()->db->createCommand($queryTotale." AND ".$campo."='".$g."'")->queryScalar();
                }
            
            }
            
            foreach($giudizzi AS $g){
            
                foreach ($valutazioni as $campo) {
                    
                    //$noNull  = "  AND ".$campo." IS NOT NULL AND ".$campo." !='' ";
                    
                    //$totale  = Yii::app()->db->createCommand($queryTotale." ".$noNull)->queryScalar();
                    //$valore  = Yii::app()->db->createCommand($queryTotale." ".$noNull." AND ".$campo."='".$g."'  ")->queryScalar();
                    
                    $sql = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = :titolo AND ".$campo." IS NOT NULL AND ".$campo." !=''";
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindParam(":titolo",$val,PDO::PARAM_STR);
                    $totale = $cmd->queryScalar();

                    $sql = "SELECT COUNT(id) FROM questionario_formazione WHERE titolo = :titolo AND ".$campo." IS NOT NULL AND ".$campo." !='' AND ".$campo."='".$g."'";
                    $cmd = Yii::app()->db->createCommand($sql);
                    $cmd->bindParam(":titolo",$val,PDO::PARAM_STR);
                    $valore = $cmd->queryScalar();
                    
                    $stats['corso_'.$x][$g][] = $this->getPercent($valore, $totale); 
                }
            }
        }
       
        return $stats ;
    }
}

?>