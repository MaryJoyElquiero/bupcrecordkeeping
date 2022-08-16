<?php 
include_once "conn.php";


if (isset($_POST['addacad'])) {
	
	$acad=$_POST['acad'];
	$status="Active";

	$sql="INSERT INTO acad_year(acad_year,status) VALUES ('$acad','$status')";

		if (mysqli_query($conn, $sql)) {

			header("Location:../admin_home.php?notif=1");
			exit();
			

			} 

		else {
			header("Location:../admin_home.php?notif=2");
			exit();
					}		

}


 ?>