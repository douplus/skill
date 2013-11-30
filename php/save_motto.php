<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$motto = $_POST['motto'];
	
	// 更新 使用者 Motto
	$query = sprintf( "UPDATE `1_CV` SET MOTTO = '$motto' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 Motto 失敗。');

	echo 'success@更新 Motto 成功。@'.$motto;
?>
