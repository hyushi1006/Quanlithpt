<?php
include '../main/ketnoivoidatabase.php';
#day la database cua register(register trong phan auth la co the nghich vi no la phan de chinh sua), cam duoc nghich
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username,password)
            VALUES('$username','$password')";

    mysqli_query($conn,$sql);

    echo "Đăng ký thành công";
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Tên đăng nhập">
    <input type="password" name="password" placeholder="Mật khẩu">
    <button name="register">Đăng ký</button>
</form>