<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$usingtime = $_POST['usingtime'];
	$score = '';
	$photo = '';
	$is_another = 0;
	$is_checked = '';
	$$join_time = '';
	
	# 取得 user 帳號
	//$query = sprintf( "SELECT USER_PHOTO, LASTUSING_TIME, SCORE FROM `1_CV` WHERE USERID = '$userid'" );
	$query = sprintf( "SELECT 1_CV.USER_PHOTO,1_CV.LASTUSING_TIME,1_CV.SCORE,1_CV.JOIN_TIME,1_ACCOUNT.IS_CHECKED FROM `1_CV`,`1_ACCOUNT` WHERE 1_CV.USERID = 1_ACCOUNT.USERID AND 1_CV.USERID = '$userid'" );
	$result = mysql_query($query) or die('error@錯誤。');
	while( $a = mysql_fetch_array($result) ){
		$temp1 = explode( ' ', $a['LASTUSING_TIME'] );
		$temp2 = explode( ' ', $usingtime );
		if( abs( strtotime($temp1[0]) - strtotime($temp2[0]) ) > 0 ){
			$is_another = 1;
		}
		$score = $a['SCORE'];
		$photo = $a['USER_PHOTO'];
		$join_time = $a['JOIN_TIME'];
		$is_checked = $a['IS_CHECKED'];
	}
	
	if( $score == '' || $is_checked == '' || $join_time == '' ){
		die('error@伺服器設定您的資訊失敗。');
	}else if( (int)$is_checked == 0 ){
		$date = strtotime('+14 day', strtotime($join_time));
		$date = date('Y-m-d', $date);
	}else{
		$date = 'none';
	}
	
	$is_remove = 0;
	if( $date !== 'none' ){
		$temp_usingtime = explode( ' ', $usingtime );
		if( strtotime($temp_usingtime[0]) > strtotime($date) ){
			$is_remove = 1;
		}
	}
	
	# 每日登入 +5 分
	if( $is_another == 1 ){
		$score = (int)$score + 5;
	}
	
	# 設定使用者 每日登入資訊
	$query = sprintf( "UPDATE `1_CV` SET LASTUSING_TIME = '$usingtime', SCORE = '$score' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的每日登入資訊失敗。');
	
	echo 'success@'.$is_another.'@'.$score.'@'.$photo.'@'.$is_checked.'@'.$date.'@'.$is_remove;
?>
<?php
	function IsExist( $path ){
		if( file_exists( $path ) ){
			return 'exist';
		}else{
			return 'not_exist';
		}
	}
?>