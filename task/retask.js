	
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
                $('.btn_cooperation_a[userid='+checker+']').remove(); 
              },
              error:function(xhr, ajaxOptions, thrownError){ 
                console.log(xhr.status); 
                console.log(thrownError);
              }
            });    
  });
var time = $.timestamp.get( { readable: true } );  
var html = '';
var html += '<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">'+
                    '<div class="_co_box_dis_framework1">'+
                            '<div class="_co_box_discuss"style="padding: 15px 0 15px 20px;">'+
                            '<div>'+
                            '<div class=" nailthumb-container square-thumb img-circle">'+
                                    '<img class="img-circle" src="../../photo/'+$d[3]+'">'+                                                                      
                            '</div>'+
                            '</div>';
                            '<button taskid="'.$d[4].'" userid="'.$d[5].'"  class="btn btn_cooperation_a" style="margin-top: 3px;">合作</button>';
                      html+='</div>'+
                    '</div>'+
                    '<div class="_co_box_dis_framework2 ">'+
                    '<div class="_co_box_span">';
                    html+= '<div class="_co_box_dis_anstime"><a href="">'+$d[2].'</a>&nbsp&nbsp&nbsp&nbsp&nbsp answered '+$d[1]+'</div>';           
                    html+= '<p style="padding: 10px 0;">'+re_task_content+'</p>'+'</div>';                             
                 html+='</div></div>';   
});