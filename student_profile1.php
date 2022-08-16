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
	<title>Admin | StudentProfile</title>

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
		          <a class="nav-link active" aria-current="page" href="faculty_home.php"><b>Submission</b></a>
		        </li>
	
		        <li class="nav-item">
		          <a class="nav-link" href="faculty_account.php">Account</a>
		        </li>
		       
		      </ul>


<form action="includes/logout.php" method="POST">
		       <span class="ftype">

		        <?php

		        include_once "includes/conn.php";

					$sql="SELECT email,department from faculty WHERE id='{$_SESSION['fuid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$department=$row['department'];
					    echo "<i class='bi bi-dot'></i>
	".$row['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>
			</span>
					<button class="btn btn-dark" name="flogout"> Log Out <i class="bi bi-box-arrow-right"></i></button>
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
							    <li class="breadcrumb-item"><a href="viewStudent1.php?student=<?php echo $_GET['student']; ?>">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
							  </ol>
						</nav>
		  		
		  	</div>
		  </div>

<div class="card-body scroll" style="height: fit-content;">
<div class="row justify-content-center mt-3">

	<div class="col-lg-4 student">
	<div class="row justify-content-center m-3">
	<div class="col-sm-auto">
				<div class="box">
				<?php

include_once "includes/conn.php";
					$sql="SELECT profilepic from profile WHERE stud_id='{$_GET['student']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0){

					  while($pic = $result->fetch_assoc()) {
					  
					   if (empty($pic['profilepic'])) {
					    echo "<img src='profpic/student.png'>";
					   }
					   else{
					   	 echo "<img src='profpic/" .$pic['profilepic'] ."'>";
					   }
									}


							}
			 ?>
				</div>
				</div>
	</div>

<?php

include_once "includes/conn.php";
	$sql="SELECT a.firstName, a.middleName, a.lastName, c.course, d.department FROM accounts a
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
		<?php 
		$sql="SELECT count(1) FROM submitted WHERE status ='NS' AND stud_id='{$_GET['student']}';";
				$count=mysqli_query($conn,$sql);
				$rowcount=mysqli_fetch_array($count); ?>
		
		<p class="name"><?php echo $row['lastName'].", " .$row['firstName']. " ". $row['middleName']; ?></p>
		<div class="col-3 mb-3" style="font-weight: 600; font-size: 16px;"> Status:   </div>
		<?php if (empty($rowcount[0])) {
			      	echo "<div class='col mb-3 complete'>COMPLETE</div>";
			      } 
			      else{
			      	echo "<div class='col mb-3 incomplete'>INCOMPLETE</div>";
			      }?>
			    
		<p class="details"><i class="bi bi-collection"></i> <?php echo $row['course'] ?></p>
		<p class="details"> <i class="bi bi-book"></i> <?php echo $row['department']; ?></p>
	</div>

	<?php }}?> 

	
					<div class="card submit">
						<div class="card-body">
							<div class="row">
								<div class="col">
									
									<p class="num"> <?php 
											$sql= "SELECT count(1) as count FROM submitted WHERE status='S' AND stud_id='{$_GET['student']}';";

												$result = $conn->query($sql);

													if ($result->num_rows > 0) {

													  while($row = $result->fetch_assoc()) {
													   echo  $row['count'];
													}
												}
									 ?></p>
									 <p class="sub">Submitted</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card missing">
						<div class="card-body">
							<div class="row">
								<div class="col">
									
									<p class="num"> <?php 
											$sql= "SELECT count(1) as count FROM submitted WHERE status='NS' AND stud_id='{$_GET['student']}';";

												$result = $conn->query($sql);

													if ($result->num_rows > 0) {

													  while($row = $result->fetch_assoc()) {
													   echo  $row['count'];
													}
												}
									 ?></p>
									 <p class="sub">Missing</p>
								</div>
							</div>
						</div>
					</div>

</div>

