$(function(){
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
			
			/*CONTENT, TIMESTAMP, USERNAME, USER_PHOTO*/
			var o_data = JSON.parse( a ), count = 0, html = '';
		for( var obj in o_data ){ count += 1; }
			for( var i=0; i<count; i++ ){
				ary = o_data[i].split('***');
	html += '<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">'+
				'<div class="_co_box_dis_framework1">'+
					'<div class="_co_box_discuss"style="padding: 15px 0 15px 20px;">'+
					'<div>'+
					'<div class=" nailthumb-container square-thumb img-circle">'+
						'<img class="img-circle" src="../../photo/'+ary[3]+'">'+									
					'</div>'+
					'</div>'+
						'<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>'+
					'</div>'+
				'</div>'+
				'<div class="_co_box_dis_framework2 ">'+
				'<div class="_co_box_span">';
				html +=	'<div class="_co_box_dis_anstime"><a href="">'+ary[2]+'</a>&nbsp&nbsp&nbsp&nbsp&nbsp answered '+ary[1]+'</div>';           
				html +=	'<p style="padding: 10px 0;">'+ary[0]+'</p>'+'</div>';                             
		html +='</div></div>';				
			}
	$('._co_box_dis_wrapper').html( html );
console.log(count);

		}
});