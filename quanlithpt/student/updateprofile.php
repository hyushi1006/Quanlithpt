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

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $address = $_POST['address'];

    $avatar = $student['avatar'];

    if($_FILES['avatar']['name']){

        $avatar = time() . "_" . $_FILES['avatar']['name'];

        move_uploaded_file(

            $_FILES['avatar']['tmp_name'],

            "../uploads/students/" . $avatar
        );
    }

    mysqli_query(

        $conn,

        "UPDATE students SET

        full_name='$full_name',
        gender='$gender',
        phone='$phone',
        email='$email',
        school='$school',
        address='$address',
        avatar='$avatar'

        WHERE user_id='$user_id'"
    );

    header("Location: profile.php");
}

include '../skin/header.php';
include '../skin/navbar.php';
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2>
                Cập nhật hồ sơ
            </h2>

            <hr>

            <form method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">

                    <label>Họ tên</label>

                    <input type="text"
                        name="full_name"

                        value="<?= $student['full_name'] ?>"

                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Giới tính</label>

                    <select name="gender"
                        class="form-control">

                        <option
                            <?= $student['gender']=='Nam'
                            ? 'selected'
                            : '' ?>>

                            Nam

                        </option>

                        <option
                            <?= $student['gender']=='Nữ'
                            ? 'selected'
                            : '' ?>>

                            Nữ

                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>SĐT</label>

                    <input type="text"
                        name="phone"

                        value="<?= $student['phone'] ?>"

                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                        name="email"

                        value="<?= $student['email'] ?>"

                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Trường học</label>

                    <input type="text"
                        name="school"

                        value="<?= $student['school'] ?>"

                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Địa chỉ</label>

                    <textarea
                        name="address"
                        class="form-control"><?= $student['address'] ?></textarea>

                </div>

                <div class="mb-3">

                    <label>Avatar</label>

                    <input type="file"
                        name="avatar"
                        class="form-control">

                </div>

                <button
                    name="update"
                    class="btn btn-primary">

                    Cập nhật
                </button>

            </form>

        </div>

    </div>

</div>

<?php
include '../skin/footer.php';
?>