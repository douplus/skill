<?php 
        include('./db.php');

        $taskid = $_GET['task_id'];      
        //取得所有回復資訊
        $query1 = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO,1_CV.USERID FROM `1_RE_TASK`,`1_CV` WHERE 1_RE_TASK.USERID = 1_CV.USERID AND 1_RE_TASK.TASKID =  '$taskid'  ORDER BY 1_RE_TASK.TIMESTAMP DESC" );
        // $query = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO FROM 1_RE_TASK INNER JOIN  1_TASK ON 1_RE_TASK.TASKID = 1_TASK.TASKID INNER JOIN  1_CV ON  1_RE_TASK.USERID = 1_CV.USERID  WHERE 1_RE_TASK.TASKID = 1_TASK.TASKID ORDER BY 1_RE_TASK.TIMESTAMP" );
      
        $result1 = mysql_query($query1) or die('error@錯誤。');
        //0:CONTENT 1:TIMESTAMP 2:USERNAME 3:USER_PHOTO 4:TASKID 5:USERID 
        while( $c = mysql_fetch_array($result1) ){
        $allretask_ary[] = $c['CONTENT'].'***'.$c['TIMESTAMP'].'***'.$c['USERNAME'].'***'.$c['USER_PHOTO'].'***'.$c['TASKID'].'***'.$c['USERID'];
        }
        // 合作只有potask者才會出現
        $userinfo = $_COOKIE['UserInfo'];
        $a = json_decode($userinfo);
        $userid = $a -> userid;

        $SQLStr = "select TASKPOSTERID from `1_TASK` where TASKID = '$taskid'";
        $res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
            while( $a = mysql_fetch_array($res) ){
                $taskposter = $a['TASKPOSTERID'];
            break;
        }
        $SQLStr = sprintf( "SELECT 1_TASK_CO_TEMP.TASK_CO_TEMP,1_TASK_CO_TEMP.USERID FROM `1_RE_TASK`,`1_TASK_CO_TEMP` WHERE 1_RE_TASK.TASKID =  '$taskid'  ORDER BY 1_RE_TASK.TIMESTAMP " );
            $res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
                while( $a = mysql_fetch_array($res) ){
                    $task_co_temp[] = $a['TASK_CO_TEMP'];
                    $temp_userid[] = $a['USERID'];     
            }            
        // 檢查留言數 不只一個
        $html2 = '';
        $num=count($allretask_ary);
            for ($i=0; $i < $num; $i++) { 
                $d = explode("***", $allretask_ary[$i]);
       $html2 .= '<div class="_co_box_dis" style="border-bottom: 2px solid #E4E4E4;">'.
                    '<div class="_co_box_dis_framework1">'.
                            '<div class="_co_box_discuss"style="padding: 15px 0 15px 20px;">'.
                            '<div>'.
                            '<div class=" nailthumb-container square-thumb img-circle">'.
                                    '<img class="img-circle" src="../../photo/'.$d[3].'">'.                                                                      
                            '</div>'.
                            '</div>';
                            // user == taskposter 才會看到合作鈕
                                if ($taskposter == $userid) {
                                    // user 看不到自己發文的
                                    if ($taskposter != $d[5]) {
                                        // 按下合作後 temp=1 並且 按下合作的人=發文的人 出現已合作
                                        if ($task_co_temp[$i] == '1' &&  $temp_userid[$i] == $d[5]) {
                                            $btn_cowork='<p>已合作</p>';
                                        } else {
                                            $btn_cowork = '<button taskid="'.$d[4].'" userid="'.$d[5].'"  class="btn btn_cooperation_a" style="margin-top: 3px;">合作</button>';
                                        }
                                    } else {
                                        $btn_cowork='';
                                    }
                                }                                
                            $html2 .= $btn_cowork.
                            '</div>'.
                    '</div>'.
                    '<div class="_co_box_dis_framework2 ">'.
                    '<div class="_co_box_span">';
                    $html2 .= '<div class="_co_box_dis_anstime"><a href="">'.$d[2].'</a>&nbsp&nbsp&nbsp&nbsp&nbsp answered '.$d[1].'</div>';           
                    $html2 .= '<p style="padding: 10px 0;">'.$d[0].'</p>'.'</div>';                             
                $html2 .='</div></div>';                   
            }
?>