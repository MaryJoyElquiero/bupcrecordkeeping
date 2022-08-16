<?php 

session_start();
include_once "conn.php";

if (isset($_POST['submit'])) {
	$imgupload = $_FILES['file'];
	$todir = '../documents/';
	$doc_id= $_POST['doc_id'];
	$sub_date=date("Y-m-d h:i:s");


		$sql= "SELECT filetype from documents WHERE id='$doc_id';";
				$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
					  	$allowed = $row['filetype'];
					  }
					}

				if ($allowed == "IMAGE") {
					$allow= array("jpg" , "jpeg", "png");
				}
				elseif ($allowed == "PDF") {
					$allow= array("pdf");
				}
				else{
					$allow= array(".docx");
				}

	$info = explode('.', strtolower( $imgupload['name']) ); // whats the 
				//extension of the file
				if (in_array( end($info), $allow) ) // is this file allowed
				{

					if (move_uploaded_file( $imgupload['tmp_name'], $todir.$imgupload['name'] ) ){
						$file = $imgupload['name'];

	 $sql="UPDATE submitted 
			SET file= '$file', 
			sub_date='$sub_date'
			WHERE stud_id='{$_SESSION['uid']}'
			AND doc_id= '$doc_id';";

						  if (mysqli_query($conn,$sql)) {
						  	header("Location: ../documents.php?notif=1");
							exit();
							}
							else{
							header("Location: ../documents.php?notif=2");
							exit();
							}
						}
						else{
							header("Location: ../documents.php?notif=2");
							exit();
						}
					}
					else{
						header("Location: ../documents.php?notif=3");
							exit();
					}
}


 ?>