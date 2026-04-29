<?php

class AzioniVerificheRistorazione extends CActiveRecord {

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
        return 'db_verifiche_ristorazione';
    }

    public function rules() {
        return array(
            array('id_verifica, codice_verifica, autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, anno', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('stoccaggio_conformita, stoccaggio_bilancia, stoccaggio_termografi, stoccaggio_taratura, stoccaggio_derrate, stoccaggio_derrate_rialzate, stoccaggio_rotazione, stoccaggio_deperibili, stoccaggio_ddt, stoccaggio_mezzi, stoccaggio_monouso,  derrata_orto_tipologia, derrata_orto_etichetta, derrata_orto_scadenza, derrata_orto_listino, derrata_orto_integrita, derrata_orto_temperatura, derrata_orto_aspetto, derrata_orto_colore, derrata_orto_odore, derrata_orto_difetti,  derrata_carne_tipologia, derrata_carne_etichetta, derrata_carne_scadenza, derrata_carne_listino, derrata_carne_integrita, derrata_carne_temperatura, derrata_carne_aspetto, derrata_carne_colore, derrata_carne_odore, derrata_carne_difetti,  derrata_secco_tipologia, derrata_secco_etichetta, derrata_secco_scadenza, derrata_secco_listino, derrata_secco_integrita, derrata_secco_temperatura, derrata_secco_aspetto, derrata_secco_colore, derrata_secco_odore, derrata_secco_difetti, aree_igiene_esterna, aree_igiene_celle, aree_guarnizioni, aree_magazzino, aree_transito, aree_pareti, aree_protezioni, aree_grigie, produzione_imballaggio, produzione_igienica, produzione_preparazioni, produzione_promiscue, produzione_tempi_lavorazione, produzione_temperatura, produzione_scongelamento, produzione_piatti_caldi, produzione_piatti_freddi, produzione_mascherina, produzione_lavaggio, produzione_campioni, produzione_buste_sterili, produzione_abbatimento, produzione_diete, produzione_diete_separate, produzione_diete_preparazione, strutture_filtri, strutture_cucine, strutture_attrezzature_pulite, strutture_attrezzature_efficienti, strutture_pareti, strutture_griglie, strutture_davanzali, strutture_taglieri, strutture_taglieri_identificabili, distribuzione_comunicazione, distribuzione_igieniche, distribuzione_materiale, distribuzione_piatti_freddi, distribuzione_piatti_caldi, distribuzione_sefservice, distribuzione_cortesia, distribuzione_composizione, distribuzione_vetrine, distribuzione_attrezature, distribuzione_locali, distribuzione_tavoli, distribuzione_ambiente, distribuzione_erogatori, distribuzione_cartucce, distribuzione_frequenza, rifiuti_preparazione, rifiuti_distribuzione, rifiuti_racolta, rifiuti_contenitori, rifiuti_esterno, rifiuti_attrezzature, rifiuti_documento, rifiuti_registro, rifiuti_differenziata, rifiuti_oli, lavaggio_funzionante, lavaggio_ambiente, lavaggio_microclima, lavaggio_bracci, lavaggio_clacare, lavaggio_addolcimento, lavaggio_temperatura, lavaggio_davanzali, personale_presente, personale_registro, personale_responsabile, personale_igiene, personale_comportamento, personale_dpi, personale_cartellino, personale_servizi, personale_saponi, personale_spogliatoi, personale_sporgenti, personale_davanzali, sanificazione_conformi, sanificazione_stoccaggio, sanificazione_corretto, sanificazione_pulizia, sanificazione_lavaggio, sanificazione_roditori, sanificazione_documentazione, sanificazione_pozzetti, sanificazione_pareti, sanificazione_davanzali, sanificazione_odori, sanificazione_lavamani, sanificazione_montacarichi, sanificazione_schede, sanificazione_flaconi, sanificazione_esche, sanificazione_schede_tecniche, manuale_detergenza, manuale_controlli, manuale_verifiche, manuale_interventi, manuale_personale, manuale_nc, manuale_rintracciabilita, manuale_allerta, manuale_autocontrollo,distribuzione_attrezature_efficienti, manuale_haccp , personale_igiene_conforme', 'length', 'max' => 2),
            array('data, ora_inizio, ora_fine, stoccaggio_conformita_note, stoccaggio_bilancia_note, stoccaggio_termografi_note, stoccaggio_taratura_note, stoccaggio_derrate_note, stoccaggio_derrate_rialzate_note, stoccaggio_rotazione_note, stoccaggio_deperibili_note, derrata_orto_prodotto, stoccaggio_ddt_note, stoccaggio_mezzi_note, stoccaggio_monouso_note, note_1, osservazioni_1, derrata_orto_tipologia_note, derrata_orto_etichetta_note, derrata_orto_scadenza_note, derrata_orto_listino_note, derrata_orto_integrita_note, derrata_orto_temperatura_note, derrata_orto_aspetto_note, derrata_orto_colore_note, derrata_orto_odore_note, derrata_orto_difetti_note, derrata_carne_prodotto, derrata_carne_tipologia_note, derrata_carne_etichetta_note, derrata_carne_scadenza_note, derrata_carne_listino_note, derrata_carne_integrita_note, derrata_carne_temperatura_note, derrata_carne_aspetto_note, derrata_carne_colore_note, derrata_carne_odore_note, derrata_carne_difetti_note, derrata_secco_prodotto, derrata_secco_tipologia_note, derrata_secco_etichetta_note, derrata_secco_scadenza_note, derrata_secco_listino_note, derrata_secco_integrita_note, derrata_secco_temperatura_note, derrata_secco_aspetto_note, derrata_secco_colore_note, derrata_secco_odore_note, derrata_secco_difetti_note, note_2, osservazioni_2, aree_igiene_esterna_note, aree_igiene_celle_note, aree_guarnizioni_note, aree_magazzino_note, aree_transito_note, aree_pareti_note, aree_protezioni_note, aree_grigie_note, note_3, osservazioni_3, produzione_imballaggio_note, produzione_igienica_note, produzione_preparazioni_note, produzione_promiscue_note, produzione_tempi_lavorazione_note, produzione_temperatura_note, produzione_scongelamento_note, produzione_piatti_caldi_note, produzione_piatti_freddi_note, produzione_mascherina_note, produzione_lavaggio_note, produzione_campioni_note, produzione_buste_sterili_note, produzione_abbatimento_note, produzione_diete_note, produzione_diete_separate_note, produzione_diete_preparazione_note, note_4, osservazioni_4, strutture_filtri_note, strutture_cucine_note, strutture_attrezzature_pulite_note, strutture_attrezzature_efficienti_note, strutture_pareti_note, strutture_griglie_note, strutture_davanzali_note, strutture_taglieri_note, strutture_taglieri_identificabili_note, note_5, osservazioni_5, distribuzione_comunicazione_note, distribuzione_igieniche_note, distribuzione_materiale_note, distribuzione_piatti_freddi_note, distribuzione_piatti_caldi_note, distribuzione_sefservice_note, distribuzione_cortesia_note, distribuzione_composizione_note, distribuzione_vetrine_note, distribuzione_attrezature_note, distribuzione_locali_note, distribuzione_tavoli_note, distribuzione_ambiente_note, distribuzione_erogatori_note, distribuzione_cartucce_note, distribuzione_frequenza_note, note_6, osservazioni_6, rifiuti_preparazione_note, rifiuti_distribuzione_note, rifiuti_racolta_note, rifiuti_contenitori_note, rifiuti_esterno_note, rifiuti_attrezzature_note, rifiuti_documento_note, rifiuti_registro_note, rifiuti_differenziata_note, rifiuti_oli_note, note_7, osservazioni_7, lavaggio_funzionante_note, lavaggio_ambiente_note, lavaggio_microclima_note, lavaggio_bracci_note, lavaggio_clacare_note, lavaggio_addolcimento_note, lavaggio_temperatura_note, lavaggio_davanzali_note, note_8, osservazioni_8, personale_presente_note, personale_registro_note, personale_responsabile_note, personale_igiene_note, personale_comportamento_note, personale_dpi_note, personale_cartellino_note, personale_servizi_note, personale_saponi_note, personale_spogliatoi_note, personale_sporgenti_note, personale_davanzali_note, note_9, osservazioni_9, sanificazione_conformi_note, sanificazione_stoccaggio_note, sanificazione_corretto_note, sanificazione_pulizia_note, sanificazione_lavaggio_note, sanificazione_roditori_note, sanificazione_documentazione_note, sanificazione_pozzetti_note, sanificazione_pareti_note, sanificazione_davanzali_note, sanificazione_odori_note, sanificazione_lavamani_note, sanificazione_montacarichi_note, sanificazione_schede_note, sanificazione_flaconi_note, sanificazione_esche_note, sanificazione_schede_tecniche_note, note_10, osservazioni_10, manuale_detergenza_note, manuale_controlli_note, manuale_verifiche_note, manuale_interventi_note, manuale_personale_note, manuale_nc_note, manuale_rintracciabilita_note, manuale_allerta_note,distribuzione_attrezature_efficienti_note, manuale_autocontrollo_note, manuale_haccp_note, note_11, osservazioni_11 , personale_igiene_conforme_note', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, stoccaggio_conformita, stoccaggio_conformita_note, stoccaggio_bilancia, stoccaggio_bilancia_note, stoccaggio_termografi, stoccaggio_termografi_note, stoccaggio_taratura, stoccaggio_taratura_note, stoccaggio_derrate, stoccaggio_derrate_note, stoccaggio_derrate_rialzate, stoccaggio_derrate_rialzate_note, stoccaggio_rotazione, stoccaggio_rotazione_note, stoccaggio_deperibili, stoccaggio_deperibili_note, stoccaggio_ddt, stoccaggio_ddt_note, stoccaggio_mezzi, stoccaggio_mezzi_note, stoccaggio_monouso, stoccaggio_monouso_note, note_1, osservazioni_1, derrata_orto_prodotto,  derrata_orto_tipologia, derrata_orto_tipologia_note, derrata_orto_etichetta, derrata_orto_etichetta_note, derrata_orto_scadenza, derrata_orto_scadenza_note, derrata_orto_listino, derrata_orto_listino_note, derrata_orto_integrita, derrata_orto_integrita_note, derrata_orto_temperatura, derrata_orto_temperatura_note, derrata_orto_aspetto, derrata_orto_aspetto_note, derrata_orto_colore, derrata_orto_colore_note, derrata_orto_odore, derrata_orto_odore_note, derrata_orto_difetti, derrata_orto_difetti_note, derrata_carne_prodotto, derrata_carne_tipologia, derrata_carne_tipologia_note, derrata_carne_etichetta, derrata_carne_etichetta_note, derrata_carne_scadenza, derrata_carne_scadenza_note, derrata_carne_listino, derrata_carne_listino_note, derrata_carne_integrita, derrata_carne_integrita_note, derrata_carne_temperatura, derrata_carne_temperatura_note, derrata_carne_aspetto, derrata_carne_aspetto_note, derrata_carne_colore, derrata_carne_colore_note, derrata_carne_odore, derrata_carne_odore_note, derrata_carne_difetti, derrata_carne_difetti_note, derrata_secco_prodotto, derrata_secco_tipologia, derrata_secco_tipologia_note, derrata_secco_etichetta, derrata_secco_etichetta_note, derrata_secco_scadenza, derrata_secco_scadenza_note, derrata_secco_listino, derrata_secco_listino_note, derrata_secco_integrita, derrata_secco_integrita_note, derrata_secco_temperatura, derrata_secco_temperatura_note, derrata_secco_aspetto, derrata_secco_aspetto_note, derrata_secco_colore, derrata_secco_colore_note, derrata_secco_odore, derrata_secco_odore_note, derrata_secco_difetti, derrata_secco_difetti_note, note_2, osservazioni_2, aree_igiene_esterna, aree_igiene_esterna_note, aree_igiene_celle, aree_igiene_celle_note, aree_guarnizioni, aree_guarnizioni_note, aree_magazzino, aree_magazzino_note, aree_transito, aree_transito_note, aree_pareti, aree_pareti_note, aree_protezioni, aree_protezioni_note, aree_grigie, aree_grigie_note, note_3, osservazioni_3, produzione_imballaggio, produzione_imballaggio_note, produzione_igienica, produzione_igienica_note, produzione_preparazioni, produzione_preparazioni_note, produzione_promiscue, produzione_promiscue_note, produzione_tempi_lavorazione, produzione_tempi_lavorazione_note, produzione_temperatura, produzione_temperatura_note, produzione_scongelamento, produzione_scongelamento_note, produzione_piatti_caldi, produzione_piatti_caldi_note, produzione_piatti_freddi, produzione_piatti_freddi_note, produzione_mascherina, produzione_mascherina_note, produzione_lavaggio, produzione_lavaggio_note, produzione_campioni, produzione_campioni_note, produzione_buste_sterili, produzione_buste_sterili_note, produzione_abbatimento, produzione_abbatimento_note, produzione_diete, produzione_diete_note, produzione_diete_separate, produzione_diete_separate_note, produzione_diete_preparazione, produzione_diete_preparazione_note, note_4, osservazioni_4, strutture_filtri, strutture_filtri_note, strutture_cucine, strutture_cucine_note, strutture_attrezzature_pulite, strutture_attrezzature_pulite_note, strutture_attrezzature_efficienti, strutture_attrezzature_efficienti_note, strutture_pareti, strutture_pareti_note, strutture_griglie, strutture_griglie_note, strutture_davanzali, strutture_davanzali_note, strutture_taglieri, strutture_taglieri_note, strutture_taglieri_identificabili, strutture_taglieri_identificabili_note, note_5, osservazioni_5, distribuzione_comunicazione, distribuzione_comunicazione_note, distribuzione_igieniche, distribuzione_igieniche_note, distribuzione_materiale, distribuzione_materiale_note, distribuzione_piatti_freddi, distribuzione_piatti_freddi_note, distribuzione_piatti_caldi, distribuzione_piatti_caldi_note, distribuzione_sefservice, distribuzione_sefservice_note, distribuzione_cortesia, distribuzione_cortesia_note, distribuzione_composizione, distribuzione_composizione_note, distribuzione_vetrine, distribuzione_vetrine_note, distribuzione_attrezature, distribuzione_attrezature_note, distribuzione_locali, distribuzione_locali_note, distribuzione_tavoli, distribuzione_tavoli_note, distribuzione_ambiente, distribuzione_ambiente_note, distribuzione_erogatori, distribuzione_erogatori_note, distribuzione_cartucce, distribuzione_cartucce_note, distribuzione_frequenza, distribuzione_frequenza_note, note_6, osservazioni_6, rifiuti_preparazione, rifiuti_preparazione_note, rifiuti_distribuzione, rifiuti_distribuzione_note, rifiuti_racolta, rifiuti_racolta_note, rifiuti_contenitori, rifiuti_contenitori_note, rifiuti_esterno, rifiuti_esterno_note, rifiuti_attrezzature, rifiuti_attrezzature_note, rifiuti_documento, rifiuti_documento_note, rifiuti_registro, rifiuti_registro_note, rifiuti_differenziata, rifiuti_differenziata_note, rifiuti_oli, rifiuti_oli_note, note_7, osservazioni_7, lavaggio_funzionante, lavaggio_funzionante_note, lavaggio_ambiente, lavaggio_ambiente_note, lavaggio_microclima, lavaggio_microclima_note, lavaggio_bracci, lavaggio_bracci_note, lavaggio_clacare, lavaggio_clacare_note, lavaggio_addolcimento, lavaggio_addolcimento_note, lavaggio_temperatura, lavaggio_temperatura_note, lavaggio_davanzali, lavaggio_davanzali_note, note_8, osservazioni_8, personale_presente, personale_presente_note, personale_registro, personale_registro_note, personale_responsabile, personale_responsabile_note, personale_igiene, personale_igiene_note, personale_comportamento, personale_comportamento_note, personale_dpi, personale_dpi_note, personale_cartellino, personale_cartellino_note, personale_servizi, personale_servizi_note, personale_saponi, personale_saponi_note, personale_spogliatoi, personale_spogliatoi_note, personale_sporgenti, personale_sporgenti_note, personale_davanzali, personale_davanzali_note, note_9, osservazioni_9, sanificazione_conformi, sanificazione_conformi_note, sanificazione_stoccaggio, sanificazione_stoccaggio_note, sanificazione_corretto, sanificazione_corretto_note, sanificazione_pulizia, sanificazione_pulizia_note, sanificazione_lavaggio, sanificazione_lavaggio_note, sanificazione_roditori, sanificazione_roditori_note, sanificazione_documentazione, sanificazione_documentazione_note, sanificazione_pozzetti, sanificazione_pozzetti_note, sanificazione_pareti, sanificazione_pareti_note, sanificazione_davanzali, sanificazione_davanzali_note, sanificazione_odori, sanificazione_odori_note, sanificazione_lavamani, sanificazione_lavamani_note, sanificazione_montacarichi, sanificazione_montacarichi_note, sanificazione_schede, sanificazione_schede_note, sanificazione_flaconi, sanificazione_flaconi_note, sanificazione_esche, sanificazione_esche_note, sanificazione_schede_tecniche, sanificazione_schede_tecniche_note, note_10, osservazioni_10, manuale_detergenza, manuale_detergenza_note, manuale_controlli, manuale_controlli_note, manuale_verifiche, manuale_verifiche_note, manuale_interventi, manuale_interventi_note, manuale_personale, manuale_personale_note, manuale_nc, manuale_nc_note, manuale_rintracciabilita, manuale_rintracciabilita_note, manuale_allerta, manuale_allerta_note, manuale_autocontrollo, manuale_autocontrollo_note, manuale_haccp, manuale_haccp_note, note_11, osservazioni_11, anno ,distribuzione_attrezature_efficienti , distribuzione_attrezature_efficienti_note , personale_igiene_conforme , personale_igiene_conforme_note', 'safe', 'on' => 'search'),
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
            'stoccaggio_conformita' => 'Conformit&agrave; della temperatura della cella di stoccaggio con l\'indicazione del valore nello spazio note (verifica della funzionalit&agrave; del termometro/termostato cella con strumento tarato)',
            'stoccaggio_conformita_note' => 'Stoccaggio Conformita Note',
            'stoccaggio_bilancia' => 'Presenza bilancia funzionante',
            'stoccaggio_bilancia_note' => 'Stoccaggio Bilancia Note',
            'stoccaggio_termografi' => 'I termografi (ove presenti) e o termogrammi sono archiviati?',
            'stoccaggio_termografi_note' => 'Stoccaggio Termografi Note',
            'stoccaggio_taratura' => 'Gli strumenti di controllo della Temperatura sono sottoposti a periodica taratura? ( se si indicare gli estremi dell\'ultimo rapporto visionato)',
            'stoccaggio_taratura_note' => 'Stoccaggio Taratura Note',
            'stoccaggio_derrate' => 'Le derrate sono conservate alle temperature idonee?',
            'stoccaggio_derrate_note' => 'Stoccaggio Derrate Note',
            'stoccaggio_derrate_rialzate' => 'Le derrate sono adeguatamente riposte, rialzate da terra, sigillate, identificate e separate?',
            'stoccaggio_derrate_rialzate_note' => 'Stoccaggio Derrate Rialzate Note',
            'stoccaggio_rotazione' => 'Viene effettuata una corretta rotazione delle scorte e sono assenti prodotti o semilavorati scaduti?',
            'stoccaggio_rotazione_note' => 'Stoccaggio Rotazione Note',
            'stoccaggio_deperibili' => 'I prodotti alimentari non deperibili sono soggetti a rotazione F.I.F.O (first in first out)?',
            'stoccaggio_deperibili_note' => 'Stoccaggio Deperibili Note',
            'stoccaggio_ddt' => 'Verifica e controllo presenza DDT',
            'stoccaggio_ddt_note' => 'Stoccaggio Ddt Note',
            'stoccaggio_mezzi' => 'I mezzi di trasporto sono adeguati',
            'stoccaggio_mezzi_note' => 'Stoccaggio Mezzi Note',
            'stoccaggio_monouso' => 'Sono presenti Kit monouso per visitatori esterni?',
            'stoccaggio_monouso_note' => 'Stoccaggio Monouso Note',
            'note_1' => 'Note 1',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'derrata_orto_prodotto' => 'Un prodotto ortofrutticolo: <INDICARE QUALE DERRATA SCELTA>',
            'derrata_orto_prodotto_note' => 'Derrata Orto Prodotto Note',
            'derrata_orto_tipologia' => 'Tipologia (descrizione, caratteristiche merceologiche e lotto: &egrave; stato effettuato un controllo di tutti i prodotti carnei presenti in cella',
            'derrata_orto_tipologia_note' => 'Derrata Orto Tipologia Note',
            'derrata_orto_etichetta' => 'Corretta etichettatura',
            'derrata_orto_etichetta_note' => 'Derrata Orto Etichetta Note',
            'derrata_orto_scadenza' => 'Data scadenza conforme (riportare la data nello spazio note):',
            'derrata_orto_scadenza_note' => 'Derrata Orto Scadenza Note',
            'derrata_orto_listino' => 'Caratteristiche merceologiche conformi Ai listini cocordati',
            'derrata_orto_listino_note' => 'Derrata Orto Listino Note',
            'derrata_orto_integrita' => 'Aspetto e integrit&agrave; confezione',
            'derrata_orto_integrita_note' => 'Derrata Orto Integrita Note',
            'derrata_orto_temperatura' => 'Temperatura e modalit&agrave; di conservazione ',
            'derrata_orto_temperatura_note' => 'Derrata Orto Temperatura Note',
            'derrata_orto_aspetto' => 'Valutazione visiva della qualit&agrave;: ASPETTO',
            'derrata_orto_aspetto_note' => 'Derrata Orto Aspetto Note',
            'derrata_orto_colore' => 'Valutazione visiva della qualit&agrave;: COLORE',
            'derrata_orto_colore_note' => 'Derrata Orto Colore Note',
            'derrata_orto_odore' => 'Valutazione visiva della qualit&agrave;: ODORE',
            'derrata_orto_odore_note' => 'Derrata Orto Odore Note',
            'derrata_orto_difetti' => 'Valutazione visiva della qualit&agrave;: ASSENZA DIFETTI',
            'derrata_orto_difetti_note' => 'Derrata Orto Difetti Note',
            'derrata_carne_prodotto' => 'Un prodotto carneo: <INDICARE QUALE DERRATA SCELTA>',
            'derrata_carne_tipologia' => 'Tipologia (descrizione, caratteristiche merceologiche e lotto): &egrave; stato fatto un controllo delle derrate presenti in cella',
            'derrata_carne_tipologia_note' => 'Derrata Carne Tipologia Note',
            'derrata_carne_etichetta' => 'Corretta etichettatura',
            'derrata_carne_etichetta_note' => 'Derrata Carne Etichetta Note',
            'derrata_carne_scadenza' => 'Data scadenza conforme (riportare la data nello spazio note):',
            'derrata_carne_scadenza_note' => 'Derrata Carne Scadenza Note',
            'derrata_carne_listino' => 'Caratteristiche merceologiche e shelf life residua conformi al capitolato',
            'derrata_carne_listino_note' => 'Derrata Carne Listino Note',
            'derrata_carne_integrita' => 'Aspetto e integrit&agrave; confezione',
            'derrata_carne_integrita_note' => 'Derrata Carne Integrita Note',
            'derrata_carne_temperatura' => 'Temperatura e modalit&agrave; di conservazione ',
            'derrata_carne_temperatura_note' => 'Derrata Carne Temperatura Note',
            'derrata_carne_aspetto' => 'Valutazione visiva della qualit&agrave;: ASPETTO',
            'derrata_carne_aspetto_note' => 'Derrata Carne Aspetto Note',
            'derrata_carne_colore' => 'Valutazione visiva della qualit&agrave;: COLORE',
            'derrata_carne_colore_note' => 'Derrata Carne Colore Note',
            'derrata_carne_odore' => 'Valutazione visiva della qualit&agrave;: ODORE',
            'derrata_carne_odore_note' => 'Derrata Carne Odore Note',
            'derrata_carne_difetti' => 'Valutazione visiva della qualit&agrave;: ASSENZA DIFETTI',
            'derrata_carne_difetti_note' => 'Derrata Carne Difetti Note',
            'derrata_secco_prodotto' => 'Un prodotto secco: <INDICARE QUALE DERRATA SCELTA>',
            'derrata_secco_prodotto_note' => 'Derrata Secco Prodotto Note',
            'derrata_secco_tipologia' => 'Tipologia (descrizione, caratteristiche merceologiche e lotto): controllo delle derrate non deperibili presenti nel magazzino',
            'derrata_secco_tipologia_note' => 'Derrata Secco Tipologia Note',
            'derrata_secco_etichetta' => 'Corretta etichettatura',
            'derrata_secco_etichetta_note' => 'Derrata Secco Etichetta Note',
            'derrata_secco_scadenza' => 'Data scadenza conforme (riportare la data nello spazio note):',
            'derrata_secco_scadenza_note' => 'Derrata Secco Scadenza Note',
            'derrata_secco_listino' => 'Caratteristiche merceologiche conformi Ai listini cocordato',
            'derrata_secco_listino_note' => 'Derrata Secco Listino Note',
            'derrata_secco_integrita' => 'Aspetto e integrit&agrave; confezione',
            'derrata_secco_integrita_note' => 'Derrata Secco Integrita Note',
            'derrata_secco_temperatura' => 'Temperatura e modalit&agrave; di conservazione ',
            'derrata_secco_temperatura_note' => 'Derrata Secco Temperatura Note',
            'derrata_secco_aspetto' => 'Valutazione visiva della qualit&agrave;: ASPETTO',
            'derrata_secco_aspetto_note' => 'Derrata Secco Aspetto Note',
            'derrata_secco_colore' => 'Valutazione visiva della qualit&agrave;: COLORE',
            'derrata_secco_colore_note' => 'Derrata Secco Colore Note',
            'derrata_secco_odore' => 'Valutazione visiva della qualit&agrave;: ODORE',
            'derrata_secco_odore_note' => 'Derrata Secco Odore Note',
            'derrata_secco_difetti' => 'Valutazione visiva della qualit&agrave;: ASSENZA DIFETTI',
            'derrata_secco_difetti_note' => 'Derrata Secco Difetti Note',
            'note_2' => 'Note 2',
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'aree_igiene_esterna' => 'Stato igienico zona esterna',
            'aree_igiene_esterna_note' => 'Aree Igiene Esterna Note',
            'aree_igiene_celle' => 'Igiene delle celle (pareti, pavimenti, griglie, scaffalature, etc)',
            'aree_igiene_celle_note' => 'Aree Igiene Celle Note',
            'aree_guarnizioni' => 'Le guarnizioni delle dotazioni frigorifere/freezer presentano tracce di usura, sporco?',
            'aree_guarnizioni_note' => 'Aree Guarnizioni Note',
            'aree_magazzino' => 'Igiene del magazzino (pareti, pavimenti, griglie, scaffalature, etc)',
            'aree_magazzino_note' => 'Aree Magazzino Note',
            'aree_transito' => 'Igiene zone di transito interne e delle scale',
            'aree_transito_note' => 'Aree Transito Note',
            'aree_pareti' => 'Le pareti/pavimenti/soffitti dei locali presentano tracce di crepe, cavit&agrave; intercapedini?',
            'aree_pareti_note' => 'Aree Pareti Note',
            'aree_protezioni' => 'Presenza di protezioni anti infestanti ed integrit&agrave; delle protezioni',
            'aree_protezioni_note' => 'Aree Protezioni Note',
            'aree_grigie' => 'Sono presenti griglie e/o scaffalature con tracce di ruggine o danneggiate?',
            'aree_grigie_note' => 'Aree Grigie Note',
            'note_3' => 'Note 3',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'produzione_imballaggio' => 'Le merci giungono in quest\'area prive di imballaggio secondario',
            'produzione_imballaggio_note' => 'Produzione Imballaggio Note',
            'produzione_igienica' => 'La produzione dei pasti &egrave; condotta secondo corrette modalit&agrave; igieniche ed operative (confronto con il capitolato del gestore)',
            'produzione_igienica_note' => 'Produzione Igienica Note',
            'produzione_preparazioni' => 'Si evidenziano preparazioni destinate ad essere consumate nei giorni a seguire?',
            'produzione_preparazioni_note' => 'Produzione Preparazioni Note',
            'produzione_promiscue' => 'Assenza di lavorazioni promiscue',
            'produzione_promiscue_note' => 'Produzione Promiscue Note',
            'produzione_tempi_lavorazione' => 'Rispetto dei tempi di lavorazione',
            'produzione_tempi_lavorazione_note' => 'Produzione Tempi Lavorazione Note',
            'produzione_temperatura' => 'La temperatura al cuore dei prodotti in cottura &egrave; maggiore di 65&deg;C? (indicare il valore nello spazio note a margine)',
            'produzione_temperatura_note' => 'Produzione Temperatura Note',
            'produzione_scongelamento' => 'Rispetto delle condizioni di scongelamento (0 - 4&deg;C) (indicare il valore nello spazio note a margine)',
            'produzione_scongelamento_note' => 'Produzione Scongelamento Note',
            'produzione_piatti_caldi' => 'I piatti caldi sono conservati a temperatura maggiore di 65&deg;C? (indicare il valore nello spazio note a margine)',
            'produzione_piatti_caldi_note' => 'Produzione Piatti Caldi Note',
            'produzione_piatti_freddi' => 'I piatti freddi sono conservati a temperatura inferiore a 10&deg;C? (indicare il valore nello spazio note a margine)',
            'produzione_piatti_freddi_note' => 'Produzione Piatti Freddi Note',
            'produzione_mascherina' => 'Gli operatori addetti idossano la mascherina durante le preparazioni da consumarsi crude (es, insalate, macedonia etc.); quest\'ultima va a coprire completamente le vie respiratorie superiori? (naso)?',
            'produzione_mascherina_note' => 'Produzione Mascherina Note',
            'produzione_lavaggio' => 'Per il lavaggio dell\'insalata e verdura &egrave; previsto l\'utilizzo di un prodotto disinfettante? (indicare nome prodotto e se sono rispettate le diluizioni riportate in etichetta)',
            'produzione_lavaggio_note' => 'Produzione Lavaggio Note',
            'produzione_campioni' => 'Sono conservati i campioni degli alimenti (porzioni di almeno 150 g) per almeno 72 h? (riportare i casi verificati, almeno tre esempi)',
            'produzione_campioni_note' => 'Produzione Campioni Note',
            'produzione_buste_sterili' => 'I pasti campione sono preparati in buste sterili?',
            'produzione_buste_sterili_note' => 'Produzione Buste Sterili Note',
            'produzione_abbatimento' => 'L\'abbattimento dei cibi &egrave; condotto correttamente?',
            'produzione_abbatimento_note' => 'Produzione Abbatimento Note',
            'produzione_diete' => '&Egrave; prevista la preparazione di diete speciali?',
            'produzione_diete_note' => 'Produzione Diete Note',
            'produzione_diete_separate' => 'In caso di produzione di diete specali la produzione &egrave; correttamente separata da quella ordinaria?',
            'produzione_diete_separate_note' => 'Produzione Diete Separate Note',
            'produzione_diete_preparazione' => 'Se &egrave; prevista, il personale ha ricevuto adeguata formazione sulla produzione/preparazione di diete speciali?',
            'produzione_diete_preparazione_note' => 'Produzione Diete Preparazione Note',
            'note_4' => 'Note 4',
            'osservazioni_4' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'strutture_filtri' => 'I filtri delle cappe sono sufficientemente puliti?',
            'strutture_filtri_note' => 'Strutture Filtri Note',
            'strutture_cucine' => 'Le cucine sono sufficientemente pulite ed in ordine compatibilmente con le operazioni in atto?',
            'strutture_cucine_note' => 'Strutture Cucine Note',
            'strutture_attrezzature_pulite' => 'Le attrezzature e gli utensili utilizzati per la produzione sono puliti compatibilmente con le operazioni in atto?',
            'strutture_attrezzature_pulite_note' => 'Strutture Attrezzature Pulite Note',
            'strutture_attrezzature_efficienti' => 'Le attrezzature di lavorazione sono efficienti ed in buono stato di manutenzione?',
            'strutture_attrezzature_efficienti_note' => 'Strutture Attrezzature Efficienti Note',
            'strutture_pareti' => 'Le pareti/pavimenti/soffitti dei locali presentano tracce di crepe, cavit&agrave;, intercapedini?',
            'strutture_pareti_note' => 'Strutture Pareti Note',
            'strutture_griglie' => 'Sono presenti griglie e/o elementi con tracce di riggine o danni?',
            'strutture_griglie_note' => 'Strutture Griglie Note',
            'strutture_davanzali' => 'Se presenti, i davanziali, finestre infissi sono adeguatamente puliti e con reti di protezione?',
            'strutture_davanzali_note' => 'Strutture Davanzali Note',
            'strutture_taglieri' => 'Taglieri e ceppi presenti sono di materiale sanificabile (Teflon)  e non presentano usure? ',
            'strutture_taglieri_note' => 'Strutture Taglieri Note',
            'strutture_taglieri_identificabili' => 'I taglieri utilizzati sono indentificati in base al rischio igienico degli alimenti per cui sono destinati?',
            'strutture_taglieri_identificabili_note' => 'Strutture Taglieri Identificabili Note',
            'note_5' => 'Note 5',
            'osservazioni_5' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'distribuzione_comunicazione' => '&Egrave; presente una corretta comunicazione alla Clientela del Pasto distribuito ( men&ugrave; del giorno, composizione del pasto, eventuale presenza di allergeni?)',
            'distribuzione_comunicazione_note' => 'Distribuzione Comunicazione Note',
            'distribuzione_igieniche' => 'Le operazioni di distribuzione sono condotte secondo corrette modalit&agrave; igieniche ed operative?',
            'distribuzione_igieniche_note' => 'Distribuzione Igieniche Note',
            'distribuzione_materiale' => 'Il materiale previsto per la somministrazione (piatti, ciotole, vassoi in caso di self service) &egrave; integro e non presenta danni o macchie?',
            'distribuzione_materiale_note' => 'Distribuzione Materiale Note',
            'distribuzione_piatti_freddi' => 'I piatti freddi sono mantenuti a T < 10&deg;C? (indicare il valore nello spazio note a margine)',
            'distribuzione_piatti_freddi_note' => 'Distribuzione Piatti Freddi Note',
            'distribuzione_piatti_caldi' => 'I piatti caldi sono mantenuti a T > 65&deg;C? (indicare il valore nello spazio note a margine)      ',
            'distribuzione_piatti_caldi_note' => 'Distribuzione Piatti Caldi Note',
            'distribuzione_sefservice' => 'In caso di distribuzione self service &egrave; correttamente applicata la procedura di controllo delle temperature ed eventualmente di riattivazione?',
            'distribuzione_sefservice_note' => 'Distribuzione Sefservice Note',
            'distribuzione_cortesia' => 'Il personale addetto alla distribuzione ha un comportamento professionale e cortese? ',
            'distribuzione_cortesia_note' => 'Distribuzione Cortesia Note',
            'distribuzione_composizione' => 'I piatti sono composti e presentati correttamente?',
            'distribuzione_composizione_note' => 'Distribuzione Composizione Note',
            'distribuzione_vetrine' => 'In caso di vetrine e o buffet i piatti sono esposti correttamente?',
            'distribuzione_vetrine_note' => 'Distribuzione Vetrine Note',
            'distribuzione_attrezature' => 'Le attrezzature utilizzate durante la distribuzione sono pulite compatibilmente con le operazioni in atto?',
            'distribuzione_attrezature_note' => 'Distribuzione Attrezature Note',
            'distribuzione_attrezature_efficienti' => 'Le attrezzature utilizzate durante la distribuzione sono pulite compatibilmente con le operazioni in atto?',
            'distribuzione_attrezature_efficienti_note' => 'Distribuzione Attrezature Note',
            'distribuzione_locali' => 'I locali di distribuzione sono puliti ed in ordine?',
            'distribuzione_locali_note' => 'Distribuzione Locali Note',
            'distribuzione_tavoli' => 'Se previsto i tavoli sono ben apparecchiati?',
            'distribuzione_tavoli_note' => 'Distribuzione Tavoli Note',
            'distribuzione_ambiente' => 'Le condizioni ambientali (temperatura, illuminazione, rumorosit&agrave; e confort) sono idonee?',
            'distribuzione_ambiente_note' => 'Distribuzione Ambiente Note',
            'distribuzione_erogatori' => 'Gli erogatori dell\'acqua e di eventuali bibite sono adeguatamente puliti?',
            'distribuzione_erogatori_note' => 'Distribuzione Erogatori Note',
            'distribuzione_cartucce' => 'Se prevista la sostituzione delle cartucce filtranti per l\'acqua e la manutenzione avviene con frequenza congrua a quanto indicato dal produttore?',
            'distribuzione_cartucce_note' => 'Distribuzione Cartucce Note',
            'distribuzione_frequenza' => 'Negli erogatori eventuali vani ri racconta di prodotto in eccedenza risulta pulito e lo svuotamento dei reflui avviene cona adeguata frequenza durante il servizio?',
            'distribuzione_frequenza_note' => 'Distribuzione Frequenza Note',
            'note_6' => 'Note 6',
            'osservazioni_6' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'rifiuti_preparazione' => 'Conformit&agrave; gestione e flussi nella zona di preparazione:',
            'rifiuti_preparazione_note' => 'Rifiuti Preparazione Note',
            'rifiuti_distribuzione' => 'Conformit&agrave; gestione e flussi nella zona di distribuzione:',
            'rifiuti_distribuzione_note' => 'Rifiuti Distribuzione Note',
            'rifiuti_racolta' => 'Conformit&agrave; gestione e flussi nell\'area di raccolta:',
            'rifiuti_racolta_note' => 'Rifiuti Racolta Note',
            'rifiuti_contenitori' => 'I contenitori per i rifiuti sono conformi?',
            'rifiuti_contenitori_note' => 'Rifiuti Contenitori Note',
            'rifiuti_esterno' => 'L\'area esterna risulta pulita ed in ordine?',
            'rifiuti_esterno_note' => 'Rifiuti Esterno Note',
            'rifiuti_attrezzature' => 'Nell\'area esterna sono presenti attrezzature in disuso in attesa di rimozione?',
            'rifiuti_attrezzature_note' => 'Rifiuti Attrezzature Note',
            'rifiuti_documento' => 'Se si &egrave; reperibile un documento o altra evidenza che indetifichi la programmata rimozione dell\'attrezzatura per il corretto smaltimento?',
            'rifiuti_documento_note' => 'Rifiuti Documento Note',
            'rifiuti_registro' => 'Esistono le registrazioni relative ai rifiuti (MUD; Registro di carico e scarico, ecc.) e sono conformi?',
            'rifiuti_registro_note' => 'Rifiuti Registro Note',
            'rifiuti_differenziata' => 'Viene eseguita la raccolta differenziata in maniera corretta e conforme ai regolamenti locali?',
            'rifiuti_differenziata_note' => 'Rifiuti Differenziata Note',
            'rifiuti_oli' => 'Gli oli esausti vengono stoccati in idonei contenitori? Ove la vasca di accumolo non sia presente?',
            'rifiuti_oli_note' => 'Rifiuti Oli Note',
            'note_7' => 'Note 7',
            'osservazioni_7' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'lavaggio_funzionante' => 'La lavastoviglie/lava pentole &egrave; funzionante e in buono stato?',
            'lavaggio_funzionante_note' => 'Lavaggio Funzionante Note',
            'lavaggio_ambiente' => 'Le stoviglie/utensili/pentolame sono stoccati in ambiente pulito e al riparo da contaminazioni?',
            'lavaggio_ambiente_note' => 'Lavaggio Ambiente Note',
            'lavaggio_microclima' => 'Il microclima &egrave; idoneo?',
            'lavaggio_microclima_note' => 'Lavaggio Microclima Note',
            'lavaggio_bracci' => 'Pulizia bracci e filtri lavastoviglie e griglie a pavimento',
            'lavaggio_bracci_note' => 'Lavaggio Bracci Note',
            'lavaggio_clacare' => 'Assenza di calcare lavastoviglie/lavapentole',
            'lavaggio_clacare_note' => 'Lavaggio Clacare Note',
            'lavaggio_addolcimento' => 'Corretta gestione dell\'impianto di addolcimento',
            'lavaggio_addolcimento_note' => 'Lavaggio Addolcimento Note',
            'lavaggio_temperatura' => 'Corrette temperature di esercizio della macchina',
            'lavaggio_temperatura_note' => 'Lavaggio Temperatura Note',
            'lavaggio_davanzali' => 'Ove presenti i davanziali, finestra, infissi sono adeguatamente pulit e con reti di protezione?',
            'lavaggio_davanzali_note' => 'Lavaggio Davanzali Note',
            'note_8' => 'Note 8',
            'osservazioni_8' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'personale_presente' => 'L\'organico &egrave; presente in numero conforme/congruo? (indicare il numero):',
            'personale_presente_note' => 'Personale Presente Note',
            'personale_registro' => '&Egrave; presente il registro infortuni e correttamente compilato? (indicare n infortuni ultimo quadrimestre)',
            'personale_registro_note' => 'Personale Registro Note',
            'personale_responsabile' => 'Il responsabile di servizio &egrave; presente?',
            'personale_responsabile_note' => 'Personale Responsabile Note',
            'personale_igiene' => 'L\'igiene dell\'abbigliamento &egrave; conforme?',
            'personale_igiene_note' => 'Personale Igiene Note',
            'personale_igiene_conforme' => 'L\'igiene delle persone &egrave; conforme (mani, gioielli, monili)',
            'personale_igiene_conforme_note' => 'Personale Igiene Note',
            'personale_comportamento' => 'Il comportamento igienico del personale &egrave; corretto (divieto di fumare, di mangiare, ecc.)',
            'personale_comportamento_note' => 'Personale Comportamento Note',
            'personale_dpi' => 'Il personale indossa correttamente i DPI previsti per le attivit&agrave; in corso al momento della Verifica Ispettiva?',
            'personale_dpi_note' => 'Personale Dpi Note',
            'personale_cartellino' => 'Il personale indossa a vista il cartellino identificativo e questo risulta integro e completo in tutte le sue parti?',
            'personale_cartellino_note' => 'Personale Cartellino Note',
            'personale_servizi' => 'I servizi igienici sono puliti ed in ordine?',
            'personale_servizi_note' => 'Personale Servizi Note',
            'personale_saponi' => 'Sono presenti saponi e asciugamani a perdereo sistemi ad aria?',
            'personale_saponi_note' => 'Personale Saponi Note',
            'personale_spogliatoi' => 'Gli spogliatoi sono puliti ed in ordine?',
            'personale_spogliatoi_note' => 'Personale Spogliatoi Note',
            'personale_spogliatoi_adeguati' => 'Gli spoiraoti sono adeguati e sono presenti armadietti a doppio scomparto in numero sufficiente? ',
            'personale_spogliatoi_adeguati_note' => 'Personale Spogliatoi Note',
            'personale_sporgenti' => 'Verificare Assenza nello spoiatorio di armadietti divelti o con parti sporgenti taglienti',
            'personale_sporgenti_note' => 'Personale Sporgenti Note',
            'personale_davanzali' => 'Ove presenti i davanziali, finestra, infissi sono adeguatamente pulit e con reti di protezione?',
            'personale_davanzali_note' => 'Personale Davanzali Note',
            'note_9' => 'Note 9',
            'osservazioni_9' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'sanificazione_conformi' => 'I prodotti detergenti e sanificanti sono conformi al piano di detergenza e sanificazione?',
            'sanificazione_conformi_note' => 'Sanificazione Conformi Note',
            'sanificazione_stoccaggio' => 'I prodotti detergenti e sanificanti sono stoccati conformemente?',
            'sanificazione_stoccaggio_note' => 'Sanificazione Stoccaggio Note',
            'sanificazione_corretto' => 'Il piano di detergenza e sanificazione &egrave; eseguito correttamente (verificare la modalit&agrave; e la frequenza)',
            'sanificazione_corretto_note' => 'Sanificazione Corretto Note',
            'sanificazione_pulizia' => 'Le operazioni di pulizia e sanificazione vengono effettuate correttamente? ( indicare a campione modalit&agrave;, responsabilit&agrave;, prodotti da utilizzare e relative concentrazioni ed eventuale riferimento documentale ISTRUZIONE OPERATIVA, PIANO DI SANIFICAZIONE, PROCEDURA)',
            'sanificazione_pulizia_note' => 'Sanificazione Pulizia Note',
            'sanificazione_lavaggio' => 'Viene effettuato il lavaggio per aspersione della mobilit&agrave; e delle attrezzature?',
            'sanificazione_lavaggio_note' => 'Sanificazione Lavaggio Note',
            'sanificazione_roditori' => 'Sono assenti tracce di roditori e infestanti?',
            'sanificazione_roditori_note' => 'Sanificazione Roditori Note',
            'sanificazione_documentazione' => 'Visionare la documentazione del piano di disinfestazione',
            'sanificazione_documentazione_note' => 'Sanificazione Documentazione Note',
            'sanificazione_pozzetti' => 'I pozzetti dei pavimenti sono sgombri, puliti e con griglie?',
            'sanificazione_pozzetti_note' => 'Sanificazione Pozzetti Note',
            'sanificazione_pareti' => 'Pareti, pavimenti, soffitti dei locali sono idoneamente mantenuti, puliti, privi di scrostamenti, muffe, ragnatele?',
            'sanificazione_pareti_note' => 'Sanificazione Pareti Note',
            'sanificazione_davanzali' => 'I davanzali, finestre, infissi adeguatamente puliti e con reti di protezione?',
            'sanificazione_davanzali_note' => 'Sanificazione Davanzali Note',
            'sanificazione_odori' => 'Nei locali sono assenti odori anomali?',
            'sanificazione_odori_note' => 'Sanificazione Odori Note',
            'sanificazione_lavamani' => 'Lavamani a comando non manuale e funzionanti?',
            'sanificazione_lavamani_note' => 'Sanificazione Lavamani Note',
            'sanificazione_montacarichi' => 'Eventuali montacarichi sono adeguatamente puliti e manutenzionati?',
            'sanificazione_montacarichi_note' => 'Sanificazione Montacarichi Note',
            'sanificazione_schede' => 'Sono presenti le schede tecniche dei prodotti in uso?',
            'sanificazione_schede_note' => 'Sanificazione Schede Note',
            'sanificazione_flaconi' => 'Sono assenti flaconi non etichettati',
            'sanificazione_flaconi_note' => 'Sanificazione Flaconi Note',
            'sanificazione_esche' => 'Le esche di monitoraggio infestanti sono presenti e sono adeguatamente segnalate?',
            'sanificazione_esche_note' => 'Sanificazione Esche Note',
            'sanificazione_schede_tecniche' => 'Sono presenti le schede tecniche e di sicurezza relative alle esche impiegate per il monitoraggio degli infestanti? - riportare tra le note un esempio - ',
            'sanificazione_schede_tecniche_note' => 'Sanificazione Schede Tecniche Note',
            'note_10' => 'Note 10',
            'osservazioni_10' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
            'manuale_detergenza' => 'REGISTRAZIONE  attivit&agrave; di detergenza e sanificazione',
            'manuale_detergenza_note' => 'Manuale Detergenza Note',
            'manuale_controlli' => 'REGISTRAZIONE Controlli / monitoraggi',
            'manuale_controlli_note' => 'Manuale Controlli Note',
            'manuale_verifiche' => 'REGISTRAZIONE Verifiche ispettive interne - inserire ultima verifica riscontrata',
            'manuale_verifiche_note' => 'Manuale Verifiche Note',
            'manuale_interventi' => 'REGISTRAZIONE Documentazione interventi disinfestazione',
            'manuale_interventi_note' => 'Manuale Interventi Note',
            'manuale_personale' => 'Documentazione formazione personale',
            'manuale_personale_note' => 'Manuale Personale Note',
            'manuale_nc' => 'Gestione delle non conformit&agrave;',
            'manuale_nc_note' => 'Manuale Nc Note',
            'manuale_rintracciabilita' => 'Procedura rintracciabilit&agrave;',
            'manuale_rintracciabilita_note' => 'Manuale Rintracciabilita Note',
            'manuale_allerta' => 'Procedura di allerta',
            'manuale_allerta_note' => 'Manuale Allerta Note',
            'manuale_autocontrollo' => 'Corrispondenza tra le procedure di autocontrollo e l\'attivit&agrave; svolta',
            'manuale_autocontrollo_note' => 'Manuale Autocontrollo Note',
            'manuale_haccp' => 'Manuale HACCP presente e completo?',
            'manuale_haccp_note' => 'Manuale Haccp Note',
            'note_11' => 'Note 11',
            'osservazioni_11' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili: ',
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
        $criteria->compare('stoccaggio_conformita', $this->stoccaggio_conformita, true);
        $criteria->compare('stoccaggio_conformita_note', $this->stoccaggio_conformita_note, true);
        $criteria->compare('stoccaggio_bilancia', $this->stoccaggio_bilancia, true);
        $criteria->compare('stoccaggio_bilancia_note', $this->stoccaggio_bilancia_note, true);
        $criteria->compare('stoccaggio_termografi', $this->stoccaggio_termografi, true);
        $criteria->compare('stoccaggio_termografi_note', $this->stoccaggio_termografi_note, true);
        $criteria->compare('stoccaggio_taratura', $this->stoccaggio_taratura, true);
        $criteria->compare('stoccaggio_taratura_note', $this->stoccaggio_taratura_note, true);
        $criteria->compare('stoccaggio_derrate', $this->stoccaggio_derrate, true);
        $criteria->compare('stoccaggio_derrate_note', $this->stoccaggio_derrate_note, true);
        $criteria->compare('stoccaggio_derrate_rialzate', $this->stoccaggio_derrate_rialzate, true);
        $criteria->compare('stoccaggio_derrate_rialzate_note', $this->stoccaggio_derrate_rialzate_note, true);
        $criteria->compare('stoccaggio_rotazione', $this->stoccaggio_rotazione, true);
        $criteria->compare('stoccaggio_rotazione_note', $this->stoccaggio_rotazione_note, true);
        $criteria->compare('stoccaggio_deperibili', $this->stoccaggio_deperibili, true);
        $criteria->compare('stoccaggio_deperibili_note', $this->stoccaggio_deperibili_note, true);
        $criteria->compare('stoccaggio_ddt', $this->stoccaggio_ddt, true);
        $criteria->compare('stoccaggio_ddt_note', $this->stoccaggio_ddt_note, true);
        $criteria->compare('stoccaggio_mezzi', $this->stoccaggio_mezzi, true);
        $criteria->compare('stoccaggio_mezzi_note', $this->stoccaggio_mezzi_note, true);
        $criteria->compare('stoccaggio_monouso', $this->stoccaggio_monouso, true);
        $criteria->compare('stoccaggio_monouso_note', $this->stoccaggio_monouso_note, true);
        $criteria->compare('note_1', $this->note_1, true);
        $criteria->compare('osservazioni_1', $this->osservazioni_1, true);
        $criteria->compare('derrata_orto_prodotto', $this->derrata_orto_prodotto, true);
        $criteria->compare('derrata_orto_prodotto_note', $this->derrata_orto_prodotto_note, true);
        $criteria->compare('derrata_orto_tipologia', $this->derrata_orto_tipologia, true);
        $criteria->compare('derrata_orto_tipologia_note', $this->derrata_orto_tipologia_note, true);
        $criteria->compare('derrata_orto_etichetta', $this->derrata_orto_etichetta, true);
        $criteria->compare('derrata_orto_etichetta_note', $this->derrata_orto_etichetta_note, true);
        $criteria->compare('derrata_orto_scadenza', $this->derrata_orto_scadenza, true);
        $criteria->compare('derrata_orto_scadenza_note', $this->derrata_orto_scadenza_note, true);
        $criteria->compare('derrata_orto_listino', $this->derrata_orto_listino, true);
        $criteria->compare('derrata_orto_listino_note', $this->derrata_orto_listino_note, true);
        $criteria->compare('derrata_orto_integrita', $this->derrata_orto_integrita, true);
        $criteria->compare('derrata_orto_integrita_note', $this->derrata_orto_integrita_note, true);
        $criteria->compare('derrata_orto_temperatura', $this->derrata_orto_temperatura, true);
        $criteria->compare('derrata_orto_temperatura_note', $this->derrata_orto_temperatura_note, true);
        $criteria->compare('derrata_orto_aspetto', $this->derrata_orto_aspetto, true);
        $criteria->compare('derrata_orto_aspetto_note', $this->derrata_orto_aspetto_note, true);
        $criteria->compare('derrata_orto_colore', $this->derrata_orto_colore, true);
        $criteria->compare('derrata_orto_colore_note', $this->derrata_orto_colore_note, true);
        $criteria->compare('derrata_orto_odore', $this->derrata_orto_odore, true);
        $criteria->compare('derrata_orto_odore_note', $this->derrata_orto_odore_note, true);
        $criteria->compare('derrata_orto_difetti', $this->derrata_orto_difetti, true);
        $criteria->compare('derrata_orto_difetti_note', $this->derrata_orto_difetti_note, true);
        $criteria->compare('derrata_carne_prodotto', $this->derrata_carne_prodotto, true);

        $criteria->compare('derrata_carne_tipologia', $this->derrata_carne_tipologia, true);
        $criteria->compare('derrata_carne_tipologia_note', $this->derrata_carne_tipologia_note, true);
        $criteria->compare('derrata_carne_etichetta', $this->derrata_carne_etichetta, true);
        $criteria->compare('derrata_carne_etichetta_note', $this->derrata_carne_etichetta_note, true);
        $criteria->compare('derrata_carne_scadenza', $this->derrata_carne_scadenza, true);
        $criteria->compare('derrata_carne_scadenza_note', $this->derrata_carne_scadenza_note, true);
        $criteria->compare('derrata_carne_listino', $this->derrata_carne_listino, true);
        $criteria->compare('derrata_carne_listino_note', $this->derrata_carne_listino_note, true);
        $criteria->compare('derrata_carne_integrita', $this->derrata_carne_integrita, true);
        $criteria->compare('derrata_carne_integrita_note', $this->derrata_carne_integrita_note, true);
        $criteria->compare('derrata_carne_temperatura', $this->derrata_carne_temperatura, true);
        $criteria->compare('derrata_carne_temperatura_note', $this->derrata_carne_temperatura_note, true);
        $criteria->compare('derrata_carne_aspetto', $this->derrata_carne_aspetto, true);
        $criteria->compare('derrata_carne_aspetto_note', $this->derrata_carne_aspetto_note, true);
        $criteria->compare('derrata_carne_colore', $this->derrata_carne_colore, true);
        $criteria->compare('derrata_carne_colore_note', $this->derrata_carne_colore_note, true);
        $criteria->compare('derrata_carne_odore', $this->derrata_carne_odore, true);
        $criteria->compare('derrata_carne_odore_note', $this->derrata_carne_odore_note, true);
        $criteria->compare('derrata_carne_difetti', $this->derrata_carne_difetti, true);
        $criteria->compare('derrata_carne_difetti_note', $this->derrata_carne_difetti_note, true);
        $criteria->compare('derrata_secco_prodotto', $this->derrata_secco_prodotto, true);

        $criteria->compare('derrata_secco_tipologia', $this->derrata_secco_tipologia, true);
        $criteria->compare('derrata_secco_tipologia_note', $this->derrata_secco_tipologia_note, true);
        $criteria->compare('derrata_secco_etichetta', $this->derrata_secco_etichetta, true);
        $criteria->compare('derrata_secco_etichetta_note', $this->derrata_secco_etichetta_note, true);
        $criteria->compare('derrata_secco_scadenza', $this->derrata_secco_scadenza, true);
        $criteria->compare('derrata_secco_scadenza_note', $this->derrata_secco_scadenza_note, true);
        $criteria->compare('derrata_secco_listino', $this->derrata_secco_listino, true);
        $criteria->compare('derrata_secco_listino_note', $this->derrata_secco_listino_note, true);
        $criteria->compare('derrata_secco_integrita', $this->derrata_secco_integrita, true);
        $criteria->compare('derrata_secco_integrita_note', $this->derrata_secco_integrita_note, true);
        $criteria->compare('derrata_secco_temperatura', $this->derrata_secco_temperatura, true);
        $criteria->compare('derrata_secco_temperatura_note', $this->derrata_secco_temperatura_note, true);
        $criteria->compare('derrata_secco_aspetto', $this->derrata_secco_aspetto, true);
        $criteria->compare('derrata_secco_aspetto_note', $this->derrata_secco_aspetto_note, true);
        $criteria->compare('derrata_secco_colore', $this->derrata_secco_colore, true);
        $criteria->compare('derrata_secco_colore_note', $this->derrata_secco_colore_note, true);
        $criteria->compare('derrata_secco_odore', $this->derrata_secco_odore, true);
        $criteria->compare('derrata_secco_odore_note', $this->derrata_secco_odore_note, true);
        $criteria->compare('derrata_secco_difetti', $this->derrata_secco_difetti, true);
        $criteria->compare('derrata_secco_difetti_note', $this->derrata_secco_difetti_note, true);
        $criteria->compare('note_2', $this->note_2, true);
        $criteria->compare('osservazioni_2', $this->osservazioni_2, true);
        $criteria->compare('aree_igiene_esterna', $this->aree_igiene_esterna, true);
        $criteria->compare('aree_igiene_esterna_note', $this->aree_igiene_esterna_note, true);
        $criteria->compare('aree_igiene_celle', $this->aree_igiene_celle, true);
        $criteria->compare('aree_igiene_celle_note', $this->aree_igiene_celle_note, true);
        $criteria->compare('aree_guarnizioni', $this->aree_guarnizioni, true);
        $criteria->compare('aree_guarnizioni_note', $this->aree_guarnizioni_note, true);
        $criteria->compare('aree_magazzino', $this->aree_magazzino, true);
        $criteria->compare('aree_magazzino_note', $this->aree_magazzino_note, true);
        $criteria->compare('aree_transito', $this->aree_transito, true);
        $criteria->compare('aree_transito_note', $this->aree_transito_note, true);
        $criteria->compare('aree_pareti', $this->aree_pareti, true);
        $criteria->compare('aree_pareti_note', $this->aree_pareti_note, true);
        $criteria->compare('aree_protezioni', $this->aree_protezioni, true);
        $criteria->compare('aree_protezioni_note', $this->aree_protezioni_note, true);
        $criteria->compare('aree_grigie', $this->aree_grigie, true);
        $criteria->compare('aree_grigie_note', $this->aree_grigie_note, true);
        $criteria->compare('note_3', $this->note_3, true);
        $criteria->compare('osservazioni_3', $this->osservazioni_3, true);
        $criteria->compare('produzione_imballaggio', $this->produzione_imballaggio, true);
        $criteria->compare('produzione_imballaggio_note', $this->produzione_imballaggio_note, true);
        $criteria->compare('produzione_igienica', $this->produzione_igienica, true);
        $criteria->compare('produzione_igienica_note', $this->produzione_igienica_note, true);
        $criteria->compare('produzione_preparazioni', $this->produzione_preparazioni, true);
        $criteria->compare('produzione_preparazioni_note', $this->produzione_preparazioni_note, true);
        $criteria->compare('produzione_promiscue', $this->produzione_promiscue, true);
        $criteria->compare('produzione_promiscue_note', $this->produzione_promiscue_note, true);
        $criteria->compare('produzione_tempi_lavorazione', $this->produzione_tempi_lavorazione, true);
        $criteria->compare('produzione_tempi_lavorazione_note', $this->produzione_tempi_lavorazione_note, true);
        $criteria->compare('produzione_temperatura', $this->produzione_temperatura, true);
        $criteria->compare('produzione_temperatura_note', $this->produzione_temperatura_note, true);
        $criteria->compare('produzione_scongelamento', $this->produzione_scongelamento, true);
        $criteria->compare('produzione_scongelamento_note', $this->produzione_scongelamento_note, true);
        $criteria->compare('produzione_piatti_caldi', $this->produzione_piatti_caldi, true);
        $criteria->compare('produzione_piatti_caldi_note', $this->produzione_piatti_caldi_note, true);
        $criteria->compare('produzione_piatti_freddi', $this->produzione_piatti_freddi, true);
        $criteria->compare('produzione_piatti_freddi_note', $this->produzione_piatti_freddi_note, true);
        $criteria->compare('produzione_mascherina', $this->produzione_mascherina, true);
        $criteria->compare('produzione_mascherina_note', $this->produzione_mascherina_note, true);
        $criteria->compare('produzione_lavaggio', $this->produzione_lavaggio, true);
        $criteria->compare('produzione_lavaggio_note', $this->produzione_lavaggio_note, true);
        $criteria->compare('produzione_campioni', $this->produzione_campioni, true);
        $criteria->compare('produzione_campioni_note', $this->produzione_campioni_note, true);
        $criteria->compare('produzione_buste_sterili', $this->produzione_buste_sterili, true);
        $criteria->compare('produzione_buste_sterili_note', $this->produzione_buste_sterili_note, true);
        $criteria->compare('produzione_abbatimento', $this->produzione_abbatimento, true);
        $criteria->compare('produzione_abbatimento_note', $this->produzione_abbatimento_note, true);
        $criteria->compare('produzione_diete', $this->produzione_diete, true);
        $criteria->compare('produzione_diete_note', $this->produzione_diete_note, true);
        $criteria->compare('produzione_diete_separate', $this->produzione_diete_separate, true);
        $criteria->compare('produzione_diete_separate_note', $this->produzione_diete_separate_note, true);
        $criteria->compare('produzione_diete_preparazione', $this->produzione_diete_preparazione, true);
        $criteria->compare('produzione_diete_preparazione_note', $this->produzione_diete_preparazione_note, true);
        $criteria->compare('note_4', $this->note_4, true);
        $criteria->compare('osservazioni_4', $this->osservazioni_4, true);
        $criteria->compare('strutture_filtri', $this->strutture_filtri, true);
        $criteria->compare('strutture_filtri_note', $this->strutture_filtri_note, true);
        $criteria->compare('strutture_cucine', $this->strutture_cucine, true);
        $criteria->compare('strutture_cucine_note', $this->strutture_cucine_note, true);
        $criteria->compare('strutture_attrezzature_pulite', $this->strutture_attrezzature_pulite, true);
        $criteria->compare('strutture_attrezzature_pulite_note', $this->strutture_attrezzature_pulite_note, true);
        $criteria->compare('strutture_attrezzature_efficienti', $this->strutture_attrezzature_efficienti, true);
        $criteria->compare('strutture_attrezzature_efficienti_note', $this->strutture_attrezzature_efficienti_note, true);
        $criteria->compare('strutture_pareti', $this->strutture_pareti, true);
        $criteria->compare('strutture_pareti_note', $this->strutture_pareti_note, true);
        $criteria->compare('strutture_griglie', $this->strutture_griglie, true);
        $criteria->compare('strutture_griglie_note', $this->strutture_griglie_note, true);
        $criteria->compare('strutture_davanzali', $this->strutture_davanzali, true);
        $criteria->compare('strutture_davanzali_note', $this->strutture_davanzali_note, true);
        $criteria->compare('strutture_taglieri', $this->strutture_taglieri, true);
        $criteria->compare('strutture_taglieri_note', $this->strutture_taglieri_note, true);
        $criteria->compare('strutture_taglieri_identificabili', $this->strutture_taglieri_identificabili, true);
        $criteria->compare('strutture_taglieri_identificabili_note', $this->strutture_taglieri_identificabili_note, true);
        $criteria->compare('note_5', $this->note_5, true);
        $criteria->compare('osservazioni_5', $this->osservazioni_5, true);
        $criteria->compare('distribuzione_comunicazione', $this->distribuzione_comunicazione, true);
        $criteria->compare('distribuzione_comunicazione_note', $this->distribuzione_comunicazione_note, true);
        $criteria->compare('distribuzione_igieniche', $this->distribuzione_igieniche, true);
        $criteria->compare('distribuzione_igieniche_note', $this->distribuzione_igieniche_note, true);
        $criteria->compare('distribuzione_materiale', $this->distribuzione_materiale, true);
        $criteria->compare('distribuzione_materiale_note', $this->distribuzione_materiale_note, true);
        $criteria->compare('distribuzione_piatti_freddi', $this->distribuzione_piatti_freddi, true);
        $criteria->compare('distribuzione_piatti_freddi_note', $this->distribuzione_piatti_freddi_note, true);
        $criteria->compare('distribuzione_piatti_caldi', $this->distribuzione_piatti_caldi, true);
        $criteria->compare('distribuzione_piatti_caldi_note', $this->distribuzione_piatti_caldi_note, true);
        $criteria->compare('distribuzione_sefservice', $this->distribuzione_sefservice, true);
        $criteria->compare('distribuzione_sefservice_note', $this->distribuzione_sefservice_note, true);
        $criteria->compare('distribuzione_cortesia', $this->distribuzione_cortesia, true);
        $criteria->compare('distribuzione_cortesia_note', $this->distribuzione_cortesia_note, true);
        $criteria->compare('distribuzione_composizione', $this->distribuzione_composizione, true);
        $criteria->compare('distribuzione_composizione_note', $this->distribuzione_composizione_note, true);
        $criteria->compare('distribuzione_vetrine', $this->distribuzione_vetrine, true);
        $criteria->compare('distribuzione_vetrine_note', $this->distribuzione_vetrine_note, true);
        $criteria->compare('distribuzione_attrezature', $this->distribuzione_attrezature, true);
        $criteria->compare('distribuzione_attrezature_note', $this->distribuzione_attrezature_note, true);
        $criteria->compare('distribuzione_attrezature_efficienti', $this->distribuzione_attrezature_efficienti, true);
        $criteria->compare('distribuzione_attrezature_efficienti_note', $this->distribuzione_attrezature_efficienti_note, true);

        $criteria->compare('distribuzione_locali', $this->distribuzione_locali, true);
        $criteria->compare('distribuzione_locali_note', $this->distribuzione_locali_note, true);
        $criteria->compare('distribuzione_tavoli', $this->distribuzione_tavoli, true);
        $criteria->compare('distribuzione_tavoli_note', $this->distribuzione_tavoli_note, true);
        $criteria->compare('distribuzione_ambiente', $this->distribuzione_ambiente, true);
        $criteria->compare('distribuzione_ambiente_note', $this->distribuzione_ambiente_note, true);
        $criteria->compare('distribuzione_erogatori', $this->distribuzione_erogatori, true);
        $criteria->compare('distribuzione_erogatori_note', $this->distribuzione_erogatori_note, true);
        $criteria->compare('distribuzione_cartucce', $this->distribuzione_cartucce, true);
        $criteria->compare('distribuzione_cartucce_note', $this->distribuzione_cartucce_note, true);
        $criteria->compare('distribuzione_frequenza', $this->distribuzione_frequenza, true);
        $criteria->compare('distribuzione_frequenza_note', $this->distribuzione_frequenza_note, true);
        $criteria->compare('note_6', $this->note_6, true);
        $criteria->compare('osservazioni_6', $this->osservazioni_6, true);
        $criteria->compare('rifiuti_preparazione', $this->rifiuti_preparazione, true);
        $criteria->compare('rifiuti_preparazione_note', $this->rifiuti_preparazione_note, true);
        $criteria->compare('rifiuti_distribuzione', $this->rifiuti_distribuzione, true);
        $criteria->compare('rifiuti_distribuzione_note', $this->rifiuti_distribuzione_note, true);
        $criteria->compare('rifiuti_racolta', $this->rifiuti_racolta, true);
        $criteria->compare('rifiuti_racolta_note', $this->rifiuti_racolta_note, true);
        $criteria->compare('rifiuti_contenitori', $this->rifiuti_contenitori, true);
        $criteria->compare('rifiuti_contenitori_note', $this->rifiuti_contenitori_note, true);
        $criteria->compare('rifiuti_esterno', $this->rifiuti_esterno, true);
        $criteria->compare('rifiuti_esterno_note', $this->rifiuti_esterno_note, true);
        $criteria->compare('rifiuti_attrezzature', $this->rifiuti_attrezzature, true);
        $criteria->compare('rifiuti_attrezzature_note', $this->rifiuti_attrezzature_note, true);
        $criteria->compare('rifiuti_documento', $this->rifiuti_documento, true);
        $criteria->compare('rifiuti_documento_note', $this->rifiuti_documento_note, true);
        $criteria->compare('rifiuti_registro', $this->rifiuti_registro, true);
        $criteria->compare('rifiuti_registro_note', $this->rifiuti_registro_note, true);
        $criteria->compare('rifiuti_differenziata', $this->rifiuti_differenziata, true);
        $criteria->compare('rifiuti_differenziata_note', $this->rifiuti_differenziata_note, true);
        $criteria->compare('rifiuti_oli', $this->rifiuti_oli, true);
        $criteria->compare('rifiuti_oli_note', $this->rifiuti_oli_note, true);
        $criteria->compare('note_7', $this->note_7, true);
        $criteria->compare('osservazioni_7', $this->osservazioni_7, true);
        $criteria->compare('lavaggio_funzionante', $this->lavaggio_funzionante, true);
        $criteria->compare('lavaggio_funzionante_note', $this->lavaggio_funzionante_note, true);
        $criteria->compare('lavaggio_ambiente', $this->lavaggio_ambiente, true);
        $criteria->compare('lavaggio_ambiente_note', $this->lavaggio_ambiente_note, true);
        $criteria->compare('lavaggio_microclima', $this->lavaggio_microclima, true);
        $criteria->compare('lavaggio_microclima_note', $this->lavaggio_microclima_note, true);
        $criteria->compare('lavaggio_bracci', $this->lavaggio_bracci, true);
        $criteria->compare('lavaggio_bracci_note', $this->lavaggio_bracci_note, true);
        $criteria->compare('lavaggio_clacare', $this->lavaggio_clacare, true);
        $criteria->compare('lavaggio_clacare_note', $this->lavaggio_clacare_note, true);
        $criteria->compare('lavaggio_addolcimento', $this->lavaggio_addolcimento, true);
        $criteria->compare('lavaggio_addolcimento_note', $this->lavaggio_addolcimento_note, true);
        $criteria->compare('lavaggio_temperatura', $this->lavaggio_temperatura, true);
        $criteria->compare('lavaggio_temperatura_note', $this->lavaggio_temperatura_note, true);
        $criteria->compare('lavaggio_davanzali', $this->lavaggio_davanzali, true);
        $criteria->compare('lavaggio_davanzali_note', $this->lavaggio_davanzali_note, true);
        $criteria->compare('note_8', $this->note_8, true);
        $criteria->compare('osservazioni_8', $this->osservazioni_8, true);
        $criteria->compare('personale_presente', $this->personale_presente, true);
        $criteria->compare('personale_presente_note', $this->personale_presente_note, true);
        $criteria->compare('personale_registro', $this->personale_registro, true);
        $criteria->compare('personale_registro_note', $this->personale_registro_note, true);
        $criteria->compare('personale_responsabile', $this->personale_responsabile, true);
        $criteria->compare('personale_responsabile_note', $this->personale_responsabile_note, true);
        $criteria->compare('personale_igiene', $this->personale_igiene, true);
        $criteria->compare('personale_igiene_note', $this->personale_igiene_note, true);
        $criteria->compare('personale_igiene_conforme', $this->personale_igiene_conforme, true);
        $criteria->compare('personale_igiene_conform_note', $this->personale_igiene_conforme_note, true);

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
        $criteria->compare('personale_spogliatoi_adeguati', $this->personale_spogliatoi_adeguati, true);
        $criteria->compare('personale_spogliatoi_adeguati_note', $this->personale_spogliatoi_adeguati_note, true);

        $criteria->compare('personale_sporgenti', $this->personale_sporgenti, true);
        $criteria->compare('personale_sporgenti_note', $this->personale_sporgenti_note, true);
        $criteria->compare('personale_davanzali', $this->personale_davanzali, true);
        $criteria->compare('personale_davanzali_note', $this->personale_davanzali_note, true);
        $criteria->compare('note_9', $this->note_9, true);
        $criteria->compare('osservazioni_9', $this->osservazioni_9, true);
        $criteria->compare('sanificazione_conformi', $this->sanificazione_conformi, true);
        $criteria->compare('sanificazione_conformi_note', $this->sanificazione_conformi_note, true);
        $criteria->compare('sanificazione_stoccaggio', $this->sanificazione_stoccaggio, true);
        $criteria->compare('sanificazione_stoccaggio_note', $this->sanificazione_stoccaggio_note, true);
        $criteria->compare('sanificazione_corretto', $this->sanificazione_corretto, true);
        $criteria->compare('sanificazione_corretto_note', $this->sanificazione_corretto_note, true);
        $criteria->compare('sanificazione_pulizia', $this->sanificazione_pulizia, true);
        $criteria->compare('sanificazione_pulizia_note', $this->sanificazione_pulizia_note, true);
        $criteria->compare('sanificazione_lavaggio', $this->sanificazione_lavaggio, true);
        $criteria->compare('sanificazione_lavaggio_note', $this->sanificazione_lavaggio_note, true);
        $criteria->compare('sanificazione_roditori', $this->sanificazione_roditori, true);
        $criteria->compare('sanificazione_roditori_note', $this->sanificazione_roditori_note, true);
        $criteria->compare('sanificazione_documentazione', $this->sanificazione_documentazione, true);
        $criteria->compare('sanificazione_documentazione_note', $this->sanificazione_documentazione_note, true);
        $criteria->compare('sanificazione_pozzetti', $this->sanificazione_pozzetti, true);
        $criteria->compare('sanificazione_pozzetti_note', $this->sanificazione_pozzetti_note, true);
        $criteria->compare('sanificazione_pareti', $this->sanificazione_pareti, true);
        $criteria->compare('sanificazione_pareti_note', $this->sanificazione_pareti_note, true);
        $criteria->compare('sanificazione_davanzali', $this->sanificazione_davanzali, true);
        $criteria->compare('sanificazione_davanzali_note', $this->sanificazione_davanzali_note, true);
        $criteria->compare('sanificazione_odori', $this->sanificazione_odori, true);
        $criteria->compare('sanificazione_odori_note', $this->sanificazione_odori_note, true);
        $criteria->compare('sanificazione_lavamani', $this->sanificazione_lavamani, true);
        $criteria->compare('sanificazione_lavamani_note', $this->sanificazione_lavamani_note, true);
        $criteria->compare('sanificazione_montacarichi', $this->sanificazione_montacarichi, true);
        $criteria->compare('sanificazione_montacarichi_note', $this->sanificazione_montacarichi_note, true);
        $criteria->compare('sanificazione_schede', $this->sanificazione_schede, true);
        $criteria->compare('sanificazione_schede_note', $this->sanificazione_schede_note, true);
        $criteria->compare('sanificazione_flaconi', $this->sanificazione_flaconi, true);
        $criteria->compare('sanificazione_flaconi_note', $this->sanificazione_flaconi_note, true);
        $criteria->compare('sanificazione_esche', $this->sanificazione_esche, true);
        $criteria->compare('sanificazione_esche_note', $this->sanificazione_esche_note, true);
        $criteria->compare('sanificazione_schede_tecniche', $this->sanificazione_schede_tecniche, true);
        $criteria->compare('sanificazione_schede_tecniche_note', $this->sanificazione_schede_tecniche_note, true);
        $criteria->compare('note_10', $this->note_10, true);
        $criteria->compare('osservazioni_10', $this->osservazioni_10, true);
        $criteria->compare('manuale_detergenza', $this->manuale_detergenza, true);
        $criteria->compare('manuale_detergenza_note', $this->manuale_detergenza_note, true);
        $criteria->compare('manuale_controlli', $this->manuale_controlli, true);
        $criteria->compare('manuale_controlli_note', $this->manuale_controlli_note, true);
        $criteria->compare('manuale_verifiche', $this->manuale_verifiche, true);
        $criteria->compare('manuale_verifiche_note', $this->manuale_verifiche_note, true);
        $criteria->compare('manuale_interventi', $this->manuale_interventi, true);
        $criteria->compare('manuale_interventi_note', $this->manuale_interventi_note, true);
        $criteria->compare('manuale_personale', $this->manuale_personale, true);
        $criteria->compare('manuale_personale_note', $this->manuale_personale_note, true);
        $criteria->compare('manuale_nc', $this->manuale_nc, true);
        $criteria->compare('manuale_nc_note', $this->manuale_nc_note, true);
        $criteria->compare('manuale_rintracciabilita', $this->manuale_rintracciabilita, true);
        $criteria->compare('manuale_rintracciabilita_note', $this->manuale_rintracciabilita_note, true);
        $criteria->compare('manuale_allerta', $this->manuale_allerta, true);
        $criteria->compare('manuale_allerta_note', $this->manuale_allerta_note, true);
        $criteria->compare('manuale_autocontrollo', $this->manuale_autocontrollo, true);
        $criteria->compare('manuale_autocontrollo_note', $this->manuale_autocontrollo_note, true);
        $criteria->compare('manuale_haccp', $this->manuale_haccp, true);
        $criteria->compare('manuale_haccp_note', $this->manuale_haccp_note, true);
        $criteria->compare('note_11', $this->note_11, true);
        $criteria->compare('osservazioni_11', $this->osservazioni_11, true);
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
            1 => "1. RICEVIMENTO E STOCCAGGIO",
            2 => "2. QUALITA' DERRATE (controllo a campione)",
            3 => "3. IGIENE DELLE AREE DI STOCCAGGIO",
            4 => "4. PRODUZIONE (Attivit&agrave;)",
            5 => "5. PRODUZIONE (Ambiente e strutture)",
            6 => "6. DISTRIBUZIONE ",
            7 => "7. GESTIONE DEI RIFIUTI",
            8 => "8. REPARTO LAVAGGIO",
            9 => "9. PERSONALE",
            10 => "10. GESTIONE DETERGENZA, SANIFICAZIONE,",
            11 => "11. VERIFICA DOCUMENTALE DEL MANUALE H.A.C.C.P.",
        );
        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('stoccaggio_conformita', 'stoccaggio_bilancia', 'stoccaggio_termografi', 'stoccaggio_taratura', 'stoccaggio_derrate', 'stoccaggio_derrate_rialzate', 'stoccaggio_rotazione', 'stoccaggio_deperibili', 'stoccaggio_ddt', 'stoccaggio_mezzi', 'stoccaggio_monouso'),
            'sezione_2' => array('derrata_orto_tipologia', 'derrata_orto_etichetta', 'derrata_orto_scadenza', 'derrata_orto_listino', 'derrata_orto_integrita', 'derrata_orto_temperatura', 'derrata_orto_aspetto', 'derrata_orto_colore', 'derrata_orto_odore', 'derrata_orto_difetti', 'derrata_carne_tipologia', 'derrata_carne_etichetta', 'derrata_carne_scadenza', 'derrata_carne_listino', 'derrata_carne_integrita', 'derrata_carne_temperatura', 'derrata_carne_aspetto', 'derrata_carne_colore', 'derrata_carne_odore', 'derrata_carne_difetti', 'derrata_secco_tipologia', 'derrata_secco_etichetta', 'derrata_secco_scadenza', 'derrata_secco_listino', 'derrata_secco_integrita', 'derrata_secco_temperatura', 'derrata_secco_aspetto', 'derrata_secco_colore', 'derrata_secco_odore', 'derrata_secco_difetti'),
            'sezione_3' => array('aree_igiene_esterna', 'aree_igiene_celle', 'aree_guarnizioni', 'aree_magazzino', 'aree_transito', 'aree_pareti', 'aree_protezioni', 'aree_grigie'),
            'sezione_4' => array('produzione_imballaggio', 'produzione_igienica', 'produzione_preparazioni', 'produzione_promiscue', 'produzione_tempi_lavorazione', 'produzione_temperatura', 'produzione_scongelamento', 'produzione_piatti_caldi', 'produzione_piatti_freddi', 'produzione_mascherina', 'produzione_lavaggio', 'produzione_campioni', 'produzione_buste_sterili', 'produzione_abbatimento', 'produzione_diete', 'produzione_diete_separate', 'produzione_diete_preparazione'),
            'sezione_5' => array('strutture_filtri', 'strutture_cucine', 'strutture_attrezzature_pulite', 'strutture_attrezzature_efficienti', 'strutture_pareti', 'strutture_griglie', 'strutture_davanzali', 'strutture_taglieri', 'strutture_taglieri_identificabili'),
            'sezione_6' => array('distribuzione_comunicazione', 'distribuzione_igieniche', 'distribuzione_materiale', 'distribuzione_piatti_freddi', 'distribuzione_piatti_caldi', 'distribuzione_sefservice', 'distribuzione_cortesia', 'distribuzione_composizione', 'distribuzione_vetrine', 'distribuzione_attrezature', 'distribuzione_attrezature_efficienti', 'distribuzione_locali', 'distribuzione_tavoli', 'distribuzione_ambiente', 'distribuzione_erogatori', 'distribuzione_cartucce', 'distribuzione_frequenza'),
            'sezione_7' => array('rifiuti_preparazione', 'rifiuti_distribuzione', 'rifiuti_racolta', 'rifiuti_contenitori', 'rifiuti_esterno', 'rifiuti_attrezzature', 'rifiuti_documento', 'rifiuti_registro', 'rifiuti_differenziata', 'rifiuti_oli'),
            'sezione_8' => array('lavaggio_funzionante', 'lavaggio_ambiente', 'lavaggio_microclima', 'lavaggio_bracci', 'lavaggio_clacare', 'lavaggio_addolcimento', 'lavaggio_temperatura', 'lavaggio_davanzali'),
            'sezione_9' => array('personale_presente', 'personale_registro', 'personale_responsabile', 'personale_igiene', 'personale_igiene_conforme', 'personale_comportamento', 'personale_dpi', 'personale_cartellino', 'personale_servizi', 'personale_saponi', 'personale_spogliatoi', 'personale_sporgenti', 'personale_davanzali'),
            'sezione_10' => array('sanificazione_conformi', 'sanificazione_stoccaggio', 'sanificazione_corretto', 'sanificazione_pulizia', 'sanificazione_lavaggio', 'sanificazione_roditori', 'sanificazione_documentazione', 'sanificazione_pozzetti', 'sanificazione_pareti', 'sanificazione_davanzali', 'sanificazione_odori', 'sanificazione_lavamani', 'sanificazione_montacarichi', 'sanificazione_schede', 'sanificazione_flaconi', 'sanificazione_esche', 'sanificazione_schede_tecniche'),
            'sezione_11' => array('manuale_detergenza', 'manuale_controlli', 'manuale_verifiche', 'manuale_interventi', 'manuale_personale', 'manuale_nc', 'manuale_rintracciabilita', 'manuale_allerta', 'manuale_autocontrollo', 'manuale_haccp'),
        );
        return $field;
    }

    public function getComplete($x, $tipo = NULL) {

        $field = $this->campiSezioni['sezione_' . $x];
        $complete = 0;
        if ($field) {
            foreach ($field AS $val) {
                if ($tipo == 'NC') {
                    if ($this->$val == 'NC')
                        $complete++;
                }else {
                    if ($this->$val != '' AND $this->$val != NULL)
                        $complete++;
                }
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
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "' ,'" . addslashes($user['nome']) . "','" . addslashes($user['cognome']) . "','21' )";
                        if (Yii::app()->db->createCommand($query)->execute()) {
                            $LID = Yii::app()->db->lastInsertID;
                            $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $LID);
                            Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET codice ='" . $codice . "' WHERE id ='" . $LID . "'  ")->execute();
                        }
                    }else
                        Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET data= NOW() , data_nc = NOW() , id_utente ='" . Yii::app()->user->getId() . "' , id_verifica ='" . $this->id_verifica . "' ,  tipo_verifica='" . $val[$x] . "' ,  descrizione ='" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "'   WHERE id ='" . $isNC . "'  ")->execute();
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