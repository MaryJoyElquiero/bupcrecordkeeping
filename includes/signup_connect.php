

<?php 




if (isset($_POST['signup'])) {
	include_once "conn.php";	
	include_once "functions.php";	

	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);
	$cpassword=htmlentities($_POST['cpassword']);
	$firstName=htmlentities($_POST['firstName']);
	$middleName=htmlentities($_POST['middleName']);
	$lastName=htmlentities($_POST['lastName']);
	$department=htmlentities($_POST['department']);
	$acad=htmlentities($_POST['acad']);
	$course=htmlentities($_POST['course']);
	$status="NS";
	;

		if (empty($department) || empty($course)) {
			header("Location:../createaccount.php?notif=6");
			exit();
		}
		if (emailExists($conn, $email)!==false) {
			header("Location:../createaccount.php?notif=2");
			exit();
		}

		if (nameExists($conn, $firstName, $middleName, $lastName)!==false) {
			header("Location:../createaccount.php?notif=7");
			exit();
		}

		if ($password!==$cpassword) {
			header("Location:../createaccount.php?notif=3");
			exit();

		}
		if (strlen($password)<6) {
			header("Location:../createaccount.php?notif=4");
			exit();
		}

		if (createUser($conn,$firstName,$middleName,$lastName,$department,$acad,$course, $email, $password)!==false) {
			

				$sql="SELECT id from accounts WHERE email='$email' and password='$password';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  $stud_id =$row['id'];
					
					  
					}
				}
				addprofile($conn, $stud_id);
				addsubmitted($conn, $stud_id, $status);
				header("Location: ../emailverification.php?notif=3&email=". $email);
				exit();


		
	}
	else{
		header("Location:../createaccount.php?notif=5");
		exit();

			
}
}

?>
