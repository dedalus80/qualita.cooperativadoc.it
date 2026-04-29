<?php

class Letture extends CActiveRecord {

    var $selectMatricole = array();
    var $selectTipologie = array("1" => "Acqua", "2" => "Energetico", "3" => "Gas");
    var $letture = array();
    var $datiEsportazione = array();
    var $struttura_nome = "";
    var $typeUser = '';

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'doc_letture';
    }

    public function rules() {

        return array(
            array('id_matricola, data_lettura, incremento', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('id_matricola', 'numerical', 'integerOnly' => true),
            array('incremento, differenza', 'numerical', 'message' => 'Inserire solo valori numerici per il campo {attribute} '),
            array('data_lettura', 'checkData'),
            array('id, id_matricola, data_lettura, incremento, differenza', 'safe', 'on' => 'search'),
        );
    }

    public function checkData() {
        $isData = Yii::app()->db->createCommand("SELECT id FROM doc_letture WHERE id!='" . $this->id . "' AND id_matricola ='" . $this->id_matricola . "' AND data_lettura ='" . $this->data_lettura . "'    ")->queryScalar();
        if ($isData)
            $this->addError("data_lettura", "&egrave; gi&agrave; stata inserita la lettura di questo contatore per la data indicata <b>" . Yii::app()->MyUtils->reverseDate($this->data_lettura) . "</b>");
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_matricola' => 'Matricola',
            'data_lettura' => 'Data <span class="no-phone">Lettura</span>',
            'incremento' => 'Lettura ',
            'differenza' => 'Differenza',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_lettura DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('id_matricola', $this->id_matricola);
        $criteria->compare('data_lettura', $this->data_lettura);
        $criteria->compare('incremento', $this->incremento);
        $criteria->compare('differenza', $this->differenza);

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        if (Yii::app()->user->getId() == 110)
            $criteria->compare('id_matricola', $this->getMatricole());
        else if ($this->typeUser != 'admin')
            $criteria->compare('id_matricola', $this->getMatricole());
        else
            $criteria->compare('id_matricola', $this->id_matricola);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getStruttura($data, $t) {
        $matricola = Yii::app()->db->createCommand("SELECT id_struttura FROM doc_matricole WHERE id='" . $data->id_matricola . "'")->queryScalar();
        return Yii::app()->MyUtils->getSelectValue($matricola, "doc_unita");
    }

    public function getTipologia($data, $t) {
        $tipologia = Yii::app()->db->createCommand("SELECT tipo_matricola FROM doc_matricole WHERE id='" . $data->id_matricola . "'")->queryScalar();
        return $this->selectTipologie[$tipologia];
    }

    public function getMatricola($data, $t) {
        return Yii::app()->db->createCommand("SELECT matricola FROM doc_matricole WHERE id='" . $data->id_matricola . "'")->queryScalar();
    }

    public function getDataLettura($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_lettura);
    }

    public function getMatricole() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());

        if (Yii::app()->user->getId() == 110)
            $where = "WHERE id_struttura IN ('19', '20', '21', '22')";
        else if ($this->typeUser != 'admin')
            $where = "WHERE id_struttura IN (" . Yii::app()->MyUtils->getUserStruttura() . ")";

        $matricole = Yii::app()->db->createCommand("SELECT id  FROM doc_matricole " . $where . "   ")->queryAll();

        for ($x = 0; $x < count($matricole); $x++)
            $code[] = "'" . $matricole[$x]['id'] . "'";

        if (count($code))
            return implode(",", $code);
    }

    public function setSelect() {

        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());

        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() == 110)
            $where = "WHERE id_struttura IN ('19', '20', '21', '22')";
        else if ($this->typeUser != 'admin')
            $where = "WHERE id_struttura IN (" . Yii::app()->MyUtils->getUserStruttura() . ")";

        $matricole = Yii::app()->db->createCommand("SELECT m.* , s.nome as struttura  FROM doc_matricole AS m LEFT JOIN doc_unita as s ON m.id_struttura = s.id  " . $where . "   ")->queryAll();
        for ($x = 0; $x < count($matricole); $x++)
            $this->selectMatricole[$matricole[$x]['id']] = $this->selectTipologie[$matricole[$x]['tipo_matricola']] . " - " . $matricole[$x]['struttura'] . " - " . $matricole[$x]['matricola'];
    }

    public function getDifferenza() {

        #LO FACCIO SU TUTTE LE LETTURE DELLA MATRICOLA 
        $letture = Yii::app()->db->createCommand("SELECT * FROM doc_letture WHERE id_matricola = '" . $this->id_matricola . "'")->queryAll();
        for ($x = 0; $x < count($letture); $x++) {

            $letturaPrecedente = Yii::app()->db->createCommand("SELECT incremento  FROM doc_letture WHERE id_matricola = '" . $this->id_matricola . "' AND data_lettura < '" . $letture[$x]['data_lettura'] . "'  ORDER BY data_lettura DESC")->queryScalar();
            if (!$letturaPrecedente)
                $differenza = 0;
            else
                $differenza = $letture[$x]['incremento'] - $letturaPrecedente;

            Yii::app()->db->createCommand("UPDATE doc_letture SET differenza = '" . $differenza . "' WHERE id='" . $letture[$x]['id'] . "'   ")->execute();
        }
    }

    public function getContatori() {

        $letture = array();

        $matricole = $this->getMatricole();
        if ($matricole) {
            $contatori = Yii::app()->db->createCommand("SELECT DISTINCT(id_matricola)  FROM " . $this->tableName() . " WHERE id_matricola IN (" . $matricole . ") ")->queryAll();
            for ($x = 0; $x < count($contatori); $x++) {
                $query = "SELECT le.*, DATE_FORMAT(le.data_lettura, '%d-%m-%Y') , u.nome as struttura ,  ma.tipo_matricola ,ma.matricola FROM " . $this->tableName() . " as le
                LEFT JOIN doc_matricole AS ma ON id_matricola = ma.id 
                LEFT JOIN doc_unita AS u ON ma.id_struttura = u.id
                WHERE le.id_matricola ='" . $contatori[$x]['id_matricola'] . "' ORDER BY le.data_lettura DESC ";
                $letture[$x] = Yii::app()->db->createCommand($query)->queryRow();
                $letture[$x]['strutture'] = $this->selectTipologie[$letture[$x]['tipo_matricola']];
            }
        }

        return $letture;
    }

    public function getEsportazione() {

        $query = " SELECT * , DATE_FORMAT(data_lettura , '%d-%m-%Y') as data  FROM " . $this->tableName() . " WHERE id_matricola ='" . $this->id_matricola . "' ORDER BY data_lettura ";
        $this->datiEsportazione['letture'] = Yii::app()->db->createCommand($query)->queryAll();

        $query = " SELECT ma.* ,u.nome as struttura FROM doc_matricole  AS ma
            LEFT JOIN doc_unita AS u ON ma.id_struttura = u.id WHERE ma.id ='" . $this->id_matricola . "' ";

        $this->datiEsportazione['matricola'] = Yii::app()->db->createCommand($query)->queryRow();
        $this->datiEsportazione['matricola']['tipo'] = $this->selectTipologie[$this->datiEsportazione['matricola']['tipo_matricola']];
        return $this->datiEsportazione;
    }

}