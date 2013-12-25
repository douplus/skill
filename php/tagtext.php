<?php 

$post_content ="a:get #text  app #tedt ";

$RegExp='/^#.*\s$/';
$k=preg_match_all($RegExp,$post_content,$result);
print_r($result[1]);


?>