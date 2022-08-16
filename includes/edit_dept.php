<?php 
include_once "conn.php";


if (isset($_POST['update'])) {

    $dept= $_POST['dept'];
    $status= $_POST['status'];
    $id= $_POST['id'];

    $sql="UPDATE department
            SET department='$dept', status='$status'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../admin_department.php?notif=5");
         exit();
                                }
else{
        header("Location:../editdept.php?notif=1&id=$id");
        exit();
                                }
}

 ?>