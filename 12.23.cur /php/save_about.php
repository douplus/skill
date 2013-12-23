<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$about = $_POST['about'];
	
	// 更新 使用者 About
	$query = sprintf( "UPDATE `1_CV` SET ABOUT_ME = '$about' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 About 失敗。');

	echo 'success@更新 About 成功。@'.$about;
?>
