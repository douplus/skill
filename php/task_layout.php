<header id="account_task_select">
	<h2 class="chinese"><a _role="po" href="javascript:void(0);" id="account_task_po" class="_s">發問</a></h2>
	<h2 class="chinese"><a _role="re" href="javascript:void(0);" id="account_task_re">回覆</a></h2>
	<div class="stripe-line"></div>
</header>
<article id="account_task_wrapper" class="account_task_wrapper">
	<?php
		include_once(dirname(__FILE__).'/db.php');
		include_once(dirname(__FILE__).'/function.php');
		$task_info = Get_Task( $_userid, $_start, $_end );
		$msg = explode( '@', $task_info );
		if( $msg[0] == 'success' ){
			echo Show_Task( $msg[2], $msg[3], $msg[4], $msg[5], $msg[6], $msg[7], $_viewerid );
		}else if( $msg[0] == 'error' ){
			echo '<script>alert( '.$msg[1].' )</script>';
			exit;
		}
	?>
</article>