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
	<script>localStorage.removeItem('jqData');localStorage.removeItem('task_jsData');</script>
</head>
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
									'../../library/jquery.tipsy.js',
									'../../library/bootstrap.min.js',
									'./discuss.js');
			var co_jsData = localStorage.co_jsData || null;
			if( co_jsData === null ){
				var data = '';
				$.ajax({ type: 'GET', async : false, url: js_file[0] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[1] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[2] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[3] }).done(function(res){ data += res; });
				$.ajax({ type: 'GET', async : false, url: js_file[4] }).done(function(res){ localStorage.co_jsData = res+data; });
			}else{
				eval(co_jsData);
			}
			$.ajax({ type: 'GET', async : false, url: js_file[5] }).done(function(res){});
		};
	})();
</script>

<body>
	<nav id="discuss_nav">
		<ul id="discuss_list">
			<div class="discuss_back">
				<a id="discuss_back" rel="discuss-tipsy" onclick="javascript: window.history.back();return false;" title="返回"></a>
				<i class="back_bottom"></i>
				<i class="back_front"></i>
			</div>
			<li id="discuss_title">我想學煮菜</li>
		</ul>
	</nav>
	<article id="container">
		<div>
			<article class="_co_box_article">
				<div class="wrapper">
					<div>
						<div class="_co_box_framework0">
							<div class="_co_box_qu_framework1_1">
							<div class="image">
								<img id="task_poster">
							</div>										
								<div class="_co_box_qu_content1">
									<div id="task_name"class="user_name">姓名:索隆</div>
									<div id="task_department">學校:海賊王大學</div>
									<div id="task_skill">專長:
										<!-- <span id ="aa" data-title="劍術 追蹤人數6000" data-content="是一種用刀砍別人的武術。"data-placement="bottom" >劍術</span> -->
									</div>
										<div class="">                       
											<span class="reputation-score" ></span>                                           
											<span class="badge1"></span>
											<span class="badgecount">0</span>                                  
											<span class="badge2"></span>
											<span class="badgecount">0</span>
											<span class="badge3"></span>
											<span id="task_score" class="badgecount"></span>                              
										</div>									
								</div>                    
							</div>
							<div class="_co_box_qu_framework1_2">								
								<h1 id="task_tittle"class="tittle"style="padding-bottom: 10px; border-bottom: 2px solid #D5D5D5; font-size: 30px;">我想學騙術</h1>
								<div class="_co_box_qu_content2">
								最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等...
								我 只升完武器就沒材料了，但是還有一堆裝備沒升到...
								我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@"
								請問有沒有方法能拿到分解材料，還是只能像我這樣慢慢挖呀@@!?                                
								</div>                   
							</div>
							<div class="_co_box_qu_framework1_3" style="margin-right: 50px;">
								<a href="" title="short permalink to this question" class="short-link" >share</a>
								<span class="lsep">|</span>
								<a href="" class="suggest-edit-post" title="">improve this question</a>
								<p >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp
									Mar 28 '11 at 13:03</p>
							</div> 
						</div>            
					</div>
					<div class="_co_box_dis_wrapper">
						<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">
							<div class="_co_box_dis_framework1">
								<div class=" nailthumb-container square-thumb img-circle">
									<img class="img-circle" src="../../img/image7.jpg" />									
								</div>
									<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>
							</div>
							<div class="_co_box_dis_framework2 ">
								<span style="position: relative; float: left;"><a href="">索隆</a></span>
								<div class="_co_box_dis_anstime">&nbsp&nbsp&nbsp&nbsp&nbsp answered Mar 28 '12 at 5:03</div>              
								最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等... 我 只升完武器就沒材料了，但是還有一堆裝備沒升到... 我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@" 請問有沒有方法                              
							</div>
						</div>
						<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">
							<div class="_co_box_dis_framework1">
								<div class=" nailthumb-container square-thumb img-circle">
									<img  src="../../img/image8.jpg" />
								</div>
								<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>
							</div>
							<div class="_co_box_dis_framework2 ">
								<span style="position: relative; float: left;"><a href="">狙擊王</a></span>
								<div class="_co_box_dis_anstime">&nbsp&nbsp&nbsp&nbsp&nbspanswered Mar 28 '12 at 5:03</div>              
								最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等... 我 只升完武器就沒材料了，但是還有一堆裝備沒升到... 我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@" 請問有沒有方法                              
							</div>
						</div>
						<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">
							<div class="_co_box_dis_framework1">
								<div class=" nailthumb-container square-thumb img-circle">
									<img class="img-circle" src="../../img/image6.jpg" />									
								</div>
									<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>
							</div>
							<div class="_co_box_dis_framework2 ">
								<span style="position: relative; float: left;"><a href="">香吉士</a></span>
								<div class="_co_box_dis_anstime">&nbsp&nbsp&nbsp&nbsp&nbsp answered Mar 28 '12 at 5:03</div>              
								最近25了在打拉鋸，發現打人都不痛，才知道他們都有把裝備升等... 我 只升完武器就沒材料了，但是還有一堆裝備沒升到... 我都自己挖水晶做裝備在把它分解，但是這樣好慢喔@@" 請問有沒有方法                              
							</div>
						</div>						
						<div class="_co_box_dis_border" >
							<div class="_co_box_dis_post" >
							<div class="_co_box_dis_post1">
								<div  style = "margin: auto"; class=" nailthumb-container square-thumb-post img-circle">
									<img  src="../../img/image7.jpg" />
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
					</div>
				</div> 
			</article>
		</div>
	</article>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">二檔的問題?</h3>
		</div>
		<div class="modal-body">
			<textarea rows="4" class="span5"></textarea>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">關閉</button>
			<button class="btn btn-primary">傳送</button>
		</div>
	</div>   
	<!-- Modal -->
	<div id="myModa2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">二檔的問題?</h3>
		</div>
		<div class="modal-body">
			<textarea rows="4" class="span5"></textarea>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">關閉</button>
			<button class="btn btn-primary">傳送</button>
		</div>
	</div>  
</body>
</html>