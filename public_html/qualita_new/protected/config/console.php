<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$config = array(
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
            'connectionString'   => 'mysql:host=localhost;dbname=qualita_1_sito',
            'emulatePrepare'     => true,
            'username'           => 'qualita_1_sito',
            'password'           => '^B&FpWPQ7*;TDFm',
            'charset'            => 'utf8',
            'enableParamLogging' => true,
            'enableProfiling'    => true,
            'initSQLs'           => array("SET time_zone = 'GMT';SET SESSION sql_mode = ''"),
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

$localConfigFile = dirname(__FILE__) . '/console-local.php';
if (is_readable($localConfigFile)) {
	return CMap::mergeArray($config, require($localConfigFile));
}

return $config;