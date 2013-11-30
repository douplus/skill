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
</nav>
<div id="task_container">
	<article id="task_result" class="dom_hidden">
		<section class="task_item">
			<header>
				<dl>
					<dt class="task_user-male">&nbsp;</dt>
					<dd itemprop="user" class="task_user_data">魯夫00000</dd>
				</dl>
				<dl>
					<dt class="task_skill">&nbsp;</dt>
					<dd itemprop="skill" class="task_skill_data">
						<span>二檔</span>
						<span>三檔</span>
						<span>霸氣</span>
						<span>橡皮人</span>
						<span>吃</span>
					</dd>
				</dl>
			</header>
			<p><em>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </em><a href="./discuss/index.php">點擊查看詳情</a></p>
			<dl class="task_item_footer">
				<dt class="task_classify">分類：</dt>
				<dd class="task_classify_data">
					<span>分類一</span>
					<span>分類二</span>
					<span>分類三</span>
					<span>分類四</span>
				</dd>
			</dl>
		</section>
		<section class="task_item">
			<header>
				<dl>
					<dt class="task_user-female">&nbsp;</dt>
					<dd itemprop="user" class="task_user_data">娜美</dd>
				</dl>
				<dl>
					<dt class="task_skill">&nbsp;</dt>
					<dd itemprop="skill" class="task_skill_data">
						<span>偷東西</span>
						<span>航海術</span>
						<span>海市蜃樓</span>
						<span>棍法</span>
					</dd>
				</dl>
			</header>
			<p><em>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.  </em><a href="./discuss/index.php">點擊查看詳情</a></p>
			<dl class="task_item_footer">
				<dt class="task_classify">分類：</dt>
				<dd class="task_classify_data">
					<span>分類一</span>
					<span>分類二</span>
					<span>分類三</span>
					<span>分類四</span>
				</dd>
			</dl>
		</section>
		<section class="task_item">
			<header>
				<dl>
					<dt class="task_user-male">&nbsp;</dt>
					<dd itemprop="user" class="task_user_data">索隆</dd>
				</dl>
				<dl>
					<dt class="task_skill">&nbsp;</dt>
					<dd itemprop="skill" class="task_skill_data">
						<span>獅子歌歌</span>
						<span>三千世界</span>
						<span>鬼氣●九刀流-阿修羅</span>
						<span>迷路</span>
						<span>鬼斬</span>
					</dd>
				</dl>
			</header>
			<p><em><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis  </em><a href="./discuss/index.php">點擊查看詳情</a></p>
			<dl class="task_item_footer">
				<dt class="task_classify">分類：</dt>
				<dd class="task_classify_data">
					<span>分類一</span>
					<span>分類二</span>
					<span>分類三</span>
					<span>分類四</span>
				</dd>
			</dl>
		</section>
	</article>
</div>