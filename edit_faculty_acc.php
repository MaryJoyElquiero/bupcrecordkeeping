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
	<title>Admin | Accounts</title>

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
							    <li class="breadcrumb-item"><a href="admin_faculty.php">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Edit Account</li>
							  </ol>
						</nav>
		  		
		  		
		  	</div>
		  </div>


			<div class="card-body scroll">

			<div class="row justify-content-center mt-3">
					<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong> Saved </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Not Saved </strong>
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
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Email is already taken </strong>
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



				
				<div class="row justify-content-center docu">
<div class="col-sm-8 mt-3">


		<?php

		        include_once "includes/conn.php";

					$sql="SELECT a.firstName, a.lastName, a.middleName,d.id as dept_id, d.department, a.email, a.password from faculty a 
					JOIN department d
					ON a.department= d.id
					WHERE a.id='{$_GET['id']}';";

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
						foreach ($arr as $key => $acc) {
	
						?>

						 <form action="includes/admin_editacc.php" method="POST">

						<div class="row">
				<div class="col-sm mb-3">
					<div class="form-group">
		      <label for="inputEmail4">First Name</label>
		      <input type="text" class="form-control" id="exampleFormControlInput1" name="firstName" placeholder="First Name" value="<?php echo $acc['firstName']; ?>" required>
		    </div>
				</div>	
				<div class="col-sm mb-3">
					<div class="form-group">
			      <label for="inputEmail4">Middle Name</label>
			      <input type="text" class="form-control" id="exampleFormControlInput1" name="middleName" placeholder="Middle Name" value="<?php echo $acc['middleName']; ?>">
		   		</div>
				</div>	
				<div class="col-sm mb-3">
					<div class="form-group">
			      <label for="inputEmail4">Last Name</label>
			      <input type="text" class="form-control" id="exampleFormControlInput1" name="lastName" placeholder="First Name" value="<?php echo $acc['lastName']; ?>" required>
		   		</div>
				</div>
				
					</div>
		<div class="row">

			<div class="col-sm mb-3">
					<div class="form-group">
						<label for="inputGroupSelect02">Department</label>
				  <select class="form-select" id="inputGroupSelect02" name="department" required>
				    <option selected value="<?php echo $acc['dept_id'];  ?>"> <?php echo $acc['department'];  ?></option>
				  <?php
include_once "includes/conn.php";
				  	$sql= "SELECT * FROM department;";
							$result= mysqli_query($conn,$sql);
							if (mysqli_num_rows($result)>0) {
							while ($dept= mysqli_fetch_assoc($result)) {
							echo "<option value='". $dept['id']."'>".$dept['department']."</option>";
									    	}
									    }
					?>
				  </select>
				 </div>
			</div>
		</div>
		<div class="col-sm mb-3">
					<div class="form-group">
						<label for="inputGroupSelect02">Email</label>
			  <input type="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $acc['email']; ?>" name="email" placeholder="Email" required>
			</div>
		</div>

		
			<div class="row">
				<div class="col-sm mb-3">
					<div class="form-group">
						<label for="inputGroupSelect02">Password</label>
						  <input type="password" class="form-control" data-toggle="password" value="<?php echo $acc['password']; ?>"  id="password" name="password" placeholder="Password" required>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-sm">
							<input type="checkbox" onclick="myFunction()"> Show Password
					</div>
			</div>
		
			<div class="mb-3 row">
						
							<div class="col-sm-4 offset-md-8" align="right">
									<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
							<button class="btn btn-success" name="editfaculty">Save Changes</button>					
							</div>

			</div>
				
		</form>

		<?php }} ?>
			
				</div>
			</div>
			</div>
		</div>
	</div>
	
</div>
</div>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>



<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>