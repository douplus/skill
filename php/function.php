<?php
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