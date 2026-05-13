<?php
#cam nghich vi day la ket noi database cuc ki quan trong
session_start();

include '../main/db.php';

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE username='$username'";

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

        $message = "Sai tài khoản hoặc mật khẩu";
    }
}

include '../skin/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    Đăng nhập
                </h2>

                <?php if($message): ?>

                    <div class="alert alert-danger">
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
                        name="login"
                        class="btn btn-primary w-100">

                        Đăng nhập
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
include '../skin/footer.php';
#nghich thoai mai trong phan div
?>