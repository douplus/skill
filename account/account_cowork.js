$(document).ready(function() {
	$('.ensure_btn').click(function() {
    var taskid = $('.ensure_btn').attr('taskid');
    var wantcoworker = $('.ensure_btn').attr('userid'); 

    console.log(taskid);
    console.log(wantcoworker);
        $.ajax({    
              url: '../php/cowork.php',
              data:{'taskid': taskid , 'wantcoworker': wantcoworker , 'type': 'cowork'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
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

  $('.refuse_btn').click(function() {
    var taskid = $('.refuse_btn').attr('taskid');
    var wantcoworker = $('.refuse_btn').attr('userid');    
     console.log(taskid);
     console.log(wantcoworker);    
        $.ajax({    
              url: '../php/cowork.php',
              data:{'taskid': taskid , 'wantcoworker': wantcoworker , 'type': 'refuse'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
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
  $('.con_ref_btn').click(function() {
    var taskid = $('.con_ref_btn').attr('taskid');
    var wantcoworker = $('.con_ref_btn').attr('userid');    
     console.log(taskid);
     console.log(wantcoworker);    
        $.ajax({    
              url: '../php/cowork.php',
              data:{'taskid': taskid , 'wantcoworker': wantcoworker , 'type': 'confirm_refuse'},
              type: 'POST',
              dataType: 'html',
              success: function(msg){
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
});