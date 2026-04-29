<?php

class UtenzeGas extends CActiveRecord {
    
    var $datiEsportazione = array();
    var $selectStrutture = array();
    var $selectAnni = array();
    var $struttura_nome = "";
    var $presenze = "";
    var $superficie = "";
    var $media = "";
    var $c_media = "";
    var $c_media_superficie = "";
    var $c_media_utenti = "";
    
    var $utenze = array(); 
    var $typeUser = '';
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'utenze_gas';
    }

    public function rules() {
        return array(
            array('struttura, anno', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('c_gennaio, c_febbraio, c_marzo, c_aprile, c_maggio, c_giugno, c_luglio, c_agosto, c_settembre, c_ottobre, c_novembre, c_dicembre, c_totale', 'numerical', 'message' => 'Sono accettati solo valori numerici pe il campo {attribute}'),
            array('struttura, anno, gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre, totale', 'numerical',  'message' => 'Sono accettati solo valori numerici pe il campo {attribute}'),
            array('id, struttura, anno, gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre, totale', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'struttura' => 'Struttura',
            'superficie' => 'Superficie',
            'totale_litri' => 'Tot. L.',
            'totale_euro' => 'Tot. &euro;',
            'ospiti' => 'Ospiti',
            'media_euro_ospiti' => '&euro; / Ospite',
            'media_euro_superfice' => ' &euro; / Mq',
            'media_mc_ospiti' => 'MC / Ospite',
            'media_mc_superfice' => ' MC / Mq',
            'anno' => 'Anno',
            'gennaio' => 'Gennaio',
            'febbraio' => 'Febbraio',
            'marzo' => 'Marzo',
            'aprile' => 'Aprile',
            'maggio' => 'Maggio',
            'giugno' => 'Giugno',
            'luglio' => 'Luglio',
            'agosto' => 'Agosto',
            'settembre' => 'Settembre',
            'ottobre' => 'Ottobre',
            'novembre' => 'Novembre',
            'dicembre' => 'Dicembre',
            'totale' => 'Totale',
            'c_gennaio' => 'Gennaio',
            'c_febbraio' => 'Febbraio',
            'c_marzo' => 'Marzo',
            'c_aprile' => 'Aprile',
            'c_maggio' => 'Maggio',
            'c_giugno' => 'Giugno',
            'c_luglio' => 'Luglio',
            'c_agosto' => 'Agosto',
            'c_settembre' => 'Settembre',
            'c_ottobre' => 'Ottobre',
            'c_novembre' => 'Novembre',
            'c_dicembre' => 'Dicembre',
            'c_totale' => 'Totale',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('anno', $this->anno);
        $criteria->compare('gennaio', $this->gennaio);
        $criteria->compare('febbraio', $this->febbraio);
        $criteria->compare('marzo', $this->marzo);
        $criteria->compare('aprile', $this->aprile);
        $criteria->compare('maggio', $this->maggio);
        $criteria->compare('giugno', $this->giugno);
        $criteria->compare('luglio', $this->luglio);
        $criteria->compare('agosto', $this->agosto);
        $criteria->compare('settembre', $this->settembre);
        $criteria->compare('ottobre', $this->ottobre);
        $criteria->compare('novembre', $this->novembre);
        $criteria->compare('dicembre', $this->dicembre);
        $criteria->compare('totale', $this->totale);
        $criteria->compare('c_gennaio', $this->c_gennaio);
        $criteria->compare('c_febbraio', $this->c_febbraio);
        $criteria->compare('c_marzo', $this->c_marzo);
        $criteria->compare('c_aprile', $this->c_aprile);
        $criteria->compare('c_maggio', $this->c_maggio);
        $criteria->compare('c_giugno', $this->c_giugno);
        $criteria->compare('c_luglio', $this->c_luglio);
        $criteria->compare('c_agosto', $this->c_agosto);
        $criteria->compare('c_settembre', $this->c_settembre);
        $criteria->compare('c_ottobre', $this->c_ottobre);
        $criteria->compare('c_novembre', $this->c_novembre);
        $criteria->compare('c_dicembre', $this->c_dicembre);
        $criteria->compare('c_totale', $this->c_totale);
        
        $ids = Yii::app()->MyUtils->getUserStruttura();
        if (count($ids) > 0)
            $criteria->addInCondition('struttura', $ids, 'AND');
        else
            $criteria->compare('struttura', $this->struttura);
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura, "doc_unita");
    }
    
    public function getSuperficie($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura, "doc_unita_superficie");
    }
        
    public function getTotale($data, $t) {
        return $data->totale;
    }
    
    public function getTotaleCosti($data, $t) {
        return $data->c_totale;
    }
    
    public function getOspiti($data, $t) {
        return Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE struttura = '" . $data->struttura . "' AND anno = '" . $data->anno . "'  ")->queryScalar();
    }

    public function setTotale() {
        $this->totale = $this->gennaio + $this->febbraio + $this->marzo + $this->aprile + $this->maggio + $this->giugno + $this->luglio + $this->agosto + $this->settembre + $this->ottobre + $this->novembre + $this->dicembre;
        return $this->totale;
    }
    
    public function setCostoTotale() {
        $this->c_totale = $this->c_gennaio + $this->c_febbraio + $this->c_marzo + $this->c_aprile + $this->c_maggio + $this->c_giugno + $this->c_luglio + $this->c_agosto + $this->c_settembre + $this->c_ottobre + $this->c_novembre + $this->c_dicembre;
        return $this->c_totale;
    }
        
    public function getEuroSuperficie($data, $t){
       $tmp = Yii::app()->MyUtils->getMediaConsumi($data->struttura,$this->tableName(),$data->anno,"superficie_unita");
       if($tmp > 0)    
         return $tmp ;
    }
    
    public function getMcSuperficie($data, $t){
        $tmp = Yii::app()->MyUtils->getMediaConsumi($data->struttura,$this->tableName(),$data->anno,"superficie");
        if($tmp > 0)    
         return $tmp ;
    }
    
    public function getEuroOspiti($data, $t){
        $tmp = Yii::app()->MyUtils->getMediaConsumi($data->struttura,$this->tableName(),$data->anno);
        if($tmp > 0)    
         return $tmp ;
    }
    
    public function getMcOspiti($data, $t){
       $tmp = Yii::app()->MyUtils->getMediaConsumi($data->struttura,$this->tableName(),$data->anno,"consumo");
       if($tmp > 0)    
         return $tmp ;
    }
        
    public function setSelect() {
        
        $this->c_media_superficie = "0";
        $this->c_media_utenti = "0";
        $this->media = "0";
        $this->c_media = "0";
                
        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() == 110)
            $this->setAttribute('struttura', array("19", "20", "21", "22"));
        else if ($this->typeUser != 'admin')
            $this->setAttribute('struttura', Yii::app()->MyUtils->getUserStruttura());
        
        
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita'); 
        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->struttura_nome = Yii::app()->MyUtils->getSelectValue($this->struttura, "doc_unita");
        $this->presenze     = Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE struttura = '" . $this->struttura . "' AND anno = '" . $this->anno . "'  ")->queryScalar();
        $this->superficie = Yii::app()->db->createCommand("SELECT superficie FROM doc_unita WHERE id= '" . $this->struttura . "' ")->queryScalar();
        
        if ($this->presenze > 0){
            $this->media = Yii::app()->MyUtils->getMediaConsumi($this->struttura,$this->tableName(),$this->anno,"consumo");   
            $this->c_media = Yii::app()->MyUtils->getMediaConsumi($this->struttura,$this->tableName(),$this->anno); 
        }
        
        if($this->superficie > 0){
            $this->c_media_superficie   = Yii::app()->MyUtils->getMediaConsumi($this->struttura,$this->tableName(),$this->anno,"superficie");
            $this->c_media_utenti       = Yii::app()->MyUtils->getMediaConsumi($this->struttura,$this->tableName(),$this->anno,"superficie_unita");
        }
        
        
        
    }
    
    public function getEsportazione($anno = NULL) {

        if ($anno)
            $WHERE = " WHERE r.anno IN (" . $anno . ")";

        $query = " SELECT r.* , u.nome as nome_unita FROM utenze_gas as r
            LEFT JOIN doc_unita  AS u ON r.struttura = u.id   " . $WHERE;
        $dati = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($dati); $x++) {
            $dati[$x]['presenze'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE struttura = '" . $dati[$x]['struttura'] . "' AND anno = '" . $dati[$x]['anno'] . "'  ")->queryScalar();
            if ($dati[$x]['presenze'] > 0){
                $dati[$x]['media'] = $dati[$x]['totale'] / $dati[$x]['presenze'];
                 $dati[$x]['c_media'] = $dati[$x]['c_totale'] / $dati[$x]['presenze'];
            }else{
                $dati[$x]['media'] = 0;
                $dati[$x]['c_media'] = 0;
                
            }
        }
         return $dati;
    }
    
    

}