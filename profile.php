<?php
session_start();


if (!isset($_SESSION['uid'])) {
	header("Location: stdntlogin.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile | Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/profile.css">
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
		          <a class="nav-link " aria-current="page" href="stud_home.php">Submission</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link active"   aria-current="page"  href="#"><b>Profile</b></a>
		        </li>
		       
		      </ul>

		<form action="includes/logout.php" method="POST">
		       <span class="stype">

		        <?php

		        include_once "includes/conn.php";

					$sql="SELECT * from accounts WHERE id='{$_SESSION['uid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$stud_id=$row['id'];
					   echo "<i class='bi bi-dot'></i>
	".$row['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>

				
				<button class="btn" name="logout"> Log Out <i class="bi bi-box-arrow-right"></i></button>
</form>
			</span>
			
		     
		    </div>
		  </div>
</nav>

<?php 
	$sql="SELECT stud_id from profile WHERE stud_id ='$stud_id';";
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
				    if (empty($arr)) {
				    	$sql1="INSERT INTO profile(stud_id) VALUES ('$stud_id')";

							if (!mysqli_query($conn, $sql1)) {
							header("Location: profile.php?notif=1");
							exit();
							} 
				    }
				    
 ?>

<div class="container">
<div class="row justify-content-center">
	<div class="row justify-content-center box">
		<div class="row justify-content-center">
			<div class="col-sm student m-1">
				<div class="pp">
					<?php
					$sql="SELECT profilepic from profile WHERE stud_id='{$_SESSION['uid']}';";
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

					    <?php

		        include_once "includes/conn.php";

					$sql="SELECT a.firstName, a.lastName, a.middleName, d.department, c.course from accounts a 
					JOIN course c
					ON a.course= c.id
					JOIN department d
					ON a.department= d.id
					WHERE a.id='{$_SESSION['uid']}';";

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
				<div class="name">
					<?php echo "<h5>". $row['lastName'].", ".$row['firstName']." ". $row['middleName']."</h3>";?>
				</div>
				<hr>
				<div class="Setting">
						<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong> Invalid File type</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> File is too big </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong> Uploaded </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Failed </strong>
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
					<button class="btn1" id="btn1"> Change Profile Picture</button>

					<form action="includes/uploadpic.php" method="POST" enctype="multipart/form-data">
						<input class="form-control mt-2" hidden type="file" id="pic" name="file" accept=".jpeg, .jpg, .png">
						<button class="btn mt-2 mb-2" hidden id="upload" name="up">Upload</button>
					</form>

					<p><a href="accountsetting.php" class="settings" style="text-decoration: none; color: black;">Account Setting</a></p>
				</div>
					<hr>
				<div class="details">

					<h6><i class="bi bi-collection"></i> <?php echo $row['course'];?> </h6>
					<h6> <i class="bi bi-book"></i> <?php echo $row['department'];?> </h6>
				</div>
				
					<?php }} ?>

					<div class="card submit">
						<div class="card-body">
							<div class="row">
								<div class="col">
									
									<p class="num"> <?php 
											$sql= "SELECT count(1) as count FROM submitted WHERE status='S' AND stud_id='{$_SESSION['uid']}';";

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
											$sql= "SELECT count(1) as count FROM submitted WHERE status='NS' AND stud_id='{$_SESSION['uid']}';";

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




			<div class="col-lg-8 profileinfo m-1">
					 			<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 5:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
								  <strong> Connection Failed</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 6:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
					  <strong> Saved </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 7:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Not saved </strong>
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
				<div class="basic">
				<div class="title"> 
					<p>Basic Information
					</p>
				</div>

		<form action="includes/add_profile.php" method="POST">		


				<div class="infos">

			
					<?php 
					  	$sql="SELECT * FROM profile WHERE stud_id='{$_SESSION['uid']}';";

					  	$stmt=mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("Location: profile.php?notif=1");
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
							<input class="form-control" placeholder="Age" type="text" name="age"  id="age" readonly="" pattern="[0-9]{2}" title="Please input valid age" value="<?php 
						if($profile['age']==0){
								echo "";
							}
							else{
								echo $profile['age'];
							}?>" required>
					</div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Gender :</div>
						<div class="col-sm-7 info">
							 <select class="form-select" placeholder="Gender" id="gender" name="gender" disabled required>
					    		<option selected> 
					    			<?php 
						if($profile['gender']==""){
								echo "Select";
							}
							else{
								echo $profile['gender'];
							}?>
					    		</option>
					    		<option value="Male" >Male</option>
					    		<option value="Female" >Female</option>
					  		</select>
				 		</div>
				 	</div>
					
					<div class="row profile">
						<div class="col-sm-5 label">Mobile Number :</div>
						<div class=" col-sm-7 info"> <input class="form-control" placeholder="Mobile Number" type="text" name="mno"  id="mno" pattern="09[0-9]{9}" title="e.g. 09XXXXXXXXX"  readonly="" value="<?php 
						if($profile['pn']==0){
								echo "";
							}
							else{
								echo $profile['pn'];
							}?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Nationality :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Nationality" type="text" name="nationality"  id="nationality"  readonly="" value="<?php echo $profile['nationality'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Place of Birth :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Place of birth" type="text" name="pob"  id="pob"  readonly="" value="<?php echo $profile['pob']; ?>"></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Date of Birth :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Date of Birth" type="date" name="dob"  id="dob"  readonly="" value="<?php echo $profile['dob'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Religion :</div>
						<div class="col-sm-7 info"><input class="form-control" placeholder="Religion" type="text" name="religion"  id="religion" readonly="" value="<?php
						echo $profile['religion'];?>" required></div>
					</div>
			
			
				<div class="row justify-content-end">
					<div class="col-sm-3" align="right">
						<button class="btn m-2" name="submit" id="save1" type="submit" disabled> <i class="bi bi-save2"></i> </button>
							<button class="btn m-2" id="basic_btn" type="button"> <i class="bi bi-pencil-square"></i>  </button> 
					</div>
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
						<div class="col-sm-7 info"><input class="form-control" placeholder="House Number/Street" type="text" name="hn" id="hn" readonly="" value="<?php
						echo $profile['street'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Barangay :</div>
						<div class="col-sm-7 info"><input class="form-control" placeholder="Barangay" type="text" name="brgy" id="brgy" readonly="" value="<?php
						echo $profile['brgy'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Municipality/City :</div>
						<div class="col-sm-7 info"><input class="form-control" placeholder="City" type="text" name="city" id="city" readonly="" value="<?php 	echo $profile['city'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Province :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Province" type="text" name="prov" id="prov" readonly="" value="<?php 
						echo $profile['province'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Zip Code :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Zipcode" pattern="[0-9]{3,4}" title="Enter valid zip code" type="text" name="zc" id="zc" readonly="" value="<?php 
						if($profile['zip_code']==0){
							echo "";
						}
						else{
						echo $profile['zip_code'];}?>" required></div>
					</div>

				<div class="row justify-content-end">
					<div class="col-sm-3" align="right">
						<button class="btn m-2" name="submit1" id="save2" type="submit" disabled> <i class="bi bi-save2"></i> </button>
							<button class="btn m-2" id="address_btn" type="button"> <i class="bi bi-pencil-square"></i>  </button> 
					</div>
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
						<div class="col-sm-7 info"> <input class="form-control" type="text" placeholder="Mother's Name" name="mn" id="mn" readonly="" value="<?php 
						echo $profile['mn'];
					?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Mother's Occupation :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Mother's Occupation" type="text"  name="mo" id="mo" 
						 readonly="" value="<?php echo $profile['m_occ'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Father's Name :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Father's Name" type="text"  name="fn" id="fn" readonly="" value="<?php 
						echo $profile['fn'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> Father's Occupation :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Father's Occupation" type="text" name="fo" id="fo" readonly="" value="<?php 
						echo $profile['f_occ'];?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label"> No. of Siblings :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="No. of Siblings" pattern="[0-9]+" type="text" name="siblings" id="siblings" readonly="" value="<?php 
							if($profile['nos']==0){
							echo "";
						}
						else{
						echo $profile['nos'];}?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Monthly Income :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Monthly Income" title="Enter valid input" type="text" name="mi" id="mi" readonly="" value="<?php
							if($profile['mi']==0){
							echo "";
						}
						else{ echo $profile['mi'];}?>" required></div>
					</div>
					<div class="row profile">
						<div class="col-sm-5 label">Annual Income :</div>
						<div class="col-sm-7 info"> <input class="form-control" placeholder="Annual Income" type="text" name="ai" id="ai" readonly="" value="<?php 
							if($profile['ai']==0){
							echo "";
						}
						else{
						echo $profile['ai'];}?>" required></div>
					</div>
					<div class="row justify-content-end">
					<div class="col-sm-3" align="right">
						<button class="btn m-2" name="submit2" id="save3" type="submit" disabled> <i class="bi bi-save2"></i> </button>
							<button class="btn m-2" id="family_btn" type="button"> <i class="bi bi-pencil-square"></i>  </button> 
					</div>
				</div>
				</div>
</form>
			</div>
		</div>

	</div>

</div>
</div>
</div>
<footer>
    <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© 2021 All rights reserved.</p>
      </div>
    </div>
  </footer>

<script type="text/javascript">
	document.getElementById('basic_btn').onclick = function() {
    document.getElementById('gender').disabled=false;
    document.getElementById('age').removeAttribute('readonly');
    document.getElementById('mno').removeAttribute('readonly');
    document.getElementById('nationality').removeAttribute('readonly');
    document.getElementById('pob').removeAttribute('readonly');
    document.getElementById('dob').removeAttribute('readonly');
    document.getElementById('religion').removeAttribute('readonly');
    document.getElementById('save1').disabled=false;
    document.getElementById('age').focus();
 
};

	document.getElementById('address_btn').onclick = function() {
    document.getElementById('hn').removeAttribute('readonly');
    document.getElementById('brgy').removeAttribute('readonly');
    document.getElementById('city').removeAttribute('readonly');
    document.getElementById('prov').removeAttribute('readonly');
    document.getElementById('zc').removeAttribute('readonly');
    document.getElementById('hn').focus();
     document.getElementById('save2').disabled=false;
 
};

	document.getElementById('family_btn').onclick = function() {
    document.getElementById('mn').removeAttribute('readonly');
    document.getElementById('mo').removeAttribute('readonly');
    document.getElementById('fn').removeAttribute('readonly');
    document.getElementById('fo').removeAttribute('readonly');
    document.getElementById('siblings').removeAttribute('readonly');
    document.getElementById('mi').removeAttribute('readonly');
    document.getElementById('ai').removeAttribute('readonly');
     document.getElementById('save3').disabled=false;
    document.getElementById('mn').focus();
 
};


document.getElementById('btn1').onclick = function() {
    document.getElementById('pic').hidden=false;
    document.getElementById('upload').hidden=false;
 
};
</script>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>