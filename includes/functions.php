 <?php
 	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require "../vendor/autoload.php";
    
function createUser($conn,$firstName,$middleName,$lastName,$department,$acad,$course,  $email, $password){

 $mail = new PHPMailer(true);

	  try {
             $mail->SMTPDebug = 0;                      //Enable verbose debug output
    		$mail->isSMTP();    
 
            //Set the SMTP server to send through
            $mail->Host = 'smtp.gmail.com';
 
            //Enable SMTP authentication
            $mail->SMTPAuth = true;
 
            //SMTP username
            $mail->Username = 'bupcrecordkeeping@gmail.com';
 
            //SMTP password
            $mail->Password = 'bupcrk55';
 
            //Enable TLS encryption;
 			 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port = 587;
 
            //Recipients
            $mail->setFrom('bupcrecordkeeping@gmail.com','bupcrecordkeeping');
 
            //Add a recipient
            $mail->addAddress($email, $lastName);
 
            //Set email format to HTML
            $mail->isHTML(true);
 
            $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
            $mail->Subject = 'Email verification';
            $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $code . '</b></p>';
 
            $mail->send();
            // echo 'Message has been sent';

} catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

	$err;
	$sql="INSERT INTO accounts(firstName,middleName,lastName,department, course,acad_year,email,password,code) VALUES (?,?,?,?,?,?,?,?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../createaccount.php?notif=1");
				$err=false;
				return $err;
				exit();
			}
			mysqli_stmt_bind_param($stmt,"sssssssss",$firstName,$middleName,$lastName,$department,$course,$acad, $email, $password,$code);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$err= true;
			return $err;
}

function uidExists($conn, $email, $password){
		$sql="SELECT * FROM accounts WHERE email=? AND password=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../stndtlogin.php?notif=1");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}

function uidAdminExists($conn, $email, $password){
		$sql="SELECT * FROM admin WHERE email=? AND password=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_login.php?notif=1");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}


function emailExists($conn, $email){
		$sql="SELECT * FROM accounts WHERE email=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../signup_connect.php?error=1");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"s", $email);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);			
		}

function nameExists($conn, $firstName, $middleName, $lastName){
		$sql="SELECT * FROM accounts WHERE firstName=? and middleName=? and lastName =?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../signup_connect.php?error=1");
				exit();
			}

			mysqli_stmt_bind_param($stmt,"sss", $firstName, $middleName, $lastName);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}

			else{
				$err= false;
				return $err;
			}

			mysqli_stmt_close($stmt);			
		}

function addprofile($conn, $stud_id){

	$sql1="INSERT INTO profile(stud_id) VALUES ('$stud_id')";

		if (!mysqli_query($conn, $sql1)) {
		header("Location: ../createaccount.php?notif=1");
		exit();
		} 
 
}

function addsubmitted($conn,  $stud_id, $status){
	$sql="SELECT * FROM documents;";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sql1="INSERT INTO submitted (stud_id, doc_id, status) VALUES ('$stud_id', '{$row['id']}', '$status');";

			if (!mysqli_query($conn,$sql1)) {
				header("Location: ../createaccount.php?something'swrong2");
				exit();
			}
		}
	}

}

function admincreateStud($conn,$firstName,$middleName,$lastName,$department,$course,$acad, $email, $password){
	$err;
	$sql="INSERT INTO accounts(firstName,middleName, lastName,department,course,acad_year,email,password) VALUES (?,?,?,?,?,?,?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_create_student.php?notif=1");
				$err=false;
				return $err;
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ssssssss",$firstName,$middleName,$lastName,$department,$course,$acad, $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$err= true;
			return $err;

}

function adminaddprofile($conn, $stud_id){

	$sql1="INSERT INTO profile(stud_id) VALUES ('$stud_id')";

		if (!mysqli_query($conn, $sql1)) {
		header("Location: ../admin_create_student.php?something's wrong");
		exit();
		} 
 
}

function adminaddsubmitted($conn,  $stud_id){
	$sql="SELECT * FROM documents;";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sql1="INSERT INTO submitted (stud_id, doc_id, status) VALUES ('$stud_id', '{$row['id']}', '$status');";

			if (!mysqli_query($conn,$sql1)) {
				header("Location: ../admin_create_student.php?something'swrong2");
				exit();
			}
		}
	}

}


function admincreateFaculty($conn,$firstName,$middleName,$lastName,$department, $email, $password){
	$err;
	$sql="INSERT INTO faculty(firstname,middlename, lastname,department,email,password) VALUES (?,?,?,?,?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_create_faculty.php?notif=1");
				$err=false;
				return $err;
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ssssss",$firstName,$middleName,$lastName,$department, $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$err= true;
			return $err;

}
function admincreateFaculty2($conn,$firstName,$middleName,$lastName,$course, $email, $password){
	$err;
	$sql="INSERT INTO faculty(firstname,middlename, lastname,course,email,password) VALUES (?,?,?,?,?,?);";

	$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_create_faculty.php?notif=1");
				$err=false;
				return $err;
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ssssss",$firstName,$middleName,$lastName,$course, $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			$err= true;
			return $err;

}

function emailFacultyExists($conn, $email){
		$sql="SELECT * FROM faculty WHERE email=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../admin_create_faculty2.php?notif=1");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"s", $email);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}

function uidFacultyExists($conn, $email, $password){
		$sql="SELECT * FROM faculty WHERE email=? AND password=?;";
		$stmt= mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location:../fcltylogin.php?notif=1");
				exit();
			}
			mysqli_stmt_bind_param($stmt,"ss", $email, $password);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);

			if($row=mysqli_fetch_assoc($result)) {	
				return $row;
			}
			else{
				$err= false;
				return $err;
			}
			mysqli_stmt_close($stmt);

				
		}


?>