<?php

session_start();

include '../../main/db.php';

$sql = "SELECT exams.*,
        students.full_name,
        subjects.subject_name,
        rooms.room_name

        FROM exams

        LEFT JOIN students
        ON exams.student_id = students.id

        LEFT JOIN subjects
        ON exams.subject_id = subjects.id

        LEFT JOIN rooms
        ON exams.room_id = rooms.id";

$result = mysqli_query($conn,$sql);

include '../../skin/header.php';
include '../../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between mb-3">

            <h2>
                Quản lý điểm thi
            </h2>

            <a href="create.php"
                class="btn btn-primary">

                Thêm điểm thi
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Thí sinh</th>
                            <th>Môn thi</th>
                            <th>Phòng thi</th>
                            <th>Điểm</th>
                            <th>Hành động</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td><?= $row['id'] ?></td>

                            <td>
                                <?= $row['full_name'] ?>
                            </td>

                            <td>
                                <?= $row['subject_name'] ?>
                            </td>

                            <td>
                                <?= $row['room_name'] ?>
                            </td>

                            <td>

                                <span class="badge bg-success">
                                    <?= $row['score'] ?>
                                </span>

                            </td>

                            <td>

                                <a href="edit.php?id=<?= $row['id'] ?>"
                                    class="btn btn-warning btn-sm">

                                    Sửa
                                </a>

                                <a href="delete.php?id=<?= $row['id'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa điểm thi?')">

                                    Xóa
                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php
include '../../skin/footer.php';
?>