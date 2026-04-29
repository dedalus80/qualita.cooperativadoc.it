<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'language' => 'it',
    'timeZone' => 'Europe/Rome',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..', 
    'name' => 'Gestione Qualit&agrave;',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.*',
        'application.modules.survey.models.*',
        'application.helpers.*',
        'ext.YiiMailer.YiiMailer',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'docscs',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('151.84.159.239','5.88.24.95', '93.66.125.254'),
            'newFileMode' => 0644,
            'newDirMode' => 0755,
        ),
        'survey' => array(
            'class' => 'application.modules.survey.SurveyModule',
            'enableGoogleTranslateWidget' => true, // true in produzione per abilitare il selettore lingua
        )
    ),
    // application components
    'components' => array(
        'MyUtils' => array(
            'class' => 'MyUtils',
        ),
        'MyStats' => array(
            'class' => 'MyStats',
        ),
        'MyPush' => array(
            'class' => 'MyPush',
        ),
        'MyEmails' => array(
            'class' => 'MyEmails',
        ),
        'MySms' => array(
            'class' => 'MySms',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl'=>array('site/login'),
            'class'=>'AppWebUser',
        ),
        'UUID' => array(
            'class' => 'UUID'
        ),
        // uncomment the following to enable URLs in path-format
        
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>'                   => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'      => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'               => '<controller>/<action>',
                'reports/picture/<dir:rp|mp>/<image:.+>'      => 'reports/picture',
                'reports/picture/delete'                      => 'reports/deletePicture',
                'reports/structure/areas/<id:\d+>'            => 'reports/structureArea',
                'reports/users/<id:\d+>'                      => 'reports/users',
                'reports/reopen/<id:\d+>'                     => 'reports/reopen',
                'reports/unavailable-areas'                   => 'reports/unavailableAreas',
                'documentiQualita/index/<id:\d+>'             => 'documentiQualita/index',
                'documentiQualita/create/<id:\d+>'            => 'documentiQualita/create',
                'documentiSoggiorni/index/<id:\d+>'           => 'documentiSoggiorni/index',
                'documentiSoggiorni/create/<id:\d+>'          => 'documentiSoggiorni/create',
                'document/index/<id:\d+>'                    => 'document/index',
                'document/create/<id:\d+>'                   => 'document/create',
                'verificheQuestions/create/<id:\d+>'          => 'verificheQuestions/create',
                'verificheQuestionsGroups/create/<id:\d+>'    => 'verificheQuestionsGroups/create',
                'azioniVerifiche/index/<id:\d+>'              => 'azioniVerifiche/index',
                //'azioniVerifiche/modello/<id:\d+>'          => 'azioniVerifiche/modello',
                'azioniVerifiche/compila/<id:\d+>'            => 'azioniVerifiche/compila',
                'account/activation/<token:[\w-]+>'           => 'site/activation',
                'account/reset/<token:[\w-]+>'                => 'site/changepassword',
                'survey/satisfaction-parent'                  => 'survey/default/satisfactionParent',
                'survey/satisfaction-parent-success'          => 'survey/default/satisfactionParentSuccess',
                'survey/satisfaction-summer-stays'            => 'survey/default/satisfactionSummerStays',
                'survey/satisfaction-summer-stays-success'    => 'survey/default/satisfactionSummerStaysSuccess',
                'survey-stays/admin/<id:[\d+]+>'              => 'surveyStays/admin',
                'survey-stays/view/<id:[\d+]+>'               => 'surveyStays/view',
                'survey-stays/stats/<id:[\d+]+>'              => 'surveyStays/stats',
                'survey-stays/download/<id:[\d+]+>'           => 'surveyStays/download',
                'survey-stays/stampaGrafici'                  => 'surveyStays/stampaGrafici',
                'survey-stays/export'                         => 'surveyStays/export',
                'survey/questionnaire/<slug:[\w-]+>'          => 'survey/questionnaire/fill',
            ),
        ),
        'db' => array(
            'connectionString'   => 'mysql:host=localhost;dbname=qualita_1_sito',
            'emulatePrepare'     => true,
            'username'           => 'qualita_1_sito',
            'password'           => '^B&FpWPQ7*;TDFm',
            'charset'            => 'utf8',
            'enableParamLogging' => true,
            'enableProfiling'    => true,
            'initSQLs'           => array("SET time_zone = 'GMT';SET SESSION sql_mode = ''"),
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error,warning,info,trace',
                    'categories'=>'system.*',
					//'logFile'=>'sql.log',
                ),           
                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'error,warning',
                    'showInFireBug'=>true
                ),
            ),
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.lib_fpdf.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.extensions.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(20, 20, 20, 20), // margins by default, in order (left, top, right, bottom)
                    )
                )
            ),
        ),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js'=>false,
            ),
            'packages'=>array(
                'jquery'=>array(
                    'baseUrl'=>'//ajax.googleapis.com/ajax/libs/jquery/3.7.1/',
                    'js'=>array('jquery.min.js'),
                ),
                'jquery-ui'=>array(
                    'baseUrl'=>'//code.jquery.com/ui/1.13.2/',
                    'js'=>array('jquery-ui.min.js'),
                    'css'=>array('themes/smoothness/jquery-ui.css'),
                    'depends'=>array('jquery'),
                ),
                'bootstrap'=>array(
                    'baseUrl'=>'bootstrap-assets/',
                    'js'=>array(
                        'js/bootstrap.min.js',
                        'js/enquire.min.js',
                        'js/application.js',
                        'js/ace.min.js',
                        'plugins/bootstrap-datepicker/bootstrap-datepicker.js',
                        'plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
                        'plugins/bootstrap-timepicker/bootstrap-timepicker.js',
                        'plugins/bootstrap-datepicker/bootstrap-datepicker.it.js',
                        'plugins/form-colorpicker/form.colorpicker.js',
                        'plugins/summernote/dist/summernote.js',
                        'plugins/charts-morrisjs/raphael.min.js',
                        'plugins/charts-morrisjs/morris.min.js',
                        'plugins/easypiechart/jquery.easypiechart.js',
                        'plugins/bootstrap-fullcalendar/lib/moment.min.js',
                        'plugins/bootstrap-fullcalendar/fullcalendar.min.js',
                        'plugins/bootstrap-fullcalendar/lang/it.js',
                        'plugins/pines-notify/pnotify.min.js'
                    ),
                    'css'=>array(
                        'css/styles.css',
                        'css/custom-styles.css',
                        'fonts/font-awesome/css/font-awesome.min.css',
                        'plugins/jstree/dist/themes/avalon/style.min.css',
                        'plugins/form-daterangepicker/daterangepicker-bs3.css',
                        'plugins/codeprettifier/prettify.css',
                        'plugins/fullcalendar/fullcalendar.css',
                        'plugins/form-colorpicker/colorpicker.css',
                        'plugins/switchery/switchery.css',
                        'plugins/summernote/dist/summernote.css',
                        'plugins/bootstrap-fullcalendar/fullcalendar.css',
                        'plugins/pines-notify/pnotify.css',
                        'css/bootstrap-datepicker.min.css',
                    ),
                    'depends'=>array('jquery'),
                ),
                'plugin'=>array(
                    'baseUrl'=>'bootstrap-assets/',
                    'js'=>array('plugins/iCheck/icheck.min.js'),
                    'css'=>array(
                        'plugins/iCheck/skins/minimal/blue.css',
                        'plugins/iCheck/skins/minimal/_all.css',
                        'plugins/iCheck/skins/flat/_all.css',
                        'plugins/iCheck/skins/square/_all.css',
                        'plugins/iCheck/skins/all.css',

                    ),
                    'depends'=>array('jquery'),
                ),
                'custom'=>array(
                    'baseUrl'=>'',
                    'js'=>array(
                        'js/functions.js?v=1.2.3.1',
                        'js/bootstrap3-jquery3-fix.js'
                    ),
                    'css'=>array(
                        'css/custom.css',
                        'css/custom_mobile.css',
                    ),
                    'depends'=>array('jquery'),
                ),
                'stylecss'=>array(
                    'baseUrl'=>'https://fonts.googleapis.com/',
                    'css'=>array('css?family=Source+Sans+Pro:300,400,400italic,700'),
                ),
                'cloudflare'=>array(
                    'baseUrl'=>'//cdnjs.cloudflare.com/ajax/libs/',
                    'js'=>array(
                        'canvg/1.4/rgbcolor.min.js',
                        'stackblur-canvas/1.4.1/stackblur.min.js',
                    ),
                    'depends'=>array('jquery'),
                ),
                'jsdelivr'=>array(
                    'baseUrl'=>'//cdn.jsdelivr.net/',
                    'js'=>array(
                        'npm/canvg/dist/browser/canvg.min.js',
                    ),
                    'depends'=>array('jquery'),
                ),
                'highcharts'=>array(
                    'baseUrl'=>'js/highcharts/',
                    'js'=>array(
                        'highcharts.js',
                        'modules/series-label.js',
                        'modules/exporting.js',
                    ),
                ),
                'chart'=>array(
                    'baseUrl'=>'',
                    'js'=>array('js/grafici_percentuale.js'),
                    'depends'=>array('highcharts'),
                )
            )

        )    
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'tech@messageglobe.it',
        'maintenance' => true,
        'SMTP' => [
            'host'=>'smtp.office365.com',
            'port'=>587,
            'secure'=>'tls',
            'auth'=>true,
            'username'=>'gest.qualita@cooperativadoc.it',
            'password'=>'Daq01129'
        ]
    ),
);
