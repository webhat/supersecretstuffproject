<?php
include_once("settings.php");
error_reporting(0);
$db = null;
if(!$db = new mysqli($db_host, $db_username, $db_password, "", $db_port)){
	error_log( "The system has encountered a serious error: Could not connect to the database: " . $db->error . "");
	exit;
}
if(!$db->select_db($db_name)){
	error_log( "The system has encountered a serious error: Could not select database. Make sure your database name is correct in database.php: ". $db->error ."");
	exit;
}
$query = "SELECT id,charset FROM settings";
if(!$result = $db->query($query)){
	error_log( "The system has encountered a serious error: Could not select database tables. Make sure you've imported the database.sql file into your database.");
	exit;
}
error_reporting(E_ALL & ~E_NOTICE);
if(strtolower($result->charset) == "utf-8"){
	$db->query('SET NAMES utf8');
}
?>
