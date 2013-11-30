$(document).ready(function(){
  $("#task-summit").click(function(){
    var task_select = $('#post_task_select').val();        
    var post_tittle = $('#post-tittle').val();
    var post_content = $('#post-content').val();



    var task_id = 't_'+$.timestamp.get( { readable: false } );
    var a = true;
    console.log("a");
    if( post_tittle == '' ){
      $('#input-tittle').append('<p class="hint">請輸入標題</p>');
      a = false;
    console.log("a");      
    }
    if( post_content == '' ){
      $('#input-content').append('<p class="hint">請輸入內容</p>');
      a = false;
    }

    if (a == 1) {
        $.ajax({    
              url: '../php/posttask.php',
              data: {"select":task_select,"tittle":post_tittle,"content":post_content,"task_id":task_id,"task_poster_id": JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid},
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
    };
  });
});