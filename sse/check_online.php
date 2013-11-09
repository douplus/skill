<?php
	$db_host = 'localhost';
	$db_username = 'root';
	$db_password = 'bs8896168';
	$db_name = 'online_users';
	$con = mysql_connect( $db_host, $db_username, $db_password ) or die( 'Not connected: '.mysql_error() );
	mysql_select_db( $db_name, $con ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die( 'Failed to set utf-8' );

	$userID = $_GET['userID'];
	$time = $_GET['time'];
	$query = "SELECT `id` FROM `online` WHERE `id` = '$userID';";
	$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	if( mysql_num_rows( $result ) > 0 ){    // 更新使用者的時間戳
		$query = "UPDATE `online` SET `time` = '$time' WHERE id = '$userID';";
		$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	}else{    // 新增使用者的時間戳
		$query = "INSERT INTO `online`(`id` ,`time`) VALUES('$userID', '$time');";
		$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	}
	mysql_close( $con );
?>