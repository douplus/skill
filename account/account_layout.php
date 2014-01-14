<?php
	header("Content-Type:text/html; charset=utf-8");

	$stream = isset( $_GET['stream'] ) ? $_GET['stream'] : '';
	switch( $stream ){
		case 'about':
			include_once(dirname(__FILE__).'/account_about.php');
			break;
		case 'task':
			include_once(dirname(__FILE__).'/account_task.php');
			break;
		case 'cowork':
			include_once(dirname(__FILE__).'/account_cowork.php');
			break;
		case 'follow':
			include_once(dirname(__FILE__).'/account_follow.php');
			break;
		default:
			echo '<script>window.location.href = "./index.php?stream=about"</script>';
			exit;
		break;
	}
?>