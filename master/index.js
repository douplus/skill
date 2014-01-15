$(function(){  // header
	$('#top_nav_user_wrapperImg').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
	/*$('#SearchAccount').on('keyup', function() {
        clearTimeout($(this).data('timer'));
        var search = this.value;
        if (search.length >= 2) {
            $(this).data('timer', setTimeout(function(){
                $.ajax({
                    type: 'POST',
                    url: '../php/search_cv.php',
                    data: { show: search }
                }).done(function(msg) {
                    //$('#t').html(msg);
					console.log(msg);
                });
            }, 1000));
        }
    });*/
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
$(document).on('click', 'div.metro_front', function(){  // 點擊隱藏 神人區 Motto
	var a = $(this).parents('section.learn_item');
	$(this).removeClass('metro_front').css('background', '');
	$(this).parents('section.learn_item').data('isMetro', false);
});
$(document).on('keydown', '#SearchAccount', function(e){  // 點擊 搜尋用戶
	if( $(this).is(':focus') && (e.keyCode == 13) ){
		if( $(this).val() == '' ){ alert('請輸入搜尋內容'); return false; }
		Account_Search( $(this).val() );
	}
});
function Account_Search( a ){
	alert('即將開放。');
}
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
	}
}
function StartUsing(){    // 使用者開始使用 skill，設定 ip address and score
	console.log('StartUsing');
	$.ajax({    //
		url: '../php/start_using.php',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, usingtime: $.timestamp.get({readable: true}) },
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
				SetPhoto( msg[3] );    console.log(parseInt( msg[6] ));
				if( parseInt( msg[4] ) == 0 ){
					$('#error_log').text('請盡快認證信箱，否則系統將於'+msg[5]+'封鎖您的帳號。').parent().removeClass('dom_hidden');
				}
				if( parseInt( msg[6] ) == 1 ){
					document.write('<script type="text/undefined">');
					alert('您的信箱超過14天未驗證成功，帳號已被停用。');
					$.cookie.remove({ name: 'UserInfo', path: '/', domain: '' });
					localStorage.clear();
					window.location.href = '../home/index.html';
				}
			}else if( msg[0] == 'error' ){
				alert( msg[1] );
				if( msg[2] == 'null' ){
					$.cookie.remove({ name: 'UserInfo', path: '/', domain: '' });
					localStorage.clear();
					window.location.href = '../home/index.html';
				}
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
}
function SetIP(){    // 使用者開始使用 skill，設定 ip address and score
	$.ajax({    // 設定 IP
		url: '../php/user_ip.php',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, userip: $('meta[name=ip]').attr('content') },
		type: 'POST',
		dataType: 'html',
		success: function(msg){  //console.log(msg);
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				console.log( msg[1] );
			}else if( msg[0] == 'error' ){
				console.log( msg[1] );
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			console.log('資料格式正確，但是伺服器 設定 IP 發生錯誤。');
		}
	});
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
$(function(){ SetIP(); });