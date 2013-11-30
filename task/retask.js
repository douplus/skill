	
$('#re_task_submit').click(function){

	var re_task_content = $('#re_task_content').val();
    var a = true;

    if (re_task_content == '') {
      $('._co_box_dis_post2').append('<li>請輸入內容</li>');
      a = false;
    };  
	    if (a = true) {
	        $.ajax({
	              url:"../php/retask.php",                                                              
	              data:{"retaskcon":re_task_content, 'userid': JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid,"content":input_content},
	              type : "POST",                                                                   
	              dataType:'json', 
	              error:function(){                                                                 
	              alert("失敗");
	              },
	              success:function(){                                                           
	              alert("成功");
	              }
	          }); 
	    };
};