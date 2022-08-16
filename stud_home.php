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
	<title>Home | Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/stud_home.css">
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
		          <a class="nav-link" href="documents.php">Documents</a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link" href="profile.php">Profile</a>
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


			</span>
			<span class="navbar-text">
				<button class="btn" name="logout"> Log Out <i class="bi bi-box-arrow-right"></i></button>
			</span>
								
</form>
		     
		    </div>
		  </div>
</nav>

<?php 
	$sql="SELECT id from submitted WHERE stud_id ='{$_SESSION['uid']}';";
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

								$status="NS";
				    			$sql1="SELECT * FROM documents;";
											$result1 = $conn->query($sql1);

											if ($result1->num_rows > 0) {
												while($row1 = $result1->fetch_assoc()) {
													$sql2="INSERT INTO submitted (stud_id, doc_id, status) VALUES ('$stud_id', '{$row1['id']}', '$status');";

													if (!mysqli_query($conn,$sql2)) {
														echo "Connection Failed";
													}
												}
											}
				    		
						} 
				    
 ?>


<div class="container">
	<div class="row justify-content-center box">
		<div class="row mt-3">
			<p style="font-size: 24px; font-weight:600;"> <i class="bi bi-list-nested" style="font-size: 40px; font-weight: 600;"></i> Submission</p>
		</div>

		<div class="row " style="padding-left: 30px; padding-right: 30px;">

				<div class="col-sm mb-2">
				<div class="card tosubmit " style="background-color: #58a7d6; " >
					<a href="tosubmit.php" style="text-decoration: none;">
					<div class="card-body">
						<div class="row">
							<div class="col"><p id="tosubmit" style=" font-size: 28px; color: white; font-weight: 700;"> 
								<?php 
											$sql= "SELECT count(s.id) as count FROM submitted s
											JOIN documents d 
											ON s.doc_id=d.id
											 WHERE s.status='NS'
											 AND d.deadline >= CURRENT_DATE()
											 AND s.stud_id='{$_SESSION['uid']}';";

												$result = $conn->query($sql);

													if ($result->num_rows > 0) {

													  while($row = $result->fetch_assoc()) {
													   echo  $row['count'];
													}
												}
									 ?>
									 
					</p>
					<p style="font-size:16px;color:white;margin:0;"> To Submit</p>
				</div>
							<div class="col align-self-end"  style="text-align: right; color: white; margin-bottom: 15px;"><i class="bi bi-arrow-right-circle-fill" style=" font-size: 40px; color: white; font-weight: 700;"></i></div>
						</div> 	
					</div>
				</a>
				</div>
			</div>
		
			<div class="col-sm mb-2">
				
				<div class="card tosubmit" style="background-color: #f4a5a7 ;">
					<a href="missed.php" style="text-decoration: none;">
					<div class="card-body">
						<div class="row">
							<div class="col"><p style=" font-size: 28px; color: white; font-weight: 700;"> 
								<?php 
											$sql= "SELECT count(s.id) as count FROM submitted s
											JOIN documents d 
											ON s.doc_id=d.id
											 WHERE s.status='NS'
											 AND d.deadline<CURRENT_DATE()
											 AND s.stud_id='{$_SESSION['uid']}';";

												$result = $conn->query($sql);

													if ($result->num_rows > 0) {

													  while($row = $result->fetch_assoc()) {
													   echo  $row['count'];
													}
												}
									 ?>
									 
					</p>
					<p style="font-size:16px;color:white;margin:0;"> Missed</p>
				</div>
							<div class="col align-self-end"  style="text-align: right; color: white; margin-bottom: 15px;"><i class="bi bi-arrow-right-circle-fill" style=" font-size: 40px; color: white; font-weight: 700;"></i></div>
						</div>
					</div>
					</a>
				</div>
					
			</div>
		
	
		</div>
		<div class="row mt-3">
			<p style="font-size: 24px; font-weight:600;"> <i class="bi bi-bell" style="font-size: 40px; font-weight: 600;"></i> Announcements </p>
		</div>
<div class="row mb-3" style="margin-left: 30px; margin-right: 30px;">
<div class="card" style="overflow-y: scroll; height: 500px; ">
	<div class="card-body" >

		<?php
								$sql="SELECT id, notif, notif_date from notifications order by id desc;";

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

				  		foreach ($arr as $key => $notif) {

				  			?>
		<div class="row mb-2" >
			<div class="col-sm">

				<div class="card" style="background-color:#f6f9f8;" >
					<div class="card-body">
						<div class="datenotif" style="font-size: 14px;"> <?php echo $notif['notif_date'];  ?></div>
						<div class="notif" style="font-size: 16px;"> <i class=" bi bi-dot"></i> <?php echo $notif['notif']; ?></div>
				
					</div>
				</div>
			</div>
		</div>
	<?php }} ?>
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

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>