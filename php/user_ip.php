<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$userip = $_POST['userip'];
	
	// 設定使用者 ip
	$query = sprintf( "UPDATE `1_CV` SET USERIP = '$userip' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的 ip 失敗。');
	
	echo 'success@'.$userip;
?>