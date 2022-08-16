<?php 
 	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require "../vendor/autoload.php";

    include_once "conn.php";

if (isset($_POST['resend'])|| isset($_POST['resend2'])) {

	$email=$_POST['email'];
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

                              if (isset($_POST['resend'])) {
                                  header("Location:../otpverifyaccount.php?notif=4&email=" .$email);
                                    exit();
                              }
                               if (isset($_POST['resend2'])) {
                                  header("Location:../emailverification.php?notif=6&email=" .$email);
                                    exit();
                              }
									                                    
									        
									}
									else{
                               if (isset($_POST['resend'])) {
                                   header("Location:../otpverifyaccount.php?notif=1&email=" .$email);
                                    exit();
                              }
                               if (isset($_POST['resend2'])) {
                                  header("Location:../emailverification.php?notif=2&email=" .$email);
                                    exit();
                              }
									       
									                                }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}


if (isset($_POST['facultyresend1']) || isset($_POST['facultyresend2'])) {

   $email=$_POST['email'];
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
            $mail->addAddress($email, 'Faculty');
 
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

                              if (isset($_POST['facultyresend1'])) {
                                 header("Location:../otpverifyfacultyaccount.php?notif=5&email=" .$email);
                                    exit();
                              }
                              if (isset($_POST['facultyresend2'])) {
                                 header("Location:../emailfacultyverification.php?notif=6&email=" .$email);
                                    exit();
                              }
                                                               
                                    
                           }
                           else{
                               if (isset($_POST['facultyresend1'])) {
                                 header("Location:../otpverifyfacultyaccount.php?notif=1&email=" .$email);
                                    exit();
                              }
                              if (isset($_POST['facultyresend2'])) {
                                 header("Location:../emailfacultyverification.php?notif=1&email=" .$email);
                                    exit();
                              }
                                  
                                                           }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}

if (isset($_POST['adminresend'])) {

   $email=$_POST['email'];
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
                                  header("Location:../otpverifyadminaccount.php?notif=1&email=" .$email);
                                    exit();
                                                           }
            

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}

?>