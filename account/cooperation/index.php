<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="../../css/cv.css"/>
	<link rel="stylesheet" href="../../library/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../library/jquery.nailthumb.1.1.min.css"/>
	<link rel="stylesheet" href="../../css/cooperation.css"/>
	<link rel="shortcut icon" type="image/png" href="../Images/favicon.png">
	<link rel="Bookmark" type="image/png" href="../Images/favicon.png">
    <title>skill 神人網</title>
	<script>localStorage.removeItem('jqData');localStorage.removeItem('co_jsData');</script>
	<script src="../../library/jquery-2.0.3.min.js"></script>
	<script src="../../library/jquery.nailthumb.1.1.min.js"></script>
	<script src="../../library/bootstrap.min.js"></script>
	<script src="./cooperation.js"></script>
<script>
	(function(){    // include jQuery.js
		CheckLogin();
		function CheckLogin(){    // 檢查使用者是否登入
			var a = $.cookie.get({ name: 'UserInfo' });
			if( a == null || localStorage.Based_CV == null ){  // 未登入：跳回首頁
				window.location.replace( '../../home/index.html' );
			}else{  // 已登入：載入頁面
				$(function(){ $('#init-overlay').addClass('dom_hidden'); });
				//IncludeJS();
				$.cookie.set({ name: 'UserInfo', value: a, expidxres: '7', path: '/~thwang/cur/' });
				localStorage.setItem( 'UserInfo', a );
			}
		};
	})();
</script>
</head>
<?php
include('../../php/db.php');

$userinfo = $_COOKIE['UserInfo'];
$a = json_decode($userinfo);
$userid = $a -> userid;

$SQLStr = "select USER_PHOTO from `1_CV` where USERID = '$userid'";
$res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
	while( $a = mysql_fetch_array($res) ){
		$user_img = $a['USER_PHOTO'];
    break;
}	
$use_photo='<img  src="../../photo/'.$user_img.'" />';
// 拉cop_tittle 新增回復資料

$copid = $_GET['cooperation_id'];
$SQLStr = "select TITTLE,CONTENT from `1_TASK` where TASKID = '$copid'";
    $res = mysql_query($SQLStr) or die('error@取得合作區標題。');
        while( $a = mysql_fetch_array($res) ){
            $cop_tittle = $a['TITTLE'];
            $cop_content = $a['CONTENT'];
        break;
    }

$SQLStr = sprintf( "SELECT * FROM `1_DISCUSS_COOPERATION`,`1_CV` WHERE 1_DISCUSS_COOPERATION.COOPERATION_ID = '$copid' AND 1_CV.USERID = 1_DISCUSS_COOPERATION.USERID ORDER BY 1_DISCUSS_COOPERATION.TIMESTAMP " );
    $res = mysql_query($SQLStr) or die('error@取得討論。');
        while( $a = mysql_fetch_array($res) ){
            $dis_ary[] = $a['CONTENT'].'***'.$a['TIMESTAMP'].'***'.$a['USERNAME'].'***'.$a['USER_PHOTO'].'***'.$a['USERID'];
    }
    //0:CONTENT 1:TIMESTAMP 2:USERNAME 3:USER_PHOTO 4:USERID
    $html = '';
    $num=count($dis_ary); 
    for ($i=0; $i < $num; $i++) { 
       		$a = explode("***", $dis_ary[$i]);
       		$time = explode("-", $a[1]);
       		$time2 = explode(":", $time[2]);
       		$dis_time = $time[1].'-'.$time2[0].':'.$time2[1];
       		if ($userid != $a[4]) {
       			$b= 'square-thumb_right';
       			$c= 'style="color: #C5C5C5; text-align: right;"';
       		} else {
       			$b= 'square-thumb_left';
       			$c= 'style="color: #C5C5C5;"';
       		}
       		
            $html.='<div class="_co_box_framework0">'.
                	'<div class="_co_box_frameworkdiv">'.
                	'<div class="div_img">'.
                    '<div id="dis_photo"class=" nailthumb-container '.$b.' img-circle">'.
                        '<img src="../../photo/'.$a[3].'" />'.
                    '</div>'.                 
                    '</div>'.
                    '<div>'.
                    '<div id ="dis_text" '.$c.' >'.
                        '<span>Edited by </span>'.
                        '<span class="authors" style="">&nbsp;&nbsp;<a href="../../profile/index.php?stream=about&u='.$a[4].'&v='.$userid.'">'.$a[2].'</a></span>'.
                        '<span class="lastEditedDate" style="">&nbsp;&nbsp;&nbsp;'.$dis_time.'</span>'.
                   ' </div >'.
                   	'<p style="text-align: center;" >'.$a[0].'</p>'.                           
                    '</div>'.
                    '</div>'.
                '</div>';       		
       	}   
