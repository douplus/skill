<?php
	header("Content-Type:text/html; charset=utf-8");
	include(dirname(__FILE__).'/db.php');
	include(dirname(__FILE__).'/function.php');

	$userid = $_POST['userid'];
	$viewerid = $_POST['viewerid'];
	$start = (int)$_POST['start'];
	$end = $start+30;

	echo Get_Follow( $userid, $viewerid, $start, $end  );
?>