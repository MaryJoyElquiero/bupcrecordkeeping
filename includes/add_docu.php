<?php 

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
    //Load Composer's autoloader
    require "../vendor/autoload.php";

include_once "conn.php";



if (isset($_POST['add'])) {
	
	$docu=$_POST['docu'];
	$filetype=$_POST['filetype'];
	$deadline=$_POST['deadline'];
	$status="NS";
	$dstatus="Active";
	$notif="Registrar added a new requirement: <br>&ensp;&ensp; Docu name: <b>". $docu . "</b><br>&ensp;&ensp; Deadline: <b>". $deadline . "</b>";
	$notif_date= date("F d, Y h:i:s A");
	$notifstatus="Unread";

	$sql="INSERT INTO documents(documents,filetype,deadline,docu_status) VALUES ('$docu','$filetype','$deadline','$dstatus')";

		if (mysqli_query($conn, $sql)) {

			
			$sql1="SELECT id FROM documents WHERE documents='$docu';";
			$result1 = $conn->query($sql1);

					if ($result1->num_rows > 0) {

					  while($row1 = $result1->fetch_assoc()) {
					 	$doc_id=$row1['id'];
					}
				}
				else{
					header("Location:../admin_documents.php?nodocufound");
					exit();
				}

			$sql2="SELECT * FROM accounts;";
			$result2 = $conn->query($sql2);

					if ($result2->num_rows > 0) {
						
					  while($row2 = $result2->fetch_assoc()) {
					

					 	$sql3="INSERT INTO submitted (stud_id, doc_id, status) VALUES ('$stud_id', '$doc_id', '$status');";

						if (mysqli_query($conn, $sql3)) {

						}
						else{
							header("Location:../admin_documents.php?accountnotaddded");
							exit();
						}

						$mail = new PHPMailer(true);
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


						$email=$row2['email'];
					  	$lastName=$row2['lastName'];
					  	$firstName=$row2['firstName'];
					 	$stud_id=$row2['id'];
			 
			            //Recipients
			            $mail->setFrom('bupcrecordkeeping@gmail.com','bupcrecordkeeping');
			            $mail->addReplyTo('bupcrecordkeeping@gmail.com');
			 
			 			//Set email format to HTML
			            $mail->isHTML(true);
						   //Add a recipient
            $mail->addAddress($email, $lastName);
 
            $mail->Subject = 'New Announcement - Registrar added a new requirement';
            $mail->Body    = '
            
            <p>Hi '.$firstName .', <br><br> Registrar added a new requirement. Submit on or before the due date. <br> Docu Name: <b> '.$docu.'</b> <br> Due on: <b>'.$deadline.'</b>
            <br>
            <br>
            <button style="background-color: #37af96; height: 30px; border-radius: 5px; border: none; ">
            <a href="bupcrecordkeeping.infinityfreeapp.com/stud_home.php" class="btn btn-primary" style="text-decoration: none; color: white; font-size: 16px;"> Go to site -></a>
            </button> </p>';
 		$mail->send();
          
					}
						
  				


				$sql4="INSERT INTO notifications (notif, notif_date, status) VALUES ('$notif', '$notif_date', '$status');";

						if(mysqli_query($conn, $sql4)){

						}
						else{
							header("Location:../admin_documents.php?notifnotadded");
							exit();

						}


					header("Location:../admin_documents.php?notif=1");
					exit();
				}
				else{
					header("Location:../admin_documents.php?accountnotfound");
					exit();
				}

					
														

			} 

		else {
			header("Location:../admin_documents.php?notif=2");
			exit();
					}		

}




 ?>