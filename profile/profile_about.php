	<ul id="cv_list" _tabbed="#cv_tabs-1">
		<div class="cv_back">
			<a id="profile_back" rel="profile-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li class="tabs-active"><a class="cv_list_a" href="./index.php?stream=about&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-cowork"><div class="chinese">關於</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=task&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-task""><div class="chinese">任務</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=rating&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-rating"><div class="chinese">評分</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=follow&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-follow""><div class="chinese">關注</div></a></li>
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
</div>
