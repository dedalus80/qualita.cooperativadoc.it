<?php

class AzioniVerificheAmbientale extends CActiveRecord {
	
	var $selectStrutture = array();
    var $selectTipologie = array("A" => "AUTOVALUTAZIONE", "V" => "VALUTAZIONE");
    var $selectValutazioni = array("C" => "CONFORME", "NC" => "NON CONFORME", "NA" => "NON APPLICABILE", "NR" => "NON RIVELATA");
    var $selectCodici = array();
    var $selectAnni = array();
    var $datiAdmin = "";
    var $campiSezioni = array();
    var $nome_unita = "";
    var $bar = array();
		
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}
	
	public function tableName()	{
		return 'db_verifiche_ambientale';
	}

	public function rules()	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
			array('data, ora_inizio, ora_fine, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3', 'safe'),
			
			array('corso_formazione_ruo, corso_formazione_coordinatori, corso_formazione_educatori, analisi_ambientale, elenco_prescrizioni, scheda_organico, politica_ambientale, piano_obbiettivi, manuale_sga, requisiti_generali, leadership, organigramma, azioni_rischi, aspetti_ambientali, monitor_obbiettivi, rispetto_obblighi, risorse_idonee, comunicazione_efficace, presenza_documentazione, attivita_svolte, valutazione_conformita, miglioramento_continuo', 'length', 'max'=>2),
			array('corso_formazione_ruo_note, corso_formazione_coordinatori_note, corso_formazione_educatori_note, analisi_ambientale_note, elenco_prescrizioni_note, scheda_organico_note, politica_ambientale_note, piano_obbiettivi_note, manuale_sga_note, requisiti_generali_note, leadership_note, organigramma_note, azioni_rischi_note, aspetti_ambientali_note, monitor_obbiettivi_note, rispetto_obblighi_note, risorse_idonee_note, comunicazione_efficace_note, presenza_documentazione_note, attivita_svolte_note, valutazione_conformita_note, miglioramento_continuo_note', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, corso_formazione_ruo, corso_formazione_ruo_note, corso_formazione_coordinatori, corso_formazione_coordinatori_note, corso_formazione_educatori, corso_formazione_educatori_note, analisi_ambientale, analisi_ambientale_note, elenco_prescrizioni, elenco_prescrizioni_note, scheda_organico, scheda_organico_note, politica_ambientale, politica_ambientale_note, piano_obbiettivi, piano_obbiettivi_note, manuale_sga, manuale_sga_note, requisiti_generali, requisiti_generali_note, leadership, leadership_note, organigramma, organigramma_note, azioni_rischi, azioni_rischi_note, aspetti_ambientali, aspetti_ambientali_note, monitor_obbiettivi, monitor_obbiettivi_note, rispetto_obblighi, rispetto_obblighi_note, risorse_idonee, risorse_idonee_note, comunicazione_efficace, comunicazione_efficace_note, presenza_documentazione, presenza_documentazione_note, attivita_svolte, attivita_svolte_note, valutazione_conformita, valutazione_conformita_note, miglioramento_continuo, miglioramento_continuo_note, numero_non_conformita, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3, anno', 'safe', 'on'=>'search'),
		);
	} 
	
	public function relations()	{
		return array(
		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
            'id_verifica' => 'Id Verifica',
            'codice_verifica' => 'Codice<span class="hidden-480"> Verifica</span>',
            'data' => 'Data',
            'unita_operativa' => '<span class="hidden-480">Unita Operativa</span><span class="only-phone">Struttura</span>',
			'autore' => 'Autore',
			'ora_inizio' => 'Ora Inizio',
			'ora_fine' => 'Ora Fine',
			'tipo_valutazione' => 'Tipo Valutazione',
			'apertura_nc' => 'Apertura Nc',
			'corso_formazione_ruo' => 'Il RUO ha partecipato ai corsi di formazione previsti in materia ambientale?',
			'corso_formazione_ruo_note' => 'Corso Formazione Ruo Note',
			'corso_formazione_coordinatori' => 'I coordinatori hanno partecipato ai corsi di formazione previsti in materia ambientale?',
			'corso_formazione_coordinatori_note' => 'Corso Formazione Coordinatori Note',
			'corso_formazione_educatori' => 'Il personale educativo presente al momento della verifica ha partecipato al presoggiorno? ',
			'corso_formazione_educatori_note' => 'Corso Formazione Educatori Note',
			'analisi_ambientale' => 'AAI - Analisi ambientale iniziale',
			'analisi_ambientale_note' => 'Analisi Ambientale Note',
			'elenco_prescrizioni' => 'EPL - Elenco prescrizioni legali ambientali',
			'elenco_prescrizioni_note' => 'Elenco Prescrizioni Note',
			'scheda_organico' => 'MD 01 06 SCHEDA ORGANICO ',
			'scheda_organico_note' => 'Scheda Organico Note',
			'politica_ambientale' => 'Politica ambientale',
			'politica_ambientale_note' => 'Politica Ambientale Note',
			'piano_obbiettivi' => 'Piano degli obiettivi',
			'piano_obbiettivi_note' => 'Piano Obbiettivi Note',
			'manuale_sga' => 'Manuale SGA',
			'manuale_sga_note' => 'Manuale Sga Note',
			'requisiti_generali' => 'Sono rispettati i requisiti generali?',
			'requisiti_generali_note' => 'Requisiti Generali Note',
			'leadership' => 'la leadership è testimoniata e si impegna nel SGA? Esiste una politica',
			'leadership_note' => 'Leadership Note',
			'organigramma' => 'è presente un\'organigramma e una job description?',
			'organigramma_note' => 'Organigramma Note',
			'azioni_rischi' => 'Esistono azioni per affrontare rischi e opportunità?',
			'azioni_rischi_note' => 'Azioni Rischi Note',
			'aspetti_ambientali' => 'Sono curati e valutati gli aspetti ambientali?',
			'aspetti_ambientali_note' => 'Aspetti Ambientali Note',
			'monitor_obbiettivi' => 'Sono monitorati gli obiettivi e il loro raggiungimento?',
			'monitor_obbiettivi_note' => 'Monitor Obbiettivi Note',
			'rispetto_obblighi' => 'Sono rispettati gli obblighi di conformità?',
			'rispetto_obblighi_note' => 'Rispetto Obblighi Note',
			'risorse_idonee' => 'Sono state messe a disposizioen idonee risorse competenze e personale?',
			'risorse_idonee_note' => 'Risorse Idonee Note',
			'comunicazione_efficace' => 'La comunicazioen interne e esterna è efficace, mantenuta e monitorata?',
			'comunicazione_efficace_note' => 'Comunicazione Efficace Note',
			'presenza_documentazione' => 'Le informazioni documentate per la norma, sono presenti?',
			'presenza_documentazione_note' => 'Presenza Documentazione Note',
			'attivita_svolte' => 'Le attività operative sono svolte correttamente ? E le prove di emergenza?',
			'attivita_svolte_note' => 'Attivita Svolte Note',
			'valutazione_conformita' => 'La valutazione delle conformità viene svolta regolarmente? È presente un piano di audit periodico?',
			'valutazione_conformita_note' => 'Valutazione Conformita Note',
			'miglioramento_continuo' => 'Il miglioramento continuo fa parte della realtà procedurale e applicativa dell\'azienda?',
			'miglioramento_continuo_note' => 'Miglioramento Continuo Note',
			'numero_non_conformita' => 'Numero Non Conformita',
			'note_1' => 'Note 1',
			'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili:',
			'note_2' => 'Note 2',
			'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili:',
			'note_3' => 'Note 3',
			'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili:',
			'anno' => 'Anno',
		);
	}
	
	public function search()	{
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('id_verifica',$this->id_verifica);
		$criteria->compare('codice_verifica',$this->codice_verifica,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('unita_operativa',$this->unita_operativa);
		$criteria->compare('autore',$this->autore);
		$criteria->compare('ora_inizio',$this->ora_inizio,true);
		$criteria->compare('ora_fine',$this->ora_fine,true);
		$criteria->compare('tipo_valutazione',$this->tipo_valutazione,true);
		$criteria->compare('apertura_nc',$this->apertura_nc,true);
		$criteria->compare('corso_formazione_ruo',$this->corso_formazione_ruo,true);
		$criteria->compare('corso_formazione_ruo_note',$this->corso_formazione_ruo_note,true);
		$criteria->compare('corso_formazione_coordinatori',$this->corso_formazione_coordinatori,true);
		$criteria->compare('corso_formazione_coordinatori_note',$this->corso_formazione_coordinatori_note,true);
		$criteria->compare('corso_formazione_educatori',$this->corso_formazione_educatori,true);
		$criteria->compare('corso_formazione_educatori_note',$this->corso_formazione_educatori_note,true);
		$criteria->compare('analisi_ambientale',$this->analisi_ambientale,true);
		$criteria->compare('analisi_ambientale_note',$this->analisi_ambientale_note,true);
		$criteria->compare('elenco_prescrizioni',$this->elenco_prescrizioni,true);
		$criteria->compare('elenco_prescrizioni_note',$this->elenco_prescrizioni_note,true);
		$criteria->compare('scheda_organico',$this->scheda_organico,true);
		$criteria->compare('scheda_organico_note',$this->scheda_organico_note,true);
		$criteria->compare('politica_ambientale',$this->politica_ambientale,true);
		$criteria->compare('politica_ambientale_note',$this->politica_ambientale_note,true);
		$criteria->compare('piano_obbiettivi',$this->piano_obbiettivi,true);
		$criteria->compare('piano_obbiettivi_note',$this->piano_obbiettivi_note,true);
		$criteria->compare('manuale_sga',$this->manuale_sga,true);
		$criteria->compare('manuale_sga_note',$this->manuale_sga_note,true);
		$criteria->compare('requisiti_generali',$this->requisiti_generali,true);
		$criteria->compare('requisiti_generali_note',$this->requisiti_generali_note,true);
		$criteria->compare('leadership',$this->leadership,true);
		$criteria->compare('leadership_note',$this->leadership_note,true);
		$criteria->compare('organigramma',$this->organigramma,true);
		$criteria->compare('organigramma_note',$this->organigramma_note,true);
		$criteria->compare('azioni_rischi',$this->azioni_rischi,true);
		$criteria->compare('azioni_rischi_note',$this->azioni_rischi_note,true);
		$criteria->compare('aspetti_ambientali',$this->aspetti_ambientali,true);
		$criteria->compare('aspetti_ambientali_note',$this->aspetti_ambientali_note,true);
		$criteria->compare('monitor_obbiettivi',$this->monitor_obbiettivi,true);
		$criteria->compare('monitor_obbiettivi_note',$this->monitor_obbiettivi_note,true);
		$criteria->compare('rispetto_obblighi',$this->rispetto_obblighi,true);
		$criteria->compare('rispetto_obblighi_note',$this->rispetto_obblighi_note,true);
		$criteria->compare('risorse_idonee',$this->risorse_idonee,true);
		$criteria->compare('risorse_idonee_note',$this->risorse_idonee_note,true);
		$criteria->compare('comunicazione_efficace',$this->comunicazione_efficace,true);
		$criteria->compare('comunicazione_efficace_note',$this->comunicazione_efficace_note,true);
		$criteria->compare('presenza_documentazione',$this->presenza_documentazione,true);
		$criteria->compare('presenza_documentazione_note',$this->presenza_documentazione_note,true);
		$criteria->compare('attivita_svolte',$this->attivita_svolte,true);
		$criteria->compare('attivita_svolte_note',$this->attivita_svolte_note,true);
		$criteria->compare('valutazione_conformita',$this->valutazione_conformita,true);
		$criteria->compare('valutazione_conformita_note',$this->valutazione_conformita_note,true);
		$criteria->compare('miglioramento_continuo',$this->miglioramento_continuo,true);
		$criteria->compare('miglioramento_continuo_note',$this->miglioramento_continuo_note,true);
		$criteria->compare('numero_non_conformita',$this->numero_non_conformita);
		$criteria->compare('note_1',$this->note_1,true);
		$criteria->compare('osservazioni_1',$this->osservazioni_1,true);
		$criteria->compare('note_2',$this->note_2,true);
		$criteria->compare('osservazioni_2',$this->osservazioni_2,true);
		$criteria->compare('note_3',$this->note_3,true);
		$criteria->compare('osservazioni_3',$this->osservazioni_3,true);
		$criteria->compare('anno',$this->anno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getDettaglio($data , $id){
		
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data)."<br />";
		$tmp .= "<span class='bold'>Codice:</span> ".$data->codice_verifica." <br />";
		$tmp .= "<span class='bold'>Struttura:</span> ".Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Autore:</span> ".Yii::app()->MyUtils->getSelectValue($data->autore, "utenti")." <br /> ";
		$tmp .= "<span class='bold'>Stato:</span> ".$this->selectTipologie[$data->tipo_valutazione]."  ".$this->getNC($data, $id);
		return $tmp;
	}
		
	public function getStruttura($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->unita_operativa, "doc_unita");
    }

    public function getOraStart($data, $id) {
        return substr(Yii::app()->MyUtils->reverseDate($data->ora_inizio), 2, 5);
    }

    public function getOraStop($data, $id) {
        return substr(Yii::app()->MyUtils->reverseDate($data->ora_fine), 2, 5);
    }

    public function getData($data, $id) {
        return Yii::app()->MyUtils->reverseDate($data->data);
    }

    public function getAutore($data, $id) {
        return Yii::app()->MyUtils->getSelectValue($data->autore, "utenti");
    }

    public function getNC($data, $id) {

        $totale = 0;
        $field = $this->getFields();
        foreach ($field AS $id => $val)
            $totale += count($field[$id]);

        $color = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($data->numero_non_conformita, $totale));
        return "<span class='nc' >" . $data->numero_non_conformita . "/" . $totale . " - <span class='nc-" . $color . "' >" . Yii::app()->MyUtils->getPercent($data->numero_non_conformita, $totale) . "% </span></span>";
    }

    public function getNCPdf($model) {

        $totale = 0;
        $field = $this->getFields();
        foreach ($field AS $id => $val)
            $totale += count($field[$id]);

        $color = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($model->numero_non_conformita, $totale));
        return "<span class='nc' >" . $model->numero_non_conformita . "/" . $totale . " - <span class='nc-" . $color . "' >" . Yii::app()->MyUtils->getPercent($model->numero_non_conformita, $totale) . "% </span></span>";
    }

    public function getValutazione($data, $id) {
        return $this->selectTipologie[$data->tipo_valutazione];
    }

    public function getTitle($x) {
        $title = array(
            1 => "1. PIANO DELLA FORMAZIONE E DELLA PROGETTAZIONE",
            2 => "2. PIANO DOCUMENTALE ",
            3 => "3. SISTEMA DI GESTIONE AMBIENTALE",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('corso_formazione_ruo', 'corso_formazione_coordinatori', 'corso_formazione_educatori', ),
            'sezione_2' => array('analisi_ambientale', 'elenco_prescrizioni', 'scheda_organico', 'politica_ambientale', 'piano_obbiettivi', 'manuale_sga'),
            'sezione_3' => array('requisiti_generali', 'leadership', 'organigramma', 'azioni_rischi', 'aspetti_ambientali', 'monitor_obbiettivi', 'rispetto_obblighi', 'risorse_idonee', 'comunicazione_efficace', 'presenza_documentazione', 'attivita_svolte','valutazione_conformita','miglioramento_continuo'),
        );
        return $field;
    }

    public function getComplete($x, $tipo = NULL) {

        $field = $this->campiSezioni['sezione_' . $x];

        $complete = 0;
        foreach ($field AS $val) {

            if ($tipo == 'NC') {
                if ($this->$val == 'NC')
                    $complete++;
            }else {
                if ($this->$val != '' AND $this->$val != NULL)
                    $complete++;
            }
        }

        return $complete;
    }

    public function setColors() {

        $tmp = array();
        for ($x = 1; $x <= count($this->campiSezioni); $x++) {
            $tmp['sezione_' . $x]['comlete'] = $complete = $this->getComplete($x);
            $tmp['sezione_' . $x]['complete_nc'] = $complete_NC = $this->getComplete($x, 'NC');
            $tmp['sezione_' . $x]['titolo'] = $this->getTitle($x);
            $tmp['sezione_' . $x]['percent'] = Yii::app()->MyUtils->getPercent($complete, count($this->campiSezioni['sezione_' . $x]));
            $tmp['sezione_' . $x]['badgecolor'] = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($complete_NC, count($this->campiSezioni['sezione_' . $x])));
            $tmp['sezione_' . $x]['color'] = Yii::app()->MyUtils->getColor($tmp['sezione_' . $x]['percent'], 'top');
        }
        return $tmp;
    }

    public function setDefaultValue() {
        $this->campiSezioni = $this->getFields();
        $this->datiAdmin = Yii::app()->MyUtils->getUserInfo();
        $this->selectStrutture = Yii::app()->MyUtils->getSelect('doc_unita');
        $this->selectCodici = Yii::app()->MyUtils->getSelect($this->tableName() . '_codici');
        $this->nome_unita = Yii::app()->MyUtils->getSelectValue($this->unita_operativa, "doc_unita");
        $this->bar = $this->setColors();
        $this->selectAnni = Yii::app()->MyUtils->getYears();
    }

    public function openNonConforme() {

        $field = $this->getFields();
        $label = $this->attributeLabels();
        $user = Yii::app()->MyUtils->getUserInfo();

        foreach ($field AS $sezione => $val) {

            for ($x = 0; $x < count($val); $x++) {

                $isNC = Yii::app()->db->createCommand("SELECT id FROM db_nonconforme WHERE id_verifica ='" . $this->id_verifica . "' AND tipo_verifica ='" . $val[$x] . "' ")->queryScalar();

                if ($this->$val[$x] == 'NC') {
                    if (!$isNC) {
                        $nc = new DbNonconforme;
                        $note = $val[$x] . "_note";
                        $query = "INSERT INTO " . $nc->tableName() . " (data,data_nc,unita_operativa,id_utente,anno,id_verifica,tipo_verifica,descrizione, nome, cognome ,tipologia)  VALUE ";
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "','" . addslashes($user['nome']) . "','" . addslashes($user['cognome']) . "' ,'23')";
                        if (Yii::app()->db->createCommand($query)->execute()) {
                            $LID = Yii::app()->db->lastInsertID;
                            $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $LID);
                            Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET codice ='" . $codice . "' WHERE id ='" . $LID . "'  ")->execute();
                        }
                    }else
                        Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET data= NOW() , data_nc = NOW() , id_utente ='" . Yii::app()->user->getId() . "' , id_verifica ='" . $this->id_verifica . "'  tipo_verifica='" . $val[$x] . "' , descrizione ='" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "'   WHERE id ='" . $isNC . "'  ")->execute();
                }else {
                    if ($isNc)
                        Yii::app()->db->createCommand("DELETE  " . $nc->tableName() . "  WHERE id ='" . $isNC . "'  ")->execute();
                }
            }
        }
    }

    public function updateVerificaGenerale() {

        $totale = 0;
        $this->numero_non_conformita = 0;
        $set = 0;
        $field = $this->getFields();

        foreach ($field AS $id => $val) {
            $totale += count($field[$id]);
            for ($x = 0; $x < count($field[$id]); $x++) {
                if ($this->$field[$id][$x])
                    $set++;
                if ($this->$field[$id][$x] == 'NC')
                    $this->numero_non_conformita++;
            }
        }

        $stato = $set . " / " . $totale;
        $this->setAttribute('numero_non_conformita', $this->numero_non_conformita);

        if ($set == $totale)
            $end = 'Y';
        Yii::app()->db->createCommand("UPDATE db_verifiche SET data_effettiva = NOW(), non_conformita ='" . $this->numero_non_conformita . "' , stato ='" . $stato . "' ,completa ='" . $end . "'  WHERE id='" . $this->id_verifica . "'")->execute();
    }
}