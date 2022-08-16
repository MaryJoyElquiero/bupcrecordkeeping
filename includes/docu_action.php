<?php 
include_once "conn.php";

if (isset($_POST['delete'])) {
	$id= $_POST['id'];


	$sql = "DELETE FROM documents, submitted using documents
		INNER JOIN submitted
		ON documents.id= submitted.doc_id 
		WHERE documents.id ='$id';";

		if (mysqli_query($conn, $sql)) {	
					header("Location:../admin_documents.php?notif=3");
						exit();
					} 
					else {
						header("Location:../admin_documents.php?notif=4");
						exit();
					}	
}


 ?>