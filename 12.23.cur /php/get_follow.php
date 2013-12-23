<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$viewerid = $_POST['viewerid'];
	$start = (int)$_POST['start'];
	$end = $start+30;
	
	# 抓 正在關注
	$following_ary = array();
	$following_user_ary = array();
	$query = sprintf( "SELECT FOLLOWED FROM `1_FOLLOW` WHERE FOLLOWER = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$following_user_ary[] = $a['FOLLOWED'];
	}
	# 抓 正在關注 履歷
	$following_user_ary_len = count( $following_user_ary );
	for( $i=0; $i<$following_user_ary_len; $i++ ){
		$temp = $following_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$data = $following_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		if( mysql_num_rows( $result ) > 0 ){  # 之前已關注
			$data = $data.'***yes';
		}else{  # 之前尚未關注
			$data = $data.'***no';
		}
		$following_ary[] = $data;
	}
	
	# 抓 追隨者
	$follower_ary = array();
	$follower_user_ary = array();
	$query = sprintf( "SELECT FOLLOWER FROM `1_FOLLOW` WHERE FOLLOWED = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$follower_user_ary[] = $a['FOLLOWER'];
	}
	# 抓 追隨者 履歷
	$follower_user_ary_len = count( $follower_user_ary );
	for( $i=0; $i<$follower_user_ary_len; $i++ ){
		$temp = $follower_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$data = $follower_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		if( mysql_num_rows( $result ) > 0 ){  # 之前已關注
			$data = $data.'***yes';
		}else{  # 之前尚未關注
			$data = $data.'***no';
		}
		$follower_ary[] = $data;
	}
	
	# 抓 已開通
	$activate_ary = array();
	$activate_user_ary = array();
	$query = sprintf( "SELECT * FROM `1_ACTIVATE` WHERE ACTIVATER = '$userid' OR ACTIVATED = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器查詢 開通名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		if( $a['ACTIVATER'] === $userid ){
			$activate_user_ary[] = $a['ACTIVATED'];
		}else if( $a['ACTIVATED'] === $userid ){
			$activate_user_ary[] = $a['ACTIVATER'];
		}
	}
	# 抓 已開通 履歷
	$following_user_ary_len = count( $activate_user_ary );
	for( $i=0; $i<$following_user_ary_len; $i++ ){
		$temp = $activate_user_ary[$i];
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 開通名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$activate_ary[] = $activate_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
	}
	
	echo 'success@查詢 關注名單 成功。@'.count( $following_ary ).'@'.json_encode( (object)$following_ary ).'@'.count( $follower_ary ).'@'.json_encode( (object)$follower_ary ).'@'.count( $activate_ary ).'@'.json_encode( (object)$activate_ary );
?>
