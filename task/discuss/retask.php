<?php
	$taskid = $_POST['taskid'];
	$retaskuser = $_POST['userid'];
	$retaskcontent = $_POST['retaskcon'];
	$agreenment = 0;

	$query = sprintf("INSERT INTO `1_RE_TASK` (TASKID,USERID,CONTENT,AGREEMENT) VALUES ('%s','%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($retaskuser), mysql_real_escape_string($retaskcontent), mysql_real_escape_string($agreenment);
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器創建您的回覆資訊。';
	    die($message);
	}
?>