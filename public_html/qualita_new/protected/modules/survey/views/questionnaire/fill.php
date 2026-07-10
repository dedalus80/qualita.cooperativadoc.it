<?php
/** @var Questionnaire $questionnaire */
/** @var QuestionnaireVersion $version */
/** @var QuestionnaireParticipant $participant */
/** @var QuestionnaireSection[] $sections */

// Widget Google Translate: abilitato dalla config del modulo (config/main.php -> survey.enableGoogleTranslateWidget)
$enableGoogleTranslateWidget = Yii::app()->getModule('survey')->enableGoogleTranslateWidget;

Yii::app()->clientScript->reset();
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile('https://www.google.com/recaptcha/api.js?render=6LegKYYrAAAAANV_8qfnDL3foGBxHEMMUnqqHEzG', CClientScript::POS_HEAD);

// Controlla se dobbiamo disabilitare Google Translate (parametro lang=it nell URL)
$disableGoogleTranslate = !$enableGoogleTranslateWidget || (isset($_GET['lang']) && $_GET['lang'] === 'it');

// Se lang=it, elimina i cookie di Google Translate lato server in modo aggressivo
if ($disableGoogleTranslate) {
    $host = $_SERVER['HTTP_HOST'];
    $domain = preg_replace('/^www\./', '', $host);
    
    // Elimina su tutti i possibili domini
    setcookie('googtrans', '', time() - 3600, '/');
    setcookie('googtrans', '', time() - 3600, '/', $host);
    setcookie('googtrans', '', time() - 3600, '/', '.' . $host);
    setcookie('googtrans', '', time() - 3600, '/', $domain);
    setcookie('googtrans', '', time() - 3600, '/', '.' . $domain);
}

// Google Translate - carica solo se il widget e abilitato E non siamo in modalita italiano forzato
if ($enableGoogleTranslateWidget && !$disableGoogleTranslate) {
    Yii::app()->clientScript->registerScript('google-translate-init', "
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        {
            pageLanguage: 'it',
            includedLanguages: 'en,fr,de,es,pt,ro,ar,zh-CN,ru,uk',
            autoDisplay: false
        },
        'google_translate_element'
    );
    
    // Dopo init, controlla se c era una lingua pendente da applicare
    setTimeout(function() {
        var pendingLang = sessionStorage.getItem('pendingLang');
        if (pendingLang) {
            sessionStorage.removeItem('pendingLang');
            var select = document.querySelector('#google_translate_element select');
            if (select) {
                select.value = pendingLang;
                select.dispatchEvent(new Event('change'));
                // Aggiorna il label del selettore custom
                updateSelectorLabel(pendingLang);
            }
        } else {
            // Aggiorna il label in base alla lingua corrente di GT
            var currentLang = getCurrentLangFromCookie();
            updateSelectorLabel(currentLang);
        }
    }, 500);
}

// Funzione per cambiare lingua tramite selettore custom
function changeLanguage(lang) {
    var select = document.querySelector('#google_translate_element select');
    if (select) {
        select.value = lang;
        select.dispatchEvent(new Event('change'));
    }
}
", CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', CClientScript::POS_END);
}

