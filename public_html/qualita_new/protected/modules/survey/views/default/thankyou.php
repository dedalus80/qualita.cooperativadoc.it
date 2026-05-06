<?php
/**
 * Thank you page for questionnaire completion
 * This page is shown after successful submission of any questionnaire
 * La lingua selezionata su fill.php viene mantenuta tramite cookie googtrans.
 */

// Widget Google Translate: stessa config del modulo (fill e thankyou in sync)
$enableGoogleTranslateWidget = Yii::app()->getModule('survey')->enableGoogleTranslateWidget;
$disableGoogleTranslate = !$enableGoogleTranslateWidget || (isset($_GET['lang']) && $_GET['lang'] === 'it');

if ($disableGoogleTranslate) {
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    $domain = preg_replace('/^www\./', '', $host);
    if ($host) {
        setcookie('googtrans', '', time() - 3600, '/');
        setcookie('googtrans', '', time() - 3600, '/', $host);
        setcookie('googtrans', '', time() - 3600, '/', '.' . $host);
        setcookie('googtrans', '', time() - 3600, '/', $domain);
        setcookie('googtrans', '', time() - 3600, '/', '.' . $domain);
    }
}

if ($enableGoogleTranslateWidget && !$disableGoogleTranslate) {
    Yii::app()->clientScript->registerScript('google-translate-init-thankyou', "
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        { pageLanguage: 'it', includedLanguages: 'en,fr,de,es,pt,ro,ar,zh-CN,ru,uk', autoDisplay: false },
        'google_translate_element'
    );
    setTimeout(function() {
        var currentLang = document.cookie.match(/googtrans=\\/it\\/([^;]+)/) ? (document.cookie.match(/googtrans=\\/it\\/([^;]+)/)[1]) : 'it';
        if (typeof updateSelectorLabel === 'function') updateSelectorLabel(currentLang);
    }, 500);
}
function changeLanguage(lang) {
    var select = document.querySelector('#google_translate_element select');
    if (select) { select.value = lang; select.dispatchEvent(new Event('change')); }
}
", CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', CClientScript::POS_END);
}

if ($enableGoogleTranslateWidget) {
    Yii::app()->clientScript->registerScript('google-translate-utils-thankyou', "
function clearAllGoogTransCookies() {
    var d = location.hostname, d2 = d.replace(/^www\\./, '');
    ['', d, '.'+d, d2, '.'+d2].forEach(function(dom) {
        ['/', ''].forEach(function(p) {
            document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=' + (p || '/') + (dom ? '; domain=' + dom : '');
        });
    });
}
var langNames = {'it':'Italiano','en':'English','fr':'Français','de':'Deutsch','es':'Español','pt':'Português','ro':'Română','uk':'Українська','ru':'Русский','ar':'العربية','zh-CN':'中文'};
function updateSelectorLabel(langCode) {
    var el = document.getElementById('current-lang-label');
    if (el && langNames[langCode]) el.textContent = langNames[langCode];
}
function getCurrentLangFromCookie() {
    var m = document.cookie.match(/googtrans=\\/it\\/([^;]+)/);
    return (m && m[1]) ? m[1] : 'it';
}
function restoreLanguage() {
    clearAllGoogTransCookies();
    sessionStorage.removeItem('pendingLang');
    location.href = location.href.split('?')[0].split('#')[0] + '?lang=it';
}
if (typeof changeLanguage === 'undefined') {
    window.changeLanguage = function(lang) {
        clearAllGoogTransCookies();
        sessionStorage.setItem('pendingLang', lang);
        location.href = location.href.split('?')[0].split('#')[0];
    };
}
function toggleLangDropdown(e) { e.stopPropagation(); document.getElementById('lang-dropdown').classList.toggle('show'); }
function selectLanguage(langCode, langName, langFlag) {
    document.getElementById('lang-dropdown').classList.remove('show');
    document.getElementById('current-lang-label').textContent = langName;
    if (langCode === 'it') { restoreLanguage(); return; }
    changeLanguage(langCode);
}
document.addEventListener('click', function(e) {
    var sel = document.querySelector('.custom-language-selector');
    if (sel && !sel.contains(e.target)) document.getElementById('lang-dropdown').classList.remove('show');
});
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.search.indexOf('lang=it') !== -1) { updateSelectorLabel('it'); return; }
    var pending = sessionStorage.getItem('pendingLang');
    updateSelectorLabel(pending || getCurrentLangFromCookie());
});
", CClientScript::POS_END);
}

