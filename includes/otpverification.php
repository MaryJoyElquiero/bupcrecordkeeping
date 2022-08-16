<?php 
 	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require "../vendor/autoload.php";

    include_once "conn.php";

if (isset($_POST['reset'])) {
	$email=$_POST['email'];

$sql="SELECT * from accounts WHERE email='$email';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
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

               $sql1="UPDATE accounts
					  SET code='$code'
					  WHERE email= '$email';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../otpverifyaccount.php?notif=2&email=" .$email);
									         exit();
									}
									else{
									        header("Location:../forgotpass.php?notif=1");
									        exit();
									                                }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}
else{

	header("Location: forgotpass.php?notif=2");
	exit();
}

}


if (isset($_POST['faculty_reset'])) {
    $email=$_POST['email'];

$sql="SELECT * from faculty WHERE email='$email';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
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

               $sql1="UPDATE faculty
                      SET code='$code'
                      WHERE email= '$email';";

                                    if (mysqli_query($conn,$sql1)) {
                                                                        
                                             header("Location:../otpverifyfacultyaccount.php?notif=2&email=" .$email);
                                             exit();
                                    }
                                    else{
                                            header("Location:../forgotpass_faculty.php?notif=1");
                                            exit();
                                                                    }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}
else{

    header("Location: forgotpass_faculty.php?notif=2");
    exit();
}

}



if (isset($_POST['admin_reset'])) {
    $email=$_POST['email'];

$sql="SELECT * from admin WHERE email='$email';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
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

               $sql1="UPDATE admin
                      SET code='$code'
                      WHERE email= '$email';";

                                    if (mysqli_query($conn,$sql1)) {
                                                                        
                                             header("Location:../otpverifyadminaccount.php?notif=2&email=" .$email);
                                             exit();
                                    }
                                    else{
                                            header("Location:../forgotpass_admin.php?notif=1");
                                            exit();
                                                                    }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}
else{

    header("Location: forgotpass_admin.php?notif=2");
    exit();
}

}

if (isset($_POST['verify'])) {
	$email= $_POST['email'];
    $code= $_POST['code'];

    $sql = "SELECT code FROM accounts WHERE email='$email' and code='$code';";
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                  header("Location:../otpverifyaccount.php?notif=3&email=" .$email);
                exit();
            }
            else{
            	header("Location:../resetpassword.php?email=" .$email);
                exit();
            } 

}

if (isset($_POST['facultyverify'])) {
    $email= $_POST['email'];
    $code= $_POST['code'];

    $sql = "SELECT code FROM faculty WHERE email='$email' and code='$code';";
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                  header("Location:../otpverifyfacultyaccount.php?notif=3&email=" .$email);
                exit();
            }
            else{
                header("Location:../facultyresetpassword.php?email=" .$email);
                exit();
            } 

}
if (isset($_POST['adminverify'])) {
    $email= $_POST['email'];
    $code= $_POST['code'];

    $sql = "SELECT code FROM admin WHERE email='$email' and code='$code';";
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                  header("Location:../otpverifyadminaccount.php?notif=3&email=" .$email);
                exit();
            }
            else{
                header("Location:../adminresetpassword.php?email=" .$email);
                exit();
            } 

}

 ?>