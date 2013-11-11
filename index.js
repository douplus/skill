$(function(){    // 初始設定
	SetViewport();
	InitialTagCloud();
	SetTagCloud();
	$('#i_learn').removeClass('dom_hidden').data('status', true);
	StartUsing();
	CheckMaster();
});
$(function(){
	$('#top_nav_user_wrapperGoToCV').click(function(){    // 進入 個人履歷
		if( !$('#i_cv').data().status ){
			$(''+$('#cv_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
			$('#cv_list').attr('_tabbed', '#tabs-1').find('li.tabs-active').removeClass('tabs-active').end().find('li:nth-child(1)').addClass('tabs-active');
			$('#tabs-1').removeClass('dom_hidden').data('status', true);
			$('#learn_nav').addClass('dom_hidden');
			$('#task_nav').addClass('dom_hidden');
			$('#co_nav').addClass('dom_hidden');
			$('#information_nav').addClass('dom_hidden');
			var a = $('#fixed_nav').attr('_opened');
			$('#i_'+a+'').addClass('dom_hidden').data('status', false);
			$('#'+a+'').addClass('dom_hidden');
			$('#fixed_nav').attr('_opened', 'cv');
			$('#i_cv').removeClass('dom_hidden').data('status', true);
			$('#cv').removeClass('dom_hidden');
			$('#cv_nav').removeClass('dom_hidden');
			clearTimeout( $('#learn_container').data().timeoutNum );
		}
	});
	$('#a_cooperation_icon').click(function(){    // 進入 合作區
		if( !$('#i_cooperation').data().status ){
			$('#learn_nav').addClass('dom_hidden');
			$('#task_nav').addClass('dom_hidden');
			$('#cv_nav').addClass('dom_hidden');
			$('#information_nav').addClass('dom_hidden');
			var a = $('#fixed_nav').attr('_opened');
			$('#i_'+a+'').addClass('dom_hidden').data('status', false);
			$('#'+a+'').addClass('dom_hidden');
			$('#fixed_nav').attr('_opened', 'cooperation');
			$('#i_cooperation').removeClass('dom_hidden').data('status', true);
			$('#cooperation').removeClass('dom_hidden');
			$('#co_nav').removeClass('dom_hidden');
			clearTimeout( $('#learn_container').data().timeoutNum );
		}
	});
	$('#a_learn_icon').click(function(){    // 進入 神人區
		if( !$('#i_learn').data().status ){
			$('#task_nav').addClass('dom_hidden');
			$('#cv_nav').addClass('dom_hidden');
			$('#co_nav').addClass('dom_hidden');
			$('#information_nav').addClass('dom_hidden');
			var a = $('#fixed_nav').attr('_opened');
			$('#i_'+a+'').addClass('dom_hidden').data('status', false);
			$('#'+a+'').addClass('dom_hidden');
			$('#fixed_nav').attr('_opened', 'learn');
			$('#i_learn').removeClass('dom_hidden').data('status', true);
			$('#learn').removeClass('dom_hidden');
			$('#learn_nav').removeClass('dom_hidden');
			window.setTimeout(function(){
				StartLearnMetro();
			}, 1000);
			SetMetroTag_P();
		}
	});
	$('#a_task_icon').click(function(){    // 進入 任務區
		if( !$('#i_task').data().status ){
			$('#learn_nav').addClass('dom_hidden');
			$('#cv_nav').addClass('dom_hidden');
			$('#co_nav').addClass('dom_hidden');
			$('#information_nav').addClass('dom_hidden');
			var a = $('#fixed_nav').attr('_opened');
			$('#i_'+a+'').addClass('dom_hidden').data('status', false);
			$('#'+a+'').addClass('dom_hidden');
			$('#fixed_nav').attr('_opened', 'task');
			$('#i_task').removeClass('dom_hidden').data('status', true);
			$('#task').removeClass('dom_hidden');
			$('#task_nav').removeClass('dom_hidden');
			clearTimeout( $('#learn_container').data().timeoutNum );
		}
	});
	$('#a_information_icon').click(function(){    // 進入 資訊區
		if( !$('#i_information').data().status ){
			$('#learn_nav').addClass('dom_hidden');
			$('#task_nav').addClass('dom_hidden');
			$('#cv_nav').addClass('dom_hidden');
			$('#co_nav').addClass('dom_hidden');
			var a = $('#fixed_nav').attr('_opened');
			$('#i_'+a+'').addClass('dom_hidden').data('status', false);
			$('#'+a+'').addClass('dom_hidden');
			$('#fixed_nav').attr('_opened', 'information');
			$('#i_information').removeClass('dom_hidden').data('status', true);
			$('#information').removeClass('dom_hidden');
			$('#information_nav').removeClass('dom_hidden');
			clearTimeout( $('#learn_container').data().timeoutNum );
			/*2013.10.21 chia*/
			SetTag_P();
		}
	});
	$('#learn_container').on('click', 'div.metro_front', function(){    // 點擊隱藏 神人區 Motto
		var a = $(this).parents('section.learn_item');
		$(this).removeClass('metro_front').css('background', '');
		$(this).parents('section.learn_item').data('isMetro', false);
	});
	$('#fixed_logo').click(function(){    // 點擊 Logo 重新載入網站
		window.location.reload();
	});
	$('#cv_box_leave').click(function(){    // 離開 個人簡歷 介面
		$('#cv_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
	});
	$('#co_container').on('click', 'i.co_item_more', function(){    // 進入 合作交流串 介面
		window.location.href = './cooperation/index.html';
	});
	$('#tabs-1').data('status', true);
	$('#cv_list').on('click', 'a', function(e){    // 個人履歷 Tabs 切換
		$(this).blur();
		e.preventDefault();
		var a = $(this).attr('href');
		if( !$(''+a+'').data().status ){
			$(''+$('#cv_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
			$('#cv_list').attr('_tabbed', a).find('li.tabs-active').removeClass('tabs-active');
			$(this).parent().addClass('tabs-active').blur();
			$(''+a+'').removeClass('dom_hidden').data('status', true);
		}
	});
	$('#cv_box_tabs-1').data('status', true);
	$('#cv_box_list').on('click', 'a', function(e){    // 他人履歷 Tabs 切換
		$(this).blur();
		e.preventDefault();
		var a = $(this).attr('href');
		if( !$(''+a+'').data().status ){
			$(''+$('#cv_box_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
			$('#cv_box_list').attr('_tabbed', a).find('li.tabs-active').removeClass('tabs-active');
			$(this).parent().addClass('tabs-active').blur();
			$(''+a+'').removeClass('dom_hidden').data('status', true);
		}
	});
	$('#a_fixed_arrow_up').click(function(){    // 
		var $a = $('#fixed_nav [role=top]');
		var a = parseInt( $a.attr('class').replace('item fixed_nav_item', '') );
		var b = parseInt( $('#fixed_nav').data().num );
		var c = a-b;
		if( c >= 0 ){
			$a.attr('class', 'item fixed_nav_item'+c+'');
		}else{
			$a.attr('class', 'item fixed_nav_item0');
		}
	});
	$('#a_fixed_arrow_down').click(function(){    // 
		var $a = $('#fixed_nav [role=top]');
		var a = parseInt( $a.attr('class').replace('item fixed_nav_item', '') );
		var b = parseInt( $('#fixed_nav').data().num );
		var c = a+b;
		if( (4-a) > b ){
			$a.attr('class', 'item fixed_nav_item'+c+'');
		}else{
			alert('已經是最底層了');
		}
	});
	$('#task_container').on('click', 'p', function(){    // 進入 問題討論串 介面
		window.location.href = './task/index.html';
	});
	$('#task_container').on('click', 'dd.task_user_data', function(){    // 任務區 點擊使用者
		$('#cv_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
	});
	$('#task_container').on('click', 'dd.task_classify_data > span', function(){    // 進入 分類 介面
		
	});
	$('#change_cv_img').click(function(){    // 更換使用者大頭像
		
	});
	$('#top_nav_UserImg').click(function(){    // 點擊 top nav 使用者大頭像
		var a = JSON.parse( localStorage.Based_CV );
		$('#top_nav_user_wrapperGoToCV').prev().text( a.EMAIL ).end().prevAll('[top-nav=username]').text( a.USERNAME );
		$('#top_nav-user_wrapper').removeClass('dom_hidden');
		SetCV( a.USERID );
		return false;
	});
	$('#top_nav_user_wrapperLogout').click(function(){    // 登出
		$.cookie.remove({ name: 'UserInfo', path: '/', domain: '' });
		localStorage.clear();
		window.location.href = './home/index.html';
	});
	$('#top_nav_user_wrapperHome').click(function(){    // 回到首頁
		window.location.replace( './home/index.html' );
	});
});
$(document).on('click', function(e){
	$('#top_nav-user_wrapper').addClass('dom_hidden');
});
$('#learn_container').on('click', 'div.learn_item_more',function(e){    // 神人區 點擊看更多使用者資訊
	$(''+$('#cv_box_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
	$('#cv_box_list').attr('_tabbed', '#cv_box_tabs-1').find('li.tabs-active').removeClass('tabs-active').end().find('li:nth-child(1)').addClass('tabs-active');
	$('#cv_box_tabs-1').removeClass('dom_hidden').data('status', true);
	ShowCV_Master( $(this).nextAll('div.master_hide_info').text() );
});
$(function(){    //
	$('#submitTask').click(function(){    // 點擊 搜尋任務
		$('#task_cloud').addClass('dom_hidden');
		$('#task_result').removeClass('dom_hidden');
		$('#backTask').removeClass('dom_hidden');
	});
	$('#backTask').click(function(){    // 點擊 搜尋任務
		$(this).addClass('dom_hidden');
		$('#task_cloud').removeClass('dom_hidden');
		$('#task_result').addClass('dom_hidden');
	});
});
$(function(){    // jQuery UI
	$('#cv_task-accordion, #cv_box_task-accordion, #cv_cooperation-accordion, #cv_box_cooperation-accordion').accordion({    // jQuery UI Accordion 設定
      heightStyle: 'content',
	  collapsible: true
    });
});
$(function(){    // jQuery Tipsy
   $('a[rel=tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});
   $('#change_cv_img').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
   //$('#learn_container div.learn_item_more').tipsy({gravity: $.fn.tipsy.autoWE});
});
window.onresize = function(){    // 視窗改變觸發
	SetViewport();
	$('#myCanvas').attr({ 'width': parseInt(localStorage.viewport_width)-50, 'height': parseInt(localStorage.viewport_height)-106 });
	if( $('#fixed_nav').attr('_opened') == 'task' ) SetTagCloud();
};
function SetViewport(){    // 設定 Viewport
	var viewportwidth, viewportheight;
	if( typeof window.innerWidth != 'undefined' ){
		viewportwidth = window.innerWidth,
		viewportheight = window.innerHeight
	}else if( typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth !='undefined' && document.documentElement.clientWidth != 0 ){
		// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)		
		viewportwidth = document.documentElement.clientWidth,
		viewportheight = document.documentElement.clientHeight
	}else{    
		// older versions of IE
		viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
		viewportheight = document.getElementsByTagName('body')[0].clientHeight
	}
	localStorage.setItem('viewport_width', viewportwidth);
	localStorage.setItem('viewport_height', viewportheight);
	SetMetroTag_P();
	SetFixedNav();
}
function SetFixedNav(){    // 關於左側導覽列滾動
	var a = localStorage.viewport_height-118;
	var b = ( Math.floor(a/55) > 4 ) ? 4 : Math.floor(a/55);
	$('#fixed_nav').data({ 'num': b });
	if( b >= 4 ){
		$('#fixed_nav [role=top]').attr('class', 'item fixed_nav_item0');
	}
}
function SetMetroTag_P(){    //  設定 Metro 介面 <p> 文字左右置中
	var a = $('#learn_master').find('div.others');
	a.children('p').css('width', a.width());
}
// Metro UI 顏色陣列
var aryMetroColor = new Array('#99b433', '#00a300', '#1e7145', '#ff0097', '#9f00a7', '#7e3878', '#603cba', '#1d1d1d', '#00aba9', '#2d89ef', '#2b5797', '#ffc40d', '#e3a21a', '#da532c', '#ee1111', '#b91d47');
function StartLearnMetro(){    // 學習區 Metro UI
	var a = $('#learn_master > section.master');
	var b = Math.floor(Math.random()*(a.length-1+1))+1;
	b = b - 1;    // 隨機選擇某個人
	var c = Math.floor(Math.random()*(aryMetroColor.length-1+1))+1;
	c = c - 1;    // 隨機選擇某個顏色
	if( !$(a[b]).data().isMetro ){    // 未顯示隱藏資訊
		$(a[b]).find('div.others').addClass('metro_front').css('background', aryMetroColor[c]).end().data('isMetro', true);
	}else{    // 已經顯示隱藏資訊
		$(a[b]).find('div.others').removeClass('metro_front').css('background', '').end().data('isMetro', false);
	}
	if( $('#i_learn').data().status ){
		var d = 1000*(Math.floor(Math.random()*(5-1+1))+1);    // 隨機設定下次執行此函式的間距
		var e = window.setTimeout(function(){
			StartLearnMetro();
		}, d);
		$('#learn_container').data('timeoutNum', e); console.log('StartLearnMetro');
	}
}
function InitialTagCloud(){    // 初始化 Tag Cloud
	var canvasWidth = parseInt(localStorage.viewport_width)-50;
	var canvasHeight = parseInt(localStorage.viewport_height)-106;
    $('#task_cloud').html( '<canvas id="myCanvas" width="'+canvasWidth+'" height="'+canvasHeight+'"></canvas>' );
}
function SetTagCloud(){    // 設定 Tag Cloud
	$('#myCanvas').tagcanvas({
		textColour : '#00f',
		depth : 1,
		dragControl : true,
		weight : true,
		weightMode : 'both',
		weightSizeMin : 12,
		weightSizeMax : 30,
		weightFrom : 'data-weight',
		weightGradient : { 0 : '#f00', 0.33 : '#ff0', 0.66 : '#0f0', 1 : '#00f' }
	}, 'weightTags');
}
function TagInput(s){    // 進入 分類 介面
	sessionStorage.setItem('TagInput', s.innerHTML);
	window.location.href = './task/index.html';
	return false;
}
function StartUsing(){    // 使用者開始使用 skill，設定 ip address and score
	$.ajax({    // 抓取 IP
		url: 'http://smart-ip.net/geoip-json?callback=?',
		dataType: 'json',
		success: function(data){  //console.log(data);
            sessionStorage.setItem( 'where', JSON.stringify( data ) );
			$.ajax({    //
				url: './php/start_using.php',
				data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, userip: data.host, usingtime: $.timestamp.get({readable: true}) },
				type: 'POST',
				dataType: 'html',
				success: function(msg){
					//console.log( msg );
					msg = msg.split('@');
					if( msg[0] == 'success' ){
					console.log( parseInt( msg[1] ) )
						if( parseInt( msg[1] ) == 1 ){
							var $a = $('#preloader');
							$a.find('span').text('每日登入，積分+5').end().removeClass('dom_hidden');
							window.setTimeout(function(){
								$a.find('span').text('您的積分：'+msg[2]+'');
								window.setTimeout(function(){
									$a.addClass('dom_hidden')
								}, 2000);
							}, 1000);
						}
						$('#score').text( msg[2] );
					}else if( msg[0] == 'error' ){
						alert( msg[1] );
					}
				},
				error:function(xhr, ajaxOptions, thrownError){ 
					console.log(xhr.status); 
					console.log(thrownError);
					alert('資料格式正確，但是伺服器發生錯誤。');
				}
			});
		}
	});
}
function CheckMaster(){    // 使用者開始使用 skill，設定 ip address and score
	var a = $.timestamp.get({readable: true}).split(' ')[0];
	var b = localStorage.Master_info || null;
	$.ajax({    //
		url: './php/check_master.php',
		data: { time: a },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				localStorage.setItem( 'Master_list', msg[3]+'@'+msg[2] );
				if( b == null || Math.abs( parseInt( Date.parse( a ) ) - parseInt( Date.parse( msg[3] ) ) ) > 24*60*60*1000 ){
					GetMaster();
				}else{
					ShowMaster( b );
				}
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
}
function GetMaster(){    // 抓神人資料
	$.ajax({    //
		url: './php/get_master.php',
		data: { time: $.timestamp.get({readable: true}).split(' ')[0] },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@@');
			if( msg[0] == 'success' ){
				localStorage.setItem( 'Master_info', msg[1] );
				ShowMaster( msg[1] );
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
}
function ShowMaster( a ){    // 顯示神人資料
	/* USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP */
	/*    0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13   */
	clearTimeout( $('#learn_container').data().timeoutNum );
	var o_data = JSON.parse( a ), count = 0, html = '';
	for( var obj in o_data ){ count += 1; }
	for( var i=0; i<count; i++ ){
		var a = o_data[i].split('***'), b = a[6].split(',');
		html += '<section class="learn_item master" master-id="'+a[0]+'">\
					\<div class="learn_item_left">\
						\<img src="" alt="未找到大頭貼" title="'+a[7]+'。<p>54 points : 0 followers</p>"/>\
					\</div>\
					\<div class="learn_item_right">\
						\<div class="learn_item_more" title="查看更多">> more...</div>\
						\<div class="details">\
							\<dl>\
								\<dt class="learn_user-'
									html += CheckGender( a[3] );
						html += '">&nbsp;</dt>\
								\<dd itemprop="user">'+a[1]+'</dd>\
							\</dl>\
							\<dl class="learn_score">\
								\<span class="badge1"></span>\
									\<span _badge="gold" class="badgecount">'+JSON.parse( CheckScore( a[12] ) ).gold+'</span>\
									\<span class="badge2"></span>\
									\<span _badge="silver" class="badgecount">'+JSON.parse( CheckScore( a[12] ) ).silver+'</span>\
									\<span class="badge3"></span>\
									\<span _badge="copper" class="badgecount">'+JSON.parse( CheckScore( a[12] ) ).copper+'</span>\
							\</dl>\
							\<dl>\
								\<dt class="learn_education">&nbsp;</dt>\
								\<dd itemprop="education">';
									html+=a[4];
						html += '</dd>\
							\</dl>\
							\<dl>\
								\<dt class="learn_email">&nbsp;</dt>\
								\<dd itemprop="email">\
									\<a class="a_learn_email">'+a[2]+'</a>\
								\</dd>\
							\</dl>\
							\<dl>\
								\<dt class="learn_join">&nbsp;</dt>\
								\<dd itemprop="join">\
									\<span class="learn_join_label">Joined on </span>\
									\<span>'+a[5]+'</span>\
								\</dd>\
							\</dl>\
							\<dl>\
								\<dt class="learn_skill">&nbsp;</dt>\
								\<dd itemprop="skill" class="learn_skill_data">';
									for( var j=0; j<b.length; j++ ){ html += '<span>'+b[j]+'</span>'; }
						html += '</dd>\
							\</dl>\
						\</div>\
						\<div class="others">\
							\<p itemprop="motto">'+a[7]+'</p>\
						\</div>\
						\<div class="master_hide_info" style="display: none;">'+o_data[i]+'</div>\
					\</div>\
				\</section>';
	}
	$('#learn_master').html( html );
	 $('#learn_master section.master img').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
	StartLearnMetro();
	SetMetroTag_P();
}
function ShowCV_Master( data ){
	/* USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP */
	/*    0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13   */
	var a = data.split('***'), b = '', c = a[6].split(','), d = '', e = a[8].split(',');
	for( var j=0; j<c.length; j++ ){ b += '<span>'+c[j]+'</span>'; }
	for( var j=0; j<e.length; j++ ){ d += '<span>'+e[j]+'</span>'; }
	$('#cv_box_nav > section').find('[itemprop=user]').text( a[1] ).prev().attr('class', 'cv_user-'+CheckGender( a[3] )+'').end().end()
			.find('#cv_follow').attr( 'user-id', a[0] ).end()
			.find('[_badge=gold]').text( JSON.parse( CheckScore( a[12] ) ).gold ).end()
			.find('[_badge=silver]').text( JSON.parse( CheckScore( a[12] ) ).silver ).end()
			.find('[_badge=copper]').text( JSON.parse( CheckScore( a[12] ) ).copper );
	$('#cv_box_tabs-1').find('[itemprop=education]').text( a[4] ).end()
			.find('[itemprop=email] > a').text( a[2] ).end()
			.find('[itemprop=join_time]').text( a[5] ).end()
			.find('[itemprop=skill]').html( b ).end()
			.find('[itemprop=motto]').text( a[7] ).end()
			.find('[itemprop=need]').html( d ).end()
			.find('[itemprop=about]').text( a[9] ).end()
			.find('[itemprop=experience]').text( a[10] );
			_badge="gold"
	$('#cv_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
}
function SetCV( data ){    // 設定個人履歷
	/* USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP */
	/*    0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13   */
	$.ajax({    //
		url: './php/get_CV.php',
		data: { userid: data },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@@');
			if( msg[0] == 'success' ){
				localStorage.setItem( 'my_CV', msg[1] );
				var a = JSON.parse( msg[1] )[0].split('***'), b = a[6].split(','), c = '', d = a[8].split(','), e = '';
				$('#cv_nav > section').find('[itemprop=user]').text( a[1] ).prev().attr('class', 'cv_user-'+CheckGender( a[3] )).end().end()
						.find('[_badge=gold]').text( JSON.parse( CheckScore( a[12] ) ).gold ).end()
						.find('[_badge=silver]').text( JSON.parse( CheckScore( a[12] ) ).silver ).end()
						.find('[_badge=copper]').text( JSON.parse( CheckScore( a[12] ) ).copper );
				for( var i=0; i<b.length; i++ ){ c += '<span>'+b[i]+'</span>'; }
				for( var i=0; i<d.length; i++ ){ e += '<span>'+d[i]+'</span>'; }
				$('#tabs-1').find('[itemprop=education]').text( a[4] ).end()
							.find('[itemprop=skill]').html( c ).end()
							.find('[itemprop=email] > a').text( a[2] ).end()
							.find('[itemprop=join_time]').text( a[5] ).end()
							.find('[itemprop=motto]').text( a[7] ).end()
							.find('[itemprop=need]').html( e ).end()
							.find('[itemprop=about]').text( a[9] ).end()
							.find('[itemprop=experience]').text( a[10] );
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
	return false;
}
function CheckGender(a){
	if( parseInt( a ) == 1 ){  // 男
		return 'male';
	}else if( parseInt( a ) == 2 ){  // 女
		return 'female';
	}else{  // 組織
		return 'organization';
	}
}
function CheckScore(a){
	var copper = parseInt( a )%1000;
	var temp = parseInt( a )/1000;
	var gold = Math.floor( temp/10 );
	var silver = Math.floor( temp )%10;
	return JSON.stringify( { gold: gold, silver: silver, copper: copper } );
}