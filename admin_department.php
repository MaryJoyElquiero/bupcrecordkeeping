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
	<title>Admin | Department</title>

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
		          <a class="nav-link "  href="admin_documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link active"  aria-current="page" href="#"><b>Departments</b></a>
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
		<div class="card text-dark mb-3" style="height:fit-content; width:95%;">
		
		  	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		  		<div class="col-sm-4">
						<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-book-half" style="font-size: 40px; "></i> BUPC Departments </p>
					</div>
		  		<div class="col-sm-2 offset-md-2 mt-3" align="right">
		  			<button class="btn btn-secondary"  data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-folder-plus"></i> Add</button>
		  		</div>
		  		<div class="col-sm-4 mt-3">
		  			<div class="input-group">
						<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search">
						<button class="btn btn-dark"><i class="bi bi-search"></i></button>
					</div>
		  		</div>
		  		
		  		<div class="collapse mb-3" id="collapseExample">
					  <div class="card card-body mt-1">
					  	<form action="includes/add_dept.php" method="POST">
					    <div class="m-1 row">
						    <label for="inputName" class="col-sm-2 col-form-label">Department :</label>
						    <div class="col-sm-5 mt-1">
						      <input type="text" name="dept" class="form-control" id="inputName">
						    </div>
						    <div class="col-auto mt-1">
							    <button type="submit" name="add" class="btn btn-secondary">Add</button>
							  </div>
						  </div>
						  </form>
					  </div>
</div>
<hr>
		  	</div>
	
			<div class="card-body scroll">

				
				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong> Added Successfully !</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Failed to Add </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Deleted </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Failed to Delete </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Updated </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>
			
			<table class="table table-sm table-hover table.table-responsive table-bordered border-dark" id="myTable">
			  <thead>
			    <tr>
			      <th scope="col">Department</th>
			      <th scope="col">Status</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			<tbody>
			  <?php 
			include_once "includes/conn.php";


					$sql= "SELECT * FROM department ORDER BY department ASC;";
			
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
						foreach ($arr as $key => $dept) {
			  			?>
			    <tr>
			      <td  ><?php echo $dept['department']; ?></td>
			      <td  ><?php echo $dept['status']; ?></td>
			      <td>
			      	<input type="hidden" name="id" value="<?php echo $dept['id']; ?>">
			      	<a href="editdept.php?id=<?php echo $dept['id']; ?>" class="btn btn-success" type="button" name="edit"> <i class="bi bi-pencil-square"></i> </a>
			      </td>
			    </tr>

			  	<?php }
			  	?>
			  	<tr>
				<td colspan ="100" class="text-center"><em>End of Result</em></td>
				</tr>
			<?php
		}
			 else{
			  	?>
			  		<tr id="noresult">
				<td colspan ="100" class="text-center"><em>Empty</em></td>
				</tr>
				<?php
			  } ?>
			  </tbody>

			</table>

		</div>
	</div>
	
</div>
</div>

<script>
function myFunction() {
 var input, filter, table, tr, i, j, column_length, count_td;
      column_length = document.getElementById('myTable').rows[0].cells.length;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 1; i < tr.length; i++) { // except first(heading) row
        count_td = 0;
        for(j = 0; j < column_length-1; j++){ // except first column
            td = tr[i].getElementsByTagName("td")[j];
            /* ADD columns here that you want you to filter to be used on */
            if (td) {
              if ( td.innerHTML.toUpperCase().indexOf(filter) > -1)  {            
                count_td++;
              }
            }
        }
        if(count_td > 0){
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
      }
}


</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>