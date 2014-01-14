<?php
	header("Content-Type:text/html; charset=utf-8");
	include('../php/db.php');

	$UserInfo = json_decode( $_COOKIE['UserInfo'], true );
	$u = $UserInfo['userid'];

	# 抓取通知
	$query = sprintf( "SELECT 1_TASK.TITTLE, 1_NOTIFICATION.WHO, 1_NOTIFICATION.TASK_ID, 1_NOTIFICATION.TARGET, 1_NOTIFICATION.TIME, 1_NOTIFICATION.IS_READ FROM `1_NOTIFICATION`, `1_TASK` WHERE 1_NOTIFICATION.USERID = '$u' AND 1_NOTIFICATION.TASK_ID = 1_TASK.TASKID" );
	$result = mysql_query($query) or die('error@系統存取通知的資料出錯。');
	$noti_ary = array();
	$user_ary = array();
	while( $a = mysql_fetch_array($result) ){
		$noti_ary[] = $a['WHO'].'***'.$a['TARGET'].'***'.$a['TASK_ID'].'***'.$a['TITTLE'].'***'.$a['TIME'].'***'.$a['IS_READ'];
		$user_ary[] = $a['WHO'];
	}
	$user_ary_len = count( $user_ary );
	for( $i = 0; $i < $user_ary_len; $i++ ){
		$query = sprintf( "SELECT USERNAME, USER_PHOTO  FROM `1_CV` WHERE 1_CV.USERID = '$user_ary[$i]'" );
		$result = mysql_query($query) or die('error@系統存取通知的資料出錯。');
		while( $a = mysql_fetch_array($result) ){
			$noti_ary[$i] .= '***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
			break;
		}
	}
	//print_r($noti_ary);
?>
<nav id="noti_nav">
	<ul id="noti_list">
		<div class="noti_back">
			<a id="noti_back" rel="noti-tipsy" onclick="javascript: window.history.back();return false;" original-title="返回"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a href="javascript: void(0);"><div class="chinese">通知</div></a></li>
	</ul>
</nav>
<div id="noti_container">
	<div>
		<article class="noti_wrapper">
			<ul>
				<!-- WHO, TARGET, TASK_ID, TITTLE, TIME, IS_READ, USERNAME, USER_PHOTO -->
				<!--  0 ,    1  ,    2   ,   3   ,  4  ,     5  ,    6    ,     7      -->
				<?php
					$temp = '';
					for( $i = 0; $i < $user_ary_len; $i++ ){
						$a = explode( '***', $noti_ary[$i] );
						$temp .= '<li>	
							<div class="thumbnail">
								<a href="../profile/index.php?stream=about&u='.$a[0].'&v='.$u.'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[7].'" title="'.$a[3].'"></a>
							</div>
							<h3 class="chinese"><a href="../profile/index.php?stream=about&u='.$a[0].'&v='.$u.'">'.$a[6].'</a> '.$a[1].' ：「 <a href="../task/discuss/index.php?task_id='.$a[2].'">'.$a[3].'</a> 」。</h3>
							<span class="date chinese">'.$a[4].'</span>
						</li>';
					}
					echo $temp;
				?>
				<!--<li>
					<div class="thumbnail">
						<a href="" title="Permalink to Google Doodle 更新迎接平安夜" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837057932.jpg?rand=0.2010142777580768" title="Google Doodle 更新迎接平安夜"></a>
					</div>
					<h3 class="chinese"><a href="">吳典陽</a> 想要和你合作 ：「 <a href="">Google Doodle 更新迎接平安夜</a> 」。</h3>
					<span class="date chinese">十二月 24, 2013</span>
				</li>-->
			</ul>
		</article>
	</div>
</div>