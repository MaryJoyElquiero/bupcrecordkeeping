<?php 
include_once "conn.php";


if (isset($_POST['update'])) {

    $fn= $_POST['fn'];
    $id= $_POST['id'];
    $mn= $_POST['mn'];
    $ln= $_POST['ln'];
    $dept= $_POST['dept'];
    $course= $_POST['course'];


    $sql="UPDATE accounts
            SET firstName='$fn',
            middleName='$mn',
            lastName='$ln',
            department='$dept',
            course='$course'
            WHERE id= '$id';";
            ;

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../admin_home.php?notif=5");
         exit();
                                }
else{
        header("Location:../editstudent.php?student=$id");
        exit();
                                }
}

 ?>