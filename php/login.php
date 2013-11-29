<?php
	header("Content-Type:text/html; charset=utf-8");
	$db_host = "localhost";
	$db_username = "nckuskill";
	$db_password = "llikslliks";
	$db_name = "nckuskill";
	$connect = mysql_connect( $db_host, $db_username, $db_password );
	mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die('Failed to set utf-8');

	$email = $_POST['email'];
	$passwd = $_POST['passwd'];
	$userid = '';
	$sql_passwd = '';
	$is_skill = 0;
	$is_motto = 0;
	
	// 取得 user 帳號
	$query = sprintf( "SELECT USERID,USERNAME,GENDER,JOIN_TIME,SKILL,MOTTO,NEED FROM `1_CV` WHERE EMAIL = '$email'" );
	$result = mysql_query($query) or die('error@此帳號未註冊。');
	while( $a = mysql_fetch_array($result) ){
		$userid = $a['USERID'];
		$username = $a['USERNAME'];
		$user_ary = array(
			'USERID' => $a['USERID'],
			'USERNAME' => $a['USERNAME'],
			'EMAIL' => $email,
			'GENDER' => $a['GENDER'],
			'JOIN_TIME' => $a['JOIN_TIME'],
			'SKILL' => $a['SKILL'],
			'NEED' => $a['NEED'],
			'MOTTO' => $a['MOTTO']
		);
	}
	
	if( $userid == '' ){
		$message  = 'error@此帳號未註冊。';
		die($message);
	}

	// 核對密碼
	$query = sprintf( "SELECT PASSWD,IS_SKILL,IS_MOTTO FROM `1_ACCOUNT` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	while( $a = mysql_fetch_array($result) ){
		$sql_passwd = $a['PASSWD'];
		if( (int)$a['IS_SKILL'] == 1 )  $is_skill = 1;
		if( (int)$a['IS_MOTTO'] == 1 )  $is_motto = 1;
	}
	
	if( $sql_passwd == '' || $sql_passwd != $passwd ){
		$message  = 'error@密碼輸入錯誤。';
		die($message);
	}
	
	echo 'success@@'.$username.'@@'.$userid.'@@'.$is_skill.'@@'.$is_motto.'@@'.json_encode( (object)$user_ary );
?>