<?php
include('../php/db.php');
	$taskid = $_POST['taskid'];
	$checker = $_POST['checker'];
	$wantcoworker = $_POST['wantcoworker'];
	$type = $_POST['type'];

    
	if ($type == 'cocheck') {
		$query = mysql_query("UPDATE `1_CHECK_TASK` SET COCHECK = '1', COWORKER='$checker' WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器cocheck失敗。';
		    die($message);
		}
		echo '已送出合作需求';
	}
	//按下確認後，待審查清掉，合作中增加
	if ($type == 'cowork') {

		$query = mysql_query("DELETE FROM `1_CHECK_TASK`  WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器checkd清空失敗。';
		    die($message);
		}		

		$query = mysql_query("UPDATE `1_COWORK_TASK` SET COWORK = '1', COWORKER='$wantcoworker' WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器cowork失敗。';
		    die($message);
		}
		echo '合作關係已建立';
	}	
	if ($type == 'refuse') {
		$query = mysql_query("DELETE FROM `1_CHECK_TASK`  WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器check delete失敗。';
		    die($message);
		}
		$query = mysql_query("DELETE FROM `1_COWORK_TASK`  WHERE TASKID = '$taskid' ");
		if( !$query ){
		    $message  = 'error@伺服器cowork delete清空失敗。';
		    die($message);
		}
		echo '拒絕合作';			
	}

	
?>