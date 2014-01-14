$(function(){
  $('#task_search').focus(fuuction(){
    if (event.keyCode == 13 )
        {
        var search = $('#task_search').val();
          var select = $('#task_select').val();
          $.ajax({    
                url: './text.php',
                data: {search:"search",select:"select"},
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
      }
  });
});