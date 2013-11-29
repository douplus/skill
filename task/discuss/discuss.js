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
	$('a[rel=discuss-tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});

    $.ajax({  // 傳USERID過去
		url: '../../php/get_task.php',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid },
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			console.log(msg);
			msg = msg.split('@@');
			if( msg[0]  == 'success' ){
				/*USERNAME, DEPARTMENT, SKILL, SCORE, USER_PHOTO*/
				var a = msg[1].split('***');
				/*TASKID, CLASSIFY, TITLE, CONTENT, TIMESTAMP*/
				var b = msg[2].split('***');
				var photo = '../../photo/'+a[4];
				var skill = a[2].split(',');
				length = skill.length;

				$('#task_poster').attr('src',photo);
				$('#task_name').text('姓名:'+a[0]);
				$('#task_department').text('學校:'+a[1]);
				$('#task_score').text(a[3]);
				$('#task_tittle').text(b[2]);
				
				for( var i=0; i<length; i++ ){
				$('#task_skill').append('<span id ="aa">'+skill[i]+'</span>')	
				}				



			}else{
				alert('失敗');
			}
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		}
    });
});

