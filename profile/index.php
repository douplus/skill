<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./profile_header.php'); ?>
<?php
	$u = isset($_GET['u']) ? $_GET['u'] : '';
	if( $u == '' ){
		echo '<script>window.location.href = "../master/index.php"</script>';
		exit;
	}else{
		include('./profile_layout.php');
	}
?>
<!-- master : JS files -->
<script>
(function(){
	$('#task_cloud_area').addClass('dom_hidden');
	$('#page-container').css('left', 0);
	$('#fixed_nav').find('i').addClass('dom_hidden');
	$('#preloader img').attr('src', '../Images/preloader.gif');
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).attr({'href':'../task/index.php', 'data-pjax':'task'});
	$( $a[2] ).attr({'href':'../information/index.php', 'data-pjax':'information'});
})();
$(function(){
	StartUsing();
	$('#cv_task-accordion, #cv_rating-accordion').accordion({    // jQuery UI Accordion 設定
		heightStyle: 'content',
		collapsible: true
    });
	$('a[rel=profile-tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});
});
</script>
<!-- master : end of JS files -->
<?php include('./profile_footer.php'); ?>