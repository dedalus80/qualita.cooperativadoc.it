<?php

class AzioniVerificheEducative extends CActiveRecord {

    var $selectStrutture = array();
    var $selectTipologie = array("A" => "AUTOVALUTAZIONE", "V" => "VALUTAZIONE");
    var $selectValutazioni = array("C" => "CONFORME", "NC" => "NON CONFORME", "NA" => "NON APPLICABILE", "NR" => "NON RIVELATA");
    var $selectCodici = array();
    var $selectAnni = array();
    var $datiAdmin = "";
    var $campiSezioni = array();
    var $nome_unita = "";
    var $bar = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'db_verifiche_educative';
    }

    public function rules() {
        return array(
            array('id_verifica, codice_verifica, autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('formazione_ruo,formazione_coordinatori,formazione_educatori,programmazione_progetto,programmazione_modello_7,programmazione_presidio,programmazione_piano,programmazione_schede_svc,programmazione_schede_svpa,programmazione_schede_sav,programmazione_monitoraggio,programmazione_gradimento,programmazione_progettoc,programmazione_programma,programmazione_orari,programmazione_attivita,programmazione_problemi,programmazione_ritiri,programmazione_notturno,programmazione_telefonate,programmazione_verbali,programmazione_valutazioni,programmazione_valutazioni_p,programmazione_autovalutazioni,programmazione_autovalutazioni_p,programmazione_relazione,educativo_animazione,educativo_spazi,educativo_disabili,educativo_relazione,educativo_clima,educativo_partecipazione,comunicazione_genitori,comunicazione_famiglie,comunicazione_sede', 'length', 'max' => 2),
            array('formazione_ruo,formazione_coordinatori,formazione_educatori,programmazione_progetto,programmazione_modello_7,programmazione_presidio,programmazione_piano,programmazione_schede_svc,programmazione_schede_svpa,programmazione_schede_sav,programmazione_monitoraggio,programmazione_gradimento,programmazione_progettoc,programmazione_programma,programmazione_orari,programmazione_attivita,programmazione_problemi,programmazione_ritiri,programmazione_notturno,programmazione_telefonate,programmazione_verbali,programmazione_valutazioni,programmazione_valutazioni_p,programmazione_autovalutazioni,programmazione_autovalutazioni_p,programmazione_relazione,educativo_animazione,educativo_spazi,educativo_disabili,educativo_relazione,educativo_clima,educativo_partecipazione,comunicazione_genitori,comunicazione_famiglie,comunicazione_sede', 'safe'),
            array('formazione_ruo_note,formazione_coordinatori_note,formazione_educatori_note,programmazione_progetto_note,programmazione_modello_7_note,programmazione_presidio_note,programmazione_piano_note,programmazione_schede_svc_note,programmazione_schede_svpa_note,programmazione_schede_sav_note,programmazione_monitoraggio_note,programmazione_gradimento_note,programmazione_progettoc_note,programmazione_programma_note,programmazione_orari_note,programmazione_attivita_note,programmazione_problemi_note,programmazione_ritiri_note,programmazione_notturno_note,programmazione_telefonate_note,programmazione_verbali_note,programmazione_valutazioni_note,programmazione_valutazioni_p_note,programmazione_autovalutazioni_note,programmazione_autovalutazioni_p_note,programmazione_relazione_note,educativo_animazione_note,educativo_spazi_note,educativo_disabili_note,educativo_relazione_note,educativo_clima_note,educativo_partecipazione_note,comunicazione_genitori_note,comunicazione_famiglie_note,comunicazione_sede_note', 'length', 'max' => 255),
            array('formazione_ruo_note,formazione_coordinatori_note,formazione_educatori_note,programmazione_progetto_note,programmazione_modello_7_note,programmazione_presidio_note,programmazione_piano_note,programmazione_schede_svc_note,programmazione_schede_svpa_note,programmazione_schede_sav_note,programmazione_monitoraggio_note,programmazione_gradimento_note,programmazione_progettoc_note,programmazione_programma_note,programmazione_orari_note,programmazione_attivita_note,programmazione_problemi_note,programmazione_ritiri_note,programmazione_notturno_note,programmazione_telefonate_note,programmazione_verbali_note,programmazione_valutazioni_note,programmazione_valutazioni_p_note,programmazione_autovalutazioni_note,programmazione_autovalutazioni_p_note,programmazione_relazione_note,educativo_animazione_note,educativo_spazi_note,educativo_disabili_note,educativo_relazione_note,educativo_clima_note,educativo_partecipazione_note,comunicazione_genitori_note,comunicazione_famiglie_note,comunicazione_sede_note', 'safe'),
            array('osservazioni_2,osservazioni_1,osservazioni_3,osservazioni_4,note_1,note_2,note_3,note_4', 'length', 'max' => 2550),
            array('data, ora_inizio, ora_fine, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3, note_4, osservazioni_4', 'safe'),
           
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_verifica' => 'Id Verifica',
            'codice_verifica' => 'Codice<span class="hidden-480"> Verifica</span>',
            'data' => 'Data',
            'unita_operativa' => '<span class="hidden-480">Unita Operativa</span><span class="only-phone">Struttura</span>',
            'autore' => 'Incaricato',
            'ora_inizio' => 'Ora Inizio',
            'ora_fine' => 'Ora Fine',
            'tipo_valutazione' => 'Tipo Valutazione',
            'apertura_nc' => 'Apertura Nc',
            
            'formazione_ruo' => 'Il RUO ha partecipato ai corsi di formazione previsti?',
            'formazione_ruo_note' => 'Formazione Ruo Note',
            'formazione_coordinatori' => 'I coordinatori hanno partecipato ai corsi di formazione previsti?',
            'formazione_coordinatori_note' => 'Formazione Coordinatori Note',
            'formazione_educatori' => 'Il personale educativo presente al momento della verifica ha partecipato al presoggiorno? ',
            'formazione_educatori_note' => 'Formazione Educaturi Note',
            
            'programmazione_progetto' => '&Egrave; presente il progetto di soggiorno?',
            'programmazione_progetto_note' => 'Progetto note',
            'programmazione_modello_7' => '&Egrave; presente e completo il modello "Organico rev 07" relativo al turno in esame al momento della verifica? ',
            'programmazione_modello_7_note' => 'Rev 7 note',
            'programmazione_presidio' => '&Egrave; presente uno strumento di presidio dell\'organizzazione degli spazi e dei tempi adeguati allo sviluppo delle attivit&agrave; dei gruppi(bambini e ragazzi) presenti ?',
            'programmazione_presidio_note' => 'Programmzione presidio note',
            'programmazione_piano' => '&Egrave; presente ed utilizzato il piano attivit&agrave;?',
            'programmazione_piano_note' => 'Utilizzo piano Note',
            'programmazione_schede_svc' => 'Sono presenti e complete le schede di valutazione del coordinatore(SVC) relative al turno precedente la verifica?',
            'programmazione_schede_svc_note' => 'Scheda (SVC) note',
            'programmazione_schede_svpa' => 'Sono presenti e complete le schede di valutazione del personale ausiliario(SVPA) ,medico (SVSM) e di segreteria (SVS) relative al turno precedente la verifica?',
            'programmazione_schede_svpa_note' => 'Scheda SVPA Note',
            'programmazione_schede_sav' => '&Egrave; presente la scheda di autovalutazione del direttore( SAVDir) relativa al turno precedente la verifica?',
            'programmazione_schede_sav_note' => 'Scheda SAVDir Note',
            'programmazione_monitoraggio' => 'Sono presenti, usati, rielaborati e restituiti gli strumenti di monitoraggio previsti nel progetto?',
            'programmazione_monitoraggio_note' => 'Monitoraggio note',
            'programmazione_gradimento' => 'Sono presenti, usati, rielaborati e restituiti gli strumenti di gradimento/valutazione attivit&agrave; previsti nel progetto?',
            'programmazione_gradimento_note' => 'Gradimento note',
            'programmazione_progettoc' => '&Egrave; presente il progetto di soggiorno?',
            'programmazione_progettoc_note' => 'Progetto Note',
            'programmazione_programma' => '&Egrave; presente la programmazione bisettimanale relativa al turno in esame al momento della verifica?',
            'programmazione_programma_note' => 'Programmaione note',
            'programmazione_orari' => '&Egrave; presente e compilata in modo chiaro la griglia oraria bisettimanale?',
            'programmazione_orari_note' => 'Griglia oraria note',
            'programmazione_attivita' => '&Egrave; presente e compilata in modo chiaro qualche scheda attivitt&agrave; ?',
            'programmazione_attivita_note' => 'Scheda attivit&agrave; Note',
            'programmazione_problemi' => '&Egrave; presente e compilata in modo chiaro qualche scheda raccolta problemi?',
            'programmazione_problemi_note' => 'Raccolta problemi note',
            'programmazione_ritiri' => 'Se ci sono stati ritiri dal soggiorno sono presenti e compilate in modo chiaro  le schede ritiri?',
            'programmazione_ritiri_note' => 'Schede ritiri note',
            'programmazione_notturno' => 'Sono presenti e compilate in modo chiaro le schede segnalazioni del personale notturno?',
            'programmazione_notturno_note' => 'Personale notturno note',
            'programmazione_telefonate' => 'Se &egrave; presente &egrave; compilata in modo chiaro la scheda raccolta telefonate - problemi - incidenti',
            'programmazione_telefonate_note' => 'Raccolte telefonate note',
            'programmazione_verbali' => 'Sono presenti e compilati in modo chiaro i verbali di riunione?',
            'programmazione_verbali_note' => 'Verbali note',
            'programmazione_valutazioni' => 'Sono presenti e complete le schede di valutazione del coordinatore e del direttore a cura dell\'animatore relative al turno precedente la verifica?',
            'programmazione_valutazioni_note' => 'Schede valutazioni note',
            'programmazione_valutazioni_p' => 'Sono presenti e complete le schede di valutazione del direttore a cura del coordinatore relative al turno precedente la verifica?',
            'programmazione_valutazioni_p_note' => 'Schede valutazioni note',
            'programmazione_autovalutazioni' => 'Sono presenti e complete le schede di autovalutazione dell\'animatore relative al turno precedente la verifica?',
            'programmazione_autovalutazioni_note' => 'Autovalutazione note',
            'programmazione_autovalutazioni_p' => 'Sono presenti e complete le schede di autovalutazione del coordinatore relative al turno precedente la verifica?',
            'programmazione_autovalutazioni_p_note' => 'Autovalutazione note',
            'programmazione_relazione' => '&Egrave; presente la "Relazione di fine turno" relativa al turno precedente la verifica?',
            'programmazione_relazione_note' => 'Autovalutazione note',
            
            'educativo_animazione' => 'Le attivit&agrave; di animazione e di laboratorisono adeguate all\'et&agrave; dei partecipanti e al progetto di soggiorno?',
            'educativo_animazione_note' => 'Animazione note',
            'educativo_spazi' => 'Gli spazi sono ben distribuiti e allestiti in modo coerente al progetto? ',
            'educativo_spazi_note' => 'Spazi Note',
            'educativo_disabili' => 'Se sono presenti bambini/ragazzi diversamente abili, l\'organizzazione tiene conto e sollecita l\'integrazione?',
            'educativo_disabili_note' => 'Diversamente abili note',
            'educativo_relazione' => '&Egrave; presente la relazione di fine turno precedente relativa all\'inserimento di bambini/ragazzi diversamente abili?',
            'educativo_relazione_note' => 'Relazioni fine turno note',
            'educativo_clima' => 'Le relazioni tra bambini , tra bambini ed adulti e tra gli adulti presenti in soggiorno favoriscono un clima educativo soddisfacente?',
            'educativo_clima_note' => 'Clima educativo note',
            'educativo_partecipazione' => '&Egrave; attiva la partecipazione dei minori alle attivit&agrave; di animazion e di laboratorio?',
            'educativo_partecipazione_note' => 'Parteciapazione note',
            
            'comunicazione_genitori' => 'Sono chiari/funzionali e adottati i compiti e le funzioni interne allo staff direttivo?',
            'comunicazione_genitori_note' => 'Compiti e funzioni Note',
            'comunicazione_famiglie' => 'Vi &egrave; un\'adeguata comunicazione tra minori e  rispettive famiglie, tra soggiorno e famiglie dei minori ospitati?',
            'comunicazione_famiglie_note' => 'Comunicazione Famiglie Note',
            'comunicazione_sede' => 'Vengono usati gli strumenti di comunicazione previsti, con l\'ente committente e con la sede?',
            'comunicazione_sede_note' => 'Uso strumenti Note',
            
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili:',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'osservazioni_4' => 'Osservazioni ',
            'note_1' => 'Note',
            'note_2' => 'Note',
            'note_3' => 'Note',
            'note_4' => 'Note',
            
            'anno' => 'Anno',
            'numero_non_conformita' => 'Numero Non Conformita',
        );
    }

    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('id_verifica', $this->id_verifica);
        $criteria->compare('codice_verifica', $this->codice_verifica, true);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('unita_operativa', $this->unita_operativa);
        $criteria->compare('autore', $this->autore);
        $criteria->compare('ora_inizio', $this->ora_inizio, true);
        $criteria->compare('ora_fine', $this->ora_fine, true);
        $criteria->compare('tipo_valutazione', $this->tipo_valutazione, true);
        $criteria->compare('apertura_nc', $this->apertura_nc, true);
        $criteria->compare('formazione_ruo' ,$this->formazione_ruo , true);
        $criteria->compare('formazione_ruo_note' ,$this->formazione_ruo_note , true);
        $criteria->compare('formazione_coordinatori' ,$this->formazione_coordinatori , true);
        $criteria->compare('formazione_coordinatori_note' ,$this->formazione_coordinatori_note , true);
        $criteria->compare('formazione_educatori' ,$this->formazione_educatori , true);
        $criteria->compare('formazione_educatori_note' ,$this->formazione_educatori_note , true);
        $criteria->compare('programmazione_progetto' ,$this->programmazione_progetto , true);
        $criteria->compare('programmazione_progetto_note' ,$this->programmazione_progetto_note , true);
        $criteria->compare('programmazione_modello_7' ,$this->programmazione_modello_7 , true);
        $criteria->compare('programmazione_modello_7_note' ,$this->programmazione_modello_7_note , true);
        $criteria->compare('programmazione_presidio' ,$this->programmazione_presidio , true);
        $criteria->compare('programmazione_presidio_note' ,$this->programmazione_presidio_note , true);
        $criteria->compare('programmazione_piano' ,$this->programmazione_piano , true);
        $criteria->compare('programmazione_piano_note' ,$this->programmazione_piano_note , true);
        $criteria->compare('programmazione_schede_svc' ,$this->programmazione_schede_svc , true);
        $criteria->compare('programmazione_schede_svc_note' ,$this->programmazione_schede_svc_note , true);
        $criteria->compare('programmazione_schede_svpa' ,$this->programmazione_schede_svpa , true);
        $criteria->compare('programmazione_schede_svpa_note' ,$this->programmazione_schede_svpa_note , true);
        $criteria->compare('programmazione_schede_sav' ,$this->programmazione_schede_svpa , true);
        $criteria->compare('programmazione_schede_sav_note' ,$this->programmazione_schede_svpa_note , true);
        $criteria->compare('programmazione_monitoraggio' ,$this->programmazione_monitoraggio , true);
        $criteria->compare('programmazione_monitoraggio_note' ,$this->programmazione_monitoraggio_note , true);
        $criteria->compare('programmazione_gradimento' ,$this->programmazione_gradimento , true);
        $criteria->compare('programmazione_gradimento_note' ,$this->programmazione_gradimento_note , true);
        $criteria->compare('programmazione_progettoc' ,$this->programmazione_progettoc , true);
        $criteria->compare('programmazione_progettoc_note' ,$this->programmazione_progettoc_note , true);
        $criteria->compare('programmazione_programma' ,$this->programmazione_programma , true);
        $criteria->compare('programmazione_programma_note' ,$this->programmazione_programma_note , true);
        $criteria->compare('programmazione_orari' ,$this->programmazione_orari , true);
        $criteria->compare('programmazione_orari_note' ,$this->programmazione_orari_note , true);
        $criteria->compare('programmazione_attivita' ,$this->programmazione_attivita , true);
        $criteria->compare('programmazione_attivita_note' ,$this->programmazione_attivita_note , true);
        $criteria->compare('programmazione_problemi' ,$this->programmazione_problemi , true);
        $criteria->compare('programmazione_problemi_note' ,$this->programmazione_problemi_note , true);
        $criteria->compare('programmazione_ritiri' ,$this->programmazione_ritiri , true);
        $criteria->compare('programmazione_ritiri_note' ,$this->programmazione_ritiri_note , true);
        $criteria->compare('programmazione_notturno' ,$this->programmazione_notturno , true);
        $criteria->compare('programmazione_notturno_note' ,$this->programmazione_notturno_note , true);
        $criteria->compare('programmazione_telefonate' ,$this->programmazione_telefonate , true);
        $criteria->compare('programmazione_telefonate_note' ,$this->programmazione_telefonate_note , true);
        $criteria->compare('programmazione_verbali' ,$this->programmazione_verbali , true);
        $criteria->compare('programmazione_verbali_note' ,$this->programmazione_verbali_note , true);
        $criteria->compare('programmazione_valutazioni' ,$this->programmazione_valutazioni , true);
        $criteria->compare('programmazione_valutazioni_note' ,$this->programmazione_valutazioni_note , true);
        $criteria->compare('programmazione_valutazioni_p' ,$this->programmazione_valutazioni_p , true);
        $criteria->compare('programmazione_valutazioni_p_note' ,$this->programmazione_valutazioni_p_note , true);
        $criteria->compare('programmazione_autovalutazioni' ,$this->programmazione_autovalutazioni , true);
        $criteria->compare('programmazione_autovalutazioni_note' ,$this->programmazione_autovalutazioni_note , true);
        $criteria->compare('programmazione_autovalutazioni_p' ,$this->programmazione_autovalutazioni_p , true);
        $criteria->compare('programmazione_autovalutazioni_p_note' ,$this->programmazione_autovalutazioni_p_note , true);
        $criteria->compare('programmazione_relazione' ,$this->programmazione_relazione , true);
        $criteria->compare('programmazione_relazione_note' ,$this->programmazione_relazione_note , true);
        $criteria->compare('educativo_animazione' ,$this->educativo_animazione , true);
        $criteria->compare('educativo_animazione_note' ,$this->educativo_animazione_note , true);
        $criteria->compare('educativo_spazi' ,$this->educativo_spazi , true);
        $criteria->compare('educativo_spazi_note' ,$this->educativo_spazi_note , true);
        $criteria->compare('educativo_disabili' ,$this->educativo_disabili , true);
        $criteria->compare('educativo_disabili_note' ,$this->educativo_disabili_note , true);
        $criteria->compare('educativo_relazione' ,$this->educativo_relazione , true);
        $criteria->compare('educativo_relazione_note' ,$this->educativo_relazione_note , true);
        $criteria->compare('educativo_clima' ,$this->educativo_clima , true);
        $criteria->compare('educativo_clima_note' ,$this->educativo_clima_note , true);
        $criteria->compare('educativo_partecipazione' ,$this->educativo_partecipazione , true);
        $criteria->compare('educativo_partecipazione_note' ,$this->educativo_partecipazione_note , true);
        $criteria->compare('comunicazione_genitori' ,$this->comunicazione_genitori , true);
        $criteria->compare('comunicazione_genitori_note' ,$this->comunicazione_genitori_note , true);
        $criteria->compare('comunicazione_famiglie' ,$this->comunicazione_famiglie , true);
        $criteria->compare('comunicazione_famiglie_note' ,$this->comunicazione_famiglie_note , true);
        $criteria->compare('comunicazione_sede' ,$this->comunicazione_sede , true);
        $criteria->compare('comunicazione_sede_note' ,$this->comunicazione_sede_note , true);
        $criteria->compare('osservazioni_2' ,$this->osservazioni_2 , true);
        $criteria->compare('osservazioni_1' ,$this->osservazioni_1 , true);
        $criteria->compare('osservazioni_3' ,$this->osservazioni_3 , true);
        $criteria->compare('osservazioni_4' ,$this->osservazioni_4 , true);
        $criteria->compare('note_1' ,$this->note_1 , true);
        $criteria->compare('note_2' ,$this->note_2 , true);
        $criteria->compare('note_3' ,$this->note_3 , true);
        $criteria->compare('note_4' ,$this->note_4 , true);
        $criteria->compare('numero_non_conformita', $this->numero_non_conformita, true);
        $criteria->compare('anno', $this->anno, true);
        
		if (!$this->unita_operativa)
            $criteria->addInCondition('unita_operativa', Yii::app()->MyUtils->getUserStruttura(), 'AND');
		
		$dati = Yii::app()->MyUtils->getUserInfo();
		
		if($dati['user_type'] =='7')
			$criteria->addInCondition('id_verifica', Yii::app()->MyUtils->getIncaricatiVerifica (), 'OR');
		
		
        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
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
            2 => "2. PIANO DELLA PROGETTAZIONE",
            3 => "3. PIANO EDUCATIVO",
            4 => "4. PIANO DELLA COMUNICAZIONE",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('formazione_ruo','formazione_coordinatori','formazione_educatori'),
            'sezione_2' => array('programmazione_progetto','programmazione_modello_7','programmazione_presidio','programmazione_piano','programmazione_schede_svc','programmazione_schede_svpa','programmazione_schede_sav','programmazione_monitoraggio','programmazione_gradimento','programmazione_progettoc','programmazione_programma','programmazione_orari','programmazione_attivita','programmazione_problemi','programmazione_ritiri','programmazione_notturno','programmazione_telefonate','programmazione_verbali','programmazione_valutazioni','programmazione_valutazioni_p','programmazione_autovalutazioni','programmazione_autovalutazioni_p','programmazione_relazione'),
            'sezione_3' => array('educativo_animazione','educativo_spazi','educativo_disabili','educativo_relazione','educativo_clima','educativo_partecipazione'),
            'sezione_4' => array('comunicazione_genitori','comunicazione_famiglie','comunicazione_sede')
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

                $nc = new DbNonconforme;
                $note = $val[$x] . "_note";
                
                if ($this->$val[$x] == 'NC') {
                    if (!$isNC) {
                        
                        $query = "INSERT INTO " . $nc->tableName() . " (data,data_nc,unita_operativa,id_utente,anno,id_verifica,tipo_verifica,descrizione, nome, cognome , tipologia)  VALUE ";
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "','" . addslashes($user['nome']) . "','" . addslashes($user['cognome']) . "' , '19')";
                        if (Yii::app()->db->createCommand($query)->execute()) {
                            $LID = Yii::app()->db->lastInsertID;
                            $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $LID);
                            Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET codice ='" . $codice . "' WHERE id ='" . $LID . "'  ")->execute();
                        }
                    } else {
                        Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET data= NOW() , data_nc = NOW() , id_utente ='" . Yii::app()->user->getId() . "' , id_verifica ='" . $this->id_verifica . "' , tipo_verifica='" . $val[$x] . "' , descrizione ='" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "'   WHERE id ='" . $isNC . "'  ")->execute();
                    }
                } else {
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
