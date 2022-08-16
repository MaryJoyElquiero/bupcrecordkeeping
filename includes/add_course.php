<?php 
include_once "conn.php";



if (isset($_POST['add'])) {
	
	$course=$_POST['course'];
	$dept=$_POST['dept'];
	$status="Active";
	
	$sql="INSERT INTO course(course,dept_id,status) VALUES ('$course','$dept','$status')";

		if (mysqli_query($conn, $sql)) {

			header("Location:../admin_courses.php?notif=1");
			exit();
			

			} 

		else {
			header("Location:../admin_courses.php?notif=2");
			exit();
					}		

}


 ?>