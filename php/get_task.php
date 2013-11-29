<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');
	
	$TASKID = $_GET['TASKID'];
  $SQLStr = "select * from 1_TASK where TASKID = '$TASKID'";

  $res = mysql_query($SQLStr);
  $row = mysql_fetch_array($res) or die('error@取得神人資訊錯誤。');


  $CLASSIFY = $row['CLASSIFY'];
  $TITLE = $row['TITLE'];
  $CONTENT = $row['CONTENT'];
  $TIMESTAMP = $row['TIMESTAMP'];

  $temp = array(
	  'TASKID'    => $TASKID,
	  'CLASSIFY'  => $CLASSIFY,
	  'TITLE' => $TITLE,
	  'CONTENT'  => $CONTENT,
	  'TIMESTAMP' => $TIMESTAMP	  
  );
  $json = json_encode($temp);
		echo $json;  
?>