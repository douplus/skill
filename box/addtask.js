$(document).ready(function(){
  $("#task-summit").click(function(){
    var task_select = $('#post_task_select').val();
    var input_tittle = $('#input-tittle').val();
    var input_content = $('#input-content').val();
    var a = true;

    if (input_tittle == '') {
      $('#input-tittle').append('<li><i class="icon-sign icon-sign-error"></i>請輸入標題</li>');
      a = false;
    };  

    if (input_content == '') {
      $('#input-content').append('<li><i class="icon-sign icon-sign-error"></i>請輸入內容</li>');
      a = false;
    };    
    
    if (a = true) {
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
    };
  });
});