// Register Google Fonts - Karla
Yii::app()->clientScript->registerLinkTag('preconnect', null, 'https://fonts.googleapis.com');
Yii::app()->clientScript->registerLinkTag('preconnect', null, 'https://fonts.gstatic.com', null, ['crossorigin' => '']);
Yii::app()->clientScript->registerLinkTag('stylesheet', null, 'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

// CSS Google Translate (stesso stile di fill.php)
if ($enableGoogleTranslateWidget) {
    Yii::app()->clientScript->registerCss('google-translate-thankyou', '
.goog-te-banner-frame, #goog-gt-tt, .goog-te-balloon-frame { display: none !important; }
body { top: 0 !important; }
#google_translate_element, .skiptranslate, body > .skiptranslate { display: none !important; height: 0 !important; }
.custom-language-selector { position: relative; display: inline-block; }
.custom-language-selector .lang-btn { background: #fff; border: 1px solid #dee2e6; border-radius: 6px; padding: 8px 14px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 14px; color: #495057; }
.custom-language-selector .lang-btn:hover { border-color: #094f8e; background: #f8f9fa; }
.custom-language-selector .lang-dropdown { position: absolute; top: 100%; right: 0; background: #fff; border: 1px solid #dee2e6; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); min-width: 160px; z-index: 1000; display: none; margin-top: 4px; }
.custom-language-selector .lang-dropdown.show { display: block; }
.custom-language-selector .lang-option { padding: 10px 14px; cursor: pointer; display: flex; align-items: center; gap: 10px; font-size: 14px; color: #495057; }
.custom-language-selector .lang-option:hover { background: #f8f9fa; }
');
}

// Determine logo URL
$logoUrl = null;
$logoAlt = 'Logo';
if (isset($questionnaire) && $questionnaire && !empty($questionnaire->logo)) {
    $logoUrl = Yii::app()->request->baseUrl . '/uploads/questionnaire_logos/' . $questionnaire->logo;
    $logoAlt = $questionnaire->title . ' Logo';
    $emailContact = $questionnaire->email_contact;
} else {
    $logoUrl = Yii::app()->request->baseUrl . "/images/survey/keluar_logo_21.png";
    $logoAlt = 'Keluar Logo';
    $emailContact = 'info@keluar.it';
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if ($enableGoogleTranslateWidget): ?>
            <div class="d-flex justify-content-end mb-2">
                <div id="google_translate_element"></div>
                <div class="custom-language-selector">
                    <button type="button" class="lang-btn" onclick="toggleLangDropdown(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                        <span id="current-lang-label">Italiano</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:12px;height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div class="lang-dropdown" id="lang-dropdown">
                        <div class="lang-option" onclick="selectLanguage('it', 'Italiano', '🇮🇹')"><span class="lang-flag">🇮🇹</span> Italiano</div>
                        <div class="lang-option" onclick="selectLanguage('en', 'English', '🇬🇧')"><span class="lang-flag">🇬🇧</span> English</div>
                        <div class="lang-option" onclick="selectLanguage('fr', 'Français', '🇫🇷')"><span class="lang-flag">🇫🇷</span> Français</div>
                        <div class="lang-option" onclick="selectLanguage('de', 'Deutsch', '🇩🇪')"><span class="lang-flag">🇩🇪</span> Deutsch</div>
                        <div class="lang-option" onclick="selectLanguage('es', 'Español', '🇪🇸')"><span class="lang-flag">🇪🇸</span> Español</div>
                        <div class="lang-option" onclick="selectLanguage('pt', 'Português', '🇵🇹')"><span class="lang-flag">🇵🇹</span> Português</div>
                        <div class="lang-option" onclick="selectLanguage('ro', 'Română', '🇷🇴')"><span class="lang-flag">🇷🇴</span> Română</div>
                        <div class="lang-option" onclick="selectLanguage('uk', 'Українська', '🇺🇦')"><span class="lang-flag">🇺🇦</span> Українська</div>
                        <div class="lang-option" onclick="selectLanguage('ru', 'Русский', '🇷🇺')"><span class="lang-flag">🇷🇺</span> Русский</div>
                        <div class="lang-option" onclick="selectLanguage('ar', 'العربية', '🇸🇦')"><span class="lang-flag">🇸🇦</span> العربية</div>
                        <div class="lang-option" onclick="selectLanguage('zh-CN', '中文', '🇨🇳')"><span class="lang-flag">🇨🇳</span> 中文</div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="text-center mb-5">
                <img class="d-block mx-auto mb-4" src="<?php echo $logoUrl; ?>" alt="<?php echo $logoAlt; ?>" style="max-width: 350px;">
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fa fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="text-center mb-4 text-primary">Grazie per la tua partecipazione!</h2>
                    
                    <div class="text-center mb-4">
                        <p class="lead">
                            Il tuo questionario è stato inviato con successo.
                        </p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="alert alert-info">
                                <h5 class="alert-heading">
                                    <i class="fa fa-info-circle"></i> Perché è importante il tuo feedback
                                </h5>
                                <p class="mb-0">
                                    La tua opinione è fondamentale per migliorare i nostri servizi e garantire 
                                    esperienze sempre più soddisfacenti per tutti i partecipanti.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Per qualsiasi domanda o informazione aggiuntiva, non esitare a contattarci:
                        </p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="mailto:<?php echo $emailContact; ?>" class="btn btn-outline-primary">
                                <i class="fa fa-envelope"></i> <?php echo $emailContact; ?>
                            </a>
                            <a href="tel:+390123456789" class="btn btn-outline-secondary">
                                <i class="fa fa-phone"></i> Chiamaci
                            </a>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="text-muted small">
                            <i class="fa fa-heart text-danger"></i> 
                            Grazie per aver scelto i nostri servizi. Speriamo di rivederti presto!
                        </p>
                        <!--<p class="text-muted small">
                            <strong>Team Keluar</strong>
                        </p>-->
                    </div>
                </div>
            </div>
            
            <!--<div class="text-center mt-4">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="btn btn-link text-decoration-none">
                    <i class="fa fa-home"></i> Torna alla home
                </a>
            </div>-->
        </div>
    </div>
</div>

<style>
/* Font principale - Karla */
body, html {
    font-family: "Karla", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
}

.card {
    border-radius: 15px;
}

.btn {
    border-radius: 25px;
    padding: 10px 20px;
}

.alert {
    border-radius: 10px;
    border: none;
}

.gap-3 {
    gap: 1rem;
}

@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
    
    .btn {
        margin-bottom: 0.5rem;
    }
}
</style> 