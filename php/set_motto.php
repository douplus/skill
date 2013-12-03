<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$motto = $_POST['motto'];
	
	// 設定使用者 Motto
	$query = sprintf( "UPDATE `1_CV` SET MOTTO = '$motto' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的名言失敗。');
	
	// 設定使用者 Motto 已填
	$query = sprintf( "UPDATE `1_ACCOUNT` SET IS_MOTTO = '1' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器確認您的名言失敗。');
	
	echo 'success@設定您的名言成功。';
?>