<?php

session_start();

include '../main/db.php';

$user_id = $_SESSION['user']['id'];

$query = mysqli_query(

    $conn,

    "SELECT * FROM students
    WHERE user_id='$user_id'"
);

$student = mysqli_fetch_assoc($query);

include '../skin/header.php';
include '../skin/navbar.php';
?>

<div class="container mt-5">

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <?php if($student['avatar']): ?>

                        <img
                            src="../uploads/students/<?= $student['avatar'] ?>"
                            class="avatar mb-3">

                    <?php endif; ?>

                    <h3>

                        <?= $student['full_name'] ?>

                    </h3>

                    <p>
                        Thí sinh
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body">

                    <h3>
                        Chào mừng đến hệ thống
                    </h3>

                    <hr>

                    <a href="profile.php"
                        class="btn btn-primary">

                        Hồ sơ cá nhân
                    </a>

                    <a href="results.php"
                        class="btn btn-success">

                        Xem điểm thi
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include '../skin/footer.php';
?>