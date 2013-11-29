$(document).ready(function(){
  $("#task-summit").click(function(){
    var task_select = $('#post_task_select').val();        
    var input_tittle = $('#input-tittle').val();
    var input_content = $('#input-content').val();   
  $.ajax({
          url:"../task/posttask.php",                                                              
          data:{"select":task_select,"tittle":input_tittle,"content":input_content},
          type : "POST",                                                                   
          dataType:'json', 
          error:function(){                                                                 
          alert("失敗");
          },
          success:function(){                                                           
          alert("成功");
          }
      }); 
  });
});