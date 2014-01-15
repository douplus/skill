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
	echo 'ddd'.$co_content.$userid;	

?>