<?php
	include('../php/db.php');
	include('../php/function.php');
	
	$taskid = $_POST['taskid'];
	$checker = $_POST['checker'];
	$poster = $_POST['poster'];
	$enterer = $_POST['enterer'];
	$type = $_POST['type'];

    //按下合作後，創立待審查項目
	if ($type == 'cocheck') {
		# 推送通知
		$noti = Create_Notify( $checker , $_POST['po_id'], $taskid, '想要和您合作', '/account/index.php?stream=cowork' );
		$noti = explode( '@', $noti );

		$query = sprintf("INSERT INTO `1_TASK_CO_TEMP` (TASKID,TASK_CO_TEMP,USERID) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string('2'), mysql_real_escape_string($checker));
		$result = mysql_query($query);
		if( !$result ){
		    $message  = 'error@伺服器創建1_TASK_CO_TEMP。';
		    die($message);
		}				
		$query = sprintf("INSERT INTO `1_CHECK_TASK` (TASKID,COWORKER) VALUES ('%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($checker));
		$result = mysql_query($query);
		if( !$result ){
		    $message  = 'error@伺服器創建您的1_CHECK_TASK。';
		    die($message);
		}	

		echo '已送出合作需求，請等待對方審查';			
	}
	//按下確認後，待審查清掉，創立合作項目
	if ($type == 'cowork') {
		# 推送通知
		$noti = Create_Notify( $poster, $enterer, $taskid, '確認和您合作', '/account/index.php?stream=cowork' );
		$noti = explode( '@', $noti );
		
		$query = mysql_query("DELETE FROM `1_CHECK_TASK`  WHERE TASKID = '$taskid' AND COWORKER = '$enterer' ");
		if( !$query ){
		    $message  = 'error@伺服器checkd待審查清空失敗。';
		    die($message);
		}		
		$query = sprintf("INSERT INTO `1_COWORK_TASK` (TASKID,COWORKER,COWORK) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($enterer), mysql_real_escape_string('1'));
		$result = mysql_query($query);
		if( !$result ){
		    $message  = 'error@伺服器創建您1_COWORK_TASK。';
		    die($message);
		}
		$query = mysql_query("UPDATE `1_TASK_CO_TEMP` SET TASK_CO_TEMP = '1' WHERE TASKID = '$taskid' AND USERID = '$enterer'");
			if( !$query ){
			    $message  = 'error@伺服器cowork失敗。';
			    die($message);
			}	

		// NUM_COWORK counter
		$query = mysql_query("UPDATE `1_INFO3_TASK` SET NUM_COWORK = NUM_COWORK+1 , SUM = SUM+0.5 WHERE TASKID = '$taskid'  ");
		if( !$query ){
		    $message  = 'error@伺服器cowork失敗。';
		    die($message);
		}
		// 傳資料到 account_cowork.js 動態新增
		$query = sprintf( "SELECT 1_INFO3_TASK.VIEW,1_INFO3_TASK.ANSWER,1_INFO3_TASK.NUM_COWORK,1_CV.USER_PHOTO,1_CV.USERNAME,1_TASK.TITTLE FROM `1_INFO3_TASK`,`1_CV`,`1_TASK` WHERE 1_CV.USERID = '$poster' AND 1_TASK.TASKID = '$taskid' AND 1_INFO3_TASK.TASKID =  1_TASK.TASKID " );
		$result = mysql_query($query) or die('error@錯誤。');
			//0:VIEW 1:ANSWER 2:NUM_COWORK 3:USER_PHOTO 4:USERNAME 5:TITTLE 
			while( $a = mysql_fetch_array($result) ){
	        $dym_cowork = $a['VIEW'].'***'.$a['ANSWER'].'***'.$a['NUM_COWORK'].'***'.$a['USER_PHOTO'].'***'.$a['USERNAME'].'***'.$a['TITTLE'];
	        }			        

		echo '合作關係已建立，請至合作區查看'.'***'.$dym_cowork;
	}	
	//拒絕合作，待審查區清空
	if ($type == 'refuse') {
		# 推送通知
		$noti = Create_Notify( $poster, $enterer, $taskid, '拒絕和您合作', '/account/index.php?stream=cowork' );
		$noti = explode( '@', $noti );

		$query = mysql_query("UPDATE `1_TASK_CO_TEMP` SET TASK_CO_TEMP = '0' WHERE TASKID = '$taskid' AND USERID = '$enterer'");
			if( !$query ){
			    $message  = 'error@伺服器cowork失敗。';
			    die($message);
			}		
		$query = mysql_query("DELETE FROM `1_CHECK_TASK`  WHERE TASKID = '$taskid' AND COWORKER='$enterer' ");
		if( !$query ){
		    $message  = 'error@伺服器checkd待審查清空失敗。';
		    die($message);
		}
		$query = sprintf("INSERT INTO `1_COWORK_TASK` (TASKID,COWORKER,COWORK) VALUES ('%s','%s','%s')",mysql_real_escape_string($taskid), mysql_real_escape_string($enterer), mysql_real_escape_string('0'));
		$result = mysql_query($query);
		if( !$result ){
		    $message  = 'error@伺服器創建您拒絕1_COWORK_TASK。';
		    die($message);
		}				
		echo '取消此合作';			
	}
	//拒絕合作確認，審查區清空
	if ($type == 'confirm_refuse') {
		$query = mysql_query("DELETE FROM `1_COWORK_TASK`  WHERE TASKID = '$taskid' AND COWORKER='$poster' ");
		if( !$query ){
		    $message  = 'error@伺服器checkd待審查清空失敗。';
		    die($message);
		}		
		echo '清空合作';			
	}
	
?>