# Documentazione Gestione Questionari - Operatori Backend

## Panoramica del Sistema

Il sistema di gestione questionari permette di creare, gestire e analizzare questionari online per raccogliere feedback dai partecipanti. Il sistema è strutturato in modo modulare con versioni multiple per ogni questionario.

## Struttura del Sistema

### 1. Questionari (Questionnaire)
- **Cos'è**: Il contenitore principale che definisce un questionario
- **Contiene**: Titolo, descrizione, tipo, cliente associato, slug URL
- **Tipi disponibili**:
  - **SP**: Soggiorno Partecipante (richiede dati anagrafici completi)
  - **SG**: Soggiorno Genitore (richiede email e dati base)
  - **Q**: Questionario generico (richiede email)
  - **A**: Anonimo (nessun dato anagrafico richiesto)

### 2. Versioni (QuestionnaireVersion)
- **Cos'è**: Ogni questionario può avere multiple versioni
- **Funzione**: Permette di modificare il questionario senza perdere le risposte precedenti
- **Stato**: Solo una versione per questionario può essere "attiva" alla volta
- **Protezione**: Le versioni con risposte non possono essere eliminate

### 3. Sezioni (QuestionnaireSection)
- **Cos'è**: Organizza le domande in gruppi logici
- **Funzione**: Raggruppa domande correlate per una migliore esperienza utente
- **Ordine**: Le sezioni vengono mostrate in ordine numerico

### 4. Domande (Question)
- **Tipi disponibili**:
  - **text**: Campo di testo libero
  - **option**: Scelta singola (radio button)
  - **range**: Scala numerica
- **Ordine**: Le domande vengono mostrate in ordine numerico all'interno della sezione

## Operazioni Principali

### Creazione di un Nuovo Questionario

1. **Accesso**: Menu "Questionari" → "Crea Nuovo Questionario"
2. **Compilazione campi**:
   - **Titolo**: Nome del questionario (obbligatorio)
   - **Descrizione**: Spiegazione del questionario
   - **Tipo**: Selezionare il tipo appropriato (SP, SG, Q, A)
   - **Cliente**: Associare a un cliente specifico (opzionale)
   - **Slug URL**: Identificativo univoco per l'URL (solo lettere minuscole, numeri e trattini)
   - **Pubblico**: Se il questionario è accessibile pubblicamente
3. **Salvataggio**: Crea automaticamente la versione 1

### Gestione delle Versioni

#### Creare una Nuova Versione
1. Dalla pagina del questionario, cliccare "Crea Versione"
2. Il sistema assegna automaticamente il numero di versione successivo
3. Aggiungere una descrizione per identificare le modifiche

#### Attivare una Versione
1. Dalla lista versioni, cliccare sul badge "Non attiva" accanto alla versione desiderata
2. Confermare l'operazione
3. La versione precedente viene automaticamente disattivata

#### Clonare una Versione
1. Dalla lista versioni, cliccare l'icona "Clona" (copia)
2. Il sistema crea una nuova versione con tutte le sezioni e domande della versione originale
3. Utile per fare modifiche minori mantenendo la struttura esistente

### Gestione delle Sezioni e Domande

#### Creare Sezioni e Domande
1. Dalla pagina della versione, cliccare "Crea Sezioni e Domande"
2. Utilizzare l'interfaccia drag-and-drop per:
   - Aggiungere nuove sezioni
   - Aggiungere domande alle sezioni
   - Riordinare sezioni e domande
3. Per ogni domanda specificare:
   - **Testo**: La domanda da mostrare
   - **Tipo**: Tipo di risposta richiesta
   - **Ordine**: Posizione nella sezione

#### Modificare Sezioni e Domande
1. Dalla pagina della versione, cliccare "Modifica Sezioni e Domande"
2. **Attenzione**: Le modifiche sono possibili solo se la versione non ha ricevuto risposte
3. Utilizzare l'interfaccia per modificare testo, tipo e ordine

### Visualizzazione e Analisi

