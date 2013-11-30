<?php 
	include('./db.php');

	$alltask_ary = array();
	//取得所有任務資訊
	$query = "select * from `1_TASK` ORDER BY SCORE TIMESTAMP";
	$res = mysql_query($query) or die('error@取得所有任務資訊錯誤。')
	$alltask_ary = '';
	while ($a = mysql_fetch_array($res)) {
		$alltask_ary[] = $a[TASKID].'***'.$a[TITTLE].'***'.$a[CONTENT].'***'.$a[TIMESTAMP].'***'.$a[TASKPOSTERID];
	}

	if( $alltask_ary == ''){
		echo 'error@@取得所有任務資訊錯誤。';
	}else{
		echo 'success@@'.json_encode( (object)$alltask_ary );
	}

?>