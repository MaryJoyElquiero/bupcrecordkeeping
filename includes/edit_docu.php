<?php 
include_once "conn.php";


if (isset($_POST['update'])) {

    $docu= $_POST['docu'];
    $filetype= $_POST['filetype'];
    $deadline= $_POST['deadline'];
    $status= $_POST['status'];
    $id= $_POST['id'];

    $sql="UPDATE documents
            SET documents='$docu',
            filetype='$filetype',
            deadline='$deadline',
            docu_status='$status'
            WHERE id= '$id';";

if (mysqli_query($conn,$sql)) {
                                    
         header("Location:../admin_documents.php?notif=5");
         exit();
                                }
else{
        header("Location:../editdocu.php?notif=1&id=$id");
        exit();
                                }
}

 ?>