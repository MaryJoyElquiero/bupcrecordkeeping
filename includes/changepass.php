<?php 

session_start();

if (isset($_POST['submit'])) {
	include_once "conn.php";

	$oldpass=htmlentities($_POST['oldpass']);
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);


$sql_check="SELECT password FROM accounts WHERE password=? AND id='{$_SESSION['uid']}';";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../accountsetting.php?notif=4");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "s", $oldpass);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (empty($arr)) {

	 	header("Location:../accountsetting.php?notif=5");
		exit();

	 }


	if ($newpass!==$cpass) {
			header("Location:../accountsetting.php?notif=1");
			exit();

		}

		if (strlen($newpass)<6) {
			header("Location:../accountsetting.php?notif=6");
			exit();
		}



	$sql="UPDATE accounts
	SET	password='$newpass'
	 WHERE id= '{$_SESSION['uid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../accountsetting.php?notif=2");
		exit();
	}
	else{
		header("Location:../accountsetting.php?notif=3");
		exit();
	}
}


if (isset($_POST['fsubmit'])) {
	include_once "conn.php";

	$oldpass=htmlentities($_POST['oldpass']);
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);


$sql_check="SELECT password FROM faculty WHERE password=? AND id='{$_SESSION['fuid']}';";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../faculty_account.php?notif=4");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "s", $oldpass);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (empty($arr)) {

	 	header("Location:../faculty_account.php?notif=5");
		exit();

	 }


	if ($newpass!==$cpass) {
			header("Location:../faculty_account.php?notif=1");
			exit();

		}

		if (strlen($newpass)<6) {
			header("Location:../faculty_account.php?notif=6");
			exit();
		}



	$sql="UPDATE faculty
	SET	password='$newpass'
	 WHERE id= '{$_SESSION['fuid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../faculty_account.php?notif=2");
		exit();
	}
	else{
		header("Location:../faculty_account.php?notif=3");
		exit();
	}
}



if (isset($_POST['admin_email'])) {
	include_once "conn.php";

	
	$email=htmlentities($_POST['email']);

	$sql="UPDATE admin
	SET	email='$email';";

	if (mysqli_query($conn,$sql)){
		header("Location:../admin_settings.php?notif=1");
		exit();
	}
	else{
		header("Location:../admin_settings.php?notif=2");
		exit();
	}
}


if (isset($_POST['admin_pass'])) {
	include_once "conn.php";

	$oldpass=htmlentities($_POST['oldpass']);
	$newpass=htmlentities($_POST['newpass']);
	$cpass=htmlentities($_POST['cpass']);


$sql_check="SELECT password FROM admin WHERE password=?;";
	$stmt_chk=mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt_chk,$sql_check)) {
					header("Location:../admin_settings.php?notif=3");
					exit();
	}

	mysqli_stmt_bind_param($stmt_chk, "s", $oldpass);
	mysqli_stmt_execute($stmt_chk);
	$chk_result = mysqli_stmt_get_result($stmt_chk);
	$arr=array();
	 while ($row= mysqli_fetch_assoc($chk_result)) {
	 	array_push($arr, $row);
	 }
	 if (empty($arr)) {

	 	header("Location:../admin_settings.php?notif=4");
		exit();

	 }


	if ($newpass!==$cpass) {
			header("Location:../admin_settings.php?notif=5");
			exit();

		}

		if (strlen($newpass)<6) {
			header("Location:../admin_settings.php?notif=6");
			exit();
		}



	$sql="UPDATE faculty
	SET	password='$newpass'
	 WHERE id= '{$_SESSION['fuid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../admin_settings.php?notif=7");
		exit();
	}
	else{
		header("Location:../admin_settings.php?notif=8");
		exit();
	}
}


 ?>