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
	$('a[rel=discuss-tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});

    $.ajax({         
	url:'../php/get_master.php',         
	cache:false,         
	dataType:'json',             
	type:'POST',         
    error:function(xhr){ console.log(xhr);                  
	},         
	success: function(response){
            console.log(response);        
             $("#a").append(response.TITLE);
             $("#b").append(response.CONTENT);
             $("#a").append(response.TIMESTAMP);       
		}  
	});
});
