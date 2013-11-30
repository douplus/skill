$(function){

	$.ajax({  
		url: '../../php/show_task.php',
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			msg = msg.split('@@');
			ShowAllTask( msg[1] );
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		}
	});

		function ShowAllTask(a){
			
			var a = new Array();
			/*TASKID, TITTLE, CONTENT, TIMESTAMP, TASKPOSTERID*/
			var o_data = JSON.parse( a ), count = 0, html = '';
			for( var obj in o_data ){ count += 1; }
			for( var i=0; i<count; i++ ){
				var a = o_data[i].split('***');	
				html += '<section class="task_item">\
					\<header>\
						\<dl>\
							\<dt class="task_user-male">&nbsp;</dt>\
							\<dd itemprop="user" class="task_user_data">'+a[4]+'</dd>\
						\</dl>\
						\<dl>\
							\<dt class="task_skill">&nbsp;</dt>\
							\<dd itemprop="skill" class="task_skill_data">';
								html +='<span>'+a[4]+'</span>\
							\</dd>
						\<dl>\
					\</header>';		
					html +='\<p><em>'+a[1]+'</em><a href="./discuss/index.php">點擊查看詳情</a></p>\
					\<dl class="task_item_footer">\
						\<dt class="task_classify">分類：</dt>\
						\<dd class="task_classify_data">\
							\<span>分類一</span>\
							\<span>分類二</span>\
							\<span>分類三</span>\
							\<span>分類四</span>\
						\</dd>\
					\</dl>\
			\</section>';

			}
		}

});