<!DOCTYPE html>
<html>
<head>
	<title>OTP Verification|Student</title>

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
				<p class="text">Verification Code</p>
			</div>
		</div>

		<div class="row justify-content-center">		
		<div class="col-md stdnt">
			
			<form action="includes/otpverification.php" method="POST">


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
					 	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Please enter verification code sent to your email. </strong>
						</div>		
			        <?php
			        break;
			        case 3:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Wrong Verification Code </strong>
						</div>		
			        <?php
			        break;
			         case 4:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Code Resent </strong>
						</div>		
			        <?php
			        break;
			        
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>
			
			<div class="form-floating mb-3">
			  <input type="text" class="form-control" id="floatingInput" name="code" placeholder="Verification Code">
			  <label for="floatingInput">Enter Verification Code</label>

			</div>
			

			<div class="mb-3 mt-3">
				<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">

			  <button class="btn" type="submit" name="verify"> Verify </button>			
			</div>

			
			</form>	

			<div class="span mt-3" style="text-align: left;">
				<div class="span mt-3" style="text-align: left;">
					<form action="includes/resendcode.php" method="POST">
						<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
						<button type="submit" name="resend" style="text-decoration: underline; outline: none; border: 0; background-color:white; color: #37af96;"> Resend Code</button>
					</form>
				</div>
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