<?php

class AzioniVerificheEducazione extends CActiveRecord {

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
        return 'db_verifiche_educazione';
    }

    public function rules() {
        return array(
            array('id_verifica, codice_verifica, autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('formazione_ruo, formazione_coordinatori, formazione_educaturi, programmazione_bisettimanale, programmazione_giornaliera, griglia_oraria, scheda_organica, scheda_valutazione, scheda_rivelazione, scheda_raccolta, autovalutazione_animatore, valutazione_animatore, autovalutazione_coordinatore, valutazione_coordinatore, autovalutazione_direttore, valutazione_direttore, valutazione_direttore_coordinatore, valutazione_ausiliario, valutazione_medico, animazione, laboratorio, relazioni_bambini, relazioni_adulti, escursioni, parteciapazione_laboratori, partecipazione_animazione, comunicazione_genitori, comunicazione_famiglie, comunicazione_sede ,rivelazione_ritiri ,verbali_riunioni , registro_infermeria , comunicazione_infortuni', 'length', 'max' => 2),
            array('formazione_ruo_note, formazione_coordinatori_note, formazione_educaturi_note, programmazione_bisettimanale_note, programmazione_giornaliera_note, griglia_oraria_note, scheda_organica_note, scheda_valutazione_note, scheda_rivelazione_note, scheda_raccolta_note, autovalutazione_animatore_note, valutazione_animatore_note, autovalutazione_coordinatore_note, valutazione_coordinatore_note, autovalutazione_direttore_note, valutazione_direttore_note, valutazione_direttore_coordinatore_note, valutazione_ausiliario_note, valutazione_medico_note, animazione_note, laboratorio_note, relazioni_bambini_note, relazioni_adulti_note, escursioni_note, parteciapazione_laboratori_note, partecipazione_animazione_note, comunicazione_genitori_note, comunicazione_famiglie_note, comunicazione_sede_note , rivelazione_ritiri_note ,verbali_riunioni_note , registro_infermeria_note , comunicazione_infortuni_note', 'length', 'max' => 255),
            array('data, ora_inizio, ora_fine, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3, note_4, osservazioni_4', 'safe'),
            array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, formazione_ruo, formazione_ruo_note, formazione_coordinatori, formazione_coordinatori_note, formazione_educaturi, formazione_educaturi_note, note_1, osservazioni_1, programmazione_bisettimanale, programmazione_bisettimanale_note, programmazione_giornaliera, programmazione_giornaliera_note, griglia_oraria, griglia_oraria_note, scheda_organica, scheda_organica_note, scheda_valutazione, scheda_valutazione_note, scheda_rivelazione, scheda_rivelazione_note, scheda_raccolta, scheda_raccolta_note, autovalutazione_animatore, autovalutazione_animatore_note, valutazione_animatore, valutazione_animatore_note, autovalutazione_coordinatore, autovalutazione_coordinatore_note, valutazione_coordinatore, valutazione_coordinatore_note, autovalutazione_direttore, autovalutazione_direttore_note, valutazione_direttore, valutazione_direttore_note, valutazione_direttore_coordinatore, valutazione_direttore_coordinatore_note, valutazione_ausiliario, valutazione_ausiliario_note, valutazione_medico, valutazione_medico_note, note_2, osservazioni_2, animazione, animazione_note, laboratorio, laboratorio_note, relazioni_bambini, relazioni_bambini_note, relazioni_adulti, relazioni_adulti_note, escursioni, escursioni_note, parteciapazione_laboratori, parteciapazione_laboratori_note, partecipazione_animazione, partecipazione_animazione_note, note_3, osservazioni_3, comunicazione_genitori, comunicazione_genitori_note, comunicazione_famiglie, comunicazione_famiglie_note, comunicazione_sede, comunicazione_sede_note, note_4, osservazioni_4, anno ,rivelazione_ritiri ,verbali_riunioni , registro_infermeria , comunicazione_infortuni , rivelazione_ritiri_note ,verbali_riunioni_note , registro_infermeria_note , comunicazione_infortuni_note
   ', 'safe', 'on' => 'search'),
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
            'formazione_educaturi' => 'Il personale educativo presente al momento della verifica ha partecipato al presoggiorno? ',
            'formazione_educaturi_note' => 'Formazione Educaturi Note',
            'note_1' => 'Note 1',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'programmazione_bisettimanale' => 'MD 01 03 PROGRAMMAZIONE BISETTIMANALE ',
            'programmazione_bisettimanale_note' => 'Programmazione Bisettimanale Note',
            'programmazione_giornaliera' => 'MD 01 04 PROGRAMMAZIONE GIORNALIERA ',
            'programmazione_giornaliera_note' => 'Programmazione Giornaliera Note',
            'griglia_oraria' => 'MD 01 05 GRIGLIA ORARIA SETTIMANALE',
            'griglia_oraria_note' => 'Griglia Oraria Note',
            'scheda_organica' => 'MD 01 06 SCHEDA ORGANICO ',
            'scheda_organica_note' => 'Scheda Organica Note',
            'scheda_valutazione' => 'MD 01 17 SCHEDA VALUTAZIONE ATTIVIT&Agrave;',
            'scheda_valutazione_note' => 'Scheda Valutazione Note',
            'scheda_rivelazione' => 'MD 01 18 SCHEDA RILEVAZIONE NOTTURNO',
            'scheda_rivelazione_note' => 'Scheda Rivelazione Note',
            'scheda_raccolta' => 'MD 01 19 SCHEDA RACCOLTA PROBLEMI INCIDENTI TELEFONATE PARTICOLARI',
            'scheda_raccolta_note' => 'Scheda Raccolta Note',
            'rivelazione_ritiri' => 'MD 01 30  RILEVAZIONE RITIRI',
            'rivelazione_ritiri_note' => '',
            'verbali_riunioni' => 'MD 01 16 VERBALE DI RIUNIONE',
            'verbali_riunioni_note' => '',
            'registro_infermeria' => 'MD 01 31 REGISTRO INFERMERIA',
            'registro_infermeria_note' => '',
            'comunicazione_infortuni' => 'MD 01 38 SCHEDA COMUNICAZIONE INFORTUNI',
            'comunicazione_infortuni_note' => '',
            'autovalutazione_animatore' => 'MD 01 33 AUTOVALUTAZIONE ANIMATORE',
            'autovalutazione_animatore_note' => 'Autovalutazione Animatore Note',
            'valutazione_animatore' => 'MD 01 21 VALUTAZIONE ANIMATORE',
            'valutazione_animatore_note' => 'Valutazione Animatore Note',
            'autovalutazione_coordinatore' => 'MD 01 32 AUTOVALUTAZIONE COORDINATORE',
            'autovalutazione_coordinatore_note' => 'Autovalutazione Coordinatore Note',
            'valutazione_coordinatore' => 'Valutazione Coordinatore',
            'valutazione_coordinatore_note' => 'Valutazione Coordinatore Note',
            'autovalutazione_direttore' => 'MD 01 34 AUTOVALLUTAZIONE DEL DIRETTORE ',
            'autovalutazione_direttore_note' => 'Autovalutazione Direttore Note',
            'valutazione_direttore' => 'MD 01 22 VALUTAZIONE DIRETTORE',
            'valutazione_direttore_note' => 'Valutazione Direttore Note',
            'valutazione_direttore_coordinatore' => 'MD 01 26 VALUTAZIONE DIRETTORE - COORDINATORE DA PARTE DELL\'ANIMATORE',
            'valutazione_direttore_coordinatore_note' => 'Valutazione Direttore Coordinatore Note',
            'valutazione_ausiliario' => 'MD 01 25 VALUTAZIONE PERSONALE AUSILIARIO',
            'valutazione_ausiliario_note' => 'Valutazione Ausiliario Note',
            'valutazione_medico' => 'MD 01 24 VALUTAZIONE PERSONALE MEDICO E DI SEGRETERIA',
            'valutazione_medico_note' => 'Valutazione Medico Note',
            'note_2' => 'Note 2',
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'animazione' => 'Le attivit&agrave; di animazione sono adeguate all\'et&agrave; dei partecipanti e al progetto di soggiorno?',
            'animazione_note' => 'Animazione Note',
            'laboratorio' => 'Le attivit&agrave; di laboratorio sono adeguate all\'et&agrave; dei partecipanti e al progetto di soggiorno?',
            'laboratorio_note' => 'Laboratorio Note',
            'relazioni_bambini' => 'Le relazioni tra adulti e bambini favoriscono un clima educativo soddisfacente?',
            'relazioni_bambini_note' => 'Relazioni Bambini Note',
            'relazioni_adulti' => 'Le relazioni tra gli adulti presenti in soggiorno favoriscono un clima educativo soddisfacente?',
            'relazioni_adulti_note' => 'Relazioni Adulti Note',
            'escursioni' => 'Le escursioni sono adeguate all\'et&agrave; dei partecipanti e al progetto di soggiorno?',
            'escursioni_note' => 'Escursioni Note',
            'parteciapazione_laboratori' => '&Egrave; attiva la partecipazione dei minori alle attivit&agrave; di laboratorio?',
            'parteciapazione_laboratori_note' => 'Parteciapazione Laboratori Note',
            'partecipazione_animazione' => '&Egrave; attiva la partecipazione dei minori alle attivit&agrave; di animazione?',
            'partecipazione_animazione_note' => 'Partecipazione Animazione Note',
            'note_3' => 'Note 3',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'comunicazione_genitori' => 'Vi &egrave; un\'adeguata comunicazione tra minori e  rispettive famiglie?',
            'comunicazione_genitori_note' => 'Comunicazione Genitori Note',
            'comunicazione_famiglie' => 'Vi &egrave; un\'adeguata comunicazione tra soggiorno e famiglie dei minori ospitati?',
            'comunicazione_famiglie_note' => 'Comunicazione Famiglie Note',
            'comunicazione_sede' => 'Vi &egrave; un\'adeguata comunicazione tra la sede e il soggiorno in esame?',
            'comunicazione_sede_note' => 'Comunicazione Sede Note',
            'note_4' => 'Note 4',
            'osservazioni_4' => 'Osservazioni 4',
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
        $criteria->compare('formazione_ruo', $this->formazione_ruo, true);
        $criteria->compare('formazione_ruo_note', $this->formazione_ruo_note, true);
        $criteria->compare('formazione_coordinatori', $this->formazione_coordinatori, true);
        $criteria->compare('formazione_coordinatori_note', $this->formazione_coordinatori_note, true);
        $criteria->compare('formazione_educaturi', $this->formazione_educaturi, true);
        $criteria->compare('formazione_educaturi_note', $this->formazione_educaturi_note, true);
        $criteria->compare('note_1', $this->note_1, true);
        $criteria->compare('osservazioni_1', $this->osservazioni_1, true);
        $criteria->compare('programmazione_bisettimanale', $this->programmazione_bisettimanale, true);
        $criteria->compare('programmazione_bisettimanale_note', $this->programmazione_bisettimanale_note, true);
        $criteria->compare('programmazione_giornaliera', $this->programmazione_giornaliera, true);
        $criteria->compare('programmazione_giornaliera_note', $this->programmazione_giornaliera_note, true);
        $criteria->compare('griglia_oraria', $this->griglia_oraria, true);
        $criteria->compare('griglia_oraria_note', $this->griglia_oraria_note, true);
        $criteria->compare('scheda_organica', $this->scheda_organica, true);
        $criteria->compare('scheda_organica_note', $this->scheda_organica_note, true);
        $criteria->compare('scheda_valutazione', $this->scheda_valutazione, true);
        $criteria->compare('scheda_valutazione_note', $this->scheda_valutazione_note, true);
        $criteria->compare('scheda_rivelazione', $this->scheda_rivelazione, true);
        $criteria->compare('scheda_rivelazione_note', $this->scheda_rivelazione_note, true);
        $criteria->compare('scheda_raccolta', $this->scheda_raccolta, true);
        $criteria->compare('scheda_raccolta_note', $this->scheda_raccolta_note, true);

        $criteria->compare('rivelazione_ritiri', $this->rivelazione_ritiri, true);
        $criteria->compare('rivelazione_ritiri_note', $this->rivelazione_ritiri_note, true);
        $criteria->compare('verbali_riunioni', $this->verbali_riunioni, true);
        $criteria->compare('verbali_riunioni_note', $this->verbali_riunioni_note, true);
        $criteria->compare('registro_infermeria', $this->registro_infermeria, true);
        $criteria->compare('registro_infermeria_note', $this->registro_infermeria_note, true);
        $criteria->compare('comunicazione_infortuni', $this->comunicazione_infortuni, true);
        $criteria->compare('comunicazione_infortuni_note', $this->comunicazione_infortuni_note, true);



        $criteria->compare('autovalutazione_animatore', $this->autovalutazione_animatore, true);
        $criteria->compare('autovalutazione_animatore_note', $this->autovalutazione_animatore_note, true);
        $criteria->compare('valutazione_animatore', $this->valutazione_animatore, true);
        $criteria->compare('valutazione_animatore_note', $this->valutazione_animatore_note, true);
        $criteria->compare('autovalutazione_coordinatore', $this->autovalutazione_coordinatore, true);
        $criteria->compare('autovalutazione_coordinatore_note', $this->autovalutazione_coordinatore_note, true);
        $criteria->compare('valutazione_coordinatore', $this->valutazione_coordinatore, true);
        $criteria->compare('valutazione_coordinatore_note', $this->valutazione_coordinatore_note, true);
        $criteria->compare('autovalutazione_direttore', $this->autovalutazione_direttore, true);
        $criteria->compare('autovalutazione_direttore_note', $this->autovalutazione_direttore_note, true);
        $criteria->compare('valutazione_direttore', $this->valutazione_direttore, true);
        $criteria->compare('valutazione_direttore_note', $this->valutazione_direttore_note, true);
        $criteria->compare('valutazione_direttore_coordinatore', $this->valutazione_direttore_coordinatore, true);
        $criteria->compare('valutazione_direttore_coordinatore_note', $this->valutazione_direttore_coordinatore_note, true);
        $criteria->compare('valutazione_ausiliario', $this->valutazione_ausiliario, true);
        $criteria->compare('valutazione_ausiliario_note', $this->valutazione_ausiliario_note, true);
        $criteria->compare('valutazione_medico', $this->valutazione_medico, true);
        $criteria->compare('valutazione_medico_note', $this->valutazione_medico_note, true);
        $criteria->compare('note_2', $this->note_2, true);
        $criteria->compare('osservazioni_2', $this->osservazioni_2, true);
        $criteria->compare('animazione', $this->animazione, true);
        $criteria->compare('animazione_note', $this->animazione_note, true);
        $criteria->compare('laboratorio', $this->laboratorio, true);
        $criteria->compare('laboratorio_note', $this->laboratorio_note, true);
        $criteria->compare('relazioni_bambini', $this->relazioni_bambini, true);
        $criteria->compare('relazioni_bambini_note', $this->relazioni_bambini_note, true);
        $criteria->compare('relazioni_adulti', $this->relazioni_adulti, true);
        $criteria->compare('relazioni_adulti_note', $this->relazioni_adulti_note, true);
        $criteria->compare('escursioni', $this->escursioni, true);
        $criteria->compare('escursioni_note', $this->escursioni_note, true);
        $criteria->compare('parteciapazione_laboratori', $this->parteciapazione_laboratori, true);
        $criteria->compare('parteciapazione_laboratori_note', $this->parteciapazione_laboratori_note, true);
        $criteria->compare('partecipazione_animazione', $this->partecipazione_animazione, true);
        $criteria->compare('partecipazione_animazione_note', $this->partecipazione_animazione_note, true);
        $criteria->compare('note_3', $this->note_3, true);
        $criteria->compare('osservazioni_3', $this->osservazioni_3, true);
        $criteria->compare('comunicazione_genitori', $this->comunicazione_genitori, true);
        $criteria->compare('comunicazione_genitori_note', $this->comunicazione_genitori_note, true);
        $criteria->compare('comunicazione_famiglie', $this->comunicazione_famiglie, true);
        $criteria->compare('comunicazione_famiglie_note', $this->comunicazione_famiglie_note, true);
        $criteria->compare('comunicazione_sede', $this->comunicazione_sede, true);
        $criteria->compare('comunicazione_sede_note', $this->comunicazione_sede_note, true);
        $criteria->compare('note_4', $this->note_4, true);
        $criteria->compare('osservazioni_4', $this->osservazioni_4, true);
        $criteria->compare('numero_non_conformita', $this->numero_non_conformita, true);
        $criteria->compare('anno', $this->anno, true);
        
		if (!$this->unita_operativa)
            $criteria->addInCondition('unita_operativa', Yii::app()->MyUtils->getUserStruttura(), 'AND');
		
		$dati = Yii::app()->MyUtils->getUserInfo();
		
		if($dati['user_type'] =='7')
			$criteria->addInCondition('id_verifica', Yii::app()->MyUtils->getIncaricatiVerifica (), 'AND');
		
		
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
            2 => "2. PIANO DOCUMENTALE",
            3 => "3. PIANO EDUCATIVO",
            4 => "4. PIANO DELLA COMUNICAZIONE",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('formazione_ruo', 'formazione_coordinatori', 'formazione_educaturi'),
            'sezione_2' => array('programmazione_bisettimanale', 'programmazione_giornaliera', 'griglia_oraria', 'scheda_organica', 'scheda_valutazione', 'scheda_rivelazione', 'scheda_raccolta', 'rivelazione_ritiri', 'verbali_riunioni', 'registro_infermeria', 'comunicazione_infortuni', 'autovalutazione_animatore', 'valutazione_animatore', 'autovalutazione_coordinatore', 'autovalutazione_direttore', 'valutazione_direttore', 'valutazione_direttore_coordinatore', 'valutazione_ausiliario', 'valutazione_medico'),
            'sezione_3' => array('animazione', 'laboratorio', 'relazioni_bambini', 'relazioni_adulti', 'escursioni', 'parteciapazione_laboratori', 'partecipazione_animazione'),
            'sezione_4' => array('comunicazione_genitori', 'comunicazione_famiglie', 'comunicazione_sede')
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