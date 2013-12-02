<?php
	header("Content-Type:text/html; charset=utf-8");
	include('../php/db.php');
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
		$query = sprintf( "UPDATE `1_CV` SET VIEWERS = '$new_view', SCORE = '$new_score' WHERE USERID = '$u'" );
		$result = mysql_query($query) or die('error@伺服器設定 viewers & score 失敗。');
	}
?>
<?php
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
			<input id="cv_follow" class="chinese" type="button" value="關注" user-id="<?php echo $user_ary['USERID']; ?>">
		</div>
	</section>
	<ul id="cv_list" _tabbed="#cv_tabs-1">
		<div class="cv_back">
			<a id="profile_back" rel="profile-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li class="tabs-active"><a class="cv_list_a" href="#cv_tabs-1"><div class="chinese">關於</div></a></li>
		<li><a class="cv_list_a" href="#cv_tabs-2"><div class="chinese">任務</div></a></li>
		<li><a class="cv_list_a" href="#cv_tabs-3"><div class="chinese">評分</div></a></li>
		<li><a class="cv_list_a" href="#cv_tabs-4"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="cv_container">
	<article id="cv_tabs-1">
		<section class="cv_list">
			<dl>
				<dt class="cv_education">&nbsp;</dt>
				<dd itemprop="education"><?php echo $user_ary['DEPARTMENT']; ?></dd>
			</dl>
			<dl class="dom_hidden">
				<dt class="cv_email">&nbsp;</dt>
				<dd itemprop="email">
					<a class="a_learn_email"><?php echo $user_ary['EMAIL']; ?></a>
				</dd>
			</dl>
			<dl>
				<dt class="cv_join">&nbsp;</dt>
				<dd itemprop="join">
					<span class="learn_join_label">Joined on </span>
					<span itemprop="join_time"><?php echo $user_ary['JOIN_TIME']; ?></span>
				</dd>
			</dl>
			<dl>
				<dt class="cv_skill">&nbsp;</dt>
				<dd itemprop="skill" class="cv_skill_data">
				<?php
					$skill_ary_temp = explode( ',', $user_ary['SKILL'] );
					$skill_ary_temp_len = count( $skill_ary_temp );
					for( $i=0; $i<$skill_ary_temp_len; $i++ ){ echo '<span>'.$skill_ary_temp[$i].'</span>'; }
					unset( $skill_ary_temp, $skill_ary_temp_len );
				?>
				</dd>
			</dl>
		</section>
		<section class="cv_motto">
			<h2 class="chinese">我的名言</h2>
			<p class="chinese" itemprop="motto"><?php echo $user_ary['MOTTO']; ?></p>
		</section>
		<section class="cv_need">
			<h2 class="chinese">我的需求</h2>
			<div class="cv_need_list" itemprop="need">
				<?php
					$need_ary_temp = explode( ',', $user_ary['NEED'] );
					$need_ary_temp_len = count( $need_ary_temp );
					for( $i=0; $i<$need_ary_temp_len; $i++ ){ echo '<span>'.$need_ary_temp[$i].'</span>'; }
					unset( $need_ary_temp, $need_ary_temp_len );
				?>
			</div>
		</section>
		<section class="cv_experience">
			<h2 class="chinese">我的經歷</h2>
			<div class="cv_experience_list">
				<p class="chinese" itemprop="experience"><?php echo $user_ary['EXPERIENCE']; ?></p>
			</div>
		</section>
		<section class="cv_about">
			<h2 class="chinese">關於我</h2>
			<p class="chinese" itemprop="about"><?php echo $user_ary['ABOUT_ME']; ?></p>
		</section>
	</article>
	<article id="cv_tabs-2" class="dom_hidden">
		<div style="position: relative;width: 96%;margin: 10px 2%;">
			<div id="cv_task-accordion">
				<h3>First</h3>
				<div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
				<h3>Second</h3>
				<div>Phasellus mattis tincidunt nibh.</div>
				<h3>Third</h3>
				<div>Nam dui erat, auctor a, dignissim quis.</div>
			</div>
		</div>
	</article>
	<article id="cv_tabs-3" class="dom_hidden">
		<div style="position: relative;width: 96%;margin: 10px 2%;">
			<div id="cv_rating-accordion">
				<h3>1</h3>
				<div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
				<h3>2</h3>
				<div>Phasellus mattis tincidunt nibh.</div>
				<h3>3</h3>
				<div>Nam dui erat, auctor a, dignissim quis.</div>
				<h3>4</h3>
				<div>Nam dui erat, auctor a, dignissim quis.</div>
			</div>
		</div>
	</article>
	<article id="cv_tabs-4" class="dom_hidden">
		<div style="position: relative;width: 96%;margin: 10px 2%;">
			<?php include('../php/follow_layout.php');?>
		</div>
	</article>
</div>