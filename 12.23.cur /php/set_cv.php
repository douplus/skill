<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = md5( $_POST['password'].'skill' );
	$gender = $_POST['gender'];
	$join_time = $_POST['join_time'];
	$captcha = GeneratorPassword();
	$temp = false;

	// 查詢 user 帳號是否有人用過
	$query = sprintf( "SELECT EMAIL FROM `1_CV` WHERE EMAIL = '$email'" );
	$result = mysql_query($query) or die('error@伺服器檢查帳號發生錯誤');
	while( $a = mysql_fetch_array($result) ){
		if( $email == $a['EMAIL'] ) $temp = true;
	}
	if( $temp ){
		$message  = 'error@此帳號已經有人使用過了。';
        die($message);
	}
	
	// 創建 user 帳號密碼
    $query = sprintf( "INSERT INTO `1_ACCOUNT` (USERID, PASSWD, CAPTCHA) VALUES ('%s', '%s', '%s')", mysql_real_escape_string($userid), mysql_real_escape_string($password), mysql_real_escape_string($captcha) );
    $result = mysql_query($query);
    if( !$result ){
        $message  = 'error@伺服器創建您的帳號密碼失敗。';
        die($message);
    }
	
	// 創建 user 個人履歷
    $query = sprintf( "INSERT INTO `1_CV` (USERID, USERNAME, EMAIL, GENDER, JOIN_TIME) VALUES ('%s', '%s', '%s', '%s', '%s')", mysql_real_escape_string($userid), $name, mysql_real_escape_string($email), mysql_real_escape_string($gender), mysql_real_escape_string($join_time) );
    $result = mysql_query($query);
    if( !$result ){
        $message  = 'error@伺服器創建您的個人資料失敗。';
        die($message);
    }
	
	// 發送認證信
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

	$mailer->AddAddress( $email );
	$mailer->Subject = 'Skill--啟動確認信函(請勿回信)';
	$mailer->Body = '
		<html>
			<body>
				<div><strong>'.$name.'</strong> 您好：</div>			
				<h3>歡迎使用 Skill！</h3>
				<div>您的申請帳號資料如下：</div>
				<div>--------------</div>
				<div>帳號:'.$email.'</div>
				<div>密碼:'.$_POST['password'].'</div>
				<div>--------------</div>
				<p>請直接點選 <strong><a href="http://merry.ee.ncku.edu.tw/~thwang/cur/register/reg.php?q='.$captcha.'&u='.$userid.'">此處</a></strong> 完成電子郵件認證。</p>
				<p>祝您使用愉快！</p>
				<p>Skill 小組敬上</p>
			</body>
		</html>
	';
	$mailer->IsHTML(true);

	if( !$mailer->Send() ){
		$message  = 'error@伺服器發送認證信失敗。';
        die($message);
	}
	echo 'success@創建您的帳戶 & 發送認證信成功。';
?>
<?php
function GeneratorPassword(){
    $password_len = 24;
    $a = '';

    // remove o,0,1,l
    $word = 'abcdefghijkmnpqrstuvwxyz!@#$%^*()-ABCDEFGHIJKLMNPQRSTUVWXYZ<>;{}[]23456789';
    $len = strlen($word);

    for ($i = 0; $i < $password_len; $i++) {
        $a .= $word[rand()%$len];
    }
    return $a;
}
?>