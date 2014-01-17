<?php
include('./db.php');

$task_select = $_POST['select'];
$post_tittle = $_POST['tittle'];
$post_content = $_POST['content'];
$task_id = $_POST['task_id'];
$task_poster_id = $_POST['task_poster_id'];

// #開始 \w字 吃到空白停住，因為空白不是字
preg_match_all('/#\w*/i',$post_content,$test);  
$a = '';
foreach ($test as $v1 ) {
	foreach ($v1 as $v2 ) {
// echo $v2.'<br>';
		$a = $a.$v2.'*';
	}
}
$tag = $a;

$query = sprintf("INSERT INTO `1_TASK` (TASKID,TITTLE,CONTENT,CLASSIFY,TASKPOSTERID) VALUES ('%s','%s','%s','%s','%s')",mysql_real_escape_string($task_id), mysql_real_escape_string($post_tittle), mysql_real_escape_string($post_content), mysql_real_escape_string($task_select), mysql_real_escape_string($task_poster_id));
$result = mysql_query($query);
if( !$result ){
    $message  = 'error@伺服器創建您的任務。';
    die($message);
}

$query = sprintf("INSERT INTO `1_TAG` (TASKID,TAG) VALUES ('%s','%s')",mysql_real_escape_string($task_id), mysql_real_escape_string($tag));
$result = mysql_query($query);
if( !$result ){
    $message  = 'error@伺服器創建TAG。';
    die($message);
}

$query = sprintf("INSERT INTO `1_INFO3_TASK` (TASKID,VIEW,ANSWER,NUM_COWORK) VALUES ('%s','%s','%s','%s')",mysql_real_escape_string($task_id), mysql_real_escape_string('0'), mysql_real_escape_string('0'), mysql_real_escape_string('0'));
$result = mysql_query($query);
if( !$result ){
    $message  = 'error@伺服器創建您的任務3資訊。';
    die($message);
}


?>