$(document).on('click', '#account_tabs-3 .ensure_btn',function(){
    var taskid = $('.ensure_btn').attr('taskid');
    // 發佈訊息的人
    var poster = $('.ensure_btn').attr('userid');
    // 按下確認的人
    var enterer = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;  

    console.log(taskid);
	$.ajax({    
		  url: '../php/cowork.php',
		  data:{'taskid': taskid , 'poster': poster, 'enterer': enterer , 'type': 'cowork'},
		  type: 'POST',
		  dataType: 'html',
		  success: function(msg){
			console.log(msg);
			alert(msg);
			//window.location.reload(); 
		  },
		  error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		  }
	});        
});
$(document).on('click', '#account_tabs-3 .refuse_btn',function(){
    var taskid = $('.refuse_btn').attr('taskid');
    // 發佈訊息的人
    var poster = $('.refuse_btn').attr('userid');
    // 按下確認的人
    var enterer = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;     
     console.log(taskid);   
	$.ajax({    
		  url: '../php/cowork.php',
		  data:{'taskid': taskid , 'poster': poster, 'enterer': enterer , 'type': 'refuse'},
		  type: 'POST',
		  dataType: 'html',
		  success: function(msg){
			console.log(msg);
			alert(msg);
			//window.location.reload(); 
		  },
		  error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		  }
	});   
}); 
$(document).on('click', '#account_tabs-3 .con_ref_btn',function(){
    var taskid = $('.con_ref_btn').attr('taskid');
    // 發佈訊息的人
    var poster = $('.con_ref_btn').attr('userid');
    // 按下確認的人
    var enterer = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;   
     console.log(taskid);    
	$.ajax({    
		  url: '../php/cowork.php',
		  data:{'taskid': taskid , 'poster': poster, 'enterer': enterer , 'type': 'confirm_refuse'},
		  type: 'POST',
		  dataType: 'html',
		  success: function(msg){
			console.log(msg);
			alert(msg);
			//window.location.reload(); 
		  },
		  error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		  }
	});  
});