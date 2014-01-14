<<<<<<< HEAD
$(document).on('click', '#follow_select > div', function(){  // ¤Á´« following/follower
	if( !$(this).hasClass('_s') ){
		/*$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).removeClass('dom_hidden').siblings('article').addClass('dom_hidden');*/
		$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).show().siblings('article').hide();
	}
=======
$(document).on('click', '#follow_select > div', function(){  // ¤Á´« following/follower
	if( !$(this).hasClass('_s') ){
		/*$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).removeClass('dom_hidden').siblings('article').addClass('dom_hidden');*/
		$(this).addClass('_s').siblings().removeClass('_s').parent().nextAll('#'+$(this).attr('_role')).show().siblings('article').hide();
	}
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
});