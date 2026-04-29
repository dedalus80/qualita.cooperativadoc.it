<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Console Qualita',

	// preloading 'log' component
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.YiiMailer.YiiMailer',
	),
	// application components
	'components'=>array(
		'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=qualita',
            'emulatePrepare' => true,
            'username' => 'qualita',
            'password' => '00qQUFDTOlKl6O3',
            'charset' => 'utf8',
            'emulatePrepare' => true,
            'enableParamLogging'=>true,
            'enableProfiling'=>true,
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);