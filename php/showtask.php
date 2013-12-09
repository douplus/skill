<?php
	include('./db.php');

	$query = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_CV.USERNAME,1_CV.SKILL FROM `1_TASK`,`1_CV` WHERE 1_TASK.TASKPOSTERID = 1_CV.USERID ORDER BY 1_TASK.TIMESTAMP" );
	$result = mysql_query($query) or die('error@錯誤。');

	while( $a = mysql_fetch_array($result) ){
	$alltask_ary[] = $a['TASKID'].'***'.$a['CLASSIFY'].'***'.$a['TITTLE'].'***'.$a['USERNAME'].'***'.$a['SKILL'];
	}

	echo 'success@@'.json_encode( (object)$alltask_ary );

?>