<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$follower = $_POST['follower'];
	$followed = $_POST['followed'];

	$query = sprintf( "DELETE FROM `1_FOLLOW` WHERE FOLLOWER = '$follower' AND FOLLOWED = '$followed'" );
	$result = mysql_query($query) or die('error@伺服器更動 關注 失敗。');
	
	# 設定 關注人數
	$query = sprintf( "UPDATE `1_CV` SET FOLLOWERS = FOLLOWERS - 1 WHERE USERID = '$followed'" );
	$result = mysql_query($query) or die('error@伺服器更動 關注人數 失敗。');
	
	echo 'success@取消關注成功。';
?>
