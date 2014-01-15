<<<<<<< HEAD
	
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
              data:{retaskcon : re_task_content , userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid },
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                console.log(msg);
                alert('創建回覆成功');
                window.location.reload(); 
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });
    };	    
});

  $('.btn_cooperation_a').click(function() {
     var taskid = $(this).attr('taskid');
     var checker = $(this).attr('userid');
     console.log(taskid);
     console.log(checker);
        $.ajax({    
              url: '../../php/cowork.php',
              data:{'taskid': taskid , 'checker': checker , 'type': 'cocheck'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                console.log(msg);
                alert(msg);
                console.log('ajax');
                console.log(checker);
                $('.btn_cooperation_a[userid='+checker+']').html('<p>已合作</p>');  
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });    
  });
=======
	
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
              data:{retaskcon : re_task_content , userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid },
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                console.log(msg);
                alert('創建任務成功');
                window.location.reload(); 
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });
    };	    
});

  $('.btn_cooperation_a').click(function() {
     var taskid = $(".btn_cooperation_a").attr('taskid');
     var checker = $(".btn_cooperation_a").attr('userid');
     console.log(taskid);
     console.log(checker);
        $.ajax({    
              url: '../../php/cowork.php',
              data:{'taskid': taskid , 'checker': checker , 'type': 'cocheck'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                $(".btn_cooperation_a");
                console.log(msg);
                alert(msg);
                window.location.reload(); 
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });    
  });
>>>>>>> b38c0e1a9ef4693a16435a0140e922c82954be8c
});