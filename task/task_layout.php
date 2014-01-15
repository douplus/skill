<?php
	header("Content-Type:text/html; charset=utf-8");
	include_once(dirname(__FILE__).'/../php/db.php');
	include_once(dirname(__FILE__).'/../php/function.php');

	$now_query = $q;
	$now_by = $by;
	
	$searchString = $now_query;

	# this echo is for debugging.
	echo '<div style="display:none;">關鍵字->'.$now_query.'，分類->'.$now_by.'</div>';
	if( $now_query == '' ){  # 未下關鍵字，即顯示 "最新 or 熱門" 任務
		$querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP DESC " );
	}else{  # 有下關鍵字，顯示該關鍵字有關連的任務
		switch( $now_by ){
			case 'all':
				$querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TASK.TITTLE LIKE BINARY '%s' AND 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP DESC " , '%'.$searchString.'%' );
				break;
			case 'context':
				$querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TASK.CONTENT LIKE BINARY '%s' AND 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP DESC " , '%'.$searchString.'%' );
				break;
			case 'tag':
				$querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TAG.TAG LIKE BINARY '%s' AND 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP DESC " , '%'.$searchString.'%' );
				break;
			case 'classify-pc_and_network':
			case 'classify-life':
			case 'classify-mobile':
			case 'classify-hobby':
			case 'classify-travel':
			case 'classify-food':
			case 'classify-design':
			case 'classify-entertainment':
			case 'classify-sport':
			case 'classify-human':
			case 'classify-business':
			case 'classify-education':
			case 'classify-science':
			case 'classify-troubled':
			case 'classify-health':
			case 'classify-fashion':
			case 'classify-game':
				$now_classify_ary = explode( '-', $now_by );
				$now_classify = Classify_Ttransform( 'e_c', $now_classify_ary[1] );
				$querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TASK.CLASSIFY = '%s' AND 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP DESC" , ''.$now_classify.'' );
				break;
			default:
			break;
		}
	}
	
	$resulttask = mysql_query($querytask) or die('error@搜尋任務發生錯誤。'/*.mysql_error()*/);
	if( mysql_num_rows($resulttask) == 0 ){
		$is_resulttask = '<p class="chineses" style="margin: 6px;font-size: 15px;color: #444;">查無資料，請重新搜尋。</p>';
	}else{
		$is_resulttask = '';
	}
	while( $a1 = mysql_fetch_array($resulttask) ){
		$alltask_ary[] = $a1['TASKID'].'***'.$a1['CLASSIFY'].'***'.$a1['TITTLE'].'***'.$a1['USERNAME'].'***'.$a1['SKILL'].'***'.$a1['SCORE'].'***'.$a1['TIMESTAMP'].'***'.$a1['TAG'];
	}

	$num = count( $alltask_ary );
	$htmltask = '';
	for( $i=0; $i < $num; $i++ ){
		/* 0TASKID,1CLASSIFY,2TITTLE,3USERNAME,4SKILL,5SCORE,6TIMESTAMP,7TAG */
		$a = explode( '***', $alltask_ary[$i] );
		//tag
		$tag = explode( '*', $a[7] );
		$span = '';
		$tagnum = count( $tag );
		for( $j=0; $j < $tagnum-1; $j++ ){ 
			$span .= '<span>'.$tag[$j].'</span>';
		}
           
		// view number & cowork number & answer number
		$query = sprintf( "SELECT * FROM `1_INFO3_TASK` WHERE  TASKID =  '$a[0]'" );
	    $result = mysql_query($query) or die('error@錯誤。');    
	        while( $d = mysql_fetch_array($result) ){
	        $view_num = $d['VIEW'];
	        $cowork_num = $d['NUM_COWORK'];
	        $ansnum = $d['ANSWER'];
	        }
		$time = explode( '-', $a[6] );
		$htmltask.= '<div class="task_show">'.
			'<div class="task_show1">'.
				'<div class="task_show_num task_vote_color">'.
					'<div class=" task_show3">'.$cowork_num.'</div>'.
					'<p >cowork</p>'.
				'</div>'.
				'<div class="task_show_num task_answer_color">'.
					'<div class="task_show3">'.$ansnum.'</div>'.
					'<p >answer</p>'.
				'</div>'.
				'<div class="task_show_num task_views_color">'.
					'<div class=" task_show3">'.$view_num.'</div>'.
					'<p >views</p>'.
				'</div>'.														
			'</div>'.
			'<div class=" task_show_classify ">'.
				'<img class="task_crown" src="../img/green1.png">'.
			'</div>'.
			'<div class="task_show_title">'.'<p style="width:16px;">'.$a[1].'</p>'.'</div>'.					
			'<div class="task_show2">';
				$htmltask.='<p><a href="./discuss/index.php?task_id='.$a[0].'" style="text-decoration: none;">'.$a[2].'</a></p>';
				$htmltask.='<div class="task_span">'.$span; 				
				$htmltask.= '</div>'.
				'<div class="task_poster">'.
					'<div class="task_score">'.
						$a[5].
					'</div>'.
					'<div class="task_name">'.
						'<a href="" style="text-decoration:none">'.$a[3].'</a>';
					$htmltask.= '</div>'.
					'<div class="task_time">';
						$htmltask.= $time[1].'-'.$time[2].
					'</div>'.																				  
				'</div>'.
			'</div>'.			
		'</div>';
	}
	$htmltask.= '<div class="task_bottom"></div>';
