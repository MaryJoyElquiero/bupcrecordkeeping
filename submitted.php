<?php 
require_once 'dompdf/autoload.inc.php';
include_once "includes/conn.php";
use Dompdf\Dompdf;
use Dompdf\Options;



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


$output ='
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
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
 <p> Name: ' .$name .'</p>
 <p> Course: ' . $course .'</p>
 <p> Department: ' .$department .'</p>

<hr>
<br>



<table>
<tr>
			      <td><b>Doc Name</b></td>
			     <td><b> Status</b></td>
			    <td><b>Date Submitted</b></td>
				</tr>
                <tbody>' ;
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
									$output .='

			      <tr>
			      <td>'.$row['documents'] .'</td>
			     <td>'.$status .' </td>
			    <td>'. $row['sub_date'] . '</td>
				</tr>';
}
$output .= '</tbody></table></body></html>';
}


$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->setIsHtml5ParserEnabled(true);
$dompdf->setOptions($options);

$dompdf->loadHtml($output);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'Portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("submitted", array("Attachment"=>0));


 ?>