<div class="col profileinfo">
	
				<div class="basic">
				<div class="title"> 
					<p>Basic Information
					</p>
				</div>

		<form action="includes/add_profile.php" method="POST">		


				<div class="infos">
					<?php 
						  if (isset($_GET['error'])) {
						    switch ($_GET['error']) {
						      case 1:
						        echo "<p class='error'>Connection Failed</p>";
						        break;
						      case 2:
						        echo "<p class='success'>Saved</p>";
						        break;
						      case 3:
						        echo "<p class='error'>Not Saved</p>";
						        break;
						      default:
						        echo "";
						        break;
						    }
						  }
				 		?>
					<?php 
					  	$sql="SELECT * FROM profile WHERE stud_id='{$_GET['student']}';";

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

					  		foreach ($arr as $key => $profile) {


					 ?>
					 <div class="row profile">
						<div class="col-sm-5 label">Age :</div>
						<div class="col-sm-7 info"> 
							<input class="form-control" type="text" name="age"  id="age" readonly="" 	value="<?php 
						if(empty($profile['age'])){
								echo "Not Set";
						}
						else{
						echo $profile['age'];}?>">
					</div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Gender :</div>
						<div class="col-sm-7 info">
							 <select class="form-select" id="gender" name="gender" disabled>
					    		<option selected> 
					    			<?php if( empty($profile['gender'])){
							echo "Not Set"; 
						}
						else{
						echo $profile['gender'];
					} ?>
					    		</option>
					    		<option >Male</option>
					    		<option >Female</option>
					  		</select>
				 		</div>
				 	</div>
					
					<div class="row profile">
						<div class="col-sm-5 label">Mobile Number :</div>
						<div class=" col-sm-7 info"> <input class="form-control" type="text" name="mno"  id="mno"  readonly="" value="<?php 
						if( empty($profile['pn'])){
							echo "Not Set";
						}
						else{
						echo $profile['pn'];
					}
					?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Nationality :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="nationality"  id="nationality"  readonly="" value="<?php if( empty($profile['nationality'])){
							echo "Not Set";
						}
						else{
						echo $profile['nationality'];
					}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Place of Birth :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="pob"  id="pob"  readonly="" value="<?php
						if( empty($profile['pob'])){
							echo "Not Set";
						}
						else{
						echo $profile['pob'];
					} ?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Date of Birth :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="date" name="dob"  id="dob"  readonly="" value="<?php echo $profile['dob'];?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Religion :</div>
						<div class="col-sm-7 info"><input class="form-control" type="text" name="religion"  id="religion" readonly="" value="<?php if( empty($profile['religion'])){
							echo "Not Set";
						}
						else{
						echo $profile['religion'];
					}?>"></div>
					</div>
		
				</div>
			</form>

		</div>
	
			
			

				<div class="basic">
				<div class="title"> 
					<p>Address Information</p></div>
				<form action="includes/add_profile.php" method="POST">
				<div class="infos">
					
					<div class="row profile">
						<div class="col-sm-5 label">House Number/Street :</div>
						<div class="col-sm-7 info"><input class="form-control" type="text" name="hn" id="hn" readonly="" value="<?php
						if(empty($profile['street'])){
								echo "Not Set";
						}
						else{
						echo $profile['street'];
					}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Barangay :</div>
						<div class="col-sm-7 info"><input class="form-control" type="text" name="brgy" id="brgy" readonly="" value="<?php if(empty($profile['brgy'])){
								echo "Not Set";
						}
						else{
						echo $profile['brgy'];
					}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Municipality/City :</div>
						<div class="col-sm-7 info"><input class="form-control" type="text" name="city" id="city" readonly="" value="<?php if(empty($profile['city'])){
								echo "Not Set";
						}
						else{
						echo $profile['city'];}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Province :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="prov" id="prov" readonly="" value="<?php 
						if(empty($profile['province'])){
								echo "Not Set";
						}
						else{
						echo $profile['province'];}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Zip Code :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="zc" id="zc" readonly="" value="<?php 
						if(empty($profile['zip_code'])){
								echo "Not Set";
						} 
						else{
						echo $profile['zip_code'];}?>"></div>
					</div>

				</div>
				</form>

			</div>

				<?php }} ?>

				<div class="basic">
				<div class="title"> 
					<p>Family Information</p></div>
				<form action="includes/add_profile.php" method="POST">
				<div class="infos">
					
					<div class="row profile">
						<div class="col-sm-5 label">Mother's Name :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="mn" id="mn" readonly="" value="<?php 
						if(empty($profile['mn'])){
								echo "Not Set";
						}
						else{
						echo $profile['mn'];
					}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Mother's Occupation :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="mo" id="mo" readonly="" value="<?php 
						if(empty($profile['m_occ'])){
								echo "Not Set";
						}
						else{
						echo $profile['m_occ'];}?> "></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Father's Name :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="fn" id="fn" readonly="" value="<?php 
					if(empty($profile['fn'])){
								echo "Not Set";
						}
						else{
						echo $profile['fn'];}?> "></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Father's Occupation :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="fo" id="fo" readonly="" value="<?php 
						if(empty($profile['f_occ'])){
								echo "Not Set";
						}
						else{
						echo $profile['f_occ'];}?> "></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> No. of Siblings :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="siblings" id="siblings" readonly="" value="<?php 
						if(empty($profile['nos'])){
								echo "Not Set";
						}
						else{
						echo $profile['nos'];}?> "></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Monthly Income :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="mi" id="mi" readonly="" value="<?php 
						if(empty($profile['mi'])){
								echo "Not Set";
						}
						else{
						echo $profile['mi'];}?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Annual Income :</div>
						<div class="col-sm-7 info"> <input class="form-control" type="text" name="ai" id="ai" readonly="" value="<?php 
						if(empty($profile['ai'])){
								echo "Not Set";
						}
						else{
						echo $profile['ai'];}?>"></div>
					</div>
				</div>
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