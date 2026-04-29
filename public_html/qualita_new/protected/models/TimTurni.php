<?php

class TimTurni extends CActiveRecord {

    
    var $selectSoggiorni = array();
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'tim_turni';
    }
    
    public function rules() {
        
        return array(
            array('codice , data_inizio, data_fine ', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio',),
            array('codice', 'length', 'max' => 100),
            array('online', 'length', 'max' => 1),
            array('iscrizione', 'length', 'max' => 2),
            array('data_inizio , data_fine', 'length', 'max' => 10),
            array('id, codice ,iscrizione, online, data_inizio , data_fine', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'codice' => 'Codice turno',
            'data_inizio' => 'Dal',
            'data_fine' => 'Al',
            'iscrizione' => 'Soggiorno',
            'online' => 'Online',
        );
    }
    
    public function search() {
        
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('data_inizio', $this->data_inizio, true);
        $criteria->compare('data_fine', $this->data_fine, true);
        $criteria->compare('iscrizione', $this->iscrizione, true);
        $criteria->compare('online', $this->online, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function getIscrizione($data, $id){
        return Yii::app()->MyUtils->getSelectValue($data->iscrizione, "tim_soggiorni");
            
    }
    
    public function getOnline($data, $id){
        
       $class='bigger-110 icon-only btn  btn-circle circle-blue';
        
        if($data->online =='Y')
            $tmp = "<span id='online-".$data->id."' ><a data-original-title='ONline clicca per mettere OFFline' class='set-online' rel='tooltip' data-toggle='tooltip' data-table='tim_turni' data-model='TimTurni' data-stato='N' data-refer ='".$data->id."'  ><i class='fa fa-check  green ".$class."'></i></a></span>";
        else
            $tmp = "<sapn id='online-".$data->id."' ><a data-original-title='OFFline clicca per mettere ONline' class='set-online' rel='tooltip' data-toggle='tooltip' data-table='tim_turni' data-model='TimTurni' data-stato='Y' data-refer ='".$data->id."'  ><i class='fa fa-ban red ".$class."'></i></a></span>";
            
        return $tmp ;
            
    }
    
    public function getInizio($data, $id){
        return Yii::app()->MyUtils->reverseDate($data->data_inizio) ;
            
    }
    
    public function getFine($data, $id){
        return Yii::app()->MyUtils->reverseDate($data->data_fine) ;
            
    }
    
    public function setDefaultValues(){
        $this->selectSoggiorni  = Yii::app()->MyUtils->getSelect('tim_soggiorni');
    }
    
    
}
