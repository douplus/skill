<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$need = $_POST['need'];
	
	// 設定 使用者 Need
	$query = sprintf( "UPDATE `1_CV` SET NEED = '$need' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的 Need 失敗。');

	// 刪除 使用者 Need
	$query = sprintf( "DELETE FROM `1_NEED` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更動您的 Need 失敗。');
	
	$ary1 = array();
	$ary1 = explode( ',', $need );
	$ary1_len = count($ary1);
	for( $i=0; $i<$ary1_len; $i++ ){    // 創建 user's Need
		$query = sprintf( "INSERT INTO `1_NEED` (USERID, NEED) VALUES ('%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($ary1[$i]) );
		$result = mysql_query($query) or die('error@伺服器更新您的 Need 失敗。');
	}

	echo 'success@創建 Need 成功。@'.$need;
?>