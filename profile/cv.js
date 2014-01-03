$(function(){
	// jQuery UI
	/*$('#tabs-1').data('status', true);
	$('#page-container').on('click', 'a.cv_list_a', function(e){    // 個人履歷 Tabs 切換
		$(this).blur();
		e.preventDefault();
		var a = $(this).attr('href');
		if( !$(''+a+'').data().status ){
			$(''+$('#cv_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
			$('#cv_list').attr('_tabbed', a).find('li.tabs-active').removeClass('tabs-active');
			$(this).parent().addClass('tabs-active').blur();
			$(''+a+'').removeClass('dom_hidden').data('status', true);
			if( a === '#cv_tabs-4' ){
				GetFollow( JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, $('#cv_follow').attr('user-id') );
			}
		}
	});*/
	$('#page-container').on('click', '#cv_activate', function(e){  // 履歷區: 點擊 開通
		if( $(this).data('activate') == 'no' ){
			$('#preloader').find('span').text('設定開通中...').end().removeClass('dom_hidden');
			SetActivate( $(this).attr('user-id'), this );
		}
	});
	$('#page-container').on('click', '#cv_follow', function(e){  // 履歷區: 點擊 關注
		if( $(this).data('follow') == 'no' ){
			$('#preloader').find('span').text('請稍後...').end().removeClass('dom_hidden');
			SetFollow( $(this).attr('user-id'), 'cv', this );
		}
	});
	$('#page-container').on('click', '#cv_unfollow', function(e){  // 履歷區: 點擊 取消關注
		if( $(this).data('follow') == 'yes' ){
			$('#preloader').find('span').text('請稍後...').end().removeClass('dom_hidden');
			SetUnfollow( $(this).attr('user-id'), 'cv', this );
		}
	});
	$('#page-container').on('click', 'div[_btn=follow]', function(e){  // 關注區: 點擊 關注
		$('#preloader').find('span').text('請稍後...').end().removeClass('dom_hidden');
		SetFollow( $(this).attr('user-id'), 'tab', this );
	});
	$('#page-container').on('click', 'div[_btn=unfollow]', function(e){  // 關注區: 點擊 取消關注
		$('#preloader').find('span').text('請稍後...').end().removeClass('dom_hidden');
		SetUnfollow( $(this).attr('user-id'), 'tab', this );
	});
});
$(document).on('click', '#follow_wrapper img', function(){  // 點擊 關注區裡面的 <img>
	$(this).parent().next().find('a').trigger('click');
});
function SetActivate( a, b ){
	$.ajax({
		url: '../php/set_activate.php',
		type: 'POST',
		data: { activater: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, activated: a },
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				if( parseInt( msg[1] ) == 1 ){
					alert( msg[2] );
				}else{
					alert( '已寄開通信至您的信箱。' );
				}
				$(b).data('activate', 'yes').css({'opacity': .5, 'cursor': 'default'}).val('已開通');
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
function SetFollow( a, b, c ){
	$.ajax({
		url: '../php/set_follow.php',
		type: 'POST',
		data: { follower: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, followed: a },
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				if( parseInt( msg[1] ) == 1 ){
					alert( msg[2] );
				}
				if( b === 'cv' ){
					$(c).addClass('dom_hidden').data('follow', 'yes').next().removeClass('dom_hidden').data('follow',  'yes');
				}else if( b === 'tab' ){
					var num = parseInt( $(c).parent().prev().find('span').text() ) + 1;
					$(c).addClass('dom_hidden').next().removeClass('dom_hidden').parent().prev().find('span').text( num );
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
function SetUnfollow( a, b, c ){
	$.ajax({
		url: '../php/set_unfollow.php',
		type: 'POST',
		data: { follower: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, followed: a },
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				if( b === 'cv' ){
					$(c).addClass('dom_hidden').data('follow', 'no').prev().removeClass('dom_hidden').data('follow', 'no');
				}else if( b === 'tab' ){
					var num = parseInt( $(c).parent().prev().find('span').text() ) - 1;
					$(c).addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().find('span').text( num );
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
/*
function GetFollow( a, b ){
	$.ajax({
		url: '../php/get_follow.php',
		type: 'POST',
		data: { viewerid: a, userid: b, start: '0' },
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				ShowFollow( msg[2], msg[3], msg[4], msg[5], JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, msg[6], msg[7] );
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
function ShowFollow( a, b, c, d, e, g, h ){
	* USERID, USERNAME, USER_PHOTO, FOLLOWERS, IS_FOLLOW(yes/no) *
	/*    0  ,     1   ,      2    ,     3    ,         4         *
	var temp1 = '', temp2 = '', temp3 = '';
	if( parseInt( a ) != 0 ){  // 顯示關注中
		var o_following = JSON.parse( b );
		for( var i=0; i<parseInt(a); i++ ){
			var f = o_following[i].split('***');
			temp1 += '<section class="follow_item">\
						\<section class="left">\
							\<img title="'+f[1]+'" src="../photo/'+f[2]+'">\
						\</section>\
						\<section class="center">\
							\<div class="title"><a data-pjax="profile" href="../profile/index.php?u='+f[0]+'&v='+e+'">'+f[1]+'</a></div>\
							\<div class="context">Followers: <span>'+f[3]+'</span></div>\
						\</section>\
						\<section class="right">';
				if( f[0] === e ){
				}else if( f[4] === 'yes' ){
					temp1 += '<div _btn="follow" class="bottom chinese dom_hidden" user-id="'+f[0]+'">關注</div><div _btn="unfollow" class="bottom chinese" user-id="'+f[0]+'">取消關注</div>';
				}else{
					temp1 += '<div _btn="follow" class="bottom chinese" user-id="'+f[0]+'">關注</div><div _btn="unfollow" class="bottom chinese dom_hidden" user-id="'+f[0]+'">取消關注</div>';
				}
			temp1 += '</section></section>';
		}
	}else{
		temp1 = '<section class="follow_item chinese">沒有正在關注的對象。</section>';
	}
	if( parseInt( c ) != 0 ){  // 顯示追隨者
		var o_follower = JSON.parse( d );
		for( var i=0; i<parseInt(c); i++ ){
			var f = o_follower[i].split('***');
			temp2 += '<section class="follow_item">\
						\<section class="left">\
							\<img title="'+f[1]+'" src="../photo/'+f[2]+'">\
						\</section>\
						\<section class="center">\
							\<div class="title"><a data-pjax="profile" href="../profile/index.php?u='+f[0]+'&v='+e+'">'+f[1]+'</a></div>\
							\<div class="context">Followers: <span>'+f[3]+'</span></div>\
						\</section>\
						\<section class="right">';
				if( f[0] === e ){
				}else if( f[4] === 'yes' ){
					temp2 += '<div _btn="follow" class="bottom chinese dom_hidden" user-id="'+f[0]+'">關注</div><div _btn="unfollow" class="bottom chinese" user-id="'+f[0]+'">取消關注</div>';
				}else{
					temp2 += '<div _btn="follow" class="bottom chinese" user-id="'+f[0]+'">關注</div><div _btn="unfollow" class="bottom chinese dom_hidden" user-id="'+f[0]+'">取消關注</div>';
				}
			temp2 += '</section></section>';
		}
	}else{
		temp2 = '<section class="follow_item chinese">沒有追隨者。</section>';
	}
	if( parseInt( g ) != 0 ){  // 顯示 已開通
		var o_activated = JSON.parse( h );
		for( var i=0; i<parseInt(g); i++ ){
			var f = o_activated[i].split('***');
			temp3 += '<section class="follow_item">\
						\<section class="left">\
							\<img title="'+f[1]+'" src="../photo/'+f[2]+'">\
						\</section>\
						\<section class="center">\
							\<div class="title"><a data-pjax="profile" href="../profile/index.php?u='+f[0]+'&v='+e+'">'+f[1]+'</a></div>\
							\<div class="context">Followers: <span>'+f[3]+'</span></div>\
						\</section>\
					\</section>';
		}
	}else{
		temp3 = '<section class="follow_item chinese">沒有開通紀錄。</section>';
	}
	$('#following').attr('num', a).html( temp1 ).next().attr('num', c).html( temp2 ).next().attr('num', g).html( temp3 );
}*/