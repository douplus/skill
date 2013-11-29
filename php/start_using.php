<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$userip = $_POST['userip'];
	$usingtime = $_POST['usingtime'];
	$score = '';
	$photo = '';
	$is_another = 0;
	
	// 取得 user 帳號
	$query = sprintf( "SELECT USER_PHOTO, LASTUSING_TIME, SCORE FROM `1_CV` WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@錯誤。');
	while( $a = mysql_fetch_array($result) ){
		$temp1 = explode( ' ', $a['LASTUSING_TIME'] );
		$temp2 = explode( ' ', $usingtime );
		if( abs( strtotime($temp1[0]) - strtotime($temp2[0]) ) > 0 ){
			$is_another = 1;
		}
		$score = $a['SCORE'];
		$photo = $a['USER_PHOTO'];
	}
	
	if( $score != '' && $is_another == 1 ){
		$score = (int)$score;
		$score += 5;
	}
	
	// 設定使用者 每日登入資訊
	$query = sprintf( "UPDATE `1_CV` SET LASTUSING_TIME = '$usingtime', USERIP = '$userip', SCORE = '$score' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的每日登入資訊失敗。');
	
	echo 'success@'.$is_another.'@'.$score.'@'.$photo;
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