#### Visualizzare le Compilazioni
1. Menu "Questionari" → "Compilazioni" o dalla pagina del questionario
2. **Filtri disponibili**:
   - **Versione**: Filtrare per versione specifica
   - **Data da/a**: Filtrare per periodo
   - **Indirizzo IP**: Cercare compilazioni da IP specifico
3. **Informazioni mostrate**:
   - Dati anagrafici del partecipante
   - Versione compilata
   - Data e ora di compilazione
   - Indirizzo IP e browser utilizzato

#### Visualizzare Dettagli Compilazione
1. Dalla lista compilazioni, cliccare "Visualizza" per una compilazione specifica
2. **Informazioni mostrate**:
   - Tutti i dati del partecipante
   - Tutte le risposte date
   - Timestamp di compilazione

#### Esportare i Dati
1. Dalla pagina compilazioni, utilizzare i filtri desiderati
2. Cliccare "Esporta Excel" o "Esporta CSV"
3. **Formato Excel**: File .xlsx con formattazione
4. **Formato CSV**: File .csv con separatore punto e virgola
5. **Dati esportati**:
   - Tutti i dati anagrafici
   - Tutte le risposte alle domande
   - Metadati (IP, browser, timestamp)

## URL Pubblici

### Accesso ai Questionari
- **Formato URL**: `https://dominio.com/index.php/survey/questionnaire/{slug}`
- **Esempio**: `https://qualita.cooperativadoc.it/index.php/survey/questionnaire/soddisfazione-estiva-2024`
- **Condizioni di accesso**:
  - Il questionario deve essere marcato come "Pubblico"
  - Deve esistere una versione attiva
  - Lo slug deve essere valido

### Sicurezza
- **reCAPTCHA v3**: Protezione automatica contro bot
- **Validazione lato server**: Tutti i dati vengono validati
- **Logging**: Tutte le compilazioni vengono registrate con IP e browser

## Best Practices

### Creazione Questionari
1. **Pianificare la struttura**: Definire sezioni logiche prima di iniziare
2. **Usare slug descrittivi**: Facilita l'identificazione e la condivisione
3. **Testare sempre**: Utilizzare l'anteprima prima di attivare una versione
4. **Documentare le modifiche**: Usare descrizioni chiare per le versioni

### Gestione Versioni
1. **Non eliminare versioni con risposte**: I dati sono preziosi
2. **Clonare invece di ricreare**: Mantiene la struttura esistente
3. **Testare prima di attivare**: Verificare che tutto funzioni correttamente
4. **Comunicare i cambiamenti**: Informare gli utenti delle nuove versioni

### Analisi Dati
1. **Esportare regolarmente**: Fare backup dei dati importanti
2. **Utilizzare i filtri**: Analizzare dati specifici per periodo o versione
3. **Verificare la qualità**: Controllare le risposte per identificare problemi
4. **Monitorare l'utilizzo**: Tenere traccia del numero di compilazioni

## Risoluzione Problemi

### Questionario non Accessibile
- Verificare che sia marcato come "Pubblico"
- Controllare che esista una versione attiva
- Verificare che lo slug sia corretto nell'URL

### Errori di Compilazione
- Controllare i log del server per errori tecnici
- Verificare che tutte le domande obbligatorie siano presenti
- Controllare la validazione dei campi

### Problemi di Esportazione
- Verificare che ci siano dati da esportare
- Controllare i permessi di scrittura per i file temporanei
- Utilizzare filtri più specifici se il file è troppo grande

### Versioni non Modificabili
- Le versioni con risposte non possono essere modificate
- Creare una nuova versione per fare modifiche
- Utilizzare la funzione di clonazione per mantenere la struttura

## Contatti e Supporto

Per problemi tecnici o domande specifiche:
- Contattare l'amministratore di sistema
- Fornire sempre l'ID del questionario e la versione coinvolta
- Includere screenshot degli errori se disponibili

---

*Documentazione aggiornata al: <?php echo date('d/m/Y'); ?>* 