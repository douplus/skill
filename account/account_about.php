<?php
	header("Content-Type:text/html; charset=utf-8");
	include_once('../php/db.php');

	# 檢查帳號
	$query = sprintf( "SELECT 1_CV.USERID,1_CV.USERNAME,1_CV.EMAIL,1_CV.GENDER,1_CV.DEPARTMENT,1_CV.JOIN_TIME,1_CV.SKILL,1_CV.MOTTO,1_CV.NEED,1_CV.ABOUT_ME,1_CV.EXPERIENCE,1_CV.LASTUSING_TIME,1_CV.SCORE,1_CV.USERIP,1_ACCOUNT.IS_CHECKED FROM `1_CV`,`1_ACCOUNT` WHERE 1_CV.USERID = 1_ACCOUNT.USERID AND 1_CV.USERID = '$u'" );
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
			$user_ary['IS_CHECKED'] = $a['IS_CHECKED'];
		}
	}else{
		echo '<script>window.location.href = "../master/index.php"</script>';
		exit;
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
?>
<nav id="account_nav">
	<ul id="account_list" _tabbed="#account_tabs-1">
		<div class="account_back">
			<a id="account_back" rel="account-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li class="tabs-active"><a class="account_list_a" href="./index.php?stream=about" data-pjax="stream-about"><div class="chinese">帳戶</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=task" data-pjax="stream-task"><div class="chinese">任務</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=cowork" data-pjax="stream-cowork"><div class="chinese">合作</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=follow" data-pjax="stream-follow"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="account_container">
	<article id="account_tabs-1">
		<section>
			<section class="account_user" style="text-align: center;">
				<dl>
					<dt class="account_user-<?php echo CheckGender( $user_ary['GENDER'] );?>">&nbsp;</dt>
					<dd class="chinese" itemprop="user"><?php echo $user_ary['USERNAME']; ?></dd>
				</dl>
			</section>
			<section class="account_passwd">
				<div _role="account_passwd" id="change_passwd">&nbsp;</div>
				<p class="chinese">更改密碼</p>
				<div class="account_right">
					<i class="account_right-bottom"></i>
					<i class="account_right-front"></i>
				</div>
			</section>
			<section class="account_bonus">
				<div _role="account_bonus" id="account_bonus">&nbsp;</div>
				<p class="chinese">積分獎勵</p>
				<div class="account_right">
					<i class="account_right-bottom"></i>
					<i class="account_right-front"></i>
				</div>
			</section>
			<?php
				if( (int)$user_ary['IS_CHECKED'] == 1 ){
					echo '<section class="account_validation" style="opacity: 0.5; background: #eee;" _status="valid">';
				}else{
					echo '<section class="account_validation" _status="non-valid">';
				}
			?>
				<div _role="account_validation" id="re-send_validation">&nbsp;</div>
				<p class="chinese">重寄驗證信</p>
				<div class="account_right">
					<i class="account_right-bottom"></i>
					<?php
						if( (int)$user_ary['IS_CHECKED'] == 1 ){
							echo '<i class="account_right-front" style="border-left-color: #eee;"></i>';
						}else{
							echo '<i class="account_right-front"></i>';
						}
					?>
				</div>
			</section>
		</section>
		<section class="account_email">
			<?php
				if( (int)$user_ary['IS_CHECKED'] == 1 ){
					echo '<strong class="chinese" _status="valid">已驗證</strong>';
				}else{
					echo '<strong class="chinese" style="color: #C44141;" _status="non-valid">未驗證</strong>';
				}
			?>
			<h2 class="chinese">電子信箱</h2>
			<div class="account_email_input dom_hidden">
				<textarea id="modify_email" class="chinese"></textarea>
			</div>
			<div class="account_email_list">
				<p itemprop="email"><?php echo $user_ary['EMAIL']; ?></p>
			</div>
			<div class="account_modify_area">
				<em _role="account_email" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_email" class="chinese">儲存</em>
					<em _action="cancel" _role="account_email" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_skill">
			<h2 class="chinese">我的技能</h2>
			<div class="account_skill_input dom_hidden">
				<?php
					$skill_ary_temp = explode( ',', $user_ary['SKILL'] );
					$skill_ary_temp_len = count( $skill_ary_temp );
					$temp = '';
					for( $i=0; $i<$skill_ary_temp_len; $i++ ){
						$temp .= ','.$skill_ary_temp[$i];
						$temp_span .= '<span>'.$skill_ary_temp[$i].'</span>';
					}
					echo '<input id="modify_skill" value="'.substr( $temp, 1, strlen( $temp ) ).'"/>';
					unset( $skill_ary_temp, $skill_ary_temp_len, $temp );
				?>
			</div>
			<div class="account_skill_list" itemprop="skill">
				<?php
					echo $temp_span;
					unset( $temp_span );
				?>
			</div>
			<div class="account_modify_area">
				<em _role="account_skill" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_skill" class="chinese">儲存</em>
					<em _action="cancel" _role="account_skill" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_need">
			<h2 class="chinese">我的需求</h2>
			<div class="account_need_input dom_hidden">
				<?php
					$need_ary_temp = explode( ',', $user_ary['NEED'] );
					$need_ary_temp_len = count( $need_ary_temp );
					$temp = '';
					for( $i=0; $i<$need_ary_temp_len; $i++ ){
						$temp .= ','.$need_ary_temp[$i];
						$temp_span .= '<span>'.$need_ary_temp[$i].'</span>';
					}
					echo '<input id="modify_need" value="'.substr( $temp, 1, strlen( $temp ) ).'"/>';
					unset( $need_ary_temp, $need_ary_temp_len, $temp );
				?>
			</div>
			<div class="account_need_list" itemprop="need">
				<?php
					echo $temp_span;
					unset( $temp_span );
				?>
			</div>
			<div class="account_modify_area">
				<em _role="account_need" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_need" class="chinese">儲存</em>
					<em _action="cancel" _role="account_need" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_motto">
			<h2 class="chinese">我的名言</h2>
			<div class="account_motto_input dom_hidden">
				<textarea id="modify_motto" class="chinese"></textarea>
			</div>
			<div class="account_motto_list">
				<p class="chinese" itemprop="motto"><?php echo $user_ary['MOTTO']; ?></p>
			</div>
			<div class="account_modify_area">
				<em _role="account_motto" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_motto" class="chinese">儲存</em>
					<em _action="cancel" _role="account_motto" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_education">
			<h2 class="chinese">最高學歷</h2>
			<div class="account_education_input dom_hidden">
				<textarea id="modify_education" class="chinese"></textarea>
			</div>
			<div class="account_education_list">
				<p itemprop="education"><?php echo $user_ary['DEPARTMENT']; ?></p>
			</div>
			<div class="account_modify_area">
				<em _role="account_education" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_education" class="chinese">儲存</em>
					<em _action="cancel" _role="account_education" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_experience">
			<h2 class="chinese">我的經歷</h2>
			<div class="account_experience_input dom_hidden">
				<textarea id="modify_experience" class="chinese"></textarea>
			</div>
			<div class="account_experience_list">
				<p class="chinese" itemprop="experience"><?php echo $user_ary['EXPERIENCE']; ?></p>
			</div>
			<div class="account_modify_area">
				<em _role="account_experience" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_experience" class="chinese">儲存</em>
					<em _action="cancel" _role="account_experience" class="chinese">取消</em>
				</section>
			</div>
		</section>
		<section class="account_about">
			<h2 class="chinese">關於我</h2>
			<div class="account_about_input dom_hidden">
				<textarea id="modify_about" class="chinese"></textarea>
			</div>
			<div class="account_about_list">
				<p class="chinese" itemprop="about"><?php echo $user_ary['ABOUT_ME']; ?></p>
			</div>
			<div class="account_modify_area">
				<em _role="account_about" class="chinese account_modify">編輯</em>
				<section class="account_edit dom_hidden">
					<em _action="save" _role="account_about" class="chinese">儲存</em>
					<em _action="cancel" _role="account_about" class="chinese">取消</em>
				</section>
			</div>
		</section>
	</article>
</div>