$(function(){
    $('.nailthumb-container').nailthumb();
	$('#a_score').click(function(event){
		event.preventDefault();
		$('#myTab a[href="#score"]').tab('show');
	});
	$('#a_date').click(function(event){
		event.preventDefault();
		$('#myTab a[href="#date"]').tab('show');
	});
	$('#aa').hover(function(){      
		if( $('#aa').hasClass('done') ){
			$('#aa').removeClass('done').popover('destroy')      
		}else{  
			$('#aa').addClass('done').popover('show'); 
		}
	});
});
$(function(){
	$('#fixed_logo').click(function(){    // 進入 神人網 首頁
		window.location.href = '../index.html';
	});
	$('div._task_box_qu_content1 > div.user_name').click(function(){    // 進入 個人簡歷 介面
		$('#cv_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
	});
	$('#cv_box_leave').click(function(){    // 離開 個人簡歷 介面
		$('#cv_box').addClass('dom_hidden').children('section').addClass('dom_hidden');
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
});
$(function(){    // jQuery UI
	$('#cv_box_task-accordion, #cv_box_participate-accordion').accordion({    // jQuery UI Accordion 設定
      heightStyle: 'content',
	  collapsible: true
    });
});

$(function(){
	$('#re_task_submit').click(function(){
		var re_task_content = $('#re_task_content').val();
	    var a = true;
    	if ( re_task_content == '') {
    	  $('.che_task_submit').html('<p>請輸入內容</p>');
    	  a = false;
   		} 
    	if (a == 1) {
	        $.ajax({    
	              url: '../discuss/retask.php',
	              data:{retaskcon : re_task_content , userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid },
	              type: 'POST',
	              dataType: 'html',
	              success: function(msg){
	                console.log(msg);
	                alert('創建任務成功');
	                window.location.reload(); 
	              },
	              error:function(xhr, ajaxOptions, thrownError){ 
	                console.log(xhr.status); 
	                console.log(thrownError);
	              }
	        });        
   		};	    	    
	});
});

$(function(){
	$('#btn_coo').click(function(){
		var co_content = $('#co_content').val();
		var copid = $('#discuss_title').attr('copid');
		console.log(co_content);
	    var a = true;
    	if ( co_content == '') {
    	  $('.btn_if').html('<p>請輸入內容</p>');
    	  a = false;
   		} 
    	if (a == 1) {
	        $.ajax({    
	              url: '../../php/cooperation.php',
	              data:{co_content : co_content , userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid ,cop_id:copid},
	              type: 'POST',
	              dataType: 'html',
	              success: function(msg){
	              	$('#co_content').val('');
	                console.log(msg);
	                alert(msg);

	              },
	              error:function(xhr, ajaxOptions, thrownError){ 
	                console.log(xhr.status); 
	                console.log(thrownError);
	              }
	        });        
   		};	    	    
	});
});
