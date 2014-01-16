<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./master_header.php'); ?>
<?php
	$q = isset($_GET['q']) ? $_GET['q'] : '';
?>
<?php include('./master_layout.php'); ?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 50);
	$('#fixed_nav').find('i').addClass('dom_hidden').end().find('#i_learn').removeClass('dom_hidden');
	$('#GoToAccount').attr({'href': '../account/index.php?stream=about', 'data-pjax':'account'});
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).removeAttr('href').removeAttr('data-pjax');
	$( $a[1] ).attr({'href':'../task/index.php', 'data-pjax':'task'});
	$( $a[2] ).attr({'href':'../information/index.php?stream=about', 'data-pjax':'information'});
})();
$(function(){
	<?php
		if( $q == '' ){
			echo '$(\'#SearchAccount\').val(\'\');';
		}else{
			echo '$(\'#SearchAccount\').val("'.$q.'");';
		}
	?>
	StartUsing();
	$('#learn_container .master img').tipsy({gravity: $.fn.tipsy.autoNS, html: true, fade: true});
});
</script>
<!-- master : end of JS files -->
<?php include('./master_footer.php'); ?>