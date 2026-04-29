<?php

class CaPreiscrizioni extends CActiveRecord {

    var $datiEsportazione = array();
    var $selectCampus = array();
    var $selectHousing = array();
    var $selectOccupazioni = array();
    var $selectConoscenza = array();
    var $selectFormule  = array();
    var $selectAnni     = array();
    var $selectNazioni  = array();
    var $selectCamere   = array();
    var $selectRefer    = array();
    var $selectFacolta    = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'ca_preiscrizioni';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('coabitazione, data_in, data_out, note, data_insert', 'required'),
            array('nazionalita, occupazione, conoscenza, formula, campus, housing', 'numerical', 'integerOnly' => true),
            array('nome, cognome, luogo_nascita, email', 'length', 'max' => 30),
            array('sesso,refer, prima_volta, privacy, mailing', 'length', 'max' => 1),
            array('cellulare,data_nascita, data_in, data_out', 'length', 'max' => 20),
            array('coabitazione', 'length', 'max' => 255),
            array('data_nascita', 'safe'),
            array('anno', 'length', 'max' => 4),
            array('id, nome,refer, cognome, data_nascita, luogo_nascita, nazionalita, sesso, email, cellulare, occupazione, prima_volta, conoscenza, formula, campus, housing, coabitazione, data_in, data_out, privacy, mailing, note, data_insert, facoltaId', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {

        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'data_nascita' => 'Data Nascita',
            'luogo_nascita' => 'Luogo Nascita',
            'nazionalita' => 'Nazionalita',
            'sesso' => 'Sesso',
            'email' => 'Email',
            'cellulare' => 'Cellulare',
            'occupazione' => 'Occupazione',
            'prima_volta' => 'Prima Volta',
            'conoscenza' => 'Conoscenza',
            'formula' => 'Formula',
            'campus' => 'Camere',
            'housing' => 'Housing',
            'coabitazione' => 'Coabitazione',
            'data_in' => 'Data&nbsp;Arrivo',
            'data_out' => 'Data&nbsp;Partenza',
            'privacy' => 'Privacy',
            'mailing' => 'Mailing',
            'note' => 'Note',
            'anno' => 'Anno',
            'data_insert' => 'Data&nbsp;Preiscrizione',
            'refer' => 'Refer',
			'facoltaId' => 'Facoltà'
        );
    }

    public function search() {


        $criteria = new CDbCriteria;

        $criteria->order = "data_insert DESC ";
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('data_nascita', $this->data_nascita, true);
        $criteria->compare('luogo_nascita', $this->luogo_nascita, true);
        $criteria->compare('nazionalita', $this->nazionalita);
        $criteria->compare('sesso', $this->sesso, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cellulare', $this->cellulare, true);
        $criteria->compare('occupazione', $this->occupazione);
        $criteria->compare('prima_volta', $this->prima_volta, true);
        $criteria->compare('conoscenza', $this->conoscenza);
        $criteria->compare('formula', $this->formula);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('housing', $this->housing);
        $criteria->compare('coabitazione', $this->coabitazione, true);
        $criteria->compare('data_in', $this->data_in, true);
        $criteria->compare('data_out', $this->data_out, true);
        $criteria->compare('privacy', $this->privacy, true);
        $criteria->compare('mailing', $this->mailing, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('anno', $this->anno, true);
        $criteria->compare('refer', $this->refer, true);
        $criteria->compare('facoltaId', $this->facoltaId, true);

        $criteria->compare('data_insert', $this->data_insert, true);

         return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
		
		$formula = Yii::app()->MyUtils->getSelectValue($data->formula, 'doc_formule')." ".Yii::app()->MyUtils->getSelectValue($data->campus, 'doc_camere');
		$tmp  = "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp  .= "<span class='bold'>Arrivo:</span> ".Yii::app()->MyUtils->reverseDate($data->data_in)." <br />";
		$tmp .= "<span class='bold'>Partenza:</span> ".Yii::app()->MyUtils->reverseDate($data->data_out)." <br />";
		$tmp .= "<span class='bold'>Formula:</span> ".$formula."  <br />";
		$tmp .= "<span class='bold'>Refer:</span> ".$this->getRefer($data, $t)."  <br />";
		return $tmp;  
	}
    
	public function getRefer($data , $t){
        return $data->refer =='S' ?  "Campus San Paolo":"Politecnico";
    }
	
	
    public function getDataInFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_in);
    }

    public function getDataOutFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_out);
    }

    public function getDettaglioFormula($formula, $campus) {

        $form = Yii::app()->MyUtils->getSelectValue($formula, 'doc_formule');
        $dett = Yii::app()->MyUtils->getSelectValue($campus, 'doc_camere');


        return $form . " - " . $dett;
    }

    public function getFormula($data, $t) {

        $formula = Yii::app()->MyUtils->getSelectValue($data->formula, 'doc_formule');
        $dett = Yii::app()->MyUtils->getSelectValue($data->campus, 'doc_camere');

        return $formula . " " . $dett;
    }

    public function setSelectValue() {
        $this->selectCampus = Yii::app()->MyUtils->getSelect('doc_campus');
        $this->selectHousing = Yii::app()->MyUtils->getSelect('doc_housing');
        $this->selectFormule = Yii::app()->MyUtils->getSelect('doc_formule');
        $this->selectCamere = Yii::app()->MyUtils->getSelect('doc_camere');
        $this->selectOccupazioni = Yii::app()->MyUtils->getSelect('doc_occupazioni');
        $this->selectConoscenza = Yii::app()->MyUtils->getSelect('doc_conoscenza');
        $this->selectNazioni = Yii::app()->MyUtils->getSelect('doc_nazioni');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->selectRefer = array("S"=>"Sito Campus San Paolo", "P"=>"Sito Politecnico");
		$this->selectFacolta = Yii::app()->MyUtils->getSelect('facolta');
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = "SELECT q.refer , q.id , q.nome , q.cognome, q.luogo_nascita,formula, DATE_FORMAT(q.data_nascita ,'%d-%m-%Y' ) as nascita 
				,DATE_FORMAT(q.data_in ,'%d-%m-%Y' ) as arrivo ,DATE_FORMAT(q.data_out ,'%d-%m-%Y' ) as partenza ,DATE_FORMAT(q.data_insert ,'%d-%m-%Y' ) as inserimento ,
				q.sesso , q.email ,q.cellulare ,n.nome as nome_nazionalita ,o.nome as nome_occupazione,
				c.nome as nome_conoscenza , f.nome as nome_formula ,fc.nome as nome_campus, fh.nome as nome_housing ,q.note , q.anno, fcl.nome_facolta
				FROM ca_preiscrizioni as q
				LEFT JOIN doc_nazioni as n ON q.nazionalita = n.id
				LEFT JOIN doc_occupazioni as o ON q.occupazione = o.id
				LEFT JOIN doc_occupazioni as c ON q.conoscenza = c.id
				LEFT JOIN doc_formule as f ON q.formula = f.id
				LEFT JOIN doc_camere as fc ON q.campus = fc.id
				LEFT JOIN doc_housing as fh ON q.housing = fh.id
				LEFT JOIN facolta as fcl ON fcl.id = q.facoltaId
                " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }
	
	public function getFacolta() {
		if($this->facoltaId) {
			$sql = "SELECT nome_facolta FROM facolta WHERE id = ".$this->facoltaId;
			$data = Yii::app()->db->createCommand($sql)->queryRow();
			
			return $data['nome_facolta'];
		}
		
		return "";
	}
}