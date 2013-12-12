$(function(){
	// jQuery UI
	$('#account_tabs-1').data('status', true);
	$('#page-container').on('click', 'a.account_list_a', function(e){    // 個人履歷 Tabs 切換
		$(this).blur();
		e.preventDefault();
		var a = $(this).attr('href');
		if( !$(''+a+'').data().status ){
			$(''+$('#account_list').attr('_tabbed')+'').addClass('dom_hidden').data('status', false);
			$('#account_list').attr('_tabbed', a).find('li.tabs-active').removeClass('tabs-active');
			$(this).parent().addClass('tabs-active').blur();
			$(''+a+'').removeClass('dom_hidden').data('status', true);
			if( a === '#account_tabs-4' ){
				GetFollow( JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid );
			}
		}
	});
	$('#top_nav_user_wrapperImg, #top_nav_user_wrapperImg + span').click(function(){    // 點擊 更改大頭貼
		$('#box').attr('role-now', 'user_img').removeClass('dom_hidden').children('[box-role=user_img]').removeClass('dom_hidden');
	});
	$('#Notification-btn').click(function(){  // 點擊 通知按鈕
		//$('#box').attr('role-now', 'user_img').removeClass('dom_hidden').children('[box-role=user_img]').removeClass('dom_hidden');
		alert('即將開放。');
	});
	$('#user_img_leave').click(function(){  // 離開 更改大頭貼 介面
		$('#box').attr('role-now', '').addClass('dom_hidden').children('[box-role=user_img]').addClass('dom_hidden');
	});
	$('#change_passwd_leave').click(function(){  // 離開 變更密碼 介面
		$('#box').attr('role-now', '').addClass('dom_hidden').children('[box-role=change_passwd]').addClass('dom_hidden');
	});
	$('#change_passwd-save').click(function(){  // 儲存 變更密碼
		$('#change_passwd-summary').html('').parent().addClass('dom_hidden');
		var a = $('#change_passwd-new').val();
		var b = $('#change_passwd-again').val();
		var c = true;
		if( a == '' || a.length < 6 || a.length > 12 || b == '' || b.length < 6 || b.length > 12 ){
			$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>新密碼的長度應該是 6~12 位數</li>');
			c = false;
		}else{
			if( a !== b ){
				$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>新密碼與確認密碼不相同</li>');
				c = false;
			}else{
				if( a.match(/\s/g) == null ){  // 判斷空白： \s
					var bl = CheckPassword( a );
					if( !bl ){
						$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>新密碼不能含有符號字元</li>');
						c = false;
					}
				}else{
					$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>新密碼不能含有空白字元</li>');
					c = false;
				}
			}
		}
		if( $('#change_passwd-old').val().trim() == '' ){
			$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>請輸入目前的密碼</li>');
			c = false;
		}
		if( c ){
			ChangePassword( $('#change_passwd-old').val(), a );
		}else{
			$('#change_passwd-summary').parent().removeClass('dom_hidden');
			$('#change_passwd-old').val('');
			$('#change_passwd-new').val('');
			$('#change_passwd-again').val('');
		}
	});
	$('#change_passwd-again, #change_passwd-old, #change_passwd-new').keydown(function(e){    // 按下 enter 變更密碼
		if ($(this).is(':focus') && (e.keyCode == 13)) {
			$('#change_passwd-save').trigger('click');
		}
	});
});
function ChangePassword( a, b ){  // 更改密碼
	$('#preloader').find('span').text('正在設定密碼...').end().removeClass('dom_hidden');
	$.ajax({    // 設定 Motto
		url: '../php/change_passwd.php',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, old_passwd: a, new_passwd: b },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				if( parseInt( msg[1] ) == 1 ){
					alert( msg[2] );
					$('#box').attr('role-now', '').addClass('dom_hidden').children('[box-role=change_passwd]').addClass('dom_hidden');
				}else{
					$('#change_passwd-summary').append('<li><i class="icon-sign icon-sign-error"></i>'+msg[2]+'</li>').parent().removeClass('dom_hidden');
				}
			}else{
				alert( msg[1] );
			}
			$('#change_passwd-old').val('');
			$('#change_passwd-new').val('');
			$('#change_passwd-again').val('');
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
			alert('資料格式正確，但是伺服器發生錯誤。');
		}
	});
}
function CheckPassword( a ){  // 檢查密碼是否有符合格式
	if( CheckStr( a ) ){
		return true;
	}else{
		return false;
	}
}
function CheckStr( a ){  // 只能有 _ 和 - 能使用
    if( /^[^@\/\'\\\"#$%&\^\*\=\+\(\)\?\:\[\]\{\}\!\~\.\,]+$/.test( a ) ){
		if( a.match(/\\/g) == null ){  // 判斷反斜線： \ 
			return true;
		}else{
			return false;
		}
	}else{
        return false; 
	}
}
$(function(){
	$('#UserImg_upload-btn').click(function(){
		$('#UserImg_upload').trigger('click');
	});
	$('#UserImg_save-btn').click(function(){
		saveImage();
	});
	initial_slicer();
});
var slicer;
function initial_slicer(){
	slicer = new ImageCropper(304, 304, 114, 114);
	slicer.setCanvas('UserImg_slicer');
	slicer.addPreview('UserImg_preview');
	if( !slicer.isAvailable() ){
		alert('your browser doesn\'t support the FileReader');
	}
}
function saveImage(){
	var type = slicer.getImgType() || null;
	if( type == null ) return alert('請先選擇圖片。');
	$('#preloader').find('span').text('上傳中...').end().removeClass('dom_hidden');
	var imgData = slicer.getCroppedImageData(114, 114, type);
	var userid = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;
	type = type.substring(6);
	$.ajax({
		url: '../php/upload_img.php',
		type: 'POST',
		data: { user_id: userid, photo: imgData },
		contentType: "application/x-www-form-urlencoded;charset=UTF-8",
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			if( msg[0] == 'success' ){
				alert( '上傳圖片成功。' );
				var a = userid+'.jpg?rand=' + Math.random();
				SetPhoto( a );
				$('#user_img_leave').trigger('click');
				$('#preloader').addClass('dom_hidden');
				localStorage.setItem('photo_file', a);
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
function selectImage( fileList ){
	console.log(fileList[0]);
	if( slicer.isImage( fileList[0] ) ){
		slicer.loadImage( fileList[0] );
	}else{
		alert('這個不是圖片檔唷。');
	}
}
$(document).on('click', '#account_container em.account_modify',function(){  // 編輯 資訊
	switch( $(this).attr('_role') ){
		case 'account_experience':
		case 'account_about':
		case 'account_motto':
		case 'account_education':
		case 'account_email':
			var $a = $(this).parent();
			var a = $a.prev().children().text();
			$a.prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children().val( a );
			$(this).data('temp', a).addClass('dom_hidden').next().removeClass('dom_hidden');
			break;
		case 'account_skill':
			Edit_Skill( $(this) );
			break;
		case 'account_need':
			Edit_Need( $(this) );
			break;
		default:
			break;
	}
});
$(document).on('click', '#account_container section.account_edit > [_action=cancel]',function(){  // 取消 修改資訊
	switch( $(this).attr('_role') ){
		case 'account_experience':
		case 'account_about':
		case 'account_motto':
		case 'account_education':
		case 'account_email':
			var a = $(this).parent().prev().data().temp;
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
			break;
		case 'account_skill':
			var a = $(this).parent().prev().data().temp;
			var b = a.split(',');
			var temp = '';
			for( var i=0; i<b.length; i++ ){
				temp += '<span>'+b[i]+'</span>';
			}
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_skill').val(a);
			break;
		case 'account_need':
			var a = $(this).parent().prev().data().temp;
			var b = a.split(',');
			var temp = '';
			for( var i=0; i<b.length; i++ ){
				temp += '<span>'+b[i]+'</span>';
			}
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_need').val(a);
			break;
		default:
			break;
	}
});
$(document).on('click', '#account_container section.account_edit > [_action=save]',function(){  // 儲存 修改資訊
	var temp = true;
	switch( $(this).attr('_role') ){
		case 'account_experience':
			var experience = $('#modify_experience').val().trim();
			if( experience == '' ){
				alert('未填寫內容。');
				temp = false;
			}else{
				if( experience.length > 140 ){
					alert('內容不可以超過 140 個字元。');
					temp = false;
				}else{
					var bl = CheckTextarea( experience );
					if( !bl ){
						alert('內容格式錯誤，含有未認可的特殊字元。');
						temp = false;
					}
				}
			}
			if( temp ) SaveExperience( experience, this );
			break;
		case 'account_about':
			var about = $('#modify_about').val().trim();
			if( about == '' ){
				alert('未填寫內容。');
				temp = false;
			}else{
				if( about.length > 100 ){
					alert('內容不可以超過 100 個字元。');
					temp = false;
				}else{
					var bl = CheckTextarea( about );
					if( !bl ){
						alert('內容格式錯誤，含有未認可的特殊字元。');
						temp = false;
					}
				}
			}
			if( temp ) SaveAbout( about, this );
			break;
		case 'account_motto':
			var motto = $('#modify_motto').val().trim();
			if( motto == '' ){
				alert('未填寫內容。');
				temp = false;
			}else{
				if( motto.length > 50 ){
					alert('內容不可以超過 50 個字元。');
					temp = false;
				}else{
					var bl = CheckTextarea( motto );
					if( !bl ){
						alert('內容格式錯誤，含有未認可的特殊字元。');
						temp = false;
					}
				}
			}
			if( temp ) SaveMotto( motto, this );
			break;
		case 'account_education':
			var education = $('#modify_education').val().trim();
			if( education == '' ){
				alert('未填寫內容。');
				temp = false;
			}else{
				if( education.length > 50 ){
					alert('內容不可以超過 50 個字元。');
					temp = false;
				}else{
					var bl = CheckTextarea( education );
					if( !bl ){
						alert('內容格式錯誤，含有未認可的特殊字元。');
						temp = false;
					}
				}
			}
			if( temp ) SaveEducation( education, this );
			break;
		case 'account_email':
			var email = $('#modify_email').val().trim();
			if( email == '' ){
				alert('未填寫電子信箱。');
				temp = false;
			}else{
				if( email.length > 50 ){
					alert('電子信箱長度不應該超過 50 個字元。');
					temp = false;
				}else{
					var bl = CheckEmail( email );
					if( !bl ){
						alert('電子信箱格式錯誤。');
						temp = false;
					}
				}
			}
			if( temp ) SaveEmail( email, this );
			break;
		case 'account_skill':
			if( $('#modify_skill').val().trim() == '' ){
				alert('請輸入技能');
			}else{
				SaveSkill( $('#modify_skill').val(), this );
			}
			break;
		case 'account_need':
			if( $('#modify_need').val().trim() == '' ){
				alert('請輸入需求');
			}else{
				SaveNeed( $('#modify_need').val(), this );
			}
			break;
		default:
			break;
	}
});
$(document).on('click', '#change_passwd',function(){  // 進入 變更密碼 介面
	$('#change_passwd-summary').html('').parent().addClass('dom_hidden');
	$('#change_passwd-old').val('');
	$('#change_passwd-new').val('');
	$('#change_passwd-again').val('');
	$('#box').attr('role-now', 'change_passwd').removeClass('dom_hidden').children('[box-role=change_passwd]').removeClass('dom_hidden');
});
$(document).on('click', '#re-send_validation',function(){  // 點擊 重寄認證信
	if( $(this).parent().attr('_status') === 'non-valid' ){
		$('#preloader').find('span').text('請稍後...').end().removeClass('dom_hidden');
		var o_a = JSON.parse( $.cookie.get({ name: 'UserInfo' }) );
		$.ajax({
			url: '../php/re_send.php',
			type: 'POST',
			data: { userid: o_a.userid, username: o_a.username, email: o_a.email },
			dataType: 'html',
			success: function(msg){
				//console.log( msg );
				msg = msg.split('@');
				$('#preloader').addClass('dom_hidden');
				if( msg[0] == 'success' ){
					if( parseInt( msg[1] ) == 0 ){
						alert( '重寄認證信成功，系統已發送新的驗證信至'+o_a.email+'。' );
					}else if( parseInt( msg[1] ) == 1 ){
						alert( msg[2] );
						$('#re-send_validation').parent().attr('_status', 'valid').css('opacity', '0.6').next().children('strong').attr('_status', 'valid').removeAttr('style').text('已驗證');
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
});
function CheckEmail( a ){  // 檢查 Email 是否有符合格式
	if( /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/.test( a ) ){
		return true;
	}else{
		return false;      
	}
}
function CheckTextarea( a ){  // 檢查 Textarea 是否有符合格式
    if( /^[^@\/\'\\\"#$%&\^\*\=\+\(\)\[\]\{\}]+$/.test( a ) ){
		if( a.match(/\\/g) == null ){  // 判斷反斜線： \ 
			return true;
		}else{
			return false;
		}
	}else{
        return false; 
	}
}
function Edit_Skill( $a ){  // 編輯 skill
	var skill = $('#modify_skill').val(); console.log(skill);
	$a.data('temp', skill).addClass('dom_hidden').next().removeClass('dom_hidden').end().parent().prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children('#modify_skill').importTags(skill);
}
function Edit_Need( $a ){  // 編輯 need
	var need = $('#modify_need').val();
	$a.data('temp', need).addClass('dom_hidden').next().removeClass('dom_hidden').end().parent().prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children('#modify_need').importTags(need);
}
function SaveExperience(a,b){  // 儲存 我的經歷
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_experience.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, experience: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 我的經歷 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
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
function SaveAbout(a,b){  // 儲存 關於我
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_about.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, about: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 關於我 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
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
function SaveMotto(a,b){  // 儲存 名言
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_motto.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, motto: a },
		dataType: 'html',
		success: function(msg){
			console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 我的名言 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
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
function SaveEducation(a,b){  // 儲存 學歷
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_education.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, education: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 最高學歷 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
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
function SaveEmail(a,b){  // 儲存 Email
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_email.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, username: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).username, email: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 Email 成功，系統已發送新的驗證信。' );
				$('#re-send_validation').parent().attr('_status','non-valid').removeAttr('style').next().children('strong').attr('_status', 'non-valid').css('color', '#C44141').text('未驗證');
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
				var temp = JSON.stringify( { 'username': JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).username, 'userid': JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, 'email': temp } );
				$.cookie.set({ name: 'UserInfo', value: temp, expires: '1', path: '/' });
				localStorage.setItem( 'UserInfo', temp );
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
function SaveSkill(a,b){  // 儲存 skill
	var skill = a.split(','), temp = '';
	for( var i=0; i<skill.length; i++ ){
		if( CheckStr( skill[i] ) ){
			temp += '<span>'+skill[i]+'</span>';
		}else{
			return alert('技能欄位只能是"中英文"、"數字"、"-"和"_"。');
		}
	}
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_skill.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, skill: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 我的技能 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_skill').val(a).importTags(a);
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
function SaveNeed(a,b){  // 儲存 need
	var need = a.split(','), temp = '';
	for( var i=0; i<need.length; i++ ){
		if( CheckStr( need[i] ) ){
			temp += '<span>'+need[i]+'</span>';
		}else{
			return alert('需求欄位只能是"中英文"、"數字"、"-"和"_"。');
		}
	}
	$('#preloader').find('span').text('更改中...').end().removeClass('dom_hidden');
	$.ajax({
		url: '../php/save_need.php',
		type: 'POST',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, need: a },
		dataType: 'html',
		success: function(msg){
			//console.log( msg );
			msg = msg.split('@');
			$('#preloader').addClass('dom_hidden');
			if( msg[0] == 'success' ){
				alert( '更改 我的需求 成功。' );
				$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_need').val(a).importTags(a);
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
$(document).on('click', '#account_bonus',function(){  // 進入 積分獎勵 介面
	alert('即將開放。');
});