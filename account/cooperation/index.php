<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<link rel="stylesheet" href="../../css/cv.css"/>
	<link rel="stylesheet" href="../../library/jquery-ui-1.10.3.custom.min.css"/>
	<link rel="stylesheet" href="../../library/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../library/jquery.nailthumb.1.1.min.css"/>
	<link rel="stylesheet" href="../../css/cooperation.css"/>
    <title>skill 神人網</title>
	<script>localStorage.removeItem('jqData');localStorage.removeItem('co_jsData');</script>
<script>
	(function(){    // include jQuery.js
		var jq_file = '../../library/jquery-2.0.3.min.js';
		var jqData = localStorage.jqData || null;
		if( jqData === null ){    // Load jQuery
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function(){
				if( xhr.readyState == 4 ){
					eval( xhr.responseText );
					localStorage.jqData = xhr.responseText;
					IncludeJS();
				}else{
					return;   
				}
			};
			xhr.open( 'GET', jq_file, true );
			xhr.send();
		}else{    // Cache jQuery.js
			eval(jqData);
			IncludeJS();
		}
		function IncludeJS(){    // include js files
			var js_file = new Array('../../library/jquery-ui-1.10.3.custom.min.js', 
									'../../library/js_cookies.js',
									'../../library/jquery.nailthumb.1.1.min.js',
									'../../library/bootstrap.min.js',
									'./cooperation.js');
			var co_jsData = localStorage.co_jsData || null;
			if( co_jsData === null ){
				var data = '';
				$.ajax({ type: 'GET', async : false, url: js_file[0] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[1] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[2] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[3] }).done(function(res){ localStorage.co_jsData = res+data; });
			}else{
				eval(co_jsData);
			}
			$.ajax({ type: 'GET', async : false, url: js_file[4] }).done(function(res){});
		};
	})();
