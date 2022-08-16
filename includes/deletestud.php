<?php 
include_once "conn.php";

if (isset($_POST['delete'])) {
	$id= $_POST['stud_id'];


	$sql = "DELETE FROM accounts, profile, submitted USING accounts 
	INNER JOIN profile 
	ON accounts.id= profile.stud_id 
	INNER JOIN submitted
	ON accounts.id= submitted.stud_id
	WHERE accounts.id='$id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../admin_students.php?notif=8");
						exit();
					} 
					else {
						header("Location:../admin_students.php?notif=9");
						exit();
					}	
}
 ?>