// Funzioni per il selettore lingua - solo se il widget e abilitato
if ($enableGoogleTranslateWidget):
Yii::app()->clientScript->registerScript('google-translate-utils', "
function clearAllGoogTransCookies() {
    var dominated = location.hostname;
    var domainWithoutWww = dominated.replace(/^www\\./, '');
    var paths = ['/', ''];
    var domains = ['', dominated, '.' + dominated, domainWithoutWww, '.' + domainWithoutWww];
    
    domains.forEach(function(d) {
        paths.forEach(function(p) {
            var cookieStr = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC';
            if (p) cookieStr += '; path=' + p;
            if (d) cookieStr += '; domain=' + d;
            document.cookie = cookieStr;
        });
    });
}

// Mappa codici lingua -> nomi
var langNames = {
    'it': 'Italiano',
    'en': 'English',
    'fr': 'Français',
    'de': 'Deutsch',
    'es': 'Español',
    'pt': 'Português',
    'ro': 'Română',
    'uk': 'Українська',
    'ru': 'Русский',
    'ar': 'العربية',
    'zh-CN': '中文'
};

// Funzione per aggiornare il label del selettore
function updateSelectorLabel(langCode) {
    var label = document.getElementById('current-lang-label');
    if (label && langNames[langCode]) {
        label.textContent = langNames[langCode];
    }
}

// Funzione per leggere la lingua corrente dal cookie
function getCurrentLangFromCookie() {
    var match = document.cookie.match(/googtrans=\\/it\\/([^;]+)/);
    if (match && match[1]) {
        return match[1];
    }
    return 'it';
}
", CClientScript::POS_END);

// Funzioni per il selettore lingua - sempre disponibili
Yii::app()->clientScript->registerScript('google-translate-ui', "
// Ripristina italiano (rimuove traduzione)
function restoreLanguage() {
    clearAllGoogTransCookies();
    sessionStorage.removeItem('pendingLang');
    sessionStorage.removeItem('pendingLangName');
    
    // Redirect con parametro lang=it per forzare italiano
    var url = location.href.split('?')[0].split('#')[0];
    location.href = url + '?lang=it';
}

// Cambia lingua - fallback se Google Translate non e caricato
if (typeof changeLanguage === 'undefined') {
    window.changeLanguage = function(lang) {
        // Pulisci tutti i vecchi cookie prima
        clearAllGoogTransCookies();
        
        // Salva la lingua da applicare dopo il reload
        sessionStorage.setItem('pendingLang', lang);
        
        // Ricarica senza ?lang=it
        var url = location.href.split('?')[0].split('#')[0];
        location.href = url;
    };
}

// Toggle dropdown lingua
function toggleLangDropdown(e) {
    e.stopPropagation();
    var dropdown = document.getElementById('lang-dropdown');
    dropdown.classList.toggle('show');
}

// Seleziona lingua
function selectLanguage(langCode, langName, langFlag) {
    var dropdown = document.getElementById('lang-dropdown');
    dropdown.classList.remove('show');
    
    // Aggiorna label del bottone
    document.getElementById('current-lang-label').textContent = langName;
    
    if (langCode === 'it') {
        // Ripristina lingua originale
        restoreLanguage();
        return;
    }
    
    // Cambia lingua tramite Google Translate
    changeLanguage(langCode);
}

// Chiudi dropdown cliccando fuori
document.addEventListener('click', function(e) {
    var dropdown = document.getElementById('lang-dropdown');
    var selector = document.querySelector('.custom-language-selector');
    if (dropdown && selector && !selector.contains(e.target)) {
        dropdown.classList.remove('show');
    }
});

// Al caricamento, aggiorna il selettore con la lingua corrente
document.addEventListener('DOMContentLoaded', function() {
    // Se siamo in modalita italiano forzato (?lang=it), mostra Italiano
    if (window.location.search.indexOf('lang=it') !== -1) {
        updateSelectorLabel('it');
        // Pulisci eventuali dati residui
        sessionStorage.removeItem('pendingLang');
        return;
    }
    
    // Controlla se c e una lingua pendente (salvata prima del reload)
    var pendingLang = sessionStorage.getItem('pendingLang');
    if (pendingLang) {
        updateSelectorLabel(pendingLang);
    } else {
        // Altrimenti leggi dal cookie
        var currentLang = getCurrentLangFromCookie();
        updateSelectorLabel(currentLang);
    }
});
", CClientScript::POS_END);
endif; // Fine blocco $enableGoogleTranslateWidget

// Aggiungi Google Fonts - Karla
Yii::app()->clientScript->registerLinkTag('preconnect', null, 'https://fonts.googleapis.com');
Yii::app()->clientScript->registerLinkTag('preconnect', null, 'https://fonts.gstatic.com', null, ['crossorigin' => '']);
Yii::app()->clientScript->registerLinkTag('stylesheet', null, 'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

// CSS per nascondere la sezione dati partecipante per questionari tipo A
$additionalCss = '';
if ($questionnaire->questionnaire_type === 'A') {
    $additionalCss = '
/* Nascondi immediatamente la sezione dati partecipante per questionari tipo A */
#participant-data-section {
    display: none !important;
}';
}



Yii::app()->clientScript->registerCss('custom-styles', '
/* Google Translate - Nasconde top bar e widget originale */
.goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame {
    display: none !important;
}
body {
    top: 0 !important;
}
#google_translate_element {
    display: none !important;
}
.skiptranslate {
    display: none !important;
}
body > .skiptranslate {
    display: none !important;
    height: 0 !important;
}

/* Selettore lingua custom */
.custom-language-selector {
    position: relative;
    display: inline-block;
}
.custom-language-selector .lang-btn {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 8px 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #495057;
    transition: all 0.2s ease;
}
.custom-language-selector .lang-btn:hover {
    border-color: #094f8e;
    background: #f8f9fa;
}
.custom-language-selector .lang-btn svg {
    width: 18px;
    height: 18px;
}
.custom-language-selector .lang-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 160px;
    z-index: 1000;
    display: none;
    margin-top: 4px;
}
.custom-language-selector .lang-dropdown.show {
    display: block;
}
.custom-language-selector .lang-option {
    padding: 10px 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #495057;
    transition: background 0.15s ease;
}
.custom-language-selector .lang-option:hover {
    background: #f8f9fa;
}
.custom-language-selector .lang-option:first-child {
    border-radius: 6px 6px 0 0;
}
.custom-language-selector .lang-option:last-child {
    border-radius: 0 0 6px 6px;
}
.custom-language-selector .lang-flag {
    font-size: 18px;
    line-height: 1;
}

/* Font principale - Karla */
body, html {
    font-family: "Karla", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
}

/* Stili esistenti */
.card-header.section-title {background-color: #094f8e !important; color: #fff !important; }
.question-item { background-color: #f8f9fa; border-color: #dee2e6 !important; }
.question-item:hover { background-color: #e9ecef; }
.option-label { font-weight: 500; color: #495057; }
.form-check-input { transform: scale(1.2); }
.form-check-input:checked { background-color: #094f8e; border-color: #094f8e; }
.question-item .row { margin-left: 0; margin-right: 0; }
.question-item .col { padding-left: 5px; padding-right: 5px; }
.badge-color { background-color: #0fa56f; } 
.btn-submit-color { background-color: #0fa56f; } 
.border-privacy-color { border-color: #0fa56f; border-width: 2px !important; }
.invalid-feedback { color: #0fa56f; }
.form-check-input.is-invalid, .was-validated .form-check-input:invalid {
	border-color: #0fa56f !important;
}
.form-check-input.is-invalid ~ .form-check-label, .was-validated .form-check-input:invalid ~ .form-check-label {
	color: #0fa56f !important;
}
.was-validated .form-control:invalid {
    border-color: #0fa56f !important;
}
.form-select.is-invalid, .was-validated .form-select:invalid {
	border-color: #0fa56f !important;
}
.form-select:focus, .form-control:focus {
    border-color: #0fa56f !important;
    box-shadow: 0 0 0 0.25rem rgba(15, 165, 111, 0.25) !important;
}

/* Remove default alert icon */
.was-validated .form-control:invalid,
.was-validated .form-select:invalid,
.form-control.is-invalid,
.form-select.is-invalid {
    background-image: none !important;
}
' . $additionalCss . '

/* Spaziatura migliorata per display piccoli */
@media (max-width: 768px) {
    .question-item .col-md-4 { 
        padding-bottom: 0.5rem; 
    }
    .question-item .col-md-8 { 
        padding-top: 0.5rem; 
    }
    .option-label { 
        font-size: 0.9rem; 
        display: block; 
    }
    .question-item .col { 
        padding-left: 8px; 
        padding-right: 8px; 
    }
}

@media (max-width: 576px) {
    .question-item .col-md-4 { 
        padding-bottom: 0.75rem; 
    }
    .question-item .col-md-8 { 
        padding-top: 0.75rem; 
    }
    .option-label { 
        font-size: 0.85rem; 
    }
}

/* Stile per la privacy policy */
.card.border-warning {
    border-width: 2px !important;
}
.card.border-warning .card-body {
    padding: 1.25rem;
}
.form-check-input:checked {
    background-color: #094f8e;
    border-color: #094f8e;
}
.form-check-label a {
    color: #094f8e;
    font-weight: 500;
}
.form-check-label a:hover {
    color: #094f8e;
    text-decoration: underline !important;
}

/* Stili per layout orizzontale domande custom con più di 4 opzioni */
.question-item .form-check {
    margin-bottom: 0.5rem;
}
.question-item .form-check-label {
    font-size: 0.9rem;
    line-height: 1.3;
}
.question-item .col-md-6 .form-check {
    padding-left: 1.5rem;
}
');
?>

<div class="py-5 text-left">
    <?php if ($enableGoogleTranslateWidget): ?>
    <div class="d-flex justify-content-end mb-2">
        <!-- Contenitore nascosto per Google Translate -->
        <div id="google_translate_element"></div>
        
        <!-- Selettore lingua custom -->
        <div class="custom-language-selector">
            <button type="button" class="lang-btn" onclick="toggleLangDropdown(event)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                </svg>
                <span id="current-lang-label">Italiano</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:12px;height:12px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <div class="lang-dropdown" id="lang-dropdown">
                <div class="lang-option" onclick="selectLanguage('it', 'Italiano', '🇮🇹')">
                    <span class="lang-flag">🇮🇹</span> Italiano
                </div>
                <div class="lang-option" onclick="selectLanguage('en', 'English', '🇬🇧')">
                    <span class="lang-flag">🇬🇧</span> English
                </div>
                <div class="lang-option" onclick="selectLanguage('fr', 'Français', '🇫🇷')">
                    <span class="lang-flag">🇫🇷</span> Français
                </div>
                <div class="lang-option" onclick="selectLanguage('de', 'Deutsch', '🇩🇪')">
                    <span class="lang-flag">🇩🇪</span> Deutsch
                </div>
                <div class="lang-option" onclick="selectLanguage('es', 'Español', '🇪🇸')">
                    <span class="lang-flag">🇪🇸</span> Español
                </div>
                <div class="lang-option" onclick="selectLanguage('pt', 'Português', '🇵🇹')">
                    <span class="lang-flag">🇵🇹</span> Português
                </div>
                <div class="lang-option" onclick="selectLanguage('ro', 'Română', '🇷🇴')">
                    <span class="lang-flag">🇷🇴</span> Română
                </div>
                <div class="lang-option" onclick="selectLanguage('uk', 'Українська', '🇺🇦')">
                    <span class="lang-flag">🇺🇦</span> Українська
                </div>
                <div class="lang-option" onclick="selectLanguage('ru', 'Русский', '🇷🇺')">
                    <span class="lang-flag">🇷🇺</span> Русский
                </div>
                <div class="lang-option" onclick="selectLanguage('ar', 'العربية', '🇸🇦')">
                    <span class="lang-flag">🇸🇦</span> العربية
                </div>
                <div class="lang-option" onclick="selectLanguage('zh-CN', '中文', '🇨🇳')">
                    <span class="lang-flag">🇨🇳</span> 中文
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <img class="d-block mx-auto mb-4" src="<?php echo CHtml::encode($questionnaire->getLogoUrl()); ?>" alt="Logo" style="max-width: 350px;">
    <h3 class="mt-3"><?php echo CHtml::encode($questionnaire->title); ?></h3>
    <?php if (!empty($questionnaire->description)): ?>
        <p class="lead"><?php echo nl2br(CHtml::encode($questionnaire->description)); ?></p>
    <?php endif; ?>
</div>

<?php echo CHtml::beginForm('', 'post', ['class' => 'needs-validation', 'novalidate' => true]); ?>
<input type="hidden" id="recaptcha_token" name="recaptcha_token" value="">

<div class="row g-3" id="participant-data-section">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header section-title">
                <strong>Dati Partecipante</strong>
            </div>
            <div class="card-body row g-3">
                <?php if ($questionnaire->questionnaire_type === 'F'): ?>
                    <div class="row g-3 mb-2">
                        <div class="col-md-3" data-field="date_course" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'date_course'); ?>
                            <?php echo CHtml::activeDateField($participant, 'date_course', array(
                                'class' => 'form-control',
                                'required' => true,
                            )); ?>
                            <div class="invalid-feedback">La data del corso è obbligatoria.</div>
                        </div>
                        <div class="col-md-3" data-field="type_course_id" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'type_course_id'); ?>
                            <?php echo CHtml::activeDropDownList($participant, 'type_course_id', $courseTypes, array(
                                'empty' => 'Seleziona il tipo di corso',
                                'class' => 'form-select',
                                'required' => true,
                            )); ?>
                            <div class="invalid-feedback">Seleziona il tipo di corso.</div>
                        </div>
                        <div class="col-md-3" data-field="course_category" data-questionnaire-types="F">
                            <?php echo CHtml::label('Categoria', 'course_category'); ?>
                            <?php echo CHtml::dropDownList('course_category', $selectedCourseCategory, $courseCategories, array(
                                'empty' => 'Seleziona la categoria',
                                'class' => 'form-select',
                                'id' => 'course_category',
                                'required' => true,
                            )); ?>
                            <div class="invalid-feedback">Seleziona la categoria del corso.</div>
                        </div>
                        <div class="col-md-3" data-field="title_course_id" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'title_course_id'); ?>
                            <?php echo CHtml::activeDropDownList($participant, 'title_course_id', $courseTitles, array(
                                'empty' => empty($selectedCourseCategory) ? 'Seleziona prima la categoria' : 'Seleziona il titolo del corso',
                                'class' => 'form-select',
                                'required' => true,
                            )); ?>
                            <div class="invalid-feedback">Seleziona il titolo del corso.</div>
                        </div>
                    </div>
                    <div class="row g-3 mb-2">
                        <div class="col-md-4" data-field="name" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'name'); ?>
                            <?php echo CHtml::activeTextField($participant, 'name', array(
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Inserisci il nome',
                            )); ?>
                            <div class="invalid-feedback">Il nome è obbligatorio.</div>
                        </div>
                        <div class="col-md-4" data-field="surname" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'surname'); ?>
                            <?php echo CHtml::activeTextField($participant, 'surname', array(
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Inserisci il cognome',
                            )); ?>
                            <div class="invalid-feedback">Il cognome è obbligatorio.</div>
                        </div>
                        <div class="col-md-4" data-field="affiliated_organisation" data-questionnaire-types="F">
                            <?php echo CHtml::activeLabel($participant, 'affiliated_organisation'); ?>
                            <?php echo CHtml::activeTextField($participant, 'affiliated_organisation', array(
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Ente/organizzazione di appartenenza',
                            )); ?>
                            <div class="invalid-feedback">L&apos;ente/organizzazione è obbligatorio.</div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-4" data-field="name" data-questionnaire-types="SP,SG,Q">
                        <?php echo CHtml::activeLabel($participant, 'name'); ?>
                        <?php echo CHtml::activeTextField($participant, 'name', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Inserisci il nome']); ?>
                        <div class="invalid-feedback">Il nome è obbligatorio.</div>
                    </div>
                    <div class="col-md-4" data-field="surname" data-questionnaire-types="SP,SG,Q">
                        <?php echo CHtml::activeLabel($participant, 'surname'); ?>
                        <?php echo CHtml::activeTextField($participant, 'surname', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Inserisci il cognome']); ?>
                        <div class="invalid-feedback">Il cognome è obbligatorio.</div>
                    </div>
                    <div class="col-md-4" data-field="age" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'age'); ?>
                        <?php echo CHtml::activeDropDownList($participant, 'age', SurveyStays::getParticipantAges(), array('empty' => 'Scegli', 'class' => 'form-select', 'required' => true));?>
                        <div class="invalid-feedback">Seleziona l'età del partecipante.</div>
                    </div>
                    <div class="col-md-4" data-field="coordinator_name" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'coordinator_name'); ?>
                        <?php echo CHtml::activeTextField($participant, 'coordinator_name', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nome del coordinatore']); ?>
                        <div class="invalid-feedback">Il nome del coordinatore è obbligatorio.</div>
                    </div>
                    <div class="col-md-4" data-field="coordinator_surname" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'coordinator_surname'); ?>
                        <?php echo CHtml::activeTextField($participant, 'coordinator_surname', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Cognome del coordinatore']); ?>
                        <div class="invalid-feedback">Il cognome del coordinatore è obbligatorio.</div>
                    </div>
                    <div class="col-md-4" data-field="group_name" data-questionnaire-types="SP">
                        <?php echo CHtml::activeLabel($participant, 'group_name'); ?>
                        <?php echo CHtml::activeTextField($participant, 'group_name', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nome del gruppo']); ?>
                        <div class="invalid-feedback">Il nome del gruppo è obbligatorio.</div>
                    </div>
                    <div class="col-md-4" data-field="tipologia_soggiorno_id" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'tipologia_soggiorno_id'); ?>
                        <?php echo CHtml::activeDropDownList($participant, 'tipologia_soggiorno_id', CHtml::listData($tipologie, 'id', 'tipologia'), array('empty' => 'Scegli', 'class' => 'form-select', 'required' => true));?>
                        <div class="invalid-feedback">Seleziona la tipologia di soggiorno.</div>
                    </div>
                    <div class="col-md-4" data-field="soggiorno_id" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'soggiorno_id'); ?>
                        <?php echo CHtml::activeDropDownList($participant, 'soggiorno_id', [], array('empty' => 'Scegli', 'class' => 'form-select', 'required' => true)); ?>
                        <div class="invalid-feedback">Seleziona il soggiorno.</div>
                    </div>
                    <div class="col-md-4" data-field="turno_id" data-questionnaire-types="SP,SG">
                        <?php echo CHtml::activeLabel($participant, 'turno_id'); ?>
                        <?php echo CHtml::activeDropDownList($participant, 'turno_id', array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), array('empty' => 'Scegli', 'class' => 'form-select', 'required' => true)); ?>
                        <div class="invalid-feedback">Seleziona il turno.</div>
                    </div>
                    <div class="col-md-4" data-field="email" data-questionnaire-types="SG,Q">
                        <?php echo CHtml::activeLabel($participant, 'email'); ?>
                        <?php echo CHtml::activeEmailField($participant, 'email', ['class' => 'form-control', 'required' => true, 'placeholder' => 'esempio@email.com']); ?>
                        <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
                    </div>
                    <div class="col-md-4" data-field="phone" data-questionnaire-types="SG,Q">
                        <?php echo CHtml::activeLabel($participant, 'phone'); ?>
                        <?php echo CHtml::activeTextField($participant, 'phone', ['class' => 'form-control', 'placeholder' => 'Numero di telefono (opzionale)']); ?>
                        <div class="invalid-feedback">Inserisci un numero di telefono valido.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach ($sections as $sectionIndex => $section): ?>
<?php
// Determina se la sezione deve essere nascosta inizialmente
$initiallyHidden = false;
if (!empty($section->condition_field) && !empty($section->condition_operator)) {
    // Per ora nascondiamo tutte le sezioni condizionali, il JavaScript le mostrerà se necessario
    $initiallyHidden = true;
}
?>
<div class="row g-3" data-section-id="<?php echo $section->id; ?>" <?php echo $initiallyHidden ? 'style="display: none;"' : ''; ?>>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header section-title">
                <strong><?php echo CHtml::encode($section->title); ?><?php if ($section->questions[0]->type === 'range') { echo ' - (Scala 1–5: 1 = per niente soddisfatto/a, 5 = molto soddisfatto/a)'; } ?></strong>
            </div>
            <div class="card-body">
                <div class="question-container">
                    <?php foreach (
    $section->questions as $qIndex => $question): ?>
    <?php
    $options = [];
    if ($question->type === 'option') {
        $options = $question->options ? array_map(function($opt) { return $opt->option_text; }, $question->options) : ['POCO', 'ABBASTANZA', 'MOLTO'];
    } elseif ($question->type === 'range') {
        $options = [1, 2, 3, 4, 5];
    } elseif ($question->type === 'custom') {
        $options = $question->options ? array_map(function($opt) { return $opt->option_text; }, $question->options) : [];
    } elseif ($question->type === 'yes_no') {
        $options = ['SI', 'NO'];
    }
    $customTypeRender = $question->type === 'custom' ? $question->getResolvedTypeRender() : null;
    ?>
    <div class="question-item mb-4 p-3 border rounded" 
         <?php if ($question->isConditional()): ?>
         data-conditional="true" 
         data-condition-question="<?php echo $question->condition_question_id; ?>" 
         data-condition-operator="<?php echo CHtml::encode($question->condition_operator); ?>" 
         data-condition-value="<?php echo CHtml::encode($question->condition_value); ?>"
         style="display: none;"
         <?php endif; ?>>
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    <span class="badge rounded-pill badge-color text-white me-2"><?php echo ($qIndex + 1); ?></span>
                    <?php echo CHtml::encode($question->text); ?>
                </div>
            </div>
            <div class="col-md-8">
                <?php if ($question->type === 'text'): ?>
                    <textarea type="text" name="Answer[<?php echo $question->id; ?>]" class="form-control" rows="2" placeholder="Inserisci la tua risposta..." required></textarea>
                    <div class="invalid-feedback text-center">Inserisci una risposta per questa domanda.</div>
                <?php elseif ($question->type === 'yes_no'): ?>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach (array('SI' => 'Sì', 'NO' => 'No') as $yesNoValue => $yesNoLabel): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="Answer[<?php echo $question->id; ?>]" value="<?php echo $yesNoValue; ?>" id="q<?php echo $question->id; ?>_<?php echo $yesNoValue; ?>" required>
                                <label class="form-check-label" for="q<?php echo $question->id; ?>_<?php echo $yesNoValue; ?>">
                                    <?php echo $yesNoLabel; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="invalid-feedback text-center">Seleziona una risposta per questa domanda.</div>
                <?php elseif ($question->type === 'custom'): ?>
                    <?php if (empty($options)): ?>
                        <p class="text-muted mb-0"><em>Nessuna opzione configurata per questa domanda.</em></p>
                    <?php elseif ($customTypeRender === 'select'): ?>
                        <select name="Answer[<?php echo $question->id; ?>]<?php echo $question->is_multiple ? '[]' : ''; ?>"
                                class="form-select answer-select<?php echo $question->is_multiple ? ' multiple-select' : ''; ?>"
                                <?php echo $question->is_multiple ? 'multiple' : ''; ?>
                                required
                                data-question-id="<?php echo $question->id; ?>">
                            <?php if (!$question->is_multiple): ?>
                                <option value="">-- seleziona --</option>
                            <?php endif; ?>
                            <?php foreach ($options as $option): ?>
                                <option value="<?php echo CHtml::encode($option); ?>"><?php echo CHtml::encode($option); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback text-center">
                            <?php echo $question->is_multiple ? 'Seleziona almeno un\'opzione per questa domanda.' : 'Seleziona una risposta per questa domanda.'; ?>
                        </div>
                    <?php elseif ($customTypeRender === 'checkbox'): ?>
                        <div class="row">
                            <?php foreach ($options as $option): ?>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input multiple-checkbox" type="checkbox" name="Answer[<?php echo $question->id; ?>][]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" data-question-id="<?php echo $question->id; ?>">
                                        <label class="form-check-label" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>">
                                            <?php echo CHtml::encode($option); ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="invalid-feedback text-center">Seleziona almeno un'opzione per questa domanda.</div>
                            </div>
                        </div>
                    <?php elseif (count($options) > 4): ?>
                        <div class="row">
                            <?php foreach ($options as $option): ?>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Answer[<?php echo $question->id; ?>]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" required>
                                        <label class="form-check-label" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>">
                                            <?php echo CHtml::encode($option); ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="invalid-feedback text-center">Seleziona una risposta per questa domanda.</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($options as $option): ?>
                                <div class="col text-center">
                                    <div class="form-check d-flex flex-column align-items-center justify-content-center h-100">
                                        <label class="form-check-label mb-2 text-center w-100" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>"><?php echo CHtml::encode($option); ?></label>
                                        <input class="form-check-input" type="radio" name="Answer[<?php echo $question->id; ?>]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" required style="margin-left: 0;">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="invalid-feedback text-center">Seleziona una risposta per questa domanda.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php elseif ($question->is_multiple): ?>
                    <div class="row">
                        <?php foreach ($options as $option): ?>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input multiple-checkbox" type="checkbox" name="Answer[<?php echo $question->id; ?>][]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" data-question-id="<?php echo $question->id; ?>">
                                    <label class="form-check-label" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>">
                                        <?php echo CHtml::encode($option); ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="invalid-feedback text-center">Seleziona almeno un'opzione per questa domanda.</div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if (count($options) > 4): ?>
                        <!-- Layout orizzontale per domande con più di 4 opzioni -->
                        <div class="row">
                            <?php foreach ($options as $option): ?>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Answer[<?php echo $question->id; ?>]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" required>
                                        <label class="form-check-label" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>">
                                            <?php echo CHtml::encode($option); ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <!-- Layout verticale originale per domande con 4 o meno opzioni -->
                        <div class="row">
                            <?php foreach ($options as $option): ?>
                                <div class="col text-center">
                                    <div class="form-check d-flex flex-column align-items-center justify-content-center h-100">
                                        <label class="form-check-label mb-2 text-center w-100" for="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>"><?php echo CHtml::encode($option); ?></label>
                                        <input class="form-check-input" type="radio" name="Answer[<?php echo $question->id; ?>]" value="<?php echo CHtml::encode($option); ?>" id="q<?php echo $question->id; ?>_<?php echo CHtml::encode($option); ?>" required style="margin-left: 0;">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="invalid-feedback text-center">Seleziona una risposta per questa domanda.</div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-privacy-color">
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="privacy_consent" name="privacy_consent" required>
                    <label class="form-check-label" for="privacy_consent">
                        Ho letto e accetto la <a href="<?php echo CHtml::encode($questionnaire->getPrivacyLink()); ?>" target="_blank" class="text-decoration-none">Privacy Policy</a>
                        <span class="text-danger">*</span>
                    </label>
                </div>
                <div class="invalid-feedback">
                    È necessario accettare la Privacy Policy per procedere.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-end mt-3">
    <button type="submit" class="btn btn-submit-color text-white">
        <i class="fa fa-paper-plane"></i> Invia Risposte
    </button>
</div>

<?php echo CHtml::endForm(); ?>

<?php
// Genera le condizioni delle sezioni per il JavaScript
$sectionConditions = [];
foreach ($sections as $section) {
    if (!empty($section->condition_field) && !empty($section->condition_operator)) {
        $sectionConditions[] = [
            'sectionId' => $section->id,
            'field' => $section->condition_field,
            'operator' => $section->condition_operator,
            'value' => $section->condition_value
        ];
    }
}



$jsCode = "


// Definizione delle condizioni delle sezioni
const sectionConditions = " . CJSON::encode($sectionConditions ?: []) . ";

// Tipo di questionario (passato dal PHP)
const questionnaireType = '" . $questionnaire->questionnaire_type . "';
const courseTitlesByCategory = " . CJSON::encode($courseTitlesByCategoryOptions) . ";
const selectedCourseCategory = " . CJSON::encode($selectedCourseCategory) . ";
const selectedCourseTitleId = " . CJSON::encode($participant->title_course_id) . ";

function populateCourseTitles(categoryValue, selectedValue) {
    const titleCourseField = $('#QuestionnaireParticipant_title_course_id');
    if (!titleCourseField.length) {
        return;
    }

    titleCourseField.find('option').remove();

    if (!categoryValue || !courseTitlesByCategory[categoryValue]) {
        titleCourseField.append($('<option></option>').attr('value', '').text('Seleziona prima la categoria'));
        titleCourseField.val('');
        return;
    }

    titleCourseField.append($('<option></option>').attr('value', '').text('Seleziona il titolo del corso'));

    $.each(courseTitlesByCategory[categoryValue], function(index, optionData) {
        titleCourseField.append($('<option></option>').attr('value', optionData.id).text(optionData.nome));
    });

    if (selectedValue && courseTitlesByCategory[categoryValue].some(function(optionData) { return optionData.id == selectedValue; })) {
        titleCourseField.val(selectedValue);
    } else {
        titleCourseField.val('');
    }
}

// Nascondi immediatamente la sezione dati partecipante per questionari tipo A
if (questionnaireType === 'A') {

    if (typeof $ !== 'undefined') {
        $('#participant-data-section').hide();
        $('#participant-data-section :input').prop('disabled', true);
    } else {
        // Fallback se jQuery non è ancora disponibile
        document.addEventListener('DOMContentLoaded', function() {
            const section = document.getElementById('participant-data-section');
            if (section) {
                section.style.display = 'none';
                const inputs = section.querySelectorAll('input, select, textarea');
                inputs.forEach(function(input) {
                    input.disabled = true;
                });
            }
        });
    }
}

// Funzione per aggiornare la visibilità dei campi in base al tipo di questionario
function updateFieldVisibility() {

    
    // Gestione speciale per il tipo A - nasconde completamente la sezione anagrafica
    if (questionnaireType === 'A') {

        $('#participant-data-section').hide();
        $('#participant-data-section :input').prop('disabled', true);
        return;
    } else {
        // Per tutti gli altri tipi, mostra la sezione anagrafica
        $('#participant-data-section').show();
        $('#participant-data-section :input').prop('disabled', false);
    }
    
    // Nascondi tutti i campi inizialmente
    $('[data-field]').hide();
    $('[data-field] :input').prop('disabled', true);
    
    // Mostra solo i campi appropriati per il tipo di questionario
    $('[data-field]').each(function() {
        const fieldElement = $(this);
        const allowedTypes = fieldElement.attr('data-questionnaire-types').split(',');
        
        if (allowedTypes.includes(questionnaireType)) {

            fieldElement.show();
            fieldElement.find(':input').prop('disabled', false);
        } else {

            fieldElement.hide();
            fieldElement.find(':input').prop('disabled', true);
        }
    });
    

}

// Funzione per valutare le condizioni
function evaluateCondition(condition, participantData) {
    if (!condition.field || !condition.operator) {
        return true; // Nessuna condizione, mostra sempre
    }

    const actualValue = participantData[condition.field];
    const expectedValue = condition.value;

    

    // Se il valore attuale è vuoto, non mostrare la sezione (per evitare sezioni vuote)
    if (actualValue === undefined || actualValue === null || actualValue === '') {

        return false;
    }

    let result = false;
    switch (condition.operator) {
        case '=':
            result = actualValue == expectedValue;
            break;
        case '!=':
            result = actualValue != expectedValue;
            break;
        case 'in':
            const expectedValues = expectedValue.split(',');
            result = expectedValues.includes(actualValue.toString());
            break;
        case 'not in':
            const notExpectedValues = expectedValue.split(',');
            result = !notExpectedValues.includes(actualValue.toString());
            break;
        default:
            result = true;
    }

    
    return result;
}

// Funzione per aggiornare la visibilità delle sezioni
function updateSectionVisibility() {
    const participantData = {
        tipologia_id: $('#QuestionnaireParticipant_tipologia_soggiorno_id').val(),
        centro: $('#QuestionnaireParticipant_soggiorno_id').val(),
        eta: $('#QuestionnaireParticipant_age').val(),
        soggiorno: $('#QuestionnaireParticipant_soggiorno_id').val(),
        turno: $('#QuestionnaireParticipant_turno_id').val(),
        anno: new Date().getFullYear().toString()
    };



    sectionConditions.forEach(condition => {

        const sectionElement = $('[data-section-id=\"' + condition.sectionId + '\"]');

        
        if (sectionElement.length) {
            const shouldShow = evaluateCondition(condition, participantData);

            if (shouldShow) {

                sectionElement.slideDown(300).fadeIn(300);
                sectionElement.find(':input').prop('disabled', false).fadeIn(200);
            } else {

                sectionElement.slideUp(300).fadeOut(300);
                sectionElement.find(':input').prop('disabled', true).fadeOut(200);
            }
        } else {
            // Sezione non trovata nel DOM
        }
    });

}

// Funzione getStays (globale)
function getStays(t) {

    
    // Usa il cliente del questionario (passato dal PHP)
    var c = " . ($questionnaire->client_id ? $questionnaire->client_id : 'null') . ";

    // Controlla se il questionario ha un client_id associato
    if (!c || c === '' || c === 'null' || c === '0') {
        console.log('Questionario senza client_id associato - getStays non eseguita');
        return;
    }

    $.post('/qualita_new/index.php/survey/default/stays',{'c':c,'t':t},function(data) {
        $('#QuestionnaireParticipant_soggiorno_id option:gt(0)').remove();
        $('#QuestionnaireParticipant_soggiorno_id').append(data);
    }, 'html');
    
    
    // Dopo aver gestito le sezioni specifiche, aggiorna la visibilità delle sezioni condizionali
    setTimeout(function() {
        updateSectionVisibility();
    }, 50);
}

// Google reCAPTCHA v3
function executeRecaptcha() {
    return new Promise((resolve, reject) => {
        grecaptcha.ready(function() {
            grecaptcha.execute('6LegKYYrAAAAANV_8qfnDL3foGBxHEMMUnqqHEzG', {action: 'questionnaire_submit'})
            .then(function(token) {
                document.getElementById('recaptcha_token').value = token;
                resolve(token);
            })
            .catch(function(error) {
                console.error('reCAPTCHA error:', error);
                reject(error);
            });
        });
    });
}

// Bootstrap 5 form validation con reCAPTCHA
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
            
                
                // Validazione manuale per tutti i campi
                var hasErrors = false;
                
                // Validazione specifica per la privacy policy
                var privacyCheckbox = document.getElementById('privacy_consent');
                if (privacyCheckbox && !privacyCheckbox.checked) {
    
                    privacyCheckbox.setCustomValidity('È necessario accettare la Privacy Policy per procedere.');
                    $(privacyCheckbox).closest('.card-body').find('.invalid-feedback').addClass('d-block');
                    hasErrors = true;
                } else if (privacyCheckbox) {
                    privacyCheckbox.setCustomValidity('');
                    $(privacyCheckbox).closest('.card-body').find('.invalid-feedback').removeClass('d-block');
                }
                
                // Controlla i radio button (una volta per gruppo)
                var radioGroups = {};
                $('input[type=\"radio\"]').each(function() {
                    var name = $(this).attr('name');
                    if (!radioGroups[name]) {
                        var questionItem = $(this).closest('.question-item');
                        var questionSection = questionItem.closest('[data-section-id]');
                        
                        // Salta la validazione se la sezione è nascosta (per tipo A o sezioni condizionali)
                        if (questionSection.length > 0 && !questionSection.is(':visible')) {
            
                            return;
                        }
                        
                        // Salta la validazione se la domanda condizionale è nascosta
                        if (questionItem.attr('data-conditional') === 'true' && !questionItem.is(':visible')) {
            
                            return;
                        }
                        
                        radioGroups[name] = {
                            checked: $('input[name=\"' + name + '\"]:checked').length > 0,
                            errorDiv: questionItem.find('.invalid-feedback')
                        };
                    }
                });
                
                // Valida ogni gruppo di radio button
                Object.keys(radioGroups).forEach(function(name) {
                    var group = radioGroups[name];
                    
                    
                    if (!group.checked) {

                        group.errorDiv.addClass('d-block');
                        hasErrors = true;
                    } else {
                        group.errorDiv.removeClass('d-block');
                    }
                });
                
                // Controlla i checkbox multiple (una volta per gruppo)
                var checkboxGroups = {};
                $('.multiple-checkbox').each(function() {
                    var questionId = $(this).attr('data-question-id');
                    if (!checkboxGroups[questionId]) {
                        var questionItem = $(this).closest('.question-item');
                        var questionSection = questionItem.closest('[data-section-id]');
                        
                        // Salta la validazione se la sezione è nascosta (per tipo A o sezioni condizionali)
                        if (questionSection.length > 0 && !questionSection.is(':visible')) {
            
                            return;
                        }
                        
                        // Salta la validazione se la domanda condizionale è nascosta
                        if (questionItem.attr('data-conditional') === 'true' && !questionItem.is(':visible')) {
            
                            return;
                        }
                        
                        checkboxGroups[questionId] = {
                            checked: $('input[data-question-id=\"' + questionId + '\"]:checked').length > 0,
                            errorDiv: questionItem.find('.invalid-feedback')
                        };
                    }
                });
                
                // Valida ogni gruppo di checkbox multiple
                Object.keys(checkboxGroups).forEach(function(questionId) {
                    var group = checkboxGroups[questionId];
                    
                    
                    if (!group.checked) {

                        group.errorDiv.addClass('d-block');
                        hasErrors = true;
                    } else {
                        group.errorDiv.removeClass('d-block');
                    }
                });
                
                // Controlla le select obbligatorie (solo quelle visibili)
                $('select[required]').each(function() {
                    var selectElement = $(this);
                    var fieldContainer = selectElement.closest('[data-field]');
                    var questionItem = selectElement.closest('.question-item');
                    var questionSection = questionItem.closest('[data-section-id]');

                    if (questionItem.length > 0) {
                        if (questionSection.length > 0 && !questionSection.is(':visible')) {
                            return;
                        }
                        if (questionItem.attr('data-conditional') === 'true' && !questionItem.is(':visible')) {
                            return;
                        }
                    } else if (fieldContainer.length > 0 && !fieldContainer.is(':visible')) {
                        return;
                    }

                    var value = selectElement.val();
                    var errorDiv = selectElement.siblings('.invalid-feedback');
                    var isEmpty = !value || value === '' || (Array.isArray(value) && value.length === 0);

                    if (isEmpty) {
                        errorDiv.addClass('d-block');
                        hasErrors = true;
                    } else {
                        errorDiv.removeClass('d-block');
                    }
                });
                
                // Controlla i campi di testo obbligatori (escludendo radio button, solo quelli visibili)
                $('input[type=\"text\"][required], input[type=\"email\"][required], textarea[required]').each(function() {
                    var textElement = $(this);
                    var fieldContainer = textElement.closest('[data-field]');
                    var questionSection = textElement.closest('[data-section-id]');
                    var questionItem = textElement.closest('.question-item');
                    
                    // Controlla solo se il campo è visibile (non nascosto dal tipo di questionario)
                    if (fieldContainer.length === 0 || fieldContainer.is(':visible')) {
                        // Controlla anche se la sezione della domanda è visibile
                        if (questionSection.length > 0 && !questionSection.is(':visible')) {
    
                            return;
                        }
                        
                        // Controlla anche se la domanda condizionale è nascosta
                        if (questionItem.length > 0 && questionItem.attr('data-conditional') === 'true' && !questionItem.is(':visible')) {
    
                            return;
                        }
                        
                        var value = textElement.val();
                        var errorDiv = textElement.siblings('.invalid-feedback');
                        

                        
                        if (!value || value.trim() === '') {

                            hasErrors = true;
                        }
                    } else {

                    }
                });
                
                // Controlla anche la validazione nativa del form
                if (!form.checkValidity()) {
    
                    hasErrors = true;
                }
                
                if (hasErrors) {
    
                    form.classList.add('was-validated');
                    return;
                }
                

                
                // Se la validazione passa, esegui reCAPTCHA e invia il form
                executeRecaptcha()
                .then(function(token) {
                    
                    form.classList.add('was-validated');
                    form.submit();
                })
                .catch(function(error) {
                    console.error('reCAPTCHA failed:', error);
                    alert('Errore nella verifica di sicurezza. Riprova.');
                });
            }, false);
        });
    }, false);
})();



