<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password |Student</title>

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
				<p class="text"> Forgot Password ?</p>
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
					  <strong> Email not Found</strong>
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
			
			<form action="includes/otpverification.php" method="POST">
			<div class="form-floating mb-3">
			  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
			  <label for="floatingInput">Enter Email Address</label>
			</div>

			<div class="mb-3 mt-3">
			  <button class="btn" type="submit" name="reset"> Send Code </button>			
			</div>
			<hr>
			<a href="createaccount.php"><span> Create Account </span></a>
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