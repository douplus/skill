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

	$user_ary = array();
	// 取得使用者資訊
	$query = sprintf( "SELECT USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP FROM `1_CV` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@取得使用者資訊錯誤。');
	while( $a = mysql_fetch_array($result) ){
		$user_ary[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['EMAIL'].'***'.$a['GENDER'].'***'.$a['DEPARTMENT'].'***'.$a['JOIN_TIME'].'***'.$a['SKILL'].'***'.$a['MOTTO'].'***'.$a['NEED'].'***'.$a['ABOUT_ME'].'***'.$a['EXPERIENCE'].'***'.$a['LASTUSING_TIME'].'***'.$a['SCORE'].'***'.$a['USERIP'];
	}

	echo 'success@@'.json_encode( (object)$user_ary );
?>