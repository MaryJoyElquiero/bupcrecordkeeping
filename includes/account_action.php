<?php 
include_once "conn.php";


if (isset($_POST['delete'])) {
	$id= $_POST['id'];


	$sql="DELETE FROM faculty WHERE id ='$id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../admin_faculty.php?notif=3");
						exit();
					} 
					else {
						header("Location:../admin_faculty.php?notif=4");
						exit();
					}	
}


 ?>