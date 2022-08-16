<?php
session_start();


if (!isset($_SESSION['uid'])) {
	header("Location: stdntlogin.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Submission | Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/stud_home.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


	<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="#">
			      <img src="img/bupclogo.png" alt="" width="50" height="50">
		    </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-sm-0">
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#"><b>Submission</b></a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link" href="profile.php">Profile</a>
		        </li>
		       
		      </ul>
<form action="includes/logout.php" method="POST">
		      <span class="stype">

		        <?php

		        include_once "includes/conn.php";

					$sql="SELECT * from accounts WHERE id='{$_SESSION['uid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {


					  		$stud_id=$row['id'];

					   echo "<i class='bi bi-dot'></i>
	".$row['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>


			</span>
			<span class="navbar-text">
				<button class="btn" name="logout"> Log Out <i class="bi bi-box-arrow-right"></i></button>
			</span>
								
</form>
		     
		    </div>
		  </div>
</nav>

<?php 
	$sql="SELECT id from submitted WHERE stud_id ='{$_SESSION['uid']}';";
			$stmt=mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "Connection Failed";
						exit();
					}

					mysqli_stmt_execute($stmt);
				    $result= mysqli_stmt_get_result($stmt);
				    $arr= array();
				    while ($row= mysqli_fetch_assoc($result)){
				    	array_push($arr, $row);
				    }
				    if (empty($arr)) {

								$status="NS";
				    			$sql1="SELECT * FROM documents;";
											$result1 = $conn->query($sql1);

											if ($result1->num_rows > 0) {
												while($row1 = $result1->fetch_assoc()) {
													$sql2="INSERT INTO submitted (stud_id, doc_id, status) VALUES ('$stud_id', '{$row1['id']}', '$status');";

													if (!mysqli_query($conn,$sql2)) {
														echo "Connection Failed";
													}
												}
											}
				    		
						} 
				    
 ?>


<div class="container">
	<div class="row justify-content-center box">
		<div class="row mt-3">
			<p style="font-size: 24px; font-weight:600;"> <i class="bi bi-list-nested" style="font-size: 40px; font-weight: 600;"></i> Submission</p>
		</div>


	
		<div class="col-md-5 submission">
			<div class="row">
			<div style="font-size: 18px; font-weight: 500;"> Missed </div>
			<hr>
			</div>

	 		<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Connection Failed</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Invalid file type. Please follow suggested file type. </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Something went wrong </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Submitted </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
			        break;
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>

			
			  	<?php

									

			  		$sql="SELECT d.id, d.documents, d.deadline, d.filetype, s.doc_id , s.stud_id
			  		FROM documents d
			  		JOIN submitted s
			  		ON s.doc_id= d.id
			  		WHERE s.stud_id='{$_SESSION['uid']}' 
			  		AND s.status='NS'
			  		AND d.deadline < CURRENT_DATE()
			  		AND d.docu_status='Active' ;";

			  		$stmt=mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						echo "Connection Failed";
						exit();
					}

					mysqli_stmt_execute($stmt);
				    $result= mysqli_stmt_get_result($stmt);
				    $arr= array();
				    while ($row= mysqli_fetch_assoc($result)){
				    	array_push($arr, $row);
				    }
				    if (!empty($arr)) {

				  		foreach ($arr as $key => $docs) {

				  			$now = new DateTime(date('Y-m-d')); 
		
				  			

				  			?>

				<form action="includes/submit.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="stud_id" value="<?php echo $_SESSION['uid']; ?>">					
						<div class="card mb-1" style="background-color:  ;">
							<div class="card-body">
								<label for="formFile" class="form-label" style="font-size: 18px; font-weight: 500; color: red;"><i class="bi bi-file-earmark-text-fill" style="font-size:24px; color: red; "></i> <?php echo $docs['documents']; ?></label>

								<p style="font-size: 14px; color: red ; margin: 0;"> Submission Due : 
								 <b>		
									<?php if ($docs['deadline']==null || $docs['deadline']== "0000-00-00 00:00:00" ) {
										echo "No Deadline";
									} 
									else{echo date("F d, Y", strtotime($docs['deadline']));}?>
										
									</b>
								</p>

								<p style="font-size: 14px;"> Suggested file type:<b> <?php echo $docs['filetype']; ?></b></p>

								<input type="hidden" name="doc_id" value="<?php echo $docs['id']; ?>">
								<input type="hidden" name="filetype" value="<?php echo $docs['filetype']; ?>">
								<input type="file" name="file" class="form-control mb-1" required>
									<div class=" col-5 mb-1">
							  		<button class="btn submit" type="submit" name="submit2"> Submit </button>
							  	</div>
							</div>
						</div>
						

	</form>
				<?php
				}
			}
				else{

					?>
						<div class="none">
							<i class="bi bi-folder-x"></i>
							<p> Nothing here ! </p>
						</div>
					<?php
				}


				  	
			  	?>
			  
		  
		  	</div>	

		  		<div class="col-md-5 submitted">
				<div class="row">
					<div style="font-size: 18px; font-weight: 500;"> Submitted</div>
						<hr>

					
					<?php
						$sql="SELECT s.file,s.status, s.doc_id, d.id, d.documents
						 FROM submitted s
						 JOIN documents d
						 ON d.id= s.doc_id
						WHERE s.stud_id='{$_SESSION['uid']}' AND s.status='S'
						 or s.status='L';";

						$stmt=mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:stud_home.php?notif=1");
							exit();
						}

						mysqli_stmt_execute($stmt);
					    $result= mysqli_stmt_get_result($stmt);
					    $arr= array();
					    while ($row= mysqli_fetch_assoc($result)){
					    	array_push($arr, $row);
					    }
					    if (!empty($arr)) {

					  		foreach ($arr as $key => $submitted) {
					  			if ($submitted['status']=="S") {
					  				echo "<p class='files'><b><i class='bi bi-check-circle-fill'></i>  ".$submitted['documents']."</b>  <em>(".$submitted['file'].")</em></p>";
					  			}
					  			else{
					  				echo "<p class='files' style='color:red;'><b><i class='bi bi-check-circle-fill'></i> LATE - ".$submitted['documents']."</b>  <em>(".$submitted['file'].")</em></p>";
					  			}
					  		}
					  		?>

					  		<a href="documents.php" class="view"> <i class="bi bi-printer" style="font-size: 20px; font-weight: 600;"></i> Print list</a>
					  		<?php
					  	}
					  	else{

					  		?>
						<div class="none">
							<i class="bi bi-folder-x"></i>
							<p> Empty ! </p>
						</div>
							<?php

					  	}

					    	

						 ?>
					
					
				</div>
			</div>
	</div>
	</div>

<footer id="footer">
    <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© 2021 All rights reserved.</p>
      </div>
    </div>
  </footer>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>