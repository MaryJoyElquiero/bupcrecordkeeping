<?php 
session_start();


if (!isset($_SESSION['fuid'])) {
	header("Location: fcltylogin.php");
	exit();
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Faculty |Account</title>

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
		          <a class="nav-link" href="faculty_home.php">Submission</a>
		        </li>
	
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="faculty_account.php"><b>Account</b></a>
		        </li>
		       
		      </ul>
		        

<form action="includes/logout.php" method="POST">
				 <span class="ftype">

		        <?php

		        include_once "includes/conn.php";

					$sql="SELECT email, department ,course from faculty WHERE id='{$_SESSION['fuid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row1 = $result->fetch_assoc()) {
					  	$department=$row1['department'];
					  	$course=$row1['course'];
					  echo "<i class='bi bi-dot'></i>
	".$row1['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>

		      <span class="navbar-text">
					<button class="btn btn-dark" name="flogout">Log Out <i class="bi bi-box-arrow-right"></i></button>
			</span>
</form>
			
		     
		    </div>
		  </div>
</nav>

<div class="container-fluid">
	<div class="row justify-content-center content">
		<div class="card mb-3" style="width:90%;">
			<div class="card-header">
				<p>Account Information</p>
			</div>
			<div class="card-body">

				<?php 

						$sql="SELECT department from department WHERE id='$department';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row2 = $result->fetch_assoc()) {

					   ?>
 					<div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Account Type:</div>
				 	<div class="col-sm-auto fname">Department Head</div>	
				 	</div>

				 	<div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Department:</div>
				 	<div class="col-sm-auto fname"><?php echo $row2['department']; ?></div>	
				 	</div>


					   <?php
					  }

					}
					else{
						$sql="SELECT course from course WHERE id='$course';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row2 = $result->fetch_assoc()) {

					   ?>

					   <div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Account Type:</div>
				 	<div class="col-sm-auto fname">Program Head</div>	
				 	</div>

				 	<div class="row mb-3">
				 	<div class="col-sm-3 flabel">Course:</div>
				 	<div class="col-sm-auto fname"><?php echo $row2['course']; ?></div>	
				 	</div>
					   <?php
					  }

					}
					}

				 ?>

				
		

				<?php 
						$sql="SELECT firstname, middlename, lastname,email, password FROM faculty f
							 WHERE id='{$_SESSION['fuid']}'; ";
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
				 <div class="row mb-3">
				 	<div class="col-sm-3 flabel"> Account Name:</div>
				 	<div class="col-sm-auto fname"> <?php echo $row['lastname']. ", ".  $row['firstname']. " ". $row['middlename'];?></div>	
				 	</div>

				 </div>
			</div>



			<div class="card" style="width:90%;">
			<div class="card-header">
				<p>Email and Password</p>
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

				 	<div class="row mb-3">
				 		<p>
  <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Change Password
  </button>

  
				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
								  <strong> Confirm Password doesn't match </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
					  <strong> Password Changed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Failed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Connection Failed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Old Password incorrect</strong>
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
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>

</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">

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
  <button type="submit" name="fsubmit" class="btn btn-secondary">Update Password</button>
</form>
</div>
  </div>
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