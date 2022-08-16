<!DOCTYPE html>
<html>
<head>
	<title>Log in|Student</title>

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
				<p class="text"> Student Log In</p>
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
					  <strong> Wrong Email or Password</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			         case 3:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Email Verified. You can now log in</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			        case 4:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Password Changed</strong>
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
			
			<form action="includes/login_connect.php" method="POST">
			<div class="form-floating mb-3">
			  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
			  <label for="floatingInput">Email address</label>
			</div>
			<div class="form-floating">
			  <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
			  <label for="floatingPassword">Password</label>
			</div>

			<div class="mb-3 mt-3">
			  <button class="btn" type="submit" name="login"> Log in</button>			
			</div>
			<div class="span" style="text-align: left; "><a href="forgotpass.php" style="color:#37af96; ">Forgot Password?</a></div>
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