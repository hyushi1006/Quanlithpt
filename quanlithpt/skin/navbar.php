
<?php
#100% AI CODE VI QUA LUOI, TU BIA RA VOI CHINH SUA TREN LOP NHE SAN, NHO BILI NO THIET KE VOI LAM MAU ME VAO
#session_start(); that su thi cai dong code nay overrated vcl, nen neu bi co hoi thi chiu nhe
#xoa no di van chay duoc ma de thi no hien ra cai session da duoc tao roi trong ngua mat lam.
#Để khắc phục, bạn cần kiểm tra xem session đã tồn tại chưa trước khi gọi hàm, ví dụ: sử dụng if (session_status() === PHP_SESSION_NONE) { session_start(); }
#nhe
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand fw-bold" href="/QUANLITHPT">
            Quản Lý THPT
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <?php if(isset($_SESSION['user'])): ?>

                    <li class="nav-item">
                        <a class="nav-link">
                            Xin chào,
                            <?= $_SESSION['user']['username'] ?>
                        </a>
                    </li>

                    <?php if($_SESSION['user']['role'] == 'admin'): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/QUANLITHPT/admin/dashboard.php">
                                Admin
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/QUANLITHPT/student/dashboard.php">
                                Student
                            </a>
                        </li>

                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-warning"
                            href="/QUANLITHPT/auth/logout.php">
                            Đăng xuất
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/QUANLITHPT/auth/login.php">
                            Đăng nhập
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/QUANLITHPT/auth/register.php">
                            Đăng ký
                        </a>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>