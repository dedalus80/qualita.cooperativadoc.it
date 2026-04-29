<?php

class AzioniVerificheManutenzione extends CActiveRecord {

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
        return 'db_verifiche_manutenzione';
    }

    public function rules() {
        return array(
            array('id_verifica, codice_verifica, autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('stoccaggio_stato, stoccaggio_igiene, stoccaggio_protezioni, stoccaggio_griglie, stoccaggio_scafali, stoccaggio_flaconi, stoccaggio_contenitori, stoccaggio_conformi, detergenza_prodotti, detergenza_piano, detergenza_operazioni, detergenza_lavaggio, detergenza_schede, detergenza_attivita, detergenza_controlli, detergenza_verifiche, detergenza_documentazione, detergenza_nc, locali_uffici_ragnatele, locali_uffici_vetri, locali_uffici_pavimenti, locali_uffici_arredi, locali_uffici_servizi, locali_ludici_ragnatele, locali_ludici_vetri, locali_ludici_pavimenti, locali_ludici_arredi, locali_ludici_servizi, locali_camere_ragnatele, locali_camere_vetri, locali_camere_pavimenti, locali_camere_arredi, locali_camere_servizi, locali_comuni_ragnatele, locali_comuni_vetri, locali_comuni_pavimenti, locali_comuni_arredi, locali_comuni_servizi, locali_igienici_ragnatele, locali_igienici_vetri, locali_igienici_pavimenti, locali_igienici_sapone, locali_igienici_scarico, rifiuti_contenitori, rifiuti_area, rifiuti_esterno, rifiuti_documento, rifiuti_differenziata, personale_oragnico, personale_responsabile, personale_igiene, personale_comportamento, personale_dpi, personale_cartellino, personale_servizi, personale_saponi, personale_spogliatoi, personale_armadietti, personale_sporgenti, personale_davanzali, sanificazione_prodotti, sanificazione_piano, sanificazione_pulizia, sanificazione_lavaggio, sanificazione_schede, sanificazione_attivita, sanificazione_controlli, sanificazione_verifiche, sanificazione_documentazione, sanificazione_gestione, manutenzione_attrezzature, manutenzione_personale, manutenzione_periodiche, manutenzione_piano, manutenzione_frequenze', 'length', 'max' => 2),
            array('stoccaggio_stato_note, stoccaggio_igiene_note, stoccaggio_protezioni_note, stoccaggio_griglie_note, stoccaggio_scafali_note, stoccaggio_flaconi_note, stoccaggio_contenitori_note, stoccaggio_conformi_note, detergenza_prodotti_note, detergenza_piano_note, detergenza_operazioni_note, detergenza_lavaggio_note, detergenza_schede_note, detergenza_attivita_note, detergenza_controlli_note, detergenza_verifiche_note, detergenza_documentazione_note, detergenza_nc_note, locali_uffici_ragnatele_note, locali_uffici_vetri_note, locali_uffici_pavimenti_note, locali_uffici_arredi_note, locali_uffici_servizi_note, locali_ludici_ragnatele_note, locali_ludici_vetri_note, locali_ludici_pavimenti_note, locali_ludici_arredi_note, locali_ludici_servizi_note, locali_camere_ragnatele_note, locali_camere_vetri_note, locali_camere_pavimenti_note, locali_camere_arredi_note, locali_camere_servizi_note, locali_comuni_ragnatele_note, locali_comuni_vetri_note, locali_comuni_pavimenti_note, locali_comuni_arredi_note, locali_comuni_servizi_note, locali_igienici_ragnatele_note, locali_igienici_vetri_note, locali_igienici_pavimenti_note, locali_igienici_sapone_note, locali_igienici_scarico_note, rifiuti_contenitori_note, rifiuti_area_note, rifiuti_esterno_note, rifiuti_documento_note, rifiuti_differenziata_note, personale_oragnico_note, personale_responsabile_note, personale_igiene_note, personale_comportamento_note, personale_dpi_note, personale_cartellino_note, personale_servizi_note, personale_saponi_note, personale_spogliatoi_note, personale_armadietti_note, personale_sporgenti_note, personale_davanzali_note, sanificazione_prodotti_note, sanificazione_piano_note, sanificazione_pulizia_note, sanificazione_lavaggio_note, sanificazione_schede_note, sanificazione_attivita_note, sanificazione_controlli_note, sanificazione_verifiche_note, sanificazione_documentazione_note, sanificazione_gestione_note, manutenzione_attrezzature_note, manutenzione_personale_note, manutenzione_periodiche_note, manutenzione_piano_note, manutenzione_frequenze_note', 'length', 'max' => 255),
            array('data, ora_inizio, ora_fine, note_1, osservazioni_1, note_2, osservazioni_2, note_3, osservazioni_3, note_4, osservazioni_4, note_5, osservazioni_5, note_6, osservazioni_6, note_7, osservazioni_7', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, stoccaggio_stato, stoccaggio_stato_note, stoccaggio_igiene, stoccaggio_igiene_note, stoccaggio_protezioni, stoccaggio_protezioni_note, stoccaggio_griglie, stoccaggio_griglie_note, stoccaggio_scafali, stoccaggio_scafali_note, stoccaggio_flaconi, stoccaggio_flaconi_note, stoccaggio_contenitori, stoccaggio_contenitori_note, stoccaggio_conformi, stoccaggio_conformi_note, note_1, osservazioni_1, detergenza_prodotti, detergenza_prodotti_note, detergenza_piano, detergenza_piano_note, detergenza_operazioni, detergenza_operazioni_note, detergenza_lavaggio, detergenza_lavaggio_note, detergenza_schede, detergenza_schede_note, detergenza_attivita, detergenza_attivita_note, detergenza_controlli, detergenza_controlli_note, detergenza_verifiche, detergenza_verifiche_note, detergenza_documentazione, detergenza_documentazione_note, detergenza_nc, detergenza_nc_note, note_2, osservazioni_2, locali_uffici_ragnatele, locali_uffici_ragnatele_note, locali_uffici_vetri, locali_uffici_vetri_note, locali_uffici_pavimenti, locali_uffici_pavimenti_note, locali_uffici_arredi, locali_uffici_arredi_note, locali_uffici_servizi, locali_uffici_servizi_note, locali_ludici_ragnatele, locali_ludici_ragnatele_note, locali_ludici_vetri, locali_ludici_vetri_note, locali_ludici_pavimenti, locali_ludici_pavimenti_note, locali_ludici_arredi, locali_ludici_arredi_note, locali_ludici_servizi, locali_ludici_servizi_note, locali_camere_ragnatele, locali_camere_ragnatele_note, locali_camere_vetri, locali_camere_vetri_note, locali_camere_pavimenti, locali_camere_pavimenti_note, locali_camere_arredi, locali_camere_arredi_note, locali_camere_servizi, locali_camere_servizi_note, locali_comuni_ragnatele, locali_comuni_ragnatele_note, locali_comuni_vetri, locali_comuni_vetri_note, locali_comuni_pavimenti, locali_comuni_pavimenti_note, locali_comuni_arredi, locali_comuni_arredi_note, locali_comuni_servizi, locali_comuni_servizi_note, locali_igienici_ragnatele, locali_igienici_ragnatele_note, locali_igienici_vetri, locali_igienici_vetri_note, locali_igienici_pavimenti, locali_igienici_pavimenti_note, locali_igienici_sapone, locali_igienici_sapone_note, locali_igienici_scarico, locali_igienici_scarico_note, note_3, osservazioni_3, rifiuti_contenitori, rifiuti_contenitori_note, rifiuti_area, rifiuti_area_note, rifiuti_esterno, rifiuti_esterno_note, rifiuti_documento, rifiuti_documento_note, rifiuti_differenziata, rifiuti_differenziata_note, note_4, osservazioni_4, personale_oragnico, personale_oragnico_note, personale_responsabile, personale_responsabile_note, personale_igiene, personale_igiene_note, personale_comportamento, personale_comportamento_note, personale_dpi, personale_dpi_note, personale_cartellino, personale_cartellino_note, personale_servizi, personale_servizi_note, personale_saponi, personale_saponi_note, personale_spogliatoi, personale_spogliatoi_note, personale_armadietti, personale_armadietti_note, personale_sporgenti, personale_sporgenti_note, personale_davanzali, personale_davanzali_note, note_5, osservazioni_5, sanificazione_prodotti, sanificazione_prodotti_note, sanificazione_piano, sanificazione_piano_note, sanificazione_pulizia, sanificazione_pulizia_note, sanificazione_lavaggio, sanificazione_lavaggio_note, sanificazione_schede, sanificazione_schede_note, sanificazione_attivita, sanificazione_attivita_note, sanificazione_controlli, sanificazione_controlli_note, sanificazione_verifiche, sanificazione_verifiche_note, sanificazione_documentazione, sanificazione_documentazione_note, sanificazione_gestione, sanificazione_gestione_note, note_6, osservazioni_6, manutenzione_attrezzature, manutenzione_attrezzature_note, manutenzione_personale, manutenzione_personale_note, manutenzione_periodiche, manutenzione_periodiche_note, manutenzione_piano, manutenzione_piano_note, manutenzione_frequenze, manutenzione_frequenze_note, note_7, osservazioni_7, anno', 'safe', 'on' => 'search'),
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
            'stoccaggio_stato' => 'Stato igienico zona esterna',
            'stoccaggio_stato_note' => 'Stoccaggio Stato Note',
            'stoccaggio_igiene' => 'Igiene del magazzino (pareti, pavimenti, griglie, scaffalature, etc)',
            'stoccaggio_igiene_note' => 'Stoccaggio Igiene Note',
            'stoccaggio_protezioni' => 'Presenza di protezioni anti infestanti ed integrit&agrave; delle protezioni',
            'stoccaggio_protezioni_note' => 'Stoccaggio Protezioni Note',
            'stoccaggio_griglie' => 'Sono presenti griglie e/o scaffalature con tracce di ruggine o danneggiate?',
            'stoccaggio_griglie_note' => 'Stoccaggio Griglie Note',
            'stoccaggio_scafali' => 'Tutte le scaffalature hanno il cartello di indicazione del peso massimo sostenibile?',
            'stoccaggio_scafali_note' => 'Stoccaggio Scafali Note',
            'stoccaggio_flaconi' => 'Sono assenti flaconi non etichettati',
            'stoccaggio_flaconi_note' => 'Stoccaggio Flaconi Note',
            'stoccaggio_contenitori' => 'I prodotti detergenti e sanificanti sono stoccati in contenitori di plastica con l\'obiettivo di evitare eventuali sversamenti di liquido a terra?',
            'stoccaggio_contenitori_note' => 'Stoccaggio Contenitori Note',
            'stoccaggio_conformi' => 'I prodotti detergenti e sanificanti sono conformi al piano detergenza e sanificazione?',
            'stoccaggio_conformi_note' => 'Stoccaggio Conformi Note',
            'note_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'detergenza_prodotti' => 'I prodotti detergenti e sanificanti sono conformi al piano di detergenza e sanificazione?',
            'detergenza_prodotti_note' => 'Detergenza Prodotti Note',
            'detergenza_piano' => 'Il piano di detergenza e sanificazione &egrave; eseguito correttamente (verificare la modalit&agrave; e la frequenza)',
            'detergenza_piano_note' => 'Detergenza Piano Note',
            'detergenza_operazioni' => 'Le operazioni di pulizia e sanificazione vengono effettuate correttamente? ( indicare a campione modalit&agrave;, responsabilit&agrave;, prodotti da utilizzare e relative concentrazioni ed eventuale riferimento documentale ISTRUZIONE OPERATIVA, PIANO DI SANIFICAZIONE, PROCEDURA)',
            'detergenza_operazioni_note' => 'Detergenza Operazioni Note',
            'detergenza_lavaggio' => 'Viene effettuato il lavaggio per aspersione della mobilit&agrave; e delle attrezzature?',
            'detergenza_lavaggio_note' => 'Detergenza Lavaggio Note',
            'detergenza_schede' => 'Sono presenti le schede tecniche dei prodotti in uso?',
            'detergenza_schede_note' => 'Detergenza Schede Note',
            'detergenza_attivita' => 'REGISTRAZIONE  attivit&agrave; di detergenza e sanificazione',
            'detergenza_attivita_note' => 'Detergenza Attivita Note',
            'detergenza_controlli' => 'REGISTRAZIONE Controlli / monitoraggi',
            'detergenza_controlli_note' => 'Detergenza Controlli Note',
            'detergenza_verifiche' => 'REGISTRAZIONE Verifiche ispettive interne - inserire ultima verifica riscontrata',
            'detergenza_verifiche_note' => 'Detergenza Verifiche Note',
            'detergenza_documentazione' => 'Documentazione formazione personale',
            'detergenza_documentazione_note' => 'Detergenza Documentazione Note',
            'detergenza_nc' => 'Gestione delle non conformit&agrave; sulla piattaforma qualita.cooperativadoc.it o qualita.scuolanaturamilano.it',
            'detergenza_nc_note' => 'Detergenza Nc Note',
            'note_2' => 'Note 2',
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'locali_uffici_ragnatele' => 'Assenza di ragnatele',
            'locali_uffici_ragnatele_note' => 'Locali Uffici Ragnatele Note',
            'locali_uffici_vetri' => 'Stato di vetri, stipiti, porte',
            'locali_uffici_vetri_note' => 'Locali Uffici Vetri Note',
            'locali_uffici_pavimenti' => 'Pavimenti e pareti',
            'locali_uffici_pavimenti_note' => 'Locali Uffici Pavimenti Note',
            'locali_uffici_arredi' => 'Altri arredi',
            'locali_uffici_arredi_note' => 'Locali Uffici Arredi Note',
            'locali_uffici_servizi' => 'Servizi igienici dedicati',
            'locali_uffici_servizi_note' => 'Locali Uffici Servizi Note',
            'locali_ludici_ragnatele' => 'Assenza di ragnatele',
            'locali_ludici_ragnatele_note' => 'Locali Ludici Ragnatele Note',
            'locali_ludici_vetri' => 'Stato di vetri, stipiti, porte',
            'locali_ludici_vetri_note' => 'Locali Ludici Vetri Note',
            'locali_ludici_pavimenti' => 'Pavimenti e pareti',
            'locali_ludici_pavimenti_note' => 'Locali Ludici Pavimenti Note',
            'locali_ludici_arredi' => 'Altri arredi',
            'locali_ludici_arredi_note' => 'Locali Ludici Arredi Note',
            'locali_ludici_servizi' => 'Servizi igienici dedicati',
            'locali_ludici_servizi_note' => 'Locali Ludici Servizi Note',
            'locali_camere_ragnatele' => 'Assenza di ragnatele',
            'locali_camere_ragnatele_note' => 'Locali Camere Ragnatele Note',
            'locali_camere_vetri' => 'Stato di vetri, stipiti, porte',
            'locali_camere_vetri_note' => 'Locali Camere Vetri Note',
            'locali_camere_pavimenti' => 'Pavimenti e pareti',
            'locali_camere_pavimenti_note' => 'Locali Camere Pavimenti Note',
            'locali_camere_arredi' => 'Letti Armadi Comodini',
            'locali_camere_arredi_note' => 'Locali Camere Arredi Note',
            'locali_camere_servizi' => 'Servizi igienici dedicati',
            'locali_camere_servizi_note' => 'Locali Camere Servizi Note',
            'locali_comuni_ragnatele' => 'Assenza di ragnatele',
            'locali_comuni_ragnatele_note' => 'Locali Comuni Ragnatele Note',
            'locali_comuni_vetri' => 'Stato di vetri, stipiti, porte',
            'locali_comuni_vetri_note' => 'Locali Comuni Vetri Note',
            'locali_comuni_pavimenti' => 'Pavimenti e pareti',
            'locali_comuni_pavimenti_note' => 'Locali Comuni Pavimenti Note',
            'locali_comuni_arredi' => 'Ringhiere e scale',
            'locali_comuni_arredi_note' => 'Locali Comuni Arredi Note',
            // 'locali_comuni_servizi' => 'Locali Comuni Servizi',
            // 'locali_comuni_servizi_note' => 'Locali Comuni Servizi Note',
            'locali_igienici_ragnatele' => 'Assenza di ragnatele',
            'locali_igienici_ragnatele_note' => 'Locali Igienici Ragnatele Note',
            'locali_igienici_vetri' => 'Stato di vetri, stipiti, porte',
            'locali_igienici_vetri_note' => 'Locali Igienici Vetri Note',
            'locali_igienici_pavimenti' => 'Pavimenti e pareti',
            'locali_igienici_pavimenti_note' => 'Locali Igienici Pavimenti Note',
            'locali_igienici_sapone' => 'Presenza Sapone / Carta Igienica',
            'locali_igienici_sapone_note' => 'Locali Igienici Arredi Note',
            'locali_igienici_scarico' => 'Corretto funzionamento impianti di scarico',
            'locali_igienici_scarico_note' => 'Locali Igienici Servizi Note',
            'note_3' => 'Note 3',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'rifiuti_contenitori' => 'I contenitori per i rifiuti sono conformi?',
            'rifiuti_contenitori_note' => 'Rifiuti Contenitori Note',
            'rifiuti_area' => 'L\'area esterna risulta pulita ed in ordine?',
            'rifiuti_area_note' => 'Rifiuti Area Note',
            'rifiuti_esterno' => 'Nell\'area esterna sono presenti attrezzature in disuso in attesa di rimozione?',
            'rifiuti_esterno_note' => 'Rifiuti Esterno Note',
            'rifiuti_documento' => 'Se si &egrave; reperibile un documento o altra evidenza che indetifichi la programmata rimozione dell\'attrezzatura per il corretto smaltimento?',
            'rifiuti_documento_note' => 'Rifiuti Documento Note',
            'rifiuti_differenziata' => 'Viene eseguita la raccolta differenziata in maniera corretta e conforme ai regolamenti locali?',
            'rifiuti_differenziata_note' => 'Rifiuti Differenziata Note',
            'note_4' => 'Note 4',
            'osservazioni_4' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'personale_oragnico' => 'L\'organico &egrave; presente in numero conforme/congruo? (indicare il numero):',
            'personale_oragnico_note' => 'Personale Oragnico Note',
            'personale_responsabile' => 'Il responsabile di servizio &egrave; presente?',
            'personale_responsabile_note' => 'Personale Responsabile Note',
            'personale_igiene' => 'L\'igiene dell\'abbigliamento &egrave; conforme?',
            'personale_igiene_note' => 'Personale Igiene Note',
            'personale_comportamento' => 'Il comportamento igienico del personale &egrave; corretto (divieto di fumare, di mangiare, ecc.)',
            'personale_comportamento_note' => 'Personale Comportamento Note',
            'personale_dpi' => 'Il personale indossa correttamente i DPI previsti per le attivit&agrave; in corso al momento della Verifica Ispettiva?',
            'personale_dpi_note' => 'Personale Dpi Note',
            'personale_cartellino' => 'Il personale indossa a vista il cartellino identificativo e questo risulta integro e completo in tutte le sue parti?',
            'personale_cartellino_note' => 'Personale Cartellino Note',
            'personale_servizi' => 'I servizi igienici del personale sono puliti ed in ordine?',
            'personale_servizi_note' => 'Personale Servizi Note',
            'personale_sapone' => 'Sono presenti saponi e asciugamani a perdereo sistemi ad aria?',
            'personale_sapone_note' => 'Personale Saponi Note',
            'personale_spogliatoi' => 'Gli spogliatoi sono puliti ed in ordine?',
            'personale_spogliatoi_note' => 'Personale Spogliatoi Note',
            'personale_armadietti' => 'Gli spoiatoi sono adeguati e sono presenti armadietti a doppio scomparto in numero sufficiente? ',
            'personale_armadietti_note' => 'Personale Armadietti Note',
            'personale_sporgenti' => 'Verificare Assenza nello spoiatoio di armadietti divelti o con parti sporgenti taglienti',
            'personale_sporgenti_note' => 'Personale Sporgenti Note',
            'personale_davanzali' => 'Ove presenti i davanziali, finestra, infissi sono adeguatamente puliti e con reti di protezione?',
            'personale_davanzali_note' => 'Personale Davanzali Note',
            'note_5' => 'Note 5',
            'osservazioni_5' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'sanificazione_prodotti' => 'I prodotti detergenti e sanificanti sono conformi al piano di detergenza e sanificazione?',
            'sanificazione_prodotti_note' => 'Sanificazione Prodotti Note',
            'sanificazione_piano' => 'Il piano di detergenza e sanificazione &egrave; eseguito correttamente (verificare la modalit&agrave; e la frequenza)',
            'sanificazione_piano_note' => 'Sanificazione Piano Note',
            'sanificazione_pulizia' => 'Le operazioni di pulizia e sanificazione vengono effettuate correttamente? ( indicare a campione modalit&agrave;, responsabilit&agrave;, prodotti da utilizzare e relative concentrazioni ed eventuale riferimento documentale ISTRUZIONE OPERATIVA, PIANO DI SANIFICAZIONE, PROCEDURA)',
            'sanificazione_pulizia_note' => 'Sanificazione Pulizia Note',
            'sanificazione_lavaggio' => 'Viene effettuato il lavaggio per aspersione della mobilit&agrave; e delle attrezzature?',
            'sanificazione_lavaggio_note' => 'Sanificazione Lavaggio Note',
            'sanificazione_schede' => 'Sono presenti le schede tecniche dei prodotti in uso?',
            'sanificazione_schede_note' => 'Sanificazione Schede Note',
            'sanificazione_attivita' => 'REGISTRAZIONE  attivit&agrave; di detergenza e sanificazione',
            'sanificazione_attivita_note' => 'Sanificazione Attivita Note',
            'sanificazione_controlli' => 'REGISTRAZIONE Controlli / monitoraggi',
            'sanificazione_controlli_note' => 'Sanificazione Controlli Note',
            'sanificazione_verifiche' => 'REGISTRAZIONE Verifiche ispettive interne - inserire ultima verifica riscontrata',
            'sanificazione_verifiche_note' => 'Sanificazione Verifiche Note',
            'sanificazione_documentazione' => 'Documentazione formazione personale',
            'sanificazione_documentazione_note' => 'Sanificazione Documentazione Note',
            'sanificazione_gestione' => 'Gestione delle non conformit&agrave; sulla piattaforma qualita.cooperativadoc.it o qualita.scuolanaturamilano.it',
            'sanificazione_gestione_note' => 'Sanificazione Gestione Note',
            'note_6' => 'Note 6',
            'osservazioni_6' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'manutenzione_attrezzature' => 'Le attrezzature in dotazione sono coerenti con il piano normativo di riferimento?',
            'manutenzione_attrezzature_note' => 'Manutenzione Attrezzature Note',
            'manutenzione_personale' => 'Il personale addetto alla manutenzione ha ricevuto i DPI necessari per lo svolgimento delle attivit&agrave; previste dal capitolato',
            'manutenzione_personale_note' => 'Manutenzione Personale Note',
            'manutenzione_periodiche' => 'Sono state effettuate le manutenzioni periodiche alle attrezzature che lo necessitano) indicare ultima manutenzione.',
            'manutenzione_periodiche_note' => 'Manutenzione Periodiche Note',
            'manutenzione_piano' => '&Egrave; Presente il piano delle manutenzioni periodiche riferite alla struttura e alle aree esterne?',
            'manutenzione_piano_note' => 'Manutenzione Piano Note',
            'manutenzione_frequenze' => 'Se presente sono rispettate le frequenze previste?',
            'manutenzione_frequenze_note' => 'Manutenzione Frequenze Note',
            'note_7' => 'Note 7',
            'osservazioni_7' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
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
        $criteria->compare('stoccaggio_stato', $this->stoccaggio_stato, true);
        $criteria->compare('stoccaggio_stato_note', $this->stoccaggio_stato_note, true);
        $criteria->compare('stoccaggio_igiene', $this->stoccaggio_igiene, true);
        $criteria->compare('stoccaggio_igiene_note', $this->stoccaggio_igiene_note, true);
        $criteria->compare('stoccaggio_protezioni', $this->stoccaggio_protezioni, true);
        $criteria->compare('stoccaggio_protezioni_note', $this->stoccaggio_protezioni_note, true);
        $criteria->compare('stoccaggio_griglie', $this->stoccaggio_griglie, true);
        $criteria->compare('stoccaggio_griglie_note', $this->stoccaggio_griglie_note, true);
        $criteria->compare('stoccaggio_scafali', $this->stoccaggio_scafali, true);
        $criteria->compare('stoccaggio_scafali_note', $this->stoccaggio_scafali_note, true);
        $criteria->compare('stoccaggio_flaconi', $this->stoccaggio_flaconi, true);
        $criteria->compare('stoccaggio_flaconi_note', $this->stoccaggio_flaconi_note, true);
        $criteria->compare('stoccaggio_contenitori', $this->stoccaggio_contenitori, true);
        $criteria->compare('stoccaggio_contenitori_note', $this->stoccaggio_contenitori_note, true);
        $criteria->compare('stoccaggio_conformi', $this->stoccaggio_conformi, true);
        $criteria->compare('stoccaggio_conformi_note', $this->stoccaggio_conformi_note, true);
        $criteria->compare('note_1', $this->note_1, true);
        $criteria->compare('osservazioni_1', $this->osservazioni_1, true);
        $criteria->compare('detergenza_prodotti', $this->detergenza_prodotti, true);
        $criteria->compare('detergenza_prodotti_note', $this->detergenza_prodotti_note, true);
        $criteria->compare('detergenza_piano', $this->detergenza_piano, true);
        $criteria->compare('detergenza_piano_note', $this->detergenza_piano_note, true);
        $criteria->compare('detergenza_operazioni', $this->detergenza_operazioni, true);
        $criteria->compare('detergenza_operazioni_note', $this->detergenza_operazioni_note, true);
        $criteria->compare('detergenza_lavaggio', $this->detergenza_lavaggio, true);
        $criteria->compare('detergenza_lavaggio_note', $this->detergenza_lavaggio_note, true);
        $criteria->compare('detergenza_schede', $this->detergenza_schede, true);
        $criteria->compare('detergenza_schede_note', $this->detergenza_schede_note, true);
        $criteria->compare('detergenza_attivita', $this->detergenza_attivita, true);
        $criteria->compare('detergenza_attivita_note', $this->detergenza_attivita_note, true);
        $criteria->compare('detergenza_controlli', $this->detergenza_controlli, true);
        $criteria->compare('detergenza_controlli_note', $this->detergenza_controlli_note, true);
        $criteria->compare('detergenza_verifiche', $this->detergenza_verifiche, true);
        $criteria->compare('detergenza_verifiche_note', $this->detergenza_verifiche_note, true);
        $criteria->compare('detergenza_documentazione', $this->detergenza_documentazione, true);
        $criteria->compare('detergenza_documentazione_note', $this->detergenza_documentazione_note, true);
        $criteria->compare('detergenza_nc', $this->detergenza_nc, true);
        $criteria->compare('detergenza_nc_note', $this->detergenza_nc_note, true);
        $criteria->compare('note_2', $this->note_2, true);
        $criteria->compare('osservazioni_2', $this->osservazioni_2, true);
        $criteria->compare('locali_uffici_ragnatele', $this->locali_uffici_ragnatele, true);
        $criteria->compare('locali_uffici_ragnatele_note', $this->locali_uffici_ragnatele_note, true);
        $criteria->compare('locali_uffici_vetri', $this->locali_uffici_vetri, true);
        $criteria->compare('locali_uffici_vetri_note', $this->locali_uffici_vetri_note, true);
        $criteria->compare('locali_uffici_pavimenti', $this->locali_uffici_pavimenti, true);
        $criteria->compare('locali_uffici_pavimenti_note', $this->locali_uffici_pavimenti_note, true);
        $criteria->compare('locali_uffici_arredi', $this->locali_uffici_arredi, true);
        $criteria->compare('locali_uffici_arredi_note', $this->locali_uffici_arredi_note, true);
        $criteria->compare('locali_uffici_servizi', $this->locali_uffici_servizi, true);
        $criteria->compare('locali_uffici_servizi_note', $this->locali_uffici_servizi_note, true);
        $criteria->compare('locali_ludici_ragnatele', $this->locali_ludici_ragnatele, true);
        $criteria->compare('locali_ludici_ragnatele_note', $this->locali_ludici_ragnatele_note, true);
        $criteria->compare('locali_ludici_vetri', $this->locali_ludici_vetri, true);
        $criteria->compare('locali_ludici_vetri_note', $this->locali_ludici_vetri_note, true);
        $criteria->compare('locali_ludici_pavimenti', $this->locali_ludici_pavimenti, true);
        $criteria->compare('locali_ludici_pavimenti_note', $this->locali_ludici_pavimenti_note, true);
        $criteria->compare('locali_ludici_arredi', $this->locali_ludici_arredi, true);
        $criteria->compare('locali_ludici_arredi_note', $this->locali_ludici_arredi_note, true);
        $criteria->compare('locali_ludici_servizi', $this->locali_ludici_servizi, true);
        $criteria->compare('locali_ludici_servizi_note', $this->locali_ludici_servizi_note, true);
        $criteria->compare('locali_camere_ragnatele', $this->locali_camere_ragnatele, true);
        $criteria->compare('locali_camere_ragnatele_note', $this->locali_camere_ragnatele_note, true);
        $criteria->compare('locali_camere_vetri', $this->locali_camere_vetri, true);
        $criteria->compare('locali_camere_vetri_note', $this->locali_camere_vetri_note, true);
        $criteria->compare('locali_camere_pavimenti', $this->locali_camere_pavimenti, true);
        $criteria->compare('locali_camere_pavimenti_note', $this->locali_camere_pavimenti_note, true);
        $criteria->compare('locali_camere_arredi', $this->locali_camere_arredi, true);
        $criteria->compare('locali_camere_arredi_note', $this->locali_camere_arredi_note, true);
        $criteria->compare('locali_camere_servizi', $this->locali_camere_servizi, true);
        $criteria->compare('locali_camere_servizi_note', $this->locali_camere_servizi_note, true);
        $criteria->compare('locali_comuni_ragnatele', $this->locali_comuni_ragnatele, true);
        $criteria->compare('locali_comuni_ragnatele_note', $this->locali_comuni_ragnatele_note, true);
        $criteria->compare('locali_comuni_vetri', $this->locali_comuni_vetri, true);
        $criteria->compare('locali_comuni_vetri_note', $this->locali_comuni_vetri_note, true);
        $criteria->compare('locali_comuni_pavimenti', $this->locali_comuni_pavimenti, true);
        $criteria->compare('locali_comuni_pavimenti_note', $this->locali_comuni_pavimenti_note, true);
        $criteria->compare('locali_comuni_arredi', $this->locali_comuni_arredi, true);
        $criteria->compare('locali_comuni_arredi_note', $this->locali_comuni_arredi_note, true);
        $criteria->compare('locali_comuni_servizi', $this->locali_comuni_servizi, true);
        $criteria->compare('locali_comuni_servizi_note', $this->locali_comuni_servizi_note, true);
        $criteria->compare('locali_igienici_ragnatele', $this->locali_igienici_ragnatele, true);
        $criteria->compare('locali_igienici_ragnatele_note', $this->locali_igienici_ragnatele_note, true);
        $criteria->compare('locali_igienici_vetri', $this->locali_igienici_vetri, true);
        $criteria->compare('locali_igienici_vetri_note', $this->locali_igienici_vetri_note, true);
        $criteria->compare('locali_igienici_pavimenti', $this->locali_igienici_pavimenti, true);
        $criteria->compare('locali_igienici_pavimenti_note', $this->locali_igienici_pavimenti_note, true);
        $criteria->compare('locali_igienici_sapone', $this->locali_igienici_sapone, true);
        $criteria->compare('locali_igienici_sapone_note', $this->locali_igienici_sapone_note, true);
        $criteria->compare('locali_igienici_scarico', $this->locali_igienici_scarico, true);
        $criteria->compare('locali_igienici_scarico_note', $this->locali_igienici_scarico_note, true);
        $criteria->compare('note_3', $this->note_3, true);
        $criteria->compare('osservazioni_3', $this->osservazioni_3, true);
        $criteria->compare('rifiuti_contenitori', $this->rifiuti_contenitori, true);
        $criteria->compare('rifiuti_contenitori_note', $this->rifiuti_contenitori_note, true);
        $criteria->compare('rifiuti_area', $this->rifiuti_area, true);
        $criteria->compare('rifiuti_area_note', $this->rifiuti_area_note, true);
        $criteria->compare('rifiuti_esterno', $this->rifiuti_esterno, true);
        $criteria->compare('rifiuti_esterno_note', $this->rifiuti_esterno_note, true);
        $criteria->compare('rifiuti_documento', $this->rifiuti_documento, true);
        $criteria->compare('rifiuti_documento_note', $this->rifiuti_documento_note, true);
        $criteria->compare('rifiuti_differenziata', $this->rifiuti_differenziata, true);
        $criteria->compare('rifiuti_differenziata_note', $this->rifiuti_differenziata_note, true);
        $criteria->compare('note_4', $this->note_4, true);
        $criteria->compare('osservazioni_4', $this->osservazioni_4, true);
        $criteria->compare('personale_oragnico', $this->personale_oragnico, true);
        $criteria->compare('personale_oragnico_note', $this->personale_oragnico_note, true);
        $criteria->compare('personale_responsabile', $this->personale_responsabile, true);
        $criteria->compare('personale_responsabile_note', $this->personale_responsabile_note, true);
        $criteria->compare('personale_igiene', $this->personale_igiene, true);
        $criteria->compare('personale_igiene_note', $this->personale_igiene_note, true);
        $criteria->compare('personale_comportamento', $this->personale_comportamento, true);
        $criteria->compare('personale_comportamento_note', $this->personale_comportamento_note, true);
        $criteria->compare('personale_dpi', $this->personale_dpi, true);
        $criteria->compare('personale_dpi_note', $this->personale_dpi_note, true);
        $criteria->compare('personale_cartellino', $this->personale_cartellino, true);
        $criteria->compare('personale_cartellino_note', $this->personale_cartellino_note, true);
        $criteria->compare('personale_servizi', $this->personale_servizi, true);
        $criteria->compare('personale_servizi_note', $this->personale_servizi_note, true);
        $criteria->compare('personale_saponi', $this->personale_saponi, true);
        $criteria->compare('personale_saponi_note', $this->personale_saponi_note, true);
        $criteria->compare('personale_spogliatoi', $this->personale_spogliatoi, true);
        $criteria->compare('personale_spogliatoi_note', $this->personale_spogliatoi_note, true);
        $criteria->compare('personale_armadietti', $this->personale_armadietti, true);
        $criteria->compare('personale_armadietti_note', $this->personale_armadietti_note, true);
        $criteria->compare('personale_sporgenti', $this->personale_sporgenti, true);
        $criteria->compare('personale_sporgenti_note', $this->personale_sporgenti_note, true);
        $criteria->compare('personale_davanzali', $this->personale_davanzali, true);
        $criteria->compare('personale_davanzali_note', $this->personale_davanzali_note, true);
        $criteria->compare('note_5', $this->note_5, true);
        $criteria->compare('osservazioni_5', $this->osservazioni_5, true);
        $criteria->compare('sanificazione_prodotti', $this->sanificazione_prodotti, true);
        $criteria->compare('sanificazione_prodotti_note', $this->sanificazione_prodotti_note, true);
        $criteria->compare('sanificazione_piano', $this->sanificazione_piano, true);
        $criteria->compare('sanificazione_piano_note', $this->sanificazione_piano_note, true);
        $criteria->compare('sanificazione_pulizia', $this->sanificazione_pulizia, true);
        $criteria->compare('sanificazione_pulizia_note', $this->sanificazione_pulizia_note, true);
        $criteria->compare('sanificazione_lavaggio', $this->sanificazione_lavaggio, true);
        $criteria->compare('sanificazione_lavaggio_note', $this->sanificazione_lavaggio_note, true);
        $criteria->compare('sanificazione_schede', $this->sanificazione_schede, true);
        $criteria->compare('sanificazione_schede_note', $this->sanificazione_schede_note, true);
        $criteria->compare('sanificazione_attivita', $this->sanificazione_attivita, true);
        $criteria->compare('sanificazione_attivita_note', $this->sanificazione_attivita_note, true);
        $criteria->compare('sanificazione_controlli', $this->sanificazione_controlli, true);
        $criteria->compare('sanificazione_controlli_note', $this->sanificazione_controlli_note, true);
        $criteria->compare('sanificazione_verifiche', $this->sanificazione_verifiche, true);
        $criteria->compare('sanificazione_verifiche_note', $this->sanificazione_verifiche_note, true);
        $criteria->compare('sanificazione_documentazione', $this->sanificazione_documentazione, true);
        $criteria->compare('sanificazione_documentazione_note', $this->sanificazione_documentazione_note, true);
        $criteria->compare('sanificazione_gestione', $this->sanificazione_gestione, true);
        $criteria->compare('sanificazione_gestione_note', $this->sanificazione_gestione_note, true);
        $criteria->compare('note_6', $this->note_6, true);
        $criteria->compare('osservazioni_6', $this->osservazioni_6, true);
        $criteria->compare('manutenzione_attrezzature', $this->manutenzione_attrezzature, true);
        $criteria->compare('manutenzione_attrezzature_note', $this->manutenzione_attrezzature_note, true);
        $criteria->compare('manutenzione_personale', $this->manutenzione_personale, true);
        $criteria->compare('manutenzione_personale_note', $this->manutenzione_personale_note, true);
        $criteria->compare('manutenzione_periodiche', $this->manutenzione_periodiche, true);
        $criteria->compare('manutenzione_periodiche_note', $this->manutenzione_periodiche_note, true);
        $criteria->compare('manutenzione_piano', $this->manutenzione_piano, true);
        $criteria->compare('manutenzione_piano_note', $this->manutenzione_piano_note, true);
        $criteria->compare('manutenzione_frequenze', $this->manutenzione_frequenze, true);
        $criteria->compare('manutenzione_frequenze_note', $this->manutenzione_frequenze_note, true);
        $criteria->compare('note_7', $this->note_7, true);
        $criteria->compare('osservazioni_7', $this->osservazioni_7, true);
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
            1 => "1. CARATTERISTICHE STRUTTURALI E IGIENICHE DELLE AREE DI STOCCAGGIO",
            2 => "2. GESTIONE DETERGENZA E SANIFICAZIONE",
            3 => "3. VERIFICA CONFORMITA' SPAZI ",
            4 => "4. GESTIONE DEI RIFIUTI",
            5 => "5. PERSONALE",
            6 => "6. GESTIONE DETERGENZA E SANIFICAZIONE",
            7 => "7. MANUTENZIONE",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('stoccaggio_stato', 'stoccaggio_igiene', 'stoccaggio_protezioni', 'stoccaggio_griglie', 'stoccaggio_scafali', 'stoccaggio_flaconi', 'stoccaggio_contenitori', 'stoccaggio_conformi'),
            'sezione_2' => array('detergenza_prodotti', 'detergenza_piano', 'detergenza_operazioni', 'detergenza_lavaggio', 'detergenza_schede', 'detergenza_attivita', 'detergenza_controlli', 'detergenza_verifiche', 'detergenza_documentazione', 'detergenza_nc'),
            'sezione_3' => array('locali_uffici_ragnatele', 'locali_uffici_vetri', 'locali_uffici_pavimenti', 'locali_uffici_arredi', 'locali_uffici_servizi', 'locali_ludici_ragnatele', 'locali_ludici_vetri', 'locali_ludici_pavimenti', 'locali_ludici_arredi', 'locali_ludici_servizi', 'locali_camere_ragnatele', 'locali_camere_vetri', 'locali_camere_pavimenti', 'locali_camere_arredi', 'locali_camere_servizi', 'locali_comuni_ragnatele', 'locali_comuni_vetri', 'locali_comuni_pavimenti', 'locali_comuni_arredi', 'locali_comuni_servizi', 'locali_igienici_ragnatele', 'locali_igienici_vetri', 'locali_igienici_pavimenti', 'locali_igienici_sapone', 'locali_igienici_scarico'),
            'sezione_4' => array('rifiuti_contenitori', 'rifiuti_area', 'rifiuti_esterno', 'rifiuti_documento', 'rifiuti_differenziata'),
            'sezione_5' => array('personale_oragnico', 'personale_responsabile', 'personale_igiene', 'personale_comportamento', 'personale_dpi', 'personale_cartellino', 'personale_servizi', 'personale_saponi', 'personale_spogliatoi', 'personale_armadietti', 'personale_sporgenti', 'personale_davanzali'),
            'sezione_6' => array('sanificazione_prodotti', 'sanificazione_piano', 'sanificazione_pulizia', 'sanificazione_lavaggio', 'sanificazione_schede', 'sanificazione_attivita', 'sanificazione_controlli', 'sanificazione_verifiche', 'sanificazione_documentazione', 'sanificazione_gestione'),
            'sezione_7' => array('manutenzione_attrezzature', 'manutenzione_personale', 'manutenzione_periodiche', 'manutenzione_piano', 'manutenzione_frequenze'),
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
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "' ,'" . addslashes($user['nome']) . "','" . addslashes($user['cognome']) . "' ,'20')";
                        if (Yii::app()->db->createCommand($query)->execute()) {
                            $LID = Yii::app()->db->lastInsertID;
                            $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $LID);
                            Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET codice ='" . $codice . "' WHERE id ='" . $LID . "'  ")->execute();
                        }
                    }else
                        Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET data= NOW() , data_nc = NOW() , id_utente ='" . Yii::app()->user->getId() . "' , id_verifica ='" . $this->id_verifica . "' , tipo_verifica='" . $val[$x] . "' , descrizione ='" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "'   WHERE id ='" . $isNC . "'  ")->execute();
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