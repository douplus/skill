<?php
include('../php/db.php');

	$taskid = $_GET['task_id'];
	$co_content = $_POST['co_content'];
	$userid = $_POST['userid'];
	$query = sprintf("INSERT INTO `1_DISCUSS_COOPERATION` (COOPERATION_ID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($userid), mysql_real_escape_string($co_content));
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器討論區回覆。';
	    die($message);
	}

?>