<?php
include('../../php/db.php');
	$taskid = $_POST['taskid'];
	$userid = $_POST['userid'];
	$type = $_POST['type'];

	if ($type == 'cocheck') {
		$query = mysql_query("UPDATE `1_CHECK_TASK` SET COCHECK = '1', COWORKER='$userid' WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器cocheck失敗。';
		    die($message);
		}
	}
	if ($type == 'cowork') {
		$query = mysql_query("UPDATE `1_CHECK_TASK` SET COWORK = '1', COWORKER='$userid' WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器cowork失敗。';
		    die($message);
		}
	}	

	
?>