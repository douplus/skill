<<<<<<< HEAD
<?php
include_once(dirname(__FILE__).'../../php/db.php');

$userinfo = $_COOKIE['UserInfo'];
$a = json_decode($userinfo);
$userid = $a -> userid;
	//dynamic add check
	$query = sprintf( "SELECT 1_CHECK_TASK.TIMESTAMP,1_CHECK_TASK.COWORKER,1_CV.USERID,1_CV.USERNAME,1_CV.USER_PHOTO,1_TASK.TITTLE,1_TASK.TASKID FROM `1_CHECK_TASK`,`1_CV`,`1_TASK` WHERE 1_CV.USERID = 1_CHECK_TASK.COWORKER AND 1_CHECK_TASK.TASKID =  1_TASK.TASKID AND 1_CHECK_TASK.COCHECK = '1' ORDER BY 1_CHECK_TASK.TIMESTAMP" );
	$result = mysql_query($query) or die('error@錯誤。');
		//0:USERID 1:USERNAME 2:USER_PHOTO 3:TITTLE 4:TIMESTAMP 5:TASKID 6:COWORKER
		while( $a = mysql_fetch_array($result) ){
        $check_task[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'].'***'.$a['TASKID'].'***'.$a['COWORKER'];
        }
		$num=count($check_task);$checkhtml='';
	        	for ($i=0; $i < $num ; $i++) { 
	        		$a = explode("***", $check_task[$i]);
	        		if ($userid == $a[6] ) {
			$checkhtml.='<li>'.	
							'<div class="thumbnail">'.
								'<a href="../profile/index.php?u='.$userid.'&amp;v='.$a[0].'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[2].'" title="'.$a[3].'"></a>';
				$checkhtml.='</div>'.
							'<h3 class="chinese"><a href="../profile/index.php?u='.$userid.'&amp;v='.$a[0].'">'.$a[1].'</a> 想要和你合作 ：「 <a href="../task/discuss/index.php?task_id='.$a[5].'">'.$a[3].'</a> 」。</h3>'.
							'<button class="account_co_btn ensure_btn" type="button"  taskid="'.$a[5].'" userid="'.$a[0].'" >確認</button>'.
							'<button class="account_co_btn refuse_btn" type="button"  taskid="'.$a[5].'" userid="'.$a[0].'" >拒絕</button>'.						
							'<br>';
				$checkhtml.='<span class="date chinese">'.$a[4].'</span>'.
						'</li>';
					}	
	        	}
	        	if ($checkhtml == '') {
	        		$checkhtml = '<p>查無待審查項目</p>';
	        	}
	//dynamic add cowork
	$query = sprintf( "SELECT 1_COWORK_TASK.TIMESTAMP,1_COWORK_TASK.COWORKER,1_CV.USERID,1_CV.USERNAME,1_CV.USER_PHOTO,1_TASK.TITTLE,1_TASK.TASKID,1_TASK.TASKPOSTERID FROM `1_COWORK_TASK`,`1_CV`,`1_TASK` WHERE 1_CV.USERID = 1_TASK.TASKPOSTERID AND 1_COWORK_TASK.TASKID =  1_TASK.TASKID AND 1_COWORK_TASK.COWORK = '1' ORDER BY 1_COWORK_TASK.TIMESTAMP" );
	$result = mysql_query($query) or die('error@錯誤。');
		//0:USERID 1:USERNAME 2:USER_PHOTO 3:TITTLE 4:TIMESTAMP 5:TASKID 6:COWORKER 7:TASKPOSTERID
		while( $a = mysql_fetch_array($result) ){
        $cowork_task[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'].'***'.$a['TASKID'].'***'.$a['COWORKER'].'***'.$a['TASKPOSTERID'];
        }

        $num=count($cowork_task);$coworkhtml='';
	        	for ($i=0; $i < $num; $i++) { 
	        		$a = explode("***", $cowork_task[$i]);
	        		if ($userid == $a[6] || $userid == $a[7]) {
			$coworkhtml.='<li>'.	
							'<div class="thumbnail">'.
								'<a href="../profile/index.php?u='.$userid.'&amp;v='.$a[0].'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[2].'" title="'.$a[3].'"></a>';
			  $coworkhtml.='</div>'.
							'<h3 class="chinese"><a href="../profile/index.php?u='.$userid.'&amp;v='.$a[0].'">'.$a[1].'</a> ：「 <a href="../task/discuss/index.php?task_id='.$a[5].'">'.$a[3].'</a> 」。</h3>';
			   $coworkhtml.='<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>'.
							'<br>'.
							'<span class="date chinese"></span>'.
						'</li>';  
					}	      		
	        	}
	        	if ($coworkhtml == '') {
	        		$coworkhtml = '<p>查無合作中項目'.$a[6].'dd'.$a[7].'dd'.$userid.'</p>';
	        	}        	
?>
<nav id="account_nav">
	<ul id="account_list" _tabbed="#account_tabs-1">
		<div class="account_back">
			<a id="account_back" rel="account-tipsy" title="返回" onclick="javascript: window.history.back();return false;"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a class="account_list_a" href="./index.php?stream=about" data-pjax="stream-about"><div class="chinese">帳戶</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=task" data-pjax="stream-task"><div class="chinese">任務</div></a></li>
		<li class="tabs-active"><a class="account_list_a" href="./index.php?stream=cowork" data-pjax="stream-cowork"><div class="chinese">合作</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=follow" data-pjax="stream-follow"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="account_container">
	<article id="account_tabs-3" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;text-align: center;">
			<header id="account_co_select">
				<h2 class="chinese"><a _role="done" href="javascript:void(0);" id="account_co_done" class="_s">合作中</a></h2>
				<h2 class="chinese"><a _role="check" href="javascript:void(0);" id="account_co_check">待審查</a></h2>
				<div class="stripe-line"></div>
			</header>
			<article class="account_co_wrapper">
				<ul _role="done">
				<?php echo $coworkhtml ?>	
				</ul>
				<ul _role="check" style="display: none;">
				<?php echo $checkhtml ?>					
				</ul>

			</article>
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
		<li class="tabs-active"><a class="account_list_a" href="./index.php?stream=cowork" data-pjax="stream-cowork"><div class="chinese">合作</div></a></li>
		<li><a class="account_list_a" href="./index.php?stream=follow" data-pjax="stream-follow"><div class="chinese">關注</div></a></li>
	</ul>
</nav>
<div id="account_container">
	<article id="account_tabs-3" class="">
		<div style="position: relative;width: 96%;margin: 10px 2%;text-align: center;">
			<header id="account_co_select">
				<h2 class="chinese"><a _role="done" href="javascript:void(0);" id="account_co_done" class="_s">合作中</a></h2>
				<h2 class="chinese"><a _role="check" href="javascript:void(0);" id="account_co_check">待審查</a></h2>
				<div class="stripe-line"></div>
			</header>
			<article class="account_co_wrapper">
				<ul _role="done">
					<li>	
						<div class="thumbnail">
							<a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154" title="frrf"><img width="50" height="50" src="../photo/u_1383837057932.jpg" title="frrf"></a>
						</div>
						<h3 class="chinese"><a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154">吳典陽</a> ：「 <a href="../task/discuss/index.php?task_id=t_1387035584782">frrf</a> 」。</h3>
						<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>
						<br>
						<span class="date chinese">2013-12-29 18:37:27</span>
					</li>
					<li>	
						<div class="thumbnail">
							<a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154" title="frrf"><img width="50" height="50" src="../photo/u_1383837057932.jpg" title="frrf"></a>
						</div>
						<h3 class="chinese"><a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154">吳典陽</a> ：「 <a href="../task/discuss/index.php?task_id=t_1387035584782">frrf</a> 」。</h3>
						<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>
						<br>
						<span class="date chinese">2013-12-29 18:37:27</span>
					</li>
				</ul>
				<ul _role="check" style="display: none;">
					<li>	
						<div class="thumbnail">
							<a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154" title="frrf"><img width="50" height="50" src="../photo/u_1383837057932.jpg" title="frrf"></a>
						</div>
						<h3 class="chinese"><a href="../profile/index.php?u=u_1383837057932&amp;v=u_1386052811154">吳典陽</a> 想要和你合作 ：「 <a href="../task/discuss/index.php?task_id=t_1387035584782">frrf</a> 」。</h3>
						<span class="num chinese">1 coworks │ 2 answers │ 3 views</span>
						<br>
						<span class="date chinese">2013-12-29 18:37:27</span>
					</li>
				</ul>
			</article>
		</div>
	</article>
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
</div>