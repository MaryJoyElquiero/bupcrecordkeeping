<?php 
session_start();

if (isset($_POST['submit'])) {
	include_once "conn.php";

	$gender=htmlentities($_POST['gender']);
	$age=htmlentities($_POST['age']);
	$mno=htmlentities($_POST['mno']);
	$nationality=htmlentities($_POST['nationality']);
	$pob=htmlentities($_POST['pob']);
	$dob=htmlentities($_POST['dob']);
	$religion=htmlentities($_POST['religion']);


	$sql="UPDATE profile
	SET	gender='$gender',
	 age='$age',
	 pn='$mno',
	 nationality='$nationality',
	 pob='$pob',
	 dob='$dob',
	 religion='$religion'
	 WHERE stud_id= '{$_SESSION['uid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../profile.php?notif=6");
		exit();
	}
	else{
		header("Location:../profile.php?notif=7");
		exit();
	}
}

if (isset($_POST['submit1'])) {
	include_once "conn.php";

	$hn=htmlentities($_POST['hn']);
	$brgy=htmlentities($_POST['brgy']);
	$city=htmlentities($_POST['city']);
	$prov=htmlentities($_POST['prov']);
	$zc=htmlentities($_POST['zc']);



	$sql="UPDATE profile
	SET	street='$hn',
	 brgy='$brgy',
	 city='$city',
	 province='$prov',
	 zip_code='$zc'
	 WHERE stud_id= '{$_SESSION['uid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../profile.php?notif=6");
		exit();
	}
	else{
		header("Location:../profile.php?notif=7");
		exit();
	}
}


if (isset($_POST['submit2'])) {
	include_once "conn.php";

	$mn=htmlentities($_POST['mn']);
	$mo=htmlentities($_POST['mo']);
	$fn=htmlentities($_POST['fn']);
	$fo=htmlentities($_POST['fo']);
	$siblings=htmlentities($_POST['siblings']);
	$mi=htmlentities($_POST['mi']);
	$ai=htmlentities($_POST['ai']);



	$sql="UPDATE profile
	SET mn='$mn',
	 m_occ='$mo',
	 fn='$fn',
	 f_occ='$fo',
	 nos='$siblings',
	 mi='$mi',
	 ai='$ai'
	 WHERE stud_id= '{$_SESSION['uid']}';";

	if (mysqli_query($conn,$sql)){
		header("Location:../profile.php?notif=6");
		exit();
	}
	else{
		header("Location:../profile.php?notif=7");
		exit();
	}
}
 ?>