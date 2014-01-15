<nav id="learn_nav">
	<section>
		<div class="targetMaster_box">
			<input type="input" id="SearchAccount" value="" placeholder="輸入帳號或名稱，即可尋找用戶" autofocus="">
		</div>
	</section>
</nav>
<div id="learn_container">
	<article>
		<h2>I'm the God of the World.</h2>
		<div id="learn_master">
			<?php
				include_once(dirname(__FILE__).'/../php/function.php');
				include_once(dirname(__FILE__).'/../php/db.php');
				if( $q == '' ){
					$check_m = Check_Master( date( "Y-m-d", time() ) );
					$check_m = explode('@', $check_m);
					if( $check_m[0] == 'success' ){
						echo '<script>localStorage.setItem( "Master_list", \''.$check_m[3].'@'.$check_m[2].'\' )</script>';
						$get_m = Get_Master();
						$get_m = explode('@@', $get_m);
						if( $get_m[0] == 'success' ){
							echo '<script>localStorage.setItem( "Master_info", \''.$get_m[1].'\' )</script>';
							echo Show_Master( $get_m[1] );
							echo '<script>
									window.setTimeout(function(){
										StartLearnMetro();
										SetMetroTag_P();
									}, 1000);
								</script>';
						}else if( $get_m[0] == 'error' ){
							echo '<script>alert( \''.$get_m[1].'\' )</script>';
						}
					}else if( $check_m[0] == 'error' ){
						echo '<script>alert( \''.$check_m[1].'\' )</script>';
					}
				}else{
					echo '<script>alert( \'show search result.\' )</script>';
				}
			?>
			<!--
			<section class="learn_item master">
				<div class="learn_item_left">
					<img src="" alt="未找到大頭貼" title="javascript 神人。<p>54 points : 1042 followers</p>"/>
				</div>
				<div class="learn_item_right">
					<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
					<div class="details">
						<dl>
							<dt class="learn_user-male">&nbsp;</dt>
							<dd itemprop="user">魯夫</dd>
						</dl>                                                              
						<dl class="learn_score">
							<span class="badge1"></span>
							<span _badge="gold" class="badgecount">1</span>                                  
							<span class="badge2"></span>
							<span _badge="silver" class="badgecount">22</span>
							<span class="badge3"></span>
							<span _badge="copper" class="badgecount">374</span>    
						</dl>
						<dl>
							<dt class="learn_education">&nbsp;</dt>
							<dd itemprop="education">NCKU, 電機系</dd>
						</dl>
						<dl>
							<dt class="learn_email">&nbsp;</dt>
							<dd itemprop="email">
								<a class="a_learn_email" href="mailto:onepiece@gmail.com" target="_blank">onepiece@gmail.com</a>
							</dd>
						</dl>
						<dl>
							<dt class="learn_join">&nbsp;</dt>
							<dd itemprop="join">
								<span class="learn_join_label">Joined on </span>
								<span>2013/10/09</span>
							</dd>
						</dl>
						<dl>
							<dt class="learn_skill">&nbsp;</dt>
							<dd itemprop="skill" class="learn_skill_data">
								<span>二檔</span>
								<span>三檔</span>
								<span>霸氣</span>
								<span>橡皮人</span>
								<span>吃</span>
							</dd>
						</dl>
					</div>
					<div class="others">
						<p itemprop="motto">javascript 跟吃飯一樣簡單。</p>
					</div>
				</div>
			</section>
			
		</div>
		<h2 class="interval">新使用者</h2>
		<section class="learn_item_new">
			<div class="learn_item_area">
				<img src="" alt="未找到大頭貼"/>
				<section>
					<div>
						<dl>
							<dt class="learn_user-male">&nbsp;</dt>
							<dd itemprop="user">佛朗基</dd>
						</dl>
					</div>
				</section>
				<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
			</div>
		</section>
		<section class="learn_item_new">
			<div class="learn_item_area">
				<img src="" alt="未找到大頭貼"/>
				<section>
					<div>
						<dl>
							<dt class="learn_user-female">&nbsp;</dt>
							<dd itemprop="user">羅賓</dd>
						</dl>
					</div>
				</section>
				<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
			</div>
		</section>
		<section class="learn_item_new">
			<div class="learn_item_area">
				<img src="" alt="未找到大頭貼"/>
				<section>
					<div>
						<dl>
							<dt class="learn_user-male">&nbsp;</dt>
							<dd itemprop="user">喬巴</dd>
						</dl>
					</div>
				</section>
				<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
			</div>
		</section>
		<section class="learn_item_new">
			<div class="learn_item_area">
				<img src="" alt="未找到大頭貼"/>
				<section>
					<div>
						<dl>
							<dt class="learn_user-male">&nbsp;</dt>
							<dd itemprop="user">特拉法爾加-羅</dd>
						</dl>
					</div>
				</section>
				<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
			</div>
		</section>
		<section class="learn_item_new">
			<div class="learn_item_area">
				<img src="" alt="未找到大頭貼"/>
				<section>
					<div>
						<dl>
							<dt class="learn_user-female">&nbsp;</dt>
							<dd itemprop="user">女帝-漢考克</dd>
						</dl>
					</div>
				</section>
				<a class="learn_item_more" href="../profile/index.php" data-pjax="profile" title="履歷">&gt; more...</a>
			</div>
		</section>
		-->
	</article>
</div>