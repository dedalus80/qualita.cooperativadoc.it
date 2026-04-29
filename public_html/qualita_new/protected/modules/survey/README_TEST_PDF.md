# Action di Test PDF per Questionari

## Descrizione

L'action `actionTestPdf` permette di visualizzare on-the-fly il PDF generato per un questionario compilato, utile per testare e verificare la formattazione di diverse tipologie di questionario.

## URL di Accesso

```
/questionnaire/testPdf/id/{participant_id}
```

Dove `{participant_id}` è l'ID del partecipante/questionario compilato.

## Esempi di URL

```
/questionnaire/testPdf/id/123
/questionnaire/testPdf/id/456
```

## Requisiti di Accesso

- **Autenticazione**: L'utente deve essere loggato
- **Permessi**: Richiesti permessi di amministratore (`admin`)
- **ID Valido**: Il `participant_id` deve esistere nel database

## Funzionalità

### 1. **Verifica Sicurezza**
- Controlla che l'utente sia autenticato
- Verifica i permessi di amministratore
- Valida l'esistenza del questionario compilato

### 2. **Caricamento Dati**
- Carica il partecipante/questionario compilato
- Recupera il questionario associato
- Carica tutte le sezioni e domande
- Genera il PDF con la stessa logica dell'email

### 3. **Output PDF**
- Visualizza il PDF direttamente nel browser
- Header appropriati per la visualizzazione inline
- Nome file: `test_questionario_{id}.pdf`

## Utilizzo per Testing

### Testare Diverse Tipologie

1. **Questionari SP (Soggiorni)**:
   - Verifica dati coordinatore
   - Controlla dati gruppo
   - Testa tipologia e soggiorno

2. **Questionari SG (Soggiorni Generici)**:
   - Verifica dati coordinatore
   - Controlla tipologia soggiorno

3. **Questionari Standard**:
   - Verifica dati anagrafici base
   - Controlla formattazione generale

### Testare Formattazione

1. **Logo e Titolo**:
   - Verifica posizionamento centrato
   - Controlla spaziature
   - Testa con/senza logo

2. **Dati Partecipante**:
   - Verifica tutti i campi disponibili
   - Controlla formattazione nomi (tipologia/soggiorno)
   - Testa campi vuoti

3. **Risposte**:
   - Verifica layout domande
   - Controlla formattazione risposte
   - Testa domande con molte opzioni

## Gestione Errori

### Errori Comuni

1. **404 - Questionario non trovato**:
   - L'ID del partecipante non esiste
   - Verificare l'ID nel database

2. **403 - Accesso negato**:
   - Utente non autenticato
   - Mancanza permessi amministratore

3. **Errore PDF**:
   - Problemi con TCPDF
   - File logo mancanti

## Esempio di Utilizzo

```php
// URL per testare il questionario compilato con ID 123
http://tuodominio.com/questionnaire/testPdf/id/123
```

## Note Tecniche

- **Performance**: Il PDF viene generato on-the-fly
- **Cache**: Headers impostati per evitare cache
- **Sicurezza**: Accesso limitato agli amministratori
- **Compatibilità**: Funziona con tutti i browser moderni

## Troubleshooting

### PDF non si visualizza
1. Verificare permessi utente
2. Controllare che l'ID esista
3. Verificare log errori PHP

### Formattazione errata
1. Controllare dimensioni logo
2. Verificare caratteri speciali
3. Testare con diversi tipi di questionario

### Errori di caricamento
1. Verificare dipendenze TCPDF
2. Controllare file logo
3. Verificare configurazione SMTP (per email) 