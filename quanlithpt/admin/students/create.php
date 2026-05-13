<?php
#day la phan tao hoac add thi sinh vao nen xin dung dong cham vao no
session_start();

include '../../main/db.php';

if(isset($_POST['create'])){

    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $school = $_POST['school'];

    $avatar = "";

    if($_FILES['avatar']['name']){

        $avatar = time() . "_" . $_FILES['avatar']['name'];

        move_uploaded_file(
            $_FILES['avatar']['tmp_name'],
            "../../uploads/students/" . $avatar
        );
    }

    $sql = "INSERT INTO students(
                full_name,
                gender,
                phone,
                school,
                avatar
            )

            VALUES(
                '$full_name',
                '$gender',
                '$phone',
                '$school',
                '$avatar'
            )";

    mysqli_query($conn,$sql);

    header("Location: index.php");
}

include '../../skin/header.php';
include '../../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <div class="card shadow">

            <div class="card-body">

                <h2 class="mb-4">
                    Thêm thí sinh
                </h2>

                <form method="POST"
                    enctype="multipart/form-data">

                    <div class="mb-3">

                        <label>Họ tên</label>

                        <input type="text"
                            name="full_name"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">

                        <label>Giới tính</label>

                        <select name="gender"
                            class="form-control">

                            <option>Nam</option>
                            <option>Nữ</option>

                        </select>
                    </div>

                    <div class="mb-3">

                        <label>Số điện thoại</label>

                        <input type="text"
                            name="phone"
                            class="form-control">
                    </div>

                    <div class="mb-3">

                        <label>Trường học</label>

                        <input type="text"
                            name="school"
                            class="form-control">
                    </div>

                    <div class="mb-3">

                        <label>Ảnh đại diện</label>

                        <input type="file"
                            name="avatar"
                            class="form-control">
                    </div>

                    <button
                        name="create"
                        class="btn btn-success">

                        Thêm thí sinh
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
include '../../skin/footer.php';
?>