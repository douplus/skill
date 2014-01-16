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
	// answer counter
	$SQLStr = "select ANSWER from `1_INFO3_TASK` where TASKID = '$taskid'";
	$res = mysql_query($SQLStr) or die('error@取得任務ANSWER。');
		while( $a = mysql_fetch_array($res) ){
			$answer = $a['ANSWER'];
	    break;
	}
	$answer = $answer+1;

	$query = mysql_query("UPDATE `1_INFO3_TASK` SET ANSWER = $answer WHERE TASKID = '$taskid' ");
	if( !$query ){
	    $message  = 'error@伺服器answer失敗。';
	    die($message);
	}


		echo "成功@@".$retaskuser.$taskid;
?>