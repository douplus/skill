<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');
	include('./motto_score.php');

	$userid = $_POST['userid'];
	$motto = $_POST['motto'];
	
	// 更新 使用者 Motto
	$query = sprintf( "UPDATE `1_CV` SET MOTTO = '$motto' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 Motto 失敗。');

	$cal = explode( '*@*@*@', Calculate( $motto ) );
	$score = $cal[0];
	$break = str_replace( '+', ' ', $cal[1] );

	$query = sprintf( "SELECT USERID FROM `1_MOTTO` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器查詢您的 Motto 失敗。');
	if( mysql_num_rows( $result ) > 0 ){    // 更新使用者的 Motto
		$query = sprintf( "UPDATE `1_MOTTO` SET M_SCORE = '$score', M_BREAK = '$break' WHERE USERID = '$userid'" );
		$result = mysql_query( $query ) or die('error@伺服器查詢您的 Motto 失敗。');
	}else{    // 新增使用者的 Motto
		$query = sprintf( "INSERT INTO `1_MOTTO` (USERID, M_SCORE, M_BREAK) VALUES ('%s', '%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($score), mysql_real_escape_string($break) );
		$result = mysql_query( $query ) or die('error@伺服器查詢您的 Motto 失敗。');
	}
	
	echo 'success@更新 Motto 成功。@'.$motto.'@'.$score.'@'.$break;
?>
