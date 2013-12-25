<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$skill = $_POST['skill'];
	
	// 設定 使用者 Skill
	$query = sprintf( "UPDATE `1_CV` SET SKILL = '$skill' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的 Skill 失敗。');

	// 刪除 使用者 Skill
	$query = sprintf( "DELETE FROM `1_SKILL` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更動您的 Skill 失敗。');
	
	$ary1 = array();
	$ary1 = explode( ',', $skill );
	$ary1_len = count($ary1);
	for( $i=0; $i<$ary1_len; $i++ ){    // 創建 user's skill
		$query = sprintf( "INSERT INTO `1_SKILL` (USERID, SKILL) VALUES ('%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($ary1[$i]) );
		$result = mysql_query($query) or die('error@伺服器更新您的 Skill 失敗。');
	}

	echo 'success@創建 Skill 成功。@'.$skill;
?>