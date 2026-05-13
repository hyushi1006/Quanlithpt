<?php
#day la phan edit hoc sinh, cam dong vao
session_start();

include '../../main/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn,$sql);

$student = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $school = $_POST['school'];

    $avatar = $student['avatar'];

    if($_FILES['avatar']['name']){

        $avatar = time() . "_" . $_FILES['avatar']['name'];

        move_uploaded_file(
            $_FILES['avatar']['tmp_name'],
            "../../uploads/students/" . $avatar
        );
    }

    $update = "UPDATE students SET

                full_name='$full_name',
                gender='$gender',
                phone='$phone',
                school='$school',
                avatar='$avatar'

                WHERE id='$id'";

    mysqli_query($conn,$update);

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
                    Sửa thí sinh
                </h2>

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
                                <?= $student['gender']=='Nam'?'selected':'' ?>>
                                Nam
                            </option>

                            <option
                                <?= $student['gender']=='Nữ'?'selected':'' ?>>
                                Nữ
                            </option>

                        </select>
                    </div>

                    <div class="mb-3">

                        <label>Số điện thoại</label>

                        <input type="text"
                            name="phone"
                            value="<?= $student['phone'] ?>"
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

                        <label>Ảnh hiện tại</label>
                        <br>

                        <img
                            src="../../uploads/students/<?= $student['avatar'] ?>"
                            width="100">
                    </div>

                    <div class="mb-3">

                        <label>Ảnh mới</label>

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

</div>

<?php
include '../../skin/footer.php';
?>