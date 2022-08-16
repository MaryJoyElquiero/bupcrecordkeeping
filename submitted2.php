<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

<?php

include_once "includes/conn.php";
	$stud_id= $_GET['id'];
$sql="SELECT a.id, p.profilepic, a.firstName, a.middleName, a.lastName, c.course, d.department FROM accounts a
	JOIN department d
	ON d.id=a.department
	JOIN profile p
	ON a.id=p.stud_id
	JOIN course c 
	ON c.id= a.course 
	WHERE a.id='$stud_id';";
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

									$name= $row['lastName'] . ", " . $row['firstName'] . " -" .$row['middleName'];
									$course=$row['course'];
									$department=$row['department'];
									}}

									?>


<style>
table{
	border-collapse: collapse;
	width: 100%;
}
td,th{
	border: 1px solid black;
	text-align: left;
	padding: 8px;
}
td: nth-child(even){
	background-color: #ddddddd;
}
tbody{
	margin-top: 10px;
}
.text{
	font-size: 12px; 
}

</style>

<p class="text">Republic of the Philippines</p>
<p class="text">Bicol University</p>
<p class="text">Polangui, Albay</p>
<hr>
<br>
 <p> Name:  <?php echo $name; ?></p>
 <p> Course:  <?php echo $course; ?></p>
 <p> Department:  <?php echo $department ?></p>

<hr>
<br>
<table>
	<tr>
		<td>Docu Name</td>
		<td>Status</td>
		<td>Date Submitted</td>
	</tr>
<tbody>	
<?php 

$sql="SELECT d.documents, s.status, s.sub_date FROM submitted s 
			  	JOIN documents d 
			  	ON s.doc_id=d.id
			  	WHERE s.stud_id ='$stud_id';";
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

									if ($row['status']=="S") {
										$status= "Submitted";
									}
									elseif($row['status']=="NS"){
										$status= "Not Submitted";
									}
									else{
										$status= "Submitted -Late";
									}

?>

<tr>
	<td><?php echo $row['documents']; ?></td>
	<td><?php echo $status; ?></td>
	<td><?php echo $row['sub_date']; ?></td>
</tr>

<?php

 }}?>
</tbody>
</table>
</body>
</html>