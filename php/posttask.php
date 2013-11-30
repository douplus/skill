
<?php
include('./db.php');

$task_select = $_POST['select'];
$post_tittle = $_POST['tittle'];
$post_content = $_POST['content'];
$task_id = $_POST['task_id'];
$task_poster_id = $_POST['task_poster_id'];

$query = sprintf("INSERT INTO `1_TASK` (TASKID,TITTLE,CONTENT,CLASSIFY,TASKPOSTERID) VALUES ('%s','%s','%s','%s','%s')",mysql_real_escape_string($task_id), mysql_real_escape_string($post_tittle), mysql_real_escape_string($post_content), mysql_real_escape_string($task_select), mysql_real_escape_string($task_poster_id));
$result = mysql_query($query);
if( !$result ){
    $message  = 'error@伺服器創建您的任務。';
    die($message);
}

echo $post_tittle;
?>