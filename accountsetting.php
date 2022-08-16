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
	<title>Student | Settings</title>

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

					$sql="SELECT email from accounts WHERE id='{$_SESSION['uid']}';";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					   echo "<i class='bi bi-dot'></i>
	".$row['email'] ."   <i class='bi bi-person-circle'></i> &nbsp;";
					  }

					}

				?>


				
				<button class="btn" name="logout"><i class="bi bi-box-arrow-right"></i> Log Out</button>
</form>
			</span>
			
		     
		    </div>
		  </div>
</nav>


<div class="container">
<div class="row justify-content-center">
	<div class="row justify-content-center box">
		<div class="row justify-content-center">
			<div class="col-sm student">
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
					<button class="btn1" id="btn1"> Change Profile Picture</button>

					<form action="includes/uploadpic.php" method="POST" enctype="multipart/form-data">
						<input class="form-control mt-2" hidden type="file" id="pic" name="file">
						<button class="btn mt-2 mb-2" hidden id="upload" name="up">Upload</button>
					</form>
					<p>
						<a href="accountsetting.php" style="text-decoration: none; color: black; font-weight: 600;">Account Setting</a></p>

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




			<div class="col-lg-8 profileinfo">
				<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
							  <ol class="breadcrumb mt-3">
							    <li class="breadcrumb-item"><a href="profile.php">Go Back</a></li>
							    <li class="breadcrumb-item active" aria-current="page"> Account Setting</li>
							  </ol>
						</nav>
				<div class="basic">
					
				<div class="title"> 
					<p>Change Password
					</p>
				</div>




				<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
								  <strong> Confirm Password doesn't match </strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-success alert-dismissible fade show m-2" role="alert">
					  <strong> Password Changed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Failed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			     		<?php
			        break;
			      case 4:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Connection Failed </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
			       <?php
			        break;
			        case 5:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> Old Password incorrect</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
					 break;
			        case 6:
			       ?>
			       	<div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
					  <strong> New password is too short</strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<?php
			      default:
			        echo "";
			        break;
			    }
			  }
	 		?>
<div class="form">

				<form action="includes/changepass.php" method="POST">
  <div class="form-group mb-2">
    <label for="exampleInputEmail1">Old Password</label>
    <input type="password" name="oldpass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Old Password">

  </div>
  <div class="form-group mb-2">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="newpass" pattern=".{6,}" title="6 or more characters" class="form-control" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <div class="form-group mb-2">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <button type="submit" name="submit" class="btn">Update</button>
</form>
</div>

				</div>
			</div>
		</div>

	</div>

</div>
</div>


</div>

<footer id="footer">
    <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© 2021 All rights reserved.</p>
      </div>
    </div>
  </footer>

<script type="text/javascript">

document.getElementById('btn1').onclick = function() {
    document.getElementById('pic').hidden=false;
    document.getElementById('upload').hidden=false;
 
};
</script>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>