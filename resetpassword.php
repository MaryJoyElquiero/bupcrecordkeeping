<!DOCTYPE html>
<html>
<head>
	<title>Password Reset|Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/stdntlogin.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-fluid">

	


	<div class="row justify-content-center">
		<div class="col-md-3 align-self-center box">

		<div class="row justify-content-center">
			<div class="col-md-auto">
				<img src="img/student.png">
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<p class="text">Password Reset</p>
			</div>
		</div>

		<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Connection Failed </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			         case 2:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Passwords doesn't match </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			         case 3:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Password is too short </strong>
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
		<div class="row justify-content-center">
		
		<div class="col-md stdnt">
			
			<form action="includes/resetpass.php" method="POST">
			<div class="form-floating mb-3">
			  <input type="password" class="form-control" id="floatingInput" name="newpass" pattern=".{6,}" title="6 or more characters" placeholder="New Password">
			  <label for="floatingInput">New Password</label>
			</div>
			<div class="form-floating">
			  <input type="password" class="form-control" id="floatingPassword" name="cpass" pattern=".{6,}" title="6 or more characters" placeholder="Confirm Password">
			  <label for="floatingPassword">Confirm New Password</label>
			</div>

			<div class="mb-3 mt-3">
			  <button class="btn" type="submit" name="reset">Update Password</button>			
			</div>
			<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
			</form>	
					
		</div>
		</div>
		</div>
	
</div>

</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>