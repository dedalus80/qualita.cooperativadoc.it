<?php

class ShPreiscrizioni extends CActiveRecord {

    var $datiEsportazione = array();
    var $selectCampus = array();
    var $selectHousing = array();
    var $selectOccupazioni = array();
    var $selectConoscenza = array();
    var $selectFormule  = array();
    var $selectAnni     = array();
    var $selectNazioni  = array();
    var $selectRefer    = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'sh_preiscrizioni';
    }

    public function rules() {
        return array(
            array('nome,cognome, email,cellulare,note, sesso,formula, data_nascita, luogo_nascita, nazionalita,prima_volta,occupazione,data_in, data_out,privacy,conoscenza', 'required', 'message' => 'Compilare il campo'),
            array('data_in, data_out, data_nascita', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty' => false, 'message' => 'Data non valida'),
            array('formula', 'validaFormula'),
            array('anno', 'length', 'max' => 4),
            array('refer', 'length', 'max' => 1),
            array('email', 'email', 'message' => 'Email non valida'),
            array('refer, nome,cognome,email,cellulare,note, sesso, data_nascita, luogo_nascita, nazionalita,prima_volta,occupazione,data_in, data_out,mailing,privacy,conoscenza', 'safe', 'on' => 'search'),
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

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'data_nascita' => 'Data di nascita',
            'luogo_nascita' => 'Luogo di Nascita',
            'nazionalita' => 'Nazionalit&agrave;',
            'sesso' => 'Sesso',
            'email' => '<span class="hidden-480">Indirizzo </span>E-mail',
            'cellulare' => 'Cellulare',
            'occupazione' => 'Occupazione',
            'prima_volta' => 'Prima Volta',
            'conoscenza' => 'Conoscenza',
            'formula' => 'Formula <span class="hidden-480">Abitativa</span>',
            'campus' => '<span class="hidden-480">Tipologia stanza / appartamento</span>',
            'housing' => '<span class="hidden-480">Formula </span>Housing',
            'coabitazione' => 'In coabitazione con ',
            'data_in' => 'Data arrivo',
            'data_out' => 'Data partenza',
            'privacy' => 'Consenso Privacy',
            'mailing' => 'Iscrizione mailing List',
            'note' => 'Note',
            'anno' => 'Anno',
            'data_insert' => 'Data preiscrizione',
            'refer' => 'Refer',
        );
    }
    
    public function search() {

        $criteria = new CDbCriteria;
        $criteria->order = 'data_insert DESC';
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
        $criteria->compare('anno', $this->anno);
        $criteria->compare('refer', $this->refer);
        $criteria->compare('data_insert', $this->data_insert);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
		
		$data->formula == '1' ? $formula = Yii::app()->MyUtils->getSelectValue($data->campus, 'doc_campus') : $formula = Yii::app()->MyUtils->getSelectValue($data->housing, 'doc_housing') ;
		
		$tmp  = "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp .= "<span class='bold'>Arrivo:</span> ".Yii::app()->MyUtils->reverseDate($data->data_in)." <br />";
		$tmp .= "<span class='bold'>Partenza:</span> ".Yii::app()->MyUtils->reverseDate($data->data_out)." <br />";
		$tmp .= "<span class='bold'>Formula:</span> ".$formula."  <br />";
        $tmp .= "<span class='bold'>Refer:</span> ".$this->getRefer($data, $t)."  <br />";
		return $tmp;  
	}
	
	public function getRefer($data , $t){
        return $data->refer =='S' ?  "Sito Sharing" :"Sito Poli";
    }
	
    public function getDataInFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_in);
    }

    public function getDataOutFormated($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_out);
    }

    public function getDettaglioFormula($formula, $campus, $housing) {

        $form = Yii::app()->MyUtils->getSelectValue($formula, 'doc_formule');

        if ($formula == '1')
            $dett = '- '.Yii::app()->MyUtils->getSelectValue($housing, 'doc_housing');
        else if ($formula == '2')
            $dett = '- '.Yii::app()->MyUtils->getSelectValue($campus, 'doc_campus');
        else
            $dett = '';

        return $form . " " . $dett;
    }

    public function getFormula($data, $t) {

        $formula = Yii::app()->MyUtils->getSelectValue($data->formula, 'doc_formule');
        if ($data->formula == '1')
            $dett = Yii::app()->MyUtils->getSelectValue($data->campus, 'doc_campus');

        else if ($data->formula == '2')
            $dett = Yii::app()->MyUtils->getSelectValue($data->housing, 'doc_housing');
        
        return $dett;
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

    public function setSelectValue() {
        $this->selectCampus = Yii::app()->MyUtils->getSelect('doc_campus');
        $this->selectHousing = Yii::app()->MyUtils->getSelect('doc_housing');
        $this->selectFormule = Yii::app()->MyUtils->getSelect('doc_formule');
        $this->selectNazioni = Yii::app()->MyUtils->getSelect('doc_nazioni');
        $this->selectOccupazioni = Yii::app()->MyUtils->getSelect('doc_occupazioni');
        $this->selectConoscenza = Yii::app()->MyUtils->getSelect('doc_conoscenza');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
        $this->selectRefer = array("S" => "Sito Sharing", "P" => "Sito Politecnico");    
    }

    public function getEsportazione($anni = null) {

        //if ($anni && $anni != '0,0,0,0,0')
        //    $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        if($anni) {
            $anni = explode(',', $anni);
            $anni = array_filter($anni, function($a) { return ($a !== '0'); });
            $anni = implode(',', $anni);
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";
        }

        $query = "SELECT q.refer , q.id , q.nome , q.cognome,q.formula, q.luogo_nascita, DATE_FORMAT(q.data_nascita ,'%d-%m-%Y' ) as nascita,
                  DATE_FORMAT(q.data_in ,'%d-%m-%Y' ) as arrivo ,DATE_FORMAT(q.data_out ,'%d-%m-%Y' ) as partenza, 
                  DATE_FORMAT(q.data_insert ,'%d-%m-%Y' ) as inserimento, q.sesso , q.email, q.cellulare ,n.nome as nome_nazionalita,
                  o.nome as nome_occupazione, c.nome as nome_conoscenza, f.nome as nome_formula ,fc.nome as nome_campus,
                  fh.nome as nome_housing, q.note, q.anno, q.privacy, q.mailing, q.prima_volta
                  FROM sh_preiscrizioni as q
                  LEFT JOIN doc_nazioni as n ON q.nazionalita = n.id
                  LEFT JOIN doc_occupazioni as o ON q.occupazione = o.id
                  LEFT JOIN doc_conoscenza as c ON q.conoscenza = c.id
                  LEFT JOIN doc_formule as f ON q.formula = f.id
                  LEFT JOIN doc_campus as fc ON q.campus = fc.id
                  LEFT JOIN doc_housing as fh ON q.housing = fh.id" . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }

}