<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./task_header.php'); ?>
<?php
	$q = isset($_GET['q']) ? $_GET['q'] : '';
	$by = isset($_GET['by']) ? $_GET['by'] : 'all';
?>
<?php include('./task_layout.php'); ?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 50);
	$('#fixed_nav').find('i').addClass('dom_hidden').end().find('#i_task').removeClass('dom_hidden');
	$('#GoToAccount').attr({'href': '../account/index.php?stream=about', 'data-pjax':'account'});
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).removeAttr('href').removeAttr('data-pjax');
	$( $a[2] ).attr({'href':'../information/index.php', 'data-pjax':'information'});
})();
$(function(){
<?php
	if( $q == '' ){
		echo '$(\'#task_search\').val(\'\');';
	}else{
		echo '$(\'#task_search\').val("'.$q.'");';
	}
	echo '$(\'#task_select\').val("'.$by.'");';
?>
	StartUsing();
	SetTaskSearch();
});
</script>
<!-- master : end of JS files -->
<?php include('./task_footer.php');?>
