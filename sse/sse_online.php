<?php
	header("Content-Type: text/event-stream");
	header('Cache-Control: no-cache');
	
 	$db_host = 'localhost';
	$db_username = 'root';
	$db_password = 'bs8896168';
	$db_name = 'online_users';
	$con = mysql_connect( $db_host, $db_username, $db_password ) or die( 'Not connected: '.mysql_error() );
	mysql_select_db( $db_name, $con ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die( 'Failed to set utf-8' );
	
	$userID = $_COOKIE['userID'];
	$time = date('Y-m-d H:i:s', strtotime("now + 480 min"));
	$query = "SELECT `id` FROM `online` WHERE `id` = '$userID';";
	$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	if( mysql_num_rows( $result ) > 0 ){    // 更新使用者的時間戳
		$query = "UPDATE `online` SET `time` = '$time' WHERE id = '$userID';";
		$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	}
	
	$query = "SELECT * FROM `online`;";
	$result = mysql_query( $query ) or die( 'MySQL failed: '.mysql_error() );
	$data = array();
	$online_user = array();
	while( $row = mysql_fetch_assoc($result) ) {
		if( abs((strtotime($row['time'])-strtotime(date('Y-m-d H:i:s', strtotime("now + 480 min"))))) < 60 ){
			$online_user[] = array( 'id' => $row['id'] );
		}
	}
	mysql_close( $con );
	
	echo "event: online\n";
	$user_list = json_encode( $online_user );
	echo 'data: {"msg": '.$user_list.'}';
	echo "\n\n";
	flush();
	sleep(7);
 ?>