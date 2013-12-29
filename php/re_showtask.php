<?php 
        include('./db.php');

        $taskid = $_GET['task_id'];      
        //取得所有回復資訊
        $query1 = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO FROM `1_RE_TASK`,`1_CV` WHERE 1_RE_TASK.USERID = 1_CV.USERID AND 1_RE_TASK.TASKID =  '$taskid'  ORDER BY 1_RE_TASK.TIMESTAMP" );
        // $query = sprintf( "SELECT 1_RE_TASK.TASKID,1_RE_TASK.CONTENT,1_RE_TASK.TIMESTAMP,1_CV.USERNAME,1_CV.USER_PHOTO FROM 1_RE_TASK INNER JOIN  1_TASK ON 1_RE_TASK.TASKID = 1_TASK.TASKID INNER JOIN  1_CV ON  1_RE_TASK.USERID = 1_CV.USERID  WHERE 1_RE_TASK.TASKID = 1_TASK.TASKID ORDER BY 1_RE_TASK.TIMESTAMP" );
      
        $result1 = mysql_query($query1) or die('error@錯誤。');

        while( $c = mysql_fetch_array($result1) ){
        $allretask_ary[] = $c['CONTENT'].'***'.$c['TIMESTAMP'].'***'.$c['USERNAME'].'***'.$c['USER_PHOTO'];
        }

        // echo 'success@@'.json_encode( (object)$allretask_ary ); 
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
                            '</div>'.
                                    '<a id="btn_cooperation_a" href="#myModal" role="button" class="btn" data-toggle="modal" style="margin-top: 3px;">合作</a>'.
                            '</div>'.
                    '</div>'.
                    '<div class="_co_box_dis_framework2 ">'.
                    '<div class="_co_box_span">';
                    $html2 .= '<div class="_co_box_dis_anstime"><a href="">'.$d[2].'</a>&nbsp&nbsp&nbsp&nbsp&nbsp answered '.$d[1].'</div>';           
                    $html2 .= '<p style="padding: 10px 0;">'.$d[0].'</p>'.'</div>';                             
                $html2 .='</div></div>';                   
            }
?>