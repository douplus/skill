<article id="box" class="dom_hidden">
	<section box-role="add_task" class="dom_hidden">
		<header>
			<div class="box_title chinese">新增任務</div>
			<div class="box_leave chinese" id="add_task_leave">離開</div>
		</header>
		<article>
			<div class="wrapper">
				<section id ="post-form">
					<div class="task_select-area">
						<select id="post_task_select">
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
					<div id ="input-tittle">
						<input id="post-tittle" placeholder="標題">
					</div>
					<div id ="input-content">
						<textarea id="post-content" placeholder="內容" rows="6"></textarea>
					</div>
					<div>
						<button id="task-summit" type="button" class="btn">送出</button>
					</div>

				</section>				
			</div>
		</article>
	</section>
	<section box-role="user_img" class="dom_hidden">
		<header>
			<div class="box_title chinese">更改相片</div>
			<div class="box_leave chinese" id="user_img_leave">離開</div>
		</header>
		<article>
			<div class="wrapper">
				<article class="UserImg_wrapper">
					<section>
						<canvas id="UserImg_slicer" width="304" height="304">drag image here</canvas>
					</section>
					<section>
						<div class="UserImg_preview">
							<section class="chinese">預覽圖片</section>
							<canvas id="UserImg_preview"></canvas>
						</div>
						<div class="UserImg_btn">
							<section id="UserImg_upload-btn">選擇圖片</section>
							<section id="UserImg_save-btn">確定上傳</section>
						</div>
					</section>
					<input id="UserImg_upload" name="upload" type="file" onchange="selectImage(this.files)">
				</article>
			</div>
		</article>
	</section>
	<section box-role="change_passwd" class="dom_hidden">
		<header>
			<div class="box_title chinese">更改密碼</div>
			<div class="box_leave chinese" id="change_passwd_leave">離開</div>
		</header>
		<article>
			<div class="wrapper">
				<article class="passwd_wrapper">
					<div class="input-password">
						<input type="password" id="change_passwd-old" minlength="6" maxlength="128" placeholder="目前的密碼">
					</div>
					<section class="input-password-forget">
						<div id="forget-password" class="chinese">忘記密碼?</div>
					</section>
					<div class="input-password-new">
						<input type="password" id="change_passwd-new" minlength="6" maxlength="128" placeholder="新密碼">
					</div>
					<div class="input-password-again">
						<input type="password" id="change_passwd-again" minlength="6" maxlength="128" placeholder="確認密碼">
					</div>
					<div class="input-failure dom_hidden">
						<ul id="change_passwd-summary"></ul>
					</div>
					<div class="button-command">
						<button class="btn-color" id="change_passwd-save" type="submit">儲存變更</button>
					</div>
				</article>
			</div>
		</article>
	</section>
</article>
