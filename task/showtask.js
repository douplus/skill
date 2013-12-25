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
			/*0TASKID,1CLASSIFY,2TITTLE,3USERNAME,4SKILL,5SCORE,6TIMESTAMP,7TAG*/
			var o_data = JSON.parse( a ), count = 0, html = '' ;
			console.log(o_data);
		for( var obj in o_data ){ count += 1; }
			for( var i=0; i<count; i++ ){
				ary = o_data[i].split('***');
					classtify=ary[1].split("");
					console.log('這是');
					console.log(ary[7]);
					var tag = ary[7].split('*');
					taglength = tag.length;
					console.log(tag);
					console.log(taglength);
					span = '';
						for( var j=0; j<taglength-1; j++ ){
						span += '<span>'+tag[j]+'</span>';	
						}
					time=ary[6].split('-');	
		html+= '<div class="task_show">'+
					'<div class="task_show1">'+
						'<div class="task_show_num task_vote_color">'+
							'<div class=" task_show3">1</div>'+
							'<p >cowork</p>'+
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
						'<img class="task_crown" src="../img/green1.png">'+
					'</div>'+
					'<div class="task_show_title">'+classtify[0]+'<br>'+classtify[1]+'<br>'+classtify[2]+'<br>'+classtify[3]+'</div>'+					
					'<div class="task_show2">';
						html+='<p><a href="./discuss/index.php?task_id='+ary[0]+'" style="text-decoration: none;">'+ary[2]+'</a></p>';
						html+='<div class="task_span">'+span; 
						console.log(span);
							// <span>css</span>
							// <span>爵士樂</span>
							// <span>jquery</span>
							// <span>煮菜</span>					
						html+= '</div>'+
						'<div class="task_poster">'+
							'<div class="task_score">'+
								+ary[5]+
							'</div>'+
							'<div class="task_name">'+
								'<a href="" style="text-decoration:none">'+ary[3]+'</a>';
							html+= '</div>'+
							'<div class="task_time">';
								html+= time[1]+'-'+time[2]+
							'</div>'+																				  
						'</div>'+
					'</div>'+			
				'</div>';
			}
				html+= '<div class="task_bottom"></div>';
			$('#task_result').html( html );
			// window.setTimeout(function(){
			// 	$('#preloader').addClass('dom_hidden');
			// }, 800);
				console.log(ary[6]);
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