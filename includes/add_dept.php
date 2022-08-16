<?php 
include_once "conn.php";



if (isset($_POST['add'])) {
	
	$dept=$_POST['dept'];
	$status="Active";	
	$sql="INSERT INTO department(department,status) VALUES ('$dept','$status')";

		if (mysqli_query($conn, $sql)) {

			header("Location:../admin_department.php?notif=1");
			exit();
			

			} 

		else {
			header("Location:../admin_department.php?notif=2");
			exit();
					}		

}


 ?>