</script>
</head>
<body>
	<nav id="discuss_nav">
		<ul id="discuss_list">
			<div class="discuss_back">
				<a id="discuss_back" rel="discuss-tipsy" onclick="javascript: window.history.back();return false;" title="返回"></a>
				<i class="back_bottom"></i>
				<i class="back_front"></i>
			</div>
			<li id="discuss_title">我想學騙人</li>
		</ul>
	</nav>
	</header>
	<article id="co_container">
		<p class="_co_box_tittle">今天開始的對話</p>
            <section class="_co_box_section1">
                <div class="_co_box_framework0">
                    <div class=" nailthumb-container square-thumb_left img-circle">
                        <img  src="../../img/image8.jpg" />
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
                <div class="_co_box_framework0">
                    <div class=" nailthumb-container square-thumb_right img-circle">
                        <img  src="../../img/image6.jpg" />
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
                <div class="_co_box_framework0">
                    <div class=" nailthumb-container square-thumb_right img-circle">
                        <img  src="../../img/image6.jpg" />
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
                <div class="_co_box_framework0">
                    <div class=" nailthumb-container square-thumb_left img-circle">
                        <img  src="../../img/image8.jpg" />
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
				<div class="_co_box_task_border" >
				<div class="_co_box_task_post" >
					<div class="_co_box_dis_post1">
						<div class=" nailthumb-container square-thumb_post img-circle">
							<img  src="../../img/image6.jpg" />
						</div>    
					</div>
					<div class="_co_box_dis_post2 ">
								<div class="_co_box_dis_anstime">answered </div>         
								<div><textarea class="span5" rows="5" placeholder="內容" style="resize: vertical; width:95% "></textarea><br></div>
								<div style="text-align: center;";>
								<input id="login" class="btn botton btn-info" type="submit" name="Submit" value="發送">
								<input class="btn botton btn-info" type="reset" name="reset" value="清除">
								</div>
					</div>
				</div>
				</div>				
            </section>
	</article>
	<article id="cv_box" class="dom_hidden">
		<section class="dom_hidden">
			<header>
				<div id="cv_box_leave">離開</div>
			</header>
			<article>
				<div class="wrapper">
					<nav id="cv_box_nav">
						<section>
							<img class="cv_img" src="" alt="未找到大頭貼">
							<div class="cv_user">
								<dl>
									<dt class="cv_user-male">&nbsp;</dt>
									<dd itemprop="user">王梓憲</dd>
								</dl>
								<div class="cv_score">                                       
									<span class="badge1"></span>
									<span _badge="gold" class="badgecount">1</span>                                  
									<span class="badge2"></span>
									<span _badge="silver" class="badgecount">22</span>
									<span class="badge3"></span>
									<span _badge="copper" class="badgecount">374</span>                              
								</div>
								<input id="cv_follow" type="button" value="follow">
							</div>
						</section>
						<ul id="cv_box_list" _tabbed="#cv_box_tabs-1">
							<li class="tabs-active"><a href="#cv_box_tabs-1"><div>關於</div></a></li>
							<li><a href="#cv_box_tabs-2"><div>任務</div></a></li>
							<li><a href="#cv_box_tabs-3"><div>評分</div></a></li>
						</ul>
					</nav>
					<div id="cv_container">
						<article id="cv_box_tabs-1">
							<section class="cv_list">
								<dl>
									<dt class="cv_education">&nbsp;</dt>
									<dd itemprop="education">NCKU, 工科系</dd>
								</dl>
								<dl>
									<dt class="cv_email">&nbsp;</dt>
									<dd itemprop="email">
										<a class="a_learn_email" href="mailto:onepiece@gmail.com" target="_blank">	shane120680@gmail.com</a>
									</dd>
								</dl>
								<dl>
									<dt class="cv_join">&nbsp;</dt>
									<dd itemprop="join">
										<span class="learn_join_label">Joined on </span>
										<span>2013/10/10</span>
									</dd>
								</dl>
								<dl>
									<dt class="cv_skill">&nbsp;</dt>
									<dd itemprop="skill" class="cv_skill_data">
										<span>php</span>
										<span>html5</span>
										<span>css</span>
										<span>javascript</span>
										<span>jquery</span>
										<span>pgonegap</span>
										<span>mysql</span>
										<span>c</span>
										<span>c++</span>
										<span>magic</span>
										<span>piano</span>
										<span>cello</span>
									</dd>
								</dl>
							</section>
							<section class="cv_motto">
								<h2>Motto</h2>
								<p>當你的左臉被人打，那你的左臉就會痛。</p>
							</section>
							<section class="cv_need">
								<h2>Need</h2>
								<div class="cv_need_list">
									<span>php</span>
									<span>html5</span>
									<span>css</span>
									<span>javascript</span>
									<span>jquery</span>
									<span>pgonegap</span>
									<span>mysql</span>
									<span>c</span>
								</div>
							</section>
							<section class="cv_about">
								<h2>About me</h2>
								<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas		</p>
							</section>
							<section class="cv_background">
								<h2>Background</h2>
								<div>
									<p>first</p>
									<p>second</p>
								</div>
							</section>
						</article>
						<article id="cv_box_tabs-2" class="dom_hidden">
							<div style="position: relative;width: 96%;margin: 10px 2%;">
								<div id="cv_box_task-accordion">
									<h3>First</h3>
									<div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
									<h3>Second</h3>
									<div>Phasellus mattis tincidunt nibh.</div>
									<h3>Third</h3>
									<div>Nam dui erat, auctor a, dignissim quis.</div>
								</div>
							</div>
						</article>
						<article id="cv_box_tabs-3" class="dom_hidden">
							<div style="position: relative;width: 96%;margin: 10px 2%;">
								<div id="cv_box_participate-accordion">
									<h3>1</h3>
									<div>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</div>
									<h3>2</h3>
									<div>Phasellus mattis tincidunt nibh.</div>
									<h3>3</h3>
									<div>Nam dui erat, auctor a, dignissim quis.</div>
									<h3>4</h3>
									<div>Nam dui erat, auctor a, dignissim quis.</div>
								</div>
							</div>
						</article>
					</div>
				</div>
			</article>
		</section>
	</article>
</body>
</html>