?>
<nav id="task_nav">
	<section>
		<div id="task_nav-left">
			<div class="task_select-area">
				<select id="task_select">
                    <option value="all">全部任務</option>
                    <option value="context">依內容</option>
                    <option value="tag">依標籤</option>
                    <option value="disabled" style="color: #333;">↓依分類↓</option>
                    <option value="classify-pc_and_network">電腦網路</option>
                    <option value="classify-life">生活資訊</option>
                    <option value="classify-mobile">行動裝置</option>
                    <option value="classify-hobby">休閒嗜好</option>
                    <option value="classify-travel">旅行遊玩</option>
                    <option value="classify-food">美食相關</option>
                    <option value="classify-design">繪畫設計</option>
                    <option value="classify-entertainment">影音娛樂</option>
                    <option value="classify-sport">運動健身</option>
                    <option value="classify-human">社會人文</option>
                    <option value="classify-business">商業金融</option>
                    <option value="classify-education">教育相關</option>
                    <option value="classify-science">科學常識</option>
                    <option value="classify-troubled">煩惱心事</option>
                    <option value="classify-health">醫療保健</option>
                    <option value="classify-fashion">流行時尚</option>
                    <option value="classify-game">電玩遊戲</option>
                </select>
				<script>
					$('option[value=disabled]').attr('disabled', 'disabled');
				</script>
			</div>
			<div class="task_search-area">
				<section class="dom_hidden" id="task_action-serch"><i>&nbsp;</i></section>
				<input class="dom_hidden" id="task_search" type="text" placeholder="按下 Enter 即可搜尋任務">
			</div>
		</div>
		<div id="task_nav-right">
			<div class="task_action-area">
				<section id="task_action-tag_cloud"><i>&nbsp;</i></section>
				<section id="task_action-add_task"><i>&nbsp;</i></section>
			</div>
		</div>
		<section class="dom_hidden" id="task_action-back"><i>&nbsp;</i></section>
	</section>
	<a id="task-result_page" task-pjax="task-result" style="display: none;"></a>
</nav>
<div id="task_container">
	<article id="task_result">
	<?php  echo $is_resulttask.$htmltask; ?>	
		<!-- <div class="task_show">
			<div class="task_show1">
				<div class="task_show_num task_vote_color">
					<div class=" task_show3">1</div>
					<p >vote</p>
				</div>
				<div class="task_show_num task_answer_color">
					<div class="task_show3">2</div>
					<p >answer</p>
				</div>
				<div class="task_show_num task_views_color">
					<div class=" task_show3">3</div>
					<p >views</p>
				</div>
												
			</div>
			<div class=" task_show_classify  ">
				<img class="task_crown" src="../img/crown1.png">
				<div class=" ">電<br>玩<br>相<br>關</div>
			</div>				
			<div class="task_show2">
				c# Generic cannot convert source type to target type
				<br>
				<div class="task_span">
					<span>css</span>
					<span>爵士樂</span>
					<span>jquery</span>
					<span>煮菜</span>					
				</div>
				<div class="task_poster">
					<div class="task_score">
						1,995
					</div>
					<div class="task_name">
						<a href="" style="text-decoration:none">Ahmed Ekri</a>
					</div>
					<div class="task_time">
						48s ago
					</div>																				  
				</div>
			</div>			
		</div> -->
	</article>
</div>