?>
<body>
	<nav id="discuss_nav">
		<ul id="discuss_list">
			<div class="discuss_back">
				<a id="discuss_back" rel="discuss-tipsy" onclick="javascript: window.history.back();return false;" title="返回"></a>
				<i class="back_bottom"></i>
				<i class="back_front"></i>
			</div>
			<li id="discuss_title" copid="<?php echo $_GET['cooperation_id'];?>"><?php echo $cop_tittle; ?></li>
		</ul>
	</nav>
	</header>
	<article id="co_container">
		<p class="_co_box_tittle"><?php echo $cop_content; ?></p>
            <section class="_co_box_section1">
            	<?php echo $html;?>
                <!-- <div class="_co_box_framework0">
                	<div class="_co_box_frameworkdiv">
                	<div class="div_img">
                    <div class=" nailthumb-container square-thumb_left img-circle">
                        <img  src="../../img/image8.jpg" />
                    </div>                 
                    </div>
                    <div>
                    <div style="color: #C5C5C5;">
                        <span>Edited by </span>
                        <span class="authors" style=""><a href="">Little Ling</a></span>
                        <span class="lastEditedDate" style=""> 10 days ago</span>
                    </div>
                        <br>
                        最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等...
                        我 只升完武器就沒材料了，但是還有一堆裝備沒升到...
                        我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@"
                        請問有沒有方法能拿到分解材料，還是只能像我這樣慢慢挖呀@@!?                              
                    </div>
                    </div>
                </div>
                <div class="_co_box_framework0">
                	<div class="_co_box_frameworkdiv">
                	<div class="div_img">                
                    <div class=" nailthumb-container square-thumb_right img-circle">
                        <img  src="../../img/image6.jpg" />
                    </div>
                    </div>                 
                    <div>
                    <div style="color: #C5C5C5; text-align: right">
                        <span>Edited by </span>
                        <span class="authors" style=""><a href="">Little Ling</a></span>
                        <span class="lastEditedDate" style=""> 10 days ago</span>
                    </div>
                        <br>
                        最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等...
                        我 只升完武器就沒材料了，但是還有一堆裝備沒升到...
                        我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@"
                        請問有沒有方法能拿到分解材料，還是只能像我這樣慢慢挖呀@@!?                              
                    </div>
                    </div>
                </div>
                <div class="_co_box_framework0">
                	<div class="_co_box_frameworkdiv">
                	<div class="div_img"> 
                    <div class=" nailthumb-container square-thumb_right img-circle">
                        <img  src="../../img/image6.jpg" />
                    </div>
                    </div>                 
                    <div>
                    <div style="color: #C5C5C5; text-align: right">
                        <span>Edited by </span>
                        <span class="authors" style=""><a href="">Little Ling</a></span>
                        <span class="lastEditedDate" style=""> 10 days ago</span>
                    </div>
                        <br>
                        最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等...
                        我 只升完武器就沒材料了，但是還有一堆裝備沒升到...
                        我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@"
                        請問有沒有方法能拿到分解材料，還是只能像我這樣慢慢挖呀@@!?                              
                    </div>
                    </div>
                </div>   
                <div class="_co_box_framework0">
                	<div class="_co_box_frameworkdiv">
                	<div class="div_img"> 
                    <div class=" nailthumb-container square-thumb_left img-circle">
                        <img  src="../../img/image8.jpg" />
                    </div> 
                    </div>         
                    <div>
                    <div style="color: #C5C5C5;">
                        <span>Edited by </span>
                        <span class="authors" style=""><a href="">Little Ling</a></span>
                        <span class="lastEditedDate" style=""> 10 days ago</span>
                    </div>
                        <br>
                        最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等...
                        我 只升完武器就沒材料了，但是還有一堆裝備沒升到...
                        我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@"
                        請問有沒有方法能拿到分解材料，還是只能像我這樣慢慢挖呀@@!?                              
                    </div>
                    </div>
                </div>		 -->		
            </section>
			<div class="_co_box_task_border" >
			<div class="_co_box_task_post" >
				<div class="_co_box_dis_post1">
					<div class=" nailthumb-container square-thumb_post img-circle">
						<?php echo $use_photo;?>
					</div>    
				</div>
				<div class="_co_box_dis_post2 ">
							<div class="_co_box_dis_anstime">answered </div>
							<div class='btn_if'></div>         
							<div><textarea id="co_content" class="span5" rows="5" placeholder="內容" style="resize: vertical; width:95% "></textarea><br></div>
							<div style="text-align: center;";>
							<input id="btn_coo" class="btn botton btn-info" type="button" value="發送">	
							</div>
				</div>
			</div>
			</div>            
	</article>
