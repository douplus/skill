	
$(document).ready(function(){
	$('#re_task_submit').click(function(){
		var re_task_content = $('#re_task_content').val(); 
		var a = true;
		if ( re_task_content == '') {
		  $('.che_task_submit').html('<p>請輸入內容</p>');
		  a = false;
		} 
		if (a == 1) {
			$.ajax({    
				  url: '../discuss/retask.php',
				  data:{ retaskcon: re_task_content, userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid, po_id: $('#task_name').attr('po_id') },
				  type: 'POST',
				  dataType: 'html',
				  success: function(msg){
					console.log(msg);
					$('#re_task_content').val('');
					var msg = msg.split('***');
					//動態新增 msg[1]:retask_photo msg[2]:taskid
					show_retask(msg[1],msg[2],re_task_content);
					alert(msg[0]);

				  },
				  error:function(xhr, ajaxOptions, thrownError){ 
					console.log(xhr.status); 
					console.log(thrownError);
				  }
				});
		}    
	});

  $('.btn_cooperation_a').click(function() {
     var taskid = $(this).attr('taskid');
     var checker = $(this).attr('userid') || '0';
     console.log(taskid);
     console.log(checker);
        $.ajax({    
              url: '../../php/cowork.php',
              data:{'taskid': taskid , 'checker': checker ,po_id: $('#task_name').attr('po_id'), 'type': 'cocheck'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                console.log(msg);
                alert(msg);
                
                console.log('ajax');
                console.log(checker);
                $('.btn_cooperation_a[userid='+checker+']').remove(); 
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });    
  });
    function show_retask(a,b,c){
            var time = $.timestamp.get( { readable: true } );
            var username = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).username;
            var userid = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;  
            var html = '';
                html += '<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">'+
                                '<div class="_co_box_dis_framework1">'+
                                        '<div class="_co_box_discuss"style="padding: 15px 0 15px 20px;">'+
                                        '<div>'+
                                        '<div class=" nailthumb-container square-thumb img-circle">'+
                                                '<img class="img-circle" src="../../photo/'+a+'">'+                                                                      
                                        '</div>'+
                                        '</div>';
                                  html+='</div>'+
                                '</div>'+
                                '<div class="_co_box_dis_framework2">'+
                                '<div class="_co_box_span">';
                                html+= '<div class="_co_box_dis_anstime"><a href="">'+username+'</a>&nbsp&nbsp&nbsp&nbsp&nbsp answered '+time+'</div>';           
                                html+= '<p style="padding: 10px 0;">'+c+'</p></div>';                            
                             html+='</div></div>'; 
                $( "._co_box_dis_wrapper" ).append(html);             
            }  
});