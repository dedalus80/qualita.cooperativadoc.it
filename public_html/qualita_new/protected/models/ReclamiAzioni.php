<?php

class ReclamiAzioni extends CActiveRecord {

    var $datiEsportazione = array();
    var $selectFunzioni = array();
    var $selectStrutture = array();
    var $selectReclami = array();
    var $selectAnni = array();
	var $refer  = array();
    var $codice = '';
    var $typeUser = '';

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_reclami_azioni';
    }

    public function rules() {

        return array(
            array('id_reclamo, nome, cognome, entro_il,funzione, descrizione', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_reclamo,funzione', 'numerical', 'integerOnly' => true),
            array('nome, cognome', 'length', 'max' => 20),
            array('allegato', 'length', 'max' => 255),
            array('anno, unita_operativa ', 'length', 'max' => 4),
            array('id, id_reclamo, nome, cognome, entro_il, effettuata_il, descrizione, allegato', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'reclamo' => array(self::BELONGS_TO, 'DbReclami', 'id_reclamo'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_reclamo' => 'Reclamo',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'entro_il' => 'Entro Il',
            'effettuata_il' => 'Effettuata Il',
            'descrizione' => 'Descrizione',
            'allegato' => 'Allegato',
            'funzione' => 'Funzione',
            'anno' => 'Anno',
            'unita_operativa' => 'Struttura'
        );
    }

    public function search() {


        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('id_reclamo', $this->id_reclamo);
        $criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('funzione', $this->funzione, true);
        $criteria->compare('entro_il', $this->entro_il, true);
        $criteria->compare('effettuata_il', $this->effettuata_il, true);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('allegato', $this->allegato, true);
        $criteria->compare('anno', $this->anno, true);
        
        if (!$this->unita_operativa)
            //$criteria->addInCondition('unita_operativa', Yii::app()->MyUtils->getUserStruttura(), 'AND');
            $criteria->addInCondition('unita_operativa', Yii::app()->user->getState('strutture'), 'AND');
        if (!$this->anno)
            $criteria->compare('anno', date("Y"), true);
        else
            $criteria->compare('anno', $this->anno, true);
        
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 25,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->effettuata_il)." <br />";
		$tmp .= "<span class='bold'>Codice:</span> ".Yii::app()->db->createCommand("SELECT codice FROM db_reclami WHERE id = '" . $data->id_reclamo . "'  ")->queryScalar()." <br />";
		$tmp .= "<span class='bold'>Funzione:</span> ".Yii::app()->MyUtils->getSelectValue($data->funzione, "doc_funzione")." <br />";
		return $tmp;
	}
	
	public function getData($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->entro_il);
    }

    public function getDataIns($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->effettuata_il);
    }

    public function getFunzione($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->funzione, "doc_funzione");
    }

    public function getAllegato($data, $t) {

        $allegato = '';

        if ($data->allegato)
            $allegato = "<a href='/../qualita_new/images/allegati_reclami/" . $data->allegato . "' target='_blank'  rel='tooltip' data-toggle='tooltip' title=''  data-original-title='Visualizza allegati'  >" . $data->allegato . "</a>";

        return $allegato;
    }

    public function getCodice($data, $t) {

        return Yii::app()->db->createCommand("SELECT codice FROM db_reclami WHERE id = '" . $data->id_reclamo . "'  ")->queryScalar();
    }

    public function getCodiceReclamo() {

        return Yii::app()->db->createCommand("SELECT codice FROM db_reclami WHERE id = '" . $this->id_reclamo . "'  ")->queryScalar();
    }

    public function getUnitaReclamo() {
        return Yii::app()->db->createCommand("SELECT unita_operativa FROM db_reclami WHERE id = '" . $this->id_reclamo . "'  ")->queryScalar();
    }

    public function setDefaultValue() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        $this->selectFunzioni = Yii::app()->MyUtils->getSelect('doc_funzione');
        $this->selectReclami = Yii::app()->MyUtils->getSelect('codici_reclami');
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
		$this->refer = $this->getReclamoDetail($this->id_reclamo);
    }
	
	public function getReclamoDetail($id){
		
		$query = "SELECT c.nome as canale ,t.nome as tipologia ,a.descrizione,a.codice, a.nome, a.cognome, a.canale_altro,a.tipologia_altro FROM db_reclami AS a 
		LEFT JOIN doc_reclami_canali AS c ON a.canale = c.id
		LEFT JOIN doc_reclami_tipologie AS t ON a.tipologia = t.id
		WHERE a.id='" . $id . "'";
		return  Yii::app()->db->createCommand($query)->queryRow();
	}
		
    public function getNomeAllegato() {

        $end = explode(".", $this->allegato);
        $a = Yii::app()->db->createCommand("SELECT COUNT(id) FROM " . $this->tableName() . " WHERE id_reclamo = '" . $this->id_reclamo . "'  ")->queryScalar() + 1;

        return "Allegato_" . $a . "_Reclamo_" . $this->codice . "." . $end[1];
    }

    public function getPreviusAllegato() {
        return Yii::app()->db->createCommand("SELECT allegato FROM " . $this->tableName() . " WHERE id = '" . $this->id . "'  ")->queryScalar();
    }

    public function getEsportazione($anno = NULL) {

       $WHERE = " WHERE  r.unita_operativa IN (" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        if ($anno)
            $WHERE .= " AND a.anno IN (" . $anno . ") ";

        $query = " SELECT r.id , r.id_reclamo , r.nome , r.cognome , r.descrizione , DATE_FORMAT(entro_il,'%d-%m-%Y') as entro_il , re.codice , r.anno,
            DATE_FORMAT(effettuata_il,'%d-%m-%Y') as effettuata_il , u.nome as nome_unita , f.nome as nome_funzione FROM db_reclami_azioni as r
            LEFT JOIN doc_unita  AS u ON r.unita_operativa = u.id
            LEFT JOIN db_reclami  AS re ON r.id_reclamo = re.id
            LEFT JOIN doc_funzione  AS f ON r.funzione = f.id " . $WHERE;
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getReclamoId($id)
    {
        $reclamo = DbReclami::model()->findByPk($this->id_reclamo);

        if($reclamo) {
            return $reclamo->id_utente;
        }

        return false;
    }

}