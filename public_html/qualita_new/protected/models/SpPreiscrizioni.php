<?php

class SpPreiscrizioni extends CActiveRecord {

    var $datiEsportazione = array();
    var $selectCamere = array();
    var $selectNazioni = array();
    var $selectAppartamenti = array();
    var $selectOccupazioni = array();
    var $selectConoscenza = array();
    var $selectLivelli = array();
    var $selectQuartieri = array();
    var $selectCoabitazione = array();
    var $selectProvincie = array();
    var $selectAnni = array();
	var $selectAlloggi = array();
    var $selectAmiciGenere = array();
    var $selectAmiciOccupazioni = array();
    var $selectAmiciEta = array();
    var $selectFumatori = array();
    var $selectAnimali = array();
    var $selectAmiciQuanti = array();
    var $selectCambioResidenza = array();
    
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'sp_preiscrizioni';
    }
	
//~ 	public function relations()
//~     {
//~         return array(
//~             'lavoratori'=>array(self::HAS_ONE, 'SpLavoratori', 'id'),
//~         );
//~     }

    public function rules() {

        return array(
            array('data_in, data_out, data_nascita, nome,cognome, email,cellulare, sesso,formula,  luogo_nascita, nazionalita,prima_volta,occupazione,privacy,conoscenza', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
            #array('data_in, data_out, data_nascita , scadenza_documento', 'date', 'format' => 'YYYY-mm-dd', 'allowEmpty' => true, 'message' => 'La {attribute} non &egrave; valida'),
            #array('formula', 'validaFormula'),
            array('email', 'email', 'message' => 'Email non valida'),
            array('anno', 'length', 'max' => 4),
            array('studente_det, occupazione_det', 'length', 'max' => 255),
            array('camera_amici , amici_genere , amici_occupazione , amici_eta , amici_fumo , amici_animali ', 'length', 'max' => 1),
            
            array('indirizzo,residenza,dove_vive_altro ,camera_amici_dettaglio ,  tipo_documento , numero_documento , permesso_soggiorno , occupazione_det', 'length', 'max' => 50),
            array('numero_civico, cap , provincia, dove_vive ','numerical', 'integerOnly' => true),
            array('codice_fiscale', 'length', 'max' => 16, 'message' => 'Il campo {attribute} non &egrave; valido'),
            array('camera, appartamento,animali, coinquilini,nuova_residenza, camera_singola , camera_doppia , camera_indiferente, dove_vive,amici_eta, amici_fumo, amici_animali, amici_occupazione', 'length', 'max' => 3, 'message' => 'Il campo {attribute} non &egrave; valido'),
            array('camera,appartamento,interessato,nome,cognome,email,cellulare,note, sesso, data_nascita, luogo_nascita, nazionalita,prima_volta,occupazione,data_in, data_out,mailing,privacy,media,consenso,conoscenza, indirizzo', 'safe', 'on' => 'search'),
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
        return array();
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
            'camera' => 'Camera',
            'tipo_camera' => '<span class="hidden-480">Tipo </span>Camera',
            'appartamento' => 'Appartamento',
            'tipo_appartamento' => '<span class="hidden-480">Tipo </span>Apparamento',
            'livello' => 'Spesa massima',
            'coinquilini' => 'Coinquilini',
            'coinquilini_n' => 'N Coinquilini',
            'quartieri' => 'Quartieri',
            'studente_det' => 'Dettaglio',
            'fumatore' => 'Fumatore',
            'animali' => 'Animali',
            'animali_dett' => 'Specificare',
            'interessato' => 'Altro interesse ',
            'coabitazione' => 'In coabiatazione con ',
            'data_in' => 'Data arrivo',
            'data_out' => 'Data partenza',
            'privacy' => 'Consenso Privacy',
            'mailing' => 'Iscrizione mailing List',
			'media' => 'Consenso utilizzo foto/video',
			'consenso' => 'Consenso trattamento dati',
            'note' => 'Note',
            'data_insert' => 'Data preiscrizione',
            'formula' => 'Formula abitativa',
            'anno' => 'Anno',
            
            "codice_fiscale" => "Codice Fiscale",
            "residenza" => "Citt&agrave;",
            "cap" => "Cap",
            "provincia" => "Provincia",
            "indirizzo" => "Indirizzo",
            "numero_civico" => "N&deg;",
            "tipo_documento" => "Tipo documento",
            "numero_documento" => "Numero",
            "scadenza_documento" => "Scadenza documento",
            "permesso_soggiorno" => "Permesso soggiorno",
            "occupazione_det" => "Dettaglio",
            "dove_vive" => "Dove vive",
            "dove_vive_altro" => "Dove vive altro / specificare",
            "camera_amici" => "Amici",
            "camera_amici_dettaglio" => "Nome Amici",
            "amici_genere" => "Genere",
            "amici_occupazione" => "Occupazione",
            "amici_eta" => "Et&agrave;",
            "amici_fumo" => "Fumatori",
            "amici_animali" => "Animali",
            "amici_animali_dettaglio" => "Specificare",
            "nuova_residenza" => "Nuova residenza",
            "giorni_visita" => "Giorni visita",
            "camera_doppia" => "Camera doppia",
            "camera_singola" => "Camera singola",
            "camera_indiferente" => "Albergo",
            
            
        );
    }

    public function search() {


        $criteria = new CDbCriteria;

        $criteria->order = "id DESC";
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome);
        $criteria->compare('cognome', $this->cognome);
        $criteria->compare('data_nascita', $this->data_nascita);
        $criteria->compare('luogo_nascita', $this->luogo_nascita);
        $criteria->compare('nazionalita', $this->nazionalita);
        $criteria->compare('sesso', $this->sesso);
        $criteria->compare('email', $this->email);
        $criteria->compare('cellulare', $this->cellulare);
        $criteria->compare('formula', $this->formula);
        $criteria->compare('occupazione', $this->occupazione);
        $criteria->compare('prima_volta', $this->prima_volta);
        $criteria->compare('conoscenza', $this->conoscenza);
        $criteria->compare('conoscenza_det', $this->conoscenza_det);
        $criteria->compare('coabitazione', $this->coabitazione);
        $criteria->compare('data_in', $this->data_in);
        $criteria->compare('data_out', $this->data_out);
        $criteria->compare('privacy', $this->privacy);
        $criteria->compare('mailing', $this->mailing);
		$criteria->compare('media', $this->media);
        $criteria->compare('note', $this->note);
        $criteria->compare('data_insert', $this->data_insert);
        $criteria->compare('camera', $this->camera);
        $criteria->compare('tipo_camera', $this->tipo_camera);
        $criteria->compare('appartamento', $this->appartamento);
        $criteria->compare('tipo_appartamento', $this->tipo_appartamento);
        $criteria->compare('livello', $this->livello);
        $criteria->compare('coinquilini', $this->coinquilini);
        $criteria->compare('coinquilini_n', $this->coinquilini_n);
        $criteria->compare('quartieri', $this->quartieri);
        $criteria->compare('fumatore', $this->fumatore);
        $criteria->compare('animali', $this->animali);
        $criteria->compare('anno', $this->anno);
        $criteria->compare('animali_det', $this->animali_det);
        $criteria->compare('interessato', $this->interessato);
        $criteria->compare("codice_fiscale", $this->codice_fiscale);
        $criteria->compare("residenza", $this->residenza);
        $criteria->compare("cap", $this->cap);
        $criteria->compare("provincia", $this->provincia);
        $criteria->compare("indirizzo", $this->indirizzo);
        $criteria->compare("numero_civico", $this->numero_civico);
        $criteria->compare("tipo_documento", $this->tipo_documento);
        $criteria->compare("numero_documento", $this->numero_documento);
        $criteria->compare("scadenza_documento", $this->scadenza_documento);
        $criteria->compare("permesso_soggiorno", $this->permesso_soggiorno);
        $criteria->compare("occupazione_det", $this->occupazione_det);
        $criteria->compare("dove_vive", $this->dove_vive);
        $criteria->compare("dove_vive_altro", $this->dove_vive_altro);
        $criteria->compare("camera_amici", $this->camera_amici);
        $criteria->compare("camera_amici_dettaglio", $this->camera_amici_dettaglio);
        $criteria->compare("amici_genere", $this->amici_genere);
        $criteria->compare("amici_occupazione", $this->amici_occupazione);
        $criteria->compare("amici_eta", $this->amici_eta);
        $criteria->compare("amici_fumo", $this->amici_fumo);
        $criteria->compare("amici_animali", $this->amici_animali);
        $criteria->compare("amici_animali_dettaglio", $this->amici_animali_dettaglio);
        $criteria->compare("nuova_residenza", $this->nuova_residenza);
        $criteria->compare("giorni_visita", $this->giorni_visita);
        $criteria->compare("camera_singola", $this->camera_singola);
        $criteria->compare("camera_doppia", $this->camera_doppia);
        $criteria->compare("camera_indiferente", $this->camera_indiferente);
        $criteria->compare("studenti_det", $this->studente_det);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
		
		$tmp  = "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp  .= "<span class='bold'>Arrivo:</span> ".Yii::app()->MyUtils->reverseDate($data->data_in)." <br />";
		$tmp .= "<span class='bold'>Partenza:</span> ".Yii::app()->MyUtils->reverseDate($data->data_out)." <br />";
		return $tmp;  
	}
	
	
	
    public function getDataInFormated($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_in);
    }

    public function getDataOutFormated($data, $t) {
        return Yii::app()->MyUtils->getItaDate($data->data_out);
    }

    public function geLivello($dato, $id) {
        if ($dato == '7')
            $livello = Yii::app()->db->createCommand("SELECT livello_altro FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();
        else
            $livello = Yii::app()->db->createCommand("SELECT nome FROM sp_livello WHERE id='" . $dato . "'")->queryScalar();

        return $livello;
    }

    public function getCoinquilini($dato, $id) {
        $coinquilini = Yii::app()->MyUtils->getYN($model->coinquilini);
        if ($dato == 'Y')
            $coinquilini .= Yii::app()->db->createCommand("SELECT coinquilini_n FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();


        return $coinquilini;
    }

    public function getAnimali($dato, $id) {
        $animali = Yii::app()->MyUtils->getYN($model->animali);
        if ($dato == 'Y')
            $animali .= Yii::app()->db->createCommand("SELECT animali_det FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();

        return $animali;
    }

    public function getConoscenza($dato, $id) {
        if ($dato == '11')
            $conoscenza = Yii::app()->db->createCommand("SELECT conoscenza_det FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();
        else
            $conoscenza = Yii::app()->db->createCommand("SELECT nome FROM sp_conoscenza WHERE id='" . $dato . "'")->queryScalar();

        return $conoscenza;
    }

    public function getQuartieri($id) {

        $quartieri = explode(",", $id);
        for ($z = 0; $z < count($quartieri); $z++)
            $q .= Yii::app()->db->createCommand("SELECT nome FROM sp_quartiere WHERE id='" . $quartieri[$z] . "'")->queryScalar() . " ";

        return $q;
    }

    public function getAbitazione($data, $t) {

        $txt = '';
        if ($data->camera == 'Y')
            $txt .="Camera :" . Yii::app()->db->createCommand("SELECT nome FROM sp_camera WHERE id='" . $data->tipo_camera . "'")->queryScalar() . " \n ";
        if ($data->appartamento == 'Y')
            $txt .="Appartamento :" . Yii::app()->db->createCommand("SELECT nome FROM sp_appartamento WHERE id='" . $data->tipo_appartamento . "'")->queryScalar();

        return $txt;
    }

    public function getDettaglioFormula($camera, $appartamento, $id) {

        $txt = '';

        if ($camera == 'Y') {
            $tipo = Yii::app()->db->createCommand("SELECT tipo_camera FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();
            $txt .= "Camera " . Yii::app()->db->createCommand("SELECT nome FROM sp_camera WHERE id='" . $tipo . "'")->queryScalar() . " \n \r ";
        }

        if ($appartamento == 'Y') {
            $tipo = Yii::app()->db->createCommand("SELECT tipo_camera FROM sp_preiscrizioni WHERE id='" . $id . "'")->queryScalar();
            $txt .= "Appartamento " . Yii::app()->db->createCommand("SELECT nome FROM sp_appartamento WHERE id='" . $tipo . "'")->queryScalar();
        }

        return $txt;
    }

    protected function afterValidate() {
        
    }

    public function setSelectValue() {
        $this->selectCamere = Yii::app()->MyUtils->getSelect('sp_camera');
        $this->selectAppartamenti = Yii::app()->MyUtils->getSelect('sp_appartamento');
        $this->selectNazioni = Yii::app()->MyUtils->getSelect('doc_nazioni');
        $this->selectOccupazioni = Yii::app()->MyUtils->getSelect('sp_occupazione');
        $this->selectConoscenza = Yii::app()->MyUtils->getSelect('sp_conoscenza');
        $this->selectLivelli = Yii::app()->MyUtils->getSelect('sp_livello');
        $this->selectQuartieri = Yii::app()->MyUtils->getSelect('sp_quartiere');
        $this->selectCoabitazione = Yii::app()->MyUtils->getSelect('sp_coabitazione');
        $this->selectProvincie = Yii::app()->MyUtils->getSelect('sp_province');
        
		$this->selectAlloggi = Yii::app()->MyUtils->getSelect('sp_alloggio');
        $this->selectAmiciGenere = Yii::app()->MyUtils->getSelect('sp_amici_genere');
        $this->selectAmiciOccupazioni = Yii::app()->MyUtils->getSelect('sp_amici_occupazione');
        $this->selectAmiciEta = Yii::app()->MyUtils->getSelect('sp_amici_eta');
        $this->selectFumatori = Yii::app()->MyUtils->getSelect('sp_amici_fumatori');
        $this->selectAnimali = Yii::app()->MyUtils->getSelect('sp_amici_animali');
        $this->selectCambioResidenza = Yii::app()->MyUtils->getSelect('sp_residenza');
        $this->selectAmiciQuanti = Yii::app()->MyUtils->getSelect('sp_amici');
		
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = " SELECT q.* , q.id , q.nome , q.cognome, q.luogo_nascita, DATE_FORMAT(q.data_nascita ,'%d-%m-%Y' ) as nascita ,DATE_FORMAT(q.scadenza_documento ,'%d-%m-%Y' ) as scadenza 
            ,DATE_FORMAT(q.data_in ,'%d-%m-%Y' ) as arrivo ,DATE_FORMAT(q.data_out ,'%d-%m-%Y' ) as partenza ,DATE_FORMAT(q.data_insert ,'%d-%m-%Y' ) as inserimento ,
            q.sesso , q.email ,q.cellulare ,n.nome as nome_nazione ,p.nome as nome_provincia , o.nome as nome_occupazione, q.camera as camera , q.appartamento as appartamento ,
            c.nome as nome_conoscenza , q.note , q.anno ,a.nome as nome_appartamento ,ca.nome as nome_camera , q.quartieri as quartieri
            FROM sp_preiscrizioni as q
            LEFT JOIN sp_appartamento as a ON q.appartamento = a.id
            LEFT JOIN sp_camera as ca ON q.appartamento = ca.id
            LEFT JOIN doc_nazioni as n ON q.nazionalita = n.id
            LEFT JOIN sp_province as p ON q.provincia = p.id
            
            LEFT JOIN doc_occupazioni as o ON q.occupazione = o.id
            LEFT JOIN sp_conoscenza as c ON q.conoscenza = c.id
            
                " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        for ($x = 0; $x < count($dati); $x++) {

            if ($dati[$x]['quartieri']) {
                $qua = explode(",", $dati[$x]['quartieri']);
                for ($z = 0; $z < count($qua); $z++)
                    $q[$x] .= " " . Yii::app()->MyUtils->getSelectValue($qua[$z], 'sp_quartiere');
            }
            $dati[$x]['nome_quartieri'] = $q[$x];
        }


        return $dati;
    }

}