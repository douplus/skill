$(function(){
	$('#task_container').on('click', 'dd.task_user_data', function(){    // 任務區 點擊使用者
		$('#cv_box').removeClass('dom_hidden').children('section').removeClass('dom_hidden');
	});
	/*
	$('#task_container').on('click', 'dd.task_classify_data > span', function(){    // 進入 分類 介面
		
	});*/
	$('#add_task_leave').click(function(){  // 離開 新增任務 介面
		$('#box').attr('role-now', '').addClass('dom_hidden').children('[box-role=add_task]').addClass('dom_hidden');
	});
	$(window).resize(function(){
		if( $('#i_task').attr('Class') == '' ){
			SetTaskSearch();
		}
	});
});
function SetTaskSearch(){
	var $a = $('#task_search');
	var a = $a.data().mode || false;
	if( window.matchMedia('(max-width:600px)').matches ){  // 手機
		if( !a ){
			$a.parent().css('left', 100).end().data('mode', false).addClass('dom_hidden').prev().removeClass('dom_hidden');
			$('#task_nav-left').css('right', '').next().removeClass('dom_hidden').next().addClass('dom_hidden');
		}
	}else{  // 平板 & 電腦
		$a.parent().css('left', 100).end().data('mode', false).removeClass('dom_hidden').prev().addClass('dom_hidden');
		$('#task_nav-left').css('right', '').next().removeClass('dom_hidden').next().addClass('dom_hidden');
	}
}
$(document).on('keydown', '#task_search', function(e){    // 點擊 搜尋任務
	if( $(this).is(':focus') && (e.keyCode == 13) ){
		if( $('#task_search').val() == '' ){ alert('請輸入搜尋內容'); return false; }
		TagInput_Search( $('#task_search').val(), $('#task_select').val() );
		
	}
});
$(document).on('click', '#task_action-tag_cloud', function(){    // 點擊 熱門任務
	TagInput_Search( '', 'all' );
});
$(document).on('click', '#task_action-back', function(){    // 點擊 手機版任務區 返回按鈕
	$('#task_search').parent().css('left', 100).end().data('mode', false).addClass('dom_hidden').prev().removeClass('dom_hidden');
	$('#task_nav-left').css('right', '').next().removeClass('dom_hidden').next().addClass('dom_hidden');
});
$(document).on('click', '#task_action-add_task', function(){    // 點擊 新增任務
	$('#box').attr('role-now', 'add_task').removeClass('dom_hidden').children('[box-role=add_task]').removeClass('dom_hidden');
});
$(document).on('click', '#task_action-serch', function(){    // 點擊 手機版任務區 搜尋按鈕
	$('#task_search').parent().css('left', 0).end().data('mode', true).removeClass('dom_hidden').prev().addClass('dom_hidden');
	$('#task_nav-left').css('right', 50).next().addClass('dom_hidden').next().removeClass('dom_hidden');
});
$(document).on('change', '#task_select', function(){    // 點擊 任務選單
	console.log( '->'+$(this).val() );
});
function TagInput_Search( a, b ){    // 點搜尋任務： 進入 任務搜尋結果 介面
	sessionStorage.setItem('TagInput', a+'__'+b);
	$('#task-result_page').attr('href', './index.php?q='+a+'&by='+b).trigger('click');
	return false;
}



