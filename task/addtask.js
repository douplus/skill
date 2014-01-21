$(document).ready(function(){
  $("#task-summit").click(function(){
    var task_select = $('#post_task_select').val();        
    var post_tittle = $('#post-tittle').val();
    var post_content = $('#post-content').val();


    var time = $.timestamp.get( { readable: true } );
    var time_ary =time.split("-");
    var timestamp = time_ary[1]+'-'+time_ary[2];

    var task_id = 't_'+$.timestamp.get( { readable: false } );
    var a = true;
    console.log("a");
    if( post_tittle == '' ){
      $('#post-title-false').text('標題不可是空白！');
      a = false;
    console.log("a");      
    }
    if( post_content == '' ){
      $('#post-content-false').text('內容不可是空白！');
      a = false;
    }
    if (task_select == "noclassify") {
      alert("請填分類");
      a = false;
    }

// template 少名字和分數

var username = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).username;

// var htmltask = '';
//     htmltask += '<div class="task_show">'+
//       '<div class="task_show1">'+
//         '<div class="task_show_num task_vote_color">'+
//           '<div class=" task_show3">0</div>'+
//           '<p >cowork</p>'+
//         '</div>'+
//         '<div class="task_show_num task_answer_color">'+
//           '<div class="task_show3">0</div>'+
//           '<p >answer</p>'+
//         '</div>'+
//         '<div class="task_show_num task_views_color">'+
//           '<div class=" task_show3">0</div>'+
//           '<p >views</p>'+
//         '</div>'+                           
//       '</div>'+
//       '<div class=" task_show_classify ">'+
//         '<img class="task_crown" src="../img/green1.png">'+
//       '</div>'+
//       '<div class="task_show_title">'+'<p class="chinese">'+task_select+'</p></div>'+          
//       '<div class="task_show2">';
//         htmltask+='<p class="chinese"><a href="./discuss/index.php?task_id='+task_id+'">'+post_tittle+'</a></p>';
//         htmltask+='<div class="task_span">';         
//         htmltask+= '</div>'+
//         '<div class="task_poster">'+
//           '<div class="task_name">'+
//             '<a class="chinese" href="">'+username+'</a>';
//           htmltask+= '</div>'+
//           '<div class="task_time">'+
//                timestamp+
//           '</div>'+                                         
//         '</div>'+
//       '</div>'+     
//     '</div>';
//   htmltask+= '<div class="task_bottom"></div>';

    if (a == 1) {
        $.ajax({    
              url: '../php/posttask.php',
              data: {"select":task_select,"tittle":post_tittle,"content":post_content,"task_id":task_id,"task_poster_id": JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
                console.log(msg);
                //清空新增任務
                $('#post_task_select').val('noclassify');
                $('#post-tittle').val('');
                $('#post-content').val('');
                //動態新增剛輸入 
                //$( "#task_result" ).prepend(htmltask);   
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });
          alert('創建任務成功');   
          $('#add_task_leave').trigger('click');
    };
  });
});
