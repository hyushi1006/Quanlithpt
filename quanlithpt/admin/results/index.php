<?php

session_start();

include '../../main/db.php';

$sql = "SELECT graduation_results.*,
        students.full_name

        FROM graduation_results

        LEFT JOIN students
        ON graduation_results.student_id = students.id";

$result = mysqli_query($conn,$sql);

include '../../skin/header.php';
include '../../skin/navbar.php';
?>

<div class="d-flex">

    <?php include '../../skin/sidebar.php'; ?>

    <div class="container-fluid p-4">

        <div class="d-flex justify-content-between mb-3">

            <h2>
                Kết quả tốt nghiệp
            </h2>

            <a href="process.php"
                class="btn btn-success">

                Tính kết quả
            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Điểm trung bình</th>
                            <th>Kết quả</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?= $row['id'] ?>
                            </td>

                            <td>
                                <?= $row['full_name'] ?>
                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    <?= round($row['average_score'],2) ?>

                                </span>

                            </td>

                            <td>

                                <?php if($row['result_status'] == 'ĐẬU'): ?>

                                    <span class="badge bg-success">

                                        ĐẬU

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">

                                        RỚT

                                    </span>

                                <?php endif; ?>

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