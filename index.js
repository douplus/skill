$(function(){    // 初始設定
	SetViewport();
	InitialTagCloud();
	SetTagCloud();
	SetMetroTag_P();
	window.setTimeout(function(){
		StartLearnMetro();
	}, 1000);
	$('#i_learn').removeClass('dom_hidden').data('status', true);
	SetCV();
});
$(function(){
	$('#a_cv_icon, #top_nav_user_wrapperGoToCV').click(function(){    // 進入 個人履歷
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
	$('#learn_container').on('click', 'div.learn_item_more', function(){    // 神人區 點擊看更多使用者資訊
		$(''+$('#cv_box_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
		$('#cv_box_list').attr('_tabbed', '#cv_box_tabs-1').find('li.tabs-active').removeClass('tabs-active').end().find('li:nth-child(1)').addClass('tabs-active');
		$('#cv_box_tabs-1').removeClass('dom_hidden').data('status', true);
		$('#cv_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
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
		if( (5-a) > b ){
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
		$('#top_nav-user_wrapper').removeClass('dom_hidden');
		return false;
	});
	$('#top_nav_user_wrapperLogout').click(function(){    // 登出
		$.cookie.remove({ name: 'UserInfo', path: '/', domain: '' });
		localStorage.clear();
		window.location.href = './home/index.html';
	});
});
$(document).on('click', function(e){
	$('#top_nav-user_wrapper').addClass('dom_hidden');
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
   $('#learn_container .master img').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
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
	var b = ( Math.floor(a/55) > 5 ) ? 5 : Math.floor(a/55);
	$('#fixed_nav').data({ 'num': b });
	if( b >= 5 ){
		$('#fixed_nav [role=top]').attr('class', 'item fixed_nav_item0');
	}
}
function SetMetroTag_P(){    //  設定 Metro 介面 <p> 文字左右置中
	var a = $('#learn_container').find('div.others');
	a.children('p').css('width', a.width());
}
// Metro UI 顏色陣列
var aryMetroColor = new Array('#99b433', '#00a300', '#1e7145', '#ff0097', '#9f00a7', '#7e3878', '#603cba', '#1d1d1d', '#00aba9', '#2d89ef', '#2b5797', '#ffc40d', '#e3a21a', '#da532c', '#ee1111', '#b91d47');
function StartLearnMetro(){    // 學習區 Metro UI
	var a = $('#learn_container > article > section.master');
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
function SetCV(){    // 進入 分類 介面
	var obj = JSON.parse( localStorage.UserCV );
	if( parseInt( obj.GENDER ) == 1 ){  // 男
		var gender = 'male';
	}else if( parseInt( obj.GENDER ) == 2 ){  // 女
		var gender = 'female';
	}else{  // 組織
		var gender = 'organization';
	}
	$('#cv_nav').find('[itemprop=user]').text( obj.USERNAME ).prev().attr('class', 'cv_user-'+gender);
	var a = obj.SKILL.split(','), b = '';
	for( var i=0; i<a.length; i++ ){
		b += '<span>'+a[i]+'</span>';
	}
	$('#tabs-1 > section.cv_list').find('[itemprop=skill]').html( b ).end()
									.find('[itemprop=email]').children().text( obj.EMAIL ).end().end()
									.find('[itemprop=join] > span:nth-child(2)').text( obj.JOIN_TIME );
	$('#tabs-1 > section.cv_motto').find('p').text( obj.MOTTO );
	var c = obj.NEED.split(','), d = '';
	for( var i=0; i<c.length; i++ ){
		d += '<span>'+c[i]+'</span>';
	}
	$('#tabs-1 > section.cv_need').find('div.cv_need_list').html( d );
	$('#top_nav_user_wrapperGoToCV').prev().text( obj.EMAIL ).end().prevAll('[top-nav=username]').text( obj.USERNAME );
	return false;
}