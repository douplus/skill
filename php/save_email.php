<?php
	header("Content-Type:text/html; charset=utf-8");
	include('./db.php');

	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	// 更新 使用者 Email
	$query = sprintf( "UPDATE `1_CV` SET EMAIL = '$email' WHERE USERID = '$userid'" );
	$result = mysql_query($query) or die('error@伺服器更新您的 Email 失敗。');

	$captcha = GeneratorPassword();
	$is_checked = 0;

	// 創建 user 認證碼
	$query = sprintf( "UPDATE `1_ACCOUNT` SET CAPTCHA = '$captcha', IS_CHECKED = '$is_checked' WHERE USERID = '$userid'" );
    $result = mysql_query($query) or die('error@伺服器創建您的認證碼失敗。');

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
	$mailer->Subject = 'Skill--更改Email確認信函(請勿回信)';
	$mailer->Body = '
		<html>
			<body>
				<div><strong>'.$username.'</strong> 您好：</div>			
				<h3>您已成功更改 Email！</h3>
				<div>新的帳號資料如下：</div>
				<div>--------------</div>
				<div>帳號:'.$email.'</div>
				<div>--------------</div>
				<p>請直接點選 <strong><a href="http://merry.ee.ncku.edu.tw/~thwang/cur/register/reg.php?q='.$captcha.'&u='.$userid.'">此處</a></strong> 完成電子郵件認證。</p>
				<p>祝您使用愉快！</p>
				<p>Skill 小組敬上</p>
			</body>
		</html>
	';
	$mailer->IsHTML(true);

	if( !$mailer->Send() ){
        die('error@伺服器發送認證信失敗。');
	}
	echo 'success@更新 Email 成功 & 發送認證信成功。@'.$email;
?>
<?php
function GeneratorPassword(){
    $password_len = 24;
    $password = '';

    // remove o,0,1,l
    $word = 'abcdefghijkmnpqrstuvwxyz!@#$%^*()-ABCDEFGHIJKLMNPQRSTUVWXYZ<>;{}[]23456789';
    $len = strlen($word);

    for ($i = 0; $i < $password_len; $i++) {
        $password .= $word[rand()%$len];
    }
    return $password;
}
?>