<html>
<title>系統通知</title>
<center>
<?php
	if(isset($_GET['user_name'])){
		$user_name=$_GET['user_name'];
		$user_name=urldecode($user_name);
	}
	if(isset($_GET['email_address'])){
		$email_address=$_GET['email_address'];
		$email_address=urldecode($email_address);
	}
	if(isset($_GET['email_password'])){
		$email_password=$_GET['email_password'];
		$email_password=urldecode($email_password);
	}
	require_once 'phpmailer/class.phpmailer.php';
					$mail = new PHPMailer();
					$mail->SMTPSecure = 'ssl';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 465;
					$mail->CharSet = 'utf-8';    						  //信件編碼
					$mail->Username = $email_address;        //帳號，例:example@gmail.com
					$mail->Password = $email_password;        				  //密碼
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPDebug  = 1;
					$mail->Encoding = 'base64';
					$mail->IsHTML(true);     							  //內容HTML格式
					$mail->From = $email_address;        	  //寄件者信箱
					$mail->FromName = $user_name;    				  //寄信者姓名
					$mail->Subject = '高齡基地系統通知';     						  //信件主旨
					if(isset($_GET['email_address'])){
						$mail->Body = $user_name."(".$email_address.")忘記了他的密碼了<br>".
									  "麻煩請利用權位在general_manager以上的帳號幫他的帳號修改密碼後再通知他";
						$mail->AddAddress('turkey606410049@gmail.com');   		  //收件者信箱
					}
					
	if($mail->Send()){
		//sleep(2);
		//header("location: add");
		echo "<h3>已將您的問題回報給指定人員 請等待他的通知或來信</h3>";
	}else{
		echo "寄信失敗";
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
?>
<br>
<br>
<button onclick="window.close()">我知道了</button>
</center>
</html>