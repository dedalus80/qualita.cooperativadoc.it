# AGENTS.md

## Project shape
- This is a legacy PHP/Yii 1.x codebase, not Yii 2; the vendored framework lives in both `yii/` and `public_html/yii/`, and the main app loads `../../yii/framework/yii.php` from `public_html/qualita_new/index.php`.
- `public_html/index.php` 301-redirects to `/qualita_new/`; treat `public_html/qualita_new/` as the primary application unless the task names another site/app.
- Other app/landing-page trees (`sicurezza/`, `sicurezza_new/`, `stessopiano/`, `sharing/`, `formazione/`, etc.) are separate legacy entrypoints; do not assume changes in `qualita_new` affect them.
- The primary app follows Yii 1 conventions: controllers in `protected/controllers`, AR models in `protected/models`, shared services in `protected/components`, views in `protected/views`, migrations in `protected/migrations`, and the survey module in `protected/modules/survey`.

## Primary app wiring
- Web bootstrap: `public_html/qualita_new/index.php` sets `memory_limit=1024M`, session lifetime `7200`, timezone `Europe/Rome`, locale `it_IT`, `YII_DEBUG=true`, then loads `protected/config/main.php`.
- Console bootstrap: run Yii console commands from `public_html/qualita_new/protected/` using `php yiic.php <command>` so relative paths resolve through `protected/yiic.php` and `protected/config/console.php`.
- Web and console use different DB configs: `protected/config/main.php` points at `qualita_1_sito`, while `protected/config/console.php` points at `qualita`; verify DB target before running console jobs or migrations.
- Main config enables path-format URLs and imports `application.models.*`, `application.components.*`, `application.modules.survey.models.*`, `application.helpers.*`, and `ext.YiiMailer.YiiMailer`.
- The custom base controller is `protected/components/Controller.php`; it registers app-wide clientScript packages, redirects guests to `site/login`, logs requests to `UtentiLogRequest`, and provides `authorize()`.
- Permission checks are repo-specific: older controllers often use `Yii::app()->MyUtils->getPermition(...)`; newer code uses `Yii::app()->user->isEnabled()`, `can()`, or `accessController()` from `AppWebUser`.

## Commands and focused checks
- Install/update only the root Composer dependency set from `public_html/`: `composer install` (root `composer.json` currently only requires PHPMailer). Do not run Composer inside vendored plugin/extension directories unless explicitly working on those vendored packages.
- Console command names are lowercased by Yii 1 (`*Command.php` -> command name): from `public_html/qualita_new/protected/`, run `php yiic.php mailqueue` and `php yiic.php smsqueue` for `MailQueueCommand` / `SmsQueueCommand`.
- Migrations are Yii 1 migrations under `public_html/qualita_new/protected/migrations`; run from `public_html/qualita_new/protected/` with `php yiic.php migrate`. Caveat: files named like `m2406xx_*` do not match Yii 1's `mYYMMDD_HHMMSS_*` migration regex and will not be discovered until renamed.
- PHP syntax-check focused edits with `php -l path/to/file.php`; there is no repo-level lint/typecheck script.
- PHPUnit config exists at `public_html/qualita_new/protected/tests/phpunit.xml`, but the functional tests are the default Yii skeleton (`localhost/testdrive/index-test.php`) and `test.php` does not define a separate test DB, so verify before trusting or running them.

## UI and assets
- Backend UI is Avalon/admin theme over Bootstrap 3; preserve Bootstrap 3/Avalon in backend views. The public survey module is an exception and uses Bootstrap 5 layouts.
- Client assets are registered in `protected/config/main.php` and `protected/components/Controller.php`: CDN jQuery 3.7.1, jQuery UI 1.13.2, local `bootstrap-assets/`, plus custom `js/functions.js` and `js/bootstrap3-jquery3-fix.js`.
- Yii generated/runtime/user-uploaded output is intentionally ignored in `public_html/qualita_new/.gitignore` (`assets/`, `protected/runtime/`, `temp/`, upload folders, local config, SQL/dumps/archives). Do not commit regenerated assets, logs, uploads, or dumps.

## Survey/questionnaire specifics
- The `survey` module is enabled in `protected/config/main.php`; public fill URLs are routed as `survey/questionnaire/<slug>` to `survey/questionnaire/fill`.
- Questionnaire admin docs live at `public_html/qualita_new/DOCUMENTAZIONE_GESTIONE_QUESTIONARI.md`, but they lag current code; current models include type `F`, `custom` questions, multiple answers, and conditional question fields.
- For questionnaire versions with responses, code blocks deleting questions but still allows other edits in `QuestionnaireSectionController::actionEditFull`; prefer cloning/creating a new version for content changes to preserve answer integrity.
- Survey result emails/PDFs use the repo’s bundled TCPDF/PHPMailer code in `protected/modules/survey/controllers/QuestionnaireController.php`; the survey README files are useful but partly stale, so trust controller/model code over those docs.
- PDF preview route is module-scoped: `/survey/questionnaire/testPdf/id/{participant_id}`; code currently checks only that the user is authenticated and that the participant/questionnaire exist.

## Existing instructions and cautions
- Preserve `.cursor/rules/projectrules.mdc`: use Yii framework syntax/conventions and Avalon themes with Bootstrap 3 for backend users.
- Credentials are hardcoded in existing config/queue code; avoid copying them into new docs, logs, examples, or commits, and prefer local override files matching `.gitignore` if adding environment-specific config.
- `protected/config/main.php` sets app timezone `Europe/Rome` while DB init SQL sets `time_zone = 'GMT'` and clears `sql_mode`; be careful with date/time and strict-SQL assumptions.
