$(function(){
	$.ajax({  
		url: '../php/showtask.php',
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			msg = msg.split('@@');
			ShowTask( msg[1] );
			
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		}
	});

		function ShowTask(a){
			/*TASKID, CLASSIFY, TITTLE, USERNAME,SKILL*/
			var o_data = JSON.parse( a ), count = 0, html = '' ;
			console.log(o_data);
		for( var obj in o_data ){ count += 1; }
			for( var i=0; i<count; i++ ){
				ary = o_data[i].split('***');
					var skill = ary[4].split(',');
					sklength = skill.length;
					span = '';
						for( var j=0; j<sklength; j++ ){
						span += '<span>'+skill[j]+'</span>';	
						}		
		html += '<section class="task_item">'+
			'<header>'+
				'<dl>'+
					'<dt class="task_user-male">&nbsp;</dt>'+
					'<dd itemprop="user" class="task_user_data">'+ary[3]+'</dd>';
				html +='</dl>'+
				'<dl>'+
					'<dt class="task_skill">&nbsp;</dt>';
					console.log(span);
				html +='<dd itemprop="skill" class="task_skill_data">'+span+
					'</dd>'+
				'</dl>'+
			'</header>';
			html +='<p><em>'+ary[2]+'</em><a href="./discuss/index.php?task_id='+ary[0]+'">點擊查看詳情</a></p>'+
			'<dl class="task_item_footer">'+
				'<dt class="task_classify">分類：</dt>'+
				'<dd class="task_classify_data">'+
				'</dd>'+
			'</dl>'+
		'</section>';				
			}
			$('#task_result').html( html );

				console.log(span);
				console.log(html);
		}

});