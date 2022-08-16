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
	<title>Documents | Student</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"> 
    <link rel="stylesheet" href="css/documents.css">
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
		          <a class="nav-link" href="stud_home.php">Submission</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" aria-current="page" href="#"><b>Documents</b></a>
		        </li>
		         <li class="nav-item">
		          <a class="nav-link" href="profile.php">Profile</a>
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

					<button class="btn" name="logout"> Log Out <i class="bi bi-box-arrow-right"></i></button>
</form>
			</span>
			
		     
		    </div>
		  </div>
</nav>


<div class="container">
	<div class="box">
		<div class="row justify-content-center docs">
			<div class="row m-2 ">
			<h4>My Documents </h4>
			<hr>
			</div>
			<div class="col-md-12 docu">



					<?php 
			  if (isset($_GET['notif'])) {
			    switch ($_GET['notif']) {
			      case 1:
			        ?>
			        	<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong> Uploaded</strong>
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
						<?php
			        break;
			      case 2:
			        ?>
					 	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Failed to Upload </strong>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>		
			        <?php
			        break;
			      case 3:
			     		?>
			     	<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong> Invalid file type. Please upload suggested document file type.</strong>
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
		
				
					<?php
						$sql="SELECT d.id, d.documents, s.file, s.sub_date FROM submitted s
						JOIN documents d 
						ON s.doc_id=d.id
						WHERE stud_id= '{$_SESSION['uid']}'
						AND S.status='S';";
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
					    	?>
					    	<div class="row justify-content-center">
					    		<div class="col-lg-auto text-center">
					  			<i class="bi bi-folder-x" style="font-size: 30px; color: #37af96;"></i>
					  			<p style="font-size: 16px; color: #37af96;" > You have no submitted documents</p>
					  			</div>
					  		</div>

					  		<?php
					  	}
					  		else{

					  		foreach ($arr as $key => $submitted) {

					  			?>
					  			
					  			<form action="includes/editfile.php" method="POST" enctype="multipart/form-data">
					  			<div class="card">
								  <div class="card-body">
								    <h5 class="card-title"> <?php echo $submitted['documents']; ?></h5>
								    <p class="card-text">
								    	<i class="bi bi-file-earmark-richtext"></i>
								    	<?php echo $submitted['file']; ?>
								    </p>
								    <p class="card-text" style="font-size: 14px;">
								    	Date Submitted: <?php echo $submitted['sub_date']; ?>
								    </p>
								    <?php 
								    echo "<a href='documents/".$submitted['file']."' class='btn'> <i class='bi bi-fullscreen'></i> </a>"; ?>
								    <?php
								    echo "<a href='documents/".$submitted['file']."'  class='btn' download> <i class='bi bi-download'></i> </a>"; ?>
								    
								    <button type="button" class="btn" onclick="btnclicked(this.id)" id="<?php echo $submitted['id']; ?>"> <i class="bi bi-pencil-square"></i></button>
								    <input hidden name="doc_id" value="<?php echo $submitted['id']; ?>">
								    <input hidden name="file" class="form-control" accept=".pdf, .jpg, .jpeg, .png" id="input<?php echo $submitted['id']; ?>" type="file"  style="margin-top: 10px" required>
								    <button hidden class="btn" id="submit<?php echo $submitted['id']; ?>" style="margin-top:10px;" name="submit" > Submit</button>
								  </div>
								</div>
								</form>
					  			<?php
					  		}
					  	}
					  	?>
					  	
	
					 
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
 function btnclicked(clicked)
{
    document.getElementById('input'+clicked).hidden=false;
    document.getElementById('submit'+clicked).hidden=false;
}
</script>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>