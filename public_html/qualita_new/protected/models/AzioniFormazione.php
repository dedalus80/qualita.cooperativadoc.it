<?php

class AzioniFormazione extends CActiveRecord{
	
    var $gruppi             = array();
    var $utenti             = array();
	public $selectedTags     = array();
	var $selectAnni         = array();
	var $selectCorsi        = array();
	var $selectGruppi       = array();
    var $selectUtenti       = array();
	var $selectTags         = array();
	var $selectCorsiAdmin   = array();
    var $stats              = array();
    var $datiEsportazione   = array();
    var $calendario         = "";
    var $today = false;
    
    public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'db_formazione';
	}

	public function rules()	{
		return array(
			array('titolo_id,id_categoria , data , ora ', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
			array('id_categoria, giorni_invio_sms, giorni_invio_email', 'numerical', 'integerOnly'=>true),
			array('titolo_id', 'numerical', 'integerOnly'=>true),
			array('ora , anno', 'length', 'max'=>5),
			array('data_fine', 'length', 'max'=>10),
			array('id_gruppi', 'length', 'max'=>100),
			array('invio_email, invio_sms', 'length', 'max'=>1),
			array('selectedTags', 'safe'),
			array('data, descrizione,tipo_accesso,link_accesso,address_accesso,titolo', 'safe'),
			array('id, titolo_id,anno, data, data_fine, ora, id_categoria, id_gruppi, invio_email, invio_sms, giorni_invio_sms, giorni_invio_email', 'safe', 'on'=>'search'),
		);
	}

	public function relations()	{
		return array(
			'tags' => array(self::MANY_MANY, 'UtentiTag', 'formazione_corsi_tags(corso_id,tag_id)'),
		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'titolo' => 'Corso',
            'titolo_id' => 'Titolo corso',
			'data' => 'Data',
			'data_fine' => 'Al',
			'ora' => 'Ora',
			'id_categoria' => 'Tipo',
			'id_gruppi' => 'Gruppi',
			'invio_email' => 'Invio Email',
			'invio_sms' => 'Invio Sms',
			'anno' => 'Anno',
			'gruppi' => 'Gruppi',
			'utenti' => 'Utenti',
			'selectedTags' => 'Tag utenti',
			'giorni_invio_sms' => 'Giorni Invio Sms',
			'giorni_invio_email' => 'Giorni Invio Email',
            'tipo_accesso' => 'Tipo corso',
            'link_accesso' => 'Link accesso',
            'address_accesso' => 'Indirizzo',
            'descrizione' => 'Note'
		);
	}

	public function search()	{
		
		$criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);
		$criteria->compare('titolo',$this->titolo,true);
        $criteria->compare('titolo_id',$this->titolo,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('data_fine',$this->data_fine,true);
		$criteria->compare('ora',$this->ora,true);
		$criteria->compare('anno',$this->anno,true);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('id_gruppi',$this->id_gruppi,true);
		$criteria->compare('invio_email',$this->invio_email,true);
		$criteria->compare('invio_sms',$this->invio_sms,true);
		$criteria->compare('giorni_invio_sms',$this->giorni_invio_sms);
		$criteria->compare('giorni_invio_email',$this->giorni_invio_email);
		
        // Visualizza solo i corsi dei gruppi a cui appartiene
        !Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $criteria->addInCondition('id', Yii::app()->MyUtils->getIdFormazione(), 'AND'):"";
		
        return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 40,
                    ),
                ));
	}
    
    public function getGruppi(){
        
        $gruppi = array();
        
        $tmp    = Yii::app()->db->createCommand("SELECT id_gruppo FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$this->id."' ")->queryAll();
        
        for($x=0; $x < count($tmp);$x++){
            $gruppi[] = $tmp[$x]['id_gruppo']; 
        }
        
        $user = Yii::app()->db->createCommand("SELECT id, nome  FROM doc_formazione_gruppi ")->queryAll();
        
        $table ='<table class="table table-striped table-bordered dataTable">';
        $table .="<thead><tr><th class='max50 centered'>Assegna</th><th>Nome</th><th class='centered' >Iscritti</th></tr></thead>";
        $table .="<tbody>";
        
        for($x=0 ; $x < count($user); $x++){
            
            in_array($user[$x]['id'], $gruppi) ? $check ='checked="checked"': $check="";
            
            $iscritti =  Yii::app()->db->createCommand("SELECT COUNT(id) FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$user[$x]['id']."' ")->queryScalar();
            
            $table .= "<tr><td class='max50 centered'><input type='checkbox' class='check-gruppo checkbox-green' ".$check." data-refer='".$user[$x]['id']."' ></td><td>".$user[$x]['nome']."</td><td class='centered'>".$iscritti."</td></tr>";
        }
                
        $table .="</tbody>";
        $result['table'] = $table;
        $result['nome']  = $this->titolo;
        
        return $result;
    }

    public function getUtenti(){
        
        $utenti = array();
        
        $tmp  = Yii::app()->db->createCommand("SELECT id_utente FROM doc_formazione_utenti_corsi WHERE id_corso ='".$this->id."' ")->queryAll();
        
        for($x=0; $x < count($tmp);$x++){
            $utenti[] = $tmp[$x]['id_utente']; 
        }
        
        $user = Yii::app()->db->createCommand("SELECT id, user FROM utenti")->queryAll();
        
        $table ='<table class="table table-striped table-bordered dataTable">';
        $table .="<thead><tr><th class='max50 centered'>Assegna</th><th>Utente</th><th class='centered' >Iscritto</th></tr></thead>";
        $table .="<tbody>";
        
        for($x=0 ; $x < count($user); $x++) {
            in_array($user[$x]['id'], $utenti) ? $check ='checked="checked"': $check="";
            //$iscritti =  Yii::app()->db->createCommand("SELECT COUNT(id) FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$user[$x]['id']."' ")->queryScalar();
            $table .= "<tr><td class='max50 centered'><input type='checkbox' class='check-gruppo checkbox-green' ".$check." data-refer='".$user[$x]['id']."' ></td><td>".$user[$x]['user']."</td><td class='centered'>1</td></tr>";
        }
                
        $table .="</tbody>";
        $result['table'] = $table;
        $result['nome']  = $this->titolo;
        
        return $result;
    }
    
    public function setGruppiFormazione($id){
        $y = 0 ;
        Yii::app()->db->createCommand("DELETE FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$id."' ")->execute();
        
        if(count($this->gruppi)){
            foreach($this->gruppi As $is => $val){
                
                if($val !=''){
                Yii::app()->db->createCommand("INSERT INTO doc_formazione_gruppi_corsi (id_corso , id_gruppo) VALUE ('".$id."','".$val."') ")->execute();
                $y++;
                }
            }
        }
        
        return $y;
    }

    public function setUtentiFormazione($id) {
        $y = 0;
        Yii::app()->db->createCommand("DELETE FROM doc_formazione_utenti_corsi WHERE id_corso ='".$id."'")->execute();
        
        if(count($this->utenti)){
            foreach($this->utenti As $is => $val){
                
                if($val !=''){
                    Yii::app()->db->createCommand("INSERT INTO doc_formazione_utenti_corsi (id_corso , id_utente) VALUE ('".$id."','".$val."') ")->execute();
                    $y++;
                }
            }
        }
        
        return $y;
    }
     
    public function setGruppi() {
        
        $y = $this->setGruppiFormazione($this->id) ;
        
        $result["text"] =  "<b>".$y."</b> gruppi assegati al corso <b>".$this->titolo."</b>" ; 
        $result["totale"] = $this->queryGruppiCorso($this->id);
        return $result ; 
    }

    public function setUtenti() {
        
        $y = $this->setUtentiFormazione($this->id) ;
        
        $result["text"] =  "<b>".$y."</b> utenti assegati al corso <b>".$this->titolo."</b>" ; 
        $result["totale"] = $this->queryUtentiCorso($this->id);
        return $result ; 
    }

	public function getSelectedTagIds()
	{
		$ids = array();

		if (!empty($this->tags)) {
			foreach ($this->tags as $tag) {
				$ids[] = (int)$tag->id;
			}
		}

		return $ids;
	}

	public function syncCorsiTags($tagIds = array())
	{
		$cleanIds = array();

		if (is_array($tagIds)) {
			foreach ($tagIds as $tagId) {
				$tagId = (int)$tagId;
				if ($tagId > 0) {
					$cleanIds[] = $tagId;
				}
			}
		}

		$cleanIds = array_values(array_unique($cleanIds));

		Yii::app()->db->createCommand()->delete('formazione_corsi_tags', 'corso_id=:corso_id', array(':corso_id' => (int)$this->id));

		foreach ($cleanIds as $tagId) {
			Yii::app()->db->createCommand()->insert('formazione_corsi_tags', array(
				'corso_id' => (int)$this->id,
				'tag_id' => (int)$tagId,
			));
		}
	}
    
    public function getDettaglio($data, $id) {
        $txt = "";
        $txt .= $this->getDataCorso($data, $id)."<br>";
        $txt .= $this->getCorso($data, $id)."<br>";
        $txt .= $this->getGruppiCorso($data, $id)."<br>";
        $txt .= $this->getSms($data, $id)."<br>";
        $txt .= $this->getEmail($data, $id)."<br>";
        
        return $txt ;
    }

    public function getIscritti($data, $id){
        return "<i class='add-group-to-course ace-icon fa fa-users  bigger-110 icon-only btn  btn-circle circle-blue' data-toggle='tooltip' data-placement='top' title='Aggiungi gruppi al corso' data-refer='".$data->id."'  ></i>";
    }
    
    public function getDataCorso($data, $id){
        return  Yii::app()->MyUtils->reverseDate($data->data)."<br> Ore ".$data->ora ;
    }
    
    public function getCorso($data , $id){
        
        $txt .= $data->titolo."<br /> ";
        $txt .= Yii::app()->MyUtils->getSelectValue($data->id_categoria, "doc_formazione_formazioni");
        return $txt ;
        
    }
    
    public function queryGruppiCorso($id , $partecipanti = null){
         $query = "SELECT g.nome, c.id_gruppo FROM doc_formazione_gruppi_corsi AS c LEFT JOIN doc_formazione_gruppi as g ON c.id_gruppo = g.id WHERE c.id_corso ='".$id."' ";
        $tmp    = Yii::app()->db->createCommand($query)->queryAll();
        
        if( count($tmp) > 0 ){
            for($x=0; $x < count($tmp);$x++){
                $txt .= $tmp[$x]['nome'];
                if($partecipanti)
                    $txt .= "  Partecipanti:<b> ".Yii::app()->db->createCommand("SELECT COUNT(id) FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$tmp[$x]['id_gruppo']."'  ")->queryScalar()."</b>";  
                $txt .= "<br />";
            }
        }
        return $txt ;
    }

    public function queryUtentiCorso($id , $partecipanti = null) {
        $query = "SELECT g.user, c.id_utente FROM doc_formazione_utenti_corsi AS c LEFT JOIN utenti as g ON c.id_utente = g.id WHERE c.id_utente ='".$id."' ";
        $tmp    = Yii::app()->db->createCommand($query)->queryAll();
       
        if( count($tmp) > 0 ){
            for($x=0; $x < count($tmp);$x++) {
                $txt .= $tmp[$x]['user'];
                //if($partecipanti)
                //   $txt .= "  Partecipanti:<b> ".Yii::app()->db->createCommand("SELECT COUNT(id) FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$tmp[$x]['id_gruppo']."'  ")->queryScalar()."</b>";  
                $txt .= "<br />";
            }
        }
       return $txt ;
    }
    
    public function getGruppiCorsoCalenndario($id){
        
        $txt = "";
        $tmp = $this->queryGruppiCorso($id);
        if($tmp !=''){
            $tmp = str_replace("Partecipanti:","",$tmp);
            $tmp = str_replace("<b> ","<span class=\'badge badge-withe\'>",$tmp);
            $tmp = str_replace("</b>","</span>",$tmp);
            $txt = "<hr>".$tmp;
        }
        return $txt;
    }
        
    public function getGruppiCorso($data , $id){
        return  "<div class='gruppo_".$data->id."'>".$this->queryGruppiCorso($data->id)."</div>" ; 
    }
    
    public function getSms($data , $id){
        
        if($data->invio_sms =='Y')
            return "Invio il ".Yii::app()->MyUtils->getDataFromDays($data->data, $data->giorni_invio_sms);
        
    }
    
    public function getEmail($data , $id ){
        
        if($data->invio_email=='Y' )
            return "Invio il ".Yii::app()->MyUtils->getDataFromDays($data->data, $data->giorni_invio_email);
    }
    
    public function getCorsiFormazione() {

        $stats = array();
        
        !Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $WHERE = " WHERE c.id IN(".implode(",",Yii::app()->MyUtils->getIdFormazione()).")" :"";
	
        $query = " SELECT f.colore  as colore , c.* , DATE_FORMAT(c.data ,'%Y') as anno_start , DATE_FORMAT(c.data ,'%d')  as giorno_start , DATE_FORMAT(c.data ,'%m')  as mese_start , 
        DATE_FORMAT(c.data_fine ,'%Y') as anno_stop , DATE_FORMAT(c.data_fine ,'%d')  as giorno_stop , DATE_FORMAT(c.data_fine ,'%m')  as mese_stop , f.nome as nome  FROM " . $this->tableName() . " AS c 
        LEFT JOIN  doc_formazione_formazioni AS f ON c.id_categoria = f.id ".$WHERE;
        
        
        
        
        $stats['corsi'] = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($stats['corsi']); $x++) {

            $mese_start = $stats['corsi'][$x]['mese_start'] - 1;
            $stats['corsi'][$x]['mese_stop'] ? $mese_stop = $stats['corsi'][$x]['mese_stop'] - 1 : $mese_stop = $mese_start;

            if ($stats['corsi'][$x]['ora'])
                $orario = explode(":", $stats['corsi'][$x]['ora']);
            else
                $orario = explode(":", "09:00");

            $border[$x] = "#ccc";

            $color[$x] = Yii::app()->db->createCommand("SELECT nome FROM doc_colori WHERE id ='" . $stats['corsi'][$x]['colore'] . "' ")->queryScalar();

            
            $gruppi[$x] = $this->getGruppiCorsoCalenndario($stats['corsi'][$x]['id']);
            
            !$stats['corsi'][$x]['anno_stop'] ? $stats['corsi'][$x]['anno_stop'] = $stats['corsi'][$x]['anno_start']:"";
            !$stats['corsi'][$x]['giorno_stop'] ? $stats['corsi'][$x]['giorno_stop'] = $stats['corsi'][$x]['giorno_start']:"";
          
            
            
            if (!$color[$x])
                $color[$x] = 'success';

            $backgound[$x] = "backgroundColor: Utility.getBrandColor('" . $color[$x] . "')";
            
            $txt = "{";
            $txt .="title:'" . str_replace("'", "", $stats['corsi'][$x]['titolo'] . " <br > " . $stats['corsi'][$x]['nome'])." ".$gruppi[$x]."' , ";
            $txt .="start: new Date(" . $stats['corsi'][$x]['anno_start'] . ", " . $mese_start . ", " . $stats['corsi'][$x]['giorno_start'] . " ," . $orario[0] . "," . $orario[1] . "),";
            $txt .=" end: new Date(" . $stats['corsi'][$x]['anno_stop'] . ", " . $mese_stop . ", " . $stats['corsi'][$x]['giorno_stop'] . "," . $orario[0] . "," . $orario[1] . "),";
            $txt .="id:" . $stats['corsi'][$x]['id'] . ",";
            $txt .=" allDay: false,";
            $txt .="className: '" . $border[$x] . "',";
            $txt .="type: 2,";
            $txt .= $backgound[$x];
            $txt .="}";
            $stats['reserved'][] = $txt;
        }

        // RECUPERO CONTEGGI SUI CORSI 
        $tipi = Yii::app()->db->createCommand("SELECT t.id ,  t.nome as nome_corso, c.nome, c.colore FROM doc_formazione_formazioni as t LEFT JOIN doc_colori as c ON t.colore = c.id ")->queryAll();

        for ($x = 0; $x < count($tipi); $x++) {

            $tipi[$x]['prime_c'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_formazione WHERE  data <='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND id_categoria ='" . $tipi[$x]['id'] . "'  ")->queryScalar();
           
            $tipi[$x]['prime_nc'] = Yii::app()->db->createCommand("SELECT COUNT(id) FROM db_formazione WHERE  data >='" . date("Y") . "-" . date("m") . "-" . date("d") . "' AND id_categoria ='" . $tipi[$x]['id'] . "'  ")->queryScalar();
            

        $stats['stats'] = $tipi;

        return $stats;
    }
    
    
    
}
    
    public function getSmallCorsiFormazione($anno = null) {
        
		$WHERE = " WHERE 1";
        if ($anno)
            $WHERE .= " AND anno ='" . $anno . "' ";
        
        
        !Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $AND = " AND f.id IN(".implode(",",Yii::app()->MyUtils->getIdFormazione()).")" :"";

        $date = Yii::app()->db->createCommand("SELECT DISTINCT(data) as data FROM " . $this->tableName() . "  " . $WHERE . " ")->queryAll();
        $corsi = array();

        for ($x = 0; $x < count($date); $x++) {
            $corsi[$date[$x]['data']] = array();
            
            $query = "SELECT f.* , c.colore , c.codice FROM " . $this->tableName() . " as f LEFT JOIN doc_formazione_formazioni AS c ON f.id_categoria = c.id  WHERE f.data ='" . $date[$x]['data'] . "' ".$AND." ";
            
            $tmp = Yii::app()->db->createCommand($query)->queryAll();

            for ($v = 0; $v < count($tmp); $v++) {
                $background = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='" . $tmp[$v]['colore'] . "' ")->queryScalar();
                $corsi[$date[$x]['data']][] = "<a class='formazione' data-refer='" . $tmp[$v]['id'] . "' id='formazione-" . $tmp[$v]['id'] . "' style='background-color:" . $background . "'>".$tmp[$v]['codice']."</a>";
            }
        }
        return $corsi;   
    }
    
    public function getSelectCorsi(){
        
        $cat = Yii::app()->db->createCommand("SELECT nome, id FROM doc_formazione_categorie ")->queryAll();
        $txt ='<select id="AzioniFormazione_id_categoria" name ="AzioniFormazione[id_categoria]"  class="form-control" value="'.$this->id_categoria.'">';
        $txt .= "<option> -- Seleziona -- </option>";
        for($x=0; $x < count ($cat) ; $x++){
            
            $txt .= "<optgroup style='color:#000; background:#f2f2f2'>".$cat[$x]['nome']."</optgroup>";
            $corsi = Yii::app()->db->createCommand("SELECT nome, id FROM doc_formazione_formazioni WHERE id_categoria ='".$cat[$x]['id']."' ")->queryAll();
            for($k =0 ; $k < count($corsi); $k++){
                $txt .= "<option value ='".$corsi[$k]['id']."' >".$corsi[$k]['nome']."</option>";
            }
        }
        
        $txt .= "</select>";
        return $txt;
        
    }
    
    public function getGruppiId(){
        $tmp = Yii::app()->db->createCommand("SELECT id_gruppo FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$this->id."'")->queryAll();
        for($x=0; $x < count($tmp); $x++)
            $gruppi[] = $tmp[$x]['id_gruppo'];
        
        return $gruppi;
    }
    
    public function setDefaultValues(){
        $this->selectCorsi          = $this->getSelectCorsi();
        $this->selectCorsiAdmin     = Yii::app()->MyUtils->getSelect('doc_formazione_formazioni');
        $this->selectGruppi         =  Yii::app()->MyUtils->getSelect('doc_formazione_gruppi');
        $this->selectUtenti         = CHtml::listData(Utenti::model()->findAll(array('order'=>'user')),'id','user');//Yii::app()->MyUtils->getSelect('utenti_formazione');
		$this->selectTags           = UtentiTag::getOptions();
        $this->selectAnni           = Yii::app()->MyUtils->getYears();
        $this->gruppi               = $this->getGruppiId();
        $this->utenti               = Yii::app()->db->createCommand()
                                                    ->select('id_utente')
                                                    ->from('doc_formazione_utenti_corsi')
                                                    ->where('id_corso=:id', array(':id'=>$this->id))
                                                    ->queryColumn();    

		if(!$this->isNewRecord) {
			$this->selectedTags = $this->getSelectedTagIds();
		}
    }
    
    public function getFormazione($id) {
        $formazione = array();
        $query  = "SELECT f.titolo, f.ora , f.id_categoria , DATE_FORMAT(f.data, '%d-%m-%Y' ) data , c.nome as categoria ,
        DATE_FORMAT(f.data_fine, '%d-%m-%Y' ) data_fine , f.invio_sms , f.invio_email , f.giorni_invio_sms , f.giorni_invio_email, f.tipo_accesso, f.link_accesso, f.address_accesso, f.descrizione
        FROM " . $this->tableName() . " AS f LEFT JOIN doc_formazione_formazioni as c ON f.id_categoria = c.id   WHERE f.id ='" . $id . "' ";
            
        $tmp    = Yii::app()->db->createCommand($query)->queryRow();
        
        $formazione['titolo']        =  $tmp['titolo'];
        $formazione['data']          = $tmp['data'];
        $formazione['data_fine']     = $tmp['data_fine'];
        $formazione['ora']           = $tmp['ora'];
        $formazione['invio_sms']     = $tmp['invio_sms'];
        $formazione['invio_email']   = $tmp['invio_email'];
        $formazione['giorni_sms']    = $tmp['giorni_invio_sms'];
        $formazione['giorni_email']  = $tmp['giorni_invio_email'];
        $formazione['tipo']          = $tmp['id_categoria'];
        $formazione['view_corso']    = $tmp['categoria'];
        $formazione['view_tipo']     = $tmp['tipo_accesso']=='P'?'In presenza':'On-line';
        $formazione['view_location'] = $tmp['tipo_accesso']=='P'?$tmp['address_accesso']:'<a href="'.$tmp['link_accesso'].'" target="_blank">'.$tmp['link_accesso'].'</a>';
        $formazione['view_desc']     = $tmp['descrizione'];
        
        $tmp['data_fine'] ? $formazione['view_data'] = "Dal ".$tmp['data']." Ore ".$tmp['ora']. "Al ".$tmp['data_fine'] : $formazione['view_data'] = "Il ".$tmp['data']." Ore ".$tmp['ora'];
        
        $query  = "SELECT c.id_gruppo , g.nome  FROM doc_formazione_gruppi_corsi as c 
        LEFT JOIN doc_formazione_gruppi as g ON c.id_gruppo = g.id WHERE c.id_corso ='".$id."' ";
        
        $tmp =  Yii::app()->db->createCommand($query)->queryAll();
        
        if(count($tmp) > 0 ){
            $formazione['gruppi'] = array();
            for($x=0; $x < count($tmp) ; $x++){
                $formazione['gruppi'][] = $tmp[$x]['id_gruppo'] ;
                $formazione['view_gruppi'] .= "<div>".$tmp[$x]['nome']."</div>";
            }
        }

        $query = "SELECT t.id, t.nome
                    FROM utenti_tags t
                    INNER JOIN formazione_corsi_tags fct ON fct.tag_id = t.id
                    WHERE fct.corso_id = :corso_id
                    ORDER BY t.nome ASC";
        $tmp = Yii::app()->db->createCommand($query)->queryAll(true, array(':corso_id' => (int)$id));
        if(count($tmp)) {
            $formazione['utenti'] = array();
            $formazione['view_utenti'] = '';
            foreach($tmp as $tag) {
                $formazione['utenti'][] = $tag['id'];
                $formazione['view_utenti'] .= "<div>".$tag['nome']."</div>";
            }
        } else {
            $formazione['view_utenti'] = '<div>Nessun tag associato</div>';
        }
        
        Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $formazione['user'] ='admin' : $formazione['user'] ='user';
	
        return $formazione;
    }
    
    
    
    
    public function setFormazione($id) {

        $booking = "";
        $dati['stato'] = 'OK';
        $dati['messaggio'] = "";
        $dati['remove'] = "N";
        $dati['newDate'] = "N";
        $dati['error'] = "";

        $idFormazione = array();
        $newFormazione = array();
        $oldFormazione = array();

        if ($id == 'new') {
            $idFormazione[] = $this->addFormazione();
            
        } else {
            
            $d = explode("-", $this->data);
            
            $formazione = Yii::app()->db->createCommand("SELECT * FROM " . $this->tableName() . "  WHERE id ='" . $id . "' ")->queryRow();
            $query = "UPDATE " . $this->tableName() . "
            SET titolo ='" . $this->titolo . "'  ,
            data ='" . $this->data . "',
            data_fine ='" . $this->data_fine . "',
            ora  ='" . $this->ora . "' ,
            id_categoria = '".$this->id_categoria."'  ,
            invio_sms ='".$this->invio_sms."'    ,
            invio_email ='".$this->invio_email."'    ,
            giorni_invio_email ='".$this->giorni_invio_email."'    ,
            giorni_invio_sms ='".$this->giorni_invio_sms."'    ,
            anno ='" . $d[0] . "'   WHERE id ='" . $id . "' ";
            Yii::app()->db->createCommand($query)->execute();
            $dati['remove'] = "Y";
            $oldFormazione[] = $id;
            $idFormazione[] = $id;
            
            // AGGIUNGO I GRUPPI
            
            
            // INVIO NOTIFICHE PUSH
            //Yii::app()->MyPush->newNotificaton($this->tableName(), "for", "update", $id);
                
        }
        
        
        if (count($idFormazione) > 0) {
            for ($x = 0; $x < count($idFormazione); $x++) {
                
                // AGGIUNGO I GRUPPI 
                $this->setGruppiFormazione($idFormazione[$x]) ;
                
                $query = " SELECT f.* , DATE_FORMAT(f.data ,'%Y') as anno_start , DATE_FORMAT(f.data ,'%d-%m-%Y') as data_anno , DATE_FORMAT(f.data,'%d')  as giorno_start , DATE_FORMAT(f.data,'%m')  as mese_start ,";
                $query .= "  DATE_FORMAT(f.data_fine ,'%Y') as anno_stop , DATE_FORMAT(f.data_fine ,'%d-%m-%Y') as fine_anno , DATE_FORMAT(f.data_fine,'%d')  as giorno_stop , DATE_FORMAT(f.data_fine,'%m')  as mese_stop , c.nome  as tipo , c.colore , c.codice  FROM " . $this->tableName() . " AS f  LEFT JOIN  doc_formazione_formazioni AS c ON f.id_categoria = c.id  WHERE f.id='" . $idFormazione[$x] . "'";
                
                $dettaglio          = Yii::app()->db->createCommand($query)->queryRow();
                $gruppi             = $this->getGruppiCorsoCalenndario($dettaglio['id']);
                
                $tmp['titolo']      = str_replace("'", "", $dettaglio['titolo'] . " <br > " . $dettaglio['tipo'])." ".$gruppi ;
                $tmp['color']       = Yii::app()->db->createCommand("SELECT nome FROM doc_colori WHERE id ='" . $dettaglio['colore'] . "' ")->queryScalar();
                $tmp['id']          = $idFormazione[$x];
                $tmp['data']        = $dettaglio['data'];
                $tmp['data_fine']   = $dettaglio['data_fine'];
                
                $tmp['mex']         = $tmp['titolo'] . " inserita con successo";
                $tmp['data_in']     = Yii::app()->MyUtils->getjavascriptDate($tmp['data']) . "-".str_replace(":","-",$dettaglio['ora']);
                $dettaglio['data_fine'] ? $tmp['data_out'] = Yii::app()->MyUtils->getjavascriptDate($tmp['data_fine']) . "-".str_replace(":","-",$dettaglio['ora']): $tmp['data_out']  = $tmp['data_in'] ;
                                
                $tmp['data_anno']   = $dettaglio['data_anno'];
                
                $tmp['small']       = "<a href='javascript:checkFormazione(" . $dettaglio['id'] . ")' class='formazione' data-refer='" . $dettaglio['id'] . "' id='formazione-" . $dettaglio['id'] . "' style='background-color:" . Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id ='" . $dettaglio['colore'] . "' ")->queryScalar() . "'>".$dettaglio['codice']."</a>";
                
                $newFormazione[] = $tmp;
            }

            $dati['newFormazione'] = $newFormazione;
            $dati['newDate'] = 'Y';
        }


        if (count($idFormazione) > 0)
            $dati['idRemove'] = implode(",", $oldFormazione);
        if ($error)
            $dati['error'] = $error;

        return $dati;
    }
    
    public function addFormazione() {
        
        $d = explode("-",$this->data);
        
        $query = " INSERT INTO " . $this->tableName() . " (data, titolo, ora, id_categoria, invio_sms, invio_email, giorni_invio_sms, giorni_invio_email , anno) VALUE ";
        $query .="('" . $this->data . "', '" . $this->titolo . "' ,'" . $this->ora . "' ,'" . $this->id_categoria . "' ,'" . $this->invio_sms . "' , '" . $this->invio_email. "' ,'".$this->giorni_invio_sms."','".$this->giorni_invio_email."','".$d[0]."' )";
        Yii::app()->db->createCommand($query)->execute();
        $ID = Yii::app()->db->getLastInsertId();
                
        // MONDO NOTIFICA PUSH
       // Yii::app()->MyPush->newNotificaton($this->tableName(), "fof", "create", $ID);
        return $ID ;
    }
    
    public function afterSave()
    {
        $this->setGruppi();
        $this->setUtenti();
		$this->syncCorsiTags($this->selectedTags);

        $users = $this->getUtentiConcorso();

        if($this->invio_email == 'Y') {
            if(count($users)) {
                foreach($users as $user) {
                    if($user['email']) {
                        $queue = new EmailQueue();
                        $queue->id_user = $user['id'];
                        $queue->to_email = $user['email'];
                        $queue->subject = "Invito ".$this->titolo;
                        $queue->from_email = 'gest.qualita@cooperativadoc.it';
                        $queue->from_name = 'Piattaforma Qualità Cooperativadoc';
                        $queue->date_published = new CDbExpression('NOW()');
                        $queue->date_scheduled = date_create($this->data." ".$this->ora)->modify('-'.$this->giorni_invio_email.' days')->format('Y-m-d H:i:s');
                        $queue->message = Yii::app()->controller->renderPartial('//mail/formazione', array('model'=>$this,'name'=>$user['nome']), true);
                        $queue->save();
                    }
                }
            }
        }

        if($this->invio_sms == 'Y') {
            if(count($users)) {
                foreach($users as $user) {
                    if($user['cellulare']) {
                        $queue = new SmsQueue();
                        $queue->id_user = $user['id'];
                        $queue->recipient = $user['cellulare'];
                        $queue->sender = "QualitàDoc";
                        $queue->date_published = new CDbExpression('NOW()');
                        $queue->date_scheduled = date_create($this->data." ".$this->ora)->modify('-'.$this->giorni_invio_sms.' days')->format('Y-m-d H:i:s');
                        $queue->message = "Ciao ".$user['nome']."\nSei stato invitato al corso ".$this->titolo."\nEntra nella piattaforma per controllare il tuo calendario\nhttps://qualita.cooperativadoc.it";
                        $queue->save();
                    }
                }
            }
        }

        parent::afterSave();
    }
    
    public function getUtentiConcorso()
    {
        $sql = "SELECT u.id, u.nome, u.email, u.cellulare
                FROM utenti u
                INNER JOIN doc_formazione_utenti_gruppi ug ON u.id = ug.id_utente
                INNER JOIN doc_formazione_gruppi_corsi gc ON gc.id_gruppo = ug.id_gruppo
                WHERE gc.id_corso = :corso_id
                UNION
                SELECT u.id, u.nome, u.email, u.cellulare
                FROM utenti u
                INNER JOIN utenti_tags_assoc uta ON uta.utente_id = u.id
                INNER JOIN formazione_corsi_tags fct ON fct.tag_id = uta.tag_id
                WHERE fct.corso_id = :corso_id";

        $user = Yii::app()->db->createCommand($sql)->queryAll(true, array(':corso_id' => (int)$this->id));

        return $user;
    }

    public function afterValidate()
    {
        $data = FormazioneTitoloCorsi::model()->findByPk($this->titolo_id);
        $this->titolo = $data->titolo_corso;
        
        parent::afterValidate();
    }
}
        
        
        
