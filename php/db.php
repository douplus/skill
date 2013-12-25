<?php
	$db_host = "localhost";
	$db_username = "nckuskill";
	$db_password = "llikslliks";
	$db_name = "nckuskill";
	$connect = mysql_connect( $db_host, $db_username, $db_password );
	mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die('Failed to set utf-8');
?>