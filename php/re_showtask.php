<?php 
        include('./db.php');

        $taskid = $_GET['task_id']; 
        //取得所有回復資訊
        $query1 = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO,1_CV.USERID FROM `1_RE_TASK`,`1_CV` WHERE 1_RE_TASK.USERID = 1_CV.USERID AND 1_RE_TASK.TASKID =  '$taskid'  ORDER BY 1_RE_TASK.TIMESTAMP " );
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
      $SQLStr = sprintf( "SELECT 1_TASK_CO_TEMP.USERID FROM `1_TASK_CO_TEMP`,`1_TASK` WHERE 1_TASK_CO_TEMP.TASKID = '$taskid' " );
            $res = mysql_query($SQLStr) or die('error@取得任務資訊錯誤1。');
                while( $a = mysql_fetch_array($res) ){
                    $temp_userid[] = $a['USERID'];     
            }           
        
        // 檢查留言數 不只一個
        $html2 = '';
        $num=count($allretask_ary);
            for ($i=0; $i < $num; $i++) { 
                $d = explode("***", $allretask_ary[$i]);

       $html2 .= '<div class="_co_box_dis"">'.
                    '<div class="_co_box_dis_framework1">'.
                            '<div class="_co_box_discuss">'.
                            '<div>'.
                            '<div class=" nailthumb-container square-thumb">'.
                                    '<img class="img-circle" src="../../photo/'.$d[3].'">'.                                                                      
                            '</div>'.
                            '</div>';
                            // user == taskposter 才會看到合作鈕
                                if ($taskposter == $userid) {
                                    // user 看不到自己發文的
                                    if ($taskposter != $d[5]) {
                                        // 按下合作的人=發文的人 出現已合作
                                        if (in_array($d[5],$temp_userid)) {
                                           //檢查是否被拒絕還是成功 TASK_CO_TEMP 1:成功 0:拒絕 2:未確認
                                            $SQLStr = sprintf( "SELECT 1_TASK_CO_TEMP.TASK_CO_TEMP FROM `1_TASK_CO_TEMP` WHERE 1_TASK_CO_TEMP.USERID = '$d[5]' AND 1_TASK_CO_TEMP.TASKID = '$taskid' " );
                                            $res = mysql_query($SQLStr) or die('error@取得TASK_CO_TEMP。');
                                                while( $a = mysql_fetch_array($res) ){
                                                    $task_co_temp = $a['TASK_CO_TEMP'];     
                                            } 
                                            switch($task_co_temp)
                                            {
                                                case 1:
                                                  $btn_cowork='<p id="co_yes">合作達成</p>';
                                                  break;
                                                case 0:
                                                  $btn_cowork='<p id="co_no">拒絕合作</p>';
                                                  break;
                                                default:
                                                  $btn_cowork='';
                                            }
                                        } else {
                                            $btn_cowork = '<div id="button-container"><button id="cowork-button" taskid="'.$d[4].'" userid="'.$d[5].'"  class="btn btn_cooperation_a">合作</button></div>';
                                        }
                                    } else {
                                        $btn_cowork='';
                                    }
                                }                                
                            $html2 .= $btn_cowork.
                            '</div>'.
                    '</div>'.
                    '<div class="_co_box_dis_framework2">'.
                    '<div class="_co_box_span">';
                    $html2 .= '<div class="_co_box_dis_anstime chinese"><a href="">'.$d[2].'</a><p class="reply_time">answered '.$d[1].'</p></div>';           
                    $html2 .= '<p class="reply_content chinese">'.$d[0].'</p>'.'</div>';                             
                $html2 .='</div></div>';                   
            }
?>
