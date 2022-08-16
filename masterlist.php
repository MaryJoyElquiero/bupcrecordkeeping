<?php 

require_once 'dompdf/autoload.inc.php';
include_once "includes/conn.php";

use Dompdf\Dompdf;

$document= new Dompdf;

$output ='

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

<p style="text-align:center;">MASTERLIST';

if (isset($_GET['acady'])) {
	$course="SELECT * from acad_year WHERE id='{$_GET['acady']}';";
					$result = $conn->query($course);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$output .=' '.$row['acad_year'].' ';
}
}
}
$output.='</p>';


				    	
if (isset($_GET['course_id'])) {
	$course="SELECT * from course WHERE id='{$_GET['course_id']}';";
					$result = $conn->query($course);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$output .='<p> Course:'.$row['course'].' </p>';
}
}
}

if (isset($_GET['dept_id'])) {
	$course="SELECT * from department WHERE id='{$_GET['dept_id']}';";
					$result = $conn->query($course);

					if ($result->num_rows > 0) {

					  while($row = $result->fetch_assoc()) {
					  	$output .='<p> Department:'.$row['department'].' </p>';
}
}
}



$output.='
<table>
<tr>
			    <td><b>Student Name</b></td>
			    <td><b> Department</b></td>
			    <td><b>Course</b></td>
				</tr>';	


	$query = "SELECT MAX(id) FROM acad_year";
						$result = mysqli_query($conn,$query);
						$ay= mysqli_fetch_row($result);

	if (isset($_GET['acady'])) {
			$acad_y=$_GET['acady'];
				
			}
			else{
				$acad_y= $ay[0];
			}

if (isset($_GET['course_id'])) {



				$filter=$_GET['course_id'];
					$sql= "SELECT  a.id,a.firstName, a.middleName, a.lastName, y.acad_year,  d.department,c.course  FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE c.id='$filter'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null		
					ORDER BY a.lastName
					ASC;";
			}


			elseif (isset($_GET['dept_id'])) {

				$filter=$_GET['dept_id'];
					$sql= "SELECT  a.id, a.firstName, a.middleName, a.lastName,  y.acad_year,   d.department,c.course FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					WHERE d.id='$filter'
					AND a.acad_year= '$acad_y'
					AND a.verified is not null	
					ORDER BY c.course, a.lastName
					ASC;";
			}

			else{

					$sql= "SELECT a.id, a.firstName, a.middleName, a.lastName,y.acad_year,d.department,c.course FROM accounts a
					JOIN department d
					ON d.id= a.department
					JOIN course c
					ON 	c.id= a.course
					JOIN acad_year y 
					ON a.acad_year=y.id
					AND a.acad_year= '$acad_y'
					AND a.verified is not null
					ORDER BY c.course, a.lastName
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
								 if (!empty($arr)) {
								foreach ($arr as $key => $row) {



	$sql="SELECT count(1) FROM submitted WHERE status ='NS' AND stud_id='{$row['id']}';";
				$count=mysqli_query($conn,$sql);
				$rowcount=mysqli_fetch_array($count);

			$output .='

			      <tr>
			      <td>'.$row['lastName'] .', '.$row['firstName'] .' -'.$row['middleName'] .'</td>
			     <td>'.$row['department'] .' </td>
			     <td>'.$row['course'] .' </td>
				</tr>';
}
$output .= '</tbody></table>';
}



$document->loadHtml($output);
$document->setPaper('A4');
$document->render();
$document->stream("submitted", array("Attachment"=>0));




 ?>