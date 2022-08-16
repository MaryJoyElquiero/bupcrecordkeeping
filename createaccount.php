<!DOCTYPE html>
<html>
<head>
	<title>Create Account|Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/createaccount.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<?php include_once "includes/conn.php"; ?>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-4 box">

			<div class="row justify-content-center">
				<div class="col-md-auto align-self-center">
					<img src="img/student.png">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-auto">
					<p class="text"> Create Account</p>
				</div>
			</div>

	<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
								  <strong> Connection Failed </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Email Exists </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Confirm password doesn't match </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Password is too short </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Failed to create account</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					 break;
			        case 6:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Please fill up all fields</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
							<?php
					 break;
					  case 7:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong>Account name already exists </strong>
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

	<form action="includes/signup_connect.php" method="POST">

		
			
		<div class="row">
				<div class="col-sm">
					<div class="mb-3"> 
					  <input type="text" class="form-control" id="exampleFormControlInput1" name="firstName" placeholder="First Name" required>
					</div>
				</div>	
				<div class="col-sm">
					<div class="mb-3"> 
				  		<input type="text" class="form-control" id="exampleFormControlInput1" name="middleName" placeholder="Middle Name">
					</div>
				</div>
				<div class="col-sm">
					<div class="mb-3"> 
				 		 <input type="text" class="form-control" id="exampleFormControlInput1" name="lastName" placeholder="Last Name" required>
					</div>
				</div>
				
		</div>

		<div class="row">

			<div class="col-sm">
				<div class="mb-3"> 
				  <select class="form-select" id="inputGroupSelect02" name="department" required>
				    <option selected disabled>Department</option>
				  <?php

				  	$sql= "SELECT * FROM department WHERE status='Active';";
							$result= mysqli_query($conn,$sql);
							if (mysqli_num_rows($result)>0) {
							while ($row= mysqli_fetch_assoc($result)) {
							echo "<option value='". $row['id']."'>".$row['department']."</option>";
									    	}
									    }
					?>
				  </select>
				 </div>
			</div>
			<div class="col-sm">
				<div class="mb-3"> 
				  <select class="form-select" id="inputGroupSelect02" name="course" required>
				    <option selected disabled>Course</option>
				     <?php

				  	$sql= "SELECT * FROM course WHERE status='Active';";
							$result= mysqli_query($conn,$sql);
							if (mysqli_num_rows($result)>0) {
							while ($row= mysqli_fetch_assoc($result)) {
							echo "<option value='". $row['id']."'>".$row['course']."</option>";
									    	}
									    }
					?>
				  </select>
				 </div>
			</div>
		</div>

		<div class="row">
			<div class="mb-3">	 
			  <select class="form-select" id="inputGroupSelect02" name="acad" required>
				    <option selected disabled>Academic Year</option>
				     <?php

				  	$sql= "SELECT * FROM acad_year WHERE status='Active' ORDER BY id DESC;";
							$result= mysqli_query($conn,$sql);
							if (mysqli_num_rows($result)>0) {
							while ($row= mysqli_fetch_assoc($result)) {
							echo "<option value='". $row['id']."'>".$row['acad_year']."</option>";
									    	}
									    }
					?>
				  </select>
			</div>
		</div>

		<div class="row">
			<div class="mb-3">	 
			  <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email" required>
			</div>
		</div>

		
			<div class="row">
					<div class="col-sm">	
						<div class="mb-3">  
						  <input type="password" class="form-control" id="exampleFormControlInput1" name="password"  pattern=".{6,}" title="6 or more characters" placeholder="Password" required>
						</div>
					</div>
					<div class="col-sm">
						<div class="mb-3"> 
					  		<input type="password" class="form-control" id="exampleFormControlInput1" name="cpassword" placeholder="Confirm Password" required>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-sm">
				<div class="mb-3">
				Please make sure that all the above inputs are correct before submitting.
				</div>
				</div>
				
			</div>
			<div class="row">
				<div class="mb-3">
				  <button class="btn" type="submit" name="signup"> Create Account</button>
				</div>
			</div>
		</form>
		</div>
	</div>

	
	</div>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>