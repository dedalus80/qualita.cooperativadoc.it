<?php

class UtenzePresenze extends CActiveRecord {

    var $datiEsportazione = array();
    var $selectStrutture = array();
    var $selectGestioni = array();
    var $selectAnni = array();
    var $selectTipi = array("p"=>"Prezzo", "c" =>"MC / KW" );
    var $stats = array();
    var $struttura_nome = "";
    var $gestione_nome = "";
    var $gestione   = "";
    var $presenze   = "";
    var $media      = "";
    var $tipo       = "";
    var $typeUser   = '';
    var $datiAdmin  = '';

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'utenze_presenze';
    }

    public function rules() {
        return array(
            array('struttura, anno', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('struttura, anno, gennaio, febbraio, marzo, aprile, maggio, giugno, luglio, agosto, settembre, ottobre, novembre, dicembre, totale', 'numerical', 'integerOnly' => true, 'message' => 'Sono accettati solo valori numerici pe il campo {attribute}'),
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
            'totale' => 'Presenze',
            'presenze' => 'Presenze',
            'superficie' => 'Superficie',
            'acqua' => 'Acqua',
            'gas' => 'Gas',
            'energia' => 'Energia',
            'rifiuti' => 'Rifiuti',
            'chimici' => 'Sostanze Chimiche',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('struttura', $this->struttura);
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

        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $criteria->compare('struttura', $user['user_unita']) : $criteria->compare('struttura', $this->struttura) ;
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->struttura, "doc_unita");
    }

    public function getOspiti($data, $t) {
        return Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE struttura = '" . $data->struttura . "' AND anno = '" . $data->anno . "'  ")->queryScalar();
    }

    public function setTotale() {
        $this->totale = $this->gennaio + $this->febbraio + $this->marzo + $this->aprile + $this->maggio + $this->giugno + $this->luglio + $this->agosto + $this->settembre + $this->ottobre + $this->novembre + $this->dicembre;
        return $this->totale;
    }
    
    public function getSuperficie($data, $t){
         return Yii::app()->MyUtils->getSelectValue($data->struttura, "doc_unita_superficie");
    }
    
    public function getPresenze($data, $t){
         return $data->totale;
    }
    
    public function getConsumiAcqua($data, $t){
        $costo = $this->getMediaAcqua($data, $t);
        $media = $this->getCostoMediaAcqua($data, $t);
        if($costo)
            $tmp = $costo." &euro; / Ospite";
        if($media)
            $tmp .= "<br>".$media." Mc / Ospite";
        
        return $tmp;
        
        
       
    }
   
    public function getConsumiLuce($data, $t){
         $costo = $this->getMediaLuce($data, $t);
        $media = $this->getCostoMediaLuce($data, $t);
        if($costo)
            $tmp = $costo." &euro; / Ospite";
        if($media)
            $tmp .= "<br>".$media." kwh / Ospite";
        
        return $tmp;
    }
    
    public function getConsumiGas($data, $t){
         $costo = $this->getMediaGas($data, $t);
        $media = $this->getCostoMediaGas($data, $t);
        if($costo)
            $tmp = $costo." &euro; / Ospite";
        if($media)
            $tmp .= "<br>".$media." Mc / ospite";
        
        return $tmp;
    }
    
    public function getConsumiRifiuti($data, $t){
        $costo = $this->getMediaRifiuti($data, $t);
        $media = $this->getCostoMediaRifiuti($data, $t);
        if($costo)
            $tmp = $costo."&euro; / Ospite";
        if($media)
            $tmp .= "<br>".$media."&euro; / Mq";
        
        return $tmp;
    }
    
    public function getConsumiChimici($data, $t){
        # $costo = $this->getMediaAcqua($data, $t);
        $media = $this->getCostoMediaChimici($data, $t);
        if($costo)
            $tmp = $costo."&euro; / Ospite";
        if($media)
            $tmp .= "<br>".$media." &euro; / Mc";
        
        return $tmp;
    }
    
    public function getCostoMediaAcqua($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_acqua",$data->anno);
    }

    public function getCostoMediaLuce($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_luce",$data->anno);
    }

    public function getCostoMediaGas($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_gas",$data->anno);
    }
    
    public function getCostoMediaRifiuti($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_rifiuti",$data->anno ,"superficie");
    }
    
    public function getCostoMediaChimici($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_chimici",$data->anno);
    }
    
    public function getMediaRifiuti($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_rifiuti",$data->anno);
    }
    
    public function getMediaAcqua($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_acqua",$data->anno,"consumo");
    }

    public function getMediaLuce($data, $t) {
        return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_luce",$data->anno ,"consumo");
        
    }

    public function getMediaGas($data, $t) {
         return Yii::app()->MyUtils->getMediaConsumi($data->struttura,"utenze_gas",$data->anno,"consumo");
    }

    public function setSelect() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() == 110)
            $this->setAttribute('struttura', array("19", "20", "21", "22"));
        else if ($this->typeUser != 'admin')
            $this->setAttribute('struttura', Yii::app()->MyUtils->getUserStruttura());

        $this->datiAdmin = Yii::app()->MyUtils->getUserInfo();

        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectGestioni = Yii::app()->MyUtils->getSelect('doc_tipologie_strutture');

        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->struttura_nome = Yii::app()->MyUtils->getSelectValue($this->struttura, "doc_unita");
        $this->gestione_nome = Yii::app()->MyUtils->getSelectValue($this->gestione, "doc_tipologie_strutture");

        $this->presenze = Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE struttura = '" . $this->struttura . "' AND anno = '" . $this->anno . "'  ")->queryScalar();
        if ($this->presenze > 0)
            $this->media = number_format($this->totale / $this->presenze, 4, '.', '');
        else
            $this->media = "0";
    }

    public function getStatistiche() {

        $stats = array();

        $mesi = array("gennaio", "febbraio", "marzo", "aprile", "maggio", "giugno", "luglio", "agosto", "settembre", "ottobre", "novembre", "dicembre");

        $tipiConsumi = array("1"=>"gas", "2"=>"acqua","3"=>"luce","4"=>"rifiuti","5"=>"chimici");
        
        
        if ($this->struttura)
            $and = " AND struttura='" . $this->struttura . "'";
        if ($this->anno)
            $and .= " AND anno = '" . $this->anno . "'";
        if ($this->gestione) {
            $id_s = Yii::app()->MyUtils->getGestioni($this->gestione);
            if (count($id_s))
                $and .= " AND struttura IN (" . implode(",", $id_s) . ") ";
        }
        
        $anni_presenze = Yii::app()->db->createCommand("SELECT DISTINCT(anno) as anno  FROM utenze_presenze WHERE 1 " . $and . " ")->queryAll();
        
        for ($x = 0; $x < count($anni_presenze); $x++) {
            $stats['label_presenze'][] = $anni_presenze[$x]['anno'];
            $stats['x_presenze'][] = "'" . $anni_presenze[$x]['anno'] . "'";
            $stats['key_presenze'][] = "'" . $x . "'";
        }
        
        $stats['totale_presenze'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_presenze WHERE 1  " . $and . "  ")->queryScalar();
        
        foreach ($mesi as $mese) {
            for ($x = 0; $x < count($stats['label_presenze']); $x++) {
                $tot = Yii::app()->db->createCommand("SELECT SUM(" . $mese . ")  FROM utenze_presenze WHERE anno ='" . $stats['label_presenze'][$x] . "' " . $and . " ")->queryScalar();
                if (!$tot)
                    $tot = 0;

                $tmp['presenze'][$mese][] = $x . ":" . $tot;
            }
            if ($tmp['presenze'][$mese])
                $stats['presenze'][] = "{ y: '" . $mese . "'," . implode(",", $tmp['presenze'][$mese]) . "  }";
        }
        
        foreach($tipiConsumi AS $id => $nome){
            $anni =  Yii::app()->db->createCommand("SELECT DISTINCT(anno) as anno  FROM utenze_".$nome." WHERE 1 " . $and . " ")->queryAll(); 
            for ($x = 0; $x < count($anni); $x++) {
                $stats['label_'.$nome][] = $anni[$x]['anno'];
                $stats['x_'.$nome][] = "'" . $anni[$x]['anno'] . "'";
                $stats['key_'.$nome][] = "'" . $x . "'";
            }
        }
        
        foreach ($mesi as $mese) {
            
            foreach($tipiConsumi AS $id => $nome){
                for ($x = 0; $x < count($stats['label_'.$nome]); $x++) {
                    $tot = Yii::app()->db->createCommand("SELECT SUM(" . $mese . ")  FROM utenze_".$nome." WHERE anno ='" . $stats['label_'.$nome][$x] . "' " . $and . " ")->queryScalar();
                    if (!$tot)
                        $tot = 0;

                    $tmp[$nome][$mese][] = $x . ":" . $tot;
                }
                if ($tmp[$nome][$mese])
                    $stats[$nome][] = "{ y: '" . $mese . "'," . implode(",", $tmp[$nome][$mese]) . "  }";
            }
        }
        
        foreach($tipiConsumi AS $id => $nome){
            $stats['totale_'.$nome] = Yii::app()->db->createCommand("SELECT totale FROM utenze_".$nome." WHERE 1  " . $and . "  ")->queryScalar();
            $stats['c_totale_'.$nome] = Yii::app()->db->createCommand("SELECT c_totale FROM utenze_".$nome." WHERE 1  " . $and . "  ")->queryScalar();
            if ($stats['totale_presenze'] > 0) {
                $stats['media_'.$nome] = number_format($stats['totale_'.$nome] / $stats['totale_presenze'], 4, '.', '');
                $stats['costo_'.$nome] = number_format($stats['c_totale_'.$nome] / $stats['totale_presenze'], 4, '.', '');
            } else 
                $stats['media_'.$nome] = $stats['costo_'.$nome] = 0;
        }
        
        return $stats;
    }

    public function getEsportazione($anno = NULL) {

        if ($anno)
            $WHERE = " WHERE r.anno IN (" . $anno . ")";

        $query = " SELECT r.* , u.nome as nome_unita FROM utenze_presenze as r
            LEFT JOIN doc_unita  AS u ON r.struttura = u.id   " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($dati); $x++) {
            $dati[$x]['acqua'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_acqua WHERE struttura = '" . $dati[$x]['struttura'] . "'  AND anno ='" . $dati[$x]['anno'] . "'   ")->queryScalar();
            $dati[$x]['gas'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_gas WHERE struttura = '" . $dati[$x]['struttura'] . "'  AND anno ='" . $dati[$x]['anno'] . "'  ")->queryScalar();
            $dati[$x]['luce'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_luce WHERE struttura = '" . $dati[$x]['struttura'] . "'  AND anno ='" . $dati[$x]['anno'] . "'   ")->queryScalar();
            $dati[$x]['rifiuti'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_rifiuti WHERE struttura = '" . $dati[$x]['struttura'] . "'  AND anno ='" . $dati[$x]['anno'] . "'   ")->queryScalar();
            $dati[$x]['chimici'] = Yii::app()->db->createCommand("SELECT totale FROM utenze_chimici WHERE struttura = '" . $dati[$x]['struttura'] . "'  AND anno ='" . $dati[$x]['anno'] . "'   ")->queryScalar();

            $dati[$x]['acqua'] > 0 ?    $dati[$x]['media_acqua'] = $dati[$x]['acqua'] / $dati[$x]['totale']: $dati[$x]['media_acqua'] = 0;
            $dati[$x]['luce'] > 0 ?    $dati[$x]['media_luce'] = $dati[$x]['luce'] / $dati[$x]['totale']: $dati[$x]['media_luce'] = 0;
            $dati[$x]['gas'] > 0 ?    $dati[$x]['media_gas'] = $dati[$x]['gas'] / $dati[$x]['totale']: $dati[$x]['media_gas'] = 0;
            $dati[$x]['chimic'] > 0 ?    $dati[$x]['media_chimici'] = $dati[$x]['chimic'] / $dati[$x]['totale']: $dati[$x]['media_chimici'] = 0;
            $dati[$x]['rifiuti'] > 0 ?    $dati[$x]['media_rifiuti'] = $dati[$x]['rifiuti'] / $dati[$x]['totale']: $dati[$x]['media_rifiuti'] = 0;
            
            $dati[$x]['acqua'] > 0 ? "":$dati[$x]['acqua'] = 0;
            $dati[$x]['luce'] > 0 ? "":$dati[$x]['luce'] = 0;
            $dati[$x]['gas'] > 0 ? "":$dati[$x]['gas'] = 0;
            $dati[$x]['rifiuti'] > 0 ? "":$dati[$x]['rifiuti'] = 0;
            $dati[$x]['chimici'] > 0 ? "":$dati[$x]['chimici'] = 0;
            
        }

        return $dati;
    }
    
    public function setStatistiche($struttura= null, $anno = null){
        
        //prendo gli ultimi 5 anni in ordine decrescente

        $dati = array();
        $stats = array("acqua","chimici","gas","luce","rifiuti");
        
        if($struttura){
            $AND                    = " AND struttura ='".$struttura."'";
            $this->struttura        = $struttura ;
            $this->struttura_nome   = Yii::app()->MyUtils->getSelectValue($this->struttura, "doc_unita");
        }
        
        foreach($stats  AS $id ){
            $valori = array();
            
            $tmp  = Yii::app()->db->createCommand("SELECT DISTINCT(anno) FROM utenze_".$id." WHERE 1 ".$AND." ORDER BY anno DESC LIMIT 5")->queryAll();
            for($x=0; $x< count($tmp); $x++){
                $valori['anni'][] = "'".$tmp[$x]['anno']."'";
                $consumi = Yii::app()->db->createCommand("SELECT SUM(totale) FROM utenze_".$id." WHERE anno ='".$tmp[$x]['anno']."' ".$AND." ")->queryScalar();
                $costi   = Yii::app()->db->createCommand("SELECT SUM(c_totale) FROM utenze_".$id." WHERE anno ='".$tmp[$x]['anno']."' ".$AND." ")->queryScalar();
                $costi   > 0 ? $valori['costi'][] = $costi : $valori['costi'][] = 0;  
                $consumi > 0 ?  $valori['consumi'][] = $consumi : $valori['consumi'][] = 0; 
            }
            
            $dati[$id] = $valori;
        }
        
        return $dati;
    }
    
}