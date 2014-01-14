<<<<<<< HEAD
$(document).on('click', '#account_task_select a', function(){  // 切換 發問/回覆
	if( !$(this).hasClass('_s') ){
		$(this).addClass('_s').parent().siblings('h2').children().removeClass('_s').parents('#account_task_select').next().children('[_role='+$(this).attr('_role')+']').show().siblings('ul').hide();
	}
});
$(document).on('click', '#account_co_select a', function(){  // 切換 合作中/待審查
	if( !$(this).hasClass('_s') ){
		$(this).addClass('_s').parent().siblings('h2').children().removeClass('_s').parents('#account_co_select').next().children('[_role='+$(this).attr('_role')+']').show().siblings('ul').hide();
	}
=======
$(document).on('click', '#account_task_select a', function(){  // 切換 發問/回覆
	if( !$(this).hasClass('_s') ){
		$(this).addClass('_s').parent().siblings('h2').children().removeClass('_s').parents('#account_task_select').next().children('[_role='+$(this).attr('_role')+']').show().siblings('ul').hide();
	}
});
$(document).on('click', '#account_co_select a', function(){  // 切換 合作中/待審查
	if( !$(this).hasClass('_s') ){
		$(this).addClass('_s').parent().siblings('h2').children().removeClass('_s').parents('#account_co_select').next().children('[_role='+$(this).attr('_role')+']').show().siblings('ul').hide();
	}
>>>>>>> 30d59d47f2a484b87d5e4dbfd8e78a1aa03a3410
});