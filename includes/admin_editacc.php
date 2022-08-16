<?php 
include_once "conn.php";


if (isset($_POST['editstudent'])) {

    $firstName= $_POST['firstName'];
    $middleName= $_POST['middleName'];
    $lastName= $_POST['lastName'];
    $department= $_POST['department'];
    $course= $_POST['course'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $id= $_POST['id'];



$sql = "SELECT email FROM accounts WHERE email='$email' AND id !='$id';";
 

if ($result = mysqli_query($conn, $sql)) {
    $count = mysqli_num_rows( $result );
 
 if ($count>0) {
      header("Location:../edit_student_acc.php?id=$id&notif=4");
         exit();
 }
}


    if (strlen($password)<6) {
            header("Location:../edit_student_acc.php?notif=3&id=$id");
            exit();
        }


    $sql="UPDATE accounts
            SET firstName='$firstName',
             middleName='$middleName',
             lastName='$lastName',
             department='$department',
             course='$course',
             email='$email',
             password='$password'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../edit_student_acc.php?id=$id&notif=1");
         exit();
                                }
else{
        header("Location:../edit_student_acc.php?notif=2&id=$id");
        exit();
                                }
}


if (isset($_POST['editfaculty'])) {

    $firstName= $_POST['firstName'];
    $middleName= $_POST['middleName'];
    $lastName= $_POST['lastName'];
    $department= $_POST['department'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $id= $_POST['id'];



$sql = "SELECT email FROM faculty WHERE email='$email' AND id !='$id';";
 

if ($result = mysqli_query($conn, $sql)) {
    $count = mysqli_num_rows( $result );
 
 if ($count>0) {
      header("Location:../edit_faculty_acc.php?id=$id&notif=4");
         exit();
 }
}


    if (strlen($password)<6) {
            header("Location:../edit_faculty_acc.php?notif=3&id=$id");
            exit();
        }


    $sql="UPDATE faculty
            SET firstName='$firstName',
             middleName='$middleName',
             lastName='$lastName',
             department='$department',
             email='$email',
             password='$password'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../edit_faculty_acc.php?id=$id&notif=1");
         exit();
                                }
else{
        header("Location:../edit_faculty_acc.php?notif=2&id=$id");
        exit();
                                }
}


if (isset($_POST['editfaculty2'])) {

    $firstName= $_POST['firstName'];
    $middleName= $_POST['middleName'];
    $lastName= $_POST['lastName'];
    $course= $_POST['course'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $id= $_POST['id'];



$sql = "SELECT email FROM faculty WHERE email='$email' AND id !='$id';";
 

if ($result = mysqli_query($conn, $sql)) {
    $count = mysqli_num_rows( $result );
 
 if ($count>0) {
      header("Location:../edit_faculty_acc2.php?id=$id&notif=4");
         exit();
 }
}


    if (strlen($password)<6) {
            header("Location:../edit_faculty_acc2.php?notif=3&id=$id");
            exit();
        }


    $sql="UPDATE faculty
            SET firstName='$firstName',
             middleName='$middleName',
             lastName='$lastName',
             course='$course',
             email='$email',
             password='$password'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../edit_faculty_acc2.php?id=$id&notif=1");
         exit();
                                }
else{
        header("Location:../edit_faculty_acc2.php?notif=2&id=$id");
        exit();
                                }
}

 ?>