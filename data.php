<?php
session_start();


if (!isset($_SESSION['auid'])) {
	header("Location: admin_login.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | Home </title>
	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/admin_home.css">
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
		          <a class="nav-link" href="admin_home.php">Submission</a>
		        </li>
		          <li class="nav-item">
		           <a class="nav-link active" aria-current="page" href="admin_dashboard.php"><b>Dashboard</b></a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link" href="admin_department.php">Departments</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_courses.php">Courses</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_students.php">Accounts</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_settings.php">Settings</a>
		        </li>
		       
		      </ul>


<form action="includes/logout.php" method="POST">
					<span class="type">
					 <i class="bi bi-dot"></i> Administrator <i class="bi bi-person-circle"></i> &nbsp;
					</span>
		      <span class="navbar-text">
					<button class="btn btn-dark" name="alogout">Log Out  <i class="bi bi-box-arrow-right"></i></button>
				</span>
</form>
			
		     
		    </div>
		  </div>
</nav>

<div class="container-fluid">
	<div class="row justify-content-center content">
		
<div class="card text-dark mb-3" style="height:fit-content; width:95%;">
		
		  	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		  		<div class="col-sm-4">
		  			<?php if ($_GET['docs']=="S") {
		  				?>
		  					<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-list-nested" style="font-size: 40px; "></i> Submitted </p>
		  				<?php
		  			}
		  			else{
		  					?>
		  					<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-list-nested" style="font-size: 40px; "></i> Unsubmitted </p>
		  				<?php
		  			}?>
					
					</div>		  		
<hr>
		  	</div>
	
			<div class="card-body">
				<div class="row"><p>Click folder to open</p></div>
					<div class="row justify-content-start"   style="margin-left:10px; margin-right: 10px; margin-bottom: 20px;">
						<?php 
						  include_once "includes/conn.php";

						  $sql="SELECT * FROM documents;";
							
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
								foreach ($arr as $key => $row) {

									if ($_GET['docs']=="S") {
								  $sql2="SELECT doc_id FROM submitted
									where doc_id='{$row['id']}' AND status IN ('S','L') LIMIT 1;";
								  }
								  else{
								  $sql2="SELECT doc_id FROM submitted
									where doc_id='{$row['id']}' AND status='NS' LIMIT 1;";
								  }
				
								$stmt=mysqli_stmt_init($conn);
								if (!mysqli_stmt_prepare($stmt,$sql2)) {
								echo "Connection Failed";
								exit();
								}
								mysqli_stmt_execute($stmt);
								$result= mysqli_stmt_get_result($stmt);
								$arr= array();
							    while ($row2= mysqli_fetch_assoc($result)){
								array_push($arr, $row2);
								 }
								 if (!empty($arr)) {
								foreach ($arr as $key => $row2) {

									if ($_GET['docs']=="S") {
										$sql3="SELECT count(*)  FROM submitted where doc_id='{$row2['doc_id']}' AND status IN('S','L');";
									}
									else{
											$sql3="SELECT count(*)  FROM submitted where doc_id='{$row2['doc_id']}' AND status='NS';";
									}

							
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql3)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql3);
								$row3=mysqli_fetch_array($result);

			 ?>	 
			
						<div class="col-sm-3 " style="text-align:center;">
							<?php if ($_GET['docs']=="S") {
								?>
								<a href="folderdata.php?id=<?php echo  $row2['doc_id']; ?>" class="data" style="text-decoration: none; margin:0; color: black;">
							<i class="bi bi-folder" style="font-size:80px; font-weight: 700; color: #37af96;"></i>
							<p><?php echo   $row['documents']." (".$row3[0].")"; ?></p>
							</a>
								<?php
							}
							else{
								?>
								<a href="folderdata2.php?id=<?php echo  $row2['doc_id']; ?>" class="data" style="text-decoration: none; margin:0; color: black;">
							<i class="bi bi-folder" style="font-size:80px; font-weight: 700; color: #37af96;"></i>
							<p><?php echo   $row['documents']." (".$row3[0].")"; ?></p>
							</a>
								<?php
							} ?>
							 
						</div>
				
				<?php }}}}
				else{
					?>
					<div class="col-sm-3" style="text-align:center;">
						<i class="bi bi-folder-x" style="font-size:40px; font-weight: 700; color: #37af96;"></i>
						<p>Empty</p>
					</div>
					<?php
				} ?>
				</div>
			
		</div>
	</div>
	
</div>
	
</div>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>