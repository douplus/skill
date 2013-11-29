<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');
	
	$userid = $_POST['user_id'];
	$img = $userid.'.jpg';
	// 設定使用者 photo
	$query = sprintf( "UPDATE `1_CV` SET USER_PHOTO = '$img' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器設定您的圖像失敗。');
	
	echo base64_to_jpeg( utf8_decode($_POST['photo']), '../photo/'.$userid.'.jpg' );
?>
<?php
	function base64_to_jpeg( $base64_string, $output_file ) {
		$a = explode( ',', $base64_string );
		$ifp = fopen( $output_file, 'wb' ); 
		$bytes = fwrite( $ifp, base64_decode($a[1]) ); 
		fclose( $ifp );
		if( $ifp === false || $bytes === false ){
			return 'error@伺服器發生錯誤，請再傳一次圖片。';
		}
		return 'success@'.$userid.'@'.$bytes.'@'.$_POST['photo'];
	}
?>