// Event listeners per i campi che influenzano le condizioni
$(document).ready(function() {

    
    // Verifica se gli elementi esistono
    const tipologiaField = $('#QuestionnaireParticipant_tipologia_soggiorno_id');
    const soggiornoField = $('#QuestionnaireParticipant_soggiorno_id');
    const ageField = $('#QuestionnaireParticipant_age');
    const turnoField = $('#QuestionnaireParticipant_turno_id');
    const courseCategoryField = $('#course_category');
    

    

    
    // Event listeners per nascondere gli errori quando l'utente interagisce
    $('input[type=\"radio\"]').on('change', function() {
        var name = $(this).attr('name');
        var errorDiv = $(this).closest('.question-item').find('.invalid-feedback');
        errorDiv.removeClass('d-block');
    });
    
    $('.multiple-checkbox').on('change', function() {
        var errorDiv = $(this).closest('.question-item').find('.invalid-feedback');
        errorDiv.removeClass('d-block');
    });
    

    
    $('select[required]').on('change', function() {
        var errorDiv = $(this).siblings('.invalid-feedback');
        errorDiv.removeClass('d-block');
    });
    
    $('#privacy_consent').on('change', function() {
        var errorDiv = $(this).closest('.card-body').find('.invalid-feedback');
        errorDiv.removeClass('d-block');
    });
    
    // Event listeners
    tipologiaField.on('change', function() {

        
        // Chiama getStays per aggiornare i soggiorni disponibili solo se il questionario ha un client_id
        var selectedTipologia = $(this).val();
        var clientId = " . ($questionnaire->client_id ? $questionnaire->client_id : 'null') . ";
        
        if (selectedTipologia && clientId && clientId !== '' && clientId !== 'null' && clientId !== '0') {
            getStays(selectedTipologia);
        }
        
        // Aggiorna la visibilità delle sezioni
        updateSectionVisibility();
    });
    
    soggiornoField.on('change', function() {

        updateSectionVisibility();
    });
    
    ageField.on('change', function() {

        updateSectionVisibility();
    });
    
    turnoField.on('change', function() {

        updateSectionVisibility();
    });

    courseCategoryField.on('change', function() {
        populateCourseTitles($(this).val(), '');
    });

    if (questionnaireType === 'F') {
        populateCourseTitles(courseCategoryField.val() || selectedCourseCategory, selectedCourseTitleId);
    }

    // Aggiorna visibilità all'avvio (immediatamente e dopo un breve delay per sicurezza)

    updateFieldVisibility();
    updateSectionVisibility();
    
    // Backup: aggiorna anche dopo un breve delay per assicurarsi che tutto sia caricato
    setTimeout(function() {
    
        updateFieldVisibility();
        updateSectionVisibility();
    }, 100);
    


    // Gestione domande condizionali
    function updateConditionalQuestions() {
    
        
        // Raccogli tutte le risposte attuali
        const answers = {};
        $('input[type=\"radio\"]:checked, textarea[name^=\"Answer[\"], select.answer-select').each(function() {
            const name = $(this).attr('name');
            let value = $(this).val();
            if (name && value) {
                const match = name.match(/Answer\[(\d+)\]/);
                if (match) {
                    if (Array.isArray(value)) {
                        answers[match[1]] = value.join(',');
                    } else {
                        answers[match[1]] = value;
                    }
                }
            }
        });
        
        // Raccogli le risposte multiple dai checkbox
        $('.multiple-checkbox:checked').each(function() {
            const questionId = $(this).attr('data-question-id');
            const value = $(this).val();
            if (questionId && value) {
                // Per le domande multiple, concateniamo i valori selezionati
                if (answers[questionId]) {
                    answers[questionId] += ',' + value;
                } else {
                    answers[questionId] = value;
                }
            }
        });
        

        

        
        // Controlla ogni domanda condizionale
        $('[data-conditional=\"true\"]').each(function() {
            const questionElement = $(this);
            const conditionQuestionId = questionElement.attr('data-condition-question');
            const conditionOperator = questionElement.attr('data-condition-operator');
            const conditionValue = questionElement.attr('data-condition-value');
            

            
            // Verifica se la domanda condizione ha una risposta
            if (!answers[conditionQuestionId]) {
                questionElement.hide();
                questionElement.find('input, textarea, .multiple-checkbox').prop('disabled', true);
                return;
            }
            
            const actualValue = answers[conditionQuestionId];
            let shouldShow = false;
            
            // Valuta la condizione
            switch (conditionOperator) {
                case '=':
                    shouldShow = actualValue == conditionValue;
                    break;
                case '!=':
                    shouldShow = actualValue != conditionValue;
                    break;
                case 'in':
                    const expectedValues = conditionValue.split(',');
                    shouldShow = expectedValues.includes(actualValue);
                    break;
                case 'not in':
                    const notExpectedValues = conditionValue.split(',');
                    shouldShow = !notExpectedValues.includes(actualValue);
                    break;
                default:
                    shouldShow = true;
            }
            

            
            // Mostra/nascondi la domanda condizionale
            if (shouldShow) {
                questionElement.slideDown(300);
                questionElement.find('input, textarea, select, .multiple-checkbox').prop('disabled', false);
            } else {
                questionElement.slideUp(300);
                questionElement.find('input, textarea, select, .multiple-checkbox').prop('disabled', true);
            }
        });
        

    }
    
    // Event listener per i cambiamenti nelle risposte
    $(document).on('change', 'input[type=\"radio\"], textarea[name^=\"Answer[\"], .multiple-checkbox, select.answer-select', function() {
        updateConditionalQuestions();
    });
    
    // Aggiorna le domande condizionali all'avvio
    updateConditionalQuestions();
});
";

Yii::app()->clientScript->registerScript('questionnaire-fill-script', $jsCode, CClientScript::POS_END);
?>
