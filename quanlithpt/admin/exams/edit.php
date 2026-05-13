<?php

session_start();

include '../../main/db.php';

$id = $_GET['id'];

$exam_query = mysqli_query(
    $conn,
    "SELECT * FROM exams WHERE id='$id'"
);

$exam = mysqli_fetch_assoc($exam_query);

$students = mysqli_query($conn,"SELECT * FROM students");
$subjects = mysqli_query($conn,"SELECT * FROM subjects");
$rooms = mysqli_query($conn,"SELECT * FROM rooms");

if(isset($_POST['update'])){

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $room_id = $_POST['room_id'];
    $score = $_POST['score'];

    $sql = "UPDATE exams SET

            student_id='$student_id',
            subject_id='$subject_id',
            room_id='$room_id',
            score='$score'

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
                    Sửa điểm thi
                </h2>

                <form method="POST">

                    <div class="mb-3">

                        <label>Thí sinh</label>

                        <select name="student_id"
                            class="form-control">

                            <?php while($s = mysqli_fetch_assoc($students)): ?>

                            <option
                                value="<?= $s['id'] ?>"

                                <?= $exam['student_id']==$s['id']
                                    ? 'selected'
                                    : '' ?>>

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

                            <option
                                value="<?= $sub['id'] ?>"

                                <?= $exam['subject_id']==$sub['id']
                                    ? 'selected'
                                    : '' ?>>

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

                            <option
                                value="<?= $r['id'] ?>"

                                <?= $exam['room_id']==$r['id']
                                    ? 'selected'
                                    : '' ?>>

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

                            value="<?= $exam['score'] ?>"

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