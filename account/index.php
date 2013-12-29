<?php 
	$is_pjax = false;
	if( array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] ){
		$is_pjax = true;  # 局部載入頁面
	}else{
		$is_pjax = false; # 重新載入頁面
	}
?>
<?php if( !$is_pjax ) include('./account_header.php'); ?>
<?php
	$u = isset( $_COOKIE['UserInfo'] ) ? $_COOKIE['UserInfo'] : '';
	if( $u == '' ){
		echo '<script>window.location.href = "../master/index.php"</script>';
		exit;
	}else{
		$user_info = json_decode($u, true);
		$u = $user_info['userid'];
		include('./account_layout.php');
	}
?>
<!-- master : JS files -->
<script>
(function(){
	$('#page-container').css('left', 0);
	$('#fixed_nav').find('i').addClass('dom_hidden');
	$('#GoToAccount').removeAttr('href').removeAttr('data-pjax');
	var $a = $('#fixed_nav > div.item > a');
	$( $a[0] ).attr({'href':'../master/index.php', 'data-pjax':'master'});
	$( $a[1] ).attr({'href':'../task/index.php', 'data-pjax':'task'});
	$( $a[2] ).attr({'href':'../information/index.php', 'data-pjax':'information'});
})();
$(function(){
	StartUsing();
	$('#account_task-accordion').accordion({    // jQuery UI Accordion 設定
		heightStyle: 'content',
		collapsible: true
    });
	$('a[rel=account-tipsy]').tipsy({gravity: $.fn.tipsy.autoWE});
	$('#modify_skill, #modify_need').tagsInput({
		'height': 'auto',
	    'width': '95%',
	    'interactive': true,
	    'defaultText': 'add a skill...',
	    'placeholderColor': '#A7D285'
	});
});
</script>
<!-- master : end of JS files -->
<?php include('./account_footer.php'); ?>