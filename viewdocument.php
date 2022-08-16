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
	<title>Student Documents</title>

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
		          <a class="nav-link active" aria-current="page" href="#"><b>Submission</b></a>
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
		<div class="card text-dark mb-3" style="height:fit-content; width:90%;">
		  <div class="card-header">
		  	<div class="row">
		  			<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="admin_home.php">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page">View Student</li>
							  </ol>
						</nav>
		  		
		  	</div>
		  </div>

<div class="card-body scroll" style="height: fit-content;">
<div class="row justify-content-center mt-3">

	<div class="col-lg-4 student">
	<div class="row justify-content-center m-3">
	<div class="card" style="width: fit-content;">
		<div class="card-body">
			
				<div class="box">
				<img src="img/student.png" height="100px" width="100px">
				</div>
			</div>
		</div>
	</div>

<?php

include_once "includes/conn.php";
	$sql="SELECT a.firstName, a.middleName, a.lastName, a.student_number, c.course, d.department FROM accounts a
	JOIN department d
	ON d.id=a.department
	JOIN course c 
	ON c.id= a.course 
	WHERE a.id='{$_GET['student']}';";
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
								foreach ($arr as $key => $row) {
			  			
?>
	<div class="row">
		<p class="name"><?php echo $row['lastName'].", " .$row['firstName']. " ". $row['middleName']; ?></p>
		<p class="details"><i class="bi bi-person-badge"></i> <?php echo $row['student_number'] ?></p>
		<p class="details"><i class="bi bi-collection"></i> <?php echo $row['course'] ?></p>
		<p class="details"> <i class="bi bi-book"></i> <?php echo $row['department']; ?></p>
		<p class="details"> <i class="bi bi-folder2"> </i> COMPLETE</p>
	</div>

	<?php }}?> 
</div>

<div class="col">
	<table class="table table-sm table-hover table.table-responsive table-bordered border-dark" id="myTable">
			  <thead>

			  

			    <tr>
			      <th scope="col">Documents</th>
			      <th scope="col">Status</th>
			      <th scope="col">Date Submitted</th>
			      <th scope="col">Action</th>

			    </tr>
			  </thead>
			<tbody>
			 	<?php 

			  	$sql="SELECT d.documents,s.status, s.sub_date FROM submitted s 
			  	JOIN documents d 
			  	ON s.doc_id=d.id
			  	WHERE s.stud_id ='{$_GET['student']}';";
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
								foreach ($arr as $key => $row) {
			  			
?>
			    <tr>
			      <td><?php echo $row['documents'];?></td>
			      <?php if ($row['status']=="S") {
			     echo "<td class='table-success'> Submitted
			      </td>";
			  }
			  else{
			  	  echo "<td class='table-danger'> Not Submitted
			      </td>";
			  }
			      ?>
			      <td><?php echo $row['sub_date'] ?></td>
			      <td><button class="btn btn-secondary"> View</button></td>

				</tr>

			  </tbody>
<?php }} ?>
			</table>
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