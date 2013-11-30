<?php
	include('./db.php');


	$taskid = 't_1385748264801';
	$SQLStr = "select * from `1_TASK` where TASKID = '$taskid'";
	$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤。');
	$task_ary = '';
	while( $a = mysql_fetch_array($res) ){
		$task_ary = $taskid.'***'.$a['CLASSIFY'].'***'.$a['TITTLE'].'***'.$a['CONTENT'].'***'.$a['TIMESTAMP'];
		$TASKPOSTERID = $a['TASKPOSTERID'];
    break;
	}


  $SQLStr = "select DEPARTMENT,USERNAME,SKILL,SCORE,USER_PHOTO from `1_CV` where USERID = '$TASKPOSTERID'";
    $res = mysql_query($SQLStr) or die('error@取得使用者資訊錯誤。');
  $user_ary ='';
  while( $a = mysql_fetch_array($res) ){
    $user_ary = $a['USERNAME'].'***'.$a['DEPARTMENT'].'***'.$a['SKILL'].'***'.$a['SCORE'].'***'.$a['USER_PHOTO'];
    break;
  }
	if( $user_ary == '' || $task_ary == '' ){
		echo 'error@@取得任務資訊錯誤。';
	}else{
		echo 'success@@'.$user_ary.'@@'.$task_ary;
	}
?>