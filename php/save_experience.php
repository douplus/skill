<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$experience = $_POST['experience'];
	
	// 更新 使用者 Experience
	$query = sprintf( "UPDATE `1_CV` SET EXPERIENCE = '$experience' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 Experience 失敗。');

	echo 'success@更新 Experience 成功。@'.$experience;
?>
