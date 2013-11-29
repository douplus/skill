<?php
	header("Content-Type:text/html; charset=utf-8");
	$db_host = "localhost";
	$db_username = "nckuskill";
	$db_password = "llikslliks";
	$db_name = "nckuskill";
	$connect = mysql_connect( $db_host, $db_username, $db_password );
	mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die('Failed to set utf-8');

	$userid = $_POST['userid'];
	$motto = $_POST['motto'];
	
	// 設定使用者 Motto
	$query = sprintf( "UPDATE `1_CV` SET MOTTO = '$motto' WHERE USERID = '$userid'" );
	$result = mysql_query($query);
	if( !$result ){
		$message  = 'error@伺服器設定您的名言失敗。';
		die($message);
	}
	
	// 設定使用者 Motto 已填
	$query = sprintf( "UPDATE `1_ACCOUNT` SET IS_MOTTO = '1' WHERE USERID = '$userid'" );
	$result = mysql_query($query);
	if( !$result ){
		$message  = 'error@伺服器確認您的名言失敗。';
		die($message);
	}
	
	echo 'success@設定您的名言成功。';
?>