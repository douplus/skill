<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./task_header.php'); ?>
<?php include('./task_layout.php'); ?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 50);
	$('#fixed_nav').find('i').addClass('dom_hidden').end().find('#i_task').removeClass('dom_hidden');
	$('#preloader img').attr('src', '../Images/preloader.gif');
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).removeAttr('href').removeAttr('data-pjax');
	$( $a[2] ).attr({'href':'../information/index.php', 'data-pjax':'information'});
})();
$(function(){
<?php
	$q = isset($_GET['q']) ? $_GET['q'] : '';
	$by = isset($_GET['by']) ? $_GET['by'] : 'all';
	if( $q == '' ){
		//echo '$(window).resize(function(){ Resize_TagCloud(); });';
		echo 'Resize_TagCloud();';
		echo '$(\'#task_cloud_area\').removeClass(\'dom_hidden\');';
		echo '$(\'#task_result\').addClass(\'dom_hidden\');';
		echo '$(\'#task_search\').val(\'\');';
		echo '$(\'#task_select\').val("'.$by.'");';
	}else{
		//echo '$(window).off( Resize_TagCloud() );';
		echo '$(\'#task_cloud_area\').addClass(\'dom_hidden\');';
		echo '$(\'#task_result\').removeClass(\'dom_hidden\');';
		echo '$(\'#task_search\').val("'.$q.'");';
		echo '$(\'#task_select\').val("'.$by.'");';
	}
?>
	StartUsing();
	SetTaskSearch();
});
</script>
<!-- master : end of JS files -->
<?php include('./task_footer.php'); ?>
