<?php 
        include('./db.php');

	session_start(); 	
	$taskid = $_SESSION['task_id'];        
        //取得所有回復資訊
        $query = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO FROM `1_RE_TASK`,`1_CV` WHERE 1_RE_TASK.USERID = 1_CV.USERID AND 1_RE_TASK.TASKID =  '$taskid'  ORDER BY 1_RE_TASK.TIMESTAMP" );
        // $query = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO FROM 1_RE_TASK INNER JOIN  1_TASK ON 1_RE_TASK.TASKID = 1_TASK.TASKID INNER JOIN  1_CV ON  1_RE_TASK.USERID = 1_CV.USERID  WHERE 1_RE_TASK.TASKID = 1_TASK.TASKID ORDER BY 1_RE_TASK.TIMESTAMP" );
      
        $result = mysql_query($query) or die('error@錯誤。');

        while( $a = mysql_fetch_array($result) ){
        $allretask_ary[] = $a['CONTENT'].'***'.$a['TIMESTAMP'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
        }
        echo 'success@@'.json_encode( (object)$allretask_ary ); 
?>