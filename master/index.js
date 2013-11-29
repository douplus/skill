$(function(){  // header
	$('#top_nav_user_wrapperImg').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
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
	$('#top_nav_UserImg').click(function(){    // 點擊 top nav 使用者大頭像
		var a = JSON.parse( localStorage.Based_CV );
		$('#GoToAccount').prevAll('[top-nav=username]').text( a.USERNAME );
		$('#top_nav-user_wrapper').removeClass('dom_hidden');
		return false;
	});
	$('#top_nav_user_wrapperLogout').click(function(){    // 登出
		$.cookie.remove({ name: 'UserInfo', path: '/', domain: '' });
		localStorage.clear();
		window.location.href = '../home/index.html';
	});
	$('#top_logo').click(function(){    // 點擊 Logo 重新載入網站
		window.location.href = '../master/index.php';
	});
	$(window).resize(function(){
		SetMetroTag_P();
		SetInforTag_P();
	});
});
$(document).on('click', function(e){
	$('#top_nav-user_wrapper').addClass('dom_hidden');
});
// 神人
$(document).on('click', 'div.metro_front', function(){    // 點擊隱藏 神人區 Motto
	var a = $(this).parents('section.learn_item');
	$(this).removeClass('metro_front').css('background', '');
	$(this).parents('section.learn_item').data('isMetro', false);
});
/*
function SetFixedNav(){    // 關於左側導覽列滾動
	var a = localStorage.viewport_height-118;
	var b = ( Math.floor(a/55) > 5 ) ? 5 : Math.floor(a/55);
	$('#fixed_nav').data({ 'num': b });
	if( b >= 5 ){
		$('#fixed_nav [role=top]').attr('class', 'item fixed_nav_item0');
	}
}*/
function SetMetroTag_P(){    //  設定 Metro 介面 <p> 文字左右置中
	var a = $('#learn_container').find('div.others');
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
	if( !$(a[b]).data('isMetro') ){    // 未顯示隱藏資訊
		$(a[b]).find('div.others').addClass('metro_front').css('background', aryMetroColor[c]).end().data('isMetro', true);
	}else{    // 已經顯示隱藏資訊
		$(a[b]).find('div.others').removeClass('metro_front').css('background', '').end().data('isMetro', false);
	}
	if( $('#i_learn').attr('Class') == '' ){
		var d = 1000*(Math.floor(Math.random()*(5-1+1))+1);    // 隨機設定下次執行此函式的間距
		var e = window.setTimeout(function(){
			StartLearnMetro();
		}, d);
		$('#preloader').data('timeoutNum', e); console.log('StartLearnMetro');
	}
}
function PjaxSuccess(){
	clearTimeout( $('#preloader').data().timeoutNum );
	$('div.tipsy').remove();
	InitialMaster();
}
$(function(){    // 設定
	InitialMaster();
	$('a[rel=tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});
});
function InitialMaster(){
	if( $('#i_learn').attr('Class') == '' ){
		//$('#learn_container div.learn_item_more').tipsy({gravity: $.fn.tipsy.autoWE});
		CheckMaster();
	}
}
function StartUsing(){    // 使用者開始使用 skill，設定 ip address and score
	$.ajax({    // 抓取 IP
		url: 'http://smart-ip.net/geoip-json?callback=?',
		dataType: 'json',
		success: function(data){  //console.log(data);
            sessionStorage.setItem( 'where', JSON.stringify( data ) );
			$.ajax({    //
				url: '../php/start_using.php',
				data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, userip: data.host, usingtime: $.timestamp.get({readable: true}) },
				type: 'POST',
				dataType: 'html',
				success: function(msg){
					console.log( msg );
					msg = msg.split('@');
					if( msg[0] == 'success' ){
						if( parseInt( msg[1] ) == 1 ){
							var $a = $('#preloader');
							$a.find('span').text('每日登入，積分+5').end().removeClass('dom_hidden');
							window.setTimeout(function(){
								$a.find('span').text('您的積分：'+msg[2]+'');
								window.setTimeout(function(){
									$a.addClass('dom_hidden');
								}, 2000);
							}, 1000);
						}
						$('#score').text( msg[2] );
						localStorage.setItem('photo_file', msg[3]);
						SetPhoto( msg[3] );
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
		url: '../php/check_master.php',
		data: { time: a },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				localStorage.setItem( 'Master_list', msg[3]+'@'+msg[2] );
				GetMaster();
				/*if( parseInt( msg[1] ) != 0 || b == null || Math.abs( parseInt( Date.parse( a ) ) - parseInt( Date.parse( msg[3] ) ) ) > 0 ){
					GetMaster(); console.log('GetMaster');
				}else{
					ShowMaster( b ); console.log('ShowMaster');
				}*/
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
		url: '../php/get_master.php',
		data: { time: $.timestamp.get({readable: true}).split(' ')[0] },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
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
	/* USERID,USERNAME,EMAIL,GENDER,DEPARTMENT,JOIN_TIME,SKILL,MOTTO,NEED,ABOUT_ME,EXPERIENCE,LASTUSING_TIME,SCORE,USERIP,USER_PHOTO */
	/*    0  ,    1   ,  2  ,   3  ,     4    ,    5    ,  6  ,  7  ,  8 ,    9   ,    10    ,       11     ,  12 ,  13  ,    14   */
	clearTimeout( $('#learn_container').data().timeoutNum );
	var o_data = JSON.parse( a ), count = 0, html = '';
	for( var obj in o_data ){ count += 1; }
	for( var i=0; i<count; i++ ){
		var a = o_data[i].split('***'), b = a[6].split(',');
		var photo = '../photo/'+a[14]+'?rand=' + Math.random();
		html += '<section class="learn_item master" master-id="'+a[0]+'">\
					\<div class="learn_item_left">\
						\<img src="';
						html += photo+'" alt="loading" title="'+a[7]+'。<p>54 points : 0 followers</p>"/>\
					\</div>\
					\<div class="learn_item_right">\
						\<a class="learn_item_more" href="../profile/index.php?u=';
							html += a[0];
						html += '" data-pjax="profile" title="履歷">&gt; more...</a>\
						\<div class="details">\
							\<dl>\
								\<dt class="learn_user-';
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
							\<strong>Score:<span itemprop="motto-score">100</span></strong>\
						\</div>\
					\</div>\
				\</section>';
	}
	$('#learn_master').html( html );
	$('#learn_master section.master img').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
	window.setTimeout(function(){
		StartLearnMetro();
		SetMetroTag_P();
	}, 1000);
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
function SetPhoto( a ){
	a = a+'?rand=' + Math.random();
	$('#top_nav_user_wrapperImg').attr('src', '../photo/'+a).parents('#top_nav-user_wrapper').prev().children('#top_nav_UserImg').attr('src', '../photo/'+a);
}