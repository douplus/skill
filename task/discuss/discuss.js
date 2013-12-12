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

    $.ajax({  
		url: '../../php/get_task.php',
		data: { userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid},		
		type: 'POST',
		dataType: 'html',
		success: function(msg){
				ShowTask( msg );
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		}
    });

		function ShowTask(msg){
			msg = msg.split('@@');

			
			/*USERNAME, DEPARTMENT, SKILL, SCORE, USER_PHOTO*/
			var a = msg[1].split('***');
			/*TASKID, CLASSIFY, TITTLE, CONTENT, TIMESTAMP*/
			var b = msg[2].split('***');
			var photo = '../../photo/'+a[4];
			var skill = a[2].split(',');
			var date = b[4].split('');
			length = skill.length;
			console.log(a);
			console.log(b);
			console.log(skill);
			html='';
			$('#task_poster').attr('src',photo);
			$('#task_name').text('姓名:'+a[0]);
			$('#task_department').text('學校:'+a[1]);
			$('#task_score').text(a[3]);
			$('#task_tittle').text(b[2]);
			$('#task_top_tittle').text(b[2]);			
			$('#task_content').text(b[3]);
			$('#task_timestamp').text(date[5]+date[6]+' / '+date[8]+date[9]+' At '+date[11]+date[12]+' : '+date[14]+date[15]);
			for( var i=0; i<length; i++ ){
			html += '<span id ="aa">'+skill[i]+'</span>';
			}
			console.log(html);
			$('#task_skill').html(html);
			$('#user_poster').attr('src','../../photo/'+msg[3]);

			$('#myModalLabel').text(b[2]);		
		}
});

