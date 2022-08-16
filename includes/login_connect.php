<?php 

use PHPMailer\PHPMailer\PHPMailer;
						    use PHPMailer\PHPMailer\SMTP;
						    use PHPMailer\PHPMailer\Exception;
						 
						    //Load Composer's autoloader
						    require "../vendor/autoload.php"; 

if(isset($_POST['login'])){
	include_once "conn.php";
	include_once "functions.php";


	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);

	

	if (uidExists($conn, $email, $password)!==false) {
		session_start();


		$sql="SELECT * from accounts WHERE email='$email' and password='$password';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
			  	 if (empty($row['code']))
			        {
							

						    $mail = new PHPMailer(true);

							  try {
						             $mail->SMTPDebug = 0;                      //Enable verbose debug output
						    		$mail->isSMTP();    
						 
						            //Set the SMTP server to send through
						            $mail->Host = 'smtp.gmail.com';
						 
						            //Enable SMTP authentication
						            $mail->SMTPAuth = true;
						 
						            //SMTP username
						            $mail->Username = 'bupcrecordkeeping@gmail.com';
						 
						            //SMTP password
						            $mail->Password = 'bupcrk55';
						 
						            //Enable TLS encryption;
						 			 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
						            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
						            $mail->Port = 587;
						 
						            //Recipients
						            $mail->setFrom('bupcrecordkeeping@gmail.com','bupcrecordkeeping');
						 
						            //Add a recipient
						            $mail->addAddress($email, $lastName);
						 
						            //Set email format to HTML
						            $mail->isHTML(true);
						 
						            $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
						 
						            $mail->Subject = 'Email verification';
						            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $code . '</b></p>';
						 
						            $mail->send();
						            // echo 'Message has been sent';

						               $sql1="UPDATE accounts
									            SET code='$code'
									            WHERE email= '$email'
									            AND password='$password';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../emailverification.php?notif=5&email=" .$email);
									         exit();
									}
									else{
									        header("Location:../stdntlogin.php?notif=1");
									        exit();
									                                }
						            

						} catch (Exception $e) {
						            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}

			        }



			  	 if ($row['verified']== null)
			        {
			            header("Location: ../emailverification.php?notif=2&email=".$email);
			            exit();
			        }

			   $_SESSION['uid']= $row['id'];
			  }
			    header("Location:../stud_home.php");
				exit();
			
			}
		}
	else{
				header("Location:../stdntlogin.php?notif=2");
				exit();
	}

}

if(isset($_POST['flogin'])){
	include_once "conn.php";
	include_once "functions.php";


	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);


	if (uidFacultyExists($conn, $email, $password)!==false) {
		session_start();


		$sql="SELECT * from faculty WHERE email='$email' and password='$password';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {


			  	if (empty($row['code']))
			        {
							

						    $mail = new PHPMailer(true);

							  try {
						             $mail->SMTPDebug = 0;                      //Enable verbose debug output
						    		$mail->isSMTP();    
						 
						            //Set the SMTP server to send through
						            $mail->Host = 'smtp.gmail.com';
						 
						            //Enable SMTP authentication
						            $mail->SMTPAuth = true;
						 
						            //SMTP username
						            $mail->Username = 'bupcrecordkeeping@gmail.com';
						 
						            //SMTP password
						            $mail->Password = 'bupcrk55';
						 
						            //Enable TLS encryption;
						 			 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
						            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
						            $mail->Port = 587;
						 
						            //Recipients
						            $mail->setFrom('bupcrecordkeeping@gmail.com','bupcrecordkeeping');
						 
						            //Add a recipient
						            $mail->addAddress($email,'Faculty');
						 
						            //Set email format to HTML
						            $mail->isHTML(true);
						 
						            $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
						 
						            $mail->Subject = 'Email verification';
						            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $code . '</b></p>';
						 
						            $mail->send();
						            // echo 'Message has been sent';

						               $sql1="UPDATE faculty
									            SET code='$code'
									            WHERE email= '$email'
									            AND password='$password';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../emailfacultyverification.php?notif=5&email=" .$email);
									         exit();
									}
									else{
									        header("Location:../fcltylogin.php?notif=1");
									        exit();
									                                }
						            

						} catch (Exception $e) {
						            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						}

			        }



			  	 if ($row['verified']== null)
			        {
			            header("Location: ../emailfacultyverification.php?notif=2&email=".$email);
			            exit();
			        }


			   $_SESSION['fuid']= $row['id'];
			  }
			    header("Location:../faculty_home.php");
				exit();
			
			}
		}
	else{
				header("Location:../fcltylogin.php?notif=2");
				exit();
	}

}


if(isset($_POST['alogin'])){
	include_once "conn.php";
	include_once "functions.php";


	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);


	if (uidAdminExists($conn, $email, $password)!==false) {
		session_start();


		$sql="SELECT id from admin WHERE email='$email';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

			  while($row = $result->fetch_assoc()) {
			   $_SESSION['auid']= $row['id'];
			  }
			    header("Location:../admin_home.php");
				exit();
			
			}
		}
	else{
				header("Location:../admin_login.php?notif=2");
				exit();
	}

}
?>