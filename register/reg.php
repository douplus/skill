<?php header("Content-Type:text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <title>Skill</title>
</head>
<body>
	<?php
		$db_host = "localhost";
		$db_username = "nckuskill";
		$db_password = "llikslliks";
		$db_name = "nckuskill";
		$connect = mysql_connect( $db_host, $db_username, $db_password );
		mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
		mysql_set_charset('utf8') or die('Failed to set utf-8');
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET CHARACTER SET UTF8"); 
		mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
		
		$captcha = $_GET['q'];
		$userid = $_GET['u'];
		$is_checked = 1;
		$temp = false;
		
		// 取得 user 認證資訊
		$query = sprintf( "SELECT CAPTCHA FROM `1_ACCOUNT` WHERE USERID = '$userid'" );
		$result = mysql_query($query) or die('MySQL query error');
		while( $a = mysql_fetch_array($result) ){
			if( $captcha == $a['CAPTCHA'] ) $temp = true;
		}
		if( $temp ){
			// 取得 user 認證碼 IS_CHECKED
			$query = sprintf( "UPDATE `1_ACCOUNT` SET IS_CHECKED = '$is_checked' WHERE USERID = '$userid'" );
			$result = mysql_query($query) or die('MySQL query error');
			if( !$result ){
				//$message  = 'Invalid query2: '.mysql_error().'\n'.'Whole query: '.$query;
				$message  = 'Invalid query';
				die($message);
			}
			echo '
				<p>電子郵件認證成功</p>
				<br>
				<a href="http://merry.ee.ncku.edu.tw/~thwang/cur/" target="_blank">進入 Skill</a>
			';
		}else{
			die('認證失敗。');
		}
	?>
</body>
</html>