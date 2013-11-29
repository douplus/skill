/*$(function(){
  SetInforTag_P();
  });
  */
function SetInforTag_P(){
  var a = $('#infor_all > .animate-wrap').find('label.front');
  a.children().css('width', a.width());
  var b = $('#infor_all > .animate-wrap').find('label.back');
  b.children().css('width', b.width());
  if( !window.matchMedia('(max-width: 600px)').matches ){  // 非 行動裝置
    var $a =  $('#page-container');
    var h =  parseInt($a.height())/3;
    h = ( h < 200 ) ? 200 : h;
    $a.find('label').css('height', h ).find('p').css('height', h );
  }
}
/*
   if (!Modernizr.csstransforms3d) {
   $('label').click(function() {
   $('.animate .front').removeClass('front');
   $(this).addClass('front');
   });
   }*/

