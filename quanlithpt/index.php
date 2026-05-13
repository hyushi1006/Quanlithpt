<?php
include 'skin/header.php';
include 'skin/navbar.php';
#day la phan menu aka trang chu,2 con include day la nguon cam duoc nghich
?>

<div class="hero">

    <div class="container">

        <h1 class="display-4 fw-bold text-primary">
            Hệ Thống Quản Lý Kỳ Thi THPT
        </h1>

        <p class="lead mt-4">
            Website quản lý kỳ thi tốt nghiệp THPT
        </p>

        <div class="mt-4">

            <a href="auth/login.php"
                class="btn btn-primary btn-lg">

                Đăng nhập
            </a>

            <a href="auth/register.php"
                class="btn btn-outline-primary btn-lg">

                Đăng ký
            </a>

        </div>

    </div>

</div>

<?php
include 'skin/footer.php';
?>