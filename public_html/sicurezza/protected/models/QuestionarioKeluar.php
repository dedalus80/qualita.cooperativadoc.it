<?php

/**
 * This is the model class for table "questionario_keluar".
 *
 * The followings are the available columns in table 'questionario_keluar':
 * @property integer $id
 * @property string $nome
 * @property string $cognome
 * @property string $sede_operativa
 * @property string $scuola
 * @property string $data_consegna
 * @property string $data_restituzione
 * @property string $villaggio_complessivo
 * @property string $struttura_complessivo
 * @property string $rapporto_keluar
 * @property string $trasporto_nome
 * @property string $trasporto_qualita
 * @property string $trasporto_cortesia
 * @property string $trasporto_tempi
 * @property string $ristorante_servizio
 * @property string $ristorante_cibo
 * @property string $ristorante_menu
 * @property string $personale_cortesia
 * @property string $personale_disponibilita
 * @property string $escursioni__itinerari
 * @property string $escursioni_guida
 * @property string $neve_noleggio
 * @property string $neve_scuola
 * @property string $laboratori_tecnici
 * @property string $laboratori_competenze
 * @property string $consiglia
 * @property string $suggerimenti
 */
class QuestionarioKeluar extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return QuestionarioKeluar the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'questionario_keluar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, cognome, sede_operativa, scuola,struttura_complessivo', 'required'),
            array('nome, cognome', 'length', 'max' => 30),
            array('sede_operativa, scuola, trasporto_nome', 'length', 'max' => 50),
            array('viaggio_complessivo, struttura_complessivo, rapporto_keluar, trasporto_qualita, trasporto_cortesia, trasporto_tempi, ristorante_servizio, ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni__itinerari, escursioni_guida, neve_noleggio, neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia', 'length', 'max' => 1),
            array('suggerimenti,data_restituzione', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, nome, cognome, sede_operativa, scuola, viaggio_complessivo, struttura_complessivo, rapporto_keluar, trasporto_nome, trasporto_qualita, trasporto_cortesia, trasporto_tempi, ristorante_servizio, ristorante_cibo, ristorante_menu, personale_cortesia, personale_disponibilita, escursioni_itinerari, escursioni_guida, neve_noleggio, neve_scuola, laboratori_tecnici, laboratori_competenze, consiglia, suggerimenti', 'safe', 'on' => 'search'),
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
            'sede_operativa' => 'Sede Operativa',
            'scuola' => 'Scuola',
            'data_consegna' => 'Data Consegna',
            'data_restituzione' => 'Data Restituzione',
            'viaggio_complessivo' => 'Giudizzio Complessivo',
            'struttura_nome' => 'Centro vacanza',
            'struttura_complessivo' => 'Struttura Complessivo',
            'rapporto_keluar' => 'Rapporto Keluar',
            'trasporto_nome' => 'Trasporto Nome',
            'trasporto_qualita' => 'Trasporto Qualita',
            'trasporto_cortesia' => 'Trasporto Cortesia',
            'trasporto_tempi' => 'Trasporto Tempi',
            'ristorante_servizio' => 'Ristorante Servizio',
            'ristorante_cibo' => 'Ristorante Cibo',
            'ristorante_menu' => 'Ristorante Menu',
            'personale_cortesia' => 'Personale Cortesia',
            'personale_disponibilita' => 'Personale Disponibilita',
            'escursioni_itinerari' => 'Escursioni Itinerari',
            'escursioni_guida' => 'Escursioni Guida',
            'neve_noleggio' => 'Neve Noleggio',
            'neve_scuola' => 'Neve Scuola',
            'laboratori_tecnici' => 'Laboratori Tecnici',
            'laboratori_competenze' => 'Laboratori Competenze',
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
        $criteria->compare('sede_operativa', $this->sede_operativa, true);
        $criteria->compare('scuola', $this->scuola, true);

        $criteria->mergeWith($this->dateRangeSearchCriteria('data_restituzione', $this->data_restituzione));

        $criteria->compare('viaggio_complessivo', $this->viaggio_complessivo, true);
        $criteria->compare('struttura_complessivo', $this->struttura_complessivo, true);
        $criteria->compare('rapporto_keluar', $this->rapporto_keluar, true);
        $criteria->compare('trasporto_nome', $this->trasporto_nome, true);
        $criteria->compare('trasporto_qualita', $this->trasporto_qualita, true);
        $criteria->compare('trasporto_cortesia', $this->trasporto_cortesia, true);
        $criteria->compare('trasporto_tempi', $this->trasporto_tempi, true);
        $criteria->compare('ristorante_servizio', $this->ristorante_servizio, true);
        $criteria->compare('ristorante_cibo', $this->ristorante_cibo, true);
        $criteria->compare('ristorante_menu', $this->ristorante_menu, true);
        $criteria->compare('personale_cortesia', $this->personale_cortesia, true);
        $criteria->compare('personale_disponibilita', $this->personale_disponibilita, true);
        $criteria->compare('escursioni_itinerari', $this->escursioni_itinerari, true);
        $criteria->compare('escursioni_guida', $this->escursioni_guida, true);
        $criteria->compare('neve_noleggio', $this->neve_noleggio, true);
        $criteria->compare('neve_scuola', $this->neve_scuola, true);
        $criteria->compare('laboratori_tecnici', $this->laboratori_tecnici, true);
        $criteria->compare('laboratori_competenze', $this->laboratori_competenze, true);
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
        $dati = Yii::app()->db->createCommand("SELECT * FROM questionario_keluar")->queryAll();
        return $dati;
    }

    public function getGiudizioViaggio($data, $t) {

        return Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->viaggio_complessivo . "'")->queryScalar();
    }

    public function getGiudizioStruttura($data, $t) {

        return Yii::app()->db->createCommand("SELECT nome FROM doc_giudizzi WHERE id='" . $data->struttura_complessivo . "'")->queryScalar();
    }

    public function getStruttura($data, $t) {

        return Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $data->struttura_nome . "'")->queryScalar();
    }

    public function getSelect($table, $limit=null) {
        if ($limit)
            $l = " LIMIT " . $limit;

        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM " . $table . $l)->queryAll();
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

    public function getStats($attribute, $struttura, $periodo= null) {

        if ($struttura)
            $and = "AND struttura_nome='" . $struttura . "'";

        if ($periodo)
            $and = " AND DATE_FORMAT(data_restituzione,'%Y-%m') ='" . $periodo . "'";


        $totale = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE 1 " . $and . "")->queryScalar();
        $dati_e = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE " . $attribute . "='E' " . $and . "")->queryScalar();
        $dati_b = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE " . $attribute . "='B' " . $and . "")->queryScalar();
        $dati_s = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE " . $attribute . "='S' " . $and . "")->queryScalar();
        $dati_i = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE " . $attribute . "='I' " . $and . "")->queryScalar();

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

        return $dati;
    }

    public function getConsiglia($attribute, $struttura, $periodo= null) {

        if ($struttura)
            $and = "AND struttura_nome='" . $struttura . "'";

        if ($periodo)
            $and = " AND DATE_FORMAT(data_restituzione,'%Y-%m') ='" . $periodo . "'";


        $totale = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE 1 " . $and . "")->queryScalar();
        $dati_S = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE consiglia='S' " . $and . "")->queryScalar();
        $dati_N = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE consiglia='N' " . $and . "")->queryScalar();
        $dati_F = Yii::app()->db->createCommand("SELECT count(id) FROM  questionario_keluar WHERE consiglia='F' " . $and . "")->queryScalar();

        if ($dati_S > 0)
            $dati["Sper"] = number_format($dati_S / $totale * 100, 2);
        else
            $dati["Sper"] = 0;

        if ($dati_N > 0)
            $dati["Nper"] = number_format($dati_N / $totale * 100, 2);
        else
            $dati["Nper"] = 0;

        if ($dati_F > 0)
            $dati["Fper"] = number_format($dati_F / $totale * 100, 2);
        else
            $dati["Fper"] = 0;

        $max = max($dati);

        foreach ($dati as $id => $val) {
            if ($val == $max)
                $dati[$id] = "<span class='val_" . $id . "'>" . $max . "%</span>";
            else
                $dati[$id] = $dati[$id] . "%";
        }
        return $dati;
    }

    function getQuestionarioByStructure($id) {

        $dati = Yii::app()->db->createCommand("SELECT * FROM questionario_keluar WHERE struttura_nome ='" . $id . "'")->queryAll();
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