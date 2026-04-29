# Configurazione Invio Email con PDF - Sistema Questionari

## Funzionalità Implementata

Il sistema ora invia automaticamente un'email con un PDF allegato contenente i risultati del questionario compilato quando:

1. Il salvataggio dei dati del questionario va a buon fine
2. Il campo `email_notification` nella tabella `questionnaires` non è vuoto

## Configurazione SMTP

### Configurazione Base (Localhost)
Per un server locale, la configurazione di default dovrebbe funzionare:

```php
$mailer->Host = 'localhost';
$mailer->SMTPAuth = false;
$mailer->Port = 25;
```

### Configurazione Gmail
Per utilizzare Gmail come server SMTP:

```php
$mailer->Host = 'smtp.gmail.com';
$mailer->SMTPAuth = true;
$mailer->Username = 'your_email@gmail.com';
$mailer->Password = 'your_app_password'; // Password per app, non password normale
$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mailer->Port = 587;
```

**Nota per Gmail**: Devi generare una "Password per app" nelle impostazioni di sicurezza di Google.

### Configurazione Altri Provider
Per altri provider SMTP, modifica i parametri nel file:
`protected/modules/survey/controllers/QuestionnaireController.php`

nella funzione `sendQuestionnaireResultsEmail()`.

## Struttura Email

L'email inviata contiene:

- **Oggetto**: "Nuovo questionario compilato: [Titolo Questionario]"
- **Mittente**: noreply@[dominio]
- **Destinatario**: Email specificata nel campo `email_notification` del questionario
- **Allegato**: PDF con tutti i risultati del questionario

### Contenuto Email
- Titolo del questionario
- Data e ora di compilazione
- Dati del partecipante (nome, cognome, email, telefono)
- PDF allegato con tutte le risposte dettagliate

## Struttura PDF

Il PDF generato contiene:

1. **Intestazione**: 
   - Logo del questionario (se configurato) o logo di fallback
   - Titolo del questionario centrato
2. **Dati Partecipante**: 
   - Dati anagrafici: Nome, cognome, età
   - Dati di contatto: Email, telefono
   - Dati del coordinatore: Nome e cognome coordinatore (per questionari SP/SG)
   - Dati del gruppo: Nome gruppo (per questionari SP)
   - Dati del soggiorno: Tipologia (nome), Soggiorno (nome), turno (per questionari SP/SG)
   - Data compilazione
3. **Risposte alle Domande**: Organizzate per sezioni
   - Titolo sezione
   - Domanda
   - Risposta fornita

**Nota**: I dati sensibili come indirizzo IP e user agent non sono inclusi nel PDF per motivi di privacy.

### Logo nel PDF
- Se il questionario ha un logo configurato, viene utilizzato quello
- Se non c'è logo o il file non esiste, viene utilizzato il logo di fallback (`/images/survey/keluar_logo_21.png`)
- Il logo viene posizionato in alto a sinistra con dimensioni proporzionate (max 50mm di larghezza)

## Configurazione Questionario

Per abilitare l'invio email per un questionario:

1. Vai alla gestione questionari
2. Modifica il questionario desiderato
3. Inserisci un indirizzo email nel campo "Email di notifica"
4. Salva il questionario

## Log e Debug

Gli errori di invio email vengono registrati nei log di Yii:
- **Successo**: `Email di notifica inviata con successo a: [email]`
- **Errore**: `Errore durante l'invio dell'email di notifica: [messaggio errore]`

## Dipendenze

Il sistema utilizza:
- **TCPDF**: Per la generazione dei PDF (supporta nativamente UTF-8 e caratteri accentati)
- **PHPMailer**: Per l'invio delle email

Entrambe le librerie sono già incluse nel progetto.

### Supporto Caratteri
- **UTF-8**: TCPDF supporta nativamente i caratteri Unicode
- **Caratteri accentati**: Risolto il problema di visualizzazione di à, è, ò, ù, ecc.
- **Font**: Utilizzato il font Helvetica che supporta i caratteri italiani
- **Email**: Configurato PHPMailer per supportare UTF-8 nell'oggetto e nel corpo email

## Risoluzione Problemi

### Email non inviate
1. Verifica che il campo `email_notification` non sia vuoto
2. Controlla i log per errori SMTP
3. Verifica la configurazione del server SMTP

### PDF non generato
1. Verifica che FPDF sia correttamente installato
2. Controlla i permessi di scrittura per i file temporanei

### Errori SMTP
1. Verifica le credenziali SMTP
2. Controlla che la porta SMTP sia aperta
3. Per Gmail, assicurati di usare una "Password per app" 