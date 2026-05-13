<?php

session_start();

include '../../main/db.php';

$students = mysqli_query($conn,"SELECT * FROM students");
$subjects = mysqli_query($conn,"SELECT * FROM subjects");
$rooms = mysqli_query($conn,"SELECT * FROM rooms");

if(isset($_POST['create'])){

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $room_id = $_POST['room_id'];
    $score = $_POST['score'];

    $sql = "INSERT INTO exams(
                student_id,
                subject_id,
                room_id,
                score
            )

            VALUES(
                '$student_id',
                '$subject_id',
                '$room_id',
                '$score'
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
                    Thêm điểm thi
                </h2>

                <form method="POST">

                    <div class="mb-3">

                        <label>Thí sinh</label>

                        <select name="student_id"
                            class="form-control">

                            <?php while($s = mysqli_fetch_assoc($students)): ?>

                                <option value="<?= $s['id'] ?>">

                                    <?= $s['full_name'] ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Môn thi</label>

                        <select name="subject_id"
                            class="form-control">

                            <?php while($sub = mysqli_fetch_assoc($subjects)): ?>

                                <option value="<?= $sub['id'] ?>">

                                    <?= $sub['subject_name'] ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Phòng thi</label>

                        <select name="room_id"
                            class="form-control">

                            <?php while($r = mysqli_fetch_assoc($rooms)): ?>

                                <option value="<?= $r['id'] ?>">

                                    <?= $r['room_name'] ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Điểm</label>

                        <input type="number"
                            step="0.1"
                            min="0"
                            max="10"
                            name="score"
                            class="form-control">

                    </div>

                    <button
                        name="create"
                        class="btn btn-success">

                        Thêm điểm
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php
include '../../skin/footer.php';
?>