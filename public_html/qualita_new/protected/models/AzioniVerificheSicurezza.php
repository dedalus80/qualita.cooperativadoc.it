<?php

class AzioniVerificheSicurezza extends CActiveRecord {

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
        return 'db_verifiche_sicurezza';
    }

    public function rules() {
        return array(
            array('id_verifica, codice_verifica, autore, anno', 'required'),
            array('id_verifica, unita_operativa, autore, numero_non_conformita', 'numerical', 'integerOnly' => true),
            array('codice_verifica', 'length', 'max' => 50),
            array('tipo_valutazione, apertura_nc', 'length', 'max' => 1),
            array('presenza_documento, cartellino, presenza_fascicoli, presenza_verbale, presenza_dpi, dpi_indossati, presenza_lettera_incarico, presenza_incaricati, preposti_sicurezza, addetti_sicurezza, copie_attestati, aggiornamenti_attestati, incaricati_primo_soccorso, letter_primo_soccorso, attestati_formazione, prove_emergenza, verbale_prove_emergenza, registro_accessi, informativa_rischi, divieto_fumo, rischio_elettrico, divieto_acqua, punto_raccolta, pulsante_allarme, pulsante_sgancio, uscite_emergenza, porte_tagliafuoco, estintori, idranti_manichetta, idranti_colonna, naspi, attacco_vvf, divieto_parcheggio, passo_uomo, uscita_veicoli, divieto_accesso, planimetrie, informativa_emergenza, copia_cpi, impianto_elettrico, impianto_idrico, impianto_termico, impianto_condizionamento, impianto_antincendio, impianto_fumi, denuncia_messaterra, verifica_messaterra, verifica_ascensore, verifica_funi, caldaia_conforme, autorizzazione_alberghiera, autorizzazione_sanitaria, autorizzazione_piscina, contratto_man_antincendio, contratto_man_ascensori, contratto_man_termico, contratto_man_elettrico, contratto_man_idrico, presenza_dvr,presenza_dvr_specifico, rischio_chimico, rischio_incendio, rischio_rumore, rischio_stress, rischio_vibrazioni, presenza_patentini, documenti_rischi, piano_emergenza, planimetrie_esposte, presenza_verbale_giornaliero, presenza_manuale_hse, firme_responsabili, ditta_consulente, certificato_prelievo, modulo_sch, presenza_termometro, acqua_calda, acqua_fredda, usura_giunti, diffusori_doccia', 'length', 'max' => 2),
            array('presenza_documento_note, cartellino_note, presenza_fascicoli_note, presenza_verbale_note, presenza_dpi_note, dpi_indossati_note, presenza_lettera_incarico_note, presenza_incaricati_note, preposti_sicurezza_note, addetti_sicurezza_note, copie_attestati_note, aggiornamenti_attestati_note, incaricati_primo_soccorso_note, letter_primo_soccorso_note, attestati_formazione_note, prove_emergenza_note, verbale_prove_emergenza_note, registro_accessi_note, informativa_rischi_note, divieto_fumo_note, rischio_elettrico_note, divieto_acqua_note, punto_raccolta_note, pulsante_allarme_note, pulsante_sgancio_note, uscite_emergenza_note, porte_tagliafuoco_note, estintori_note, idranti_manichetta_note, idranti_colonna_note, naspi_note, attacco_vvf_note, divieto_parcheggio_note, passo_uomo_note, uscita_veicoli_note, divieto_accesso_note, planimetrie_note, informativa_emergenza_note, copia_cpi_note, impianto_elettrico_note, impianto_idrico_note, impianto_termico_note, impianto_condizionamento_note, impianto_antincendio_note, impianto_fumi_note, denuncia_messaterra_note, verifica_messaterra_note, verifica_ascensore_note, verifica_funi_note, caldaia_conforme_note, autorizzazione_alberghiera_note, autorizzazione_sanitaria_note, autorizzazione_piscina_note, contratto_man_antincendio_note, contratto_man_ascensori_note, contratto_man_termico_note, contratto_man_elettrico_note, contratto_man_idrico_note, presenza_dvr_note, presenza_dvr_specifico_note, rischio_chimico_note, rischio_incendio_note, rischio_rumore_note, rischio_stress_note, rischio_vibrazioni_note, presenza_patentini_note, documenti_rischi_note, piano_emergenza_note, planimetrie_esposte_note, presenza_verbale_giornaliero_note, presenza_manuale_hse_note, firme_responsabili_note, ditta_consulente_note, certificato_prelievo_note, modulo_sch_note, presenza_termometro_note, acqua_calda_note, acqua_fredda_note, usura_giunti_note, diffusori_doccia_note', 'length', 'max' => 255),
            array('anno', 'length', 'max' => 4),
            array('data, ora_inizio, ora_fine, note_1,  osservazioni_1, note_2,  osservazioni_2, note_3,  osservazioni_3, note_4,  osservazioni_4, note_5,  osservazioni_5, note_6,  osservazioni_6', 'safe'),
            array('id, id_verifica, codice_verifica, data, unita_operativa, autore, ora_inizio, ora_fine, tipo_valutazione, apertura_nc, presenza_documento, presenza_documento_note, cartellino, cartellino_note, presenza_fascicoli, presenza_fascicoli_note, presenza_verbale, presenza_verbale_note, presenza_dpi, presenza_dpi_note, dpi_indossati, dpi_indossati_note, presenza_lettera_incarico, presenza_lettera_incarico_note, presenza_incaricati, presenza_incaricati_note, preposti_sicurezza, preposti_sicurezza_note, addetti_sicurezza, addetti_sicurezza_note, copie_attestati, copie_attestati_note, aggiornamenti_attestati, aggiornamenti_attestati_note, incaricati_primo_soccorso, incaricati_primo_soccorso_note, letter_primo_soccorso, letter_primo_soccorso_note, attestati_formazione, attestati_formazione_note, prove_emergenza, prove_emergenza_note, verbale_prove_emergenza, verbale_prove_emergenza_note, registro_accessi, registro_accessi_note, informativa_rischi, informativa_rischi_note, divieto_fumo, divieto_fumo_note, rischio_elettrico, rischio_elettrico_note, divieto_acqua, divieto_acqua_note, punto_raccolta, punto_raccolta_note, pulsante_allarme, pulsante_allarme_note, pulsante_sgancio, pulsante_sgancio_note, uscite_emergenza, uscite_emergenza_note, porte_tagliafuoco, porte_tagliafuoco_note, estintori, estintori_note, idranti_manichetta, idranti_manichetta_note, idranti_colonna, idranti_colonna_note, naspi, naspi_note, attacco_vvf, attacco_vvf_note, divieto_parcheggio, divieto_parcheggio_note, passo_uomo, passo_uomo_note, uscita_veicoli, uscita_veicoli_note, divieto_accesso, divieto_accesso_note, planimetrie, planimetrie_note, informativa_emergenza, informativa_emergenza_note, copia_cpi, copia_cpi_note, impianto_elettrico, impianto_elettrico_note, impianto_idrico, impianto_idrico_note, impianto_termico, impianto_termico_note, impianto_condizionamento, impianto_condizionamento_note, impianto_antincendio, impianto_antincendio_note, impianto_fumi, impianto_fumi_note, denuncia_messaterra, denuncia_messaterra_note, verifica_messaterra, verifica_messaterra_note, verifica_ascensore, verifica_ascensore_note, verifica_funi, verifica_funi_note, caldaia_conforme, caldaia_conforme_note, autorizzazione_alberghiera, autorizzazione_alberghiera_note, autorizzazione_sanitaria, autorizzazione_sanitaria_note, autorizzazione_piscina, autorizzazione_piscina_note, contratto_man_antincendio, contratto_man_antincendio_note, contratto_man_ascensori, contratto_man_ascensori_note, contratto_man_termico, contratto_man_termico_note, contratto_man_elettrico, contratto_man_elettrico_note, contratto_man_idrico, contratto_man_idrico_note, presenza_dvr, presenza_dvr_note, presenza_specifico_dvr, presenza_dvr_specifico_note, rischio_chimico, rischio_chimico_note, rischio_incendio, rischio_incendio_note, rischio_rumore, rischio_rumore_note, rischio_stress, rischio_stress_note, rischio_vibrazioni, rischio_vibrazioni_note, presenza_patentini, presenza_patentini_note, documenti_rischi, documenti_rischi_note, piano_emergenza, piano_emergenza_note, planimetrie_esposte, planimetrie_esposte_note, presenza_verbale_giornaliero, presenza_verbale_giornaliero_note, presenza_manuale_hse, presenza_manuale_hse_note, firme_responsabili, firme_responsabili_note, ditta_consulente, ditta_consulente_note, certificato_prelievo, certificato_prelievo_note, modulo_sch, modulo_sch_note, presenza_termometro, presenza_termometro_note, acqua_calda, acqua_calda_note, acqua_fredda, acqua_fredda_note, usura_giunti, usura_giunti_note, diffusori_doccia, diffusori_doccia_note, numero_non_conformita, note_1,  osservazioni_1, note_2,  osservazioni_2, note_3,  osservazioni_3, note_4,  osservazioni_4, note_5,  osservazioni_5, note_6,  osservazioni_6 anno', 'safe', 'on' => 'search'),
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
            'presenza_documento' => '&Egrave; presente il documento organico del personale con indizazioni delle mansioni svolte?',
            'presenza_documento_note' => 'Presenza Documento Note',
            'cartellino' => 'IL PERSONALE IN SERVIZIO INDOSSA A VISTA  IL CARTELLINO IDENTIFICATIVO E QUESTO RISULTA INTEGRO E COMPLETO IN TUTTE LE SUE PARTI?',
            'cartellino_note' => 'Cartellino Note',
            'presenza_fascicoli' => 'SONO PRESENTI PRESSO L\'UNIT&Agrave; OPERATIVA TUTTE LE TIPOLOGIE DI FASCICOLI INFORMATIVI SUI RISCHI SPECIFICI PER MANSIONE?',
            'presenza_fascicoli_note' => 'Presenza Fascicoli Note',
            'presenza_verbale' => '&Egrave; PRESENTE IL VERBALE DI CONSEGNA DEI D.P.I PER OGNI SPECIFICA MANSIONE?',
            'presenza_verbale_note' => 'Presenza Verbale Note',
            'presenza_dpi' => 'SONO PRESENTI I D.P.I. COMUNI SPECIFICI PER ATTIVIT&Agrave; COME DESCRITTO DAL DVR DELL\'UNIT&Agrave; OPERATIVA?',
            'presenza_dpi_note' => 'Presenza Dpi Note',
            'dpi_indossati' => 'IL PERSONALE INDOSSA CORRETTAMENTE I DPI PREVISTI PER LE ATTIVIT&agrave; IN CORSO AL MOMENTO DELLA VERIFICA ISPETTIVA?',
            'dpi_indossati_note' => 'Dpi Indossati Note',
            'presenza_lettera_incarico' => '&Egrave; PRESENTE LA LETTERA DI INCARICO PER IL DIRIGENTE DELEGATO - SE PREVISTO DAL DVR AZIENDALE IN LOCO?',
            'presenza_lettera_incarico_note' => 'Presenza Lettera Incarico Note',
            'presenza_incaricati' => 'SONO STATI INDIVIDUATI E NOMINATI GLI ADDETTI INCARICATI ANTINCENDIO? SONO PRESENTI LE LETTERE?',
            'presenza_incaricati_note' => 'Presenza Incaricati Note',
            'preposti_sicurezza' => 'SONO STATI INDIVIDUATI E NOMINATI I PREPOSTI ALLA SICUREZZA? SONO PRESENTI LE LETTERE?',
            'preposti_sicurezza_note' => 'Preposti Sicurezza Note',
            'addetti_sicurezza' => 'SONO STATI INDIVIDUATI E NOMINATI GLI ADDETTI ANTICENDIO E ALL\'EVACQUAZIONE? SONO PRESENTI LE LETTERE?',
            'addetti_sicurezza_note' => 'Addetti Sicurezza Note',
            'copie_attestati' => 'SONO PRESENTI COPIE DEGLI ATTESTATI ANTINCEDIO DEGLI ADDETTI PRESSO L\'UNIT&Agrave; OPERATIVA?',
            'copie_attestati_note' => 'Copie Attestati Note',
            'aggiornamenti_attestati' => 'IN CASO DI ATTESTATI CONSEGUITI DA OLTRE 3 ANNI ALLA DATA DI VERIFICA ISPETTIVA &Egrave; PRESENTE L\'ATTESTATO ANTICENDIO DI AGGIORNAMENTO FORMAZIONE?',
            'aggiornamenti_attestati_note' => 'Aggiornamenti Attestati Note',
            'incaricati_primo_soccorso' => 'SONO STATI INDIVIDUATI INCARICATI DI PRIMO SOCCORSO? ',
            'incaricati_primo_soccorso_note' => 'Incaricati Primo Soccorso Note',
            'letter_primo_soccorso' => 'PER GLI INCARICATI AL PRIMO SOCCORSO SONO PRESENTI LE LETTERE DI INCARICO?',
            'letter_primo_soccorso_note' => 'Letter Primo Soccorso Note',
            'attestati_formazione' => 'SONO PRESENTI PRESSO L\'UNIT&Agrave; OPERATIVA GLI ATTESTATI DI AVVENUTA FORMAZIONE PER INCARICATI DI PRIMO SOCCORSO?',
            'attestati_formazione_note' => 'Attestati Formazione Note',
            'prove_emergenza' => 'SONO STATE SVOLTE LE PERIODICHE PROVE DI EMERGENZA - indicare data ultima prova eseguita - ',
            'prove_emergenza_note' => 'Prove Emergenza Note',
            'verbale_prove_emergenza' => '&Egrave; PRESENTE IL VERBALE DI AVVENUTA EFFETTUAZIONE DELLA PROVA DI EMERGENZA?',
            'verbale_prove_emergenza_note' => 'Verbale Prove Emergenza Note',
            'registro_accessi' => '&Egrave; PRESENTE E CORRETTAMENTE COMPILATO IL REGISTRO DI CONTROLLO DEGLI ACCESSI?',
            'registro_accessi_note' => 'Registro Accessi Note',
            'informativa_rischi' => '&Egrave; PRESENTE L\'INFORMATIVA SUI RISCHI DELLA STRUTTURA DA CONSEGNARE AD OSPITI E VISITATORI?',
            'informativa_rischi_note' => 'Informativa Rischi Note',
            'divieto_fumo' => 'Divieto di fumo completo all\'ingresso',
            'divieto_fumo_note' => 'Divieto Fumo Note',
            'rischio_elettrico' => 'Rischio elettrico sui quadri',
            'rischio_elettrico_note' => 'Rischio Elettrico Note',
            'divieto_acqua' => 'Divieto di spegnere con acqua sui quadri',
            'divieto_acqua_note' => 'Divieto Acqua Note',
            'punto_raccolta' => 'Punto di raccolta',
            'punto_raccolta_note' => 'Punto Raccolta Note',
            'pulsante_allarme' => 'Pulsanti di allarme',
            'pulsante_allarme_note' => 'Pulsante Allarme Note',
            'pulsante_sgancio' => 'Pulsanti di sgancio',
            'pulsante_sgancio_note' => 'Pulsante Sgancio Note',
            'uscite_emergenza' => 'Uscite di emergenza',
            'uscite_emergenza_note' => 'Uscite Emergenza Note',
            'porte_tagliafuoco' => 'Porte tagliafuoco',
            'porte_tagliafuoco_note' => 'Porte Tagliafuoco Note',
            'estintori' => 'Estintori',
            'estintori_note' => 'Estintori Note',
            'idranti_manichetta' => 'Idranti a manichetta',
            'idranti_manichetta_note' => 'Idranti Manichetta Note',
            'idranti_colonna' => 'Idranti a colonna',
            'idranti_colonna_note' => 'Idranti Colonna Note',
            'naspi' => 'Naspi',
            'naspi_note' => 'Naspi Note',
            'attacco_vvf' => 'Attacco VVF',
            'attacco_vvf_note' => 'Attacco Vvf Note',
            'divieto_parcheggio' => 'Divieto parcheggio davanti uscite',
            'divieto_parcheggio_note' => 'Divieto Parcheggio Note',
            'passo_uomo' => 'Procedere a passo d\'uomo - SOLO SE PREVISTA AUTORIMESSA - ',
            'passo_uomo_note' => 'Passo Uomo Note',
            'uscita_veicoli' => 'Uscita autoveicoli - SOLO SE PREVISTA AUTORIMESSA - ',
            'uscita_veicoli_note' => 'Uscita Veicoli Note',
            'divieto_accesso' => 'Divieto di accesso',
            'divieto_accesso_note' => 'Divieto Accesso Note',
            'planimetrie' => 'Sono presenti e correttamente posate le PLANIMETRIE di Emergenza ?',
            'planimetrie_note' => 'Planimetrie Note',
            'informativa_emergenza' => '&Egrave; presente l\'informtiva Emergenza e evaquazione?',
            'informativa_emergenza_note' => 'Informativa Emergenza Note',
            'copia_cpi' => 'La Direzione ha copia del CPI Certificato di prevenzione incendi o di DIA/SCIA sostituitva intestata alla societ&agrave; proprietaria dello stabile?',
            'copia_cpi_note' => 'Copia Cpi Note',
            'impianto_elettrico' => 'IMPIANTO ELETTRICO',
            'impianto_elettrico_note' => 'Impianto Elettrico Note',
            'impianto_idrico' => 'IMPIANTO IDRICO',
            'impianto_idrico_note' => 'Impianto Idrico Note',
            'impianto_termico' => 'IMPIANTO TERMICO',
            'impianto_termico_note' => 'Impianto Termico Note',
            'impianto_condizionamento' => 'IMPIANTO DI CONDIZIONAMENTO',
            'impianto_condizionamento_note' => 'Impianto Condizionamento Note',
            'impianto_antincendio' => 'IMPIANTO ANTINCENDIO',
            'impianto_antincendio_note' => 'Impianto Antincendio Note',
            'impianto_fumi' => 'IMPIANTO RILEVAZIONE FUMI',
            'impianto_fumi_note' => 'Impianto Fumi Note',
            'denuncia_messaterra' => 'DENUNCIA DI IMPIANTO MESSA A TERRA',
            'denuncia_messaterra_note' => 'Denuncia Messaterra Note',
            'verifica_messaterra' => 'VERIFICA BIENNALE IMPIANTO DI MESSA A TERRA - indicare data ultima verifica - ',
            'verifica_messaterra_note' => 'Verifica Messaterra Note',
            'verifica_ascensore' => 'VERIFICA ASCENSORI - indicare data ultima verifica - ',
            'verifica_ascensore_note' => 'Verifica Ascensore Note',
            'verifica_funi' => 'VERIFICA TRIMESTRALE FUNI E CATENE PER GLI ASCENSORI - indicare data ultima verifica - ',
            'verifica_funi_note' => 'Verifica Funi Note',
            'caldaia_conforme' => 'CONFORMIT&Agrave; CALDAIA',
            'caldaia_conforme_note' => 'Caldaia Conforme Note',
            'autorizzazione_alberghiera' => 'Autorizzazione sanitaria alberghiera',
            'autorizzazione_alberghiera_note' => 'Autorizzazione Alberghiera Note',
            'autorizzazione_sanitaria' => 'Autorizzazione sanitaria somministrazione alimenti - se prevista - ',
            'autorizzazione_sanitaria_note' => 'Autorizzazione Sanitaria Note',
            'autorizzazione_piscina' => 'Autorizzazione sanitaria piscina - se prevista - ',
            'autorizzazione_piscina_note' => 'Autorizzazione Piscina Note',
            'contratto_man_antincendio' => 'Contratto manutenzione impianto antincendio',
            'contratto_man_antincendio_note' => 'Contratto Man Antincendio Note',
            'contratto_man_ascensori' => 'Contratto di manutenzione ascensori',
            'contratto_man_ascensori_note' => 'Contratto Man Ascensori Note',
            'contratto_man_termico' => 'Contratto di manutenzione impianto termico e uta (se presente)',
            'contratto_man_termico_note' => 'Contratto Man Termico Note',
            'contratto_man_elettrico' => 'Contratto di manutenzione impianto elettrico',
            'contratto_man_elettrico_note' => 'Contratto Man Elettrico Note',
            'contratto_man_idrico' => 'Contratto di manutenzione impianto idrico',
            'contratto_man_idrico_note' => 'Contratto Man Idrico Note',
            'presenza_dvr' => '&Egrave; PRESENTE IL DVR DOCUMENTO VALUTAZIONE DEI RISCHI DI DOC SPECIFICO PER MANSIONE?',
            'presenza_dvr_note' => 'Presenza Dvr Note',
            'presenza_dvr_specifico' => '&Egrave; PRESENTE IL DVR SPECIFICO PER UNIT&Agrave; OPERATIVA?',
            'presenza_dvr_specifico_note' => 'Presenza Dvr Note',
            'rischio_chimico' => '&Egrave; PRESENTE LA VALUTAZIONE DEL RISCHIO CHIMICO?',
            'rischio_chimico_note' => 'Rischio Chimico Note',
            'rischio_incendio' => '&Egrave; PRESENTE LA VALUTAZIONE DEL RISCHIO INCENDIO?',
            'rischio_incendio_note' => 'Rischio Incendo Note',
            'rischio_rumore' => '&Egrave; PRESENTE LA VALUTAZIONE DEL RISCHIO RUMORE? ',
            'rischio_rumore_note' => 'Rischio Rumore Note',
            'rischio_stress' => '&Egrave; PRESENTE LA VALUTAZIONE DEL RISCHIO STRESS DA LAVORO CORRELATO?',
            'rischio_stress_note' => 'Rischio Stress Note',
            'rischio_vibrazioni' => '&Egrave; PRESENTE LA VALUTAZIONE DEI RISCHIO VIBRAZIONI?',
            'rischio_vibrazioni_note' => 'Rischio Vibrazioni Note',
            'presenza_patentini' => 'IN CASO DI UTILIZZO DI MEZZI DI MOVIMENTAZIONE TERRA O AGRICOLI SONO PRESENTI I RELATIVI PATENTINI?',
            'presenza_patentini_note' => 'Presenza Patentini Note',
            'documenti_rischi' => 'TUTTI I DOCUMENTI RELATIVI ALLA VALUTAZIONE DEI RISCHI SPECIFICI SONO REGOLARMENTE CONTROFIRMATI DA RSPP - DATORE DI LAVORO - MEDICO COMPETENTE  E RLS DI D.O.C. s.c.s.',
            'documenti_rischi_note' => 'Documenti Rischi Note',
            'piano_emergenza' => '&Egrave; PRESENTE IL PIANO DI EMERGENZA CON RELATIVE PLANIMATRIE?',
            'piano_emergenza_note' => 'Piano Emergenza Note',
            'planimetrie_esposte' => 'LE PLANIMETRIE SONO CORRETTAMENTE ESPOSTE NEI CORRIDOI E NELLE AREE COMUNI?',
            'planimetrie_esposte_note' => 'Planimetrie Esposte Note',
            'presenza_verbale_giornaliero' => '&Egrave; PRESENTE E CORRETTAMENTE COMPILATO IL VERBALE GIORNALIERO SICUREZZA MD 01_56 ? - SOLO PER UNIT&Agrave; CON RISTORAZIONE -',
            'presenza_verbale_giornaliero_note' => 'Presenza Verbale Giornaliero Note',
            'presenza_manuale_hse' => '&Egrave; PRESENTE IL MANUALE HSE IS 20-01 MANUALE AUTCONTROLLO RISCHIO LEGIONELLA?',
            'presenza_manuale_hse_note' => 'Presenza Manuale Hse Note',
            'firme_responsabili' => 'SONO PRESENTI LE FIRME DEL RESPONSABILE DELL\'AUTOCONTROLLO E DELL\'ADDETTO AL CAMPIONAMENTO E DEL RESPONSABILI DEI FLUSSAGGI ?',
            'firme_responsabili_note' => 'Firme Responsabili Note',
            'ditta_consulente' => 'ALL\'INTERNO DEL MANUALE &Egrave; CORRETTAMENTE NOMINATA LA DITTA CONSULENTE RESPONSABILE DEI CAMPIONAMENTI ESTERNI? - indicare il laboratorio di Analisi contrattualizzato -',
            'ditta_consulente_note' => 'Ditta Consulente Note',
            'certificato_prelievo' => '&Egrave; STATO RILASCIATO DALLA DITTA CONSULENTE UN CERTIFICATO DI PREVIEVO CON INDICAZIONE DELLA DATA? - INDICARE DATA ULTIMO PRELIEVO',
            'certificato_prelievo_note' => 'Certificato Prelievo Note',
            'modulo_sch' => '&Egrave; CORRETTAMENTE COMPILATO LA SCH 01 MODULO REGISTRAZIONE FLUSSAGGI? - INDICARE DATA ULTIMA REGISTRAZIONE',
            'modulo_sch_note' => 'Modulo Sch Note',
            'presenza_termometro' => '&Egrave; PRESENTE E FUNZIONANTE IL TERMOMETRO PER LE REGISTRAZIONI DELLE TEMPERATURE?',
            'presenza_termometro_note' => 'Presenza Termometro Note',
            'acqua_calda' => 'LA TEMPERATURA CAMPIONATA IN FASE DI EROGAZIONE DELL\'ACQUA CALDA SANITARIA &Egrave; CONFORME?  <b>(MAGGIORE A 50&deg;C)</b>',
            'acqua_calda_note' => 'Acqua Calda Note',
            'acqua_fredda' => 'LA TEMPERATURA CAMPIONATA IN FASE DI EROGAZIONE DELL\'ACQUA FREDDA SANITARIA &Egrave; CONFORME?  <b>(INFERIORE A 20&deg;C)</b>',
            'acqua_fredda_note' => 'Acqua Fredda Note',
            'usura_giunti' => 'VERIFICARE LA NON USURA DI GIUNTI, FINALI DELLE DOCCE, RUBINETTI',
            'usura_giunti_note' => 'Usura Giunti Note',
            'diffusori_doccia' => 'I DIFFUSORI DELLE DOCCE SONO PRIVI DI INCROSTAZIONI',
            'diffusori_doccia_note' => 'Diffusori Doccia Note',
            'numero_non_conformita' => 'Numero Non Conformita',
            'note_1' => 'Note',
            'osservazioni_1' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
            'note_2' => 'Note',
            'osservazioni_2' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
            'note_3' => 'Note',
            'osservazioni_3' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
            'note_4' => 'Note',
            'osservazioni_4' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
            'note_5' => 'Note',
            'osservazioni_5' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
            'note_6' => 'Note',
            'osservazioni_6' => 'Osservazioni del Gestore ed eventuali Azioni Correttive adottate/adottabili',
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
        $criteria->compare('presenza_documento', $this->presenza_documento, true);
        $criteria->compare('presenza_documento_note', $this->presenza_documento_note, true);
        $criteria->compare('cartellino', $this->cartellino, true);
        $criteria->compare('cartellino_note', $this->cartellino_note, true);
        $criteria->compare('presenza_fascicoli', $this->presenza_fascicoli, true);
        $criteria->compare('presenza_fascicoli_note', $this->presenza_fascicoli_note, true);
        $criteria->compare('presenza_verbale', $this->presenza_verbale, true);
        $criteria->compare('presenza_verbale_note', $this->presenza_verbale_note, true);
        $criteria->compare('presenza_dpi', $this->presenza_dpi, true);
        $criteria->compare('presenza_dpi_note', $this->presenza_dpi_note, true);
        $criteria->compare('dpi_indossati', $this->dpi_indossati, true);
        $criteria->compare('dpi_indossati_note', $this->dpi_indossati_note, true);
        $criteria->compare('presenza_lettera_incarico', $this->presenza_lettera_incarico, true);
        $criteria->compare('presenza_lettera_incarico_note', $this->presenza_lettera_incarico_note, true);
        $criteria->compare('presenza_incaricati', $this->presenza_incaricati, true);
        $criteria->compare('presenza_incaricati_note', $this->presenza_incaricati_note, true);
        $criteria->compare('preposti_sicurezza', $this->preposti_sicurezza, true);
        $criteria->compare('preposti_sicurezza_note', $this->preposti_sicurezza_note, true);
        $criteria->compare('addetti_sicurezza', $this->addetti_sicurezza, true);
        $criteria->compare('addetti_sicurezza_note', $this->addetti_sicurezza_note, true);
        $criteria->compare('copie_attestati', $this->copie_attestati, true);
        $criteria->compare('copie_attestati_note', $this->copie_attestati_note, true);
        $criteria->compare('aggiornamenti_attestati', $this->aggiornamenti_attestati, true);
        $criteria->compare('aggiornamenti_attestati_note', $this->aggiornamenti_attestati_note, true);
        $criteria->compare('incaricati_primo_soccorso', $this->incaricati_primo_soccorso, true);
        $criteria->compare('incaricati_primo_soccorso_note', $this->incaricati_primo_soccorso_note, true);
        $criteria->compare('letter_primo_soccorso', $this->letter_primo_soccorso, true);
        $criteria->compare('letter_primo_soccorso_note', $this->letter_primo_soccorso_note, true);
        $criteria->compare('attestati_formazione', $this->attestati_formazione, true);
        $criteria->compare('attestati_formazione_note', $this->attestati_formazione_note, true);
        $criteria->compare('prove_emergenza', $this->prove_emergenza, true);
        $criteria->compare('prove_emergenza_note', $this->prove_emergenza_note, true);
        $criteria->compare('verbale_prove_emergenza', $this->verbale_prove_emergenza, true);
        $criteria->compare('verbale_prove_emergenza_note', $this->verbale_prove_emergenza_note, true);
        $criteria->compare('registro_accessi', $this->registro_accessi, true);
        $criteria->compare('registro_accessi_note', $this->registro_accessi_note, true);
        $criteria->compare('informativa_rischi', $this->informativa_rischi, true);
        $criteria->compare('informativa_rischi_note', $this->informativa_rischi_note, true);
        $criteria->compare('divieto_fumo', $this->divieto_fumo, true);
        $criteria->compare('divieto_fumo_note', $this->divieto_fumo_note, true);
        $criteria->compare('rischio_elettrico', $this->rischio_elettrico, true);
        $criteria->compare('rischio_elettrico_note', $this->rischio_elettrico_note, true);
        $criteria->compare('divieto_acqua', $this->divieto_acqua, true);
        $criteria->compare('divieto_acqua_note', $this->divieto_acqua_note, true);
        $criteria->compare('punto_raccolta', $this->punto_raccolta, true);
        $criteria->compare('punto_raccolta_note', $this->punto_raccolta_note, true);
        $criteria->compare('pulsante_allarme', $this->pulsante_allarme, true);
        $criteria->compare('pulsante_allarme_note', $this->pulsante_allarme_note, true);
        $criteria->compare('pulsante_sgancio', $this->pulsante_sgancio, true);
        $criteria->compare('pulsante_sgancio_note', $this->pulsante_sgancio_note, true);
        $criteria->compare('uscite_emergenza', $this->uscite_emergenza, true);
        $criteria->compare('uscite_emergenza_note', $this->uscite_emergenza_note, true);
        $criteria->compare('porte_tagliafuoco', $this->porte_tagliafuoco, true);
        $criteria->compare('porte_tagliafuoco_note', $this->porte_tagliafuoco_note, true);
        $criteria->compare('estintori', $this->estintori, true);
        $criteria->compare('estintori_note', $this->estintori_note, true);
        $criteria->compare('idranti_manichetta', $this->idranti_manichetta, true);
        $criteria->compare('idranti_manichetta_note', $this->idranti_manichetta_note, true);
        $criteria->compare('idranti_colonna', $this->idranti_colonna, true);
        $criteria->compare('idranti_colonna_note', $this->idranti_colonna_note, true);
        $criteria->compare('naspi', $this->naspi, true);
        $criteria->compare('naspi_note', $this->naspi_note, true);
        $criteria->compare('attacco_vvf', $this->attacco_vvf, true);
        $criteria->compare('attacco_vvf_note', $this->attacco_vvf_note, true);
        $criteria->compare('divieto_parcheggio', $this->divieto_parcheggio, true);
        $criteria->compare('divieto_parcheggio_note', $this->divieto_parcheggio_note, true);
        $criteria->compare('passo_uomo', $this->passo_uomo, true);
        $criteria->compare('passo_uomo_note', $this->passo_uomo_note, true);
        $criteria->compare('uscita_veicoli', $this->uscita_veicoli, true);
        $criteria->compare('uscita_veicoli_note', $this->uscita_veicoli_note, true);
        $criteria->compare('divieto_accesso', $this->divieto_accesso, true);
        $criteria->compare('divieto_accesso_note', $this->divieto_accesso_note, true);
        $criteria->compare('planimetrie', $this->planimetrie, true);
        $criteria->compare('planimetrie_note', $this->planimetrie_note, true);
        $criteria->compare('informativa_emergenza', $this->informativa_emergenza, true);
        $criteria->compare('informativa_emergenza_note', $this->informativa_emergenza_note, true);
        $criteria->compare('copia_cpi', $this->copia_cpi, true);
        $criteria->compare('copia_cpi_note', $this->copia_cpi_note, true);
        $criteria->compare('impianto_elettrico', $this->impianto_elettrico, true);
        $criteria->compare('impianto_elettrico_note', $this->impianto_elettrico_note, true);
        $criteria->compare('impianto_idrico', $this->impianto_idrico, true);
        $criteria->compare('impianto_idrico_note', $this->impianto_idrico_note, true);
        $criteria->compare('impianto_termico', $this->impianto_termico, true);
        $criteria->compare('impianto_termico_note', $this->impianto_termico_note, true);
        $criteria->compare('impianto_condizionamento', $this->impianto_condizionamento, true);
        $criteria->compare('impianto_condizionamento_note', $this->impianto_condizionamento_note, true);
        $criteria->compare('impianto_antincendio', $this->impianto_antincendio, true);
        $criteria->compare('impianto_antincendio_note', $this->impianto_antincendio_note, true);
        $criteria->compare('impianto_fumi', $this->impianto_fumi, true);
        $criteria->compare('impianto_fumi_note', $this->impianto_fumi_note, true);
        $criteria->compare('denuncia_messaterra', $this->denuncia_messaterra, true);
        $criteria->compare('denuncia_messaterra_note', $this->denuncia_messaterra_note, true);
        $criteria->compare('verifica_messaterra', $this->verifica_messaterra, true);
        $criteria->compare('verifica_messaterra_note', $this->verifica_messaterra_note, true);
        $criteria->compare('verifica_ascensore', $this->verifica_ascensore, true);
        $criteria->compare('verifica_ascensore_note', $this->verifica_ascensore_note, true);
        $criteria->compare('verifica_funi', $this->verifica_funi, true);
        $criteria->compare('verifica_funi_note', $this->verifica_funi_note, true);
        $criteria->compare('caldaia_conforme', $this->caldaia_conforme, true);
        $criteria->compare('caldaia_conforme_note', $this->caldaia_conforme_note, true);
        $criteria->compare('autorizzazione_alberghiera', $this->autorizzazione_alberghiera, true);
        $criteria->compare('autorizzazione_alberghiera_note', $this->autorizzazione_alberghiera_note, true);
        $criteria->compare('autorizzazione_sanitaria', $this->autorizzazione_sanitaria, true);
        $criteria->compare('autorizzazione_sanitaria_note', $this->autorizzazione_sanitaria_note, true);
        $criteria->compare('autorizzazione_piscina', $this->autorizzazione_piscina, true);
        $criteria->compare('autorizzazione_piscina_note', $this->autorizzazione_piscina_note, true);
        $criteria->compare('contratto_man_antincendio', $this->contratto_man_antincendio, true);
        $criteria->compare('contratto_man_antincendio_note', $this->contratto_man_antincendio_note, true);
        $criteria->compare('contratto_man_ascensori', $this->contratto_man_ascensori, true);
        $criteria->compare('contratto_man_ascensori_note', $this->contratto_man_ascensori_note, true);
        $criteria->compare('contratto_man_termico', $this->contratto_man_termico, true);
        $criteria->compare('contratto_man_termico_note', $this->contratto_man_termico_note, true);
        $criteria->compare('contratto_man_elettrico', $this->contratto_man_elettrico, true);
        $criteria->compare('contratto_man_elettrico_note', $this->contratto_man_elettrico_note, true);
        $criteria->compare('contratto_man_idrico', $this->contratto_man_idrico, true);
        $criteria->compare('contratto_man_idrico_note', $this->contratto_man_idrico_note, true);
        $criteria->compare('presenza_dvr', $this->presenza_dvr, true);
        $criteria->compare('presenza_dvr_note', $this->presenza_dvr_note, true);
        $criteria->compare('presenza_dvr_specifico', $this->presenza_dvr_specifico, true);
        $criteria->compare('presenza_dvr_specifco_note', $this->presenza_dvr_specifico_note, true);

        $criteria->compare('rischio_chimico', $this->rischio_chimico, true);
        $criteria->compare('rischio_chimico_note', $this->rischio_chimico_note, true);
        $criteria->compare('rischio_incendio', $this->rischio_incendio, true);
        $criteria->compare('rischio_incendio_note', $this->rischio_incendio_note, true);
        $criteria->compare('rischio_rumore', $this->rischio_rumore, true);
        $criteria->compare('rischio_rumore_note', $this->rischio_rumore_note, true);
        $criteria->compare('rischio_stress', $this->rischio_stress, true);
        $criteria->compare('rischio_stress_note', $this->rischio_stress_note, true);
        $criteria->compare('rischio_vibrazioni', $this->rischio_vibrazioni, true);
        $criteria->compare('rischio_vibrazioni_note', $this->rischio_vibrazioni_note, true);
        $criteria->compare('presenza_patentini', $this->presenza_patentini, true);
        $criteria->compare('presenza_patentini_note', $this->presenza_patentini_note, true);
        $criteria->compare('documenti_rischi', $this->documenti_rischi, true);
        $criteria->compare('documenti_rischi_note', $this->documenti_rischi_note, true);
        $criteria->compare('piano_emergenza', $this->piano_emergenza, true);
        $criteria->compare('piano_emergenza_note', $this->piano_emergenza_note, true);
        $criteria->compare('planimetrie_esposte', $this->planimetrie_esposte, true);
        $criteria->compare('planimetrie_esposte_note', $this->planimetrie_esposte_note, true);
        $criteria->compare('presenza_verbale_giornaliero', $this->presenza_verbale_giornaliero, true);
        $criteria->compare('presenza_verbale_giornaliero_note', $this->presenza_verbale_giornaliero_note, true);
        $criteria->compare('presenza_manuale_hse', $this->presenza_manuale_hse, true);
        $criteria->compare('presenza_manuale_hse_note', $this->presenza_manuale_hse_note, true);
        $criteria->compare('firme_responsabili', $this->firme_responsabili, true);
        $criteria->compare('firme_responsabili_note', $this->firme_responsabili_note, true);
        $criteria->compare('ditta_consulente', $this->ditta_consulente, true);
        $criteria->compare('ditta_consulente_note', $this->ditta_consulente_note, true);
        $criteria->compare('certificato_prelievo', $this->certificato_prelievo, true);
        $criteria->compare('certificato_prelievo_note', $this->certificato_prelievo_note, true);
        $criteria->compare('modulo_sch', $this->modulo_sch, true);
        $criteria->compare('modulo_sch_note', $this->modulo_sch_note, true);
        $criteria->compare('presenza_termometro', $this->presenza_termometro, true);
        $criteria->compare('presenza_termometro_note', $this->presenza_termometro_note, true);
        $criteria->compare('acqua_calda', $this->acqua_calda, true);
        $criteria->compare('acqua_calda_note', $this->acqua_calda_note, true);
        $criteria->compare('acqua_fredda', $this->acqua_fredda, true);
        $criteria->compare('acqua_fredda_note', $this->acqua_fredda_note, true);
        $criteria->compare('usura_giunti', $this->usura_giunti, true);
        $criteria->compare('usura_giunti_note', $this->usura_giunti_note, true);
        $criteria->compare('diffusori_doccia', $this->diffusori_doccia, true);
        $criteria->compare('diffusori_doccia_note', $this->diffusori_doccia_note, true);
        $criteria->compare('numero_non_conformita', $this->numero_non_conformita);
        $criteria->compare('note_1', $this->note_1, true);
        $criteria->compare('note_2', $this->note_2, true);
        $criteria->compare('note_3', $this->note_3, true);
        $criteria->compare('note_4', $this->note_4, true);
        $criteria->compare('note_5', $this->note_5, true);
        $criteria->compare('note_6', $this->note_6, true);
        $criteria->compare('osservazioni_1', $this->osservazioni_1, true);
        $criteria->compare('osservazioni_2', $this->osservazioni_2, true);
        $criteria->compare('osservazioni_3', $this->osservazioni_3, true);
        $criteria->compare('osservazioni_4', $this->osservazioni_4, true);
        $criteria->compare('osservazioni_5', $this->osservazioni_5, true);
        $criteria->compare('osservazioni_6', $this->osservazioni_6, true);

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

    public function getNCPdf($model) {

        $totale = 0;
        $field = $this->getFields();
        foreach ($field AS $id => $val)
            $totale += count($field[$id]);

        $color = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($model->numero_non_conformita, $totale));
        return "<span class='nc' >" . $model->numero_non_conformita . "/" . $totale . " - <span class='nc-" . $color . "' >" . Yii::app()->MyUtils->getPercent($model->numero_non_conformita, $totale) . "% </span></span>";
    }

    public function getNC($data, $id) {

        $totale = 0;
        $field = $this->getFields();
        foreach ($field AS $id => $val)
            $totale += count($field[$id]);

        $color = Yii::app()->MyUtils->getColor(Yii::app()->MyUtils->getPercent($data->numero_non_conformita, $totale));
        return "<span class='nc' >" . $data->numero_non_conformita . "/" . $totale . " - <span class='nc-" . $color . "' >" . Yii::app()->MyUtils->getPercent($data->numero_non_conformita, $totale) . "% </span></span>";
    }

    public function getValutazione($data, $id) {
        return $this->selectTipologie[$data->tipo_valutazione];
    }

    public function getTitle($x) {
        $title = array(
            1 => "1. PERSONALE (GESTIONE DIRETTA - INDIRETTA - IN APPALTO)",
            2 => "2. PROVE DI EVACUAZIONE (GESTINE DIRETTA - INDIRETTA - IN APPALTO)",
            3 => "3. CARTELLONISTICA SICUREZZA E ANTICEDIO ",
            4 => "4. REQUISITI STRUTTURA  DOC SCS (SOLO GESTIONE DIRETTA)",
            5 => "5. SISTEMA DOCUMENTALE  D.O.C. S.C.S. (SOLO GESTIONE DIRETTA)",
            6 => "6. MONITORAGGIO RISCHIO LEGIONELLA (SOLO GESTIONE DIRETTA)",
        );


        return $title[$x];
    }

    public function getFields() {

        $field = array(
            'sezione_1' => array('presenza_documento', 'cartellino', 'presenza_fascicoli', 'presenza_verbale', 'presenza_dpi', 'dpi_indossati', 'presenza_lettera_incarico', 'presenza_incaricati', 'preposti_sicurezza', 'addetti_sicurezza', 'copie_attestati', 'aggiornamenti_attestati', 'incaricati_primo_soccorso', 'letter_primo_soccorso', 'attestati_formazione'),
            'sezione_2' => array('prove_emergenza', 'verbale_prove_emergenza', 'registro_accessi', 'informativa_rischi'),
            'sezione_3' => array('divieto_fumo', 'rischio_elettrico', 'divieto_acqua', 'punto_raccolta', 'pulsante_allarme', 'pulsante_sgancio', 'uscite_emergenza', 'porte_tagliafuoco', 'estintori', 'idranti_manichetta', 'idranti_colonna', 'naspi', 'attacco_vvf', 'divieto_parcheggio', 'passo_uomo', 'uscita_veicoli', 'divieto_accesso', 'planimetrie', 'informativa_emergenza'),
            'sezione_4' => array('copia_cpi', 'impianto_elettrico', 'impianto_idrico', 'impianto_termico', 'impianto_condizionamento', 'impianto_antincendio', 'impianto_fumi', 'denuncia_messaterra', 'verifica_messaterra', 'verifica_ascensore', 'verifica_funi', 'caldaia_conforme', 'autorizzazione_alberghiera', 'autorizzazione_sanitaria', 'autorizzazione_piscina', 'contratto_man_antincendio', 'contratto_man_ascensori', 'contratto_man_termico', 'contratto_man_elettrico', 'contratto_man_idrico'),
            'sezione_5' => array('presenza_dvr', 'presenza_dvr_specifico', 'rischio_chimico', 'rischio_incendio', 'rischio_rumore', 'rischio_stress', 'rischio_vibrazioni', 'presenza_patentini', 'documenti_rischi', 'piano_emergenza', 'planimetrie_esposte', 'presenza_verbale_giornaliero'),
            'sezione_6' => array('presenza_manuale_hse', 'firme_responsabili', 'ditta_consulente', 'certificato_prelievo', 'modulo_sch', 'presenza_termometro', 'acqua_calda', 'acqua_fredda', 'usura_giunti', 'diffusori_doccia')
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
                        $query .="(NOW(),NOW(),'" . $this->unita_operativa . "','" . Yii::app()->user->getId() . "','" . date("Y") . "','" . $this->id_verifica . "','" . $val[$x] . "','" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "' ,'".addslashes($user['nome'])."','".addslashes($user['cognome'])."' ,'22')";
                        if (Yii::app()->db->createCommand($query)->execute()) {
                            $LID = Yii::app()->db->lastInsertID;
                            $codice = Yii::app()->MyUtils->generaCodice($this->unita_operativa, $nc->tableName(), $LID);
                            Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET codice ='" . $codice . "' WHERE id ='" . $LID . "'  ")->execute();
                        }
                    } else {
                        Yii::app()->db->createCommand("UPDATE " . $nc->tableName() . " SET  data = NOW() , data_nc = NOW() , id_utente ='" . Yii::app()->user->getId() . "' , id_verifica ='" . $this->id_verifica . "' , tipo_verifica='" . $val[$x] . "' , descrizione ='" . addslashes(html_entity_decode($label[$val[$x]], ENT_QUOTES, 'UTF-8')) . ": " . addslashes($this->$note) . "'   WHERE id ='" . $isNC . "'  ")->execute();
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