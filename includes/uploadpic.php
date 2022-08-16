<?php 

session_start();
include_once "conn.php";

if (isset($_POST['up'])) {
	$imgupload = $_FILES['file'];
	$allow = array("jpg","jpeg","png");
	$todir = '../profpic/';

	$info = explode('.', strtolower( $imgupload['name']) ); // whats the 
				//extension of the file
				if (in_array( end($info), $allow) ) // is this file allowed
				{

					if (move_uploaded_file( $imgupload['tmp_name'], $todir.$imgupload['name'] ) ){
						$file = $imgupload['name'];

	 $sql="UPDATE profile 
			SET profilepic= '$file' 
			WHERE stud_id='{$_SESSION['uid']}';";

						  if (mysqli_query($conn,$sql)) {
						  	header("Location: ../profile.php?notif=uploaded");
							exit();
							}
							else{
							header("Location: ../profile.php?notif=not uploaded");
							exit();
							}
						}
						else{
							header("Location: ../profile.php?notif=notuploaded");
							exit();
						}
					}
					else{
						header("Location: ../profile.php?notif=invalidtype");
							exit();
					}
}


 ?>