<?php

class AzioniVerificheAmministrative extends CActiveRecord {

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
        return 'db_verifiche_amministrative';
    }

    public function rules() {
        return array(
            array('autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('organico_completo, lettera_assunzione, informativa_dlgs, detrazione_imposta, certificato_sanitario, mip_bagnati, statuto, regolamento_doc, regolamento_soggiorno, carta_prassi, lettera_proroga, lettera_trasferiemnto, stato_dna, valutazione_personale, rapporto_giornaliero, numero_clienti, scheda_veicoli, saldo_cassa, archiviazione_documenti, numero_protocollo, intestazione_documento, importo_documento, ragione_sociale_fornitore, verifica_prezzi, ordini_registrati, rimborso_trasferte, scontrini_trasferte, copia_documenti, md0306, md0305, el0302, el0303, el0304, documento_qualita, manuale_qualita, manuale_gestione, istruzioni_operative, registri_gestioni_servizi, struttura_piattaforma_gestione, casevacanze_piattaform_gestione, sezione_nonconformita, sezione_reclami, indicatori_abientali, verifiche_inspettive ,fornitori_selezionati', 'length', 'max' => 2),
            array('organico_completo_note, lettera_assunzione_note, informativa_dlgs_note, detrazione_imposta_note, certificato_sanitario_note, mip_bagnati_note, statuto_note, regolamento_doc_note, regolamento_soggiorno_note, carta_prassi_note, lettera_proroga_note, lettera_trasferiemnto_note, stato_dna_note, valutazione_personale_note, rapporto_giornaliero_note, numero_clienti_note, scheda_veicoli_note, saldo_cassa_note, archiviazione_documenti_note, numero_protocollo_note, intestazione_documento_note, importo_documento_note, ragione_sociale_fornitore_note, verifica_prezzi_note, ordini_registrati_note, rimborso_trasferte_note, scontrini_trasferte_note, copia_documenti_note, md0306_note, md0305_note, el0302_note, el0303_note, el0304_note, documento_qualita_note, manuale_qualita_note, manuale_gestione_note, istruzioni_operative_note, registri_gestioni_servizi_note, struttura_piattaforma_gestione_note, casevacanze_piattaform_gestione_note, sezione_nonconformita_note, sezione_reclami_note, indicatori_abientali_note, verifiche_inspettive_note , fornitori_selezionati_note', 'length', 'max' => 255),
            array('data, ora_inizio, ora_fine, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, organico_completo, organico_completo_note, lettera_assunzione, lettera_assunzione_note, informativa_dlgs, informativa_dlgs_note, detrazione_imposta, detrazione_imposta_note, certificato_sanitario, certificato_sanitario_note, mip_bagnati, mip_bagnati_note, statuto, statuto_note, regolamento_doc, regolamento_doc_note, regolamento_soggiorno, regolamento_soggiorno_note, carta_prassi, carta_prassi_note, lettera_proroga, lettera_proroga_note, lettera_trasferiemnto, lettera_trasferiemnto_note, stato_dna, stato_dna_note, valutazione_personale, valutazione_personale_note, note_1, osservazioni_1, rapporto_giornaliero, rapporto_giornaliero_note, numero_clienti, numero_clienti_note, scheda_veicoli, scheda_veicoli_note, saldo_cassa, saldo_cassa_note, archiviazione_documenti, archiviazione_documenti_note, numero_protocollo, numero_protocollo_note, intestazione_documento, intestazione_documento_note, importo_documento, importo_documento_note, ragione_sociale_fornitore, ragione_sociale_fornitore_note, verifica_prezzi, verifica_prezzi_note, ordini_registrati, ordini_registrati_note, rimborso_trasferte, rimborso_trasferte_note, scontrini_trasferte, scontrini_trasferte_note, copia_documenti, copia_documenti_note, md0306, md0306_note, md0305, md0305_note, el0302, el0302_note, el0303, el0303_note, el0304, el0304_note, note_2, osservazioni_2, documento_qualita, documento_qualita_note, manuale_qualita, manuale_qualita_note, manuale_gestione, manuale_gestione_note, istruzioni_operative, istruzioni_operative_note, registri_gestioni_servizi, registri_gestioni_servizi_note, struttura_piattaforma_gestione, struttura_piattaforma_gestione_note, casevacanze_piattaform_gestione, casevacanze_piattaform_gestione_note, sezione_nonconformita, sezione_nonconformita_note, sezione_reclami, sezione_reclami_note, indicatori_abientali, indicatori_abientali_note, verifiche_inspettive, verifiche_inspettive_note, note_3, osservazioni_3, anno', 'safe', 'on' => 'search'),
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
            'organico_completo' => '&Egrave; PRESENTE L\'ORGANICO COMPLETO DEL PERSONALE IN FORZA PRESSO L\'UNIT&Agrave; OPERATIV&Agrave; CON DESCRIZIONE DELLE MANSIONI PREVISTE',
            'organico_completo_note' => 'Organico Completo Note',
            'lettera_assunzione' => 'LETTERA DI ASSUNZIONE  ',
            'lettera_assunzione_note' => 'Lettera Assunzione Note',
            'informativa_dlgs' => 'INFORMTIVA D.LGS 196/2003    ',
            'informativa_dlgs_note' => 'Informativa Dlgs Note',
            'detrazione_imposta' => 'IL DOCUMENTO PER LE DETRAZIONI DI IMPOSTA   ',
            'detrazione_imposta_note' => 'Detrazione Imposta Note',
            'certificato_sanitario' => 'CERTIFICATO DI INONEIT&Agrave; SANITARIA  ',
            'certificato_sanitario_note' => 'Certificato Sanitario Note',
            'mip_bagnati' => 'M.I.P. PER ASSISTENTI BAGNANTI - se presenti - verificare compatibilit&agrave; tra permesso acque interne o acque esterne e soggiorno',
            'mip_bagnati_note' => 'Mip Bagnati Note',
            'statuto' => 'STATUTO DOC SCS',
            'statuto_note' => 'Statuto Note',
            'regolamento_doc' => 'REGOLAMENTO INTERNO D.O.C. s.c.s.',
            'regolamento_doc_note' => 'Regolamento Doc Note',
            'regolamento_soggiorno' => 'REGOLAMENTO DI SOGGIORNO D.O.C. s.c.s.  - solo per assunzione estive - ',
            'regolamento_soggiorno_note' => 'Regolamento Soggiorno Note',
            'carta_prassi' => 'CARTA DELLE BUONE PRASSI EDUCATIVE D.O.C. s.c.s. - solo per assunzione estive - ',
            'carta_prassi_note' => 'Carta Prassi Note',
            'lettera_proroga' => 'LETTERA DI PROROGA (se presente)',
            'lettera_proroga_note' => 'Lettera Proroga Note',
            'lettera_trasferiemnto' => 'LETTERA DI TRASFERIMENTO (se presente)',
            'lettera_trasferiemnto_note' => 'Lettera Trasferiemnto Note',
            'stato_dna' => '&Egrave; STATO COMUNICATO IL D.N.A.( Denuncia nominativa assicurati) entro le ore 14.00? - verificare data ultimo invio - ',
            'stato_dna_note' => 'Stato Dna Note',
            'valutazione_personale' => 'LE VALUTAZIONI DEL PERSONALE SONO TUTTE CORRETTAMENTE COMPILATE CON LE FIRME NECESSARIE ? - SOLO PER GESTIONI ESTIVE E STRUTTURE GESTIONALI - ',
            'valutazione_personale_note' => 'Valutazione Personale Note',
            'note_1' => 'Note 1',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'rapporto_giornaliero' => 'Il" rapportino giornaliero" &egrave; compilato correttamente? (INDICARE DATA DI ULTIMO INVIO)',
            'rapporto_giornaliero_note' => 'Rapporto Giornaliero Note',
            'numero_clienti' => 'Il numero dei clienti presenti in struttura corrisponde a quanto indicato nel rapportino giornaliero o nella lista da inviare alla questura?( indicare nelle note il numero reale e quello indicato nel documento)',
            'numero_clienti_note' => 'Numero Clienti Note',
            'scheda_veicoli' => 'La scheda di utilizzo autoveicoli -MD 00 02 rev 00 &egrave; compilata in modo corretto e costante?',
            'scheda_veicoli_note' => 'Scheda Veicoli Note',
            'saldo_cassa' => 'Il saldo cassa presente nell\'unit&agrave; operativa corrisponde a quello indicato nel programma di contabilit&agrave;? ( indicare nelle note importo cassa reale e cassa programma)',
            'saldo_cassa_note' => 'Saldo Cassa Note',
            'archiviazione_documenti' => 'L\'archiviazione dei documenti &egrave; conforme alla procedura amministrativa ',
            'archiviazione_documenti_note' => 'Archiviazione Documenti Note',
            'numero_protocollo' => 'I documenti riportano lo stesso numero di protocollo indicato su File Maker o altro programma di prima nota?',
            'numero_protocollo_note' => 'Numero Protocollo Note',
            'intestazione_documento' => 'L\'intestazione del documento riporta i dati societari corretti (DOC o KELUAR) nelle modalit&agrave; stabilite dalle procedure di riferiemtno',
            'intestazione_documento_note' => 'Intestazione Documento Note',
            'importo_documento' => 'L\'importo e la data del documento corrispondono a quelli indicati sul FileMaker o altro programma di prima nota?',
            'importo_documento_note' => 'Importo Documento Note',
            'ragione_sociale_fornitore' => 'Il documento riporta la ragione sociale del fornitore corretta?',
            'ragione_sociale_fornitore_note' => 'Ragione Sociale Fornitore Note',
            'verifica_prezzi' => 'Al ricevimento di una fattura &egrave; verificata la conformit&agrave; dei prezzi applicati con quelli dei listini o dei prezzi concordati?',
            'verifica_prezzi_note' => 'Verifica Prezzi Note',
            'ordini_registrati' => 'Gli ordini e gli acquisti sono correttamente registrati con il modulo d\'ordine DOC e/o KELUAR come descritto nella procedura acquisti di riferimento?',
            'ordini_registrati_note' => 'Ordini Registrati Note',
            'rimborso_trasferte' => 'In caso di trasferte del personale sono correttamente compilati i previsti moduli rimborso trasferta?',
            'rimborso_trasferte_note' => 'Rimborso Trasferte Note',
            'scontrini_trasferte' => 'Gli scontrini e le fatture relativi alle trasferte del personale sono stati fotocopiati in duplice copia?',
            'scontrini_trasferte_note' => 'Scontrini Trasferte Note',
            'copia_documenti' => 'L\'ufficio amministrativo di soggiorno ha una copia di tutti i documenti fiscali inviati alla Sede Centrale?',
            'copia_documenti_note' => 'Copia Documenti Note',
            'md0306' => '&Egrave; visibile e correttamente completato il documento acqusito servizi tuistici  MD 03-06 per prenotazione parchi, guide o altro?',
            'fornitori_selezionati' => 'Per l\'acquisto di servizi bus per gite sono utilizzati correttamente i fornitori selezionati dell\'ufficio commerciali di DOC e KELUAR?',
            'fornitori_selezionati_note' => 'Note',
            'md0306_note' => 'Md0306 Note',
            'md0305' => '&Egrave;  visibile e correttamente completato il documento acqusito SERVIZI BUS MD 03-05 per prenotazione bus e vettori?',
            'md0305_note' => 'Md0305 Note',
            'el0302' => '&Egrave; presente il Documento inviato dalla sede Centrale Elenco Offerte Vettori EL 03-02 ?',
            'el0302_note' => 'El0302 Note',
            'el0303' => '&Egrave; Presente il Documento da inviare alla sede Centrale Elenco Servizi Confermati EL 03-03 ?',
            'el0303_note' => 'El0303 Note',
            'el0304' => '&Egrave; Presente e correttamente compilato l\'elendo da inviare alle sede Registro Segnalazioni Trasferte EL 03-04 ?',
            'el0304_note' => 'El0304 Note',
            'note_2' => 'Note 2',
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'documento_qualita' => '&Egrave; PRESENTE IN STRUTTURA IL DOCUMENTO POLITICA DELLA QUALIT&Agrave; AMBIENTE E SICUREZZA ?',
            'documento_qualita_note' => 'Documento Qualita Note',
            'manuale_qualita' => '&Egrave; PRESENTE IL MANUALE DELLAL QUALIT&Agrave; ISO 9001 DI DOC SCS ?',
            'manuale_qualita_note' => 'Manuale Qualita Note',
            'manuale_gestione' => '&Egrave; PRESENTE IL MANUELE GESTIONE AMBIENTALE ISO 14001 SPECIFICO PER STRUTTURA ? - SOLO I CENTRI CON SPECIFICA CERTIFICAZIONE AMBIENTALE - ',
            'manuale_gestione_note' => 'Manuale Gestione Note',
            'istruzioni_operative' => 'IL PERSONALE DI DIREZIONE DELLA STRUTTURA/SOGGIORNO HA CONSEGNATO ALLA FORZA LAVORO L\'ISTRUZIONE OPERATIVA SPECIFICA DEL  SITO?',
            'istruzioni_operative_note' => 'Istruzioni Operative Note',
            'registri_gestioni_servizi' => 'IN CASO DI GESTIONE COMMERCIALE DELLA STRUTTURA SONO PRESENTI I REGISTRI GESTIONE SERVIZI EL 01 e 02 RAPPORTI COMMERCIALI E EL 03-04 SERVIZI SCOLASTICI?  - se si indicara data ultima registrazione',
            'registri_gestioni_servizi_note' => 'Registri Gestioni Servizi Note',
            'struttura_piattaforma_gestione' => 'LA STRUTTURA ACCEDE CORRETTAMENTE ALLA PIATTAFORMA DI GESTIONE QUALITA.COOPERATIVADOC.IT  ',
            'struttura_piattaforma_gestione_note' => 'Struttura Piattaforma Gestione Note',
            'casevacanze_piattaform_gestione' => 'LE CASE VACANZA DEL COMUNE DI MILANO ACCEDONO CORRETTAMENTE ALLA PIATTAFORMA DI GESTIONE QUALITA.SCUOLANATURAMILANO.IT',
            'casevacanze_piattaform_gestione_note' => 'Casevacanze Piattaform Gestione Note',
            'sezione_nonconformita' => 'LE NON COFORMIT&Agrave; E LE AZIONI CORRETTIVE (comprensive delle registrazione cartecee all\'interno delle schede di monitoraggio dell\'attivit&agrave; educativa) SONO CORRETTAMENTE INSERITE E GESTIONE NELLA SEZIONE NON  CONFORMIT&Agrave; DELLA PIATTAFORMA DI RIFERIMENTO? - inserire data ultima NC e AC registrata',
            'sezione_nonconformita_note' => 'Sezione Nonconformita Note',
            'sezione_reclami' => 'I RECLAMI EVENTUALMENTE RICEVUTI SONO STATI CORRETTAMENTE RIPORTATI ALL\'INTERNO DELLA SEZIONE RECLAMI DELLA PIATTAFORMA DI RIFERIMENTO?',
            'sezione_reclami_note' => 'Sezione Reclami Note',
            'indicatori_abientali' => 'I DATI E GLI INDICATORI AMBIENTALI SONO STATI CORRETTAMENTE RIPORTATI ALL\'INTERNO DELLA SEZIONE RECLAMI  DELLA PIATTAFORMA DI RIFERIMENTO?',
            'indicatori_abientali_note' => 'Indicatori Abientali Note',
            'verifiche_inspettive' => 'LE VERIFICHE ISPETTIVE INTERNE IN REGIME DI AUTOVALUTAZIONE SONO STATE CORRETTAMENTE REGISTRATE ALL\'INTERNO DELLA SEZIONE VERIFICHE ISPETTIVE DELLA PIATTAFORMA DI RIFERIMENTO?',
            'verifiche_inspettive_note' => 'Verifiche Inspettive Note',
            'note_3' => 'Note',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'numero_non_conformita' => 'Numero Non Conformita',
            'anno' => 'Anno',
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
        $criteria->compare('organico_completo', $this->organico_completo, true);
        $criteria->compare('organico_completo_note', $this->organico_completo_note, true);
        $criteria->compare('lettera_assunzione', $this->lettera_assunzione, true);
        $criteria->compare('lettera_assunzione_note', $this->lettera_assunzione_note, true);
        $criteria->compare('informativa_dlgs', $this->informativa_dlgs, true);
        $criteria->compare('informativa_dlgs_note', $this->informativa_dlgs_note, true);
        $criteria->compare('detrazione_imposta', $this->detrazione_imposta, true);
        $criteria->compare('detrazione_imposta_note', $this->detrazione_imposta_note, true);
        $criteria->compare('certificato_sanitario', $this->certificato_sanitario, true);
        $criteria->compare('certificato_sanitario_note', $this->certificato_sanitario_note, true);
        $criteria->compare('mip_bagnati', $this->mip_bagnati, true);
        $criteria->compare('mip_bagnati_note', $this->mip_bagnati_note, true);
        $criteria->compare('statuto', $this->statuto, true);
        $criteria->compare('statuto_note', $this->statuto_note, true);
        $criteria->compare('regolamento_doc', $this->regolamento_doc, true);
        $criteria->compare('regolamento_doc_note', $this->regolamento_doc_note, true);
        $criteria->compare('regolamento_soggiorno', $this->regolamento_soggiorno, true);
        $criteria->compare('regolamento_soggiorno_note', $this->regolamento_soggiorno_note, true);
        $criteria->compare('carta_prassi', $this->carta_prassi, true);
        $criteria->compare('carta_prassi_note', $this->carta_prassi_note, true);
        $criteria->compare('lettera_proroga', $this->lettera_proroga, true);
        $criteria->compare('lettera_proroga_note', $this->lettera_proroga_note, true);
        $criteria->compare('lettera_trasferiemnto', $this->lettera_trasferiemnto, true);
        $criteria->compare('lettera_trasferiemnto_note', $this->lettera_trasferiemnto_note, true);
        $criteria->compare('stato_dna', $this->stato_dna, true);
        $criteria->compare('stato_dna_note', $this->stato_dna_note, true);
        $criteria->compare('valutazione_personale', $this->valutazione_personale, true);
        $criteria->compare('valutazione_personale_note', $this->valutazione_personale_note, true);
        $criteria->compare('note_1', $this->note_1, true);
        $criteria->compare('osservazioni_1', $this->osservazioni_1, true);
        $criteria->compare('rapporto_giornaliero', $this->rapporto_giornaliero, true);
        $criteria->compare('rapporto_giornaliero_note', $this->rapporto_giornaliero_note, true);
        $criteria->compare('numero_clienti', $this->numero_clienti, true);
        $criteria->compare('numero_clienti_note', $this->numero_clienti_note, true);
        $criteria->compare('scheda_veicoli', $this->scheda_veicoli, true);
        $criteria->compare('scheda_veicoli_note', $this->scheda_veicoli_note, true);
        $criteria->compare('saldo_cassa', $this->saldo_cassa, true);
        $criteria->compare('saldo_cassa_note', $this->saldo_cassa_note, true);
        $criteria->compare('archiviazione_documenti', $this->archiviazione_documenti, true);
        $criteria->compare('archiviazione_documenti_note', $this->archiviazione_documenti_note, true);
        $criteria->compare('numero_protocollo', $this->numero_protocollo, true);
        $criteria->compare('numero_protocollo_note', $this->numero_protocollo_note, true);
        $criteria->compare('intestazione_documento', $this->intestazione_documento, true);
        $criteria->compare('intestazione_documento_note', $this->intestazione_documento_note, true);
        $criteria->compare('importo_documento', $this->importo_documento, true);
        $criteria->compare('importo_documento_note', $this->importo_documento_note, true);
        $criteria->compare('ragione_sociale_fornitore', $this->ragione_sociale_fornitore, true);
        $criteria->compare('ragione_sociale_fornitore_note', $this->ragione_sociale_fornitore_note, true);
        $criteria->compare('verifica_prezzi', $this->verifica_prezzi, true);
        $criteria->compare('verifica_prezzi_note', $this->verifica_prezzi_note, true);
        $criteria->compare('ordini_registrati', $this->ordini_registrati, true);
        $criteria->compare('ordini_registrati_note', $this->ordini_registrati_note, true);
        $criteria->compare('rimborso_trasferte', $this->rimborso_trasferte, true);
        $criteria->compare('rimborso_trasferte_note', $this->rimborso_trasferte_note, true);
        $criteria->compare('scontrini_trasferte', $this->scontrini_trasferte, true);
        $criteria->compare('scontrini_trasferte_note', $this->scontrini_trasferte_note, true);
        $criteria->compare('copia_documenti', $this->copia_documenti, true);
        $criteria->compare('copia_documenti_note', $this->copia_documenti_note, true);

        $criteria->compare('fornitori_selezionati', $this->fornitori_selezionati, true);
        $criteria->compare('fornitori_selezionati_note', $this->fornitori_selezionati_note, true);

        $criteria->compare('md0306', $this->md0306, true);
        $criteria->compare('md0306_note', $this->md0306_note, true);
        $criteria->compare('md0305', $this->md0305, true);
        $criteria->compare('md0305_note', $this->md0305_note, true);
        $criteria->compare('el0302', $this->el0302, true);
        $criteria->compare('el0302_note', $this->el0302_note, true);
        $criteria->compare('el0303', $this->el0303, true);
        $criteria->compare('el0303_note', $this->el0303_note, true);
        $criteria->compare('el0304', $this->el0304, true);
        $criteria->compare('el0304_note', $this->el0304_note, true);
        $criteria->compare('note_2', $this->note_2, true);
        $criteria->compare('osservazioni_2', $this->osservazioni_2, true);
        $criteria->compare('documento_qualita', $this->documento_qualita, true);
        $criteria->compare('documento_qualita_note', $this->documento_qualita_note, true);
        $criteria->compare('manuale_qualita', $this->manuale_qualita, true);
        $criteria->compare('manuale_qualita_note', $this->manuale_qualita_note, true);
        $criteria->compare('manuale_gestione', $this->manuale_gestione, true);
        $criteria->compare('manuale_gestione_note', $this->manuale_gestione_note, true);
        $criteria->compare('istruzioni_operative', $this->istruzioni_operative, true);
        $criteria->compare('istruzioni_operative_note', $this->istruzioni_operative_note, true);
        $criteria->compare('registri_gestioni_servizi', $this->registri_gestioni_servizi, true);
        $criteria->compare('registri_gestioni_servizi_note', $this->registri_gestioni_servizi_note, true);
        $criteria->compare('struttura_piattaforma_gestione', $this->struttura_piattaforma_gestione, true);
        $criteria->compare('struttura_piattaforma_gestione_note', $this->struttura_piattaforma_gestione_note, true);
        $criteria->compare('casevacanze_piattaform_gestione', $this->casevacanze_piattaform_gestione, true);
        $criteria->compare('casevacanze_piattaform_gestione_note', $this->casevacanze_piattaform_gestione_note, true);
        $criteria->compare('sezione_nonconformita', $this->sezione_nonconformita, true);
        $criteria->compare('sezione_nonconformita_note', $this->sezione_nonconformita_note, true);
        $criteria->compare('sezione_reclami', $this->sezione_reclami, true);
        $criteria->compare('sezione_reclami_note', $this->sezione_reclami_note, true);
        $criteria->compare('indicatori_abientali', $this->indicatori_abientali, true);
        $criteria->compare('indicatori_abientali_note', $this->indicatori_abientali_note, true);
        $criteria->compare('verifiche_inspettive', $this->verifiche_inspettive, true);
        $criteria->compare('verifiche_inspettive_note', $this->verifiche_inspettive_note, true);
        $criteria->compare('note_3', $this->note_3, true);
        $criteria->compare('numero_non_conformita', $this->numero_non_conformita, true);
        $criteria->compare('osservazioni_3', $this->osservazioni_3, true);

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
            1 => "1. GESTIONE DEL PERSONALE (GESTIONE DIRETTE - INDIRETTE - IN APPALTO)",
            2 => "2. GESTIONE PRATICHE AMMINISTRATIVE E DI SOGGIORNO ",
            3 => "3. SISTEMA GESTIONE QUALITA' E AMBIENTE STRUTTURE A ",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('organico_completo', 'lettera_assunzione', 'informativa_dlgs', 'detrazione_imposta', 'certificato_sanitario', 'mip_bagnati', 'statuto', 'regolamento_doc', 'regolamento_soggiorno', 'carta_prassi', 'lettera_proroga', 'lettera_trasferiemnto', 'stato_dna', 'valutazione_personale'),
            'sezione_2' => array('rapporto_giornaliero', 'numero_clienti', 'scheda_veicoli', 'saldo_cassa', 'archiviazione_documenti', 'numero_protocollo', 'intestazione_documento', 'importo_documento', 'ragione_sociale_fornitore', 'verifica_prezzi', 'ordini_registrati', 'rimborso_trasferte', 'scontrini_trasferte', 'copia_documenti', 'fornitori_selezionati', 'md0306', 'md0305', 'el0302', 'el0303', 'el0304'),
            'sezione_3' => array('documento_qualita', 'manuale_qualita', 'manuale_gestione', 'istruzioni_operative', 'registri_gestioni_servizi', 'struttura_piattaforma_gestione', 'casevacanze_piattaform_gestione', 'sezione_nonconformita', 'sezione_reclami', 'indicatori_abientali', 'verifiche_inspettive'),
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
                        
                        $query = "INSERT INTO " . $nc->tableName() . " (data,data_nc,unita_operativa,id_utente,anno,id_verifica,tipo_verifica,descrizione, nome, cognome ,tipologia)  VALUE ";
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "','" . addslashes($user['nome']) . "','" . addslashes($user['cognome']) . "' ,'18')";
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