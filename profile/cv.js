$(function(){
	// jQuery UI
	$('#tabs-1').data('status', true);
	$('#page-container').on('click', 'a.cv_list_a', function(e){    // 個人履歷 Tabs 切換
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
});