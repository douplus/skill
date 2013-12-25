<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$skill = $_POST['skill'];
	$need = $_POST['need'];
	
	// 設定使用者 Need 和 Skill
	$query = sprintf( "UPDATE `1_CV` SET SKILL = '$skill', NEED = '$need' WHERE USERID = '$userid'" );
	$result = mysql_query($query);
	if( !$result ){
		$message  = 'error@伺服器設定您的 Need 和 Skill 失敗。';
		die($message);
	}
	
	$ary1 = array(); $ary2 = array();
	$ary1 = explode( ',', $skill );
	$ary2 = explode( ',', $need );
	for( $i=0; $i<count($ary1); $i++ ){    // 創建 user's skill
		$query = sprintf( "INSERT INTO `1_SKILL` (USERID, SKILL) VALUES ('%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($ary1[$i]) );
		$result = mysql_query($query);
		if( !$result ){
			$message  = 'error@伺服器設定您的 Need 和 Skill 失敗。';
			die($message);
		}
	}
	for( $i=0; $i<count($ary2); $i++ ){    // 創建 user's need
		$query = sprintf( "INSERT INTO `1_NEED` (USERID, NEED) VALUES ('%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($ary2[$i]) );
		$result = mysql_query($query);
		if( !$result ){
			$message  = 'error@伺服器設定您的 Need 和 Skill 失敗。';
			die($message);
		}
	}
	
	// 設定使用者 Need 和 Skill 已填
	$query = sprintf( "UPDATE `1_ACCOUNT` SET IS_SKILL = '1' WHERE USERID = '$userid'" );
	$result = mysql_query($query);
	if( !$result ){
		$message  = 'error@伺服器確認您的 Need 和 Skill 失敗。';
		die($message);
	}
	
	echo 'success@創建您的 Need 和 Skill 成功。';
?>