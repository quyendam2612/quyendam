<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

require_once getcwd() . '/../wp-load.php';

global $wpdb;

$sql = "select count(*) as records from cgv_sessions";
$rows = $wpdb->get_results($sql);
echo ($rows[0]->records);
