<?php
include('../php/db.php');
<<<<<<< HEAD
	//拉標題


	$copid = $_POST['cop_id'];
	$userid = $_POST['userid'];
	$co_content = $_POST['co_content'];
	$query = sprintf("INSERT INTO `1_DISCUSS_COOPERATION` (COOPERATION_ID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($copid), mysql_real_escape_string($userid), mysql_real_escape_string($co_content));
	
=======

	$taskid = $_GET['task_id'];
	$co_content = $_POST['co_content'];
	$userid = $_POST['userid'];
	$query = sprintf("INSERT INTO `1_DISCUSS_COOPERATION` (COOPERATION_ID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($userid), mysql_real_escape_string($co_content));
>>>>>>> b38c0e1a9ef4693a16435a0140e922c82954be8c
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器討論區回覆。';
	    die($message);
<<<<<<< HEAD
	}	
	echo 'ddd'.$co_content.$userid;	
=======
	}
>>>>>>> b38c0e1a9ef4693a16435a0140e922c82954be8c

?>