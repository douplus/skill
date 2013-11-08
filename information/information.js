$(function(){
  SetTag_P();
  $('#a_information_icon').click(function(){
    $('.deparment').hide();
    $('.i_c_item').show();
  });
  $('#liberal_arts').click(function(){
    $('.i_c_item').hide();
    $('.liberal_arts_item').show();
  });
  $('#science').click(function(){
    $('.i_c_item').hide();
    $('.science_item').show();
  });
  $('#engineer').click(function(){
    $('.i_c_item').hide();
    $('.engineer_item').show();
  });
  $('#management').click(function(){
    $('.i_c_item').hide();
    $('.management_item').show();
  });
  $('#medicine').click(function(){
    $('.i_c_item').hide();
    $('.medicine_item').show();
  });
  $('#social_science').click(function(){
    $('.i_c_item').hide();
    $('.social_science_item').show();
  });
  $('#electrical_enginee').click(function(){
    $('.i_c_item').hide();
    $('.electrical_enginee_item').show();
  });
  $('#planning_design').click(function(){
    $('.i_c_item').hide();
    $('.planning_design_item').show();
  });
  $('#bioscience').click(function(){
    $('.i_c_item').hide();
    $('.bioscience_item').show();
  });

});

function SetTag_P(){    //  設定 Metro 介面 <p> 文字左右置中
  var a = $('#information_category').find('div.i_c_item');
  a.children('p').css('width', a.width());
  var b = $('.deparment_block').find('div.deparment');
  b.children('p').css('width', b.width());
}
