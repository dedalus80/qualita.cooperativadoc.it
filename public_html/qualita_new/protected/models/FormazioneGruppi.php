<?php

class FormazioneGruppi extends CActiveRecord{
	
    var $iscritti  = array();
    
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'doc_formazione_gruppi';
	}

	public function rules()	{
		
		return array(
			array('nome', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
			array('nome', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nome', 'safe', 'on'=>'search'),
		);
	}
	
	public function relations()	{
		
		return array(
		);
	}
	
	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
		);
	}

	public function search()	{
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('nome',$this->nome,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getPartecipanti($data, $id){
        
        return "<span id='gruppo_".$data->id."'>".Yii::app()->db->createCommand("SELECT COUNT(id) FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='" . $data->id . "' ")->queryScalar()."</span>";
        
    }
    
    public function getIscritti($data, $id){
        
        return "<i class='add-to-group ace-icon fa fa-user-circle  bigger-110 icon-only btn  btn-circle circle-blue' data-toggle='tooltip' data-placement='top' title='Aggiungi iscritti al gruppo' data-refer='".$data->id."'  ></i>";
        
    }
    
    public function getUtenti(){
        
        $iscritti = array();
        
        $tmp  = Yii::app()->db->createCommand("SELECT id_utente FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$this->id."' ")->queryAll();
        
        for($x=0; $x < count($tmp);$x++){
            $iscritti[] = $tmp[$x]['id_utente']; 
        }
        
        $user = Yii::app()->db->createCommand("SELECT id, nome , cognome FROM utenti ")->queryAll();
        
        $table ='<table class="table table-striped table-bordered dataTable">';
        $table .="<thead><tr><th class='max50 centered'>Assegna</th><th>Nome</th><th>Cognome</th></tr></thead>";
        $table .="<tbody>";
        
        for($x=0 ; $x < count($user); $x++){
            
            in_array($user[$x]['id'], $iscritti) ? $check ='checked="checked"': $check="";
            
            $table .= "<tr><td class='max50 centered'><input type='checkbox' class='check-user checkbox-green' ".$check." data-refer='".$user[$x]['id']."' ></td><td>".$user[$x]['nome']."</td><td>".$user[$x]['cognome']."</td></tr>";
        }
                
        $table .="</tbody>";
        $result['table'] = $table;
        $result['nome']  = $this->nome;
        
        return $result;
    }
    
    
    public function setUtenti(){
        
        // Cancello tutti gli utenti e inserisco quelli nuovi
        
        $y = 0 ;
        
        Yii::app()->db->createCommand("DELETE FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$this->id."' ")->execute();
        for($x = 0 ; $x <count($this->iscritti); $x ++){
            
            if($this->iscritti[$x]){
                
                Yii::app()->db->createCommand("INSERT INTO doc_formazione_utenti_gruppi (id_gruppo , id_utente) VALUE ('".$this->id."','".$this->iscritti[$x]."') ")->execute();
                
                $y++;
            }
            
           
        }
        
        $result["text"] =  "<b>".$y."</b> Iscritti assegati al gruppo <b>".$this->nome."</b>" ; 
        $result["totale"] = $y;
        
        return $result ; 
        
    }
    
    
    
    
}