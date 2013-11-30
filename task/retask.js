	
$('#re_task_submit').click(function(){

	var re_task_content = $('#re_task_content').val();
    var a = true;
    var taskid = 't_1385748264801';

    if (re_task_content == '') {
      $('._co_box_dis_post2').append('<li>請輸入內容</li>');
      a = false;
    };  
	    if (a = true) {
	        $.ajax({
	              url:"../php/retask.php",                                                              
	              data:{"retaskcon":re_task_content , 'userid': JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid,'taskid':taskid},
	              type : "POST",                                                                   
	              dataType:'json', 
	              error:function(){                                                                 
	             	 console.log(msg);
	              },
	              success:function(){
	            	 console.log(xhr.status); 
               		 console.log(thrownError);                                                           
	              }
	          }); 
            alert('創建任務成功');        
	    };
});