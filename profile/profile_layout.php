<?php
	header("Content-Type:text/html; charset=utf-8");
	include_once(dirname(__FILE__).'/../php/db.php');
	include_once(dirname(__FILE__).'/../php/function.php');

	# 檢查帳號
	$query = sprintf( "SELECT USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO,VIEWERS FROM `1_CV` WHERE USERID = '$u'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	if( mysql_num_rows($result) == 1 ){
		$user_ary = array();
		while( $a = mysql_fetch_array($result) ){
			$user_ary['USERID'] = $a['USERID'];
			$user_ary['USERNAME'] = $a['USERNAME'];
			$user_ary['EMAIL'] = $a['EMAIL'];
			$user_ary['GENDER'] = $a['GENDER'];
			$user_ary['DEPARTMENT'] = $a['DEPARTMENT'];
			$user_ary['JOIN_TIME'] = $a['JOIN_TIME'];
			$user_ary['SKILL'] = $a['SKILL'];
			$user_ary['MOTTO'] = $a['MOTTO'];
			$user_ary['NEED'] = $a['NEED'];
			$user_ary['ABOUT_ME'] = $a['ABOUT_ME'];
			$user_ary['EXPERIENCE'] = $a['EXPERIENCE'];
			$user_ary['LASTUSING_TIME'] = $a['LASTUSING_TIME'];
			$user_ary['SCORE'] = $a['SCORE'];
			$user_ary['USERIP'] = $a['USERIP'];
			$user_ary['USER_PHOTO'] = $a['USER_PHOTO'];
			$user_ary['VIEWERS'] = $a['VIEWERS'];
			break;
		}
	}else{
		echo '<script>alert("載入資訊發生錯誤。");</script>';
		echo '<script>window.location.href = "../master/index.php"</script>';
		exit;
	}
	
	# 檢查觀看者帳號
	$query = sprintf( "SELECT USERNAME,USER_PHOTO,FOLLOWERS,VIEWERS FROM `1_CV` WHERE USERID = '$v'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	if( mysql_num_rows($result) == 1 ){
		$viewer_ary = array();
		while( $a = mysql_fetch_array($result) ){
			$viewer_ary['USERNAME'] = $a['USERNAME'];
			$viewer_ary['USER_PHOTO'] = $a['USER_PHOTO'];
			$viewer_ary['FOLLOWERS'] = $a['FOLLOWERS'];
			$viewer_ary['VIEWERS'] = $a['VIEWERS'];
			break;
		}
	}else{
		echo '<script>alert("載入資訊發生錯誤。");</script>';
		echo '<script>window.location.href = "../master/index.php"</script>';
		exit;
	}
	
	$new_view = (int)$user_ary['VIEWERS'];
	$new_score = (float)$user_ary['SCORE'];
	if( $v != $u ){  # 設定 viewers
		$new_view += 1;
		$new_score += 0.1;
		$query = sprintf( "UPDATE `1_CV` SET VIEWERS = VIEWERS + 1, SCORE = '$new_score' WHERE USERID = '$u'" );
		$result = mysql_query($query) or die('error@伺服器設定 viewers & score 失敗。');
	}
	
	# 檢查 關注
	$query = sprintf( "SELECT * FROM `1_FOLLOW` WHERE FOLLOWER = '$v' AND FOLLOWED = '$u'" );
	$result = mysql_query($query) or die('error@伺服器查詢 關注 失敗。');
	if( mysql_num_rows( $result ) > 0 ){  # 已關注
		$is_follow = 'yes';
	}else{  # 尚未關注
		$is_follow = 'no';
	}
	
	# 檢查 開通
	$query = sprintf( "SELECT * FROM `1_ACTIVATE` WHERE (ACTIVATER = '$u' AND ACTIVATED = '$v') OR (ACTIVATER = '$v' AND ACTIVATED = '$u')" );
	$result = mysql_query($query) or die('error@伺服器查詢 開通 失敗。');
	if( mysql_num_rows( $result ) > 0 ){  # 已關注
		$is_activate = 'yes';
	}else{  # 尚未關注
		$is_activate = 'no';
	}
