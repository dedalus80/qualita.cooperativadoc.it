<?php

class ShPreiscrizioni extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DbAzionicorrettive the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sh_preiscrizioni';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome,cognome, email,cellulare,note, sesso,formula, data_nascita, luogo_nascita, nazionalita,prima_volta,occupazione,data_in, data_out,privacy,conoscenza', 'required', 'message' => 'Compilare il campo'),
            array('data_in, data_out, data_nascita', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty' => false, 'message' => 'Data non valida'),
            array('formula', 'validaFormula'),
            array('email', 'email', 'message' => 'Email non valida'),
            array('nome,cognome,email,cellulare,note, sesso, data_nascita, luogo_nascita, nazionalita,prima_volta,occupazione,data_in, data_out,mailing,privacy,conoscenza', 'safe', 'on' => 'search'),
        );
    }

    public function validaEmail() {

        $pattern = "^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$";
        if (!eregi($pattern, $this->email))
            $this->addError("email", "Email non valida.");
    }

    public function validaFormula() {

        if ($this->formula == '1' && $this->campus == '0')
            $this->addError("campus", "Specificare formula campus.");
        else if ($this->formula == '2' && $this->housing == '0')
            $this->addError("housing", "Specificare formula housing.");
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
            'data_nascita' => 'Data di nascita',
            'luogo_nascita' => 'Luogo di Nascita',
            'nazionalita' => 'Nazionalit&agrave;',
            'sesso' => 'Sesso',
            'email' => 'Indirizzo E-mail',
            'cellulare' => 'Cellulare',
            'occupazione' => 'Occupazione',
            'prima_volta' => 'Prima Volta',
            'conoscenza' => 'Conoscenza',
            'formula' => 'Formula Abitativa',
            'campus' => 'Formula Campus',
            'housing' => 'Formula Housing',
            'coabitazione' => 'In coabiatazione con ',
            'data_in' => 'Data arrivo',
            'data_out' => 'Data partenza',
            'privacy' => 'Conseso Privacy',
            'mailing' => 'Iscrizione mailing List',
            'note' => 'Note',
            'data_insert' => 'Data preiscrizione',
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
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('data_nascita', $this->data_nascita);
        $criteria->compare('luogo_nascita', $this->luogo_nascita);
        $criteria->compare('nazionalita', $this->nazionalita);
        $criteria->compare('sesso', $this->sesso);
        $criteria->compare('email', $this->email);
        $criteria->compare('cellulare', $this->cellulare);
        $criteria->compare('occupazione', $this->occupazione);
        $criteria->compare('prima_volta', $this->prima_volta);
        $criteria->compare('conoscenza', $this->conoscenza);
        $criteria->compare('formula', $this->formula);
        $criteria->compare('campus', $this->campus);
        $criteria->compare('housing', $this->housing);
        $criteria->compare('coabitazione', $this->coabitazione);
        $criteria->compare('data_in', $this->data_in);
        $criteria->compare('data_out', $this->data_out);
        $criteria->compare('privacy', $this->privacy);
        $criteria->compare('mailing', $this->mailing);
        $criteria->compare('note', $this->note);
        $criteria->compare('data_insert', $this->data_insert);


        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'id DESC',
                    ),
                ));
    }

    public function getSelect($table) {
        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM " . $table)->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }

    public function getSelectValue($id, $table) {
        return Yii::app()->db->createCommand("SELECT nome FROM " . $table . " WHERE id='" . $id . "'")->queryScalar();
    }

    public function getDataInFormated($data, $t) {
        return $this->getItaDate($data->data_in);
    }

    public function getDataOutFormated($data, $t) {
        return $this->getItaDate($data->data_in);
    }

    public function getEsportazione() {
        $dati = Yii::app()->db->createCommand("SELECT * FROM sh_preiscrizioni ")->queryAll();
        return $dati;
    }

    public function getDettaglioFormula($formula, $campus, $housing) {

        $form = $this->getSelectValue($formula, 'doc_formule');

        if ($formula == '1')
            $dett = $this->getSelectValue($campus, 'doc_campus');

        else if ($formula == '2')
            $dett = $this->getSelectValue($housing, 'doc_housing');

        return $form . " - " . $dett;
    }

    public function getFormula($data, $t) {

        $formula = $this->getSelectValue($data->formula, 'doc_formule');
        if ($data->formula == '1')
            $dett = $this->getSelectValue($data->campus, 'doc_campus');

        else if ($data->formula == '2')
            $dett = $this->getSelectValue($data->housing, 'doc_housing');
        return $dett;
    }

    function getItaDate($date) {

        $g = explode(" ", $date);
        $d = explode("-", $g[0]);
        return $d[2] . " " . $this->getMount($d[1]) . " " . $d[0];
    }

    function getUserDate($date) {
        $g = explode(" ", $date);
        $d = explode("-", $g[0]);
        return $d[2] . "-" . $d[1] . "-" . $d[0];
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

    protected function beforeValidate() {


        $n = explode("-", $this->data_nascita);
        $i = explode("-", $this->data_in);
        $o = explode("-", $this->data_out);

        $this->setAttribute('data_nascita', $n[2] . "-" . $n[1] . "-" . $n[0]);
        $this->setAttribute('data_in', $i[2] . "-" . $i[1] . "-" . $i[0]);
        $this->setAttribute('data_out', $o[2] . "-" . $o[1] . "-" . $o[0]);

        return parent::beforeValidate();
    }

}