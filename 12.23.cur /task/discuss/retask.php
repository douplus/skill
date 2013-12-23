<?php
include('../../php/db.php');


	session_start(); 	
	$taskid = $_SESSION['task_id'];

	$retaskuser = $_POST['userid'];
	$retaskcontent = $_POST['retaskcon'];

	$agreenment = 0;

	$query = sprintf("INSERT INTO `1_RE_TASK` (TASKID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($retaskuser), mysql_real_escape_string($retaskcontent));
	
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器創建您的回覆資訊。';
	    die($message);
	}
		echo "成功@@";
?>