$(document).ready(function(){
	$.ajax({  
		url: '../../php/re_showtask.php',
		type: 'POST',
		dataType: 'html',
		success: function(msg){
			msg = msg.split('@@');
			ShowReTask( msg[1] );
		},
		error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		}
	});

		function ShowReTask(a){
			
			var a = new Array();
			/*TASKID, USERID, CONTENT, TIMESTAMP*/
			var o_data = JSON.parse( a ), count = 0, html = '';
		for( var obj in o_data ){ count += 1; }
			for( var i=0; i<count; i++ ){
				var a = o_data[i].split('***');

	html += '<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">\
				\<div class="_co_box_dis_framework1">\
					\<div class=" nailthumb-container square-thumb img-circle">\
						\<img class="img-circle" src="../../img/image7.jpg">\									
					\</div>\
						\<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>\
				\</div>\
				\<div class="_co_box_dis_framework2 ">\
					\<span style="position: relative; float: left;"><a href="">'+a[1]+'</a></span>';
				html +=	'<div class="_co_box_dis_anstime">&nbsp&nbsp&nbsp&nbsp&nbsp answered'+a[3]+'</div>';            
				html +=	 a[2];                             
		html +='</div>\
			\</div>';				
			}
			
		}


});