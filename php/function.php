<?php
function Check_Notify( $u ){  # 檢查通知
	# 抓取通知
	$query = sprintf( "SELECT IS_READ FROM `1_NOTIFICATION` WHERE USERID = '$u' AND IS_READ = 0" );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@系統檢查通知出錯。';
	}
	$num = mysql_num_rows( $result );

	return 'success@'.$num;
}
function Create_Notify( $userid, $who, $task_id, $target, $url ){  # 設定通知
	$query = sprintf( "INSERT INTO `1_NOTIFICATION` (USERID, WHO, TASK_ID, TARGET, URL) VALUES ('%s', '%s', '%s', '%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($who), mysql_real_escape_string($task_id), mysql_real_escape_string($target), mysql_real_escape_string($url) );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@設定通知錯誤。';
	}
	return 'success@設定通知成功。';
}
function Get_Notify( $a ){
	# 抓取通知
	$query = sprintf( "SELECT 1_TASK.TITTLE, 1_NOTIFICATION.WHO, 1_NOTIFICATION.TASK_ID, 1_NOTIFICATION.TARGET, 1_NOTIFICATION.TIME, 1_NOTIFICATION.IS_READ, 1_NOTIFICATION.URL FROM `1_NOTIFICATION`, `1_TASK` WHERE 1_NOTIFICATION.USERID = '$a' AND 1_NOTIFICATION.TASK_ID = 1_TASK.TASKID ORDER BY `1_NOTIFICATION`.`TIME` DESC LIMIT 0 , 30" );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@@系統存取通知的資料出錯。';
	}else if( mysql_num_rows( $result ) == 0 ){
		return 'success@@0@@目前沒有通知喔。';
	}
	$noti_ary = array();
	$user_ary = array();
	while( $a = mysql_fetch_array($result) ){
		$noti_ary[] = $a['WHO'].'***'.$a['TARGET'].'***'.$a['TASK_ID'].'***'.$a['TITTLE'].'***'.$a['TIME'].'***'.$a['IS_READ'].'***'.$a['URL'];
		$user_ary[] = $a['WHO'];
	}
	$user_ary_len = count( $user_ary );
	for( $i = 0; $i < $user_ary_len; $i++ ){
		$query = sprintf( "SELECT USERNAME, USER_PHOTO FROM `1_CV` WHERE 1_CV.USERID = '$user_ary[$i]'" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@@系統存取通知的資料出錯。';
		}
		while( $a = mysql_fetch_array($result) ){
			$noti_ary[$i] .= '***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
			break;
		}
	}
	return 'success@@1@@'.$user_ary_len.'@@'.json_encode( (object)$noti_ary );
}
function Show_Search_CV( $a ){
/*USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO,FOLLOWERS,VIEWERS,M_SCORE */
/*  0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13  ,    14    ,    15   ,   16   ,   17   */
	$b_info = json_decode( $_COOKIE['UserInfo'], true );
	$b = $b_info['userid'];
	$temp_ary = json_decode( $a, true );
	$temp_ary_len = count( $temp_ary );
	for( $i=0; $i<$temp_ary_len; $i++ ){
		$f = explode( '***', $temp_ary[$i] );
		$html .= '<section class="s_cv_item">
					<section class="left">
						<img title="'.$f[0].'" src="../photo/'.$f[14].'">
					</section>
					<section class="center">
						<div class="title"><a data-pjax="profile" href="../profile/index.php?stream=about&u='.$f[0].'&v='.$b.'">'.$f[1].'</a></div>
						<div class="context">Followers: <span>'.$f[15].'</span></div>
					</section>
					<section class="right">
						<div _btn="goto" class="bottom chinese" user-id="'.$f[0].'">一窺究竟</div>
					</section>
				</section>';
	}
	return '<div style="position: relative;width: 96%;margin: 10px 2%;"><article id="search_cv_wrapper">'.$html.'</article></div>';
}
function Search_CV( $a ){    # 搜尋帳戶
	$user_ary = array();
	$query = sprintf( "SELECT USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO,FOLLOWERS,VIEWERS FROM `1_CV` WHERE 1_CV.USERNAME LIKE '%s' OR 1_CV.EMAIL = '$a'", '%'.$a.'%');
	$result = mysql_query($query);
	if( !$result ){
		return 'error@@搜尋資訊錯誤。';
	}else if( mysql_num_rows( $result ) == 0 ){
		return 'success@@0@@沒有相關結果';
	}
	while( $a = mysql_fetch_array($result) ){
		$user_ary[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['EMAIL'].'***'.$a['GENDER'].'***'.$a['DEPARTMENT'].'***'.$a['JOIN_TIME'].'***'.$a['SKILL'].'***'.$a['MOTTO'].'***'.$a['NEED'].'***'.$a['ABOUT_ME'].'***'.$a['EXPERIENCE'].'***'.$a['LASTUSING_TIME'].'***'.$a['SCORE'].'***'.$a['USERIP'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'].'***'.$a['VIEWERS'];
	}
	return 'success@@1@@'.json_encode( (object)$user_ary );
}
function Show_Master( $a ){    # 顯示神人資料
	/* USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO,FOLLOWERS,VIEWERS,M_SCORE */
	/*    0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13  ,    14    ,    15   ,   16   ,   17   */
	$ary_data = json_decode( $a, true );
	$count = 0;
	$html = '';
	$u_info = json_decode( $_COOKIE['UserInfo'], true );
	$userid = $u_info['userid'];
	$count = count( $ary_data );
	for( $i=0; $i<$count; $i++ ){
		$a = explode( '***', $ary_data[$i] );
		$b = explode( ',', $a[6] );

		$photo = '../photo/'.$a[14].'?rand='.rand();
		$html .= '<section class="learn_item master" master-id="'.$a[0].'">
					<div class="learn_item_left">
						<img src="';
						$html .= $photo.'" alt="loading" title="'.$a[7].'。<p>'.$a[16].' viewers : '.$a[15].' followers</p>"/>
					</div>
					<div class="learn_item_right">
						<a class="learn_item_more" href="../profile/index.php?stream=about&u=';
							$html = $html . $a[0] . '&v=' . $userid;
						$html .= '" data-pjax="profile" title="履歷">&gt; more...</a>
						<div class="details">
							<dl>
								<dt class="learn_user-';
									$html .= CheckGender( $a[3] );
									$score_ary = CheckScore( $a[12] );
						$html .= '">&nbsp;</dt>
								<dd itemprop="user">'.$a[1].'</dd>
							</dl>
							<dl class="learn_score">
								<span class="badge1"></span>
									<span _badge="gold" class="badgecount">'.$score_ary['gold'].'</span>
									<span class="badge2"></span>
									<span _badge="silver" class="badgecount">'.$score_ary['silver'].'</span>
									<span class="badge3"></span>
									<span _badge="copper" class="badgecount">'.$score_ary['copper'].'</span>
							</dl>
							<dl>
								<dt class="learn_education">&nbsp;</dt>
								<dd itemprop="education">';
									$html .= $a[4];
						$html .= '</dd>
							</dl>
							<dl class="dom_hidden">
								<dt class="learn_email">&nbsp;</dt>
								<dd itemprop="email">
									<a class="a_learn_email">'.$a[2].'</a>
								</dd>
							</dl>
							<dl>
								<dt class="learn_join">&nbsp;</dt>
								<dd itemprop="join">
									<span class="learn_join_label">Joined on </span>
									<span>'.$a[5].'</span>
								</dd>
							</dl>
							<dl>
								<dt class="learn_skill">&nbsp;</dt>
								<dd itemprop="skill" class="learn_skill_data">';
									for( $j=0; $j<count($b); $j++ ){ $html .= '<span>'.$b[$j].'</span>'; }
						$html .= '</dd>
							</dl>
						</div>
						<div class="others">
							<p itemprop="motto">'.$a[7].'</p>
							<strong>Score:<span itemprop="motto-score">'.$a[17].'</span></strong>
						</div>
					</div>
				</section>';
	}
	return '<h2>I\'m the God of the World.</h2><div id="learn_master">'.$html.'</div>';
}
function Get_Master(){    # 抓神人資料
	$master_ary = array();
	$user_ary = array();

	# 取得神人資訊
	$query = sprintf( "SELECT USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO,FOLLOWERS,VIEWERS FROM `1_CV` WHERE IS_MASTER = '1' ORDER BY SCORE DESC" );
	$result = mysql_query($query) or die('error@取得神人資訊錯誤。');
	while( $a = mysql_fetch_array($result) ){
		$master_ary[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['EMAIL'].'***'.$a['GENDER'].'***'.$a['DEPARTMENT'].'***'.$a['JOIN_TIME'].'***'.$a['SKILL'].'***'.$a['MOTTO'].'***'.$a['NEED'].'***'.$a['ABOUT_ME'].'***'.$a['EXPERIENCE'].'***'.$a['LASTUSING_TIME'].'***'.$a['SCORE'].'***'.$a['USERIP'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'].'***'.$a['VIEWERS'];
		$user_ary[] = $a['USERID'];
	}

	# 取得 motto 分數
	$user_ary_len = count($user_ary);
	for( $i=0; $i<$user_ary_len; $i++ ){
		$a = $user_ary[$i];
		$query = sprintf( "SELECT M_SCORE FROM `1_MOTTO` WHERE USERID = '$a'" );
		$result = mysql_query($query) or die('error@取得神人資訊錯誤。');
		if( mysql_num_rows( $result ) > 0 ){
			while( $a = mysql_fetch_array($result) ){
				$master_ary[$i] = $master_ary[$i].'***'.$a['M_SCORE'];
			}
		}else{
			$master_ary[$i] = $master_ary[$i].'***0';
		}
	}

	return 'success@@'.json_encode( (object)$master_ary ).'@@'.json_encode( (object)$user_ary );
}
function Check_Master($time){    # 
	$master_str = '';
	$user_str = '';
	$is_another = 0;
	$master_ary = array();
	
	# 取得 master list
	$query = sprintf( "SELECT MASTERID, MASTER_TIME FROM `1_MASTER` ORDER BY MASTER_TIME DESC LIMIT 1" );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@取得神人清單錯誤。';
	}
	if( mysql_num_rows( $result ) > 0 ){    # 有資料
		while( $a = mysql_fetch_array($result) ){
			if( abs( strtotime($a['MASTER_TIME'])-strtotime($time) ) > 0 ){
				$is_another = 1;
			}else{
				$time = $a['MASTER_TIME'];
			}
			$master_str = $a['MASTERID'];
		}
	}else{    # 沒有資料
		$is_another = 2;
	}
	
	if( $is_another == 1 || $is_another == 2 ){
		# 取得 user id of master
		$query = sprintf( "SELECT USERID, SCORE FROM `1_CV` ORDER BY SCORE DESC LIMIT 12" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@取得神人資訊錯誤。';
		}
		while( $a = mysql_fetch_array($result) ){
			$user_str = $user_str.','.$a['USERID'];
			$master_ary[] = $a['USERID'];
		}
		$user_str = substr( $user_str, 1, strlen( $user_str ) );

		# 設定 神人清單
		$query = sprintf( "INSERT INTO `1_MASTER` (MASTERID, MASTER_TIME) VALUES ('%s', '%s')", mysql_real_escape_string($user_str), mysql_real_escape_string($time) );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@設定神人清單錯誤。';
		}
		$master_str = $user_str;
		
		// 重設 神人清單
		$query = sprintf( "UPDATE `1_CV` SET IS_MASTER = '0'" );
		$result = mysql_query($query) or die('error@重設神人清單錯誤。');
		if( !$result ){
			return 'error@重設神人清單錯誤。';
		}

		$master_ary_len = count( $master_ary );
		for( $i=0; $i<$master_ary_len; $i++ ){
			$query = sprintf( "UPDATE `1_CV` SET IS_MASTER = '1' WHERE USERID = '$master_ary[$i]'" );
			$result = mysql_query($query) or die('error@設定神人資訊錯誤。');
			if( !$result ){
				return 'error@設定神人資訊錯誤。';
			}
		}
		unset( $master_ary_len );
	}

	return 'success@'.$is_another.'@'.$master_str.'@'.$time;
}
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
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 發問任務清單 失敗。';
	}
	while( $a = mysql_fetch_array($result) ){
		$po_task_ary[] = $a['TASKID'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'];
	}
	$query = sprintf( "SELECT USERNAME, USER_PHOTO FROM `1_CV` WHERE USERID = '$userid' LIMIT 1" );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 發問任務清單 失敗。';
	}
	while( $a = mysql_fetch_array($result) ){
		$po_task_user_ary[] = $userid.'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'];
		break;
	}

	# 抓 回覆
	$query = sprintf( "SELECT distinct 1_TASK.TASKPOSTERID, 1_TASK.TASKID , 1_TASK.TITTLE, 1_TASK.TIMESTAMP FROM `1_RE_TASK`, `1_TASK` WHERE 1_TASK.TASKID = 1_RE_TASK.TASKID AND 1_RE_TASK.USERID = '$userid' LIMIT $start,$end" );
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 回覆任務清單 失敗。';
	}
	while( $a = mysql_fetch_array($result) ){
		$re_task_ary[] = $a['TASKID'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'];
		$re_task_user_ary_temp[] = $a['TASKPOSTERID'];
	}
	$re_task_user_ary_temp_len = count( $re_task_user_ary_temp );
	for( $i=0; $i<$re_task_user_ary_temp_len; $i++ ){
		$query = sprintf( "SELECT USERNAME, USER_PHOTO FROM `1_CV` WHERE USERID = '$re_task_user_ary_temp[$i]' LIMIT 1" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@伺服器查詢 回覆任務清單 失敗。';
		}
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
	if( (int)$a != 0 ){    # 顯示 發問
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
	if( (int)$d != 0 ){    # 顯示 發問
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
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 關注名單 失敗。';
	}
	while( $a = mysql_fetch_array($result) ){
		$following_user_ary[] = $a['FOLLOWED'];
	}
	# 抓 正在關注 履歷
	$following_user_ary_len = count( $following_user_ary );
	for( $i=0; $i<$following_user_ary_len; $i++ ){
		$temp = $following_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query);
		if( !$result ){
		return 'error@伺服器查詢 關注名單履歷 失敗。';
	}
		while( $a = mysql_fetch_array($result) ){
			$data = $following_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@伺服器查詢 關注名單履歷 失敗。';
		}
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
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 關注名單 失敗。';
	}
	while( $a = mysql_fetch_array($result) ){
		$follower_user_ary[] = $a['FOLLOWER'];
	}
	# 抓 追隨者 履歷
	$follower_user_ary_len = count( $follower_user_ary );
	for( $i=0; $i<$follower_user_ary_len; $i++ ){
		$temp = $follower_user_ary[$i];
		$data = '';
		$query = sprintf( "SELECT USERNAME, USER_PHOTO, FOLLOWERS FROM `1_CV` WHERE USERID = '$temp'" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@伺服器查詢 關注名單履歷 失敗。';
		}
		while( $a = mysql_fetch_array($result) ){
			$data = $follower_user_ary[$i].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['FOLLOWERS'];
			break;
		}
		$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$viewerid' AND FOLLOWED = '$temp'" );
		$result = mysql_query($query);
		if( !$result ){
			return 'error@伺服器查詢 關注名單履歷 失敗。';
		}
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
	$result = mysql_query($query);
	if( !$result ){
		return 'error@伺服器查詢 開通名單 失敗。';
	}
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
		$result = mysql_query($query);
		if( !$result ){
			return 'error@伺服器查詢 開通名單履歷 失敗。';
		}
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