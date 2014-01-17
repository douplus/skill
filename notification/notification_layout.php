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
				<?php
					include('../php/db.php');
					include('../php/function.php');
					$UserInfo = json_decode( $_COOKIE['UserInfo'], true );
					$_u = $UserInfo['userid'];
					$noti_temp = Get_Notify( $_u );
					$noti_temp = explode( '@@', $noti_temp );
					if( $noti_temp[0] == 'success' ){
						if( $noti_temp[1] == '1' ){
							$noti_temp_ary = json_decode( $noti_temp[3], true );
							$html = '';
							for( $i = 0; $i < $noti_temp[2]; $i++ ){
								$noti_temp2 = explode( '***', $noti_temp_ary[$i] );
								$html .= '<li>	
									<div class="thumbnail">
										<a href="../profile/index.php?stream=about&u='.$noti_temp2[0].'&v='.$_u.'" title="'.$noti_temp2[3].'"><img width="50" height="50" src="../photo/'.$noti_temp2[8].'" title="'.$noti_temp2[3].'"></a>
									</div>
									<h3 class="chinese"><a href="../profile/index.php?stream=about&u='.$noti_temp2[0].'&v='.$_u.'">'.$noti_temp2[7].'</a> '.$noti_temp2[1].' ：「 <a href="..'.$noti_temp2[6].'">'.$noti_temp2[3].'</a> 」。</h3>
									<span class="date chinese">'.$noti_temp2[4].'</span>
								</li>';
							}
							echo $html;
						}else{
							echo '<li>'.$noti_temp[2].'</li>';
						}
						$query = sprintf( "UPDATE `1_NOTIFICATION` SET IS_READ = '1' WHERE USERID = '$_u'" );
						$result = mysql_query($query);
						if( !$result ){
							echo '<script>alert("通知已讀發生錯誤。");</script>';
						}
					}else{
						echo '<script>alert("'.$noti_temp[1].'");</script>';
					}
				?>
				<!--<li>
					<div class="thumbnail">
						<a href="" title="Permalink to Google Doodle 更新迎接平安夜" rel="bookmark"><img width="50" height="50" src="../photo/u_1383837057932.jpg?rand=0.2010142777580768" title="Google Doodle 更新迎接平安夜"></a>
					</div>
					<h3 class="chinese"><a href="">吳典陽</a> 想要和你合作 ：「 <a href="">Google Doodle 更新迎接平安夜</a> 」。</h3>
					<span class="date chinese">十二月 24, 2013</span>
				</li>-->
			</ul>
		</article>
	</div>
</div>