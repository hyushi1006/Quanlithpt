<?php

session_start();

include '../../main/db.php';

if(isset($_POST['create'])){

    $subject_name = $_POST['subject_name'];

    $sql = "INSERT INTO subjects(subject_name)
            VALUES('$subject_name')";

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
                    Thêm môn thi
                </h2>

                <form method="POST">

                    <div class="mb-3">

                        <label>Tên môn thi</label>

                        <input type="text"
                            name="subject_name"
                            class="form-control"
                            required>

                    </div>

                    <button
                        name="create"
                        class="btn btn-success">

                        Thêm môn
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
include '../../skin/footer.php';
?>