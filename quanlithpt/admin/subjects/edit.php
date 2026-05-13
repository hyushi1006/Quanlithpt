<?php

session_start();

include '../../main/db.php';

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM subjects WHERE id='$id'"
);

$subject = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $subject_name = $_POST['subject_name'];

    $sql = "UPDATE subjects SET

            subject_name='$subject_name'

            WHERE id='$id'";

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
                    Sửa môn thi
                </h2>

                <form method="POST">

                    <div class="mb-3">

                        <label>Tên môn thi</label>

                        <input type="text"
                            name="subject_name"

                            value="<?= $subject['subject_name'] ?>"

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