<?php
/* @var $this QuestionnaireController */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Documentazione',
);
?>

<div class="page-header">
    <h1><i class="fa fa-book"></i> Documentazione Gestione Questionari</h1>
    <p class="lead">Guida completa per gli operatori del backend</p>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Panoramica del Sistema -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info-circle"></i> Panoramica del Sistema</h3>
            </div>
            <div class="panel-body">
                <p>Il sistema di gestione questionari permette di creare, gestire e analizzare questionari online per raccogliere feedback dai partecipanti. Il sistema è strutturato in modo modulare con versioni multiple per ogni questionario.</p>
            </div>
        </div>

        <!-- Struttura del Sistema -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-sitemap"></i> Struttura del Sistema</h3>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fa fa-file-text"></i> 1. Questionari</h4>
                        <ul>
                            <li><strong>Cos'è:</strong> Il contenitore principale che definisce un questionario</li>
                            <li><strong>Contiene:</strong> Titolo, descrizione, tipo, cliente associato, slug URL</li>
                            <li><strong>Tipi disponibili:</strong>
                                <ul>
                                    <li><strong>SP:</strong> Soggiorno Partecipante (richiede dati anagrafici completi)</li>
                                    <li><strong>SG:</strong> Soggiorno Genitore (richiede email e dati base)</li>
                                    <li><strong>Q:</strong> Questionario generico (richiede email)</li>
                                    <li><strong>A:</strong> Anonimo (nessun dato anagrafico richiesto)</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6">
                        <h4><i class="fa fa-code-fork"></i> 2. Versioni</h4>
                        <ul>
                            <li><strong>Cos'è:</strong> Ogni questionario può avere multiple versioni</li>
                            <li><strong>Funzione:</strong> Permette di modificare il questionario senza perdere le risposte precedenti</li>
                            <li><strong>Stato:</strong> Solo una versione per questionario può essere "attiva" alla volta</li>
                            <li><strong>Protezione:</strong> Le versioni con risposte non possono essere eliminate</li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fa fa-folder"></i> 3. Sezioni</h4>
                        <ul>
                            <li><strong>Cos'è:</strong> Organizza le domande in gruppi logici</li>
                            <li><strong>Funzione:</strong> Raggruppa domande correlate per una migliore esperienza utente</li>
                            <li><strong>Ordine:</strong> Le sezioni vengono mostrate in ordine numerico</li>
                        </ul>
                    </div>
                    
                    <div class="col-md-6">
                        <h4><i class="fa fa-question-circle"></i> 4. Domande</h4>
                        <ul>
                            <li><strong>Tipi disponibili:</strong>
                                <ul>
                                    <li><strong>text:</strong> Campo di testo libero</li>
                                    <li><strong>option:</strong> Scelta singola (radio button)</li>
                                    <li><strong>range:</strong> Scala numerica</li>
                                </ul>
                            </li>
                            <li><strong>Ordine:</strong> Le domande vengono mostrate in ordine numerico all'interno della sezione</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Operazioni Principali -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Operazioni Principali</h3>
            </div>
            <div class="panel-body">
                
                <h4><i class="fa fa-plus-circle"></i> Creazione di un Nuovo Questionario</h4>
                <ol>
                    <li><strong>Accesso:</strong> Menu "Questionari" → "Crea Nuovo Questionario"</li>
                    <li><strong>Compilazione campi:</strong>
                        <ul>
                            <li><strong>Titolo:</strong> Nome del questionario (obbligatorio)</li>
                            <li><strong>Descrizione:</strong> Spiegazione del questionario</li>
                            <li><strong>Tipo:</strong> Selezionare il tipo appropriato (SP, SG, Q, A)</li>
                            <li><strong>Cliente:</strong> Associare a un cliente specifico (opzionale)</li>
                            <li><strong>Slug URL:</strong> Identificativo univoco per l'URL (solo lettere minuscole, numeri e trattini)</li>
                            <li><strong>Pubblico:</strong> Se il questionario è accessibile pubblicamente</li>
                        </ul>
                    </li>
                    <li><strong>Salvataggio:</strong> Crea automaticamente la versione 1</li>
                </ol>

                <hr>

                <h4><i class="fa fa-code-fork"></i> Gestione delle Versioni</h4>
                
                <h5><i class="fa fa-plus"></i> Creare una Nuova Versione</h5>
                <ol>
                    <li>Dalla pagina del questionario, cliccare "Crea Versione"</li>
                    <li>Il sistema assegna automaticamente il numero di versione successivo</li>
                    <li>Aggiungere una descrizione per identificare le modifiche</li>
                </ol>

                <h5><i class="fa fa-check-circle"></i> Attivare una Versione</h5>
                <ol>
                    <li>Dalla lista versioni, cliccare sul badge "Non attiva" accanto alla versione desiderata</li>
                    <li>Confermare l'operazione</li>
                    <li>La versione precedente viene automaticamente disattivata</li>
                </ol>

                <h5><i class="fa fa-copy"></i> Clonare una Versione</h5>
                <ol>
                    <li>Dalla lista versioni, cliccare l'icona "Clona" (copia)</li>
                    <li>Il sistema crea una nuova versione con tutte le sezioni e domande della versione originale</li>
                    <li>Utile per fare modifiche minori mantenendo la struttura esistente</li>
                </ol>

                <hr>

                <h4><i class="fa fa-edit"></i> Gestione delle Sezioni e Domande</h4>
                
                <h5><i class="fa fa-plus"></i> Creare Sezioni e Domande</h5>
                <ol>
                    <li>Dalla pagina della versione, cliccare "Crea Sezioni e Domande"</li>
                    <li>Utilizzare l'interfaccia drag-and-drop per:
                        <ul>
                            <li>Aggiungere nuove sezioni</li>
                            <li>Aggiungere domande alle sezioni</li>
                            <li>Riordinare sezioni e domande</li>
                        </ul>
                    </li>
                    <li>Per ogni domanda specificare:
                        <ul>
                            <li><strong>Testo:</strong> La domanda da mostrare</li>
                            <li><strong>Tipo:</strong> Tipo di risposta richiesta</li>
                            <li><strong>Ordine:</strong> Posizione nella sezione</li>
                        </ul>
                    </li>
                </ol>

                <h5><i class="fa fa-pencil"></i> Modificare Sezioni e Domande</h5>
                <ol>
                    <li>Dalla pagina della versione, cliccare "Modifica Sezioni e Domande"</li>
                    <li><strong>Attenzione:</strong> Le modifiche sono possibili solo se la versione non ha ricevuto risposte</li>
                    <li>Utilizzare l'interfaccia per modificare testo, tipo e ordine</li>
                </ol>
            </div>
        </div>

        <!-- Visualizzazione e Analisi -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-chart-bar"></i> Visualizzazione e Analisi</h3>
            </div>
            <div class="panel-body">
                
                <h4><i class="fa fa-list-alt"></i> Visualizzare le Compilazioni</h4>
                <ol>
                    <li>Menu "Questionari" → "Compilazioni" o dalla pagina del questionario</li>
                    <li><strong>Filtri disponibili:</strong>
                        <ul>
                            <li><strong>Versione:</strong> Filtrare per versione specifica</li>
                            <li><strong>Data da/a:</strong> Filtrare per periodo</li>
                            <li><strong>Indirizzo IP:</strong> Cercare compilazioni da IP specifico</li>
                        </ul>
                    </li>
                    <li><strong>Informazioni mostrate:</strong>
                        <ul>
                            <li>Dati anagrafici del partecipante</li>
                            <li>Versione compilata</li>
                            <li>Data e ora di compilazione</li>
                            <li>Indirizzo IP e browser utilizzato</li>
                        </ul>
                    </li>
                </ol>

                <hr>

                <h4><i class="fa fa-eye"></i> Visualizzare Dettagli Compilazione</h4>
                <ol>
                    <li>Dalla lista compilazioni, cliccare "Visualizza" per una compilazione specifica</li>
                    <li><strong>Informazioni mostrate:</strong>
                        <ul>
                            <li>Tutti i dati del partecipante</li>
                            <li>Tutte le risposte date</li>
                            <li>Timestamp di compilazione</li>
                        </ul>
                    </li>
                </ol>

                <hr>

                <h4><i class="fa fa-download"></i> Esportare i Dati</h4>
                <ol>
                    <li>Dalla pagina compilazioni, utilizzare i filtri desiderati</li>
                    <li>Cliccare "Esporta Excel" o "Esporta CSV"</li>
                    <li><strong>Formato Excel:</strong> File .xlsx con formattazione</li>
                    <li><strong>Formato CSV:</strong> File .csv con separatore punto e virgola</li>
                    <li><strong>Dati esportati:</strong>
                        <ul>
                            <li>Tutti i dati anagrafici</li>
                            <li>Tutte le risposte alle domande</li>
                            <li>Metadati (IP, browser, timestamp)</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>

        <!-- URL Pubblici -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-link"></i> URL Pubblici</h3>
            </div>
            <div class="panel-body">
                
                <h4><i class="fa fa-globe"></i> Accesso ai Questionari</h4>
                <ul>
                    <li><strong>Formato URL:</strong> <code>https://dominio.com/index.php/survey/questionnaire/{slug}</code></li>
                    <li><strong>Esempio:</strong> <code>https://qualita.cooperativadoc.it/index.php/survey/questionnaire/soddisfazione-estiva-2024</code></li>
                    <li><strong>Condizioni di accesso:</strong>
                        <ul>
                            <li>Il questionario deve essere marcato come "Pubblico"</li>
                            <li>Deve esistere una versione attiva</li>
                            <li>Lo slug deve essere valido</li>
                        </ul>
                    </li>
                </ul>

                <hr>

                <h4><i class="fa fa-shield-alt"></i> Sicurezza</h4>
                <ul>
                    <li><strong>reCAPTCHA v3:</strong> Protezione automatica contro bot</li>
                    <li><strong>Validazione lato server:</strong> Tutti i dati vengono validati</li>
                    <li><strong>Logging:</strong> Tutte le compilazioni vengono registrate con IP e browser</li>
                </ul>
            </div>
        </div>

        <!-- Best Practices -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-star"></i> Best Practices</h3>
            </div>
            <div class="panel-body">
                
                <h4><i class="fa fa-plus-circle"></i> Creazione Questionari</h4>
                <ol>
                    <li><strong>Pianificare la struttura:</strong> Definire sezioni logiche prima di iniziare</li>
                    <li><strong>Usare slug descrittivi:</strong> Facilita l'identificazione e la condivisione</li>
                    <li><strong>Testare sempre:</strong> Utilizzare l'anteprima prima di attivare una versione</li>
                    <li><strong>Documentare le modifiche:</strong> Usare descrizioni chiare per le versioni</li>
                </ol>

                <hr>

                <h4><i class="fa fa-code-fork"></i> Gestione Versioni</h4>
                <ol>
                    <li><strong>Non eliminare versioni con risposte:</strong> I dati sono preziosi</li>
                    <li><strong>Clonare invece di ricreare:</strong> Mantiene la struttura esistente</li>
                    <li><strong>Testare prima di attivare:</strong> Verificare che tutto funzioni correttamente</li>
                    <li><strong>Comunicare i cambiamenti:</strong> Informare gli utenti delle nuove versioni</li>
                </ol>

                <hr>

                <h4><i class="fa fa-chart-bar"></i> Analisi Dati</h4>
                <ol>
                    <li><strong>Esportare regolarmente:</strong> Fare backup dei dati importanti</li>
                    <li><strong>Utilizzare i filtri:</strong> Analizzare dati specifici per periodo o versione</li>
                    <li><strong>Verificare la qualità:</strong> Controllare le risposte per identificare problemi</li>
                    <li><strong>Monitorare l'utilizzo:</strong> Tenere traccia del numero di compilazioni</li>
                </ol>
            </div>
        </div>

        <!-- Risoluzione Problemi -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-wrench"></i> Risoluzione Problemi</h3>
            </div>
            <div class="panel-body">
                
                <h4><i class="fa fa-exclamation-triangle"></i> Questionario non Accessibile</h4>
                <ul>
                    <li>Verificare che sia marcato come "Pubblico"</li>
                    <li>Controllare che esista una versione attiva</li>
                    <li>Verificare che lo slug sia corretto nell'URL</li>
                </ul>

                <hr>

                <h4><i class="fa fa-exclamation-circle"></i> Errori di Compilazione</h4>
                <ul>
                    <li>Controllare i log del server per errori tecnici</li>
                    <li>Verificare che tutte le domande obbligatorie siano presenti</li>
                    <li>Controllare la validazione dei campi</li>
                </ul>

                <hr>

                <h4><i class="fa fa-download"></i> Problemi di Esportazione</h4>
                <ul>
                    <li>Verificare che ci siano dati da esportare</li>
                    <li>Controllare i permessi di scrittura per i file temporanei</li>
                    <li>Utilizzare filtri più specifici se il file è troppo grande</li>
                </ul>

                <hr>

                <h4><i class="fa fa-lock"></i> Versioni non Modificabili</h4>
                <ul>
                    <li>Le versioni con risposte non possono essere modificate</li>
                    <li>Creare una nuova versione per fare modifiche</li>
                    <li>Utilizzare la funzione di clonazione per mantenere la struttura</li>
                </ul>
            </div>
        </div>

        <!-- Contatti e Supporto -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-phone"></i> Contatti e Supporto</h3>
            </div>
            <div class="panel-body">
                <p>Per problemi tecnici o domande specifiche:</p>
                <ul>
                    <li>Contattare l'amministratore di sistema</li>
                    <li>Fornire sempre l'ID del questionario e la versione coinvolta</li>
                    <li>Includere screenshot degli errori se disponibili</li>
                </ul>
            </div>
        </div>

        <!-- Pulsanti di Navigazione -->
        <div class="form-group text-center">
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Torna all\'elenco questionari', array('index'), array('class'=>'btn btn-primary btn-lg')); ?>
            <?php echo CHtml::link('<i class="fa fa-plus"></i> Crea Nuovo Questionario', array('create'), array('class'=>'btn btn-success btn-lg')); ?>
        </div>

    </div> <!-- col -->
</div> <!-- row -->

<style>
.panel {
    margin-bottom: 20px;
}
.panel-title {
    font-weight: bold;
}
.panel-body h4 {
    color: #337ab7;
    margin-top: 20px;
    margin-bottom: 15px;
}
.panel-body h5 {
    color: #555;
    margin-top: 15px;
    margin-bottom: 10px;
}
.panel-body ul, .panel-body ol {
    margin-bottom: 15px;
}
.panel-body code {
    background-color: #f5f5f5;
    color: #333;
    padding: 2px 4px;
    border-radius: 3px;
}
.lead {
    color: #666;
    font-size: 16px;
}
</style> 