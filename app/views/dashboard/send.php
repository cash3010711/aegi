<html>
<title>系統通知</title>
<center>
<?php
	if(isset($_GET['project_name'])){
		$project_name=$_GET['project_name'];
		$project_name=urldecode($project_name);
	}
	if(isset($_GET['description'])){
		$description=$_GET['description'];
		$description=urldecode($description);
	}
	if(isset($_GET['project_client'])){
		$project_client=$_GET['project_client'];
		$project_client=urldecode($project_client);
	}
	if(isset($_GET['note'])){
		$note=$_GET['note'];
		$note=urldecode($note);
	}
	if(isset($_GET['startdate'])){
		$startdate=$_GET['startdate'];
		$startdate=urldecode($startdate);
	}
	if(isset($_GET['enddate'])){
		$enddate=$_GET['enddate'];
		$enddate=urldecode($enddate);
	}
	if(isset($_GET['tagsinput'])){
		$tagsinput=$_GET['tagsinput'];
		$tagsinput=urldecode($tagsinput);
		$tagsinput2=explode(',' , $tagsinput);
	}
	/////////////////////////////////////////////
	if(isset($_GET['task_name'])){
		$task_name=$_GET['task_name'];
		$task_name=urldecode($task_name);
	}
	if(isset($_GET['projectlist'])){
		$projectlist=$_GET['projectlist'];
		$projectlist=urldecode($projectlist);
	}
	if(isset($_GET['startdate'])){
		$startdate=$_GET['startdate'];
		$startdate=urldecode($startdate);
	}
	if(isset($_GET['enddate'])){
		$enddate=$_GET['enddate'];
		$enddate=urldecode($enddate);
	}
	if(isset($_GET['note'])){
		$note=$_GET['note'];
		$note=urldecode($note);
	}
	if(isset($_GET['tagsinput'])){
		$tagsinput=$_GET['tagsinput'];
		$plugin=urldecode($plugin);
		$tagsinput2=explode(',' , $tagsinput);
	}
	if(isset($_GET['subtasks'])){
		$subtasks=$_GET['subtasks'];
		$subtasks=urldecode($subtasks);
	}
	///////////////////////////////////////////////
	if(isset($_GET['title'])){
		$title=$_GET['title'];
		$title=urldecode($title);
	}
	if(isset($_GET['date'])){
		$date=$_GET['date'];
		$date=urldecode($date);
	}
	if(isset($_GET['starttime'])){
		$starttime=$_GET['starttime'];
		$starttime=urldecode($starttime);
	}
	if(isset($_GET['endtime'])){
		$endtime=$_GET['endtime'];
		$endtime=urldecode($endtime);
	}
	if(isset($_GET['category'])){
		$category=$_GET['category'];
		$category=urldecode($category);
	}
	if(isset($_GET['tagsinput'])){
		$tagsinput=$_GET['tagsinput'];
		$tagsinput=urldecode($tagsinput);
		$tagsinput2=explode(',' , $tagsinput);
	}
	if(isset($_GET['note'])){
		$note=$_GET['note'];
		$note=urldecode($note);
	}
	require_once 'phpmailer/class.phpmailer.php';
					$mail = new PHPMailer();
					$mail->SMTPSecure = 'ssl';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 465;
					$mail->CharSet = 'utf-8';    						  //信件編碼
					$mail->Username = 'turkey606410049@gmail.com';        //帳號，例:example@gmail.com
					$mail->Password = '2x2x5x17';        				  //密碼
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPDebug  = 1;
					$mail->Encoding = 'base64';
					$mail->IsHTML(true);     							  //內容HTML格式
					$mail->From = 'turkey606410049@gmail.com';        	  //寄件者信箱
					$mail->FromName = 'sun-shin-ning';    				  //寄信者姓名
					$mail->Subject = 'test';     						  //信件主旨
					// $mail->Body = $project_name . "<br>" . 
					// 			  $description . "<br>" . 
					// 			  $project_client . "<br>" . 
					// 			  $note . "<br>" .
					// 			  $startdate . "<br>" .
					// 			  $enddate . "<br>" .
					// 			  $tagsinput . "<br>" ;        					  //信件內容
					if(isset($_GET['project_name'])){
						$mail->Body = "你已被加入到 ".$project_name." 計劃中<br>".
									"計劃內容：".$description."<br>".
									"計劃客戶：".$project_client."<br>".
									"計劃時間：".$startdate." 至 ".$enddate."<br>".
									"注意事項：".$note."<br>".
									"計劃參與者：".$tagsinput;
						for($loop=0;$loop<count($tagsinput2);$loop++){
							$mail->AddAddress($tagsinput2[$loop]);   		  //收件者信箱
						}
					}
					if(isset($_GET['task_name'])){
						$mail->Body = "你已被指派 ".$task_name." 任務<br>".
									"所屬計劃：".$projectlist."<br>".
									"任務時間：".$startdate." 至 ". $enddate ."<br>".
									"注意事項：".$note."<br>".
									"任務參與者：".$tagsinput."<br>".
									"子任務：".$subtasks;
						for($loop2=0;$loop2<count($tagsinput2);$loop2++){
							$mail->AddAddress($tagsinput2[$loop2]);   		  //收件者信箱
						}
					}
					if(isset($_GET['title'])){
						$mail->Body ="提醒您，您有一個來自 ".$category." 的事件——".$title."<br>".
									"事件時間：".$date." ".$starttime." 至 ".$endtime."<br>".
									"注意事項：".$note;
						for($loop3=0;$loop3<count($tagsinput2);$loop3++){
							$mail->AddAddress($tagsinput2[$loop3]);   		  //收件者信箱
						}
					}
					
	if($mail->Send()){
		//sleep(2);
		//header("location: add");
		echo "<h3>系統已自動透過gmail通知參與本計畫(任務)的使用者</h3>";
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