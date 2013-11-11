<?php
	header("Content-Type:text/html; charset=utf-8");
	$db_host = "localhost";
	$db_username = "nckuskill";
	$db_password = "llikslliks";
	$db_name = "nckuskill";
	$connect = mysql_connect( $db_host, $db_username, $db_password );
	mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die('Failed to set utf-8');

	$userid = $_POST['userid'];
	$userip = $_POST['userip'];
	$usingtime = $_POST['usingtime'];
	$score = '';
	$is_another = 0;

	// 取得 user 帳號
	$query = sprintf( "SELECT LASTUSING_TIME, SCORE FROM `1_CV` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@錯誤。');
	while( $a = mysql_fetch_array($result) ){
		if( abs((strtotime($a['LASTUSING_TIME'])-strtotime(date('Y-m-d H:i:s', strtotime( $usingtime ))))) > 60*60*24 ){
			$is_another = 1;
		}
		$score = $a['SCORE'];
	}
	
	if( $score != '' && $is_another == 1 ){
		$score = (int)$score;
		$score += 5;
	}
	
	// 設定使用者 每日登入資訊
	$query = sprintf( "UPDATE `1_CV` SET LASTUSING_TIME = '$usingtime', USERIP = '$userip', SCORE = '$score' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的每日登入資訊失敗。');

	echo 'success@'.$is_another.'@'.$score;
?>