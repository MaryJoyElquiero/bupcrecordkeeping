<?php

	include_once "conn.php";

	$todir = '../documents/';
	$sub_date= date("Y-m-d");
	$status= "S";
	$status2= "L";
	$imgupload = $_FILES["file"];
	$filetype = $_POST["filetype"];
	$stud_id= $_POST['stud_id'];	
	$doc_id = $_POST["doc_id"];	


		if (isset($_POST['submit'])) {

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
						  $doc_id = $_POST["doc_id"];
						  $file = $imgupload['name'];    

						  $sql="UPDATE submitted 
						  SET file= '$file', 
						  sub_date='$sub_date', 
						  status='$status' 
						  WHERE stud_id='$stud_id'
						  AND doc_id= '$doc_id';";

						  if (mysqli_query($conn,$sql)) {
						  	
							}
							else{
							header("Location: ../tosubmit.php?notif=1");
							exit();
							}
				}
				}
				else{
					header("Location: ../tosubmit.php?notif=2");//invalid file
					exit();
				}
	
			
		
		header("Location: ../tosubmit.php?notif=4");//Uploaded
		exit();
	}


		if (isset($_POST['submit2'])) {

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
						  $doc_id = $_POST["doc_id"];
						  $file = $imgupload['name'];    

						  $sql="UPDATE submitted 
						  SET file= '$file', 
						  sub_date='$sub_date', 
						  status='$status2' 
						  WHERE stud_id='$stud_id'
						  AND doc_id= '$doc_id';";

						  if (mysqli_query($conn,$sql)) {
						  	
							}
							else{
							header("Location: ../missed.php?notif=1");
							exit();
							}
				}
				}
				else{
					header("Location: ../missed.php?notif=2");//invalid file
					exit();
				}
	
			
		
		header("Location: ../missed.php?notif=4");//Uploaded
		exit();
	}

?>