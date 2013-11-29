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
		}
	});
	$('#top_nav_user_wrapperImg, #top_nav_user_wrapperImg + span').click(function(){    // 點擊 更改大頭貼
		$('#box').attr('role-now', 'user_img').removeClass('dom_hidden').children('[box-role=user_img]').removeClass('dom_hidden');
	});
	$('#user_img_leave').click(function(){  // 離開 更改大頭貼 介面
		$('#box').attr('role-now', '').addClass('dom_hidden').children('[box-role=user_img]').addClass('dom_hidden');
	});
});
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
$(function(){
	$('#modify_skill, #modify_need').tagsInput({
		'height': 'auto',
	    'width': '95%',
	    'interactive': true,
	    'defaultText': 'add a skill...',
	    'placeholderColor': '#A7D285'
	});
});
$(document).on('click', '#account_container em.account_modify',function(){  // 編輯 資訊
	switch( $(this).attr('_role') ){
		case 'account_experience':
		case 'account_about':
		case 'account_motto':
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
	switch( $(this).attr('_role') ){
		case 'account_experience':
			SaveExperience( $('#modify_experience').val(), this );
			break;
		case 'account_about':
			SaveAbout( $('#modify_about').val(), this );
			break;
		case 'account_motto':
			SaveMotto( $('#modify_motto').val(), this );
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
function Edit_Skill( $a ){  // 編輯 skill
	var skill = $('#modify_skill').val(); console.log(skill);
	$a.data('temp', skill).addClass('dom_hidden').next().removeClass('dom_hidden').end().parent().prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children('#modify_skill').importTags(skill);
}
function Edit_Need( $a ){  // 編輯 need
	var need = $('#modify_need').val();
	$a.data('temp', need).addClass('dom_hidden').next().removeClass('dom_hidden').end().parent().prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children('#modify_need').importTags(need);
}
function SaveExperience(a,b){  // 儲存 經歷
	$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
}
function SaveAbout(a,b){  // 儲存 關於我
	$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
}
function SaveMotto(a,b){  // 儲存 名言
	$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
}
function SaveSkill(a,b){  // 儲存 skill
	var skill = a.split(',');
	var temp = '';
	for( var i=0; i<skill.length; i++ ){
		temp += '<span>'+skill[i]+'</span>';
	}
	$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_skill').val(a).importTags(a);
}
function SaveNeed(a,b){  // 儲存 need
	var need = a.split(',');
	var temp = '';
	for( var i=0; i<need.length; i++ ){
		temp += '<span>'+need[i]+'</span>';
	}
	$(b).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_need').val(a).importTags(a);
}