<?php
session_start();
$lang = $_REQUEST['lang'];

if($lang =='en')
	$_SESSION['lang'] = "it" ;
else
	$_SESSION['lang'] = "en" ;

header("Location: http://qualita.cooperativadoc.it/stessopiano");

?>