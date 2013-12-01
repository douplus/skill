<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="ip" content="<?php echo $_SERVER["REMOTE_ADDR"]; ?>">
	<title>Skill-任務</title>
	<!-- load : CSS files -->
	<?php 
		include('../master/css_files.php'); 
		include('../php/showtask.php');
	?>
	<!-- load : end of CSS files -->
	<script src="../library/jquery-2.0.3.min.js"></script>
	<script src="../library/jquery.pjax.js"></script>
	<script src="../library/jquery.tipsy.js"></script>
	<script src="../library/jquery.tagcanvas.min.js"></script>
	<script src="../library/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="../master/index.js"></script>
	<script src="./task.js"></script>
	<script src="../profile/cv.js"></script>
	<script src="../account/account.js"></script>
	<script src="../information/information.js"></script>
	<script src="../information/modernizr.custom.18273.js"></script>
	<script src="./addtask.js"></script>
	<script src="./showtask.js"></script>
	<script src="../library/imageSlice.js"></script>
	<script src="../library/jquery.tagsinput.min.js"></script>
	<script src="../js/follow.js"></script>
<script>
	(function(){    // include jQuery.js
		CheckLogin();
		function CheckLogin(){    // 檢查使用者是否登入
			var a = $.cookie.get({ name: 'UserInfo' });
			if( a == null || localStorage.Based_CV == null ){  // 未登入：跳回首頁
				window.location.replace( '../home/index.html' );
			}else{  // 已登入：載入頁面
				$(function(){ $('#init-overlay').addClass('dom_hidden'); });
				//IncludeJS();
				$.cookie.set({ name: 'UserInfo', value: a, expires: '1', path: '/' });
				localStorage.setItem( 'UserInfo', a );
			}
		};
	})();
$(function(){
	$.pjax({
        selector: 'a[data-pjax]',
        container: '#page-container > div.wrapper', //内容替换的容器
        type : 'POST',
        cache: false,  //是否使用缓存
        storage: true,  //是否使用本地存储
        titleSuffix: '', //标题后缀
        filter: function(){},
        callback: function(status){
			var type = status.type;
			console.log( 'pjax.'+type );
            switch(type){
                case 'success': PjaxSuccess();break; //正常
                case 'cache':;break; //读取缓存 
                case 'error': ;break; //发生异常
                case 'hash': ;break; //只是hash变化
            }
		}
    });
	$.pjax({
        selector: 'a[task-pjax]',
        container: '#page-container > div.wrapper', //内容替换的容器
        type : 'GET',
        cache: false,  //是否使用缓存
        storage: true,  //是否使用本地存储
        titleSuffix: '', //标题后缀
        filter: function(){},
        callback: function(status){
			var type = status.type;
			console.log( 'task-pjax.'+type );
            switch(type){
                case 'success': PjaxSuccess();break; //正常
                case 'cache':;break; //读取缓存 
                case 'error': ;break; //发生异常
                case 'hash': ;break; //只是hash变化
            }
		}
    });
	$(window).resize(function() {
		$.viewport.set();
	});
});
$.viewport.set();
</script>
</head>
<body>
	<section id="init-overlay" class=""></section>
	<article id="preloader" class="dom_hidden">
		<h3><img src="../Images/preloader.gif"><span></span></h3>
	</article>
	<?php include('../php/tag_cloud.php'); ?>
	<?php include('../php/fixed_header.php'); ?>
	<?php include('../php/top_header.php'); ?>
	<?php include('../box/box.php'); ?>
	<article id="page-container" style="position: fixed;left: 50px;top: 51px;bottom: 0;right: 0;z-index: 30;overflow-y: auto;">
		<div class="wrapper" style="position: relative;width: 100%;height: 100%;z-index: 30;">
