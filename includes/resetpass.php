<?php 

include_once "conn.php";
if (isset($_POST['reset'])) {
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);
	$email=htmlentities($_POST['email']);

	if ($newpass!==$cpass) {
			header("Location:../resetpassword.php?notif=2&email=" .$email);
			exit();

		}
	if (strlen($newpass)<6) {
			header("Location:../resetpassword.php?notif=3&email=" .$email);
			exit();
		}

   $sql1="UPDATE accounts
			SET password='$newpass'
			WHERE email= '$email';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../stdntlogin.php?notif=4");
									         exit();
									}
									else{
									        header("Location:../resetpassword.php?notif=1&email=" .$email);
									        exit();
									    }
	
}

if (isset($_POST['facultyreset'])) {
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);
	$email=htmlentities($_POST['email']);

	if ($newpass!==$cpass) {
			header("Location:../facultyresetpassword.php?notif=2&email=" .$email);
			exit();

		}
	if (strlen($newpass)<6) {
			header("Location:../facultyresetpassword.php?notif=3&email=" .$email);
			exit();
		}

   $sql1="UPDATE faculty
			SET password='$newpass'
			WHERE email= '$email';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../fcltylogin.php?notif=4");
									         exit();
									}
									else{
									        header("Location:../facultyresetpassword.php?notif=1&email=" .$email);
									        exit();
									    }
	
}


if (isset($_POST['adminreset'])) {
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);
	$email=htmlentities($_POST['email']);

	if ($newpass!==$cpass) {
			header("Location:../adminresetpassword.php?notif=2&email=" .$email);
			exit();

		}
	if (strlen($newpass)<6) {
			header("Location:../adminresetpassword.php?notif=3&email=" .$email);
			exit();
		}

   $sql1="UPDATE admin
			SET password='$newpass'
			WHERE email= '$email';";

									if (mysqli_query($conn,$sql1)) {
									                                    
									         header("Location:../admin_login.php?notif=4");
									         exit();
									}
									else{
									        header("Location:../adminresetpassword.php?notif=1&email=" .$email);
									        exit();
									    }
	
}



 ?>