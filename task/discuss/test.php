<?php 
        $db_host = "localhost";
        $db_username = "nckuskill";
        $db_password = "llikslliks";
        $db_name = "nckuskill";
        $connect = mysql_connect( $db_host, $db_username, $db_password );
        mysql_select_db( $db_name, $connect ) or die( 'Failed selecting: '.mysql_error() );  
        mysql_set_charset('utf8') or die('Failed to set utf-8');

        $realltask_ary = array();
        //取得所有任務資訊
        $query = "select * from `1_RE_TASK` ORDER BY TIMESTAMP DESC";
        $res = mysql_query($query) or die('error@取得所有回覆任務資訊錯誤。')
        $realltask_ary = '';
        while( $a = mysql_fetch_array($res) ){
                $realltask_ary[] = $a[TASKID].'***'.$a[USERID].'***'.$a[CONTENT].'***'.$a[TIMESTAMP];
        }

        if( $realltask_ary == ''){
                echo 'error@@取得所有任務資訊錯誤。';
        }else{
                echo 'success@@'.json_encode( (object)$realltask_ary );
        }

?>