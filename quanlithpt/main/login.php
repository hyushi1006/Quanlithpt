<?php
session_start();
include '../main/db.php';
#day la database, cam duoc nghich
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user'] = $user;

        if($user['role'] == 'admin'){
            header("Location: ../admin/dashboard.php");
        }else{
            header("Location: ../student/dashboard.php");
        }
    }else{
        echo "Sai tài khoản hoặc mật khẩu";
    }
}
?>