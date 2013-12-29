<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./information_header.php'); ?>
<?php include('./information_layout.php'); ?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 50);
	$('#fixed_nav').find('i').addClass('dom_hidden').end().find('#i_information').removeClass('dom_hidden');
	$('#GoToAccount').attr({'href': '../account/index.php', 'data-pjax':'account'});
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).attr({'href':'../task/index.php', 'data-pjax':'task'});
	$( $a[2] ).removeAttr('href').removeAttr('data-pjax');
})();
$(function(){
  	SetInforTag_P();
	StartUsing();
});
</script>
<!-- master : end of JS files -->
<?php include('./information_footer.php'); ?>
