<?php
	header("Content-Type:text/html; charset=utf-8");
	include('../php/db.php');
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
function CheckScore($a){
	$copper = ((int)$a)%1000;
	$temp = ((int)$a)/1000;
	$gold = floor( $temp/10 );
	$silver = floor( $temp )%10;
	$score_ary = array( 'gold'=>$gold, 'silver'=>$silver, 'copper'=>$copper );
	return $score_ary;
}
?>
<nav id="noti_nav">
	<ul id="noti_list">
		<div class="noti_back">
			<a id="noti_back" rel="noti-tipsy" onclick="javascript: window.history.back();return false;" original-title="返回"></a>
			<i class="back_bottom"></i>
			<i class="back_front"></i>
		</div>
		<li><a href="javascript: void(0);"><div class="chinese">通知</div></a></li>
	</ul>
</nav>
<div id="noti_container">
	<div>
		<article class="noti_wrapper">
			<ul>
				<li>	
					<div class="thumbnail">
						<a href="" title="Galaxy S5 螢幕已經開始量產" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837389826.jpg?rand=0.5713774424511939" title="Galaxy S5 螢幕已經開始量產"></a>
					</div>
					<h3 class="chinese"><a href="">江佳佳</a> 想要和你合作 ：「 <a href="">Galaxy S5 螢幕已經開始量產</a> 」。</h3>
					<span class="date chinese">十二月 24, 2013</span>
				</li>
				<li>		
					<div class="thumbnail">
						<a href="" title="Permalink to Sony 多達7款產品通過認證,或於明年上半年推出" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837057932.jpg?rand=0.2010142777580768" title="Sony 多達7款產品通過認證,或於明年上半年推出"></a>
					</div>
					<h3 class="chinese"><a href="">吳典陽</a> 想要和你合作 ：「 <a href="">Sony 多達7款產品通過認證,或於明年上半年推出</a> 」。</h3>
					<span class="date chinese">十二月 21, 2013</span>
				</li>
				<li>		
					<div class="thumbnail">
						<a href="" title="Permalink to 支援錄製 4K 影片, 6吋 Acer Liquid S2 發佈" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837389826.jpg?rand=0.5713774424511939" title="支援錄製 4K 影片, 6吋 Acer Liquid S2 發佈"></a>
					</div>
					<h3 class="chinese"><a href="">江佳佳</a> 已和你合作 ：「 <a href="">支援錄製 4K 影片, 6吋 Acer Liquid S2 發佈</a> 」。</h3>
					<span class="date chinese">十二月 20, 2013</span>
				</li>
				<li>		
					<div class="thumbnail">
						<a href="" title="Permalink to 除了 Galaxy Note Pro 12.2 ,Samsung 還將推 Galaxy Note Pro 10.1 ?" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837389826.jpg?rand=0.5713774424511939" title="除了 Galaxy Note Pro 12.2 ,Samsung 還將推 Galaxy Note Pro 10.1 ?"></a>
					</div>
					<h3 class="chinese"><a href="">江佳佳</a> 已和你合作 ：「 <a href="">除了 Galaxy Note Pro 12.2 ,Samsung 還將推 Galaxy Note Pro 10.1 ?</a> 」。</h3>
					<span class="date chinese">十二月 20, 2013</span>
				</li>
				<li>
					<div class="thumbnail">
						<a href="" title="Permalink to Google Doodle 更新迎接平安夜" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837057932.jpg?rand=0.2010142777580768" title="Google Doodle 更新迎接平安夜"></a>
					</div>
					<h3 class="chinese"><a href="">吳典陽</a> 想要和你合作 ：「 <a href="">Google Doodle 更新迎接平安夜</a> 」。</h3>
					<span class="date chinese">十二月 24, 2013</span>
				</li>
			</ul>
		</article>
	</div>
</div>