<?php 
include_once "conn.php";


if (isset($_POST['verify'])) {

    $email= $_POST['email'];
    $code= $_POST['code'];
    $verified_at=date('Y-m-d H:i:s');

    $sql = "SELECT code FROM accounts WHERE email='$email' and code='$code';";
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                  header("Location:../emailverification.php?notif=4& email=" .$email);
                exit();
            } 
            
    $sql1="UPDATE accounts
            SET verified='$verified_at'
            WHERE email= '$email'
            AND code='$code';";

if (mysqli_query($conn,$sql1)) {
                                    
         header("Location:../stdntlogin.php?notif=3");
         exit();
                                }
else{
        header("Location:../emailverification.php?notif=1& email=" .$email);
        exit();
                                }
}

if (isset($_POST['facultyverify'])) {

    $email= $_POST['email'];
    $code= $_POST['code'];
    $verified_at=date('Y-m-d H:i:s');

    $sql = "SELECT code FROM faculty WHERE email='$email' and code='$code';";
        $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                  header("Location:../emailfacultyverification.php?notif=4&email=".$email);
                exit();
            } 
            
    $sql1="UPDATE faculty
            SET verified='$verified_at'
            WHERE email= '$email'
            AND code='$code';";

if (mysqli_query($conn,$sql1)) {
                                    
         header("Location:../fcltylogin.php?notif=3");
         exit();
                                }
else{
        header("Location:../emailfacultyverification.php?notif=1&email=".$email);
        exit();
                                }
}
 ?>