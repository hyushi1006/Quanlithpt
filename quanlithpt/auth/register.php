<?php
session_start();
include '../main/db.php';
#cam nghich phan nay
$message = "";

if(isset($_POST['register'])){

    $username = $_POST['username'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users(username,password)
            VALUES('$username','$password')";

if(mysqli_query($conn,$sql)){

    $user_id = mysqli_insert_id($conn);

    mysqli_query(

        $conn,

        "INSERT INTO students(
            full_name,
            user_id
        )

        VALUES(
            '$username',
            '$user_id'
        )"
    );

    $_SESSION['success'] =
        "Đăng ký thành công! Đang chuyển đến đăng nhập...";

    header("refresh:2;url=login.php");

    }else{
        $message = "Tên tài khoản đã tồn tại";
    }
}

include '../skin/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    Đăng ký
                </h2>

                <?php if($message): ?>

                    <div class="alert alert-info">
                        <?= $message ?>
                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label>Tài khoản</label>

                        <input type="text"
                            name="username"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Mật khẩu</label>

                        <input type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>

                    <button
                        name="register"
                        class="btn btn-primary w-100">

                        Đăng ký
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
#nghich thoai mai phan div class nay
include '../skin/footer.php';
?>