<?php
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'gabriel');
	define('DB_PASSWORD', 'gab_123');
	define('DB_NAME', 'app_mercos');

	$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_set_charset($link,'utf8');

	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	if ( !defined('ABSPATH') )
		define('ABSPATH', dirname(__FILE__) . '/');

	if ( !defined('BASEURL') )
		define('BASEURL', '/appmercos/');

	if ( !defined('DBAPI') )
		define('DBAPI', ABSPATH . 'inc/database.php');

	define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
	define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');



?>