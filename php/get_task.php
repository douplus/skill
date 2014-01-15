
<?php
	include('../../php/db.php');

	session_start(); 

	$taskid = $_GET['task_id'];
	$userinfo = $_COOKIE['UserInfo'];
	$a = json_decode($userinfo);
	$userid = $a -> userid;

	$SQLStr = "select USER_PHOTO from `1_CV` where USERID = '$userid'";
	$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
		while( $a = mysql_fetch_array($res) ){
			$user_img = $a['USER_PHOTO'];
	    break;
	}	

	$SQLStr = "select * from `1_TASK` where TASKID = '$taskid'";
	$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤2。');
	$task_ary = '';
		while( $a = mysql_fetch_array($res) ){
			$task_ary = $taskid.'***'.$a['CLASSIFY'].'***'.$a['TITTLE'].'***'.$a['CONTENT'].'***'.$a['TIMESTAMP'];
			$TASKPOSTERID = $a['TASKPOSTERID'];
	    break;
	}

  	$SQLStr = "select DEPARTMENT,USERNAME,SKILL,SCORE,USER_PHOTO from `1_CV` where USERID = '$TASKPOSTERID'";
    $res = mysql_query($SQLStr) or die('error@取得使用者資訊錯誤3。');
 	$user_ary ='';
	 	while( $a = mysql_fetch_array($res) ){
	    $user_ary = $a['USERNAME'].'***'.$a['DEPARTMENT'].'***'.$a['SKILL'].'***'.$a['SCORE'].'***'.$a['USER_PHOTO'];
	    break;
  	}
		if( $user_ary == '' || $task_ary == '' ){
			echo 'error@@取得任務資訊錯誤4。';
		}

	/*USERNAME, DEPARTMENT, SKILL, SCORE, USER_PHOTO*/
	$user = explode("***", $user_ary);
	/*TASKID, CLASSIFY, TITTLE, CONTENT, TIMESTAMP*/
	$b = explode("***", $task_ary);

	$photo = '../../photo/'.$user[4];
	$skill = explode(',', $user[2]);
	$date = str_split($b[4]);
	$skilllengh=count($skill);
	$html = '';
	for ($i=0; $i < $skilllengh; $i++) { 
		$html .= '<span id ="aa">'.$skill[$i].'</span>';
	}
	$date = $date[5].$date[6].' / '.$date[8].$date[9].' At '.$date[11].$date[12].' : '.$date[14].$date[15];
	$user_img = '../../photo/'.$user_img;
?>



