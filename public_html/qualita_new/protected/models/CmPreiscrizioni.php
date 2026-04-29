<?php
class CmPreiscrizioni extends CActiveRecord {
        
    var $datiEsportazione = array();
    var $selectStrutture  = array();
    var $selectAnni = array();
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'cm_preiscrizioni';
    }

    public function rules() {

        return array(
            array('numero, cap, altro_numero, altro_cap, casa_vacanza', 'numerical', 'integerOnly' => true),
            array('nome, cognome, luogo_nascita, altro_nome, altro_cognome, altro_luogo_nascita, documento_numero, documento_rilascio, nome_figlio, cognome_figlio, luogo_nascita_figlio, tessera_sanitaria_figlio, classe, sezione, dieta_sanitaria_dettaglio, dieta_religiosa_dettaglio', 'length', 'max' => 50),
            array('residenza', 'length', 'max' => 100),
            array('indirizzo, altro_residenza, altro_indirizzo, altro_email, scuola, disabile_dettaglio', 'length', 'max' => 150),
            array('codicefiscale, altro_codicefiscale, codice_fiscale_figlio', 'length', 'max' => 11),
            array('email', 'length', 'max' => 255),
            array('cellulare, altro_cellulare', 'length', 'max' => 16),
            array('altro_genitore, utente_milano, dieta_sanitaria, dieta_religiosa, insegnante_sostegno, disabile, informativa, privacy, mailing', 'length', 'max' => 1),
            array('documento', 'length', 'max' => 2),
            array('data_nascita,data_ins, altro_data_nascita, data_rilascio, data_nascita_figlio', 'safe'),
            array('id, nome, cognome, luogo_nascita, data_nascita, residenza, indirizzo, numero, codicefiscale, cap, email, cellulare, altro_genitore, altro_nome, altro_cognome, altro_luogo_nascita, altro_data_nascita, altro_residenza, altro_indirizzo, altro_numero, altro_codicefiscale, altro_cap, altro_email, altro_cellulare, documento, documento_numero, documento_rilascio, data_rilascio, nome_figlio, cognome_figlio, luogo_nascita_figlio, data_nascita_figlio, tessera_sanitaria_figlio, codice_fiscale_figlio, scuola, classe, sezione, utente_milano, dieta_sanitaria, dieta_sanitaria_dettaglio, dieta_religiosa, dieta_religiosa_dettaglio, insegnante_sostegno, disabile, disabile_dettaglio, casa_vacanza, informativa, privacy, mailing', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'data_ins' => 'Data iscrizione',
            
            'cognome' => 'Cognome',
            'luogo_nascita' => 'Luogo Nascita',
            'data_nascita' => 'Data Nascita',
            'residenza' => 'Residenza',
            'indirizzo' => 'Indirizzo',
            'numero' => 'Numero',
            'codicefiscale' => 'Codice fiscale',
            'cap' => 'Cap',
            'email' => 'Email',
            'cellulare' => 'Cellulare',
            'altro_genitore' => 'Genitore',
            'altro_nome' => 'Nome',
            'altro_cognome' => 'Cognome',
            'altro_luogo_nascita' => 'Luogo Nascita',
            'altro_data_nascita' => 'Data Nascita',
            'altro_residenza' => 'Residenza',
            'altro_indirizzo' => 'Indirizzo',
            'altro_numero' => 'Numero',
            'altro_codicefiscale' => 'C. Fiscale',
            'altro_cap' => 'Cap',
            'altro_email' => 'Email',
            'altro_cellulare' => 'Cellulare',
            'documento' => 'Documento',
            'documento_numero' => 'Numero documento',
            'documento_rilascio' => 'Rilasciato da',
            'data_rilascio' => 'Rilascioto il',
            'nome_figlio' => 'Nome',
            'cognome_figlio' => 'Cognome',
            'luogo_nascita_figlio' => 'Luogo Nascita',
            'data_nascita_figlio' => 'Data Nascita',
            'tessera_sanitaria_figlio' => 'Tessera Sanitaria',
            'codice_fiscale_figlio' => '<span class="no-phone">Codice Fiscale </span><span class="only-phone">CF. </span>Figlio',
            'scuola' => 'Scuola',
            'classe' => 'Classe',
            'sezione' => 'Sezione',
            'utente_milano' => 'Utente Milano',
            'dieta_sanitaria' => 'Dieta Sanitaria',
            'dieta_sanitaria_dettaglio' => 'Dieta Sanitaria Dettaglio',
            'dieta_religiosa' => 'Dieta Religiosa',
            'dieta_religiosa_dettaglio' => 'Dieta Religiosa Dettaglio',
            'insegnante_sostegno' => 'Insegnante Sostegno',
            'disabile' => 'Disabile',
            'disabile_dettaglio' => 'Disabile Dettaglio',
            'casa_vacanza' => 'Struttura',
            'informativa' => 'Informativa',
            'privacy' => 'Privacy',
            'mailing' => 'Mailing',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('data_ins', $this->data_ins, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('luogo_nascita', $this->luogo_nascita, true);
        $criteria->compare('data_nascita', $this->data_nascita, true);
        $criteria->compare('residenza', $this->residenza, true);
        $criteria->compare('indirizzo', $this->indirizzo, true);
        $criteria->compare('numero', $this->numero);
        $criteria->compare('codicefiscale', $this->codicefiscale, true);
        $criteria->compare('cap', $this->cap);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('cellulare', $this->cellulare, true);
        $criteria->compare('altro_genitore', $this->altro_genitore, true);
        $criteria->compare('altro_nome', $this->altro_nome, true);
        $criteria->compare('altro_cognome', $this->altro_cognome, true);
        $criteria->compare('altro_luogo_nascita', $this->altro_luogo_nascita, true);
        $criteria->compare('altro_data_nascita', $this->altro_data_nascita, true);
        $criteria->compare('altro_residenza', $this->altro_residenza, true);
        $criteria->compare('altro_indirizzo', $this->altro_indirizzo, true);
        $criteria->compare('altro_numero', $this->altro_numero);
        $criteria->compare('altro_codicefiscale', $this->altro_codicefiscale, true);
        $criteria->compare('altro_cap', $this->altro_cap);
        $criteria->compare('altro_email', $this->altro_email, true);
        $criteria->compare('altro_cellulare', $this->altro_cellulare, true);
        $criteria->compare('documento', $this->documento, true);
        $criteria->compare('documento_numero', $this->documento_numero, true);
        $criteria->compare('documento_rilascio', $this->documento_rilascio, true);
        $criteria->compare('data_rilascio', $this->data_rilascio, true);
        $criteria->compare('nome_figlio', $this->nome_figlio, true);
        $criteria->compare('cognome_figlio', $this->cognome_figlio, true);
        $criteria->compare('luogo_nascita_figlio', $this->luogo_nascita_figlio, true);
        $criteria->compare('data_nascita_figlio', $this->data_nascita_figlio, true);
        $criteria->compare('tessera_sanitaria_figlio', $this->tessera_sanitaria_figlio, true);
        $criteria->compare('codice_fiscale_figlio', $this->codice_fiscale_figlio, true);
        $criteria->compare('scuola', $this->scuola, true);
        $criteria->compare('classe', $this->classe, true);
        $criteria->compare('sezione', $this->sezione, true);
        $criteria->compare('utente_milano', $this->utente_milano, true);
        $criteria->compare('dieta_sanitaria', $this->dieta_sanitaria, true);
        $criteria->compare('dieta_sanitaria_dettaglio', $this->dieta_sanitaria_dettaglio, true);
        $criteria->compare('dieta_religiosa', $this->dieta_religiosa, true);
        $criteria->compare('dieta_religiosa_dettaglio', $this->dieta_religiosa_dettaglio, true);
        $criteria->compare('insegnante_sostegno', $this->insegnante_sostegno, true);
        $criteria->compare('disabile', $this->disabile, true);
        $criteria->compare('disabile_dettaglio', $this->disabile_dettaglio, true);
        $criteria->compare('casa_vacanza', $this->casa_vacanza);
        $criteria->compare('informativa', $this->informativa, true);
        $criteria->compare('privacy', $this->privacy, true);
        $criteria->compare('mailing', $this->mailing, true);
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
    
	public function getDettaglio($data , $t){
		
		$tmp  = "<span class='bold'>Nome</span> ".$data->nome." ".$data->cognome." <br />";
		$tmp .= "<span class='bold'>Codice Fiscale:</span> ".$data->codicefiscale." <br />";
		$tmp  .= "<span class='bold'>Casa Vacanza:</span> ".Yii::app()->MyUtils->getSelectValue($data->casa_vacanza, 'doc_unita')." <br />";
		return $tmp;  
	}
	
	
	
    public function getDataIns($data, $t) {
        return Yii::app()->MyUtils->reverseDate($data->data_ins);
    }
    
    public function getStruttura($data, $t) {
        return  Yii::app()->MyUtils->getSelectValue($data->casa_vacanza, 'doc_unita');
    }

    public function setSelectValue() {
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita_comune');
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function getEsportazione($anni = null) {

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = " SELECT q.*, u.nome as srtuttura DATE_FORMAT(q.data_nascita ,'%d-%m-%Y' ) as nascita 
            ,DATE_FORMAT(q.altro_data_nascita ,'%d-%m-%Y' ) as altro_nascita ,DATE_FORMAT(q.data_nascita_figlio ,'%d-%m-%Y' ) as nascita_figlio ,DATE_FORMAT(q.data_rilascio ,'%d-%m-%Y' ) as data_rilascio ,
            FROM ca_preiscrizioni as q LEFT JOIN doc_unita as u ON q.casa_vacanza = u.id " . $WHERE;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }
    
}