?>
<nav id="cv_nav">
	<section>
		<img id="change_cv_img" class="cv_img" src="<?php echo '../photo/'.$user_ary['USER_PHOTO'];?>" alt="none" original-title="點擊變更我的大頭像"/>
		<div class="cv_user">
			<dl>
				<dt class="cv_user-<?php echo CheckGender( $user_ary['GENDER'] );?>">&nbsp;</dt>
				<dd class="chinese" itemprop="user" title="<?php echo 'viewers: '.$new_view;?>"><?php echo $user_ary['USERNAME']; ?></dd>
			</dl>
			<div class="cv_score">
				<?php 
					$score_ary_temp = CheckScore( $new_score );
					echo '<span class="badge1"></span>';
					echo '<span _badge="gold" class="badgecount">'.$score_ary_temp['gold'].'</span> ';
					echo '<span class="badge2"></span>';
					echo '<span _badge="silver" class="badgecount">'.$score_ary_temp['silver'].'</span>';
					echo '<span class="badge3"></span>';
					echo '<span _badge="copper" class="badgecount">'.$score_ary_temp['copper'].'</span>  ';
					unset( $score_ary_temp );
				?>                            
			</div>
			<?php
				if( $v === $u ){  # 
					echo '<input id="cv_follow" class="chinese" type="hidden" value="關注" user-id="'.$user_ary['USERID'].'">';
					echo '<input id="cv_unfollow" class="chinese" type="hidden" value="取消關注" user-id="'.$user_ary['USERID'].'">';
				}else if( $is_follow === 'yes' ){
					echo '<input id="cv_follow" class="chinese dom_hidden" type="button" value="關注" user-id="'.$user_ary['USERID'].'">';
					echo '<input id="cv_unfollow" class="chinese" type="button" value="取消關注" user-id="'.$user_ary['USERID'].'">';
				}else if( $is_follow === 'no' ){
					echo '<input id="cv_follow" class="chinese" type="button" value="關注" user-id="'.$user_ary['USERID'].'">';
					echo '<input id="cv_unfollow" class="chinese dom_hidden" type="button" value="取消關注" user-id="'.$user_ary['USERID'].'">';
				}
				if( $v === $u ){  # 
					echo '<input id="cv_activate" class="chinese" type="hidden" value="開通" user-id="'.$user_ary['USERID'].'">';
				}else if( $is_activate === 'yes' ){
					echo '<input id="cv_activate" class="chinese" type="button" value="已開通" user-id="'.$user_ary['USERID'].'" style="opacity: 0.5; cursor: default;">';
				}else if( $is_activate === 'no' ){
					echo '<input id="cv_activate" class="chinese" type="button" value="開通" user-id="'.$user_ary['USERID'].'">';
				}
			?>
			<script>
				$('#cv_follow').data( 'follow', <?php echo '\''.$is_follow.'\'';?> ).next().data( 'follow', <?php echo '\''.$is_follow.'\'';?> ).next().data( 'activate', <?php echo '\''.$is_activate.'\'';?> );
			</script>
		</div>
	</section>
	<?php
		$stream = isset( $_GET['stream'] ) ? $_GET['stream'] : '';
		switch( $stream ){
			case 'about':
				include_once(dirname(__FILE__).'/profile_about.php');
				break;
			case 'task':
				include_once(dirname(__FILE__).'/profile_task.php');
				break;
			case 'rating':
				include_once(dirname(__FILE__).'/profile_rating.php');
				break;
			case 'follow':
				include_once(dirname(__FILE__).'/profile_follow.php');
				break;
			default:
				echo '<script>window.location.href = "./index.php?stream=about&u='.$u.'&v='.$v.'"</script>';
				exit;
			break;
		}
	?>