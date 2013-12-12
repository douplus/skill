	<script src="./showtask.js"></script>

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
	<article id="task_result">
		<div class="task_show">
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
		</div>
		
	</article>
</div>