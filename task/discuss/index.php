<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="../../library/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../library/jquery.nailthumb.1.1.min.css"/>        
    <link rel="stylesheet" href="../../css/discuss.css"/> 
	<link rel="stylesheet" href="../../library/tipsy.css"/>
    <title>Skill 神人網</title>
	<script src="../../library/jquery-2.0.3.min.js"></script>
	<script src="../../library/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="../../library/jquery.nailthumb.1.1.min.js"></script>
	<script src="../../library/jquery.tipsy.js"></script>
	<script src="../../library/bootstrap.min.js"></script>
	<script src="../retask.js"></script> 
	<!--
	<script src="./discuss.js"></script>  標題和結尾 
	<script src="../retask.js"></script> 新增任務 
	<script src="../re_showtask.js"></script>  動態新增回復 
	-->

</head>
<!-- view計數器  -->
<?php
	include('../../php/db.php');
	$task_id = $_GET['task_id'];
	$userinfo = $_COOKIE['UserInfo'];
	$a = json_decode($userinfo);
	$userid = $a -> userid;

		$SQLStr = "select VIEW from `1_INFO3_TASK` where TASKID = '$task_id'";
		$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
			while( $a = mysql_fetch_array($res) ){
				$view = $a['VIEW'];
		    break;
		}
		$SQLStr = "select TASKPOSTERID from `1_TASK` where TASKID = '$task_id'";
		$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
			while( $a = mysql_fetch_array($res) ){
				$taskposter = $a['TASKPOSTERID'];
		    break;
		}
		$view = $view+1;
		if ($userid == $taskposter) {
			$view = $view-1;
		}
		$query = mysql_query("UPDATE `1_INFO3_TASK` SET VIEW = $view WHERE TASKID = '$task_id' ");
		if( !$query ){
		    $message  = 'error@伺服器view失敗。';
		    die($message);
		}
?>

<?php 
	$task_id = $_GET['task_id'];
	session_start(); 
	$_SESSION['task_id']=$task_id;
	include('../../php/get_task.php');
	include('../../php/re_showtask.php');
?>
<body>
	<nav id="discuss_nav">
		<ul id="discuss_list">
			<div class="discuss_back">
				<a id="discuss_back" rel="discuss-tipsy" onclick="javascript: window.history.back();return false;" title="返回"></a>
				<i class="back_bottom"></i>
				<i class="back_front"></i>
			</div>
			<li id="task_top_tittle"><?php echo $b[1]; ?></li>
		</ul>
	</nav>
	<article id="container">
		<div>
			<article class="_co_box_article">
				<div class="wrapper">
						<div class="_co_box_framework0">
							<div class="_co_box_qu_framework1_1">
							<div class="image">
								<div style="padding: 10px;"><img id="task_poster" src="<?php echo $photo;?>"></div>
							</div>										
								<div class="_co_box_qu_content1">
									<div style="padding: 5px;">
									<p id="task_name"class="user_name">姓名:<?php echo $user[0]; ?></p>
									<p id="task_department">學校:<?php echo $user[1]; ?></p>
									<p id="task_skill">專長:
									<?php echo $html;?>	
									</p>
										<div class="">                       
											<span class="reputation-score" ></span>                                           
											<span class="badge1"></span>
											<span class="badgecount">0</span>                                  
											<span class="badge2"></span>
											<span class="badgecount">0</span>
											<span class="badge3"></span>
											<span id="task_score" class="badgecount"><?php echo $user[3]; ?></span>                              
										</div>
									</div>										
								</div>                    
							</div>
							<div class="_co_box_qu_framework1_2">								
								<h1 id="task_tittle"class="tittle"style="padding-bottom: 10px; border-bottom: 2px solid #D5D5D5; font-size: 30px;"><?php echo $b[2]; ?></h1>
								<div id="task_content"class="_co_box_qu_content2">
								<p style="margin: 10px;"><?php echo $b[3]; ?>
								</p>                                
								</div>                   
							</div>
							<div class="_co_box_qu_framework1_3">
								<a href="" title="short permalink to this question" class="short-link" >share</a>
								<span class="lsep">|</span>
								<a href="" class="suggest-edit-post" title="">improve this question</a>
								<p id="task_timestamp" style="margin-left: 80px;">
									<?php echo $date; ?></p>
							</div> 
						</div>            
					</div>
					<?php 
						$postphoto='<img id="user_poster" src="'.$user_img.'">'
					?>
					<div class="_co_box_dis_wrapper">
						<?php echo $html2; ?>	
					</div>
					<div class="_co_box_dis_border" >
	                    <div class="_co_box_dis_post" >
	                            <div class="_co_box_dis_post1">
	                                    <div  style = "margin: auto"; class=" nailthumb-container square-thumb-post img-circle">
	                                    	<?php echo $postphoto; ?>
	                                    </div>
	                            </div>
	                            <div class="_co_box_dis_post2 ">
	                                    <div class="_co_box_dis_anstime">answered </div>         
	                                    <div style="padding: 5px 20px 0;"><textarea id="re_task_content"class="span7" rows="5" placeholder="內容" style="resize: vertical; "></textarea><br></div>
	                                    <div >
	                                    <input id="re_task_submit" class="btn botton btn-info" type="button" value="發送">
	                                    </div>
	                                    <div style='margin-top: 5px;' class='che_task_submit'></div>
	                            </div>
	                    </div>      
					</div> 
				</div>	
			</article>
		</div>
	</article>
	</div>
<!-- 合作訊息傳送 暫時關閉
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header task_co ">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel"><?php echo $b[2];?></h3>
		</div>
		<div class="modal-body task_co">
			<textarea rows="4" class="span5"></textarea>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">關閉</button>
			<button class="btn btn-primary">傳送</button>
		</div>
	</div>   --> 
</body>
</html>