-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 10, 2026 at 11:28 AM
-- Server version: 11.4.12-MariaDB-ubu2404
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qualita_1_sito`
--

-- --------------------------------------------------------

--
-- Table structure for table `0_ip`
--

CREATE TABLE `0_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `number` int(11) NOT NULL,
  `black` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `0_preiscrizioni`
--

CREATE TABLE `0_preiscrizioni` (
  `id` int(11) NOT NULL,
  `id_refer` int(11) DEFAULT NULL,
  `refer` enum('SH','CA','FO') DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `participant_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `questionnaire_version_id` int(10) UNSIGNED NOT NULL,
  `value` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ca_preiscrizioni`
--

CREATE TABLE `ca_preiscrizioni` (
  `id` int(11) NOT NULL,
  `id_iscrizione` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `luogo_nascita` varchar(30) DEFAULT NULL,
  `nazionalita` int(11) DEFAULT NULL,
  `sesso` enum('M','F') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cellulare` varchar(20) DEFAULT NULL,
  `occupazione` int(11) DEFAULT NULL,
  `prima_volta` enum('Y','N') DEFAULT NULL,
  `conoscenza` int(11) DEFAULT NULL,
  `formula` int(11) DEFAULT NULL,
  `campus` int(11) DEFAULT NULL,
  `housing` int(11) DEFAULT NULL,
  `coabitazione` varchar(255) NOT NULL,
  `data_in` date NOT NULL,
  `data_out` date NOT NULL,
  `privacy` enum('Y','N') DEFAULT NULL,
  `mailing` enum('Y','N') DEFAULT NULL,
  `note` text NOT NULL,
  `data_insert` datetime NOT NULL,
  `lang` varchar(6) NOT NULL DEFAULT 'it-IT',
  `anno` int(11) NOT NULL,
  `refer` enum('S','P') NOT NULL DEFAULT 'S',
  `facoltaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cm_preiscrizioni`
--

CREATE TABLE `cm_preiscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `luogo_nascita` varchar(50) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `residenza` varchar(100) DEFAULT NULL,
  `indirizzo` varchar(150) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `codicefiscale` varchar(11) DEFAULT NULL,
  `cap` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cellulare` varchar(16) DEFAULT NULL,
  `altro_genitore` enum('Y','N') DEFAULT NULL,
  `altro_nome` varchar(50) DEFAULT NULL,
  `altro_cognome` varchar(50) DEFAULT NULL,
  `altro_luogo_nascita` varchar(50) DEFAULT NULL,
  `altro_data_nascita` date DEFAULT NULL,
  `altro_residenza` varchar(150) DEFAULT NULL,
  `altro_indirizzo` varchar(150) DEFAULT NULL,
  `altro_numero` int(11) DEFAULT NULL,
  `altro_codicefiscale` varchar(11) DEFAULT NULL,
  `altro_cap` int(11) DEFAULT NULL,
  `altro_email` varchar(150) DEFAULT NULL,
  `altro_cellulare` varchar(16) DEFAULT NULL,
  `documento` enum('PS','CI','PA') DEFAULT NULL,
  `documento_numero` varchar(50) DEFAULT NULL,
  `documento_rilascio` varchar(50) DEFAULT NULL,
  `data_rilascio` date DEFAULT NULL,
  `nome_figlio` varchar(50) DEFAULT NULL,
  `cognome_figlio` varchar(50) DEFAULT NULL,
  `luogo_nascita_figlio` varchar(50) DEFAULT NULL,
  `data_nascita_figlio` date DEFAULT NULL,
  `tessera_sanitaria_figlio` varchar(50) DEFAULT NULL,
  `codice_fiscale_figlio` varchar(11) DEFAULT NULL,
  `scuola` varchar(150) DEFAULT NULL,
  `classe` varchar(50) DEFAULT NULL,
  `sezione` varchar(50) DEFAULT NULL,
  `utente_milano` enum('Y','N') DEFAULT NULL,
  `dieta_sanitaria` enum('Y','N') DEFAULT NULL,
  `dieta_sanitaria_dettaglio` varchar(50) DEFAULT NULL,
  `dieta_religiosa` enum('Y','N') DEFAULT NULL,
  `dieta_religiosa_dettaglio` varchar(50) DEFAULT NULL,
  `insegnante_sostegno` enum('Y','N') DEFAULT NULL,
  `disabile` enum('Y','N') DEFAULT NULL,
  `disabile_dettaglio` varchar(150) DEFAULT NULL,
  `educatore_individuale` enum('Y','N') DEFAULT NULL,
  `casa_vacanza` int(11) DEFAULT NULL,
  `informativa` enum('Y','N') DEFAULT NULL,
  `privacy` enum('Y','N') DEFAULT NULL,
  `mailing` enum('Y','N') DEFAULT NULL,
  `data_ins` date DEFAULT NULL,
  `anno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comunicazioni`
--

CREATE TABLE `comunicazioni` (
  `id` int(11) NOT NULL,
  `tipo` enum('M','S','P') DEFAULT NULL,
  `previsti` int(11) NOT NULL,
  `quanti` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `ruolo` int(11) NOT NULL,
  `tutti` enum('Y','N') DEFAULT NULL,
  `sender` varchar(255) NOT NULL,
  `oggetto` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `messaggio_sms` varchar(255) NOT NULL,
  `messaggio_push` varchar(255) NOT NULL,
  `messaggio_email` text NOT NULL,
  `data_invio` datetime NOT NULL,
  `risposta` text NOT NULL,
  `stato` enum('Y','N') DEFAULT NULL,
  `struttura` int(11) NOT NULL,
  `query` varchar(255) NOT NULL,
  `refer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comunicazioni_tipologie`
--

CREATE TABLE `comunicazioni_tipologie` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `chiave` varchar(50) NOT NULL,
  `valore` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_azionicorrettive`
--

CREATE TABLE `db_azionicorrettive` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `data_az` date DEFAULT NULL,
  `data_aggiornamento` datetime DEFAULT NULL,
  `tipo_azione` int(11) NOT NULL,
  `societa` int(11) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `codice_riferimento` varchar(20) NOT NULL,
  `funzione` int(11) NOT NULL,
  `tipologia` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `trattamento` text NOT NULL,
  `allegato` varchar(50) NOT NULL,
  `verifica_efficacia` char(1) NOT NULL,
  `anno` int(11) NOT NULL,
  `chiusura` int(11) DEFAULT NULL,
  `approvato` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_formazione`
--

CREATE TABLE `db_formazione` (
  `id` int(11) NOT NULL,
  `titolo_id` int(11) DEFAULT NULL,
  `titolo` varchar(255) NOT NULL,
  `data` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `ora` varchar(5) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_gruppi` varchar(100) DEFAULT NULL,
  `invio_email` enum('Y','N') DEFAULT NULL,
  `invio_sms` enum('Y','N') DEFAULT NULL,
  `giorni_invio_sms` int(11) NOT NULL,
  `giorni_invio_email` int(11) NOT NULL,
  `anno` varchar(4) NOT NULL,
  `descrizione` text NOT NULL,
  `tipo_accesso` enum('P','O') NOT NULL,
  `link_accesso` varchar(255) NOT NULL,
  `address_accesso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_nonconforme`
--

CREATE TABLE `db_nonconforme` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `data_nc` date DEFAULT NULL,
  `data_aggiornamento` date DEFAULT NULL,
  `societa` int(11) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `funzione` int(11) NOT NULL,
  `tipologia` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `trattamento` text NOT NULL,
  `trattamento_accettato` enum('Y','N') DEFAULT NULL,
  `trattamento_data` datetime DEFAULT NULL,
  `trattamento_note` text NOT NULL,
  `responsabile` int(11) NOT NULL,
  `codice` varchar(20) NOT NULL,
  `chiusura` int(11) DEFAULT NULL,
  `allegato` varchar(50) NOT NULL,
  `id_compilatore` int(11) NOT NULL,
  `id_reclamo` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `verificaQuestionId` int(10) UNSIGNED DEFAULT NULL,
  `tipo_verifica` varchar(150) DEFAULT NULL,
  `apertura_ac` enum('Y','N') DEFAULT NULL,
  `approvato` enum('Y','N') DEFAULT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_reclami`
--

CREATE TABLE `db_reclami` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL DEFAULT 0,
  `codice` varchar(15) NOT NULL,
  `canale` int(11) NOT NULL,
  `canale_altro` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `tipologia` int(11) NOT NULL,
  `tipologia_altro` varchar(255) NOT NULL,
  `nome_compilatore` varchar(255) NOT NULL,
  `cognome_compilatore` varchar(255) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `societa` int(11) NOT NULL,
  `funzione` int(11) NOT NULL,
  `descrizione` text NOT NULL,
  `motivazione` text NOT NULL,
  `allegato` varchar(255) NOT NULL,
  `data_inserimento` date NOT NULL,
  `non_conformita` enum('Y','N') DEFAULT NULL,
  `id_non_conformita` varchar(255) NOT NULL,
  `motivo_non_conformita` text NOT NULL,
  `anno` int(11) NOT NULL,
  `chiusura` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_reclami_azioni`
--

CREATE TABLE `db_reclami_azioni` (
  `id` int(11) NOT NULL,
  `id_reclamo` int(11) DEFAULT NULL,
  `unita_operativa` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `entro_il` date NOT NULL,
  `effettuata_il` date NOT NULL,
  `descrizione` text NOT NULL,
  `allegato` varchar(255) NOT NULL,
  `funzione` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche`
--

CREATE TABLE `db_verifiche` (
  `id` int(11) NOT NULL,
  `codice` varchar(100) NOT NULL,
  `dettaglio` varchar(255) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `compilatore` int(11) NOT NULL,
  `incaricato` int(11) DEFAULT NULL,
  `verifica` enum('P','S') DEFAULT NULL,
  `tipo_processo` int(11) NOT NULL,
  `tipo_verifica` tinyint(4) NOT NULL DEFAULT 0,
  `data_prevista` date DEFAULT NULL,
  `data_prevista_fine` date DEFAULT NULL,
  `data_effettiva` date DEFAULT NULL,
  `stato` varchar(10) DEFAULT NULL,
  `completa` enum('Y','N') NOT NULL DEFAULT 'N',
  `non_conformita` int(11) NOT NULL,
  `anno` varchar(4) DEFAULT NULL,
  `diario` varchar(255) NOT NULL,
  `verbale` varchar(255) NOT NULL,
  `avvisi` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL DEFAULT 0,
  `ora_inizio` time NOT NULL,
  `ora_fine` time NOT NULL,
  `data` date DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_ambientale`
--

CREATE TABLE `db_verifiche_ambientale` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `corso_formazione_ruo` enum('C','NC','NA','NR') DEFAULT NULL,
  `corso_formazione_ruo_note` varchar(255) DEFAULT NULL,
  `corso_formazione_coordinatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `corso_formazione_coordinatori_note` varchar(255) DEFAULT NULL,
  `corso_formazione_educatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `corso_formazione_educatori_note` varchar(255) DEFAULT NULL,
  `analisi_ambientale` enum('C','NC','NA','NR') DEFAULT NULL,
  `analisi_ambientale_note` varchar(255) DEFAULT NULL,
  `elenco_prescrizioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `elenco_prescrizioni_note` varchar(255) DEFAULT NULL,
  `scheda_organico` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_organico_note` varchar(255) DEFAULT NULL,
  `politica_ambientale` enum('C','NC','NA','NR') DEFAULT NULL,
  `politica_ambientale_note` varchar(255) DEFAULT NULL,
  `piano_obbiettivi` enum('C','NC','NA','NR') DEFAULT NULL,
  `piano_obbiettivi_note` varchar(255) DEFAULT NULL,
  `manuale_sga` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_sga_note` varchar(255) DEFAULT NULL,
  `requisiti_generali` enum('C','NC','NA','NR') DEFAULT NULL,
  `requisiti_generali_note` varchar(255) DEFAULT NULL,
  `leadership` enum('C','NC','NA','NR') DEFAULT NULL,
  `leadership_note` varchar(255) DEFAULT NULL,
  `organigramma` enum('C','NC','NA','NR') DEFAULT NULL,
  `organigramma_note` varchar(255) DEFAULT NULL,
  `azioni_rischi` enum('C','NC','NA','NR') DEFAULT NULL,
  `azioni_rischi_note` varchar(255) DEFAULT NULL,
  `aspetti_ambientali` enum('C','NC','NA','NR') DEFAULT NULL,
  `aspetti_ambientali_note` varchar(255) DEFAULT NULL,
  `monitor_obbiettivi` enum('C','NC','NA','NR') DEFAULT NULL,
  `monitor_obbiettivi_note` varchar(255) DEFAULT NULL,
  `rispetto_obblighi` enum('C','NC','NA','NR') DEFAULT NULL,
  `rispetto_obblighi_note` varchar(255) DEFAULT NULL,
  `risorse_idonee` enum('C','NC','NA','NR') DEFAULT NULL,
  `risorse_idonee_note` varchar(255) DEFAULT NULL,
  `comunicazione_efficace` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_efficace_note` varchar(255) DEFAULT NULL,
  `presenza_documentazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_documentazione_note` varchar(255) DEFAULT NULL,
  `attivita_svolte` enum('C','NC','NA','NR') DEFAULT NULL,
  `attivita_svolte_note` varchar(255) DEFAULT NULL,
  `valutazione_conformita` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_conformita_note` varchar(255) DEFAULT NULL,
  `miglioramento_continuo` enum('C','NC','NA','NR') DEFAULT NULL,
  `miglioramento_continuo_note` varchar(255) DEFAULT NULL,
  `numero_non_conformita` int(11) DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `note_2` text NOT NULL,
  `osservazioni_2` text NOT NULL,
  `note_3` text NOT NULL,
  `osservazioni_3` text NOT NULL,
  `anno` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_amministrative`
--

CREATE TABLE `db_verifiche_amministrative` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `organico_completo` enum('C','NC','NA','NR') DEFAULT NULL,
  `organico_completo_note` varchar(255) DEFAULT NULL,
  `lettera_assunzione` enum('C','NC','NA','NR') DEFAULT NULL,
  `lettera_assunzione_note` varchar(255) DEFAULT NULL,
  `informativa_dlgs` enum('C','NC','NA','NR') DEFAULT NULL,
  `informativa_dlgs_note` varchar(255) DEFAULT NULL,
  `detrazione_imposta` enum('C','NC','NA','NR') DEFAULT NULL,
  `detrazione_imposta_note` varchar(255) DEFAULT NULL,
  `certificato_sanitario` enum('C','NC','NA','NR') DEFAULT NULL,
  `certificato_sanitario_note` varchar(255) DEFAULT NULL,
  `mip_bagnati` enum('C','NC','NA','NR') DEFAULT NULL,
  `mip_bagnati_note` varchar(255) DEFAULT NULL,
  `statuto` enum('C','NC','NA','NR') DEFAULT NULL,
  `statuto_note` varchar(255) DEFAULT NULL,
  `regolamento_doc` enum('C','NC','NA','NR') DEFAULT NULL,
  `regolamento_doc_note` varchar(255) DEFAULT NULL,
  `regolamento_soggiorno` enum('C','NC','NA','NR') DEFAULT NULL,
  `regolamento_soggiorno_note` varchar(255) DEFAULT NULL,
  `carta_prassi` enum('C','NC','NA','NR') DEFAULT NULL,
  `carta_prassi_note` varchar(255) DEFAULT NULL,
  `lettera_proroga` enum('C','NC','NA','NR') DEFAULT NULL,
  `lettera_proroga_note` varchar(255) DEFAULT NULL,
  `lettera_trasferiemnto` enum('C','NC','NA','NR') DEFAULT NULL,
  `lettera_trasferiemnto_note` varchar(255) DEFAULT NULL,
  `stato_dna` enum('C','NC','NA','NR') DEFAULT NULL,
  `stato_dna_note` varchar(255) DEFAULT NULL,
  `valutazione_personale` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_personale_note` varchar(255) DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `rapporto_giornaliero` enum('C','NC','NA','NR') DEFAULT NULL,
  `rapporto_giornaliero_note` varchar(255) DEFAULT NULL,
  `numero_clienti` enum('C','NC','NA','NR') DEFAULT NULL,
  `numero_clienti_note` varchar(255) DEFAULT NULL,
  `scheda_veicoli` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_veicoli_note` varchar(255) DEFAULT NULL,
  `saldo_cassa` enum('C','NC','NA','NR') DEFAULT NULL,
  `saldo_cassa_note` varchar(255) DEFAULT NULL,
  `archiviazione_documenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `archiviazione_documenti_note` varchar(255) DEFAULT NULL,
  `numero_protocollo` enum('C','NC','NA','NR') DEFAULT NULL,
  `numero_protocollo_note` varchar(255) DEFAULT NULL,
  `intestazione_documento` enum('C','NC','NA','NR') DEFAULT NULL,
  `intestazione_documento_note` varchar(255) DEFAULT NULL,
  `importo_documento` enum('C','NC','NA','NR') DEFAULT NULL,
  `importo_documento_note` varchar(255) DEFAULT NULL,
  `ragione_sociale_fornitore` enum('C','NC','NA','NR') DEFAULT NULL,
  `ragione_sociale_fornitore_note` varchar(255) DEFAULT NULL,
  `verifica_prezzi` enum('C','NC','NA','NR') DEFAULT NULL,
  `verifica_prezzi_note` varchar(255) DEFAULT NULL,
  `ordini_registrati` enum('C','NC','NA','NR') DEFAULT NULL,
  `ordini_registrati_note` varchar(255) DEFAULT NULL,
  `rimborso_trasferte` enum('C','NC','NA','NR') DEFAULT NULL,
  `rimborso_trasferte_note` varchar(255) DEFAULT NULL,
  `scontrini_trasferte` enum('C','NC','NA','NR') DEFAULT NULL,
  `scontrini_trasferte_note` varchar(255) DEFAULT NULL,
  `copia_documenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `copia_documenti_note` varchar(255) DEFAULT NULL,
  `fornitori_selezionati` enum('C','NC','NA','NR') DEFAULT NULL,
  `fornitori_selezionati_note` text DEFAULT NULL,
  `md0306` enum('C','NC','NA','NR') DEFAULT NULL,
  `md0306_note` varchar(255) DEFAULT NULL,
  `md0305` enum('C','NC','NA','NR') DEFAULT NULL,
  `md0305_note` varchar(255) DEFAULT NULL,
  `el0302` enum('C','NC','NA','NR') DEFAULT NULL,
  `el0302_note` varchar(255) DEFAULT NULL,
  `el0303` enum('C','NC','NA','NR') DEFAULT NULL,
  `el0303_note` varchar(255) DEFAULT NULL,
  `el0304` enum('C','NC','NA','NR') DEFAULT NULL,
  `el0304_note` varchar(255) DEFAULT NULL,
  `note_2` text DEFAULT NULL,
  `osservazioni_2` text DEFAULT NULL,
  `documento_qualita` enum('C','NC','NA','NR') DEFAULT NULL,
  `documento_qualita_note` varchar(255) DEFAULT NULL,
  `manuale_qualita` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_qualita_note` varchar(255) DEFAULT NULL,
  `manuale_gestione` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_gestione_note` varchar(255) DEFAULT NULL,
  `istruzioni_operative` enum('C','NC','NA','NR') DEFAULT NULL,
  `istruzioni_operative_note` varchar(255) DEFAULT NULL,
  `registri_gestioni_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `registri_gestioni_servizi_note` varchar(255) DEFAULT NULL,
  `struttura_piattaforma_gestione` enum('C','NC','NA','NR') DEFAULT NULL,
  `struttura_piattaforma_gestione_note` varchar(255) DEFAULT NULL,
  `casevacanze_piattaform_gestione` enum('C','NC','NA','NR') DEFAULT NULL,
  `casevacanze_piattaform_gestione_note` varchar(255) DEFAULT NULL,
  `sezione_nonconformita` enum('C','NC','NA','NR') DEFAULT NULL,
  `sezione_nonconformita_note` varchar(255) DEFAULT NULL,
  `sezione_reclami` enum('C','NC','NA','NR') DEFAULT NULL,
  `sezione_reclami_note` varchar(255) DEFAULT NULL,
  `indicatori_abientali` enum('C','NC','NA','NR') DEFAULT NULL,
  `indicatori_abientali_note` varchar(255) DEFAULT NULL,
  `verifiche_inspettive` enum('C','NC','NA','NR') DEFAULT NULL,
  `verifiche_inspettive_note` varchar(255) DEFAULT NULL,
  `note_3` text DEFAULT NULL,
  `osservazioni_3` text DEFAULT NULL,
  `numero_non_conformita` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_educative`
--

CREATE TABLE `db_verifiche_educative` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `anno` int(11) NOT NULL,
  `numero_non_conformita` int(11) NOT NULL,
  `formazione_ruo` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_ruo_note` varchar(255) DEFAULT NULL,
  `formazione_coordinatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_coordinatori_note` varchar(255) DEFAULT NULL,
  `formazione_educatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_educatori_note` varchar(255) DEFAULT NULL,
  `programmazione_progetto` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_progetto_note` varchar(255) DEFAULT NULL,
  `programmazione_modello_7` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_modello_7_note` varchar(255) DEFAULT NULL,
  `programmazione_presidio` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_presidio_note` varchar(255) DEFAULT NULL,
  `programmazione_piano` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_piano_note` varchar(255) DEFAULT NULL,
  `programmazione_schede_svc` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_schede_svc_note` varchar(255) DEFAULT NULL,
  `programmazione_schede_svpa` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_schede_svpa_note` varchar(255) DEFAULT NULL,
  `programmazione_schede_sav` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_schede_sav_note` varchar(255) DEFAULT NULL,
  `programmazione_monitoraggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_monitoraggio_note` varchar(255) DEFAULT NULL,
  `programmazione_gradimento` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_gradimento_note` varchar(255) DEFAULT NULL,
  `programmazione_progettoc` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_progettoc_note` varchar(255) DEFAULT NULL,
  `programmazione_programma` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_programma_note` varchar(255) DEFAULT NULL,
  `programmazione_orari` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_orari_note` varchar(255) DEFAULT NULL,
  `programmazione_attivita` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_attivita_note` varchar(255) DEFAULT NULL,
  `programmazione_problemi` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_problemi_note` varchar(255) DEFAULT NULL,
  `programmazione_ritiri` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_ritiri_note` varchar(255) DEFAULT NULL,
  `programmazione_notturno` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_notturno_note` varchar(255) DEFAULT NULL,
  `programmazione_telefonate` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_telefonate_note` varchar(255) DEFAULT NULL,
  `programmazione_verbali` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_verbali_note` varchar(255) DEFAULT NULL,
  `programmazione_valutazioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_valutazioni_note` varchar(255) DEFAULT NULL,
  `programmazione_valutazioni_p` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_valutazioni_p_note` varchar(255) DEFAULT NULL,
  `programmazione_autovalutazioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_autovalutazioni_note` varchar(255) DEFAULT NULL,
  `programmazione_autovalutazioni_p` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_autovalutazioni_p_note` varchar(255) DEFAULT NULL,
  `programmazione_relazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_relazione_note` varchar(255) DEFAULT NULL,
  `educativo_animazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_animazione_note` varchar(255) DEFAULT NULL,
  `educativo_spazi` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_spazi_note` varchar(255) DEFAULT NULL,
  `educativo_disabili` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_disabili_note` varchar(255) DEFAULT NULL,
  `educativo_relazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_relazione_note` varchar(255) DEFAULT NULL,
  `educativo_clima` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_clima_note` varchar(255) DEFAULT NULL,
  `educativo_partecipazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `educativo_partecipazione_note` varchar(255) DEFAULT NULL,
  `comunicazione_genitori` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_genitori_note` varchar(255) DEFAULT NULL,
  `comunicazione_famiglie` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_famiglie_note` varchar(255) DEFAULT NULL,
  `comunicazione_sede` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_sede_note` varchar(255) DEFAULT NULL,
  `osservazioni_2` varchar(255) DEFAULT NULL,
  `osservazioni_1` varchar(255) DEFAULT NULL,
  `osservazioni_3` varchar(255) DEFAULT NULL,
  `osservazioni_4` varchar(255) DEFAULT NULL,
  `note_1` varchar(255) DEFAULT NULL,
  `note_2` varchar(255) DEFAULT NULL,
  `note_3` varchar(255) DEFAULT NULL,
  `note_4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_educazione`
--

CREATE TABLE `db_verifiche_educazione` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `formazione_ruo` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_ruo_note` varchar(255) DEFAULT NULL,
  `formazione_coordinatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_coordinatori_note` varchar(255) DEFAULT NULL,
  `formazione_educaturi` enum('C','NC','NA','NR') DEFAULT NULL,
  `formazione_educaturi_note` varchar(255) DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `programmazione_bisettimanale` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_bisettimanale_note` varchar(255) DEFAULT NULL,
  `programmazione_giornaliera` enum('C','NC','NA','NR') DEFAULT NULL,
  `programmazione_giornaliera_note` varchar(255) DEFAULT NULL,
  `griglia_oraria` enum('C','NC','NA','NR') DEFAULT NULL,
  `griglia_oraria_note` varchar(255) DEFAULT NULL,
  `scheda_organica` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_organica_note` varchar(255) DEFAULT NULL,
  `scheda_valutazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_valutazione_note` varchar(255) DEFAULT NULL,
  `scheda_rivelazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_rivelazione_note` varchar(255) DEFAULT NULL,
  `scheda_raccolta` enum('C','NC','NA','NR') DEFAULT NULL,
  `scheda_raccolta_note` varchar(255) DEFAULT NULL,
  `rivelazione_ritiri` enum('C','NC','NA','NR') DEFAULT NULL,
  `rivelazione_ritiri_note` text DEFAULT NULL,
  `verbali_riunioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `verbali_riunioni_note` text DEFAULT NULL,
  `registro_infermeria` enum('C','NC','NA','NR') DEFAULT NULL,
  `registro_infermeria_note` text DEFAULT NULL,
  `comunicazione_infortuni` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_infortuni_note` text DEFAULT NULL,
  `autovalutazione_animatore` enum('C','NC','NA','NR') DEFAULT NULL,
  `autovalutazione_animatore_note` varchar(255) DEFAULT NULL,
  `valutazione_animatore` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_animatore_note` varchar(255) DEFAULT NULL,
  `autovalutazione_coordinatore` enum('C','NC','NA','NR') DEFAULT NULL,
  `autovalutazione_coordinatore_note` varchar(255) DEFAULT NULL,
  `valutazione_coordinatore` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_coordinatore_note` varchar(255) DEFAULT NULL,
  `autovalutazione_direttore` enum('C','NC','NA','NR') DEFAULT NULL,
  `autovalutazione_direttore_note` varchar(255) DEFAULT NULL,
  `valutazione_direttore` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_direttore_note` varchar(255) DEFAULT NULL,
  `valutazione_direttore_coordinatore` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_direttore_coordinatore_note` varchar(255) DEFAULT NULL,
  `valutazione_ausiliario` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_ausiliario_note` varchar(255) DEFAULT NULL,
  `valutazione_medico` enum('C','NC','NA','NR') DEFAULT NULL,
  `valutazione_medico_note` varchar(255) DEFAULT NULL,
  `note_2` text DEFAULT NULL,
  `osservazioni_2` text DEFAULT NULL,
  `animazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `animazione_note` varchar(255) DEFAULT NULL,
  `laboratorio` enum('C','NC','NA','NR') DEFAULT NULL,
  `laboratorio_note` varchar(255) DEFAULT NULL,
  `relazioni_bambini` enum('C','NC','NA','NR') DEFAULT NULL,
  `relazioni_bambini_note` varchar(255) DEFAULT NULL,
  `relazioni_adulti` enum('C','NC','NA','NR') DEFAULT NULL,
  `relazioni_adulti_note` varchar(255) DEFAULT NULL,
  `escursioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `escursioni_note` varchar(255) DEFAULT NULL,
  `parteciapazione_laboratori` enum('C','NC','NA','NR') DEFAULT NULL,
  `parteciapazione_laboratori_note` varchar(255) DEFAULT NULL,
  `partecipazione_animazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `partecipazione_animazione_note` varchar(255) DEFAULT NULL,
  `note_3` text DEFAULT NULL,
  `osservazioni_3` text DEFAULT NULL,
  `comunicazione_genitori` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_genitori_note` varchar(255) DEFAULT NULL,
  `comunicazione_famiglie` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_famiglie_note` varchar(255) DEFAULT NULL,
  `comunicazione_sede` enum('C','NC','NA','NR') DEFAULT NULL,
  `comunicazione_sede_note` varchar(255) DEFAULT NULL,
  `note_4` text DEFAULT NULL,
  `osservazioni_4` text DEFAULT NULL,
  `numero_non_conformita` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_manutenzione`
--

CREATE TABLE `db_verifiche_manutenzione` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `stoccaggio_stato` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_stato_note` varchar(255) DEFAULT NULL,
  `stoccaggio_igiene` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_igiene_note` varchar(255) DEFAULT NULL,
  `stoccaggio_protezioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_protezioni_note` varchar(255) DEFAULT NULL,
  `stoccaggio_griglie` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_griglie_note` varchar(255) DEFAULT NULL,
  `stoccaggio_scafali` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_scafali_note` varchar(255) DEFAULT NULL,
  `stoccaggio_flaconi` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_flaconi_note` varchar(255) DEFAULT NULL,
  `stoccaggio_contenitori` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_contenitori_note` varchar(255) DEFAULT NULL,
  `stoccaggio_conformi` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_conformi_note` varchar(255) DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `detergenza_prodotti` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_prodotti_note` varchar(255) DEFAULT NULL,
  `detergenza_piano` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_piano_note` varchar(255) DEFAULT NULL,
  `detergenza_operazioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_operazioni_note` varchar(255) DEFAULT NULL,
  `detergenza_lavaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_lavaggio_note` varchar(255) DEFAULT NULL,
  `detergenza_schede` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_schede_note` varchar(255) DEFAULT NULL,
  `detergenza_attivita` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_attivita_note` varchar(255) DEFAULT NULL,
  `detergenza_controlli` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_controlli_note` varchar(255) DEFAULT NULL,
  `detergenza_verifiche` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_verifiche_note` varchar(255) DEFAULT NULL,
  `detergenza_documentazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_documentazione_note` varchar(255) DEFAULT NULL,
  `detergenza_nc` enum('C','NC','NA','NR') DEFAULT NULL,
  `detergenza_nc_note` varchar(255) DEFAULT NULL,
  `note_2` text DEFAULT NULL,
  `osservazioni_2` text DEFAULT NULL,
  `locali_uffici_ragnatele` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_uffici_ragnatele_note` varchar(255) DEFAULT NULL,
  `locali_uffici_vetri` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_uffici_vetri_note` varchar(255) DEFAULT NULL,
  `locali_uffici_pavimenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_uffici_pavimenti_note` varchar(255) DEFAULT NULL,
  `locali_uffici_arredi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_uffici_arredi_note` varchar(255) DEFAULT NULL,
  `locali_uffici_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_uffici_servizi_note` varchar(255) DEFAULT NULL,
  `locali_ludici_ragnatele` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_ludici_ragnatele_note` varchar(255) DEFAULT NULL,
  `locali_ludici_vetri` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_ludici_vetri_note` varchar(255) DEFAULT NULL,
  `locali_ludici_pavimenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_ludici_pavimenti_note` varchar(255) DEFAULT NULL,
  `locali_ludici_arredi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_ludici_arredi_note` varchar(255) DEFAULT NULL,
  `locali_ludici_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_ludici_servizi_note` varchar(255) DEFAULT NULL,
  `locali_camere_ragnatele` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_camere_ragnatele_note` varchar(255) DEFAULT NULL,
  `locali_camere_vetri` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_camere_vetri_note` varchar(255) DEFAULT NULL,
  `locali_camere_pavimenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_camere_pavimenti_note` varchar(255) DEFAULT NULL,
  `locali_camere_arredi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_camere_arredi_note` varchar(255) DEFAULT NULL,
  `locali_camere_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_camere_servizi_note` varchar(255) DEFAULT NULL,
  `locali_comuni_ragnatele` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_comuni_ragnatele_note` varchar(255) DEFAULT NULL,
  `locali_comuni_vetri` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_comuni_vetri_note` varchar(255) DEFAULT NULL,
  `locali_comuni_pavimenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_comuni_pavimenti_note` varchar(255) DEFAULT NULL,
  `locali_comuni_arredi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_comuni_arredi_note` varchar(255) DEFAULT NULL,
  `locali_comuni_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_comuni_servizi_note` varchar(255) DEFAULT NULL,
  `locali_igienici_ragnatele` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_igienici_ragnatele_note` varchar(255) DEFAULT NULL,
  `locali_igienici_vetri` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_igienici_vetri_note` varchar(255) DEFAULT NULL,
  `locali_igienici_pavimenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_igienici_pavimenti_note` varchar(255) DEFAULT NULL,
  `locali_igienici_sapone` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_igienici_sapone_note` varchar(255) DEFAULT NULL,
  `locali_igienici_scarico` enum('C','NC','NA','NR') DEFAULT NULL,
  `locali_igienici_scarico_note` varchar(255) DEFAULT NULL,
  `note_3` text DEFAULT NULL,
  `osservazioni_3` text DEFAULT NULL,
  `rifiuti_contenitori` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_contenitori_note` varchar(255) DEFAULT NULL,
  `rifiuti_area` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_area_note` varchar(255) DEFAULT NULL,
  `rifiuti_esterno` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_esterno_note` varchar(255) DEFAULT NULL,
  `rifiuti_documento` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_documento_note` varchar(255) DEFAULT NULL,
  `rifiuti_differenziata` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_differenziata_note` varchar(255) DEFAULT NULL,
  `note_4` text DEFAULT NULL,
  `osservazioni_4` text DEFAULT NULL,
  `personale_oragnico` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_oragnico_note` varchar(255) DEFAULT NULL,
  `personale_responsabile` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_responsabile_note` varchar(255) DEFAULT NULL,
  `personale_igiene` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_igiene_note` varchar(255) DEFAULT NULL,
  `personale_comportamento` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_comportamento_note` varchar(255) DEFAULT NULL,
  `personale_dpi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_dpi_note` varchar(255) DEFAULT NULL,
  `personale_cartellino` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_cartellino_note` varchar(255) DEFAULT NULL,
  `personale_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_servizi_note` varchar(255) DEFAULT NULL,
  `personale_saponi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_saponi_note` varchar(255) DEFAULT NULL,
  `personale_spogliatoi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_spogliatoi_note` varchar(255) DEFAULT NULL,
  `personale_armadietti` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_armadietti_note` varchar(255) DEFAULT NULL,
  `personale_sporgenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_sporgenti_note` varchar(255) DEFAULT NULL,
  `personale_davanzali` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_davanzali_note` varchar(255) DEFAULT NULL,
  `note_5` text DEFAULT NULL,
  `osservazioni_5` text DEFAULT NULL,
  `sanificazione_prodotti` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_prodotti_note` varchar(255) DEFAULT NULL,
  `sanificazione_piano` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_piano_note` varchar(255) DEFAULT NULL,
  `sanificazione_pulizia` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_pulizia_note` varchar(255) DEFAULT NULL,
  `sanificazione_lavaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_lavaggio_note` varchar(255) DEFAULT NULL,
  `sanificazione_schede` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_schede_note` varchar(255) DEFAULT NULL,
  `sanificazione_attivita` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_attivita_note` varchar(255) DEFAULT NULL,
  `sanificazione_controlli` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_controlli_note` varchar(255) DEFAULT NULL,
  `sanificazione_verifiche` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_verifiche_note` varchar(255) DEFAULT NULL,
  `sanificazione_documentazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_documentazione_note` varchar(255) DEFAULT NULL,
  `sanificazione_gestione` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_gestione_note` varchar(255) DEFAULT NULL,
  `note_6` text DEFAULT NULL,
  `osservazioni_6` text DEFAULT NULL,
  `manutenzione_attrezzature` enum('C','NC','NA','NR') DEFAULT NULL,
  `manutenzione_attrezzature_note` varchar(255) DEFAULT NULL,
  `manutenzione_personale` enum('C','NC','NA','NR') DEFAULT NULL,
  `manutenzione_personale_note` varchar(255) DEFAULT NULL,
  `manutenzione_periodiche` enum('C','NC','NA','NR') DEFAULT NULL,
  `manutenzione_periodiche_note` varchar(255) DEFAULT NULL,
  `manutenzione_piano` enum('C','NC','NA','NR') DEFAULT NULL,
  `manutenzione_piano_note` varchar(255) DEFAULT NULL,
  `manutenzione_frequenze` enum('C','NC','NA','NR') DEFAULT NULL,
  `manutenzione_frequenze_note` varchar(255) DEFAULT NULL,
  `note_7` text DEFAULT NULL,
  `osservazioni_7` text DEFAULT NULL,
  `numero_non_conformita` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_ristorazione`
--

CREATE TABLE `db_verifiche_ristorazione` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `stoccaggio_conformita` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_conformita_note` text DEFAULT NULL,
  `stoccaggio_bilancia` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_bilancia_note` text DEFAULT NULL,
  `stoccaggio_termografi` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_termografi_note` text DEFAULT NULL,
  `stoccaggio_taratura` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_taratura_note` text DEFAULT NULL,
  `stoccaggio_derrate` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_derrate_note` text DEFAULT NULL,
  `stoccaggio_derrate_rialzate` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_derrate_rialzate_note` text DEFAULT NULL,
  `stoccaggio_rotazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_rotazione_note` text DEFAULT NULL,
  `stoccaggio_deperibili` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_deperibili_note` text DEFAULT NULL,
  `stoccaggio_ddt` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_ddt_note` text DEFAULT NULL,
  `stoccaggio_mezzi` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_mezzi_note` text DEFAULT NULL,
  `stoccaggio_monouso` enum('C','NC','NA','NR') DEFAULT NULL,
  `stoccaggio_monouso_note` text DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `derrata_orto_prodotto` text DEFAULT NULL,
  `derrata_orto_prodotto_note` text DEFAULT NULL,
  `derrata_orto_tipologia` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_tipologia_note` text DEFAULT NULL,
  `derrata_orto_etichetta` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_etichetta_note` text DEFAULT NULL,
  `derrata_orto_scadenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_scadenza_note` text DEFAULT NULL,
  `derrata_orto_listino` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_listino_note` text DEFAULT NULL,
  `derrata_orto_integrita` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_integrita_note` text DEFAULT NULL,
  `derrata_orto_temperatura` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_temperatura_note` text DEFAULT NULL,
  `derrata_orto_aspetto` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_aspetto_note` text DEFAULT NULL,
  `derrata_orto_colore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_colore_note` text DEFAULT NULL,
  `derrata_orto_odore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_odore_note` text DEFAULT NULL,
  `derrata_orto_difetti` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_orto_difetti_note` text DEFAULT NULL,
  `derrata_carne_prodotto` text DEFAULT NULL,
  `derrata_carne_prodotto_note` text DEFAULT NULL,
  `derrata_carne_tipologia` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_tipologia_note` text DEFAULT NULL,
  `derrata_carne_etichetta` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_etichetta_note` text DEFAULT NULL,
  `derrata_carne_scadenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_scadenza_note` text DEFAULT NULL,
  `derrata_carne_listino` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_listino_note` text DEFAULT NULL,
  `derrata_carne_integrita` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_integrita_note` text DEFAULT NULL,
  `derrata_carne_temperatura` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_temperatura_note` text DEFAULT NULL,
  `derrata_carne_aspetto` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_aspetto_note` text DEFAULT NULL,
  `derrata_carne_colore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_colore_note` text DEFAULT NULL,
  `derrata_carne_odore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_odore_note` text DEFAULT NULL,
  `derrata_carne_difetti` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_carne_difetti_note` text DEFAULT NULL,
  `derrata_secco_prodotto` text DEFAULT NULL,
  `derrata_secco_prodotto_note` text DEFAULT NULL,
  `derrata_secco_tipologia` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_tipologia_note` text DEFAULT NULL,
  `derrata_secco_etichetta` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_etichetta_note` text DEFAULT NULL,
  `derrata_secco_scadenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_scadenza_note` text DEFAULT NULL,
  `derrata_secco_listino` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_listino_note` text DEFAULT NULL,
  `derrata_secco_integrita` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_integrita_note` text DEFAULT NULL,
  `derrata_secco_temperatura` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_temperatura_note` text DEFAULT NULL,
  `derrata_secco_aspetto` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_aspetto_note` text DEFAULT NULL,
  `derrata_secco_colore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_colore_note` text DEFAULT NULL,
  `derrata_secco_odore` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_odore_note` text DEFAULT NULL,
  `derrata_secco_difetti` enum('C','NC','NA','NR') DEFAULT NULL,
  `derrata_secco_difetti_note` text DEFAULT NULL,
  `note_2` text DEFAULT NULL,
  `osservazioni_2` text DEFAULT NULL,
  `aree_igiene_esterna` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_igiene_esterna_note` text DEFAULT NULL,
  `aree_igiene_celle` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_igiene_celle_note` text DEFAULT NULL,
  `aree_guarnizioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_guarnizioni_note` text DEFAULT NULL,
  `aree_magazzino` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_magazzino_note` text DEFAULT NULL,
  `aree_transito` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_transito_note` text DEFAULT NULL,
  `aree_pareti` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_pareti_note` text DEFAULT NULL,
  `aree_protezioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_protezioni_note` text DEFAULT NULL,
  `aree_grigie` enum('C','NC','NA','NR') DEFAULT NULL,
  `aree_grigie_note` text DEFAULT NULL,
  `note_3` text DEFAULT NULL,
  `osservazioni_3` text DEFAULT NULL,
  `produzione_imballaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_imballaggio_note` text DEFAULT NULL,
  `produzione_igienica` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_igienica_note` text DEFAULT NULL,
  `produzione_preparazioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_preparazioni_note` text DEFAULT NULL,
  `produzione_promiscue` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_promiscue_note` text DEFAULT NULL,
  `produzione_tempi_lavorazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_tempi_lavorazione_note` text DEFAULT NULL,
  `produzione_temperatura` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_temperatura_note` text DEFAULT NULL,
  `produzione_scongelamento` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_scongelamento_note` text DEFAULT NULL,
  `produzione_piatti_caldi` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_piatti_caldi_note` text DEFAULT NULL,
  `produzione_piatti_freddi` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_piatti_freddi_note` text DEFAULT NULL,
  `produzione_mascherina` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_mascherina_note` text DEFAULT NULL,
  `produzione_lavaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_lavaggio_note` text DEFAULT NULL,
  `produzione_campioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_campioni_note` text DEFAULT NULL,
  `produzione_buste_sterili` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_buste_sterili_note` text DEFAULT NULL,
  `produzione_abbatimento` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_abbatimento_note` text DEFAULT NULL,
  `produzione_diete` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_diete_note` text DEFAULT NULL,
  `produzione_diete_separate` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_diete_separate_note` text DEFAULT NULL,
  `produzione_diete_preparazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `produzione_diete_preparazione_note` text DEFAULT NULL,
  `note_4` text DEFAULT NULL,
  `osservazioni_4` text DEFAULT NULL,
  `strutture_filtri` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_filtri_note` text DEFAULT NULL,
  `strutture_cucine` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_cucine_note` text DEFAULT NULL,
  `strutture_attrezzature_pulite` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_attrezzature_pulite_note` text DEFAULT NULL,
  `strutture_attrezzature_efficienti` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_attrezzature_efficienti_note` text DEFAULT NULL,
  `strutture_pareti` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_pareti_note` text DEFAULT NULL,
  `strutture_griglie` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_griglie_note` text DEFAULT NULL,
  `strutture_davanzali` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_davanzali_note` text DEFAULT NULL,
  `strutture_taglieri` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_taglieri_note` text DEFAULT NULL,
  `strutture_taglieri_identificabili` enum('C','NC','NA','NR') DEFAULT NULL,
  `strutture_taglieri_identificabili_note` text DEFAULT NULL,
  `note_5` text DEFAULT NULL,
  `osservazioni_5` text DEFAULT NULL,
  `distribuzione_comunicazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_comunicazione_note` text DEFAULT NULL,
  `distribuzione_igieniche` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_igieniche_note` text DEFAULT NULL,
  `distribuzione_materiale` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_materiale_note` text DEFAULT NULL,
  `distribuzione_piatti_freddi` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_piatti_freddi_note` text DEFAULT NULL,
  `distribuzione_piatti_caldi` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_piatti_caldi_note` text DEFAULT NULL,
  `distribuzione_sefservice` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_sefservice_note` text DEFAULT NULL,
  `distribuzione_cortesia` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_cortesia_note` text DEFAULT NULL,
  `distribuzione_composizione` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_composizione_note` text DEFAULT NULL,
  `distribuzione_vetrine` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_vetrine_note` text DEFAULT NULL,
  `distribuzione_attrezature` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_attrezature_note` text DEFAULT NULL,
  `distribuzione_attrezature_efficienti` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_attrezature_efficienti_note` text DEFAULT NULL,
  `distribuzione_locali` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_locali_note` text DEFAULT NULL,
  `distribuzione_tavoli` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_tavoli_note` text DEFAULT NULL,
  `distribuzione_ambiente` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_ambiente_note` text DEFAULT NULL,
  `distribuzione_erogatori` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_erogatori_note` text DEFAULT NULL,
  `distribuzione_cartucce` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_cartucce_note` text DEFAULT NULL,
  `distribuzione_frequenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `distribuzione_frequenza_note` text DEFAULT NULL,
  `note_6` text DEFAULT NULL,
  `osservazioni_6` text DEFAULT NULL,
  `rifiuti_preparazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_preparazione_note` text DEFAULT NULL,
  `rifiuti_distribuzione` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_distribuzione_note` text DEFAULT NULL,
  `rifiuti_racolta` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_racolta_note` text DEFAULT NULL,
  `rifiuti_contenitori` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_contenitori_note` text DEFAULT NULL,
  `rifiuti_esterno` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_esterno_note` text DEFAULT NULL,
  `rifiuti_attrezzature` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_attrezzature_note` text DEFAULT NULL,
  `rifiuti_documento` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_documento_note` text DEFAULT NULL,
  `rifiuti_registro` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_registro_note` text DEFAULT NULL,
  `rifiuti_differenziata` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_differenziata_note` text DEFAULT NULL,
  `rifiuti_oli` enum('C','NC','NA','NR') DEFAULT NULL,
  `rifiuti_oli_note` text DEFAULT NULL,
  `note_7` text DEFAULT NULL,
  `osservazioni_7` text DEFAULT NULL,
  `lavaggio_funzionante` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_funzionante_note` text DEFAULT NULL,
  `lavaggio_ambiente` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_ambiente_note` text DEFAULT NULL,
  `lavaggio_microclima` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_microclima_note` text DEFAULT NULL,
  `lavaggio_bracci` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_bracci_note` text DEFAULT NULL,
  `lavaggio_clacare` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_clacare_note` text DEFAULT NULL,
  `lavaggio_addolcimento` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_addolcimento_note` text DEFAULT NULL,
  `lavaggio_temperatura` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_temperatura_note` text DEFAULT NULL,
  `lavaggio_davanzali` enum('C','NC','NA','NR') DEFAULT NULL,
  `lavaggio_davanzali_note` text DEFAULT NULL,
  `note_8` text DEFAULT NULL,
  `osservazioni_8` text DEFAULT NULL,
  `personale_presente` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_presente_note` text DEFAULT NULL,
  `personale_registro` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_registro_note` text DEFAULT NULL,
  `personale_responsabile` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_responsabile_note` text DEFAULT NULL,
  `personale_igiene` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_igiene_note` text DEFAULT NULL,
  `personale_igiene_conforme` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_igiene_conforme_note` text DEFAULT NULL,
  `personale_comportamento` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_comportamento_note` text DEFAULT NULL,
  `personale_dpi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_dpi_note` text DEFAULT NULL,
  `personale_cartellino` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_cartellino_note` text DEFAULT NULL,
  `personale_servizi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_servizi_note` text DEFAULT NULL,
  `personale_saponi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_saponi_note` text DEFAULT NULL,
  `personale_spogliatoi` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_spogliatoi_note` text DEFAULT NULL,
  `personale_spogliatoi_adeguati` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_spogliatoi_adeguati_note` text DEFAULT NULL,
  `personale_sporgenti` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_sporgenti_note` text DEFAULT NULL,
  `personale_davanzali` enum('C','NC','NA','NR') DEFAULT NULL,
  `personale_davanzali_note` text DEFAULT NULL,
  `note_9` text DEFAULT NULL,
  `osservazioni_9` text DEFAULT NULL,
  `sanificazione_conformi` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_conformi_note` text DEFAULT NULL,
  `sanificazione_stoccaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_stoccaggio_note` text DEFAULT NULL,
  `sanificazione_corretto` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_corretto_note` text DEFAULT NULL,
  `sanificazione_pulizia` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_pulizia_note` text DEFAULT NULL,
  `sanificazione_lavaggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_lavaggio_note` text DEFAULT NULL,
  `sanificazione_roditori` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_roditori_note` text DEFAULT NULL,
  `sanificazione_documentazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_documentazione_note` text DEFAULT NULL,
  `sanificazione_pozzetti` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_pozzetti_note` text DEFAULT NULL,
  `sanificazione_pareti` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_pareti_note` text DEFAULT NULL,
  `sanificazione_davanzali` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_davanzali_note` text DEFAULT NULL,
  `sanificazione_odori` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_odori_note` text DEFAULT NULL,
  `sanificazione_lavamani` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_lavamani_note` text DEFAULT NULL,
  `sanificazione_montacarichi` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_montacarichi_note` text DEFAULT NULL,
  `sanificazione_schede` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_schede_note` text DEFAULT NULL,
  `sanificazione_flaconi` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_flaconi_note` text DEFAULT NULL,
  `sanificazione_esche` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_esche_note` text DEFAULT NULL,
  `sanificazione_schede_tecniche` enum('C','NC','NA','NR') DEFAULT NULL,
  `sanificazione_schede_tecniche_note` text DEFAULT NULL,
  `note_10` text DEFAULT NULL,
  `osservazioni_10` text DEFAULT NULL,
  `manuale_detergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_detergenza_note` text DEFAULT NULL,
  `manuale_controlli` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_controlli_note` text DEFAULT NULL,
  `manuale_verifiche` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_verifiche_note` text DEFAULT NULL,
  `manuale_interventi` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_interventi_note` text DEFAULT NULL,
  `manuale_personale` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_personale_note` text DEFAULT NULL,
  `manuale_nc` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_nc_note` text DEFAULT NULL,
  `manuale_rintracciabilita` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_rintracciabilita_note` text DEFAULT NULL,
  `manuale_allerta` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_allerta_note` text DEFAULT NULL,
  `manuale_autocontrollo` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_autocontrollo_note` text DEFAULT NULL,
  `manuale_haccp` enum('C','NC','NA','NR') DEFAULT NULL,
  `manuale_haccp_note` text DEFAULT NULL,
  `note_11` text DEFAULT NULL,
  `osservazioni_11` text DEFAULT NULL,
  `numero_non_conformita` int(11) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `db_verifiche_sicurezza`
--

CREATE TABLE `db_verifiche_sicurezza` (
  `id` int(11) NOT NULL,
  `id_verifica` int(11) NOT NULL,
  `codice_verifica` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `unita_operativa` int(11) DEFAULT NULL,
  `autore` int(11) NOT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `tipo_valutazione` enum('V','A') DEFAULT NULL,
  `apertura_nc` enum('Y','N') DEFAULT NULL,
  `presenza_documento` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_documento_note` varchar(255) DEFAULT NULL,
  `cartellino` enum('C','NC','NA','NR') DEFAULT NULL,
  `cartellino_note` varchar(255) DEFAULT NULL,
  `presenza_fascicoli` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_fascicoli_note` varchar(255) DEFAULT NULL,
  `presenza_verbale` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_verbale_note` varchar(255) DEFAULT NULL,
  `presenza_dpi` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_dpi_note` varchar(255) DEFAULT NULL,
  `dpi_indossati` enum('C','NC','NA','NR') DEFAULT NULL,
  `dpi_indossati_note` varchar(255) DEFAULT NULL,
  `presenza_lettera_incarico` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_lettera_incarico_note` varchar(255) DEFAULT NULL,
  `presenza_incaricati` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_incaricati_note` varchar(255) DEFAULT NULL,
  `preposti_sicurezza` enum('C','NC','NA','NR') DEFAULT NULL,
  `preposti_sicurezza_note` varchar(255) DEFAULT NULL,
  `addetti_sicurezza` enum('C','NC','NA','NR') DEFAULT NULL,
  `addetti_sicurezza_note` varchar(255) DEFAULT NULL,
  `copie_attestati` enum('C','NC','NA','NR') DEFAULT NULL,
  `copie_attestati_note` varchar(255) DEFAULT NULL,
  `aggiornamenti_attestati` enum('C','NC','NA','NR') DEFAULT NULL,
  `aggiornamenti_attestati_note` varchar(255) DEFAULT NULL,
  `incaricati_primo_soccorso` enum('C','NC','NA','NR') DEFAULT NULL,
  `incaricati_primo_soccorso_note` varchar(255) DEFAULT NULL,
  `letter_primo_soccorso` enum('C','NC','NA','NR') DEFAULT NULL,
  `letter_primo_soccorso_note` varchar(255) DEFAULT NULL,
  `attestati_formazione` enum('C','NC','NA','NR') DEFAULT NULL,
  `attestati_formazione_note` varchar(255) DEFAULT NULL,
  `prove_emergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `prove_emergenza_note` varchar(255) DEFAULT NULL,
  `verbale_prove_emergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `verbale_prove_emergenza_note` varchar(255) DEFAULT NULL,
  `registro_accessi` enum('C','NC','NA','NR') DEFAULT NULL,
  `registro_accessi_note` varchar(255) DEFAULT NULL,
  `informativa_rischi` enum('C','NC','NA','NR') DEFAULT NULL,
  `informativa_rischi_note` varchar(255) DEFAULT NULL,
  `divieto_fumo` enum('C','NC','NA','NR') DEFAULT NULL,
  `divieto_fumo_note` varchar(255) DEFAULT NULL,
  `rischio_elettrico` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_elettrico_note` varchar(255) DEFAULT NULL,
  `divieto_acqua` enum('C','NC','NA','NR') DEFAULT NULL,
  `divieto_acqua_note` varchar(255) DEFAULT NULL,
  `punto_raccolta` enum('C','NC','NA','NR') DEFAULT NULL,
  `punto_raccolta_note` varchar(255) DEFAULT NULL,
  `pulsante_allarme` enum('C','NC','NA','NR') DEFAULT NULL,
  `pulsante_allarme_note` varchar(255) DEFAULT NULL,
  `pulsante_sgancio` enum('C','NC','NA','NR') DEFAULT NULL,
  `pulsante_sgancio_note` varchar(255) DEFAULT NULL,
  `uscite_emergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `uscite_emergenza_note` varchar(255) DEFAULT NULL,
  `porte_tagliafuoco` enum('C','NC','NA','NR') DEFAULT NULL,
  `porte_tagliafuoco_note` varchar(255) DEFAULT NULL,
  `estintori` enum('C','NC','NA','NR') DEFAULT NULL,
  `estintori_note` varchar(255) DEFAULT NULL,
  `idranti_manichetta` enum('C','NC','NA','NR') DEFAULT NULL,
  `idranti_manichetta_note` varchar(255) DEFAULT NULL,
  `idranti_colonna` enum('C','NC','NA','NR') DEFAULT NULL,
  `idranti_colonna_note` varchar(255) DEFAULT NULL,
  `naspi` enum('C','NC','NA','NR') DEFAULT NULL,
  `naspi_note` varchar(255) DEFAULT NULL,
  `attacco_vvf` enum('C','NC','NA','NR') DEFAULT NULL,
  `attacco_vvf_note` varchar(255) DEFAULT NULL,
  `divieto_parcheggio` enum('C','NC','NA','NR') DEFAULT NULL,
  `divieto_parcheggio_note` varchar(255) DEFAULT NULL,
  `passo_uomo` enum('C','NC','NA','NR') DEFAULT NULL,
  `passo_uomo_note` varchar(255) DEFAULT NULL,
  `uscita_veicoli` enum('C','NC','NA','NR') DEFAULT NULL,
  `uscita_veicoli_note` varchar(255) DEFAULT NULL,
  `divieto_accesso` enum('C','NC','NA','NR') DEFAULT NULL,
  `divieto_accesso_note` varchar(255) DEFAULT NULL,
  `planimetrie` enum('C','NC','NA','NR') DEFAULT NULL,
  `planimetrie_note` varchar(255) DEFAULT NULL,
  `informativa_emergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `informativa_emergenza_note` varchar(255) DEFAULT NULL,
  `copia_cpi` enum('C','NC','NA','NR') DEFAULT NULL,
  `copia_cpi_note` varchar(255) DEFAULT NULL,
  `impianto_elettrico` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_elettrico_note` varchar(255) DEFAULT NULL,
  `impianto_idrico` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_idrico_note` varchar(255) DEFAULT NULL,
  `impianto_termico` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_termico_note` varchar(255) DEFAULT NULL,
  `impianto_condizionamento` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_condizionamento_note` varchar(255) DEFAULT NULL,
  `impianto_antincendio` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_antincendio_note` varchar(255) DEFAULT NULL,
  `impianto_fumi` enum('C','NC','NA','NR') DEFAULT NULL,
  `impianto_fumi_note` varchar(255) DEFAULT NULL,
  `denuncia_messaterra` enum('C','NC','NA','NR') DEFAULT NULL,
  `denuncia_messaterra_note` varchar(255) DEFAULT NULL,
  `verifica_messaterra` enum('C','NC','NA','NR') DEFAULT NULL,
  `verifica_messaterra_note` varchar(255) DEFAULT NULL,
  `verifica_ascensore` enum('C','NC','NA','NR') DEFAULT NULL,
  `verifica_ascensore_note` varchar(255) DEFAULT NULL,
  `verifica_funi` enum('C','NC','NA','NR') DEFAULT NULL,
  `verifica_funi_note` varchar(255) DEFAULT NULL,
  `caldaia_conforme` enum('C','NC','NA','NR') DEFAULT NULL,
  `caldaia_conforme_note` varchar(255) DEFAULT NULL,
  `autorizzazione_alberghiera` enum('C','NC','NA','NR') DEFAULT NULL,
  `autorizzazione_alberghiera_note` varchar(255) DEFAULT NULL,
  `autorizzazione_sanitaria` enum('C','NC','NA','NR') DEFAULT NULL,
  `autorizzazione_sanitaria_note` varchar(255) DEFAULT NULL,
  `autorizzazione_piscina` enum('C','NC','NA','NR') DEFAULT NULL,
  `autorizzazione_piscina_note` varchar(255) DEFAULT NULL,
  `contratto_man_antincendio` enum('C','NC','NA','NR') DEFAULT NULL,
  `contratto_man_antincendio_note` varchar(255) DEFAULT NULL,
  `contratto_man_ascensori` enum('C','NC','NA','NR') DEFAULT NULL,
  `contratto_man_ascensori_note` varchar(255) DEFAULT NULL,
  `contratto_man_termico` enum('C','NC','NA','NR') DEFAULT NULL,
  `contratto_man_termico_note` varchar(255) DEFAULT NULL,
  `contratto_man_elettrico` enum('C','NC','NA','NR') DEFAULT NULL,
  `contratto_man_elettrico_note` varchar(255) DEFAULT NULL,
  `contratto_man_idrico` enum('C','NC','NA','NR') DEFAULT NULL,
  `contratto_man_idrico_note` varchar(255) DEFAULT NULL,
  `presenza_dvr` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_dvr_note` varchar(255) DEFAULT NULL,
  `presenza_dvr_specifico` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_dvr_specifico_note` varchar(255) DEFAULT NULL,
  `rischio_chimico` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_chimico_note` varchar(255) DEFAULT NULL,
  `rischio_incendio` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_incendio_note` varchar(255) DEFAULT NULL,
  `rischio_rumore` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_rumore_note` varchar(255) DEFAULT NULL,
  `rischio_stress` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_stress_note` varchar(255) DEFAULT NULL,
  `rischio_vibrazioni` enum('C','NC','NA','NR') DEFAULT NULL,
  `rischio_vibrazioni_note` varchar(255) DEFAULT NULL,
  `presenza_patentini` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_patentini_note` varchar(255) DEFAULT NULL,
  `documenti_rischi` enum('C','NC','NA','NR') DEFAULT NULL,
  `documenti_rischi_note` varchar(255) DEFAULT NULL,
  `piano_emergenza` enum('C','NC','NA','NR') DEFAULT NULL,
  `piano_emergenza_note` varchar(255) DEFAULT NULL,
  `planimetrie_esposte` enum('C','NC','NA','NR') DEFAULT NULL,
  `planimetrie_esposte_note` varchar(255) DEFAULT NULL,
  `presenza_verbale_giornaliero` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_verbale_giornaliero_note` varchar(255) DEFAULT NULL,
  `presenza_manuale_hse` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_manuale_hse_note` varchar(255) DEFAULT NULL,
  `firme_responsabili` enum('C','NC','NA','NR') DEFAULT NULL,
  `firme_responsabili_note` varchar(255) DEFAULT NULL,
  `ditta_consulente` enum('C','NC','NA','NR') DEFAULT NULL,
  `ditta_consulente_note` varchar(255) DEFAULT NULL,
  `certificato_prelievo` enum('C','NC','NA','NR') DEFAULT NULL,
  `certificato_prelievo_note` varchar(255) DEFAULT NULL,
  `modulo_sch` enum('C','NC','NA','NR') DEFAULT NULL,
  `modulo_sch_note` varchar(255) DEFAULT NULL,
  `presenza_termometro` enum('C','NC','NA','NR') DEFAULT NULL,
  `presenza_termometro_note` varchar(255) DEFAULT NULL,
  `acqua_calda` enum('C','NC','NA','NR') DEFAULT NULL,
  `acqua_calda_note` varchar(255) DEFAULT NULL,
  `acqua_fredda` enum('C','NC','NA','NR') DEFAULT NULL,
  `acqua_fredda_note` varchar(255) DEFAULT NULL,
  `usura_giunti` enum('C','NC','NA','NR') DEFAULT NULL,
  `usura_giunti_note` varchar(255) DEFAULT NULL,
  `diffusori_doccia` enum('C','NC','NA','NR') DEFAULT NULL,
  `diffusori_doccia_note` varchar(255) DEFAULT NULL,
  `numero_non_conformita` int(11) DEFAULT NULL,
  `note_1` text DEFAULT NULL,
  `osservazioni_1` text DEFAULT NULL,
  `note_2` text NOT NULL,
  `osservazioni_2` text NOT NULL,
  `note_3` text NOT NULL,
  `osservazioni_3` text NOT NULL,
  `note_4` text NOT NULL,
  `osservazioni_4` text NOT NULL,
  `note_5` text NOT NULL,
  `osservazioni_5` text NOT NULL,
  `note_6` text NOT NULL,
  `osservazioni_6` text NOT NULL,
  `anno` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_azione`
--

CREATE TABLE `doc_azione` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_camere`
--

CREATE TABLE `doc_camere` (
  `id` int(11) NOT NULL,
  `formulaId` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_camere_fossata`
--

CREATE TABLE `doc_camere_fossata` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_campus`
--

CREATE TABLE `doc_campus` (
  `id` int(11) NOT NULL,
  `formulaId` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL,
  `attivo` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_campus_fossata`
--

CREATE TABLE `doc_campus_fossata` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL,
  `attivo` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_chiusura`
--

CREATE TABLE `doc_chiusura` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_clienti`
--

CREATE TABLE `doc_clienti` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codice` varchar(4) NOT NULL,
  `tipologia` int(11) NOT NULL,
  `qdoc` enum('Y','N') DEFAULT NULL,
  `qkeluar` enum('Y','N') DEFAULT NULL,
  `qsharing` enum('Y','N') DEFAULT NULL,
  `qcampus` enum('Y','N') DEFAULT NULL,
  `qsenior` enum('Y','N') NOT NULL DEFAULT 'N',
  `qjunior` enum('Y','N') NOT NULL DEFAULT 'N',
  `qscientifici` enum('Y','N') NOT NULL DEFAULT 'N',
  `qstudio` enum('Y','N') NOT NULL DEFAULT 'N',
  `qsport` enum('Y','N') DEFAULT 'N',
  `online` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_clienti_tipologia_soggiorni`
--

CREATE TABLE `doc_clienti_tipologia_soggiorni` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `tipologia_id` tinyint(4) DEFAULT NULL,
  `soggiorno_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_codici`
--

CREATE TABLE `doc_codici` (
  `id` int(11) NOT NULL,
  `id_nc` int(11) NOT NULL,
  `unita` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_colori`
--

CREATE TABLE `doc_colori` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `colore` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_conoscenza`
--

CREATE TABLE `doc_conoscenza` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_consiglia`
--

CREATE TABLE `doc_consiglia` (
  `id` char(1) NOT NULL,
  `nome` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_qualita`
--

CREATE TABLE `doc_documenti_qualita` (
  `id` int(11) NOT NULL,
  `procedura_id` tinyint(4) NOT NULL DEFAULT 0,
  `sgq` varchar(255) NOT NULL,
  `tipologia` varchar(255) NOT NULL,
  `codice` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `revisione` varchar(255) NOT NULL,
  `data_revisione` date DEFAULT NULL,
  `titolo` varchar(255) NOT NULL,
  `redige` varchar(255) NOT NULL,
  `archivia` varchar(255) NOT NULL,
  `riesamina` varchar(255) NOT NULL,
  `autorizza` varchar(255) NOT NULL,
  `approva` varchar(255) NOT NULL,
  `periodicita_riesame` varchar(255) NOT NULL,
  `modalita_archiviazione` varchar(255) NOT NULL,
  `luogo_archiviazione` varchar(255) NOT NULL,
  `formato` enum('DOC','EXCEL','PPT','PDF') DEFAULT NULL,
  `funzione_responsabile_id` int(11) NOT NULL DEFAULT 0,
  `data_inserimento` date DEFAULT NULL,
  `data_modifica` date DEFAULT NULL,
  `creato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `modificato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_qualita_procedura`
--

CREATE TABLE `doc_documenti_qualita_procedura` (
  `id` tinyint(4) NOT NULL,
  `procedura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_qualita_unita`
--

CREATE TABLE `doc_documenti_qualita_unita` (
  `id` int(11) NOT NULL,
  `documenti_id` int(11) NOT NULL DEFAULT 0,
  `unita_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_soggiorni`
--

CREATE TABLE `doc_documenti_soggiorni` (
  `id` int(11) NOT NULL,
  `procedura_id` tinyint(4) NOT NULL DEFAULT 0,
  `sgq` varchar(255) NOT NULL,
  `tipologia` varchar(255) NOT NULL,
  `codice` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `revisione` varchar(255) NOT NULL,
  `data_revisione` date DEFAULT NULL,
  `titolo` varchar(255) NOT NULL,
  `redige` varchar(255) NOT NULL,
  `archivia` varchar(255) NOT NULL,
  `riesamina` varchar(255) NOT NULL,
  `autorizza` varchar(255) NOT NULL,
  `approva` varchar(255) NOT NULL,
  `periodicita_riesame` varchar(255) NOT NULL,
  `modalita_archiviazione` varchar(255) NOT NULL,
  `luogo_archiviazione` varchar(255) NOT NULL,
  `formato` enum('DOC','EXCEL','PPT','PDF') DEFAULT NULL,
  `funzione_responsabile_id` int(11) NOT NULL DEFAULT 0,
  `data_inserimento` date DEFAULT NULL,
  `data_modifica` date DEFAULT NULL,
  `creato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `modificato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_soggiorni_procedura`
--

CREATE TABLE `doc_documenti_soggiorni_procedura` (
  `id` tinyint(4) NOT NULL,
  `procedura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documenti_soggiorni_unita`
--

CREATE TABLE `doc_documenti_soggiorni_unita` (
  `id` int(11) NOT NULL,
  `documenti_id` int(11) NOT NULL DEFAULT 0,
  `unita_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documents`
--

CREATE TABLE `doc_documents` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `procedura_id` tinyint(4) NOT NULL DEFAULT 0,
  `sgq` varchar(255) NOT NULL,
  `tipologia` varchar(255) NOT NULL,
  `codice` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `revisione` varchar(255) NOT NULL,
  `data_revisione` date DEFAULT NULL,
  `titolo` varchar(255) NOT NULL,
  `redige` varchar(255) NOT NULL,
  `archivia` varchar(255) NOT NULL,
  `riesamina` varchar(255) NOT NULL,
  `autorizza` varchar(255) NOT NULL,
  `approva` varchar(255) NOT NULL,
  `periodicita_riesame` varchar(255) NOT NULL,
  `modalita_archiviazione` varchar(255) NOT NULL,
  `luogo_archiviazione` varchar(255) NOT NULL,
  `formato` enum('DOC','EXCEL','PPT','PDF') DEFAULT NULL,
  `funzione_responsabile_id` int(11) NOT NULL DEFAULT 0,
  `data_inserimento` date DEFAULT NULL,
  `data_modifica` date DEFAULT NULL,
  `creato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `modificato_user_id` tinyint(4) NOT NULL DEFAULT 0,
  `filename` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documents_category`
--

CREATE TABLE `doc_documents_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_documents_procedures`
--

CREATE TABLE `doc_documents_procedures` (
  `id` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `procedura` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_email_queue`
--

CREATE TABLE `doc_email_queue` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `from_name` varchar(64) DEFAULT NULL,
  `from_email` varchar(128) NOT NULL,
  `to_email` varchar(128) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `max_attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 3,
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `date_published` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_categorie`
--

CREATE TABLE `doc_formazione_categorie` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_formazioni`
--

CREATE TABLE `doc_formazione_formazioni` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `colore` int(11) NOT NULL,
  `codice` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_gruppi`
--

CREATE TABLE `doc_formazione_gruppi` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_gruppi_corsi`
--

CREATE TABLE `doc_formazione_gruppi_corsi` (
  `id` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `id_gruppo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_titolo_corsi`
--

CREATE TABLE `doc_formazione_titolo_corsi` (
  `id` int(11) NOT NULL,
  `titolo_corso` varchar(255) NOT NULL,
  `categoria` varchar(20) DEFAULT 'ENTRAMBI',
  `attivo` enum('Y','N') NOT NULL DEFAULT 'Y',
  `insert_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_utenti_corsi`
--

CREATE TABLE `doc_formazione_utenti_corsi` (
  `id` int(11) NOT NULL,
  `id_corso` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formazione_utenti_gruppi`
--

CREATE TABLE `doc_formazione_utenti_gruppi` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_gruppo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formule`
--

CREATE TABLE `doc_formule` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL,
  `form_sh` enum('Y','N') NOT NULL DEFAULT 'Y',
  `form_campus` enum('Y','N') NOT NULL DEFAULT 'Y',
  `form_fossata` enum('Y','N') NOT NULL DEFAULT 'Y',
  `form_sharing` enum('Y','N') NOT NULL DEFAULT 'Y',
  `show_on_sh` enum('Y','N') NOT NULL DEFAULT 'Y',
  `show_on_q` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_formule_fossata`
--

CREATE TABLE `doc_formule_fossata` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL,
  `view_on_sh` enum('Y','N') NOT NULL DEFAULT 'N',
  `view_on_q` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_funzione`
--

CREATE TABLE `doc_funzione` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_giudizzi`
--

CREATE TABLE `doc_giudizzi` (
  `id` char(1) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_housing`
--

CREATE TABLE `doc_housing` (
  `id` int(11) NOT NULL,
  `formulaId` int(11) NOT NULL DEFAULT 0,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_housing_fossata`
--

CREATE TABLE `doc_housing_fossata` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL,
  `attivo` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_letture`
--

CREATE TABLE `doc_letture` (
  `id` int(11) NOT NULL,
  `id_matricola` int(11) NOT NULL,
  `data_lettura` date NOT NULL,
  `incremento` float NOT NULL,
  `differenza` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_matricole`
--

CREATE TABLE `doc_matricole` (
  `id` int(11) NOT NULL,
  `id_struttura` int(11) NOT NULL,
  `tipo_matricola` int(11) NOT NULL,
  `nome_contatore` varchar(255) NOT NULL,
  `matricola` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_nazioni`
--

CREATE TABLE `doc_nazioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_occupazioni`
--

CREATE TABLE `doc_occupazioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_preiscrizioni`
--

CREATE TABLE `doc_preiscrizioni` (
  `id` int(11) NOT NULL,
  `sede` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `cellulare` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `cellulare_altro` varchar(15) NOT NULL,
  `telefono_altro` varchar(15) NOT NULL,
  `data_nascita` date NOT NULL,
  `luogo_nascita` varchar(50) NOT NULL,
  `codice_fiscale` varchar(16) NOT NULL,
  `tipo_indirizzo` int(11) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `cap` varchar(5) NOT NULL,
  `citta` varchar(255) NOT NULL,
  `stato` int(11) NOT NULL,
  `altro_tipo_indirizzo` int(11) NOT NULL,
  `altro_indirizzo` varchar(255) NOT NULL,
  `altro_codice_fiscale` varchar(16) NOT NULL,
  `altro_citta` varchar(255) NOT NULL,
  `altro_stato` int(11) NOT NULL,
  `altro_cap` varchar(5) NOT NULL,
  `cittadinanza` varchar(150) NOT NULL,
  `madrelingua` varchar(150) NOT NULL,
  `diploma` enum('Y','N') NOT NULL,
  `tipo_diploma` int(11) NOT NULL,
  `scuola` varchar(255) NOT NULL,
  `anno_iscrizione` int(11) NOT NULL,
  `tipo_laurea` varchar(150) NOT NULL,
  `specializzazione` enum('Y','N') NOT NULL,
  `specializzazione_dettaglio` varchar(255) NOT NULL,
  `attestati` varchar(150) NOT NULL,
  `corsi` varchar(150) NOT NULL,
  `disponibile_dal` date NOT NULL,
  `disponibile_al` date NOT NULL,
  `permesso_soggiorno` int(11) NOT NULL,
  `scadenza_permesso_soggiorno` date NOT NULL,
  `brevetto` enum('Y','N') NOT NULL,
  `tipologia_brevetto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_reclami_canali`
--

CREATE TABLE `doc_reclami_canali` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_reclami_tipologie`
--

CREATE TABLE `doc_reclami_tipologie` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_responsabile`
--

CREATE TABLE `doc_responsabile` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_rooming`
--

CREATE TABLE `doc_rooming` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_segnalato`
--

CREATE TABLE `doc_segnalato` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nome_it_IT` varchar(80) NOT NULL,
  `nome_en_GB` varchar(80) NOT NULL,
  `nome_es_ES` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_sms_queue`
--

CREATE TABLE `doc_sms_queue` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `recipient` varchar(60) NOT NULL,
  `sender` varchar(16) NOT NULL,
  `message` text NOT NULL,
  `max_attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 3,
  `attempts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_societa`
--

CREATE TABLE `doc_societa` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `codice` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_soggiorno`
--

CREATE TABLE `doc_soggiorno` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologia_soggiorni`
--

CREATE TABLE `doc_tipologia_soggiorni` (
  `id` tinyint(4) NOT NULL,
  `tipologia` varchar(20) DEFAULT NULL,
  `local_name` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_aperture`
--

CREATE TABLE `doc_tipologie_aperture` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_clienti`
--

CREATE TABLE `doc_tipologie_clienti` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_formazione`
--

CREATE TABLE `doc_tipologie_formazione` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `attivo` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_processi`
--

CREATE TABLE `doc_tipologie_processi` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_soggiorni`
--

CREATE TABLE `doc_tipologie_soggiorni` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `label_it_IT` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_strutture`
--

CREATE TABLE `doc_tipologie_strutture` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_tipologie_verifiche`
--

CREATE TABLE `doc_tipologie_verifiche` (
  `id` tinyint(4) NOT NULL,
  `codice` varchar(6) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `colore` varchar(6) NOT NULL,
  `is_hidden` enum('N','Y') NOT NULL DEFAULT 'N',
  `file_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_turni`
--

CREATE TABLE `doc_turni` (
  `id` int(11) NOT NULL,
  `dal` date NOT NULL,
  `al` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_unita`
--

CREATE TABLE `doc_unita` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codice` varchar(4) NOT NULL,
  `superficie` int(11) DEFAULT NULL,
  `tipologia` int(11) NOT NULL,
  `centro` int(11) NOT NULL,
  `ente` int(11) DEFAULT NULL,
  `colore` int(11) NOT NULL,
  `qdoc` enum('Y','N') DEFAULT NULL,
  `qkeluar` enum('Y','N') DEFAULT NULL,
  `qsharing` enum('Y','N') DEFAULT NULL,
  `qcampus` enum('Y','N') DEFAULT NULL,
  `qsenior` enum('Y','N') NOT NULL DEFAULT 'N',
  `qjunior` enum('Y','N') NOT NULL DEFAULT 'N',
  `qscientifici` enum('Y','N') NOT NULL DEFAULT 'N',
  `qstudio` enum('Y','N') NOT NULL DEFAULT 'N',
  `qsport` enum('Y','N') DEFAULT 'N',
  `qformazione` enum('Y','N') NOT NULL DEFAULT 'N',
  `qsmog` enum('Y','N') NOT NULL DEFAULT 'N',
  `soloq` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_unita_centri`
--

CREATE TABLE `doc_unita_centri` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `id_responsabile` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_unita_mappa_aree`
--

CREATE TABLE `doc_unita_mappa_aree` (
  `id` int(11) NOT NULL,
  `unita_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_unita_old`
--

CREATE TABLE `doc_unita_old` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codice` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_verifiche_answers`
--

CREATE TABLE `doc_verifiche_answers` (
  `id` int(11) NOT NULL,
  `verificaId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL DEFAULT 0,
  `answer` enum('C','NC','NA','NR') DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `file_nc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_verifiche_questions`
--

CREATE TABLE `doc_verifiche_questions` (
  `id` int(11) NOT NULL,
  `tipologiaVerificaId` tinyint(4) NOT NULL DEFAULT 0,
  `groupId` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `type` enum('SELECT','FILE','NOTE') DEFAULT NULL,
  `ordine` smallint(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_verifiche_questions_groups`
--

CREATE TABLE `doc_verifiche_questions_groups` (
  `id` int(11) NOT NULL,
  `tipologiaVerificaId` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facolta`
--

CREATE TABLE `facolta` (
  `id` int(11) NOT NULL,
  `nome_facolta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formazione_corsi_tags`
--

CREATE TABLE `formazione_corsi_tags` (
  `corso_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fo_preiscrizioni`
--

CREATE TABLE `fo_preiscrizioni` (
  `id` int(11) NOT NULL,
  `id_iscrizione` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `luogo_nascita` varchar(30) DEFAULT NULL,
  `nazionalita` int(11) DEFAULT NULL,
  `sesso` enum('M','F') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cellulare` varchar(20) DEFAULT NULL,
  `occupazione` int(11) DEFAULT NULL,
  `prima_volta` enum('Y','N') DEFAULT NULL,
  `conoscenza` int(11) DEFAULT NULL,
  `formula` int(11) DEFAULT NULL,
  `campus` int(11) DEFAULT NULL,
  `housing` int(11) DEFAULT NULL,
  `coabitazione` varchar(255) NOT NULL,
  `data_in` date NOT NULL,
  `data_out` date NOT NULL,
  `privacy` enum('Y','N') DEFAULT NULL,
  `mailing` enum('Y','N') DEFAULT NULL,
  `note` text NOT NULL,
  `data_insert` datetime NOT NULL,
  `lang` varchar(6) NOT NULL DEFAULT 'it-IT',
  `anno` int(11) NOT NULL,
  `refer` enum('S','P') NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_picture`
--

CREATE TABLE `maintenance_picture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maintenance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_tokens`
--

CREATE TABLE `notification_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_doc`
--

CREATE TABLE `questionario_doc` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `lingua` varchar(6) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cellulare` varchar(30) DEFAULT NULL,
  `data_arrivo` date NOT NULL,
  `data_partenza` date NOT NULL,
  `conoscenza` int(11) NOT NULL,
  `tipologia_cliente` int(11) NOT NULL,
  `giorni_permanenza` int(11) NOT NULL,
  `data_consegna` datetime DEFAULT NULL,
  `data_restituzione` date NOT NULL,
  `vacanza` enum('E','B','S','I') DEFAULT NULL,
  `struttura_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `struttura_nome` int(11) NOT NULL,
  `struttura_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `stanza_confort` enum('E','B','S','I') DEFAULT NULL,
  `stanza_arredi` enum('E','B','S','I') DEFAULT NULL,
  `stanza_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `stanza_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_servizio` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_attesa` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_cibo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_menu` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `personale_cortesia` enum('E','B','S','I') DEFAULT NULL,
  `personale_professionalita` enum('E','B','S','I') DEFAULT NULL,
  `personale_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `personale_animazione` enum('E','B','S','I') DEFAULT NULL,
  `consiglia` enum('S','N','F') DEFAULT NULL,
  `suggerimenti` text DEFAULT NULL,
  `info` char(1) DEFAULT NULL,
  `anno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_formazione`
--

CREATE TABLE `questionario_formazione` (
  `id` int(11) NOT NULL,
  `lingua` varchar(6) NOT NULL,
  `data_corso` date NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `tipo_corso` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `ente` int(11) NOT NULL,
  `ente_corso` varchar(255) NOT NULL,
  `corso` enum('I','S','B','E') NOT NULL,
  `giudizio` enum('I','S','B','E') NOT NULL,
  `conduzione` enum('I','S','B','E') NOT NULL,
  `spazi` enum('I','S','B','E') NOT NULL,
  `livello` enum('I','S','B','E') NOT NULL,
  `consiglia` enum('N','S','F') NOT NULL,
  `argomenti` text NOT NULL,
  `suggerimenti` text NOT NULL,
  `anno` int(11) NOT NULL,
  `data_inserimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_genitori_junior`
--

CREATE TABLE `questionario_genitori_junior` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `assistenza` enum('M','A','P') DEFAULT NULL,
  `informazioni` enum('M','A','P') DEFAULT NULL,
  `trasferimenti` enum('M','A','P') DEFAULT NULL,
  `complessivo` enum('M','A','P') DEFAULT NULL,
  `organizzazione` enum('M','A','P') DEFAULT NULL,
  `attivita` enum('M','A','P') DEFAULT NULL,
  `esperienza` enum('M','A','P') DEFAULT NULL,
  `cura` enum('M','A','P') DEFAULT NULL,
  `communicazione` enum('M','A','P') DEFAULT NULL,
  `suggerimenti` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL,
  `email_genitore` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_genitori_scientifici`
--

CREATE TABLE `questionario_genitori_scientifici` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `assistenza` enum('M','A','P') DEFAULT NULL,
  `informazioni` enum('M','A','P') DEFAULT NULL,
  `trasferimenti` enum('M','A','P') DEFAULT NULL,
  `complessivo` enum('M','A','P') DEFAULT NULL,
  `organizzazione` enum('M','A','P') DEFAULT NULL,
  `attivita` enum('M','A','P') DEFAULT NULL,
  `esperienza` enum('M','A','P') DEFAULT NULL,
  `cura` enum('M','A','P') DEFAULT NULL,
  `communicazione` enum('M','A','P') DEFAULT NULL,
  `suggerimenti` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL,
  `email_genitore` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_genitori_senior`
--

CREATE TABLE `questionario_genitori_senior` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `assistenza` enum('M','A','P') DEFAULT NULL,
  `informazioni` enum('M','A','P') DEFAULT NULL,
  `trasferimenti` enum('M','A','P') DEFAULT NULL,
  `complessivo` enum('M','A','P') DEFAULT NULL,
  `organizzazione` enum('M','A','P') DEFAULT NULL,
  `attivita` enum('M','A','P') DEFAULT NULL,
  `esperienza` enum('M','A','P') DEFAULT NULL,
  `cura` enum('M','A','P') DEFAULT NULL,
  `communicazione` enum('M','A','P') DEFAULT NULL,
  `suggerimenti` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL,
  `email_genitore` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_genitori_studio`
--

CREATE TABLE `questionario_genitori_studio` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `assistenza` enum('M','A','P') DEFAULT NULL,
  `informazioni` enum('M','A','P') DEFAULT NULL,
  `trasferimenti` enum('M','A','P') DEFAULT NULL,
  `complessivo` enum('M','A','P') DEFAULT NULL,
  `organizzazione` enum('M','A','P') DEFAULT NULL,
  `attivita` enum('M','A','P') DEFAULT NULL,
  `esperienza` enum('M','A','P') DEFAULT NULL,
  `cura` enum('M','A','P') DEFAULT NULL,
  `communicazione` enum('M','A','P') DEFAULT NULL,
  `suggerimenti` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL,
  `email_genitore` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_junior`
--

CREATE TABLE `questionario_junior` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `divertimento` enum('M','A','P') NOT NULL,
  `educatori` enum('M','A','P') NOT NULL,
  `compagni` enum('M','A','P') NOT NULL,
  `giochi` enum('M','A','P') NOT NULL,
  `attivita_sportive` enum('M','A','P') NOT NULL,
  `gite` enum('M','A','P') NOT NULL,
  `laboratori` enum('M','A','P') NOT NULL,
  `escursioni` enum('M','A','P') NOT NULL,
  `soggiorno_esperienza` enum('M','A','P') NOT NULL,
  `soggiorno_staff` enum('M','A','P') NOT NULL,
  `soggiorno_communicazione` enum('M','A','P') NOT NULL,
  `soggiorno_complessivo` enum('M','A','P') NOT NULL,
  `suggerimenti` text NOT NULL,
  `osservazioni` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_keluar`
--

CREATE TABLE `questionario_keluar` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `sede_operativa` varchar(50) NOT NULL,
  `scuola` varchar(50) NOT NULL,
  `data_consegna` datetime NOT NULL,
  `data_restituzione` date NOT NULL,
  `viaggio_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `struttura_complessivo` enum('E','B','S','I') NOT NULL,
  `struttura_nome` int(11) NOT NULL,
  `camera_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `camera_confort` enum('E','B','S','I') NOT NULL,
  `rapporto_keluar` enum('E','B','S','I') DEFAULT NULL,
  `trasporto_nome` varchar(50) DEFAULT NULL,
  `trasporto_qualita` enum('E','B','S','I') DEFAULT NULL,
  `trasporto_cortesia` enum('E','B','S','I') DEFAULT NULL,
  `trasporto_tempi` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_servizio` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_cibo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_menu` enum('E','B','S','I') DEFAULT NULL,
  `personale_cortesia` enum('E','B','S','I') DEFAULT NULL,
  `personale_disponibilita` enum('E','B','S','I') DEFAULT NULL,
  `escursioni_itinerari` enum('E','B','S','I') DEFAULT NULL,
  `escursioni_guida` enum('E','B','S','I') DEFAULT NULL,
  `neve_noleggio` enum('E','B','S','I') DEFAULT NULL,
  `neve_scuola` enum('E','B','S','I') DEFAULT NULL,
  `laboratori_tecnici` enum('E','B','S','I') DEFAULT NULL,
  `laboratori_competenze` enum('E','B','S','I') DEFAULT NULL,
  `consiglia` enum('S','N','F','E') DEFAULT NULL,
  `suggerimenti` text DEFAULT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_scientifici`
--

CREATE TABLE `questionario_scientifici` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `divertimento` enum('M','A','P') NOT NULL,
  `educatori` enum('M','A','P') NOT NULL,
  `compagni` enum('M','A','P') NOT NULL,
  `giochi` enum('M','A','P') NOT NULL,
  `attivita_sportive` enum('M','A','P') NOT NULL,
  `gite` enum('M','A','P') NOT NULL,
  `laboratori` enum('M','A','P') NOT NULL,
  `escursioni` enum('M','A','P') NOT NULL,
  `soggiorno_esperienza` enum('M','A','P') NOT NULL,
  `soggiorno_staff` enum('M','A','P') NOT NULL,
  `soggiorno_communicazione` enum('M','A','P') NOT NULL,
  `soggiorno_complessivo` enum('M','A','P') NOT NULL,
  `scientifici_organizzazione` enum('M','A','P') NOT NULL,
  `scientifici_didattica` enum('M','A','P') NOT NULL,
  `scientifici_formazione` enum('M','A','P') NOT NULL,
  `suggerimenti` text NOT NULL,
  `osservazioni` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_senior`
--

CREATE TABLE `questionario_senior` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `divertimento` enum('M','A','P') NOT NULL,
  `educatori` enum('M','A','P') NOT NULL,
  `compagni` enum('M','A','P') NOT NULL,
  `giochi` enum('M','A','P') NOT NULL,
  `attivita_sportive` enum('M','A','P') NOT NULL,
  `gite` enum('M','A','P') NOT NULL,
  `laboratori` enum('M','A','P') NOT NULL,
  `escursioni` enum('M','A','P') NOT NULL,
  `soggiorno_esperienza` enum('M','A','P') NOT NULL,
  `soggiorno_staff` enum('M','A','P') NOT NULL,
  `soggiorno_communicazione` enum('M','A','P') NOT NULL,
  `soggiorno_complessivo` enum('M','A','P') NOT NULL,
  `suggerimenti` text NOT NULL,
  `osservazioni` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_sharing`
--

CREATE TABLE `questionario_sharing` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `lingua` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellulare` varchar(30) NOT NULL,
  `data_arrivo` date NOT NULL,
  `data_partenza` date NOT NULL,
  `conoscenza` int(11) NOT NULL,
  `tipologia_cliente` int(11) NOT NULL,
  `tipologia_soggiorno` int(11) NOT NULL,
  `giorni_permanenza` int(11) NOT NULL,
  `soggiorno` int(11) DEFAULT NULL,
  `data_consegna` datetime NOT NULL,
  `data_restituzione` date NOT NULL,
  `vacanza` enum('E','B','S','I') DEFAULT NULL,
  `struttura_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `struttura_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `stanza_confort` enum('E','B','S','I') DEFAULT NULL,
  `stanza_arredi` enum('E','B','S','I') DEFAULT NULL,
  `stanza_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `stanza_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_servizio` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_attesa` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_cibo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_menu` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `personale_cortesia` enum('E','B','S','I') DEFAULT NULL,
  `personale_professionalita` enum('E','B','S','I') DEFAULT NULL,
  `personale_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `attivita_complessivo` enum('I','S','B','E') DEFAULT NULL,
  `consiglia` enum('S','N','F') DEFAULT NULL,
  `suggerimenti` text DEFAULT NULL,
  `info` char(1) NOT NULL,
  `anno` int(11) NOT NULL,
  `refer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_studio`
--

CREATE TABLE `questionario_studio` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `divertimento` enum('M','A','P') DEFAULT NULL,
  `educatori` enum('M','A','P') DEFAULT NULL,
  `compagni` enum('M','A','P') DEFAULT NULL,
  `giochi` enum('M','A','P') DEFAULT NULL,
  `attivita_sportive` enum('M','A','P') DEFAULT NULL,
  `gite` enum('M','A','P') DEFAULT NULL,
  `laboratori` enum('M','A','P') DEFAULT NULL,
  `escursioni` enum('M','A','P') DEFAULT NULL,
  `soggiorno_esperienza` enum('M','A','P') DEFAULT NULL,
  `soggiorno_staff` enum('M','A','P') DEFAULT NULL,
  `soggiorno_communicazione` enum('M','A','P') DEFAULT NULL,
  `soggiorno_complessivo` enum('M','A','P') DEFAULT NULL,
  `studio_localita` enum('M','A','P') DEFAULT NULL,
  `studio_college` enum('M','A','P') DEFAULT NULL,
  `studio_attivita` enum('M','A','P') DEFAULT NULL,
  `studio_corso` enum('M','A','P') DEFAULT NULL,
  `studio_escursioni` enum('M','A','P') DEFAULT NULL,
  `studio_divertimento` enum('M','A','P') DEFAULT NULL,
  `studio_aspetto_vacanza` text NOT NULL,
  `studio_attivita_utile` text NOT NULL,
  `studio_suggerimenti` text NOT NULL,
  `suggerimenti` text NOT NULL,
  `osservazioni` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionario_torremarina`
--

CREATE TABLE `questionario_torremarina` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `lingua` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellulare` varchar(30) NOT NULL,
  `data_arrivo` date NOT NULL,
  `data_partenza` date NOT NULL,
  `conoscenza` int(11) NOT NULL,
  `tipologia_cliente` int(11) NOT NULL,
  `giorni_permanenza` int(11) NOT NULL,
  `data_consegna` datetime NOT NULL,
  `data_restituzione` date NOT NULL,
  `vacanza` enum('E','B','S','I') DEFAULT NULL,
  `struttura_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `struttura_nome` int(11) NOT NULL,
  `struttura_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `stanza_confort` enum('E','B','S','I') DEFAULT NULL,
  `stanza_arredi` enum('E','B','S','I') DEFAULT NULL,
  `stanza_pulizia` enum('E','B','S','I') DEFAULT NULL,
  `stanza_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_servizio` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_attesa` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_cibo` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_menu` enum('E','B','S','I') DEFAULT NULL,
  `ristorante_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `personale_cortesia` enum('E','B','S','I') DEFAULT NULL,
  `personale_professionalita` enum('E','B','S','I') DEFAULT NULL,
  `personale_complessivo` enum('E','B','S','I') DEFAULT NULL,
  `personale_animazione` enum('E','B','S','I') NOT NULL,
  `consiglia` enum('S','N','F') DEFAULT NULL,
  `suggerimenti` text DEFAULT NULL,
  `info` char(1) NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionnaire_type` enum('SP','SG','Q','A','F') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `link_privacy` varchar(255) DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=pubblico, 0=privato',
  `email_notification` varchar(100) DEFAULT NULL,
  `email_contact` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire_participants`
--

CREATE TABLE `questionnaire_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionnaire_id` int(10) UNSIGNED NOT NULL,
  `version_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `coordinator_name` varchar(100) DEFAULT NULL,
  `coordinator_surname` varchar(100) DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `type_course_id` varchar(255) DEFAULT NULL,
  `title_course_id` varchar(255) DEFAULT NULL,
  `date_course` date DEFAULT NULL,
  `affiliated_organisation` varchar(255) DEFAULT NULL,
  `tipologia_soggiorno_id` int(10) UNSIGNED DEFAULT 0,
  `soggiorno_id` int(10) UNSIGNED DEFAULT 0,
  `turno_id` tinyint(1) DEFAULT 0,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL COMMENT 'Indirizzo IP del compilatore',
  `browser_agent` text DEFAULT NULL COMMENT 'User Agent del browser del compilatore',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire_sections`
--

CREATE TABLE `questionnaire_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `version_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `condition_field` varchar(50) DEFAULT NULL,
  `condition_operator` enum('=','!=','in','not in') DEFAULT NULL,
  `condition_value` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionnaire_versions`
--

CREATE TABLE `questionnaire_versions` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionnaire_id` int(10) UNSIGNED NOT NULL,
  `version_number` int(10) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `type` enum('text','option','range','custom','yes_no') NOT NULL,
  `type_render` enum('checkbox','radio','select','textarea') DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_multiple` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `condition_question_id` int(10) UNSIGNED DEFAULT NULL,
  `condition_operator` varchar(10) DEFAULT NULL,
  `condition_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `value` int(11) NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `structure_id` int(10) UNSIGNED DEFAULT NULL,
  `structure_area_id` int(11) DEFAULT NULL,
  `area_not_available` tinyint(1) NOT NULL DEFAULT 0,
  `subject` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `site` char(255) DEFAULT NULL,
  `status` enum('opened','assigned','closed','deleted') NOT NULL DEFAULT 'opened',
  `priority` enum('1','2','3','4','5') NOT NULL DEFAULT '3',
  `resolve_by` varchar(255) DEFAULT NULL,
  `escalated_to_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports_category`
--

CREATE TABLE `reports_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports_picture`
--

CREATE TABLE `reports_picture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_anno`
--

CREATE TABLE `sel_anno` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_competenze`
--

CREATE TABLE `sel_competenze` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_diploma`
--

CREATE TABLE `sel_diploma` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_lavoro`
--

CREATE TABLE `sel_lavoro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_lingua`
--

CREATE TABLE `sel_lingua` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_lingua_livello`
--

CREATE TABLE `sel_lingua_livello` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_sedi`
--

CREATE TABLE `sel_sedi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_stato`
--

CREATE TABLE `sel_stato` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_tipo_brevetto`
--

CREATE TABLE `sel_tipo_brevetto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_tipo_indirizzo`
--

CREATE TABLE `sel_tipo_indirizzo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sel_tipo_permesso`
--

CREATE TABLE `sel_tipo_permesso` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_email`
--

CREATE TABLE `send_email` (
  `id` int(11) NOT NULL,
  `tipo` enum('S','M') NOT NULL,
  `destinatari` text NOT NULL,
  `id_destinatari` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `testo` text NOT NULL,
  `quanti` int(11) NOT NULL,
  `data_invio` datetime NOT NULL,
  `tutti` enum('Y','N') DEFAULT 'N',
  `effettuati` int(11) DEFAULT NULL,
  `data_visita` date DEFAULT NULL,
  `turno` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `centro` int(11) NOT NULL,
  `scheda` enum('T','C','NC') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_email_stats`
--

CREATE TABLE `send_email_stats` (
  `id` int(11) NOT NULL,
  `id_send` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('D','F') NOT NULL,
  `data_delivery` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_push`
--

CREATE TABLE `send_push` (
  `id` int(11) NOT NULL,
  `tipo` enum('S','M','P') NOT NULL,
  `destinatari` text NOT NULL,
  `id_destinatari` text NOT NULL,
  `sender` varchar(16) NOT NULL,
  `testo` text NOT NULL,
  `quanti` int(11) NOT NULL,
  `effettuati` int(11) NOT NULL,
  `data_invio` datetime NOT NULL,
  `tutti` enum('Y','N') DEFAULT 'N',
  `data_visita` date DEFAULT NULL,
  `sezione` int(11) NOT NULL,
  `stato` int(11) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `centro` int(11) NOT NULL,
  `scheda` enum('T','NC','C') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_push_stats`
--

CREATE TABLE `send_push_stats` (
  `id` int(11) NOT NULL,
  `id_send` int(11) NOT NULL,
  `number` varchar(16) NOT NULL,
  `status` enum('D','F') NOT NULL,
  `reason` varchar(50) NOT NULL,
  `data_delivery` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_sms`
--

CREATE TABLE `send_sms` (
  `id` int(11) NOT NULL,
  `tipo` enum('S','M') NOT NULL,
  `destinatari` text NOT NULL,
  `id_destinatari` text NOT NULL,
  `sender` varchar(16) NOT NULL,
  `testo` text NOT NULL,
  `quanti` int(11) NOT NULL,
  `effettuati` int(11) NOT NULL,
  `data_invio` datetime NOT NULL,
  `tutti` enum('Y','N') DEFAULT 'N',
  `data_visita` date DEFAULT NULL,
  `turno` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `unita_operativa` int(11) NOT NULL,
  `centro` int(11) NOT NULL,
  `scheda` enum('T','NC','C') DEFAULT NULL,
  `tipo_sms` int(11) NOT NULL,
  `risposta` text NOT NULL,
  `refer` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_sms_stats`
--

CREATE TABLE `send_sms_stats` (
  `id` int(11) NOT NULL,
  `id_send` varchar(15) NOT NULL,
  `number` varchar(16) NOT NULL,
  `status` enum('D','F') NOT NULL,
  `reason` varchar(50) NOT NULL,
  `data_delivery` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sh_preiscrizioni`
--

CREATE TABLE `sh_preiscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `luogo_nascita` varchar(30) DEFAULT NULL,
  `nazionalita` int(11) DEFAULT NULL,
  `sesso` enum('M','F') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cellulare` varchar(20) DEFAULT NULL,
  `occupazione` int(11) DEFAULT NULL,
  `prima_volta` enum('Y','N') DEFAULT NULL,
  `conoscenza` int(11) DEFAULT NULL,
  `formula` int(11) DEFAULT NULL,
  `campus` int(11) DEFAULT NULL,
  `housing` int(11) DEFAULT NULL,
  `coabitazione` varchar(255) NOT NULL,
  `data_in` date NOT NULL,
  `data_out` date NOT NULL,
  `privacy` enum('Y','N') DEFAULT NULL,
  `mailing` enum('Y','N') DEFAULT NULL,
  `note` text NOT NULL,
  `data_insert` datetime NOT NULL,
  `anno` int(11) NOT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'it-IT',
  `refer` enum('S','P') NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siti`
--

CREATE TABLE `siti` (
  `id` int(11) NOT NULL,
  `sito` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sn_focus`
--

CREATE TABLE `sn_focus` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sn_percorsi`
--

CREATE TABLE `sn_percorsi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sn_preiscrizioni`
--

CREATE TABLE `sn_preiscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `ruolo` tinyint(1) NOT NULL,
  `altro_ruolo` varchar(50) NOT NULL,
  `ente` varchar(50) NOT NULL,
  `focus` tinyint(1) NOT NULL,
  `percorso` tinyint(1) NOT NULL,
  `percorso_stato` enum('C','R') NOT NULL DEFAULT 'C',
  `data_insert` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `confermato` char(1) DEFAULT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sn_ruoli`
--

CREATE TABLE `sn_ruoli` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_alloggio`
--

CREATE TABLE `sp_alloggio` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(50) NOT NULL,
  `nome_en` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici`
--

CREATE TABLE `sp_amici` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(20) NOT NULL,
  `nome_en` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici_animali`
--

CREATE TABLE `sp_amici_animali` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici_eta`
--

CREATE TABLE `sp_amici_eta` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici_fumatori`
--

CREATE TABLE `sp_amici_fumatori` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici_genere`
--

CREATE TABLE `sp_amici_genere` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_amici_occupazione`
--

CREATE TABLE `sp_amici_occupazione` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_appartamento`
--

CREATE TABLE `sp_appartamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(125) NOT NULL,
  `nome_en` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_camera`
--

CREATE TABLE `sp_camera` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `nome_en` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_coabitazione`
--

CREATE TABLE `sp_coabitazione` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `nome_en` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_conoscenza`
--

CREATE TABLE `sp_conoscenza` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_en` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_lavoratori`
--

CREATE TABLE `sp_lavoratori` (
  `id` tinyint(4) NOT NULL,
  `tipo_it` varchar(255) NOT NULL,
  `tipo_en` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_livello`
--

CREATE TABLE `sp_livello` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `nome_en` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_occupazione`
--

CREATE TABLE `sp_occupazione` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `nome_en` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_preiscrizioni`
--

CREATE TABLE `sp_preiscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `luogo_nascita` varchar(30) DEFAULT NULL,
  `nazionalita` int(11) DEFAULT NULL,
  `codice_fiscale` varchar(20) NOT NULL,
  `residenza` varchar(50) NOT NULL,
  `cap` int(11) NOT NULL,
  `provincia` int(11) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `numero_civico` varchar(10) NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `numero_documento` varchar(11) NOT NULL,
  `scadenza_documento` date NOT NULL,
  `permesso_soggiorno` varchar(50) NOT NULL,
  `sesso` enum('M','F') DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `cellulare` varchar(20) DEFAULT NULL,
  `occupazione` int(11) DEFAULT NULL,
  `occupazione_det` varchar(50) NOT NULL,
  `studente_det` varchar(255) NOT NULL,
  `studente_livello` varchar(255) NOT NULL,
  `lavoratore_tipo` tinyint(4) NOT NULL DEFAULT 0,
  `lavoratore_altro` varchar(255) NOT NULL,
  `lavoratore_scadenza` date DEFAULT NULL,
  `prima_volta` enum('Y','N') DEFAULT NULL,
  `conoscenza` int(11) DEFAULT NULL,
  `conoscenza_det` varchar(100) NOT NULL,
  `dove_vive` int(11) DEFAULT NULL,
  `dove_vive_altro` varchar(30) DEFAULT NULL,
  `camera_amici` enum('Y','N') NOT NULL,
  `camera_amici_dettaglio` varchar(50) NOT NULL,
  `amici_genere` int(11) DEFAULT NULL,
  `amici_occupazione` tinyint(4) DEFAULT NULL,
  `amici_eta` tinyint(4) DEFAULT NULL,
  `amici_fumo` tinyint(4) DEFAULT NULL,
  `amici_animali` tinyint(4) DEFAULT NULL,
  `amici_animali_dettaglio` varchar(50) DEFAULT NULL,
  `nuova_residenza` int(11) DEFAULT NULL,
  `giorni_visita` varchar(255) DEFAULT NULL,
  `appartamento` enum('Y','N') DEFAULT NULL,
  `tipo_appartamento` int(11) NOT NULL,
  `camera` enum('Y','N') DEFAULT NULL,
  `tipo_camera` int(11) DEFAULT NULL,
  `livello` int(11) NOT NULL,
  `livello_altro` varchar(10) NOT NULL,
  `coinquilini` enum('Y','N') NOT NULL,
  `coinquilini_n` int(11) NOT NULL,
  `quartieri` varchar(200) NOT NULL,
  `fumatore` enum('Y','N') NOT NULL,
  `animali` enum('Y','N') NOT NULL,
  `animali_det` varchar(255) NOT NULL,
  `interessato` varchar(500) NOT NULL,
  `coabitazione` int(11) NOT NULL,
  `data_in` date NOT NULL,
  `data_out` date NOT NULL,
  `privacy` enum('Y','N') DEFAULT NULL,
  `mailing` enum('Y','N') DEFAULT NULL,
  `consenso` enum('Y','N') NOT NULL,
  `media` enum('Y','N') DEFAULT NULL,
  `note` text NOT NULL,
  `data_insert` datetime NOT NULL,
  `formula` int(11) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'it-IT',
  `anno` int(11) NOT NULL DEFAULT 2016,
  `camera_singola` enum('Y','N') DEFAULT NULL,
  `camera_doppia` enum('Y','N') DEFAULT NULL,
  `camera_indiferente` enum('Y','N') DEFAULT NULL,
  `amici_quanti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_province`
--

CREATE TABLE `sp_province` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `regione` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nome` varchar(255) DEFAULT NULL,
  `sigla` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_quartiere`
--

CREATE TABLE `sp_quartiere` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_residenza`
--

CREATE TABLE `sp_residenza` (
  `id` int(11) NOT NULL,
  `nome_it` varchar(100) NOT NULL,
  `nome_en` varchar(100) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_parents`
--

CREATE TABLE `survey_parents` (
  `id` int(11) NOT NULL,
  `type_stay` enum('JUN','SEN','STU','SCI','SPO') DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `assistenza` enum('M','A','P') DEFAULT NULL,
  `informazioni` enum('M','A','P') DEFAULT NULL,
  `trasferimenti` enum('M','A','P') DEFAULT NULL,
  `complessivo` enum('M','A','P') DEFAULT NULL,
  `organizzazione` enum('M','A','P') DEFAULT NULL,
  `attivita` enum('M','A','P') DEFAULT NULL,
  `esperienza` enum('M','A','P') DEFAULT NULL,
  `cura` enum('M','A','P') DEFAULT NULL,
  `communicazione` enum('M','A','P') DEFAULT NULL,
  `suggerimenti` text NOT NULL,
  `data_restituzione` date NOT NULL,
  `anno` int(11) NOT NULL,
  `email_genitore` varchar(50) NOT NULL,
  `insert_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_stays`
--

CREATE TABLE `survey_stays` (
  `id` int(11) NOT NULL,
  `tipologia_id` tinyint(4) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `organizzatore` int(11) NOT NULL,
  `type_stay` enum('JUN','SEN','STU','SCI','SPO','1','2','3','4','5') DEFAULT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nome_coordinatore` varchar(50) NOT NULL,
  `cognome_coordinatore` varchar(50) NOT NULL,
  `eta` int(11) NOT NULL,
  `nome_gruppo` varchar(50) NOT NULL,
  `cellulare` varchar(20) DEFAULT NULL,
  `divertimento` enum('M','A','P') DEFAULT NULL,
  `educatori` enum('M','A','P') DEFAULT NULL,
  `compagni` enum('M','A','P') DEFAULT NULL,
  `giochi` enum('M','A','P') DEFAULT NULL,
  `attivita_sportive` enum('M','A','P') DEFAULT NULL,
  `gite` enum('M','A','P') DEFAULT NULL,
  `laboratori` enum('M','A','P') DEFAULT NULL,
  `escursioni` enum('M','A','P') DEFAULT NULL,
  `soggiorno_esperienza` enum('M','A','P') DEFAULT NULL,
  `soggiorno_staff` enum('M','A','P') DEFAULT NULL,
  `soggiorno_communicazione` enum('M','A','P') DEFAULT NULL,
  `soggiorno_complessivo` enum('M','A','P') DEFAULT NULL,
  `studio_localita` enum('M','A','P') DEFAULT NULL,
  `studio_college` enum('M','A','P') DEFAULT NULL,
  `studio_attivita` enum('M','A','P') DEFAULT NULL,
  `studio_corso` enum('M','A','P') DEFAULT NULL,
  `studio_escursioni` enum('M','A','P') DEFAULT NULL,
  `studio_divertimento` enum('M','A','P') DEFAULT NULL,
  `studio_aspetto_vacanza` text DEFAULT NULL,
  `studio_attivita_utile` text DEFAULT NULL,
  `studio_suggerimenti` text DEFAULT NULL,
  `studio_location` enum('IT','ES') DEFAULT NULL,
  `studio_involvement` enum('P','A','M') DEFAULT NULL,
  `scientifici_organizzazione` enum('M','A','P') DEFAULT NULL,
  `scientifici_didattica` enum('M','A','P') DEFAULT NULL,
  `scientifici_formazione` enum('M','A','P') DEFAULT NULL,
  `scientifici_school_subject` varchar(255) DEFAULT NULL,
  `scientifici_modules_liked` enum('P','A','M') DEFAULT NULL,
  `scientifici_involvement` enum('P','A','M') DEFAULT NULL,
  `sport_chosen` varchar(255) DEFAULT NULL,
  `sport_organization` enum('P','A','M') DEFAULT NULL,
  `sport_involvement` enum('P','A','M') DEFAULT NULL,
  `suggerimenti` text DEFAULT NULL,
  `osservazioni` text DEFAULT NULL,
  `data_restituzione` date DEFAULT NULL,
  `anno` int(11) DEFAULT NULL,
  `insert_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_centri`
--

CREATE TABLE `tim_centri` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `iscrizione` int(11) NOT NULL,
  `online` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_fascie`
--

CREATE TABLE `tim_fascie` (
  `id` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `descrizione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_funzioni`
--

CREATE TABLE `tim_funzioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_partenze`
--

CREATE TABLE `tim_partenze` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_preiscrizioni`
--

CREATE TABLE `tim_preiscrizioni` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `codice_fiscale` varchar(16) NOT NULL,
  `nascita_luogo` varchar(150) NOT NULL,
  `nascita_data` date NOT NULL,
  `nascita_provincia` int(11) NOT NULL,
  `nazionalita` int(11) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `citta` varchar(150) NOT NULL,
  `provincia` int(11) NOT NULL,
  `cap` varchar(5) NOT NULL,
  `telefono` varchar(16) NOT NULL,
  `soggiorno` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `partenza` int(11) NOT NULL,
  `operatore_supporto` enum('Y','N') DEFAULT NULL,
  `operatore_supporto_dettaglio` varchar(255) NOT NULL,
  `allergie` enum('Y','N') NOT NULL,
  `allergie_dettaglio` varchar(255) NOT NULL,
  `problema_sanitario` enum('Y','N') DEFAULT NULL,
  `problema_sanitario_dettaglio` text DEFAULT NULL,
  `genitore_nome` varchar(100) NOT NULL,
  `genitore_cognome` varchar(100) NOT NULL,
  `genitore_codice_fiscale` varchar(16) NOT NULL,
  `genitore_societa` int(11) NOT NULL,
  `genitore_funzione` int(11) NOT NULL,
  `cid` varchar(10) NOT NULL,
  `localita` varchar(255) NOT NULL,
  `genitore_provincia` int(11) NOT NULL,
  `genitore_cap` varchar(5) NOT NULL,
  `genitore_telefono` varchar(16) NOT NULL,
  `genitore_cellulare` varchar(16) NOT NULL,
  `genitore_email` varchar(255) NOT NULL,
  `genitore_lavoro` int(11) NOT NULL,
  `altro_genitore` enum('Y','N') DEFAULT NULL,
  `secondo_genitore_nome` varchar(150) NOT NULL,
  `secondo_genitore_cognome` varchar(150) NOT NULL,
  `secondo_genitore_codice_fiscale` varchar(16) NOT NULL,
  `secondo_genitore_nascita_luogo` varchar(150) NOT NULL,
  `secondo_genitore_nascita_data` date NOT NULL,
  `secondo_genitore_provincia` int(11) NOT NULL,
  `iscrizione` int(11) NOT NULL,
  `reddito` int(11) NOT NULL,
  `data_iscrizione` datetime NOT NULL,
  `codice` varchar(10) NOT NULL,
  `modulo_conformita` varchar(150) NOT NULL,
  `modulo_genitore` varchar(150) NOT NULL,
  `modulo_secondo_genitore` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_sedi`
--

CREATE TABLE `tim_sedi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_societa`
--

CREATE TABLE `tim_societa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_soggiorni`
--

CREATE TABLE `tim_soggiorni` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim_turni`
--

CREATE TABLE `tim_turni` (
  `id` int(11) NOT NULL,
  `codice` varchar(100) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `iscrizione` int(11) NOT NULL,
  `centro` int(11) NOT NULL,
  `online` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_sms`
--

CREATE TABLE `tmp_sms` (
  `id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `fall` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `un_attivita`
--

CREATE TABLE `un_attivita` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `un_questionario`
--

CREATE TABLE `un_questionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `turno` int(11) NOT NULL,
  `attivita` int(11) NOT NULL,
  `privacy` enum('Y','N') NOT NULL,
  `informativa` enum('Y','N') NOT NULL,
  `email` varchar(50) NOT NULL,
  `cellulare` varchar(50) NOT NULL,
  `data_insert` date NOT NULL,
  `anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `un_turni`
--

CREATE TABLE `un_turni` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `id_signal` varchar(255) NOT NULL,
  `user` varchar(60) NOT NULL,
  `password_hash` varchar(120) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'N',
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 2,
  `user_unita` varchar(50) DEFAULT NULL,
  `user_centro` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `avatar` varchar(50) NOT NULL,
  `preiscrizione_sn` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_sp` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_cs` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_sh` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_tim` enum('Y','N') DEFAULT 'N',
  `preiscrizione_fo` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_junior` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_senior` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_scientifici` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_sport` enum('Y','N') DEFAULT 'N',
  `q_studio` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_doc` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_campus` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_keluar` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_sharing` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_formazione` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_vacanza` enum('Y','N') NOT NULL DEFAULT 'N',
  `preiscrizione_cm` enum('Y','N') DEFAULT 'N',
  `push_qualita` enum('Y','N') DEFAULT NULL,
  `push_centriestivi` enum('Y','N') DEFAULT NULL,
  `verifiche_ispettive` enum('Y','N') NOT NULL DEFAULT 'N',
  `formazione` enum('Y','N') NOT NULL DEFAULT 'N',
  `statistiche` enum('Y','N') NOT NULL DEFAULT 'N',
  `letture_contatori` enum('Y','N') NOT NULL DEFAULT 'N',
  `utenze` enum('Y','N') NOT NULL DEFAULT 'N',
  `documenti_qualita` enum('Y','N') NOT NULL DEFAULT 'N',
  `documenti_soggiorni` enum('Y','N') NOT NULL DEFAULT 'N',
  `area_documenti` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_maintenance_lead` enum('N','Y') NOT NULL DEFAULT 'N',
  `password_expired_at` timestamp NULL DEFAULT NULL,
  `activation_token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`id`, `id_signal`, `user`, `password_hash`, `is_active`, `nome`, `cognome`, `email`, `cellulare`, `password`, `user_type`, `user_unita`, `user_centro`, `last_login`, `avatar`, `preiscrizione_sn`, `preiscrizione_sp`, `preiscrizione_cs`, `preiscrizione_sh`, `preiscrizione_tim`, `preiscrizione_fo`, `q_junior`, `q_senior`, `q_scientifici`, `q_sport`, `q_studio`, `q_doc`, `q_campus`, `q_keluar`, `q_sharing`, `q_formazione`, `q_vacanza`, `preiscrizione_cm`, `push_qualita`, `push_centriestivi`, `verifiche_ispettive`, `formazione`, `statistiche`, `letture_contatori`, `utenze`, `documenti_qualita`, `documenti_soggiorni`, `area_documenti`, `is_maintenance_lead`, `password_expired_at`, `activation_token`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(37, 'f6m4E2DjoA8:APA91bHlzqEYnZjycauoQnYpKWoGHlrE9c0QHfjdFAVZEDjt-GGBD6TjUPWZIJ5RpRQ3j8xLN6K1i3jgSgAZEynFmPpVzkMYFYfibbSaMTT6REUGRpovoEJSGa5zyT8taMfxPfeRyp9Y', 'federico.gribaudo', '$6$NL/6hAcP1QSzfB8Q$vKuJurLanDrReQzEPIJ5DzjM/e6wvqxVzN.AqSml5mbd8GqAqeOqCwp.zm0WwvlqFqWpvNrvVEI0bESmCHVYi1', 'Y', 'Federico', 'Gribaudo', 'federico.gribaudo@cooperativadoc.it', '', 'Igor@2026!', 8, '9,47,182,155,71,5,198,19,200,8,58,50,156,12', '18', '2023-04-05 15:14:37', '', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', NULL, 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'Y', 'N', 'N', '2026-09-08 00:00:00', NULL, NULL, NULL, NULL, '2026-05-11 14:57:08'),
(62, 'dVupMEXBSi8:APA91bHLHThQH2uWhggYRs0dw-qG9zsPLKyluEi3apLiGikhJz7Oc0n9OrG4J0EBVh-yF7k-UhPDoIpK93V_izY3VQmco607ZpJTooNWA1VIFyroHpz4VRHBfoYD93O7Jgsyy7hbqT_W', 'admin', '$6$GxcDO2ho06luI1py$SPzAuvQ5KYlZ63IDI/VTmhaSZM1EEkNF.Zpd25pB6cmkTavzucAfUGQY7nFjLf.dHSxnvL6ce8zfsDNsXKONV/', 'Y', 'Mario', 'Ferretti', 'mario.ferretti@cooperativadoc.it', '', 'kth2GVE.twu0ezk8akq', 8, '', NULL, '2023-05-12 08:48:39', 'logo-roma-vecchio-nuovo.jpg', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', NULL, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', '2026-10-29 00:00:00', NULL, NULL, NULL, NULL, '2026-07-01 16:19:46'),
(100, 'cdo30lqQwQ0:APA91bGJeHFz5xXBddzAFziE_YAhhggTjPkwp52f3Vb0sFXqQ4Nade0opaOb1E7Q4EGCoW3TyvDM-SiMwaY8d2Ebb13qXDnqV1XaMdyxNKDVCCCOwHgqq34N1p08GTZxsuqS_njl1q5s', 'archynet', '$6$YJk0+GmQkhhS7jJw$1Mj6.BL119yHEA/95Ru34nzIU2lCc70Q4n.QISoQWjHqZqqOXG.gJVUFAez/M0stB68pDg4gHKDkQOyvz59C3.', 'Y', 'Message', 'GlobeSrl', 'dedalus80+test@gmail.com', '', 'Dj*1b5k0', 9, '', NULL, '2023-05-16 10:56:05', 'avatar.jpg', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N', 'N', '2026-07-14 00:00:00', NULL, NULL, NULL, NULL, '2026-03-16 17:34:51'),
(112, '', 'archynet1', '$6$oInTqYZbFThh3FJJ$c4RkFfrm3Jx3ajzGI9Ndqn.l3LoeLEx9EvnkLSxYKkSAmLE9/u0hqUXndkkGNrijSnGxgcPm2C7NlbAqw0PmB1', 'Y', 'Luciano', 'Ciaramella', 'dedalus80@gmail.com', '', 'lyR07Fx^C5nb', 7, '71', NULL, '2019-11-08 17:13:59', '', 'N', 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', '2026-05-19 00:00:00', NULL, NULL, NULL, NULL, '2026-04-08 16:34:53'),
(131, '', 'alessandra.fasano', '$6$7H83Tq0+7cM0EF70$AFIMcbX.1fE2rTkmZseEZl8JicXLhRNlpVhRw7QRakNJCZ1y7VUtnIrzN0gYrdFC3Nlv5Xx1QrfwH.8dlcIVu0', 'Y', 'Alessandra ', 'Fasano', 'alessandra.fasano@cooperativadoc.it', '', 'Alessandra8581?!', 5, '191,213,176', NULL, '2022-12-09 10:11:16', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-09-09 00:00:00', NULL, NULL, NULL, NULL, '2026-05-12 20:58:44'),
(132, '', 'pamela.lanzafame', '$6$MCbakxw2xikZmc6H$pC5tblGhr8vQtu2wS/jTrYxXzpYT3hugS3JQnT5qtGvEJoT9OOUMjrEuT4IJkHIZvS2cIe5VZCn.IUjj9duqP1', 'Y', 'Pamela', 'Lanzafame', 'pamela.lanzafame@cooperativadoc.it', '', 'Noemistefanelli6!', 2, '191,213,232,211,230,247,212,246,248,297,190', NULL, '2022-05-11 12:21:18', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-11-14 22:00:00', NULL, NULL, NULL, NULL, '2026-04-29 11:57:05'),
(133, '', 'angela.tonti', '$6$ZkiMu9X5bsy3xAIU$bkGKQn4b04T7Y3g5wg6DosrKEU7stQsEiozdOlyHfFm.HFKI5RhDjKgEzdKCS773oD52CQAqhL0N4SStyqUQ9/', 'Y', 'Angela ', 'Tonti ', 'angela.tonti@cooperativadoc.it ', '', 'aNGELA.17!', 5, '184,185,224,225,223,201,275,235,261,276', NULL, '2022-07-31 07:50:17', 'urban.png', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-08-26 00:00:00', NULL, NULL, NULL, NULL, '2026-04-28 17:59:41'),
(134, '', 'aurora.vessio', '$6$2kmIHov/ZIdMih0S$JjRAtdbtbLydnT2fogTkPXzLFB2mxE8pIHChwDxFA7ZnU.YzIjr2VDYomjrhK1irjAJ7ebnaQr3HdWZ94plQR/', 'Y', 'Aurora ', 'Vessio', 'aurora.vessio@cooperativadoc.it', '', '100388Av.', 5, '182,183,186,203,205,274,240,262,310', NULL, '2022-07-15 20:48:23', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-08-07 00:00:00', NULL, NULL, NULL, NULL, '2026-04-29 11:41:45'),
(140, '', 'angelo.toches', '$6$4SDJ/yFw0G0N87Iw$jPYZoKFUjxCeB8UEhv0BBJxSijojE/evDH.XSw2zQ1/RShCtM4lKCRcV1OBNo3wVsZeQJV67l5ZXXUgK4630/0', 'Y', 'Angelo ', 'Tosches', 'angelo.tosches@cooperativadoc.it', '', 'JUveNTus1897!', 2, '184,185', NULL, '2022-08-05 19:21:38', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-09-24 22:00:00', NULL, NULL, NULL, NULL, NULL),
(141, '', 'fabrizio.rinaldi', '$6$dXNqEwnJefkq2O1d$q9kH.m9vhl9BrckbcWJklGeKvcseTknwhys/1tx6T04.fbZMyOtU4LeEjz8M.KT7mF2lVChxd/EKAR8KnFD4J.', 'Y', 'Fabrizio', 'Rinaldi', 'fabrizio.rinaldi@cooperativadoc.it', '', 'Bertoloni01!', 5, '194,196', NULL, '2023-04-12 06:42:35', 'IMG-20191019-WA00053.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-09-27 00:00:00', NULL, NULL, NULL, NULL, '2026-05-30 06:15:24'),
(142, '', 'fabio.silvetti', '$6$F37TFRNHSi2OeWii$ywG6LyubHj1ij1LtaGON.9S4zD7KJUihZGtYv0X/.utQz0fVBT7bi.YcZ3a7Bp304/ikzZ3pvq1yD11UjS7380', 'Y', 'Fabio', 'Silvetti', 'fabio.silvetti@cooperativadoc.it', '', 'Samiola75!', 5, '192', NULL, '2023-03-22 12:00:26', 'a.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-10-03 00:00:00', NULL, NULL, NULL, NULL, '2026-06-05 11:39:01'),
(143, '', 'paolo.dossena', '$6$8tq5wY0urUZPP3ec$noCsXAwYuo5NKWCXGxPD9teG5zEH8wQ6IhPiqVd8jn.FRSL/8e4uUcrFRmL7DbLqmaKUqgWDnt72i0BMB0pbL0', 'Y', 'Paolo ', 'Dossena', 'paolo.dossena@cooperativadoc.it', '', 'Pd18081974!', 5, '304', NULL, '2022-05-13 21:24:35', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'Y', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2025-05-31 00:00:00', NULL, NULL, NULL, NULL, '2026-06-07 23:54:00'),
(144, '', 'rosa.ronzio', '$6$v6DfOemwT7sxmyfv$2hrcrTDUqh7uY54v6jPf60GIjQRpaPrsms2pY7CFVXLvo/51Z3KDMjdQs3E69l0PyCVooqzx4Njm051an6H6V1', 'Y', 'Rosa ', 'Ronzio', 'rosa.ronzio@cooperativadoc.it', '', 'QUAqua2026%', 7, '189,187,183,186,176,193,194,192,195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-10-08 00:00:00', NULL, NULL, NULL, NULL, '2026-06-10 17:52:34'),
(145, '', 'francesca.paoluzzi', '$6$mRBClJldMossJSgD$ykxOTmfJcF1lPn7U6qa37S6b253Sj5QgjecfhocvY7ijH7NfAyeTXpjuWOezsbEc/xnWa77RblRmy.pYEAXB90', 'Y', 'Francesca', 'Paoluzzi', 'francesca.paoluzzi@cooperativadoc.it', '', 'Bea1!Pissi2', 5, '194', NULL, '2023-04-06 09:21:48', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-09-26 00:00:00', NULL, NULL, NULL, NULL, '2026-05-29 11:57:24'),
(146, '', 'luna.sette', '$6$EBqWnkrvM54e2Trj$9XnsLYiXD8gpQV6/Oelk66VwKDPIxoLGSco3mkugHijQUroGCIgDdXj35jTzIG8ackm0S2orUybsHGpQBrkJf0', 'Y', 'Luna Esterina', 'Sette ', 'luna.sette@stessopiano.it', '', 'Stessopiano.25', 3, '58', NULL, '2023-01-17 13:00:26', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-05-23 00:00:00', NULL, NULL, NULL, NULL, '2026-01-23 10:15:10'),
(147, '', 'simona.dellarocca', '$6$/7u/vlvc9IL2kJy5$Qm/ZZ9bLPkzekqJEWQ/RUdIlMiaOOltj3e077lJA9GFqKMlgPPb1raoL6RJ7a/LaA444U5U658kelJtwQdS4u/', 'Y', 'Simona', 'Della Rocca', 'simona.dellarocca@stessopiano.it', '', 'Doc062', 2, '58', NULL, '2022-05-10 10:12:59', '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(148, '', 'renato.domini', '$6$KWwpfL9/v4bt5PFS$917SqNvN0ffTad/iUkvO8wVt9xm/X1FtpAzWGnHZGXhk6vUwtnCoVCCLsUQy6UPSWJ6xuOXoApfqjIDpzF62P/', 'Y', 'Renato ', 'Domini ', 'renato.domini@cooperativadoc.it', '', 'rD29792212A!\"£$', 3, '8,176,193,194,192,195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-08-07 00:00:00', NULL, NULL, NULL, NULL, '2026-04-09 10:02:01'),
(149, '', 'claudio.sarboraria', '$6$cWSbStDAedvT6kaY$rw/0R6SDlyaxq4fIOPDx8buMVefBKRvfejosbBzPR0GZ5ZW20TSV4I5jKrJhcPVLb2LTAe1JBOeroL67z7y1T.', 'Y', 'Claudio', 'Sarboraria', 'claudio.sarboraria@cooperativadoc.it', '', 'Sharing26!', 3, '8,156', NULL, '2022-11-28 15:12:08', '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-10-21 00:00:00', NULL, NULL, NULL, NULL, '2026-06-23 16:36:45'),
(150, '', 'maria.ficcaglia', '$6$wjjyqa2JeWArOuoA$bu7rDsgs0S6Jl4O2x2P439DH3qJzkN1bT3PXbaC9.GhFbQrWGdUMaFOYU5V./XMNv563ertTnSskzsppTFjqo/', 'Y', 'Maria ', 'Ficcaglia', 'maria.ficcaglia@cooperativadoc.it', '', '@Doc065@', 3, '155', NULL, '2022-06-13 13:43:21', '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-10-28 00:00:00', NULL, NULL, NULL, NULL, '2026-06-30 11:11:42'),
(151, '', 'gianluca.cuccia', '$6$xhj+4Qk15E7ixvKn$HNwAlVXOhlEuuJGPdFZO55fXP/NDkVW9GOj87jgWdvN9tqyhToWPRcI.vybfpxf/jBBJktCJaWqNAF5ao1IX7.', 'Y', 'Gianluca', 'Cuccia', 'gianluca.cuccia@cooperativadoc.it', '', 'Campus2026!#', 3, '47', NULL, '2023-05-15 12:39:14', '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-07-24 00:00:00', NULL, NULL, NULL, NULL, '2026-03-26 13:04:06'),
(152, '', 'damiano.mana', '$6$ZF21lS1jnL7ibRxT$a7gvQP5jqlzCe1OMJqDtO63CSYEXDEAwkM5sCJhXK507wiFJyYS6eEylPA5uVblnVhNN87X/8JPV1UJVCvxt4.', 'Y', 'Damiano ', 'Mana', 'damiano.mana@cooperativadoc.it', '', '1989Comm!', 5, '225,275,276,198,71,12', NULL, '2022-07-31 07:50:42', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', '2026-08-07 00:00:00', NULL, NULL, NULL, NULL, '2026-04-09 10:01:57'),
(153, '', 'biagio.bellonese', '$6$vE9m+qa17TsFROHZ$tx1DmIBrgLJrluT8lc73mrlXVzU1FjPkN9pZGZVyEvBGrxiNcVaB9O1Z6j7wDPYV9SloWD83vSt3GH77xvEHm0', 'Y', 'Biagio ', 'Bellonese', 'biagio.bellonese@cooperativadoc.it', '', 'Andrea10&', 7, '184,185,47,176,193,194,192,195,187,182,186,180,190', NULL, '2023-03-13 08:44:06', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-10-03 00:00:00', NULL, NULL, NULL, NULL, '2026-06-05 10:01:11'),
(154, '', 'davide.marotta', '$6$9ayOZPPMpeXtfVDP$RVs2Axyhed9A2hin1OJtGrrF9uEB8Qmx0QXJWxgoCihJaS3YcGnBaf./V3x31DXo77emSndbe0cPj8g0ILOyp1', 'Y', 'Davide', 'Marotta', 'davide.marotta@cooperativadoc.it', '', 'Soggiorni*03', 3, '155,182,19,183,186,205,203,262,240,274,310', NULL, NULL, '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2024-11-18 22:00:00', NULL, NULL, NULL, NULL, '2026-04-29 11:42:33'),
(155, '', 'anna.saracino', '$6$BLfQZsLny9wYbTxH$ni1aINjC/cTMH4sDiwqTGwfX9CpC2vQren/nxVU5i6Q6KnW.O8ssZ5BYYqm1WrM1CuaiXBNpr6KPszpXEIJaw0', 'Y', 'Anna ', 'Saracino', 'anna.saracino@cooperativadoc.it', '', 'Doc070', 5, '183,186,203,205,224,235,296,184,223,261,185,201', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, '2026-06-07 23:25:34'),
(158, '', 'enrico.boenzi', '$6$G52Rg3C9oFdxEGIY$tYiM2b4HhrzEaqZxDFgAiSusaqeRorcCYRYN3RGuSMitPN8aMziKcgwXzZrZtOglap3teARJ6o7Ko3lZlFciH0', 'Y', 'Enrico', 'Boenzi', 'enrico.boenzi@cooperativadoc.it', '', 'Dirtypl1596!!', 8, '197,196,216,215,264,241,243,242,47,155,262,71,5,8', NULL, '2023-05-15 15:02:34', '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'N', NULL, NULL, 'N', 'Y', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'N', '2026-08-11 00:00:00', NULL, NULL, NULL, NULL, '2026-04-13 14:43:04'),
(159, '', 'lello.merola', '$6$2KWPdMiLRJWapfwF$hw3YNNOWSI9IY2mvtE2N483yqN9bfwZs5DD1KVZe4C6TIR7mleGQKTAo4B4wcMlapcSXVnBueqHo2qV2i1jKd.', 'Y', 'Lello ', 'Merola', 'raffaele.merola@stessopiano.it', '', 'SP202203!', 7, '58', NULL, NULL, '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(164, '', 'alessandro.mariani', '$6$quzmYJeH6pBKQLxI$KfIhKKLkec78M3OqXpxD/1ONF.RqWShXk9L21J/eqASPY77rm6UTu/O2v/cI82ILHjveZT35IivZC0atkOQWE0', 'Y', 'Alessandro', 'Mariani', 'alessandro.mariani@cooperativadoc.it', '', 'Qualitaale72! ', 3, '176,193,194,192,195', NULL, '2023-03-14 10:25:53', 'FOTO PER MAIL.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-11-04 00:00:00', NULL, NULL, NULL, NULL, '2026-07-07 11:19:36'),
(166, '', 'francesco.ferraro', '$6$rTRyM+CZu7gRAi/9$vJOQZm7Y5iIqpMhIxXgvM02MKtjhO15LCncmAmaVtRGZK01DwvsCXkmNsx.dveVqZk1o2EB8gNxIvZejtPT5y1', 'Y', 'Francesco ', 'Ferraro', 'francesco.ferraro@cooperativadoc.it', '', 'Doc079', 3, '50,191', NULL, '2022-12-29 14:53:16', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(167, '', 'emilio.perni', '$6$JZF09Vhh79TF+ip+$lUlvh7kC/8Or.B/ocSFdi9HEeOdBUOb2xIFkoQslBRsUjZF2wgaVZ8D7GKc2hRuXgwS/o0qHfDmc/mjqruuNI0', 'Y', 'Emilio', 'Perni', 'emilio.perni@keluar.it', '', '826+!Emi', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2024-01-12 22:00:00', NULL, NULL, NULL, NULL, NULL),
(168, '', 'elisabetta.rossi', '$6$be/KpIDcyKp4iVI4$e/CJHKSY3/3lsxYb7ojTJXomiNZLIHsVWSOo6gqe3o7Wt361KIhXSUOC7JGCxjZut9RNpex5jxRerhOwzKUup/', 'Y', 'Elisabetta', 'Rossi', 'elisabetta.rossi@keluar.it', '', 'DoC79', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(169, '', 'gabriele.bartesaghi', '$6$651PtR3Yh/RI8L7z$AUY.hP6OgnJwX9GQEjMdxVA7tEkF0afrqavi22vwMhCZzMyl2Zb0wffzhPfgJTXazIBJlMnTzj6IhrSEiRPBT.', 'Y', 'Gabriele', 'Bartesaghi', 'gabriele.bartesaghi@keluar.it', '', 'Doc080', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(171, '', 'anna.pacera', '$6$Byw251HceffxjGMh$pVNjYD6bn280TxXdKcfAjhfzaX5VBQsG6cKDvhDsQHC2VwZekQfJ6lLz0M4XEcdLvpI4hNidVCPUhw5j8VulZ/', 'Y', 'Anna', 'Pacera', 'anna.pacera@cooperativadoc.it', '', 'ANNpac2022', 2, '71,198', NULL, '2022-06-11 11:38:03', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(172, '', 'concetta.digregorio', '$6$vw7QL+BFkCRld7BN$GSVpbIAm.UoXFfbV1t0qyI0WsLlSiumx/LUxSQfTzGMoowvWkENW9xKYe2lZdZzIYjZCqECjXOxOjKXB9heRG.', 'Y', 'Concetta', 'Di Gregorio', 'concetta.digregorio@cooperativadoc.it', '', 'Doc084', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(173, '', 'francesca.giordano', '$6$1CPhY8MRGdf8wuXh$e4WOPXXrX4QyhepLStHNZX7pnqYhoKhzbWCEGG56DiLeNtKc.IzA1EnNFtzqs/Zv/4tKkq68SpxKiqqSaUVF1/', 'Y', 'Francesca', 'Giordano', 'francesca.giordano@cooperativadoc.it', '', 'Doc085', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(174, '', 'luca.pugliese', '$6$eML8j313i2MAALES$RaVxO6piPoW54WrqPd6Wrp4rm/HLKebwGGBbTuSMGjTiPDx/Zi.pP37sojzhYwv.Dh3C4auru9KBa8.oJIveE/', 'Y', 'Luca', 'Pugliese', 'luca.pugliese@cooperativadoc.it', '', 'Doc086', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(175, '', 'gabriella.posa', '$6$jZygErxiWFZxFRCW$fudFHO4PMH3/KPXNv6vhqGwtFl2n3tg3UQrlJlF0CPUj2AA07Bs31RY622PupLMdIyw/prDp3WfM3kcSjgD59/', 'Y', 'Gabriella', 'Posa', 'gabriella.posa@cooperativadoc.it', '', 'Doc08824!', 7, '71,198', NULL, '2023-05-10 12:56:13', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2024-05-13 22:00:00', NULL, NULL, NULL, NULL, NULL),
(176, '', 'francesco.marchetti', '$6$KVtOqEiNVPam0cZ9$/oxspjl0rzg4QrUUcQxbAC.6bXgM99/kKg0eWPCBMWOg3UYHKfZ3y8jgfvYpNmYDg/XwNgasIN82byNDXi8IA.', 'Y', 'Francesco', 'Marchetti', 'francesco.marchetti@cooperativadoc.it', '', 'Doc088', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(177, '', 'christian.bau', '$6$cevg68CXehV/Ka0E$wHLqOe2iTTD5ZmwlIUpdBmEaIHnrccIyCVTAcQP7kZc1op2Y34iGKzvi5PUbzAlyH3WdSZMtqVJFwp11IRGd11', 'Y', 'Christian', 'Bau', 'christian.bau@cooperativadoc.it', '', 'NkifXM!Nfq6athe', 3, '5,71,198,12', NULL, '2023-04-03 13:20:01', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-10-20 00:00:00', NULL, NULL, NULL, NULL, '2026-06-22 15:01:04'),
(178, '', 'ignazio.cafarelli', '$6$NLcOKdW1613o0RSB$7Hy9xskb6L597WDPSSjT.xElXgv3NyPL2MVgoPKATmwNN63SGxd2LZsdYUEQA2roIPInews9qI2l0FvyLEFSP/', 'Y', 'Ignazio', 'Cafarelli', 'ignazio.cafarelli@cooperativadoc.it', '', 'Venezia25!', 3, '5', NULL, '2023-01-23 09:46:10', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-05-17 00:00:00', NULL, NULL, NULL, NULL, '2025-01-17 10:58:49'),
(179, '', 'chiara.dominioni', '$6$S3n5iRtzjSChWoJ6$cVZ4a.6EIzMk17rDnZsbIcyXldG3clJiiBmbVRD96PyzkRbl6sG7ocBzf33f06XGudSUAxpKnwyqDnXyo9JD9.', 'Y', 'Chiara', 'Dominioni', 'chiara.dominioni@cooperativadoc.it', '', 'Doc091', 2, '199', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(180, '', 'paolo.mascherpa', '$6$olwkEMGq1hvHlzEf$G/39ui.Z2XjmE33LBIFVaaDLTfXLMnEZxwse.lk.1YSmCroY.oLuMUPeJIc8teyweyUpw9We6Y1iH584z36jH/', 'Y', 'Paolo', 'Mascherpa', 'paolo.mascherpa@cooperativadoc.it', '', 'Doc92', 2, '71,198', NULL, '2022-05-12 10:41:18', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(181, '', 'carlo.scati', '$6$kfGyIsicCrxiGwqL$iCaKCOCI8dIUif/81z/tCIebdhGhbaTKK/AkeZRKk5I0gs7UyXKuEa6N0GYAOXP1hVnhrLjogZDhy5/1ANp2S0', 'Y', 'Carlo', 'Scati', 'carlo.scati@cooperativadoc.it', '', 'cONTROLLO2025!', 8, '71,198,199,262', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-05-16 00:00:00', NULL, NULL, NULL, NULL, '2025-01-16 15:51:58'),
(182, '', 'valentina.amerio', '$6$C1/y0O/d44d+PVUO$C3gfPHm8nOAXZVu2/5rqr5uB/jCMx3jhiAKVjSPc5OQ1bMxL76VEcgJI/Gi6PLsMZH23.wJYFwGB1S7QAWXa0/', 'Y', 'Valentina', 'Amerio', 'valentina.amerio@cooperativadoc.it', '', 'Doc102', 2, '71,198', NULL, '2022-05-12 09:40:17', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(183, '', 'paola.marchesin', '$6$5j/9SE/mu2a9AvJU$HD5.455Mwu3OctL1rL5l45UnHcw/tBJbsRGNkT.ifVlsKaHslQbJiSfiCWL3/ILM1GK8r8n8rJzE4Yned/ae91', 'Y', 'Paola', 'Marchesin', 'paola.marchesin@cooperativadoc.it', '', 'Doc103', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(184, '', 'mariagrazia.ravera', '$6$B3L9ei4HN1LaNPRX$E02TPqlalzf3lCrZ.bCRcovDODtibBYJKpqkeIHNFP/ntpOQmglsAtcBNuk8.Gs74HT2Xo/oFP0eMePVW92x5.', 'Y', 'Maria Grazia', 'Ravera', 'mariagrazia.ravera@cooperativadoc.it', '', 'Doc104', 2, '71,198', NULL, '2022-05-13 14:05:26', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(185, '', 'fiorenza.sette', '$6$o+PgShb7lplLUVSF$YqcfDW7snLYSehmbItmR3/80.BNjpqRF5bcdKPH3mt4aazEQ.eJdJoCE1sdYlhYVlY9mqNOM1eCDs4PAQsWiy.', 'Y', 'Fiorenza', 'Sette', 'fiorenza.sette@cooperativadoc.it', '', 'Doc2022', 2, '71,198', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(186, '', 'oriana.casamassima', '$6$ZGlVZmTNn9NL5ekL$wZJhUCKGbZuxdfegeNk9q9QFSJhaYRH501xsd.UjDttYhQW1407xu9.IkGz02i03mC4j.QYOQfErBvHUMjbQN1', 'Y', 'Oriana', 'Casamassima', 'oriana.casamassima@cooperativadoc.it', '', 'Casa.massima.4!', 3, '50', NULL, '2023-02-05 09:52:30', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-10-20 00:00:00', NULL, NULL, NULL, NULL, '2025-06-22 19:55:03'),
(187, '', 'mariateresa.rossi', '$6$S13f0rVi3R9uDr4I$fQ3uC5lgXhgIyNM2t1p6.8jaJKxtRwYVkBWj4gbJUvz.vOl2JToyBQe9IL7fo9ref0yPUkrWfUqFvl3eTOtS31', 'Y', 'Maria Teresa', 'Rossi', 'mariateresa.rossi@cooperativadoc.it', '', 'mate060620!BB', 8, '71,184,185,47,199,176,196,178,193,194,192,195,187', NULL, '2023-01-12 09:42:26', '', 'Y', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-09-26 00:00:00', NULL, NULL, NULL, NULL, '2026-05-29 09:03:22'),
(188, '', 'federico.aru', '$6$7xMXa9zyPNbbXsi6$bQk6S8o9sTZ2r2C5GVEvE6LfjvK9Vz1DfYg3PYESaGrdOCbEPqZZzee0a4ygQyaM9DC5TamoGLn15nQmS4Lao/', 'Y', 'Federico', 'Aru', 'federico.aru@cooperativadoc.it', '', 'Alessandro2026!', 8, '196,71', NULL, '2023-03-26 13:18:09', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-07-15 00:00:00', NULL, NULL, NULL, NULL, '2026-03-17 13:32:12'),
(189, '', 'gianluca.castaldini', '$6$opL8n9BrRtOIahvT$imAqbUEPbsu0l8Eli9mJYFYVXPsQjoTBLqgFCOfmPKHTSU9tuL6o8JEBMTpiEBeS5vwptIzBznN7DYeJFTexF/', 'Y', 'Gian Luca', 'Castaldini', 'gianluca.castaldini@cooperativadoc.it', '', 'Doc4785', 3, '47,71', NULL, NULL, '', 'N', 'N', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(190, '', 'francesca.dicuonzo', '$6$W9mMUfpW4d215hTp$rTKdo.8IW/IETWdnb9KqVa8c2m4Vs2Hz1HKipieUHP2.RdDrvmAfCxjLGvPl4QRMXPgSOEXpEWDdFHq3Wwa.U/', 'Y', 'Francesca', 'Di Cuonzo', 'francesca.dicuonzo@cooperativadoc.it', '', 'Tanzania77$', 3, '156', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-02-03 22:00:00', NULL, NULL, NULL, NULL, NULL),
(191, '', 'marialuisa.travascio', '$6$p8XTkOFC4Q8TzB/i$69B1IKUJK3cdodN2hGNMd3eouKf4WBDQ2X3tkWMHoEL/hXnkbERnsplD8kQ3OqcYRIBtsbzE5OavKjNHGm2Ad1', 'Y', 'Maria Luisa', 'Travascio ', 'marialuisa.travascio@stessopiano.it', '', 'SP202204!', 2, '58', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(193, '', 'elisabetta.cattaneo', '$6$M8wHTqdyWwy9NJCU$pNBHlB1PB.RcZcfBKIdEkk8OqFMELk.QOHiNSf184LVkOc/D4Lvj.GCyLuRSoLsLZApAU23YlwKRHwcTO1NUJ1', 'Y', 'Elisabetta', 'Cattaneo', 'elisabettacattaneo91@gmail.com', '', 'Eli17', 2, '182,183', NULL, '2022-05-19 23:29:55', '1650454198389.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(194, '', 'REXO', '$6$zwc0y4ov+Ql3NCav$bGSGrbP2HurUz36TqQFsVQHSIuxIICuY5KhqoVavyMNODPPcPE89RWLrQ/8u5n8pGGgfGwiOLfCWvV9H3ltU/.', 'Y', 'Riccardo ', 'Terrile ', 'supportoIT@cooperativadoc.it', '', 'dpoIZ3Gb_Di9^oOIF!kQQ83', 2, '71,198,8', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(195, '', 'loredana.panepinto', '$6$Pj6I1SxO6cRK4bH5$yKCOnBM0zt1k8yc1qYdeD1wtgc9vhxF9KNBOcFC27uNzbpFwHQYsSX3QD90usC8qfNBo3vPOseHFwpZD2/y4b0', 'Y', 'Loredana', 'Panepinto', 'loredana.panepinto@cooperativadoc.it', '', 'T0rino22!', 3, '200', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-08-07 00:00:00', NULL, NULL, NULL, NULL, '2026-04-09 10:08:37'),
(196, '', 'alessandra.baggia', '$6$ULnxC3kxkBujBOJZ$LEUHM2ccFgBgFmDWLHsRhb4oyrJC.fg5cDkuqPc993d5xmfH/Eo4GKHxlyAzihnj.hucLoX8vLv9bxbzZc/TO0', 'Y', 'Alessandra ', 'Baggia', 'alessandra.baggia@keluar.it', '', 'ALLE2922c\"\"\"?', 8, '', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-01-27 00:00:00', NULL, NULL, NULL, NULL, '2025-09-29 10:18:41'),
(198, '', 'fany.ngoune', '$6$cCNqy9BL5H7rrzG1$12e6YxkNiQxhsnc7iZG3VkkfUxG6dM/vaB3HNyVuz1.0LOZuLvk0CT.7JzealSN4bR/EgkoXYoCrU51DJQVWJ1', 'Y', 'Fany Valerie', 'Fouelefack Ngoune', 'f.ngoune@yahoo.fr', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(199, '', 'giulia.ditata', '$6$cMly84HijXmztaci$TCADqn3qWq5Z59ja/HutbSYx.PZ6uVCXmXXk.0T5uzRobSR4Zw8cVs9fUoHZ.X9ji/D6.wEI4vdpRnVicJe3t.', 'Y', 'Giulia', 'Di Tata', 'giulia.ditata@hotmail.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(200, '', 'laura.lacatus', '$6$XtQy3pGLXvZNIqNC$it6hyauSYfLM18gX.3yahKyyJ5UBjWdUU/9xkXZYQ4vt/Y1itcPjIz.hA6nhFOGQ/PD4itiBDfUKnB9.sYn8S.', 'Y', 'Laura', 'Lacatus', 'laura8285@yahoo.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(201, '', 'loredana.sannino', '$6$XoU5TMpMXgJBajux$bDhmPiTjkqQKgTDreH6QrXzn25Vn3mefcAeZVMeCjTTzm0aO86Yxg2gPo4i/UXFQaLY23iqMR4RNMSrsoGuSE/', 'Y', 'Loredana', 'Sannino', 'loredanasannino749@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(203, '', 'mary.testa', '$6$7gjikyehP7StvXGC$gVTfPmRPnWQgH8XmTGiAh8RUVO1nGB5IyBSbW1OmR.R12YnL/phP8XxVlKIbP7lE.CroxE6NWRithTJr1aFWz0', 'Y', 'Maria Giovanna', 'Testa Fralia', 'maria.testa@cooperativadoc.it', '', 'Olimpico03!', 3, '12', NULL, '2023-03-14 13:14:16', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2025-04-18 00:00:00', NULL, NULL, NULL, NULL, '2024-12-19 15:39:28'),
(205, '', 'nunzia.passiatore', '$6$yGkD6xDohYliwK3T$Dlbx7tXov0WKDz6lm5KBVrb8F8DEDJIMe18bmf95Zooqb7Iovv08aUjL0Kb5NuMxBKBT.8bv9zPNWQm9iOw6E0', 'Y', 'Nunzia', 'Passiatore', 'nunzia.passiatore@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(206, '', 'roberta.bravoco', '$6$EjnSOQwQM0p35zGm$EM6d.B7ttd7/THRbFIIbPxuuysWsU/Ywj3wCSQ80WfeHtFNGI6eOXvVxtR2uTKI0xzcj0sMvePHUKxljxYxRW/', 'Y', 'Roberta', 'Bravoco', 'amministrazione@sharing.to.it', '', 'Doc*01', 2, '8', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(208, '', 'angela.russo', '$6$qqz2a6DDZDMLAPTu$9uLTpvkhXYgg2bFigBFMZWqQDgt5Ak3mKwbAwXa8aSlbpNDb/xevWIAejd4P9Kl/qOkYblQO/YY77YXMWEqnc0', 'Y', 'Angela', 'Russo', 'angelarusso2020@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(209, '', 'barbara.marcotullio', '$6$Umcwp0XfMn6qce0l$29mY.t5Unb4MHOVkA.GezBwCbySlrVFBUvnVjsj2EU38uuSfXV13vBIlXp/vMZlDY/FCLTYDF77SoqkOS558.0', 'Y', 'Barbara', 'Marcotullio', 'barbara.gloria83@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(210, '', 'franca.aliano', '$6$CZIMBVyr6bNs3r61$dlJMUqIejGKuC8voESLix3AlIMk8RpDrZzcktsEqnz1Z.h71f4D1XrR3uLMEqjyYJZZ.2Q4fWooGIghCSrVvs1', 'Y', 'Franca', 'Aliano', 'francaaliano69@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(211, '', 'nadiya.pelozi', '$6$qvyp5QX1HEqj/7lw$qDxALxyUauwMjBqyBcRyZF1DiVxKrHWVWzQsDEoQvGno8xuz2M56H/C9jMY.J/RGyXd1YGDvnufvBotndju9y1', 'Y', 'Nadiya', 'Pelozi', 'nadypelozi@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(212, '', 'valentina.bonavia', '$6$s72eCIRqzu8v0c7Z$aGD21O7Ri52YbAhlkxt8UWsJDHCdCbbvwPUTSKnx/T2bez6WI1RwI7pCSnZWWgB6hRfiym88Oa/K7l7pM90pO.', 'Y', 'Valentina', 'Bonavia', 'valentina.bonavia@cooperativadoc.it', '', 'Doc*01', 2, '176', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, '2026-05-26 18:01:30'),
(213, '', 'angela.lavarda', '$6$tVT+ukDijJ/G0DE+$6WhppeG3zVEYRLJIbTNlYwg..r1BZ61iooyUdmT7Y/m1PZr0jFL6pMaSnOPqOHrMc1pfMF1vLi3pItsgEqqP/0', 'Y', 'Angela', 'Lavarda', 'angelina_81@hotmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(216, '', 'laura.treppi', '$6$nXy5dZo677VB6/aN$U7gr/IzPvAiZfEGsZgwXv5CLPEW1O9Vh2YgfGvy6kzAxBCFND943u2NH.9xYHxILXdyK0LpYbtNY8GrDk.y/p/', 'Y', 'Laura', 'Treppi', 'la.3b@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(217, '', 'rosa.blandizio', '$6$7Hvs047vq6umZras$kuo5YaPQQp7V5cX2U8V6PMBjOvTynX.2yR23edR8q4yV4ciSe9NM2u/SZJzwt/Bigx61yVFIH9V1vERraTjPb.', 'Y', 'Rosa', 'Blandizio', 'rosa.blandizio@cooperativadoc.it', '', 'Doc*01', 2, '50,5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, '2026-04-03 12:36:39'),
(220, '', 'valentina.russello', '$6$kgC+UGLwGLKf4oIE$LEPAQb7bWJEK/BJ89VQ..5jVgHZYnwrs.AGq9cKJ6MrmqlVdhoh.QFku/.EMChGqWPsv40Hz/UQBnBI5shroF.', 'Y', 'Valentina', 'Russello', 'valentinarusse84@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(221, '', 'laura.milito', '$6$sKDFx1ndGtSnf1D2$vCLRRuu2d/fOMRuzFdxzqdo/l81D6eZIWzuroU6ZXkRYfYuKRVt85PpNTv2ntV/k0vM76e.cA1HItvdUbMDwl1', 'Y', 'Laura', 'Milito', 'laura.milito@cooperativadoc.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(222, '', 'mihaela.sandu', '$6$ry7WFUk+yloJV12C$KAhSEZLEMhPHMhdgzCLEau7DIFOxealpWQX0b99NbGn70hEFwS6qvbndmpiWNS.ux91jkk63PX1ColB6K5hsy/', 'Y', 'Mihaela', 'Sandu', 'mihasandu74@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(223, '', 'daniela.pisano', '$6$zsb9b2dgZPHvxG+l$DM1epr4P6/H2e3wukpgITq4vTxpkojw1nF0VmZ1Hrp52doKyBpGvMXVmhzD0GlS18bWP05/j6r0EtaLaBioTn.', 'Y', 'Daniela', 'Pisano', 'esmy003@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(224, '', 'lorenza.marchisio', '$6$B/Loq8mnP9Zohxim$Sxn1tO5nV0j1XHH14xEW0FRR82VqflZ1xPlya.o2iU40Ylsm2b..n13Ko4uK5w693tLbVpU7FeEYdn6xSwp8b/', 'Y', 'Lorenza', 'Marchisio', 'lorenzamarchisio@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(225, '', 'luminita.teleaga', '$6$Kg7ElAO+T9JYo3AF$TElmBZEKP.D3YQf2zmk3XPZ4MOKxOVIXqQrof0z9BM3rhaz0xLIP8vGXD3TEwcF5dXmOWcgvrGJVpm41IAODf/', 'Y', 'Luminita', 'Teleaga', 'luminita.teleaga@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(226, '', 'sabrina.canale', '$6$n+uWNVakU6fZ9hkz$zLTODjWamnTs0wulAgjPnhB.UjHAX/1KbniXSl68iFM.JrpK0HTBj4a6Fg6lT5tyI7WB8PFa1ZkBEacfaX27w0', 'Y', 'Sabrina', 'Canale', 'sabrina.canale1987@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(227, '', 'roberta.dilecce', '$6$zp5KhiYub52wO9OE$m/m.Gyz8O7lynuU48EpI7SEpaN83O4vk1yu2ZLpr.4neJcIzzAheM2drWk2s.PkqUfDdYr91jn4PpAoUEE1ox.', 'Y', 'Roberta ', 'Di Lecce', 'rodilecce@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(228, '', 'giulia.musso', '$6$mavWSMZekKO+AaGW$lyGJjkT7xJ1u7G4v8/VXdIiBZ85Vk2Gatajj4EHUWGGv2JrTu.FDx1P7p0I/kUr/1Boqty3l5SgcW2VXT0d6/0', 'Y', 'Giulia', 'Musso', 'giuliamusso@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(229, '', 'emanuela.morettini', '$6$p+cJY0RSVPhUr3+b$We4amTQhx4uP9hIe5xwfZ4//BmqdMl8.pij.pk47YkDOt0Lo.wABHtfHEmcbCp9oYRsibZwDC3JLXlKF1hqlp/', 'Y', 'Emanuela', 'Morettini', 'morettini.emanuela@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(230, '', 'francesca.gasparini', '$6$s9DXDd6RkEvBY897$qJ/FlDqfaGbynN8sK3LV0.5AwvVvzSSN5PBLK5nKrgBkafnBOHig.X8xJGllLCF0P6kXqXdtiqabZn9rDELn8/', 'Y', 'Francesca', 'Gasparini', 'franci.gas70@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(231, '', 'tina.otasowie', '$6$q3YclC5B/qDdjewh$7Ub2VvAz6mXd8nix8PHaTzT8OCWVy4OscH89xzd9YB0Q1XYEvJnhj3g6hkVi2hNyv1OkqHYFzRp3GtTlzYAW80', 'Y', 'Tina', 'Otasowie', 'otasowietina28@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(232, '', 'iulia.nicolini', '$6$8Dwq26OwTBCqbINb$lsa4Lp9DsdlwwwcPsAZvLKzxb.ZL1jUCbV.BsMRXF88Vu4APdcd3bYfAwdXnnHPn937KSkxLCoID5HA.aQ7jW/', 'Y', 'Iulia', 'Nicolini', 'nicolini.iulia@libero.it', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(233, '', 'davide.ciccone', '$6$TyNTmVGhR6Yz515c$q4afFdPxtB2kABgE4YFEbQiHTtQZRutd/xkJEcm96wJccZTnKbzUXzBNXLfGcIKm7YRSSoia1ymGa7p6zPMRc0', 'Y', 'Davide', 'Ciccone', 'dvdcccik@gmail.com', '', 'Doc*01', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(235, '', 'maurizio.merli', '$6$E6oHpivSOzP2y0ch$PkHob9Csm0FXA1pVuPwf66iVlkPydnyajYn48a2giCvLXoPQ.cRrHP/X.HiCxfHE34XadG/sFnR1E.1gdG.BP1', 'Y', 'Maurizio', 'Merli ', 'maurizio.merli@cooperativadoc.it', '', 'Mm2k23*03!', 7, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2023-05-18 00:00:00', NULL, NULL, NULL, NULL, NULL),
(251, '', 'romina.flores', '$6$1jD1pOceremrbkj4$mhxekAtJGc3nhjc7tWF1CwE9bteJkCOCAxw1YR3R.PU.eTlgaXcy04tHwPLCiOZd2SEz6gQSEznruLzjG1skZ0', 'N', 'Flores', 'Romina', 'romina.flores@cooperativadoc.it', '', ',U6CM(o&', 2, '186,203,205,182,183', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, 'd936a588-5d8a-495a-9825-dd119ba1cb63', NULL, NULL, NULL, NULL),
(253, '', 'mattia.tartaglia', '$6$1bFwuCG0InPSQbsz$rga.TqbHJTm9ydtiQuDjd/O2QgwL5vQoph4yjZI0Jn3Au6Xs7gPtzFFUc3Efwm0soKtNturbg2/id22Kwci7P0', 'N', 'Mattia', 'Tartaglia', 'mattia.tartaglia@cooperativadoc.it', '', '4EFSjh(i', 2, '186,203,205,183,190,246,248,247,230,211,297', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '909c07bf-4dac-4bda-ac15-4f98c5f947f4', NULL, NULL, NULL, '2026-04-29 11:56:43'),
(254, '', 'micol.izzo', '$6$68gWVLEqYFikJDjv$8U5diIYdX0Z6bIj2z.qD6sEImlbH0trKmViDf8IuvgIdTKxbk3M2Ofiqt/B1.nWeWbc0aWV1LQnUAIy4sIuDx.', 'N', 'Micol', 'Izzo', 'micol.izzo@cooperativadoc.it', '', 'Unicorno.celestiale96', 2, '186,203,205,183,304', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-10-08 22:00:00', 'afb8c37f-f819-40b3-a028-44ad4c1bbf95', NULL, NULL, NULL, '2026-04-29 11:51:22'),
(255, '', 'stefania.diana', '$6$HYNPoXS4TrMSecof$ghifnbXtAQxfbV7SfrYLXYILXa4ntfBmiEhNyZbCsFoRGTwqECUYd7UyBdzKfW87e77xhURj6YKY1K3ANkf9w0', 'Y', 'Stefania', 'Diana', 'stefania.diana@cooperativadoc.it', '', 'Pinguino1929!', 5, '214', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-10-11 22:00:00', 'ba0db0f9-30a5-4520-9175-d0c588855728', NULL, NULL, NULL, NULL),
(256, '', 'francesco.esposito', '$6$/IE5zPKWd0+K+alf$u7vt9tQ8lh0/IgjLw7RLIPZWtxibYXkc7uQtgo6HsCou1ftI8IpP7LSHdfopyzYwB1s/V2WV3xJ84lgArJ2SJ0', 'Y', 'Francesco Saverio', 'Esposito', 'francesco.esposito@cooperativadoc.it', '', 'Ascoli.987', 5, '266,244,245,214', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-09-09 00:00:00', 'a86187aa-cce2-4893-aff9-6325c37241a6', NULL, NULL, NULL, '2025-06-05 19:51:09'),
(257, '', 'martina.quacchio', '$6$76iFYLtDly4PBtet$NxAa4vZ4xARL6wnxU6Ptzs9wo.maJA0LlCqntmLM4C7yxEX0USui5VGw0s14ccSgVulJzbIEHe1VcXqfirN3u0', 'Y', 'Martina', 'Quacchio', 'martina.quacchio@cooperativadoc.it', '', 'Coca.cola10', 2, '184,185,225,223,201,224,235,276,275', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-15 00:00:00', 'c549fd68-4880-42f7-94d8-cb60f84b2d14', NULL, NULL, NULL, '2026-06-17 10:39:10'),
(258, '', 'lorenzo.millo', '$6$nZz9dM0XtHh2V7JL$yvWotQNszWyUc8nz5jNPc6WAlJ5tnTwbhG0dkZdMR1KAJKnHiJ0jXXch5FBLcxapuItwQSLyJlrCPycs4T76D/', 'Y', 'Lorenzo', 'Millo', 'lorenzo.millo@cooperativadoc.it', '', 'Lollodoc17?', 2, '241,243,242,264,215', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-10-11 22:00:00', '19b3f639-e12e-4a72-96ef-c5463fed980f', NULL, NULL, NULL, '2025-06-05 19:09:45'),
(260, '', 'carmelo.agnello', '$6$dXs22z7ACsk70AYD$PYkiAfBzjfZaBM56uVGi5B82ZQIRfZswKD7KLw5WSKQT0QDKMxpZUKKeCghLn4twJLjnWmZ0G.WBJj05iMFdy.', 'Y', 'Carmelo ', 'Agnello', 'carmelo.agnello@cooperativadoc.it', '', 'Crocifissa3691!', 2, '213,176', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-10-24 22:00:00', '2249f524-9b60-4e5f-a532-b0695c0ca28e', NULL, NULL, NULL, '2026-05-26 18:00:32'),
(261, '', 'antonio.manfuso', '$6$kekXL+RM7cVQu1qJ$/jc/LlrzqIKNNr/DcW0RVt7uDuXCx1Iuh3KwYojU0P3P9tpp4KQLAj2YLvqibLRfQCW43s2jyPg.aIUk.WCcS/', 'Y', 'Antonio ', 'Manfuso', 'antonio.manfuso@cooperativadoc.it', '', 'Jimbo13@2026', 5, '213,211,246,248,247,230,232,190,297,199', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-20 00:00:00', '332e6ac7-7a6d-4399-80d6-e231a3370f38', NULL, NULL, NULL, '2026-06-22 14:55:04'),
(265, '', 'leana.molinaro', '$6$DTBh6SJIkmWi/Mw8$Z3a9bpKmSzmbY5VYR1kVQ99FKqGILwFs/0qFKWCKeLRWQKEXw.pV4mJSFGQ1ASBTjD5vuUu9IDZkHzuFNoHwA1', 'Y', 'Leana', 'Molinaro', 'leana.molinaro@cooperativadoc.it', '', 'Lea22021985%', 5, '202,304', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-31 00:00:00', '568f62e5-d2ac-475d-8344-7d09573ccc26', NULL, NULL, NULL, '2026-07-03 18:25:16'),
(266, '', 'marcello.bertozzi', '$6$AZIfobCsTTT1frjX$QjsRMm3/UzU6mUlLtC86rF8i/uVCFMZQHppdxiUT1JwaNpBcLzWh7H9MyjqQrjj.qRBDoydFnKtv/RGs9Hy/m.', 'Y', 'Marcello', 'Bertozzi', 'marcello.bertozzi@cooperativadoc.it', '', '12Etudes!', 2, '224,235,185,225,223,276,275,201,184', NULL, NULL, 'agg_1.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-10-09 22:00:00', '9be18b20-89b3-4651-a2ee-5e4609720084', NULL, NULL, NULL, '2026-05-26 18:01:19'),
(269, '', 'flavia.bellonese', '$6$iie/pmW57Mir2u1U$vMWF8t4ZWUO5269QsFJH5moDHODVxuKlEh2zBhnjPZEhsqtUMDHIYHd.uzyQFgI4VKlh0Uqi7SgKdGIROdXre.', 'Y', 'Flavia', 'Bellonese', 'flavia.bellonese@cooperativadoc.it', '', 'Flavi270592!', 5, '210,190,246,248,247,230,211,297,311', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-10 00:00:00', '4b798ec5-b8af-4eb0-ba47-2be081d9ce03', NULL, NULL, NULL, '2026-06-12 09:53:22'),
(270, '', 'daniele.didio', '$6$x9MHl/A4WYQVLl7Q$juUVjWUSHetDfMzmnQ.b9fdQZZvREru32i3IXs4qkvowU89hpV8VHVZtarkS43eg69h5VH9Q.K.dsFir3a.421', 'N', 'Daniele', 'Di Dio', 'daniele.didio@cooperativadoc.it', '', 'Pizzo@2026-', 5, '307', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-11-03 00:00:00', 'c4de32bb-181e-4538-90bf-eb74d50bbd1c', NULL, NULL, NULL, '2026-07-06 17:07:32'),
(272, '', 'imma.carannante', '$6$27fgOArlB0tkdQht$mphP7I8STkikQLQpcdd4GdVBhxVBooAZ0kUfpGW6BBiwdiQExU.3kcNoL6mcm029h5T4GiVON/AFLV4KiMkVD/', 'Y', 'Imma', 'Carannante', 'imma.carannante@cooperativadoc.it', '', 'Francesco2705!', 5, '278,280,281,279,277,306', NULL, NULL, 'IMG_5267 (1).JPG', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-02-02 00:00:00', 'e6851918-5ca5-43a9-8379-5175d6e5bfa2', NULL, NULL, NULL, '2026-04-29 11:59:30'),
(273, '', 'doriana.manna', '$6$tD5vz16Bys1eiwvC$es2ecXp2hLZ2zbnRAYWpkaWJumjrO3UBZkguDA7B1qN8S7coYnavvQt9A8ynRJwFkrNaLAT8JHid26YLKmXrl/', 'Y', 'Doriana', 'Manna', 'doriana.manna@cooperativadoc.it', '', 'Stellantis2023?', 5, '207', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'Y', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-10-09 22:00:00', 'c77b64c9-33d7-412c-816b-91b1bf684e85', NULL, NULL, NULL, NULL),
(274, '', 'ella.dellolio', '$6$JzpA9Tala960/oMl$eEFv6OemFv8Q71n/9C7WwPNoYlgc5nVsUN2WbmSJUwCTb5nqNXj0GroIyl/m6wmwqUyEthWMwH5CozwLEBpEk/', 'Y', 'Ella', 'Dell\'Olio', 'ella.dellolio@cooperativadoc.it', '', 'Go6K|~33)', 5, '257,259,208,260,258,206,305,309', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-09-19 00:00:00', '4400e1d9-8786-446b-abc3-3703fa306d1b', NULL, NULL, NULL, '2026-05-22 22:51:54'),
(275, '', 'arcangela.clemente', '$6$MydL+F8wHKFJQ7In$MM4yLyHIiskRNpAqXc/CdmSwlUL1rEDS5Ih.vdZmwRoTOpw8HyiuZDxPr9L4/s/oVTibpPdKjQWTR53u/8flr/', 'Y', 'Arcangela', 'Clemente', 'arcangela.clemente@cooperativadoc.it', '', 'DomeDesi1126!', 2, '214', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2023-10-13 22:00:00', '320aa33e-82fb-483a-ba41-7cedd6cc8646', NULL, NULL, NULL, '2026-05-26 18:02:08');
INSERT INTO `utenti` (`id`, `id_signal`, `user`, `password_hash`, `is_active`, `nome`, `cognome`, `email`, `cellulare`, `password`, `user_type`, `user_unita`, `user_centro`, `last_login`, `avatar`, `preiscrizione_sn`, `preiscrizione_sp`, `preiscrizione_cs`, `preiscrizione_sh`, `preiscrizione_tim`, `preiscrizione_fo`, `q_junior`, `q_senior`, `q_scientifici`, `q_sport`, `q_studio`, `q_doc`, `q_campus`, `q_keluar`, `q_sharing`, `q_formazione`, `q_vacanza`, `preiscrizione_cm`, `push_qualita`, `push_centriestivi`, `verifiche_ispettive`, `formazione`, `statistiche`, `letture_contatori`, `utenze`, `documenti_qualita`, `documenti_soggiorni`, `area_documenti`, `is_maintenance_lead`, `password_expired_at`, `activation_token`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(282, '', 'elisa.tessari', '$6$/jAYvuzqIjx9aQ7j$iVEw7cxheNrjFXdS5kowxwKC6ipJ/uSCa00yDGdLOrUhNZZbWZMoe9eaLbPSXAGadAIdwrX50CrXo2iiN8zsw1', 'Y', 'Elisa', 'Tessari', 'elisa.tessari@genesiambiente.it', '', 'Muffin2021!', 7, NULL, NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2024-05-30 22:00:00', '5a966b68-0ecc-4a57-9c15-a366adce7fcf', NULL, NULL, NULL, NULL),
(284, '', 'ricevimento_CSP', '$6$oleBEr5moWfTGnBY$MrauLG1kmQijEDCsGiSwCxjaoajzP6YyG.cntPx8Qu/5bfBLsTwJ/./6RJyUPhQdo9eisRxmGl6Fk5Or8STeO.', 'Y', 'Addetto ', 'Ricevimento ', 'booking@campussanpaolo.it', '', 'Campus2026!', 2, '47', NULL, NULL, '', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-07-26 00:00:00', '9e0819a4-4272-4182-97e4-04ff036112fe', NULL, NULL, NULL, '2026-03-28 09:39:54'),
(285, '', 'Ricevimento_Open_011', '$6$cHSw2eqwyC0JZpYR$.dAiDy2JruNXxAiuyeLTaUHN/97y1V3WZAk3Pxj7nOxorXfStL9xQMhchDbz9Q25FodHY/K6pMCt4VggRstJ71', 'N', 'Ricevimento ', 'Open 011', 'info@open011.it ', '', 'tD.BnSbR', 2, '5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, '66a5d7ed-7099-4c60-adb2-4567fa136be2', NULL, NULL, NULL, NULL),
(286, '', 'Ricevimento_CF', '$6$9wluBGj56pY366yJ$zOizmnRykFG7TEORdu0NFeIGjxayDTYG5JsZbvXruLIbb7QdPIU2sG0mI20kRCyycoUzLfzLnu/awrw7s5WqS.', 'Y', 'Ricevimento ', 'Cascina Fossata ', 'booking@cascinafossata.it', '', 'CF2019cf!', 2, '155', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-02-17 22:00:00', '77ec94b2-bc4e-4db1-b0da-5f97670d471c', NULL, NULL, NULL, NULL),
(287, '', 'Ricevimento_VOB', '$6$AjWiKc/hPPZNurRy$WCpq.oBxZJFZNb7JbE7OOHjlS1GfeuzIeg55avDsRQ02ZTgO8RBkJzbL/7lth802/0mvwRWKROOJeRCLp/NSk.', 'Y', 'Ricevimento ', 'VOB', 'booking@villaggiobardonecchia.it', '', 'Bardonecchia24!', 2, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2024-07-21 22:00:00', 'e0d43313-56f5-48bd-a4a6-138a9945d8a0', NULL, NULL, NULL, NULL),
(288, '', 'Ricevimento_SH', '$6$Pf49BfCfPFlsYpnK$kWJTU7Mw06.N.pnq71bXtQBGZzwWvASFdJrRlyxoooXEPS2fL8KLLHwHPWZO4EZ.U3WOHWCd2FRSS6ZrlfD8u/', 'Y', 'Ricevimento ', 'Sharing', 'booking@sharing.to.it', '', 'Sh2025!!', 2, '8', NULL, NULL, '', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2025-10-07 00:00:00', '46435ab8-8942-417e-bac3-89bbb91aafe5', NULL, NULL, NULL, '2025-06-09 15:28:39'),
(292, '', 'ischia.keluar', '$6$koadA0CztLIPpyMQ$vbACwhBZjF3xYAp90oQ8/Sf4pXIrc3vdoIhRFEnoDjRx1eDwyCVnrEF7sspCyBgXJ7aIZy1V0EUs3YJGjOYPM1', 'Y', 'Ischia', 'Spadara', 'ischia@keluar.it', '', 'Iodice7@', 2, '216,215', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-10-10 22:00:00', '5ccbce02-e9cd-43a3-9133-c07b3beb3ffa', NULL, NULL, NULL, NULL),
(293, '', 'gabriele.carmenati', '$6$+QyhFumMYxffsa6K$ttWHEvp0JB2JUtyMZR1Ms9.yQw2kOtZTDKN8E1jep6uoG5.ELj61.0K6is612LeCpS3aq4E1GV7N7oC.ZJPKV.', 'N', 'GABRIELE', 'CARMENATI', 'gabriele.carmenati@cooperativadoc.it', '', 'UWKFT$32', 2, '224,184,185,225,223,201,235,276,275,261,296', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '953ebab5-78b3-42a9-a9cc-cba806b0818e', NULL, NULL, NULL, '2026-05-26 18:01:40'),
(295, '', 'gennaro.monforte', '$6$l+MrN+NWhPrsEwIk$lEHmk1d9F1iUOnrpfSi/QfPUD0tqvM82NZkevDJh5Ygux/RA16/.ViF9FMEZlvo71IcJpUIsexoAbxGZcetcw0', 'Y', 'GENNARO', 'MONFORTE', 'gennaro.monforte@cooperativadoc.it', '', '3SA8p$e7', 2, '305', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-11-24 00:00:00', '7e8039db-5f1c-4d30-ad38-e36d9f4e7009', NULL, NULL, NULL, '2026-04-29 11:49:47'),
(300, '', 'barbara.tombolato', '$6$3GOMCa7AWwc8rehc$L5JtKW.7OLe2Exvb9cj8HnubSUp7Ahxdt0Him0QtEjMn9rizt6QXB5UgzN1yG9vt/icETP1S1qMRO71z/Vlx3.', 'Y', 'BARBARA', 'TOMBOLATO', 'barbara.tombolato@cooperativadoc.it', '', 'eC!RLrxAUpHu5c7', 2, '184,185,225,223,201,224,235,276,275', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-15 00:00:00', '4dd0df75-58be-4641-81a2-f3874d3c93ab', NULL, NULL, NULL, '2026-06-17 10:23:35'),
(301, '', 'manuela.denora', '$6$Q+LK7O4FqNuQtLjb$xLRRgrdplsmowq3hYGNBuFTKhLSoxR/y8nwu7CLnhrC5jpXXodMJumRGvtw8naLJploJkYRL04xrg0SKDSo9z/', 'N', 'MANUELA', 'DENORA', 'manuela.denora@cooperativadoc.it', '', 'Malta.2026', 5, '225,276,275,265,180', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-08-30 00:00:00', '663088bd-e703-462e-aec5-7a4413b285cc', NULL, NULL, NULL, '2026-05-02 18:48:16'),
(303, '', 'federica.todisco', '$6$V2iHGmukNt7qInlR$Vbro38u/0OWR8DzpLI2EHOWVt39tYNH6G/2v6z6NPpxLIjpwUEXQ3GuNrwIcAn3D50M5jlVSnqD1JXQBNRY5z1', 'N', 'FEDERICA', 'TODISCO', 'federica.todisco@cooperativadoc.it', '', 'Dindondan97.', 2, '225,182,240,274,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-09-02 00:00:00', '57693514-c1ec-42c2-9c9f-7358118e03ae', NULL, NULL, NULL, '2026-05-05 13:39:35'),
(304, '', 'andrea.polla', '$6$swnalDUVTJk4WyXK$qA4vV9PTIWEj2e63s0b3Hpl/IE6Xa8RSYgKuu76sx6QKzzVNM4S7QxP1k/bZE/pDbEFIaJTw6ItsIb3XwQUNR1', 'Y', 'ANDREA', 'POLLA', 'andrea.polla@cooperativadoc.it', '', 'Cesenatico_2024', 2, '182,183', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-10-15 22:00:00', '7e03ed86-25fe-4ac4-b0f4-d158f3776b28', NULL, NULL, NULL, NULL),
(307, '', 'valentina.rutigliano', '$6$ncNoFg2ElyH3YVDl$7kmSKnHsUBbE3U7pdFwEgMwzqSymM/Ljyjkp57.LsQ5z/GeYg2mESio/oaO1e09nKAmI1YJoXXJcvV9jhRckU.', 'Y', 'Valentina', 'Rutigliano', 'valentina.rutigliano@cooperativadoc.it', '', 'Policoro3!', 5, '290,256,269,229', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2024-11-14 22:00:00', 'fade738b-5d46-4308-a616-9b418bc25b2f', NULL, NULL, NULL, '2026-04-29 12:01:25'),
(308, '', 'Bardonecchia.Eni', '$6$rXBrcrzkZVPFFZbS$Gk1Dp4IzWY5PAPnUn5/y6ZHElTKTi.LDx4g6g6HtEyszObAp8Mj6Foiy48VMPd65.nItZHVQZn5xLdzUUipZP0', 'Y', 'Segreteria ', 'Bardonecchia ', 'bardonecchia@cooperativadoc.it', '', 'Bardonecchia2024!', 2, '184,185,225', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-11-22 00:00:00', '8bc045c2-992e-479b-a9c6-d216d190f6a1', NULL, NULL, NULL, '2026-05-26 18:00:43'),
(309, '', 'TestManutentore', '$6$thFOf4lS1aJd6MGK$oabwQCYlInY8RbKqA1BjOsO.5N88ryF2Pwx8w7Ba.LQT4Da9kwXZuhy0xiZFXLDu7zRarQg/TlKL7Ooh7rDCh.', 'Y', 'Pippo', 'Manutentore', 'manutentore@test.it', '', 'AIP@5q^7^lMc', 12, '12,8', NULL, '2024-10-28 12:57:11', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-09-02 00:00:00', NULL, NULL, NULL, NULL, '2026-05-05 12:42:47'),
(310, '', 'TestSegnalatore', '$6$7DmcluQPdVZKEEDX$GhgugnmKS5dZdrApXxfldk0GJGgS6ujaeKG7VeD08/FABIZIu6/RqYap.I4KFP8EAAex3j25FTOeVSfoFx45c/', 'Y', 'Pippo', 'Segnalatore', 'segnalatore@test.it', '', 'AIP@5q^7^lMc', 11, '8,71,195', NULL, '2024-10-28 12:57:11', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-02-26 13:57:44', NULL, NULL, NULL, NULL, '2024-11-26 13:57:44'),
(311, '', 'responsabile_manuten', '$6$PwSVNJpN7Y6uNELC$W5MnUJYUkUgcNhiK0EmUI6kZntJcdc53UTmG55uOygQFnLV3yxvJcGDJc8jTSrxdhI8iwsY7EYU/38ipGlYre0', 'Y', 'Responsabile', 'Manutentore', 'responsabile@test.it', '', 'AIP@5q^7^lMc', 13, '195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL),
(313, '', 'RiparoTuttoIo', '$6$+QfB0Prtk5QGB0fW$RanCBgnatD.xHhB3LGx.Uv.L3j5Xey42uSfZ.J98y15VWIt3xju/2KltqxFB1XOSQTsC/TMwpxnoVAcH0Q7jF1', 'Y', 'Luciano', 'Manutentore', 'tech@messageglobe.it', '', 'A10(prova)A10', 12, '195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-03-25 23:00:00', '6bef6f6a-f011-4b90-86c6-d9b76940f04f', NULL, NULL, NULL, '2024-11-26 10:50:24'),
(314, '', 'Enrico_Manutentore', '$6$vaUGpZTBujtU63XZ$DHXSf0evG2Z0JvvovqmgtGst0WwJghbQOTrzrzTVg5m/sLOwfk0hWPqylKuUBDrOudYeNrXqfeETsSW2m2ePj.', 'Y', 'Enrico', 'Manutentore', 'test.manutenzione@cooperativadoc.it', '', 'DocKel*03!', 12, '193,194,192,195,176,8,12', NULL, NULL, 'LOGO DOC.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '2025-03-25 23:00:00', 'a7c00479-4585-4521-8d8d-f0d7f6afbcf9', NULL, NULL, NULL, '2025-02-11 11:10:04'),
(316, '', 'Direttoremanutentore', '$6$Tj9F+A/7qwNuFcb1$ZTTG8yRAgcIacqElGVY1QE/ToZ9U3NgWQPw2yh4VwZKQEuAv9aXwpsEAyxW/ygl34/tYty4/N0CYJ1pNRWGNh0', 'Y', 'Direttore', 'Manutentore', 'enricoboenzi@gmail.com', '', 'Dirtypl1596!', 5, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', '2026-09-03 00:00:00', '0fe176a2-df11-4201-8500-ca1d7812b4b3', NULL, NULL, '2024-12-20 09:24:06', '2026-05-06 12:03:07'),
(317, '', 'enrico.boenzi.vob', '$6$usQScRde4jfsOi6U$j1ZJXqm.anS0DdvDfbisPh.Y4oyr.OU.Dy5A8yz0m/MhLty.FhGjTO.ZRnfVaU4hBG1GAtVF8KzJGmZiJWvsd/', 'Y', 'Enrico', 'Boenzi', 'enrico.boenzi@villaggiobardonecchia.it', '', 'Doc2k25!', 13, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-05-09 00:00:00', 'bde1a1eb-dd64-4b93-884f-d716880093c8', NULL, NULL, '2025-01-08 15:38:17', '2026-04-08 09:15:55'),
(321, '', 'matteo.lanino', '$6$yl9VIvnesR8j2KP1$xwdMSVbb5Y7b9B.LlIQy9zQDEB0MVLVCuwwH7BmNXibTCbwQXWI2eJMfpb8Ty1ZrxTOy6zna.cxAl8S.1NAkQ0', 'N', 'Matteo ', 'Lanino', 'matteo.lanino@comune.milano.it', '', 'C_@miSMe', 11, '193,192,195', NULL, NULL, 'logo_comune_milano_stemma.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, 'ce5efe08-8feb-470b-8200-7459778ab806', NULL, NULL, '2025-01-20 15:49:04', '2025-01-20 15:49:04'),
(322, '', 'giulia.damiani', '$6$sq9iTMhs2fmbf2UT$T5jX0F1RbYPM9acgrt1HcxmUlWGRJTxNN/nCBlXW4Sr5P1ZnUHhGk6nJMcgepJcSrDz1l.xizKgNT1.5kkFb1.', 'Y', 'Giulia', 'Damiani', 'giulia.damiani@comune.milano.it', '', 'BornToRun8!', 11, '176,194', NULL, NULL, 'logo_comune_milano_stemma.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-05-29 00:00:00', '7a15554e-b5fd-42b5-8b7f-00ba8a1aa50e', NULL, NULL, '2025-01-20 15:49:56', '2025-01-29 17:25:24'),
(323, '', 'sara.conti', '$6$3fneILz1kBAE4KK5$zaN/QWcjeEjUtEaS7RauXaXPNdmFqAIeXSZE3pSMWLZ9VlYo8dBruDL9kHYOhBwxsVxQN0SjJUOIqVfQz4RIQ.', 'Y', 'Sara', 'Conti', 'sara.conti@comune.milano.it', '', 'Berlin19!', 11, '176,193,194,192,195', NULL, NULL, 'logo_comune_milano_stemma.jpg', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-05-21 00:00:00', '62b46c8c-3d8f-4be2-a167-7720755a5b1b', NULL, NULL, '2025-01-20 15:50:44', '2025-01-21 10:22:39'),
(324, '', 'umberto.aprile', '$6$G5p0mss4HRZ9hRNt$HeJ/B5qmJWZFFa6qcW3WyL.Z397Es4eI5kefZj8RRhO.gKYrSXmwsHr3UUNwInXY52mKwPmonEr4aRWnbawjG0', 'Y', 'Umberto', 'Aprile', 'enricoboenzi@gmail.com', '', 'Dirtypl1596!', 7, '47,155,71,5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-05-21 00:00:00', '4366e9f6-9aa0-4703-bb9b-d893a8e55f32', NULL, NULL, '2025-01-21 15:35:54', '2025-01-21 15:36:19'),
(325, '', 'riccardo.terrile', '$6$jmGr9Fw2fNaKBJpa$NAgx1O85bdnS9EdLCnWEAkjWJolmC209QE0EeGcwxzWyt7lcGl8E1vwlTtvlHu1uJ5GnETn2deBftZOd0aSI1/', 'Y', 'Riccardo', 'Terrile', 'supportoit@cooperativadoc.it', '', 'K11#[++]#k11', 3, '273', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-05-31 00:00:00', 'd8bc1b0a-30df-428b-8944-f97391e5963f', NULL, NULL, '2025-01-31 15:15:07', '2025-01-31 21:26:26'),
(326, '', 'Renato', '$6$dpKwHdA/ZgEFpEI4$G2dh9C4QloXO3vAPUTg12OTZXN3qPqneQTD5OuW7BRfdtbwAe9Rs4niUfvwMtL/iQokW/nd9LKsoR53f1iTgw1', 'Y', 'Renato', 'Domini', 'renato.domini.to@gmail.com', '', 'RD29792212a\"!£', 12, '176,193,194,192,195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '2025-06-04 00:00:00', '71bb6295-a888-4d5f-b894-6d04c2952c1e', NULL, NULL, '2025-02-04 16:15:34', '2025-02-04 16:55:38'),
(328, '', 'maria.testa', '$6$VULWG15WTAHfrMYT$9ciIfiI0LhL/9gQL6SeozT32AHr0DrNbhJaP5xoHaKt4CrKhA0FUQg2jNHXKDjPahh4U/H2mFhB0fvfhZ.0KI/', 'Y', 'Mary app ', 'manutenzioni', 'maria.testa@villaggiobardonecchia.it', '', 'Olimpico03!', 11, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-06-08 00:00:00', 'cbedbc97-49b2-4d5e-847a-8ca1e55b6495', NULL, NULL, '2025-02-08 12:47:58', '2025-02-08 12:48:56'),
(330, '', 'gabriel.bodnariu', '$6$WOo0mQI/no4npp0p$gQPypL/22rju85z.I5IaeK9wyFFrUObZgup0tqAQc9AQGKAGqZnrOBF94rNpxuU5O5HuMEAQBGWNlL6uvbuY6/', 'Y', 'Gabriel', 'Bodnariu', 'gabriel.bodnariu@villaggiobardonecchia.it', '', 'Petronela201005-', 12, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', '2025-06-08 00:00:00', '7efdbccd-0b91-4037-ada2-06a53440c85e', NULL, NULL, '2025-02-08 13:05:53', '2025-02-08 13:07:13'),
(331, '', 'prova.stessopiano', '$6$MNX3BsGGQtR1eli6$zS3kDRCle1cS3hvsXa72fujroYQbuyWoMbpIhIDBNYs.ftpckfqP/Fw/2VAuZngFi.gejW/KBRY8mOpxxYpR5/', 'Y', 'Prova', 'Stessopiano', 'enricoboenzi@gmail.com', '', 'Dirtypl1596!', 3, '58', NULL, NULL, '', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2025-06-10 00:00:00', '28077b6c-1c02-4201-9898-4e34f4a8016c', NULL, NULL, '2025-02-10 11:52:06', '2025-02-10 12:01:33'),
(332, '', 'mariacristina.rizzi', '$6$RKrQoZw0LHzyEO5b$kNdDNXIDUGOVlPa4RMDZYFHiLG6Tgfm/RmXZ0rdRtEkc.0Ds0bVC.6xB76.ZQbfSwt4hkmJt7K/1vOatLZoIg1', 'Y', 'Maria Cristina', 'Rizzi', 'mariacristina.rizzi@cooperativadoc.it', '', 'Zxc2026!', 5, '195', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-08-07 00:00:00', 'd54a97ed-175e-4d48-9729-07c1484ecd83', NULL, NULL, '2025-05-20 10:55:41', '2026-04-29 12:02:35'),
(335, '', 'laura.franzellitti', '$6$nZLCwV3ng9izcFVH$0WByWNJfPWerWfoGoCOVpwSKd7uyE0bKbr1nTNXUVNYXgjufGWP2uZzJG/ivUdcgdQoJpSQwd1SpaGuvMbDxB1', 'N', 'Laura ', 'Franzellitti', 'laura.franzellitti@cooperativadoc.it', '', '&_PWv:)u', 2, '262,182,274', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '2e5c6206-3a21-49b2-b57a-74ce5b9eec82', NULL, NULL, '2025-06-05 10:54:25', '2025-06-05 10:59:24'),
(336, '', 'tania.cappelluti', '$6$kCetV0Xt4gngmP6G$QU/JvI7KiDiUrQivVRMm2YUTsjK2z5TDV5wuT9Xa3GdJn4oQFSDJtiZIHfRY.ioK2YCF3o2234IbmYDB4plXJ/', 'N', 'Tania ', 'Cappelluti', 'tania.cappelluti@cooperativadoc.it', '', 'Fg[sA5eM', 2, '262,182,274', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, 'a4dde4d3-2fa8-46b7-b386-4b3b28fd6b0e', NULL, NULL, '2025-06-05 13:57:13', '2025-06-05 13:57:13'),
(337, '', 'daniela.diomede', '$6$n/ILlkR1klWSgZ4j$8X3n8c.6W6.qLg9DG7eOFGZQmFaKXTYxT2cM1LhPbAiprri0WviRfr9/Iw1stcf1.QHtk4jz1XjXR3gLxziyc1', 'N', 'Daniela', 'Diomede', 'daniela.diomede@cooperativadoc.it', '', '1R[T(pkj', 2, '262,182,274', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '904f2c35-3afa-47ef-8a3a-34d6d865a181', NULL, NULL, '2025-06-05 13:58:46', '2025-06-05 13:58:46'),
(338, '', 'simone.fanotto', '$6$ef2hk/hxhXBtRDmv$iD6g9wmV6TVpXLR9/5tG4oNIDx2Z1il5evAvitK9GRsJvLz5lJHWwc1QgK1XDu.llJaxbqmOod76nW5dYJK.61', 'Y', 'Simone', 'Fanotto', 'simone.fanotto@cooperativadoc.it', '', 'MARIOsonic8?', 2, '182,274,240,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-10-06 00:00:00', '98f22056-0d34-414c-9afe-8b0e6f609913', NULL, NULL, '2025-06-05 14:03:26', '2026-04-29 11:43:27'),
(339, '', 'federica.disanto', '$6$4QXq+t8b5jPzBuLo$WQaSY8jTqeyQonrHWawfw6KklBZ2jg6LLkVQGx3zR/YkGorFQiJUwHfEmZ8AwY7sOP5Eu0o93YJxfNQePEv/z/', 'N', 'Federica', 'Disanto', 'federica.disanto@cooperativadoc.it', '', 'o2:ay!su', 2, '262,182,274', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '111ac2bb-95d6-4318-9f5d-75e3a4d9b359', NULL, NULL, '2025-06-05 14:04:36', '2025-06-05 14:04:36'),
(340, '', 'angela.caruso', '$6$u2rxwME36Cb5NJuf$VKT4l3MQIIfQhfUuESKOEyCFrASteQZddhn7WYY/sDMqu9X8gN4L9R4AhtMwiIDf06xUMN17L75orVUgBQo.v0', 'Y', 'Angela', 'Caruso', 'angela.caruso@cooperativadoc.it', '', 'Angela.car98', 2, '182,274,310,240', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-10-04 00:00:00', '3586900f-11dc-4566-9d93-b000feb5760f', NULL, NULL, '2025-06-05 14:05:35', '2026-04-29 11:41:20'),
(341, '', 'sonia.calabrese', '$6$eVED3XU+428MrJGc$eShjDPkJC50aeqE1QnQfjzo/bZeczMeGPwya8XFu7E7d.yAWSFkPiIvbJOVRG2rIX43HQk.b65OtLx4IV6Bjz/', 'N', 'Sonia ', 'Calabrese', 'sonia.calabrese@cooperativadoc.it', '', 'x9Yo6PvE', 2, '182,274,240,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, 'f7f59759-359f-45cd-8161-6f6c3f13d2d2', NULL, NULL, '2025-06-05 14:06:52', '2026-04-29 11:43:47'),
(343, '', 'teresa.carito', '$6$AoDBzrK2qilIuYfr$iEpgmJykkA/KI1dqsz368RGdOI211C.V7dgYRkCS3bbYiGUVDP6lORLpbjFUHMXJ1.TNJgU8ueFdU5aZ4aw1w.', 'N', 'Teresa', 'Carito', 'teresa.carito@cooperativadoc.it', '', 'kSxN[jPa', 2, '261,224,235,185,225,223,276,275,201,184', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '1a669529-f66e-45ff-940e-365795a4e406', NULL, NULL, '2025-06-05 18:52:57', '2025-06-05 19:01:52'),
(344, '', 'chiara.nardone', '$6$2jwj/5aTMYea+0zb$g35LyNqxwKtyaNOqOmXPwfqyyHJvZb6LiEQSiPSK2Hc2vg.Fu1IRxK6LjWiIsPOB76s.EgSPe6mwULUyycg3q0', 'N', 'Chiara', 'Nardone', 'chiara.nardone@cooperativadoc.it', '', 'F2nZ6uf=', 2, '261,224,235,185,225,223,276,275,201,184', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, '053eede5-c2db-4217-92e0-080a77112b87', NULL, NULL, '2025-06-05 18:54:35', '2025-06-05 19:01:29'),
(345, '', 'anna.gramolelli', '$6$vYFIMUjLaufy2fd2$JIdChJUh8dkw7QEc6UcCT7Wc0G9uDPMukbjHU66gqr2ZrpKN0jw2arz39eYZ2Uk2.3CNlKPavMU4.Nvnn7b9R0', 'Y', 'Anna', 'Gramolelli', 'anna.gramolelli@cooperativadoc.it', '', 'potkoz-kypHa0-coxtez', 2, '224,235,185,225,223,276,275,201,184', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-10-15 00:00:00', '408b5bd3-73a5-487c-b14b-a7516182e67e', NULL, NULL, '2025-06-05 18:56:44', '2026-06-17 10:23:53'),
(346, '', 'arianna.bartesaghi', '$6$/AtmbmK/jJYdWgxv$v04YloK0GI0Shs2kHVYwuYeDDDCKkCu8wz4/piqBgNzejGGN4EP1bU9WJ0CrlI86wTABvOc7eO/7WC.MpOGLY/', 'N', 'Arianna ', 'Bartesaghi', 'arianna.bartesaghi@cooperativadoc.it', '', 'D1SfB8dw', 2, '224,235,185,225,223,276,275,201,184,296', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, 'ba561cd2-3083-42a1-a6b7-b87f11a85f42', NULL, NULL, '2025-06-05 18:58:54', '2026-05-26 18:00:51'),
(347, '', 'luca.montanaro', '$6$qp/AWnqywLBSS2Q8$KQA7fzEUacasYIHRB0q/rKwa5SA8kgLhsnMWPCp2UVF7M2pwCTPYmqR95UCAGyCD/saxVv1bvIJtOjnOM/M3o1', 'N', 'Luca', 'Montanaro', 'luca.montanaro@cooperativadoc.it', '', '0lOSMs]H', 2, '224,235,184,185,225,223,276,275,201', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '62727f2c-2afe-4620-ae29-1a3244b43fe4', NULL, NULL, '2025-06-05 19:04:09', '2026-04-29 11:38:16'),
(349, '', 'davide.rambaudi', '$6$jPOKHR5FaM9u4vqA$2l3U.xWzFR15u.91bxkhxIkaLn4MPixjKab2dhj1ZLZAhWmrzbvRde2XzDB2wgW9CvkbmI7GpINDsT4Ubqwik0', 'N', 'Davide ', 'Rambaudi', 'davide.rambaudi@cooperativadoc.it', '', 'Coordinatore1!', 2, '304', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-12-04 00:00:00', 'f90b04ce-f1b5-4b28-937a-2721a0995899', NULL, NULL, '2025-06-05 19:22:07', '2026-04-29 11:50:21'),
(350, '', 'jalindra.savarese', '$6$RfOyaBucZkYwKdT/$5lKYVy7WkxVMYBbWCw7Mj4oiuqrMB/yh/desbmrA7viwsBTAEgr8Y/PmXTDd9a6lYW6V7HrJOGx7.ziLDl2zp1', 'N', 'Jalindra', 'Savarese', 'jalindra.savarese@cooperativadoc.it', '', ')!A1XBUt', 2, '232,309,305', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '3d84dd04-dc2c-48fe-8af6-0d911e105c47', NULL, NULL, '2025-06-05 19:27:19', '2026-06-29 09:32:50'),
(351, '', 'elivira.merenda', '$6$SS27WIdc4HfU3x0o$YdSednFZwhcnL9/O.PgI7cYogCTVX4f3Gmx5ICwyz0RvCkWDslwni/fuxu/4VVKbFulp7DIrileHIwxHBm/NR/', 'Y', 'Elvira ', 'Merenda', 'elvira.merenda@cooperativadoc.it', '', 'Coordinamento*1', 2, '306', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2025-10-08 00:00:00', '3eaa309f-8740-411b-ab04-054768b09dce', NULL, NULL, '2025-06-05 19:52:12', '2026-04-29 11:59:12'),
(352, '', 'licia.cicala', '$6$ghdMIdm7IdA5+/zo$d7zhTLIfEUyIi0bN5c3PtHOaJAERn9cM2Jj9oA48qOvkgyRIJSm2v810m49GkpT0mATgNf8O/Fs9QpN6TRL/x0', 'N', 'Licia', 'Cicala', 'licia.cicala@cooperativadoc.it', '', 'Misano@2025!', 7, '19,304,303,302,306', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-10-09 00:00:00', 'a5b80f0f-97ee-4dfb-a71e-c8a6549083aa', NULL, NULL, '2025-06-05 20:04:18', '2026-06-11 16:04:47'),
(354, '', 'marika.franchini', '$6$tfQbmtHCCTAJhnEK$O12lwB.5SsPn4cFApWPpRnhnstTtWCk9lIpDBHzPkN1TPyh11DBRsQ30xwp.hEtcMenOchu31LBWkjYqStD9F0', 'Y', 'Marika ', 'Franchini', 'marika.franchini@cooperativadoc.it', '', 'D.o.C.26!', 5, '193', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2026-10-02 00:00:00', '34732eeb-7c06-4d53-a4ed-d91e670a1568', NULL, NULL, '2025-06-05 20:14:25', '2026-06-04 08:56:27'),
(355, '', 'mariasofia.fuorvia', '$6$x6p4zo4Wj0jrneED$XEz3tnMsaU3sWHIsyGh1xp5eh90fNcXOsb4pD/oelVkcpFus6E/dP/kT48UHIzbs7wPWt5wznUaL4WfanIKNa0', 'N', 'Maria Sofia', 'Fuorvia', 'mariasofia.fuorvia@cooperattivadoc.it', '', '_Akt7?iE', 2, '266,244,245,214', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, 'ed4f0eda-591e-43e1-8c7d-125ef3a5070b', NULL, NULL, '2025-06-05 20:35:48', '2025-06-05 20:35:48'),
(356, '', 'benedetta.capozzi', '$6$mKhRhqtZXLwUqdcm$.wpIixAhJCNM.iJ9v3Y8znohEjRg0jl7grpyPZ41NttZV1tMDG0ijzmOgwQoDkDKn3cdue9y4sfD/ZTK0GjW90', 'N', 'Benedetta ', 'Capozzi', 'benedetta.capozzi@villaggiobardonecchia.it', '', 'Bardonecchia1!', 3, '261', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', '2025-10-07 00:00:00', 'c878425e-8977-4e6a-a36f-28321a23dba3', NULL, NULL, '2025-06-09 12:29:33', '2025-06-09 13:15:58'),
(358, '', 'claudio.zudettich', '$6$vuReJDxteier/38Q$5myYCvmUm45emgr6wG4HVOMwd/y9qGbJ11mamS9IYNDrLbjklXzwt7wcdwTPHAlQKyhnmDVyMGVTUfmuCH7RM1', 'N', 'Claudio', 'Zudettich', 'claudio.zudettich@cooperativadoc.it', '', '[YifdkyZ', 2, '224,235,184,223,185,201', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '9cfd69e1-2d0d-45d4-8490-b35ffbcebc43', NULL, NULL, '2026-02-05 17:34:57', '2026-05-26 18:02:35'),
(359, '', 'paolo.corallini', '$6$T5tlrE7XyjpEr5lx$hPtUfr3UIXcPPHOzpdtA.nRIQBPt737UltkvvNImF9lzbM8PMX/sOPCGM9aIWi3bQOq9YtyJp7Dy4gr9JPMo5/', 'N', 'Paolo', 'Corallini', 'paolo.corallini@libero.it', '', 'Cocorito2026@', 7, '156,12,200,50', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-10-28 00:00:00', '9acab56e-f817-4df4-8b30-10b20d5f94e2', NULL, NULL, '2026-03-02 10:10:58', '2026-06-30 10:47:03'),
(360, '', 'ines.emili', '$6$JDskqDkCr+VuWc1I$3PqvRCOfSQgN103UyY4jLJG8ifGsoNw8o.YvRrNVAu.8n.7aRh7aVfXW/y.oWYDknpozTKV6U3gODNaFuB6uA.', 'N', 'Ines', 'Emili', 'inses.emili@cooperativadoc.it', '', 'Rnphfw52', 3, '156', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, '3669841a-a47b-4adc-95d2-97995577316b', NULL, NULL, '2026-03-03 10:42:22', '2026-03-03 10:42:22'),
(362, '', 'marco.furcas', '$6$2krqfBsS2JpXcVxa$fqLhB3tK0LX5aPgqO9QxJ0N1010dCWZKVzLQrInC5.VZPliVBYl8MqTv.fGhCtmhQcOc.ncGB5geHowFGlA/t0', 'N', 'Marco', 'Furcas', 'marco.furcas@sharing.to.it', '', '(a_F035B', 2, '8', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, '96aef74f-38a9-4220-834b-869b1dc7254f', NULL, NULL, '2026-04-03 12:34:03', '2026-04-03 12:34:03'),
(364, '', 'nadia.bussoletti', '$6$QHqA7ktE1RRbMEhe$8syqexiCdSOlq81mTVjjLLgktLe/ZQYAx37LWZe4czWCEzZ/YY7tL1640DuxROc5ExYdIpwxhDA8vhbcinrRT.', 'N', 'Nadia', 'Bussoletti', 'nadia.bussoletti@cooperativadoc.it', '', '5Zs?c$Jx', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, 'c02bd06f-eb47-45a9-9b82-60d5ac2bd797', NULL, NULL, '2026-04-03 12:35:36', '2026-04-03 12:35:36'),
(365, '', 'patrizia.busini', '$6$XYWUpjJzzo4ZI14p$8o.Cc00vbsvv1zjoW/NrzVBzS8oFnrt9TxiRGhJY4wqG9Th9aanC52UdKN7MXMWHo3XCdVXFNVINGS9M1HcsW1', 'N', 'Patrizia', 'Busini', 'patrizia.busini@cooperativadoc.it', '', 'nto)4lQp', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, '3f2742e0-e3b8-41f1-a323-162c981f27df', NULL, NULL, '2026-04-03 12:37:28', '2026-04-03 12:37:28'),
(366, '', 'nicole.herrera', '$6$zRMaBQ60+5lKprxL$2Xf0Ll4UvfmgEhY24Bkc3OgPTKntvZje40epXN.uS0t/PFzRjLZTP9zoWrIAjqudc2k2KFro7lFNyVmlWoNVE0', 'N', 'Nicole', 'Herrera', 'nikole669@gmail.com', '', 'Os]q:Xp,', 2, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, '775c2a86-a4fd-4c58-8648-ccc03ece29fe', NULL, NULL, '2026-04-03 12:40:58', '2026-04-03 12:40:58'),
(367, '', 'moreno.tonti', '$6$ej4AI0gafjCTqwQz$CknKWhg/3LFN8DXlyZzmg.F/glf2PRjwzAo4.VR1mvwDh079bpqQ1P0ktA1C021VXZL44u1Ja0aEoFUBzda2E.', 'N', 'Moreno', 'Tonti', 'chikosemantik@gmail.com', '', '2:6ydjU[', 2, '12', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, 'cb6abc4f-7dc4-4a80-ba50-f7b44cf97439', NULL, NULL, '2026-04-03 12:44:43', '2026-04-03 12:45:00'),
(368, '', 'chiara.zanni', '$6$A7ycs4olwx5woDhr$lsRbwCujy/eWWefJhKKZKkpnYaQa04ZENDgpkFoqcAPBJAx0FmLl.UHFKPhPKwciV7845x.DRMONopFX.d5Vw1', 'N', 'Chiara', 'Zanni', 'chiara.zanni@cascinafossata.it', '', '_?rBvdC5', 2, '155', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N', NULL, '8cc1f63e-b067-4c08-ace3-415990c95c2f', NULL, NULL, '2026-04-03 12:46:25', '2026-04-03 12:47:03'),
(369, '', 'test.manutentore', '$6$NoB190vs8ZBW8yP8$oPRZahzFgMU0PnQZyytvr9PsuksXcmSo2bARnDGiifrps3stkOKbyMLO2Z3nALPzdSrQjKtpUlelzAPHMI0WY0', 'N', 'test', 'manutentore', 'testmanutentoredoc@gmail.com', '', 'Docscs123!', 2, '302,303', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', '2026-08-06 00:00:00', '3034d79a-97e6-4bdd-87bd-ce8015b38087', NULL, NULL, '2026-04-08 09:17:39', '2026-05-06 12:17:01'),
(371, '', 'test.manutentore2', '$6$NPt38hnkn75qcrhH$c3sY.lBp6DYgE2haH43AhsLjc1wCefheJut7P/Ndn3b6KdsXQCrHtjh2neHpSxkqcn/rYPlEFE5gdiAb1ncB01', 'N', 'test', 'manutentore2', 'boenzi_enrico@yahoo.it', '', 'Docscs123!', 12, '5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-08-06 00:00:00', '40ddabf0-cb7d-41db-bcb0-fe56033bad38', NULL, NULL, '2026-04-08 09:19:24', '2026-04-09 09:12:57'),
(374, '', 'test.capomanutentore', '$6$sGPxQxMvyH7V2NG/$rIBXhUIRPh4d3VtCYyGwQY96VF1CY1HU0G7Xrc7TG4RZ.45hMkfK08yIRG92pERXvzlhxlWsQ8yS7/ulkIPfS/', 'N', 'test', 'capomanutentore', 'qualita@cooperativadoc.it', '', 'Docscs123!', 2, '5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-08-06 00:00:00', '83bb92e3-7d4f-417d-8a10-b9c5a0df46c8', NULL, NULL, '2026-04-08 10:11:04', '2026-04-29 11:15:35'),
(375, '', 'test.segnalatore', '$6$mRAtYrG/VF8vpUja$JCtFqVIwE28jwNolsXQyphGYW0OF9JR4FJV8h7W7N1s/dH7r28uo1.guDDD6GyEEPUMhRljEgKE0fJYMdkLYa0', 'N', 'test', 'segnalatore', 'acquisti@cooperativadoc.it', '', 'Docscs123!', 11, '5', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-08-07 00:00:00', 'ef667197-d02a-484e-8d33-9c577bb335f6', NULL, NULL, '2026-04-09 09:18:16', '2026-04-09 09:20:54'),
(382, '', 'jolanda.genova', '$6$eUS5NH7Ngizn+srM$5JYIAdUBKL.DC1eePJKe0UdpdX6kHjKFdGoSHDzSYJ9vTVgL8qRM0TThv/dfur7n/zOSHtvJijVYWlpFrFSB.0', 'N', 'Jolanda', 'Genova', 'jolanda.genova@cooperativadoc.it', '', 'J16525pa?', 2, '302,303', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-08-30 00:00:00', 'eb3d6151-13ae-40d6-8dbf-e0b4d7c2c821', NULL, NULL, '2026-04-29 11:55:01', '2026-05-02 12:34:13'),
(384, '', 'marione76ferretti', '$6$Nxk3tHio590Mw6cU$7FtgsJDjGszf.v0h1EphYt3cpUhVt34S9.hRXRwh2UlVgFNFzSIHj6/jXfWWFNzbB0tNNA1CsLGbdC9Bt7Wao/', 'N', 'Marione', 'Ferretti', 'marione76ferretti@gmail.com', '', 'Rmde3yck', 2, '176', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', NULL, '0f9ee382-024e-4477-a816-99f92da49da4', NULL, NULL, '2026-05-04 12:19:57', '2026-05-04 12:19:57'),
(388, '', 'mario76ferretti', '$6$4KklVb5NkB5hN4+y$yInaYuT9UitVD4aDkXi9JGOdKMcAD/fget12GV5Dlbdk3cpIcd6OJK43nfDnXN55Tz4zkURQZKRWV74mJxYxE0', 'N', 'TEst Mario', 'Ferretti', 'mario76ferretti@gmail.com', '', 'Lo2612pk???', 3, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-09-01 00:00:00', '588d6a01-c18f-45ef-956c-dc49c9448f03', NULL, NULL, '2026-05-04 12:39:23', '2026-06-05 11:45:26'),
(392, '', 'vitamaria.delvecchio', '$6$p3g948pPxFRA9e7v$Nb8kqnWoBzLF8D6BLeDyTDFrR0nerCY1x8gYaweczxX7MK1LZ7hhi4E.8sjDC12ekdlOCr8CR.ZYW1c13AZqa1', 'Y', 'Vita Maria', 'Del Vecchio', 'vitamaria.delvecchio@cooperativadoc.it', '', 'LeoVita23!', 2, '182,240,274,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', '2026-09-23 00:00:00', '595a93a8-86ad-4af5-ad65-9e0d64da6c0a', NULL, NULL, '2026-05-05 13:01:59', '2026-05-26 15:51:30'),
(393, '', 'chiara.dellamico', '$6$m9+SOaR6hWxb+IJw$YiQuceiRx0dO..hxyyWuzlgmmkmloTBmCu1NcnaM2v.AlzpQ1ed3C1COSC7s.WZ2r.34lmd0tUmt4/.goI0oP.', 'Y', 'Chiara', 'Dell\'Amico', 'chiara.dellamico@cooperativadoc.it', '', 'Kikketta96!', 2, '182,240,274,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', '2026-09-03 00:00:00', '3f7c27f9-6fbd-4db7-9c37-97ccb926429e', NULL, NULL, '2026-05-05 13:02:39', '2026-05-06 14:03:23'),
(394, '', 'giulia.lombardi', '$6$RjRUHT2o70Or2mqr$d9/4wY6xWgGyGMd9HrtrIDcGgf9/qfsoMuuLgZWENan6a2keEeD6HibPE.HriTEdnhaffIWEXsji6IGHEvLe1/', 'N', 'Giulia', 'Lombardi', 'giulia.lombardi@cooperativadoc.it', '', 'Z-C5T@Qy', 2, '182,240,274,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', NULL, '6dfdd639-5e3f-4b50-9fbf-438da9971312', NULL, NULL, '2026-05-05 13:03:05', '2026-05-05 13:03:05'),
(395, '', 'vittorio.passaro', '$6$YdlpiVUvDsxsv9a3$cszZwHzA2qvP9Qm9uOitsvFJdKG5E.8aVEmjtYLYWvMGZ0FYGh/8rJ3mJT95umw5NNNiUBce040VbWZVxtjD21', 'N', 'Vittorio', 'Passaro', 'vittorio.passaro@cooperativadoc.it', '', '!xY,S3sJ', 2, '302,303', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', NULL, '5cf1187a-fd64-488e-8260-7447dca3b503', NULL, NULL, '2026-05-05 13:03:30', '2026-05-05 13:03:30'),
(396, '', 'davide.caravello', '$6$iICCSxL4mB1GhQ3e$Y/omfvkYmNNyfkonH96XA6rImpRZ6A26hErUMRrk6LmMqcB0wMHZUzsrHh55t2/qQ2B0gaY4JZupCRekFzNS00', 'Y', 'Davide', 'Caravello', 'davide.caravello@cooperativadoc.it', '', 'Poterecontrollocatene77!', 2, '304', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', '2026-09-03 00:00:00', '1674d4e1-fe0e-475c-bb93-9b734f94f3f2', NULL, NULL, '2026-05-05 13:04:06', '2026-05-06 16:20:00'),
(397, '', 'camilla.zoncada', '$6$BT6e5dIxpwm534t4$Lumm8CCJi70LR9/smHvPhT4CIoZlEwu4IcIAbznJU5IkN/zjAQ.V5N.hhrhMxUljXm1QJb3benQ6mkd6oUrSp1', 'Y', 'Camilla', 'Zoncada', 'camilla.zoncada@cooperativadoc.it', '', 'MuAe!js5vRVpTWP', 2, '307', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', '2026-09-16 00:00:00', 'a4024b56-d2d1-40e2-a8f3-e78e1fd431e8', NULL, NULL, '2026-05-05 13:04:28', '2026-05-19 16:19:58'),
(398, '', 'prova.prova', '$6$Vq/tSbbVvJz38Pw1$g7bJYsmQvVovH/eFbGTI.GHOj7.T.FpDvwQogxb9NpIQOTJdp8wjChqUS26nBbNliR4dPyOlpbOyROgKhazd50', 'Y', 'prova', 'prova', 'enricoboenzi@gmail.com', '', 'Dirtypl1596!', 2, '302,303', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-09-03 00:00:00', '012852f5-246c-46dc-bd42-84daa5c536a3', NULL, NULL, '2026-05-06 11:43:18', '2026-05-06 11:54:22'),
(399, '', 'prova.coordinatore', '$6$lQORkPDEFl0yb7M5$RgTb.Dvgl9t7JFJNee1EUKjzxrwTeSGRkYi3usSNK.KAhNNWkiDAVVrkwwGy0yPeMj.R3XcKLzkF.ZsxJ9w4i.', 'Y', 'prova', 'coordinatore', 'enricoboenzi@gmail.com', '', 'Prova1234*', 7, '302,303', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '2026-09-23 00:00:00', 'a0b982a8-847f-43be-aaa3-8412cba5bbfe', NULL, NULL, '2026-05-26 14:06:05', '2026-05-26 14:09:25'),
(400, '', 'segreteria.cesenatico', '$6$XaYz5EUHGbgtn1BO$hpg//jfcmCUoeLoMLWvCBHQ4yRw6CgJ0O2GQSh6ofEMF9IK7a4/pWYkIAJNHvfSOavUbPk4TPa7Ir5UFt1QYV.', 'Y', 'Segreteria', 'Cesenatico', 'cesenatico@cooperativadoc.it', '', 'Colonia*21', 2, '182,262,240,274,310', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'Y', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', '2026-09-29 00:00:00', 'dc8e76f8-e759-47a0-80d3-815495b796ef', NULL, NULL, '2026-05-29 12:10:41', '2026-06-01 07:55:35'),
(401, '', 'linda.dominante ', '$6$+zu6iModaRBOk+gC$9MvrN8yi4C/Wf1AGbQNlO8PtbJyKim/UZ3L/ZY1jIi5KUaBKPY9RROdAsdF9Wkvo./SqoY7crEj6rwPo2sAkS/', 'N', 'Linda', 'Dominante', 'linda.dominante@cooperativadoc.it', '', 'E2&KHruc', 2, '71', NULL, NULL, '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', NULL, NULL, 'N', 'N', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', NULL, '030ee0d1-88c3-4298-989f-faeaf8de2dea', NULL, NULL, '2026-05-29 14:36:56', '2026-05-29 14:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `utenti_gruppi`
--

CREATE TABLE `utenti_gruppi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_login_access`
--

CREATE TABLE `utenti_login_access` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_date` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_log_request`
--

CREATE TABLE `utenti_log_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT current_timestamp(),
  `request_method` varchar(10) DEFAULT NULL,
  `request_http_code_response` char(3) DEFAULT NULL,
  `request_url` varchar(255) DEFAULT NULL,
  `request_data` text DEFAULT NULL,
  `request_body_raw` text DEFAULT NULL,
  `class_controller_action` varchar(255) DEFAULT NULL,
  `request_browser` varchar(255) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_old`
--

CREATE TABLE `utenti_old` (
  `id` int(11) NOT NULL,
  `id_signal` varchar(255) NOT NULL,
  `user` varchar(20) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `cellulare` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 2,
  `user_unita` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `preiscrizione_sn` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_sp` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_cs` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_sh` enum('N','Y') NOT NULL DEFAULT 'N',
  `preiscrizione_tim` enum('Y','N') DEFAULT 'N',
  `q_junior` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_senior` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_scientifici` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_studio` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_doc` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_campus` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_keluar` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_sharing` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_formazione` enum('Y','N') NOT NULL DEFAULT 'N',
  `q_vacanza` enum('Y','N') NOT NULL DEFAULT 'N',
  `preiscrizione_cm` enum('Y','N') DEFAULT 'N',
  `push_qualita` enum('Y','N') DEFAULT NULL,
  `push_centriestivi` enum('Y','N') DEFAULT NULL,
  `verifiche_ispettive` enum('Y','N') NOT NULL DEFAULT 'N',
  `formazione` enum('Y','N') NOT NULL DEFAULT 'N',
  `statistiche` enum('Y','N') NOT NULL DEFAULT 'N',
  `letture_contatori` enum('Y','N') NOT NULL DEFAULT 'N',
  `utenze` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_request_reset_password`
--

CREATE TABLE `utenti_request_reset_password` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(36) DEFAULT NULL,
  `request_date` datetime DEFAULT current_timestamp(),
  `expire_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_ruoli`
--

CREATE TABLE `utenti_ruoli` (
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_tags`
--

CREATE TABLE `utenti_tags` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_tags_assoc`
--

CREATE TABLE `utenti_tags_assoc` (
  `utente_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenti_tipi`
--

CREATE TABLE `utenti_tipi` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `gruppo` enum('ADMIN','DIRECTOR','RESPONSIBLE','USER','SEGNALATORE','MANUTENTORE') NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `utenti_tipi`
--

INSERT INTO `utenti_tipi` (`id`, `nome`, `gruppo`, `permissions`) VALUES
(2, 'Utente', 'USER', '{\"Utenti\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Reclami\": {\"view\": \"1\", \"class\": \"DbReclami\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Verifiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Formazione\": {\"view\": \"1\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Comunicazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiQualita\": {\"view\": \"1\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniNonConformi\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"dbNonConforme\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}'),
(3, 'Direttore di Struttura', 'DIRECTOR', '{\"Utenti\":{\"enabled\":\"0\",\"view\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"User\",\"controller\":\"\"},\"Impostazioni\":{\"enabled\":\"0\",\"view\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"AzioniNonConformi\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"DbNonconforme\",\"controller\":\"\"},\"AzioniCorrettive\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"DbAzionicorrettive\",\"controller\":\"\"},\"Reclami\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"DbReclami\",\"controller\":\"\"},\"AzioniReclami\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"ReclamiAzioni\",\"controller\":\"\"},\"Verifiche\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"AzioniVerifiche\",\"controller\":\"\"},\"DocumentiQualita\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"DocumentiQualita\",\"controller\":\"\"},\"DocumentiSoggiorni\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"DocumentiSoggiorni\",\"controller\":\"\"},\"Area Documenti\":{\"enabled\":\"0\",\"view\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"Documents\",\"controller\":\"documents\"},\"Formazione\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"FormazioneCorsi\",\"controller\":\"\"},\"Statistiche\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"Utenze\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"\",\"controller\":\"\"},\"Letture contatori\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"IndiceSoddisfazione\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"Questionari\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"\",\"controller\":\"\"},\"StatisticheQuestionari\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"Preiscrizioni\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"\",\"controller\":\"\"},\"Segnalazioni\":{\"enabled\":\"1\",\"view\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\",\"class\":\"\",\"controller\":\"\"},\"Manutenzioni\":{\"enabled\":\"0\",\"view\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"},\"Scarica Dati\":{\"enabled\":\"1\",\"view\":\"0\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\",\"class\":\"\",\"controller\":\"\"}}'),
(5, 'Direttore Educativo/Responsabile di Progetto', 'RESPONSIBLE', '{\"Utenti\": {\"view\": \"0\", \"class\": \"User\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Reclami\": {\"view\": \"1\", \"class\": \"DbReclami\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Verifiche\": {\"view\": \"1\", \"class\": \"AzioniVerifiche\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Formazione\": {\"view\": \"1\", \"class\": \"FormazioneCorsi\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Scarica Dati\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"Segnalazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"1\", \"class\": \"ReclamiAzioni\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"1\", \"class\": \"DbAzionicorrettive\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiQualita\": {\"view\": \"1\", \"class\": \"DocumentiQualita\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniNonConformi\": {\"view\": \"1\", \"class\": \"DbNonconforme\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"1\", \"class\": \"DocumentiSoggiorni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}'),
(7, 'Auditor Interno', 'USER', '{\"Utenti\": {\"view\": \"0\", \"class\": \"User\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Reclami\": {\"view\": \"1\", \"class\": \"DbReclami\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Verifiche\": {\"view\": \"1\", \"class\": \"AzioniVerifiche\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Formazione\": {\"view\": \"1\", \"class\": \"FormazioneCorsi\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"1\", \"class\": \"ReclamiAzioni\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"1\", \"class\": \"DbAzionicorrettive\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiQualita\": {\"view\": \"1\", \"class\": \"DocumentiQualita\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniNonConformi\": {\"view\": \"1\", \"class\": \"DbNonconforme\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"1\", \"class\": \"DocumentiSoggiorni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}'),
(8, 'Admin', 'ADMIN', '{\"Utenti\": {\"view\": \"1\", \"class\": \"User\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Utenze\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Reclami\": {\"view\": \"1\", \"class\": \"DbReclami\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Verifiche\": {\"view\": \"1\", \"class\": \"AzioniVerifiche\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Formazione\": {\"view\": \"1\", \"class\": \"FormazioneCorsi\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Questionari\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Scarica Dati\": {\"enabled\": \"1\"}, \"Segnalazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"1\", \"class\": \"ReclamiAzioni\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Preiscrizioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"1\", \"class\": \"DbAzionicorrettive\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiQualita\": {\"view\": \"1\", \"class\": \"DocumentiQualita\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniNonConformi\": {\"view\": \"1\", \"class\": \"DbNonconforme\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Letture contatori\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"1\", \"class\": \"DocumentiSoggiorni\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"IndiceSoddisfazione\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}}'),
(9, 'Big Boss', 'ADMIN', '{\"Utenti\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Utenze\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Reclami\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Verifiche\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Formazione\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Questionari\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Scarica Dati\": {\"enabled\": \"1\"}, \"Segnalazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Preiscrizioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiQualita\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniNonConformi\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Letture contatori\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"IndiceSoddisfazione\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}}'),
(11, 'Segnalatore', 'SEGNALATORE', '{\"Utenti\": {\"view\": \"0\", \"class\": \"User\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenti\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenzePresenze\"}, \"Reclami\": {\"view\": \"0\", \"class\": \"DbReclami\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbReclami\"}, \"Verifiche\": {\"view\": \"0\", \"class\": \"AzioniVerifiche\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniVerifiche\"}, \"Formazione\": {\"view\": \"0\", \"class\": \"FormazioneCorsi\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniFormazioni\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Segnalazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"0\", \"class\": \"ReclamiAzioni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"reclamiAzioni\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"0\", \"class\": \"DbAzionicorrettive\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbAzioniCorrettive\"}, \"DocumentiQualita\": {\"view\": \"0\", \"class\": \"DocumentiQualita\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiQualita\"}, \"AzioniNonConformi\": {\"view\": \"0\", \"class\": \"DbNonconforme\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbNonconforme\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"0\", \"class\": \"DocumentiSoggiorni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiSoggiorni\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}'),
(12, 'Manutentore', 'MANUTENTORE', '{\"Utenti\": {\"view\": \"0\", \"class\": \"User\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenti\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenzePresenze\"}, \"Reclami\": {\"view\": \"0\", \"class\": \"DbReclami\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbReclami\"}, \"Verifiche\": {\"view\": \"0\", \"class\": \"AzioniVerifiche\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniVerifiche\"}, \"Formazione\": {\"view\": \"0\", \"class\": \"FormazioneCorsi\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniFormazioni\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Segnalazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"0\", \"class\": \"ReclamiAzioni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"reclamiAzioni\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"0\", \"class\": \"DbAzionicorrettive\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbAzioniCorrettive\"}, \"DocumentiQualita\": {\"view\": \"0\", \"class\": \"DocumentiQualita\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiQualita\"}, \"AzioniNonConformi\": {\"view\": \"0\", \"class\": \"DbNonconforme\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbNonconforme\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"0\", \"class\": \"DocumentiSoggiorni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiSoggiorni\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}'),
(13, 'Responsabile Manutenzioni', 'DIRECTOR', '{\"Utenti\": {\"view\": \"0\", \"class\": \"User\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenti\"}, \"Utenze\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"utenzePresenze\"}, \"Reclami\": {\"view\": \"0\", \"class\": \"DbReclami\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbReclami\"}, \"Verifiche\": {\"view\": \"0\", \"class\": \"AzioniVerifiche\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniVerifiche\"}, \"Formazione\": {\"view\": \"0\", \"class\": \"FormazioneCorsi\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"azioniFormazioni\"}, \"Questionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Statistiche\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Impostazioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"Manutenzioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"Segnalazioni\": {\"view\": \"1\", \"class\": \"\", \"create\": \"1\", \"delete\": \"1\", \"update\": \"1\", \"enabled\": \"1\", \"controller\": \"\"}, \"AzioniReclami\": {\"view\": \"0\", \"class\": \"ReclamiAzioni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"reclamiAzioni\"}, \"Preiscrizioni\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"AzioniCorrettive\": {\"view\": \"0\", \"class\": \"DbAzionicorrettive\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbAzioniCorrettive\"}, \"DocumentiQualita\": {\"view\": \"0\", \"class\": \"DocumentiQualita\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiQualita\"}, \"AzioniNonConformi\": {\"view\": \"0\", \"class\": \"DbNonconforme\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"dbNonconforme\"}, \"Letture contatori\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"DocumentiSoggiorni\": {\"view\": \"0\", \"class\": \"DocumentiSoggiorni\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"documentiSoggiorni\"}, \"IndiceSoddisfazione\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}, \"StatisticheQuestionari\": {\"view\": \"0\", \"class\": \"\", \"create\": \"0\", \"delete\": \"0\", \"update\": \"0\", \"enabled\": \"0\", \"controller\": \"\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `utenze_acqua`
--

CREATE TABLE `utenze_acqua` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `c_gennaio` float DEFAULT NULL,
  `c_febbraio` float DEFAULT NULL,
  `c_marzo` float DEFAULT NULL,
  `c_aprile` float NOT NULL,
  `c_maggio` float DEFAULT NULL,
  `c_giugno` float DEFAULT NULL,
  `c_luglio` float DEFAULT NULL,
  `c_agosto` float DEFAULT NULL,
  `c_settembre` float DEFAULT NULL,
  `c_ottobre` float DEFAULT NULL,
  `c_novembre` float DEFAULT NULL,
  `c_dicembre` float DEFAULT NULL,
  `totale` int(11) DEFAULT NULL,
  `c_totale` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenze_chimici`
--

CREATE TABLE `utenze_chimici` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `c_gennaio` float DEFAULT NULL,
  `c_febbraio` float DEFAULT NULL,
  `c_marzo` float DEFAULT NULL,
  `c_aprile` float NOT NULL,
  `c_maggio` float DEFAULT NULL,
  `c_giugno` float DEFAULT NULL,
  `c_luglio` float DEFAULT NULL,
  `c_agosto` float DEFAULT NULL,
  `c_settembre` float DEFAULT NULL,
  `c_ottobre` float DEFAULT NULL,
  `c_novembre` float DEFAULT NULL,
  `c_dicembre` float DEFAULT NULL,
  `totale` int(11) DEFAULT NULL,
  `c_totale` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenze_gas`
--

CREATE TABLE `utenze_gas` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `c_gennaio` float DEFAULT NULL,
  `c_febbraio` float DEFAULT NULL,
  `c_marzo` float DEFAULT NULL,
  `c_aprile` float NOT NULL,
  `c_maggio` float DEFAULT NULL,
  `c_giugno` float DEFAULT NULL,
  `c_luglio` float DEFAULT NULL,
  `c_agosto` float DEFAULT NULL,
  `c_settembre` float DEFAULT NULL,
  `c_ottobre` float DEFAULT NULL,
  `c_novembre` float DEFAULT NULL,
  `c_dicembre` float DEFAULT NULL,
  `totale` int(11) DEFAULT NULL,
  `c_totale` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenze_luce`
--

CREATE TABLE `utenze_luce` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `c_gennaio` float DEFAULT NULL,
  `c_febbraio` float DEFAULT NULL,
  `c_marzo` float DEFAULT NULL,
  `c_aprile` float NOT NULL,
  `c_maggio` float DEFAULT NULL,
  `c_giugno` float DEFAULT NULL,
  `c_luglio` float DEFAULT NULL,
  `c_agosto` float DEFAULT NULL,
  `c_settembre` float DEFAULT NULL,
  `c_ottobre` float DEFAULT NULL,
  `c_novembre` float DEFAULT NULL,
  `c_dicembre` float DEFAULT NULL,
  `totale` int(11) DEFAULT NULL,
  `c_totale` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenze_presenze`
--

CREATE TABLE `utenze_presenze` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `totale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utenze_rifiuti`
--

CREATE TABLE `utenze_rifiuti` (
  `id` int(11) NOT NULL,
  `struttura` int(11) NOT NULL,
  `anno` int(11) NOT NULL,
  `gennaio` int(11) DEFAULT NULL,
  `febbraio` int(11) DEFAULT NULL,
  `marzo` int(11) DEFAULT NULL,
  `aprile` int(11) DEFAULT NULL,
  `maggio` int(11) DEFAULT NULL,
  `giugno` int(11) DEFAULT NULL,
  `luglio` int(11) DEFAULT NULL,
  `agosto` int(11) DEFAULT NULL,
  `settembre` int(11) DEFAULT NULL,
  `ottobre` int(11) DEFAULT NULL,
  `novembre` int(11) DEFAULT NULL,
  `dicembre` int(11) DEFAULT NULL,
  `c_gennaio` float DEFAULT NULL,
  `c_febbraio` float DEFAULT NULL,
  `c_marzo` float DEFAULT NULL,
  `c_aprile` float NOT NULL,
  `c_maggio` float DEFAULT NULL,
  `c_giugno` float DEFAULT NULL,
  `c_luglio` float DEFAULT NULL,
  `c_agosto` float DEFAULT NULL,
  `c_settembre` float DEFAULT NULL,
  `c_ottobre` float DEFAULT NULL,
  `c_novembre` float DEFAULT NULL,
  `c_dicembre` float DEFAULT NULL,
  `totale` int(11) DEFAULT NULL,
  `c_totale` float(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visibility_rules`
--

CREATE TABLE `visibility_rules` (
  `id` int(11) NOT NULL,
  `ruleset_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `source_type` enum('participant_field','question_answer') NOT NULL,
  `source_key` varchar(50) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visibility_rulesets`
--

CREATE TABLE `visibility_rulesets` (
  `id` int(11) NOT NULL,
  `target_type` enum('question','section') NOT NULL,
  `target_id` int(10) UNSIGNED NOT NULL,
  `combine_operator` enum('and','or') NOT NULL DEFAULT 'and',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_config`
--

CREATE TABLE `_config` (
  `id` int(11) NOT NULL,
  `txt` text DEFAULT NULL,
  `val_key` varchar(255) DEFAULT NULL,
  `lang` varchar(6) NOT NULL DEFAULT 'it-IT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_ip`
--
ALTER TABLE `0_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `0_preiscrizioni`
--
ALTER TABLE `0_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_participant_id` (`participant_id`),
  ADD KEY `idx_question_id` (`question_id`),
  ADD KEY `fk_questionnaire_version` (`questionnaire_version_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ca_preiscrizioni`
--
ALTER TABLE `ca_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cm_preiscrizioni`
--
ALTER TABLE `cm_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comunicazioni`
--
ALTER TABLE `comunicazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comunicazioni_tipologie`
--
ALTER TABLE `comunicazioni_tipologie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_azionicorrettive`
--
ALTER TABLE `db_azionicorrettive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_formazione`
--
ALTER TABLE `db_formazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `titolo_id` (`titolo_id`);

--
-- Indexes for table `db_nonconforme`
--
ALTER TABLE `db_nonconforme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verificaQuestionId` (`verificaQuestionId`);

--
-- Indexes for table `db_reclami`
--
ALTER TABLE `db_reclami`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utente` (`id_utente`);

--
-- Indexes for table `db_reclami_azioni`
--
ALTER TABLE `db_reclami_azioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reclamo_id` (`id_reclamo`);

--
-- Indexes for table `db_verifiche`
--
ALTER TABLE `db_verifiche`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autore` (`autore`),
  ADD KEY `tipo_verifica` (`tipo_verifica`);

--
-- Indexes for table `db_verifiche_ambientale`
--
ALTER TABLE `db_verifiche_ambientale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_amministrative`
--
ALTER TABLE `db_verifiche_amministrative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_educative`
--
ALTER TABLE `db_verifiche_educative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_educazione`
--
ALTER TABLE `db_verifiche_educazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_manutenzione`
--
ALTER TABLE `db_verifiche_manutenzione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_ristorazione`
--
ALTER TABLE `db_verifiche_ristorazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_verifiche_sicurezza`
--
ALTER TABLE `db_verifiche_sicurezza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_azione`
--
ALTER TABLE `doc_azione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_camere`
--
ALTER TABLE `doc_camere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulaId` (`formulaId`);

--
-- Indexes for table `doc_camere_fossata`
--
ALTER TABLE `doc_camere_fossata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_campus`
--
ALTER TABLE `doc_campus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulaId` (`formulaId`);

--
-- Indexes for table `doc_campus_fossata`
--
ALTER TABLE `doc_campus_fossata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_clienti`
--
ALTER TABLE `doc_clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_clienti_tipologia_soggiorni`
--
ALTER TABLE `doc_clienti_tipologia_soggiorni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `tipologia_id` (`tipologia_id`),
  ADD KEY `soggiorno_id` (`soggiorno_id`);

--
-- Indexes for table `doc_codici`
--
ALTER TABLE `doc_codici`
  ADD PRIMARY KEY (`id_nc`);

--
-- Indexes for table `doc_colori`
--
ALTER TABLE `doc_colori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_conoscenza`
--
ALTER TABLE `doc_conoscenza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_documenti_qualita`
--
ALTER TABLE `doc_documenti_qualita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funzione_fk` (`funzione_responsabile_id`),
  ADD KEY `procedura_id` (`procedura_id`);

--
-- Indexes for table `doc_documenti_qualita_procedura`
--
ALTER TABLE `doc_documenti_qualita_procedura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_documenti_qualita_unita`
--
ALTER TABLE `doc_documenti_qualita_unita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documenti_id` (`documenti_id`),
  ADD KEY `unita_id` (`unita_id`);

--
-- Indexes for table `doc_documenti_soggiorni`
--
ALTER TABLE `doc_documenti_soggiorni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funzione_fk` (`funzione_responsabile_id`),
  ADD KEY `procedura_id` (`procedura_id`);

--
-- Indexes for table `doc_documenti_soggiorni_procedura`
--
ALTER TABLE `doc_documenti_soggiorni_procedura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_documenti_soggiorni_unita`
--
ALTER TABLE `doc_documenti_soggiorni_unita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documenti_id` (`documenti_id`),
  ADD KEY `unita_id` (`unita_id`);

--
-- Indexes for table `doc_documents`
--
ALTER TABLE `doc_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funzione_fk` (`funzione_responsabile_id`),
  ADD KEY `procedura_id` (`procedura_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `doc_documents_category`
--
ALTER TABLE `doc_documents_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_documents_procedures`
--
ALTER TABLE `doc_documents_procedures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `doc_email_queue`
--
ALTER TABLE `doc_email_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_email` (`to_email`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `doc_formazione_categorie`
--
ALTER TABLE `doc_formazione_categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formazione_formazioni`
--
ALTER TABLE `doc_formazione_formazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formazione_gruppi`
--
ALTER TABLE `doc_formazione_gruppi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formazione_gruppi_corsi`
--
ALTER TABLE `doc_formazione_gruppi_corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_corso` (`id_corso`);

--
-- Indexes for table `doc_formazione_titolo_corsi`
--
ALTER TABLE `doc_formazione_titolo_corsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formazione_utenti_corsi`
--
ALTER TABLE `doc_formazione_utenti_corsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_corso` (`id_corso`);

--
-- Indexes for table `doc_formazione_utenti_gruppi`
--
ALTER TABLE `doc_formazione_utenti_gruppi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formule`
--
ALTER TABLE `doc_formule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_formule_fossata`
--
ALTER TABLE `doc_formule_fossata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_funzione`
--
ALTER TABLE `doc_funzione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_giudizzi`
--
ALTER TABLE `doc_giudizzi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_housing`
--
ALTER TABLE `doc_housing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formulaId` (`formulaId`);

--
-- Indexes for table `doc_housing_fossata`
--
ALTER TABLE `doc_housing_fossata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_letture`
--
ALTER TABLE `doc_letture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_matricole`
--
ALTER TABLE `doc_matricole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_nazioni`
--
ALTER TABLE `doc_nazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_occupazioni`
--
ALTER TABLE `doc_occupazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_preiscrizioni`
--
ALTER TABLE `doc_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_reclami_canali`
--
ALTER TABLE `doc_reclami_canali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_reclami_tipologie`
--
ALTER TABLE `doc_reclami_tipologie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_responsabile`
--
ALTER TABLE `doc_responsabile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_rooming`
--
ALTER TABLE `doc_rooming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_segnalato`
--
ALTER TABLE `doc_segnalato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_sms_queue`
--
ALTER TABLE `doc_sms_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_email` (`recipient`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `doc_societa`
--
ALTER TABLE `doc_societa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_soggiorno`
--
ALTER TABLE `doc_soggiorno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologia_soggiorni`
--
ALTER TABLE `doc_tipologia_soggiorni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_aperture`
--
ALTER TABLE `doc_tipologie_aperture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_clienti`
--
ALTER TABLE `doc_tipologie_clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_formazione`
--
ALTER TABLE `doc_tipologie_formazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_processi`
--
ALTER TABLE `doc_tipologie_processi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_soggiorni`
--
ALTER TABLE `doc_tipologie_soggiorni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_strutture`
--
ALTER TABLE `doc_tipologie_strutture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_tipologie_verifiche`
--
ALTER TABLE `doc_tipologie_verifiche`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_turni`
--
ALTER TABLE `doc_turni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_unita`
--
ALTER TABLE `doc_unita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipologia` (`tipologia`);

--
-- Indexes for table `doc_unita_centri`
--
ALTER TABLE `doc_unita_centri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_unita_mappa_aree`
--
ALTER TABLE `doc_unita_mappa_aree`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unita_id` (`unita_id`);

--
-- Indexes for table `doc_unita_old`
--
ALTER TABLE `doc_unita_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_verifiche_answers`
--
ALTER TABLE `doc_verifiche_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verificaId` (`verificaId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `doc_verifiche_questions`
--
ALTER TABLE `doc_verifiche_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verificaId` (`tipologiaVerificaId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `doc_verifiche_questions_groups`
--
ALTER TABLE `doc_verifiche_questions_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipologiaVerificaId` (`tipologiaVerificaId`);

--
-- Indexes for table `facolta`
--
ALTER TABLE `facolta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `formazione_corsi_tags`
--
ALTER TABLE `formazione_corsi_tags`
  ADD PRIMARY KEY (`corso_id`,`tag_id`),
  ADD KEY `idx_formazione_corsi_tags_tag` (`tag_id`);

--
-- Indexes for table `fo_preiscrizioni`
--
ALTER TABLE `fo_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_report_id_foreign` (`report_id`),
  ADD KEY `maintenance_user_id_foreign` (`user_id`);

--
-- Indexes for table `maintenance_picture`
--
ALTER TABLE `maintenance_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_picture_maintenance_id_foreign` (`maintenance_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notification_tokens`
--
ALTER TABLE `notification_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notification_tokens_device_token_unique` (`device_token`) USING BTREE,
  ADD UNIQUE KEY `device_id` (`device_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questionario_doc`
--
ALTER TABLE `questionario_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_formazione`
--
ALTER TABLE `questionario_formazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_genitori_junior`
--
ALTER TABLE `questionario_genitori_junior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_genitori_scientifici`
--
ALTER TABLE `questionario_genitori_scientifici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_genitori_senior`
--
ALTER TABLE `questionario_genitori_senior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_genitori_studio`
--
ALTER TABLE `questionario_genitori_studio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_junior`
--
ALTER TABLE `questionario_junior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_keluar`
--
ALTER TABLE `questionario_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_scientifici`
--
ALTER TABLE `questionario_scientifici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_senior`
--
ALTER TABLE `questionario_senior`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_sharing`
--
ALTER TABLE `questionario_sharing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_studio`
--
ALTER TABLE `questionario_studio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionario_torremarina`
--
ALTER TABLE `questionario_torremarina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_client_id` (`client_id`);

--
-- Indexes for table `questionnaire_participants`
--
ALTER TABLE `questionnaire_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_questionnaire_id` (`questionnaire_id`),
  ADD KEY `idx_version_id` (`version_id`);

--
-- Indexes for table `questionnaire_sections`
--
ALTER TABLE `questionnaire_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_version_id` (`version_id`);

--
-- Indexes for table `questionnaire_versions`
--
ALTER TABLE `questionnaire_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_questionnaire_id` (`questionnaire_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_section_id` (`section_id`),
  ADD KEY `fk_questions_condition_question` (`condition_question_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_question_id` (`question_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_structure_area_id_foreign` (`structure_area_id`),
  ADD KEY `reports_category_id_index` (`category_id`);

--
-- Indexes for table `reports_category`
--
ALTER TABLE `reports_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_picture`
--
ALTER TABLE `reports_picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_picture_report_id_foreign` (`report_id`);

--
-- Indexes for table `sel_anno`
--
ALTER TABLE `sel_anno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_competenze`
--
ALTER TABLE `sel_competenze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_diploma`
--
ALTER TABLE `sel_diploma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_lavoro`
--
ALTER TABLE `sel_lavoro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_lingua`
--
ALTER TABLE `sel_lingua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_lingua_livello`
--
ALTER TABLE `sel_lingua_livello`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_sedi`
--
ALTER TABLE `sel_sedi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_stato`
--
ALTER TABLE `sel_stato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_tipo_brevetto`
--
ALTER TABLE `sel_tipo_brevetto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_tipo_indirizzo`
--
ALTER TABLE `sel_tipo_indirizzo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_tipo_permesso`
--
ALTER TABLE `sel_tipo_permesso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_push`
--
ALTER TABLE `send_push`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_push_stats`
--
ALTER TABLE `send_push_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_sms`
--
ALTER TABLE `send_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_sms_stats`
--
ALTER TABLE `send_sms_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sh_preiscrizioni`
--
ALTER TABLE `sh_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siti`
--
ALTER TABLE `siti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_focus`
--
ALTER TABLE `sn_focus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_percorsi`
--
ALTER TABLE `sn_percorsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_preiscrizioni`
--
ALTER TABLE `sn_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sn_ruoli`
--
ALTER TABLE `sn_ruoli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_alloggio`
--
ALTER TABLE `sp_alloggio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici`
--
ALTER TABLE `sp_amici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici_animali`
--
ALTER TABLE `sp_amici_animali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici_eta`
--
ALTER TABLE `sp_amici_eta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici_fumatori`
--
ALTER TABLE `sp_amici_fumatori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici_genere`
--
ALTER TABLE `sp_amici_genere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_amici_occupazione`
--
ALTER TABLE `sp_amici_occupazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_appartamento`
--
ALTER TABLE `sp_appartamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_camera`
--
ALTER TABLE `sp_camera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_coabitazione`
--
ALTER TABLE `sp_coabitazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_conoscenza`
--
ALTER TABLE `sp_conoscenza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_lavoratori`
--
ALTER TABLE `sp_lavoratori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_livello`
--
ALTER TABLE `sp_livello`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_occupazione`
--
ALTER TABLE `sp_occupazione`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_preiscrizioni`
--
ALTER TABLE `sp_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_province`
--
ALTER TABLE `sp_province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_regione` (`regione`);

--
-- Indexes for table `sp_quartiere`
--
ALTER TABLE `sp_quartiere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sp_residenza`
--
ALTER TABLE `sp_residenza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_parents`
--
ALTER TABLE `survey_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_stays`
--
ALTER TABLE `survey_stays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipologia_id` (`tipologia_id`),
  ADD KEY `soggiorno` (`soggiorno`),
  ADD KEY `organizzatore` (`organizzatore`);

--
-- Indexes for table `tim_centri`
--
ALTER TABLE `tim_centri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_fascie`
--
ALTER TABLE `tim_fascie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_funzioni`
--
ALTER TABLE `tim_funzioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_partenze`
--
ALTER TABLE `tim_partenze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_preiscrizioni`
--
ALTER TABLE `tim_preiscrizioni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_sedi`
--
ALTER TABLE `tim_sedi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_societa`
--
ALTER TABLE `tim_societa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_soggiorni`
--
ALTER TABLE `tim_soggiorni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_turni`
--
ALTER TABLE `tim_turni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_sms`
--
ALTER TABLE `tmp_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `un_attivita`
--
ALTER TABLE `un_attivita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `un_questionario`
--
ALTER TABLE `un_questionario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `un_turni`
--
ALTER TABLE `un_turni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utenti_user_type_foreign` (`user_type`);

--
-- Indexes for table `utenti_gruppi`
--
ALTER TABLE `utenti_gruppi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenti_login_access`
--
ALTER TABLE `utenti_login_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `utenti_log_request`
--
ALTER TABLE `utenti_log_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `utenti_old`
--
ALTER TABLE `utenti_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenti_request_reset_password`
--
ALTER TABLE `utenti_request_reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `utenti_ruoli`
--
ALTER TABLE `utenti_ruoli`
  ADD PRIMARY KEY (`userId`,`groupId`),
  ADD KEY `gruppiFk` (`groupId`);

--
-- Indexes for table `utenti_tags`
--
ALTER TABLE `utenti_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_utenti_tags_nome` (`nome`);

--
-- Indexes for table `utenti_tags_assoc`
--
ALTER TABLE `utenti_tags_assoc`
  ADD PRIMARY KEY (`utente_id`,`tag_id`),
  ADD KEY `idx_utenti_tags_assoc_tag` (`tag_id`);

--
-- Indexes for table `utenti_tipi`
--
ALTER TABLE `utenti_tipi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_acqua`
--
ALTER TABLE `utenze_acqua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_chimici`
--
ALTER TABLE `utenze_chimici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_gas`
--
ALTER TABLE `utenze_gas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_luce`
--
ALTER TABLE `utenze_luce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_presenze`
--
ALTER TABLE `utenze_presenze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utenze_rifiuti`
--
ALTER TABLE `utenze_rifiuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visibility_rules`
--
ALTER TABLE `visibility_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_visibility_rules_ruleset` (`ruleset_id`);

--
-- Indexes for table `visibility_rulesets`
--
ALTER TABLE `visibility_rulesets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_visibility_rulesets_target` (`target_type`,`target_id`);

--
-- Indexes for table `_config`
--
ALTER TABLE `_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0_ip`
--
ALTER TABLE `0_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `0_preiscrizioni`
--
ALTER TABLE `0_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ca_preiscrizioni`
--
ALTER TABLE `ca_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cm_preiscrizioni`
--
ALTER TABLE `cm_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comunicazioni`
--
ALTER TABLE `comunicazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comunicazioni_tipologie`
--
ALTER TABLE `comunicazioni_tipologie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_azionicorrettive`
--
ALTER TABLE `db_azionicorrettive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_formazione`
--
ALTER TABLE `db_formazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_nonconforme`
--
ALTER TABLE `db_nonconforme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_reclami`
--
ALTER TABLE `db_reclami`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_reclami_azioni`
--
ALTER TABLE `db_reclami_azioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche`
--
ALTER TABLE `db_verifiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_ambientale`
--
ALTER TABLE `db_verifiche_ambientale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_amministrative`
--
ALTER TABLE `db_verifiche_amministrative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_educative`
--
ALTER TABLE `db_verifiche_educative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_educazione`
--
ALTER TABLE `db_verifiche_educazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_manutenzione`
--
ALTER TABLE `db_verifiche_manutenzione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_ristorazione`
--
ALTER TABLE `db_verifiche_ristorazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_verifiche_sicurezza`
--
ALTER TABLE `db_verifiche_sicurezza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_azione`
--
ALTER TABLE `doc_azione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_camere`
--
ALTER TABLE `doc_camere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_camere_fossata`
--
ALTER TABLE `doc_camere_fossata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_campus`
--
ALTER TABLE `doc_campus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_campus_fossata`
--
ALTER TABLE `doc_campus_fossata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_clienti`
--
ALTER TABLE `doc_clienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_clienti_tipologia_soggiorni`
--
ALTER TABLE `doc_clienti_tipologia_soggiorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_colori`
--
ALTER TABLE `doc_colori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_conoscenza`
--
ALTER TABLE `doc_conoscenza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_qualita`
--
ALTER TABLE `doc_documenti_qualita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_qualita_procedura`
--
ALTER TABLE `doc_documenti_qualita_procedura`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_qualita_unita`
--
ALTER TABLE `doc_documenti_qualita_unita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_soggiorni`
--
ALTER TABLE `doc_documenti_soggiorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_soggiorni_procedura`
--
ALTER TABLE `doc_documenti_soggiorni_procedura`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documenti_soggiorni_unita`
--
ALTER TABLE `doc_documenti_soggiorni_unita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documents`
--
ALTER TABLE `doc_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documents_category`
--
ALTER TABLE `doc_documents_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_documents_procedures`
--
ALTER TABLE `doc_documents_procedures`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_email_queue`
--
ALTER TABLE `doc_email_queue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_categorie`
--
ALTER TABLE `doc_formazione_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_formazioni`
--
ALTER TABLE `doc_formazione_formazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_gruppi`
--
ALTER TABLE `doc_formazione_gruppi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_gruppi_corsi`
--
ALTER TABLE `doc_formazione_gruppi_corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_titolo_corsi`
--
ALTER TABLE `doc_formazione_titolo_corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_utenti_corsi`
--
ALTER TABLE `doc_formazione_utenti_corsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formazione_utenti_gruppi`
--
ALTER TABLE `doc_formazione_utenti_gruppi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formule`
--
ALTER TABLE `doc_formule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_formule_fossata`
--
ALTER TABLE `doc_formule_fossata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_funzione`
--
ALTER TABLE `doc_funzione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_housing`
--
ALTER TABLE `doc_housing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_housing_fossata`
--
ALTER TABLE `doc_housing_fossata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_letture`
--
ALTER TABLE `doc_letture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_matricole`
--
ALTER TABLE `doc_matricole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_nazioni`
--
ALTER TABLE `doc_nazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_occupazioni`
--
ALTER TABLE `doc_occupazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_preiscrizioni`
--
ALTER TABLE `doc_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_reclami_canali`
--
ALTER TABLE `doc_reclami_canali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_reclami_tipologie`
--
ALTER TABLE `doc_reclami_tipologie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_responsabile`
--
ALTER TABLE `doc_responsabile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_rooming`
--
ALTER TABLE `doc_rooming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_segnalato`
--
ALTER TABLE `doc_segnalato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_sms_queue`
--
ALTER TABLE `doc_sms_queue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_societa`
--
ALTER TABLE `doc_societa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_soggiorno`
--
ALTER TABLE `doc_soggiorno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologia_soggiorni`
--
ALTER TABLE `doc_tipologia_soggiorni`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_aperture`
--
ALTER TABLE `doc_tipologie_aperture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_clienti`
--
ALTER TABLE `doc_tipologie_clienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_formazione`
--
ALTER TABLE `doc_tipologie_formazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_processi`
--
ALTER TABLE `doc_tipologie_processi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_soggiorni`
--
ALTER TABLE `doc_tipologie_soggiorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_strutture`
--
ALTER TABLE `doc_tipologie_strutture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_tipologie_verifiche`
--
ALTER TABLE `doc_tipologie_verifiche`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_turni`
--
ALTER TABLE `doc_turni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_unita`
--
ALTER TABLE `doc_unita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_unita_centri`
--
ALTER TABLE `doc_unita_centri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_unita_mappa_aree`
--
ALTER TABLE `doc_unita_mappa_aree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_unita_old`
--
ALTER TABLE `doc_unita_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_verifiche_answers`
--
ALTER TABLE `doc_verifiche_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_verifiche_questions`
--
ALTER TABLE `doc_verifiche_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_verifiche_questions_groups`
--
ALTER TABLE `doc_verifiche_questions_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facolta`
--
ALTER TABLE `facolta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fo_preiscrizioni`
--
ALTER TABLE `fo_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_picture`
--
ALTER TABLE `maintenance_picture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_tokens`
--
ALTER TABLE `notification_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_doc`
--
ALTER TABLE `questionario_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_formazione`
--
ALTER TABLE `questionario_formazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_genitori_junior`
--
ALTER TABLE `questionario_genitori_junior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_genitori_scientifici`
--
ALTER TABLE `questionario_genitori_scientifici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_genitori_senior`
--
ALTER TABLE `questionario_genitori_senior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_genitori_studio`
--
ALTER TABLE `questionario_genitori_studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_junior`
--
ALTER TABLE `questionario_junior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_keluar`
--
ALTER TABLE `questionario_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_scientifici`
--
ALTER TABLE `questionario_scientifici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_senior`
--
ALTER TABLE `questionario_senior`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_sharing`
--
ALTER TABLE `questionario_sharing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_studio`
--
ALTER TABLE `questionario_studio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionario_torremarina`
--
ALTER TABLE `questionario_torremarina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire_participants`
--
ALTER TABLE `questionnaire_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire_sections`
--
ALTER TABLE `questionnaire_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionnaire_versions`
--
ALTER TABLE `questionnaire_versions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports_category`
--
ALTER TABLE `reports_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports_picture`
--
ALTER TABLE `reports_picture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_anno`
--
ALTER TABLE `sel_anno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_competenze`
--
ALTER TABLE `sel_competenze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_diploma`
--
ALTER TABLE `sel_diploma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_lavoro`
--
ALTER TABLE `sel_lavoro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_lingua`
--
ALTER TABLE `sel_lingua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_lingua_livello`
--
ALTER TABLE `sel_lingua_livello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_sedi`
--
ALTER TABLE `sel_sedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_stato`
--
ALTER TABLE `sel_stato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_tipo_brevetto`
--
ALTER TABLE `sel_tipo_brevetto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_tipo_indirizzo`
--
ALTER TABLE `sel_tipo_indirizzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sel_tipo_permesso`
--
ALTER TABLE `sel_tipo_permesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_push`
--
ALTER TABLE `send_push`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_push_stats`
--
ALTER TABLE `send_push_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_sms`
--
ALTER TABLE `send_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `send_sms_stats`
--
ALTER TABLE `send_sms_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sh_preiscrizioni`
--
ALTER TABLE `sh_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siti`
--
ALTER TABLE `siti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sn_focus`
--
ALTER TABLE `sn_focus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sn_percorsi`
--
ALTER TABLE `sn_percorsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sn_preiscrizioni`
--
ALTER TABLE `sn_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sn_ruoli`
--
ALTER TABLE `sn_ruoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_alloggio`
--
ALTER TABLE `sp_alloggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici`
--
ALTER TABLE `sp_amici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici_animali`
--
ALTER TABLE `sp_amici_animali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici_eta`
--
ALTER TABLE `sp_amici_eta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici_fumatori`
--
ALTER TABLE `sp_amici_fumatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici_genere`
--
ALTER TABLE `sp_amici_genere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_amici_occupazione`
--
ALTER TABLE `sp_amici_occupazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_appartamento`
--
ALTER TABLE `sp_appartamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_camera`
--
ALTER TABLE `sp_camera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_coabitazione`
--
ALTER TABLE `sp_coabitazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_conoscenza`
--
ALTER TABLE `sp_conoscenza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_lavoratori`
--
ALTER TABLE `sp_lavoratori`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_livello`
--
ALTER TABLE `sp_livello`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_occupazione`
--
ALTER TABLE `sp_occupazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_preiscrizioni`
--
ALTER TABLE `sp_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_province`
--
ALTER TABLE `sp_province`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_quartiere`
--
ALTER TABLE `sp_quartiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_residenza`
--
ALTER TABLE `sp_residenza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_parents`
--
ALTER TABLE `survey_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_stays`
--
ALTER TABLE `survey_stays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_centri`
--
ALTER TABLE `tim_centri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_fascie`
--
ALTER TABLE `tim_fascie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_funzioni`
--
ALTER TABLE `tim_funzioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_partenze`
--
ALTER TABLE `tim_partenze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_preiscrizioni`
--
ALTER TABLE `tim_preiscrizioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_sedi`
--
ALTER TABLE `tim_sedi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_societa`
--
ALTER TABLE `tim_societa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_soggiorni`
--
ALTER TABLE `tim_soggiorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim_turni`
--
ALTER TABLE `tim_turni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmp_sms`
--
ALTER TABLE `tmp_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `un_attivita`
--
ALTER TABLE `un_attivita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `un_questionario`
--
ALTER TABLE `un_questionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `un_turni`
--
ALTER TABLE `un_turni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `utenti_login_access`
--
ALTER TABLE `utenti_login_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti_log_request`
--
ALTER TABLE `utenti_log_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti_old`
--
ALTER TABLE `utenti_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti_request_reset_password`
--
ALTER TABLE `utenti_request_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti_tags`
--
ALTER TABLE `utenti_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti_tipi`
--
ALTER TABLE `utenti_tipi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `utenze_acqua`
--
ALTER TABLE `utenze_acqua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenze_chimici`
--
ALTER TABLE `utenze_chimici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenze_gas`
--
ALTER TABLE `utenze_gas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenze_luce`
--
ALTER TABLE `utenze_luce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenze_presenze`
--
ALTER TABLE `utenze_presenze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenze_rifiuti`
--
ALTER TABLE `utenze_rifiuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visibility_rules`
--
ALTER TABLE `visibility_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visibility_rulesets`
--
ALTER TABLE `visibility_rulesets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `_config`
--
ALTER TABLE `_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answer_participant` FOREIGN KEY (`participant_id`) REFERENCES `questionnaire_participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answer_question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_questionnaire_version` FOREIGN KEY (`questionnaire_version_id`) REFERENCES `questionnaire_versions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `db_reclami_azioni`
--
ALTER TABLE `db_reclami_azioni`
  ADD CONSTRAINT `fk_reclamo_id` FOREIGN KEY (`id_reclamo`) REFERENCES `db_reclami` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `db_verifiche`
--
ALTER TABLE `db_verifiche`
  ADD CONSTRAINT `FkTipoVerifica` FOREIGN KEY (`tipo_verifica`) REFERENCES `doc_tipologie_verifiche` (`id`);

--
-- Constraints for table `doc_clienti_tipologia_soggiorni`
--
ALTER TABLE `doc_clienti_tipologia_soggiorni`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `doc_clienti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_soggiorno` FOREIGN KEY (`soggiorno_id`) REFERENCES `doc_unita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipologia` FOREIGN KEY (`tipologia_id`) REFERENCES `doc_tipologia_soggiorni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doc_documenti_qualita`
--
ALTER TABLE `doc_documenti_qualita`
  ADD CONSTRAINT `funzione_fk` FOREIGN KEY (`funzione_responsabile_id`) REFERENCES `doc_funzione` (`id`),
  ADD CONSTRAINT `procedura_fk` FOREIGN KEY (`procedura_id`) REFERENCES `doc_documenti_qualita_procedura` (`id`);

--
-- Constraints for table `doc_documenti_qualita_unita`
--
ALTER TABLE `doc_documenti_qualita_unita`
  ADD CONSTRAINT `documenti_fk` FOREIGN KEY (`documenti_id`) REFERENCES `doc_documenti_qualita` (`id`),
  ADD CONSTRAINT `unita_fk` FOREIGN KEY (`unita_id`) REFERENCES `doc_unita` (`id`);

--
-- Constraints for table `doc_documenti_soggiorni`
--
ALTER TABLE `doc_documenti_soggiorni`
  ADD CONSTRAINT `funzioneFk` FOREIGN KEY (`funzione_responsabile_id`) REFERENCES `doc_funzione` (`id`),
  ADD CONSTRAINT `proceduraFk` FOREIGN KEY (`procedura_id`) REFERENCES `doc_documenti_soggiorni_procedura` (`id`);

--
-- Constraints for table `doc_documenti_soggiorni_unita`
--
ALTER TABLE `doc_documenti_soggiorni_unita`
  ADD CONSTRAINT `documentiFk` FOREIGN KEY (`documenti_id`) REFERENCES `doc_documenti_soggiorni` (`id`),
  ADD CONSTRAINT `unitaFk` FOREIGN KEY (`unita_id`) REFERENCES `doc_unita` (`id`);

--
-- Constraints for table `doc_documents`
--
ALTER TABLE `doc_documents`
  ADD CONSTRAINT `doc_documents_ibfk_1` FOREIGN KEY (`procedura_id`) REFERENCES `doc_documents_procedures` (`id`),
  ADD CONSTRAINT `doc_documents_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `doc_documents_category` (`id`);

--
-- Constraints for table `doc_documents_procedures`
--
ALTER TABLE `doc_documents_procedures`
  ADD CONSTRAINT `doc_documents_procedures_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `doc_documents_category` (`id`);

--
-- Constraints for table `doc_unita_mappa_aree`
--
ALTER TABLE `doc_unita_mappa_aree`
  ADD CONSTRAINT `fk_unita_id` FOREIGN KEY (`unita_id`) REFERENCES `doc_unita` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doc_verifiche_answers`
--
ALTER TABLE `doc_verifiche_answers`
  ADD CONSTRAINT `fkQuestionId` FOREIGN KEY (`questionId`) REFERENCES `doc_verifiche_questions` (`id`),
  ADD CONSTRAINT `fkVerificaId` FOREIGN KEY (`verificaId`) REFERENCES `db_verifiche` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doc_verifiche_questions`
--
ALTER TABLE `doc_verifiche_questions`
  ADD CONSTRAINT `fkTipologiaVerificaId` FOREIGN KEY (`tipologiaVerificaId`) REFERENCES `doc_tipologie_verifiche` (`id`),
  ADD CONSTRAINT `groupFk` FOREIGN KEY (`groupId`) REFERENCES `doc_verifiche_questions_groups` (`id`);

--
-- Constraints for table `doc_verifiche_questions_groups`
--
ALTER TABLE `doc_verifiche_questions_groups`
  ADD CONSTRAINT `tipologiaVerificaFk` FOREIGN KEY (`tipologiaVerificaId`) REFERENCES `doc_tipologie_verifiche` (`id`);

--
-- Constraints for table `formazione_corsi_tags`
--
ALTER TABLE `formazione_corsi_tags`
  ADD CONSTRAINT `fk_formazione_corsi_tags_corso` FOREIGN KEY (`corso_id`) REFERENCES `db_formazione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_formazione_corsi_tags_tag` FOREIGN KEY (`tag_id`) REFERENCES `utenti_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `maintenance_picture`
--
ALTER TABLE `maintenance_picture`
  ADD CONSTRAINT `maintenance_picture_maintenance_id_foreign` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD CONSTRAINT `fk_questionnaires_client` FOREIGN KEY (`client_id`) REFERENCES `doc_clienti` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `questionnaire_participants`
--
ALTER TABLE `questionnaire_participants`
  ADD CONSTRAINT `fk_participant_questionnaire` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_participant_version` FOREIGN KEY (`version_id`) REFERENCES `questionnaire_versions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questionnaire_sections`
--
ALTER TABLE `questionnaire_sections`
  ADD CONSTRAINT `fk_sections_version` FOREIGN KEY (`version_id`) REFERENCES `questionnaire_versions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questionnaire_versions`
--
ALTER TABLE `questionnaire_versions`
  ADD CONSTRAINT `fk_versions_questionnaire` FOREIGN KEY (`questionnaire_id`) REFERENCES `questionnaires` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_condition_question` FOREIGN KEY (`condition_question_id`) REFERENCES `questions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_questions_section` FOREIGN KEY (`section_id`) REFERENCES `questionnaire_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `fk_options_question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `reports_category` (`id`),
  ADD CONSTRAINT `reports_structure_area_id_foreign` FOREIGN KEY (`structure_area_id`) REFERENCES `doc_unita_mappa_aree` (`id`),
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports_picture`
--
ALTER TABLE `reports_picture`
  ADD CONSTRAINT `reports_picture_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `survey_stays`
--
ALTER TABLE `survey_stays`
  ADD CONSTRAINT `fk_tipologia_soggiorno` FOREIGN KEY (`tipologia_id`) REFERENCES `doc_tipologia_soggiorni` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_user_type_foreign` FOREIGN KEY (`user_type`) REFERENCES `utenti_tipi` (`id`);

--
-- Constraints for table `utenti_login_access`
--
ALTER TABLE `utenti_login_access`
  ADD CONSTRAINT `utenti_login_fk` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utenti_request_reset_password`
--
ALTER TABLE `utenti_request_reset_password`
  ADD CONSTRAINT `utenti_fk` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `utenti_ruoli`
--
ALTER TABLE `utenti_ruoli`
  ADD CONSTRAINT `gruppiFk` FOREIGN KEY (`groupId`) REFERENCES `utenti_gruppi` (`id`),
  ADD CONSTRAINT `utentiFk` FOREIGN KEY (`userId`) REFERENCES `utenti` (`id`);

--
-- Constraints for table `utenti_tags_assoc`
--
ALTER TABLE `utenti_tags_assoc`
  ADD CONSTRAINT `fk_utenti_tags_assoc_tag` FOREIGN KEY (`tag_id`) REFERENCES `utenti_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utenti_tags_assoc_utente` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visibility_rules`
--
ALTER TABLE `visibility_rules`
  ADD CONSTRAINT `fk_visibility_rules_ruleset` FOREIGN KEY (`ruleset_id`) REFERENCES `visibility_rulesets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
