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
	<title>Admin |Settings</title>

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
		          <a class="nav-link " href="admin_home.php">Submission</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
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
		          <a class="nav-link active" aria-current="page" href="#"><b>Settings</b></a>
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
				<?php 
				include_once "includes/conn.php";
						$sql="SELECT * FROM admin; ";
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
	
				 ?>



			<div class="card" style="width:100%;">
			<div class="row" style="margin-left: 10px; margin-right: 10px;">
					<div class="col-sm-3">
						<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-gear" style="font-size: 40px; "></i> Settings</p>
					</div>
					<hr>
				</div>
			<div class="card-body">
				
				 <div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Email:</div>
				 	<div class="col-sm-auto fname"> <?php echo $row['email'];?></div>	
				 	</div>

				  <div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Password:</div>
				 	<div class="col-sm-auto hidetext"> <?php echo $row['password'];?></div>	
				 	</div>

  
				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
								  <strong> Email Updated </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Failed to change email </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Connection Failed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Old password incorrect </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Confirm Password doesn't match</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					 break;
			        case 6:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> New password is too short</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
							<?php
					 break;
			        case 7:
			       ?>
			       	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
					  <strong> Password Updated</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
							<?php
					 break;
			        case 8:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Failed to change password</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>


	
  <div class="card card-body">
 <div class="row">
  	<div class="col">
  		<p style="font-size: 18px; font-weight: 600;"> Change Password</p>
  	</div> 	
  </div>

    <div class="form">

	<form action="includes/changepass.php" method="POST">
  <div class="form-group mb-2">
    <label for="exampleInputEmail1">Old Password</label>
    <input type="password" name="oldpass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Old Password">

  </div>
  <div class="form-group mb-2">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="newpass" class="form-control" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <div class="form-group mb-2">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <button type="submit" name="admin_pass" class="btn btn-secondary">Update Password</button>
</form>
</div>
  </div>


				 <?php }} ?>
				 </div>
			</div>
		</div>
			
		</div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>