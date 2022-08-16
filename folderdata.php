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
	<title>Admin | Home </title>
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
		          <a class="nav-link"  href="admin_home.php">Submission</a>
		        </li>
		          <li class="nav-item">
		          <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="admin_documents.php">Documents</a>
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

<div class="container-fluid">
	<div class="row justify-content-center content">
		
		<div class="card text-dark mb-3" style="width:95%;">
		
		  	<div class="row" style="margin-left: 10px; margin-right: 10px;">

		  		<?php 

		  		include_once "includes/conn.php";
		  			$query = "SELECT MAX(id) FROM acad_year";
						$result = mysqli_query($conn,$query);
						$ay= mysqli_fetch_row($result);

			if (isset($_GET['acad_id'])) {
			$acad_y=$_GET['acad_id'];
				
			}
			else{
				$acad_y= $ay[0];
			}
	
		  		 ?>
		  		<div class="col-sm-5 mt-2">
		  				<?php 
		  					if (isset($_GET['id'])) {
		  						
		  						$sql="SELECT documents from documents WHERE id='{$_GET['id']}';";
		  						$result = $conn->query($sql);
									if ($result->num_rows > 0) {

					  while($row1 = $result->fetch_assoc()) {
					  	?>
					  	<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-file-earmark-text" style="font-size: 40px; "></i> <?php echo $row1['documents'] ?> -Submitted</p>
					  	<?php
					  }

					}
				}else{
					header("Location: admin_dashboard.php");
					exit();
				}
		  				
		  				 ?>
						
					</div>
					<div class="col-sm-5 offset-md-2">
						<div class="dropdown mt-2">
							Select Academic Year:
					  <a class="btn mb-3 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="border: solid 1px lightgray; width: 100%; background-color: white;">
					    <?php 
					    		$sql="SELECT acad_year from acad_year WHERE id='$acad_y';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {

					   echo $row['acad_year'];
					  }

					}

				?>

					  </a>


					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">	
							 
							<?php
							include_once "includes/conn.php";
				

							$sql="SELECT * FROM acad_year ORDER BY id DESC;";
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
								foreach ($arr as $key => $ac) {

							?>
	 					<form action="admin_home.php" method="POST">
						<li>
					  <a class="dropdown-item" name="flter_course" href="folderdata.php?id=<?php echo $_GET['id']; ?>&&acad_id=<?php echo $ac['id']; ?>"><?php echo $ac['acad_year']; ?></a></li>	 
	 					</form>

							<?php  }} ?>
							</ul>

					</div>
					</div>

		<hr>
		  	</div>

		  	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		  		<div class="col-sm-1">
		  			<p style="padding-top: 10px;">Filter list:</p>
		  		</div>
		  		<div class="col-md-6">
	
		  			<div class=" btn-group dropdown mt-1">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
					    <?php if (isset($_GET['course_id'])) {
					    	$sql="SELECT * from course WHERE id='{$_GET['course_id']}';";
								$result = $conn->query($sql);

									if ($result->num_rows > 0) {

					 				 while($row = $result->fetch_assoc()) {
					 				 	echo $row['course'];
					  }

					}

					    }
					    else{
					    	echo "Course";
					    } ?>
					  </a>


					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">	
					  	  <li><a class="dropdown-item" href="folderdata.php?id=<?php echo $_GET['id']; ?>&&acad_id=<?php echo $acad_y; ?>">All</a></li>

				<?php 
				 include_once "includes/conn.php";
					  $sql="SELECT * FROM course;";
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
								foreach ($arr as $key => $course) {
			  			?>
 					
					    <li>
					    	<a class="dropdown-item" name="flter_course" href="folderdata.php?id=<?php echo $_GET['id']; ?>&&course_id=<?php echo $course['id']; ?>&&acad_id=<?php echo $acad_y; ?>"><?php echo $course['course']; ?></a></li>
					 

	 <?php 	}} ?>
					  </ul>

					</div>
		  			<div class=" btn-group dropdown mt-1">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
					    <?php if (isset($_GET['dept_id'])) {
					    	$sql="SELECT * from department WHERE id='{$_GET['dept_id']}';";
								$result = $conn->query($sql);

									if ($result->num_rows > 0) {

					 				 while($row = $result->fetch_assoc()) {
					 				 	echo $row['department'];
					  }

					}

					    }
					    else{
					    	echo "Department";
					    } ?>
					  </a>

					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					  	  <li><a class="dropdown-item" href="admin_home.php?id=<?php echo $_GET['id']; ?>&&acad_id=<?php echo $acad_y; ?>">All</a></li>
					  	<?php 
				 include_once "includes/conn.php";
					  $sql="SELECT * FROM department;";
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
					    <li><a class="dropdown-item" href="folderdata.php?id=<?php echo $_GET['id']; ?>&&dept_id=<?php echo $dept['id']; ?>&&acad_id=<?php echo $acad_y; ?>"><?php echo $dept['department']; ?></a></li>
					  <?php }} ?>
					  </ul>
					</div>
		  		</div>
		  		<div class="col-md-4 offset-md-1">
		  			<div class="input-group mt-1">
						<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search">
						<button class="btn btn-dark"><i class="bi bi-search"></i></button>
					</div>
		  		</div>
		  	</div>
			<div class="card-body" style="height:500px; overflow-y:scroll;">



	 				  <?php 
			include_once "includes/conn.php";

			if (isset($_GET['course_id'])) {

				$filter=$_GET['course_id'];
					$sql= "SELECT a.firstName,a.middleName,a.lastName,d.department,c.course,ac.acad_year,do.documents,s.sub_date,s.file FROM submitted s 
					JOIN accounts a 
					ON s.stud_id=a.id
					JOIN department d 
					on d.id= a.department
					JOIN course c 
					on c.id=a.course
					JOIN documents do
					on s.doc_id=do.id
					JOIN acad_year ac
					ON a.acad_year=ac.id
					WHERE a.course= '$filter'
					AND a.acad_year= '$acad_y'
					AND s.status IN ('S','L')
					AND s.doc_id='{$_GET['id']}'
					ORDER BY a.lastname
					ASC;";
			}

			elseif (isset($_GET['dept_id'])) {

				$filter=$_GET['dept_id'];
					$sql= "SELECT a.firstName,a.middleName,a.lastName,d.department,c.course,ac.acad_year,do.documents,s.sub_date,s.file FROM submitted s 
					JOIN accounts a 
					ON s.stud_id=a.id
					JOIN department d 
					on d.id= a.department
					JOIN course c 
					on c.id=a.course
					JOIN documents do
					on s.doc_id=do.id
					JOIN acad_year ac
					ON a.acad_year=ac.id
					WHERE a.department= '$filter'
					AND a.acad_year= '$acad_y'
					AND s.status IN ('S','L')
					AND s.doc_id='{$_GET['id']}'
					ORDER BY a.lastname,c.course
					ASC;";

			}

			else{
					$sql= "SELECT a.firstName,a.middleName,a.lastName,d.department,c.course,ac.acad_year,do.documents,s.sub_date,s.file FROM submitted s 
					JOIN accounts a 
					ON s.stud_id=a.id
					JOIN department d 
					on d.id= a.department
					JOIN course c 
					on c.id=a.course
					JOIN documents do
					on s.doc_id=do.id
					JOIN acad_year ac
					ON a.acad_year=ac.id
					AND a.acad_year= '$acad_y'
					AND s.status IN ('S','L')
					AND s.doc_id='{$_GET['id']}'
					ORDER BY a.lastname,c.course
					ASC;";
				}

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
								
						 ?>

			<table class="table table-sm table-hover table.table-responsive table-bordered border-dark" id="myTable">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Department</th>
			      <th scope="col">Course</th>
			      <th scope="col">Acad Year</th>
			      <th scope="col">Document Name</th>
			      <th scope="col">Date Submitted</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			<tbody>
				<?php  if (!empty($arr)) {
								foreach ($arr as $key => $accounts) { ?>
			    <tr>
			      <td><?php echo $accounts['lastName'] .", ".$accounts['firstName'] ." ". $accounts['middleName']; ?></td>
			        <td><?php echo $accounts['department']; ?></td>
			      <td><?php echo $accounts['course']; ?></td>
			      <td><?php echo $accounts['acad_year']; ?></td>
			      <td><?php echo $accounts['documents']; ?></td>
			      <td><?php echo $accounts['sub_date']; ?></td>
			      <td>
			      <a href="documents/<?php echo $accounts['file']; ?>" class="btn btn-success" target="-blank"> View</a>
			      	<a href="documents/<?php echo $accounts['file']; ?>" class="btn btn-success" download><i class="bi bi-download"></i></a>
			      </td>
			  
			    </tr>

			  	<?php }
			  	?>
			  <tr>
				<td colspan=100 class="text-center"><em>End of Result</em></td>
				</tr>
			<?php
			  } 
			  else{
			  	?>
			  <tr>
				<td colspan=100 class="text-center"><em>Empty</em></td>
				</tr>
			  	<?php
			  }?>
			  </tbody>

			</table>
			<ul class="pagination pagination-lg pager" id="myPager"></ul>
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