<?php

class DbNonconforme extends CActiveRecord {

    public $allegato;
    var $selectFunzioni = array();
    var $selectSocieta = array();
    var $selectTipologie = array();
    var $selectUnita = array();
    var $selectAzioni = array();
    var $selectResponsabili = array();
    var $selectChiusure = array();
    var $selectCodici = array();
    var $datiEsportazione = array();
    var $selectAnni = array();
    var $typeUser = '';
    var $indicatori = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_nonconforme';
    }

    public function rules() {

        return array(
            array('societa,  nome, cognome,data_nc, funzione, tipologia, descrizione, trattamento, responsabile', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            array('societa, unita_operativa, funzione, tipologia, responsabile, chiusura', 'numerical', 'integerOnly' => true, 'message' => 'Sono accettati solo valori numerici per il campo {attribute}'),
            array('codice', 'length', 'max' => 20),
            array('data_nc', 'length', 'max' => 10),
            array('trattamento_note', 'length', 'max' => 5000),
            array('trattamento_accettato,approvato,apertura_ac', 'length', 'max' => 1),
            array('anno', 'length', 'max' => 4),
            array('unita_operativa', 'validaUnita'),
            array('allegato', 'file', 'types' => 'jpg, gif, png, doc, pdf, xls, xxls', 'message' => 'Possono essere caricati solo file con le seguenti estensioni jpg, png, doc, xls, pdf', 'allowEmpty' => true),
            array('trattamento_note,approvato, trattamento_data, trattamento_accettato, id, data, data_nc, societa, unita_operativa, nome, cognome, funzione, tipologia, descrizione, trattamento, responsabile, codice, chiusura', 'safe', 'on' => 'search'),
        );
    }

    public function validaUnita() {
        $typeUser = Yii::app()->db->createCommand("SELECT user_type FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryScalar();
        if ($typeUser == 'admin' || Yii::app()->user->getId() == 110) {
            if (!$this->unita_operativa || $this->unita_operativa == '')
                $this->addError("unita_operativa", "Indicare unita operativa");
        }
    }

    public function relations() {
        return array();
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'data' => 'Data<span class="hidden-480"> inserimento</span>',
            'data_aggiornamento' => 'Aggiornato il ',
            'societa' => 'Societ&agrave; ',
            'unita_operativa' => 'Unit&agrave; <span class="hidden-480">Operativa</span>',
            'nome' => 'Nome ',
            'cognome' => 'Cognome ',
            'funzione' => 'Funzione',
            'tipologia' => 'Tipologia <span class="hidden-480">non conformit&agrave;</span>',
            'descrizione' => 'Descrizione non conformit&agrave;',
            'trattamento' => 'Proposta trattamento non conformatit&agrave;',
            'responsabile' => 'Responsabile <span class="hidden-480">controllo e verifica</span>',
            'codice' => 'Codice',
            'allegato' => 'Allegato',
            'chiusura' => 'Chiusura <span class="hidden-480">non conformit&agrave;</span>',
            'trattamento_accettato' => 'Proposta trattamento accettata',
            'trattamento_data' => 'Data accettazione proposta',
            'trattamento_note' => 'Note',
            'anno' => 'Anno',
            'apertura_ac' => 'Crea Azione correttiva',
            'approvato' => 'Approvato',
            'id_verifica' => 'ID Verifica',
            'data_nc' => 'Data non conformit&agrave;'
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->order = ' data_nc DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('data_aggiornamento', $this->data, true);
        $criteria->compare('data_nc', $this->data_nc, true);
        $criteria->compare('societa', $this->societa);
        //$criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('funzione', $this->funzione);
        $criteria->compare('tipologia', $this->tipologia);
        $criteria->compare('descrizione', $this->descrizione, true);
        $criteria->compare('trattamento', $this->trattamento, true);
        $criteria->compare('responsabile', $this->responsabile);
        $criteria->compare('codice', $this->codice, true);
        $criteria->compare('chiusura', $this->chiusura, true);
        $criteria->compare('apertura_ac', $this->apertura_ac, true);
        $criteria->compare('trattamento_accettato', $this->trattamento_accettato, true);
        $criteria->compare('trattamento_data', $this->trattamento_data, true);
        $criteria->compare('trattamento_note', $this->trattamento_note, true);
        $criteria->compare('allegato', $this->allegato, true);
        
      
        
        if (!$this->unita_operativa) {
            if(Yii::app()->user->getState('group') != 'ADMIN') {
                $criteria->addInCondition('unita_operativa',  Yii::app()->user->getState('strutture'));
            }
        }
        else {
            $criteria->compare('unita_operativa', $this->unita_operativa);
        }
        
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

    function setUserUnita($id) {
        return Yii::app()->MyUtils->getSelectValue($id, "doc_unita");
    }
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data)." <br />";
		$tmp .= "<span class='bold'>Codice:</span> ".$data->codice." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Chiusura:</span> ".Yii::app()->MyUtils->getSelectValue($data->chiusura, "doc_chiusura")."  ";
		return $tmp;
	}
	
	
    public function getDataFormated($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data);
    }

    public function getDataFormatedNc($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_nc);
    }

    public function getDataUpadate($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_aggiornamento);
    }

    public function getFunzione($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->funzione, "doc_funzione");
    }

    public function getSocieta($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->societa, "doc_societa");
    }

    public function getUnita($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }

    public function getChiusura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->chiusura, "doc_chiusura");
    }

    public function getResponsabile($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->responsabile, "doc_responsabile");
    }

    public function getTipologia($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_tipologie_aperture");
    }

    public function getAllegato() {
        return Yii::app()->MyUtils->getSelectValue($this->id, "allegato_nc");
    }

    function generaCodice($unita, $id) {

        #PRIMA LO CANCELLO 
        Yii::app()->db->createCommand("DELETE FROM doc_codici WHERE id_nc ='" . $id . "'")->execute();

        $u = Yii::app()->db->createCommand("SELECT codice FROM doc_unita WHERE id='" . $unita . "'")->queryScalar();
        $c = Yii::app()->db->createCommand("SELECT MAX(id) FROM doc_codici WHERE unita='" . $u . "'")->queryScalar();
        $nc = $c + 1;
        $i = Yii::app()->db->createCommand("INSERT INTO doc_codici (id,unita,id_nc) VALUE ('" . $nc . "', '" . $u . "','" . $id . "')")->execute();
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $u . "-" . $nc . "'  WHERE id='" . $id . "'")->execute();
        return $u . "-" . $nc;
    }

    function deleteCodice() {
        Yii::app()->db->createCommand("DELETE FROM doc_codici WHERE id_nc ='" . $this->id . "'")->execute();
    }

    function updateCodice($id, $codice) {
        Yii::app()->db->createCommand("UPDATE db_nonconforme SET codice='" . $codice . "'  WHERE id='" . $id . "'")->execute();
    }

    function sendEmailTrattamento($id) {
        $dati = Yii::app()->db->createCommand("SELECT * FROM db_nonconforme  WHERE id ='" . $id . "'")->queryAll();

        $object = "TRATTAMNETO AZIONE NON CONFORME RIFIUTATO ";

        $txt = "<div style='background:#F8F8F8;padding: 10px'>";
        $txt .= "<p>La proposta di trattamento per la seguente azione non conforme inserita non &egrave; stata accettata</p>";
        $txt .= "<p>Si prega di aggiornare l'azione non conforme proponendo un altra proposta di trattamento</p>";
        $txt .= "<p><span style='color:#'>" . $dati[0]['trattamento_note'] . "</span></p>";

        $txt .="</div><div style='margin-top: 20px'>";
        $txt .= "Codice :" . $dati[0]['codice'] . " <br> ";
        $txt .= "Data inserimento:" . Yii::app()->MyUtils->getItaDate($dati[0]['data']) . " \n <br>";
        $txt .= "Data non conformit&agrave;:" . Yii::app()->MyUtils->getItaDate($dati[0]['data_nc']) . " \n <br>";
        $txt .= "Inserito da  :" . Yii::app()->db->createCommand("SELECT user FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Nome  :" . $dati[0]['nome'] . " \n ";
        $txt .= "Cognome  :" . $dati[0]['cognome'] . " \n ";
        $txt .= "Funzione  :" . Yii::app()->db->createCommand("SELECT nome FROM doc_funzione WHERE id='" . $dati[0]['funzione'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Responsabile :" . Yii::app()->db->createCommand("SELECT nome FROM doc_responsabile WHERE id='" . $dati[0]['responsabile'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Societa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_societa WHERE id='" . $dati[0]['societa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Unita Operativa :" . Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $dati[0]['unita_operativa'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Tipologia :" . Yii::app()->db->createCommand("SELECT nome FROM doc_tipologie_aperture WHERE id='" . $dati[0]['tipologia'] . "'")->queryScalar() . " \n <br>";
        $txt .= "Descrizione :" . $dati[0]['descrizione'] . " \n <br>";
        $txt .= "Trattamento  RIFIUTATO:" . $dati[0]['trattamento'] . " \n <br>";
        $txt .="</div>";

        $destinatario = Yii::app()->db->createCommand("SELECT email FROM utenti WHERE id='" . $dati[0]['id_utente'] . "'")->queryScalar();

        $mail = new YiiMailer();
        $mail->setFrom('info@cooperativadoc.it', 'Qualita cooperativadoc');
        $mail->setTo(array('djamal@archynet.it', $destinatario));
        $mail->setSubject($object);
        $mail->setBody($object . "\n \n " . $txt);
        $mail->send();
    }

    protected function beforeValidate() {
        return parent::beforeValidate();
    }

    public function setDefaultValue() {

        # SELECT VARIE PER INSERIMENTO DATI ------------------------------------
        $this->typeUser = Yii::app()->MyUtils->getUserType(Yii::app()->user->getId());
        $this->selectFunzioni = Yii::app()->MyUtils->getSelect('doc_funzione');
        $this->selectSocieta = Yii::app()->MyUtils->getSelect('doc_societa');
        $this->selectTipologie = Yii::app()->MyUtils->getSelect('doc_tipologie_aperture');
        $this->selectUnita = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectResponsabili = Yii::app()->MyUtils->getSelect('doc_responsabile');
        $this->selectChiusure = Yii::app()->MyUtils->getSelect('doc_chiusura');
        $this->selectCodici = Yii::app()->MyUtils->getSelect('codici_nc');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anno = null) {

        $WHERE = " WHERE  a.unita_operativa IN (" . implode(",", Yii::app()->MyUtils->getUserStruttura()) . ")";
        if ($anno)
            $WHERE .= " AND a.anno IN (" . $anno . ") ";

        $query = " SELECT  a.id ,DATE_FORMAT(a.data, '%d-%m-%Y') as data ,DATE_FORMAT(a.data_nc, '%d-%m-%Y') as data_nc ,  a.nome , a.cognome,  a.trattamento , a.anno ,a.codice as codice, a.anno as anno
            ,u.nome as nome_utente , f.nome as nome_funzione , soc.nome as nome_societa , tip.nome as nome_tipologia_apertura,
             uni.nome as nome_unita_operativa , chi.nome as nome_chiusura , res.nome as nome_responsabile  FROM db_nonconforme AS a 
            LEFT JOIN utenti AS u ON a.id_utente  = u.id 
            LEFT JOIN doc_funzione AS f ON a.funzione  = f.id
            LEFT JOIN doc_societa AS soc ON a.societa  = soc.id
            LEFT JOIN doc_tipologie_aperture AS tip ON a.tipologia  = tip.id
            LEFT JOIN doc_unita AS uni ON a.unita_operativa  = uni.id
            LEFT JOIN doc_chiusura AS chi ON a.chiusura  = chi.id
            LEFT JOIN doc_responsabile AS res ON a.responsabile  = res.id " . $WHERE;
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function openAzioneCorrettiva() {
        $isAC = Yii::app()->db->createCommand("SELECT id FROM  db_azionicorrettive WHERE  codice_riferimento='" . $this->id . "'  ")->queryScalar();
        if (!$isAC) {
            $query = "INSERT INTO db_azionicorrettive (tipo_azione,data_az,id_utente,anno,funzione,unita_operativa,societa,tipologia,codice_riferimento, nome, cognome ) VALUE ";
            $query .= "('1','" . date("Y") . "-" . date("m") . "-" . date("d") . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->funzione . "','" . $this->unita_operativa . "','" . $this->societa . "','" . $this->tipologia . "','" . $this->id . "','" . $this->nome . "','" . $this->cognome . "')";
            Yii::app()->db->createCommand($query)->execute();
        }
    }

    public function getPicture($forPdf = false) {
        $picture = VerificheAnswers::model()->findByAttributes(array('verificaId' => $this->id_verifica, 'questionId' => $this->verificaQuestionId));
        
        if($picture && $picture->file_nc) {
            
            $ncDir = Yii::app()->basePath . '/data/nc';
            $filePath = $ncDir . '/' . $picture->file_nc;
            if(file_exists($filePath)) {
                $isImage = in_array(strtolower(pathinfo($picture->file_nc, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif'));

                if($forPdf) {
                    if($isImage) {
                        return '<img src="'.$filePath.'" width="150" height="150" />';
                    } else {
                        return $picture->file_nc;
                    }
                }

                $fileUrl = Yii::app()->createUrl('azioniVerifiche/downloadNc', array('file' => $picture->file_nc));

                if($isImage) {
                    return '<a href="'.$fileUrl.'" target="_blank"><img src="'.$fileUrl.'" style="max-width: 100px; max-height: 100px; margin-left: 5px;" /></a>';
                } else {
                    return '<a href="'.$fileUrl.'" target="_blank">'.$picture->file_nc.'</a>';
                }
            }
        }
                
        return '';
    }

}