<?php
function Classify_Ttransform( $a, $b ){
	switch( $a ){
		case 'e_c':
			switch( $b ){
				case 'pc_and_network':
					return '電腦網路';
					break;
				case 'life':
					return '生活資訊';
					break;
				case 'mobile':
					return '行動裝置';
					break;
				case 'hobby':
					return '休閒嗜好';
					break;
				case 'travel':
					return '旅行遊玩';
					break;
				case 'food':
					return '美食相關';
					break;
				case 'design':
					return '繪畫設計';
					break;
				case 'entertainment':
					return '影音娛樂';
					break;
				case 'sport':
					return '運動健身';
					break;
				case 'human':
					return '社會人文';
					break;
				case 'business':
					return '商業金融';
					break;
				case 'education':
					return '教育相關';
					break;
				case 'science':
					return '科學常識';
					break;
				case 'troubled':
					return '煩惱心事';
					break;
				case 'health':
					return '醫療保健';
					break;
				case 'fashion':
					return '流行時尚';
					break;
				case 'game':
					return '電玩遊戲';
					break;
				default:
					break;
			}
			break;
		case 'c_e':
			switch( $b ){
				case '電腦網路':
					return 'pc_and_network';
					break;
				case '生活資訊':
					return 'life';
					break;
				case '行動裝置':
					return 'mobile';
					break;
				case '休閒嗜好':
					return 'hobby';
					break;
				case '旅行遊玩':
					return 'travel';
					break;
				case '美食相關':
					return 'food';
					break;
				case '繪畫設計':
					return 'design';
					break;
				case '影音娛樂':
					return 'entertainment';
					break;
				case '運動健身':
					return 'sport';
					break;
				case '社會人文':
					return 'human';
					break;
				case '商業金融':
					return 'business';
					break;
				case '教育相關':
					return 'education';
					break;
				case '科學常識':
					return 'science';
					break;
				case '煩惱心事':
					return 'troubled';
					break;
				case '醫療保健':
					return 'health';
					break;
				case '流行時尚':
					return 'fashion';
					break;
				case '電玩遊戲':
					return 'game';
					break;
				default:
					break;
			}
			break;
		default:
			break;
	}
}
function Get_Task( $userid, $start, $end ){
	$re_task_user_ary = array();
	$re_task_user_ary_temp = array();
	$re_task_ary = array();
	$po_task_user_ary = array();
	$po_task_ary = array();

	# 抓 發問
	$query = sprintf( "SELECT TASKID, TITTLE, TIMESTAMP FROM `1_TASK` WHERE TASKPOSTERID = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 發問任務清單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$po_task_ary[] = $a['TASKID'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'];
	}
	$query = sprintf( "SELECT USERNAME, USER_PHOTO FROM `1_CV` WHERE USERID = '$userid' LIMIT 1" );
	$result = mysql_query($query) or die('error@伺服器查詢 發問任務清單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$po_task_user_ary[] = $userid.'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
		break;
	}

	# 抓 回覆
	$query = sprintf( "SELECT distinct 1_TASK.TASKPOSTERID, 1_TASK.TASKID , 1_TASK.TITTLE, 1_TASK.TIMESTAMP FROM `1_RE_TASK`, `1_TASK` WHERE 1_TASK.TASKID = 1_RE_TASK.TASKID AND 1_RE_TASK.USERID = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 回覆任務清單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$re_task_ary[] = $a['TASKID'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'];
		$re_task_user_ary_temp[] = $a['TASKPOSTERID'];
	}
	$re_task_user_ary_temp_len = count( $re_task_user_ary_temp );
	for( $i=0; $i<$re_task_user_ary_temp_len; $i++ ){
		$query = sprintf( "SELECT USERNAME, USER_PHOTO FROM `1_CV` WHERE USERID = '$re_task_user_ary_temp[$i]' LIMIT 1" );
		$result = mysql_query($query) or die('error@伺服器查詢 回覆任務清單 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$re_task_user_ary[] = $re_task_user_ary_temp[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
			break;
		}
	}

	return 'success@查詢 任務清單 成功。@'.count( $po_task_ary ).'@'.json_encode( (object)$po_task_ary ).'@'.json_encode( (object)$po_task_user_ary ).'@'.count( $re_task_ary ).'@'.json_encode( (object)$re_task_ary ).'@'.json_encode( (object)$re_task_user_ary );
}
function Show_Task( $a, $b, $c, $d, $e, $f, $g ){
	$temp1 = '';
	$temp2 = '';
	if( (int)$a != 0 ){  // 顯示 發問
		$o_po = json_decode( $b, true );
		$o_po_er = json_decode( $c, true );
		$j = explode( '***', $o_po_er[0] );
		for( $i=0; $i<(int)$a; $i++ ){
			$h = explode( '***', $o_po[$i] );
			$temp1 .= '<li>	
					<h3 class="chinese"><a data-pjax="profile" href="../profile/index.php?stream=about&u='.$j[0].'&v='.$g.'">我</a> ：「 <a href="../task/discuss/index.php?task_id='.$h[0].'">'.$h[1].'</a> 」。</h3>
					<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>
					<br>
					<span class="date chinese">'.$h[2].'</span>
				</li>';
		}
	}else{
		$temp1 = '<li class="chinese">沒有發問任務。</li>';
	}
	if( (int)$d != 0 ){  // 顯示 發問
		$o_re = json_decode( $e, true );
		$o_re_er = json_decode( $f, true );
		for( $i=0; $i<(int)$d; $i++ ){
			$h = explode( '***', $o_re[$i] );
			$j = explode( '***', $o_re_er[$i] );
			$temp2 .= '<li>	
				<div class="thumbnail">
					<a href="../profile/index.php?stream=about&u='.$j[0].'&v='.$g.'" title="'.$h[1].'"><img width="50" height="50" src="../photo/'.$j[2].'" title="'.$h[1].'"></a>
				</div>
				<h3 class="chinese"><a href="../profile/index.php?stream=about&u='.$j[0].'&v='.$g.'">'.$j[1].'</a> ：「 <a href="../task/discuss/index.php?task_id='.$h[0].'">'.$h[1].'</a> 」。</h3>
				<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>
				<br>
				<span class="date chinese">'.$h[2].'</span>
			</li>';
		}
	}else{
		$temp2 = '<li class="chinese">沒有回覆任務。</li>';
	}
	return '<ul _role="po" num="'.$a.'">'.$temp1.'</ul><ul _role="re" num="'.$d.'" style="display: none;">'.$temp2.'</ul>';
}
function Get_Follow( $userid, $viewerid, $start, $end  ){
	# 抓 正在關注
	$following_ary = array();
	$following_user_ary = array();
	$query = sprintf( "SELECT FOLLOWED FROM `1_FOLLOW` WHERE FOLLOWER = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$following_user_ary[] = $a['FOLLOWED'];
	}
	# 抓 正在關注 履歷
	$following_user_ary_len = count( $following_user_ary );
	for( $i=0; $i<$following_user_ary_len; $i++ ){
		$temp = $following_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$data = $following_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		if( mysql_num_rows( $result ) > 0 ){  # 之前已關注
			$data = $data.'***yes';
		}else{  # 之前尚未關注
			$data = $data.'***no';
		}
		$following_ary[] = $data;
	}
	
	# 抓 追隨者
	$follower_ary = array();
	$follower_user_ary = array();
	$query = sprintf( "SELECT FOLLOWER FROM `1_FOLLOW` WHERE FOLLOWED = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		$follower_user_ary[] = $a['FOLLOWER'];
	}
	# 抓 追隨者 履歷
	$follower_user_ary_len = count( $follower_user_ary );
	for( $i=0; $i<$follower_user_ary_len; $i++ ){
		$temp = $follower_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$data = $follower_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 關注名單履歷 失敗。');
		if( mysql_num_rows( $result ) > 0 ){  # 之前已關注
			$data = $data.'***yes';
		}else{  # 之前尚未關注
			$data = $data.'***no';
		}
		$follower_ary[] = $data;
	}
	
	# 抓 已開通
	$activate_ary = array();
	$activate_user_ary = array();
	$query = sprintf( "SELECT * FROM `1_ACTIVATE` WHERE ACTIVATER = '$userid' OR ACTIVATED = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器查詢 開通名單 失敗。');
	while( $a = mysql_fetch_array($result) ){
		if( $a['ACTIVATER'] === $userid ){
			$activate_user_ary[] = $a['ACTIVATED'];
		}else if( $a['ACTIVATED'] === $userid ){
			$activate_user_ary[] = $a['ACTIVATER'];
		}
	}
	# 抓 已開通 履歷
	$following_user_ary_len = count( $activate_user_ary );
	for( $i=0; $i<$following_user_ary_len; $i++ ){
		$temp = $activate_user_ary[$i];
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query) or die('error@伺服器查詢 開通名單履歷 失敗。');
		while( $a = mysql_fetch_array($result) ){
			$activate_ary[] = $activate_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
	}
	
	return 'success@查詢 關注名單 成功。@'.count( $following_ary ).'@'.json_encode( (object)$following_ary ).'@'.count( $follower_ary ).'@'.json_encode( (object)$follower_ary ).'@'.count( $activate_ary ).'@'.json_encode( (object)$activate_ary );
}
function ShowFollow( $a, $b, $c, $d, $e, $g, $h ){
	/* USERID, USERNAME, USER_PHOTO, FOLLOWERS, IS_FOLLOW(yes/no) */
	/*    0  ,     1   ,      2    ,     3    ,         4         */
	$temp1 = '';
	$temp2 = '';
	$temp3 = '';
	if( (int)$a != 0 ){  // 顯示關注中
		$o_following = json_decode( $b, true );
		for( $i=0; $i<(int)$a; $i++ ){
			$f = explode( '***', $o_following[$i] );
			$temp1 .= '<section class="follow_item">
						<section class="left">
							<img title="'.$f[1].'" src="../photo/'.$f[2].'">
						</section>
						<section class="center">
							<div class="title"><a data-pjax="profile" href="../profile/index.php?stream=about&u='.$f[0].'&v='.$e.'">'.$f[1].'</a></div>
							<div class="context">Followers: <span>'.$f[3].'</span></div>
						</section>
						<section class="right">';
				if( $f[0] === $e ){
				}else if( $f[4] === 'yes' ){
					$temp1 .= '<div _btn="follow" class="bottom chinese dom_hidden" user-id="'.$f[0].'">關注</div><div _btn="unfollow" class="bottom chinese" user-id="'.$f[0].'">取消關注</div>';
				}else{
					$temp1 .= '<div _btn="follow" class="bottom chinese" user-id="'.$f[0].'">關注</div><div _btn="unfollow" class="bottom chinese dom_hidden" user-id="'.$f[0].'">取消關注</div>';
				}
			$temp1 .= '</section></section>';
		}
	}else{
		$temp1 = '<section class="follow_item chinese">沒有正在關注的對象。</section>';
	}
	if( (int)$c != 0 ){  // 顯示追隨者
		$o_follower = json_decode( $d, true );
		for( $i=0; $i<(int)$c; $i++ ){
			$f = explode( '***', $o_follower[$i] );
			$temp2 .= '<section class="follow_item">
						<section class="left">
							<img title="'.$f[1].'" src="../photo/'.$f[2].'">
						</section>
						<section class="center">
							<div class="title"><a data-pjax="profile" href="../profile/index.php?stream=about&u='.$f[0].'&v='.$e.'">'.$f[1].'</a></div>
							<div class="context">Followers: <span>'.$f[3].'</span></div>
						</section>
						<section class="right">';
				if( $f[0] === $e ){
				}else if( $f[4] === 'yes' ){
					$temp2 .= '<div _btn="follow" class="bottom chinese dom_hidden" user-id="'.$f[0].'">關注</div><div _btn="unfollow" class="bottom chinese" user-id="'.$f[0].'">取消關注</div>';
				}else{
					$temp2 .= '<div _btn="follow" class="bottom chinese" user-id="'.$f[0].'">關注</div><div _btn="unfollow" class="bottom chinese dom_hidden" user-id="'.$f[0].'">取消關注</div>';
				}
			$temp2 .= '</section></section>';
		}
	}else{
		$temp2 = '<section class="follow_item chinese">沒有追隨者。</section>';
	}
	if( (int)$g != 0 ){  // 顯示 已開通
		$o_activated = json_decode( $h, true );
		for( $i=0; $i<(int)$g; $i++ ){
			$f = explode( '***', $o_activated[$i] );
			$temp3 .= '<section class="follow_item">
						<section class="left">
							<img title="'.$f[1].'" src="../photo/'.$f[2].'">
						</section>
						<section class="center">
							<div class="title"><a data-pjax="profile" href="../profile/index.php?stream=about&u='.$f[0].'&v='.$e.'">'.$f[1].'</a></div>
							<div class="context">Followers: <span>'.$f[3].'</span></div>
						</section>
					</section>';
		}
	}else{
		$temp3 = '<section class="follow_item chinese">沒有開通紀錄。</section>';
	}
	return '<article id="following" num="'.$a.'">'.$temp1.'</article>'.'<article id="follower" num="'.$c.'" style="display:none;">'.$temp2.'</article>'.'<article id="activated" num="'.$g.'" style="display:none;">'.$temp3.'</article>';
}
function CheckGender($a){
	if( (int)$a == 1 ){  // 男
		return 'male';
	}else if( (int)$a == 2 ){  // 女
		return 'female';
	}else{  // 組織
		return 'organization';
	}
}
function CheckScore($a){
	$copper = ((int)$a)%1000;
	$temp = ((int)$a)/1000;
	$gold = floor( $temp/10 );
	$silver = floor( $temp )%10;
	$score_ary = array( 'gold'=>$gold, 'silver'=>$silver, 'copper'=>$copper );
	return $score_ary;
}
?>