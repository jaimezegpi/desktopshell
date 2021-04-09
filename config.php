<?php
/**/
define('SITE_URL', 'http://192.168.1.88/laboratorio/desktopshell');
define('THEME_FOLDER', 'default');
define('ADMIN_ACCESS', 'access');

/*SQL*/
define('DB_SOURCE', true);
if (DB_SOURCE){
	define('DB_FILE', 'ds-engine/ds-model/sql.php');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'desktopshell');
	define('DB_USER', 'root');
	define('DB_PASS', '');
} 

/*Config*/
define('THEME_PATH', 'ds-theme');
define('ADMIN_PATH', 'ds-engine');
define('CONTROLLER_PATH', 'ds-engine');
define('MODEL_PATH', 'ds-engine');
define('DEBUG', true);


define('SESSION_ID', session_id());

?>