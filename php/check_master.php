<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');
	
	$time = $_POST['time'];
	
	$master_str = '';
	$user_str = '';
	$is_another = 0;
	$master_ary = array();
	
	// 取得 master list
	$query = sprintf( "SELECT MASTERID, MASTER_TIME FROM `1_MASTER` ORDER BY MASTER_TIME DESC LIMIT 1" );
	$result = mysql_query($query) or die('error@取得神人清單錯誤。');
	if( mysql_num_rows( $result ) > 0 ){    // 有資料
		while( $a = mysql_fetch_array($result) ){
			if( abs( strtotime($a['MASTER_TIME'])-strtotime($time) ) > 0 ){
				$is_another = 1;
			}else{
				$time = $a['MASTER_TIME'];
			}
			$master_str = $a['MASTERID'];
		}
	}else{    // 沒有資料
		$is_another = 2;
	}
	
	if( $is_another == 1 || $is_another == 2 ){
		// 取得 user id of master
		$query = sprintf( "SELECT USERID, SCORE FROM `1_CV` ORDER BY SCORE DESC LIMIT 12" );
		$result = mysql_query($query) or die('error@取得神人資訊錯誤。');
		while( $a = mysql_fetch_array($result) ){
			$user_str = $user_str.','.$a['USERID'];
			$master_ary[] = $a['USERID'];
		}
		$user_str = substr( $user_str, 1, strlen( $user_str ) );

		// 設定 神人清單
		$query = sprintf( "INSERT INTO `1_MASTER` (MASTERID, MASTER_TIME) VALUES ('%s', '%s')", mysql_real_escape_string($user_str), mysql_real_escape_string($time) );
		$result = mysql_query($query) or die('error@設定神人清單錯誤。');
		$master_str = $user_str;
		
		// 重設 神人清單
		$query = sprintf( "UPDATE `1_CV` SET IS_MASTER = '0'" );
		$result = mysql_query($query) or die('error@重設神人清單錯誤。');

		$master_ary_len = count( $master_ary );
		for( $i=0; $i<$master_ary_len; $i++ ){
			$query = sprintf( "UPDATE `1_CV` SET IS_MASTER = '1' WHERE USERID = '$master_ary[$i]'" );
			$result = mysql_query($query) or die('error@設定神人資訊錯誤。');
		}
		unset( $master_ary_len );
	}

	echo 'success@'.$is_another.'@'.$master_str.'@'.$time;
?>