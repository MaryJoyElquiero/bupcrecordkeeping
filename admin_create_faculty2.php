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
	<title>Admin | CreateFacultyAccount</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/admin_home.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<nav class="navbar sticky-top navbar-expand-sm navbar-light bg-light">
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
		          <a class="nav-link"  href="admin_documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link" href="admin_department.php">Departments</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_courses.php">Courses</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active"  aria-current="page" href="#"><b>Accounts</b></a>
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

	<div class="row justify-content-center content">
		<div class="card text-dark mb-3" style="height:fit-content; width:90%;">
		  <div class="card-header">
		  	<div class="row">
		  			<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="admin_students.php">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Create Program Head Account</li>
							  </ol>
						</nav>
		  		</div>
		  		
		  	</div>


			<div class="card-body scroll">



				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Connection Failed !</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong>Email Already Exists</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Confirm Password doesnt match </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Password Too Short </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>  Failed to create account</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
						break;
			        case 6:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Please fill up all fields</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>
			

<div class="row justify-content-center docu">
<div class="col-sm-8 mt-3">

						 <form action="includes/admin_create_acc.php" method="POST">

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
				  <select class="form-select" id="inputGroupSelect02" name="course" required>
				    <option selected disabled>Course</option>
				  <?php
include_once "includes/conn.php";
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
			  <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Email" required>
			</div>
		</div>

		
			<div class="row">
					<div class="col-sm">	
						<div class="mb-3">  
						  <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Password" required>
						</div>
					</div>
					<div class="col-sm">
						<div class="mb-3"> 
					  		<input type="password" class="form-control" id="exampleFormControlInput1" name="cpassword" placeholder="Confirm Password" required>
						</div>
					</div>
			</div>

			<div class="mb-3 row">
						
							<div class="col-sm-4 offset-md-8" align="right">
							<button class="btn btn-success" name="create_facacc2">Create Account</button>
							
							</div>


			</div>
				
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