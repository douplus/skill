<?php
	include('db.php');

	 $querytask = sprintf( "SELECT 1_TASK.TASKID,1_TASK.CLASSIFY,1_TASK.TITTLE,1_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.SKILL,1_CV.SCORE,1_TAG.TAG FROM `1_TASK`,`1_CV`,`1_TAG` WHERE 1_TASK.TASKPOSTERID = 1_CV.USERID AND 1_TASK.TASKID = 1_TAG.TASKID ORDER BY 1_TASK.TIMESTAMP" );
	 $resulttask = mysql_query($querytask) or die('error@錯誤。');

	while( $a1 = mysql_fetch_array($resulttask) ){
	$alltask_ary[] = $a1['TASKID'].'***'.$a1['CLASSIFY'].'***'.$a1['TITTLE'].'***'.$a1['USERNAME'].'***'.$a1['SKILL'].'***'.$a1['SCORE'].'***'.$a1['TIMESTAMP'].'***'.$a1['TAG'];
	}


	//echo 'success@@'.json_encode( (object)$alltask_ary );
		$num=count($alltask_ary);
		$htmltask = '';
		for ($i=0; $i < $num; $i++) { 
			/*0TASKID,1CLASSIFY,2TITTLE,3USERNAME,4SKILL,5SCORE,6TIMESTAMP,7TAG*/
			$a = explode("***", $alltask_ary[$i]);
				// $classtify = str_split($a[1]);
				$tag = explode("*", $a[7]);
					$span = '';
					$tagnum=count($tag);
					for ($j=0; $j < $tagnum-1; $j++) { 
						$span .= '<span>'.$tag[$j].'</span>';
					}
					//classtify=ary[1].split("");
				$time = explode("-", $a[6]);
				$htmltask.= '<div class="task_show">'.
					'<div class="task_show1">'.
						'<div class="task_show_num task_vote_color">'.
							'<div class=" task_show3">1</div>'.
							'<p >cowork</p>'.
						'</div>'.
						'<div class="task_show_num task_answer_color">'.
							'<div class="task_show3">2</div>'.
							'<p >answer</p>'.
						'</div>'.
						'<div class="task_show_num task_views_color">'.
							'<div class=" task_show3">3</div>'.
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