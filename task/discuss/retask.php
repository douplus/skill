<?php
	$db_host = "localhost";
	$db_username = "nckuskill";
	$db_password = "llikslliks";
	$db_name = "nckuskill";
	$connect = mysql_connect( $db_host, $db_username, $db_password );
	mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
	mysql_set_charset('utf8') or die('Failed to set utf-8');
	
	$taskid = $_POST['Taskid'];
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