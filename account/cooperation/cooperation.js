$(function(){
    $('.nailthumb-container').nailthumb();
	$('#a_score').click(function(event){
		event.preventDefault();
		$('#myTab a[href="#score"]').tab('show');
	});
	$('#a_date').click(function(event){
		event.preventDefault();
		$('#myTab a[href="#date"]').tab('show');
	});
	$('#aa').hover(function(){      
		if( $('#aa').hasClass('done') ){
			$('#aa').removeClass('done').popover('destroy')      
		}else{  
			$('#aa').addClass('done').popover('show'); 
		}
	});
});
// $("#dis_photo"). removeClass("square-thumb_left");
// $("#dis_photo"). addClass("square-thumb_right");
//$('#dis_text').attr("style","text-align: right;color: #C5C5C5;")

$(function(){
	$('#btn_coo').click(function(){
		var co_content = $('#co_content').val();
		var copid = $('#discuss_title').attr('copid');
		console.log(co_content);
	    var a = true;
    	if ( co_content == '') {
    	  $('.btn_if').html('<p>請輸入內容</p>');
    	  a = false;
   		}
    	if (a == 1) {
	        $.ajax({    
	              url: '../../php/cooperation.php',
	              data:{co_content : co_content , userid: JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid ,cop_id:copid},
	              type: 'POST',
	              dataType: 'html',
	              success: function(msg){
	              	console.log(msg);
	              	$('#co_content').val('');
	              	var msg = msg.split('***');
	              	//動態新增
	              	html(msg[1],co_content);        		              	
	                console.log(msg);
	                alert(msg[0]);
	              },
	              error:function(xhr, ajaxOptions, thrownError){ 
	                console.log(xhr.status); 
	                console.log(thrownError);
	              }
	        });        
   		}	
   		function html(a,b){
    	var time = $.timestamp.get( { readable: true } );
    	var time_ary =time.split("-");
    	var time_ary2 =time_ary[2].split(":");
    	var timestamp = time_ary[1]+'-'+time_ary2[0]+':'+time_ary2[1];

		var username = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).username;
		var userid = JSON.parse( $.cookie.get({ name: 'UserInfo' }) ).userid;

    	var html = '';
        html+='<div class="_co_box_framework0">'+
    	'<div class="_co_box_frameworkdiv">'+
    	'<div class="div_img">'+
        '<div id="dis_photo"class=" nailthumb-container square-thumb_left img-circle">'+
            '<img src="../../photo/'+a+'" />'+
        '</div>'+                 
        '</div>'+
        '<div>'+
        '<div id ="dis_text" style="color: #C5C5C5;" >'+
            '<span>Edited by </span>'+
            '<span class="authors" style="">&nbsp;&nbsp;<a href="../../profile/index.php?stream=about&u='+userid+'&v='+userid+'">'+username+'</a></span>'+
            '<span class="lastEditedDate" style="">&nbsp;&nbsp;&nbsp;'+timestamp+'</span>'+
       ' </div >'+
       	'<p style="text-align: center;" >'+b+'</p>'+                           
        '</div>'+
        '</div>'+
    '</div>';       
  		 $( "._co_box_section1" ).append(html); 			
   		}
   		   		    
	});
});
