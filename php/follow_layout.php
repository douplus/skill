<<<<<<< HEAD
<article id="follow_wrapper">
	<header id="follow_select">
		<div _role="following" class="_s">正在關注</div>
		<div _role="follower">追隨者</div>
		<div _role="activated">已開通</div>
	</header>
	<?php
		include_once(dirname(__FILE__).'/db.php');
		include_once(dirname(__FILE__).'/function.php');
		$follow_info = Get_Follow( $_userid, $_viewerid, $_start, $_end  );
		$msg = explode( '@', $follow_info );
		if( $msg[0] == 'success' ){
			echo ShowFollow( $msg[2], $msg[3], $msg[4], $msg[5], $_viewerid, $msg[6], $msg[7] );
		}else if( $msg[0] == 'error' ){
			echo '<script>alert( '.$msg[1].' )</script>';
			exit;
		}
	?>
=======
<article id="follow_wrapper">
	<header id="follow_select">
		<div _role="following" class="_s">正在關注</div>
		<div _role="follower">追隨者</div>
		<div _role="activated">已開通</div>
	</header>
	<?php
		include_once(dirname(__FILE__).'/db.php');
		include_once(dirname(__FILE__).'/function.php');
		$follow_info = Get_Follow( $_userid, $_viewerid, $_start, $_end  );
		$msg = explode( '@', $follow_info );
		if( $msg[0] == 'success' ){
			echo ShowFollow( $msg[2], $msg[3], $msg[4], $msg[5], $_viewerid, $msg[6], $msg[7] );
		}else if( $msg[0] == 'error' ){
			echo '<script>alert( '.$msg[1].' )</script>';
			exit;
		}
	?>
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
</article>