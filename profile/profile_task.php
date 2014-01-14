<<<<<<< HEAD
	<ul id="cv_list" _tabbed="#cv_tabs-1">
		<div class="cv_back">
			<a id="profile_back" rel="profile-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a class="cv_list_a" href="./index.php?stream=about&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-cowork"><div class="chinese">關於</div></a></li>
		<li class="tabs-active"><a class="cv_list_a" href="./index.php?stream=task&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-task""><div class="chinese">任務</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=rating&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-rating"><div class="chinese">評分</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=follow&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-follow""><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="cv_container">
	<article id="cv_tabs-2" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;text-align: center;">
			<?php
				$_userid = $u;
				$_viewerid = $v;
				$_start = (int)0;
				$_end = $_start+30;
				include_once(dirname(__FILE__).'/../php/task_layout.php');
			?>
		</div>
	</article>
=======
	<ul id="cv_list" _tabbed="#cv_tabs-1">
		<div class="cv_back">
			<a id="profile_back" rel="profile-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a class="cv_list_a" href="./index.php?stream=about&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-cowork"><div class="chinese">關於</div></a></li>
		<li class="tabs-active"><a class="cv_list_a" href="./index.php?stream=task&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-task""><div class="chinese">任務</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=rating&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-rating"><div class="chinese">評分</div></a></li>
		<li><a class="cv_list_a" href="./index.php?stream=follow&u=<?php echo $u;?>&v=<?php echo $v;?>" data-pjax="stream-follow""><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="cv_container">
	<article id="cv_tabs-2" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;text-align: center;">
			<?php
				$_userid = $u;
				$_viewerid = $v;
				$_start = (int)0;
				$_end = $_start+30;
				include_once(dirname(__FILE__).'/../php/task_layout.php');
			?>
		</div>
	</article>
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
</div>