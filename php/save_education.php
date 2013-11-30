<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$education = $_POST['education'];
	
	// 更新 使用者 Education
	$query = sprintf( "UPDATE `1_CV` SET DEPARTMENT = '$education' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 Education 失敗。');

	echo 'success@更新 Education 成功。@'.$education;
?>
