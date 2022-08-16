<?php 


if (isset($_POST['create_studacc'])) {
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
			header("Location:../admin_create_student.php?notif=6");
			exit();
		}
		if (emailExists($conn, $email)!==false) {
			header("Location:../admin_create_student.php?notif=2");
			exit();
		}
		
		if (nameExists($conn, $firstName, $middleName, $lastName)!==false) {
			header("Location:../createaccount.php?notif=7");
			exit();
		}

		if ($password!==$cpassword) {
			header("Location:../admin_create_student.php?notif=3");
			exit();

		}
		if (strlen($password)<6) {
			header("Location:../admin_create_student.php?notif=4");
			exit();
		}

		if (admincreateStud($conn,$firstName,$middleName,$lastName,$department,$course,$acad, $email, $password)!==false) {

			$sql="SELECT id from accounts WHERE email='$email' and password='$password';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  $stud_id =$row['id'];
					  adminaddprofile($conn, $stud_id);
				adminaddsubmitted($conn, $stud_id, $status);

					}
				}


				

				header("Location: ../admin_create_student.php?notif=7");
				exit();


		
	}
	else{
		header("Location:../admin_create_student.php?notif=5");
		exit();

			
}
}



if (isset($_POST['create_facacc'])) {
	include_once "conn.php";	
	include_once "functions.php";	

	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);
	$cpassword=htmlentities($_POST['cpassword']);
	$firstName=htmlentities($_POST['firstName']);
	$middleName=htmlentities($_POST['middleName']);
	$lastName=htmlentities($_POST['lastName']);
	$department=htmlentities($_POST['department']);

		if (empty($department)) {
			header("Location:../admin_create_faculty.php?notif=6");
			exit();
		}
		if (emailFacultyExists($conn, $email)!==false) {
			header("Location:../admin_create_faculty.php?notif=2");
			exit();
		}

		if ($password!==$cpassword) {
			header("Location:../admin_create_faculty.php?notif=3");
			exit();

		}
		if (strlen($password)<6) {
			header("Location:../admin_create_faculty.php?notif=4");
			exit();
		}

		if (admincreateFaculty($conn,$firstName,$middleName,$lastName,$department, $email, $password)!==false) {

				header("Location: ../admin_faculty.php?notif=1");
				exit();	
	}
	else{
		header("Location:../admin_create_faculty.php?notif=5");
		exit();

			
}
}

if (isset($_POST['create_facacc2'])) {
	include_once "conn.php";	
	include_once "functions.php";	

	$email=htmlentities($_POST['email']);
	$password=htmlentities($_POST['password']);
	$cpassword=htmlentities($_POST['cpassword']);
	$firstName=htmlentities($_POST['firstName']);
	$middleName=htmlentities($_POST['middleName']);
	$lastName=htmlentities($_POST['lastName']);
	$course=htmlentities($_POST['course']);

		if (empty($course)) {
			header("Location:../admin_create_faculty2.php?notif=6");
			exit();
		}
		if (emailFacultyExists($conn, $email)!==false) {
			header("Location:../admin_create_faculty2.php?notif=2");
			exit();
		}

		if ($password!==$cpassword) {
			header("Location:../admin_create_faculty2.php?notif=3");
			exit();

		}
		if (strlen($password)<6) {
			header("Location:../admin_create_faculty2.php?notif=4");
			exit();
		}

		if (admincreateFaculty2($conn,$firstName,$middleName,$lastName,$course, $email, $password)!==false) {

				header("Location: ../admin_faculty2.php?notif=1");
				exit();	
	}
	else{
		header("Location:../admin_create_faculty2.php?notif=5");
		exit();

			
}
}


 ?>