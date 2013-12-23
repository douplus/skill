<?php
	header("Content-Type:text/html; charset=utf-8");
    require_once 'pscws4.class.php';
    
	$query = '今日名句：人不可以有傲氣，不能沒有傲骨。文章：父母給我們生命，自己給自己力量。人生有兩個世界，一個是客觀的物質世界，一個是主觀的心靈世界。';
    echo $query.'<br>';
    $pscws = new PSCWS4('utf8');
    $pscws->set_dict('etc/dict_cht.utf8.xdb');
    $pscws->set_rule('etc/rules.ini');
    $pscws->send_text($query);
    $result = $pscws->get_result();
    //$result = $pscws->get_tops(50);     
	//print_r( $result );    
    echo '<br>';

	$result_str = '';
    // 取得結果的所有詞彙
    foreach( $result as $a ){
        //$a['attr']
		if( (int)$a['idf'] != 0 ){
			$result_str = $result_str.' '.$a['word'];
		}
	}
	echo $result_str;

    // 去掉相同的詞彙
    //$result_ary = array_unique($result_ary);
?>
