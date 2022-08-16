<?php 
include_once "conn.php";

if (isset($_POST['delete'])) {
	$id= $_POST['id'];


	$sql = "DELETE FROM course,accounts,profile,submitted using course 
	INNER JOIN accounts
	ON accounts.course=course.id 
	INNER JOIN profile 
	ON profile.stud_id= accounts.id
	INNER JOIN submitted
	ON accounts.id=submitted.stud_id
	WHERE course.id ='$id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../admin_courses.php?notif=3");
						exit();
					} 
					else {
						header("Location:../admin_courses.php?notif=4");
						exit();
					}	
}


 ?>