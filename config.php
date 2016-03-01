<?php
#  'db' prefix for database access variables
$config['dbName'] = "ejemplo";
$config['dbUser'] = "ejemplo";
$config['dbPass'] = "ejemplo";
$config['dbHost'] = "localhost";

# 'web' prefix for web variables
$config['webHost'] = "www.ejemplo.com";
$config['webProto'] = "http"; # http o https

# 'mail' prefix for mail access variables
$config['mailHost'] = "smtp.ejemplo.com";
$config['mailSecure'] = "";	# '' (inseguro), 'ssl' (SSL/TLS) o 'tls' (STARTTLS)

$config['mailPort'] = 25;	# 25 (inseguro), 465 (SSL/TLS) o 587 (STARTTLS).

$config['mailUser'] = "usuario@ejemplo.com";
$config['mailPass'] = "ejemplo";
$config['mailRealName'] = "Ejemplo";

# allow local overrides
if (file_exists(dirname(__FILE__).'/config.local.php')) {
	require_once(dirname(__FILE__).'/config.local.php');
}

?>
