<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./notification_header.php'); ?>
<?php include('./notification_layout.php'); ?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 0);
	$('#fixed_nav').find('i').addClass('dom_hidden');
	$('#GoToAccount').attr({'href': '../account/index.php', 'data-pjax':'account'});
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).attr({'href':'../task/index.php', 'data-pjax':'task'});
	$( $a[2] ).attr({'href':'../information/index.php', 'data-pjax':'information'});
})();
$(function(){
	StartUsing();
	$('a[rel=noti-tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});
});
</script>
<!-- master : end of JS files -->
<?php include('./notification_footer.php'); ?>