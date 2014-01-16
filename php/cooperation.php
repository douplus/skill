<?php
include('../php/db.php');
	//拉標題
	$copid = $_POST['cop_id'];
	$userid = $_POST['userid'];
	$co_content = $_POST['co_content'];
	$query = sprintf("INSERT INTO `1_DISCUSS_COOPERATION` (COOPERATION_ID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($copid), mysql_real_escape_string($userid), mysql_real_escape_string($co_content));
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器討論區回覆。';
	    die($message);
	}

	$SQLStr = sprintf( "SELECT 1_CV.USER_PHOTO FROM `1_CV` WHERE 1_CV.USERID =  '$userid' " );
	    $res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
	        while( $a = mysql_fetch_array($res) ){
	            $user_photo = $a['USER_PHOTO'];  
	    }		
	echo '討論區回覆成功'.'***'.$user_photo;	

?>