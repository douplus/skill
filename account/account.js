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
		$('#preloader').find('span').text('上傳中...').end().removeClass('dom_hidden');
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
	var type = slicer.getImgType();
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