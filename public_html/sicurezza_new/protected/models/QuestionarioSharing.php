<?php

/**
 * This is the model class for table "questionario_sharing".
 *
 * The followings are the available columns in table 'questionario_sharing':
 * @property integer $id
 * @property string $nome
 * @property string $cognome
 * @property string $data_consegna
 * @property string $data_restituzione
 * @property string $vacanza
 * @property string $struttura_pulizia
 * @property string $stuttura_complessivo
 * @property string $stanza_confort
 * @property string $stanza_arredi
 * @property string $stanza_pulizia
 * @property string $stanza_complessivo
 * @property string $ristorante_servizio
 * @property string $ristorante_attesa
 * @property string $ristorante_cibo
 * @property string $ristorante_menu
 * @property string $ristorante_complessivo
 * @property string $personale_cortesia
 * @property string $personale_professionalita
 * @property string $personale_complessivo
 * @property string $consiglia
 * @property string $suggerimenti
 */
class QuestionarioSharing extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return QuestionarioSharing the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'questionario_sharing';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, cognome', 'required'),
            array('nome, cognome', 'length', 'max' => 30),
            array('vacanza, struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, consiglia', 'length', 'max' => 1),
            array('suggerimenti,data_restituzione', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, nome, cognome, vacanza, struttura_pulizia, struttura_complessivo, stanza_confort, stanza_arredi, stanza_pulizia, stanza_complessivo, ristorante_servizio, ristorante_attesa, ristorante_cibo, ristorante_menu, ristorante_complessivo, personale_cortesia, personale_professionalita, personale_complessivo, consiglia, suggerimenti', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors() {
        return array(
            'dateRangeSearch' => array(
                'class' => 'application.components.behaviors.EDateRangeSearchBehavior',
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'data_consegna' => 'Data Consegna',
            'data_restituzione' => 'Data Restituzione',
            'vacanza' => 'Vacanza',
            'struttura_pulizia' => 'Struttura Pulizia',
            'struttura_complessivo' => 'Struttura Complessivo',
            'stanza_confort' => 'Stanza Confort',
            'stanza_arredi' => 'Stanza Arredi',
            'stanza_pulizia' => 'Stanza Pulizia',
            'stanza_complessivo' => 'Stanza Complessivo',
            'ristorante_servizio' => 'Ristorante Servizio',
            'ristorante_attesa' => 'Ristorante Attesa',
            'ristorante_cibo' => 'Ristorante Cibo',
            'ristorante_menu' => 'Ristorante Menu',
            'ristorante_complessivo' => 'Ristorante Complessivo',
            'personale_cortesia' => 'Personale Cortesia',
            'personale_professionalita' => 'Personale Professionalita',
            'personale_complessivo' => 'Personale Complessivo',
            'consiglia' => 'Consiglia',
            'suggerimenti' => 'Suggerimenti',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);

        $criteria->mergeWith($this->dateRangeSearchCriteria('data_restituzione', $this->data_restituzione));

        $criteria->compare('vacanza', $this->vacanza, true);
        $criteria->compare('struttura_pulizia', $this->struttura_pulizia, true);
        $criteria->compare('struttura_complessivo', $this->struttura_complessivo, true);
        $criteria->compare('stanza_confort', $this->stanza_confort, true);
        $criteria->compare('stanza_arredi', $this->stanza_arredi, true);
        $criteria->compare('stanza_pulizia', $this->stanza_pulizia, true);
        $criteria->compare('stanza_complessivo', $this->stanza_complessivo, true);
        $criteria->compare('ristorante_servizio', $this->ristorante_servizio, true);
        $criteria->compare('ristorante_attesa', $this->ristorante_attesa, true);
        $criteria->compare('ristorante_cibo', $this->ristorante_cibo, true);
        $criteria->compare('ristorante_menu', $this->ristorante_menu, true);
        $criteria->compare('ristorante_complessivo', $this->ristorante_complessivo, true);
        $criteria->compare('personale_cortesia', $this->personale_cortesia, true);
        $criteria->compare('personale_professionalita', $this->personale_professionalita, true);
        $criteria->compare('personale_complessivo', $this->personale_complessivo, true);
        $criteria->compare('consiglia', $this->consiglia, true);
        $criteria->compare('suggerimenti', $this->suggerimenti, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getDataFormated($data, $t) {
        $date = Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->data_consegna . "'")->queryScalar();
        return $this->getItaDate($data->data_consegna);
    }

    public function getEsportazione() {
        $dati = Yii::app()->db->createCommand("SELECT * FROM questionario_sharing")->queryAll();
        return $dati;
    }

    public function getGiudizioVacanza($data, $t) {

        return Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->vacanza . "'")->queryScalar();
    }

    public function getGiudizioStruttura($data, $t) {

        return Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->struttura_complessivo . "'")->queryScalar();
    }

    public function getSelect($table) {
        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM " . $table)->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }

    public function getStrutture($table = null) {
        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM doc_unita  WHERE id NOT IN ('21','22','23','24')")->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }

    public function getSelectValue($id, $table) {
        return Yii::app()->db->createCommand("SELECT nome FROM " . $table . " WHERE id='" . $id . "'")->queryScalar();
    }

    public function getStats($attribute, $periodo) {

        if ($periodo)
           $and = " AND DATE_FORMAT(data_restituzione,'%Y-%m') ='".$periodo."'";
        
        $totale = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE 1 " . $and . "")->queryScalar();
        $dati_e = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE " . $attribute . "='E' " . $and . "")->queryScalar();
        $dati_b = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE " . $attribute . "='B' " . $and . "")->queryScalar();
        $dati_s = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE " . $attribute . "='S' " . $and . "")->queryScalar();
        $dati_i = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE " . $attribute . "='I' " . $and . "")->queryScalar();

        if ($dati_e > 0)
            $dati["Eper"] = number_format($dati_e / $totale * 100, 2);
        else
            $dati["Eper"] = 0;

        if ($dati_b > 0)
            $dati["Bper"] = number_format($dati_b / $totale * 100, 2);
        else
            $dati["Bper"] = 0;
        if ($dati_s > 0)
            $dati["Sper"] = number_format($dati_s / $totale * 100, 2);
        else
            $dati["Sper"] = 0;
        if ($dati_i > 0)
            $dati["Iper"] = number_format($dati_i / $totale * 100, 2);
        else
            $dati["Iper"] = 0;
        
        
        $max = max($dati);

        foreach ($dati as $id => $val) {
            if ($val == $max)
                $dati[$id] = "<span class='val_" . $id . "'>" . $max . "%</span>";
            else
                $dati[$id] = $dati[$id] . "%";
        }
        
        $dati['totale'] = $totale;
        
        return $dati;
    }

    public function getConsiglia($attribute, $periodo) {

        if ($periodo)
           $and = " AND DATE_FORMAT(data_restituzione,'%Y-%m') ='".$periodo."'";

        $totale = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE 1 " . $and . "")->queryScalar();
        $dati_S = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE consiglia='S' " . $and . "")->queryScalar();
        $dati_N = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE consiglia='N' " . $and . "")->queryScalar();
        $dati_F = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_sharing WHERE consiglia='F' " . $and . "")->queryScalar();

        if ($dati_S > 0) 
            $dati["Sper"] = number_format($dati_S / $totale * 100, 2);
        else
            $dati["Sper"] =0;
        
        if ($dati_N > 0)
            $dati["Nper"] = number_format($dati_N / $totale * 100, 2);
        else
            $dati["Nper"] =0;
        
        if ($dati_F > 0)
            $dati["Fper"] = number_format($dati_F / $totale * 100, 2);
        else
            $dati["Fper"] =0;
        
        $max = max($dati);

        foreach ($dati as $id => $val) {
            if ($val == $max)
                $dati[$id] = "<span class='val_" . $id . "'>" . $max . "%</span>";
            else
                $dati[$id] = $dati[$id] . "%";
        }
        return $dati;
    }

    function getItaDate($date) {

        $g = explode(" ", $date);
        $d = explode("-", $g[0]);
        return $d[2] . " " . $this->getMount($d[1]) . " " . $d[0];
    }
    
    
    function getPeriodo($periodo){
        $data = explode("-",$periodo);
        return $this->getMount($data[1]). " ".$data[0];
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

}