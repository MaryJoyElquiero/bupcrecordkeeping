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
	<title>Admin | Dashboard </title>

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
		          <a class="nav-link"  href="admin_home.php">Submission</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#"><b>Dashboard</b></a>
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
		<div class="card" style="width: 95%;">
			<div class="row" style="margin-left: 10px; margin-right: 10px;">
					<div class="col-sm-3">
						<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-grid" style="font-size: 40px; "></i> Dashboard</p>
					</div>
					<hr>
			</div>
			<div class="card-body">
				
		<div class="row justify-content-center content mb-3">
			
		<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #37af96; ;">
			<a href="admin_students.php" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
							<?php 
								include_once "includes/conn.php";
							$sql="SELECT count(*)  FROM accounts;";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Student Accounts</p>
					</div>
				</div>
			</div>
				</a>
		</div>
	
		<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #58a7d6; ;">
			<a href="admin_faculty.php" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
									<?php 
							$sql="SELECT count(*)  FROM faculty;";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Department and Program Accounts</p>
					</div>
				</div>
			</div>
		</a>
		</div>

		<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #f28522;">
			<a href="data.php?docs=S" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
									<?php 
							$sql="SELECT count(*)  FROM submitted WHERE status='S';";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Submitted Documents</p>
					</div>
				</div>
			</div>
		</a>
		</div>
			<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #f4a5a7 ;">
				<a href="data.php?docs=NS" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
									<?php 
							$sql="SELECT count(*) FROM submitted WHERE status='NS';";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Unsubmitted Documents</p>
					</div>
				</div>
			</div>
		</a>
		</div>
		<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #b1620c ;">
			<a href="admin_courses.php" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
								<?php 
							$sql="SELECT count(*) FROM course;";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Courses</p>
					</div>
				</div>
			</div>
		</a>
		</div>
		<div class="card m-2" style="width: 22rem; height: fit-content; background-color: #84e090;">
			<a href="admin_department.php" style="text-decoration: none; margin:0;">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-sm-auto">
						<p class="count">
								<?php 
							$sql="SELECT count(*) FROM department;";
							$stmt= mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:admin_dashboard.php?notif=1");
							exit();
						}


								$result=mysqli_query($conn,$sql);
								$row=mysqli_fetch_array($result);

								echo $row[0];				
				?>

						</p>
						<hr>
						<p class="text1">Departments</p>
					</div>
				</div>
			</div>
		</a>
		</div>
	</div>
</div>
			</div>

			


</div>
</div>



<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>