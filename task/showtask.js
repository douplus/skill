$(function(){
	$.ajax({  
		url: '../php/showtask.php',
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			msg = msg.split('@@');
			// $('#preloader').removeClass('dom_hidden').find('span').text('任務區載入中');
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
		html+= '<div class="task_show">'+
					'<div class="task_show1">'+
						'<div class="task_show_num task_vote_color">'+
							'<div class=" task_show3">1</div>'+
							'<p >vote</p>'+
						'</div>'+
						'<div class="task_show_num task_answer_color">'+
							'<div class="task_show3">2</div>'+
							'<p >answer</p>'+
						'</div>'+
						'<div class="task_show_num task_views_color">'+
							'<div class=" task_show3">3</div>'+
							'<p >views</p>'+
						'</div>'+														
					'</div>'+
					'<div class=" task_show_classify ">'+
						'<img class="task_crown" src="../img/crown1.png">'+
						'<div class=" ">電<br>玩<br>相<br>關</div>'+
					'</div>'+				
					'<div class="task_show2">'+
						ary[2];
						html+= '<br>'+
						'<div class="task_span">'+span;
							// <span>css</span>
							// <span>爵士樂</span>
							// <span>jquery</span>
							// <span>煮菜</span>					
						html+= '</div>'+
						'<div class="task_poster">'+
							'<div class="task_score">'+
								'1,995'+
							'</div>'+
							'<div class="task_name">'+
								'<a href="" style="text-decoration:none">'+ary[3]+'</a>';
							html+= '</div>'+
							'<div class="task_time">'+
								'48s ago'+
							'</div>'+																				  
						'</div>'+
					'</div>'+			
				'</div>';
			}
			$('#task_result').html( html );
			// window.setTimeout(function(){
			// 	$('#preloader').addClass('dom_hidden');
			// }, 800);
			console.log(span);
			console.log(html);
		}



		// function ShowTask(a){
		// 	/*TASKID, CLASSIFY, TITTLE, USERNAME,SKILL*/
		// 	var o_data = JSON.parse( a ), count = 0, html = '' ;
		// 	console.log(o_data);
		// for( var obj in o_data ){ count += 1; }
		// 	for( var i=0; i<count; i++ ){
		// 		ary = o_data[i].split('***');
		// 			var skill = ary[4].split(',');
		// 			sklength = skill.length;
		// 			span = '';
		// 				for( var j=0; j<sklength; j++ ){
		// 				span += '<span>'+skill[j]+'</span>';	
		// 				}		
		// html += '<section class="task_item">'+
		// 	'<header>'+
		// 		'<dl>'+
		// 			'<dt class="task_user-male">&nbsp;</dt>'+
		// 			'<dd itemprop="user" class="task_user_data">'+ary[3]+'</dd>';
		// 		html +='</dl>'+
		// 		'<dl>'+
		// 			'<dt class="task_skill">&nbsp;</dt>';
		// 			console.log(span);
		// 		html +='<dd itemprop="skill" class="task_skill_data">'+span+
		// 			'</dd>'+
		// 		'</dl>'+
		// 	'</header>';
		// 	html +='<p><a href="./discuss/index.php?task_id='+ary[0]+'" style = "text-decoration: none;">'+ary[2]+'</a></p>'+
		// 	'<dl class="task_item_footer">'+
		// 		'<dt class="task_classify">分類：</dt>'+
		// 		'<dd class="task_classify_data">'+
		// 		'</dd>'+
		// 	'</dl>'+
		// '</section>';				
		// 	}
		// 	$('#task_result').html( html );
		// 	// window.setTimeout(function(){
		// 	// 	$('#preloader').addClass('dom_hidden');
		// 	// }, 800);
		// 	console.log(span);
		// 	console.log(html);
		// }

});