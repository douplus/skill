<?php
	session_start();         
    $taskid = $_SESSION['task_id'];
	
	include('../../php/db.php');
	include('../../php/function.php');
	
    $taskid = $_SESSION['task_id'];
	$retaskuser = $_POST['userid'];
	$retaskcontent = $_POST['retaskcon'];
	
	# 推送通知
	$noti = Create_Notify( $_POST['po_id'], $retaskuser, $taskid, '回應了您的任務', '/task/discuss/index.php?task_id='.$taskid );
	$noti = explode( '@', $noti );
	
	$agreenment = 0;

	$query = sprintf("INSERT INTO `1_RE_TASK` (TASKID,USERID,CONTENT) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($retaskuser), mysql_real_escape_string($retaskcontent));
	$result = mysql_query($query);
	if( !$result ){
	    $message  = 'error@伺服器創建您的回覆資訊。';
	    die($message);
	}

	# answer counter
	$query = mysql_query("UPDATE `1_INFO3_TASK` SET ANSWER = ANSWER+1 , SUM = SUM+0.3 WHERE TASKID = '$taskid' ");
	if( !$query ){
	    $message  = 'error@伺服器answer失敗。';
	    die($message);
	}

	$SQLStr = sprintf( "SELECT 1_CV.USER_PHOTO FROM `1_CV` WHERE 1_CV.USERID =  '$retaskuser' " );
	$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
		while( $a = mysql_fetch_array($res) ){
			$retask_photo = $a['USER_PHOTO'];  
	}		

	echo "回覆資訊成功".'***'.$retask_photo.'***'.$taskid.'***'.$noti[1];
?>