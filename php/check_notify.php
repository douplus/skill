<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');
	include('./function.php');
	
	echo Check_Notify( $_POST['userid'] );
?>