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
if(!$student){

    mysqli_query(

        $conn,

        "INSERT INTO students(
            full_name,
            user_id
        )

        VALUES(
            'Chưa cập nhật',
            '$user_id'
        )"
    );

    $query = mysqli_query(

        $conn,

        "SELECT * FROM students
        WHERE user_id='$user_id'"
    );

    $student = mysqli_fetch_assoc($query);
}

include '../skin/header.php';
include '../skin/navbar.php';
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <div class="d-flex justify-content-between">

                <h2>
                    Hồ sơ cá nhân
                </h2>

                <a href="update_profile.php"
                    class="btn btn-warning">

                    Chỉnh sửa
                </a>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-3">

                    <?php if($student['avatar']): ?>

                        <img
                            src="../uploads/students/<?= $student['avatar'] ?>"
                            class="img-fluid rounded">

                    <?php endif; ?>

                </div>

                <div class="col-md-9">

                    <table class="table">

                        <tr>
                            <th>Họ tên</th>
                            <td><?= $student['full_name'] ?></td>
                        </tr>

                        <tr>
                            <th>Giới tính</th>
                            <td><?= $student['gender'] ?></td>
                        </tr>

                        <tr>
                            <th>SĐT</th>
                            <td><?= $student['phone'] ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?= $student['email'] ?></td>
                        </tr>

                        <tr>
                            <th>Trường</th>
                            <td><?= $student['school'] ?></td>
                        </tr>

                        <tr>
                            <th>Địa chỉ</th>
                            <td><?= $student['address'] ?></td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include '../skin/footer.php';
?>