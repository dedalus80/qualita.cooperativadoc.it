<?php
$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array(
    html_entity_decode("Gestionale Qualità", ENT_QUOTES, 'UTF-8'),
);

$baseUrl = Yii::app()->request->baseUrl;
//$documentiQualitaUrl = Yii::app()->user->getState('group') == 'ADMIN' ? $baseUrl . '/index.php/documentiQualitaProcedure/admin' : $baseUrl . '/index.php/documentiQualita/index';
$quickLinks = array(
    array(
        'label' => 'Apri Non Conformità',
        'description' => 'Registra subito una nuova non conformità rilevata nel servizio.',
        'url' => $baseUrl . '/index.php/dbNonconforme/create',
        'icon' => 'fa fa-thumbs-o-down',
        'class' => 'home-action-blue',
    ),
    array(
        'label' => 'Apri reclamo',
        'description' => 'Inserisci un nuovo reclamo e avvia il percorso di gestione.',
        'url' => $baseUrl . '/index.php/dbReclami/create',
        'icon' => 'fa fa-bullhorn',
        'class' => 'home-action-orange',
    ),
    array(
        'label' => 'Elenco verifiche',
        'description' => 'Consulta rapidamente verifiche, scadenze e attività di controllo.',
        'url' => $baseUrl . '/index.php/azioniVerifiche/index',
        'icon' => 'fa fa-check',
        'class' => 'home-action-green',
    ),
    array(
        'label' => 'Elenco documenti',
        'description' => 'Accedi a tutti i documenti qualità disponibili.',
        'url' => $baseUrl . '/index.php/documentiQualita/index',
        'icon' => 'fa fa-file-o',
        'class' => 'home-action-blue',
    ),
);
?>
<div class="row" id="home-text">
    <div class="col-xs-12">
        <div class="home-hero">
            <h1>Gestionale Qualità</h1>
            <p>Accesso rapido alle azioni principali della piattaforma.</p>
        </div>

        <div class="row home-actions">
            <?php foreach ($quickLinks as $quickLink): ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <a class="home-action-card <?php echo $quickLink['class']; ?>" href="<?php echo CHtml::encode($quickLink['url']); ?>">
                        <span class="home-action-icon"><i class="<?php echo CHtml::encode($quickLink['icon']); ?>"></i></span>
                        <span class="home-action-title"><?php echo CHtml::encode($quickLink['label']); ?></span>
                        <span class="home-action-description"><?php echo CHtml::encode($quickLink['description']); ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!--
        <div class="home-content-card">
        <p>
La presente piattaforma di gestione ha l'obiettivo di mantenere traccia e memoria dei processi interni di gestione dei progetti Scuola Natura ed Estate Vacanza al fine di garantire un'alta qualit&agrave; del servizio offerto dalla Cooperativa.
</p>
<p>
La piattaforma &egrave; stata realizzata in base ai requisiti delle norme UNI EN ISO 9001 - sistemi per la qualit&agrave; - e UNI EN ISO 14001 - sistemi di gestione ambientale -; norme per le quali la cooperativa ha certificato il proprio sistema di gestione.
</p>
<p>
La piattaforma si articola in diverse sezioni come di seguito specificato:
</p>
<ul>
<li>La sezione di gestione delle <span class="bhome"><a href='./index.php/dbNonconforme/admin'>NON CONFORMIT&Agrave;</a></span> ha come obiettivo rendere evidenti eventuali rilievi del servizio nei diversi ambiti in cui &egrave; composto.</li>
<li>La sezione di gestione delle <span class="bhome"><a href='./index.php/dbAzionicorrettive/admin'>AZIONI CORRETTIVE</a></span>  registra quelle azioni che il personale presso la Casa Vacanza o la Direzione della Societ&agrave; intendono mettere in atto al fine di risolvere eventuali situazioni non conformi all'interno dei servizi affidati.</li>
<li>La sezione di gestione dei  <span class="bhome"><a href='./index.php/dbReclami/admin'>RECLAMI</a></span> recepisce invece le indicazioni ed eventualmente i rilievi che gli utilizzatori finali e loro genitori e i Clienti Committenti manifestano e la cui risoluzione &egrave; prioritaria per la nostra organizzazione. </li>
<li>La sezione <span class="bhome"><a href='./index.php/azioniVerifiche/admin'>VERIFICHE ISPETTIVE INTERNE,</a></span> compilabili sia come autovalutazione dai responsabili e coordinatori del servizio che di valutazione da parte di auditor interni &egrave; un utile strumento di mantenimento della qualit&agrave; offerta contenendo tutti gli indicatori necessari da monitorare per un'erogazione del servizio conforme agli standard stabiliti dal gruppo di direzione della societ&agrave;.</li>
<li>La sezione <span class="bhome"><a href='./index.php/Matricole/admin'>AMBIENTE</a></span> contiene i diversi pannelli di controllo che sono compilati dai responsabili dei diversi servizi al fine di produrre i necessari indicatori ambientali stabiliti dalla norma UNI EN ISO 14001 per stabilire gli obiettivi di performance che caratterizzano la nostra gestione. </li>
</ul>
<p>
L'impegno che chiediamo a tutti i soci della nostra cooperativa &egrave; di implementare ed utilizzare questa piattaforma quotidianamente, evidenziando quando necessario quelle situazioni da migliorare o migliorabili al fine di poter mantenere uno standard di servizio di alto livello ed adeguato agli impegni progettuali e gli ingaggi di responsabilit&agrave; diversificati per ruolo e mansione. 
</p>
<p>
Inoltre per poter facilitare l'accesso all'utilizzo abbiamo istituito una nuova sezione TUTORIAL che mostra le modalit&agrave; corrette di implementazione del servizio che speriamo sia utile per una migliore comprensione delle attivit&agrave; connesse all'utilizzo della piattaforma e che completano l'offerta formativa che la Cooperativa mette in atto per una sempre pi&ugrave; ampia consapevolezza del sistema di gestione. 
</p>
<p style="margin-top: 30px;">
A tutti i nostri migliori auguri di buon lavoro
</p>
<p>
Il CdA di D.O.C. s.c.s.
</p>
        </div>
        -->
    </div>
</div>
