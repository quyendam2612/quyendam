<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

$user = "root";
$pass = "khenham";
try {
	$output = shell_exec( "cd ..;/usr/bin/mysql -u$user -p$pass wp_quyendam < cgv_sessions.sql" );
	echo "<pre>$output</pre>";
} catch (Exception $e) {
	print_r($e->getMessage());
}
echo "done";