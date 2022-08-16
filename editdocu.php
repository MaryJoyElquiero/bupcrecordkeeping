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
	<title>Admin | Edit Document</title>

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
		          <a class="nav-link active"  aria-current="page" href="#"><b>Documents</b></a>
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

	<div class="row justify-content-center content">
		<div class="card text-dark mb-3" style="height:500px; width:90%;">
		  <div class="card-header">
		 <div class="row">
		  			<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="admin_documents.php">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Edit Documents</li>
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
								  <strong> Failed !</strong>
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
	<form action="includes/edit_docu.php" method="POST">
					<?php 
						if (isset($_GET['id'])) {
							$id=$_GET['id'];
						}
					include_once "includes/conn.php";

$sql="SELECT * FROM documents WHERE id= '$id';";

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

				  		foreach ($arr as $key => $docu) {


						 ?>
			
		

						 <div class="mb-3 row">
						    <label for="input" class="col-sm-3 col-form-label"> Document Name</label>
						    <div class="col-sm-9">
						      <input type="text" name="docu" class="form-control" id="input" value="<?php echo $docu['documents']; ?>">
						    </div>
 						 </div>
 						 <div class="mb-3 row">
						    <label for="input" class="col-sm-3 col-form-label"> Required File Type</label>
						    <div class="col-sm-9">
						    	 <select class="form-select" aria-label="Default select example" name="filetype">
									  <option selected ><?php echo $docu['filetype']; ?></option>
									  <option value="PDF">PDF </option>
									  <option value="IMAGE">IMAGE ( jpg, jpeg, png) </option>
									  <option value=".DOCX">.DOCX</option>
									</select>
						    </div>
 						 </div><div class="mb-3 row">
						    <label for="input" class="col-sm-3 col-form-label"> Deadline</label>
						    <div class="col-sm-9">
						      <input type="date" name="deadline" class="form-control" id="input" value="<?php echo strftime('%Y-%m-%d',
  strtotime($docu['deadline'])); ?>" min="<?php echo date("Y-m-d"); ?>" >
						    </div>
 						 </div>
 						  <div class="mb-3 row">
						    <label for="input" class="col-sm-3 col-form-label"> Status</label>
						    <div class="col-sm-9">
						      <select class="form-select" id="inputGroupSelect02" name="status" required>
				    			<option selected value="<?php echo $docu['docu_status']; ?>"> <?php echo $docu['docu_status']; ?></option>
							    			<?php if ($docu['docu_status']=="Active") {
							    				echo "<option  value='Deactivated'>Deactivate</option>";
							    			} 
							    			else{
							    				echo "<option  value='Active'>Activate</option>";
							    			}?>
				  </select>
						    </div>
 						 </div>
 					
	
						<div class="mb-3 row">
						
							<div class="col-sm-4 offset-md-9">
							<a href="admin_documents.php" class="btn btn-danger" type="button">Cancel</a>
							<input type="hidden" name="id" value="<?php echo $docu['id']; ?>">
							<button class="btn btn-secondary" name="update">Update</button>
							
							</div>

						</div>
				<?php }} ?>
		</form>
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
    td = tr[i].getElementsByTagName("td")[1];
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
</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>