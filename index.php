<?php
session_start();
/*CONFIGURATION*/
$error = array();
$error_code = array();
$error_fatal = false;
define('ROOTPATH', dirname(__FILE__));

$f = file_exists('config.php');
if ( $f ){
	require('config.php');
}else{
	array_push($error,"File Not Exists - config.php");
	$error_fatal = true;
}

if (!$error_fatal){
	if (DB_SOURCE){
		if ( file_exists(DB_FILE) ){
			require(DB_FILE);
			$sql = new db();
			$sql->sql_open();
		}else{
			array_push($error,"File Not Exists - ".DB_FILE);
			$error_fatal = true;
		}
	}
}

$f = file_exists(MODEL_PATH.'\\ds-model\\languaje-en.php');
if ( $f && !$error_fatal ){
	require(MODEL_PATH.'\\ds-model\\languaje-en.php');
}elseif( !$f && !$error_fatal ){
	array_push($error,'File Not Exists '.MODEL_PATH.'\\ds-model\\languaje-en.php');
	$error_fatal = true;
}

$f = file_exists(CONTROLLER_PATH.'\\ds-controller\\functions.php');
if ( $f && !$error_fatal ){
	include(CONTROLLER_PATH.'\\ds-controller\\functions.php');
}elseif( !$f && !$error_fatal ){
	array_push($error,'File Not Exists '.CONTROLLER_PATH.'\\ds-controller\\functions.php');
	$error_fatal = true;
}

/*Template Director*/
if( !$error_fatal ){
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
}


/*Get THEME config*/
$f = file_exists(THEME_PATH.'\\'.THEME_FOLDER.'\\config.php');
if ( $f && !$error_fatal ){
	include(THEME_PATH.'\\'.THEME_FOLDER.'\\config.php');
}elseif( !$f && !$error_fatal ){
	array_push($error,THEME_PATH.'\\'.THEME_FOLDER.'\\config.php');
}

/*Get THEME Functions*/
$f = file_exists(THEME_PATH.'\\'.THEME_FOLDER.'\\controller\\functions.php');
if ( $f && !$error_fatal ){
	include(THEME_PATH.'\\'.THEME_FOLDER.'\\controller\\functions.php');
}elseif( !$f && !$error_fatal ){
	array_push($error,THEME_PATH.'\\'.THEME_FOLDER.'\\controller\\functions.php');
}

if ( isset($_GET['view']) && !$error_fatal ){
	if ( $_GET['view'] == ADMIN_ACCESS ){
		include(ADMIN_PATH.'\\ds-view\\admin-login.php');
	}else{
		if ( ds_viewExists($_GET['view']) ){
			ds_renderView($_GET['view']);
		}else{
			ds_renderView('404');
		}
	}
}elseif( !$error_fatal ){
	ds_renderView('index');
}

if (!$error_fatal){
	if (DB_SOURCE){
		$sql->sql_close();
	}
}

/*Debug Console*/
if ( defined('DEBUG')  ){
	if (DEBUG){
		echo "<pre>";
		var_dump($error);
		echo "</pre>";
	}
}else{
	echo "<pre>";
	var_dump($error);
	echo "</pre>";
}