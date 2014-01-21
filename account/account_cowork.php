<?php
include_once(dirname(__FILE__).'../../php/db.php');

$userinfo = $_COOKIE['UserInfo'];
$a = json_decode($userinfo);
$userid = $a -> userid;
	//dynamic add check check
	$query = sprintf("SELECT 1_CV.USERNAME FROM `1_CV`,`1_TASK`,`1_CHECK_TASK` WHERE 1_CV.USERID = 1_CHECK_TASK.COWORKER AND 1_CHECK_TASK.TASKID =  1_TASK.TASKID ORDER BY 1_CHECK_TASK.TIMESTAMP DESC ");
	$result = mysql_query($query) or die('error@錯誤。');
		while( $a = mysql_fetch_array($result) ){
        $want_cowork[] = $a['USERNAME'];
        }
	$query = sprintf( "SELECT 1_CHECK_TASK.TIMESTAMP,1_CHECK_TASK.COWORKER,1_CV.USERID,1_CV.USERNAME,1_CV.USER_PHOTO,1_TASK.TITTLE,1_TASK.TASKID,1_TASK.TASKPOSTERID FROM `1_CHECK_TASK`,`1_CV`,`1_TASK` WHERE 1_CV.USERID = 1_TASK.TASKPOSTERID AND 1_CHECK_TASK.TASKID =  1_TASK.TASKID ORDER BY 1_CHECK_TASK.TIMESTAMP DESC" );
	$result = mysql_query($query) or die('error@錯誤。');
		//0:USERID 1:USERNAME 2:USER_PHOTO 3:TITTLE 4:TIMESTAMP 5:TASKID 6:COWORKER 7:TASKPOSTERID
		while( $a = mysql_fetch_array($result) ){
        $check_task[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'].'***'.$a['TASKID'].'***'.$a['COWORKER'].'***'.$a['TASKPOSTERID'];
        }
		$num=count($check_task);$checkhtml='';
	        	for ($i=0; $i < $num ; $i++) { 
	        		$a = explode("***", $check_task[$i]);
	        		if ($userid == $a[6] ) {
			$checkhtml.='<li class ="'.$a[5].' ">'.	
							'<div class="thumbnail">'.
								'<a href="../profile/index.php?u='.$a[7].'&amp;v='.$userid.'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[2].'" title="'.$a[3].'"></a>';
				$checkhtml.='</div>'.
							'<h3 class="chinese"><a href="../profile/index.php?u='.$a[7].'&amp;v='.$userid.'">'.$a[1].'</a> 想要和你合作 ：「 <a href="../task/discuss/index.php?task_id='.$a[5].'">'.$a[3].'</a> 」。</h3>'.
							'<button class="account_co_btn ensure_btn" type="button"  taskid="'.$a[5].'" userid="'.$a[0].'" >確認</button>'.
							'<button class="account_co_btn refuse_btn" type="button"  taskid="'.$a[5].'" userid="'.$a[0].'" >拒絕</button>'.						
							'<br>';
				$checkhtml.='<span class="date chinese">'.$a[4].'</span>'.
						'</li>';
					}	
	        	}


	$query = sprintf( "SELECT 1_COWORK_TASK.TIMESTAMP,1_COWORK_TASK.COWORKER,1_COWORK_TASK.COWORK,1_CV.USERID,1_CV.USERNAME,1_CV.USER_PHOTO,1_TASK.TITTLE,1_TASK.TASKID,1_TASK.TASKPOSTERID,1_INFO3_TASK.VIEW,1_INFO3_TASK.ANSWER,1_INFO3_TASK.NUM_COWORK FROM `1_COWORK_TASK`,`1_CV`,`1_TASK`,`1_INFO3_TASK` WHERE 1_CV.USERID = 1_TASK.TASKPOSTERID AND 1_COWORK_TASK.TASKID =  1_TASK.TASKID AND 1_INFO3_TASK.TASKID =  1_TASK.TASKID ORDER BY 1_COWORK_TASK.TIMESTAMP DESC" );
	$result = mysql_query($query) or die('error@錯誤。');
		//0:USERID 1:USERNAME 2:USER_PHOTO 3:TITTLE 4:TIMESTAMP 5:TASKID 6:COWORKER 7:TASKPOSTERID 8:COWORK 9:VIEW 10:ANSWER 11:NUM_COWORK
		while( $a = mysql_fetch_array($result) ){
        $cowork_task[] = $a['USERID'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['TITTLE'].'***'.$a['TIMESTAMP'].'***'.$a['TASKID'].'***'.$a['COWORKER'].'***'.$a['TASKPOSTERID'].'***'.$a['COWORK'].'***'.$a['VIEW'].'***'.$a['ANSWER'].'***'.$a['NUM_COWORK'];
        }

        $num=count($cowork_task);$coworkhtml=''; $bug='';
	        	for ($i=0; $i < $num; $i++) { 
	        		$a = explode("***", $cowork_task[$i]);
	        		//dynamic add cowork 狀態 $a[8] 1：合作中 0：等待拒絕確認
	        		$bug.= $a[7].'bug';
	        		if ($a[8] == '0') {
						if ($userid == $a[7] ) {
					$query = sprintf("SELECT 1_CV.USERNAME,1_COWORK_TASK.COWORK   FROM `1_CV`,`1_COWORK_TASK` WHERE 1_CV.USERID = '$a[6]' AND 1_COWORK_TASK.COWORKER= '$a[6]' AND 1_COWORK_TASK.TASKID= '$a[5]'");
					$result = mysql_query($query) or die('error@錯誤。');
						while( $t = mysql_fetch_array($result) ){
				        $ref_name= $t['USERNAME'];
				        $co_work= $t['COWORK'];
				        }
				       if ($co_work==0) {
				$checkhtml.='<li>'.	
								'<div class="thumbnail">'.
									'<a href="../profile/index.php?u='.$a[7].'&amp;v='.$userid.'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[2].'" title="'.$a[3].'"></a>';
					$checkhtml.='</div>'.
								'<h3 class="chinese"><a href="../profile/index.php?u='.$a[6].'&amp;v='.$userid.'">'.$ref_name.'</a> 拒絕此合作 ：「 <a href="../task/discuss/index.php?task_id='.$a[5].'">'.$a[3].'</a> 」。</h3>'.
								'<button class="account_co_btn con_ref_btn" type="button"  taskid="'.$a[5].'" userid="'.$a[6].'" >確認</button>'.					
								'<br>';
					$checkhtml.='<span class="date chinese">'.$a[4].'</span>'.
							'</li>';
				       }

																			        												
						}
	        		} else {
	        			//po任務的人 和 合作的人
		        		if ($userid == $a[6] || $userid == $a[7]) {
				$coworkhtml.='<li>'.	
								'<div class="thumbnail">'.
									'<a href="../profile/index.php?u='.$a[7].'&amp;v='.$userid.'" title="'.$a[3].'"><img width="50" height="50" src="../photo/'.$a[2].'" title="'.$a[3].'"></a>';
				  $coworkhtml.='</div>'.
								'<h3 class="chinese"><a href="../profile/index.php?u='.$a[7].'&amp;v='.$userid.'">'.$a[1].'</a> ：「 <a href="../task/discuss/index.php?task_id='.$a[5].'">'.$a[3].'</a> 」。</h3>';
				   $coworkhtml.='<span class="num chinese">'.$a[9].' views │ '.$a[10].' answers │ '.$a[11].' coworks</span>'.
								'<br>'.
								'<p id="go_work"><a class="chinese" href="./cooperation/index.php?cooperation_id='.$a[5].'">前往合作討論區</a></p>'.
								'<span class="date chinese"></span>'.
							'</li>';  
						}
	        		}
	        	}
	        	if ($coworkhtml == '') {
	        		$coworkhtml = '<p class="chinese">查無合作中項目</p>';
	        	}
	        	if ($checkhtml == '') {
	        		$checkhtml = '<p class="chinese">查無待審查項目</p>';
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
				<h2 class="chinese"><a _role="done" href="javascript:void(0);" id="account_co_done" class="_s">已合作</a></h2>
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
</div>
