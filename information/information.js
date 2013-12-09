function SetInforTag_P(){
  var a = $('#infor_all > .animate-wrap').find('label.front');
  a.children().css('width', a.width());
  var b = $('#infor_all > .animate-wrap').find('label.back');
  b.children().css('width', b.width());
  if( !window.matchMedia('(max-width: 600px)').matches ){  // 非 行動裝置
    var c =  $('#page-container');
    var h =  parseInt(c.height())/3;
    h = ( h < 200 ) ? 200 : h;
    c.find('label').css('height', h ).find('p').css('height', h );
  }
}

