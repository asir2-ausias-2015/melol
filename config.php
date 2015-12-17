<?php
# 'db' prefix for database access variables
$config['dbName'] = "ejemplo";
$config['dbUser'] = "ejemplo";
$config['dbPass'] = "ejemplo";
$config['dbHost'] = "localhost";

# allow local overrides
if (file_exists('./config.local.php')) {
	require_once('config.local.php');
}

?>
