<?php 
session_start();


if (!isset($_SESSION['fuid'])) {
	header("Location: fcltylogin.php");
	exit();
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Faculty | Home</title>

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
		          <a class="nav-link" href="faculty_account.php">Account</a>
		        </li>
		       
		      </ul>
		        

<form action="includes/logout.php" method="POST">
				 <span class="ftype">

		        <?php

		        include_once "includes/conn.php";

					$sql="SELECT email,department,course from faculty WHERE id='{$_SESSION['fuid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$department=$row['department'];
					  	$course=$row['course'];
					    echo "<i class='bi bi-dot'></i>
	".$row['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>
			</span>

		      <span class="navbar-text">
					<button class="btn btn-dark" name="flogout">Log Out <i class="bi bi-box-arrow-right"></i></button>
			</span>
</form>
			
		     
		    </div>
		  </div>
</nav>

<div class="container-fluid">
	<div class="row justify-content-center content">
		<div class="card text-dark mb-3" style="height:fit-content; width:100%;">
		
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
		  		<div class="col-sm-3 mt-2">
						<p style="font-size: 24px; font-weight: 600;"><i class="bi bi-card-list" style="font-size: 40px; "></i> List of Students</p>
					</div>
					<div class="col-sm-5 offset-md-4">
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
					  <a class="dropdown-item" name="flter_course" href="faculty_home.php?acad_id=<?php echo $ac['id']; ?>"><?php echo $ac['acad_year']; ?></a></li>	 
	 					</form>

							<?php  }} ?>
							</ul>

					</div>
					</div>

		<hr>
		  	</div>

		  	<div class="row" style="margin-left: 10px; margin-right: 10px;">
		  		

		  		<?php if (!empty($department)) {
		  			?>
		  			<div class="col-md-1  mt-2">
		  			<p style="padding-top: 10px; text-align: right;">Filter list:</p>
		  			</div>
		  			<div class="col-md-1">
		  			<div class=" dropdown mt-1">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
					    Course
					  </a>


					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">	
					  	  <li><a class="dropdown-item" href="faculty_home.php">All</a></li>

				<?php 
				 include_once "includes/conn.php";
					  $sql="SELECT * FROM course WHERE dept_id='$department';";
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
 						<form action="faculty_home.php" method="POST">
					    <li>
					    	<a class="dropdown-item" name="flter_course" href="faculty_home.php?course_id=<?php echo $course['id']; ?>&&acad_id=<?php echo $acad_y; ?>"><?php echo $course['course']; ?></a></li>
					  </form>

	 <?php 	}} ?>
					  </ul>

					</div>
		  		</div>
		  			<?php
		  		}
		  		else{
		  			?>
		  			<div class="col-md-1  mt-2">
		  			<p style="padding-top: 10px; text-align: right;">Course:</p>
		  		</div>
		  			<?php
		  		} ?>
		  		

		  			

		  			<div class="col-md-4 mt-1">
		  				<button class="btn btn-success"> <?php 
		  					$sql="SELECT department from department WHERE id='$department';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row1 = $result->fetch_assoc()) {

					   echo $row1['department'];
					  }

					}
					else{
						$sql="SELECT course from course WHERE id='$course';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row1 = $result->fetch_assoc()) {

					   echo $row1['course'];
					  }

					}
					}
		  				 ?></button>

		  		</div>

		 		
		  		<div class="col-md-4 offset-md-2">
		  			<div class="input-group mt-1">
						<input type="text" name="search" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search">
						<button class="btn btn-dark"><i class="bi bi-search"></i></button>
					</div>
		  		</div>
		  	</div>
		
			<div class="card-body" style="overflow-x:auto; overflow-y:auto ;">

				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-primary alert-dismissible fade show" role="alert">
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
					  <strong> Updated</strong>
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
			      <th scope="col">Name</th>
			      <th scope="col">Department</th>
			      <th scope="col">Course</th>
			      <th scope="col">Status</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			<tbody>
			  <?php 
			include_once "includes/conn.php";

			if (!empty($department)) {
				if (isset($_GET['course_id'])) {

				$filter=$_GET['course_id'];
					$sql= "SELECT  a.id,a.firstName, a.middleName, a.lastName, d.department,y.acad_year,c.course  FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE c.id='$filter'
					AND a.department='$department'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null
					ORDER BY a.firstName
					ASC;";
			}

			else{

					$sql= "SELECT a.id, a.firstName, a.middleName, a.lastName, d.department,y.acad_year,c.course FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE a.department= '$department'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null	
					ORDER BY c.course,a.firstName
					ASC;";
				}
			}
			else{
				if (isset($_GET['course_id'])) {

				$filter=$_GET['course_id'];
					$sql= "SELECT  a.id,a.firstName, a.middleName, a.lastName, d.department,y.acad_year,c.course  FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE c.id='$filter'
					AND a.course='$course'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null
					ORDER BY a.firstName
					ASC;";
			}

			else{

					$sql= "SELECT a.id, a.firstName, a.middleName, a.lastName, d.department,y.acad_year,c.course FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE a.course= '$course'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null	
					ORDER BY c.course,a.firstName
					ASC;";
				}
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
						 if (!empty($arr)) {
						foreach ($arr as $key => $accounts) {
 

	$sql="SELECT count(1) FROM submitted WHERE status ='NS' AND stud_id='{$accounts['id']}';";
				$count=mysqli_query($conn,$sql);
				$rowcount=mysqli_fetch_array($count);

			  			?>
			    <tr>
			      <td><?php echo $accounts['lastName'] .", ".$accounts['firstName'] ." ". $accounts['middleName']; ?></td>
			      <td><?php echo $accounts['department']; ?></td>
			      <td><?php echo $accounts['course']; ?></td>

			      <?php if (empty($rowcount[0])) {
			      	echo "<td class='table-success'>Complete</td>";
			      } 
			      else{
			      	echo "<td class='table-danger'>Incomplete</td>";
			      }?>
			    
			      <td>
			      	<input type="hidden" name="stud_id" value="<?php echo $accounts['id']; ?>">
			      	<a href="viewStudent1.php?student=<?php echo $accounts['id']; ?>" class="btn btn-success" type="button"> View </a>
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