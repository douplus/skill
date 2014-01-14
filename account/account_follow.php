<<<<<<< HEAD
<nav id="account_nav">
	<ul id="account_list" _tabbed="#account_tabs-1">
		<div class="account_back">
			<a id="account_back" rel="account-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a class="account_list_a" href="./index.php?stream=about" data-pjax="stream-about"><div class="chinese">帳戶</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=task" data-pjax="stream-task"><div class="chinese">任務</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=cowork" data-pjax="stream-cowork"><div class="chinese">合作</div></a></li>
		<li class="tabs-active"><a class="account_list_a" href="./index.php?stream=follow" data-pjax="stream-follow"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="account_container">
	<article id="account_tabs-4" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;">
			<?php
				$_userid = $u;
				$_viewerid = $u;
				$_start = (int)0;
				$_end = $_start+30;
				include_once(dirname(__FILE__).'/../php/follow_layout.php');
			?>
		</div>
	</article>
=======
<nav id="account_nav">
	<ul id="account_list" _tabbed="#account_tabs-1">
		<div class="account_back">
			<a id="account_back" rel="account-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a class="account_list_a" href="./index.php?stream=about" data-pjax="stream-about"><div class="chinese">帳戶</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=task" data-pjax="stream-task"><div class="chinese">任務</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=cowork" data-pjax="stream-cowork"><div class="chinese">合作</div></a></li>
		<li class="tabs-active"><a class="account_list_a" href="./index.php?stream=follow" data-pjax="stream-follow"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="account_container">
	<article id="account_tabs-4" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;">
			<?php
				$_userid = $u;
				$_viewerid = $u;
				$_start = (int)0;
				$_end = $_start+30;
				include_once(dirname(__FILE__).'/../php/follow_layout.php');
			?>
		</div>
	</article>
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
</div>