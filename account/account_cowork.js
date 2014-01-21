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
			//1:VIEW 2:ANSWER 3:NUM_COWORK 4:USER_PHOTO 5:USERNAME 6:TITTLE 
			var msg = msg.split('***');			
			alert(msg[0]);
			console.log(taskid);
			var a = '.'+taskid+'';
			$(a).remove();	
			dym_cowork(msg[1],msg[2],msg[3],msg[4],msg[5],msg[6]);
			//window.location.reload(); 
		  },
		  error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		  }
	});
	function dym_cowork (a,b,c,d,e,f){
var coworkhtml = '';
 coworkhtml+='<li>'+	
				'<div class="thumbnail">'+
					'<a href="../profile/index.php?u='+poster+'&amp;v='+enterer+'" title="'+f+'"><img width="50" height="50" src="../photo/'+d+'" title="'+f+'"></a>';
    coworkhtml+='</div>'+
				'<h3 class="chinese"><a href="../profile/index.php?u='+poster+'&amp;v='+enterer+'">'+e+'</a> ：「 <a href="../task/discuss/index.php?task_id='+taskid+'">'+f+'</a> 」。</h3>';
    coworkhtml+='<span class="num chinese">'+a+' views │ '+b+' answers │ '+c+' coworks</span>'+
				'<br>'+
				'<br>'+
				'<a href="./cooperation/index.php?cooperation_id='+taskid+'">前往合作討論區</a>'+
				'<span class="date chinese"></span>'+
			'</li>';
			$( "ul[_role='done']" ).prepend(coworkhtml);
	}
       
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
			var a = '.'+taskid+'';
			$(a).remove();
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
			var a = '.'+taskid+'';
			$(a).remove();			
			//window.location.reload(); 
		  },
		  error:function(xhr, ajaxOptions, thrownError){ 
			console.log(xhr.status); 
			console.log(thrownError);
		  }
	});  
});