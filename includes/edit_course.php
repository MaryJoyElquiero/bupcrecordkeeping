<?php 
include_once "conn.php";


if (isset($_POST['update'])) {

    $course= $_POST['course'];
    $id= $_POST['id'];
    $status= $_POST['status'];

    $sql="UPDATE course
            SET course='$course', status='$status'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../admin_courses.php?notif=5");
         exit();
                                }
else{
        header("Location:../editCourse.php?notif=1&id=$id");
        exit();
                                }
}

 ?>