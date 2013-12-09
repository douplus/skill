<?php 
$txt = "#EFG #ddd dwww #fefef ffffff";

// #開始 \w字 吃到空白停住，因為空白不是字
preg_match_all('/#\w*/i',$txt,$test);  


$a = '';
foreach ($test as $v1 ) {
	foreach ($v1 as $v2 ) {
// echo $v2.'<br>';
		$a = $a.$v2.'***';
	}
}
echo $test[1][0].$test[0][1].$test[0][2].$test[0][3] ;
?>