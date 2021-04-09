<?php
/*Functions*/
function ds_getThemePath(){
	$theme_folder = SITE_URL.'/'.THEME_PATH.'/'.THEME_FOLDER;
	if ($theme_folder){
		return $theme_folder;
	}else{
		return false;
	}
}

function ds_viewExists($path){
	if (!$path){
		return false;
	}
	
	if ( file_exists(ROOTPATH.'\\'.THEME_PATH.'\\'.THEME_FOLDER.'\\'.$path.'.php') ){
		return true;
	}else{
		return false;
	}
}

function ds_renderView($path){
	if (!$path){
		return false;
	}
	$path = ds_cleanUri($path);	
	if ( file_exists(ROOTPATH.'\\'.THEME_PATH.'\\'.THEME_FOLDER.'\\'.$path.'.php') ){
		$sql = $GLOBALS["sql"];
		include ( ROOTPATH.'\\'.THEME_PATH.'\\'.THEME_FOLDER.'\\'.$path.'.php' );
		return true;
	}else{
		return false;
	}
}

function ds_cleanUri($uri=""){
	$uri = str_replace("../", "", $uri);
	$uri = urlencode($uri);
	return $uri;
}

function ds_getModule($path){
	if (!$path){
		return false;
	}
	$path = ds_cleanUri($path);	

	if ( file_exists(ROOTPATH.'\\'.THEME_PATH.'\\'.THEME_FOLDER.'\\module\\'.$path.'.php') ){
		$sql = $GLOBALS["sql"];
		include ( ROOTPATH.'\\'.THEME_PATH.'\\'.THEME_FOLDER.'\\module\\'.$path.'.php' );
	}elseif( file_exists(ROOTPATH.'\\'.ADMIN_PATH.'\\ds-view\\module\\'.$path.'.php') ){
		include ( ROOTPATH.'\\'.ADMIN_PATH.'\\ds-view\\module\\'.$path.'.php' );
	}
}

function ds_userIsLogin(){
	if ( isset($_SESSION["user_is_login_".session_id()]) ){
		return true;
	}else{
		return false;
	}
}

function ds_redirect(){

}

?>