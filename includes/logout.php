<?php 
session_start();

if (isset($_POST['logout'])) {
	session_unset();
	session_destroy();

	header("Location:../index.php?loggedout");
	exit();
}

if (isset($_POST['flogout'])) {
	session_unset();
	session_destroy();

	header("Location:../facultyindex.php?loggedout");
	exit();
}
if (isset($_POST['alogout'])) {
	session_unset();
	session_destroy();

	header("Location:../facultyindex.php?loggedout");
	exit();
}

 ?>