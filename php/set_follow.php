<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$follower = $_POST['follower'];
	$followed = $_POST['followed'];

	$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$follower' AND FOLLOWED = '$followed'" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注 失敗。');
	if( mysql_num_rows( $result ) > 0 ){  # 之前已關注
		die('success@1@您已經關注了。');
	}else{  # 之前尚未關注
		$query = sprintf( "INSERT INTO `1_FOLLOW` (FOLLOWED, FOLLOWER) VALUES ('%s', '%s')", mysql_real_escape_string($followed), mysql_real_escape_string($follower) );
		$result = mysql_query( $query ) or die('error@伺服器 設定關注 失敗。');
		# 設定 關注人數
		$query = sprintf( "UPDATE `1_CV` SET FOLLOWERS = FOLLOWERS + 1 WHERE USERID = '$followed'" );
		$result = mysql_query($query) or die('error@伺服器更動 關注人數 失敗。');
	}
	
	echo 'success@0@設定關注成功。';
?>
