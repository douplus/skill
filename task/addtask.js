$(document).ready(function(){
  $("#task-summit").click(function(){
    var task_select = $('#post_task_select').val();        
    var post_tittle = $('#post-tittle').val();
    var post_content = $('#post-content').val();

    console.log("true");

    var task_id = 't_'+$.timestamp.get( { readable: false } );


    $.ajax({    
          url: '../php/posttask.php',
          data: {"select":task_select,"tittle":post_tittle,"content":post_content,"task_id":task_id},
          type: 'POST',
          dataType: 'html',
          success: function(msg){
            console.log(msg);
          },
          error:function(xhr, ajaxOptions, thrownError){ 
            console.log(xhr.status); 
            console.log(thrownError);
          }
        });
      alert('創建任務成功');    
      $('#add_task_leave').trigger('click') 

    });

});