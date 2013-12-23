<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$old_passwd = md5( $_POST['old_passwd'].'skill' );
	$new_passwd = md5( $_POST['new_passwd'].'skill' );
	$sql_passwd = '';
	
	# 核對密碼
	$query = sprintf( "SELECT PASSWD FROM `1_ACCOUNT` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	while( $a = mysql_fetch_array($result) ){
		$sql_passwd = $a['PASSWD'];
		break;
	}
	
	if( $sql_passwd == '' || $sql_passwd != $old_passwd ){
		die('success@0@目前的密碼輸入錯誤。');
	}else{
		# 設定 新密碼
		$query = sprintf( "UPDATE `1_ACCOUNT` SET PASSWD = '$new_passwd' WHERE USERID = '$userid'" );
		$result = mysql_query($query) or die('error@伺服器設定您的新密碼失敗。');
	}
	
	echo 'success@1@新密碼更改成功';
?>