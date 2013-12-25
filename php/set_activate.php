<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$activater = $_POST['activater'];
	$activated = $_POST['activated'];

	$query = sprintf( "SELECT * FROM `1_ACTIVATE` WHERE (ACTIVATER = '$activated' AND ACTIVATED = '$activater') OR (ACTIVATER = '$activater' AND ACTIVATED = '$activated')" );
	$result = mysql_query($query) or die('error@伺服器查詢 開通 失敗。');
	if( mysql_num_rows( $result ) > 0 ){  # 之前已開通
		die('success@1@您已經開通了。');
	}else{  # 之前尚未開通
		$query = sprintf( "INSERT INTO `1_ACTIVATE` (ACTIVATED, ACTIVATER) VALUES ('%s', '%s')", mysql_real_escape_string($activated), mysql_real_escape_string($activater) );
		$result = mysql_query( $query ) or die('error@伺服器 設定開通 失敗。');
	}
	
	# 抓 開通者 資料
	$activater_ary = array();
	$query = sprintf( "SELECT USERNAME, EMAIL FROM `1_CV` WHERE USERID = '$activater'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	while( $a = mysql_fetch_array($result) ){
		$activater_ary[] = $activater;
		$activater_ary[] = $a['USERNAME'];
		$activater_ary[] = $a['EMAIL'];
		break;
	}
	
	# 抓 被開通者 資料
	$activated_ary = array();
	$query = sprintf( "SELECT USERNAME, EMAIL FROM `1_CV` WHERE USERID = '$activated'" );
	$result = mysql_query($query) or die('error@系統存取資料出錯。');
	while( $a = mysql_fetch_array($result) ){
		$activated_ary[] = $activated;
		$activated_ary[] = $a['USERNAME'];
		$activated_ary[] = $a['EMAIL'];
		break;
	}
	
	# 發送 開通信
	require_once(dirname(__FILE__).'/email/class.phpmailer.php');
	$mailer = new PHPMailer();
	$mailer->CharSet = 'utf-8';
	$mailer->Encoding = 'base64';
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	
	$mailer->Username = 'skillteam.tw@gmail.com';
	$mailer->Password = 'llikslliks';

	$mailer->From = 'skillteam.tw@gmail.com';
	$mailer->FromName = 'Skill 團隊';

	$mailer->AddAddress( $activater_ary[2] );
	$mailer->AddAddress( $activated_ary[2] );
	$mailer->Subject = 'Skill--開通信(請勿回信)';
	$mailer->Body = '
		<html>
			<body>
				<div><strong>'.$activater_ary[1].'</strong> 與 <strong>'.$activated_ary[1].'</strong> 您好：</div>			
				<h3>Skill 已開通你們的帳號！</h3>
				<div>--------------</div>
				<div><strong>開通者</strong></div>
				<div>名稱: '.$activater_ary[1].'</div>
				<div>Email/帳號: '.$activater_ary[2].'</div>
				<div>--------------</div>
				<br>
				<div>--------------</div>
				<div><strong>被開通者</strong></div>
				<div>名稱: '.$activated_ary[1].'</div>
				<div>Email/帳號: '.$activated_ary[2].'</div>
				<div>--------------</div>
				<p>Skill 小組敬上</p>
			</body>
		</html>
	';
	$mailer->IsHTML(true);

	if( !$mailer->Send() ){
        die('error@伺服器發送 開通信 失敗。');
	}
	
	echo 'success@0@設定開通成功。';
?>
