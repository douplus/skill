$(document).on('click', '#follow_select > div', function(){  // 切換 following/follower
	if( !$(this).hasClass('_s') ){
		/*$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).removeClass('dom_hidden').siblings('article').addClass('dom_hidden');*/
		$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).show().siblings('article').hide();
	}
});